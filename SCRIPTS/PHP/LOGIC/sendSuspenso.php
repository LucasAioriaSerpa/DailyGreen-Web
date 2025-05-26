<?php
    include_once 'session.php';
    include_once 'SQL_connection.php';
    include_once 'functions.php';
    include_once 'deleteReport.php';
    debug_var($_POST);

    $sqlConnection = new SQLconnection();
    $id_denuncia = $_POST['id_denuncia'];
    $id_administrador = $_POST['id_administrador'];
    $id_participante_suspenso = $_POST['id_participante_suspenso'];
    $motivo = $_POST['motivo'];
    $dataHoraInicio = date("Y-m-d H:i:s", strtotime($_POST['data_hora_inicio']));
    $dataHoraFim = date("Y-m-d H:i:s", strtotime($_POST['data_hora_fim']));

    $sqlQuery = "INSERT INTO suspenso(
        id_administrador,
        id_participante_suspenso,
        motivo,
        data_hora_inicio,
        data_hora_fim
    ) VALUES (
        '{$id_administrador}',
        '{$id_participante_suspenso}',
        '{$motivo}',
        '{$dataHoraInicio}',
        '{$dataHoraFim}'
    )";

    $sqlConnection->insertQueryBD($sqlQuery);
    $sqlConnection->deleteReport($id_denuncia);
    header("Location: /DailyGreen-Project/SCRIPTS/PHP/admPage.php");
?>