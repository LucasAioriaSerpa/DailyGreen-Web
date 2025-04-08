
<?php
//include 'Cypher.php';

function updateCadastroSave() {
    // $_ENCODE = new EncodeDecode();
    return [
        "cad-part" => $_POST["cad-part"],
        "part-1" => [
            "nome" => $_POST["nome"],
            "sobrenome" => $_POST["sobrenome"],
            "email" => $_POST["email"],
            "senha" => $_POST["senha"]
        ],
        "part-1-org" => [
            "org-nome" => $_POST["org-nome"],
            "CNPJ" => $_POST["CNPJ"]
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
    // $_ENCODE = new EncodeDecode();
    return [
        "email" => $_POST["email"],
        "senha" => $_POST["senha"]
    ];
}

// CADASTRO ADM
function updateCadastroSaveAdm(){
    // $_ENCODE = new EncodeDecode();
    return [
        "email" => $_POST["email"],
        "password" => $_POST["password"]
    ];
}

// LOGIN ADM 
function updateLoginSaveAdm(){
    // $_ENCODE = new EncodeDecode();
    return [
        "email" => $_POST["email"],
        "password" => $_POST["password"]
    ];
}