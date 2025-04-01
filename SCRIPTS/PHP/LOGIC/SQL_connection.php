
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
    public function testConnect() {
        $conn = new mysqli( $this->serverInfo['servername'],
                            $this->serverInfo['username'],
                            $this->serverInfo['password'],
                            $this->serverInfo['database'],
                            $this->serverInfo['port']);
        if ($conn->connect_error) {
            header("Location: /DailyGreen-Project/SCRIPT/PHP/SQL_connection_error.php");
        }
    }
    public function addNewParticipant(array $arrayDATA) {
        
    }
}
