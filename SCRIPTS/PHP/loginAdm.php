<?php
    $loginArray = json_decode(file_get_contents('/xampp/htdocs/DailyGreen-Project/JSON/loginAdm.json'),true);
    if (!$loginArray["find"]){
        echo "<script type='text/javascript'> alert('Email ou senha incorretos!') </script>";
    }
    
    include "/xampp/htdocs/DailyGreen-Project/SCRIPTS/HTML/tela_de_login_adm.html"; 
?>