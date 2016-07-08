<?php
namespace ZN\Helpers;

interface CleanInterface
{
	/***********************************************************************************/
	/* CLEAN LIBRARY						                   	                       */
	/***********************************************************************************/
	/* Yazar: Ozan UYKUN <ozanbote@windowslive.com> | <ozanbote@gmail.com>
	/* Site: www.zntr.net
	/* Lisans: The MIT License
	/* Telif Hakkı: Copyright (c) 2012-2016, zntr.net
	/*
	/* Sınıf Adı: Clean
	/* Versiyon: 1.4
	/* Tanımlanma: Statik
	/* Dahil Edilme: Gerektirmez
	/* Erişim: captcha::, $this->clean, zn::$use->clean, uselib('clean')
	/* Not: Büyük-küçük harf duyarlılığı yoktur.
	/***********************************************************************************/

	/******************************************************************************************
	* DATA                                                                                    *
	*******************************************************************************************
	| Genel Kullanım: Dizi ya da metinsel ifadelerden veri silmek için kullanılır. 			  |
	|																						  |
	| Parametreler: 2 parametresi vardır.                                              	      |
	| 1. string/array var @searchData => Aranacak metin veya dizi elamanları.				  |
	| 2. string/array var @cleanWord => Silinecek metin veya dizi elamanları.				  |
	|																						  |
	******************************************************************************************/	
	public function data($searchData);
}