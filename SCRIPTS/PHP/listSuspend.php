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
        <div class="no-records">
            <div class="icon-lupa">
                <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                <path stroke="currentColor" stroke-linecap="round" stroke-width="2" d="m21 21-3.5-3.5M17 10a7 7 0 1 1-14 0 7 7 0 0 1 14 0Z"/>
                </svg>
            </div>
            <div class="title-no-records"><h4>Ainda não há usuários suspensos!</h4></div>
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