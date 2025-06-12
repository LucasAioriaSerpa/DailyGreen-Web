<?php
include_once 'LOGIC/session.php';
include_once 'LOGIC/SQL_connection.php';
include_once 'LOGIC/functions.php';
include_once 'LOGIC/joinPostUsers.php';
if (empty($_SESSION['user']['loged'])) {
    header("Location: /DailyGreen-Project/SCRIPTS/PHP/loginAdm.php");
    exit();
}
$sqlConnection = new SQLconnection();
$id_participante = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$participante_email = $participante_email ?? '';
$participante_create_time = $participante_create_time ?? '';
$participante_lista = $participante_lista ?? '';
$postsAgrupados = $postsAgrupados ?? [];
$user_create_date = $participante_create_time ? new DateTime($participante_create_time) : null;
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
            <tr><th class="th">ID do Participante:&nbsp;</th><td><?= $id_participante ?></td></tr>
            <tr><th class="th">Email do Participante:&nbsp;</th><td><?= htmlspecialchars($participante_email) ?></td></tr>
            <tr><th class="th">Data criação da conta:&nbsp;</th>
                <td>
                    <?= $user_create_date ? $user_create_date->format('d/m/Y H:i:s') : '-' ?>
                </td>
            </tr>
            <tr><th class="th">Lista do Participante:&nbsp;</th><td><?= htmlspecialchars($participante_lista) ?></td></tr>
        </tbody>
    </table>
    <?php if (!empty($postsAgrupados)): ?>
        <br>
        <hr>
        <h3 class="title">POSTS</h3>
        <hr><br>
        <div>
            <?php foreach ($postsAgrupados as $post): ?>
                <div><hr><br>
                    <table>
                        <tbody>
                            <tr><th class="th">TÍTULO:&nbsp;</th><td><?= htmlspecialchars($post['titulo'] ?? '') ?></td></tr>
                            <tr><th class="th">DESCRIÇÃO:&nbsp;</th><td><?= htmlspecialchars($post['descricao'] ?? '') ?></td></tr>
                            <tr><th class="th">POSTADO EM:&nbsp;</th>
                                <td>
                                    <?php
                                    $post_create_date = !empty($post['create_time']) ? new DateTime($post['create_time']) : null;
                                    echo $post_create_date ? $post_create_date->format('d/m/Y H:i:s') : '-';
                                    ?>
                                </td>
                            </tr>
                            <tr style="height: 10px"></tr>
                            <?php if (!empty($post['midias'])): ?>
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
    <?php endif; ?>
</div>