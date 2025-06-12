<?php
include_once 'LOGIC/session.php';
include_once 'LOGIC/functions.php';
$pagCadastroDATA = $_SESSION['inputs']['cadastro']['cad-part'];
?>

<!DOCTYPE html>
<html lang="pt-BR">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Cadastro | DailyGreen</title>
        <link rel="icon" type="image/x-icon" href="/DailyGreen-Project/IMAGES/dailyGreen-icon.ico">
        <style>
            .error-message {
                position: fixed;
                top: 20px;
                left: 50%;
                transform: translateX(-50%);
                background-color: #ff6b6b;
                color: white;
                padding: 15px 25px;
                border-radius: 5px;
                box-shadow: 0 3px 10px rgba(0,0,0,0.2);
                z-index: 1000;
                animation: fadeIn 0.3s, fadeOut 0.3s 2.7s forwards;
            }
            @keyframes fadeIn {
                from { opacity: 0; top: 0; }
                to { opacity: 1; top: 20px; }
            }
            @keyframes fadeOut {
                from { opacity: 1; top: 20px; }
                to { opacity: 0; top: 0; }
            }
        </style>
    </head>
    <body>
        <?php if (isset($_SESSION['error'])): ?>
            <div class="error-message">
                <?php
                    echo $_SESSION['error'];
                    unset($_SESSION['error']); // Remove a mensagem após exibir
                ?>
            </div>
        <?php endif; ?>

        <?php
        switch ($pagCadastroDATA) {
            case "0":
                include "/xampp/htdocs/DailyGreen-Project/SCRIPTS/HTML/pagina_cadastro.html";
                break;
            case "1-1":
                include "/xampp/htdocs/DailyGreen-Project/SCRIPTS/HTML/pagina_cadastro_organizacao.html";
                break;
            case "1":
                include "/xampp/htdocs/DailyGreen-Project/SCRIPTS/HTML/pagina_cadastro2.html";
                break;
            case "2":
                include "/xampp/htdocs/DailyGreen-Project/SCRIPTS/HTML/pagina_cadastro3.html";
                break;
            default:
                echo "parte inválida!";
                break;
        }
        ?>
    </body>
</html>