<?php

include $_SERVER['DOCUMENT_ROOT'] . '/src/model/DBFunctions.php';
include $_SERVER['DOCUMENT_ROOT'] . '/src/model/appointment.php';
include $_SERVER['DOCUMENT_ROOT'] . '/src/model/user.php';

$paraOutput = '';
$paraOutputColour= 'black';

function editUserAppointment($datetime, $details, $numOfPatients)
{

    editAppointment($appointmentID,$datetime,$details, $numOfPatients);
}


if (isset($_POST['btnEdit'])) {

    $tempNumOfPatients = $_POST['numOfPatientsInput'];

    if (empty($_POST['datetimeInput']) || empty($_POST['detailsInput']) || empty($_POST['numOfPatientsInput'])){
        $paraOutputColour= 'red';
        $paraOutput = "Make sure to fill all fields.";
    }elseif ($tempNumOfPatients <= 0){
        $paraOutputColour = 'red';
        $paraOutput = 'Number of patients must be positive.';
    }else{
        editUserAppointment($_POST['datetimeInput'],$_POST['detailsInput'], $_POST['numOfPatientsInput']);
        $paraOutputColour= 'green';
        $paraOutput = "Appointment Edited";
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Create Appointments</title>
</head>
<body>

<form action="<?php $_SERVER['PHP_SELF'] ?>" method="post">

    <div class="container" style="text-align: center">
        <div class="row">
            <div class="col-sm-12">
                <h1>Create Appointment</h1>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12">
                <label for="datetimeInput">Date And Time : </label>
                <input type="datetime-local" name="datetimeInput">
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-sm-12">
                <label for="numOfPatientsInput">Number of Patients : </label>
                <input name="numOfPatientsInput" type="number">
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-sm-12">
                <label for="detailsInput">Details : </label>
                <input name="detailsInput" type="text">
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
                <input name="btnBack" value="Back" type="button" onclick="location.href='index.php'">
            </div>
        </div>
    </div>

</form>
</body>
</html>
