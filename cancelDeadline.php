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
    header("Refresh:0"); // refreshes the page
    $paraOutput = 'Deadline Canceled';
    $paraOutputColour= 'green';
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Cancel Deadline</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
          integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh"
          crossorigin="anonymous">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
            integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6"
            crossorigin="anonymous"></script>
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
