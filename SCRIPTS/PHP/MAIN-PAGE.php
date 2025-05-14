
<?php
include_once 'LOGIC/session.php';
if ($_SESSION['user']['type'] === null){
    $_SESSION['user']['type'] = 'USER';
} else if ($_SESSION['user']['type'] === 'ADM') {
    $_SESSION['user']['type'] = 'USER';
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HOME | DailyGreen</title>
</head>
<body>
    <?php include_once '../HTML/pagina_apresentaçao.html' ?> <!--//? place holder por enquanto, dps deve ser desenvolvido uma home page mais completo @joao-au @Nikolas2606-->
</body>
</html>
