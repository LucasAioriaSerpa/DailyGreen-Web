<?php
    include_once 'LOGIC/session.php';
    include_once 'LOGIC/SQL_connection.php';
    include_once 'LOGIC/functions.php';
    include_once 'LOGIC/joinAndUpdateAdm.php';
    if ($_SESSION['user']['loged'] === false) {
        header("Location: /DailyGreen-Project/SCRIPTS/PHP/loginAdm.php");
        exit();
    }
    $sqlConnection = new SQLconnection();
    $id_administrador = ((int) $_SESSION['user']['account']);
    $id_adm = ((int) $_SESSION['user']['account']['id_administrador']);
    $id_denuncia = (int) $_GET['id'];
?>

<div class="navegacao_principal">
    <?php if(!isset($post_id)): ?>
        <fieldset style="width: 100%; height: 80vh; display: flex; align-items: center; flex-direction: column; justify-content: center; gap: 5vh">
            <h4>Usuário está banido da plataforma!</h4>
            <div class="ban-button">
                <button class="analyse-ban" type="submit" onclick="loadPage('/DailyGreen-Project/SCRIPTS/PHP/listBan.php')">VER LISTA</button>
            </div>
            <div class="button-back">
                <button class="btn-back" onclick="loadPage('/DailyGreen-Project/SCRIPTS/PHP/listReport.php')">VOLTAR</button>
            </div>
        </fieldset>
    <?php else: ?>
    <div class="form-analyse-report">
        <div class="container-dados-denuncia">
            <div class="relator-informacoes">
                <fieldset>
                    <legend>RELATOR</legend>
                    <div class="dados-relator">
                        <div class="dados-relator-direita">
                            <div class="img-relator">
                                <div><img src="<?= str_replace("/xampp/htdocs", "", htmlspecialchars($relator_pic)) ?>"
                                    alt="Avatar" style="width: 90px; height: 90px; border-radius: 50%;"></div>
                            </div>
                        </div>
                        <div class="info-relator">
                            <div><?php echo "<b>Nome: </b>".$relator; ?></div>
                            <div><?php echo "<b>Email: </b>".$relator_email ?></div>
                            <div><?php echo "<b>Conta criada em: </b>".$relator_create_time->format('d/m/Y H:i:s') ?></div>
                        </div>
                    </div> 
                </fieldset><br>
                <div class="dados-adm">
                    <fieldset>
                        <legend class="legend-adm">DADOS ADM</legend>
                        <div><?php echo "<b>ID Administrador: </b>".$admnistrador_id; ?></div>
                        <div><?php echo "<b>Email Administrador: </b>".$admnistrador_email ?></div>
                        <div><?php echo "<b>Data de inicio da análise: </b>".$data_inicio->format('d/m/Y H:i:s') ?></div>
                        <?php if($data_fim_analise != null): ?>
                            <div><?php echo "<b>Data do fim da análise: </b>".$data_fim->format('d/m/Y H:i:s') ?></div><br>
                        <?php else: ?>
                            <br><div class="no-data-end"><?php echo "<b>Denúncia Em Análise. </b>" ?></div><br>
                        <?php endif; ?>
                    </fieldset>
                </div>
            </div> <br>
            <fieldset>
                <legend>RELATADO</legend>
                <div class="dados-relatado">
                    <div class="img-relatado">
                        <div><img src="<?= str_replace("/xampp/htdocs", "", htmlspecialchars($relatado_pic)) ?>"
                            alt="Avatar" style="width: 90px; height: 90px; border-radius: 50%;"></div>
                    </div>
                    <div class="info-relatado">
                        <div><?php echo "<b>Nome: </b>".$relatado; ?></div>
                        <div><?php echo "<b>Email: </b>".$relatado_email ?></div>
                        <div><?php echo "<b>Conta criada em: </b>".$relatado_create_time->format('d/m/Y H:i:s') ?></div>
                    </div>
                </div><br>
                <fieldset>
                    <legend>INFORMAÇÕES DA DENÚNCIA</legend>
                    <div class="dados-denuncia">
                        <div><?php echo "<b>ID da Denúncia: </b>".$denuncia_id; ?></div>
                        <div><?php echo "<b>Motivo da Denúncia: </b>".str_replace('_', ' ', $denuncia_motivo); ?></div>
                        <div><?php echo "<b>Descrição da Denúncia: </b>".$denuncia_descricao; ?></div>
                        <div><?php echo "<b>Data de Registro: </b>".$denuncia_registro->format('d/m/Y H:i:s') ?></div>
                    </div> <br>
                </fieldset><br>
                <fieldset>
                    <legend>POST DENUNCIADO</legend>
                    <div class="dados-post">
                        <div><?php echo "<b>Titulo do Post: </b>".$post_titulo ?></div>
                        <div><?php echo "<b>Descrição do Post: </b>".$post_descricao ?></div>
                        <?php $post_create_time = new DateTime($post_creation_date) ?>
                        <div><?php echo "<b>Postado em: </b>".$post_create_time->format('d/m/Y H:i:s') ?></div>
                        <div class="midia-post"><?php echo "<b>Imagens do Post: </b>" ?></div><br>
                        <div class="img-post">
                            <img src="<?= str_replace("/xampp/htdocs", "", htmlspecialchars($midia_post)) ?>"
                                alt="Avatar" style="border-radius: 10px;">
                        </div>
                    </div><br>
                </fieldset><br>
                <fieldset>
                    <legend>DECISÃO</legend>
                    <div class="decision">
                        <button class="back-to-listReport" onclick="loadPage('/DailyGreen-Project/SCRIPTS/PHP/listReport.php')">VOLTAR</button>
                        <input type="submit" value="ARQUIVAR" class="archive" id="archive" name="archive" onclick="formArquivar()">
                        <input type="submit" value="SUSPENDER" class="suspend" id="suspend" name="suspend" onclick="formSuspend()">
                        <input type="submit" value="BANIR" class="ban" id="ban" name="ban" onclick="formBan()">
                    </div> <br>
                    <div class="formulario-arquivar" id="formulario-arquivar" name="formulario-arquivar">
                        <?php include "/xampp/htdocs/DailyGreen-Project/SCRIPTS/HTML/form_arquivar.html"; ?>
                    </div>
                    <div class="formulario-suspenso" id="formulario-suspenso" name="formulario-suspenso">
                        <?php include "/xampp/htdocs/DailyGreen-Project/SCRIPTS/HTML/form_suspend.html"; ?>
                    </div>
                    <div class="formulario-banido" id="formulario-banido" name="formulario-banido">
                        <?php include "/xampp/htdocs/DailyGreen-Project/SCRIPTS/HTML/form_ban.html"; ?>
                    </div>
                </fieldset>
            </fieldset>
        </div>
    </div>
    <?php endif; ?>
</div>