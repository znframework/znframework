<?php namespace ZN\ViewObjects;

use ZN\FileSystem\File;
use ZN\IndividualStructures\Buffer;

class TemplateWizard
{
    //--------------------------------------------------------------------------------------------------------
    //
    // Author     : Ozan UYKUN <ozanbote@gmail.com>
    // Site       : www.znframework.com
    // License    : The MIT License
    // Copyright  : (c) 2012-2016, znframework.com
    //
    //--------------------------------------------------------------------------------------------------------

    //--------------------------------------------------------------------------------------------------------
    // Theme Integration -> 5.4.6
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $string
    //
    //--------------------------------------------------------------------------------------------------------
    public static function themeIntegration(String $themeName, String &$data)
    {
        $data = preg_replace_callback('/<(link|img|script|div)\s(.*?)(href|src)\=\"(.*?)\"(.*?)\>/i', function($selector) use ($themeName)
        {
            $orig = $selector[0];
            $path = $selector[4];

            if( ! \IS::url($path) && ! is_file($path) )
            {
                $suffix = suffix($themeName) . $path;

                if( is_file(THEMES_DIR . $suffix) )
                {
                    return str_replace($path, THEMES_URL . $suffix, $orig);
                }
            }     

            return $selector[0];
            
        }, $data);
    }

	//--------------------------------------------------------------------------------------------------------
    // Isolation -> 5.3.15
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $string
    //
    //--------------------------------------------------------------------------------------------------------
	public static function isolation(String $data = '')
	{
		File\Forge::replace($data, ['<?php', '<?', '?>'], ['{[', '{[', ']}']);
	}

    //--------------------------------------------------------------------------------------------------------
    // Data -> 5.3.15|5.4.6[edited]
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $string
    // @param array  $data
    //
    //--------------------------------------------------------------------------------------------------------
    public static function data(String $string, Array $data = []) : String
    {
        self::_textControl($string); // 5.4.6[added]

        $pattern = array_merge
        (
            self::_symbolsHeader(),
            self::_keywords(),
            self::_printable(),
            self::_functions(),
            self::_symbolsFooter(),
            self::_comments(),
            self::_required(),
            self::_tags(),
            self::_jsdata(),
            self::_html()
        );

        return Buffer\Callback::code(self::replace($pattern, $string), $data);
    }

    //--------------------------------------------------------------------------------------------------------
    // Protected Text Control -> 5.4.6[added]
    //--------------------------------------------------------------------------------------------------------
    //
    // @param void
    //
    //--------------------------------------------------------------------------------------------------------
    protected static function _textControl(&$string)
    {
        if( self::config()['html'] ?? true )
        {
            preg_match_all('/\<(style|script)(.*?)*\>(.*?)\<\/(style|script)\>/si', $string, $standart);
            preg_match_all('/\#(style|script)(.*?)*\s(.*?)\s\##(style|script)/si', $string, $wizard);

            $patterns = array_merge((array) $standart[3], (array) $wizard[3]);
            
            if( ! empty($patterns) ) 
            {
                $changes = [];
    
                foreach( $patterns as $pattern )
                {
                    $changes[] = str_replace(['/#', '#'], ['#', '/#'], $pattern);
                }
    
                $string = str_replace($patterns, $changes, $string);
            }
        } 
    }

    //--------------------------------------------------------------------------------------------------------
    // Protected Replace
    //--------------------------------------------------------------------------------------------------------
    //
    // @param void
    //
    //--------------------------------------------------------------------------------------------------------
    protected static function replace($pattern, $string)
    {
        return preg_replace(array_keys($pattern), array_values($pattern), $string);
    }

    //--------------------------------------------------------------------------------------------------------
    // Protected Config
    //--------------------------------------------------------------------------------------------------------
    //
    // @param void
    //
    //--------------------------------------------------------------------------------------------------------
    protected static function config()
    {
        return \Config::get('ViewObjects', 'wizard');
    }

    //--------------------------------------------------------------------------------------------------------
    // Protected Required
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $htmlRegexChar
    //
    //--------------------------------------------------------------------------------------------------------
    protected static function _required()
    {
        return
        [
            '/\{\{\{\s*(.*?)\s*\}\}\}/s' => '<?php echo htmlentities($1) ?>',
            '/\{\{(\s*.*?)\s*\}\}/s'     => '<?php echo $1 ?>',
        ];
    }

    //--------------------------------------------------------------------------------------------------------
    // Protected Keywords -> 5.4.4|5.4.7[edited]
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $htmlRegexChar
    //
    //--------------------------------------------------------------------------------------------------------
    protected static function _keywords()
    {
        $array = [];

        if( self::config()['keywords'] ?? true )
        {
            $array =
            [
                '/@endforelse:/'                                         => '<?php endif; ?>',                                       
                '/@forelse\s*\((\s*(.*?)\s+as\s+(.*?))\)\:/s'            => '<?php if( ! empty($2) ): foreach($1): ?>',
                '/@empty\:/'                                             => '<?php endforeach; else: ?>',     
                '/@loop\s*\((.*?)\)\:/s'                                 => '<?php foreach($1 as $key => $value): ?>',    
                '/@endloop:/'                                            => '<?php endforeach; ?>',         
                '/@(endif|endforeach|endfor|endwhile|break|continue)\:/' => '<?php $1 ?>',
                '/@(elseif|if|else|foreach|for|while)\s*(.*?)\:/s'       => '<?php $1$2: ?>'
            ];
        }

        return $array;
    }

    //--------------------------------------------------------------------------------------------------------
    // Protected Printable
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $htmlRegexChar
    //
    //--------------------------------------------------------------------------------------------------------
    protected static function _printable()
    {
        $array = [];

        if( self::config()['printable'] ?? true )
        {
            $suffix   = '\:/s';
            $coalesce = '\?';
            $constant = '@((\w+)(\[(\'|\")*.*?(\'|\")*\])*)';
            $variable = '/@\$(\w+.*?)';
            
            $outputVariableCoalesce = '<?php echo $$1 ?? NULL ?>';
            $outputVariable         = '<?php echo $$1 ?>';

            $outputCosntantCoalesce = '<?php echo defined("$2") ? ($1 ?? NULL) : NULL ?>';
            $outputCosntant         = '<?php echo $1 ?>';
            
            $array    =
            [
                $variable . $coalesce . $suffix         => $outputVariableCoalesce, // Variable
                $variable        . $suffix              => $outputVariable,         // Variable
                '/@' . $constant . $coalesce . $suffix  => $outputCosntantCoalesce, // Constant
                '/@' . $constant . $suffix              => $outputCosntant,         // Constant
                '/'  . $constant . $coalesce . $suffix  => $outputCosntantCoalesce, // Constant
                '/'  . $constant . $suffix              => $outputCosntant          // Constant
            ];
        }

        return $array;
    }

    //--------------------------------------------------------------------------------------------------------
    // Protected Functions -> 5.4.7[edited]
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $htmlRegexChar
    //
    //--------------------------------------------------------------------------------------------------------
    protected static function _functions()
    {
        $array = [];

        if( self::config()['functions'] ?? true )
        {
            $function = '@(\w+.*?(\)|\}|\]|\-\>\w+))\:/s';
            $array    =
            [
                '/@' . $function => '<?php echo $1 ?>', // Function
                '/'  . $function => '<?php if( is_scalar($1) ) echo $1; ?>'  // Function
            ];
        }

        return $array;
    }

    //--------------------------------------------------------------------------------------------------------
    // Protected Comments
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $htmlRegexChar
    //
    //--------------------------------------------------------------------------------------------------------
    protected static function _comments()
    {
        $array = [];

        if( self::config()['comments'] ?? true )
        {
            $array =
            [

                '/\{\-\-\s*(.*?)\s*\-\-\}/s' => '<!--$1-->'
            ];
        }

        return $array;
    }

    //--------------------------------------------------------------------------------------------------------
    // Protected JS Data -> 5.2.75
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $htmlRegexChar
    //
    //--------------------------------------------------------------------------------------------------------
    protected static function _jsdata()
    {
        $array = [];

        if( self::config()['jsdata'] ?? true )
        {
            $array =
            [
                '/\[\{\s*(.*?)\s*\}\]/s' => '{{$1}}'
            ];
        }

        return $array;
    }

    //--------------------------------------------------------------------------------------------------------
    // Protected Tags -> 5.3.36[edited]
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $htmlRegexChar
    //
    //--------------------------------------------------------------------------------------------------------
    protected static function _tags()
    {
        $array = [];

        if( self::config()['tags'] ?? true )
        {
            $array =
            [
				// 5.3.4[added]
				'/\{\[\=(.*?)\]\}/'      => '<?php echo $1 ?>',
                '/\{\[\s*(.*?)\s*\]\}/s' => '<?php $1 ?>'
            ];
        }

        return $array;
    }

    //--------------------------------------------------------------------------------------------------------
    // Protected Html
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $htmlRegexChar
    //
    //--------------------------------------------------------------------------------------------------------
    protected static function _html()
    {
        $array             = [];
        $htmlAttributesTag = '(^|\s)\#(!*\w+)\s*(\[(.*?)\])*';

        if( self::config()['html'] ?? true )
        {
            $array =
            [
                '/\/#/'                                         => '+[symbol??dies]+',
                '/\s+\#\#(\w+)/'                                => '</$1>',
                '/'.$htmlAttributesTag.'\:/'                    => '<$2 $4>',
                '/'.$htmlAttributesTag.'\s+/'                   => '<$2 $4>',
                '/'.$htmlAttributesTag.'\s*\(\s*(.*?)\s*\)\:/s' => '<$2 $4>$5</$2>',
                '/'.$htmlAttributesTag.'\s*/'                   => '<$2 $4>',
                '/\<(\w+)\s+\>/'                                => '<$1>',
                '/\+\[symbol\?\?dies\]\+/'                      => '#'
            ];
        }

        return $array;
    }

    //--------------------------------------------------------------------------------------------------------
    // Protected Symbols Header
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $htmlRegexChar
    //
    //--------------------------------------------------------------------------------------------------------
    protected static function _symbolsHeader()
    {
        return
        [
            '/\/@/' => '+[symbol??at]+',
            '/::/'  => '+[symbol??static]+',
            '/\/:/' => '+[symbol??colon]+',
        ];
    }

    //--------------------------------------------------------------------------------------------------------
    // Protected Symbols Footer
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $htmlRegexChar
    //
    //--------------------------------------------------------------------------------------------------------
    protected static function _symbolsFooter()
    {
        return
        [
            '/\+\[symbol\?\?at\]\+/'     => '@',
            '/\+\[symbol\?\?static\]\+/' => '::',
            '/\+\[symbol\?\?colon\]\+/'  => ':',
        ];
    }
}
