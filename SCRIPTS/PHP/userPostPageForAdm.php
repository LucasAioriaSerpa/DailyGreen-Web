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
    <fieldset>
        <legend>USUÁRIO</legend>
        <div><?php echo "ID do Participante: ".$id_participante ?></div>
        <div><?php echo "Email do Participante: " ?></div>
    </fieldset><br>
    <fieldset>
        <legend>POSTS</legend>
        <div>
            <?php 
                if ($joinQuery && count($joinQuery) > 0){
                    $participante_username = $joinQuery[0]['participante_username']; // mesmo nome em todos os posts

                    foreach ($joinQuery as $post) {
                        echo "<hr>";
                        echo "<h3 class='titulo-post-user' style='padding: 20px'>" . "TITULO\n".$post['titulo'] . "</h3>";
                        echo "<p class='descricao-post-user' style='padding: 20px'>" . "DESCRIÇÃO\n".$post['descricao'] . "</p>";
                        echo "<hr> <br>";
                    }
                } else {
                    echo "Nenhum resultado encontrado.";
                }
            ?>
        </div>
    </fieldset>
</div>