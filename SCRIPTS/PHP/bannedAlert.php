
<?php
include_once "/xampp/htdocs/DailyGreen-Project/SCRIPTS/PHP/LOGIC/session.php";
include_once "/xampp/htdocs/DailyGreen-Project/SCRIPTS/PHP/LOGIC/SQL_connection.php";
include_once '/xampp/htdocs/DailyGreen-Project/SCRIPTS/PHP/LOGIC/functions.php';
$__sqlConnection = new SQLconnection();
$account = $_SESSION['user']['account'];
$arrayBanido = $__sqlConnection->callTableBD('banido');
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Banido | DailyGreen</title>
    <link rel="icon" type="image/x-icon" href="/DailyGreen-Project/IMAGES/dailyGreen-icon.ico">
    <link rel="stylesheet" href="/DailyGreen-Project/SCRIPTS/CSS/style_banned_alert.css">
</head>
<body>
    <div class="alert">
        <img src="<?= str_replace("/xampp/htdocs", "", htmlspecialchars($account[0]['profile_pic'])) ?>"
        alt="avatar" style="width: 100px; height: 100px; border-radius: 50%;">
        <h1>Conta <?= htmlspecialchars($account[0]['username']) ?> Banida</h1>
        <p>Seu acesso foi bloqueado porque sua conta foi banida.<br>
        Se você acredita que isso é um engano, entre em contato com o suporte.</p>
        <h2>Motivo</h2>
        <?php foreach($arrayBanido as $banido): ?>
            <?php if ($banido['id_participante_banido'] === $account[0]['id_participante']): ?>
                <p><?= htmlspecialchars(str_replace("_", " ", $banido['motivo'])) ?></p>
            <?php endif; ?>
        <?php endforeach;?>
        <a href="http://localhost/DailyGreen-Project/SCRIPTS/PHP/main-page.php">VOLTAR PARA PAGINA PRINCIPAL</a>
    </div>
</body>
</html>
