
<?php
include 'Cypher.php';
class SQLconnection {
    private EncodeDecode $decode = new EncodeDecode();
    private array $sqlData = json_decode(file_get_contents("/xampp/htdocs/DailyGreen-Project/JSON/bd_info.json"), true);
    private array $serverInfo = [
        "servername"=>"{$this->sqlData["servername"]}",
        "username"=>"{$this->sqlData["username"]}",
        "password"=>"{$this->sqlData["password"]}",
        "database"=>"{$this->sqlData["database"]}",
        "port"=>"{$this->sqlData["port"]}"
    ];
    public function tryConnectBD() {
        $conn = new mysqli( $this->serverInfo['servername'],
                            $this->serverInfo['username'],
                            $this->decode->decrypt($this->serverInfo['password']),
                            $this->serverInfo['database'],
                            $this->serverInfo['port']);
        if ($conn->connect_error) {
            header("Location: /DailyGreen-Project/SCRIPT/PHP/SQL_connection_error.php");
        }
        return $conn;
    }
    public function insertQueryBD(string $query) {
        $conn = $this->tryConnectBD();
        if ($conn->query($query) === true) {
            $last_id = $conn->insert_id;
            echo "New recorded created sucessfully. Last ID: " . $last_id;
            return $last_id;
        } else {
            echo "Error: " . $query . "<br>" . $conn->error;
            return false;
        }
    }
    public function callQueryBD(string $query) {
        $conn = $this->tryConnectBD();
        $result = mysqli_query($conn, $query);
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetc)
        }
    }
}
