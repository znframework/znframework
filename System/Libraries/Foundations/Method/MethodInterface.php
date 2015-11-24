<?php
interface MethodInterface
{
	//----------------------------------------------------------------------------------------------------
	//
	// Yazar      : Ozan UYKUN <ozanbote@windowslive.com> | <ozanbote@gmail.com>
	// Site       : www.zntr.net
	// Lisans     : The MIT License
	// Telif Hakkı: Copyright (c) 2012-2016, zntr.net
	//
	//----------------------------------------------------------------------------------------------------
	
	/******************************************************************************************
	* POST                                                                                    *
	*******************************************************************************************
	| Genel Kullanım:$_POST Global değişkeninin kullanımıdır.                                 |
	|															                              |
	| Parametreler: 2 parametresi vardır.                                              	      |
	| 1. string var @name => Post değişkeninin anahtar ismidir. $_POST['isim']       	  	  |
	| 2. string var @value => Anahtarın tutacağı veri. $_POST['isim'] = 'Değer'               |
	|          																				  |
	| Örnek Kullanım: post('isim', 'Değer');        	  					                  |
	| // $_POST['isim'] = 'Değer'      													      |
	|          																				  |
	******************************************************************************************/	
	public function post($name, $value);	
	
	/******************************************************************************************
	* GET                                                                                     *
	*******************************************************************************************
	| Genel Kullanım:$_GET Global değişkeninin kullanımıdır.                                  |
	|															                              |
	| Parametreler: 2 parametresi vardır.                                              	      |
	| 1. string var @name => Get değişkeninin anahtar ismidir. $_GET['isim']       	  	      |
	| 2. string var @value => Anahtarın tutacağı veri. $_GET['isim'] = 'Değer'                |
	|          																				  |
	| Örnek Kullanım: get('isim', 'Değer');        	  					                      |
	| // $_GET['isim'] = 'Değer'      													      |
	|          																				  |
	******************************************************************************************/	
	public function get($name, $value);
	
	/******************************************************************************************
	* REQUEST                                                                                 *
	*******************************************************************************************
	| Genel Kullanım:$_REQUEST Global değişkeninin kullanımıdır.                              |
	|															                              |
	| Parametreler: 2 parametresi vardır.                                              	      |
	| 1. string var @name => Request değişkeninin anahtar ismidir. $_REQUEST['isim']       	  |
	| 2. string var @value => Anahtarın tutacağı veri. $_REQUEST['isim'] = 'Değer'            |
	|          																				  |
	| Örnek Kullanım: request('isim', 'Değer');        	  					                  |
	| // $_REQUEST['isim'] = 'Değer'      													  |
	|          																				  |
	******************************************************************************************/	
	public function request($name, $value);
	
	/******************************************************************************************
	* FILES                                                                                   *
	*******************************************************************************************
	| Genel Kullanım:$_FILES Global değişkeninin kullanımıdır.                                |
	|															                              |
	| Parametreler: 2 parametresi vardır.                                              	      |
	| 1. string var @file_name => Request değişkeninin anahtar ismidir.$_FILES['upload']	  |
	| 2. [ string var @type ] => Veri türü. Varsayılan:name. $_FILES['upload']['name']        |
	|          																				  |
	| Örnek Kullanım: request('upload', 'name');        	  					              |
	| // $_FILES['upload']['name']      											          |
	|          																				  |
	******************************************************************************************/	
	public function files($fileName, $type);
}