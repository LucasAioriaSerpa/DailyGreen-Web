
<?php
    class EncodeDecode {
        private string $method = "aes-256-cbc";
        private $iv_length = null;
        public function __construct() {
            $this->iv_length = openssl_cipher_iv_length("aes-256-cbc");
        }
        public function encrypt(string $data) {
            $key = base64_decode("bnAXdVmdrbb3UeB8lpJsuWOeS8nq2Hbz0nZyyXiDykq71OFmkUigFtVJVQAT2i8UrM7Qz4X8f74qXxnJLGDlvQ==");
            $iv = openssl_random_pseudo_bytes($this->iv_length);
            $encryptedData = openssl_encrypt($data,$this->method,$key, OPENSSL_RAW_DATA, $iv);
            $encryptedData_hashMask = hash_hmac('sha3-512',$encryptedData, $key, true);
            $output = base64_encode($iv.$encryptedData_hashMask.$encryptedData);
            return $output;
        }
        public function decrypt(string $input) {
            $key = base64_decode("bnAXdVmdrbb3UeB8lpJsuWOeS8nq2Hbz0nZyyXiDykq71OFmkUigFtVJVQAT2i8UrM7Qz4X8f74qXxnJLGDlvQ==");
            $mix = base64_decode($input);
            $iv = substr($mix,0,$this->iv_length);
            $hashMask_encrypt = substr($mix,$this->iv_length,64);
            $encrypt = substr($mix,$this->iv_length+64);
            $data = openssl_decrypt($encrypt,$this->method,$key, OPENSSL_RAW_DATA,$iv);
            $data_hashMask = hash_hmac('sha3-512',$encrypt,$key,true);
            if (hash_equals($hashMask_encrypt,$data_hashMask)) {return $data;}
            echo "Cypher.php - something wrong happened!";
            return false;
        }
    }
