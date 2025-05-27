<?php
include_once 'LOGIC/session.php';
include_once 'LOGIC/Cypher.php';
include_once 'LOGIC/functions.php';
if ($_SESSION['user']['find'] === false) {
    $_SESSION['user']['find'] = null;
    
    echo 
    '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
    document.addEventListener("DOMContentLoaded", function() {
        Swal.fire({
            icon: "error",
            title: "Login inválido",
            text: "O login ou senha estão incorretos ou não existem."
        }).then(() => {
            window.location.href = "/DailyGreen-Project/SCRIPTS/PHP/loginAcc.php";
        });
    });
    </script>';
    exit();
}

include_once "/xampp/htdocs/DailyGreen-Project/SCRIPTS/HTML/pagina_login.html";
?>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>