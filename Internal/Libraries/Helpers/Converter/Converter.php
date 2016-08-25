<?php namespace ZN\Helpers;

class InternalConverter extends \CallController implements ConverterInterface
{
    //--------------------------------------------------------------------------------------------------------
    //
    // Author     : Ozan UYKUN <ozanbote@gmail.com>
    // Site       : www.znframework.com
    // License    : The MIT License
    // Telif Hakkı: Copyright (c) 2012-2016, znframework.com
    //
    //--------------------------------------------------------------------------------------------------------
    
    //--------------------------------------------------------------------------------------------------------
    // Byte
    //--------------------------------------------------------------------------------------------------------
    // 
    // @param int  $bytes
    // @param int  $precision
    // @param bool $unit
    //
    //--------------------------------------------------------------------------------------------------------
    public function byte(Int $bytes, Int $precision = 1, Bool $unit = true) : String
    {       
        $byte   = 1024;
        $kb     = 1024 * $byte;
        $mb     = 1024 * $kb;
        $gb     = 1024 * $mb;
        $tb     = 1024 * $gb; 
        $pb     = 1024 * $tb;
        $eb     = 1024 * $pb;
        
        if( $bytes <= $byte && $bytes > -1 )
        {
            $un = ( ! empty($unit) ) 
                  ? " Bytes" 
                  : "";
            
            $return = $bytes.$un;
        }
        elseif( $bytes <= $kb && $bytes > $byte )
        {
            $un = ( ! empty($unit) ) 
                  ? " KB" 
                  : "";
                  
            $return =  round(($bytes / $byte),$precision).$un;
        }
        elseif( $bytes <= $mb && $bytes > $kb )
        {   
            $un = ( ! empty($unit) ) 
                  ? " MB" 
                  : "";
                  
            $return =  round(($bytes / $kb),$precision).$un;
        }
        elseif( $bytes <= $gb && $bytes > $mb )
        {   
            $un = ( ! empty($unit) ) 
                  ? " GB" 
                  : "";
                  
            $return =   round(($bytes / $mb),$precision).$un;
        }
        elseif( $bytes <= $tb && $bytes > $gb )
        {
            $un = ( ! empty($unit) ) 
                  ? " TB" 
                  : "";
                  
            $return =   round(($bytes / $gb),$precision).$un;
        }
        elseif( $bytes <= $pb && $bytes > $tb )
        {
            $un = ( ! empty($unit) ) 
                  ? " PB" 
                  : "";
                  
            $return =   round(($bytes / $tb),$precision).$un;
        }
        elseif( $bytes <= $eb && $bytes > $pb )
        {
            $un = ( ! empty($unit) ) 
                  ? " EB" 
                  : "";
                  
            $return =   round(($bytes / $pb),$precision).$un;
        }
        else
        {
            $un = ( ! empty($unit) ) 
                  ? " Bytes" 
                  : "";
                  
            $return = str_replace(",", ".", number_format($bytes)).$un;
        }

        return $return;
    }

    //--------------------------------------------------------------------------------------------------------
    // Money
    //--------------------------------------------------------------------------------------------------------
    // 
    // @param int    $money
    // @param string $type
    //
    //--------------------------------------------------------------------------------------------------------
    public function money(Int $money = 0, String $type = NULL) : String
    {
        return \Cart::moneyFormat($money, $type);
    }

    //--------------------------------------------------------------------------------------------------------
    // Time
    //--------------------------------------------------------------------------------------------------------
    // 
    // @param int    $count
    // @param string $type
    // @param string $output
    //
    //--------------------------------------------------------------------------------------------------------
    public function time($count, String $type = 'second', String $output = 'day') : Float
    {
        if( $output === "second" ) $out = 1;
        if( $output === "minute" ) $out = 60;
        if( $output === "hour" )   $out = 60 * 60;
        if( $output === "day" )    $out = 60 * 60 * 24;
        if( $output === "month" )  $out = 60 * 60 * 24 * 30;
        if( $output === "year" )   $out = 60 * 60 * 24 * 30 * 12;
        
        if( $type === "second" ) $time = $count;
        if( $type === "minute" ) $time = 60 * $count;
        if( $type === "hour" )   $time = 60 * 60 * $count;
        if( $type === "day" )    $time = 60 * 60 * 24 * $count;
        if( $type === "month" )  $time = 60 * 60 * 24 * 30 * $count;
        if( $type === "year" )   $time = 60 * 60 * 24 * 30 * 12 * $count;
            
        return $time / $out;    
    }   
    
    //--------------------------------------------------------------------------------------------------------
    // Word
    //--------------------------------------------------------------------------------------------------------
    // 
    // @param string $string
    // @param mixed  $badWords
    // @param mixed  $changeChar
    //
    //--------------------------------------------------------------------------------------------------------
    public function word(String $string, $badWords = NULL, $changeChar = '[badwords]') : String
    {
        return str_ireplace($badWords, $changeChar, $string);
    }   

    //--------------------------------------------------------------------------------------------------------
    // Anchor
    //--------------------------------------------------------------------------------------------------------
    // 
    // @param string $data
    // @param string $type: short, long
    // @param array  $attributes
    //
    //--------------------------------------------------------------------------------------------------------
    public function anchor(String $data, String $type = 'short', Array $attributes = NULL) : String
    {
        return preg_replace
        (
            '/(((https?|ftp)\:\/\/)(\w+\.)*(\w+)\.\w+\/*\S*)/xi', 
            '<a href="$1"'.\Html::attributes((array) $attributes).'>'.( $type === 'short' ? '$5' : '$1').'</a>', 
            $data
        );
    }
    
    //--------------------------------------------------------------------------------------------------------
    // Char
    //--------------------------------------------------------------------------------------------------------
    // 
    // @param string $string
    // @param string $type      : char, dec, hex, html
    // @param string $changeType: char, dec, hex, html
    //
    //--------------------------------------------------------------------------------------------------------
    public function char(String $string, String $type = 'char', String $changeType = 'html') : String
    {
        $string = $this->accent($string);
        
        if( ! is_string($type) ) 
        {
            $type = 'char';
        }
        
        if( ! is_string($changeType) ) 
        {
            $changeType = 'html';
        }
        
        for( $i = 32; $i <= 255; $i++ )
        {
            $hexRemaining = ( $i % 16 );
            $hexRemaining = str_replace( [10, 11, 12, 13, 14, 15], ['A', 'B', 'C', 'D', 'E', 'F'], $hexRemaining );
            $hex          = ( floor( $i / 16) ).$hexRemaining;
            
            if( $hex[0] == '0' ) 
            {
                $hex = $hex[1]; 
            }
            
            if( chr($i) !== ' ' )
            {
                $chars['char'][] = chr($i);
                $chars['dec'][]  = $i." ";
                $chars['hex'][]  = $hex." ";
                $chars['html'][] = "&#{$i};";
            }       
        }   
        
        return str_replace( $chars[strtolower($type)], $chars[strtolower($changeType)], $string );
    }

    //--------------------------------------------------------------------------------------------------------
    // Accent
    //--------------------------------------------------------------------------------------------------------
    // 
    // @param string $str
    //
    //--------------------------------------------------------------------------------------------------------
    public function accent(String $str) : String 
    {   
        $accent = \Config::get('ForeignChars', 'accentChars');
        
        $accent = \Arrays::multikey($accent);
        
        return str_replace(array_keys($accent), array_values($accent), $str); 
    } 

    //--------------------------------------------------------------------------------------------------------
    // Url Word
    //--------------------------------------------------------------------------------------------------------
    // 
    // @param string $str
    // @param string $splitWord
    //
    //--------------------------------------------------------------------------------------------------------
    public function urlWord(String $str, String $splitWord = '-') : String
    {
        $badChars = Config::get('IndividualStructures', 'security')['urlBadChars'];
        
        $str = $this->accent($str);
        $str = str_replace($badChars, '', $str);
        $str = preg_replace("/\s+/", ' ', $str);
        $str = str_replace("&nbsp;", '', $str);
        $str = str_replace(' ', $splitWord, trim(strtolower($str)));
        
        return $str;
    }

    //--------------------------------------------------------------------------------------------------------
    // String Case
    //--------------------------------------------------------------------------------------------------------
    // 
    // @param string $str
    // @param string $type: lower, upper, title
    // @param string $encoding
    //
    //--------------------------------------------------------------------------------------------------------
    public function stringCase(String $str, String $type = 'lower', String $encoding = 'utf-8') : String
    {
        return mb_convert_case($str, $this->toConstant($type, 'MB_CASE_'), $encoding);  
    }   
    
    //--------------------------------------------------------------------------------------------------------
    // Array Case
    //--------------------------------------------------------------------------------------------------------
    // 
    // @param array  $array
    // @param string $type  : lower, upper, title
    // @param string $keyval: key, val, value, all
    //
    //--------------------------------------------------------------------------------------------------------
    public function arrayCase(Array $array, String $type = 'lower', String $keyval = 'all') : Array
    {
        if( $type === 'lower' )
        {
            $caseType = 'Strings::lowerCase';   
        }
        elseif( $type === 'upper' )
        {
            $caseType = 'Strings::upperCase';       
        }
        elseif( $type === 'title' )
        {
            $caseType = 'Strings::titleCase';   
        }
        
        $arrayVals = array_values($array);
        $arrayKeys = array_keys($array);
        
        if( $keyval === 'key' )
        {
            $arrayKeys = array_map($caseType, $arrayKeys);
        }
        elseif( $keyval === 'val' || $keyval === 'value' )
        {
            $arrayVals = array_map($caseType, $arrayVals);
        }
        else
        {
            $arrayKeys = array_map($caseType, $arrayKeys);
            $arrayVals = array_map($caseType, $arrayVals);      
        }
        
        $newArray = [];
        
        for( $i = 0; $i < count($array); $i++ )
        {
            $newArray[$arrayKeys[$i]] = $arrayVals[$i];
        }
        
        return $newArray;
    }
    
    //--------------------------------------------------------------------------------------------------------
    // Charset
    //--------------------------------------------------------------------------------------------------------
    // 
    // @param string $str
    // @param string $fromCharset
    // @param string $toCharset
    //
    //--------------------------------------------------------------------------------------------------------
    public function charset(String $str, String $fromCharset, String $toCharset = 'utf-8') : String
    {
        return mb_convert_encoding($str, $fromCharset, $toCharset); 
    }
    
    //--------------------------------------------------------------------------------------------------------
    // High Light
    //--------------------------------------------------------------------------------------------------------
    // 
    // @param string $str
    // @param array $settings
    //
    //--------------------------------------------------------------------------------------------------------
    public function highLight(String $str, Array $settings = []) : String
    {
        $phpFamily      = ! empty( $settings['php:family'] ) ? 'font-family:'.$settings['php:family'] : 'font-family:Consolas';
        $phpSize        = ! empty( $settings['php:size'] )   ? 'font-size:'.$settings['php:size'] : 'font-size:12px';
        $phpStyle       = ! empty( $settings['php:style'] )  ? $settings['php:style'] : '';     
        $htmlFamily     = ! empty( $settings['html:family'] ) ? 'font-family:'.$settings['html:family'] : '';
        $htmlSize       = ! empty( $settings['html:size'] )   ? 'font-size:'.$settings['html:size'] : '';
        $htmlColor      = ! empty( $settings['html:color'] )  ? $settings['html:color'] : '';
        $htmlStyle      = ! empty( $settings['html:style'] )  ? $settings['html:style'] : '';       
        $comment        = ! empty( $settings['comment:color'] ) ? $settings['comment:color'] : '#969896';
        $commentStyle   = ! empty( $settings['comment:style'] ) ? $settings['comment:style'] : '';
        $default        = ! empty( $settings['default:color'] ) ? $settings['default:color'] : '#000000';
        $defaultStyle   = ! empty( $settings['default:style'] ) ? $settings['default:style'] : '';
        $keyword        = ! empty( $settings['keyword:color'] ) ? $settings['keyword:color'] : '#a71d5d';
        $keywordStyle   = ! empty( $settings['keyword:style'] ) ? $settings['keyword:style'] : '';
        $string         = ! empty( $settings['string:color'] )  ? $settings['string:color']  : '#183691';
        $stringStyle    = ! empty( $settings['string:style'] )  ? $settings['string:style']  : '';  
        $background     = ! empty( $settings['background'] )   ? $settings['background'] : '';  
        $tags           = isset( $settings['tags'] )  ? $settings['tags']  : true;
        
        ini_set("highlight.comment", "$comment; $phpFamily; $phpSize; $phpStyle; $commentStyle");
        ini_set("highlight.default", "$default; $phpFamily; $phpSize; $phpStyle; $defaultStyle");
        ini_set("highlight.keyword", "$keyword; $phpFamily; $phpSize; $phpStyle; $keywordStyle ");
        ini_set("highlight.string",  "$string;  $phpFamily; $phpSize; $phpStyle; $stringStyle");    
        ini_set("highlight.html",    "$htmlColor; $htmlFamily; $htmlSize; $htmlStyle");
        
        // ----------------------------------------------------------------------------------------------
        // HIGHLIGHT
        // ----------------------------------------------------------------------------------------------
        $string = highlight_string($str, true);
        // ----------------------------------------------------------------------------------------------
    
        $string = \Security::scriptTagEncode(\Security::phpTagEncode(\Security::htmlDecode($string)));
        
        $tagArray = $tags === true 
                  ? ['<div style="'.$background.'">&#60;&#63;php', '&#63;&#62;</div>']
                  : ['<div style="'.$background.'">', '</div>'];
        
        return str_replace(['&#60;&#63;php', '&#63;&#62;'], $tagArray, $string);
    }
    
    //--------------------------------------------------------------------------------------------------------
    // To Int
    //--------------------------------------------------------------------------------------------------------
    // 
    // @param var $var
    //
    //--------------------------------------------------------------------------------------------------------
    public function toInt($var) : Int
    {
        return (int) $var;  
    }
    
    //--------------------------------------------------------------------------------------------------------
    // To Integer
    //--------------------------------------------------------------------------------------------------------
    // 
    // @param var $var
    //
    //--------------------------------------------------------------------------------------------------------
    public function toInteger($var) : Int
    {
        return (int) $var;  
    }
    
    //--------------------------------------------------------------------------------------------------------
    // To Bool
    //--------------------------------------------------------------------------------------------------------
    // 
    // @param var $var
    //
    //--------------------------------------------------------------------------------------------------------
    public function toBool($var) : Bool
    {
        return (bool) $var; 
    }
    
    //--------------------------------------------------------------------------------------------------------
    // To Boolean
    //--------------------------------------------------------------------------------------------------------
    // 
    // @param var $var
    //
    //--------------------------------------------------------------------------------------------------------
    public function toBoolean($var) : Bool
    {
        return (bool) $var; 
    }
    
    //--------------------------------------------------------------------------------------------------------
    // To String
    //--------------------------------------------------------------------------------------------------------
    // 
    // @param var $var
    //
    //--------------------------------------------------------------------------------------------------------
    public function toString($var) : String
    {
        if( is_array($var) || is_object($var) ) 
        {
            return implode(' ', (array) $var);
        }
        
        return (string) $var;   
    }
    
    //--------------------------------------------------------------------------------------------------------
    // To Float
    //--------------------------------------------------------------------------------------------------------
    // 
    // @param var $var
    //
    //--------------------------------------------------------------------------------------------------------
    public function toFloat($var) : Float
    {
        return (float) $var;    
    }   
    
    //--------------------------------------------------------------------------------------------------------
    // To Real
    //--------------------------------------------------------------------------------------------------------
    // 
    // @param var $var
    //
    //--------------------------------------------------------------------------------------------------------
    public function toReal($var)
    {
        return (real) $var; 
    }   
    
    //--------------------------------------------------------------------------------------------------------
    // To Double
    //--------------------------------------------------------------------------------------------------------
    // 
    // @param var $var
    //
    //--------------------------------------------------------------------------------------------------------
    public function toDouble($var)
    {
        return (double) $var;   
    }
    
    //--------------------------------------------------------------------------------------------------------
    // To Object
    //--------------------------------------------------------------------------------------------------------
    // 
    // @param var $var
    //
    //--------------------------------------------------------------------------------------------------------
    public function toObject($var) : \stdClass
    {
        return (object) $var;   
    }
    
    //--------------------------------------------------------------------------------------------------------
    // To Array
    //--------------------------------------------------------------------------------------------------------
    // 
    // @param var $var
    //
    //--------------------------------------------------------------------------------------------------------
    public function toArray($var) : Array
    {
        return (array) $var;    
    }
    
    //--------------------------------------------------------------------------------------------------------
    // To Unset
    //--------------------------------------------------------------------------------------------------------
    // 
    // @param var $var
    //
    //--------------------------------------------------------------------------------------------------------
    public function toUnset($var)
    {
        return (unset) $var;    
    }
    
    //--------------------------------------------------------------------------------------------------------
    // To Constant
    //--------------------------------------------------------------------------------------------------------
    // 
    // @param var    $var
    // @param string $prefix
    // @param string $suffix
    //
    //--------------------------------------------------------------------------------------------------------
    public function toConstant($var, String $prefix = NULL, String $suffix = NULL)
    {
        if( ! is_scalar($var) )
        {
            return \Exceptions::throws('Error', 'valueParameter', '1.(var)');   
        }
            
        if( defined(strtoupper($prefix.$var.$suffix)) )
        {
            return constant(strtoupper($prefix.$var.$suffix));
        }
        elseif( defined($var) )
        {
            return constant($var);
        }
        else
        {
            return $var;    
        }
    }
    
    //--------------------------------------------------------------------------------------------------------
    // To Unset
    //--------------------------------------------------------------------------------------------------------
    // 
    // @param var    $var
    // @param string $type
    //
    //--------------------------------------------------------------------------------------------------------
    public function varType($var, String $type)
    {
        switch($type)
        {
            case 'int':
                return (int)$var;
            break;  
            
            case 'integer':
                return (integer)$var;
            break;  
            
            case 'bool':
                return (bool)$var;
            break;  
            
            case 'boolean':
                return (boolean)$var;
            break;
            
            case 'str':
            case 'string':
                if(is_array($var) || is_object($var)) return implode(' ', (array) $var);
                return (string)$var;
            break;
            
            case 'float':
                return (float)$var;
            break;
            
            case 'real':
                return (real)$var;
            break;
            
            case 'double':
                return (double)$var;
            break;
            
            case 'object':
                return (object)$var;
            break;
            
            case 'array':
                return (array)$var;
            break;
            
            case 'unset':
                return (unset)$var;
            break;
        }
    }
}