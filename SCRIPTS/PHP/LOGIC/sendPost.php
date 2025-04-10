
<?php
include_once 'SQL_connection.php';
include_once 'functions.php';
$sqlConnection = new SQLconnection();
$id_autor = $_POST["id_participante"];
$titulo = $_POST["titulo"];
$descricao = $_POST["descricao"];
$sqlQuery = "INSERT INTO post(
    id_autor,
    titulo,
    descricao
) VALUES (
    '{$id_autor}',
    '{$titulo}',
    '{$descricao}'
)";
$last_id = $sqlConnection->insertQueryBD($sqlQuery);
header("Location: /DailyGreen-Project/SCRIPTS/PHP/postagens.php");
