<?php

class CAT {
    private $defsalt;

    function __contruct($defsalt) {
        $this -> defsalt = $defsalt;
    }

    function CreateToken($payload, $salt = null) {
        $data = "";

        $data = base64_encode($payload) . "." . hash_hmac("sha256", base64_encode($payload), $this -> defsalt . $salt);

        return($data);
    }

    function VerifyToken($data, $salt = null) {
        $str = explode(".", $data);

        if(hash_hmac("sha256", $str[0], $this -> defsalt . $salt) == $str[1]) {
            return true;
        }
        else
        {
            return false;
        }
    }
}
?>