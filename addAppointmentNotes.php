<?php
include $_SERVER['DOCUMENT_ROOT'] . '/src/model/DBFunctions.php';
include $_SERVER['DOCUMENT_ROOT'] . '/src/model/appointment.php';
include $_SERVER['DOCUMENT_ROOT'] . '/src/model/user.php';

session_start();
$user = getUser();
$appointmentsArray = ($user->getAppointmentsArray());
$selectedAppointmentDate = $_SESSION['selectedAppointmentDate'];
$selectedAppointmentID = findAppointmentID($selectedAppointmentDate,$appointmentsArray);
$paraOutput = $hasNotes = '';
$paraOutputColour= 'black';

function addUserNotes($ID,$notes)
{
    addAppointmentNotes($ID,$notes);
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

foreach ($appointmentsArray as $app){
    if($app->getAppointmentID() == $selectedAppointmentID && $app->getAppointmentNotes() != ''){
        $hasNotes = true;
        $paraOutputColour= 'red';
        $paraOutput = "Appointment already has notes. Please go to the Edit page.";
    }
}

if (isset($_POST['btnAdd'])) {

    if (empty($_POST['NotesInput'])){
        $paraOutputColour= 'red';
        $paraOutput = "Make sure not to leave the field blank.";
    } else{
        addUserNotes($selectedAppointmentID,$_POST['NotesInput']);
        $paraOutputColour= 'green';
        $paraOutput = "Notes Added to Appointment.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Notes</title>
</head>
<body>

<form action="<?php $_SERVER['PHP_SELF'] ?>" method="post">

    <div class="container" style="text-align: center">
        <div class="row">
            <div class="col-sm-12">
                <h1>Add Notes</h1>
            </div>
        </div>

        <br>
        <div class="row">
            <div class="col-sm-12">
                <label for="NotesInput">Notes : </label>
                <input name="NotesInput"<?php if ($hasNotes == true){ ?> disabled <?php   } ?>  type="text">
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-sm-12">
                <input name="btnAdd" <?php if ($hasNotes == true){ ?> disabled <?php   } ?> value="Add" type="submit">
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
