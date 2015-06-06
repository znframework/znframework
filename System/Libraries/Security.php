<?php 
/************************************************************/
/*                       CLASS SECURITY                     */
/************************************************************/
/*

Author: Ozan UYKUN
Site: http://www.zntr.net
Copyright 2012-2015 zntr.net - Tüm hakları saklıdır.

*/
/******************************************************************************************
* SECURITY                                                                            	  *
*******************************************************************************************
| Dahil(Import) Edilirken : Security   							                          |
| Sınıfı Kullanırken      :	Sec::   											          |
| 																						  |
| Kütüphanelerin kısa isimlendirmelerle kullanımı için. Config/Libraries.php bakınız.     |
******************************************************************************************/
class Sec
{
	/******************************************************************************************
	* NC ENCODE                                                                               *
	*******************************************************************************************
	| Genel Kullanım: Kötü içerikli karakterlerin temizlemesi için                            |
	| kullanılır.												                              |
	|															                              |
	| Parametreler: 3 adet parametre alır.                                                    |
	| 1. string var @string => Temizleme yapılacak metin.                                     |
	| 2. string/array var @badword => Kötü içerikli kelimeler.                                |
	| 3. string/array var @changechar => Değiştirilecek kelilemeler                           |
	|          																				  |
	| 2. ve 3. Parametreler kullanılmaz ise varsayılan olarak Config/Security.php dosyasında  |
	| yer alan nc_encode => change chars karakterleri ayarlı olacaktır. 					  |
	******************************************************************************************/
	public static function nc_encode($string = '', $badwords = '', $changechar = '[badchars]')
	{
		if( ! is_string($string)) 
		{
			return false;
		}
	
		// 2. Parametre boş ise varsayılan olarak Config/Security.php dosya ayarlarını kullan.	
		if( empty($badwords) )
		{
			$secnc = config::get("Security", "nc_encode");
			$badwords = $secnc['bad_chars'];
			$changechar = $secnc['change_bad_chars'];
		}
		if( ! is_array($badwords)) return  $string = reg::replace($badwords, $changechar, $string, '<inspace><insens>');
		
		$ch = '';
		$i = 0;	
		
		foreach($badwords as $value)
		{		
			if( ! is_array($changechar) )
			{
				$ch = $changechar;
			}
			else
			{
				if( isset($changechar[$i]) )
				{
					$ch = $changechar[$i];	
					$i++;
				}
			}
			
			$string = reg::replace($value, $ch, $string, '<inspace><insens>');
		}
	
		return $string;
	}	
		
		
	/******************************************************************************************
	* INJECTION ENCODE                                                                        *
	*******************************************************************************************
	| Genel Kullanım: SQL sorgularında tehdit edici karakterlerin izole edilmesi için         |
	| kullanılır. Hangi karakterlerin izole edileceği Config/Security.php dosyasında yer alan.|									         
	| Injection_bad_chars parametresinde mevcuttur.											  |				                           
	| Parametreler: 3 adet parametre alır. 													  |
	|																						  |                                                   
	| 1. string var @string => Temizleme yapılacak metin.                                     |
	******************************************************************************************/	
	public static function injection_encode($string = '')
	{
		if( ! is_string($string)) 
		{
			return false;
		}
		
		$sec_bac_chars = config::get("Security", "injection_bad_chars");
		
		if( ! empty($sec_bac_chars)) 
		{
			foreach($sec_bac_chars as $bad_char => $change_char)
			{
				if(is_numeric($bad_char))
				{
					$bad_char = $change_char;
					$change_char = '';
				}
				
				$bad_char = trim($bad_char, '/');
				
				$string = preg_replace('/'.$bad_char.'/xi', $change_char, $string);
			}
		}
		
		return addslashes(trim($string));
	}
	
	
	/******************************************************************************************
	* INJECTION DECODE                                                                        *
	*******************************************************************************************
	| Genel Kullanım: SQL sorgularında tehdit edici karakterlerin izole edilen karakterlerin  |
	| kullanılır. Ancak sadece izole edilen tırnak işareleri tekrar eski haline getirilir.    |
	|																						  |	
	| 1. string var @string => Temizleme yapılacak metin. 									  |								       
	******************************************************************************************/	
	public static function injection_decode($string = '')
	{
		if( ! is_string($string))
		{ 
			return false;
		}
		
		return stripslashes(trim($string));
	}
	
	
	/******************************************************************************************
	* XSS ENCODE                                                                              *
	*******************************************************************************************
	| Genel Kullanım: Script kodların kullanımında tehdit edici karakterlerin izole edilmesini|
	| sağlamak için kullanılır. Dönüştürülecek karakterlerin listesi için Cofig/Security.php  |	
	|																						  |
	| 1. string var @string => Temizleme yapılacak metin.           					      |
	******************************************************************************************/	
	public static function xss_encode($string = '')
	{
		if( ! is_string($string)) 
		{
			return false;
		}
		
		$sec_bac_chars = config::get("Security", "script_bad_chars");
		
		if( ! empty($sec_bac_chars)) 
		{
			foreach($sec_bac_chars as $bad_char => $change_char)
			{
				if(is_numeric($bad_char))
				{
					$bad_char = $change_char;
					$change_char = '';
				}
				
				$bad_char = trim($bad_char, '/');
				
				$string = preg_replace('/'.$bad_char.'/xi', $change_char, $string);
			}
		}
		
		return $string;
	}


	/******************************************************************************************
	* HTML EMCODE                                                                             *
	*******************************************************************************************
	| Genel Kullanım: HTML özel karakterlerinin ( < , > )izole edilmesini                     |
	| sağlamak için kullanılır. 															  |	
	|																						  |
	| 1. string var @string => Temizleme yapılacak metin.           					      |
	| 2. string var @type => Tırnak işaretleri.           					                  |
	******************************************************************************************/	
	public static function html_encode($string, $type = 'quotes')
	{
		if( ! is_string($string)) 
		{
			return false;
		}
		
		if( ! is_string($type)) 
		{	
			$type = 'quotes';
		}
		
		if($type === 'quotes') 
		{
			$tp = ENT_QUOTES; 
		}
		elseif($type === 'nonquotes')
		{
			$tp = ENT_NOQUOTES; 
		}
		else 
		{
			$tp = ENT_COMPAT;
		}
		
		return htmlspecialchars(trim($string), $tp);
	}
	
	
	/******************************************************************************************
	* HTML DECODE                                                                             *
	*******************************************************************************************
	| Genel Kullanım: İzole edilen HTML özel karakterlerinin ( < , > ) gerçek hallerine       |
	| dönmesini sağlamak için kullanılır. 												      |	
	|																						  |
	| 1. string var @string => Temizleme yapılacak metin.           					      |
	| 2. string var @type => Tırnak işaretleri.           					                  |
	******************************************************************************************/	
	public static function html_decode($string, $type = 'quotes')
	{
		if( ! is_string($string))
		{
			return false;
		}
		
		if( ! is_string($type)) 
		{
			$type = 'quotes';
		}
		
		if($type === 'quotes')
		{ 
			$tp = ENT_QUOTES; 
		}
		elseif($type === 'combat')
		{	
			$tp = ENT_COMPAT; 
		}
		else 
		{
			$tp = ENT_NOQUOTES;
		}
		
		return htmlspecialchars_decode(trim($string), $tp);
	}
}