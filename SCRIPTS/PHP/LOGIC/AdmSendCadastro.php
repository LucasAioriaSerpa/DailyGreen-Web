<?php
include_once 'functions.php';
include_once 'session.php';
include_once 'Cypher.php';
include_once 'SQL_connection.php';

$__Cripto = new EncodeDecode();
$_SQL = new SQLconnection();
$email = $_POST['email'];
$senha = $__Cripto->encrypt($_POST['password']);

$_SQLQUERY = "INSERT INTO administrador ( email, password) VALUES ('{$email}', '{$senha}')";
$_SQL->insertQueryBD($_SQLQUERY);

header('Location: /DailyGreen-Project/SCRIPTS/HTML/tela_de_login_adm.html');
