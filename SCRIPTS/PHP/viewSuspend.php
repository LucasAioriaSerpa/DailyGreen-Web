<?php
    include_once 'LOGIC/session.php';
    include_once 'LOGIC/SQL_connection.php';
    include_once 'LOGIC/functions.php';
    
    if ($_SESSION['user']['loged'] === false) {
        header("Location: /DailyGreen-Project/SCRIPTS/PHP/loginAdm.php");
        exit();
    }
    $sqlConnection = new SQLconnection();
    $id_denuncia = (int) $_GET['id'];
    include_once 'LOGIC/joinSuspenso.php';

?>

<div class="form-analyse-suspend">
    <div class="buttons-post-user">
        <div class="action-buttons">
            <div class="button-back">
                <button class="btn-back" onclick="loadPage('/DailyGreen-Project/SCRIPTS/PHP/listSuspend.php')">VOLTAR</button>
            </div>
        </div>
    </div><br><br>
    <div class="info-suspend">
        <div class="info-user-suspend">
            <fieldset>
                <legend>INFORMAÇÕES DO USUÁRIO</legend>
                <div>
                    <table style="display: flex">
                        <tbody style="width: 20%"><th><td rowspan="4">
                            <div class="img-user-banido">
                                <img src="<?= str_replace("/xampp/htdocs", "", $participante_profile_pic) ?>"
                                    alt="Avatar" style="width: 100px; height: 100px; margin-left: 30px; border-radius: 50%;">
                                </div>
                            </td></th>
                        </tbody>
                        <tbody style="width: 40%">
                            <tr><th class="th">ID do Usuário:&nbsp;</th><td><?php echo $id_participante_suspenso ?></td></tr>
                            <tr><th class="th">Nome do Usuário:&nbsp;</th><td><?php echo $participante_username  ?></td></tr>
                            <tr><th class="th">Email Cadastrado:&nbsp;</th><td><?php echo $participante_email ?></td></tr>
                            <tr><th class="th">Criação da conta:&nbsp;</th><td><?php echo $user_create_time->format('d/m/Y H:i:s') ?></td></tr>
                        </tbody>
                        <tbody style="width: 50%">
                            <tr><th class="th">Pertence a Lista:&nbsp;</th><td><?php echo $participante_lista ?></td></tr>
                            <tr><th class="th">Inicio da Suspensão:&nbsp;</th><td><?php echo $data_inicio_suspensao->format('d/m/Y H:i:s') ?></td></tr>
                            <tr><th class="th">Fim da Suspensão:&nbsp;</th><td><?php echo $data_fim_suspensao->format('d/m/Y H:i:s') ?></td></tr>
                        </tbody>
                    </table>
                </div>
            </fieldset><br>
            <fieldset>
                <legend>INFORMAÇÕES DA DENÚNCIA</legend>
                    <div>
                        <table style="display: flex">
                            <tbody style="width: 50%">
                                <tr><th class="th">ID Denuncia:&nbsp;</th><td><?php echo $id_denuncia ?></td></tr>
                                <tr><th class="th">Denuncia Titulo:&nbsp;</th><td><?php echo str_replace('_', ' ', $denuncia_titulo) ?></td></tr>
                                <tr><th class="th">Denuncia Motivo:&nbsp;</th><td><?php echo $denuncia_motivo ?></td></tr>
                                <tr><th class="th">Denuncia Status:&nbsp;</th><td><?php echo $denuncia_status ?></td></tr>
                                <tr><th class="th">Data Registro:&nbsp;</th><td><?php echo $denuncia_create_time->format('d/m/Y H:i:s') ?></td></tr>
                            </tbody>
                            <tbody style="width: 50%">
                                <tr><th class="th">Inicio da Analise:&nbsp;</th><td><?php echo $inicio_analise->format('d/m/Y H:i:s') ?></td></tr>
                                <tr><th class="th">Fim da Analise:&nbsp;</th><td><?php echo $fim_analise->format('d/m/Y H:i:s') ?></td></tr>
                                <tr><th class="th">ID Adm Responsável:&nbsp;</th><td><?php echo $id_administrador ?></td></tr>
                                <tr><th class="th">Email Adm Responsável:&nbsp;</th><td><?php echo $administrador_email ?></td></tr>
                            </tbody>
                        </table>
                    </div>
            </fieldset><br>
            <div id="hide-report" class="hide-report-container">
                <div class="header-hide-report" onclick="alternarFiltro()">
                    <span><strong>POST DENUNCIADO</strong></span>
                    <span id="seta" class="seta">▼</span>
                </div>
                <div class="info-suspend-report">
                    <div>
                        <table>
                            <tbody>
                                <tr><th class="th">ID do Post:&nbsp;</th><td><?php echo $id_post ?></td></tr>
                                <tr><th class="th">Titulo:&nbsp;</th><td><?php echo $post_titulo ?></td></tr>
                                <tr><th class="th">Descrição:&nbsp;</th><td><?php echo $post_descricao ?></td></tr>
                                <tr><th class="th">Data Publicação:&nbsp;</th><td><?php echo $post_create_time->format('d/m/Y H:i:s') ?></td></tr>
                                <tr style="height: 10px"></tr>
                                <tr><th class="th">Mídia:&nbsp;</th><td><img src="<?= str_replace("/xampp/htdocs", "", htmlspecialchars($midia_ref)) ?>" alt="Avatar"></td></tr>
                            </tbody>
                        </table><br>
                    </div>
                </div><br>
            </div>
        </div>
    </div>
</div>