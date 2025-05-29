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


<div class="navegacao_principal">
    <?php if (count($usersArray) === 0):?>
        <div class="no-records">
            <div class="icon-lupa">
                <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                <path stroke="currentColor" stroke-linecap="round" stroke-width="2" d="m21 21-3.5-3.5M17 10a7 7 0 1 1-14 0 7 7 0 0 1 14 0Z"/>
                </svg>
            </div>
            <div class="title-no-records"><h4>Ainda não há participantes cadastrados!</h4></div>
        </div>
    <?php endif; ?>
    <div class="lista-usuarios">
        <?php foreach ($usersArray as $user): ?>
            <div class="user">
                <div class="user-info">
                    <div class="container-user">
                        <div class="efect-user"></div>
                        <div class="border-user"></div>
                        <div class="user-info">
                            <div class="user-img">
                                <div class="user-avatar">
                                    <img src="<?= str_replace("/xampp/htdocs", "", htmlspecialchars($user['profile_pic'])) ?>"
                                    alt="Avatar" style="width: 100px; height: 100px; border-radius: 50%;">
                                </div>
                            </div>
                            <div class="dados-user">
                                <div class="username"> Username: <div class="user-name"><?= htmlspecialchars($user['username']) ?></div> </div>
                                <div class="email"> Email: <div class="user-email"><?= htmlspecialchars($user['email']) ?></div> </div>
                                <div class="create-time"> Creation time: <div class="user-creation-time"><?= htmlspecialchars($user['create_time']) ?></div> </div>
                            </div>
                        </div>
                        <div class=btn-show-post>
                            <div class="show-user-posts">
                                <button class="show-perfil" type="submit" data-id="<?= htmlspecialchars($user['id_participante']) ?>"
                                    onclick="loadPage('/DailyGreen-Project/SCRIPTS/PHP/userPostPageForAdm.php?id='+this.getAttribute('data-id'))">VER PERFIL
                                    <div class="arrow">
                                        <svg height="24" width="24" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M0 0h24v24H0z" fill="none"></path>
                                        <path d="M16.172 11l-5.364-5.364 1.414-1.414L20 12l-7.778 7.778-1.414-1.414L16.172 13H4v-2z"fill="currentColor"></path>
                                        </svg>
                                    </div>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>