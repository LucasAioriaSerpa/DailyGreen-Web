
<?php
class PullUserInfoJson {
    private $stringJSONurl;

    public function __construct($jsonUrl = "/xampp/htdocs/DailyGreen-Project/JSON/login.json") {
        $this->stringJSONurl = $jsonUrl;
    }

    private function getUserData() {
        return json_decode(file_get_contents($this->stringJSONurl), true)[0];
    }

    public function pullName() {
        return $this->getUserData()["username"];
    }

    public function pullProfileImage() {
        return str_replace("/xampp/htdocs", "", $this->getUserData()["profile_pic"]);
    }

    public function pullID() {
        return $this->getUserData()["id_participante"];
    }
    public function getArray() {
        return json_decode(file_get_contents($this->stringJSONurl), true);
    }
}

