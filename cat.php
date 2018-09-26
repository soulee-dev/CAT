<?php

class CAT {
    private $defsalt;

    function __contruct($defsalt) {
        $this -> defsalt = $defsalt;
    }

    function CreateToken($payload, $salt = null) {
        $data = base64_encode($payload) . "." . hash_hmac("sha256", base64_encode($payload), $this -> defsalt . $salt);

        return($data);
    }

    function VerifyToken($data, $acl, $ref, $salt = null) {
        $str = explode(".", $data);

        if(count($str) <= 1) {
            return false;
        }

        if(hash_hmac("sha256", $str[0], $this -> defsalt . $salt) == $str[1]) {

            $jsondcode = json_decode(base64_decode($str[0]));

            if(intval($jsondcode -> {"expire"}) > time() && $acl == $jsondcode -> {"acl"} && $jsondcode -> {"ipadr"} == $_SERVER["REMOTE_ADDR"] && $_SERVER['HTTP_REFERER'] == $ref) {
                return true;
            }
            return false;
        }
        return false;
    }
}
?>
