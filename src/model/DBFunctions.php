<?php

const DB_SERVER = "proj-mysql.uopnet.plymouth.ac.uk";
const DB_USER = "PRCO204_SyntaxError";
const DB_PASSWORD = 'nJDXfDXEVBgiFT44';
const DB_DATABASE = "PRCO204_SyntaxError";


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