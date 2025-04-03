
<?php
include "Cypher.php";
$encode = new EncodeDecode();
$cadastroSave = json_decode(file_get_contents("/xampp/htdocs/DailyGreen-Project/JSON/pag_cadastro.json"), true);
$profile_pic = $cadastroSave["part-2"]["file"];
$username = $cadastroSave["part-1"]["nome"];
$email = $cadastroSave["part-1"]["email"];
$password = $encode->encrypt($cadastroSave["part-3"]["senha"]);
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
if ($cadastroSave["part-1"]["org"]) {
    $sqlQuery_org = "INSERT INTO organizacao(
        id_participante,
        nome,
        cnpj
    ) VALUES (
        '',
        '',
        ''
    )";
}
