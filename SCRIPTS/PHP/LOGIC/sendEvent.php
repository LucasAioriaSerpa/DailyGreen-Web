
<?php
include_once 'session.php';
include_once 'SQL_connection.php';
include_once 'functions.php';
debug_var($_POST);
$sqlConnection = new SQLconnection();
$id_autor = $_POST["id_participante"];
$titulo = $_POST["titulo"];
$descricao = $_POST["descricao"];
$sqlQuery_1 = "INSERT INTO post(
    id_autor,
    titulo,
    descricao
) VALUES (
    '{$id_autor}',
    '{$titulo}',
    '{$descricao}'
)";
$last_id = $sqlConnection->insertQueryBD($sqlQuery_1);
$id_organizacao = $_POST["id_organizacao"];
$id_post = $last_id;
$data_hora_inicio = $_POST["dataTimeInicio"]; //? YYYY-MM-DD HH:MI:SS
$data_hora_fim = $_POST["dataTimeFim"]; //? YYYY-MM-DD HH:MI:SS
$local = $_POST["local"];
$link = $_POST["link"];
$sqlQuery_2 = "INSERT INTO evento(
    id_organizacao,
    id_post,
    data_hora_inicio,
    data_hora_fim,
    local,
    link
) VALUES (
    '{$id_organizacao}',
    '{$id_post}',
    '{$data_hora_inicio}',
    '{$data_hora_fim}',
    '{$local}',
    '{$link}'
)";
$sqlConnection->insertQueryBD($sqlQuery_2);
header("Location: /DailyGreen-Project/SCRIPTS/PHP/postagens.php");
