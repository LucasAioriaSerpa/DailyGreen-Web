
<?php
include_once 'session.php';
include_once 'SQL_connection.php';
include_once 'functions.php';
debug_var($_POST['checkin']);
$__sqlConnection = new SQLconnection();
$id_checklist = $_POST['id_checklist'];
if (isset($_POST['checkin']['checked'])) {
    foreach ($_POST['checkin'] as $checkin) {
        $checkin = intval($checkin);
        $query = "UPDATE checklist SET presente = '0' WHERE id_checklist = '{$id_checklist}' AND id_participante = '{$checkin}'";
        $__sqlConnection->rawQueryBD($query);
        header("Location: /DailyGreen-Project/SCRIPTS/PHP/postagens.php");
    }
} elseif (isset($_POST['checkin']['not-checked'])) {
    foreach ($_POST['checkin'] as $checkin) {
        $checkin = intval($checkin);
        $query = "UPDATE checklist SET presente = '1' WHERE id_checklist = '{$id_checklist}' AND id_participante = '{$checkin}'";
        $__sqlConnection->rawQueryBD($query);
        header("Location: /DailyGreen-Project/SCRIPTS/PHP/postagens.php");
    }
}
header("Location: /DailyGreen-Project/SCRIPTS/PHP/postagens.php");
?>
