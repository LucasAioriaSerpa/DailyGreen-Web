
<?php
$pagCadastroDATA = json_decode(file_get_contents("/xampp/htdocs/DailyGreen-Project/JSON/pag_cadastro.json"), true);
function updateCadastroSave() {
    return [
        "cad-part" => $_POST["cad-part"],
        "part-1" => [
            "nome" => $_POST["nome"],
            "sobrenome" => $_POST["sobrenome"],
            "email" => $_POST["email"],
            "senha" => $_POST["org"]
        ],
        "part-1-org" => [
            "org-nome" => $_POST["org-nome"],
            "CNPJ" => $_POST["cNPJ"]
        ],
        "part-2" => [
            "file" => $_POST["file"],
            "genero" => $_POST["genero"]
        ],
        "part-3" => [
            "senha" => $_POST["senha"]
        ]
        ];
}

switch ($_POST["cad-part"]) {
    case 0:
        $cadastroSave = updateCadastroSave();
        $cadastroSave["cad-part"] = "1";
        $stringJSON = json_encode($cadastroSave);
        file_put_contents("/xampp/htdocs/DailyGreen-Project/JSON/pag_cadastro.json", $stringJSON);
        header("Location: /DailyGreen-Project/SCRIPTS/PHP/accountCreation.php");
        break;
    case 1:
        $cadastroSave = updateCadastroSave();
        $cadastroSave["cad-part"] = "2";
        $stringJSON = json_encode($cadastroSave);
        file_put_contents("/xampp/htdocs/DailyGreen-Project/JSON/pag_cadastro.json", $stringJSON);
        header("Location: /DailyGreen-Project/SCRIPTS/PHP/accountCreation.php");
        break;
    case 2:
        $cadastroSave = updateCadastroSave();
        $cadastroSave["cad-part"] = "3";
        $stringJSON = json_encode($cadastroSave);
        file_put_contents("/xampp/htdocs/DailyGreen-Project/JSON/pag_cadastro.json", $stringJSON);
        header("Location: /DailyGreen-Project/index.php");
        break;
    default:
        echo "Error cad-part não encontrado";
        break;
}
