<?php
    include_once 'LOGIC/session.php';
    include_once 'LOGIC/SQL_connection.php';
    include_once 'LOGIC/functions.php';
    if ($_SESSION['user']['loged'] === false) {
        header("Location: /DailyGreen-Project/SCRIPTS/PHP/loginAdm.php");
        exit();
    }

    $sqlConnection = new SQLconnection();
    $denunciaArray = $sqlConnection->callTableBD('denuncia');

    // Chamando o id da denuncia ele foi passado pelo onclick no botão de analisar
    $id_denuncia = $_GET['id'];

    // JOIN para pegar os dados do relator, relatado e post
    $join = "SELECT denuncia.*, 
		relator.username AS relator_username, 
        relator.email AS relator_email, 
        relator.profile_pic AS relator_profile_pic, 
        relator.create_time AS relator_creation_date, 
        relatado.username AS relatado_username,
        relatado.email AS relatado_email,
        relatado.profile_pic AS relatado_profile_pic, 
        relatado.create_time AS relatado_creation_date,
        post.titulo AS post_titulo, 
        post.descricao AS post_descricao
        FROM denuncia
        JOIN participante AS relator ON denuncia.id_relator = relator.id_participante
        JOIN participante AS relatado ON denuncia.id_relatado = relatado.id_participante
        JOIN post ON denuncia.id_post = post.id_post
        WHERE denuncia.id_denuncia = {$id_denuncia};";

    $joinQuery = $sqlConnection->joinQueryBD($join);

    // Setando as variáveis do JOIN para exibir os dados
    if ($joinQuery && count($joinQuery) > 0) {
        // Relatado
        $relatado_id = $joinQuery[0]['id_relatado'];
        $relatado = $joinQuery[0]['relatado_username'];
        $relatado_email = $joinQuery[0]['relatado_email'];
        $relatado_pic = $joinQuery[0]['relatado_profile_pic'];
        $relatado_creation_date = $joinQuery[0]['relatado_creation_date'];
        // Relator
        $relator_id = $joinQuery[0]['id_relator'];
        $relator = $joinQuery[0]['relator_username'];
        $relator_email = $joinQuery[0]['relator_email'];
        $relator_pic = $joinQuery[0]['relator_profile_pic'];
        $relator_creation_date = $joinQuery[0]['relator_creation_date'];
        // Post
        $post_titulo = $joinQuery[0]['post_titulo'];
        $post_descricao = $joinQuery[0]['post_descricao'];
        // Denuncia
        $denuncia_data = $joinQuery[0]['data_registro'];
        $denuncia_motivo = $joinQuery[0]['titulo'];
        $denuncia_descricao = $joinQuery[0]['motivo'];
        $denuncia_status = $joinQuery[0]['status'];
    } else {
        echo "Nenhum resultado encontrado.";
    }
?>

<div class="navegacao_principal">
    <div class="form-analyse-report">
        <div class="container-dados-denuncia">
            <fieldset>
                <legend>RELATADO</legend>
                <div class="dados-relatado">
                    <div class="img-relatado">
                        <div><img src="<?= str_replace("/xampp/htdocs", "", htmlspecialchars($relatado_pic)) ?>"
                            alt="Avatar" style="width: 70px; height: 70px; border-radius: 50%;"></div>
                    </div>
                    <div class="info-relatado">
                        <div><?php echo "<b>Nome: </b>".$relatado; ?></div>
                        <div><?php echo "<b>Email: </b>".$relatado_email ?></div>
                        <div><?php echo "<b>Conta criada em: </b>".$relatado_creation_date ?></div>
                    </div>
                </div> <br>
                <fieldset>
                    <legend>RELATOR</legend>
                    <div class="dados-relator">
                        <div class="img-relator">
                            <div><img src="<?= str_replace("/xampp/htdocs", "", htmlspecialchars($relator_pic)) ?>"
                                alt="Avatar" style="width: 70px; height: 70px; border-radius: 50%;"></div>
                        </div>
                        <div class="info-relator">
                            <div><?php echo "<b>Nome: </b>".$relator; ?></div>
                            <div><?php echo "<b>Email: </b>".$relator_email ?></div>
                            <div><?php echo "<b>Conta criada em: </b>".$relator_creation_date ?></div>
                        </div>
                    </div> <br>
                    <fieldset>
                        <legend>INFORMAÇÕES DA DENÚNCIA</legend>
                        <div class="dados-denuncia">
                            <div><?php echo "<b>Motivo da Denúncia: </b>".$denuncia_motivo; ?></div>
                            <div><?php echo "<b>Descrição da Denúncia: </b>".$denuncia_descricao; ?></div>
                            <div><?php echo "<b>Data de Registro: </b>".$denuncia_data; ?></div>
                        </div> <br>
                        <fieldset>
                            <legend>POST DENUNCIADO</legend>
                            <div class="dados-post">
                                <div><?php echo "<b>Titulo do Post: </b>".$post_titulo ?></div>
                                <div><?php echo "<b>Descrição do Post: </b>".$post_descricao ?></div>
                            </div> <br>
                            <fieldset>
                                <legend>DECISÃO</legend>
                                <div class="decision">
                                    <button class="back-to-listReport" onclick="loadPage('/DailyGreen-Project/SCRIPTS/PHP/listReport.php')">VOLTAR</button>
                                    <input type="submit" value="DESCARTAR" class="discard" id="discard" name="discard" onclick="formDiscard()">
                                    <input type="submit" value="SUSPENDER" class="suspend" id="suspend" name="suspend" onclick="formSuspend()">
                                    <input type="submit" value="BANIR" class="ban" id="ban" name="ban" onclick="formBan()">
                                </div> <br>
                                <div class="formulario-discard" id="formulario-discard" name="formulario-discard">
                                    <?php include "/xampp/htdocs/DailyGreen-Project/SCRIPTS/HTML/form_discard.html"; ?>
                                </div>
                                <div class="formulario-suspenso" id="formulario-suspenso" name="formulario-suspenso">
                                    <?php include "/xampp/htdocs/DailyGreen-Project/SCRIPTS/HTML/form_suspend.html"; ?>
                                </div>
                                <div class="formulario-banido" id="formulario-banido" name="formulario-banido">
                                    <?php include "/xampp/htdocs/DailyGreen-Project/SCRIPTS/HTML/form_ban.html"; ?>
                                </div>
                            </fieldset>
                        </fieldset>
                    </fieldset>
                </fieldset>
            </fieldset>
        </div>
    </div>
</div>