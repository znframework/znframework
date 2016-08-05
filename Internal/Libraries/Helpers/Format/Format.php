<?php
namespace ZN\Helpers;

class InternalFormat extends \CallController implements FormatInterface
{
	//----------------------------------------------------------------------------------------------------
	//
	// Yazar      : Ozan UYKUN <ozanbote@windowslive.com> | <ozanbote@gmail.com>
	// Site       : www.zntr.net
	// Lisans     : The MIT License
	// Telif Hakkı: Copyright (c) 2012-2016, zntr.net
	//
	//----------------------------------------------------------------------------------------------------
	
	//----------------------------------------------------------------------------------------------------
	// Byte
	//----------------------------------------------------------------------------------------------------
	// 
	// @param int  $bytes
	// @param int  $precision
	// @param bool $unit
	//
	//----------------------------------------------------------------------------------------------------
	public function byte($bytes, $precision = 1, $unit = true)
	{		
		$byte 	= 1024;
		$kb		= 1024 * $byte;
		$mb		= 1024 * $kb;
		$gb		= 1024 * $mb;
		$tb		= 1024 * $gb; 
		$pb		= 1024 * $tb;
		$eb		= 1024 * $pb;
		
		if( $bytes <= $byte && $bytes > -1 )
		{
			$un = ( ! empty($unit) ) 
				  ? " Bytes" 
				  : "";
			
			$return = $bytes.$un;
		}
		elseif( $bytes <= $kb && $bytes > $byte )
		{
			$un = ( ! empty($unit) ) 
				  ? " KB" 
				  : "";
				  
			$return =  round(($bytes / $byte),$precision).$un;
		}
		elseif( $bytes <= $mb && $bytes > $kb )
		{	
			$un = ( ! empty($unit) ) 
				  ? " MB" 
				  : "";
				  
			$return =  round(($bytes / $kb),$precision).$un;
		}
		elseif($bytes <= $gb && $bytes > $mb)
		{	
			$un = ( ! empty($unit) ) 
				  ? " GB" 
				  : "";
				  
			$return =   round(($bytes / $mb),$precision).$un;
		}
		elseif($bytes <= $tb && $bytes > $gb)
		{
			$un = ( ! empty($unit) ) 
			      ? " TB" 
				  : "";
				  
			$return =   round(($bytes / $gb),$precision).$un;
		}
		elseif( $bytes <= $pb && $bytes > $tb )
		{
			$un = ( ! empty($unit) ) 
				  ? " PB" 
				  : "";
				  
			$return =   round(($bytes / $tb),$precision).$un;
		}
		elseif( $bytes <= $eb && $bytes > $pb )
		{
			$un = ( ! empty($unit) ) 
				  ? " EB" 
				  : "";
				  
			$return =   round(($bytes / $pb),$precision).$un;
		}
		else
		{
			$un = ( ! empty($unit) ) 
				  ? " Bytes" 
				  : "";
				  
			$return = str_replace(",", ".", number_format($bytes)).$un;
		}
		return $return;
	}

	//----------------------------------------------------------------------------------------------------
	// Money
	//----------------------------------------------------------------------------------------------------
	// 
	// @param int    $money
	// @param string $type
	//
	//----------------------------------------------------------------------------------------------------
	public function money($money = 0, String $type = NULL)
	{
		if( ! is_numeric($money) ) 
		{
			return \Errors::set('Error', 'numericParameter', 'money');
		}
		
		if( ! is_string($type) ) 
		{
			$type = '';
		}
		
		$moneyFormat = '';
		
		$money = round($money, 2);
		
		$strEx = explode(".",$money);
		
		$join = [];
		
		$str = strrev($strEx[0]);
		
		for( $i = 0; $i < strlen($str); $i++ )
		{
			if( $i % 3 === 0 )
			{
				array_unshift($join, '.');
			}
			
			array_unshift($join, $str[$i]);
		}
		
		for( $i = 0; $i < count($join); $i++ )
		{
			$moneyFormat .= $join[$i];	
		}
		
		$type = ( ! empty($type) ) 
			    ? ' '.$type 
				: '';
		
		$remaining = ( isset($strEx[1]) ) 
					 ? $strEx[1] 
					 : '00';
		
		if( strlen($remaining) === 1 ) 
		{
			$remaining .= '0';
		}
		
		$moneyFormat = substr($moneyFormat, 0, -1).','.$remaining.$type;
		
		return $moneyFormat;
	}

	//----------------------------------------------------------------------------------------------------
	// Time
	//----------------------------------------------------------------------------------------------------
	// 
	// @param int    $count
	// @param string $type
	// @param string $output
	//
	//----------------------------------------------------------------------------------------------------
	public function time($count, String $type = NULL, String $output = NULL)
	{
		nullCoalesce($type, 'second');
		nullCoalesce($output, 'day');

		if( $output === "second" ) $out = 1;
		if( $output === "minute" ) $out = 60;
		if( $output === "hour" )   $out = 60 * 60;
		if( $output === "day" )    $out = 60 * 60 * 24;
		if( $output === "month" )  $out = 60 * 60 * 24 * 30;
		if( $output === "year" )   $out = 60 * 60 * 24 * 30 * 12;
		
		if( $type === "second" ) $time = $count;
		if( $type === "minute" ) $time = 60 * $count;
		if( $type === "hour" ) 	 $time = 60 * 60 * $count;
		if( $type === "day" ) 	 $time = 60 * 60 * 24 * $count;
		if( $type === "month" )  $time = 60 * 60 * 24 * 30 * $count;
		if( $type === "year" )	 $time = 60 * 60 * 24 * 30 * 12 * $count;
			
		return $time / $out;	
	}	
}