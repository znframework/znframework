<?php namespace ZN\DateTime;

class InternalDate extends DateTimeCommon implements InternalDateTimeCommonInterface
{
    //--------------------------------------------------------------------------------------------------------
    // DATE CLASS
    //--------------------------------------------------------------------------------------------------
    //
    // Author     : Ozan UYKUN <ozanbote@windowslive.com> | <ozanbote@gmail.com>
    // Site       : www.znframework.com
    // License    : The MIT License
    // Copyright  : Copyright (c) 2012-2016, ZN Framework
    //
    //--------------------------------------------------------------------------------------------------

    //--------------------------------------------------------------------------------------------------------
    // Current
    //--------------------------------------------------------------------------------------------------------
    //
    // Aktif saat bilgisini verir.
    //
    // @param  string clock
    // @return string
    //
    //--------------------------------------------------------------------------------------------------------
    public function current(String $clock = 'd.m.o') : String
    {
        return $this->_datetime($clock);
    }

    //--------------------------------------------------------------------------------------------------------
    // Convert
    //--------------------------------------------------------------------------------------------------------
    //
    // Tarih bilgisini dönüştürmek için kullanılır.
    //
    // @param  string $date
    // @param  string $format
    // @return string
    //
    //--------------------------------------------------------------------------------------------------------
    public function convert(String $date, String $format = 'd-m-Y H:i:s') : String
    {
        return $this->_datetime($format, strtotime($date));
    }

    //--------------------------------------------------------------------------------------------------------
    // Standart
    //--------------------------------------------------------------------------------------------------------
    //
    // Standart tarih ve saat bilgisi üretir.
    //
    // @param  void
    // @return string
    //
    //--------------------------------------------------------------------------------------------------------
    public function standart() : String
    {
        return $this->_datetime("d.F.o l, H:i:s");
    }
}
