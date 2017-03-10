<?php
//--------------------------------------------------------------------------------------------------
// Internal
//--------------------------------------------------------------------------------------------------
//
// Author     : Ozan UYKUN <ozanbote@windowslive.com> | <ozanbote@gmail.com>
// Site       : www.znframework.com
// License    : The MIT License
// Copyright  : Copyright (c) 2012-2016, ZN Framework
//
//--------------------------------------------------------------------------------------------------

//--------------------------------------------------------------------------------------------------
// internalDefaultProjectKey() - ZN >= 4.2.7
//--------------------------------------------------------------------------------------------------
//
// @param void
//
// @return string
//
//--------------------------------------------------------------------------------------------------
function internalDefaultProjectKey() : String
{
    if( defined('_CURRENT_PROJECT') )
    {
        $containers = PROJECTS_CONFIG['containers'];

        if( ! empty($containers[_CURRENT_PROJECT]) )
        {
            return md5(baseUrl(strtolower($containers[_CURRENT_PROJECT])));
        }
    }

    return md5(baseUrl(strtolower(CURRENT_PROJECT)));
}

//--------------------------------------------------------------------------------------------------
// internalGetCurrentProject() - ZN >= 4.2.6
//--------------------------------------------------------------------------------------------------
//
// @param void
//
// @return string
//
//--------------------------------------------------------------------------------------------------
function internalGetCurrentProject() : String
{
    return (CURRENT_PROJECT === DEFAULT_PROJECT ? '' : suffix(CURRENT_PROJECT));
}

//--------------------------------------------------------------------------------------------------
// internalBaseDir() - ZN >= 4.2.6
//--------------------------------------------------------------------------------------------------
//
// @param int $index = 0
//
// @return string
//
//--------------------------------------------------------------------------------------------------
function internalBaseDir(Int $index = 0) : String
{
    $newBaseDir = BASE_DIR;

    if( BASE_DIR !== '/' )
    {
        $baseDir = substr(BASE_DIR, 1, -1);

        if( $index < 0 )
        {
            $baseDir    = explode('/', $baseDir);
            $newBaseDir = '/';

            for( $i = 0; $i < count($baseDir) + $index; $i++ )
            {
                $newBaseDir .= suffix($baseDir[$i]);
            }
        }
    }

    return $newBaseDir;
}

//--------------------------------------------------------------------------------------------------
// internalRequestURI()
//--------------------------------------------------------------------------------------------------
//
// @param void
//
// @return string
//
//--------------------------------------------------------------------------------------------------
function internalRequestURI() : String
{
    $requestUri = currentUri()
                ? str_replace(DIRECTORY_INDEX.'/', '', currentUri())
                : substr(server('currentPath'), 1);

    if( isset($requestUri[strlen($requestUri) - 1]) && $requestUri[strlen($requestUri) - 1] === '/' )
    {
            $requestUri = substr($requestUri, 0, -1);
    }

    if( defined('_CURRENT_PROJECT') )
    {
        $requestUri = internalCleanURIPrefix($requestUri, _CURRENT_PROJECT);
    }

    $requestUri = internalCleanInjection(internalRouteURI($requestUri));
    $requestUri = internalCleanURIPrefix($requestUri, currentLang());

    return $requestUri;
}

//--------------------------------------------------------------------------------------------------
// internalCleanURIPrefix()
//--------------------------------------------------------------------------------------------------
//
// @param string $uri
// @param string $cleanData
//
//--------------------------------------------------------------------------------------------------
function internalCleanURIPrefix(String $uri = '', String $cleanData = NULL) : String
{
    $suffixData = suffix((string) $cleanData);

    if( ! empty($cleanData) && stripos($uri, $suffixData) === 0 )
    {
        $uri = substr($uri, strlen($suffixData));
    }

    return $uri;
}

//--------------------------------------------------------------------------------------------------
// internalRouteURI()
//--------------------------------------------------------------------------------------------------
//
// @param string $requestUri
//
// @return string
//
//--------------------------------------------------------------------------------------------------
function internalRouteURI(String $requestUri = '') : String
{
    $config = Config::get('Services', 'route');

    if( $config['openPage'] )
    {
        $internalDir = NULL;

        if( defined('_CURRENT_PROJECT') )
        {
            $configAppdir = PROJECTS_CONFIG['directory']['others'];

            if( is_array($configAppdir) )
            {
                $internalDir = ! empty($configAppdir[$requestUri]) ? $requestUri : _CURRENT_PROJECT;
            }
            else
            {
                $internalDir = _CURRENT_PROJECT;
            }
        }

        if
        (
            $requestUri === DIRECTORY_INDEX ||
            $requestUri === getLang()       ||
            $requestUri === $internalDir    ||
            empty($requestUri)
        )
        {
            $requestUri = $config['openPage'];
        }
    }

    $uriChange   = $config['changeUri'];
    $patternType = $config['patternType'];

    if( ! empty($uriChange) ) foreach( $uriChange as $key => $val )
    {
        if( $patternType === 'classic' )
        {
            $requestUri = preg_replace(presuffix($key).'xi', $val, $requestUri);
        }
        else
        {
            $requestUri = Regex::replace($key, $val, $requestUri, 'xi');
        }
    }

    return $requestUri;
}

//--------------------------------------------------------------------------------------------------
// internalCleanInjection()
//--------------------------------------------------------------------------------------------------
//
// @param string $string
//
// @return string
//
//--------------------------------------------------------------------------------------------------
function internalCleanInjection(String $string = '') : String
{
    $urlInjectionChangeChars = Config::get('IndividualStructures', 'security')['urlChangeChars'];

    if( ! empty($urlInjectionChangeChars) ) foreach( $urlInjectionChangeChars as $key => $val )
    {
        $string = preg_replace(presuffix($key).'xi', $val, $string);
    }

    return $string;

}

//--------------------------------------------------------------------------------------------------
// internalCreateRobotsFile()
//--------------------------------------------------------------------------------------------------
//
// @param void
//
//--------------------------------------------------------------------------------------------------
function internalCreateRobotsFile()
{
    $rules = Config::get('Robots', 'rules');

    $robots = '';

    if( isArray($rules) ) foreach( $rules as $key => $val )
    {
        if( ! is_numeric($key) ) // Single Use
        {
            switch( $key )
            {
                case 'userAgent' :
                    $robots .= ! empty( $val ) ? 'User-agent: '.$val.EOL : '';
                break;

                case 'allow'    :
                case 'disallow' :
                    if( ! empty($val) ) foreach( $val as $v )
                    {
                        $robots .= ucfirst($key).': '.$v.EOL;
                    }
                break;
            }
        }
        else
        {
            if( isArray($val) ) foreach( $val as $r => $v ) // Multi Use
            {
                switch( $r )
                {
                    case 'userAgent' :
                        $robots .= ! empty( $v ) ? 'User-agent: '.$v.EOL : '';
                    break;

                    case 'allow'    :
                    case 'disallow' :
                        if( ! empty($v) ) foreach( $v as $vr )
                        {
                            $robots .= ucfirst($r).': '.$vr.EOL;
                        }
                    break;
                }
            }
        }
    }

    $robotTxt = 'robots.txt';

    // robots.txt dosyası varsa içeriği al yok ise içeriği boş geç
    if( File::exists($robotTxt) )
    {
        $getContents = File::read($robotTxt);
    }
    else
    {
        $getContents = '';
    }
    // robots.txt değişkenin tuttuğu değer ile dosya içeri eşitse tekrar oluşturma
    if( trim($robots) === trim($getContents) )
    {
        return false;
    }

    if( ! File::write($robotTxt, trim($robots)) )
    {
        throw new GeneralException('Error', 'fileNotWrite', $robotTxt);
    }
}

//--------------------------------------------------------------------------------------------------
// internalCreateHtaccessFile()
//--------------------------------------------------------------------------------------------------
//
// @param void
//
//--------------------------------------------------------------------------------------------------
function internalCreateHtaccessFile()
{
    // Cache.php ayar dosyasından ayarlar çekiliyor.
    $htaccessSettings = Config::get('Htaccess');

    $config = $htaccessSettings['cache'];
    $eol    = EOL;
    $tab    = HT;

    //-----------------------GZIP-------------------------------------------------------------
    // mod_gzip = true ayarı yapılmışsa aşağıdaki kodları ekler.
    // Gzip ile ön bellekleme başlatılmış olur.
    if( $config['modGzip']['status'] === true )
    {
        $modGzip = '<ifModule mod_gzip.c>
'.$tab.'mod_gzip_on Yes
'.$tab.'mod_gzip_dechunk Yes
'.$tab.'mod_gzip_item_include file .('.$config['modGzip']['includedFileExtension'].')$
'.$tab.'mod_gzip_item_include handler ^cgi-script$
'.$tab.'mod_gzip_item_include mime ^text/.*
'.$tab.'mod_gzip_item_include mime ^application/x-javascript.*
'.$tab.'mod_gzip_item_exclude mime ^image/.*
'.$tab.'mod_gzip_item_exclude rspheader ^Content-Encoding:.*gzip.*
</ifModule>'.$eol.$eol;
    }
    else
    {
        $modGzip = '';
    }
    //-----------------------GZIP-------------------------------------------------------------

    //-----------------------EXPIRES----------------------------------------------------------
    // mod_expires = true ayarı yapılmışsa aşağıdaki kodları ekler.
    // Tarayıcı ile ön bellekleme başlatılmış olur.
    if( $config['modExpires']['status'] === true )
    {
        $exp = '';
        foreach($config['modExpires']['fileTypeTime'] as $type => $value)
        {
            $exp .= $tab.'ExpiresByType '.$type.' "access plus '.$value.' seconds"'.$eol;
        }

        $modExpires = '<ifModule mod_expires.c>
'.$tab.'ExpiresActive On
'.$tab.'ExpiresDefault "access plus '.$config['modExpires']['defaultTime'].' seconds"
'.rtrim($exp, $eol).'
</ifModule>'.$eol.$eol;
    }
    else
    {
        $modExpires = '';
    }
    //-----------------------EXPIRES----------------------------------------------------------

    //-----------------------HEADERS----------------------------------------------------------
    // mod_headers = true ayarı yapılmışsa aşağıdaki kodları ekler.
    // Header ile ön bellekleme başlatılmış olur.
    if( $config['modHeaders']['status'] === true )
    {
        $fmatch = '';
        foreach( $config['modHeaders']['fileExtensionTimeAccess'] as $type => $value )
        {
            $fmatch .= $tab.'<filesMatch "\.('.$type.')$">
'.$tab.$tab.'Header set Cache-Control "max-age='.$value['time'].', '.$value['access'].'"
'.$tab.'</filesMatch>'.$eol;
        }

        $modHeaders = '<ifModule mod_headers.c>
'.rtrim($fmatch, $eol).'
</ifModule>
'.$eol;
    }
    else
    {
        $modHeaders = '';
    }
    //-----------------------HEADERS----------------------------------------------------------

    //-----------------------HEADER SET-------------------------------------------------------

    if( $htaccessSettings['headers']['status'] === true )
    {
        $headersIniSet  = "<ifModule mod_expires.c>".$eol;

        foreach( $htaccessSettings['headers']['settings'] as $val )
        {
            $headersIniSet .= $tab."$val".$eol;
        }

        $headersIniSet .= "</ifModule>".$eol.$eol;
    }
    else
    {
        $headersIniSet = '';
    }
    //-----------------------HEADER SET-------------------------------------------------------

    //-----------------------HTACCESS SET-----------------------------------------------------

    if( ! empty($htaccessSettings['settings']) )
    {
        $htaccessSettingsStr = '';

        foreach( $htaccessSettings['settings'] as $key => $val )
        {
            if( ! is_numeric($key) )
            {
                if( is_array($val) )
                {
                    $htaccessSettingsStr .= "<$key>".$eol;

                    foreach( $val as $k => $v)
                    {
                        if( ! is_numeric($k) )
                        {
                            $htaccessSettingsStr .= $tab."$k $v".$eol;
                        }
                        else
                        {
                            $htaccessSettingsStr .= $tab.$v.$eol;
                        }
                    }

                    $keyex = explode(" ", $key);
                    $htaccessSettingsStr .= "</$keyex[0]>".$eol.$eol;
                }
                else
                {
                    $htaccessSettingsStr .= "$key $val".$eol;
                }
            }
            else
            {
                $htaccessSettingsStr .= $val.$eol;
            }
        }
    }
    else
    {
        $htaccessSettingsStr = '';
    }
    //-----------------------HTACCESS SET-----------------------------------------------------

    // Htaccess dosyasına eklenecek veriler birleştiriliyor...

    $htaccess  = '#----------------------------------------------------------------------------------------------------'.$eol;
    $htaccess .= '# This file automatically created and updated'.$eol;
    $htaccess .= '#----------------------------------------------------------------------------------------------------'.$eol.$eol;
    $htaccess .= $modGzip.$modExpires.$modHeaders.$headersIniSet.$htaccessSettingsStr;

    //-----------------------URI ZERONEED PHP----------------------------------------------------
    if( ! $htaccessSettings['uri']['directoryIndex'] )
    {
        $indexSuffix = $htaccessSettings['uri']['indexSuffix'];
        $flag        = ! empty($indexSuffix) ? 'QSA' : 'L';

        $htaccess .= "<IfModule mod_rewrite.c>".$eol;
        $htaccess .= $tab."RewriteEngine On".$eol;
        $htaccess .= $tab."RewriteBase /".$eol;
        $htaccess .= $tab."RewriteCond %{REQUEST_FILENAME} !-f".$eol;
        $htaccess .= $tab."RewriteCond %{REQUEST_FILENAME} !-d".$eol;
        $htaccess .= $tab.'RewriteRule ^(.*)$  '.$_SERVER['SCRIPT_NAME'].$indexSuffix.'/$1 ['.$flag.']'.$eol;
        $htaccess .= "</IfModule>".$eol.$eol;
    }
    //-----------------------URI ZERONEED PHP----------------------------------------------------

    //-----------------------ERROR REQUEST----------------------------------------------------
    $htaccess .= 'ErrorDocument 403 '.BASE_DIR.DIRECTORY_INDEX.$eol.$eol;
    //-----------------------ERROR REQUEST----------------------------------------------------

    //-----------------------DIRECTORY INDEX--------------------------------------------------
    $htaccess .= 'DirectoryIndex '.DIRECTORY_INDEX.$eol.$eol;
    //-----------------------DIRECTORY INDEX--------------------------------------------------

    if( ! empty($uploadSet['status']) )
    {
        $uploadSettings = $htaccessSettings['upload'];
    }
    else
    {
        $uploadSettings = [];
    }
    //-----------------------UPLOAD SETTINGS--------------------------------------------------

    //-----------------------SESSION SETTINGS-------------------------------------------------

    if( ! empty($htaccessSettings['session']['status']) )
    {
        $sessionSettings = $htaccessSettings['session']['settings'];
    }
    else
    {
        $sessionSettings = [];
    }
    //-----------------------SESSION SETTINGS-------------------------------------------------

    //-----------------------INI SETTINGS-----------------------------------------------------
    if( $htaccessSettings['ini']['status'] === true )
    {
        $iniSettings = $htaccessSettings['ini']['settings'];
    }
    else
    {
        $iniSettings = [];
    }
    //-----------------------INI SETTINGS-----------------------------------------------------

    // Ayarlar birleştiriliyor.
    $allSettings = array_merge($iniSettings, $uploadSettings, $sessionSettings);

    if( ! empty($allSettings) )
    {
        $sets = '';

        foreach( $allSettings as $k => $v )
        {
            if( $v !== '' )
            {
                $sets .= $tab."php_value $k $v".$eol;
            }
        }

        if( ! empty($sets) )
        {
            $htaccess .= $eol."<IfModule mod_php5.c>".$eol;
            $htaccess .= $sets;
            $htaccess .= "</IfModule>";
        }
    }

    $htaccessTxt = '.htaccess';

    if( File::exists($htaccessTxt) )
    {
        $getContents = trim(File::read($htaccessTxt));
    }
    else
    {
        $getContents = '';
    }

    $htaccess .= '#----------------------------------------------------------------------------------------------------';
    $htaccess  = trim($htaccess);

    if( $htaccess === $getContents )
    {
        return false;
    }

    if( ! File::write($htaccessTxt, trim($htaccess)) )
    {
        throw new GeneralException('Error', 'fileNotWrite', $htaccessTxt);
    }
}

//--------------------------------------------------------------------------------------------------
// internalStartingContoller()
//--------------------------------------------------------------------------------------------------
//
// @param string $startController
// @param array  $param
//
//--------------------------------------------------------------------------------------------------
function internalStartingContoller(String $startController = '', Array $param = [])
{
    $controllerEx = explode(':', $startController);

    $controllerPath  = ! empty($controllerEx[0]) ? $controllerEx[0] : '';
    $controllerFunc  = ! empty($controllerEx[1]) ? $controllerEx[1] : 'main';
    $controllerFile  = CONTROLLERS_DIR.suffix($controllerPath, '.php');
    $controllerClass = divide($controllerPath, '/', -1);

    if( ! class_exists($controllerClass, false) )
    {
        $controllerClass = PROJECT_CONTROLLER_NAMESPACE . $controllerClass;
    }

    if( is_file($controllerFile) )
    {
        import($controllerFile);

        if( ! is_callable([$controllerClass, $controllerFunc]) )
        {
            report('Error', lang('Error', 'callUserFuncArrayError', $controllerFunc), 'SystemCallUserFuncArrayError');

            die(Errors::message('Error', 'callUserFuncArrayError', $controllerFunc));
        }

        return uselib($controllerClass)->$controllerFunc(...$param);
    }
    else
    {
        report('Error', lang('Error', 'notIsFileError', $controllerFile), 'SystemNotIsFileError');

        die(Errors::message('Error', 'notIsFileError', $controllerFile));
    }
}

//--------------------------------------------------------------------------------------------------
// internalBenchmarkReport()
//--------------------------------------------------------------------------------------------------
//
// @param void
//
//--------------------------------------------------------------------------------------------------
function internalBenchmarkReport($start, $finish)
{
    if( Config::get('Project', 'benchmark') === true && REQUEST_URI !== NULL )
    {
        //----------------------------------------------------------------------------------------------
        // System Elapsed Time Calculating
        //----------------------------------------------------------------------------------------------
        $elapsedTime = $finish - $start;
        //----------------------------------------------------------------------------------------------

        //----------------------------------------------------------------------------------------------
        // Get Memory Usage
        //----------------------------------------------------------------------------------------------
        $memoryUsage = memory_get_usage();
        //----------------------------------------------------------------------------------------------

        //----------------------------------------------------------------------------------------------
        // Get Maximum Memory Usage
        //----------------------------------------------------------------------------------------------
        $maxMemoryUsage = memory_get_peak_usage();
        //----------------------------------------------------------------------------------------------

        //----------------------------------------------------------------------------------------------
        // Template Benchmark Performance Result Table
        //----------------------------------------------------------------------------------------------
        $benchmarkData =
        [
            'elapsedTime'    => $elapsedTime,
            'memoryUsage'    => $memoryUsage,
            'maxMemoryUsage' => $maxMemoryUsage
        ];

        $benchResult = Import::template('BenchmarkTable', $benchmarkData, true);
        //----------------------------------------------------------------------------------------------

        //----------------------------------------------------------------------------------------------
        // Get Benchmark Performance Result Table
        //----------------------------------------------------------------------------------------------
        echo $benchResult;

        report('Benchmarking Test Result', $benchResult, 'BenchmarkTestResults');
        //----------------------------------------------------------------------------------------------
    }
}
