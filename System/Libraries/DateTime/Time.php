<?php
class __USE_STATIC_ACCESS__Time implements DateTimeCommonInterface
{
	//----------------------------------------------------------------------------------------------------
	// TIME CLASS
	//----------------------------------------------------------------------------------------------------
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
	//----------------------------------------------------------------------------------------------------
	
	//----------------------------------------------------------------------------------------------------
	// Common
	//----------------------------------------------------------------------------------------------------
	// 
	// $config
	//
	// __construct()
	//
	//----------------------------------------------------------------------------------------------------
	use DateTimeTrait;

	//----------------------------------------------------------------------------------------------------
	// Current
	//----------------------------------------------------------------------------------------------------
	// 
	// Aktif saat bilgisini verir.
	//
	// @param  string clock
	// @return string
	//
	//----------------------------------------------------------------------------------------------------
	public function current($clock = '%H:%M:%S')
	{
		if( ! is_string($clock) ) 
		{
			return Error::set('Error', 'stringParameter', 'clock');
		}
		
		return strftime($clock);	
	}
	
	//----------------------------------------------------------------------------------------------------
	// Standart
	//----------------------------------------------------------------------------------------------------
	// 
	// Standart tarih ve saat bilgisi üretir.
	//
	// @param  void
	// @return string
	//
	//----------------------------------------------------------------------------------------------------
	public function standart()
	{	
		// Çıktıda iconv() yöntemi ile TR karakter sorunları düzeltiliyor.
		// Config/DateTime.php dosyasından bu ayarları değiştirmeniz mümkün.
		return strftime("%d %B %Y %A, %H:%M:%S");
	}

	//----------------------------------------------------------------------------------------------------
	// Set
	//----------------------------------------------------------------------------------------------------
	// 
	// Tarih ve saat ayarlamaları yapmak için kullanılır.	
	//
	// @param  string exp
	// @return string
	//
	//----------------------------------------------------------------------------------------------------
	public function set($exp = '')
	{	
		if( ! is_string($exp) ) 
		{
			return Error::set('Error', 'stringParameter', 'exp');
		}

		return strftime($this->_convert('setTimeFormatChars', $exp));
	}
}