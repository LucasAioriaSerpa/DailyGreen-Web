<?php
    include_once 'LOGIC/session.php';
    include_once 'LOGIC/SQL_connection.php';
    include_once 'LOGIC/functions.php';
    include_once 'LOGIC/joinPostUsers.php';
    if ($_SESSION['user']['loged'] === false) {
        header("Location: /DailyGreen-Project/SCRIPTS/PHP/loginAdm.php");
        exit();
    }
    $sqlConnection = new SQLconnection();
    $id_participante = (int) $_GET['id'];

?>

<div class="container-post-user">
    <div class="button-back">
        <button class="btn-back" onclick="loadPage('/DailyGreen-Project/SCRIPTS/PHP/listUsers.php')">VOLTAR</button>
    </div><br><br>
    <hr>
    <h3 class="title">USUÁRIO</h3>
    <hr><br>
    <table>
        <tbody>
            <tr><th class="th">ID do Participante:&nbsp;</th><td><?php echo $id_participante ?></td></tr>
            <tr><th class="th">Email do Participante:&nbsp;</th><td><?php echo $participante_email  ?></td></tr>
            <?php $user_create_date = new DateTime($participante_create_time) ?>
            <tr><th class="th">Data criação da conta:&nbsp;</th><td><?php echo $user_create_date->format('d/m/Y H:i:s') ?></td></tr>
            <tr><th class="th">Lista do Participante:&nbsp;</th><td><?php echo $participante_lista ?></td></tr>
        </tbody>
    </table><br>
    <hr>
    <h3 class="title">POSTS</h3>
    <hr><br>
    <div>
        <?php foreach ($postsAgrupados as $post): ?>
            <div><hr><br>
                <table>
                    <tbody>
                        <tr><th class="th">TÍTULO:&nbsp;</th><td><?= htmlspecialchars($post['titulo']) ?></td></tr>
                        <tr><th class="th">DESCRIÇÃO:&nbsp;</th><td><?= htmlspecialchars($post['descricao']) ?></td></tr>
                        <?php $post_create_date = new DateTime(htmlspecialchars($post['create_time'])) ?>
                        <tr><th class="th">POSTADO EM:&nbsp;</th><td><?= $post_create_date->format('d/m/Y H:i:s') ?></td></tr>
                        <tr style="height: 10px"></tr>
                        <?php if (count($post['midias']) > 0): ?>
                            <tr>
                                <th class="th">MÍDIAS:</th>
                                <td>
                                    <?php foreach ($post['midias'] as $midia): ?>
                                        <img src="<?= str_replace("/xampp/htdocs", "", htmlspecialchars($midia)) ?>" alt="Imagem do post">
                                    <?php endforeach; ?>
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table><br>
                <hr><br>
            </div>
        <?php endforeach; ?>
    </div>
</div>