
<?php
include_once 'functions.php';
session_start();
debug_var($_SESSION['adm-user']);
if ($_SESSION['adm-user']['loged']) {
    $_SESSION['adm-user']['loged'] = false;
    $_SESSION['adm-user']['find'] = null;
    $_SESSION['adm-user']['account'] = null;
    session_destroy();
    header("Location: /DailyGreen-Project/SCRIPTS/PHP/loginAdm.php");
} else {
    echo "<script type='text/javascript'> alert('Você não está logado!') </script>";
    header("Location: /DailyGreen-Project/SCRIPTS/PHP/loginAdm.php");
}
