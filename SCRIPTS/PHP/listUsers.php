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
?>

<div class="menu_principal">
    <div class="navegacao_principal">
        <div class="lista-usuarios">
            <?php foreach ($usersArray as $user): ?>
                <div class="user">
                    <div class="user-avatar">
                        <img src="<?= str_replace("/xampp/htdocs", "", htmlspecialchars($user['profile_pic'])) ?>"
                            alt="Avatar" style="width: 100px; height: 100px; border-radius: 50%;">
                    </div>
                    <div class="user-info">
                        <div class="username"> Username: <div class="user-name"><?= htmlspecialchars($user['username']) ?></div> </div>
                        <div class="email"> Email: <div class="user-email"><?= htmlspecialchars($user['email']) ?></div> </div>
                        <div class="create-time"> Creation time: <div class="user-creation-time"><?= htmlspecialchars($user['create_time']) ?></div> </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>