
<?php
include 'Cypher.php';
include 'SQL_connection.php';
$encodeDecode = new EncodeDecode();
$sqlConnection = new SQLconnection();
$loginSave = json_decode(file_get_contents("/xampp/htdocs/DailyGreen-Project/JSON/login.json"), true);
$email = $loginSave["email"];
$password = $loginSave["password"];
$sqlQuery = "SELECT email, password FROM participante WHERE email={$email}";
