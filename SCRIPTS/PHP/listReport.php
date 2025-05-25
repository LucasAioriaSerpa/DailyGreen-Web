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
        <div class="no-reports">
            <h4>Ainda não há denúncias registradas!</h4>
        </div>
    <?php endif; ?>
    <div class="lista-reports">
        <?php foreach ($denunciaArray as $denuncia): ?>
            <div class="report">
                <div class="report-info">
                    <div class="container-report">
                        <div class="report-row report-row-titulo-motivo">
                            <div class="denuncia-titulo">
                                <div class="titulo"> Titulo: <div class="titulo-report"><?= htmlspecialchars($denuncia['titulo']) ?></div> </div>
                            </div>
                            <div class="denuncia-motivo">
                                <div class="motivo"> Motivo: <div class="motivo-report"><?= htmlspecialchars($denuncia['motivo']) ?></div> </div>
                            </div>
                            <div class="denuncia-id">
                                <div class="id"> ID: <div class="id-report"><?= htmlspecialchars($denuncia['id_denuncia']) ?></div> </div>
                            </div>
                        </div>
                        <div class="report-row report-row-status-data">
                            <div class="denuncia-status">
                                <div class="status"> Status: <div class="status-report"><?= htmlspecialchars($denuncia['status']) ?></div> </div>
                            </div>
                            <div class="denuncia-data">
                                <div class="status"> Data de Regitro: <div class="data-report"><?= htmlspecialchars($denuncia['data_registro']) ?></div> </div>
                            </div>
                        </div>
                        <div class="button-analyse">
                            <!-- o id da denuncia está setado no onclick em data-id  -->
                            <div class="analyse"> <input type="submit" class="btn-analyse" data-id="<?= htmlspecialchars($denuncia['id_denuncia']) ?>" name="btn-analyse" id="btn-analyse"
                            onclick="loadPage('/DailyGreen-Project/SCRIPTS/PHP/form_analyse_report.php?id='+this.getAttribute('data-id'))" value="ANALISAR"></input> </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>
