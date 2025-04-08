
<?php
include_once 'Cypher.php';
class SQLconnection {
    private EncodeDecode $decode;
    private array $sqlData;
    private array $serverInfo;
    public function __construct(){
        $this->decode = new EncodeDecode();
        $this->sqlData = json_decode(file_get_contents("/xampp/htdocs/DailyGreen-Project/JSON/bd_info.json"), true);
        $this->serverInfo = [
            "servername"=>"{$this->sqlData["mySql"]["servername"]}",
            "username"=>"{$this->sqlData["mySql"]["username"]}",
            "password"=>"{$this->sqlData["mySql"]["password"]}",
            "database"=>"{$this->sqlData["mySql"]["database"]}",
            "port"=>"{$this->sqlData["mySql"]["port"]}"
        ];
    }

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
    public function callTableBD(string $table) {
        $conn = $this->tryConnectBD();
        $sqlQuery = "SELECT * FROM " . $table;
        $stmt = $conn->prepare($sqlQuery);
        $stmt->execute();
        // $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
