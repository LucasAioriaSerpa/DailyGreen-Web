<?php
include_once "/xampp/htdocs/DailyGreen-Project/SCRIPTS/PHP/LOGIC/session.php";
include_once "/xampp/htdocs/DailyGreen-Project/SCRIPTS/PHP/LOGIC/SQL_connection.php";
include_once '/xampp/htdocs/DailyGreen-Project/SCRIPTS/PHP/LOGIC/functions.php';
if (empty($_SESSION['user']['loged']) || $_SESSION['user']['loged'] === false) {
    header('Location: /DailyGreen-Project/SCRIPTS/PHP/MAIN-PAGE.php');
    exit();
}
$id_lista = isset($_SESSION['user']['account'][0]['id_lista']) ? (int) $_SESSION['user']['account'][0]['id_lista'] : null;
if ($id_lista === 1 || $id_lista === 2) {
    $_SESSION['user']['loged'] = false;
    $_SESSION['user']['find'] = null;
    $_SESSION['user']['org'] = null;
    $redirectUrl = $id_lista === 1
        ? '/DailyGreen-Project/SCRIPTS/PHP/bannedAlert.php'
        : '/DailyGreen-Project/SCRIPTS/PHP/timeOutAlert.php';
    header("Location: $redirectUrl");
    exit();
}
$userInfo = $_SESSION['user']['account'];
$sqlConnection = new SQLconnection();
$userArray = $sqlConnection->callTableBD('participante');
if (sizeof($userArray) == 0) {
    $_SESSION['user']['loged'] = false;
    $_SESSION['user']['find'] = null;
    $_SESSION['user']['account'] = null;
    $_SESSION['user']['org'] = null;
    header('Location: /DailyGreen-Project/SCRIPTS/PHP/MAIN-PAGE.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lixeira-inteligente | DailyGreen</title>
    <link rel="icon" type="image/x-icon" href="/DailyGreen-Project/IMAGES/dailyGreen-icon.ico">
    <link rel="stylesheet" href="/DailyGreen-Project/SCRIPTS/CSS/pagina_postagens.css">
    <link rel="stylesheet" href="/DailyGreen-Project/SCRIPTS/CSS/style_lixeira_inteligente.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body>
    <div class="container">
        <!-- //* SIDEBAR ESQUERDA -->
        <div class="sidebar_esquerda">
            <a class="btnlateral" style="text-decoration: none;"
                href="http://localhost/DailyGreen-Project/SCRIPTS/PHP/postagens.php">
                <div class="menu-item">
                    <span><i class="fas fa-home"></i>Página Inicial</span>
                </div>
            </a>
            <?php if ($_SESSION['user']['org'] === true || $_SESSION['user']['org'] === 1): ?>
                <a class="btnlateral" style="text-decoration: none;"
                    href="http://localhost/DailyGreen-Project/SCRIPTS/PHP/lixeira_inteligente.php">
                    <div class="menu-item">
                        <span><i class="fas fa-trash"></i> Lixeira-Inteligente</span>
                    </div>
                </a>
            <?php endif; ?>
            <a class="btnlateral" style="text-decoration: none;"
                href="http://localhost/DailyGreen-Project/SCRIPTS/PHP/pagina_perfil.php">
                <div class="menu-item">
                    <span><i class="fas fa-user"></i> Perfil</span>
                </div>
            </a>
            <div class="area_perfil">
                <div class="menu-item2" onclick="btnLogout()">
                    <div class="user-avatar">
                        <img src="<?php echo str_replace("/xampp/htdocs", "", $userInfo[0]['profile_pic']); ?>"
                            alt="User Avatar" style="width: 50px; height: 50px; border-radius: 50%;">
                    </div>
                    <div style="margin-left: 10px;">
                        <div><?= htmlspecialchars($userInfo[0]['username']) ?></div>
                        <div style="font-size: 0.8rem; color: #71767b;">
                            @<?= htmlspecialchars($userInfo[0]['username']) ?></div>
                    </div>
                    <div id="logoutBtn" class="logout_button">
                        <form action="/DailyGreen-Project/SCRIPTS/PHP/LOGIC/logoutPostagens.php">
                            <button type="submit">LOGOUT</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- CONTEÚDO CENTRAL (PERFIL) -->
        <div class="conteudo_principal">
            <h1>Dashboard da Lixeira Inteligente</h1>
            <div class="connection-container">
                <div class="input-container">
                    <label for="ipInput" class="label-ip">Endereço IP do Sensor:
                        <input type="text" id="ipInput" name="ipInput" placeholder="Ex: 192.168.0.100">
                    </label>
                    <button type="button" id="connectBtn">Conectar</button>
                </div>
            </div>
            <h3>Status da conexão:</h3>
            <div id="status">Aguardando conexão...</div>
            <div class="cards">
                <div class="card">
                    Distância Interna
                    <span id="distanciaInterna">-- cm</span>
                </div>
                <div class="card">
                    Distância Externa
                    <span id="distanciaExterna">-- cm</span>
                </div>
                <div class="card">
                    Pessoas Passaram
                    <span id="pessoasPassaram">--</span>
                </div>
                <div class="card">
                    Peso
                    <span id="peso">-- g</span>
                </div>
                <div class="card">
                    Gás Detectado
                    <span id="gasDetectado">--</span>
                </div>
            </div>
            <div class="charts">
                <div class="chart-container">
                    <canvas id="chartDistancia"></canvas>
                </div>
                <div class="chart-container">
                    <canvas id="chartPeso"></canvas>
                </div>
                <div class="chart-container">
                    <canvas id="chartGas"></canvas>
                </div>
            </div>
        </div>
        <script src="/DailyGreen-Project/SCRIPTS/JS/pagina_postagens.js"></script>
        <script src="/DailyGreen-Project/SCRIPTS/JS/lixeira_inteligente.js"></script>
</body>

</html>