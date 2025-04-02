
<?php
include "Cypher.php";
$objEncode = new EncodeDecode();
//! to get a file to read needs to add "/xampp/htdocs/[folder-site]..."
$jsonDecodedBD = json_decode(file_get_contents("/xampp/htdocs/DailyGreen-Project/JSON/bd_info.json"), true);
if (sizeof($_POST) === 0) {
    header("Location: /DailyGreen-Project/SCRIPTS/PHP/SQL_connection_error.php");
    exit;
}
$jsonDecodedBD['mySql'] = $_POST; //* UPDATES DECODED DATA
// TODO: keeps return a string length of 64 and don't separate correctly "IV" and encryption = _ =) god please help
debug_var($jsonDecodedBD['mySql']["password"]);
debug_array($jsonDecodedBD);
$jsonDecodedBD['mySql']["password"] = $objEncode->encrypt($jsonDecodedBD['mySql']["password"]);
debug_array($jsonDecodedBD);
debug_var($objEncode->decrypt($jsonDecodedBD['mySql']["password"]));
file_put_contents("/xampp/htdocs/DailyGreen-Project/JSON/bd_info.json",json_encode($jsonDecodedBD, JSON_PRETTY_PRINT));
#header("Location: SQL_connection.php");
