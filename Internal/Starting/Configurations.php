<?php
//--------------------------------------------------------------------------------------------------
// Starting
//--------------------------------------------------------------------------------------------------
//
// Author     : Ozan UYKUN <ozanbote@windowslive.com> | <ozanbote@gmail.com>
// Site       : www.znframework.com
// License    : The MIT License
// Copyright  : Copyright (c) 2012-2016, ZN Framework
//
//--------------------------------------------------------------------------------------------------

//--------------------------------------------------------------------------------------------------
// Ob Start
//--------------------------------------------------------------------------------------------------
//
// Tampon başlatılıyor.
//
//--------------------------------------------------------------------------------------------------
if( Config::get('IndividualStructures', 'cache')['obGzhandler'] && substr_count(server('acceptEncoding'), 'gzip') )
{
    ob_start('ob_gzhandler');
}
else
{
    ob_start();
}
//--------------------------------------------------------------------------------------------------

//--------------------------------------------------------------------------------------------------
// Headers
//--------------------------------------------------------------------------------------------------
//
// Başlık bilgileri düzenleniyor.
//
//--------------------------------------------------------------------------------------------------
headers(Config::get('General', 'headers'));
//--------------------------------------------------------------------------------------------------

//--------------------------------------------------------------------------------------------------
// Set Error Handler
//--------------------------------------------------------------------------------------------------
//
// Yakanalan hata set ediliyor.
//
//--------------------------------------------------------------------------------------------------
if( PROJECT_MODE !== 'publication' )
{
    set_error_handler('Exceptions::table');
}
//--------------------------------------------------------------------------------------------------

//--------------------------------------------------------------------------------------------------
// INI Ayarlarını Yapılandırma İşlemi
//--------------------------------------------------------------------------------------------------
if( $iniSet = Config::get('Htaccess', 'ini')['settings'] )
{
    Config::iniSet($iniSet);
}
//--------------------------------------------------------------------------------------------------

//--------------------------------------------------------------------------------------------------
// Htaccess Dosyası Oluşturma İşlemi
//--------------------------------------------------------------------------------------------------
if( Config::get('Htaccess','createFile') === true )
{
    internalCreateHtaccessFile();
}
//--------------------------------------------------------------------------------------------------

//--------------------------------------------------------------------------------------------------
// Robots Dosyası Oluşturma İşlemi
//--------------------------------------------------------------------------------------------------
if( Config::get('Robots','createFile') === true )
{
    internalCreateRobotsFile();
}
//--------------------------------------------------------------------------------------------------

//--------------------------------------------------------------------------------------------------------
// Invalid Request Page
//--------------------------------------------------------------------------------------------------------
$invalidRequest = Config::get('Services', 'route')['invalidRequest'];

if( $invalidRequest['control'] === true && Http::isInvalidRequest() )
{
    if( ! in_array(strtolower(CURRENT_CFURI), array_map('strtolower', $invalidRequest['allowPages'])) )
    {
        if( empty($invalidRequest['page']) )
        {
            trace(lang('Error', 'invalidRequest'));
        }

        redirect($invalidRequest['page']);
    }
}
//--------------------------------------------------------------------------------------------------------

//--------------------------------------------------------------------------------------------------
// Composer Autoloader
//--------------------------------------------------------------------------------------------------
if( $composer = Config::get('Autoloader', 'composer') )
{
    $path = 'vendor/autoload.php';

    if( $composer === true )
    {
        if( file_exists($path) )
        {
            import($path);
        }
        else
        {
            report('Error', lang('Error', 'fileNotFound', $path) ,'AutoloadComposer');

            die(Errors::message('Error', 'fileNotFound', $path));
        }
    }
    elseif( is_file($composer) )
    {
        require_once($composer);
    }
    else
    {
        $path = suffix($composer) . $path;

        report('Error', lang('Error', 'fileNotFound', $path) ,'AutoloadComposer');

        die(Errors::message('Error', 'fileNotFound', $path));
    }
}
//--------------------------------------------------------------------------------------------------------

//--------------------------------------------------------------------------------------------------------
// Autoload Files
//--------------------------------------------------------------------------------------------------------
$starting = Config::get('Starting');

if( $starting['autoload']['status'] === true )
{
    $startingAutoload       = Folder::allFiles(AUTOLOAD_DIR, $starting['autoload']['recursive']);
    $commonStartingAutoload = Folder::allFiles(EXTERNAL_AUTOLOAD_DIR, $starting['autoload']['recursive']);

    if( ! empty($startingAutoload) ) foreach( $startingAutoload as $file )
    {
        if( extension($file) === 'php' )
        {
            if( is_file($file) )
            {
                import($file);
            }
        }
    }

    if( ! empty($commonStartingAutoload) ) foreach( $commonStartingAutoload as $file )
    {
        if( extension($file) === 'php' )
        {
            $commonIsSameExistsFile = str_ireplace(EXTERNAL_AUTOLOAD_DIR, AUTOLOAD_DIR, $file);

            if( ! is_file($commonIsSameExistsFile) && is_file($file) )
            {
                import($file);
            }
        }
    }
}
//--------------------------------------------------------------------------------------------------------

//--------------------------------------------------------------------------------------------------------
// Handload Files
//--------------------------------------------------------------------------------------------------------
if( ! empty($starting['handload']) )
{
    Import::handload(...$starting['handload']);
}
//--------------------------------------------------------------------------------------------------------
