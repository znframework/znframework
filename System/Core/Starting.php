<?php
//----------------------------------------------------------------------------------------------------
// SİSTEM BAŞLATILIRKEN 
//----------------------------------------------------------------------------------------------------
//
// Yazar      : Ozan UYKUN <ozanbote@windowslive.com> | <ozanbote@gmail.com>
// Site       : www.zntr.net
// Lisans     : The MIT License
// Telif Hakkı: Copyright (c) 2012-2016, zntr.net
//
//----------------------------------------------------------------------------------------------------

//----------------------------------------------------------------------------------------------------
// INI Ayarlarını Yapılandırma İşlemi
//----------------------------------------------------------------------------------------------------

$iniSet = Config::get('Ini', 'settings');

if( ! empty($iniSet) ) 
{
	Config::iniSet($iniSet);
}

//----------------------------------------------------------------------------------------------------
	
	
		
//----------------------------------------------------------------------------------------------------
// Htaccess Dosyası Oluşturma İşlemi
//----------------------------------------------------------------------------------------------------
 	
if( Config::get('Htaccess','createFile') === true ) 
{
	createHtaccessFile();
}	

//----------------------------------------------------------------------------------------------------



//----------------------------------------------------------------------------------------------------
// Fonksiyon Yükleme İşlemleri
//----------------------------------------------------------------------------------------------------
 
$functions = Config::get('Functions');

if( $functions['autoload']['status'] === true ) 
{
	$autoloadFunctions = Folder::allFiles(AUTOLOAD_DIR, $functions['autoload']['recursive']);
	
	//------------------------------------------------------------------------------------------------
	// Otomatik Olarak Yüklenen Fonksiyonlar
	//------------------------------------------------------------------------------------------------
	if( ! empty($autoloadFunctions) ) foreach( $autoloadFunctions as $file )
	{
		$file = restorationPath(suffix($file, '.php'));
		
		if( is_file($file) )
		{
			require_once $file;
		}
	}
}	

//----------------------------------------------------------------------------------------------------
// El ile Yüklenen Fonksiyonlar
//----------------------------------------------------------------------------------------------------
if( ! empty($functions['handload']) ) foreach( $functions['handload'] as $file )
{
	$file =  restorationPath(HANDLOAD_DIR.suffix($file, '.php'));

	if( is_file($file) )
	{
		require_once $file;
	}
}
//----------------------------------------------------------------------------------------------------



//----------------------------------------------------------------------------------------------------
// Composer Autoload İşlemi
//----------------------------------------------------------------------------------------------------
	
$composer = Config::get('Composer', 'autoload');

if( $composer === true )
{
	$path = 'vendor/autoload.php';
	
	if( file_exists($path) )
	{
		require_once($path);
	}
	else
	{
		report('Error', getMessage('Error', 'fileNotFound', $path) ,'AutoloadComposer');
		
		die(getErrorMessage('Error', 'fileNotFound', $path));
	}
}
elseif( file_exists($composer) )
{
	require_once($composer);
}
elseif( ! empty($composer) )
{
	report('Error', getMessage('Error', 'fileNotFound', $composer) ,'AutoloadComposer');
	
	die(getErrorMessage('Error', 'fileNotFound', $composer));
}

//----------------------------------------------------------------------------------------------------	