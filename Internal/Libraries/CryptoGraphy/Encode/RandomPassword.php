<?php namespace ZN\CryptoGraphy\Encode;

class RandomPassword extends EncodeExtends implements RandomPasswordInterface
{
    //--------------------------------------------------------------------------------------------------------
    //
    // Author     : Ozan UYKUN <ozanbote@gmail.com>
    // Site       : www.znframework.com
    // License    : The MIT License
    // Copyright  : (c) 2012-2016, znframework.com
    //
    //--------------------------------------------------------------------------------------------------------

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
}
