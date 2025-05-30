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


?>

<div class="container-banido">
    <?php if (count($banidoArray) === 0):?>
        <div class="no-records">
            <div class="icon-lupa">
                <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                <path stroke="currentColor" stroke-linecap="round" stroke-width="2" d="m21 21-3.5-3.5M17 10a7 7 0 1 1-14 0 7 7 0 0 1 14 0Z"/>
                </svg>
            </div>
            <div class="title-no-records"><h4>Ainda não há usuários banidos!</h4></div>
        </div>
    <?php endif; ?>
    <div class="list-bans">
        <?php foreach ($banidoArray as $banido): ?>
            <div class="suspend-users">
                <div class="suspend-info">
                    <div class="container-ban">
                        <div class="efect-ban"></div>
                        <div class="border-ban"></div>
                        <div class="table-list-ban">
                            <table class="table-ban">
                                <thead class="head-table-ban">
                                    <tr class="row-head-ban">
                                        <th class="colunm-head-ban" style="width: 20%">
                                            <div class="user-banido">
                                                <div class="id-ban"> ID DO BANIMENTO: <div class="ban-user"><?= htmlspecialchars($banido['id_banido']) ?></div> </div>
                                            </div>
                                        </th>
                                        <th class="colunm-head-ban" style="width: 40%">
                                            <div class="user-banido">
                                                <div class="user-ban"> NOME USUÁRIO: <div class="ban-user"><?= htmlspecialchars($banido['id_participante_banido']) ?></div> </div>
                                            </div>
                                        </th>
                                        <th class="colunm-head-ban">
                                            <div class="ban-inicio">
                                                <div class="inicio_ban"> DATA BANIMENTO: <div class="start-ban"><?= htmlspecialchars($banido['create_time']) ?></div> </div>
                                            </div>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr style="height: 25px;"></tr>
                                    <tr>
                                        <td colspan="2">
                                            <div class="ban-motivo" style="width: 100%">
                                                <div class="motivo-ban"> MOTIVO: <div class="ban-motvo"><?= str_replace('_', ' ', htmlspecialchars($banido['motivo'])) ?></div> </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="ban-button">
                                                <button class="analyse-ban" type="submit" data-id="<?= htmlspecialchars($suspenso['id_suspenso']) ?>"
                                                    onclick="loadPage('/DailyGreen-Project/SCRIPTS/PHP/viewBan.php?id='+this.getAttribute('data-id'))">VER BANIMENTO</button>
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