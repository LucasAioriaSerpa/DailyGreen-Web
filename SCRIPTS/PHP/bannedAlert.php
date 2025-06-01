
<?php
include_once "/xampp/htdocs/DailyGreen-Project/SCRIPTS/PHP/LOGIC/session.php";
include_once "/xampp/htdocs/DailyGreen-Project/SCRIPTS/PHP/LOGIC/SQL_connection.php";
include_once '/xampp/htdocs/DailyGreen-Project/SCRIPTS/PHP/LOGIC/functions.php';
debug_var($_SESSION['user']);
$__sqlConnection = new SQLconnection();
$arrayBanido = $__sqlConnection->callTableBD('banido');
debug_var($arrayBanido);
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Banido | DailyGreen</title>
    <link rel="stylesheet" href="/DailyGreen-Project/SCRIPTS/CSS/style_banned_alert.css">
</head>
<body>
    <div class="alert">
        <h1>Conta Banida</h1>
        <p>Seu acesso foi bloqueado porque sua conta foi banida.<br>
        Se você acredita que isso é um engano, entre em contato com o suporte.</p>
    </div>
</body>
</html>
