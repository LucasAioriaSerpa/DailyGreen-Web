
<?php
include_once 'session.php';
include_once 'SQL_connection.php';
include_once 'Cypher.php';

$decode = new EncodeDecode();
$sqlConnection = new SQLconnection();
$loginTable = $sqlConnection->callTableBD("administrador");
echo $_POST['email'] . '<br>';
echo $_POST['password'];
foreach ($loginTable as $data) {
    echo $data['email'] . '<br>';
    echo $data['password'] . '<br>';
    if ($data["email"] == $_POST["email"] && $decode->decrypt($data["password"]) == $_POST["password"]) {
        $_SESSION['adm-user'] = [
            'loged' => true,
            'find' => true,
            'account' => $data
        ];
        //header("Location: /DailyGreen-Project/SCRIPTS/PHP/admPage.php");
        exit();
    }
}
$_SESSION["adm-user"]["find"] = false;
//header("Location: /DailyGreen-Project/SCRIPTS/PHP/loginAdm.php");
