
<?php
include "functions.php";
class EncodeDecode {
    private string $method = "aes-256-cbc";
    private $iv_length = null;
    public function __construct() {
        $this->iv_length = openssl_cipher_iv_length("aes-256-cbc");
    }
    public function encrypt(string $data) {
        $key = base64_decode(json_decode(file_get_contents("/xampp/htdocs/DailyGreen-Project/JSON/cypher_data.json"), true)["key"]);
        $iv = openssl_random_pseudo_bytes($this->iv_length);
        $encryptedData = hash_hmac('sha3-512',openssl_encrypt($data,$this->method,$key, OPENSSL_RAW_DATA, $iv), $key, TRUE);
        $output = base64_encode($iv.$encryptedData);
        return $output;
    }
    public function decrypt(string $input) {
        //! there is some problem in the IV and encrypted data when trying to separate the strings . _ .)
        $key = base64_decode(json_decode(file_get_contents("/xampp/htdocs/DailyGreen-Project/JSON/cypher_data.json"), true)["key"]);
        $mix = base64_decode($input);
        $iv = substr($mix,0,$this->iv_length);
        $substr_encrypt = substr($mix,$this->iv_length);
        $data = hash_hmac('sha3-512',openssl_decrypt($substr_encrypt,$this->method,$key,OPENSSL_RAW_DATA,$iv),$key, TRUE);
        if (hash_equals($substr_encrypt,$data)) {return $data;}
        echo "something wrong happened!";
        return false;
    }
}
