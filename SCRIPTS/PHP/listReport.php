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
            <div class="report">
                <div class="report-info">
                    <div class="container-report">
                        <div class="efect-report"></div>
                        <div class="border-report"></div>
                        <div class="report-titulo-motivo">
                            <div class="denuncia-titulo">
                                <div class="titulo"> TITULO: <div class="titulo-report"><?= htmlspecialchars($denuncia['titulo']) ?></div> </div>
                            </div>
                            <div class="denuncia-motivo">
                                <div class="motivo"> MOTIVO: <div class="motivo-report"><?= htmlspecialchars($denuncia['motivo']) ?></div> </div>
                            </div>
                        </div>
                        <div class="report-status-data">
                            <div class="denuncia-status">
                                <div class="status"> STATUS: <div class="status-report"><?= htmlspecialchars($denuncia['status']) ?></div> </div>
                            </div>
                            <div class="denuncia-data">
                                <div class="data"> DATA DE REGISTRO: <div class="data-report"><?= htmlspecialchars($denuncia['data_registro']) ?></div> </div>
                            </div>
                        </div>
                        <div class="report-status-data">
                            <div class="button-analyse">
                                <!-- o id da denuncia está setado no onclick em data-id  -->
                                <div class="analyse"> <input type="submit" class="btn-analyse" data-id="<?= htmlspecialchars($denuncia['id_denuncia']) ?>" name="btn-analyse" id="btn-analyse"
                                onclick="loadPage('/DailyGreen-Project/SCRIPTS/PHP/form_analyse_report.php?id='+this.getAttribute('data-id'))" value="ANALISAR"></input> </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>
