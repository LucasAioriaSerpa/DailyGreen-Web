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
    <div class="buttons-post-user">
        <div class="action-buttons">
            <div class="button-back">
                <button class="btn-back" onclick="loadPage('/DailyGreen-Project/SCRIPTS/PHP/listUsers.php')">VOLTAR</button>
            </div>
            <div class="button-suspender">
                <input type="submit" value="SUSPENDER" class="btn-suspender" id="suspend" name="suspend" onclick="formSuspend()">
            </div>
            <div class="button-banir">
                <input type="submit" value="BANIR" class="btn-banir" id="ban" name="ban" onclick="formBan()">
            </div>
        </div>
        <div class="formulario-suspenso" id="formulario-suspenso" name="formulario-suspenso">
            <?php include "/xampp/htdocs/DailyGreen-Project/SCRIPTS/HTML/form_suspend.html"; ?>
        </div>
        <div class="formulario-banido" id="formulario-banido" name="formulario-banido">
            <?php include "/xampp/htdocs/DailyGreen-Project/SCRIPTS/HTML/form_ban.html"; ?>
        </div>
    </div><br><br>
    <hr>
    <h3>USUÁRIO</h3>
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
    <h3>POSTS</h3>
    <hr><br>
    <div>
        <?php foreach ($postsAgrupados as $post): ?>
            <div>
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
                                        <img src="<?= str_replace("/xampp/htdocs", "", htmlspecialchars($midia)) ?>" 
                                            alt="Imagem do post" style="border-radius: 10%; margin: 5px;">
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