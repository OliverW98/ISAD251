<?php

include $_SERVER['DOCUMENT_ROOT'] . '/src/model/DBFunctions.php';
include $_SERVER['DOCUMENT_ROOT'] . '/src/model/appointment.php';
include $_SERVER['DOCUMENT_ROOT'] . '/src/model/deadline.php';
include $_SERVER['DOCUMENT_ROOT'] . '/src/model/user.php';

$paraOutput = '';
$paraOutputColour= 'black';

function RecordUserDeadline($datetime, $details)
{
    $UserID = 1;
    $met = 'false';
    recordDeadline($UserID,$datetime,$details,$met);
}

if (isset($_POST['btnInput'])) {

    if (empty($_POST['datetimeInput']) || empty($_POST['detailsInput'])){
        $paraOutputColour= 'red';
        $paraOutput = "Make sure to fill all fields.";
    }else{
        RecordUserDeadline($_POST['datetimeInput'],$_POST['detailsInput']);
        $paraOutputColour= 'green';
        $paraOutput = "Deadline created";
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Create Deadline</title>
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
                <label for="detailsInput">Details : </label>
                <input name="detailsInput" placeholder="..." type="text">
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-sm-12">
                <input name="btnInput" value="Create" type="submit">
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