
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
    function pullAdmName(){
        // pega o nome do administrador no arquivo .json
        $emailAdministrador = $_SESSION['user']['account']['email'];

        // apaga tudo depois do @
        $partsEmail = explode("@", $emailAdministrador);
        $nomeAdministrador = $partsEmail[0];
        echo "Bem-vindo(a), " . $nomeAdministrador . "!";
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/DailyGreen-Project/SCRIPTS/CSS/style_pagina_administrador.css">
    <title>Adm | DailyGreen</title>
</head>
<body>
    <div class="container-admPage">

        <!-- SIDEBAR DA ESQUERDA -->
        <div class="sidebar_esquerda">
            <header class="header_titulo" id="title"></header>
            <div class="usuario_administrador">
                <div class="name_user_adm"><?php echo pullAdmName()?></div>
            </div>
            <div class="btn_menu_navegacao">
                <button class="btn_menu" onclick="showButtons()">MENU DE NAVEGAÇÃO<span class="triangle">&#9660;</span> </button>
                <div class="menu_navegacao" id="menu_navegacao" name="menu_navegacao">
                    <div class="btn-list"> <button onclick="loadPage('/DailyGreen-Project/SCRIPTS/PHP/listButtonsAdm.php')">Página Principal</button> </div>
                    <div class="btn-list"> <button onclick="loadPage('/DailyGreen-Project/SCRIPTS/PHP/listUsers.php')">Lista de Contas</button> </div>
                    <div class="btn-list"> <button onclick="loadPage('/DailyGreen-Project/SCRIPTS/PHP/listReport.php')">Lista de Denuncias</button> </div>
                    <div class="btn-list"> <button onclick="loadPage('/DailyGreen-Project/SCRIPTS/PHP/.php')">Lista de Suspensos</button> </div>
                    <div class="btn-list"> <button onclick="loadPage('/DailyGreen-Project/SCRIPTS/PHP/.php')">Lista de Banidos</button> </div>
                </div>
            </div>
            <div class="logout">
                <button class="btn_logout" id="btn_logout" name="btn_logout" onclick="btnLogout()">LOGOUT</button>
            </div>
        </div>

        <!-- MENU PRINCIPAL -->
        <div class="pagina_principal">
            <header class="header_menu_principal"></header>
            <div class="menu_principal" id="menu_principal" name="menu_principal">
                <div class="button-row">
                    <div class="btn_users_report">
                        <button class="btn-users-list" id="btn-users-list" name="btn-users-list" onclick="loadPage('/DailyGreen-Project/SCRIPTS/PHP/listUsers.php')">Lista de Usuários</button>
                        <button class="btn-report-list" id="btn-report-list" name="btn-report-list" onclick="loadPage('/DailyGreen-Project/SCRIPTS/PHP/listReport.php')">Lista de Denúncias</button>
                    </div>
                </div>
                <div class="button-row">
                    <div class="btn_suspenso_banido">
                        <button class="btn-suspenso-list" id="btn-suspenso-list" name="btn-suspenso-list">Lista de Suspensos</button>
                        <button class="btn-banido-list" id="btn-banido-list" name="btn-banido-list">Lista de Banidos</button>
                    </div>
                </div>
            </div>
        </div>

    </div>
</body>
<script src="/DailyGreen-Project/SCRIPTS/JS/pagina_administrador.js"></script>
</html>
