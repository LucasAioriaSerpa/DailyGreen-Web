<?php 
    include_once 'session.php';
    include_once 'SQL_connection.php';
    include_once 'functions.php';
    debug_var($_POST);

    $sqlConnection = new SQLconnection();
    $id_relator = $_POST['id_relator'];
    $id_relatado = $_POST['id_relatado'];
    $titulo = $_POST['titulo'];
    $motivo = $_POST['motivo'];

    $sqlQuery = "INSERT INTO denuncia(
        id_relator,
        id_relatado,
        titulo,
        motivo
    ) VALUES (
        '{$id_relator}',
        '{$id_relatado}',
        '{$titulo}',
        '{$motivo}'
    )";

    //$sqlConnection->insertQueryBD($sqlQuery);

    //header("Location: /DailyGreen-Project/SCRIPTS/PHP/postagens.php");
?>