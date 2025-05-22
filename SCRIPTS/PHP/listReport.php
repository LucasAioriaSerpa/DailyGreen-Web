<?php
    include_once 'LOGIC/session.php';
    include_once 'LOGIC/SQL_connection.php';
    include_once 'LOGIC/functions.php';
    if ($_SESSION['user']['loged'] === false) {
        header("Location: /DailyGreen-Project/SCRIPTS/PHP/loginAdm.php");
        exit();
    }
    $sqlConnection = new SQLconnection();
    $admUserName = $sqlConnection->callTableBD('administrador');
    $usersArray = $sqlConnection->callTableBD('participante');
    $denunciaArray = $sqlConnection->callTableBD('denuncia');

?>

<div class="menu_principal">
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
                        <button class="btn-denuncia">
                            <div class="relator"> Relator: <div class="relator-name"><?= htmlspecialchars($denuncia['id_relator']) ?></div> </div>
                            <div class="relatado"> Relatado: <div class="relatado-name"><?= htmlspecialchars($denuncia['id_relatado']) ?></div> </div>
                            <div class="titulo"> Titulo: <div class="titulo-report"><?= htmlspecialchars($denuncia['titulo']) ?></div> </div>
                            <div class="motivo"> Motivo: <div class="motivo-report"><?= htmlspecialchars($denuncia['motivo']) ?></div> </div>
                            <div class="status"> Status: <div class="status-report"><?= htmlspecialchars($denuncia['status']) ?></div> </div>
                            <div class="status"> Data de Regitro: <div class="data-report"><?= htmlspecialchars($denuncia['data_registro']) ?></div> </div>
                        </button>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>