<?php

const DB_SERVER = "proj-mysql.uopnet.plymouth.ac.uk";
const DB_USER = "ISAD251_OWilkes";
const DB_PASSWORD = 'ISAD251_22201425';
const DB_DATABASE = "ISAD251_Owilkes";

function getConnection()
{
    $dataSourceName = 'mysql:dbname=' . DB_DATABASE . ';host=' . DB_SERVER;
    $dbConnection = null;
    try {
        $dbConnection = new PDO($dataSourceName, DB_USER, DB_PASSWORD);

    } catch (PDOException $err) {
        echo 'Connection failed: ', $err->getMessage();
    }
    return $dbConnection;
}

function getUser()
{
    $userID = 1; // only 1 user

    $appointmentData = getAppointments($userID); // fetches all the appointments for the user
    $deadlineData = getDeadlines($userID);

    $user = createUserObject($userID, $appointmentData, $deadlineData); // creates a user object

    return $user;
}

function createUserObject($userID, $appointmentData, $deadlineData)
{
    $appointmentsArray = array();
    $deadlinesArray = array();

    for ($i = 0; $i < count($appointmentData); $i++) {
        $appointmentID = $appointmentData[$i]['appointmentID'];
        $userID = $appointmentData[$i]['userID'];
        $appointmentDate = $appointmentData[$i]['appointmentDate'];
        $appointmentDetails = $appointmentData[$i]['appointmentDetails'];
        $appointmentNotes = $appointmentData[$i]['appointmentNotes'];
        $numOfPatients = $appointmentData[$i]['numOfPatients'];

        $appointment = new appointment($appointmentID, $userID, $appointmentDate, $appointmentDetails, $appointmentNotes, $numOfPatients);

        array_push($appointmentsArray, $appointment);
    }

    for ($i = 0; $i < count($deadlineData); $i++) {
        $deadlineID = $deadlineData[$i]['deadlineID'];
        $deadlineUserID = $deadlineData[$i]['deadlineUserID'];
        $deadlineDate = $deadlineData[$i]['deadlineDate'];
        $deadlineDetails = $deadlineData[$i]['deadlineDetails'];
        $deadlineMet = $deadlineData[$i]['deadlineMet'];

        $deadline = new deadline($deadlineID, $deadlineUserID, $deadlineDate, $deadlineDetails, $deadlineMet);

        array_push($deadlinesArray, $deadline);
    }

    return $user = new user($userID, $appointmentsArray, $deadlinesArray);
}


function getAppointments($userID)
{
    $statement = getConnection()->prepare("CALL getAppointments ('" . $userID . "')");
    $statement->execute();
    $data = $statement->fetchAll(PDO::FETCH_ASSOC);

    return $data;
}

function recordAppointment($userID, $appointmentDate, $appointmentDetails, $appointmentNotes, $numOfPatients)
{
    $statement = getConnection()->prepare("CALL recordAppointment ('" . $userID . "','" . $appointmentDate . "','" . $appointmentDetails . "','" . $appointmentNotes . "','" . $numOfPatients . "')");
    $statement->execute();
}

function deleteAppointment($appointmentID)
{
    $statement = getConnection()->prepare("CALL deleteAppointment ('" . $appointmentID . "')");
    $statement->execute();
}

function editAppointment($appointmentID, $appointmentDate, $appointmentDetails, $appointmentNotes, $numOfPatients)
{
    $statement = getConnection()->prepare("CALL editAppointment ('" . $appointmentID . "','" . $appointmentDate . "','" . $appointmentDetails . "','" . $appointmentNotes . "','" . $numOfPatients . "')");
    $statement->execute();
}

function addAppointmentNotes($appointmentID, $appointmentNotes)
{
    $statement = getConnection()->prepare("CALL addAppointmentNotes ('" . $appointmentID . "','" . $appointmentNotes . "')");
    $statement->execute();
}

function getDeadlines($userID)
{
    $statement = getConnection()->prepare("CALL getDeadlines ('" . $userID . "')");
    $statement->execute();
    $data = $statement->fetchAll(PDO::FETCH_ASSOC);

    return $data;
}

function recordDeadline($userID, $deadlineDate, $deadlineDetails, $deadlineMet)
{
    $statement = getConnection()->prepare("CALL recordDeadline ('" . $userID . "','" . $deadlineDate . "','" . $deadlineDetails . "','" . $deadlineMet . "')");
    $statement->execute();
}

function deleteDeadline($deadlineID)
{
    $statement = getConnection()->prepare("CALL deleteDeadline ('" . $deadlineID . "')");
    $statement->execute();
}

function editDeadline($deadlineID, $deadlineDate, $deadlineDetails, $deadlineMet)
{
    $statement = getConnection()->prepare("CALL editDeadline ('" . $deadlineID . "','" . $deadlineDate . "','" . $deadlineDetails . "','" . $deadlineMet . "')");
    $statement->execute();
}

function editDeadlineMet($deadlineID, $deadlineMet)
{
    $statement = getConnection()->prepare("CALL editDeadlineMet ('" . $deadlineID . "','" . $deadlineMet . "')");
    $statement->execute();
}
