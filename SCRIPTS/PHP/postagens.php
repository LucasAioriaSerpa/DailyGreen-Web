
<?php
include_once '/xampp/htdocs/DailyGreen-Project/SCRIPTS/PHP/LOGIC/SQL_connection.php';
$sqlConnection = new SQLconnection();
$postsArray = $sqlConnection->callTableBD('post',false);
$usersArray = $sqlConnection->callTableBD('participante',true);
function pullName() {
    echo json_decode(file_get_contents("/xampp/htdocs/DailyGreen-Project/JSON/login.json"), true)["username"];
}
function pullProfileImage() {
    return str_replace("/xampp/htdocs", "",json_decode(file_get_contents("/xampp/htdocs/DailyGreen-Project/JSON/login.json"), true)["profile_pic"]);
}
function pullID(){
    return json_decode(file_get_contents("/xampp/htdocs/DailyGreen-Project/JSON/login.json"), true)["id_participante"];
}
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Twitter-like Full Screen</title>
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
                    <img src="<?php echo pullProfileImage(); ?>" alt="User Avatar" style="width: 50px; height: 50px; border-radius: 50%;">
                    </div>
                    <div style="margin-left: 10px;">
                        <div><?php pullName();?></div>
                        <div style="font-size: 0.8rem; color: #71767b;">@<?php pullName();?></div>
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
                    <img src="<?php echo pullProfileImage(); ?>" alt="User Avatar" style="width: 50px; height: 50px; border-radius: 50%;">
                    </div>
                    <div class="caixa_postagem-input">
                        <form action="/DailyGreen-Project/SCRIPTS/PHP/LOGIC/sendPost.php" method="POST">
                            <input type="hidden" name="id_participante" value="<?php echo pullID(); ?>">
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
            <!-- <div class="post">
                <div class="post-user">
                    <div class="user-avatar"></div>
                    <div>
                        <div><strong>Usuário Exemplo</strong></div>
                        <div style="color: #71767b;">@exemplo · 2h</div>
                    </div>
                </div>
                <div class="post-content">
                    Este é um exemplo de postagem que ocupa o feed central. Você pode adicionar quantos posts quiser, e
                    eles serão exibidos em sequência vertical.
                </div>
            </div> -->
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
