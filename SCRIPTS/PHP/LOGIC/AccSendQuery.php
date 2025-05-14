
<?php
include_once 'session.php';
include_once 'Cypher.php';
include_once 'SQL_connection.php';
include_once 'functions.php';
$encode = new EncodeDecode();
$sqlConnection = new SQLconnection();
$cadastroSave = json_decode(file_get_contents("/xampp/htdocs/DailyGreen-Project/JSON/pag_cadastro.json"), true);
$profile_pic = $cadastroSave["part-2"]["file"];
$username = $cadastroSave["part-1"]["nome"];
$email = $cadastroSave["part-1"]["email"];
$password = $encode->decrypt($cadastroSave["part-3"]["senha"]);
$genero = $cadastroSave["part-2"]["genero"][0];
debug_var($cadastroSave);
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
if (in_array(null, $cadastroSave['part-1'])) {
    $nameOrg = (string) $cadastroSave["part-1-org"]["org-nome"];
    $CNPJ = (int) $cadastroSave["part-1-org"]["CNPJ"];
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
header("Location: /DailyGreen-Project/SCRIPTS/HTML/pagina_login.html");
