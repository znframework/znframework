<?php
namespace ZN\Services;

interface URLInterface
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
	// Base
	//----------------------------------------------------------------------------------------------------
	// 
	// @param  string  $uri: empty
	// @param  numeric $index:  0
	// @return string
	//
	//----------------------------------------------------------------------------------------------------
	public function base(String $uri = '', Int $index = 0);
	
	//----------------------------------------------------------------------------------------------------
	// Site
	//----------------------------------------------------------------------------------------------------
	// 
	// @param  string  $uri: empty
	// @param  numeric $index:  0
	// @return string
	//
	//----------------------------------------------------------------------------------------------------
	public function site(String $uri = '', Int $index = 0);
	
	//----------------------------------------------------------------------------------------------------
	// Current
	//----------------------------------------------------------------------------------------------------
	// 
	// @param  string  $fix empty
	// @return string
	//
	//----------------------------------------------------------------------------------------------------
	public function current(String $fix = NULL);
	
	//----------------------------------------------------------------------------------------------------
	// Host
	//----------------------------------------------------------------------------------------------------
	// 
	// @param  string  $uri: empty
	// @return string
	//
	//----------------------------------------------------------------------------------------------------
	public function host(String $uri = '');
	
	//----------------------------------------------------------------------------------------------------
	// Prev
	//----------------------------------------------------------------------------------------------------
	// 
	// @param  void
	// @return string
	//
	//----------------------------------------------------------------------------------------------------
	public function prev();
	
	//----------------------------------------------------------------------------------------------------
	// Base 64 Decode
	//----------------------------------------------------------------------------------------------------
	// 
	// @param  string  $data: empty
	// @param  bool    $strict: false
	// @return mixed
	//
	//----------------------------------------------------------------------------------------------------
	public function base64Decode(String $data, Bool $strict = false);
	
	//----------------------------------------------------------------------------------------------------
	// Base 64 Encode
	//----------------------------------------------------------------------------------------------------
	// 
	// @param  string  $data: empty
	// @return mixed
	//
	//----------------------------------------------------------------------------------------------------
	public function base64Encode(String $data);
	
	//----------------------------------------------------------------------------------------------------
	// Headers
	//----------------------------------------------------------------------------------------------------
	// 
	// @param  string $url: empty
	// @param  string $format: 0
	// @return mixed
	//
	//----------------------------------------------------------------------------------------------------
	public function headers(String $url, $format = 0);
	
	//----------------------------------------------------------------------------------------------------
	// Headers
	//----------------------------------------------------------------------------------------------------
	// 
	// @param  string $fileName: empty
	// @param  bool   $useIncludePath: false
	// @return mixed
	//
	//----------------------------------------------------------------------------------------------------
	public function metaTags(String $fileName, Bool $useIncludePath = false);
	
	//----------------------------------------------------------------------------------------------------
	// Build Query
	//----------------------------------------------------------------------------------------------------
	// 
	// @param  string $data         : empty
	// @param  string $numericPrefix: NULL
	// @param  string $separator    : NULL
	// @param  string $enctype      : RFC1738
	// @return mixed
	//
	//----------------------------------------------------------------------------------------------------
	public function buildQuery(String $data, String $numericPrefix = NULL, String $separator = NULL, String $enctype = 'RFC1738');
	
	//----------------------------------------------------------------------------------------------------
	// Parse
	//----------------------------------------------------------------------------------------------------
	// 
	// @param  string  $url      : empty
	// @param  numeric $component: 1
	// @return mixed
	//
	//----------------------------------------------------------------------------------------------------
	public function parse(String $url, Int $component = 1);
	
	//----------------------------------------------------------------------------------------------------
	// Raw Decode
	//----------------------------------------------------------------------------------------------------
	// 
	// @param  string  $str: empty
	// @return mixed
	//
	//----------------------------------------------------------------------------------------------------
	public  function rawDecode(String $str);

	//----------------------------------------------------------------------------------------------------
	// Raw Encode
	//----------------------------------------------------------------------------------------------------
	// 
	// @param  string  $str: empty
	// @return mixed
	//
	//----------------------------------------------------------------------------------------------------
	public function rawEncode(String $str);
	
	//----------------------------------------------------------------------------------------------------
	// Decode
	//----------------------------------------------------------------------------------------------------
	// 
	// @param  string  $str: empty
	// @return mixed
	//
	//----------------------------------------------------------------------------------------------------
	public function decode(String $str);
	
	//----------------------------------------------------------------------------------------------------
	// Encode
	//----------------------------------------------------------------------------------------------------
	// 
	// @param  string  $str: empty
	// @return mixed
	//
	//----------------------------------------------------------------------------------------------------
	public function encode(String $str);
}