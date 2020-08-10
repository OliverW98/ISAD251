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
$paraOutput = $hasNotes = '';
$paraOutputColour = 'black';

function addUserNotes($ID, $notes)
{
    addAppointmentNotes($ID, $notes);
}

function findAppointmentID($date, $array)
{
    for ($i = 0; $i < count($array); $i++) {
        if ($array[$i]->getAppointmentDate() == $date) {
            return $array[$i]->getAppointmentID();
        }
    }
}

foreach ($appointmentsArray as $app) {
    if ($app->getAppointmentID() == $selectedAppointmentID && $app->getAppointmentNotes() != '') {
        $hasNotes = true;
        $paraOutputColour = 'red';
        $paraOutput = "Appointment already has notes. Please go to the Edit page.";
    }
}

if (isset($_POST['btnAdd'])) {

    if (empty($_POST['NotesInput'])) {
        $paraOutputColour = 'red';
        $paraOutput = "Make sure not to leave the field blank.";
    } else {
        addUserNotes($selectedAppointmentID, $_POST['NotesInput']);
        $paraOutputColour = 'green';
        $paraOutput = "Notes Added to Appointment.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Notes</title>
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
                <h1>Add Notes</h1>
            </div>
        </div>

        <br>
        <div class="row">
            <div class="col-sm-12">
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <label class="input-group-text" for="NotesInput">Notes : </label>
                    </div>
                    <input class="form-control" name="NotesInput"<?php if ($hasNotes == true) { ?> disabled <?php } ?>
                           type="text">
                </div>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-sm-12">
                <input class="btn btn-success" name="btnAdd" <?php if ($hasNotes == true) { ?> disabled <?php } ?>
                       value="Add" type="submit">
            </div>
        </div>
        <br>
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
