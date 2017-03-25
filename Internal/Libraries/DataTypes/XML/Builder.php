<?php namespace ZN\DataTypes\XML;

use Html;

class Builder implements BuilderInterface
{
    //--------------------------------------------------------------------------------------------------------
    // Version
    //--------------------------------------------------------------------------------------------------------
    //
    // @var string
    //
    //--------------------------------------------------------------------------------------------------------
    protected $version  = '1.0';

    //--------------------------------------------------------------------------------------------------------
    // Encoding
    //--------------------------------------------------------------------------------------------------------
    //
    // @var string
    //
    //--------------------------------------------------------------------------------------------------------
    protected $encoding = 'UTF-8';

    //--------------------------------------------------------------------------------------------------------
    // Version
    //--------------------------------------------------------------------------------------------------------
    //
    // Genel Kullanım: Bir XML belgesinin versiyonunu oluşturur.
    //
    // @param  string   $version -> 1.0
    // @return this
    //
    //--------------------------------------------------------------------------------------------------------
    public function version(String $version = '1.0') : Builder
    {
        $this->version = $version;

        return $this;
    }

    //--------------------------------------------------------------------------------------------------------
    // Encoding
    //--------------------------------------------------------------------------------------------------------
    //
    // Genel Kullanım: Bir XML belgesinin kodlama türünü belirtir.
    //
    // @param  string   $encoding -> UTF-8
    // @return this
    //
    //--------------------------------------------------------------------------------------------------------
    public function encoding(String $encoding = 'UTF-8') : Builder
    {
        $this->encoding = $encoding;

        return $this;
    }

    //--------------------------------------------------------------------------------------------------------
    // Build
    //--------------------------------------------------------------------------------------------------------
    //
    // @param array  $data
    // @param string $version
    // @param string $encoding
    //
    //--------------------------------------------------------------------------------------------------------
    public function do(Array $data, String $version = NULL, String $encoding = NULL) : String
    {
        if( ! empty($version) )  $this->version  = $version;
        if( ! empty($encoding) ) $this->encoding = $encoding;

        $xml  ='<?xml version="'.$this->version.'" encoding="'.$this->encoding.'"?>'.EOL;
        $xml .= $this->_document($data, '', 0);

        return $xml;
    }

    //--------------------------------------------------------------------------------------------------------
    // Protected Document
    //--------------------------------------------------------------------------------------------------------
    // Genel Kullanım: Bir XML belgesi oluşturur.
    //
    //--------------------------------------------------------------------------------------------------------
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
            $attr    = $data['attr']    ?? '';
            $content = $data['content'] ?? '';
            $child   = $data['child']   ?? '';

            $output .= "$tab<$name".Html::attributes($attr).">";

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
