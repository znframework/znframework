<?php namespace ZN\ViewObjects;

use Errors, Exceptions, CallController, Config;

class TemplateWizard extends CallController implements TemplateWizardInterface
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
    // Data
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $string
    // @param array  $data
    //
    //--------------------------------------------------------------------------------------------------------
    public static function data(String $string, Array $data = []) : String
    {
        $htmlRegexChar     = '.*?';
        $htmlTagClose      = "</$1>";
        $htmlAttributesTag = '\#(!*\w+)\s*(\[(.*?)\])*';

        $pattern = array_merge
        (
            self::_symbolsHeader(),
            self::_keywords($htmlRegexChar),
            self::_printable($htmlRegexChar),
            self::_functions($htmlRegexChar),
            self::_symbolsFooter(),
            self::_comments($htmlRegexChar),
            self::_required($htmlRegexChar),
            self::_tags($htmlRegexChar),
            self::_jsdata($htmlRegexChar),
            self::_html($htmlAttributesTag, $htmlTagClose)
        );

        $string = preg_replace(array_keys($pattern), array_values($pattern), $string);

        if( is_array($data) )
        {
            extract($data, EXTR_OVERWRITE);
        }

        ob_start();
        eval("?>$string");
        $content = ob_get_contents();
        ob_end_clean();

        if( $lastError = Errors::last() )
        {
            return Exceptions::table('', $lastError['message'], '', $lastError['line']);
        }
        else
        {
            return $content;
        }
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
        return Config::get('ViewObjects', 'wizard');
    }

    //--------------------------------------------------------------------------------------------------------
    // Protected Required
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $htmlRegexChar
    //
    //--------------------------------------------------------------------------------------------------------
    protected static function _required($htmlRegexChar)
    {
        return
        [
            '/\{\{\{\s*('.$htmlRegexChar.')\s*\}\}\}/s' => '<?php echo htmlentities($1) ?>',
            '/\{\{(\s*'.$htmlRegexChar.')\s*\}\}/s'     => '<?php echo $1 ?>',
        ];
    }

    //--------------------------------------------------------------------------------------------------------
    // Protected Keywords
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $htmlRegexChar
    //
    //--------------------------------------------------------------------------------------------------------
    protected static function _keywords($htmlRegexChar)
    {
        $array = [];

        if( self::config()['keywords'] ?? true )
        {
            $array =
            [
                '/@(endif|endforeach|endfor|endwhile|break|continue)\:/'            => '<?php $1 ?>',
                '/@(elseif|if|else|foreach|for|while)\s*('.$htmlRegexChar.')\:/s'   => '<?php $1$2: ?>'
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
    protected static function _printable($htmlRegexChar)
    {
        $array = [];

        if( self::config()['printable'] ?? true )
        {
            $array =
            [
                '/@\$('.$htmlRegexChar.')\:/s' => '<?php echo $$1 ?>',
                '/@@('.$htmlRegexChar.')\:/s'  => '<?php echo $1 ?>',
                '/@('.$htmlRegexChar.')\:/s'   => '<?php $1 ?>'
            ];
        }

        return $array;
    }

    //--------------------------------------------------------------------------------------------------------
    // Protected Functions
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $htmlRegexChar
    //
    //--------------------------------------------------------------------------------------------------------
    protected static function _functions($htmlRegexChar)
    {
        $array = [];

        if( self::config()['functions'] ?? true )
        {
            $array =
            [
                '/@('.$htmlRegexChar.')\:/s'   => '<?php $1 ?>'
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
    protected static function _comments($htmlRegexChar)
    {
        $array = [];

        if( self::config()['comments'] ?? true )
        {
            $array =
            [

                '/\{\-\-\s*('.$htmlRegexChar.')\s*\-\-\}/s' => '<!--$1-->'
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
    protected static function _jsdata($htmlRegexChar)
    {
        $array = [];

        if( self::config()['jsdata'] ?? true )
        {
            $array =
            [
                '/\[\{\s*('.$htmlRegexChar.')\s*\}\]/s' => '{{$1}}',
            ];
        }

        return $array;
    }

    //--------------------------------------------------------------------------------------------------------
    // Protected Tags
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $htmlRegexChar
    //
    //--------------------------------------------------------------------------------------------------------
    protected static function _tags($htmlRegexChar)
    {
        $array = [];

        if( self::config()['tags'] ?? true )
        {
            $array =
            [
                '/\{\[\s*('.$htmlRegexChar.')\s*\]\}/s' => '<?php $1 ?>',
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
    protected static function _html($htmlAttributesTag, $htmlTagClose)
    {
        $array = [];

        if( self::config()['html'] ?? true )
        {
            $array =
            [
                '/\/#/'                                         => '+[symbol??dies]+',
                '/\s+\#\#(\w+)/'                                => $htmlTagClose,
                '/'.$htmlAttributesTag.'\:/'                    => '<$1 $3>',
                '/'.$htmlAttributesTag.'\s+/'                   => '<$1 $3>',
                '/'.$htmlAttributesTag.'\s*\(\s*(.*?)\s*\)\:/s' => '<$1 $3>$4'.$htmlTagClose,
                '/'.$htmlAttributesTag.'\s*/'                   => '<$1 $3>',
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
