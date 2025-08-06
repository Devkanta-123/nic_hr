<?php
namespace app\misc;

class AES
{
    //Define cipher
    static $method = "aes-256-cbc";

    //Generate a 256-bit encryption key
    static $encryption_key = "2iWa2p/3SWvXNxyp1aBTBaOCmXQHo6m0JGtwziJ079E=";

    // Generate an initialization vector
    static $iv = "9AO/tSbPMHiXA5bk4a+cEw==";

    /**
     * Encrypt a message
     *
     * @param string $data - data to encrypt
     * @return string
     */
    static function encrypt($data) {
        return openssl_encrypt($data, self::$method, base64_decode(self::$encryption_key), 0, base64_decode(self::$iv));
    }

    /**
     * Decrypt a message
     *
     * @param string $cipher - cipher to be decrypted
     * @return string
     */
    static function decrypt($cipher)
    {
        return openssl_decrypt($cipher, self::$method, base64_decode(self::$encryption_key), 0, base64_decode(self::$iv));
    }
}