<?php namespace ZN\DataTypes;

use Converter, Exceptions, CallController;

class InternalStrings extends CallController implements StringsInterface
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
    // mtrim
    //--------------------------------------------------------------------------------------------------------
    // 
    // @param string $str
    //
    //--------------------------------------------------------------------------------------------------------
    public function mtrim(String $str) : String
    {
        $str = preg_replace
        (
            ['/\s+/', '/&nbsp;/', "/\n/", "/\r/", "/\t/"], 
            ['', '', '', '', ''], 
            $str
        );
        
        return $str;
    }   

    //--------------------------------------------------------------------------------------------------------
    // Trim Slashes
    //--------------------------------------------------------------------------------------------------------
    // 
    // @param string $str
    //
    //--------------------------------------------------------------------------------------------------------
    public function trimSlashes(String $str) : String
    {
        $str = trim($str, "/");
        
        return $str;
    }   
    
    //--------------------------------------------------------------------------------------------------------
    // Casing
    //--------------------------------------------------------------------------------------------------------
    // 
    // @param string $str
    // @param string $type lower, upper, title
    // @param string $encoding
    //
    //--------------------------------------------------------------------------------------------------------
    public function casing(String $str, String $type = 'lower', String $encoding = 'utf-8') : String
    {
        return Converter::stringCase($str, $type, $encoding);
    }

    //--------------------------------------------------------------------------------------------------------
    // Upper Case
    //--------------------------------------------------------------------------------------------------------
    // 
    // @param string $str
    // @param string $encoding
    //
    //--------------------------------------------------------------------------------------------------------
    public function upperCase(String $str, String $encoding = 'utf-8') : String
    {
        $str = mb_convert_case($str, MB_CASE_UPPER, $encoding);
        
        return $str;
    }   

    //--------------------------------------------------------------------------------------------------------
    // Lower Case
    //--------------------------------------------------------------------------------------------------------
    // 
    // @param string $str
    // @param string $encoding
    //
    //--------------------------------------------------------------------------------------------------------
    public function lowerCase(String $str, String $encoding = 'utf-8') : String
    {
        $str = mb_convert_case($str, MB_CASE_LOWER, $encoding);
        
        return $str;
    }   

    //--------------------------------------------------------------------------------------------------------
    // Title Case
    //--------------------------------------------------------------------------------------------------------
    // 
    // @param string $str
    // @param string $encoding
    //
    //--------------------------------------------------------------------------------------------------------
    public function titleCase(String $str, String $encoding = 'utf-8') : String
    {
        $str = mb_convert_case($str, MB_CASE_TITLE, $encoding);
        
        return $str;
    }
    
    //--------------------------------------------------------------------------------------------------------
    // Camel Case
    //--------------------------------------------------------------------------------------------------------
    // 
    // @param string $str
    //
    //--------------------------------------------------------------------------------------------------------
    public function camelCase(String $str) : String
    {
        $string = $this->titleCase($str);
        
        $string[0] = $this->lowerCase($string);
        
        return $this->mtrim($string);
    }   
    
    //--------------------------------------------------------------------------------------------------------
    // Pascal Case
    //--------------------------------------------------------------------------------------------------------
    // 
    // @param string $str
    //
    //--------------------------------------------------------------------------------------------------------
    public function pascalCase(String $str) : String
    {
        $string = $this->titleCase($str);
        
        return $this->mtrim($string);
    }

    //--------------------------------------------------------------------------------------------------------
    // Section
    //--------------------------------------------------------------------------------------------------------
    // 
    // @param string $str
    // @param int    $starting
    // @param int    $count
    // @param string $encoding
    //
    //--------------------------------------------------------------------------------------------------------
    public function section(String $str, Int $starting = 0, Int $count = NULL, String $encoding = 'utf-8') : String
    {
        return mb_substr($str, $starting, $count, $encoding);
    }   

    //--------------------------------------------------------------------------------------------------------
    // Search
    //--------------------------------------------------------------------------------------------------------
    // 
    // @param string $str
    // @param string $needle
    // @param string $type
    // @param string $case
    //
    //--------------------------------------------------------------------------------------------------------
    public function search(String $str, String $needle, String $type = 'str', Bool $case = true) : String
    {
        if( $type === "str" || $type === "string" )
        {
            if( $case === true )
            {
                return mb_strstr($str, $needle);
            }
            else
            {
                return mb_stristr($str, $needle);
            }
        }

        if( $type === "pos" || $type === "position" )
        {
            if( $case === true )
            {
                return mb_strpos($str, $needle);
            }
            else
            {
                return mb_stripos($str, $needle);
            }
        }
    }   

    //--------------------------------------------------------------------------------------------------------
    // Reshuffle
    //--------------------------------------------------------------------------------------------------------
    // 
    // @param string $str
    // @param string $shuffle
    // @param string $reshuffle
    //
    //--------------------------------------------------------------------------------------------------------
    public function reshuffle(String $str, String $shuffle, String $reshuffle) : String
    {
        $shuffleEx = explode($shuffle, $str);
        
        $newstr = '';
        
        foreach( $shuffleEx as $v )
        {
            $newstr .=  str_replace($reshuffle, $shuffle, $v).$reshuffle;   
        } 
        
        return substr($newstr, 0, -strlen($reshuffle));
    }   

    //--------------------------------------------------------------------------------------------------------
    // Recurrent Count
    //--------------------------------------------------------------------------------------------------------
    // 
    // @param string $str
    // @param string $char
    //
    //--------------------------------------------------------------------------------------------------------
    public function recurrentCount(String $str, String $char) : Int
    {
        return count(explode($char, $str)) - 1;
    }   

    //--------------------------------------------------------------------------------------------------------
    // Placement
    //--------------------------------------------------------------------------------------------------------
    // 
    // @param string $str
    // @param string $delimiter
    // @param array  $array
    //
    //--------------------------------------------------------------------------------------------------------
    public function placement(String $str, String $delimiter, Array $array) : String
    {
        if( ! is_array($array) ) 
        {
            return Exceptions::throws('Error', 'arrayParameter', '3.(array)');
        }
        
        if( ! empty($delimiter) )
        {
            $strex = explode($delimiter, $str);
        }
        else
        {
            return $str;
        }
        
        if( (count($strex) - 1) !== count($array) )
        {
            return $str;
        }
        
        $newstr = '';
        
        for($i = 0; $i < count($array); $i++)
        {
            $newstr .= $strex[$i].$array[$i];
        }
    
        return $newstr.$strex[count($array)];
    }   
    
    //--------------------------------------------------------------------------------------------------------
    // Replace
    //--------------------------------------------------------------------------------------------------------
    // 
    // @param string $str
    // @param string $delimiter
    // @param array  $array
    //
    //--------------------------------------------------------------------------------------------------------
    public function replace(String $string, String $oldChar, String $newChar = '', Bool $case = true) : String
    {
        if( $case === true )
        {
            return str_replace($oldChar, $newChar, $string);
        }
        else
        {
            return str_ireplace($oldChar, $newChar, $string);
        }
    }
    
    //--------------------------------------------------------------------------------------------------------
    // To Array
    //--------------------------------------------------------------------------------------------------------
    // 
    // @param string $string
    // @param string $split
    //
    //--------------------------------------------------------------------------------------------------------
    public function toArray(String $string, String $split = ' ') : Array
    {
        return explode($split, $string);
    }
    
    //--------------------------------------------------------------------------------------------------------
    // To Char
    //--------------------------------------------------------------------------------------------------------
    // 
    // @param int $ascii
    //
    //--------------------------------------------------------------------------------------------------------
    public function toChar(Int $ascii) : String
    {
        return chr($ascii);
    }
    
    //--------------------------------------------------------------------------------------------------------
    // To Ascii
    //--------------------------------------------------------------------------------------------------------
    // 
    // @param string $str
    //
    //--------------------------------------------------------------------------------------------------------
    public function toAscii(String $string) : Int
    {
        return ord($string);
    }
    
    //--------------------------------------------------------------------------------------------------------
    // Add Slashes
    //--------------------------------------------------------------------------------------------------------
    // 
    // @param string $str
    // @param string $addDifferentChars
    //
    //--------------------------------------------------------------------------------------------------------
    public function addSlashes(String $string, String $addDifferentChars = NULL) : String
    {
        $return = addslashes($string);
        
        if( ! empty($addDifferentChars) )
        {
            $return = addcslashes($return, $addDifferentChars);
        }
        
        return $return;
    }
    
    //--------------------------------------------------------------------------------------------------------
    // Remove Slashes
    //--------------------------------------------------------------------------------------------------------
    // 
    // @param string $str
    //
    //--------------------------------------------------------------------------------------------------------
    public function removeSlashes(String $string) : String
    {
        return stripslashes(stripcslashes($string));
    }
    
    //--------------------------------------------------------------------------------------------------------
    // Length
    //--------------------------------------------------------------------------------------------------------
    // 
    // @param string $str
    // @param string $encoding
    //
    //--------------------------------------------------------------------------------------------------------
    public function length(String $string, String $encoding = 'utf-8') : Int
    {
        return mb_strlen($string, $encoding);
    }
    
    //--------------------------------------------------------------------------------------------------------
    // Encode
    //--------------------------------------------------------------------------------------------------------
    // 
    // @param string $str
    // @param string $salt
    //
    //--------------------------------------------------------------------------------------------------------
    public function encode(String $string, String $salt) : String 
    {
        return crypt($string, $salt);
    }
    
    //--------------------------------------------------------------------------------------------------------
    // Repeat
    //--------------------------------------------------------------------------------------------------------
    // 
    // @param string $str
    // @param numeric $count
    //
    //--------------------------------------------------------------------------------------------------------
    public function repeat(String $string, Int $count = 1) : String
    {
        return str_repeat($string, $count);
    }
    
    //--------------------------------------------------------------------------------------------------------
    // Pad
    //--------------------------------------------------------------------------------------------------------
    // 
    // @param string $str
    // @param numeric $count
    // @param string  $chars
    // @param string  $type
    //
    //--------------------------------------------------------------------------------------------------------
    public function pad(String $string, Int $count = 1, String $chars = ' ', String $type = 'right') : String
    {
        return str_pad($string, $count, $chars, Converter::toConstant($type, 'STR_PAD_'));
    }
    
    //--------------------------------------------------------------------------------------------------------
    // Apportion
    //--------------------------------------------------------------------------------------------------------
    // 
    // @param string  $string
    // @param numeric $length
    // @param string  $end
    //
    //--------------------------------------------------------------------------------------------------------
    public function apportion(String $string, Int $length = 76, String $end = "\r\n") : String
    {
        $arrayChunk = array_chunk(preg_split("//u", $string, -1, PREG_SPLIT_NO_EMPTY), $length);
    
        $string = "";
        
        foreach( $arrayChunk as $chunk ) 
        {
            $string .= implode("", $chunk) . $end;
        }
        
        return $string;
    }
    
    //--------------------------------------------------------------------------------------------------------
    // Divide
    //--------------------------------------------------------------------------------------------------------
    // 
    // @param string  $string
    // @param string  $seperator
    // @param numeric $index
    //
    //--------------------------------------------------------------------------------------------------------
    public function divide(String $str, String $separator = "|", $index = 0) : String
    {
        return divide($str, $separator, $index);
    }
    
    //--------------------------------------------------------------------------------------------------------
    // Translation Table
    //--------------------------------------------------------------------------------------------------------
    // 
    // @param numeric $table
    // @param numeric $quote
    //
    //--------------------------------------------------------------------------------------------------------
    public function translationTable(String $table = 'specialchars', String $quote = 'compat') : Array
    {
        return get_html_translation_table(Converter::toConstant($table, 'HTML_'), Converter::toConstant($quote, 'ENT_'));
    }
}