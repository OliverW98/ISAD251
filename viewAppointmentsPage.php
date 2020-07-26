<?php

include $_SERVER['DOCUMENT_ROOT'] . '/src/model/DBFunctions.php';
include $_SERVER['DOCUMENT_ROOT'] . '/src/model/appointment.php';
include $_SERVER['DOCUMENT_ROOT'] . '/src/model/user.php';

session_start();
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

function findAppointment($array,$date){
    $txt = '';
    for ($i = 0; $i < count($array); $i++)
    {
        if($array[$i]->getAppointmentDate() == $date)
        {
            $txt = "Appointment Date    : {$array[$i]->getAppointmentDate()} \n";
            $txt .= "Number of patients  : {$array[$i]->getNumOfPatients()} \n";
            $txt .= "Appointment Details : {$array[$i]->getAppointmentDetails()} \n";
            $txt .= "Appointment Notes   : {$array[$i]->getAppointmentNotes()}";
        }
    }
    return $txt;
}

if (isset($_POST['btnEditAppointment'])){
    $_SESSION['selectedAppointmentDate'] = $_POST['selectAppointmentDate'];
    header("Location: editAppointmentPage.php");

}

if (isset($_POST['btnViewAppointment'])){

    $selectedDate = $_POST['selectAppointmentDate'];

    $txtAppDetails = findAppointment($appointmentsArray,$selectedDate);
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
            <textarea name="txtAppList"  rows="10" cols="75"><?php echo $txtAppDetails?></textarea>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <input name="btnViewAppointment" value="View Appointment" type="submit">
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <input name="btnEditAppointment" value="Edit Appointment" type="submit">
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
