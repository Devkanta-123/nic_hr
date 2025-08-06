<?php

namespace app\misc;
class Sodium {

    static  $keypair = "VqosqLXT/SyvAuon0+EAEfWyMGLUII2x8IsoNaE98daMmPmq1WY/JgM4GtHVYgldG0m9DmG745zQ1bQvslVxZw==";
    
    /**
     * Encrypt a message
     * 
     * @param string $message - message to encrypt
     * @param string $key - encryption key
     * @return string
     */
    static function safeEncrypt($message) {

        $key = sodium_crypto_box_publickey(base64_decode(self::$keypair));
        $cipher = sodium_crypto_box_seal($message, $key);
        return base64_encode($cipher);
    }

    /**
     * Decrypt a message
     * 
     * @param string $encrypted - message encrypted with safeEncrypt()
     * @param string $key - encryption key
     * @return string
     */
    static function safeDecrypt($cipher)
    {
        $cipher = base64_decode($cipher);

        return sodium_crypto_box_seal_open($cipher, base64_decode(self::$keypair));
    }
}
