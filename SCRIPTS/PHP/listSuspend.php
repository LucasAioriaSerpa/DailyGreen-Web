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
                <div class="suspend-info">
                    <div class="container-suspend">
                        <div class="efect-suspend"></div>
                        <div class="border-suspend"></div>
                        <div class="table-list-suspend">
                            <table class="table-suspend">
                                <thead class="head-table-suspend">
                                    <tr class="row-head-suspend">
                                        <th class="colunm-head-suspend" style="width: 25%">
                                            <div class="suspend-id">
                                                <div class="user-suspend-id"> NÚMERO SUSPENSÃO: <div class="suspend-user"><?= htmlspecialchars($suspenso['id_suspenso']) ?></div> </div>
                                            </div>
                                        </th>
                                        <th class="colunm-head-suspend" style="width: 25%" >
                                            <div class="user-suspenso">
                                                <div class="user-suspend"> USUÁRIO SUSPENSO: <div class="suspend-user"><?= htmlspecialchars($suspenso['id_participante_suspenso']) ?></div> </div>
                                            </div>
                                        </th>
                                        <th class="colunm-head-suspend">
                                            <div class="suspenso-motivo">
                                                <div class="motivo-suspend"> MOTIVO: <div class="suspend-motvo"><?= str_replace('_', ' ', htmlspecialchars($suspenso['motivo'])) ?></div> </div>
                                            </div>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="body-table-suspend">
                                    <tr style="height: 25px;"></tr>
                                    <tr class="row-body-suspend">
                                        <td class="colunm-body-suspend" style="width: 25%">
                                            <div class="suspend-inicio">
                                                <div class="inicio_suspensao"> INICIO DA SUSPENSÃO: <div class="start-suspend"><?= htmlspecialchars($suspenso['data_hora_inicio']) ?></div> </div>
                                            </div>
                                        </td>
                                        <td class="colunm-body-suspend" style="width: 25%" >
                                            <div class="suspend-fim">
                                                <div class="fim_suspensao"> FIM DA SUSPENSÃO: <div class="end-suspend"><?= htmlspecialchars($suspenso['data_hora_inicio']) ?></div> </div>
                                            </div>
                                        </td>
                                        <td class="colunm-body-suspend">
                                            <div class="suspend-data">
                                                <button class="analyse-suspend" type="submit" data-id="<?= htmlspecialchars($suspenso['id_suspenso']) ?>"
                                                    onclick="loadPage('/DailyGreen-Project/SCRIPTS/PHP/viewSuspend.php?id='+this.getAttribute('data-id'))">VER SUSPENSÃO</button>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div> <br>
        <?php endforeach; ?>
    </div>
</div>