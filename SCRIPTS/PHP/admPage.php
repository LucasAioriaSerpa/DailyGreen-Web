
<?php
    include_once '/xampp/htdocs/DailyGreen-Project/SCRIPTS/PHP/LOGIC/SQL_connection.php';
    $sqlConnection = new SQLconnection();
    $admUserName = $sqlConnection->callTableBD('administrador',true);
    
    function pullAdmName(){
        // pega o nome do administrador no arquivo .json
        $data = json_decode(file_get_contents("/xampp/htdocs/DailyGreen-Project/JSON/cad_log_adm.json"), true);
        $emailAdministrador = $data["email"];

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

            <header class="header_titulo">
                <h2>DAILYGREEN</h2>
            </header>

            <div class="usuario_administrador">
                <div class="p_usuario_administrador"><?php echo pullAdmName()?></div>
            </div>

            <div class="titulo_menu_navegacao">
                <p>MENU DE NAVEGAÇÃO</p>
            </div>

            <div class="menu_navegacao">
                test
            </div>

            <div class="logout">
                <button class="btn_logout" id="btn_logout" name="btn_logout" onclick="btnLogout()">LOGOUT</button>
            </div>

        </div>

        <!-- MENU PRINCIPAL -->
        <div class="menu_principal">

            <header class="header_menu_principal">
                test
            </header>

            <div class="navegacao_principal">

            </div>
            
        </div>

    </div>
</body>
<script src="/DailyGreen-Project/SCRIPTS/JS/pagina_administrador.js"></script>
</html>
