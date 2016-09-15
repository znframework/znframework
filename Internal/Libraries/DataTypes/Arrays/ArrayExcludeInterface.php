<?php namespace ZN\DataTypes\Arrays;

interface ArrayExcludeInterface
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
    // excluding
    //--------------------------------------------------------------------------------------------------------
    //
    // Dizi elemanlarından istenmeyen elemanlar belirtilir. Ancak istenmeyen eleman hem anahtar içinde hem de
    // değerler içinde aranır. Bu nedenle beklediğinizden farklı sonuçlar alabilirsiniz. Bu yöntemin en
    // doğru kullanımı anahtar veri içeren dizilerle kullanılmasıdır.
    //
    // @param array $array
    // @param array $excluding
    //
    //--------------------------------------------------------------------------------------------------------
    public function excluding(Array $array, Array $excluding) : Array;

    //--------------------------------------------------------------------------------------------------------
    // excluding
    //--------------------------------------------------------------------------------------------------------
    //
    // @param array   $array
    // @param array   $excluding
    //
    //--------------------------------------------------------------------------------------------------------
    public function exclude(Array $array, Array $excluding) : Array;
}
