<?php

include $_SERVER['DOCUMENT_ROOT'] . '/src/model/DBFunctions.php';
include $_SERVER['DOCUMENT_ROOT'] . '/src/model/appointment.php';
include $_SERVER['DOCUMENT_ROOT'] . '/src/model/deadline.php';
include $_SERVER['DOCUMENT_ROOT'] . '/src/model/user.php';

// TO DO : view date button resets the select box. this leads to the edit being messed up.

session_start();
$user = getUser();
$deadlinesArray = ($user->getDeadlineArray());
$txtDeadlineList = fillTextArea($deadlinesArray);
$txtDeadlineDetails = $paraOutput = $selectedDeadlineID = '';
$paraOutputColour= 'black';

function fillTextArea($array){
    $txt ='';
    for ($i = 0; $i < count($array); $i++)
    {
        $txt .= "You have an deadline on : {$array[$i]->getDeadlineDate()}.\r\n";
    }
    return $txt;
}

function findDeadlineID($array,$date)
{
    for ($i = 0; $i < count($array); $i++)
    {
        if($array[$i]->getDeadlineDate() == $date)
        {
            return $array[$i]->getDeadlineID();
        }
    }
}

function findDeadlineDetails($array,$ID){
    $txt = '';
    for ($i = 0; $i < count($array); $i++)
    {
        if($array[$i]->getDeadlineID() == $ID)
        {
            $txt = "Deadline Date    : {$array[$i]->getDeadlineDate()} \n";
            $txt .= "Deadline Details : {$array[$i]->getDeadlineDetails()} \n";
            $txt .= "Deadline Met     : {$array[$i]->getDeadlineMet()}";
        }
    }
    return $txt;
}

function findDeadlineMet($array,$ID){
    for ($i = 0; $i < count($array); $i++)
    {
        if($array[$i]->getDeadlineID() == $ID)
        {
            return $array[$i]->getDeadlineMet();
        }
    }
}

function editUserDeadlineMet($ID , $met)
{
    editDeadlineMet($ID, $met);
}

if (isset($_POST['btnViewDeadline'])){

    $selectedDate = $_POST['selectDeadlineDate'];
    $selectedDeadlineID = findDeadlineID($deadlinesArray,$selectedDate);
    $txtDeadlineDetails = findDeadlineDetails($deadlinesArray,$selectedDeadlineID);
}

if (isset($_POST['btnEditDeadline'])){
    $_SESSION['selectedDeadlineDate'] = $_POST['selectDeadlineDate'];
    header("Location: editDeadlinePage.php");
}

if(isset($_POST['btnDeadlineMet'])){

    $selectedDate = $_POST['selectDeadlineDate'];
    $selectedDeadlineID = findDeadlineID($deadlinesArray,$selectedDate);
    if (findDeadlineMet($deadlinesArray,$selectedDeadlineID) == 'false'){
        editUserDeadlineMet($selectedDeadlineID, 'true');
        $paraOutputColour= 'green';
        $paraOutput= 'Deadline is now met';
    }else{
        editUserDeadlineMet($selectedDeadlineID, 'false');
        $paraOutputColour= 'green';
        $paraOutput= 'Deadline is now not met';
    }
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
        <input name="btnEditDeadline" value="Edit Deadline" type="submit">
        <input name="btnDeadlineMet" value="Toggle Deadline Met" type="submit">
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