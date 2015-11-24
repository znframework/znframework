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