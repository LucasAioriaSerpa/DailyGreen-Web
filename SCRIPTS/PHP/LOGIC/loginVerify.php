
<?php
include_once 'SQL_connection.php';
include_once 'Cypher.php';
$decode = new EncodeDecode();
$sqlConnection = new SQLconnection();
$loginTable = $sqlConnection->callTableBD("participante", true);
$orgLogin = $sqlConnection->callTableBD("organizacao", false);
$loginInput = json_decode(file_get_contents('/xampp/htdocs/DailyGreen-Project/JSON/login_input.json'), true);

$urlLogin = "Location: /DailyGreen-Project/SCRIPTS/HTML/pagina_login.html";

//? verify if the login exists and verify if the password is correct
foreach ($loginTable as $data) {
    switch ($data["email"]) {
        case $loginInput["email"]: {
            echo "<br><br> true - the email is equal";
            if ($decode->decrypt($data["password"]) == $decode->decrypt($loginInput["password"])) {
                echo "<br><br> true - the password is equal";
                //? verify if the acount is a Organization
                foreach ($orgLogin as $dataOrg) {
                    if ($dataOrg["id_participante"] == $data["id_participante"]) {
                        $loginArray = ["org"=>true , $data , $orgLogin];
                        file_put_contents('/xampp/htdocs/DailyGreen-Project/JSON/login.json', json_encode($loginArray, JSON_PRETTY_PRINT));
                        header('Location: /DailyGreen-Project/SCRIPTS/PHP/postagens.php');
                        exit();
                    }
                }
                file_put_contents('/xampp/htdocs/DailyGreen-Project/JSON/login.json', json_encode(["org"=>false , $data], JSON_PRETTY_PRINT));
                header('Location: /DailyGreen-Project/SCRIPTS/PHP/postagens.php');
                exit();
            } else {
                echo "<br><br> false - the password is not equal";
                header($urlLogin);
            }
            break;
        }
        default: {
            echo "<br><br> false - the email is not equal";
            header($urlLogin);
        }
    }
}
header($urlLogin);
