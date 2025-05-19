
<?php
include_once 'session.php';
include_once 'SQL_connection.php';
include_once 'uploadImage.php';
include_once 'functions.php';
$sqlConnection = new SQLconnection();
$id_autor = $_POST["id_participante"];
$titulo = $_POST["titulo"];
$descricao = $_POST["descricao"];
$sqlQuery = "INSERT INTO post(
    id_autor,
    titulo,
    descricao
) VALUES (
    '{$id_autor}',
    '{$titulo}',
    '{$descricao}'
)";
$last_id = $sqlConnection->insertQueryBD($sqlQuery);
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
