
<?php
include_once 'Cypher.php';
class SQLconnection {
    private EncodeDecode $encodeDecode;
    private array $sqlData;
    private array $serverInfo;
    public function __construct(){
        $this->encodeDecode = new EncodeDecode();
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
        try {
            return $conn = new mysqli(  $this->serverInfo['servername'],
                                        $this->serverInfo['username'],
                                        $this->encodeDecode->decrypt($this->serverInfo['password']),
                                        $this->serverInfo['database'],
                                            $this->serverInfo['port']);
        } catch (mysqli_sql_exception $e) {
            echo $e;
            error_log("Connection Failed: " . $conn->connect_error);
            header("Location: /DailyGreen-Project/SCRIPTS/PHP/SQL_connection_error.php");
            exit();
        }
    }
    public function insertQueryBD(string $query) {
        $conn = $this->tryConnectBD();
        if ($conn->query($query) === true) {
            $last_id = $conn->insert_id;
            echo "New recorded created sucessfully. Last ID: " . $last_id;
            $conn->close();
            return $last_id;
        } else {
            echo "Error: " . $query . "<br>" . $conn->error;
            $conn->close();
            return false;
        }
    }
    public function callTableBD(string $table, bool $password) {
        $data = [];
        $conn = $this->tryConnectBD();
        $table = $conn->real_escape_string($table);
        $sqlQuery = "SELECT * FROM `$table`";
        $result = $conn->query($sqlQuery);
        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $data[] = $row;
            }
        }
        if ($password) {
            $i = 0;
            foreach ($data as $value) {
                $passwordEncripted = $this->encodeDecode->encrypt($value["password"]);
                $data[$i]["password"] = $passwordEncripted;
                $i++;
            }
        }
        $conn->close();
        return $data;
    }
}

$sqlObj = new SQLconnection();
$sqlObj->tryConnectBD();
