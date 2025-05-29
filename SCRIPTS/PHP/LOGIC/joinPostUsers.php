<?php
    include_once 'LOGIC/session.php';
    include_once 'LOGIC/SQL_connection.php';
    include_once 'LOGIC/functions.php';
    if ($_SESSION['user']['loged'] === false) {
        header("Location: /DailyGreen-Project/SCRIPTS/PHP/loginAdm.php");
        exit();
    }

    $sqlConnection = new SQLconnection();
    $userArray = $sqlConnection->callTableBD('participante');
    $postArray = $sqlConnection->callTableBD('post');
    $midiaArray = $sqlConnection->callTableBD('midia');
    $id_participante = (int) $_GET['id'];

    $join = "SELECT post.*,
    participante.username AS participante_username,
    participante.email AS participante_email,
    participante.profile_pic AS participante_profile_pic,
    participante.create_time AS participante_create_time
    FROM post
    JOIN participante ON post.id_autor = participante.id_participante
    WHERE participante.id_participante = {$id_participante};";

    $joinQuery = $sqlConnection->joinQueryBD($join);

?>