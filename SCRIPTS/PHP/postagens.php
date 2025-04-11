
<?php
use DailyGreenProject\SCRIPTS\PHP\LOGIC\SQL_connection;
use DailyGreenProject\SCRIPTS\PHP\LOGIC\PullUserInfoJson;

$userInfo = new PullUserInfoJson();
$sqlConnection = new SQLconnection();
$postsArray = $sqlConnection->callTableBD('post',false);
$usersArray = $sqlConnection->callTableBD('participante',true);

?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DailyGreen-Postagens</title>
    <link rel="stylesheet" href="/DailyGreen-Project/SCRIPTS/CSS/pagina_postagens.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>

<body>
    <div class="container">
        <!-- SIDEBAR ESQUERDA -->
        <div class="sidebar_esquerda">
            <div class="menu-item">
                <i class="fas fa-home"></i>
                <span>Página Inicial</span>
            </div>

            <div class="area_perfil">
                <div class="menu-item">
                    <div class="user-avatar">
                    <img src="<?php echo $userInfo->pullProfileImage(); ?>" alt="User Avatar" style="width: 50px; height: 50px; border-radius: 50%;">
                </div>
                    <div style="margin-left: 10px;">
                        <div><?php $userInfo->pullName();?></div>
                        <div style="font-size: 0.8rem; color: #71767b;">@<?php $userInfo->pullName();?></div>
                    </div>
                </div>
            </div>
        </div>

        <!-- CONTEÚDO CENTRAL (FEED) -->
        <div class="conteudo_principal">
            <div class="feed-header">Para você</div>

            <div class="caixa_postagem">
                <div class="caixa_postagem-header">
                    <div class="caixa_postagem-avatar">
                    <img src="<?php echo $userInfo->pullProfileImage(); ?>" alt="User Avatar" style="width: 50px; height: 50px; border-radius: 50%;">
                    </div>
                    <div class="caixa_postagem-input">
                        <form action="/DailyGreen-Project/SCRIPTS/PHP/LOGIC/sendPost.php" method="POST">
                            <input type="hidden" name="id_participante" value="<?php echo $userInfo->pullID(); ?>">
                            <input type="text" name="titulo" placeholder="titulo">
                            <input type="text" name="descricao" placeholder="Poste aqui">
                            <input class="botao_postagem" type="submit" value="Postar">
                        </form>
                    </div>
                </div>
                <div class="caixa_postagem-footer">
                    <div class="caixa_postagem-actions">
                        <div class="caixa_postagem-action"><i class="far fa-image"></i></div>
                    </div>
                </div>
            </div>

            <!-- POST EXEMPLO 1 -->
            <?php foreach ($postsArray as $post): ?>
            <div class="post">
                <div class="post-user">
                    <div class="user-avatar">
                        <img src="<?= str_replace("/xampp/htdocs", "", htmlspecialchars($usersArray[((int)$post["id_autor"])-1]['profile_pic'])) ?>" alt="Avatar" style="width: 50px; height: 50px; border-radius: 50%;">
                    </div>
                    <div style="margin-left: 10px;">
                        <div><strong><?= htmlspecialchars($usersArray[((int)$post["id_autor"])-1]['username']) ?></strong></div>
                        <div style="color: #71767b;">@<?= htmlspecialchars($usersArray[((int)$post["id_autor"])-1]['username']) ?></div>
                    </div>
                </div>
                <div class="post-titulo">
                    <?= htmlspecialchars($post['titulo']) ?>
                </div>
                <div class="post-content">
                    <?= nl2br(htmlspecialchars($post['descricao'])) ?>
                </div>
            </div>
        <?php endforeach; ?>


        </div>

        <!-- SIDEBAR DIREITA -->
        <div class="sidebar_direita">
            <div class="barra_pesquisa">
                <i class="fas fa-search"></i>
                <input type="text" placeholder="Pesquisar">
            </div>

            <div class="eventos_anuncio">
                <!-- <div class="evento">
                    <h1>EVENTO 1</h1>
                    <b>o evento sera em tal lugar tal horario e tal dia</b>
                    <img src="/DailyGreen-Project/IMAGES/mulher camera imagem.jpg" alt="" width="370px">
                </div> -->
                <?php
                ?>
            </div>
        </div>
    </div>
    </div>
</body>

</html>
