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
                                                <div class="user-suspend-id"> ID SUSPENSÃO: <div class="suspend-user"><?= htmlspecialchars($suspenso['id_suspenso']) ?></div> </div>
                                            </div>
                                        </th>
                                        <th class="colunm-head-suspend" style="width: 25%" >
                                            <div class="user-suspenso">
                                                <?php $id_suspenso = htmlspecialchars($suspenso['id_participante_suspenso']) ?>
                                                <?php $join = "SELECT suspenso.*, participante.username AS username_suspenso
                                                    FROM suspenso JOIN participante ON suspenso.id_participante_suspenso = participante.id_participante
                                                    WHERE suspenso.id_participante_suspenso = {$id_suspenso};";
                                                    $joinQuery = $sqlConnection->joinQueryBD($join);
                                                    if ($joinQuery && count($joinQuery) > 0){
                                                        $participante_suspenso = $joinQuery[0]['username_suspenso'];
                                                    }
                                                ?>
                                                <div class="user-suspend"> NOME USUÁRIO: <div class="suspend-user"><?= $participante_suspenso ?></div> </div>
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
                                                <?php $data_inicio = new DateTime(htmlspecialchars($suspenso['data_hora_inicio'])) ?>
                                                <div class="inicio_suspensao"> INICIO DA SUSPENSÃO: <div class="start-suspend"><?= $data_inicio->format('d/m/Y H:i:s') ?></div> </div>
                                            </div>
                                        </td>
                                        <td class="colunm-body-suspend" style="width: 25%" >
                                            <div class="suspend-fim">
                                                <?php $data_fim = new DateTime(htmlspecialchars($suspenso['data_hora_inicio'])) ?>
                                                <div class="fim_suspensao"> FIM DA SUSPENSÃO: <div class="end-suspend"><?= $data_fim->format('d/m/Y H:i:s') ?></div> </div>
                                            </div>
                                        </td>
                                        <td class="colunm-body-suspend">
                                            <div class="suspend-data">
                                                <button class="analyse-suspend" type="submit" data-id="<?= htmlspecialchars($suspenso['id_denuncia']) ?>"
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
