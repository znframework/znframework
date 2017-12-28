<?php namespace ZN\ViewObjects;
/**
 * ZN PHP Web Framework
 * 
 * "Simplicity is the ultimate sophistication." ~ Da Vinci
 * 
 * @package ZN
 * @license MIT [http://opensource.org/licenses/MIT]
 * @author  Ozan UYKUN [ozan@znframework.com]
 */

use ZN\FileSystem\File;
use ZN\IndividualStructures\Buffer;

class TemplateWizard
{
    /**
     * Theme integration.
     * 
     * @param string $themeName
     * @param string &$data
     * 
     * @return void
     */
    public static function themeIntegration(String $themeName, String &$data)
    {
        $data = preg_replace_callback
        (
            '/<(link|img|script|div)\s(.*?)(href|src)\=\"(.*?)\"(.*?)\>/i', 
            function($selector) use ($themeName)
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
                
            }, $data
        );
    }

	/**
     * PHP tag isolation
     * 
     * @param string $data = ''
     * 
     * @return void
     */
	public static function isolation(String $data = '')
	{
		File\Forge::replace($data, ['<?php', '<?', '?>'], ['{[', '{[', ']}']);
	}

    /**
     * Get data.
     * 
     * @param string $string
     * @param array  $data = []
     * 
     * @return string
     */
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

    /**
     * protected text control.
     * 
     * @param string &$string
     * 
     * @return void
     */
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

    /**
     * protected replace.
     * 
     * @param array  $pattern
     * @param string $string
     * 
     * @return string
     */
    protected static function replace($pattern, $string)
    {
        return preg_replace(array_keys($pattern), array_values($pattern), $string);
    }

    /**
     * protected config.
     * 
     * @para void
     * 
     * @return array
     */
    protected static function config()
    {
        return \Config::get('ViewObjects', 'wizard');
    }

    /**
     * protected required
     * 
     * @param void
     * 
     * @return array
     */
    protected static function _required()
    {
        return
        [
            '/\{\{\{\s*(.*?)\s*\}\}\}/s' => '<?php echo htmlentities($1) ?>',
            '/\{\{(\s*.*?)\s*\}\}/s'     => '<?php echo $1 ?>',
        ];
    }

    /**
     * protected keywords
     * 
     * @param void
     * 
     * @return array
     */
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

    /**
     * protected printable
     * 
     * @param void
     * 
     * @return array
     */
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

    /**
     * protected functions
     * 
     * @param void
     * 
     * @return array
     */
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

    /**
     * protected comments
     * 
     * @param void
     * 
     * @return array
     */
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

    /**
     * protected javascript data
     * 
     * @param void
     * 
     * @return array
     */
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

    /**
     * protected tags
     * 
     * @param void
     * 
     * @return array
     */
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

    /**
     * protected html
     * 
     * @param void
     * 
     * @return array
     */
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

    /**
     * protected symbols header
     * 
     * @param void
     * 
     * @return array
     */
    protected static function _symbolsHeader()
    {
        return
        [
            '/\/@/' => '+[symbol??at]+',
            '/::/'  => '+[symbol??static]+',
            '/\/:/' => '+[symbol??colon]+',
        ];
    }

    /**
     * protected symbols footer
     * 
     * @param void
     * 
     * @return array
     */
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
