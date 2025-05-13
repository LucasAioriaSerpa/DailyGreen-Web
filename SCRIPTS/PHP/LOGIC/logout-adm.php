
<?php
include_once 'functions.php';
session_start();
debug_var($_SESSION['adm-user']);
if ($_SESSION['user']['loged']) {
    $_SESSION['user']['loged'] = false;
    $_SESSION['user']['find'] = null;
    $_SESSION['user']['account'] = null;
    session_destroy();
    header("Location: /DailyGreen-Project/SCRIPTS/PHP/loginAdm.php");
} else {
    echo "<script type='text/javascript'> alert('Você não está logado!') </script>";
    header("Location: /DailyGreen-Project/SCRIPTS/PHP/loginAdm.php");
}
