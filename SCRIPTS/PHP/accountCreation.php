
<?php
include_once 'LOGIC/functions.php';
$pagCadastroDATA = json_decode(file_get_contents("/xampp/htdocs/DailyGreen-Project/JSON/pag_cadastro.json"), true);
switch ($pagCadastroDATA["cad-part"]) {
    case "0":
        return include "/xampp/htdocs/DailyGreen-Project/SCRIPTS/HTML/pagina_cadastro.html";
    case "1":
        if ($pagCadastroDATA["part-1"]["org"]) {
            return include "/xampp/htdocs/DailyGreen-Project/SCRIPTS/HTML/pagina_cadastro_organizacao.html";
        }
        return include "/xampp/htdocs/DailyGreen-Project/SCRIPTS/HTML/pagina_cadastro2.html";
    case "2":
        return include "/xampp/htdocs/DailyGreen-Project/SCRIPTS/HTML/pagina_cadastro3.html";
    default:
        echo "parte inválida!";
        break;
}
?>
