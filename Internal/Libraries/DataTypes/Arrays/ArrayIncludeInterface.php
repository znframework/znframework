<?php namespace ZN\DataTypes\Arrays;

interface ArrayIncludeInterface
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
    // including
    //--------------------------------------------------------------------------------------------------------
    //
    // Dizi elemanlarından istenen elemanlar belirtilir. Ancak istenmeyen eleman hem anahtar içinde hem de
    // değerler içinde aranır. Bu nedenle beklediğinizden farklı sonuçlar alabilirsiniz. Bu yöntemin en
    // doğru kullanımı anahtar veri içeren dizilerle kullanılmasıdır.
    //
    // @param array   $array
    // @param array   $including
    //
    //--------------------------------------------------------------------------------------------------------
    public function including(Array $array, Array $including) : Array;

    //--------------------------------------------------------------------------------------------------------
    // excluding
    //--------------------------------------------------------------------------------------------------------
    //
    // @param array   $array
    // @param array   $excluding
    //
    //--------------------------------------------------------------------------------------------------------
    public function include(Array $array, Array $excluding) : Array;
}
