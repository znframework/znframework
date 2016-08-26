<?php namespace ZN\IndividualStructures;

class InternalSecurity extends \Requirements implements SecurityInterface
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
    // Nail Chars
    //--------------------------------------------------------------------------------------------------------
    // 
    // @var array
    //
    //--------------------------------------------------------------------------------------------------------
    protected $nailChars = array
    (
        "'" => "&#39;",
        '"' => "&#34;"
    );
    
    //--------------------------------------------------------------------------------------------------------
    // PHP Tag Chars
    //--------------------------------------------------------------------------------------------------------
    // 
    // @var array
    //
    //--------------------------------------------------------------------------------------------------------
    protected $phpTagChars = array
    (
        '<?' => '&#60;&#63;',
        '?>' => '&#63;&#62;'
    );
    
    //--------------------------------------------------------------------------------------------------------
    // PHP Tag Chars
    //--------------------------------------------------------------------------------------------------------
    // 
    // @var array
    //
    //--------------------------------------------------------------------------------------------------------
    protected $scriptTagChars = array
    (
        '/\<script(.*?)\>/i'  => '&#60;script$1&#62;',
        '/\<\/script\>/i'     => '&#60;/script&#62;'
    );
    
    //--------------------------------------------------------------------------------------------------------
    // PHP Tag Chars
    //--------------------------------------------------------------------------------------------------------
    // 
    // @var array
    //
    //--------------------------------------------------------------------------------------------------------
    protected $scriptTagCharsDecode = array
    (
        '/\&\#60\;script(.*?)\&\#62\;/i' => '<script$1>',
        '/\&\#60\;\/script\&\#62\;/i'    => '</script>'
    );

    //--------------------------------------------------------------------------------------------------------
    // Construct
    //--------------------------------------------------------------------------------------------------------
    // 
    // @param  void
    // @return bool
    //
    //--------------------------------------------------------------------------------------------------------
    public function __construct()
    {
        $this->config = config('IndividualStructures', 'security');
    }
    
    //--------------------------------------------------------------------------------------------------------
    // Nc Encode
    //--------------------------------------------------------------------------------------------------------
    // 
    // @param string $string 
    // @param mixed  $badWords
    // @param mixed  $changeChar
    //
    //--------------------------------------------------------------------------------------------------------
    public function ncEncode(String $string, $badWords = NULL, $changeChar = '[badchars]') : String
    {
        // 2. Parametre boş ise varsayılan olarak Config/Security.php dosya ayarlarını kullan.  
        if( empty($badWords) )
        {
            $secnc      = $this->config['ncEncode'];
            $badWords   = $secnc['badChars'];
            $changeChar = $secnc['changeBadChars'];
        }
        
        if( ! is_array($badWords) ) 
        {
            return $string = \Regex::replace($badWords, $changeChar, $string, 'xi');
        }
        
        $ch = '';
        $i  = 0;    
        
        foreach( $badWords as $value )
        {       
            if( ! is_array($changeChar) )
            {
                $ch = $changeChar;
            }
            else
            {
                if( isset($changeChar[$i]) )
                {
                    $ch = $changeChar[$i];  
                    $i++;
                }
            }
            
            $string = \Regex::replace($value, $ch, $string, 'xi');
        }
    
        return $string;
    }   
        
    //--------------------------------------------------------------------------------------------------------
    // Injection Encode
    //--------------------------------------------------------------------------------------------------------
    // 
    // @param string $string
    //
    //--------------------------------------------------------------------------------------------------------
    public function injectionEncode(String $string) : String
    {
        $secBadChars = $this->config['injectionBadChars'];
        
        if( ! empty($secBadChars)) 
        {
            foreach($secBadChars as $badChar => $changeChar)
            {
                if(is_numeric($badChar))
                {
                    $badChar = $changeChar;
                    $changeChar = '';
                }
                
                $badChar = trim($badChar, '/');
                
                $string = preg_replace('/'.$badChar.'/xi', $changeChar, $string);
            }
        }
        
        return addslashes(trim($string));
    }
    
    //--------------------------------------------------------------------------------------------------------
    // Injection Decode
    //--------------------------------------------------------------------------------------------------------
    // 
    // @param string $string
    //
    //--------------------------------------------------------------------------------------------------------
    public function injectionDecode(String $string) : String
    {
        return stripslashes(trim($string));
    }
    
    //--------------------------------------------------------------------------------------------------------
    // Xss Encode
    //--------------------------------------------------------------------------------------------------------
    // 
    // @param string $string
    //
    //--------------------------------------------------------------------------------------------------------
    public function xssEncode(String $string) : String
    {
        $secBadChars = $this->config['scriptBadChars'];
        
        if( ! empty($secBadChars)) 
        {
            foreach($secBadChars as $badChar => $changeChar)
            {
                if(is_numeric($badChar))
                {
                    $badChar = $changeChar;
                    $changeChar = '';
                }
                
                $badChar = trim($badChar, '/');
                
                $string = preg_replace('/'.$badChar.'/xi', $changeChar, $string);
            }
        }
        
        return $string;
    }


    //--------------------------------------------------------------------------------------------------------
    // Html Encode
    //--------------------------------------------------------------------------------------------------------
    // 
    // @param string $string
    // @param string $type: quotes, nonquotes, compat
    // @param string $encoding
    //
    //--------------------------------------------------------------------------------------------------------
    public function htmlEncode(String $string, String $type = 'quotes', String $encoding = 'utf-8') : String
    {
        return htmlspecialchars(trim($string), \Converter::toConstant($type, 'ENT_'), $encoding);
    }
    
    
    //--------------------------------------------------------------------------------------------------------
    // Html Decode
    //--------------------------------------------------------------------------------------------------------
    // 
    // @param string $string
    // @param string $type: quotes, nonquotes, compat
    //
    //--------------------------------------------------------------------------------------------------------
    public function htmlDecode(String $string, String $type = 'quotes') : String
    {
        return htmlspecialchars_decode(trim($string), \Converter::toConstant($type, 'ENT_'));
    }
    
    //--------------------------------------------------------------------------------------------------------
    // PHP Tag Encode
    //--------------------------------------------------------------------------------------------------------
    // 
    // @param string $str
    //
    //--------------------------------------------------------------------------------------------------------
    public function phpTagEncode(String $str) : String
    {   
        return str_replace(array_keys($this->phpTagChars), array_values($this->phpTagChars), $str);
    }
    
    //--------------------------------------------------------------------------------------------------------
    // PHP Tag Decode
    //--------------------------------------------------------------------------------------------------------
    // 
    // @param string $str
    //
    //--------------------------------------------------------------------------------------------------------
    public function phpTagDecode(String $str) : String
    {
        return str_replace(array_values($this->phpTagChars), array_keys($this->phpTagChars), $str);
    }
    
    //--------------------------------------------------------------------------------------------------------
    // Script Tag Encode
    //--------------------------------------------------------------------------------------------------------
    // 
    // @param string $str
    //
    //--------------------------------------------------------------------------------------------------------
    public function scriptTagEncode(String $str) : String
    {
        return preg_replace(array_keys($this->scriptTagChars), array_values($this->scriptTagChars), $str);
    }
    
    //--------------------------------------------------------------------------------------------------------
    // Script Tag Decode
    //--------------------------------------------------------------------------------------------------------
    // 
    // @param string $str
    //
    //--------------------------------------------------------------------------------------------------------
    public function scriptTagDecode(String $str) : String
    {
        return preg_replace(array_keys($this->scriptTagCharsDecode), array_values($this->scriptTagCharsDecode), $str);
    }
    
    //--------------------------------------------------------------------------------------------------------
    // Nail Encode
    //--------------------------------------------------------------------------------------------------------
    // 
    // @param string $str
    //
    //--------------------------------------------------------------------------------------------------------
    public function nailEncode(String $str) : String
    {
        $str = str_replace(array_keys($this->nailChars), array_values($this->nailChars), $str);
        
        return $str;
    }
    
    //--------------------------------------------------------------------------------------------------------
    // Nail Decode
    //--------------------------------------------------------------------------------------------------------
    // 
    // @param string $str
    //
    //--------------------------------------------------------------------------------------------------------
    public function nailDecode(String $str) : String
    {
        $str = str_replace(array_values($this->nailChars), array_keys($this->nailChars), $str);
        
        return $str;
    }
    
    //--------------------------------------------------------------------------------------------------------
    // Foreign Char Encode
    //--------------------------------------------------------------------------------------------------------
    // 
    // @param string $str
    //
    //--------------------------------------------------------------------------------------------------------
    public function foreignCharEncode(String $str) : String
    {   
        $chars = config('ForeignChars', 'numericalCodes');
        
        return str_replace(array_keys($chars), array_values($chars), $str);
    }   
    
    //--------------------------------------------------------------------------------------------------------
    // Foreign Char Decode
    //--------------------------------------------------------------------------------------------------------
    // 
    // @param string $str
    //
    //--------------------------------------------------------------------------------------------------------
    public function foreignCharDecode(String $str) : String
    {   
        $chars = config('ForeignChars', 'numericalCodes');
        
        return str_replace(array_values($chars), array_keys($chars), $str);
    }   
    
    //--------------------------------------------------------------------------------------------------------
    // Escape String Encode
    //--------------------------------------------------------------------------------------------------------
    // 
    // @param string $data
    //
    //--------------------------------------------------------------------------------------------------------
    public function escapeStringEncode(String $data) : String
    {
        return addslashes($data);
    }
    
    //--------------------------------------------------------------------------------------------------------
    // Escape String Decode
    //--------------------------------------------------------------------------------------------------------
    // 
    // @param string $str
    //
    //--------------------------------------------------------------------------------------------------------
    public function escapeStringDecode(String $data) : String
    {
        return stripslashes($data);
    }
}