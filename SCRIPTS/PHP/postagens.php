<?php
include_once "/xampp/htdocs/DailyGreen-Project/SCRIPTS/PHP/LOGIC/session.php";
include_once "/xampp/htdocs/DailyGreen-Project/SCRIPTS/PHP/LOGIC/SQL_connection.php";
include_once '/xampp/htdocs/DailyGreen-Project/SCRIPTS/PHP/LOGIC/functions.php';
if (empty($_SESSION['user']['loged']) || $_SESSION['user']['loged'] === false) {
    header('Location: /DailyGreen-Project/SCRIPTS/PHP/MAIN-PAGE.php');
    exit();
}
$id_lista = isset($_SESSION['user']['account'][0]['id_lista']) ? (int)$_SESSION['user']['account'][0]['id_lista'] : null;
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
$postsArray = $sqlConnection->callTableBD('post');
$eventArray = $sqlConnection->callTableBD('evento');
$midiaArray = $sqlConnection->callTableBD('midia');
$checkListArray = $sqlConnection->callTableBD('checklist');
$comentarioArray = $sqlConnection->callTableBD('comentario');
$usersArray = $sqlConnection->callTableBD('participante');
$denunciaArray = $sqlConnection->callTableBD('denuncia');
$reactionPostArray = $sqlConnection->callTableBD('reacaopost');
$reactionCommentArray = $sqlConnection->callTableBD('reacaocomentario');
$_event = null;
function getPostReactions($Id, $reactionArray, $type) {
    $reactions = [
        'gostei' => 0,
        'parabens' => 0,
        'apoio' => 0,
        'amei' => 0,
        'genial' => 0
    ];
    foreach ($reactionArray as $reaction) {
        if ($reaction["id_reacao{$type}"] == $Id) {
            $reactions[$reaction['reaction']]++;
        }
    }
    return $reactions;
}

?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Postagens | DailyGreen</title>
    <link rel="icon" type="image/x-icon" href="/DailyGreen-Project/IMAGES/dailyGreen-icon.ico">
    <link rel="stylesheet" href="/DailyGreen-Project/SCRIPTS/CSS/pagina_postagens.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<script src="/DailyGreen-Project/SCRIPTS/JS/org_post_flip.js"></script>
<body>
    <div class="container">
        <!-- //* SIDEBAR ESQUERDA -->
        <div class="sidebar_esquerda">
            <a class="btnlateral" style="text-decoration: none;" href="http://localhost/DailyGreen-Project/SCRIPTS/PHP/postagens.php">
                <div class="menu-item">
                    <span><i class="fas fa-home"></i>Página Inicial</span>
                </div>
            </a>
            <?php if ($_SESSION['user']['org'] === true || $_SESSION['user']['org'] === 1): ?>
            <a class="btnlateral" style="text-decoration: none;" href="http://localhost/DailyGreen-Project/SCRIPTS/PHP/lixeira_inteligente.php">
                <div class="menu-item">
                    <span><i class="fas fa-trash"></i> Lixeira-Inteligente</span>
                </div>
            </a>
            <?php endif; ?>
            <a class="btnlateral" id="btn-perfil" style="text-decoration: none;" href="http://localhost/DailyGreen-Project/SCRIPTS/PHP/pagina_perfil.php">
                <div class="menu-item">
                    <span><i class="fas fa-user"></i> Perfil</span>
                </div>
            </a>
            <div class="area_perfil">
                <div class="menu-item2" onclick="btnLogout()">
                    <div class="user-avatar">
                        <img src="<?php echo str_replace("/xampp/htdocs", "", $userInfo[0]['profile_pic']); ?>" alt="User Avatar"
                            style="width: 50px; height: 50px; border-radius: 50%;">
                    </div>
                    <div style="margin-left: 10px;">
                        <div><?= htmlspecialchars($userInfo[0]['username']) ?></div>
                        <div style="font-size: 0.8rem; color: #71767b;">@<?= htmlspecialchars($userInfo[0]['username']) ?></div>
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
                <div class="post-divider" id="postDivider">
                    <article class="post" id="post-<?= htmlspecialchars($post['id_post']) ?>" onclick="openPostModal(this, event, 'post')">
                        <div class="post-user">
                            <div class="user-avatar">
                                <button class="btn-user-img" id="btn-user-img" name="btn-user-img" onclick="btnDenuncia(this)">
                                    <img src="<?= str_replace("/xampp/htdocs", "", htmlspecialchars($usersArray[((int) $post["id_autor"]) - 1]['profile_pic'])) ?>"
                                    alt="Avatar" style="width: 50px; height: 50px; border-radius: 50%;">
                                </button>
                                <?php if($userInfo[0]['id_participante'] != ($post['id_autor'])): ?>
                                <button class="btn-denuncia" onclick="formDenuncia(this)">
                                    <span class="alert-icon">⚠️</span><p>Denunciar</p>
                                </button>
                                <?php endif; ?>
                            </div>
                            <?php if($userInfo[0]['id_participante'] != ($post['id_autor'])): ?>
                            <div class="formulario-denuncia" id="formulario-denuncia" name="formulario-denuncia" id="formulario-denuncia-<?= $post['id_post'] ?>
                            style="display: none;>
                                <?php include "/xampp/htdocs/DailyGreen-Project/SCRIPTS/HTML/form_denuncia.html"; ?>
                            </div>
                            <?php endif; ?>
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
                            <?php
                            if (isset($post['descricao'])) {
                                $descricao = htmlspecialchars($post['descricao']);
                                echo nl2br(wordwrap($descricao, 80, "\n", true));
                            }
                            ?>
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
                                foreach ($postMidias as $idx => $midia) {
                                    ?>
                                        <img
                                            src="<?= str_replace("/xampp/htdocs", "", htmlspecialchars($midia['midia_ref'])) ?>"
                                            alt="post img"
                                            class="post-img img-count-<?= $imgCount ?>"
                                            onclick="openMidiaModal(this.src)"
                                        >
                                    <?php } ?>
                            </div>
                        </div>
                        <!-- Modal para ampliar imagem -->
                        <button id="imgModal" class="img-modal" onclick="closeMidiaModal()">
                            <span class="img-modal-close"> &times;</span>
                            <img class="img-modal-content" id="imgModalContent" alt="modal">
                        </button>
                        <div class="post-footer">
                            <div class="reaction-wrapper">
                                <button class="btn-content-footer btn-reaction-toggle" title="Reaja neste post!" onclick="toggleReact(this)">
                                    <i class="fa-solid fa-heart"> <p>Reações</p></i>
                                </button>
                                <div class="react-container">
                                    <?php $reactions = getPostReactions($post['id_post'], $reactionPostArray, 'Post'); ?>
                                    <form class="form-reaction" id="forms_reaction" action="/DailyGreen-Project/SCRIPTS/PHP/LOGIC/send_reaction.php" method="post">
                                        <input type="hidden" name="id_post" value="<?= htmlspecialchars($post['id_post']) ?>">
                                        <!-- //? GOSTEI -->
                                        <div class="reaction-pair-elements gostei">
                                            <button type="submit" name="reaction-gostei" value="<?=htmlspecialchars($userInfo[0]['id_participante'])?>-gostei"
                                                class="btn-reaction" title="gostei">
                                                <span class="box-icon-reaction"><i class="icon-reaction fa-solid fa-thumbs-up"></i></span>
                                            </button>
                                        </div>
                                        <div class="reaction-num"><?php echo $reactions['gostei']; ?></div>
                                        <!-- //? PARABENS -->
                                        <div class="reaction-pair-elements parabens">
                                            <button type="submit" name="reaction-parabens" value="<?=htmlspecialchars($userInfo[0]['id_participante'])?>-parabens"
                                                class="btn-reaction" title="parabéns">
                                                <span class="box-icon-reaction"><i class="icon-reaction fa-solid fa-hands-clapping"></i></span>
                                            </button>
                                        </div>
                                        <div class="reaction-num"><?php echo $reactions['parabens']; ?></div>
                                        <!-- //? APOIO -->
                                        <div class="reaction-pair-elements apoio">
                                            <button type="submit" name="reaction-apoio" value="<?=htmlspecialchars($userInfo[0]['id_participante'])?>-apoio"
                                                class="btn-reaction" title="apoio">
                                                <span class="box-icon-reaction"><i class="icon-reaction fa-solid fa-handshake"></i></span>
                                            </button>
                                        </div>
                                        <div class="reaction-num"><?php echo $reactions['apoio']; ?></div>
                                        <!-- //? AMEI -->
                                        <div class="reaction-pair-elements amei">
                                            <button type="submit" name="reaction-amei" value="<?=htmlspecialchars($userInfo[0]['id_participante'])?>-amei"
                                                class="btn-reaction" title="amei">
                                                <span class="box-icon-reaction"><i class="icon-reaction fa-solid fa-heart"></i></span>
                                            </button>
                                        </div>
                                        <div class="reaction-num"><?php echo $reactions['amei']; ?></div>
                                        <!-- //? GENIAL -->
                                        <div class="reaction-pair-elements genial">
                                            <button type="submit" name="reaction-genial" value="<?=htmlspecialchars($userInfo[0]['id_participante'])?>-genial"
                                                class="btn-reaction" title="genial">
                                                <span class="box-icon-reaction" style="color: #51291E;"><i class="icon-reaction fa-solid fa-lightbulb"></i></span>
                                            </button>
                                        </div>
                                        <div class="reaction-num"><?php echo $reactions['genial']; ?></div>
                                    </form>
                                </div>
                            </div>
                            <div class="comment-wrapper">
                                <button id="btnComment" class="btn-content-footer btn-comment-toggle" title="Comente neste post!" onclick="toggleComment(this)">
                                    <?php $countComment = 0; foreach($comentarioArray as $comment) { if ($comment['id_post'] === $post['id_post']) { $countComment += 1; } } ?>
                                    <i class="fa-solid fa-comment"><p>Comente</p><?php if ($countComment != 0) { echo $countComment; } ?>  </i>
                                </button>
                                <div class="comment-modal-content">
                                    <div class="comment-content">
                                        <button id="btn_exit_modal_comment" onclick="closeCommentModal(event)">X</button>
                                        <div class="post-comment">
                                            <div class="post-user">
                                                <div class="user-avatar">
                                                    <div class="btn-user-img" id="btn-user-img" name="btn-user-img" style="cursor: auto;">
                                                        <img src="<?= str_replace("/xampp/htdocs", "", htmlspecialchars($usersArray[((int) $post["id_autor"]) - 1]['profile_pic'])) ?>"
                                                        alt="Avatar" style="width: 50px; height: 50px; border-radius: 50%;">
                                                    </div>
                                                </div>
                                                <?php if($userInfo[0]['id_participante'] != ($post['id_autor'])): ?>
                                                <div class="formulario-denuncia" id="formulario-denuncia" name="formulario-denuncia">
                                                    <?php include "/xampp/htdocs/DailyGreen-Project/SCRIPTS/HTML/form_denuncia.html"; ?>
                                                </div>
                                                <?php endif; ?>
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
                                        </div>
                                        <div class="comment-container">
                                            <div class="user-avatar avatar-info-comment">
                                                <img src="<?php echo str_replace("/xampp/htdocs", "", $userInfo[0]['profile_pic']); ?>" alt="User Avatar"
                                                    style="width: 50px; height: 50px; border-radius: 50%;">
                                                <div style="margin-left: 1vh;">
                                                    <div><?php echo $userInfo[0]['username'] ?></div>
                                                    <div style="font-size: 0.8rem; color: #71767b;">@<?php echo $userInfo[0]['username']; ?></div>
                                                </div>
                                            </div>
                                            <form action="/DailyGreen-Project/SCRIPTS/PHP/logic/send_comment.php" class="form-comment" method="post">
                                                <input type="hidden" name="id_post" value="<?= htmlspecialchars($post['id_post']) ?>">
                                                <input type="hidden" name="id_autor" value="<?= htmlspecialchars($post['id_autor']) ?>">
                                                <input type="hidden" name="id_autor_comment" value="<?= htmlspecialchars($userInfo[0]['id_participante']) ?>">
                                                <input type="text" id="comment_title" name="comment-title" placeholder="título do comentário.." required>
                                                <textarea id="comment_text" name="comment-text" placeholder="comentario.." required></textarea>
                                                <button type="submit" name="comment-post">Comentar</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </article>
                    <!-- //! MODAL POST -->
                    <article class="post-modal" id="postModal" style="display: none;">
                        <div class="post-modal-header">
                            <button class="bnt-close-post-modal" onclick="closePostModal(this, 'post')">X</button>
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
                                        @<?= htmlspecialchars($usersArray[((int) $post["id_autor"]) - 1]['username']) ?>
                                    </div>
                                </div>
                            </div>
                            <div class="post-titulo">
                                <h1><?= htmlspecialchars($post['titulo']) ?></h1>
                            </div>
                            <div class="post-content">
                                <?php
                                if (isset($post['descricao'])) {
                                    $descricao = htmlspecialchars($post['descricao']);
                                    echo nl2br(wordwrap($descricao, 80, "\n", true));
                                }
                                ?>
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
                                    foreach ($postMidias as $idx => $midia) {
                                    ?>
                                        <img
                                            src="<?= str_replace("/xampp/htdocs", "", htmlspecialchars($midia['midia_ref'])) ?>"
                                            alt="post img"
                                            class="post-img img-count-<?= $imgCount ?>"
                                            style="cursor: auto; width: 18%;"
                                        >
                                    <?php } ?>
                                </div>
                            </div>
                            </button>
                            <?php if ($countComment === 0): ?>
                                <div class="box-comments-none">
                                    <h1>Não possui comentarios!</h1>
                                </div>
                            <?php else: ?>
                            <div class="box-comments">
                                    <div class="post-comments">
                                    <?php foreach($comentarioArray as $comment): ?>
                                        <?php if ($comment['id_post'] === $post['id_post']): ?>
                                            <div class="comment">
                                                <div class="account-part-comment">
                                                    <div class="avatar-comment">
                                                        <img src="<?= str_replace("/xampp/htdocs", "", htmlspecialchars($userArray[((int) $comment['id_autor_comentario'] - 1)]['profile_pic'])) ?>"
                                                        alt="Avatar_autor_comentario" style="width: 50px; height: 50px; border-radius: 50%;">
                                                    </div>
                                                    <div class="usarname-autor-comment">
                                                        <div>
                                                            <strong><?= htmlspecialchars($userArray[((int) $comment['id_autor_comentario']-1)]['username']) ?></strong>
                                                        </div>
                                                        <div style="color: #71767b;">
                                                            @<?= htmlspecialchars($userArray[((int) $comment['id_autor_comentario']-1)]['username']) ?>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="content-part-comment">
                                                    <div class="title-part-comment">
                                                        <h1><?= htmlspecialchars($comment['titulo_comentario']) ?></h1>
                                                    </div>
                                                    <div class="description-part-comment">
                                                        <?= htmlspecialchars($comment['descricao_comentario']) ?>
                                                    </div>
                                                </div>
                                                <div class="footer-comment">
                                                    <div class="reaction-wrapper">
                                                        <button class="btn-content-footer btn-reaction-toggle" title="Reaja neste post!" onclick="toggleReact(this)">
                                                            <i class="fa-solid fa-heart"> <p>Reaja</p></i>
                                                        </button>
                                                        <div class="react-container">
                                                            <?php $reactions = getPostReactions($comment['id_comentario'], $reactionCommentArray, 'Comentario'); ?>
                                                            <form class="form-reaction" id="forms_reaction_comment" action="/DailyGreen-Project/SCRIPTS/PHP/LOGIC/send_reaction.php" method="post">
                                                                <input type="hidden" name="id_comentario" value="<?= htmlspecialchars($comment['id_comentario']) ?>">
                                                                <!-- //? GOSTEI -->
                                                                <div class="reaction-pair-elements gostei">
                                                                    <button type="submit" name="reaction-gostei" value="<?=htmlspecialchars($userInfo[0]['id_participante'])?>-gostei"
                                                                        class="btn-reaction" title="gostei">
                                                                        <span class="box-icon-reaction"><i class="icon-reaction fa-solid fa-thumbs-up"></i></span>
                                                                    </button>
                                                                </div>
                                                                <div class="reaction-num"><?php echo $reactions['gostei']; ?></div>
                                                                <!-- //? PARABENS -->
                                                                <div class="reaction-pair-elements parabens">
                                                                    <button type="submit" name="reaction-parabens" value="<?=htmlspecialchars($userInfo[0]['id_participante'])?>-parabens"
                                                                        class="btn-reaction" title="parabéns">
                                                                        <span class="box-icon-reaction"><i class="icon-reaction fa-solid fa-hands-clapping"></i></span>
                                                                    </button>
                                                                </div>
                                                                <div class="reaction-num"><?php echo $reactions['parabens']; ?></div>
                                                                <!-- //? APOIO -->
                                                                <div class="reaction-pair-elements apoio">
                                                                    <button type="submit" name="reaction-apoio" value="<?=htmlspecialchars($userInfo[0]['id_participante'])?>-apoio"
                                                                        class="btn-reaction" title="apoio">
                                                                        <span class="box-icon-reaction"><i class="icon-reaction fa-solid fa-handshake"></i></span>
                                                                    </button>
                                                                </div>
                                                                <div class="reaction-num"><?php echo $reactions['apoio']; ?></div>
                                                                <!-- //? AMEI -->
                                                                <div class="reaction-pair-elements amei">
                                                                    <button type="submit" name="reaction-amei" value="<?=htmlspecialchars($userInfo[0]['id_participante'])?>-amei"
                                                                        class="btn-reaction" title="amei">
                                                                        <span class="box-icon-reaction"><i class="icon-reaction fa-solid fa-heart"></i></span>
                                                                    </button>
                                                                </div>
                                                                <div class="reaction-num"><?php echo $reactions['amei']; ?></div>
                                                                <!-- //? GENIAL -->
                                                                <div class="reaction-pair-elements genial">
                                                                    <button type="submit" name="reaction-genial" value="<?=htmlspecialchars($userInfo[0]['id_participante'])?>-genial"
                                                                        class="btn-reaction" title="genial">
                                                                        <span class="box-icon-reaction" style="color: #51291E;"><i class="icon-reaction fa-solid fa-lightbulb"></i></span>
                                                                    </button>
                                                                </div>
                                                                <div class="reaction-num"><?php echo $reactions['genial']; ?></div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                            <?php endif; ?>
                            <div class="post-footer">
                                <div class="reaction-wrapper">
                                    <button class="btn-content-footer btn-reaction-toggle" title="Reaja neste post!" onclick="toggleReact(this)">
                                        <i class="fa-solid fa-heart"> <p>Reaja</p></i>
                                    </button>
                                    <div class="react-container">
                                        <?php $reactions = getPostReactions($post['id_post'], $reactionPostArray, 'Post'); ?>
                                        <form class="form-reaction" id="forms_reaction" action="/DailyGreen-Project/SCRIPTS/PHP/LOGIC/send_reaction.php" method="post">
                                            <input type="hidden" name="id_post" value="<?= htmlspecialchars($post['id_post']) ?>">
                                            <!-- //? GOSTEI -->
                                            <div class="reaction-pair-elements gostei">
                                                <button type="submit" name="reaction-gostei" value="<?=htmlspecialchars($userInfo[0]['id_participante'])?>-gostei"
                                                    class="btn-reaction" title="gostei">
                                                    <span class="box-icon-reaction"><i class="icon-reaction fa-solid fa-thumbs-up"></i></span>
                                                </button>
                                            </div>
                                            <div class="reaction-num"><?php echo $reactions['gostei']; ?></div>
                                            <!-- //? PARABENS -->
                                            <div class="reaction-pair-elements parabens">
                                                <button type="submit" name="reaction-parabens" value="<?=htmlspecialchars($userInfo[0]['id_participante'])?>-parabens"
                                                    class="btn-reaction" title="parabéns">
                                                    <span class="box-icon-reaction"><i class="icon-reaction fa-solid fa-hands-clapping"></i></span>
                                                </button>
                                            </div>
                                            <div class="reaction-num"><?php echo $reactions['parabens']; ?></div>
                                            <!-- //? APOIO -->
                                            <div class="reaction-pair-elements apoio">
                                                <button type="submit" name="reaction-apoio" value="<?=htmlspecialchars($userInfo[0]['id_participante'])?>-apoio"
                                                    class="btn-reaction" title="apoio">
                                                    <span class="box-icon-reaction"><i class="icon-reaction fa-solid fa-handshake"></i></span>
                                                </button>
                                            </div>
                                            <div class="reaction-num"><?php echo $reactions['apoio']; ?></div>
                                            <!-- //? AMEI -->
                                            <div class="reaction-pair-elements amei">
                                                <button type="submit" name="reaction-amei" value="<?=htmlspecialchars($userInfo[0]['id_participante'])?>-amei"
                                                    class="btn-reaction" title="amei">
                                                    <span class="box-icon-reaction"><i class="icon-reaction fa-solid fa-heart"></i></span>
                                                </button>
                                            </div>
                                            <div class="reaction-num"><?php echo $reactions['amei']; ?></div>
                                            <!-- //? GENIAL -->
                                            <div class="reaction-pair-elements genial">
                                                <button type="submit" name="reaction-genial" value="<?=htmlspecialchars($userInfo[0]['id_participante'])?>-genial"
                                                    class="btn-reaction" title="genial">
                                                    <span class="box-icon-reaction" style="color: #51291E;"><i class="icon-reaction fa-solid fa-lightbulb"></i></span>
                                                </button>
                                            </div>
                                            <div class="reaction-num"><?php echo $reactions['genial']; ?></div>
                                        </form>
                                    </div>
                                </div>
                                <div class="comment-wrapper">
                                    <button id="btnComment" class="btn-content-footer btn-comment-toggle" title="Comente neste post!" onclick="toggleComment(this)">
                                        <i class="fa-solid fa-comment"><p>Comente</p> <?php if ($countComment != 0) { echo $countComment; } ?> </i>
                                    </button>
                                    <div class="comment-modal-content">
                                        <div class="comment-content">
                                            <button id="btn_exit_modal_comment" onclick="closeCommentModal(event)">X</button>
                                            <div class="post-comment">
                                                <div class="post-user">
                                                    <div class="user-avatar">
                                                        <div class="btn-user-img" id="btn-user-img" name="btn-user-img" style="cursor: auto;">
                                                            <img src="<?= str_replace("/xampp/htdocs", "", htmlspecialchars($usersArray[((int) $post["id_autor"]) - 1]['profile_pic'])) ?>"
                                                            alt="Avatar" style="width: 50px; height: 50px; border-radius: 50%;">
                                                        </div>
                                                    </div>
                                                    <?php if($userInfo[0]['id_participante'] != ($post['id_autor'])): ?>
                                                    <div class="formulario-denuncia" id="formulario-denuncia" name="formulario-denuncia">
                                                        <?php include "/xampp/htdocs/DailyGreen-Project/SCRIPTS/HTML/form_denuncia.html"; ?>
                                                    </div>
                                                    <?php endif; ?>
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
                                            </div>
                                            <div class="comment-container">
                                                <div class="user-avatar avatar-info-comment">
                                                    <img src="<?php echo str_replace("/xampp/htdocs", "", $userInfo[0]['profile_pic']); ?>" alt="User Avatar"
                                                        style="width: 50px; height: 50px; border-radius: 50%;">
                                                    <div style="margin-left: 1vh;">
                                                        <div><?php echo $userInfo[0]['username'] ?></div>
                                                        <div style="font-size: 0.8rem; color: #71767b;">@<?php echo $userInfo[0]['username']; ?></div>
                                                    </div>
                                                </div>
                                                <form action="/DailyGreen-Project/SCRIPTS/PHP/logic/send_comment.php" class="form-comment" method="post">
                                                    <input type="hidden" name="id_post" value="<?= htmlspecialchars($post['id_post']) ?>">
                                                    <input type="hidden" name="id_autor" value="<?= htmlspecialchars($post['id_autor']) ?>">
                                                    <input type="hidden" name="id_autor_comment" value="<?= htmlspecialchars($userInfo[0]['id_participante']) ?>">
                                                    <input type="text" id="comment_title" name="comment-title" placeholder="título do comentário.." required>
                                                    <textarea id="comment_text" name="comment-text" placeholder="comentario.." required></textarea>
                                                    <button type="submit" name="comment-post">Comentar</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </article>
                </div>
            <?php endforeach; ?>

        </div>

        <!-- //* SIDEBAR DIREITA -->
        <div class="sidebar_direita">
            <div class="barra_pesquisa">
                <i class="fas fa-search"></i>
                <input type="text" placeholder="Pesquisar">
            </div>

            <div class="title_evento"><h2>Eventos</h2></div>

            <div class="eventos_anuncio">
            <?php if (count($eventArray) === 0):?>
            <div class="no-event">
                <h4>Ainda não há eventos!</h4>
            </div>
            <?php endif; ?>
            <?php foreach (array_reverse($postsArray) as $post): ?>
                    <?php
                    // ? Verifica se o post tem um evento associado
                    $hasEvent = false;
                    foreach ($eventArray as $evento) {
                        if ($evento['id_post'] == $post['id_post']) {
                            $id_event = $evento['id_evento'];
                            $hasEvent = true;
                            break;
                        }
                    }
                    ?>
                    <?php if ($hasEvent): ?> <!-- //? Exibe apenas posts com evento  -->
                        <div class="event-divider">
                        <article class="post" id="post-<?= htmlspecialchars($post['id_post'])?>-event-<?= htmlspecialchars($id_event)?>" onclick="openPostModal(this, event, 'event')">
                            <div class="post-user">
                                <div class="user-avatar">
                                    <button class="btn-user-img" id="btn-user-img" name="btn-user-img" onclick="btnDenuncia(this)">
                                        <img src="<?= str_replace("/xampp/htdocs", "", htmlspecialchars($usersArray[((int) $post["id_autor"]) - 1]['profile_pic'])) ?>"
                                        alt="Avatar" style="width: 50px; height: 50px; border-radius: 50%;">
                                    </button>
                                    <?php if($userInfo[0]['id_participante'] != ($post['id_autor'])): ?>
                                    <button class="btn-denuncia" id="btn-denuncia" name="btn-denuncia" onclick="formDenuncia()">
                                        <span class="alert-icon">⚠️</span><p>Denunciar</p></button>
                                    <?php endif; ?>
                                </div>
                                <?php if($userInfo[0]['id_participante'] != ($post['id_autor'])): ?>
                                <div class="formulario-denuncia" id="formulario-denuncia" name="formulario-denuncia">
                                    <?php include "/xampp/htdocs/DailyGreen-Project/SCRIPTS/HTML/form_denuncia.html"; ?>
                                </div>
                                <?php endif; ?>
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
                                            <div class="dateTime-inicio">Início: <?= date('d/m/Y H:i', strtotime($evento['data_hora_inicio'])) ?></div>
                                            <div class="dateTime-inicio">Início: <?= date('d/m/Y H:i', strtotime($evento['data_hora_fim'])) ?></div>
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
                            <div class="post-footer">
                                <div class="reaction-wrapper">
                                    <button class="btn-content-footer btn-reaction-toggle" title="Reaja neste post!" onclick="toggleReact(this)">
                                        <i class="fa-solid fa-heart"> <p>Reações</p></i>
                                    </button>
                                    <div class="react-container">
                                        <?php $reactions = getPostReactions($post['id_post'], $reactionPostArray, 'Post'); ?>
                                        <form class="form-reaction" id="forms_reaction" action="/DailyGreen-Project/SCRIPTS/PHP/LOGIC/send_reaction.php" method="post">
                                            <input type="hidden" name="id_post" value="<?= htmlspecialchars($post['id_post']) ?>">
                                            <!-- //? GOSTEI -->
                                            <div class="reaction-pair-elements gostei">
                                                <button type="submit" name="reaction-gostei" value="<?=htmlspecialchars($userInfo[0]['id_participante'])?>-gostei"
                                                    class="btn-reaction" title="gostei">
                                                    <span class="box-icon-reaction"><i class="icon-reaction fa-solid fa-thumbs-up"></i></span>
                                                </button>
                                            </div>
                                            <div class="reaction-num"><?php echo $reactions['gostei']; ?></div>
                                            <!-- //? PARABENS -->
                                            <div class="reaction-pair-elements parabens">
                                                <button type="submit" name="reaction-parabens" value="<?=htmlspecialchars($userInfo[0]['id_participante'])?>-parabens"
                                                    class="btn-reaction" title="parabéns">
                                                    <span class="box-icon-reaction"><i class="icon-reaction fa-solid fa-hands-clapping"></i></span>
                                                </button>
                                            </div>
                                            <div class="reaction-num"><?php echo $reactions['parabens']; ?></div>
                                            <!-- //? APOIO -->
                                            <div class="reaction-pair-elements apoio">
                                                <button type="submit" name="reaction-apoio" value="<?=htmlspecialchars($userInfo[0]['id_participante'])?>-apoio"
                                                    class="btn-reaction" title="apoio">
                                                    <span class="box-icon-reaction"><i class="icon-reaction fa-solid fa-handshake"></i></span>
                                                </button>
                                            </div>
                                            <div class="reaction-num"><?php echo $reactions['apoio']; ?></div>
                                            <!-- //? AMEI -->
                                            <div class="reaction-pair-elements amei">
                                                <button type="submit" name="reaction-amei" value="<?=htmlspecialchars($userInfo[0]['id_participante'])?>-amei"
                                                    class="btn-reaction" title="amei">
                                                    <span class="box-icon-reaction"><i class="icon-reaction fa-solid fa-heart"></i></span>
                                                </button>
                                            </div>
                                            <div class="reaction-num"><?php echo $reactions['amei']; ?></div>
                                            <!-- //? GENIAL -->
                                            <div class="reaction-pair-elements genial">
                                                <button type="submit" name="reaction-genial" value="<?=htmlspecialchars($userInfo[0]['id_participante'])?>-genial"
                                                    class="btn-reaction" title="genial">
                                                    <span class="box-icon-reaction" style="color: #51291E;"><i class="icon-reaction fa-solid fa-lightbulb"></i></span>
                                                </button>
                                            </div>
                                            <div class="reaction-num"><?php echo $reactions['genial']; ?></div>
                                        </form>
                                    </div>
                                </div>
                                <div class="comment-wrapper">
                                    <button id="btnComment" class="btn-content-footer btn-comment-toggle" title="Comente neste post!" onclick="toggleComment(this)">
                                        <?php $countComment = 0; foreach($comentarioArray as $comment) { if ($comment['id_post'] === $post['id_post']) { $countComment += 1; } } ?>
                                        <i class="fa-solid fa-comment"><p>Comente</p><?php if ($countComment != 0) { echo $countComment; } ?>  </i>
                                    </button>
                                    <div class="comment-modal-content">
                                        <div class="comment-content">
                                            <button id="btn_exit_modal_comment" onclick="closeCommentModal(event)">X</button>
                                            <div class="post-comment">
                                                <div class="post-user">
                                                    <div class="user-avatar">
                                                        <div class="btn-user-img" id="btn-user-img" name="btn-user-img" style="cursor: auto;">
                                                            <img src="<?= str_replace("/xampp/htdocs", "", htmlspecialchars($usersArray[((int) $post["id_autor"]) - 1]['profile_pic'])) ?>"
                                                            alt="Avatar" style="width: 50px; height: 50px; border-radius: 50%;">
                                                        </div>
                                                    </div>
                                                    <?php if($userInfo[0]['id_participante'] != ($post['id_autor'])): ?>
                                                    <div class="formulario-denuncia" id="formulario-denuncia" name="formulario-denuncia">
                                                        <?php include "/xampp/htdocs/DailyGreen-Project/SCRIPTS/HTML/form_denuncia.html"; ?>
                                                    </div>
                                                    <?php endif; ?>
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
                                            </div>
                                            <div class="comment-container">
                                                <div class="user-avatar avatar-info-comment">
                                                    <img src="<?php echo str_replace("/xampp/htdocs", "", $userInfo[0]['profile_pic']); ?>" alt="User Avatar"
                                                        style="width: 50px; height: 50px; border-radius: 50%;">
                                                    <div style="margin-left: 1vh;">
                                                        <div><?php echo $userInfo[0]['username'] ?></div>
                                                        <div style="font-size: 0.8rem; color: #71767b;">@<?php echo $userInfo[0]['username']; ?></div>
                                                    </div>
                                                </div>
                                                <form action="/DailyGreen-Project/SCRIPTS/PHP/logic/send_comment.php" class="form-comment" method="post">
                                                    <input type="hidden" name="id_post" value="<?= htmlspecialchars($post['id_post']) ?>">
                                                    <input type="hidden" name="id_autor" value="<?= htmlspecialchars($post['id_autor']) ?>">
                                                    <input type="hidden" name="id_autor_comment" value="<?= htmlspecialchars($userInfo[0]['id_participante']) ?>">
                                                    <input type="text" id="comment_title" name="comment-title" placeholder="título do comentário.." required>
                                                    <textarea id="comment_text" name="comment-text" placeholder="comentario.." required></textarea>
                                                    <button type="submit" name="comment-post">Comentar</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php if(!isset($userInfo[1])): ?>
                                    <?php
                                    $foundCheckIn = false;
                                    $userId = $userInfo[0]['id_participante'];
                                    $postId = $post['id_post'];
                                    foreach ($checkListArray as $checklist) {
                                        if ($userId == $checklist['id_participante'] && $checklist['id_post'] == $postId) {
                                            $foundCheckIn = true;
                                            break;
                                        }
                                    }
                                    $btnId = "btn-send-checkIn-" . htmlspecialchars($postId);
                                    ?>
                                    <div class="participar-wrapper">
                                        <form action="/DailyGreen-Project/SCRIPTS/PHP/LOGIC/sendCheckIn.php" method="post">
                                            <input type="hidden" name="id_participante" value="<?= htmlspecialchars($userId) ?>">
                                            <input type="hidden" name="id_post" value="<?= htmlspecialchars($postId) ?>">
                                            <button
                                                type="submit"
                                                id="<?= $btnId ?>"
                                                class="btn-content-footer btn-send-checkIn<?= $foundCheckIn ? ' active' : '' ?>"
                                                name="btn-participar"
                                            >
                                                <i><p>Participar</p></i>
                                            </button>
                                        </form>
                                    </div>
                                <?php else: ?>
                                    <div class="checkIn-wrapper">
                                        <button class="btn-content-footer btn-send-checkList" onclick="toggleCheckListModal(this)">
                                            <i class="fa-solid fa-person"><p>Presença</p></i>
                                        </button>
                                        <div class="checklist-modal-content" style="display: none;">
                                            <div class="checklist-content">
                                                <button class="btn-exit-modal-checklist" onclick="closeCheckListModal(event)">X</button>
                                                <h2>Lista de Presença</h2>
                                                <ul class="checklist-users">
                                                    <!--//! muito instavel para funcionar por parte do organizador ! -->
                                                    <form action="/DailyGreen-Project/SCRIPTS/PHP/LOGIC/updateCheckIn.php" method="post">
                                                        <input type="hidden" name="id_post" value="<?=htmlspecialchars($post['id_post'])?>">
                                                        <?php
                                                        $hasUsers = false;
                                                        foreach ($checkListArray as $checklist):
                                                            if ($checklist['id_post'] == $post['id_post']):
                                                                $hasUsers = true;
                                                                ?><input type="hidden" name="id_checklist" value="<?=htmlspecialchars($checklist['id_checklist'])?>"><?php
                                                                $userId = $checklist['id_participante'];
                                                                foreach ($usersArray as $user):
                                                                    if ($user['id_participante'] == $userId):
                                                        ?>
                                                                        <li class="checklist-user-item">
                                                                            <img class="checklist-user-avatar" src="<?= str_replace("/xampp/htdocs", "", htmlspecialchars($user['profile_pic'])) ?>" alt="Avatar">
                                                                            <div class="checklist-user-name"><strong><?= htmlspecialchars($user['username']) ?></strong></div>
                                                                            <div class="checklist-user-status <?php if($checklist['presente'] == 1) {echo htmlspecialchars('presente'); }?> ">
                                                                                <?php if($checklist['presente'] == 1) {
                                                                                        echo htmlspecialchars('Presente');
                                                                                    } else {
                                                                                        echo htmlspecialchars('Ausente');
                                                                                    }?>
                                                                            </div>
                                                                            <input type="checkbox" class="checkin-checkbox"
                                                                                name="checkin[<?php if($checklist['presente'] == 1) {echo 'checked';} else {echo 'not-checked';} ?>][<?=htmlspecialchars($userId)?>]"
                                                                                value="<?=htmlspecialchars($userId)?>" <?php if($checklist['presente'] == 1) echo 'checked'; ?>
                                                                            >
                                                                            <?php if($checklist['presente'] == 1): ?>
                                                                                <input type="hidden" name="checkin[checked-un][<?=htmlspecialchars($userId)?>]" value="<?=htmlspecialchars($userId)?>">
                                                                            <?php endif; ?>
                                                                        </li>
                                                        <?php
                                                                    endif;
                                                                endforeach;
                                                            endif;
                                                        endforeach;
                                                        if (!$hasUsers):?>
                                                            <li class="checklist-user-item">
                                                                <strong>Não há registros de checkIn para este evento!</strong>
                                                            </li>
                                                        <?php endif; ?>
                                                        <input type="submit" class="btn-checkIn-submit">
                                                    </form>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                <?php endif;?>
                            </div>
                        </article>
                        <!-- //! MODAL EVENT -->
                        <article class="post-modal" id="postModal" style="display: none;">
                            <div class="post-modal-header">
                                <button class="bnt-close-post-modal" onclick="closePostModal(this, 'event')">X</button>
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
                                            @<?= htmlspecialchars($usersArray[((int) $post["id_autor"]) - 1]['username']) ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="post-titulo">
                                    <h1><?= htmlspecialchars($post['titulo']) ?></h1>
                                </div>
                                <div class="post-content">
                                    <?php
                                    if (isset($post['descricao'])) {
                                        $descricao = htmlspecialchars($post['descricao']);
                                        echo nl2br(wordwrap($descricao, 80, "\n", true));
                                    }
                                    ?>
                                </div>
                                <div class="event-post">
                                    <?php foreach ($eventArray as $evento): ?>
                                        <?php if ($evento['id_post'] == $post['id_post']): ?>
                                            <div class="dateTime">
                                                <div class="dateTime-inicio">Início: <?= date('d/m/Y H:i', strtotime($evento['data_hora_inicio'])) ?></div>
                                                <div class="dateTime-inicio">Início: <?= date('d/m/Y H:i', strtotime($evento['data_hora_fim'])) ?></div>
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
                                        foreach ($postMidias as $idx => $midia) {
                                        ?>
                                            <img
                                                src="<?= str_replace("/xampp/htdocs", "", htmlspecialchars($midia['midia_ref'])) ?>"
                                                alt="post img"
                                                class="post-img img-count-<?= $imgCount ?>"
                                                style="cursor: auto; width: 18%;"
                                            >
                                        <?php } ?>
                                    </div>
                                </div>
                                </button>
                                <?php if ($countComment === 0): ?>
                                    <div class="box-comments-none">
                                        <h1>Não possui comentarios!</h1>
                                    </div>
                                <?php else: ?>
                                <div class="box-comments">
                                        <div class="post-comments">
                                        <?php foreach($comentarioArray as $comment): ?>
                                            <?php if ($comment['id_post'] === $post['id_post']): ?>
                                                <div class="comment">
                                                    <div class="account-part-comment">
                                                        <div class="avatar-comment">
                                                            <img src="<?= str_replace("/xampp/htdocs", "", htmlspecialchars($userArray[((int) $comment['id_autor_comentario'] - 1)]['profile_pic'])) ?>"
                                                            alt="Avatar_autor_comentario" style="width: 50px; height: 50px; border-radius: 50%;">
                                                        </div>
                                                        <div class="usarname-autor-comment">
                                                            <div>
                                                                <strong><?= htmlspecialchars($userArray[((int) $comment['id_autor_comentario']-1)]['username']) ?></strong>
                                                            </div>
                                                            <div style="color: #71767b;">
                                                                @<?= htmlspecialchars($userArray[((int) $comment['id_autor_comentario']-1)]['username']) ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="content-part-comment">
                                                        <div class="title-part-comment">
                                                            <h1><?= htmlspecialchars($comment['titulo_comentario']) ?></h1>
                                                        </div>
                                                        <div class="description-part-comment">
                                                            <?= htmlspecialchars($comment['descricao_comentario']) ?>
                                                        </div>
                                                    </div>
                                                    <div class="footer-comment">
                                                        <div class="reaction-wrapper">
                                                            <button class="btn-content-footer btn-reaction-toggle" title="Reaja neste post!" onclick="toggleReact(this)">
                                                                <i class="fa-solid fa-heart"> <p>Reaja</p></i>
                                                            </button>
                                                            <div class="react-container">
                                                                <?php $reactions = getPostReactions($comment['id_comentario'], $reactionCommentArray, 'Comentario'); ?>
                                                                <form class="form-reaction" id="forms_reaction_comment" action="/DailyGreen-Project/SCRIPTS/PHP/LOGIC/send_reaction.php" method="post">
                                                                    <input type="hidden" name="id_comentario" value="<?= htmlspecialchars($comment['id_comentario']) ?>">
                                                                    <!-- //? GOSTEI -->
                                                                    <div class="reaction-pair-elements gostei">
                                                                        <button type="submit" name="reaction-gostei" value="<?=htmlspecialchars($userInfo[0]['id_participante'])?>-gostei"
                                                                            class="btn-reaction" title="gostei">
                                                                            <span class="box-icon-reaction"><i class="icon-reaction fa-solid fa-thumbs-up"></i></span>
                                                                        </button>
                                                                    </div>
                                                                    <div class="reaction-num"><?php echo $reactions['gostei']; ?></div>
                                                                    <!-- //? PARABENS -->
                                                                    <div class="reaction-pair-elements parabens">
                                                                        <button type="submit" name="reaction-parabens" value="<?=htmlspecialchars($userInfo[0]['id_participante'])?>-parabens"
                                                                            class="btn-reaction" title="parabéns">
                                                                            <span class="box-icon-reaction"><i class="icon-reaction fa-solid fa-hands-clapping"></i></span>
                                                                        </button>
                                                                    </div>
                                                                    <div class="reaction-num"><?php echo $reactions['parabens']; ?></div>
                                                                    <!-- //? APOIO -->
                                                                    <div class="reaction-pair-elements apoio">
                                                                        <button type="submit" name="reaction-apoio" value="<?=htmlspecialchars($userInfo[0]['id_participante'])?>-apoio"
                                                                            class="btn-reaction" title="apoio">
                                                                            <span class="box-icon-reaction"><i class="icon-reaction fa-solid fa-handshake"></i></span>
                                                                        </button>
                                                                    </div>
                                                                    <div class="reaction-num"><?php echo $reactions['apoio']; ?></div>
                                                                    <!-- //? AMEI -->
                                                                    <div class="reaction-pair-elements amei">
                                                                        <button type="submit" name="reaction-amei" value="<?=htmlspecialchars($userInfo[0]['id_participante'])?>-amei"
                                                                            class="btn-reaction" title="amei">
                                                                            <span class="box-icon-reaction"><i class="icon-reaction fa-solid fa-heart"></i></span>
                                                                        </button>
                                                                    </div>
                                                                    <div class="reaction-num"><?php echo $reactions['amei']; ?></div>
                                                                    <!-- //? GENIAL -->
                                                                    <div class="reaction-pair-elements genial">
                                                                        <button type="submit" name="reaction-genial" value="<?=htmlspecialchars($userInfo[0]['id_participante'])?>-genial"
                                                                            class="btn-reaction" title="genial">
                                                                            <span class="box-icon-reaction" style="color: #51291E;"><i class="icon-reaction fa-solid fa-lightbulb"></i></span>
                                                                        </button>
                                                                    </div>
                                                                    <div class="reaction-num"><?php echo $reactions['genial']; ?></div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php endif; ?>
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                                <?php endif; ?>
                                <div class="post-footer">
                                    <div class="reaction-wrapper">
                                        <button class="btn-content-footer btn-reaction-toggle" title="Reaja neste post!" onclick="toggleReact(this)">
                                            <i class="fa-solid fa-heart"> <p>Reaja</p></i>
                                        </button>
                                        <div class="react-container">
                                            <?php $reactions = getPostReactions($post['id_post'], $reactionPostArray, 'Post'); ?>
                                            <form class="form-reaction" id="forms_reaction" action="/DailyGreen-Project/SCRIPTS/PHP/LOGIC/send_reaction.php" method="post">
                                                <input type="hidden" name="id_post" value="<?= htmlspecialchars($post['id_post']) ?>">
                                                <!-- //? GOSTEI -->
                                                <div class="reaction-pair-elements gostei">
                                                    <button type="submit" name="reaction-gostei" value="<?=htmlspecialchars($userInfo[0]['id_participante'])?>-gostei"
                                                        class="btn-reaction" title="gostei">
                                                        <span class="box-icon-reaction"><i class="icon-reaction fa-solid fa-thumbs-up"></i></span>
                                                    </button>
                                                </div>
                                                <div class="reaction-num"><?php echo $reactions['gostei']; ?></div>
                                                <!-- //? PARABENS -->
                                                <div class="reaction-pair-elements parabens">
                                                    <button type="submit" name="reaction-parabens" value="<?=htmlspecialchars($userInfo[0]['id_participante'])?>-parabens"
                                                        class="btn-reaction" title="parabéns">
                                                        <span class="box-icon-reaction"><i class="icon-reaction fa-solid fa-hands-clapping"></i></span>
                                                    </button>
                                                </div>
                                                <div class="reaction-num"><?php echo $reactions['parabens']; ?></div>
                                                <!-- //? APOIO -->
                                                <div class="reaction-pair-elements apoio">
                                                    <button type="submit" name="reaction-apoio" value="<?=htmlspecialchars($userInfo[0]['id_participante'])?>-apoio"
                                                        class="btn-reaction" title="apoio">
                                                        <span class="box-icon-reaction"><i class="icon-reaction fa-solid fa-handshake"></i></span>
                                                    </button>
                                                </div>
                                                <div class="reaction-num"><?php echo $reactions['apoio']; ?></div>
                                                <!-- //? AMEI -->
                                                <div class="reaction-pair-elements amei">
                                                    <button type="submit" name="reaction-amei" value="<?=htmlspecialchars($userInfo[0]['id_participante'])?>-amei"
                                                        class="btn-reaction" title="amei">
                                                        <span class="box-icon-reaction"><i class="icon-reaction fa-solid fa-heart"></i></span>
                                                    </button>
                                                </div>
                                                <div class="reaction-num"><?php echo $reactions['amei']; ?></div>
                                                <!-- //? GENIAL -->
                                                <div class="reaction-pair-elements genial">
                                                    <button type="submit" name="reaction-genial" value="<?=htmlspecialchars($userInfo[0]['id_participante'])?>-genial"
                                                        class="btn-reaction" title="genial">
                                                        <span class="box-icon-reaction" style="color: #51291E;"><i class="icon-reaction fa-solid fa-lightbulb"></i></span>
                                                    </button>
                                                </div>
                                                <div class="reaction-num"><?php echo $reactions['genial']; ?></div>
                                            </form>
                                        </div>
                                    </div>
                                    <div class="comment-wrapper">
                                        <button id="btnComment" class="btn-content-footer btn-comment-toggle" title="Comente neste post!" onclick="toggleComment(this)">
                                            <i class="fa-solid fa-comment"><p>Comente</p> <?php if ($countComment != 0) { echo $countComment; } ?> </i>
                                        </button>
                                        <div class="comment-modal-content">
                                            <div class="comment-content">
                                                <button id="btn_exit_modal_comment" onclick="closeCommentModal(event)">X</button>
                                                <div class="post-comment">
                                                    <div class="post-user">
                                                        <div class="user-avatar">
                                                            <div class="btn-user-img" id="btn-user-img" name="btn-user-img" style="cursor: auto;">
                                                                <img src="<?= str_replace("/xampp/htdocs", "", htmlspecialchars($usersArray[((int) $post["id_autor"]) - 1]['profile_pic'])) ?>"
                                                                alt="Avatar" style="width: 50px; height: 50px; border-radius: 50%;">
                                                            </div>
                                                        </div>
                                                        <?php if($userInfo[0]['id_participante'] != ($post['id_autor'])): ?>
                                                        <div class="formulario-denuncia" id="formulario-denuncia" name="formulario-denuncia">
                                                            <?php include "/xampp/htdocs/DailyGreen-Project/SCRIPTS/HTML/form_denuncia.html"; ?>
                                                        </div>
                                                        <?php endif; ?>
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
                                                </div>
                                                <div class="comment-container">
                                                    <div class="user-avatar avatar-info-comment">
                                                        <img src="<?php echo str_replace("/xampp/htdocs", "", $userInfo[0]['profile_pic']); ?>" alt="User Avatar"
                                                            style="width: 50px; height: 50px; border-radius: 50%;">
                                                        <div style="margin-left: 1vh;">
                                                            <div><?php echo $userInfo[0]['username'] ?></div>
                                                            <div style="font-size: 0.8rem; color: #71767b;">@<?php echo $userInfo[0]['username']; ?></div>
                                                        </div>
                                                    </div>
                                                    <form action="/DailyGreen-Project/SCRIPTS/PHP/logic/send_comment.php" class="form-comment" method="post">
                                                        <input type="hidden" name="id_post" value="<?= htmlspecialchars($post['id_post']) ?>">
                                                        <input type="hidden" name="id_autor" value="<?= htmlspecialchars($post['id_autor']) ?>">
                                                        <input type="hidden" name="id_autor_comment" value="<?= htmlspecialchars($userInfo[0]['id_participante']) ?>">
                                                        <input type="text" id="comment_title" name="comment-title" placeholder="título do comentário.." required>
                                                        <textarea id="comment_text" name="comment-text" placeholder="comentario.." required></textarea>
                                                        <button type="submit" name="comment-post">Comentar</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </article>
                        </div>
                    <?php endif; ?>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="/DailyGreen-Project/SCRIPTS/JS/pagina_postagens.js"></script>
</body>
</html>
