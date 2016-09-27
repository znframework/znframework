<?php namespace ZN\EncodingSupport;

use Arrays, CallController;
use ZN\EncodingSupport\Iconv\InvalidArgumentException;

class InternalIV extends CallController implements InternalIVInterface
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
    // Inputs
    //--------------------------------------------------------------------------------------------------------
    //
    // @var array
    //
    //--------------------------------------------------------------------------------------------------------
    protected $inputs = ['input', 'output', 'internal'];

    //--------------------------------------------------------------------------------------------------------
    // Convert
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $string
    // @param string $fromEncoding
    // @param string $toEncoding
    //
    //--------------------------------------------------------------------------------------------------------
    public function convert(String $string, String $fromEncoding, String $toEncoding) : String
    {
        $toEncodingFirst = Arrays::getFirst(explode('//', $toEncoding));

        if( ! isCharset($fromEncoding) || ! isCharset($toEncodingFirst) )
        {
            throw new InvalidArgumentException('Error', 'charsetParameter', '2.($fromEncoding) & 3.($toEncoding)');
        }

        return iconv($fromEncoding, $toEncoding, $string);
    }

    //--------------------------------------------------------------------------------------------------------
    // Encodings
    //--------------------------------------------------------------------------------------------------------
    //
    // @param void
    //
    //--------------------------------------------------------------------------------------------------------
    public function encodings() : Array
    {
        return iconv_get_encoding('all');
    }

    //--------------------------------------------------------------------------------------------------------
    // Get Encoding
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $type: input, output, internal
    //
    //--------------------------------------------------------------------------------------------------------
    public function getEncoding(String $type = 'input') : String
    {
        if( ! in_array($type, $this->inputs) )
        {
            throw new InvalidArgumentException('Error', 'invalidInput', $type);
        }

        return iconv_get_encoding($type.'_encoding');
    }

    //--------------------------------------------------------------------------------------------------------
    // Set Encoding
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $type
    // @param string $charset
    //
    //--------------------------------------------------------------------------------------------------------
    public function setEncoding(String $type = 'input', String $charset = 'utf-8') : Bool
    {
        if( ! in_array($type, $this->inputs) )
        {
            throw new InvalidArgumentException('Error', 'invalidInput', $type);
        }

        if( ! isCharset($charset) )
        {
            throw new InvalidArgumentException('Error', 'charsetParameter', '2.($charset)');
        }

        return iconv_set_encoding($type.'_encoding', $charset);
    }

    //--------------------------------------------------------------------------------------------------------
    // Mimes Decode
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $encodedHeaders
    // @param int    $mode
    // @param string $charset
    //
    //--------------------------------------------------------------------------------------------------------
    public function mimesDecode(String $encodedHeaders, Int $mode = 0, String $charset = NULL) : Array
    {
        if( $charset === NULL )
        {
            $charset = ini_get("iconv.internal_encoding");
        }

        return iconv_mime_decode_headers($encodedHeaders, $mode, $charset);
    }

    //--------------------------------------------------------------------------------------------------------
    // Mime Decode
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $encodedHeader
    // @param int    $mode
    // @param string $charset
    //
    //--------------------------------------------------------------------------------------------------------
    public function mimeDecode(String $encodedHeader, Int $mode = 0, String $charset = NULL) : String
    {
        if( $charset === NULL )
        {
            $charset = ini_get("iconv.internal_encoding");
        }

        return iconv_mime_decode($encodedHeader, $mode, $charset);
    }

    //--------------------------------------------------------------------------------------------------------
    // Mime Encode
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $fieldName
    // @param string $fieldValue
    // @param array  $preferences
    //
    //--------------------------------------------------------------------------------------------------------
    public function mimeEncode(String $fieldName, String $fieldValue, Array $preferences = NULL) : String
    {
        return iconv_mime_encode($fieldName, $fieldValue, $preferences);
    }
}
