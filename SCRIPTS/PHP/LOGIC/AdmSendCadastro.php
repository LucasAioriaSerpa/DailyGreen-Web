<?php
    include 'Cypher.php';
    include 'SQL_connection.php';

    $_Cypher = new EncodeDecode();
    $_SQL = new SQLconnection();

    $CadastroAdm = json_decode(file_get_contents('/xampp/htdocs/DailyGreen-Project/JSON/cad_log_adm.json'),true);
    $email = $CadastroAdm['email'];
    $password = $_Cypher->decrypt($CadastroAdm['password']);

    $_SQLQUERY = "INSERT INTO administrador (email,password) VALUES ('{$email}', '{$password}')";
    $_SQL->insertQueryBD($_SQLQUERY);

    header('Location: /DailyGreen-Project/SCRIPTS/HTML/tela_de_login_adm.html');
?>