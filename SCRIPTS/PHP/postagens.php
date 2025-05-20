<?php
include_once "/xampp/htdocs/DailyGreen-Project/SCRIPTS/PHP/LOGIC/session.php";
include_once "/xampp/htdocs/DailyGreen-Project/SCRIPTS/PHP/LOGIC/SQL_connection.php";
include_once '/xampp/htdocs/DailyGreen-Project/SCRIPTS/PHP/LOGIC/functions.php';
if ($_SESSION['user']['loged'] === false) {
    header('Location: /DailyGreen-Project/SCRIPTS/PHP/MAIN-PAGE.php');
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
$postsArray = $sqlConnection->callTableBD('post');
$eventArray = $sqlConnection->callTableBD('evento');
$midiaArray = $sqlConnection->callTableBD('midia');
$usersArray = $sqlConnection->callTableBD('participante');
$denunciaArray = $sqlConnection->callTableBD('denuncia');
$_event = null;
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Postagens | DailyGreen</title>
    <link rel="stylesheet" href="/DailyGreen-Project/SCRIPTS/CSS/pagina_postagens.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="/DailyGreen-Project/SCRIPTS/JS/btn_denuncia.js">
</head>
<script src="/DailyGreen-Project/SCRIPTS/JS/org_post_flip.js"></script>
<body>
    <div class="container">
        <!-- //* SIDEBAR ESQUERDA -->
        <div class="sidebar_esquerda">

            <div class="menu-item">
                <i class="fas fa-home"></i>
                <span>Página Inicial</span>   
            </div>
            <div class="menu-item">
                
                <span><a href="http://localhost/DailyGreen-Project/SCRIPTS/PHP/pagina_perfil.php"><i class="fas fa-user"></i>Perfil</a></span>
                  
            </div>


            


            <div class="area_perfil">
                <div class="menu-item" onclick="btnLogout()">
                    <div class="user-avatar">
                        <img src="<?php echo str_replace("/xampp/htdocs", "", $userInfo[0]['profile_pic']); ?>" alt="User Avatar"
                            style="width: 50px; height: 50px; border-radius: 50%;">
                    </div>
                    <div style="margin-left: 10px;">
                        <div><?php echo $userInfo[0]['username'] ?></div>
                        <div style="font-size: 0.8rem; color: #71767b;">@<?php echo $userInfo[0]['username']; ?></div>
                    </div>
                    <div id="logoutBtn" class="logout_button">
                        <form action="/DailyGreen-Project/SCRIPTS/PHP/LOGIC/logoutPostagens.php">
                            <button type="submit">LOGOUT</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- //* CONTEÚDO CENTRAL (FEED) -->
        <!-- //?  INPUT: POST / EVENTO   -->
        <div class="conteudo_principal">
            <div class="feed-header">Para você</div>

            <div class="caixa_postagem">
                <div class="caixa_postagem-header">

                    <div class="caixa_postagem-avatar">
                        <img src="<?php echo str_replace("/xampp/htdocs", "", $userInfo[0]['profile_pic']); ?>" alt="User Avatar"
                            style="width: 50px; height: 50px; border-radius: 50%;">
                    </div>

                    <div class="caixa_postagem-input">
                        <?php
                        if ($_SESSION['user']['org'] === true || $_SESSION['user']['org'] === 1) {
                            echo "
                            <div class='btns-typePost'>
                                <button class='btn-postMode' onclick='updateOrgSession(1)'>POST</button>
                                <button class='btn-eventMode' onclick='updateOrgSession(true)'>EVENTO</button>
                            </div>";
                            if ($_SESSION['user']['org'] === 1) {
                                include_once '/xampp/htdocs/DailyGreen-Project/SCRIPTS/HTML/form_post.html';
                            }
                            if ($_SESSION['user']['org'] === true) {
                                include_once '/xampp/htdocs/DailyGreen-Project/SCRIPTS/HTML/form_event.html';
                            }
                        } else {
                            include_once '/xampp/htdocs/DailyGreen-Project/SCRIPTS/HTML/form_post.html';
                        } ?>
                    </div>

                </div>

            </div>

            <!-- //* POST EXEMPLO 1 -->
            <!-- //? Filters post and events. only POSTs pass thourth -->
            <?php foreach (array_reverse($postsArray) as $post): ?>
                <?php foreach ($eventArray as $evento): if ($evento['id_post'] == $post['id_post']): $_event = true; endif; endforeach;?>
                <?php if ($_event): $_event = false; continue; endif; ?>
                <div class="post">
                    <div class="post-user">
                        <div class="user-avatar">
                            <button class="btn-user-img" id="btn-user-img" name="btn-user-img" onclick="btnDenuncia(this)">
                                <img src="<?= str_replace("/xampp/htdocs", "", htmlspecialchars($usersArray[((int) $post["id_autor"]) - 1]['profile_pic'])) ?>"
                                alt="Avatar" style="width: 50px; height: 50px; border-radius: 50%;">
                            </button>
                            <button class="btn-denuncia" id="btn-denuncia" name="btn-denuncia">
                                <span class="alert-icon">⚠️</span>Denunciar
                            </button>
                        </div>
                        <div style="margin-left: 10px;">
                            <div>
                                <strong><?= htmlspecialchars($usersArray[((int) $post["id_autor"]) - 1]['username']) ?></strong>
                            </div>
                            <div style="color: #71767b;">
                                @<?= htmlspecialchars($usersArray[((int) $post["id_autor"]) - 1]['username']) ?></div>
                        </div>
                    </div>
                    <div class="post-titulo">
                        <h1><?= htmlspecialchars($post['titulo']) ?></h1>
                    </div>
                    <div class="post-content">
                        <?= nl2br(htmlspecialchars($post['descricao'])) ?>
                    </div>
                    <div class="post-midia">
                        <div class="column-midia">
                            <?php
                            $postMidias = [];
                            foreach ($midiaArray as $midia) {
                                if ($midia['id_post'] == $post['id_post']) {
                                    $postMidias[] = $midia;
                                }
                            }
                            $imgCount = count($postMidias);
                            foreach ($postMidias as $idx => $midia):
                            ?>
                                <img
                                    src="<?= str_replace("/xampp/htdocs", "", htmlspecialchars($midia['midia_ref'])) ?>"
                                    alt="Post Image"
                                    class="post-img img-count-<?= $imgCount ?>"
                                    onclick="openModal(this.src)"
                                >
                            <?php endforeach; ?>
                        </div>
                    </div>
                    <!-- Modal para ampliar imagem -->
                    <div id="imgModal" class="img-modal" onclick="closeModal()">
                        <span class="img-modal-close" onclick="closeModal(event)">&times;</span>
                        <img class="img-modal-content" id="imgModalContent">
                    </div>
                </div>
            <?php endforeach; ?>

        </div>

        <!-- //* SIDEBAR DIREITA -->
        <div class="sidebar_direita">
            <div class="barra_pesquisa">
                <i class="fas fa-search"></i>
                <input type="text" placeholder="Pesquisar">
            </div>

            <div class="eventos_anuncio">
            <?php foreach (array_reverse($postsArray) as $post): ?>
                    <?php
                    // ? Verifica se o post tem um evento associado
                    $hasEvent = false;
                    foreach ($eventArray as $evento) {
                        if ($evento['id_post'] == $post['id_post']) {
                            $hasEvent = true;
                            break;
                        }
                    }
                    ?>
                    <?php if ($hasEvent): ?> <!-- //? Exibe apenas posts com evento  -->
                        <div class="post">
                            <div class="post-user">
                                <div class="user-avatar">
                                    <img src="<?= str_replace("/xampp/htdocs", "", htmlspecialchars($usersArray[((int) $post["id_autor"]) - 1]['profile_pic'])) ?>"
                                        alt="Avatar" style="width: 50px; height: 50px; border-radius: 50%;">
                                </div>
                                <div style="margin-left: 10px;">
                                    <div>
                                        <strong><?= htmlspecialchars($usersArray[((int) $post["id_autor"]) - 1]['username']) ?></strong>
                                    </div>
                                    <div style="color: #71767b;">
                                        @<?= htmlspecialchars($usersArray[((int) $post["id_autor"]) - 1]['username']) ?></div>
                                </div>
                            </div>
                            <div class="post-titulo">
                                <h1><?= htmlspecialchars($post['titulo']) ?></h1>
                            </div>
                            <div class="post-content">
                                <?= nl2br(htmlspecialchars($post['descricao'])) ?>
                            </div>
                            <div class="event-post">
                                <?php foreach ($eventArray as $evento): ?>
                                    <?php if ($evento['id_post'] == $post['id_post']): ?>
                                        <div class="dateTime">
                                            <div class="dateTime-inicio">Inicio: <?php echo $evento['data_hora_inicio'] ?></div>
                                            <div class="dateTime-fim">Fim: <?php echo $evento['data_hora_fim'] ?></div>
                                        </div>
                                        <div class="local">Local: <?php echo $evento['local'] ?></div>
                                        <div class="link">Link: <?php echo "<a href='https://{$evento["link"]}'>{$evento['link']}</a>" ?></div>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </div>
                            <div class="post-midia">
                                <div class="column-midia">
                                    <?php
                                    $postMidias = [];
                                    foreach ($midiaArray as $midia) {
                                        if ($midia['id_post'] == $post['id_post']) {
                                            $postMidias[] = $midia;
                                        }
                                    }
                                    $imgCount = count($postMidias);
                                    foreach ($postMidias as $idx => $midia):
                                    ?>
                                        <img
                                            src="<?= str_replace("/xampp/htdocs", "", htmlspecialchars($midia['midia_ref'])) ?>"
                                            alt="Post Image"
                                            class="post-img img-count-<?= $imgCount ?>"
                                            onclick="openModal(this.src)"
                                        >
                                    <?php endforeach; ?>
                                </div>
                            </div>
                            <!-- Modal para ampliar imagem -->
                            <div id="imgModal" class="img-modal" onclick="closeModal()">
                                <span class="img-modal-close" onclick="closeModal(event)">&times;</span>
                                <img class="img-modal-content" id="imgModalContent">
                            </div>
                        </div>
                    <?php endif; ?>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
    </div>
</body>
<script src="/DailyGreen-Project/SCRIPTS/JS/pagina_postagens.js"></script>
</html>