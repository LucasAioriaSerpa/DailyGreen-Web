
<?php
include_once 'SQL_connection.php';
include_once 'Cypher.php';
$decode = new EncodeDecode();
$sqlConnection = new SQLconnection();
$loginTable = $sqlConnection->callTableBD("administrador", true);

foreach ($loginTable as $data) {
    if ($data["email"] == $_POST["email"]) {
        if ($decode->decrypt($data["password"]) == $_POST["password"]) {
            header("Location: /DailyGreen-Project/SCRIPTS/PHP/admPage.php");
            exit();
        }
    }
}
echo "false";
header("Location: /DailyGreen-Project/SCRIPTS/HTML/tela_de_login_adm.html");
