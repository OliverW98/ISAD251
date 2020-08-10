<?php

include $_SERVER['DOCUMENT_ROOT'] . '/ISAD251/owilkes/app/src/model/DBFunctions.php';
include $_SERVER['DOCUMENT_ROOT'] . '/ISAD251/owilkes/app/src/model/appointment.php';
include $_SERVER['DOCUMENT_ROOT'] . '/ISAD251/owilkes/app/src/model/deadline.php';
include $_SERVER['DOCUMENT_ROOT'] . '/ISAD251/owilkes/app/src/model/user.php';

session_start();
$user = getUser();
$appointmentsArray = ($user->getAppointmentsArray());
$selectedAppointmentDate = $_SESSION['selectedAppointmentDate'];
$selectedAppointmentID = findAppointmentID($selectedAppointmentDate, $appointmentsArray);
$numOfPatientsOutput = $detailsOutput = $paraOutput = $notesOutput = '';
$paraOutputColour = 'black';
$pastAppointment = pastAppointment($selectedAppointmentDate);

//TO DO : Date maybe?

function pastAppointment($selectedAppointmentDate)
{
    $appdate = new DateTime($selectedAppointmentDate);
    $today = new DateTime(date("Y-m-d H:i:s", time()));
    if ($appdate < $today) {
        return true;
    } else {
        return false;
    }
}

foreach ($appointmentsArray as $app) {
    if ($app->getAppointmentID() == $selectedAppointmentID) {
        $numOfPatientsOutput = (int)$app->getNumOfPatients();
        $detailsOutput = $app->getAppointmentDetails();
        $notesOutput = $app->getAppointmentNotes();
    }
}

function editUserAppointmentWithNotes($ID, $datetime, $details, $notes, $numOfPatients)
{
    editAppointment($ID, $datetime, $details, $notes, $numOfPatients);
}

function editUserAppointmentNoNotes($ID, $datetime, $details, $numOfPatients)
{
    $notes = "";
    editAppointment($ID, $datetime, $details, $notes, $numOfPatients);
}

function findAppointmentID($date, $array)
{
    for ($i = 0; $i < count($array); $i++) {
        if ($array[$i]->getAppointmentDate() == $date) {
            return $array[$i]->getAppointmentID();
        }
    }
}

if (isset($_POST['btnEdit'])) {

    $tempNumOfPatients = $_POST['numOfPatientsInput'];

    if (empty($_POST['numOfPatientsInput'])) {
        $paraOutputColour = 'red';
        $paraOutput = "Make sure to fill patients field.";
    } elseif ($tempNumOfPatients <= 0) {
        $paraOutputColour = 'red';
        $paraOutput = 'Number of patients must be positive.';
    } else {
        if ($pastAppointment == false) {
            editUserAppointmentNoNotes($selectedAppointmentID, $selectedAppointmentDate, $_POST['detailsInput'], $_POST['numOfPatientsInput']);
        } else {
            editUserAppointmentWithNotes($selectedAppointmentID, $selectedAppointmentDate, $_POST['detailsInput'], $_POST['notesInput'], $_POST['numOfPatientsInput']);
            $notesOutput = $_POST['notesInput'];
        }
        $numOfPatientsOutput = $_POST['numOfPatientsInput'];
        $detailsOutput = $_POST['detailsInput'];
        $paraOutputColour = 'green';
        $paraOutput = "Appointment Edited";
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Appointments</title>
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
                <h1>Edit Appointment</h1>
            </div>
        </div>

        <br>
        <div class="row">
            <div class="col-sm-12">
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <label class="input-group-text" for="numOfPatientsInput">Number of Patients : </label>
                    </div>
                    <input class="form-control" name="numOfPatientsInput" type="number"
                           value="<?php echo $numOfPatientsOutput ?>">
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
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <label class="input-group-text" for="notesInput">Notes : </label>
                    </div>
                    <input class="form-control" name="notesInput"
                           type="text" <?php if ($pastAppointment == false) { ?> disabled <?php } ?>
                           value="<?php echo $notesOutput ?>">
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
                       onclick="location.href='viewAppointmentsPage.php'">
            </div>
        </div>
    </div>

</form>
</body>
</html>
