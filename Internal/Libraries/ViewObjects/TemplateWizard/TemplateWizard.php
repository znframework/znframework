<?php namespace ZN\ViewObjects;

use Errors, Exceptions, CallController;

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

        $pattern =
        [
            // SPECIAL SYMBOLS
            '/\/@/'                                                             => '+[symbol??at]+',
            '/\/#/'                                                             => '+[symbol??dies]+',
            '/::/'                                                              => '+[symbol??static]+',
            '/\/:/'                                                             => '+[symbol??colon]+',

            // DECISION STRUCTURES & LOOPS
            '/@(endif|endforeach|endfor|endwhile|break|continue)\:/'            => '<?php $1 ?>',
            '/@(elseif|if|else|foreach|for|while)\s*('.$htmlRegexChar.')\:/s'   => '<?php $1$2: ?>',

            // PRINTABLE VARIABLES
            '/@\$('.$htmlRegexChar.')\:/s'                                      => '<?php echo $$1 ?>',

            // PRINTABLE FUNCTIONS
            '/@@('.$htmlRegexChar.')\:/s'                                       => '<?php echo $1 ?>',

            // FUNCTIONS
            '/@('.$htmlRegexChar.')\:/s'                                        => '<?php $1 ?>',

            '/\+\[symbol\?\?at\]\+/'                                            => '@',
            '/\+\[symbol\?\?static\]\+/'                                        => '::',
            '/\+\[symbol\?\?colon\]\+/'                                         => ':',

            // COMMENTS
            '/\{\-\-\s*('.$htmlRegexChar.')\s*\-\-\}/s'                         => '<!--$1-->',

            // HTMLENTITES PRINT
            '/\{\{\{\s*('.$htmlRegexChar.')\s*\}\}\}/s'                         => '<?php echo htmlentities($1) ?>',

            // PRINT
            '/\{\{(\s*'.$htmlRegexChar.')\s*\}\}/s'                             => '<?php echo $1 ?>',

            // PHP TAGS
            '/\{\[\s*('.$htmlRegexChar.')\s*\]\}/s'                             => '<?php $1 ?>',

            // HTML TAGS
            '/\s+\#\#(\w+)/'                                                    => $htmlTagClose,
            '/'.$htmlAttributesTag.'\:/'                                        => '<$1 $3>',
            '/'.$htmlAttributesTag.'\s+/'                                       => '<$1 $3>',
            '/'.$htmlAttributesTag.'\s*\(\s*(.*?)\s*\)\:/s'                     => '<$1 $3>$4'.$htmlTagClose,
            '/'.$htmlAttributesTag.'\s*/'                                       => '<$1 $3>',
            '/\<(\w+)\s+\>/'                                                    => '<$1>',
            '/\+\[symbol\?\?dies\]\+/'                                          => '#'
        ];

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
}
