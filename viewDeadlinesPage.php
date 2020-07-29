<?php

include $_SERVER['DOCUMENT_ROOT'] . '/src/model/DBFunctions.php';
include $_SERVER['DOCUMENT_ROOT'] . '/src/model/appointment.php';
include $_SERVER['DOCUMENT_ROOT'] . '/src/model/deadline.php';
include $_SERVER['DOCUMENT_ROOT'] . '/src/model/user.php';

// TO DO : view date button resets the select box. this leads to the edit being messed up.

$user = getUser();
$deadlinesArray = ($user->getDeadlineArray());
$txtDeadlineList = fillTextArea($deadlinesArray);
$txtDeadlineDetails = $paraOutput ='';
$paraOutputColour= 'black';

function fillTextArea($array){
    $txt ='';
    for ($i = 0; $i < count($array); $i++)
    {
        $txt .= "You have an deadline on : {$array[$i]->getDeadlineDate()}.\r\n";
    }
    return $txt;
}

function findDeadline($array,$date){
    $txt = '';
    for ($i = 0; $i < count($array); $i++)
    {
        if($array[$i]->getDeadlineDate() == $date)
        {
            $txt = "Deadline Date    : {$array[$i]->getDeadlineDate()} \n";
            $txt .= "Deadline Details : {$array[$i]->getDeadlineDetails()} \n";
            $txt .= "Deadline Met     : {$array[$i]->getDeadlineMet()}";
        }
    }
    return $txt;
}

if (isset($_POST['btnViewDeadline'])){

    $selectedDate = $_POST['selectDeadlineDate'];
    $txtDeadlineDetails = findDeadline($deadlinesArray,$selectedDate);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>View DeadLines</title>
</head>
<style>
    textarea{
        resize: none;
    }
</style>
<body>
<h1>View DeadLines</h1>
<form method="post" action="<?php $_SERVER['PHP_SELF'] ?>">
    <div class="row">
        <div class="col-sm-12">
            <textarea name="txtDeadlineList" rows="10" cols="75"><?php echo $txtDeadlineList?></textarea>
            <select name="selectDeadlineDate">
            <?php foreach ($deadlinesArray as $item){ ?>
              <option name="option"><?php echo $item->getDeadlineDate()?></option>
             <?php } ?>
            </select>
            <textarea name="txtDeadlineDetails" rows="10" cols="75"><?php echo $txtDeadlineDetails?></textarea>
        </div>
    </div>
<div class="row">
    <div class="col-sm-12">
        <input name="btnViewDeadline" value="View Deadline" type="submit">
    </div>
</div>
<div class="row">
    <div class="col-sm-12">
        <p style="color: <?php echo $paraOutputColour; ?>" > <?php echo $paraOutput; ?> </p>
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