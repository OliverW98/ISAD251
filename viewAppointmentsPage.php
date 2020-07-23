<?php

include $_SERVER['DOCUMENT_ROOT'] . '/src/model/DBFunctions.php';
include $_SERVER['DOCUMENT_ROOT'] . '/src/model/appointment.php';
include $_SERVER['DOCUMENT_ROOT'] . '/src/model/user.php';

$user = getUser();
$appointmentsArray = ($user->getAppointmentsArray());
$txtAppList = fillTextArea($appointmentsArray);
$txtAppDetails ='';

function fillTextArea($array){
    $txt ='';
    for ($i = 0; $i < count($array); $i++)
    {
        $txt .= "You have an appointment for {$array[$i]->getNumOfPatients()} patients on : {$array[$i]->getAppointmentDate()}.\r\n";
    }
    return $txt;
}

function findAppointment(){
    // use the date to find the appointment
}

if (isset($_POST['btnViewAppointment'])){

    $selectedDate = $_POST['selectAppointmentDate'];
    var_dump($selectedDate);
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>View Appointments</title>
</head>
<style>
    textarea{
        resize: none;
    }
</style>
<body>
<h1>View Appointments</h1>
<form method="post" action="<?php $_SERVER['PHP_SELF'] ?>">
    <div class="row">
        <div class="col-sm-12">
            <textarea name="txtAppList"  rows="10" cols="75"><?php echo $txtAppList?></textarea>
            <select name="selectAppointmentDate">
                <?php foreach ($appointmentsArray as $item){ ?>
                    <option name="option"><?php echo $item->getAppointmentDate()?></option>
                <?php } ?>
            </select>
            <textarea name="txtAppList"  rows="10" cols="75"></textarea>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <input name="btnViewAppointment" value="View Appointment" type="submit">
        </div>
    </div>
</form>

<div class="row">
    <div class="col-sm-12">
        <input name="btnBack" value="Back" type="button" onclick="location.href='index.php'">
    </div>
</div>

</body>
</html>
