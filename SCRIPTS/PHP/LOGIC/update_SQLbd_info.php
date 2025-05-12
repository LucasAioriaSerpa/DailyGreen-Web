
<?php
session_start();
include_once 'Cypher.php';
include_once 'SQL_connection.php';
$objEncode = new EncodeDecode();
//! to get a file to read needs to add "/xampp/htdocs/[folder-site]..."
if (empty($_POST)) {
    header("Location: /DailyGreen-Project/SCRIPTS/PHP/SQL_connection_error.php");
    exit;
}
$_SESSION['mySql'] = $_POST; //* UPDATES DECODED DATA
$_SESSION['mySql']["password"] = $objEncode->encrypt($_SESSION['mySql']["password"]);
$connection = new SQLconnection();
$connection->tryConnectBD(true); //? TEST CONNECTION
header("Location: /DailyGreen-Project/SCRIPTS/PHP/MAIN-PAGE.php"); //? REDIRECT TO HOME PAGE
