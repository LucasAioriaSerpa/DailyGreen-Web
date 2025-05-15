
<?php
include_once 'LOGIC/session.php';
include_once 'LOGIC/Cypher.php';
include_once 'LOGIC/functions.php';
if ($_SESSION['user']['find'] === false){
    echo "<script type='text/javascript'> Swal.fire({title: 'Erro!', text: 'Email ou senha incorretos.', icon: 'error'}) </script>";
    $_SESSION['user']['find'] = null;
}
include_once "/xampp/htdocs/DailyGreen-Project/SCRIPTS/HTML/pagina_login.html";
?>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>