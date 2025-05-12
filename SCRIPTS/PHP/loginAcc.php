
<?php
    $loginArray = json_decode(file_get_contents('/xampp/htdocs/DailyGreen-Project/JSON/login.json'),true);
    if (!$loginArray["find"]){
        echo "<script type='text/javascript'> alert('Email ou senha incorretos!') </script>";
    }
    include_once "/xampp/htdocs/DailyGreen-Project/SCRIPTS/HTML/pagina_login.html";
