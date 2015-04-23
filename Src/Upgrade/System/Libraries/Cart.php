<?php 
/************************************************************/
/*                        CLASS  CART                       */
/************************************************************/
/*

Author: Ozan UYKUN
Site: http://www.zntr.net
Copyright 2012-2015 zntr.net - Tüm hakları saklıdır.

*/
if( ! isset($_SESSION)) session_start();

class Cart
{
	private static $items = array();
	private static $error;
	/*
	name, price, quantity
	*/
	
	// Sepete Ürün ekler.
	// parametre => ürün ile ilgili istenilen bilgiler
	
	public static function insert_item($product = array())
	{
		if( empty($product) )
		{
			self::$error = get_message('Cart', 'cart_insert_parameter_empty_error');
			report('Error', self::$error, 'CartLibrary');
			return false;	
		}
		
		if( ! is_array($product))
		{
			self::$error = get_message('Cart', 'cart_array_parameter_error');
			report('Error', self::$error, 'CartLibrary');
			return false;	
		}
		
		if( ! isset($product['quantity']))
			$product['quantity'] = 1;
		
		if( isset($_SESSION[md5('cart')]) )
		{
			self::$items = $_SESSION[md5('cart')];
			array_push(self::$items, $product);
			$_SESSION[md5('cart')] = self::$items;
		}
		else
		{
			array_push(self::$items, $product);
			$_SESSION[md5('cart')] = self::$items;
		}
		self::$items = $_SESSION[md5('cart')];
		return self::$items;
	}
	
	
	// Sepetteki ürünleri verir.
	
	public static function select_items()
	{
		if(isset($_SESSION[md5('cart')]))
		{
			self::$items = $_SESSION[md5('cart')];
			return self::$items;	
		}
		else
		{
			self::$error = get_message('Cart', 'cart_no_data_error');
			report('Error', self::$error, 'CartLibrary');
			return false;	
		}
	}
	
	public static function select_item($code = '')
	{
		if(empty($code)) return false;
				
		self::$items = (isset($_SESSION[md5('cart')])) ? $_SESSION[md5('cart')] : "";
		
		if(empty(self::$items)) return false;
		
		foreach(self::$items as $row)
		{
			if( ! is_array($code))
				$key = array_search($code, $row);
			else
				if(isset($row[key($code)]) && $row[key($code)] == current($code))
					$key = $row;
				
			if( ! empty($key))
				return (object)$row;
		}
	}
	
	// Sepette kaç ürün olduğunu verir.
	
	public static function total_items()
	{
		if(isset($_SESSION[md5('cart')]))
		{
			self::$items = $_SESSION[md5('cart')];
			$total_items = 0;
			if( ! empty(self::$items))foreach(self::$items as $item)
			{
				$total_items += $item['quantity'];	
			}
			
			return $total_items;
		}
		else
		{
			self::$error = get_message('Cart', 'cart_no_data_error');
			report('Error', self::$error, 'CartLibrary');
			return 0;	
		}
	}
	
	
	// Ürünlerin toplam fiyatını verir. hesap için
	// quantity dizi elemanının kullanılmış olması gereklidir.
	
	public static function total_prices()
	{
		self::$items = (isset($_SESSION[md5('cart')])) ? $_SESSION[md5('cart')] : "";
		
		if(empty(self::$items))
		{
			self::$error = get_message('Cart', 'cart_no_data_error');
			report('Error', self::$error, 'CartLibrary');
			return 0;	
		}
		
		$total = "";
		foreach(self::$items as $values)
		{
			$quantity = (isset($values['quantity'])) ? $values['quantity'] : 1;
			$total += $values['price'] * $quantity;
		}
		return $total;
	}
	
	// Sepeti güncellemek için kullanılır.
	// Code değerine göre değiştireceği elemanı seçer
	// Data ile de değiştirilecek veriler eklenir.
	
	public static function update_item($code = '', $data = '')
	{	
		if( empty($code) )
		{
			self::$error = get_message('Cart', 'cart_update_code_error');
			report('Error', self::$error, 'CartLibrary');
			return false;	
		}
		
		if( empty($data) )
		{
			self::$error = get_message('Cart', 'cart_update_parameter_empty_error');
			report('Error', self::$error, 'CartLibrary');
			return false;	
		}
		
		if( ! is_array($data))
		{
			self::$error = get_message('Cart', 'cart_update_array_parameter_error');
			report('Error', self::$error, 'CartLibrary');
			return false;	
		}
		
		
		
		self::$items = (isset($_SESSION[md5('cart')])) ? $_SESSION[md5('cart')] : "";
		
		if(empty(self::$items)) return false;
		
		$i=0;
		
		foreach(self::$items as $row)
		{
			if(is_array($code)) 
				if(isset($row[key($code)]) && $row[key($code)] == current($code))
					$code = $row[key($code)];
					
			$key = array_search($code,$row);
			if( ! empty($key))
			{
				array_splice(self::$items,$i,1);
				if(count($data) !== count($row))
				{
					foreach($data as $k => $v)
					{
						$row[$k] = $v;	
					}
					array_push(self::$items, $row);
				}
				else
				{
					array_push(self::$items, $data);
				}
			}
		
			$i++;
		}
		
		$_SESSION[md5('cart')] = self::$items;
	}
	
	// Code bilgisine göre sepetteki ürünü temizler.
	
	public static function delete_item($code = '')
	{		
		if( empty($code) )
		{
			self::$error = get_message('Cart', 'cart_delete_code_error');
			report('Error', self::$error, 'CartLibrary');
			return false;	
		}

		self::$items = (isset($_SESSION[md5('cart')])) ? $_SESSION[md5('cart')] : "";
		
		if( empty(self::$items) ) return false;
		
		$i=0;
		
		foreach(self::$items as $row)
		{	
			if(is_array($code)) 
				if(isset($row[key($code)]) && $row[key($code)] == current($code))
					$code = $row[key($code)];
			
			$key = array_search($code, $row);
			if( ! empty($key))
			{
				array_splice(self::$items,$i--,1);
			}
		
			$i++;
		}
		
		$_SESSION[md5('cart')] = self::$items;		
	}
	
	// Sepetteki tüm ürünleri siler.
	
	public static function delete_items()
	{
		if(isset($_SESSION[md5('cart')]))
				unset($_SESSION[md5('cart')]);
	}
	
	// Sayısal bir değeri para birimi olarak değiştirir.
	
	public static function money_format($money = 0, $type = '')
	{
		if( ! is_numeric($money)) return false;
		if( ! is_string($type)) $type = '';
		
		$moneyFormat = '';
		
		$money = round($money, 2);
		
		$str_ex = explode(".",$money);
		
		$join = array();
		
		$str = strrev($str_ex[0]);
		
		for($i=0; $i<strlen($str); $i++)
		{
			if($i%3 === 0)
			{
				array_unshift($join, '.');
			}
			array_unshift($join, $str[$i]);
		}
		
		for($i=0; $i<count($join);$i++)
		{
			$moneyFormat .= $join[$i];	
		}
		$type = ($type) ? ' '.$type : '';
		
		$remaining = (isset($str_ex[1])) ? $str_ex[1] : '00';
		
		if(strlen($remaining) === 1) $remaining .= '0';
				
		$moneyFormat = substr($moneyFormat,0,-1).','.$remaining.$type;
		
		return $moneyFormat;
	}
	
	
	public static function error()
	{
		if(isset(self::$error))
			return self::$error;
		else
			return false;
	}
}