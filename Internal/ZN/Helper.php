<?php namespace ZN;
/**
 * ZN PHP Web Framework
 * 
 * "Simplicity is the ultimate sophistication." ~ Da Vinci
 * 
 * @package ZN
 * @license MIT [http://opensource.org/licenses/MIT]
 * @author  Ozan UYKUN [ozan@znframework.com]
 */

class Helper
{   
    /**
     * Report log
     * 
     * @param string $subject
     * @param string $message
     * @param string $destination
     * @param string $time
     * 
     * @return bool
     */
    public static function report(String $subject, String $message, String $destination = NULL, String $time = NULL) : Bool
    {
        if( ! Config::get('Project', 'log')['createFile'] )
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
            mkdir($logDir, 0755);
        }

        if( is_file($logDir.Base::suffix($destination, $extension)) )
        {
            if( empty($time) )
            {
                $time = Config::get('Project', 'log')['fileTime'];
            }

            $createDate = date('d.m.Y', filectime($logDir . Base::suffix($destination, $extension)));
            $endDate    = strtotime("$time", strtotime($createDate));
            $endDate    = date('Y.m.d', $endDate);

            if( date('Y.m.d')  >  $endDate )
            {
                unlink($logDir.Base::suffix($destination, $extension));
            }
        }

        $message = 'IP: ' . Request::ipv4().
                   ' | Subject: ' . $subject.
                   ' | Date: '.Singleton::class('ZN\DateTime\Date')->set('{dayNumber0}.{monthNumber0}.{year} {H024}:{minute}:{second}').
                   ' | Message: ' . $message . EOL;

        return error_log($message, 3, $logDir.Base::suffix($destination, $extension));
    }

    /**
     * Convert high lighting
     * 
     * @param string $str
     * @param array  $settings
     * 
     * @return string
     */
    public static function highLight(String $str, Array $settings = []) : String
    {
        $phpFamily      = ! empty( $settings['php:family'] )    ? 'font-family:'.$settings['php:family'] : 'font-family:Consolas, monospace';
        $phpSize        = ! empty( $settings['php:size'] )      ? 'font-size:'.$settings['php:size'] : 'font-size:12px';
        $phpStyle       = ! empty( $settings['php:style'] )     ? $settings['php:style'] : '';
        $htmlFamily     = ! empty( $settings['html:family'] )   ? 'font-family:'.$settings['html:family'] : '';
        $htmlSize       = ! empty( $settings['html:size'] )     ? 'font-size:'.$settings['html:size'] : '';
        $htmlColor      = ! empty( $settings['html:color'] )    ? $settings['html:color'] : '';
        $htmlStyle      = ! empty( $settings['html:style'] )    ? $settings['html:style'] : '';
        $comment        = ! empty( $settings['comment:color'] ) ? $settings['comment:color'] : '#969896';
        $commentStyle   = ! empty( $settings['comment:style'] ) ? $settings['comment:style'] : '';
        $default        = ! empty( $settings['default:color'] ) ? $settings['default:color'] : '#000000';
        $defaultStyle   = ! empty( $settings['default:style'] ) ? $settings['default:style'] : '';
        $keyword        = ! empty( $settings['keyword:color'] ) ? $settings['keyword:color'] : '#a71d5d';
        $keywordStyle   = ! empty( $settings['keyword:style'] ) ? $settings['keyword:style'] : '';
        $string         = ! empty( $settings['string:color'] )  ? $settings['string:color']  : '#183691';
        $stringStyle    = ! empty( $settings['string:style'] )  ? $settings['string:style']  : '';
        $background     = ! empty( $settings['background'] )    ? $settings['background'] : '';
        $tags           = $settings['tags'] ?? true;

        ini_set("highlight.comment", "$comment; $phpFamily; $phpSize; $phpStyle; $commentStyle");
        ini_set("highlight.default", "$default; $phpFamily; $phpSize; $phpStyle; $defaultStyle");
        ini_set("highlight.keyword", "$keyword; $phpFamily; $phpSize; $phpStyle; $keywordStyle ");
        ini_set("highlight.string",  "$string;  $phpFamily; $phpSize; $phpStyle; $stringStyle");
        ini_set("highlight.html",    "$htmlColor; $htmlFamily; $htmlSize; $htmlStyle");
        
        $string = highlight_string($str, true);

        $string = preg_replace
        (
            ['/\&\#60\;script(.*?)\&\#62\;/i', '/\&\#60\;\/script\&\#62\;/i'], 
            ['<script$1>', '</script>'], 
            str_replace
            (
                ['<?', '?>'], 
                ['&#60;&#63;', '&#63;&#62;'], 
                htmlspecialchars_decode(trim($string), ENT_QUOTES)
            )
        );

        $tagArray = $tags === true
                  ? ['<div style="'.$background.'">&#60;&#63;php', '&#63;&#62;</div>']
                  : ['<div style="'.$background.'">', '</div>'];

        return str_replace(['&#60;&#63;php', '&#63;&#62;'], $tagArray, $string);
    }

    /**
     * Convert to constant
     * 
     * @param string $var
     * @param string $prefix = NULL
     * @param string $suffix = NULL
     */
    public static function toConstant(String $var, String $prefix = NULL, String $suffix = NULL)
    {
        $var = implode('_', Datatype::splitUpperCase($var));
        
        $variable = strtoupper($prefix . $var . $suffix);

        if( defined($variable) )
        {
            return constant($variable);
        }
        elseif( defined($var) )
        {
            return constant($var);
        }
        else
        {
            if( is_numeric($var) )
            {
                return (int) $var;
            }

            return $var;
        }
    }
}