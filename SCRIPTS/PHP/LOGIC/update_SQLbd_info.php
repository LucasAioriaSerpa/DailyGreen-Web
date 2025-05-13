
<?php
session_start();
include_once 'Cypher.php';
include_once 'SQL_connection.php';
include_once 'functions.php';
$objEncode = new EncodeDecode();
//! to get a file to read needs to add "/xampp/htdocs/[folder-site]..."
debug_var($_POST);
debug_var($_SESSION['mySql']);
if (empty($_POST)) {
    header("Location: /DailyGreen-Project/SCRIPTS/PHP/SQL_connection_error.php");
    exit;
}
$_SESSION['mySql'] = $_POST; //* UPDATES DECODED DATA
$_SESSION['mySql']["password"] = $objEncode->encrypt($_SESSION['mySql']["password"]);
$connection = new SQLconnection();
$connection->tryConnectBD(true); //? TEST CONNECTION
if ($_SESSION['user']['type'] === 'USER') {
    header("Location: /DailyGreen-Project/SCRIPTS/PHP/MAIN-PAGE.php");
    exit;
} else if ($_SESSION['user']['type'] === 'ADM') {
    header("Location: /DailyGreen-Project/SCRIPTS/PHP/loginAdm.php");
    exit;
}
