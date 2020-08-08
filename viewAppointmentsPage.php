<?php

include $_SERVER['DOCUMENT_ROOT'] . '/src/model/DBFunctions.php';
include $_SERVER['DOCUMENT_ROOT'] . '/src/model/appointment.php';
include $_SERVER['DOCUMENT_ROOT'] . '/src/model/deadline.php';
include $_SERVER['DOCUMENT_ROOT'] . '/src/model/user.php';

// TO DO : view date button resets the select box. this leads to the edit being messed up.


session_start();
$user = getUser();
$appointmentsArray = ($user->getAppointmentsArray());
$txtAppList = fillTextArea($appointmentsArray);
$txtAppDetails = $paraOutput = '';
$paraOutputColour = 'black';

function fillTextArea($array)
{
    $txt = '';
    for ($i = 0; $i < count($array); $i++) {
        $txt .= "You have an appointment for {$array[$i]->getNumOfPatients()} patients on : {$array[$i]->getAppointmentDate()}.\r\n";
    }
    return $txt;
}

function findAppointmentDetails($array, $date)
{
    $txt = '';
    for ($i = 0; $i < count($array); $i++) {
        if ($array[$i]->getAppointmentDate() == $date) {
            $txt = "Appointment Date    : {$array[$i]->getAppointmentDate()} \n";
            $txt .= "Number of patients  : {$array[$i]->getNumOfPatients()} \n";
            $txt .= "Appointment Details : {$array[$i]->getAppointmentDetails()} \n";
            $txt .= "Appointment Notes   : {$array[$i]->getAppointmentNotes()}";
        }
    }
    return $txt;
}

function findAppointmentID($array, $date)
{
    for ($i = 0; $i < count($array); $i++) {
        if ($array[$i]->getAppointmentDate() == $date) {
            return (int)$array[$i]->getAppointmentID();

        }
    }
}

function cancelUserAppointment($array, $date)
{
    deleteAppointment(findAppointmentID($array, $date));
}

if (isset($_POST['btnCancelAppointment'])) {
    $selectedDate = $_POST['selectAppointmentDate'];
    cancelUserAppointment($appointmentsArray, $selectedDate);
    header("Refresh:0"); // refreshes the page
}

if (isset($_POST['btnViewAppointment'])) {
    $selectedDate = $_POST['selectAppointmentDate'];
    $txtAppDetails = findAppointmentDetails($appointmentsArray, $selectedDate);
}

if (isset($_POST['btnEditAppointment'])) {
    $_SESSION['selectedAppointmentDate'] = $_POST['selectAppointmentDate'];
    header("Location: editAppointmentPage.php");
}

if (isset($_POST['btnAddNotes'])) {
    $appdate = new DateTime($_POST['selectAppointmentDate']);
    $today = new DateTime(date("Y-m-d H:i:s", time()));
    if ($appdate < $today) {
        $_SESSION['selectedAppointmentDate'] = $_POST['selectAppointmentDate'];
        header("Location: addAppointmentNotes.php");
    } else {
        $paraOutputColour = 'red';
        $paraOutput = "Can only add notes to Past Appointments.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>View Appointments</title>
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
                <h1 class="text-center">View Appointments</h1>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-4">
                <div class="form-group">
                    <textarea class="appt-list form-control" rows="10"
                              name="txtAppList"><?php echo $txtAppList ?></textarea>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="row">
                    <select class="custom-select" name="selectAppointmentDate">
                        <?php foreach ($appointmentsArray as $item) { ?>
                            <option name="option"><?php echo $item->getAppointmentDate() ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="row mt-3">
                    <div class="btn-group-vertical mx-auto">
                        <input class="btn btn-light" name="btnViewAppointment" value="View Appointment" type="submit">
                        <input class="btn btn-light" name="btnEditAppointment" value="Edit Appointment" type="submit">
                        <input class="btn btn-light" name="btnAddNotes" value="Add Notes" type="submit">
                        <input class="btn btn-light" name="creatAppointmentPageBtn" value="Create Appointment"
                               type="button"
                               onclick="location.href='createAppointmentPage.php'">
                        <input class="btn btn-light" name="btnCancelAppointment" value="Cancel Appointment"
                               type="submit">

                        <p style="color: <?php echo $paraOutputColour; ?>"> <?php echo $paraOutput; ?> </p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="form-group">
                    <textarea class="appt-list form-control" rows="10"
                              name="txtAppDetails"><?php echo $txtAppDetails ?></textarea>
                </div>
            </div>
        </div>
    </form>
    <div class="row">
        <div class="col-sm-12 text-center">
            <input name="btnBack" class="btn btn-info" value="Back" type="button" onclick="location.href='index.php'">
        </div>
    </div>
</div>
</body>
</html>
