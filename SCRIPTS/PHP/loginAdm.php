
<?php
    session_start();
    include_once 'LOGIC/functions.php';
    if (!isset($_SESSION['initialized']) || $_SESSION['initialized'] === false) {
        $_SESSION['user'] = [
            'type' => 'ADM',
            'loged' => false,
            'account' => null
        ];
        $_SESSION['mySql'] = [
            'servername' => 'localhost',
            'username' => 'root',
            'password' => '',
            'database' => 'db_dailygreen',
            'port' => 3306
        ];
        $_SESSION['adm-user'] = [
            'loged' => false,
            'find' => null,
            'account' => null
        ];
        $_SESSION['initialized'] = true;
    }
    if ($_SESSION['adm-user']['find'] === false) {
        echo "<script type='text/javascript'> alert('Email ou senha incorretos!') </script>";
    }
    include_once "/xampp/htdocs/DailyGreen-Project/SCRIPTS/HTML/tela_de_login_adm.html";

