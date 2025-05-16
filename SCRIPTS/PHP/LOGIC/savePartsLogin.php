
<?php
include_once 'session.php';
include_once 'Cypher.php';
$_ENCODE = new EncodeDecode();
$_SESSION['inputs']['login']['email'] = $_POST['email'];
$_SESSION['inputs']['login']['password'] = $_ENCODE->encrypt($_POST['password']);
header('Location: /DailyGreen-Project/SCRIPTS/PHP/LOGIC/loginVerify.php');
