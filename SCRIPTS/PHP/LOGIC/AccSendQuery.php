
<?php
include "Cypher.php";
include "SQL_connection.php";
$encode = new EncodeDecode();
$sqlConnection = new SQLconnection();
$cadastroSave = json_decode(file_get_contents("/xampp/htdocs/DailyGreen-Project/JSON/pag_cadastro.json"), true);
$profile_pic = $cadastroSave["part-2"]["file"];
$username = $cadastroSave["part-1"]["nome"];
$email = $cadastroSave["part-1"]["email"];
$password = $encode->decrypt($cadastroSave["part-3"]["senha"]);
$genero = $cadastroSave["part-2"]["genero"];
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
if ($cadastroSave["part-1"]["org"]) {
    $nomeOrg = $cadastroSave["part-1-org"]["org-nome"];
    $CNPJ = $cadastroSave["part-1-org"]["CNPJ"];
    $sqlQuery_org = "INSERT INTO organizacao(
        id_participante,
        nome,
        cnpj
    ) VALUES (
        '{$last_id}',
        '{$nameOrg}',
        '{$CNPJ}'
    )";
    $last_id = $sqlConnection->insertQueryBD($sqlQuery_org);
}
header("Location: /DailyGreen-Project/SCRIPTS/HTML/pagina_login.html");
