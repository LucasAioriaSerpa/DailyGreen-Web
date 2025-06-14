<?php
    include_once 'LOGIC/session.php';
    include_once 'LOGIC/SQL_connection.php';
    include_once 'LOGIC/functions.php';
    if ($_SESSION['user']['loged'] === false) {
        header("Location: /DailyGreen-Project/SCRIPTS/PHP/loginAdm.php");
        exit();
    }
    $sqlConnection = new SQLconnection();
    $denunciaArray = $sqlConnection->callTableBD('denuncia');
    function statusPriority($status) {
        switch ($status) {
            case 'Pendente': return 1;
            case 'Em Análise': return 2;
            case 'Resolvida': return 3;
            case 'Arquivada': return 4;
        }
    }
    usort($denunciaArray, function ($a, $b) {
        return statusPriority($a['status']) <=> statusPriority($b['status']);
    });
?>

<div class="navegacao_principal">
    <?php if (count($denunciaArray) === 0):?>
        <div class="no-records">
            <div class="icon-lupa">
                <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                <path stroke="currentColor" stroke-linecap="round" stroke-width="2" d="m21 21-3.5-3.5M17 10a7 7 0 1 1-14 0 7 7 0 0 1 14 0Z"/>
                </svg>
            </div>
            <div class="title-no-records"><h4>Ainda não há denúncias registradas!</h4></div>
        </div>
    <?php endif; ?>
    <div class="lista-reports">
        <?php foreach ($denunciaArray as $denuncia): ?>
            <?php 
                $status = $denuncia['status'];
                $status_denuncia = htmlspecialchars($status);
                $statusClass = '';

                switch ($status_denuncia) {
                    case 'Pendente': 
                        $statusClass = 'status-pendente'; 
                        break;
                    case 'Em Análise': 
                        $statusClass = 'status-em-analise'; 
                        break;
                    case 'Resolvida': 
                        $statusClass = 'status-resolvida'; 
                        break;
                    case 'Arquivada': 
                        $statusClass = 'status-arquivada'; 
                        break;
                }
            ?>
            <div class="report">
                <div class="report-info">
                    <div class="container-report">
                        <div class="efect-report"></div>
                        <div class="border-report"></div>
                        <div class="table-list-report">
                            <table class="table-report">
                                <thead class="head-table-report">
                                    <tr class="row-head-report">
                                        <th class="colunm-head-report" style="width: 30%">
                                            <div class="denuncia-id">
                                                <div class="report-id"> ID DENUNCIA: <div class="id-report"><?= htmlspecialchars($denuncia['id_denuncia']) ?></div> </div>
                                            </div>
                                        </th>
                                        <th class="colunm-head-report" style="width: 50%">
                                            <div class="denuncia-titulo">
                                                <div class="titulo"> TITULO: <div class="titulo-report"><?= str_replace('_', ' ', htmlspecialchars($denuncia['titulo'])) ?></div> </div>
                                            </div>
                                        </th>
                                        <th class="colunm-head-report-status">
                                            <div class="denuncia-status">
                                                <div class="status"> <div class="status-report <?= $statusClass ?>"><?= $status_denuncia ?></div> </div>
                                            </div>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="body-table-report">
                                    <tr style="height: 25px;"></tr> 
                                    <tr class="row-body-report">
                                        <td class="colunm-body-report" style="width: 30%">
                                            <div class="denuncia-data">
                                                <?php $report_create_time = new DateTime(htmlspecialchars($denuncia['data_registro'])) ?>
                                                <div class="data"> DATA DE REGISTRO: <div class="data-report"><?= $report_create_time->format('d/m/Y H:i:s') ?></div> </div>
                                            </div>
                                        </td>
                                        <td class="colunm-body-report" style="width: 50%">
                                            <div class="denuncia-motivo">
                                                <div class="motivo"> MOTIVO: <div class="motivo-report"><?= htmlspecialchars($denuncia['motivo']) ?></div> </div>
                                            </div>
                                        </td>
                                        <td class="colunm-body-report">
                                            <div class="button-analyse">
                                                <!-- o id da denuncia está setado no onclick em data-id  -->
                                                <div class="analyse"> <input type="submit" class="btn-analyse" data-id="<?= htmlspecialchars($denuncia['id_denuncia']) ?>" name="btn-analyse" id="btn-analyse"
                                                onclick="loadPage('/DailyGreen-Project/SCRIPTS/PHP/form_analyse_report.php?id='+this.getAttribute('data-id'))" value="ANALISAR"></input> </div>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>
