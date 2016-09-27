<?php namespace ZN\Helpers\Converter;

use Html, Security;

class Text implements TextInterface
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
            '<a href="$1"'.Html::attributes((array) $attributes).'>'.( $type === 'short' ? '$5' : '$1').'</a>',
            $data
        );
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
        $phpFamily      = ! empty( $settings['php:family'] )    ? 'font-family:'.$settings['php:family'] : 'font-family:Consolas';
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
        $tags           =   isset( $settings['tags'] )          ? $settings['tags']  : true;

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

        $string = Security::scriptTagEncode(Security::phpTagEncode(Security::htmlDecode($string)));

        $tagArray = $tags === true
                  ? ['<div style="'.$background.'">&#60;&#63;php', '&#63;&#62;</div>']
                  : ['<div style="'.$background.'">', '</div>'];

        return str_replace(['&#60;&#63;php', '&#63;&#62;'], $tagArray, $string);
    }
}
