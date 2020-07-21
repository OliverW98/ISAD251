<?php

const DB_SERVER = "proj-mysql.uopnet.plymouth.ac.uk";
const DB_USER = "ISAD251_OWilkes";
const DB_PASSWORD = 'ISAD251_22201425';
const DB_DATABASE = "ISAD251_Owilkes";


function getConnection()
{
    $dataSourceName = 'mysql:host='.DB_SERVER.';dbname='.DB_DATABASE;
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

    $user = createUserObject($userID, $appointmentData); // creates a user object

    return $user;

}

function createUserObject($userID, $appointmentData)
{

    $appointmentsArray = array();

    for ($i =0 ; $i< count($appointmentData); $i++)
    {
        $appointmentID = $appointmentData[$i]['appointmentID'];
        $userID = $appointmentData[$i]['userID'];
        $appointmentDate = $appointmentData[$i]['appointmentDate'];
        $appointmentDetails = $appointmentData[$i]['appointmentDetails'];
        $appointmentNotes = $appointmentData[$i]['appointmentNotes'];
        $numOfPatients = $appointmentData[$i]['numOfPatients'];

        $appointment = new appointment($appointmentID,$userID,$appointmentDate,$appointmentDetails,$appointmentNotes,$numOfPatients);

        array_push($appointmentsArray, $appointment);
    }

    return $user = new user($userID, $appointmentData);
}


function getAppointments($userID){
    $statement = getConnection()->prepare("CALL getAppointments ('".$userID."')");
    $statement->execute();
    $data = $statement->fetchAll(PDO::FETCH_ASSOC);

    return $data;
}

function recordAppointment($userID, $appointmentDate, $appointmentDetails, $appointmentNotes, $numOfPatients)
{
    $statement = getConnection()->prepare("CALL recordAppointment ('".$userID."','".$appointmentDate."','".$appointmentDetails."','".$appointmentNotes."','".$numOfPatients."')");
    $statement->execute();
}