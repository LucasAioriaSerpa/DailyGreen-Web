<?php
include_once 'Cypher.php';

class SQLconnection {
    private EncodeDecode $encodeDecode;
    private array $serverInfo;

    public function __construct() {
        $this->encodeDecode = new EncodeDecode();
        $sqlData = $_SESSION['mySql'];
        $this->serverInfo = [
            "servername" => $sqlData["servername"],
            "username" => $sqlData["username"],
            "password" => $sqlData["password"],
            "database" => $sqlData["database"],
            "port" => (int) $sqlData["port"]
        ];
    }

    private function connect(): mysqli {
        try {
            $conn = @new mysqli(
                $this->serverInfo['servername'],
                $this->serverInfo['username'],
                $this->encodeDecode->decrypt($this->serverInfo['password']),
                $this->serverInfo['database'],
                $this->serverInfo['port']
            );
            if ($conn->connect_error) {
                throw new Exception("Connection Failed: " . $conn->connect_error);
            }
        } catch (Exception $e) {
            error_log($e->getMessage());
            header("Location: /DailyGreen-Project/SCRIPTS/PHP/SQL_connection_error.php");
            exit();
        }
        return $conn;
    }

    public function tryConnectBD(bool $test) {
        $conn = $this->connect();
        if ($test) {
            $success = !$conn->connect_error;
            $conn->close();
            return $success;
        }
        return $conn;
    }

    public function insertQueryBD(string $query) {
        $conn = $this->connect();
        $result = $conn->query($query);
        $last_id = $result ? $conn->insert_id : false;
        $conn->close();
        return $last_id;
    }

    public function callTableBD(string $table): array {
        $conn = $this->connect();
        $table = $conn->real_escape_string($table);
        $sqlQuery = "SELECT * FROM `$table`";
        $result = $conn->query($sqlQuery);
        $data = [];
        if ($result) {
            while ($row = $result->fetch_assoc()) {
                $data[] = $row;
            }
            $result->free();
        }
        $conn->close();
        return $data;
    }

    public function joinQueryBD(string $join) {
        $conn = $this->connect();
        $result = $conn->query($join);
        $data = false;
        if ($result && $result->num_rows > 0) {
            $data = [];
            while ($row = $result->fetch_assoc()) {
                $data[] = $row;
            }
            $result->free();
        }
        $conn->close();
        return $data;
    }

    public function rawQueryBD(string $query) {
        $conn = $this->connect();
        $result = $conn->query($query);
        if ($result === true) {
            $conn->close();
            return true;
        } elseif ($result instanceof mysqli_result) {
            $data = [];
            while ($row = $result->fetch_assoc()) {
                $data[] = $row;
            }
            $result->free();
            $conn->close();
            return $data;
        } else {
            error_log("SQL Error: " . $conn->error);
            $conn->close();
            return false;
        }
    }
}
