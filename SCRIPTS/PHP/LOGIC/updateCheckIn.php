
<?php
include_once 'session.php';
include_once 'SQL_connection.php';
include_once 'functions.php';
debug_var($_POST);
debug_var($_POST['checkin']);
$__sqlConnection = new SQLconnection();
$id_checklist = isset($_POST['id_checklist']) ? intval($_POST['id_checklist']) : 0;
$checkin = $_POST['checkin'] ?? [];
$id_post = isset($_POST['id_post']) ? intval($_POST['id_post']) : 0;
foreach (['not-checked' => 1, 'checked-un' => 0] as $key => $presente) {
    if (!empty($checkin[$key]) && is_array($checkin[$key])) {
        foreach ($checkin[$key] as $id_participante) {
            // ? verifica se o id_participante está em checkin['checked'] também, caso esteja, ignora e continua o looping
            if ($key === 'checked-un' && isset($checkin['checked']) && is_array($checkin['checked']) && in_array($id_participante, $checkin['checked'])) {continue;}
            // ? debug ?
            echo "checked to " . ($presente ? "On" : "Off") . "!<br>item_id:$id_participante<br>id_post:$id_post<br>";
            $id_participante = intval($id_participante);
            $query = "UPDATE checklist SET presente = $presente WHERE id_participante = $id_participante AND id_post = $id_post";
            $__sqlConnection->rawQueryBD($query);
        }
    }
}
header("Location: /DailyGreen-Project/SCRIPTS/PHP/postagens.php");
?>
