
<?php
include_once 'session.php';
include_once 'SQL_connection.php';
include_once 'Cypher.php';
$decode = new EncodeDecode();
$sqlConnection = new SQLconnection();
$loginTable = $sqlConnection->callTableBD("participante", true);
$orgLogin = $sqlConnection->callTableBD("organizacao", false);
$urlLogin = "Location: /DailyGreen-Project/SCRIPTS/PHP/loginAcc.php";

//? verify if the login exists and verify if the password is correct
foreach ($loginTable as $data) {
    switch ($data["email"]) {
        case $_SESSION['inputs']['login']["email"]: {
            if ($decode->decrypt($data["password"]) == $decode->decrypt($_SESSION['inputs']['login']["password"])) {
                //? verify if the acount is a Organization
                foreach ($orgLogin as $dataOrg) {
                    if ($dataOrg["id_participante"] == $data["id_participante"]) {
                        $_SESSION['user']['loged'] = true;
                        $_SESSION['user']['find'] = true;
                        $_SESSION['user']['org'] = true;
                        $_SESSION['user']['account'] = [$data, $dataOrg];
                        header('Location: /DailyGreen-Project/SCRIPTS/PHP/postagens.php');
                        exit();
                    }
                }
                $_SESSION['user']['loged'] = true;
                $_SESSION['user']['find'] = true;
                $_SESSION['user']['org'] = false;
                $_SESSION['user']['account'] = [$data];
                header('Location: /DailyGreen-Project/SCRIPTS/PHP/postagens.php');
                exit();
            } else {
                $_SESSION['user']['find'] = false;
                header($urlLogin);
            }
            break;
        }
        default: {
            $_SESSION['user']['find'] = false;
            header($urlLogin);
        }
    }
}
$_SESSION['user']['find'] = false;
header($urlLogin);
