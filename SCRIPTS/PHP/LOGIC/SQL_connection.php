
<?php
class SQL_connection {
    private array $SQLdata = json_decode(file_get_contents("/xampp/htdocs/DailyGreen-Project/JSON/bd_info.json"), true);
    private array $server_info = [
        "servername"=>"{$SQLdata["servername"]}",
        "username"=>"{$SQLdata["username"]}",
        "password"=>"{$SQLdata["password"]}",
        "database"=>"{$SQLdata["database"]}",
        "port"=>"{$SQLdata["port"]}"
    ];
    function try_connect() {
        if ($this->server_info["password"] === "") {
            header("Location: /DailyGreen-Project/SCRIPT/PHP/SQL_connection_error.php");
        }
        $conn = new mysqli( $this->server_info['servername'],
                            $this->server_info['username'],
                            $this->server_info['password'],
                            $this->server_info['database'],
                                $this->server_info['port']);
        if ($conn->connect_error) {
            header("Connection Error: " . $conn->connect_error);
        }
    }

}
