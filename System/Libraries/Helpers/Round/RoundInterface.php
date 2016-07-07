<?php
namespace ZN\Helpers;

interface RoundInterface
{
	/***********************************************************************************/
	/* ROUND LIBRARY						                   	                       */
	/***********************************************************************************/
	/* Yazar: Ozan UYKUN <ozanbote@windowslive.com> | <ozanbote@gmail.com>
	/* Site: www.zntr.net
	/* Lisans: The MIT License
	/* Telif Hakkı: Copyright (c) 2012-2016, zntr.net
	/*
	/* Sınıf Adı: Round
	/* Versiyon: 1.4
	/* Tanımlanma: Statik
	/* Dahil Edilme: Gerektirmez
	/* Erişim: round::, $this->round, zn::$use->round, uselib('round')
	/* Not: Büyük-küçük harf duyarlılığı yoktur.
	/***********************************************************************************/
	
	// Function: data()
	// İşlev: Sayıları yuvarlamak için kullanılır.
	// Parametreler
	// @number = Yuvarlanacak sayı.
	// @count = Virgülden sonraki ondalıklı bölmün kaç karakter olacağı
	// @type = Yuvarlamanın yönü. Parametrenin alabileceği değerler: average, down, up
	// Dönen Değer: Yuvarlanmı sayısal veri.
	public function data($number, $count, $type);
}