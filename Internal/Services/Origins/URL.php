<?php namespace ZN\Services;
/**
 * ZN PHP Web Framework
 * 
 * "Simplicity is the ultimate sophistication." ~ Da Vinci
 * 
 * @package ZN
 * @license MIT [http://opensource.org/licenses/MIT]
 * @author  Ozan UYKUN [ozan@znframework.com]
 */

use ZN\In;
use ZN\Helpers\Converter;
use ZN\IndividualStructures\Lang;

class URL implements URLInterface
{
    //--------------------------------------------------------------------------------------------------------
    // Base
    //--------------------------------------------------------------------------------------------------------
    //
    // @param  string  $uri: empty
    // @param  numeric $index:  0
    // @return string
    //
    //--------------------------------------------------------------------------------------------------------
    public static function base(String $uri = NULL, Int $index = 0) : String
    {
        return self::host(BASE_DIR . $uri);
    }

    //--------------------------------------------------------------------------------------------------------
    // Site
    //--------------------------------------------------------------------------------------------------------
    //
    // @param  string  $uri: empty
    // @param  numeric $index:  0
    // @return string
    //
    //--------------------------------------------------------------------------------------------------------
    public static function site(String $uri = NULL, Int $index = 0) : String
    {
        return self::host
        (
               BASE_DIR.
               In::getCurrentProject().
               suffix(Lang::current()).
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
    public static function sites(String $uri = NULL, Int $index = 0) : String
    {
        return str_replace(SSL_STATUS, \Http::fix(true), self::site($uri, $index));
    }

    //--------------------------------------------------------------------------------------------------------
    // Current
    //--------------------------------------------------------------------------------------------------------
    //
    // @param  string  $fix empty
    // @return string
    //
    //--------------------------------------------------------------------------------------------------------
    public static function current(String $fix = NULL) : String
    {
        $currentUrl = self::host(server('requestUri'));

        if( ! empty($fix) )
        {
            return suffix(rtrim($currentUrl, $fix)) . $fix;
        }

        return $currentUrl;
    }

    //--------------------------------------------------------------------------------------------------------
    // Host
    //--------------------------------------------------------------------------------------------------------
    //
    // @param  string  $uri: empty
    // @return string
    //
    //--------------------------------------------------------------------------------------------------------
    public static function host(String $uri = NULL) : String
    {
        return HOST_URL . In::cleanInjection(ltrim($uri, '/'));
    }

    //--------------------------------------------------------------------------------------------------------
    // Prev
    //--------------------------------------------------------------------------------------------------------
    //
    // @param  void
    // @return string
    //
    //--------------------------------------------------------------------------------------------------------
    public static function prev() : String
    {
        return $_SERVER['HTTP_REFERER'] ?? '';
    }

    //--------------------------------------------------------------------------------------------------------
    // Base 64 Decode
    //--------------------------------------------------------------------------------------------------------
    //
    // @param  string  $data: empty
    // @param  bool    $strict: false
    // @return mixed
    //
    //--------------------------------------------------------------------------------------------------------
    public static function base64Decode(String $data, Bool $strict = false) : String
    {
        return base64_decode($data, $strict);
    }

    //--------------------------------------------------------------------------------------------------------
    // Base 64 Encode
    //--------------------------------------------------------------------------------------------------------
    //
    // @param  string  $data: empty
    // @return mixed
    //
    //--------------------------------------------------------------------------------------------------------
    public static function base64Encode(String $data) : String
    {
        return base64_encode($data);
    }

    //--------------------------------------------------------------------------------------------------------
    // Headers
    //--------------------------------------------------------------------------------------------------------
    //
    // @param  string $url: empty
    // @param  string $format: 0
    // @return mixed
    //
    //--------------------------------------------------------------------------------------------------------
    public static function headers(String $url, Int $format = 0) : Array
    {
        return get_headers($url, $format);
    }

    //--------------------------------------------------------------------------------------------------------
    // Headers
    //--------------------------------------------------------------------------------------------------------
    //
    // @param  string $fileName: empty
    // @param  bool   $useIncludePath: false
    // @return mixed
    //
    //--------------------------------------------------------------------------------------------------------
    public static function metaTags(String $fileName, Bool $useIncludePath = false) : Array
    {
        return get_meta_tags($fileName, $useIncludePath);
    }

    //--------------------------------------------------------------------------------------------------------
    // Build Query
    //--------------------------------------------------------------------------------------------------------
    //
    // @param  mixed  $data         : empty
    // @param  string $numericPrefix: NULL
    // @param  string $separator    : NULL
    // @param  Int    $enctype = self::RFC1738
    // @return mixed
    //
    //--------------------------------------------------------------------------------------------------------
    public static function buildQuery($data, String $numericPrefix = NULL, String $separator = NULL, Int $enctype = PHP_QUERY_RFC1738) : String
    {
        return http_build_query($data, $numericPrefix, $separator ?? '&', $enctype);
    }

    //--------------------------------------------------------------------------------------------------------
    // Parse
    //--------------------------------------------------------------------------------------------------------
    //
    // @param  string  $url      : empty
    // @param  scalar  $component: 1
    // @return mixed
    //
    //--------------------------------------------------------------------------------------------------------
    public static function parse(String $url, $component = 1)
    {
        return parse_url($url, Converter::toConstant($component, 'PHP_URL_'));
    }

    //--------------------------------------------------------------------------------------------------------
    // Raw Decode
    //--------------------------------------------------------------------------------------------------------
    //
    // @param  string  $str: empty
    //
    //--------------------------------------------------------------------------------------------------------
    public static function rawDecode(String $str) : String
    {
        return rawurldecode($str);
    }

    //--------------------------------------------------------------------------------------------------------
    // Raw Encode
    //--------------------------------------------------------------------------------------------------------
    //
    // @param  string  $str: empty
    // @return mixed
    //
    //--------------------------------------------------------------------------------------------------------
    public static function rawEncode(String $str) : String
    {
        return rawurlencode($str);
    }

    //--------------------------------------------------------------------------------------------------------
    // Decode
    //--------------------------------------------------------------------------------------------------------
    //
    // @param  string  $str: empty
    //
    //--------------------------------------------------------------------------------------------------------
    public static function decode(String $str) : String
    {
        return urldecode($str);
    }

    //--------------------------------------------------------------------------------------------------------
    // Encode
    //--------------------------------------------------------------------------------------------------------
    //
    // @param  string  $str: empt
    // @return mixed
    //
    //--------------------------------------------------------------------------------------------------------
    public static function encode(String $str) : String
    {
        return urlencode($str);
    }

    /**
     * URL short path descriptions.
     * 
     * @param void
     * 
     * @return void
     */
    public static function defines()
    {
        define('HOST', host());
        define('HOST_NAME', HOST);
        define('HOST_URL', SSL_STATUS . HOST . '/');
        define('BASE_URL', HOST_URL . BASE_DIR);
        define('SITE_URL', self::site());
        define('CURRENT_URL', rtrim(HOST_URL, '/') . ($_SERVER['REQUEST_URI'] ?? NULL));
        define('PREV_URL', $_SERVER['HTTP_REFERER'] ?? NULL);
        define('BASE_PATH', BASE_DIR);
        define('CURRENT_PATH', URI::current());
        define('PREV_PATH', str_replace(SITE_URL, NULL, PREV_URL));
        define('FILES_URL', BASE_URL . FILES_DIR);
        define('FONTS_URL', BASE_URL . FONTS_DIR);
        define('PLUGINS_URL', BASE_URL . PLUGINS_DIR);
        define('SCRIPTS_URL', BASE_URL . SCRIPTS_DIR);
        define('STYLES_URL', BASE_URL . STYLES_DIR);
        define('THEMES_URL', BASE_URL . THEMES_DIR);
        define('UPLOADS_URL', BASE_URL . UPLOADS_DIR);
        define('RESOURCES_URL', BASE_URL . RESOURCES_DIR);
    }
}
