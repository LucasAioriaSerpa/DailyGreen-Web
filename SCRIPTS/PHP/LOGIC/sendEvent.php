<?php
include_once 'session.php';
include_once 'SQL_connection.php';
include_once 'uploadImage.php';
include_once 'functions.php';
debug_var($_POST);
$sqlConnection = new SQLconnection();
$id_autor = $_POST["id_participante"];
$titulo = $_POST["titulo"];
$descricao = $_POST["descricao"];
$sqlQuery_1 = "INSERT INTO post(
    id_autor,
    titulo,
    descricao
) VALUES (
    '{$id_autor}',
    '{$titulo}',
    '{$descricao}'
)";
$last_id = $sqlConnection->insertQueryBD($sqlQuery_1);
$id_organizacao = $_POST["id_organizacao"];
$id_post = $last_id;
$data_hora_inicio = $_POST["dataTimeInicio"]; //? YYYY-MM-DD HH:MI:SS
$data_hora_fim = $_POST["dataTimeFim"]; //? YYYY-MM-DD HH:MI:SS
$local = $_POST["local"];
$link = $_POST["link"];
$sqlQuery_2 = "INSERT INTO evento(
    id_organizacao,
    id_post,
    data_hora_inicio,
    data_hora_fim,
    local,
    link
) VALUES (
    '{$id_organizacao}',
    '{$id_post}',
    '{$data_hora_inicio}',
    '{$data_hora_fim}',
    '{$local}',
    '{$link}'
)";
$sqlConnection->insertQueryBD($sqlQuery_2);
if (!isset($_FILE)) {
    $_UPLOAD_MEDIA = new ImageUploader("/xampp/htdocs/DailyGreen-Project/IMAGES/POSTs/");
    for ($i = 0; $i < sizeof($_FILES['insert_media']['name']); $i++) {
        if ($_FILES['insert_media']['error'][$i] == 0) {
            $fileArray = [
                'tmp_name' => $_FILES['insert_media']['tmp_name'][$i],
                'error' => $_FILES['insert_media']['error'][$i],
                'name' => $_FILES['insert_media']['name'][$i],
                'type' => $_FILES['insert_media']['type'][$i],
                'size' => $_FILES['insert_media']['size'][$i]
            ];
            $file = $_UPLOAD_MEDIA->upload($fileArray);
            $sqlQuery = "INSERT INTO midia(
                id_post,
                midia_ref
            ) VALUES (
                '{$last_id}',
                '{$file}'
            )";
            $sqlConnection->insertQueryBD($sqlQuery);
        }
    }
}
header("Location: /DailyGreen-Project/SCRIPTS/PHP/postagens.php");
