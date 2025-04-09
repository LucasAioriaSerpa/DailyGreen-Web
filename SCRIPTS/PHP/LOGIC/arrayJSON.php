<?php
include_once 'Cypher.php';

function updateCadastroSave(string $part, bool $org) {
    $_ENCODE = new EncodeDecode();
    $_JSON = json_decode(file_get_contents("/xampp/htdocs/DailyGreen-Project/JSON/pag_cadastro.json"), true);
    switch ($part) {
        case "0":
            return [
    "cad-part" => $_POST["cad-part"],
    "part-1" => [
        "nome" => $_POST["nome"],
        "email" => $_POST["email"],
        "org" => $_POST["org"]
    ],
    "part-1-org" => [
        "org-nome" => null,
        "CNPJ" => null,
    ],
    "part-2" => [
        "file" => null,
        "genero" => null
    ],
    "part-3" => [
        "senha" => null
    ]
            ];
        case "1":
            if ($org) {
                return [
        "cad-part" => $_POST["cad-part"],
        "part-1" => [
            "nome" => $_JSON['part-1']['nome'],
            "email" => $_JSON['part-1']['email'],
            "org" => $_POST['org']
        ],
        "part-1-org" => [
            "org-nome" => $_POST['org-nome'],
            "CNPJ" => $_POST['CNPJ']
        ],
        "part-2" => [
            "file" => null,
            "genero" => null
        ],
        "part-3" => [
            "senha" => null
        ]
                ];
            }
            return [
    "cad-part" => $_POST["cad-part"],
    "part-1" => [
        "nome" => $_JSON['part-1']['nome'],
        "email" => $_JSON['part-1']['email'],
        "org" => $_JSON['part-1']['org']
    ],
    "part-1-org" => [
        "org-nome" => $_JSON['part-1-org']['org-nome'],
        "CNPJ" => $_JSON['part-1-org']['CNPJ']
    ],
    "part-2" => [
        "file" => $_POST["file"],
        "genero" => $_POST["genero"]
    ],
    "part-3" => [
        "senha" => null
    ]
            ];
        case "2":
            return [
    "cad-part" => $_POST["cad-part"],
    "part-1" => [
        "nome" => $_JSON['part-1']['nome'],
        "email" => $_JSON['part-1']['email'],
        "org" => $_JSON['part-1']['org']
    ],
    "part-1-org" => [
        "org-nome" => $_JSON['part-1-org']['org-nome'],
        "CNPJ" => $_JSON['part-1-org']['CNPJ']
    ],
    "part-2" => [
        "file" => $_JSON['part-2']['file'],
        "genero" => $_JSON['part-2']['genero']
    ],
    "part-3" => [
        "senha" => $_ENCODE->encrypt($_POST["senha"])
    ]
            ];
        default:
            echo "cad-part invalid!";
    }
}

function updateLoginSave()
{
    $_ENCODE = new EncodeDecode();
    return [
        "email" => $_POST["email"],
        "password" => $_ENCODE->encrypt($_POST["password"]),
        "org" => $_POST["org"]
    ];
}

//* CADASTRO ADM
function updateCadastroSaveAdm()
{
    $_ENCODE = new EncodeDecode();
    return [
        "email" => $_POST["email"],
        "password" => $_ENCODE->encrypt($_POST["password"])
    ];
}
