<?php namespace ZN\Cryptography\Drivers;

use ZN\Cryptography\CryptoMapping;

class HashDriver extends CryptoMapping
{
    //--------------------------------------------------------------------------------------------------------
    //
    // Author     : Ozan UYKUN <ozanbote@gmail.com>
    // Site       : www.znframework.com
    // License    : The MIT License
    // Telif Hakkı: Copyright (c) 2012-2016, znframework.com
    //
    //--------------------------------------------------------------------------------------------------------

    //--------------------------------------------------------------------------------------------------------
    // Encrypt
    //--------------------------------------------------------------------------------------------------------
    // 
    // @param  string $driver
    // @return bool
    //
    //--------------------------------------------------------------------------------------------------------
    public function encrypt($data, $settings)
    {
        $cipher = isset($settings['cipher']) ? $settings['cipher'] : 'sha256';
        $key    = isset($settings['key'])    ? $settings['key']    : $this->config['key']; 
        
        return base64_encode(trim(hash_hmac($cipher, $data, $key)));
    }

    //--------------------------------------------------------------------------------------------------------
    // Keygen
    //--------------------------------------------------------------------------------------------------------
    //
    // @param numeric $length
    //
    //--------------------------------------------------------------------------------------------------------
    public function keygen($length)
    {
        return hash_pbkdf2('md5', md5(mt_rand()), mcrypt_create_iv($length, MCRYPT_DEV_URANDOM), $length, $length);
    }
}