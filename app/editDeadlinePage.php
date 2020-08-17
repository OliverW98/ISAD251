<?php

include $_SERVER['DOCUMENT_ROOT'] . '/ISAD251/owilkes/app/src/model/DBFunctions.php';
include $_SERVER['DOCUMENT_ROOT'] . '/ISAD251/owilkes/app/src/model/appointment.php';
include $_SERVER['DOCUMENT_ROOT'] . '/ISAD251/owilkes/app/src/model/deadline.php';
include $_SERVER['DOCUMENT_ROOT'] . '/ISAD251/owilkes/app/src/model/user.php';

session_start();
$user = getUser();
$deadlinesArray = ($user->getDeadlineArray());
$selectedDeadlineDate = $_SESSION['selectedDeadlineDate'];
$selectedDeadlineID = findDeadlineID($selectedDeadlineDate, $deadlinesArray);
$datetimeOutput = $detailsOutput = $paraOutput = $deadlineMet = '';
$paraOutputColour = 'black';

foreach ($deadlinesArray as $deadline) { //fills input with deadline data
    if ($deadline->getDeadlineID() == $selectedDeadlineID) {
        $datetime = new DateTime($deadline->getDeadlineDate());
        $datetimeOutput = "{$datetime->format('Y-m-d')}T{$datetime->format('H:i')}";
        $detailsOutput = $deadline->getDeadlineDetails();
        $deadlineMet = $deadline->getDeadlineMet();
    }
}

function editUserDeadline($deadlineID, $deadlineDate, $deadlineDetails, $deadlineMet)
{
    editDeadline($deadlineID, $deadlineDate, $deadlineDetails, $deadlineMet);
}

function findDeadlineID($date, $array) //find the selected deadlineID using the date selected
{
    for ($i = 0; $i < count($array); $i++) {
        if ($array[$i]->getDeadlineDate() == $date) {
            return $array[$i]->getDeadlineID();
        }
    }
}

if (isset($_POST['btnEdit'])) {

    if (empty($_POST['detailsInput']) || empty($_POST['datetimeInput'])) {
        $paraOutputColour = 'red';
        $paraOutput = "Make sure to fill patients field.";
    } else {
        editUserDeadline($selectedDeadlineID, $_POST['datetimeInput'], $_POST['detailsInput'], $deadlineMet);
        $detailsOutput = $_POST['detailsInput'];
        $datetimeOutput = $_POST['datetimeInput'];
        $paraOutputColour = 'green';
        $paraOutput = "Appointment Edited";
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Deadline</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
          integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh"
          crossorigin="anonymous">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
            integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6"
            crossorigin="anonymous"></script>
</head>
<body>

<form action="<?php $_SERVER['PHP_SELF'] ?>" method="post">

    <div class="container" style="text-align: center">
        <div class="row">
            <div class="col-sm-12">
                <h1>Edit Deadline</h1>
            </div>
        </div>

        <br>
        <div class="row">
            <div class="col-sm-12">
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <label class="input-group-text" for="dateInput">Date : </label>
                    </div>
                    <input class="form-control" name="datetimeInput" type="datetime-local"
                           value="<?php echo $datetimeOutput ?>">
                </div>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-sm-12">
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <label class="input-group-text" for="detailsInput">Details : </label>
                    </div>
                    <input class="form-control" name="detailsInput" type="text" value="<?php echo $detailsOutput ?>">
                </div>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-sm-12">
                <input class="btn btn-warning" name="btnEdit" value="EDIT" type="submit">
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12">
                <p style="color: <?php echo $paraOutputColour; ?>"> <?php echo $paraOutput; ?> </p>
            </div>
        </div>

        <br>
        <div class="row">
            <div class="col-sm-12">
                <input class="btn btn-info" name="btnBack" value="Back" type="button"
                       onclick="location.href='viewDeadlinesPage.php'">
            </div>
        </div>
    </div>

</form>
</body>
</html>

