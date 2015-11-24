<?php 
interface MLInterface
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
	* INSERT                                                                                  *
	*******************************************************************************************
	| Genel Kullanım: Dil dosyasına kelime eklemek için kullanılır. 						  |
	
	  @param string $app 
	  @param mixed  $key
	  @param string $data
	  
	  @return bool
	|          																				  |
	******************************************************************************************/
	public function insert($app, $key, $data);
	
	/******************************************************************************************
	* DELETE                                                                                  *
	*******************************************************************************************
	| Genel Kullanım: Dil dosyasından kelime silmek için kullanılır. 						  |
	
	  @param string $app 
	  @param mixed  $key
	  
	  @return bool
	|          																				  |
	******************************************************************************************/
	public function delete($app, $key);
	
	/******************************************************************************************
	* UPDATE                                                                                  *
	*******************************************************************************************
	| Genel Kullanım: Dil dosyasında yer alan bir kelimeyi güncellemek için kullanılır.		  |
	
	  @param string $app 
	  @param mixed  $key
	  @param string $data
	  
	  @return bool
	|          																				  |
	******************************************************************************************/
	public function update($app, $key, $data);
	
	/******************************************************************************************
	* SELECT                                                                                  *
	*******************************************************************************************
	| Genel Kullanım: Dil dosyasın yer alan istenilen kelimeye erişmek için kullanılır.  	  |
	
	  @param mixed  $key
	  
	  @return string
	|          																				  |
	******************************************************************************************/
	public function select($key);
	
	/******************************************************************************************
	* LANG                                                                                    *
	*******************************************************************************************
	| Genel Kullanım: Sayfanın aktif dilini ayarlamak için kullanılır. 						  |
	
	  @param string $lang 
	  
	  @return bool
	|          																				  |
	******************************************************************************************/
	public function lang($lang);
}