
<?php
include 'arrayJSON.php';
$filename = "/xampp/htdocs/DailyGreen-Project/JSON/pag_cadastro.json";
switch ($_POST["cad-part"]) {
    case "0":
        $cadastroSave = updateCadastroSave();
        $cadastroSave["cad-part"] = "1";
        $stringJSON = json_encode($cadastroSave, JSON_PRETTY_PRINT);
        file_put_contents($filename, $stringJSON);
        header("Location: /DailyGreen-Project/SCRIPTS/PHP/accountCreation.php");
        break;
    case "1":
        $cadastroSave = updateCadastroSave();
        $cadastroSave["cad-part"] = "2";
        $stringJSON = json_encode($cadastroSave, JSON_PRETTY_PRINT);
        file_put_contents($filename, $stringJSON);
        header("Location: /DailyGreen-Project/SCRIPTS/PHP/accountCreation.php");
        break;
    case "2":
        $cadastroSave = updateCadastroSave();
        $cadastroSave["cad-part"] = "3";
        $stringJSON = json_encode($cadastroSave, JSON_PRETTY_PRINT);
        file_put_contents($filename, $stringJSON);
        header("Location: /DailyGreen-Project/SCRIPTS/PHP/AccSendQuery.php");
        break;
    default:
        echo "Error cad-part não encontrado";
        break;
}
