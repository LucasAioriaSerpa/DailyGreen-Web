<?php
include_once 'session.php';
include_once 'uploadImage.php';
include_once 'Cypher.php';
include_once 'functions.php';

$locationAccCreation = "Location: /DailyGreen-Project/SCRIPTS/PHP/accountCreation.php";

switch ($_POST["cad-part"]) {
    case "0":
        $_SESSION['inputs']['cadastro']['cad-part'] = $_POST["cad-part"];
        $_SESSION['inputs']['cadastro']['part-1'] = [
            "nome" => $_POST["nome"],
            "email" => $_POST["email"],
            "org" => $_POST["org"]
        ];
        if (in_array("true", $_SESSION['inputs']['cadastro']['part-1'])) {
            $_SESSION['inputs']['cadastro']["cad-part"] = "1-1";
            $_SESSION['inputs']['cadastro']['part-1']['org'] = true;
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
