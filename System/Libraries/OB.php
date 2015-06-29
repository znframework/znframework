<?php 
/************************************************************/
/*                     CLASS  OB                    	    */
/************************************************************/
/*

Author: Ozan UYKUN
Site: http://www.zntr.net
Copyright 2012-2015 zntr.net - Tüm hakları saklıdır.

*/
/******************************************************************************************
* OB                                                                                 	  *
*******************************************************************************************
| Sınıfı Kullanırken      :	OB::, $this->OB, zn::$use->OB, uselib('OB')			 		  |
| 																						  |
| Kütüphanelerin kısa isimlendirmelerle kullanımı için. Config/Namespace.php bakınız.     |
******************************************************************************************/	
class OB
{
	/******************************************************************************************
	* TAKE FILE BUFFER                                                                        *
	*******************************************************************************************
	| Genel Kullanım: Bir dosyanın içeriğini tampona almak için kullanılır.		  			  |
	|															                              |
	| Parametreler: Tek parametresi vardır.                                                   |
	| 1. string var @file => Tampona alınacak sayfa.		  								  |
	|          																				  |
	| Örnek Kullanım: takeFileBuffer('dosya/index.html');		 							  |
	|          																				  |
	******************************************************************************************/
	public static function takeFileBuffer($file = '')
	{
		if( ! file_exists($file) )
		{
			return false;	
		}
		
		ob_start();
		
		require($file);
		
		$contents = ob_get_contents();
		
		ob_end_clean();
		
		return $contents;
	}	
	
	/******************************************************************************************
	* TAKE FUNC BUFFER                                                                        *
	*******************************************************************************************
	| Genel Kullanım: Bir çalıştırılabilir yöntemi tampona almak için kullanılır.		  	  |
	|															                              |
	| Parametreler: Tek parametresi vardır.                                                   |
	| 1. string var @func => Tampona alınacak yöntem ismi veya içeriği.		  				  |
	|          																				  |
	| Örnek Kullanım: takeFuncBuffer(function(){echo 1;});		 							  |
	|          																				  |
	******************************************************************************************/
	public static function takeFuncBuffer($func = '')
	{
		if( ! is_callable($func))
		{
			return false;	
		}
		
		ob_start();
		
		$func();
		
		$contents = ob_get_contents();
		
		ob_end_clean();
		
		return $contents;
	}
	
	/******************************************************************************************
	* INSERT                                                                                  *
	*******************************************************************************************
	| Genel Kullanım: Yöntem, dosya ve bir veriyi tamponlamak için kullanılır.		  	  	  |
	|															                              |
	| Parametreler: 2 parametresi vardır.                                                     |
	| 1. string var @name => Veri ismi.		  				  								  |
	| 2. string var @func => Tampona alınacak yöntem ismi veya içeriği.		  				  |
	|          																				  |
	| Örnek Kullanım: insert('veri', 'dosya/index.html');		 							  |
	|          																				  |
	******************************************************************************************/
	public static function insert($name = '', $data = '')
	{
		if( ! isValue($name) )
		{
			return false;	
		}
		
		if( is_callable($data) )
		{
			return Session::insert('OB_DATAS_'.$name, self::takeFuncBuffer($data));	
		}
		elseif( file_exists($data) )
		{
			return Session::insert('OB_DATAS_'.$name, self::takeFileBuffer($data));	
		}
		else
		{
			return Session::insert('OB_DATAS_'.$name, $data);
		}
	}
	
	/******************************************************************************************
	* SELECT                                                                                  *
	*******************************************************************************************
	| Genel Kullanım: Tampona alınan verileri seçmek için kullanılır.		  	  	          |
	|															                              |
	| Parametreler: Tek parametresi vardır.                                                   |
	| 1. string var @name => Veri ismi.		  				  								  |
	|          																				  |
	| Örnek Kullanım: select('veri');		 							  					  |
	|          																				  |
	******************************************************************************************/
	public static function select($name = '')
	{
		if( ! isValue($name) )
		{
			return false;	
		}
		
		return Session::select('OB_DATAS_'.$name);
	}
	
	/******************************************************************************************
	* DELETE                                                                                  *
	*******************************************************************************************
	| Genel Kullanım: Tampona alınan verileri silmek için kullanılır.		  	  	          |
	|															                              |
	| Parametreler: Tek parametresi vardır.                                                   |
	| 1. string var @name => Veri ismi.		  				  								  |
	|          																				  |
	| Örnek Kullanım: delete('veri');		 							  					  |
	|          																				  |
	******************************************************************************************/
	public static function delete($name = '')
	{
		if( ! isValue($name) )
		{
			return false;	
		}
		
		return Session::delete('OB_DATAS_'.$name);
	}
	
	/******************************************************************************************
	* START                                                                                   *
	*******************************************************************************************
	| Genel Kullanım: ob_start().		  	  	          									  |
	|          																				  |
	******************************************************************************************/
	public static function start($callback = '', $chunkSize = 0, $flags = 0)
	{
		if( ! empty($callback) )
		{
			if( ! is_callable($callback) )
			{
				return false;	
			}
			
			return ob_start($callback);
		}
		elseif( ! empty($chunkSize) )
		{
			if( ! is_numeric($chunkSize) )
			{
				return false;	
			}
			
			return ob_start($callback, $chunkSize);
		}
		elseif( ! empty($flags) )
		{
			if( ! is_numeric($flags) )
			{
				return false;	
			}
			
			return ob_start($callback, $chunkSize, $flags);
		}
		else
		{
			return ob_start();	
		}
	}
	
	/******************************************************************************************
	* END CLEAN                                                                               *
	*******************************************************************************************
	| Genel Kullanım: ob_end_clean().		  	  	          								  |
	|          																				  |
	******************************************************************************************/
	public static function endClean()
	{
		return ob_end_clean();	
	}
	
	/******************************************************************************************
	* CLEAN                                                                                   *
	*******************************************************************************************
	| Genel Kullanım: ob_clean().	     	  	  	          								  |
	|          																				  |
	******************************************************************************************/
	public static function clean()
	{
		return ob_clean();	
	}
	
	/******************************************************************************************
	* END FLUSH                                                                               *
	*******************************************************************************************
	| Genel Kullanım: ob_end_flush().		  	  	          								  |
	|          																				  |
	******************************************************************************************/
	public static function endFlush()
	{
		return ob_end_flush();	
	}
	
	/******************************************************************************************
	* FLUSH                                                                                   *
	*******************************************************************************************
	| Genel Kullanım: ob_flush().		         	          								  |
	|          																				  |
	******************************************************************************************/
	public static function flush()
	{
		return ob_flush();	
	}
	
	/******************************************************************************************
	* GET CLEAN                                                                               *
	*******************************************************************************************
	| Genel Kullanım: ob_get_clean().		  	  	          								  |
	|          																				  |
	******************************************************************************************/
	public static function getClean()
	{
		return ob_get_clean();	
	}
	
	/******************************************************************************************
	* CONTENTS                                                                                *
	*******************************************************************************************
	| Genel Kullanım: ob_get_contents().		  	  	      								  |
	|          																				  |
	******************************************************************************************/
	public static function contents()
	{
		return ob_get_contents();	
	}
	
	/******************************************************************************************
	* LENGTH                                                                                  *
	*******************************************************************************************
	| Genel Kullanım: ob_get_length().		  	  	          								  |
	|          																				  |
	******************************************************************************************/
	public static function length()
	{
		return ob_get_length();	
	}
	
	/******************************************************************************************
	* LEVEL                                                                                   *
	*******************************************************************************************
	| Genel Kullanım: ob_get_level().		  	  	          								  |
	|          																				  |
	******************************************************************************************/
	public static function level()
	{
		return ob_get_level();	
	}
	
	/******************************************************************************************
	* STATUS                                                                                  *
	*******************************************************************************************
	| Genel Kullanım: ob_get_status().		  	  	          								  |
	|          																				  |
	******************************************************************************************/
	public static function status()
	{
		return ob_get_status();	
	}
	
	/******************************************************************************************
	* LIST HANDLERS                                                                           *
	*******************************************************************************************
	| Genel Kullanım: ob_list_handlers().		  	  	      								  |
	|          																				  |
	******************************************************************************************/
	public static function listHandlers()
	{
		return ob_list_handlers();	
	}
	
	/******************************************************************************************
	* IMPLICIT FLUSH                                                                          *
	*******************************************************************************************
	| Genel Kullanım: ob_implicit_flush().		  	  	      								  |
	|          																				  |
	******************************************************************************************/
	public static function implicitFlush($flag = true)
	{
		if( ! is_numeric($flag) )
		{
			return false;	
		}
		
		return ob_implicit_flush($flag);	
	}
	
	/******************************************************************************************
	* GZ HANDLER                                                                              *
	*******************************************************************************************
	| Genel Kullanım: ob_gzhandler().		  	  	      								  |
	|          																				  |
	******************************************************************************************/
	public static function gzHandler($buffer = '', $mode = 0)
	{
		if( ! empty($buffer) )
		{
			if( ! is_string($buffer) )
			{
				return false;	
			}
			
			return ob_gzhandler($buffer);	
		}
		elseif( ! empty($mode) )
		{
			if( ! is_numeric($mode) )
			{
				return false;	
			}
			
			return ob_gzhandler($buffer, $mode);	
		}
		else
		{
			return ob_gzhandler();	
		}
	}
}