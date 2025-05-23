
<?php
include_once 'session.php';
include_once 'SQL_connection.php';
include_once 'Cypher.php';

$decode = new EncodeDecode();
$sqlConnection = new SQLconnection();
$loginTable = $sqlConnection->callTableBD("administrador");
echo '_POST: ' . $_POST['email'] . '<br>';
echo '_POST: ' . $_POST['password'] . '<br>';
foreach ($loginTable as $data) {
    echo $data['email'] . '<br>';
    echo $data['password'] . '<br>';
    if ($data["email"] == $_POST["email"] && $decode->decrypt($data['password']) == $_POST["password"]) {
        echo 'entrou';
        $_SESSION['user'] = [
            'loged' => true,
            'find' => true,
            'account' => $data
        ];
        header("Location: /DailyGreen-Project/SCRIPTS/PHP/admPage.php");
        exit();
    }
}
echo 'não entrou';
$_SESSION["user"]["find"] = false;
header("Location: /DailyGreen-Project/SCRIPTS/PHP/loginAdm.php");
