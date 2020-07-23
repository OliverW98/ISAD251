<?php

include $_SERVER['DOCUMENT_ROOT'] . '/src/model/DBFunctions.php';
include $_SERVER['DOCUMENT_ROOT'] . '/src/model/appointment.php';
include $_SERVER['DOCUMENT_ROOT'] . '/src/model/user.php';

$user = getUser();
$appointmentsArray = ($user->getAppointmentsArray());
$paraOutput = '';
$paraOutputColour= 'black';

function findAppointment($array,$date){
    for ($i = 0; $i < count($array); $i++)
    {
        if($array[$i]->getAppointmentDate() == $date)
        {
            return (int)$array[$i]->getAppointmentID();
        }
    }
}

if(isset($_POST['btnCancelAppointment']))
{
    $selectedDate = $_POST['selectAppointmentDate'];
    var_dump($selectedDate);
    var_dump(findAppointment($appointmentsArray,$selectedDate));
    deleteAppointment(findAppointment($appointmentsArray,$selectedDate));
    $paraOutput = 'Appointment Canceled';
    $paraOutputColour= 'green';

}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Cancel Appointments</title>
</head>

<body>
<h1>Cancel Appointments</h1>
<form method="post" action="<?php $_SERVER['PHP_SELF'] ?>">
    <div class="row">
        <div class="col-sm-12">
            <select name="selectAppointmentDate">
                <?php foreach ($appointmentsArray as $item){ ?>
                    <option name="option"><?php echo $item->getAppointmentDate()?></option>
                <?php } ?>
            </select>
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-sm-12">
            <input name="btnCancelAppointment" value="Cancel Appointment" type="submit">
        </div>
    </div>
</form>

<div class="row">
    <div class="col-sm-12">
        <p style="color: <?php echo $paraOutputColour; ?>" > <?php echo $paraOutput; ?> </p>
    </div>
</div>

<div class="row">
    <div class="col-sm-12">
        <input name="btnBack" value="Back" type="button" onclick="location.href='index.php'">
    </div>
</div>

</body>
</html>
