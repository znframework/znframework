<?php
//--------------------------------------------------------------------------------------------------
// Low Level
//--------------------------------------------------------------------------------------------------
//
// Author     : Ozan UYKUN <ozanbote@windowslive.com> | <ozanbote@gmail.com>
// Site       : www.znframework.com
// License    : The MIT License
// Copyright  : Copyright (c) 2012-2016, ZN Framework
//
//--------------------------------------------------------------------------------------------------

//--------------------------------------------------------------------------------------------------
// Get Aliases Name
//--------------------------------------------------------------------------------------------------
$autoloaderAliases = Config::get('Autoloader')['aliases'];
//--------------------------------------------------------------------------------------------------

//--------------------------------------------------------------------------------------------------
// Set Aliases Name
//--------------------------------------------------------------------------------------------------
if( ! empty($autoloaderAliases) ) foreach( $autoloaderAliases as $alias => $origin )
{
    class_alias($origin, $alias);
}
//--------------------------------------------------------------------------------------------------

//--------------------------------------------------------------------------------------------------
// CSRFInput
//--------------------------------------------------------------------------------------------------
//
// @param string data
//
// @return int
//
//--------------------------------------------------------------------------------------------------
function CSRFInput()
{
    Session::insert('token', Encode::create(32));

    return Form::hidden('token', Session::select('token'));
}

//--------------------------------------------------------------------------------------------------
// Length
//--------------------------------------------------------------------------------------------------
//
// @param string data
//
// @return int
//
//--------------------------------------------------------------------------------------------------
function length($data) : Int
{
    return ! is_scalar($data)
           ? count((array) $data)
           : strlen($data);
}

//--------------------------------------------------------------------------------------------------
// Illustrate
//--------------------------------------------------------------------------------------------------
//
// @param string $const
// @param  mixed $value
// @return mixed
//
//--------------------------------------------------------------------------------------------------
function illustrate(String $const, $value = '')
{
    if( ! defined($const) )
    {
        define($const, $value);
    }
    else
    {
        if( $value !== '' )
        {
            return $value;
        }
    }

    return constant($const);
}

//--------------------------------------------------------------------------------------------------
// Symbol
//--------------------------------------------------------------------------------------------------
//
// @param string $symbolName
//
// @return string
//
//--------------------------------------------------------------------------------------------------
function symbol(String $symbolName = 'turkishLira') : String
{
    return Config::get('Symbols', $symbolName);
}

//--------------------------------------------------------------------------------------------------
// getErrorMessage()
//--------------------------------------------------------------------------------------------------
//
// @param string $langFile
// @param string $errorMsg
// @param mixed  $ex
//
// @return string
//
//--------------------------------------------------------------------------------------------------
function getErrorMessage(String $langFile, String $errorMsg = NULL, $ex = NULL) : String
{
    $style  = 'border:solid 1px #E1E4E5;';
    $style .= 'background:#FEFEFE;';
    $style .= 'padding:10px;';
    $style .= 'margin-bottom:10px;';
    $style .= 'font-family:Calibri, Ebrima, Century Gothic, Consolas, Courier New, Courier, monospace, Tahoma, Arial;';
    $style .= 'color:#666;';
    $style .= 'text-align:left;';
    $style .= 'font-size:14px;';

    $exStyle = 'color:#900;';

    if( ! is_array($ex) )
    {
        $ex = '<span style="'.$exStyle .'">'.$ex.'</span>';
    }
    else
    {
        $newArray = [];

        if( ! empty($ex) ) foreach( $ex as $k => $v )
        {
            $newArray[$k] = $v;
        }

        $ex = $newArray;
    }

    $str  = "<div style=\"$style\">";

    if( ! empty($errorMsg) )
    {
        $str .= lang($langFile, $errorMsg, $ex);
    }
    else
    {
        $str .= $langFile;
    }

    $str .= '</div><br>';

    return $str;
}

//--------------------------------------------------------------------------------------------------
// report()
//--------------------------------------------------------------------------------------------------
//
// @param string $subject
// @param string $message
// @param string $destination
// @param string $time
//
// @return bool
//
//--------------------------------------------------------------------------------------------------
function report(String $subject, String $message, String $destination = NULL, String $time = NULL) : Bool
{
    if( ! Config::get('General', 'log')['createFile'] )
    {
        return false;
    }

    if( empty($destination) )
    {
        $destination = str_replace(' ', '-', $subject);
    }

    $logDir    = STORAGE_DIR.'Logs/';
    $extension = '.log';

    if( ! is_dir($logDir) )
    {
        Folder::create($logDir, 0755);
    }

    if( is_file($logDir.suffix($destination, $extension)) )
    {
        if( empty($time) )
        {
            $time = Config::get('General', 'log')['fileTime'];
        }

        $createDate = File::createDate($logDir.suffix($destination, $extension), 'd.m.Y');
        $endDate    = strtotime("$time", strtotime($createDate));
        $endDate    = date('Y.m.d', $endDate);

        if( date('Y.m.d')  >  $endDate )
        {
            File::delete($logDir.suffix($destination, $extension));
        }
    }

    $message = 'IP: ' . ipv4().
               ' | Subject: ' . $subject.
               ' | Date: '.Date::set('{dayNumber0}.{monthNumber0}.{year} {H024}:{minute}:{second}').
               ' | Message: ' . $message . EOL;

    return error_log($message, 3, $logDir.suffix($destination, $extension));
}

//--------------------------------------------------------------------------------------------------
// headers()
//--------------------------------------------------------------------------------------------------
//
// @param mixed $header
//
//--------------------------------------------------------------------------------------------------
function headers($header)
{
    if( empty($header) )
    {
        return false;
    }

    if( ! is_array($header) )
    {
         header($header);
    }
    else
    {
        if( ! empty($header) ) foreach( $header as $k => $v )
        {
            header($v);
        }
    }
}

//--------------------------------------------------------------------------------------------------
// requestURI()
//--------------------------------------------------------------------------------------------------
//
// @param void
//
// @return string
//
//--------------------------------------------------------------------------------------------------
function requestURI() : String
{
    return (string) internalRequestURI();
}

//--------------------------------------------------------------------------------------------------
// currentUri()
//--------------------------------------------------------------------------------------------------
//
// @param bool $fullPath = false
//
// @return string
//
//--------------------------------------------------------------------------------------------------
function currentUri(Bool $fullPath = false) : String
{
    $requestUri = server('requestUri');
    $currentUri = BASE_DIR !== '/'
                ? str_replace(BASE_DIR, '', $requestUri)
                : substr($requestUri, 1);

    if( $fullPath === false )
    {
        $currentUri = internalCleanURIPrefix($currentUri, indexStatus());

        if( suffix($currentUri) === internalGetCurrentProject() )
        {
            return Config::get('Services', 'route')['openController'];
        }

        $currentUri = internalCleanURIPrefix($currentUri, internalGetCurrentProject());
        $currentUri = internalCleanURIPrefix($currentUri, currentLang());
    }

    return $currentUri;
}

//--------------------------------------------------------------------------------------------------
// Configs
//--------------------------------------------------------------------------------------------------
//
// @param array variadic $configs
//
// @return mixed
//
//--------------------------------------------------------------------------------------------------
function configs(...$configs) : Array
{
    $allConfig = [];

    foreach( $configs as $config )
    {
        if( is_array($config) )
        {
            $allConfig = array_merge($allConfig, config(key($config), current($config)));
        }
        else
        {
            $allConfig = array_merge($allConfig, config($config));
        }
    }

    return $allConfig;
}

//--------------------------------------------------------------------------------------------------
// Config
//--------------------------------------------------------------------------------------------------
//
// @param string $file
// @param string $value
// @param mixed  $newValue
//
// @return mixed
//
//--------------------------------------------------------------------------------------------------
function config(String $file, String $value = NULL, $newValue = NULL)
{
    if( $newValue === NULL )
    {
        return Config::get($file, $value);
    }
    else
    {
        $default = Config::get($file, $value);

        Config::set($file, $value, $newValue);

        if( is_array($newValue) )
        {
            $config = Config::get($file, $value);
        }
        else
        {
            $config = Config::get($file);
        }

        Config::set($file, $value, $default);

        return $config;
    }
}

//--------------------------------------------------------------------------------------------------
// Gconfig
//--------------------------------------------------------------------------------------------------
//
// @param string $value
//
// @return mixed
//
//--------------------------------------------------------------------------------------------------
function gconfig(String $value = NULL)
{
    global $gconfig;

    if( empty($gconfig) )
    {
        $configs = array_merge
        (
            Folder::files(EXTERNAL_CONFIG_DIR, 'php'),
            Folder::files(CONFIG_DIR, 'php'),
            Folder::files(INTERNAL_CONFIG_DIR, 'php')
        );

        $gconfig = [];

        foreach( $configs as $file )
        {
            $file    = removeExtension($file);
            $gconfig = array_merge($gconfig, (array) Config::get($file));
        }
    }

    if( $value === NULL )
    {
        return $gconfig;
    }

    return $gconfig[$value] ?? false;
}

//--------------------------------------------------------------------------------------------------
// getLang()
//--------------------------------------------------------------------------------------------------
//
// @param void
//
// @return string
//
//--------------------------------------------------------------------------------------------------
function getLang() : String
{
    $systemLanguageData        = internalDefaultProjectKey('SystemLanguageData');
    $defaultSystemLanguageData = internalDefaultProjectKey('DefaultSystemLanguageData');

    $default = Config::get('Language', 'default');

    if( ! Session::select($defaultSystemLanguageData) )
    {
        Session::insert($defaultSystemLanguageData, $default);
    }
    else
    {
        if( Session::select($defaultSystemLanguageData) !== $default )
        {
            Session::insert($defaultSystemLanguageData, $default);
            Session::insert($systemLanguageData, $default);

            return $default;
        }
    }

    if( Session::select($systemLanguageData) === false )
    {
        Session::insert($systemLanguageData, $default);

        return $default;
    }
    else
    {
        return Session::select($systemLanguageData);
    }
}

//--------------------------------------------------------------------------------------------------
// setLang()
//--------------------------------------------------------------------------------------------------
//
// @param string $l
//
// @return bool
//
//--------------------------------------------------------------------------------------------------
function setLang(String $l = NULL) : Bool
{
    if( empty($l) )
    {
        $l = Config::get('Language', 'default');
    }

    return Session::insert(internalDefaultProjectKey('SystemLanguageData'), $l);
}

//--------------------------------------------------------------------------------------------------
// lang()
//--------------------------------------------------------------------------------------------------
//
// @param string $file
// @param string $str
// @param mixed  $changed
//
// @return mixed
//
//--------------------------------------------------------------------------------------------------
function lang(String $file = NULL, String $str = NULL, $changed = NULL)
{
    global $lang;

    $file          = ( Config::get('Language', 'shortCodes')[getLang()] ?? 'English').'/'.suffix($file, '.php');
    $langDir       = LANGUAGES_DIR.$file;
    $sysLangDir    = INTERNAL_LANGUAGES_DIR.$file;
    $commonLangDir = EXTERNAL_LANGUAGES_DIR.$file;

    if( is_file($langDir) && ! isImport($langDir) )
    {
        $lang[$file] = import($langDir);
    }
    elseif( is_file($sysLangDir) && ! isImport($sysLangDir) )
    {
        $lang[$file] = import($sysLangDir);
    }
    elseif( is_file($commonLangDir) && ! isImport($commonLangDir) )
    {
        $lang[$file] = import($commonLangDir);
    }

    if( empty($str) && isset($lang[$file]) )
    {
        return $lang[$file];
    }
    elseif( ! empty($lang[$file][$str]) )
    {
        $langstr = $lang[$file][$str];
    }
    else
    {
        return false;
    }

    if( ! is_array($changed) )
    {
        if( strstr($langstr, "%") && ! empty($changed) )
        {
            return str_replace("%", $changed , $langstr);
        }
        else
        {
            return $langstr;
        }
    }
    else
    {
        if( ! empty($changed) )
        {
            $values = [];

            foreach( $changed as $key => $value )
            {
                $keys[]   = $key;
                $values[] = $value;
            }

            return str_replace($keys, $values, $langstr);
        }
        else
        {
            return $langstr;
        }
    }
}

//--------------------------------------------------------------------------------------------------
// currentLang()
//--------------------------------------------------------------------------------------------------
//
// @param void
//
// @return string
//
//--------------------------------------------------------------------------------------------------
function currentLang() : String
{
    if( ! Config::get('Services','uri')['lang'] )
    {
        return false;
    }
    else
    {
        return getLang();
    }
}

//--------------------------------------------------------------------------------------------------
// currentUrl()
//--------------------------------------------------------------------------------------------------
//
// @param string $fix
//
// @return string
//
//--------------------------------------------------------------------------------------------------
function currentUrl(String $fix = NULL) : String
{
    $currentUrl = hostUrl(server('requestUri'));

    if( ! empty($fix) )
    {
        return suffix(rtrim($currentUrl, $fix)) . $fix;
    }

    return $currentUrl;
}

//--------------------------------------------------------------------------------------------------
// siteUrl()
//--------------------------------------------------------------------------------------------------
//
// @param string $uri
// @param int    $index
//
// @return string
//
//--------------------------------------------------------------------------------------------------
function siteUrl(String $uri = NULL, Int $index = 0) : String
{
    return hostUrl
    (
           internalBaseDir($index).
           indexStatus().
           internalGetCurrentProject().
           suffix(currentLang()).
           $uri
     );
}

//--------------------------------------------------------------------------------------------------
// siteUrls() - v.4.2.6
//--------------------------------------------------------------------------------------------------
//
// @param string $uri
// @param int    $index
//
// @return string
//
//--------------------------------------------------------------------------------------------------
function siteUrls(String $uri = NULL, Int $index = 0) : String
{
    return str_replace(sslStatus(), httpFix(true), siteUrl($uri, $index));
}

//--------------------------------------------------------------------------------------------------
// baseUrl()
//--------------------------------------------------------------------------------------------------
//
// @param string $uri
// @param int    $index
//
// @return string
//
//--------------------------------------------------------------------------------------------------
function baseUrl(String $uri = NULL, Int $index = 0) : String
{
    return hostUrl(internalBaseDir($index) . absoluteRelativePath($uri));
}

//--------------------------------------------------------------------------------------------------
// prevUrl()
//--------------------------------------------------------------------------------------------------
//
// @param void
//
// @return string
//
//--------------------------------------------------------------------------------------------------
function prevUrl() : String
{
    return  $_SERVER['HTTP_REFERER'] ?? '';
}

//--------------------------------------------------------------------------------------------------
// hostUrl()
//--------------------------------------------------------------------------------------------------
//
// @param string $uri
//
// @return string
//
//--------------------------------------------------------------------------------------------------
function hostUrl(String $uri = NULL) : String
{
    return sslStatus() . host() . ($uri === '' ? '/' : prefix(internalCleanInjection($uri)));
}

//--------------------------------------------------------------------------------------------------
// currentPath()
//--------------------------------------------------------------------------------------------------
//
// @param bool $isPath
//
// @return string
//
//--------------------------------------------------------------------------------------------------
function currentPath(Bool $isPath = true) : String
{
    $currentPagePath = str_replace(getLang().'/', '', server('currentPath'));

    if( isset($currentPagePath[0]) && $currentPagePath[0] === '/' )
    {
        $currentPagePath = substr($currentPagePath, 1, strlen($currentPagePath) - 1);
    }

    if( $isPath === true )
    {
        return $currentPagePath;
    }
    else
    {
        $str = explode('/', $currentPagePath);

        if( count($str) > 1 )
        {
            return $str[count($str) - 1];
        }

        return $str[0];
    }
}

//--------------------------------------------------------------------------------------------------
// basePath()
//--------------------------------------------------------------------------------------------------
//
// @param string $uri
// @param int    $index
//
// @return string
//
//--------------------------------------------------------------------------------------------------
function basePath(String $uri = NULL, Int $index = 0) : String
{
    $newBaseDir = substr(BASE_DIR, 1);

    if( BASE_DIR !== '/' )
    {
        if( $index < 0 )
        {
            $baseDir    = substr(BASE_DIR, 1, -1);
            $baseDir    = explode('/', $baseDir);
            $newBaseDir = '';

            for( $i = 0; $i < count($baseDir) + $index; $i++ )
            {
                $newBaseDir .= suffix($baseDir[$i]);
            }
        }
    }

    return internalCleanInjection($newBaseDir . $uri);
}

//--------------------------------------------------------------------------------------------------
// prevPath()
//--------------------------------------------------------------------------------------------------
//
// @param bool $isPath
//
// @return string
//
//--------------------------------------------------------------------------------------------------
function prevPath(Bool $isPath = true) : String
{
    if( ! isset($_SERVER['HTTP_REFERER']) )
    {
        return false;
    }

    $str = str_replace(siteUrl(), '', $_SERVER['HTTP_REFERER']);

    if( $isPath === true )
    {
        return $str;
    }
    else
    {
        return divide($str, '/', -1);
    }
}

//--------------------------------------------------------------------------------------------------
// filePath()
//--------------------------------------------------------------------------------------------------
//
// @param string $file
// @param string $removeurl
//
// @return string
//
//--------------------------------------------------------------------------------------------------
function filePath(String $file = NULL, String $removeUrl = NULL) : String
{
    if( isUrl($file) )
    {
        if( ! isUrl($removeUrl) )
        {
            $removeUrl = baseUrl();
        }

        $file = trim(str_replace($removeUrl, '', $file));
    }

    return $file;
}

//--------------------------------------------------------------------------------------------------
// redirect()
//--------------------------------------------------------------------------------------------------
//
// @param string $url
// @param int    $time
// @param array  $data
// @param bool   $exit
//
//--------------------------------------------------------------------------------------------------
function redirect(String $url = NULL, Int $time = 0, Array $data = NULL, Bool $exit = true)
{
    if( ! isUrl((string) $url) )
    {
        $url = siteUrl($url);
    }

    if( ! empty($data) )
    {
        foreach( $data as $k => $v )
        {
            Session::insert('redirect:' . $k, $v);
        }
    }

    if( $time > 0 )
    {
        sleep($time);
    }

    header('Location: ' . $url, true);

    if( $exit === true )
    {
        exit;
    }
}

//--------------------------------------------------------------------------------------------------
// redirectData()
//--------------------------------------------------------------------------------------------------
//
// @param string $k
//
// @return mixed
//
//--------------------------------------------------------------------------------------------------
function redirectData(String $k)
{
    if( $data = Session::select('redirect:'.$k) )
    {
        return $data;
    }
    else
    {
        return false;
    }
}

//--------------------------------------------------------------------------------------------------
// redirectDeleteData()
//--------------------------------------------------------------------------------------------------
//
// @param mixed $data
//
// @return bool
//
//--------------------------------------------------------------------------------------------------
function redirectDeleteData($data) : Bool
{
    if( is_array($data) ) foreach( $data as $v )
    {
        Session::delete('redirect:'.$v);
    }
    else
    {
        return Session::delete('redirect:'.$data);
    }

    return true;
}

//--------------------------------------------------------------------------------------------------
// library()
//--------------------------------------------------------------------------------------------------
//
// @param string $class
// @param string $function
// @param mixed  $parameters
//
// @return callable
//
//--------------------------------------------------------------------------------------------------
function library(String $class, String $function, $parameters = [])
{
    $var = uselib($class);

    if( ! is_array($parameters) )
    {
        $parameters = [$parameters];
    }

    if( is_callable([$var, $function]) )
    {
        return call_user_func_array([$var, $function], $parameters);
    }
    else
    {
        return false;
    }
}

//--------------------------------------------------------------------------------------------------
// uselib()
//--------------------------------------------------------------------------------------------------
//
// @param string $class
// @param array  $parameters
//
// @return class
//
//--------------------------------------------------------------------------------------------------
function uselib(String $class, Array $parameters = [])
{
    if( ! class_exists($class) )
    {
        $classInfo = Autoloader::getClassFileInfo($class);

        $class = $classInfo['namespace'];

        if( ! class_exists($class) )
        {
            die(getErrorMessage('Error', 'classError', $class));
        }
    }

    if( ! isset(zn::$use->$class) )
    {
        if( ! is_object(zn::$use) )
        {
            zn::$use = new stdClass();
        }

        zn::$use->$class = new $class(...$parameters);
    }

    return zn::$use->$class;
}

//--------------------------------------------------------------------------------------------------
// httpFix() - ZN >= 4.2.6
//--------------------------------------------------------------------------------------------------
//
// @param bool $security = false
//
// @return string
//
//--------------------------------------------------------------------------------------------------
function httpFix(Bool $security = false) : String
{
    return ( $security === false )
           ? 'http://'
           : 'https://';
}

//--------------------------------------------------------------------------------------------------
// sslStatus()
//--------------------------------------------------------------------------------------------------
//
// @param void
//
// @return string
//
//--------------------------------------------------------------------------------------------------
function sslStatus() : String
{
    return ! Config::get('Services','uri')['ssl']
           ? 'http://'
           : 'https://';
}

//--------------------------------------------------------------------------------------------------
// indexStatus()
//--------------------------------------------------------------------------------------------------
//
// @param void
//
// @return string
//
//--------------------------------------------------------------------------------------------------
function indexStatus() : String
{
    return ! Config::get('Htaccess', 'uri')['directoryIndex']
           ? ''
           : suffix(DIRECTORY_INDEX);
}

//--------------------------------------------------------------------------------------------------
// internalInvalidRequest() - ZN >= 4.3.5
//--------------------------------------------------------------------------------------------------
//
// @param string $type
// @param bool   $bool
//
//--------------------------------------------------------------------------------------------------
function internalInvalidRequest(String $type, Bool $bool)
{
    $invalidRequest = Config::get('Services', 'route')['requestMethods'];

    if( $requestMethods = $invalidRequest[$type] )
    {
        $requestMethods = Arrays::lowerKeys($requestMethods);

        if( ! empty($requestMethod = $requestMethods[CURRENT_CFURI] ?? NULL) )
        {
            if( Http::isRequestMethod(...(array) $requestMethod) === $bool )
            {
                Route::redirectInvalidRequest();
            }
        }
    }
}

//--------------------------------------------------------------------------------------------------
// internalDefaultProjectKey() - ZN >= 4.2.7
//--------------------------------------------------------------------------------------------------
//
// @param void
//
// @return string
//
//--------------------------------------------------------------------------------------------------
function internalDefaultProjectKey(String $fix = NULL) : String
{
    if( defined('_CURRENT_PROJECT') )
    {
        $containers = PROJECTS_CONFIG['containers'];

        if( ! empty($containers[_CURRENT_PROJECT]) )
        {
            return md5(baseUrl(strtolower($containers[_CURRENT_PROJECT])) . $fix);
        }
    }

    return md5(baseUrl(strtolower(CURRENT_PROJECT)) . $fix);
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
    if( isSubdomain() )
    {
        return false;
    }

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
function internalCleanURIPrefix(String $uri = NULL, String $cleanData = NULL) : String
{
    $suffixData = suffix((string) $cleanData);

    if( ! empty($cleanData) && stripos($uri, $suffixData) === 0 )
    {
        $uri = substr($uri, strlen($suffixData));
    }

    return $uri;
}

//--------------------------------------------------------------------------------------------------
// internalRouteAll()
//--------------------------------------------------------------------------------------------------
//
// @param void
//
//--------------------------------------------------------------------------------------------------
function internalRouteAll()
{
    $externalRouteFiles = (array) Folder::files(EXTERNAL_ROUTES_DIR, 'php');
    $routeFiles         = (array) Folder::files(ROUTES_DIR, 'php');
    $files              = array_merge($externalRouteFiles, $routeFiles);

    if( ! empty($files)  )
    {
        foreach( $files as $file )
        {
            import(ROUTES_DIR . $file);
        }

        Route::all();
    }
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
function internalRouteURI(String $requestUri = NULL) : String
{
    internalRouteAll();

    $config = Config::get('Services', 'route');

    if( $config['openController'] )
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
            $requestUri = $config['openController'];
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
function internalCleanInjection(String $string = NULL) : String
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
    $rules  = Config::get('Robots', 'rules');
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
// internalStartingController()
//--------------------------------------------------------------------------------------------------
//
// @param string $startController
// @param array  $param
//
//--------------------------------------------------------------------------------------------------
function internalStartingController(String $startController = NULL, Array $param = [])
{
    $controllerEx = explode(':', $startController);

    $controllerPath  = ! empty($controllerEx[0]) ? $controllerEx[0] : '';
    $controllerFunc  = ! empty($controllerEx[1]) ? $controllerEx[1] : 'main';
    $controllerFile  = CONTROLLERS_DIR . suffix($controllerPath, '.php');
    $controllerClass = divide($controllerPath, '/', -1);

    if( is_file($controllerFile) )
    {
        if( ! class_exists($controllerClass, false) )
        {
            $controllerClass = PROJECT_CONTROLLER_NAMESPACE . $controllerClass;
        }

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
        return false;
    }
}

//--------------------------------------------------------------------------------------------------
// internalStartingConfig()
//--------------------------------------------------------------------------------------------------
//
// @param string $config
//
//--------------------------------------------------------------------------------------------------
function internalStartingConfig($config)
{
    if( $destruct = Config::get('Starting', $config) )
    {
        if( is_string($destruct) )
        {
            internalStartingController($destruct);
        }
        elseif( is_array($destruct) )
        {
            foreach( $destruct as $key => $val )
            {
                if( is_numeric($key) )
                {
                    internalStartingController($val);
                }
                else
                {
                    internalStartingController($key, $val);
                }
            }
        }
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
