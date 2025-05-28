<?php 
    include_once 'session.php';
    include_once 'SQL_connection.php';
    include_once 'functions.php';
    debug_var($_POST);

    $sqlConnection = new SQLconnection();
    $updateDenunciaTB = "UPDATE denuncia
        SET
            status = 'Arquivada',
            data_fim_analise = NOW()
        WHERE
            status = 'Em Análise';
    ";

    $sqlConnection->rawQueryBD($updateDenunciaTB);
    header("Location: /DailyGreen-Project/SCRIPTS/PHP/admPage.php");
?>