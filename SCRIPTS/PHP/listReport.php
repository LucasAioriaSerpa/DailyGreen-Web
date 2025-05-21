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
        <div class="lista-usuarios">
            <?php foreach ($denunciaArray as $denuncia): ?>
                <div class="user">
                    <div class="user-info">
                        <div class="username"> Relator: <div class="user-name"><?= htmlspecialchars($denuncia['id_relator']) ?></div> </div>
                        <div class="username"> Relatado: <div class="user-name"><?= htmlspecialchars($denuncia['id_relatado']) ?></div> </div>
                        <div class="username"> Titulo: <div class="user-name"><?= htmlspecialchars($denuncia['titulo']) ?></div> </div>
                        <div class="email"> Motivo: <div class="user-email"><?= htmlspecialchars($denuncia['motivo']) ?></div> </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>