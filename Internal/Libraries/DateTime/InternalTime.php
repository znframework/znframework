<?php namespace ZN\DateTime;

class InternalTime extends DateTimeCommon implements InternalDateTimeCommonInterface
{
    //--------------------------------------------------------------------------------------------------------
    // TIME CLASS
    //--------------------------------------------------------------------------------------------------------
    //
    // Yazar: Ozan UYKUN <ozanbote@windowslive.com> | <ozanbote@gmail.com>
    // Site: www.zntr.net
    // Lisans: The MIT License
    // Telif Hakkı: Copyright (c) 2012-2016, zntr.net
    //
    // Sınıf Adı: Time
    // Versiyon: 2.0
    // Tanımlanma: Statik
    // Dahil Edilme: Gerektirmez
    // Erişim: time::, $this->time, zn::$use->time, uselib('time'), new Time
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
