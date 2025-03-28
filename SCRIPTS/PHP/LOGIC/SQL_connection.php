
<?php
class SQL_connection {
    private array $sqlData = json_decode(file_get_contents("/xampp/htdocs/DailyGreen-Project/JSON/bd_info.json"), true);
    private array $serverInfo = [
        "servername"=>"{$this->sqlData["servername"]}",
        "username"=>"{$this->sqlData["username"]}",
        "password"=>"{$this->sqlData["password"]}",
        "database"=>"{$this->sqlData["database"]}",
        "port"=>"{$this->sqlData["port"]}"
    ];
    private mysqli $conn = new mysqli(  $this->serverInfo['servername'],
                                        $this->serverInfo['username'],
                                        $this->serverInfo['password'],
                                        $this->serverInfo['database'],
                                        $this->serverInfo['port']);
    public function connect() {
        if ($this->serverInfo["password"] === "") {
            header("Location: /DailyGreen-Project/SCRIPT/PHP/SQL_connection_error.php");
        }
        if ($this->conn->connect_error) {
            header("Connection Error: " . $this->conn->connect_error);
        }
    }

}
