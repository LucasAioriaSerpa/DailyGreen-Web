
<?php
    $loginArray = json_decode(file_get_contents('/xampp/htdocs/DailyGreen-Project/JSON/login.json'),true);
    if (!$loginArray["find"]){
        echo "<script type='text/javascript'> Swal.fire({title: 'Erro!', text: 'Email ou senha incorretos.', icon: 'error'}) </script>";
    }
    include_once "/xampp/htdocs/DailyGreen-Project/SCRIPTS/HTML/pagina_login.html";
?>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>