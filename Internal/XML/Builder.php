<?php namespace ZN\XML;
/**
 * ZN PHP Web Framework
 * 
 * "Simplicity is the ultimate sophistication." ~ Da Vinci
 * 
 * @package ZN
 * @license MIT [http://opensource.org/licenses/MIT]
 * @author  Ozan UYKUN [ozan@znframework.com]
 */

use ZN\Singleton;

class Builder
{
    /**
     * Keeps version
     * 
     * @var string
     */
    protected $version  = '1.0';

    /**
     * Keeps encoding
     * 
     * @var string
     */
    protected $encoding = 'UTF-8';

    /**
     * Creates the version of the query XML document.
     * 
     * @param string $version = '1.0'
     * 
     * @return Builder
     */
    public function version(String $version = '1.0') : Builder
    {
        $this->version = $version;

        return $this;
    }

    /**
     * Specifies the encoding of an XML document.
     * 
     * @param string $encoding = 'UTF-8'
     * 
     * @return Builder
     */
    public function encoding(String $encoding = 'UTF-8') : Builder
    {
        $this->encoding = $encoding;

        return $this;
    }

    /**
     * Build XML document.
     * 
     * @param array  $data
     * @param string $version  = NULL
     * @param string $encoding = NULL
     * 
     * @return string
     */
    public function do(Array $data, String $version = NULL, String $encoding = NULL) : String
    {
        if( ! empty($version) )  $this->version  = $version;
        if( ! empty($encoding) ) $this->encoding = $encoding;

        $xml  ='<?xml version="'.$this->version.'" encoding="'.$this->encoding.'"?>'.EOL;
        $xml .= $this->_document($data, '', 0);

        return $xml;
    }

    /**
     * Creates an XML document.
     * 
     * @param string $xml   = ''
     * @param string $tab   = ''
     * @param string $start = 0
     * 
     * @return string
     */
    protected function _document($xml = '', $tab = '', $start = 0)
    {
        static $start;

        $eof     = EOL;
        $output  = '';
        $tab     = str_repeat("\t", $start);

        if( ! isset($xml[0]) )
        {
            $xml = [$xml];
            $start = 0;
        }

        foreach( $xml as $data )
        {
            $name    = $data['name']    ?? '';
            $attr    = $data['attr']    ?? [];
            $content = $data['content'] ?? '';
            $child   = $data['child']   ?? '';

            $output .= "$tab<$name".Singleton::class('ZN\Hypertext\Html')->attributes($attr).">";

            if( ! empty($content) )
            {
                $output .= $content;
            }
            else
            {
                if( ! empty($child) )
                {
                    $output .= $eof.$this->_document($child, $tab, $start++).$tab;
                }
                else
                {
                    $output .= $content;
                }
            }

            $output .= "</".$name.">".$eof;
        }

        return $output;
    }
}
