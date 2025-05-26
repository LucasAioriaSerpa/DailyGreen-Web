<?php
    include_once 'LOGIC/session.php';
    include_once 'LOGIC/SQL_connection.php';
    include_once 'LOGIC/functions.php';
    if ($_SESSION['user']['loged'] === false) {
        header("Location: /DailyGreen-Project/SCRIPTS/PHP/loginAdm.php");
        exit();
    }
    $sqlConnection = new SQLconnection();
    $banidoArray = $sqlConnection->callTableBD('banido');

    // AINDA VOU FAZER O JOIN
?>

<div class="container-banido">
    <?php if (count($banidoArray) === 0):?>
        <div class="no-reports">
            <h4>Ainda não há usuários banidos!</h4>
        </div>
    <?php endif; ?>
    <div class="list-bans">
        <?php foreach ($banidoArray as $banido): ?>
            <div class="ban-users">
                <div class="motivo"> MOTIVO: <div class="titulo-report"><?= htmlspecialchars($banido['motivo']) ?></div> </div>
                <div class="inicio_suspensao"> DATA DO BANIMENTO: <div class="titulo-report"><?= htmlspecialchars($banido['create_time']) ?></div> </div>
            </div> <br>
        <?php endforeach; ?>
    </div>
</div>