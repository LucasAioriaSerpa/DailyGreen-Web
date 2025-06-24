
<?php
include_once '/xampp/htdocs/DailyGreen-Project/SCRIPTS/PHP/LOGIC/session.php';
if ($_SESSION['user']['find'] === false) {
    echo "<script type='text/javascript'> alert('Email ou senha incorretos!') </script>";
    $_SESSION['user']['find'] = null;
}
include_once "/xampp/htdocs/DailyGreen-Project/SCRIPTS/HTML/tela_de_login_adm.html";

