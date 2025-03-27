
<?php
$SQLdata = json_decode(file_get_contents("/xampp/htdocs/DailyGreen-Project/JSON/bd_info.json"), true);
$server_info = [
    "servername"=>"{$SQLdata["servername"]}",
    "username"=>"{$SQLdata["username"]}",
    "password"=>"{$SQLdata["password"]}",
    "database"=>"{$SQLdata["database"]}",
    "port"=>"{$SQLdata["port"]}"
];

if ($server_info["password"] === "") {
    header("Location: /DailyGreen-Project/SCRIPT/PHP/SQL_connection_error.php");
}

$conn = new mysqli( $server_info['servername'],
                    $server_info['username'],
                    $server_info['password'],
                    $server_info['database'],
                        $server_info['port']);

if ($conn->connect_error) {
    header("Connection Error: " . $conn->connect_error);
}
