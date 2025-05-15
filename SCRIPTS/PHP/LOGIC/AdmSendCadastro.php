<?php
    include_once 'session.php';
    include_once 'Cypher.php';
    include 'SQL_connection.php';

    $__Cripto = new EncodeDecode();
    $_SQL = new SQLconnection();

    $email = $_POST['email'];
    $password = $__Cripto->encrypt($_POST['password']);

    $_SQLQUERY = "INSERT INTO administrador (email,password) VALUES ('{$email}', '{$password}')";
    $_SQL->insertQueryBD($_SQLQUERY);

    header('Location: /DailyGreen-Project/SCRIPTS/HTML/tela_de_login_adm.html');
