<?php

namespace App\Helpers;

class Gdrian
{
    public static function encryptStr($data)
    {
        $iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length('AES-256-CBC'));
        $encrypted = openssl_encrypt($data, 'AES-256-CBC', PASSWORD_BCRYPT, 0, $iv);
        return base64_encode($iv . $encrypted);
    }

    public static function decryptStr($encryptedData)
    {
        $data = base64_decode($encryptedData);
        $iv = substr($data, 0, openssl_cipher_iv_length('AES-256-CBC'));
        $encrypted = substr($data, openssl_cipher_iv_length('AES-256-CBC'));
        return openssl_decrypt($encrypted, 'AES-256-CBC', PASSWORD_BCRYPT, 0, $iv);
    }
}
