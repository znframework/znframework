<?php namespace ZN\Core;
/**
 * ZN PHP Web Framework
 * 
 * "Simplicity is the ultimate sophistication." ~ Da Vinci
 * 
 * @package ZN
 * @license MIT [http://opensource.org/licenses/MIT]
 * @author  Ozan UYKUN [ozan@znframework.com]
 */

use Config;
use ZN\IndividualStructures\IS;

class Htaccess
{
    /**
     * Keep htaccess config
     * 
     * @var array
     */
    protected static $config;

    /**
     * Cache Settings
     * 
     * @param string &$htaccess
     * 
     * @return void
     */
    protected static function cache(&$htaccess)
    {
        # GZIP
        # If mod_gzip = true is set, it adds the following codes.
        # GZIP starts caching.
        self::modGzip($htaccess);

        # Expires
        # If mod_expires = true is set, it adds the following codes.
        # Crawler cache is initialized.
        self::modExpires($htaccess);

        # Headers
        # If mod_headers = true is set, it adds the following codes.
        # Caching with header is started.
        self::modHeaders($htaccess);
    }

    /**
     * Gzip status
     * 
     * @param string &$htaccess
     * 
     * @return void
     */
    protected static function modGzip(&$htaccess)
    {
        $modGzip = self::$config['cache']['modGzip'];
        
        if( $modGzip['status'] === true )
        {
            $htaccess .= '<ifModule mod_gzip.c>' . EOL;
            $htaccess .= HT.'mod_gzip_on Yes' . EOL;
            $htaccess .= HT.'mod_gzip_dechunk Yes' . EOL;
            $htaccess .= HT.'mod_gzip_item_include file .('.$modGzip['includedFileExtension'].')$' . EOL;
            $htaccess .= HT.'mod_gzip_item_include handler ^cgi-script$' . EOL;
            $htaccess .= HT.'mod_gzip_item_include mime ^text/.*' . EOL;
            $htaccess .= HT.'mod_gzip_item_include mime ^application/x-javascript.*' . EOL;
            $htaccess .= HT.'mod_gzip_item_exclude mime ^image/.*' . EOL;
            $htaccess .= HT.'mod_gzip_item_exclude rspheader ^Content-Encoding:.*gzip.*' . EOL;
            $htaccess .= '</ifModule>' . EOL . EOL;
        }
    }

    /**
     * Expires status
     * 
     * @param string &$htaccess
     * 
     * @return void
     */
    protected static function modExpires(&$htaccess)
    {
        $modExpires = self::$config['cache']['modExpires'];

        if( $modExpires['status'] === true )
        {
            $exp = NULL;
            $settings = $modExpires['fileTypeTime'];

            foreach( $settings as $type => $value )
            {
                $exp .= HT.'ExpiresByType '.$type.' "access plus '.$value.' seconds"'.EOL;
            }

            $htaccess .= '<ifModule mod_expires.c>' . EOL;
            $htaccess .= HT.'ExpiresActive On' . EOL;
            $htaccess .= HT.'ExpiresDefault "access plus '.$modExpires['defaultTime'].' seconds"' . EOL;
            $htaccess .= rtrim($exp, EOL) . EOL;
            $htaccess .= '</ifModule>' . EOL . EOL;
        }
    }

    /**
     * Headers status
     * 
     * @param string &$htaccess
     * 
     * @return void
     */
    protected static function modHeaders(&$htaccess)
    {
        $modHeaders = self::$config['cache']['modHeaders'];
        
        if( $modHeaders['status'] === true )
        {
            $fmatch = NULL;
            $fileExtensionTimeAccess = $modHeaders['fileExtensionTimeAccess'];

            foreach( $fileExtensionTimeAccess as $type => $value )
            {
                $fmatch .= HT.'<filesMatch "\.('.$type.')$">' . EOL;
                $fmatch .= HT.HT.'Header set Cache-Control "max-age='.$value['time'].', '.$value['access'].'"' . EOL;
                $fmatch .= HT.'</filesMatch>'.EOL;
            }

            $htaccess .= '<ifModule mod_headers.c>' . EOL;
            $htaccess .= rtrim($fmatch, EOL) . EOL;
            $htaccess .= '</ifModule>' . EOL . EOL;
        }
    }

    /**
     * Initial Headers status
     * 
     * @param string &$htaccess
     * 
     * @return void
     */
    protected static function headers(&$htaccess)
    {
        $settings  = self::$config['headers'];
        $htaccess .= "<ifModule mod_expires.c>".EOL;

        foreach( $settings as $val )
        {
            if( ! empty($val) )
            {
                $htaccess .= HT."$val".EOL;
            }       
        }

        $htaccess .= "</ifModule>".EOL.EOL;
    }

    /**
     * Settings
     * 
     * @param string &$htaccess
     * 
     * @return void
     */
    protected static function settings(&$htaccess)
    {
        $settings = self::$config['settings'];

        if( ! empty($settings) )
        {
            foreach( $settings as $key => $val )
            {
                if( ! is_numeric($key) )
                {
                    if( is_array($val) )
                    {
                        $htaccess .= "<$key>".EOL;

                        foreach( $val as $k => $v)
                        {
                            if( ! is_numeric($k) )
                            {
                                $htaccess .= HT."$k $v".EOL;
                            }
                            else
                            {
                                $htaccess .= HT.$v.EOL;
                            }
                        }

                        $keyex = explode(" ", $key);
                        $htaccess .= "</$keyex[0]>".EOL.EOL;
                    }
                    else
                    {
                        $htaccess .= "$key $val".EOL;
                    }
                }
                else
                {
                    $htaccess .= $val.EOL;
                }
            }
        }
    }

    /**
     * Get base content
     * 
     * @param string &$htaccess
     * 
     * @return void
     */
    protected static function baseContent(&$htaccess)
    {
        if( ! server('pathInfo') )
        {
            $indexSuffix = '?';  $flag = 'QSA';
        }
        else
        {
            $indexSuffix = NULL; $flag = 'L';
        }

        $htaccess .= "<IfModule mod_rewrite.c>".EOL;
        $htaccess .= HT."RewriteEngine On".EOL;
        $htaccess .= HT."RewriteBase /".EOL;
        $htaccess .= HT."RewriteCond %{REQUEST_FILENAME} !-f".EOL;
        $htaccess .= HT."RewriteCond %{REQUEST_FILENAME} !-d".EOL;
        $htaccess .= HT.'RewriteRule ^(.*)$  '.($_SERVER['SCRIPT_NAME'] ?? NULL).$indexSuffix.'/$1 ['.$flag.']'.EOL;
        $htaccess .= "</IfModule>".EOL.EOL;
        $htaccess .= 'ErrorDocument 403 /'.BASE_DIR.DIRECTORY_INDEX.EOL.EOL;
        $htaccess .= 'DirectoryIndex '.DIRECTORY_INDEX.EOL;
    }

    /**
     * Initial Settings
     * 
     * @param string &$htaccess
     * 
     * @return void
     */
    protected static function ini(&$htaccess)
    {
        $status = self::$config['ini']['status'];
        
        if( $status === false )
        {
            return false;
        }
        
        $settings = Config::ini();

        if( ! empty($settings) )
        {
            $sets = NULL;

            foreach( $settings as $k => $v )
            {
                if( $v !== '' && ! empty($k) )
                {
                    $sets .= HT."php_value $k $v".EOL;
                }
            }

            if( ! empty($sets) )
            {
                $htaccess .= EOL . "<IfModule mod_php5.c>" . EOL;
                $htaccess .= $sets;
                $htaccess .= "</IfModule>" . EOL;
            }
        }
    }

    /**
     * Creates htaccess file.
     * 
     * @param array $config = NULL
     * 
     * @return void
     */
    public static function create($config = NULL)
    {
        if( IS::software() !== 'apache' )
        {
            return false;
        }
        
        self::$config = $config ?? Config::get('Htaccess');

        $htaccess  = '#----------------------------------------------------------------------'.EOL;
        $htaccess .= '# This file automatically created and updated'.EOL;
        $htaccess .= '#----------------------------------------------------------------------'.EOL.EOL;

        # Initial Cache
        self::cache($htaccess);
      
        # Initial Headers
        self::headers($htaccess);
        
        # Settings
        self::settings($htaccess);
     
        # Base Content
        self::baseContent($htaccess);

        # Initial Settings
        self::ini($htaccess);

        $file = '.htaccess';

        if( is_file($file) )
        {
            $getContents = trim(file_get_contents($file));
        }
        else
        {
            $getContents = '';
        }

        $htaccess .= EOL . '#----------------------------------------------------------------------';
        $htaccess  = trim($htaccess);

        if( $htaccess === $getContents )
        {
            return false;
        }

        if( ! file_put_contents($file, trim($htaccess)) )
        {
            throw new \GeneralException('Error', 'fileNotWrite', $file);
        }
    }
}
