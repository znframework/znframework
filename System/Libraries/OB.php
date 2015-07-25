<?php 
class __USE_STATIC_ACCESS__OB
{
	/***********************************************************************************/
	/* OB LIBRARY        					                   	                       */
	/***********************************************************************************/
	/* Yazar: Ozan UYKUN <ozanbote@windowslive.com> | <ozanbote@gmail.com>
	/* Site: www.zntr.net
	/* Lisans: The MIT License
	/* Telif Hakkı: Copyright (c) 2012-2015, zntr.net
	/*
	/* Sınıf Adı: OB 
	/* Versiyon: 2.0
	/* Tanımlanma: Statik
	/* Dahil Edilme: Gerektirmez
	/* Erişim: ob::, $this->ob, zn::$use->ob, uselib('ob')
	/* Not: Büyük-küçük harf duyarlılığı yoktur.
	/***********************************************************************************/
	
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
	public function takeFileBuffer($file = '')
	{
		if( ! file_exists($file) )
		{
			return Error::set(lang('Error', 'fileParameter', 'file'));	
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
	| 2. array var @params => Yöntemin parametrelerini belirtmek içindir.		  			  |
	|          																				  |
	| Örnek Kullanım: takeFuncBuffer(function(){echo 1;});		 							  |
	|          																				  |
	******************************************************************************************/
	public function takeFuncBuffer($func = '', $params = array())
	{
		if( ! is_callable($func) || ! is_array($params) )
		{
			Error::set(lang('Error', 'callableParameter', 'func'));	
			Error::set(lang('Error', 'arrayParameter', 'params'));
			
			return false;	
		}
		
		ob_start();
		
		if( ! empty($params) )
		{
			return call_user_func_array($func, $params);
		}
		else
		{
			return $func();
		}
		
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
	| 3. array var @params => Yöntemin parametrelerini belirtmek içindir.		  			  |
	|          																				  |
	| Örnek Kullanım: insert('veri', 'dosya/index.html');		 							  |
	|          																				  |
	******************************************************************************************/
	public function insert($name = '', $data = '', $params = array())
	{
		if( ! isValue($name) || ! is_array($params) )
		{
			Error::set(lang('Error', 'valueParameter', 'name'));
			Error::set(lang('Error', 'arrayParameter', 'params'));	
			
			return false;
		}
		
		if( is_callable($data) )
		{
			return Session::insert('OB_DATAS_'.$name, $this->takeFuncBuffer($data, $params));	
		}
		elseif( file_exists($data) )
		{
			return Session::insert('OB_DATAS_'.$name, $this->takeFileBuffer($data));	
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
	public function select($name = '')
	{
		if( ! isValue($name) )
		{
			return Error::set(lang('Error', 'valueParameter', 'name'));	
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
	public function delete($name = '')
	{
		if( ! isValue($name) )
		{
			return Error::set(lang('Error', 'valueParameter', 'name'));		
		}
		
		return Session::delete('OB_DATAS_'.$name);
	}
	
	/******************************************************************************************
	* START                                                                                   *
	*******************************************************************************************
	| Genel Kullanım: ob_start().		  	  	          									  |
	|          																				  |
	******************************************************************************************/
	public function start($callback = '', $chunkSize = 0, $flags = 0)
	{
		if( ! empty($callback) )
		{
			if( ! is_callable($callback) )
			{
				return Error::set(lang('Error', 'callableParameter', 'callback'));		
			}
			
			return ob_start($callback);
		}
		elseif( ! empty($chunkSize) )
		{
			if( ! is_numeric($chunkSize) )
			{
				return Error::set(lang('Error', 'numericParameter', 'chunkSize'));		
			}
			
			return ob_start($callback, $chunkSize);
		}
		elseif( ! empty($flags) )
		{
			if( ! is_numeric($flags) )
			{
				return Error::set(lang('Error', 'numericParameter', 'flags'));		
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
	public function endClean()
	{
		return ob_end_clean();	
	}
	
	/******************************************************************************************
	* CLEAN                                                                                   *
	*******************************************************************************************
	| Genel Kullanım: ob_clean().	     	  	  	          								  |
	|          																				  |
	******************************************************************************************/
	public function clean()
	{
		return ob_clean();	
	}
	
	/******************************************************************************************
	* END FLUSH                                                                               *
	*******************************************************************************************
	| Genel Kullanım: ob_end_flush().		  	  	          								  |
	|          																				  |
	******************************************************************************************/
	public function endFlush()
	{
		return ob_end_flush();	
	}
	
	/******************************************************************************************
	* FLUSH                                                                                   *
	*******************************************************************************************
	| Genel Kullanım: ob_flush().		         	          								  |
	|          																				  |
	******************************************************************************************/
	public function flush()
	{
		return ob_flush();	
	}
	
	/******************************************************************************************
	* GET CLEAN                                                                               *
	*******************************************************************************************
	| Genel Kullanım: ob_get_clean().		  	  	          								  |
	|          																				  |
	******************************************************************************************/
	public function getClean()
	{
		return ob_get_clean();	
	}
	
	/******************************************************************************************
	* CONTENTS                                                                                *
	*******************************************************************************************
	| Genel Kullanım: ob_get_contents().		  	  	      								  |
	|          																				  |
	******************************************************************************************/
	public function contents()
	{
		return ob_get_contents();	
	}
	
	/******************************************************************************************
	* LENGTH                                                                                  *
	*******************************************************************************************
	| Genel Kullanım: ob_get_length().		  	  	          								  |
	|          																				  |
	******************************************************************************************/
	public function length()
	{
		return ob_get_length();	
	}
	
	/******************************************************************************************
	* LEVEL                                                                                   *
	*******************************************************************************************
	| Genel Kullanım: ob_get_level().		  	  	          								  |
	|          																				  |
	******************************************************************************************/
	public function level()
	{
		return ob_get_level();	
	}
	
	/******************************************************************************************
	* STATUS                                                                                  *
	*******************************************************************************************
	| Genel Kullanım: ob_get_status().		  	  	          								  |
	|          																				  |
	******************************************************************************************/
	public function status()
	{
		return ob_get_status();	
	}
	
	/******************************************************************************************
	* LIST HANDLERS                                                                           *
	*******************************************************************************************
	| Genel Kullanım: ob_list_handlers().		  	  	      								  |
	|          																				  |
	******************************************************************************************/
	public function listHandlers()
	{
		return ob_list_handlers();	
	}
	
	/******************************************************************************************
	* IMPLICIT FLUSH                                                                          *
	*******************************************************************************************
	| Genel Kullanım: ob_implicit_flush().		  	  	      								  |
	|          																				  |
	******************************************************************************************/
	public function implicitFlush($flag = true)
	{
		if( ! is_numeric($flag) )
		{
			return Error::set(lang('Error', 'numericParameter', 'flag'));		
		}
		
		return ob_implicit_flush($flag);	
	}
	
	/******************************************************************************************
	* GZ HANDLER                                                                              *
	*******************************************************************************************
	| Genel Kullanım: ob_gzhandler().		  	  	      								  |
	|          																				  |
	******************************************************************************************/
	public function gzHandler($buffer = '', $mode = 0)
	{
		if( ! empty($buffer) )
		{
			if( ! is_string($buffer) )
			{
				return Error::set(lang('Error', 'stringParameter', 'buffer'));		
			}
			
			return ob_gzhandler($buffer);	
		}
		elseif( ! empty($mode) )
		{
			if( ! is_numeric($mode) )
			{
				return Error::set(lang('Error', 'numericParameter', 'mode'));		
			}
			
			return ob_gzhandler($buffer, $mode);	
		}
		else
		{
			return ob_gzhandler();	
		}
	}
}