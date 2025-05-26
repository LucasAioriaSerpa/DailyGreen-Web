<?php
    include_once 'LOGIC/session.php';
    include_once 'LOGIC/SQL_connection.php';
    include_once 'LOGIC/functions.php';
    if ($_SESSION['user']['loged'] === false) {
        header("Location: /DailyGreen-Project/SCRIPTS/PHP/loginAdm.php");
        exit();
    }
?>

<div class="all-buttons">
    <div class="button-row">
        <div class="btn_users">
            <button class="btn-users-list" id="btn-users-list" name="btn-users-list"
                onclick="loadPage('/DailyGreen-Project/SCRIPTS/PHP/listUsers.php')">
                <div class="background-card"></div>
                <div class="card-content">
                    <div class="card-title">Lista de Usuários</div>
                </div>
            </button>
        </div>
        <div class="btn_report">
            <button class="btn-report-list" id="btn-report-list" name="btn-report-list"
                onclick="loadPage('/DailyGreen-Project/SCRIPTS/PHP/listReport.php')">
                <div class="background-card"></div>
                <div class="card-content">
                    <div class="card-title">Lista de Denúncias</div>
                </div>
            </button>
        </div>
    </div>
    <div class="button-row">
        <div class="btn_suspenso">
            <button class="btn-suspenso-list" id="btn-suspenso-list" name="btn-suspenso-list"
                onclick="loadPage('/DailyGreen-Project/SCRIPTS/PHP/listSuspend.php')">
                <div class="background-card"></div>
                <div class="card-content">
                    <div class="card-title">Lista de Suspensos</div>
                </div>
            </button>
        </div>
        <div class="btn_banido">
            <button class="btn-banido-list" id="btn-banido-list" name="btn-banido-list"
                onclick="loadPage('/DailyGreen-Project/SCRIPTS/PHP/listBan.php')">
                <div class="background-card"></div>
                <div class="card-content">
                    <div class="card-title">Lista de Banidos</div>
                </div>
            </button>
        </div>
    </div>
</div>