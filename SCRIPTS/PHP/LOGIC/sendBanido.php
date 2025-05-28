
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

    $sqlConnection->rawQueryBD($updateStatus);

    header("Location: /DailyGreen-Project/SCRIPTS/PHP/admPage.php");
?>