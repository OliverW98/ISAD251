<?php

include $_SERVER['DOCUMENT_ROOT'] . '/src/model/DBFunctions.php';
include $_SERVER['DOCUMENT_ROOT'] . '/src/model/appointment.php';
include $_SERVER['DOCUMENT_ROOT'] . '/src/model/user.php';

session_start();
$user = getUser();
$appointmentsArray = ($user->getAppointmentsArray());
$selectedAppointmentDate = $_SESSION['selectedAppointmentDate'];
$selectedAppointmentID = findAppointmentID($selectedAppointmentDate,$appointmentsArray);
$numOfPatientsOutput = $detailsOutput = $paraOutput = $notesOutput = '';
$paraOutputColour= 'black';
$pastAppointment = pastAppointment($selectedAppointmentDate);

//TO DO : Date maybe?
//        Notes? (greyed out for future app)

function pastAppointment($selectedAppointmentDate){
    $appdate = new DateTime($selectedAppointmentDate);
    $today = new DateTime(date("Y-m-d H:i:s",time()));
    if ($appdate < $today){
        return true;
    }else{
        return false;
    }
}


foreach ($appointmentsArray as $app)
{
    if ($app->getAppointmentID() == $selectedAppointmentID)
    {
        $numOfPatientsOutput = (int)$app->getNumOfPatients();
        $detailsOutput = $app->getAppointmentDetails();
        $notesOutput = $app->getAppointmentNotes();
    }
}

function editUserAppointmentWithNotes($ID,$datetime, $details,$notes, $numOfPatients)
{
    editAppointment($ID,$datetime,$details,$notes, $numOfPatients);
}

function editUserAppointmentNoNotes($ID,$datetime, $details, $numOfPatients)
{
    $notes = "";
    editAppointment($ID,$datetime,$details,$notes, $numOfPatients);
}

function findAppointmentID($date,$array)
{
    for ($i = 0; $i < count($array); $i++)
    {
        if($array[$i]->getAppointmentDate() == $date)
        {
          return $array[$i]->getAppointmentID();
        }
    }
}

if (isset($_POST['btnEdit'])) {

    $tempNumOfPatients = $_POST['numOfPatientsInput'];

    if (empty($_POST['numOfPatientsInput'])){
        $paraOutputColour= 'red';
        $paraOutput = "Make sure to fill patients field.";
    }elseif ($tempNumOfPatients <= 0){
        $paraOutputColour = 'red';
        $paraOutput = 'Number of patients must be positive.';
    }else{
        if($pastAppointment == false){
            editUserAppointmentNoNotes($selectedAppointmentID,$selectedAppointmentDate,$_POST['detailsInput'], $_POST['numOfPatientsInput']);
        }else{
            editUserAppointmentWithNotes($selectedAppointmentID,$selectedAppointmentDate,$_POST['detailsInput'],$_POST['notesInput'], $_POST['numOfPatientsInput']);
            $notesOutput = $_POST['notesInput'];
        }
        $numOfPatientsOutput = $_POST['numOfPatientsInput'];
        $detailsOutput = $_POST['detailsInput'];
        $paraOutputColour= 'green';
        $paraOutput = "Appointment Edited";
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Appointments</title>
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
                <label for="numOfPatientsInput">Number of Patients : </label>
                <input name="numOfPatientsInput" type="number" value="<?php echo $numOfPatientsOutput?>" >
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-sm-12">
                <label for="detailsInput">Details : </label>
                <input name="detailsInput" type="text" value="<?php echo $detailsOutput?>" >
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-sm-12">
                <label for="notesInput">Notes : </label>
                <input name="notesInput" type="text" <?php if ($pastAppointment == false){ ?> disabled <?php   } ?> value="<?php echo $notesOutput?>" >
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-sm-12">
                <input name="btnEdit" value="EDIT" type="submit">
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12">
                <p style="color: <?php echo $paraOutputColour; ?>" > <?php echo $paraOutput; ?> </p>
            </div>
        </div>

        <br>
        <div class="row">
            <div class="col-sm-12">
                <input name="btnBack" value="Back" type="button" onclick="location.href='viewAppointmentsPage.php'">
            </div>
        </div>
    </div>

</form>
</body>
</html>
