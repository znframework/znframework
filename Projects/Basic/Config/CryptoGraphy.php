<?php return
[
    //--------------------------------------------------------------------------------------------------
    // Crypto Graphy 
    //--------------------------------------------------------------------------------------------------
    //
    // Author     : Ozan UYKUN <ozanbote@windowslive.com> | <ozanbote@gmail.com>
    // Site       : www.znframework.com
    // License    : The MIT License
    // Copyright  : Copyright (c) 2012-2016, ZN Framework
    //
    //--------------------------------------------------------------------------------------------------
   
    'crypto' =>
    [
        //----------------------------------------------------------------------------------------------
        // Crypto Driver
        //----------------------------------------------------------------------------------------------
        //
        // Genel Kullanım: Veri şifrelemede kullanılan şifreleme sürücüleri.                          
        //
        // @drivers: mcyrpt, openssl, hash, phash, mhash
        //                                                                                                                      
        //----------------------------------------------------------------------------------------------
        'driver' => 'mcrypt'
    ],

    'encode' =>
    [
        //----------------------------------------------------------------------------------------------
        // Type
        //----------------------------------------------------------------------------------------------
        //
        // Genel Kullanım: Encode.php kütüphanesinde yer alan yöntemlerin temel olarak hangi          
        // şifreleme algoritmasını kullanacağı seçmek için kullanılır. Şifrelenmesini istediğiniz  
        // hash algoritmasını yazmanız yeterlidir.                                                                                      
        //
        //----------------------------------------------------------------------------------------------
        'type' => 'md5'
    ]
];