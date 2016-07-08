<?php
namespace ZN\Foundations\Traits;

trait DriverMethodTrait
{
	//----------------------------------------------------------------------------------------------------
	// DRIVER METHOD TRAIT
	//----------------------------------------------------------------------------------------------------
	//
	// Yazar: Ozan UYKUN <ozanbote@windowslive.com> | <ozanbote@gmail.com>
	// Site: www.zntr.net
	// Lisans: The MIT License
	// Telif Hakkı: Copyright (c) 2012-2016, zntr.net
	//
	// Sınıf Adı: DriverMethodTrait
	// Versiyon: 2.0.4
	// Tanımlanma: Dinamik
	// Dahil Edilme: Gerektirmez
	// Erişim: Yok
	// Not: Büyük-küçük harf duyarlılığı yoktur.
	//
	//----------------------------------------------------------------------------------------------------
	
	//----------------------------------------------------------------------------------------------------
	// Driver                                                                       
	//----------------------------------------------------------------------------------------------------
	//
	// @param  string $driver
	// @return object 	        		     			 
	//          																				 
	//----------------------------------------------------------------------------------------------------
	public function driver($driver = '')
	{
		return new self($driver);
	}
}