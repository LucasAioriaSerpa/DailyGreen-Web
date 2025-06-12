
<?php
include_once "/xampp/htdocs/DailyGreen-Project/SCRIPTS/PHP/LOGIC/session.php";
include_once "/xampp/htdocs/DailyGreen-Project/SCRIPTS/PHP/LOGIC/SQL_connection.php";
include_once '/xampp/htdocs/DailyGreen-Project/SCRIPTS/PHP/LOGIC/functions.php';
$__sqlConnection = new SQLconnection();
$account = $_SESSION['user']['account'];
$arraySuspenso = $__sqlConnection->callTableBD('suspenso');
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Suspenso | DailyGreen</title>
    <link rel="icon" type="image/x-icon" href="/DailyGreen-Project/IMAGES/dailyGreen-icon.ico">
    <link rel="stylesheet" href="/DailyGreen-Project/SCRIPTS/CSS/style_timeOut_alert.css">
</head>
<body>
    <div class="alert">
        <img src="<?= str_replace("/xampp/htdocs", "", htmlspecialchars($account[0]['profile_pic'])) ?>"
        alt="avatar" style="width: 100px; height: 100px; border-radius: 50%;">
        <h1>Conta <?= htmlspecialchars($account[0]['username']) ?> Suspensa</h1>
        <p>Seu acesso foi temporariamente suspenso.<br>
        Se você acredita que isso é um engano, entre em contato com o suporte.</p>
        <?php foreach($arraySuspenso as $suspenso): ?>
            <?php if ($suspenso['id_participante_suspenso'] === $account[0]['id_participante']): ?>
                <h2>Motivo</h2>
                <p><?= htmlspecialchars(str_replace("_", " ", $suspenso['motivo'])) ?></p>
                <h2>Data fim</h2>
                <p>
                    <?php
                        $dataHoraFim = $suspenso['data_hora_fim'];
                        $dataFormatada = date('d/m/Y H:i', strtotime($dataHoraFim));
                        echo htmlspecialchars($dataFormatada);
                    ?>
                </p>
            <?php endif; ?>
        <?php endforeach;?>
        <a href="http://localhost/DailyGreen-Project/SCRIPTS/PHP/main-page.php">VOLTAR PARA PAGINA PRINCIPAL</a>
    </div>
</body>
</html>
