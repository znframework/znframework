<?php namespace ZN\DateTime;

class InternalDate extends DateTimeCommon implements InternalDateTimeCommonInterface
{
    //--------------------------------------------------------------------------------------------------------
    // DATE CLASS
    //--------------------------------------------------------------------------------------------------------
    //
    // Yazar: Ozan UYKUN <ozanbote@windowslive.com> | <ozanbote@gmail.com>
    // Site: www.zntr.net
    // Lisans: The MIT License
    // Telif Hakkı: Copyright (c) 2012-2016, zntr.net
    //
    // Sınıf Adı: Date
    // Versiyon: 2.0
    // Tanımlanma: Statik
    // Dahil Edilme: Gerektirmez
    // Erişim: Date::, $this->Date, zn::$use->Date, uselib('Date'), new Date
    // Not: Büyük-küçük harf duyarlılığı yoktur.
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
