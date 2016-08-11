<?php	
namespace ZN\DataTypes;

class InternalXML extends \CallController implements XMLInterface
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
	// Version
	//----------------------------------------------------------------------------------------------------
	// 
	// @var string
	//
	//----------------------------------------------------------------------------------------------------
	protected $version  = '1.0';
	
	//----------------------------------------------------------------------------------------------------
	// Encoding
	//----------------------------------------------------------------------------------------------------
	// 
	// @var string
	//
	//----------------------------------------------------------------------------------------------------
	protected $encoding = 'UTF-8';
	
	//----------------------------------------------------------------------------------------------------
	// Extension
	//----------------------------------------------------------------------------------------------------
	// 
	// @var string
	//
	//----------------------------------------------------------------------------------------------------
	protected $extension = '.xml';
	
	//----------------------------------------------------------------------------------------------------
	// Settings Methods Başlangıç
	//----------------------------------------------------------------------------------------------------

	//----------------------------------------------------------------------------------------------------
	// Version		                                                                          
	//----------------------------------------------------------------------------------------------------
	//
	// Genel Kullanım: Bir XML belgesinin versiyonunu oluşturur.				 				                                     
	//  
	// @param  string	$version -> 1.0
	// @return this
	//          																				  
	//----------------------------------------------------------------------------------------------------
	public function version(String $version = '1.0') : InternalXML
	{
		$this->version = $version;	
		
		return $this;
	}
	
	//----------------------------------------------------------------------------------------------------
	// Encoding		                                                                          
	//----------------------------------------------------------------------------------------------------
	//
	// Genel Kullanım: Bir XML belgesinin kodlama türünü belirtir.			 				                                       
	//  
	// @param  string	$encoding -> UTF-8
	// @return this
	//         																				  
	//----------------------------------------------------------------------------------------------------
	public function encoding(String $encoding = 'UTF-8') : InternalXML
	{
		return $this->encoding = $encoding;	
		
		return $this;
	}

	//----------------------------------------------------------------------------------------------------
	// Build       	                                                                          
	//----------------------------------------------------------------------------------------------------
	//
	// @param array  $data
	// @param string $version
	// @param string $encoding
	//          																				  
	//----------------------------------------------------------------------------------------------------
	public function build(Array $data, String $version = NULL, String $encoding = NULL) : String
	{
		if( ! empty($version) )  $this->version  = $version;
		if( ! empty($encoding) ) $this->encoding = $encoding;
		
		$xml  ='<?xml version="'.$this->version.'" encoding="'.$this->encoding.'"?>'.EOL;
		$xml .= $this->_document($data, '', 0);	
		
		return $xml;
	}
	
	//----------------------------------------------------------------------------------------------------
	// Save      	                                                                         
	//----------------------------------------------------------------------------------------------------						 				                                      
	// 
	// @param string $file
	// @param string $data 
	//          																				  
	//----------------------------------------------------------------------------------------------------
	public function save(String $file, String $data) : Bool
	{
		$file = suffix($file, $this->extension);
		
		return \File::write($file, $data);	
	}

	//----------------------------------------------------------------------------------------------------
	// Load               	                                                                  
	//----------------------------------------------------------------------------------------------------
	//  
	// @param  string 	$file
	// @return string
	//          																				  
	//----------------------------------------------------------------------------------------------------
	public function load(String $file) : String
	{
		$file = suffix($file, '.xml');
		
		if( is_file($file) )
		{
			return \File::read($file);	
		}
		else
		{
			\Exceptions::throws('Error', 'fileNotFound', $file);	
		}
	}

	//----------------------------------------------------------------------------------------------------
	// Parse Array		                                                                          
	//----------------------------------------------------------------------------------------------------
	//
	// @param  string $data
	// @return array
	//          																				  
	//----------------------------------------------------------------------------------------------------
	public function parseArray(String $data) : Array
	{
		return $this->parse($data, 'array');
	}
	
	//----------------------------------------------------------------------------------------------------
	// Parse Json		                                                                          
	//----------------------------------------------------------------------------------------------------
	// 
	// @param  string $data
	// @return array
	//          																				 
	//----------------------------------------------------------------------------------------------------
	public function parseJson(String $data) : String
	{
		return json_encode($this->parse($data, 'array'));
	}
	
	//----------------------------------------------------------------------------------------------------
	// Parse Object
	//----------------------------------------------------------------------------------------------------			 			                                      
	// 
	// @param  string 	$data
	// @return object
	//          																				 
	//----------------------------------------------------------------------------------------------------
	public function parseObject(String $data) : \stdClass
	{
		return $this->parse($data, 'object');
	}
	
	//----------------------------------------------------------------------------------------------------
	// Parse
	//----------------------------------------------------------------------------------------------------
	//
	// @param string $xml
	// @param string $result
	//          																				 
	//----------------------------------------------------------------------------------------------------
	public function parse(String $xml, String $result = 'object')
	{
		$parser   = xml_parser_create();
		
		xml_parser_set_option($parser, XML_OPTION_CASE_FOLDING, 0);
		xml_parser_set_option($parser, XML_OPTION_SKIP_WHITE, 1);
		xml_parse_into_struct($parser, $xml, $tags);
		xml_parser_free($parser);
		
		$elements = [];  
		$stack    = [];
		
		if( ! empty($tags) ) foreach( $tags as $tag ) 
		{
			$index = count($elements);
			
			if( $tag['type'] === 'complete' || $tag['type'] === 'open' ) 
			{
				if( $result === 'object' )
				{
					$elements[$index] 	       = new \stdClass;
					$elements[$index]->name	   = isset( $tag['tag'] ) 		? $tag['tag'] 		 : '';
					$elements[$index]->content = isset( $tag['value'] ) 		? $tag['value'] 	 : '';
					$elements[$index]->attr    = isset( $tag['attributes'] )  ? $tag['attributes'] : '';
					
					if( $tag['type'] === 'open' ) 
					{ 
						$elements[$index]->child = [];
						$stack[count($stack)]       = &$elements;
						$elements 					= &$elements[$index]->child;
					}
				}
				else
				{
					$elements[$index] 			  	= [];
					$elements[$index]['name'] 	  	= isset( $tag['tag'] ) 		  ? $tag['tag'] 	   : '';
					$elements[$index]['content']    = isset( $tag['value'] ) 	  ? $tag['value'] 	   : '';
					$elements[$index]['attr']       = isset( $tag['attributes'] ) ? $tag['attributes'] : '';
					
					if( $tag['type'] === 'open' ) 
					{ 
						$elements[$index]['child'] = [];
						$stack[count($stack)]      = &$elements;
						$elements 				   = &$elements[$index]['child'];
					}
				}
			}
				
			if( $tag['type'] === 'close' ) 
			{
				$elements = &$stack[count($stack) - 1];
				unset($stack[count($stack) - 1]);
			}
		}
		
		return $elements[0];		
	}

	//----------------------------------------------------------------------------------------------------
	// Protected Document                                                                      
	//----------------------------------------------------------------------------------------------------
	// Genel Kullanım: Bir XML belgesi oluşturur.								 			                                       
	//          																				  
	//----------------------------------------------------------------------------------------------------
	protected function _document($xml = '', $tab = '', $start = 0)
	{
		static $start;
		
		$eof 	 = EOL;
		$output  = '';
		$tab 	 = str_repeat("\t", $start);
		
		if( ! isset($xml[0]) )
		{
			$xml = [$xml];
			$start = 0;
		}
	
		foreach( $xml as $data )
		{
			$name    = isset( $data['name'] )    ?  $data['name']    : '';
			$attr    = isset( $data['attr'] )    ?  $data['attr']    : '';
			$content = isset( $data['content'] ) ?  $data['content'] : '';
			$child   = isset( $data['child'] )   ?  $data['child']   : '';
			
			$output .= "$tab<$name".\Html::attributes($attr).">";
			
			if( ! empty($content) )
			{
				$output .= $content;	
			}
			else
			{
				if( ! empty($child) )
				{
					$output .= $eof.$this->_document($child, $tab, $start++).$tab;
				}
				else
				{
					$output .= $content;	
				}
			}
			
			$output .= "</".$name.">".$eof;
		}
		
		return $output;
	}	
}