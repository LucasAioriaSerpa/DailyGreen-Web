
<?php
include_once "session.php";
include_once "SQL_connection.php";

$sqlConnection = new SQLconnection();

$id_post = $_POST['id_post'];
$id_autor_comentario = $_POST['id_autor_comment'];
$titulo = $_POST['comment-title'];
$descricao = $_POST['comment-text'];

$queryBD = "INSERT INTO comentario(
    id_post,
    id_autor_comentario,
    titulo_comentario,
    descricao_comentario
) VALUES (
    '{$id_post}',
    '{$id_autor_comentario}',
    '{$titulo}',
    '{$descricao}'
)";

$sqlConnection->insertQueryBD($queryBD);

header("Location: /DailyGreen-Project/SCRIPTS/PHP/postagens.php");
