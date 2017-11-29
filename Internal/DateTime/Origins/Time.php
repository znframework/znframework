<?php namespace ZN\DateTime;

class Time extends DateTimeCommon implements DateTimeCommonInterface
{
    //--------------------------------------------------------------------------------------------------------
    //
    // Author     : Ozan UYKUN <ozanbote@windowslive.com> | <ozanbote@gmail.com>
    // Site       : www.znframework.com
    // License    : The MIT License
    // Copyright  : Copyright (c) 2012-2016, ZN Framework
    //
    //--------------------------------------------------------------------------------------------------------

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
    public function current(String $clock = '%H:%M:%S') : String
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
    public function convert(String $date, String $format = '%d-%B-%Y %A, %H:%M:%S') : String
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
        // Çıktıda iconv() yöntemi ile TR karakter sorunları düzeltiliyor.
        // Config/DateTime.php dosyasından bu ayarları değiştirmeniz mümkün.
        return strftime("%d %B %Y %A, %H:%M:%S");
    }
}
