<?php
    include_once 'LOGIC/session.php';
    include_once 'LOGIC/SQL_connection.php';
    include_once 'LOGIC/functions.php';
    if ($_SESSION['user']['loged'] === false) {
        header("Location: /DailyGreen-Project/SCRIPTS/PHP/loginAdm.php");
        exit();
    }
    $sqlConnection = new SQLconnection();
    $suspensoArray = $sqlConnection->callTableBD('suspenso');

    // AINDA VOU FAZER O JOIN
?>

<div class="container-suspensos">
    <?php if (count($suspensoArray) === 0):?>
        <div class="no-reports">
            <h4>Ainda não há usuários suspensos!</h4>
        </div>
    <?php endif; ?>
    <div class="list-suspends">
        <?php foreach ($suspensoArray as $suspenso): ?>
            <div class="suspend-users">
                <div class="motivo"> MOTIVO: <div class="titulo-report"><?= htmlspecialchars($suspenso['motivo']) ?></div> </div>
                <div class="inicio_suspensao"> INICIO DA SUSPENSÃO: <div class="titulo-report"><?= htmlspecialchars($suspenso['data_hora_inicio']) ?></div> </div>
                <div class="fim_suspensao"> FIM DA SUSPENSÃO: <div class="titulo-report"><?= htmlspecialchars($suspenso['data_hora_inicio']) ?></div> </div>
            </div> <br>
        <?php endforeach; ?>
    </div>
</div>