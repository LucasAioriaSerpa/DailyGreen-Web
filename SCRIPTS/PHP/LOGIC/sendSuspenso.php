
<?php
    include_once 'session.php';
    include_once 'SQL_connection.php';
    include_once 'functions.php';
    debug_var($_POST);

    $sqlConnection = new SQLconnection();
    $id_administrador = $_POST['id_administrador'];
    $id_participante_suspenso = $_POST['id_participante_suspenso'];
    $id_denuncia = $_POST['id_denuncia'];
    $motivo = $_POST['motivo'];
    $dataHoraInicio = date("Y-m-d H:i:s", strtotime($_POST['data_hora_inicio']));
    $dataHoraFim = date("Y-m-d H:i:s", strtotime($_POST['data_hora_fim']));

    $sqlQuery = "INSERT INTO suspenso(
        id_administrador,
        id_participante_suspenso,
        id_denuncia,
        motivo,
        data_hora_inicio,
        data_hora_fim
    ) VALUES (
        '{$id_administrador}',
        '{$id_participante_suspenso}',
        '{$id_denuncia}',
        '{$motivo}',
        '{$dataHoraInicio}',
        '{$dataHoraFim}'
    )";

    $sqlConnection->insertQueryBD($sqlQuery);


    $updateStatus = "UPDATE denuncia
        SET
            status = 'Resolvida',
            data_fim_analise = NOW()
        WHERE
            status = 'Em Análise';
    ";

    $updateLista = "UPDATE participante
        SET 
            id_lista = '2'
        WHERE
            id_lista = '3'
            AND id_participante = {$id_participante_suspenso};
    ";

    $sqlConnection->rawQueryBD($updateStatus);
    $sqlConnection->rawQueryBD($updateLista);

    header("Location: /DailyGreen-Project/SCRIPTS/PHP/admPage.php");
?>
