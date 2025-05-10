
<?php

include_once 'SQL_connection.php';
include_once 'Cypher.php';

session_start();

$decode = new EncodeDecode();
$sqlConnection = new SQLconnection();
$loginTable = $sqlConnection->callTableBD("administrador", true);

foreach ($loginTable as $data) {
    if ($data["email"] == $_POST["email"]) {
        if ($decode->decrypt($data["password"]) == $_POST["password"]) {
            $_SESSION['adm-user'] = [
                'loged' => true,
                'find' => true,
                'account' => $data
            ];
            // ? delete later $loginAdmArray = ["find"=>true, $data];
            // ? file_put_contents("/xampp/htdocs/DailyGreen-Project/JSON/loginAdm.json",json_encode($loginAdmArray, JSON_PRETTY_PRINT));
            header("Location: /DailyGreen-Project/SCRIPTS/PHP/admPage.php");
            exit();
        }
    }
}
$_SESSION["adm-user"]["find"] = false;
// ? file_put_contents('/xampp/htdocs/DailyGreen-Project/JSON/loginAdm.json',json_encode(['find'=>false],JSON_PRETTY_PRINT));
header("Location: /DailyGreen-Project/SCRIPTS/PHP/loginAdm.php");
