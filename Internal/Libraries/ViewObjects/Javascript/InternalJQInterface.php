<?php namespace ZN\ViewObjects;

interface InternalJQInterface
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
    // String Control
    //--------------------------------------------------------------------------------------------------------
    //
    // Metnin string olup olmadığı ayırt etmek için kullanılır. Parametre başında : nokta ile belirtilirse
    // verinin string olmadığı hiç bir şey belirtilmezse string veri olduğu anlaşılır. Bu durumda
    // metin için başına ve sonuna tırnak işaretleri kullanmanız gerekmez.
    //
    // @param  string $code
    // @return string
    //
    //--------------------------------------------------------------------------------------------------------
    public function stringControl(String $code = '') : String;

    //--------------------------------------------------------------------------------------------------------
    // Selector
    //--------------------------------------------------------------------------------------------------------
    //
    // Seçici belirtmek için kullanılır.
    //
    // @param  string $selector
    // @return string
    //
    //--------------------------------------------------------------------------------------------------------
    public function selector(String $selector = NULL) : String;

    //--------------------------------------------------------------------------------------------------------
    // Property
    //--------------------------------------------------------------------------------------------------------
    //
    // Jquery propertisi oluşturmak için kullanılır.
    //
    // @param string $property
    // @param array  $params
    // @param bool   $comma false
    //
    // @return string
    //
    //--------------------------------------------------------------------------------------------------------
    public function property(String $property, $params = [], Bool $comma = false) : String;

    //--------------------------------------------------------------------------------------------------------
    // Func
    //--------------------------------------------------------------------------------------------------------
    //
    // Jquery fonksiyonu oluşturmak için kullanılır.
    //
    // @param string $params
    // @param mixed  $code
    // @param bool   $comma false
    //
    // @return string
    //
    //--------------------------------------------------------------------------------------------------------
    public function function(String $params = NULL, $code = NULL, Bool $comma = false) : String;

    //--------------------------------------------------------------------------------------------------------
    // Callback / Func
    //--------------------------------------------------------------------------------------------------------
    //
    // Jquery fonksiyonu oluşturmak için kullanılır.
    //
    // @param string $params
    // @param mixed  $code
    // @param bool   $comma false
    //
    // @return string
    //
    //--------------------------------------------------------------------------------------------------------
    public function callback(String $params = NULL, $code = NULL, Bool $comma = false) : String;

    //--------------------------------------------------------------------------------------------------------
    // Combine
    //--------------------------------------------------------------------------------------------------------
    //
    // Genel jquery komutu oluşturmak için kullanılır.
    //
    // @param string $selector
    // @param string $property
    // @param array  $params
    // @param string $callback
    // @param bool   $comma false
    //
    // @return string
    //
    //--------------------------------------------------------------------------------------------------------
    public function combine(String $selector = NULL, String $property = NULL, $params = NULL, $callback = NULL, Bool $comma = false) : String;

    //--------------------------------------------------------------------------------------------------------
    // get
    //--------------------------------------------------------------------------------------------------------
    //
    // @param  mixed  $params
    // @param  boole  $comma
    // @return string
    //
    //--------------------------------------------------------------------------------------------------------
    public function get(String $url = NULL, $callback = NULL, Bool $comma = true) : String;

    //--------------------------------------------------------------------------------------------------------
    // post
    //--------------------------------------------------------------------------------------------------------
    //
    // @param  mixed  $params
    // @param  boole  $comma
    // @return string
    //
    //--------------------------------------------------------------------------------------------------------
    public function post(String $url = NULL, String $data = NULL, $callback = NULL, Bool $comma = true) : String;
}
