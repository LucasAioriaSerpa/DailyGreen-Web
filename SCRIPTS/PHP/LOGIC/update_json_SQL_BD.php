
<?php
include_once 'Cypher.php';
include_once 'SQL_connection.php';
$objEncode = new EncodeDecode();
//! to get a file to read needs to add "/xampp/htdocs/[folder-site]..."
$jsonDecodedBD = json_decode(file_get_contents("/xampp/htdocs/DailyGreen-Project/JSON/bd_info.json"), true);
if (empty($_POST)) {
    header("Location: /DailyGreen-Project/SCRIPTS/PHP/SQL_connection_error.php");
    exit;
}
$jsonDecodedBD['mySql'] = $_POST; //* UPDATES DECODED DATA
$jsonDecodedBD['mySql']["password"] = $objEncode->encrypt($jsonDecodedBD['mySql']["password"]);
file_put_contents("/xampp/htdocs/DailyGreen-Project/JSON/bd_info.json",json_encode($jsonDecodedBD, JSON_PRETTY_PRINT));
$connection = new SQLconnection();
$connection->tryConnectBD(true); //? TEST CONNECTION
header("Location: /DailyGreen-Project/SCRIPTS/HTML/pagina_apresentaçao.html"); //? REDIRECT TO HOME PAGE
