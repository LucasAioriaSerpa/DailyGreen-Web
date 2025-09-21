<?php
include_once 'session.php';
include_once 'SQL_connection.php';
include_once 'functions.php';
$sqlConnection = new SQLconnection();
debug_var($_SESSION['user']['account']);
debug_var($_POST);
$biografia = $_POST['biografia'];
$idParticipante = $_SESSION['user']['account'][0]['id_participante'];
$sqlQuery = "
UPDATE participante SET
biografia = '{$biografia}'
WHERE id_participante = '{$idParticipante}'
";
$sqlConnection->insertQueryBD($sqlQuery);
$_SESSION['user']['account'][0]['biografia'] = $biografia;
header("Location: /DailyGreen-Project/SCRIPTS/PHP/pagina_perfil.php");