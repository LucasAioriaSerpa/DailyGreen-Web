
<?php
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
function updateLoginSave() {
    return [
        "email" => $_POST["email"],
        "senha" => $_POST["senha"]
    ];
}
