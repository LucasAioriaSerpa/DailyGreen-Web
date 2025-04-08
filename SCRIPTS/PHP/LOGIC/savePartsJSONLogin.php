
<?php
include 'arrayJSON.php';
$loginJSON = json_encode(updateLoginSave(), JSON_PRETTY_PRINT);
file_put_contents('/xampp/htdocs/DailyGreen-Project/JSON/login.json', $loginJSON);
header('Location: /DailyGreen-Project/SCRIPTS/PHP/...');
