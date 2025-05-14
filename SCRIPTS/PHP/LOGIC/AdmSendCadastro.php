<?php
    include_once 'session.php';
    include_once 'Cypher.php';
    include 'SQL_connection.php';

    $__Cripto = new EncodeDecode();
    $_SQL = new SQLconnection();

    $CadastroAdm = json_decode(file_get_contents('/xampp/htdocs/DailyGreen-Project/JSON/cad_log_adm.json'),true);
    $email = $CadastroAdm['email'];
    $password = $__Cripto->decrypt($CadastroAdm['password']);

    $_SQLQUERY = "INSERT INTO administrador (email,password) VALUES ('{$email}', '{$password}')";
    $_SQL->insertQueryBD($_SQLQUERY);

    header('Location: /DailyGreen-Project/SCRIPTS/HTML/tela_de_login_adm.html');
