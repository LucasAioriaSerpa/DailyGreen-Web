<?php
    include_once 'LOGIC/session.php';
    include_once 'LOGIC/SQL_connection.php';
    include_once 'LOGIC/functions.php';

    if ($_SESSION['user']['loged'] === false) {
        header("Location: /DailyGreen-Project/SCRIPTS/PHP/loginAdm.php");
        exit();
    }
    $sqlConnection = new SQLconnection();
    $id_suspenso = (int) $_GET['id'];

?>

<div class="form-analyse-suspend">
    <div class="info-suspend">
        <div class="info-user-suspend">
            <fieldset>
                <legend>INFORMAÇÕES DO USUÁRIO</legend>
                <div class="dados-user-suspend">
                    <div><?php echo $id_suspenso; ?></div>
                </div>
            </fieldset><br>
            <fieldset>
                <legend>INFORMAÇÕES DA DENÚNCIA</legend>
                <div class="info-suspend-denuncia">

                </div>
            </fieldset><br>
            <fieldset>
                <legend>HISTÓRICO DE DENÚNCIAS</legend>
                <div>

                </div>
            </fieldset><br>
        </div>
    </div>
</div>