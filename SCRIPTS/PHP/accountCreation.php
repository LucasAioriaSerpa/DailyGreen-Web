
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
</head>
<body>
    <?php
    switch ($pagCadastroDATA) {
        case "0":
            return include "/xampp/htdocs/DailyGreen-Project/SCRIPTS/HTML/pagina_cadastro.html";
        case "1-1":
            return include "/xampp/htdocs/DailyGreen-Project/SCRIPTS/HTML/pagina_cadastro_organizacao.html";
        case "1":
            return include "/xampp/htdocs/DailyGreen-Project/SCRIPTS/HTML/pagina_cadastro2.html";
        case "2":
            return include "/xampp/htdocs/DailyGreen-Project/SCRIPTS/HTML/pagina_cadastro3.html";
        default:
            echo "parte inválida!";
            break;
    }
    ?>
</body>
</html>
