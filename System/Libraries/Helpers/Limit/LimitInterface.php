<?php
namespace ZN\Helpers;

interface LimitInterface
{
	/***********************************************************************************/
	/* LIMIT LIBRARY						                   	                       */
	/***********************************************************************************/
	/* Yazar: Ozan UYKUN <ozanbote@windowslive.com> | <ozanbote@gmail.com>
	/* Site: www.zntr.net
	/* Lisans: The MIT License
	/* Telif Hakkı: Copyright (c) 2012-2016, zntr.net
	/*
	/* Sınıf Adı: Limit
	/* Versiyon: 1.4
	/* Tanımlanma: Statik
	/* Dahil Edilme: Gerektirmez
	/* Erişim: limit::, $this->limit, zn::$use->limit, uselib('limit')
	/* Not: Büyük-küçük harf duyarlılığı yoktur.
	/***********************************************************************************/
	
	// Function: word_limiter()
	// İşlev: Bir metinin kaç kelime ile sınırlanacağını belirler.
	// Parametreler
	// @str = Sınırlanacak metin.
	// @limit = Kaç kelime ile sınırlanacağı
	// @endchar = Metnin kelime sayısı sınırlanan sayıdan fazla ise devamı olduğunu gösteren ve metnin sonuna eklenen karakter.
	// @striptags = Metindeki html tagları numerik koda dönüştürülsün mü?. true veya false.
	// Dönen Değer: Dönüştürülmüş veri.
	public function word($str, $limit, $endChar, $stripTags, $encoding);

	// Function: char_limiter()
	// İşlev: Bir metinin kaç karakter ile sınırlanacağını belirler.
	// Parametreler
	// @str = Sınırlanacak metin.
	// @limit = Kaç karakter ile sınırlanacağı
	// @endchar = Metnin kelime sayısı sınırlanan sayıdan fazla ise devamı olduğunu gösteren ve metnin sonuna eklenen karakter.
	// @striptags = Metindeki html tagları numerik koda dönüştürülsün mü?. true veya false.
	// Dönen Değer: Dönüştürülmüş veri.
	public function char($str, $limit, $endChar,  $stripTags, $encoding);	
}
