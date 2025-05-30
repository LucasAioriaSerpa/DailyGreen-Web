<?php
include_once 'session.php';
include_once 'uploadImage.php';
include_once 'Cypher.php';
include_once 'functions.php';

debug_var($_SESSION['user']['account']);
debug_var($_POST);


$idParticipante = $_SESSION['user']['account'][0]['id_participante'];
$uploader = new ImageUploader('/xampp/htdocs/DailyGreen-Project/IMAGES/PROFILES/');
$newProfilePic = $uploader->upload($_FILES['file']);
$profile_pic = $_POST['profile_pic'];

$sqlQuery = "
    UPDATE participante SET 
    profile_pic = '{$newProfilePic}'
    WHERE id_participante = '{$idParticipante}'
    ";
    $sqlConnection->insertQueryBD($sqlQuery);

$sqlQuery = "
UPDATE participante SET 
profile_pic = '{$profile_pic}'
WHERE id_participante = '{$idParticipante}'
";
$sqlConnection->insertQueryBD($sqlQuery);
$_SESSION['user']['account'][0]['profile_pic'] = $newProfilePic;
$_SESSION['user']['account'][0]['profile_pic'] = $profile_pic;
header("Location: /DailyGreen-Project/SCRIPTS/PHP/pagina_perfil.php");