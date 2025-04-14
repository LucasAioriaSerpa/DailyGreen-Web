<?php
include_once 'arrayJSON.php'; // Se você precisa usar funções daí
include_once 'functions.php';
include_once 'uploadImage.php';

$filename = "/xampp/htdocs/DailyGreen-Project/JSON/pag_cadastro.json";

switch ($_POST["cad-part"]) {
    case "0":
        $cadastroSave = updateCadastroSave("0", false);
        if (in_array("true", $cadastroSave['part-1'])) {
            $cadastroSave["cad-part"] = "1-1";
        } else {
            $cadastroSave["cad-part"] = "1";
        }
        debug_var($_POST);
        debug_var($cadastroSave);
        $stringJSON = json_encode($cadastroSave, JSON_PRETTY_PRINT);
        file_put_contents($filename, $stringJSON);
        header("Location: /DailyGreen-Project/SCRIPTS/PHP/accountCreation.php");
        break;
    case "1-1":
        $cadastroSave = updateCadastroSave("1", true);
        $cadastroSave["cad-part"] = "1";
        $stringJSON = json_encode($cadastroSave, JSON_PRETTY_PRINT);
        file_put_contents($filename, $stringJSON);
        header("Location: /DailyGreen-Project/SCRIPTS/PHP/accountCreation.php");
        break;
    case "1":
        $cadastroSave = updateCadastroSave("1", false);
        $uploader = new ImageUploader('/xampp/htdocs/DailyGreen-Project/IMAGES/PROFILES/');
        $cadastroSave['part-2']['file'] = $uploader->upload($_FILES['file']);
        $cadastroSave["cad-part"] = "2";
        $stringJSON = json_encode($cadastroSave, JSON_PRETTY_PRINT);
        file_put_contents($filename, $stringJSON);
        header("Location: /DailyGreen-Project/SCRIPTS/PHP/accountCreation.php");
        break;
    case "2":
        $cadastroSave = updateCadastroSave("2", false);
        $cadastroSave["cad-part"] = "0";
        $stringJSON = json_encode($cadastroSave, JSON_PRETTY_PRINT);
        file_put_contents($filename, $stringJSON);
        header("Location: /DailyGreen-Project/SCRIPTS/PHP/LOGIC/AccSendQuery.php");
        break;
    default:
        echo "Error cad-part não encontrado";
}
