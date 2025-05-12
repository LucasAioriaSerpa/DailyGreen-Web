
<?php
include_once 'LOGIC/session.php';
if ($_SESSION['user']['type'] === null){
    $_SESSION['user']['type'] = 'ADM';
} else if ($_SESSION['user']['type'] === 'USER') {
    $_SESSION['user']['type'] = 'ADM';
}
if ($_SESSION['adm-user']['find'] === false) {
    echo "<script type='text/javascript'> alert('Email ou senha incorretos!') </script>";
}
include_once "/xampp/htdocs/DailyGreen-Project/SCRIPTS/HTML/tela_de_login_adm.html";

