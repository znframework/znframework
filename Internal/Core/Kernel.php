<?php
//----------------------------------------------------------------------------------------------------
// TEMEL YAPI 
//----------------------------------------------------------------------------------------------------
//
// Author     : Ozan UYKUN <ozanbote@windowslive.com> | <ozanbote@gmail.com>
// Site       : www.znframework.com
// License    : The MIT License
// Copyright  : Copyright (c) 2012-2016, ZN Framework
//
//----------------------------------------------------------------------------------------------------

//----------------------------------------------------------------------------------------------------
// Kernel                                                                                     
//----------------------------------------------------------------------------------------------------
//
// Genel Kullanım: Çıktıyı üretmek için kullanılır.						  
//          																				  
//----------------------------------------------------------------------------------------------------

//----------------------------------------------------------------------------------------------------
// Structure Data
//----------------------------------------------------------------------------------------------------
//
// @return Aktif çalıştırılan kontrolcü dosyasının yol bilgisi.
//
//----------------------------------------------------------------------------------------------------
$datas 		= ZN\Core\Structure::data();
$parameters = $datas['parameters'];
$page       = $datas['page'];
$isFile     = $datas['file'];
$function   = $datas['function'];

//----------------------------------------------------------------------------------------------------
// CURRENT_CFILE
//----------------------------------------------------------------------------------------------------
//
// @return Aktif çalıştırılan kontrolcü dosyasının yol bilgisi.
//
//----------------------------------------------------------------------------------------------------
define('CURRENT_CFILE', $isFile);

//----------------------------------------------------------------------------------------------------
// CURRENT_CFUNCTION
//----------------------------------------------------------------------------------------------------
//
// @return Aktif çalıştırılan sayfaya ait fonksiyon bilgisi.
//
//----------------------------------------------------------------------------------------------------
define('CURRENT_CFUNCTION', $function);

//----------------------------------------------------------------------------------------------------
// CURRENT_CPAGE
//----------------------------------------------------------------------------------------------------
//
// @return Aktif çalıştırılan sayfaya ait kontrolcü dosyasının ad bilgisini.
//
//----------------------------------------------------------------------------------------------------
define('CURRENT_CPAGE', $page.".php");

//----------------------------------------------------------------------------------------------------
// CURRENT_CONTROLLER
//----------------------------------------------------------------------------------------------------
//
// @return Aktif çalıştırılan sayfaya ait kontrolcü bilgisi.
//
//----------------------------------------------------------------------------------------------------
define('CURRENT_CONTROLLER', $page);

//----------------------------------------------------------------------------------------------------
// CURRENT_CPATH
//----------------------------------------------------------------------------------------------------
//
// @return Aktif çalıştırılan sayfaya ait kontrolcü ve fonksiyon yolu	bilgisi.
//
//----------------------------------------------------------------------------------------------------
define('CURRENT_CFPATH', str_replace(CONTROLLERS_DIR, '', CURRENT_CONTROLLER).'/'.CURRENT_CFUNCTION);

//----------------------------------------------------------------------------------------------------
// CURRENT_CFURI
//----------------------------------------------------------------------------------------------------
//
// @return Aktif çalıştırılan sayfaya ait kontrolcü ve fonksiyon yolu	bilgisi.
//
//----------------------------------------------------------------------------------------------------
define('CURRENT_CFURI', CURRENT_CFPATH);

//----------------------------------------------------------------------------------------------------
// CURRENT_CPATH
//----------------------------------------------------------------------------------------------------
//
// @return Aktif çalıştırılan sayfaya ait kontrolcü ve fonksiyon URL yol bilgisi.
//
//----------------------------------------------------------------------------------------------------
define('CURRENT_CFURL', siteUrl(CURRENT_CFPATH));

//----------------------------------------------------------------------------------------------------
// Fonksiyon Yükleme İşlemleri
//----------------------------------------------------------------------------------------------------
$starting = Config::get('Starting');

//----------------------------------------------------------------------------------------------------
// Starting Controllers
//----------------------------------------------------------------------------------------------------
$startController = $starting['controller'];
	
if( ! empty($startController) )
{
	// Tek Kontrolcü
	if( is_string($startController) )
	{
		internalStartingContoller($startController);	
	}
	elseif( is_array($startController) )
	{
		// Çoklu Kontrolcü
		foreach( $startController as $key => $val )
		{
			if( is_numeric($key) )
			{
				// Parametresiz
				internalStartingContoller($val);	
			}	
			else
			{
				// Parametreli
				internalStartingContoller($key, $val);	
			}
		}	
	}
}

if( $starting['autoload']['status'] === true ) 
{
	$startingAutoload 		= Folder::allFiles(AUTOLOAD_DIR, $starting['autoload']['recursive']);
	$commonStartingAutoload = Folder::allFiles(EXTERNAL_AUTOLOAD_DIR, $starting['autoload']['recursive']);
	
	//------------------------------------------------------------------------------------------------
	// Yerel Otomatik Olarak Yüklenen Fonksiyonlar
	//------------------------------------------------------------------------------------------------
	if( ! empty($startingAutoload) ) foreach( $startingAutoload as $file )
	{
		if( extension($file) === 'php' )
		{
			$file = restorationPath($file);
			
			if( is_file($file) )
			{
				require_once $file;
			}
		}
	}
	
	//------------------------------------------------------------------------------------------------
	// Ortak Otomatik Olarak Yüklenen Fonksiyonlar
	//------------------------------------------------------------------------------------------------
	if( ! empty($commonStartingAutoload) ) foreach( $commonStartingAutoload as $file )
	{
		if( extension($file) === 'php' )
		{
			// Aynı dosya hem yerel de hemde genelde mevcutsa
			// genel dizindeki dosya dikkate alınmaz.
			$commonIsSameExistsFile = str_ireplace(EXTERNAL_AUTOLOAD_DIR, AUTOLOAD_DIR, $file);
			
			if( ! is_file($commonIsSameExistsFile) && is_file($file) )
			{
				require_once $file;
			}
		}
	}
}	

//----------------------------------------------------------------------------------------------------
// El ile Yüklenen Fonksiyonlar
//----------------------------------------------------------------------------------------------------
if( ! empty($starting['handload']) )
{
	Import::handload(...$starting['handload']);
}
//----------------------------------------------------------------------------------------------------

// SAYFA KONTROLÜ YAPILIYOR...
// -------------------------------------------------------------------------------
//  Sayfa bilgisine erişilmişse sayfa dahil edilir.
// -------------------------------------------------------------------------------
if( is_file($isFile) )
{
	// -------------------------------------------------------------------------------
	//  Sayfa dahil ediliyor.
	// -------------------------------------------------------------------------------
	require_once $isFile;
		
	// -------------------------------------------------------------------------------
	// Sayfaya ait controller nesnesi oluşturuluyor.
	// -------------------------------------------------------------------------------
	if( class_exists($page, false) )
	{
		// -------------------------------------------------------------------------------
		//  Varsayılan açılış Fonksiyonu. index ya da main kullanılabilir.
		// -------------------------------------------------------------------------------
		if( strtolower($function) === 'index' && ! is_callable([$page, $function]) )
		{
			$function = 'main';	
		}	

		// -------------------------------------------------------------------------------
		// Sınıf ve yöntem bilgileri geçerli ise sayfayı çalıştır.
		// -------------------------------------------------------------------------------	
		if( is_callable([$page, $function]) )
		{
			uselib($page)->$function(...$parameters);
		}
		else
		{
			if( Config::get('Route', 'show404') )
			{	
				redirect(Config::get('Route', 'show404'));	
			}
			else
			{
				// Hatayı rapor et.
				report('Error', lang('Error', 'callUserFuncArrayError', $function), 'SystemCallUserFuncArrayError');	
					
				// Hatayı ekrana yazdır.
				die(Errors::message('Error', 'callUserFuncArrayError', $function));
			}
		}
	}
}
else
{	
	if( Config::get('Route','show404') ) 
	{				
		redirect(Config::get('Route','show404'));		
	}
	else
	{
		// Hatayı rapor et.
		report('Error', lang('Error', 'notIsFileError', $isFile), 'SystemNotIsFileError');
		
		// Hatayı ekrana yazdır.
		die(Errors::message('Error', 'notIsFileError', $isFile));
	}		
}

//----------------------------------------------------------------------------------------------------
// Restore Error Handler
//----------------------------------------------------------------------------------------------------
//
// Hata yakalanıyor.
//
//----------------------------------------------------------------------------------------------------
if( APPMODE !== 'publication' )
{
	restore_error_handler();
}
else
{
	//------------------------------------------------------------------------------------------------
	// Report Error Last Error
	//------------------------------------------------------------------------------------------------
	//
	// Yakalanan son hata log dosyasına kaydediliyor.
	//
	//------------------------------------------------------------------------------------------------
	if(  Config::get('Log', 'createFile') === true && $errorLast = Errors::last() )
	{
		$lang    = lang('Error');
		$message = $lang['line']   .':'.$errorLast['line'].', '.
				   $lang['file']   .':'.$errorLast['file'].', '.
				   $lang['message'].':'.$errorLast['message'];
		
		report('GeneralError', $message, 'GeneralError');
	}	
	//------------------------------------------------------------------------------------------------
}
//----------------------------------------------------------------------------------------------------

//----------------------------------------------------------------------------------------------------
// Ob End Flush
//----------------------------------------------------------------------------------------------------
//
// Tampon kapatılıyor.
//
//----------------------------------------------------------------------------------------------------
ob_end_flush();
//----------------------------------------------------------------------------------------------------