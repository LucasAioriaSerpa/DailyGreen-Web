
<?php
include_once 'SQL_connection.php';
include_once 'Cypher.php';

$decode = new EncodeDecode();
$sqlConnection = new SQLconnection();
$loginTable = $sqlConnection->callTableBD("administrador", true);

foreach ($loginTable as $data) {
    if ($data["email"] == $_POST["email"]) {
        if ($decode->decrypt($data["password"]) == $_POST["password"]) {
            $loginAdmArray = ["find"=>true, $data];
            file_put_contents("/xampp/htdocs/DailyGreen-Project/JSON/loginAdm.json",json_encode($loginAdmArray, JSON_PRETTY_PRINT));
            header("Location: /DailyGreen-Project/SCRIPTS/PHP/admPage.php");
            exit();
        }
    }
}
file_put_contents('/xampp/htdocs/DailyGreen-Project/JSON/loginAdm.json',json_encode(['find'=>false],JSON_PRETTY_PRINT));
header("Location: /DailyGreen-Project/SCRIPTS/PHP/loginAdm.php");
