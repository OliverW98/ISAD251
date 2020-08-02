<?php

include $_SERVER['DOCUMENT_ROOT'] . '/src/model/DBFunctions.php';
include $_SERVER['DOCUMENT_ROOT'] . '/src/model/appointment.php';
include $_SERVER['DOCUMENT_ROOT'] . '/src/model/deadline.php';
include $_SERVER['DOCUMENT_ROOT'] . '/src/model/user.php';

$user = getUser();
$deadlineArray = $user->getDeadlineArray();
$paraOutput = '';
$paraOutputColour= 'black';

function findDeadline($array,$date)
{
    for ($i = 0; $i < count($array); $i++)
    {
        if($array[$i]->getDeadlineDate() == $date)
        {
            return (int)$array[$i]->getDeadlineID();

        }
    }
}

function cancelUserDeadline($array , $date)
{
    deleteDeadline(findDeadline($array,$date)); // SQL needed
}


if(isset($_POST['btnCancelDeadline']))
{
    $selectedDate = $_POST['selectDeadlineDate'];
    cancelUserDeadline($deadlineArray,$selectedDate); // SQL needed
    $paraOutput = 'Deadline Canceled';
    $paraOutputColour= 'green';
    header("Refresh:0"); // refreshes the page
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Cancel Deadline</title>
</head>

<body>
<h1>Cancel Deadline</h1>
<form method="post" action="<?php $_SERVER['PHP_SELF'] ?>">
    <div class="row">
        <div class="col-sm-12">
            <select name="selectDeadlineDate">
                <?php foreach ($deadlineArray as $item){ ?>
                    <option name="option"><?php echo $item->getDeadlineDate()?></option>
                <?php } ?>
            </select>
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-sm-12">
            <input name="btnCancelDeadline" value="Cancel Deadline" type="submit">
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
