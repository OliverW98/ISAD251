<?php

include $_SERVER['DOCUMENT_ROOT'] . '/src/model/DBFunctions.php';

$paraOutput = '';
$paraOutputColour= 'black';

function RecordUserAppointment($datetime, $details, $numOfPatients)
{
    $UserID = 1;
    $notes = '';
    recordAppointment($UserID,$datetime,$details,$notes, $numOfPatients);
}


if (isset($_POST['inputButton'])) {

    RecordUserAppointment($_POST['datetimeInput'],$_POST['detailsInput'], $_POST['numOfPatientsInput']);
    $paraOutputColour= 'green';
    $paraOutput = "Appointment created";
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Appointments</title>
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

    <div class="row">
        <div class="col-sm-12">
            <label for="numOfPatientsInput">Number of Patients : </label>
            <input name="numOfPatientsInput" type="number">
        </div>
    </div>


    <div class="row">
        <div class="col-sm-12">
            <label for="detailsInput">Details : </label>
            <input name="detailsInput" placeholder="..." type="text">
        </div>
    </div>


    <div class="row">
        <div class="col-sm-12">
            <input name="inputButton" value="ENTER" type="submit">
        </div>
    </div>

    <div class="row">
        <div class="col-sm-12">
            <p style="color: <?php echo $paraOutputColour; ?>" > <?php echo $paraOutput; ?> </p>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-12">
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-sm-12">
            <input name="backButton" value="Back" type="button" onclick="location.href='index.php'">
        </div>
    </div>
</div>

</form>
</body>
</html>
