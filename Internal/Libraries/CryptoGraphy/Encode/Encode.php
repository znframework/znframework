<?php namespace ZN\CryptoGraphy;

use Exceptions, CLController;
use ZN\CryptoGraphy\Exception\InvalidArgumentException;

class InternalEncode extends CLController implements EncodeInterface
{
    //--------------------------------------------------------------------------------------------------------
    //
    // Author     : Ozan UYKUN <ozanbote@gmail.com>
    // Site       : www.znframework.com
    // License    : The MIT License
    // Telif Hakkı: Copyright (c) 2012-2016, znframework.com
    //
    //--------------------------------------------------------------------------------------------------------

    const config = ['CryptoGraphy:encode', 'Project'];

    //--------------------------------------------------------------------------------------------------------
    // Create
    //--------------------------------------------------------------------------------------------------------
    //
    // @param int    $count
    // @param string $chars
    //
    //--------------------------------------------------------------------------------------------------------
    public function create(Int $count = 6, String $chars = 'all') : String
    {
        $password = '';

        // Şifreleme için kullanılacak karakter listesi.
        if( $chars === "all" || $chars === 'alnum' )
        {
            $characters = "1234567890abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOQPRSTUVWXYZ";
        }
        if( $chars === "numeric" )
        {
            $characters = "1234567890";
        }
        if( $chars === "string" || $chars === "alpha" )
        {
            $characters = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOQPRSTUVWXYZ";
        }

        // Parametre olarak belirtilen sayı kadar karakter
        // listesinden karakterler seçilerek
        // rastgele şifre oluşturulur.
        for( $i = 0; $i < $count; $i++ )
        {
            $password .= substr( $characters, rand( 0, strlen($characters)), 1 );
        }

        return $password;
    }

    //--------------------------------------------------------------------------------------------------------
    // Golden
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $data
    // @param string $additional
    //
    //--------------------------------------------------------------------------------------------------------
    public function golden(String $data, String $additional = 'default') : String
    {
        $algo = CRYPTOGRAPHY_ENCODE_CONFIG['type'];

        if( ! isHash($algo) )
        {
            $algo = 'md5';
        }
        // Ek veri şifreleniyor.

        $additional = hash($algo, $additional);

        // Veri şifreleniyor.
        $data = hash($algo, $data);

        // Veri ve ek yeniden şifreleniyor.
        return hash($algo, $data.$additional);


    }

    //--------------------------------------------------------------------------------------------------------
    // Super
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $data
    //
    //--------------------------------------------------------------------------------------------------------
    public function super(String $data) : String
    {
        $projectKey = PROJECT_CONFIG['key'];

        $algo = CRYPTOGRAPHY_ENCODE_CONFIG['type'];

        if( ! isHash($algo) )
        {
            $algo = 'md5';
        }

        // Proje Anahatarı belirtizme bu veri yerine
        // Proje anahtarı olarak sitenin host adresi
        // eklenecek ek veri kabul edilir.
        if( empty($projectKey) )
        {
            $additional = hash($algo, host());
        }
        else
        {
            $additional = hash($algo, $projectKey);
        }

        // Veri şifreleniyor.
        $data = hash($algo, $data);

        // Veri ve ek yeniden şifreleniyor.
        return hash($algo, $data.$additional);

    }

    //--------------------------------------------------------------------------------------------------------
    // Data
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $data
    // @param string $type
    //
    //--------------------------------------------------------------------------------------------------------
    public function data(String $data, String $type = 'md5') : String
    {
        $algos = ['golden', 'super'];

        if( ! isHash($type) && ! in_array($type, $algos) )
        {
            throw new InvalidArgumentException('Error', 'hashParameter', 'String $type');
        }

        if( in_array($type, $algos) )
        {
            return $this->$type($data);
        }

        return hash($type, $data);
    }

    //--------------------------------------------------------------------------------------------------------
    // Type
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $data
    // @param string $type
    //
    //--------------------------------------------------------------------------------------------------------
    public function type(String $data, String $type = 'md5') : String
    {
        return $this->data($data, $type);
    }
}
