<?php

include $_SERVER['DOCUMENT_ROOT'] . '/src/model/DBFunctions.php';
include $_SERVER['DOCUMENT_ROOT'] . '/src/model/appointment.php';
include $_SERVER['DOCUMENT_ROOT'] . '/src/model/user.php';

$user = getUser();
$appointmentsArray = ($user->getAppointmentsArray());
$txtAreaOutput ='';

var_dump($appointmentsArray);

for ($i = 0; $i < count($appointmentsArray); $i++)
{

    $txtAreaOutput =  $appointmentsArray[$i]->getAppointmentDate();
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>View Appointments</title>
</head>

<body>
<h1>View Appointments</h1>

<div class="row">
    <div class="col-sm-12">
        <textarea name="txtAppList"  rows="10" cols="75"><?php echo $txtAreaOutput?></textarea>
    </div>
</div>

<div class="row">
    <div class="col-sm-12">
        <input name="backButton" value="Back" type="button" onclick="location.href='index.php'">
    </div>
</div>

</body>
</html>
