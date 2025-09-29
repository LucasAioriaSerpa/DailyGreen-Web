
<?php
include_once "session.php";
include_once "SQL_connection.php";
include_once "comentarioService.php";

$sqlConnection = new SQLconnection();
$comentarioService = new ComentarioService($sqlConnection);
$id_post = $_POST['id_post'];
$id_autor_comentario = $_POST['id_autor_comment'];
$titulo = $_POST['comment-title'];
$descricao = $_POST['comment-text'];
$comentarioService->inserirComentario(
    $id_post,
    $id_autor_comentario,
    $titulo,
    $descricao
);

header("Location: /DailyGreen-Project/SCRIPTS/PHP/postagens.php");
