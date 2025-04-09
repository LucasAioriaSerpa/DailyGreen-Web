<?php
include_once 'arrayJSON.php'; // Se você precisa usar funções daí

$filename = "/xampp/htdocs/DailyGreen-Project/JSON/pag_cadastro.json";

switch ($_POST["cad-part"]) {
    case "0":
        $cadastroSave = updateCadastroSave("0", false);
        $cadastroSave["cad-part"] = "1";
        $stringJSON = json_encode($cadastroSave, JSON_PRETTY_PRINT);
        file_put_contents($filename, $stringJSON);
        header("Location: /DailyGreen-Project/SCRIPTS/PHP/accountCreation.php");
        break;
    case "1":
        if ($_POST["part-1"]["org"] == "true") {
            $cadastroSave = updateCadastroSave("1", true);
            $cadastroSave["cad-part"] = "1";
            $stringJSON = json_encode($cadastroSave, JSON_PRETTY_PRINT);
            file_put_contents($filename, $stringJSON);
            header("Location: /DailyGreen-Project/SCRIPTS/PHP/accountCreation.php");
        }
        $cadastroSave = updateCadastroSave("1", false);
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

?>
