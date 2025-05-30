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

    $join = "SELECT
    post.id_post,
    post.titulo,
    post.descricao,
    post.create_time,
    midia.midia_ref,
    participante.username AS participante_username,
    participante.email AS participante_email,
    participante.profile_pic AS participante_profile_pic,
    participante.create_time AS participante_create_time
    FROM post
    JOIN participante ON post.id_autor = participante.id_participante
    LEFT JOIN midia ON post.id_post = midia.id_post
    WHERE participante.id_participante = {$id_participante};";

    $joinQuery = $sqlConnection->joinQueryBD($join);

    $postsAgrupados = [];

    foreach ($joinQuery as $postInformation) {
        $idPost = $postInformation['id_post'];

        if (!isset($postsAgrupados[$idPost])) {
            $postsAgrupados[$idPost] = [
                'titulo' => $postInformation['titulo'],
                'descricao' => $postInformation['descricao'],
                'create_time' => $postInformation['create_time'],
                'midias' => [],
            ];
        }

        if (!empty($postInformation['midia_ref'])) {
            $postsAgrupados[$idPost]['midias'][] = $postInformation['midia_ref'];
        }

        $participante_email = $postInformation['participante_email'];
        $participante_username = $postInformation['participante_username'];
        $participante_create_time = $postInformation['participante_create_time'];
    }


?>