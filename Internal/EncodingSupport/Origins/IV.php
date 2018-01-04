<?php namespace ZN\EncodingSupport;
/**
 * ZN PHP Web Framework
 * 
 * "Simplicity is the ultimate sophistication." ~ Da Vinci
 * 
 * @package ZN
 * @license MIT [http://opensource.org/licenses/MIT]
 * @author  Ozan UYKUN [ozan@znframework.com]
 */

use ZN\IndividualStructures\IS;
use ZN\EncodingSupport\Exception\InvalidArgumentException;
use ZN\DataTypes\Arrays;

class IV implements IVInterface
{
    protected $mimeErrors = ['strict' => ICONV_MIME_DECODE_STRICT, 'continue' => ICONV_MIME_DECODE_CONTINUE_ON_ERROR];

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
        $toEncodingFirst = Arrays\GetElement::first(explode('//', $toEncoding));

        if( ! IS::charset($fromEncoding) || ! IS::charset($toEncodingFirst) )
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

        if( ! IS::charset($charset) )
        {
            throw new InvalidArgumentException('Error', 'charsetParameter', '2.($charset)');
        }

        return iconv_set_encoding($type . '_encoding', $charset);
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
    public function mimesDecode(String $encodedHeaders, $mode = 0, String $charset = NULL) : Array
    {
        return iconv_mime_decode_headers
        (
            $encodedHeaders,
            $this->mimeErrors[$mode] ?? $mode,
            $charset ?? ini_get("iconv.internal_encoding")
        );
    }

    //--------------------------------------------------------------------------------------------------------
    // Mime Decode
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $encodedHeader
    // @param mixed  $mode: 0, 1, 2, continue, strict
    // @param string $charset
    //
    //--------------------------------------------------------------------------------------------------------
    public function mimeDecode(String $encodedHeader, $mode = 0, String $charset = NULL) : String
    {
        return iconv_mime_decode
        (
            $encodedHeader,
            $this->mimeErrors[$mode] ?? $mode,
            $charset ?? ini_get("iconv.internal_encoding")
        );
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
