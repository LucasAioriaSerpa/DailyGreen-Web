
<?php
include_once 'Cypher.php';
class SQLconnection {
    private EncodeDecode $encodeDecode;
    private array $sqlData;
    private array $serverInfo;
    public function __construct(){
        $this->encodeDecode = new EncodeDecode();
        $this->sqlData = $_SESSION['mySql'];
        $this->serverInfo = [
            "servername"=>"{$this->sqlData["servername"]}",
            "username"=>"{$this->sqlData["username"]}",
            "password"=>"{$this->sqlData["password"]}",
            "database"=>"{$this->sqlData["database"]}",
            "port"=>(int)$this->sqlData["port"]
        ];
    }

    public function tryConnectBD(bool $test) {
        try {
            $conn = new mysqli(     $this->serverInfo['servername'],
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
        if ($test) {
            if ($conn->connect_error) {
                echo "Connection failed: " . $conn->connect_error;
                return false;
            } else {
                echo "Connected successfully";
                return true;
            }
        } else {
            return $conn;
        }
    }
    public function insertQueryBD(string $query) {
        $conn = $this->tryConnectBD(false);
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
    public function callTableBD(string $table) {
        $data = [];
        $conn = $this->tryConnectBD(false);
        $table = $conn->real_escape_string($table);
        $sqlQuery = "SELECT * FROM `$table`";
        $result = $conn->query($sqlQuery);
        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $data[] = $row;
            }
        }
        $conn->close();
        return $data;
    }

    public function joinQueryBD(string $join){
        $conn = $this->tryConnectBD(false);
        $result = $conn->query($join);
        if ($result && $result->num_rows > 0) {
            $data = [];
            while ($row = $result->fetch_assoc()) {
                $data[] = $row;
            }
            $conn->close();
            return $data;
        } else {
            echo "Error: " . $conn->error;
            $conn->close();
            return false;
        }
    }
}
