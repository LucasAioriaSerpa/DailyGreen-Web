<?php
include_once 'session.php';
include_once 'uploadImage.php';
include_once 'Cypher.php';
include_once 'functions.php';
include_once 'SQL_connection.php';
$sqlConnection = new SQLconnection();
$participanteArray = $sqlConnection->callTableBD("participante");
$locationAccCreation = "Location: /DailyGreen-Project/SCRIPTS/PHP/accountCreation.php";

switch ($_POST["cad-part"]) {
    case "0":
        // Verificar se o email já existe
        $emailExistente = false;
        foreach ($participanteArray as $participante) {
            if ($participante['email'] === $_POST["email"]) {
                $emailExistente = true;
                break;
            }
        }
        
        if ($emailExistente) {
            $_SESSION['error'] = "Este e-mail já está cadastrado. Por favor, use outro e-mail.";
            header($locationAccCreation);
            exit();
        }
        
        $_SESSION['inputs']['cadastro']['cad-part'] = $_POST["cad-part"];
        $_SESSION['inputs']['cadastro']['part-1'] = [
            "nome" => $_POST["nome"],
            "passagem" => $_POST["passagem"],
            "biografia" => $_POST["biografia"],
            "email" => $_POST["email"],
            "org" => $_POST["org"]
        ];
        if ($_SESSION['inputs']['cadastro']['part-1']['org'] === 'true') {
            $_SESSION['inputs']['cadastro']["cad-part"] = "1-1";
        } else {
            $_SESSION['inputs']['cadastro']["cad-part"] = "1";
        }
        header($locationAccCreation);
        break;
    case "1-1":
        $_SESSION['inputs']['cadastro']['part-1-org'] = [
            'org-nome' => $_POST['org-nome'],
            'CNPJ' => $_POST['CNPJ']
        ];
        $_SESSION['inputs']['cadastro']["cad-part"] = "1";
        header($locationAccCreation);
        break;
    case "1":
        $uploader = new ImageUploader('/xampp/htdocs/DailyGreen-Project/IMAGES/PROFILES/');
        $_SESSION['inputs']['cadastro']['part-2'] = [
            'file' => $uploader->upload($_FILES['file']),
            'genero' => $_POST['genero']
        ];
        $_SESSION['inputs']['cadastro']["cad-part"] = "2";
        header($locationAccCreation);
        break;
    case "2":
        $_ENCODE = new EncodeDecode();
        $_SESSION['inputs']['cadastro']['part-3'] = ['senha' => $_ENCODE->encrypt($_POST['senha'])];
        header("Location: /DailyGreen-Project/SCRIPTS/PHP/LOGIC/AccSendQuery.php");
        break;
    default:
        echo "Error cad-part não encontrado";
}