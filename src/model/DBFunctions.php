<?php

const DB_SERVER = "socem1.uopnet.plymouth.ac.uk";
const DB_USER = "OWilkes";
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


function recordAppointment($userId, $appointmentDate, $appointmentDetails, $appointmentNotes, $numOfPatients)
{
    $statement = getConnection()->prepare("EXEC RecordAppointment $userId, '".$appointmentDate."' , '".$appointmentDetails."' , '".$appointmentNotes."' ,$numOfPatients;");
    $statement->execute();
}