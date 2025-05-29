
<?php
    include_once 'session.php';
    include_once 'SQL_connection.php';
    include_once 'functions.php';
    debug_var($_POST);

    $sqlConnection = new SQLconnection();
    $id_administrador = $_POST['id_administrador'];
    $id_participante_banido = $_POST['id_participante_banido'];
    $id_denuncia = $_POST['id_denuncia'];
    $motivo = $_POST['motivo'];

    $sqlQuery = "INSERT INTO banido(
        id_administrador,
        id_participante_banido,
        id_denuncia,
        motivo
    ) VALUES (
        '{$id_administrador}',
        '{$id_participante_banido}',
        '{$id_denuncia}',
        '{$motivo}'
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
            id_lista = '3';
            AND id_participante = {$id_participante_banido};
    ";

    $sqlConnection->rawQueryBD($updateStatus);
    $sqlConnection->rawQueryBD($updateLista);

    header("Location: /DailyGreen-Project/SCRIPTS/PHP/admPage.php");
?>