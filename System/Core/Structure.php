<?php
/************************************************************/
/*                   	 STRUCTURE URL                      */
/************************************************************/
/*

Author: Ozan UYKUN
Site: http://www.zntr.net
Copyright 2012-2015 zntr.net - Tüm hakları saklıdır.

*/
/* 
	ZN FRAMEWOK URL SİSTEMİ
						                      
	httpx://www.xxxx.xxx/[dizin/dizin/.../][index.php/]['dil/']sayfa(sınıf)/fonksiyon[/parametre1/parametre2/.../parametreN] 

*/

/* STRUCTURE RUN *
 *
 * 
 * System running
 */
Structure::run();

/* CLASS STRUCTURE *
 *
 * 
 * 
 */
class Structure
{
	/* STRUCTURE RUN
	 *
	 *
	 *
	 */
	
	public static function run()
	{
		$url_join 		= ''; 	
		$url_parameters = '';	  
		$is_file 		= ''; 	
		$parameters 	= array();
		$contents 		= '';
		$request_uri 	= request_uri();	
		$url 			= explode("?", $request_uri);
		$url_explode 	= explode("/", $url[0]);
		
		for($i=0; $i<count($url_explode); $i++)
		{
			$url_join .= $url_explode[$i];
		
			if( is_file( CODER_DIR.suffix($url_join,".php") ) )
			{
			
				if( isset($url_explode[$i]) )
				{
					$page = $url_explode[$i];
				}
				
				if( isset($url_explode[$i+1]) )	
				{
					$function = $url_explode[$i+1];
				}
				
				$url_parameters = $i+2;
				$last_join 		= $url_join;		
				$is_file 		= CODER_DIR.suffix($last_join,".php");
			}
			else
			{
				$url_join .= "/";	
			}
		
			if( isset($url_explode[$url_parameters]) )
			{
				 array_push( $parameters, $url_explode[$url_parameters] ); 		 
				 $url_parameters++;
			}
		
		}
		
		// ----------------------------------------------------------------------
		
		// TAMPONLAMA BAŞLATILIYOR...
		
		if(config::get("Cache","ob_gzhandler") && substr_count(server('accept_encoding'), 'gzip')) 
		{
			ob_start('ob_gzhandler');
		}
		else
		{
			ob_start();
		}
		
		// ----------------------------------------------------------------------

		// BAŞLIK BİLGİLERİ DÜZENLENİYOR...
		
		headers(config::get('Headers', 'settings'));
		
		// ----------------------------------------------------------------------
	
		// SAYFA KONTROLÜ YAPILIYOR...
		
		if( $is_file )
		{
			if(config::get("Repair","mode")) 
			{
				repair::mode();
			}
			
			require_once $is_file;
			
			if( ! isset($function) ) 
			{
				$function = 'index';		
			}
			
			if( ! $page) 
			{
				if( ! config::get('Route', 'show_404'))
				{
					$error = get_message('System', 'system_call_user_func_class_error');
					echo $error;
					report('Error', $error, 'SystemCallUserFuncClassError');
					return false;
				}
				else
				{
					redirect(config::get('Route', 'show_404'));
				}
			}
				
			zn::$zndynamic = new $page;
			
			zndynamic_autoloaded();
					
			if(is_callable(array(zn::$zndynamic, $function)))
			{
				call_user_func_array( array(zn::$zndynamic, $function), $parameters);
			}
			else
			{
				if( ! config::get('Route', 'show_404'))
				{
					$error = get_message('System', 'system_call_user_func_array_error');
					echo $error;
					report('Error', $error, 'SystemCallUserFuncArrayError');
					return false;
				}
				else
				{
					redirect(config::get('Route', 'show_404'));
				}
			}
	
		}
		else
		{	
			if(config::get('Route','show_404')) 
			{				
				redirect(config::get('Route','show_404'));		
			}
			else
			{
				$error = get_message('System', 'system_not_is_file_error');
				echo $error;
				report('Error', $error, 'SystemNotIsFileError');
				return false;
			}		
		}
		
		// ----------------------------------------------------------------------
		
		// TAMPONLAMA KAPATILIYOR...
		
		ob_end_flush();
		
		// ----------------------------------------------------------------------
	}
}