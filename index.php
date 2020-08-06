<?php
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Home page</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
          integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh"
          crossorigin="anonymous">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
            integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6"
            crossorigin="anonymous"></script>
</head>
<body>
<div class="container" style="text-align: center">
    <h1>Home page</h1>

    <div class="row">
        <div class="col-sm-12">
            <input name="viewAppointmentsPageBtn" value="View Appointments" type="button" onclick="location.href='viewAppointmentsPage.php'">
            <input name="viewDeadlinePageBtn" value="View Deadline" type="button" onclick="location.href='viewDeadlinesPage.php'">
        </div>
    </div>
</div>

</body>
</html>
