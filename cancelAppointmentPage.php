<?php

include $_SERVER['DOCUMENT_ROOT'] . '/src/model/DBFunctions.php';
include $_SERVER['DOCUMENT_ROOT'] . '/src/model/appointment.php';
include $_SERVER['DOCUMENT_ROOT'] . '/src/model/deadline.php';
include $_SERVER['DOCUMENT_ROOT'] . '/src/model/user.php';

$user = getUser();
$appointmentsArray = $user->getAppointmentsArray();
$paraOutput = '';
$paraOutputColour= 'black';

function findAppointment($array,$date)
{
    for ($i = 0; $i < count($array); $i++)
    {
        if($array[$i]->getAppointmentDate() == $date)
        {
            return (int)$array[$i]->getAppointmentID();

        }
    }
}

function cancelUserAppointment($array , $date)
{
    deleteAppointment(findAppointment($array,$date));
}

if(isset($_POST['btnCancelAppointment']))
{
    $selectedDate = $_POST['selectAppointmentDate'];
    cancelUserAppointment($appointmentsArray,$selectedDate);
    header("Refresh:0"); // refreshes the page
    $paraOutput = 'Appointment Canceled';
    $paraOutputColour= 'green';
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Cancel Appointments</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
          integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh"
          crossorigin="anonymous">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
            integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6"
            crossorigin="anonymous"></script>
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
