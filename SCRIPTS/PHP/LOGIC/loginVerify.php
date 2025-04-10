
<?php
include_once 'SQL_connection.php';
include_once 'Cypher.php';
$decode = new EncodeDecode();
$sqlConnection = new SQLconnection();
$loginTable = $sqlConnection->callTableBD("participante", true);
$orgLogin = $sqlConnection->callTableBD("organizacao", false);
$loginInput = json_decode(file_get_contents('/xampp/htdocs/DailyGreen-Project/JSON/login_input.json'), true);

//? verify if the login exists and verify if the password is correct
foreach ($loginTable as $data) {
    switch ($data["email"]) {
        case $loginInput["email"]: {
            echo "<br><br> true - the email is equal";
            switch ($decode->decrypt($data["password"])) {
                case $decode->decrypt($loginInput["password"]): {
                    echo "<br><br> true - the password is equal";
                    if ($loginInput["org"] == "true") {
                        foreach ($orgLogin as $dataOrg) {
                            if ($dataOrg["id_participante"] == $data["id_participante"]) {
                                $loginArray = [$data , $orgLogin];
                                file_put_contents('/xampp/htdocs/DailyGreen-Project/JSON/login.json', json_encode($loginArray, JSON_PRETTY_PRINT));
                                header('Location: /DailyGreen-Project/SCRIPTS/PHP/postagens.php');
                                exit();
                            }
                        }
                    }
                    file_put_contents('/xampp/htdocs/DailyGreen-Project/JSON/login.json', json_encode([$data], JSON_PRETTY_PRINT));
                    header('Location: /DailyGreen-Project/SCRIPTS/PHP/postagens.php');
                    exit();
                }
                default: {
                    echo "<br><br> false - the password is not equal";
                    header('Location: /DailyGreen-Project/SCRIPTS/HTML/pagina_login.html');
                }
            }
        }
    }
}
header('Location: /DailyGreen-Project/SCRIPTS/HTML/pagina_login.html');
