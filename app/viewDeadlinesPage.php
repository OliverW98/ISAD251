<?php

include $_SERVER['DOCUMENT_ROOT'] . '/ISAD251/owilkes/app/src/model/DBFunctions.php';
include $_SERVER['DOCUMENT_ROOT'] . '/ISAD251/owilkes/app/src/model/appointment.php';
include $_SERVER['DOCUMENT_ROOT'] . '/ISAD251/owilkes/app/src/model/deadline.php';
include $_SERVER['DOCUMENT_ROOT'] . '/ISAD251/owilkes/app/src/model/user.php';


session_start();
$user = getUser();
$deadlinesArray = ($user->getDeadlineArray());
$txtDeadlineList = fillTextArea($deadlinesArray);
$txtDeadlineDetails = $paraOutput = $selectedDeadlineID = '';
$paraOutputColour = 'black';

function fillTextArea($array) //fills the textarea with all the child's deadlines
{
    $txt = '';
    for ($i = 0; $i < count($array); $i++) {
        $txt .= "You have an deadline on : {$array[$i]->getDeadlineDate()}.\r\n";
    }
    return $txt;
}

function findDeadlineID($array, $date) //find the selected deadlineID using the date selected
{
    for ($i = 0; $i < count($array); $i++) {
        if ($array[$i]->getDeadlineDate() == $date) {
            return $array[$i]->getDeadlineID();
        }
    }
}

function findDeadlineDetails($array, $ID) //fills the textarea with all the details of the selected deadline
{
    $txt = '';
    for ($i = 0; $i < count($array); $i++) {
        if ($array[$i]->getDeadlineID() == $ID) {
            $txt = "Deadline Date    : {$array[$i]->getDeadlineDate()} \n";
            $txt .= "Deadline Details : {$array[$i]->getDeadlineDetails()} \n";
            $txt .= "Deadline Met     : {$array[$i]->getDeadlineMet()}";
        }
    }
    return $txt;
}

function findDeadlineMet($array, $ID) // returns if selected deadline is met
{
    for ($i = 0; $i < count($array); $i++) {
        if ($array[$i]->getDeadlineID() == $ID) {
            return $array[$i]->getDeadlineMet();
        }
    }
}

function editUserDeadlineMet($ID, $met)
{
    editDeadlineMet($ID, $met);
}

if (isset($_POST['btnViewDeadline'])) {

    $selectedDate = $_POST['selectDeadlineDate'];
    $selectedDeadlineID = findDeadlineID($deadlinesArray, $selectedDate);
    $txtDeadlineDetails = findDeadlineDetails($deadlinesArray, $selectedDeadlineID);
}

if (isset($_POST['btnEditDeadline'])) {
    $_SESSION['selectedDeadlineDate'] = $_POST['selectDeadlineDate'];
    header("Location: editDeadlinePage.php");
}

if (isset($_POST['btnDeadlineMet'])) {
    //selected deadline toggles between met and not met when button is pressed
    $selectedDate = $_POST['selectDeadlineDate'];
    $selectedDeadlineID = findDeadlineID($deadlinesArray, $selectedDate);
    if (findDeadlineMet($deadlinesArray, $selectedDeadlineID) == 'false') {
        editUserDeadlineMet($selectedDeadlineID, 'true');
        $paraOutputColour = 'green';
        $paraOutput = 'Deadline is now met';
    } else {
        editUserDeadlineMet($selectedDeadlineID, 'false');
        $paraOutputColour = 'green';
        $paraOutput = 'Deadline is now not met';
    }
}

function cancelUserDeadline($array, $date)
{
    deleteDeadline(findDeadlineID($array, $date));
}


if (isset($_POST['btnCancelDeadline'])) {
    $selectedDate = $_POST['selectDeadlineDate'];
    cancelUserDeadline($deadlinesArray, $selectedDate);
    header("Refresh:0"); // refreshes the page
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>View DeadLines</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
          integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh"
          crossorigin="anonymous">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
            integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6"
            crossorigin="anonymous"></script>
</head>
<style>
    .appt-list {
        resize: none;
    }
</style>
<body>
<div class="container">
    <form method="post" action="<?php $_SERVER['PHP_SELF'] ?>">

        <div class="row mt-3 mb-3">
            <div class="col-lg-12">
                <h1 class="text-center">View DeadLines</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-4">
                <div class="form-group">
                    <textarea class="appt-list form-control" name="txtDeadlineList"
                              rows="10"><?php echo $txtDeadlineList ?></textarea>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="row">
                    <select class="custom-select" name="selectDeadlineDate">
                        <?php foreach ($deadlinesArray as $item) { ?>
                            <option name="option"><?php echo $item->getDeadlineDate() ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="row mt-3">
                    <div class="btn-group-vertical mx-auto">
                        <input class="btn btn-light" name="btnViewDeadline" value="View Deadline" type="submit">
                        <input class="btn btn-light" name="btnEditDeadline" value="Edit Deadline" type="submit">
                        <input class="btn btn-light" name="btnDeadlineMet" value="Toggle Deadline Met"
                               type="submit">
                        <input class="btn btn-success" name="btnCreateDeadlinePage" value="Create Deadline"
                               type="button"
                               onclick="location.href='createDeadlinePage.php'">
                        <input class="btn btn-danger" name="btnCancelDeadline" value="Cancel Deadline" type="submit">
                        <p style="color: <?php echo $paraOutputColour; ?>"> <?php echo $paraOutput; ?> </p>
                    </div>
                </div>

            </div>


            <div class="col-lg-4">
                <div class="form-group">
                    <textarea class="appt-list form-control" name="txtDeadlineDetails"
                              rows="10"><?php echo $txtDeadlineDetails ?></textarea>
                </div>
            </div>

        </div>

    </form>
    <div class="row">
        <div class="col-sm-12 text-center">
            <input class="btn btn-info" name="btnBack" value="Back" type="button" onclick="location.href='index.php'">
        </div>
    </div>
</div>
</body>
</html>