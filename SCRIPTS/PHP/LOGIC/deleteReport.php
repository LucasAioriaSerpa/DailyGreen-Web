<?php 
    include_once 'session.php';
    include_once 'SQL_connection.php';
    include_once 'functions.php';
    debug_var($_POST);

    $sqlConnection = new SQLconnection();
    $id_denuncia = $_POST['id_denuncia'];
    

    header("Location: /DailyGreen-Project/SCRIPTS/PHP/admPage.php");
?>