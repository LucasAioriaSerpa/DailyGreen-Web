
<?php
include_once 'session.php';
include_once 'SQL_connection.php';
include_once 'Cypher.php';
include_once 'functions.php';
$encode = new EncodeDecode();
$sqlConnection = new SQLconnection();
$profile_pic = $_SESSION['inputs']['cadastro']["part-2"]["file"];
$username = $_SESSION['inputs']['cadastro']["part-1"]["nome"];
$email = $_SESSION['inputs']['cadastro']["part-1"]["email"];
$password = $_SESSION['inputs']['cadastro']["part-3"]["senha"];
$genero = $_SESSION['inputs']['cadastro']["part-2"]["genero"][0];
$sqlQuery = "INSERT INTO participante(
    profile_pic,
    username,
    email,
    password,
    genero
) VALUES (
    '{$profile_pic}',
    '{$username}',
    '{$email}',
    '{$password}',
    '{$genero}'
)";
$last_id = $sqlConnection->insertQueryBD($sqlQuery);
if ($_SESSION['inputs']['cadastro']['part-1']['org']) {
    $nameOrg = $_SESSION['inputs']['cadastro']["part-1-org"]["org-nome"];
    $CNPJ = (int) $_SESSION['inputs']['cadastro']["part-1-org"]["CNPJ"];
    $sqlQuery_org = "INSERT INTO organizacao(
        id_participante,
        nome,
        CNPJ
    ) VALUES (
        '{$last_id}',
        '{$nameOrg}',
        '{$CNPJ}'
    )";
    $last_id = $sqlConnection->insertQueryBD($sqlQuery_org);
}
$_SESSION['inputs']['cadastro'] = [
    'cad-part' => '0',
    'part-1' => [
        'nome' => null,
        'email' => null,
        'org' => null
    ],
    'part-1-org' => [
        'org-nome' => null,
        'CNPJ' => null
    ],
    'part-2' => [
        'file' => null,
        'genero' => null
    ],
    'part-3' => [
        'senha' => null
    ]
];
header("Location: /DailyGreen-Project/SCRIPTS/HTML/pagina_login.html");
