
<?php
include_once 'session.php';
include_once 'SQL_connection.php';
include_once 'functions.php';
$__sqlConnection = new SQLconnection();
$_checkListArray = $__sqlConnection->callTableBD('checklist');
foreach ($_checkListArray as $checkList) {
    if ($_POST['id_participante'] == $checkList['id_participante'] && $_POST['id_post'] == $checkList['id_post']) {
        echo "off";
        $_query = "DELETE FROM checklist WHERE id_participante = '{$_POST["id_participante"]}' AND id_post = '{$_POST["id_post"]}'";
        $__sqlConnection->rawQueryBD($_query);
        header("Location: /DailyGreen-Project/SCRIPTS/PHP/postagens.php");
        exit();
    }
}
echo "on";
$id_participante = $_POST['id_participante'];
$id_post = $_POST['id_post'];
$_query = "INSERT INTO checklist (
    id_participante,
    id_post,
    presente
) VALUES (
    '{$id_participante}',
    '{$id_post}',
    '0'
)";
$__sqlConnection->insertQueryBD($_query);
header("Location: /DailyGreen-Project/SCRIPTS/PHP/postagens.php");
?>
