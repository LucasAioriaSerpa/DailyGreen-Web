<?php
    include_once 'LOGIC/session.php';
    include_once 'LOGIC/SQL_connection.php';
    include_once 'LOGIC/functions.php';
    if ($_SESSION['user']['loged'] === false) {
        header("Location: /DailyGreen-Project/SCRIPTS/PHP/loginAdm.php");
        exit();
    }

    $sqlConnection = new SQLconnection();
    $suspensoArray = $sqlConnection->callTableBD('banido');
    $denunciaArray = $sqlConnection->callTableBD('denuncia');
    $admArray = $sqlConnection->callTableBD('administrador');
    $participanteArray = $sqlConnection->callTableBD('participante');
    $postArray = $sqlConnection->callTableBD('post');
    $midiaArray = $sqlConnection->callTableBD('midia');
    $id_denuncia = (int) $_GET['id'];

    $join = "SELECT banido.*,
    -- Participante
    participante.id_participante AS participante_id,
    participante.username AS participante_username,
    participante.profile_pic,
    participante.email AS participante_email,
    participante.create_time AS participante_create_time,
    lista.tipo_lista AS participante_lista_tipo,
    -- Denuncia
    denuncia.id_denuncia,
    denuncia.titulo AS denuncia_titulo,
    denuncia.motivo AS denuncia_motivo,
    denuncia.status AS denuncia_status,
    denuncia.data_registro,
    denuncia.data_inicio_analise,
    denuncia.data_fim_analise,
    -- Post
    post.id_post,
    post.titulo AS post_titulo,
    post.descricao AS post_descricao,
    post.create_time AS post_create_time,
    -- Midia
    midia.id_midia,
    midia.midia_ref,
    -- Administrador
    administrador.id_administrador,
    administrador.email AS administrador_email
    -- Referencia
    FROM banido
    JOIN participante ON banido.id_participante_banido = participante.id_participante
    JOIN lista ON participante.id_lista = lista.id_lista
    JOIN denuncia ON banido.id_denuncia = denuncia.id_denuncia
    JOIN administrador ON denuncia.id_administrador = administrador.id_administrador
    LEFT JOIN post ON denuncia.id_post = post.id_post
    LEFT JOIN midia ON post.id_post = midia.id_post
    WHERE banido.id_denuncia = {$id_denuncia};";

    $joinQuery = $sqlConnection->joinQueryBD($join);

    if ($joinQuery && count($joinQuery) > 0){
        // Participante
        $id_participante_banido = $joinQuery[0]['participante_id'];
        $participante_username = $joinQuery[0]['participante_username'];
        $participante_email = $joinQuery[0]['participante_email'];
        $participante_profile_pic = $joinQuery[0]['profile_pic'];
        $participante_creation_date = $joinQuery[0]['participante_create_time'];
        $participante_lista = $joinQuery[0]['participante_lista_tipo'];
        // Denuncia
        $id_denuncia = $joinQuery[0]['id_denuncia'];
        $denuncia_titulo = $joinQuery[0]['denuncia_titulo'];
        $denuncia_motivo = $joinQuery[0]['denuncia_motivo'];
        $denuncia_status = $joinQuery[0]['denuncia_status'];
        $denuncia_create = $joinQuery[0]['data_registro'];
        $denuncia_inicio_analise = $joinQuery[0]['data_inicio_analise'];
        $denuncia_fim_analise = $joinQuery[0]['data_fim_analise'];
        // Post
        $id_post = $joinQuery[0]['id_post'];
        $post_titulo = $joinQuery[0]['post_titulo'];
        $post_descricao = $joinQuery[0]['post_descricao'];
        $post_publicacao = $joinQuery[0]['post_create_time'];
        // Midia
        $id_midia = $joinQuery[0]['id_midia'];
        $midia_ref = $joinQuery[0]['midia_ref'];
        // Administrador
        $id_administrador = $joinQuery[0]['id_administrador'];
        $administrador_email = $joinQuery[0]['administrador_email'];
    } else {
        echo "Nenhum resultado encontrado.";
    }
    
    $user_create_time = new DateTime($participante_creation_date);
    $denuncia_create_time = new DateTime($denuncia_create);
    $inicio_analise = new DateTime($denuncia_inicio_analise);
    $fim_analise = new DateTime($denuncia_fim_analise);
    $post_create_time = new DateTime($post_publicacao);

?>