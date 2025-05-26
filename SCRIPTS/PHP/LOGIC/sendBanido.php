<?php 
    include_once 'session.php';
    include_once 'SQL_connection.php';
    include_once 'functions.php';
    debug_var($_POST);

    $sqlConnection = new SQLconnection();
    $id_denuncia = $_POST['id_denuncia'];
    $id_administrador = $_POST['id_administrador'];
    $id_participante_banido = $_POST['id_participante_banido'];
    $motivo = $_POST['motivo'];

    $sqlQuery = "INSERT INTO banido(
        id_administrador,
        id_participante_banido,
        motivo
    ) VALUES (
        '{$id_administrador}',
        '{$id_participante_banido}',
        '{$motivo}'
    )";

    $sqlConnection->insertQueryBD($sqlQuery);
    header("Location: /DailyGreen-Project/SCRIPTS/PHP/admPage.php");
?>