<?php
namespace ZN\Helpers;

interface FormatInterface
{
	/***********************************************************************************/
	/* FORMAT LIBRARY						                   	                       */
	/***********************************************************************************/
	/* Yazar: Ozan UYKUN <ozanbote@windowslive.com> | <ozanbote@gmail.com>
	/* Site: www.zntr.net
	/* Lisans: The MIT License
	/* Telif Hakkı: Copyright (c) 2012-2016, zntr.net
	/*
	/* Sınıf Adı: Format
	/* Versiyon: 1.4
	/* Tanımlanma: Statik
	/* Dahil Edilme: Gerektirmez
	/* Erişim: format::, $this->format, zn::$use->format, uselib('format')
	/* Not: Büyük-küçük harf duyarlılığı yoktur.
	/***********************************************************************************/
	
	// Function: byte_formatter()
	// İşlev: Girilen sayısal veriyi bayt biçimine çevirir.
	// Parametreler
	// @bytes = Sayısal veri.
	// @precision = Virgülden sonraki ondalıklı bölümün kaç karaker olacağı.
	// @unit = Dönüştürülen verinin birimi görüntülensin mi?.
	// Dönen Değer: Dönüştürülmüş veri.
	public function byte($bytes, $precision, $unit);

	// Function: money_formatter()
	// İşlev: Girilen sayısal veriyi para birimine çevirir.
	// Parametreler
	// @money = Sayısal veri. Örnek 1.000,00
	// @type = Paranın birimi belirlenir. Örnek 1.000,00 TL
	// Dönen Değer: Dönüştürülmüş veri.
	public function money($money, $type);

	// Function: time_formatter()
	// İşlev: Girilen sayısal veriyi zamana çevirir.
	// Parametreler
	// @count = Sayısal veri. Parametrenin alabileceği değerler: second, minute, hour, day, month, year
	// @type = Hangi türden. Parametrenin alabileceği değerler: second, minute, hour, day, month, year
	// @type = Hangi türe 
	// Dönen Değer: Dönüştürülmüş veri.
	public function time($count, $type, $output);	
}