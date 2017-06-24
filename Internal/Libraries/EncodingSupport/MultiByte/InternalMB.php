<?php namespace ZN\EncodingSupport;

use Strings, Converter, CallController, IS;
use ZN\EncodingSupport\MultiByte\Exception\InvalidArgumentException;

class InternalMB extends CallController implements InternalMBInterface
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
    // Split
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $string
    // @param string $pattern
    // @param int    $limit
    //
    //--------------------------------------------------------------------------------------------------------
    public function split(String $string, String $pattern, Int $limit = -1) : Array
    {
        return mb_split($pattern, $string, $limit);
    }

    //--------------------------------------------------------------------------------------------------------
    // Split
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $str
    // @param string $needle
    // @param string $type
    // @param bool   $case
    //
    //--------------------------------------------------------------------------------------------------------
    public function search(String $str, String $needle, String $type = 'string', Bool $case = true) : String
    {
        return Strings::search($str, $needle, $type, $case);
    }

    //--------------------------------------------------------------------------------------------------------
    // Section
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $str
    // @param int    $starting
    // @param int    $count
    // @param string $encoding
    //
    //--------------------------------------------------------------------------------------------------------
    public function section(String $str, Int $starting = 0, Int $count = NULL, String $encoding = 'UTF-8') : String
    {
        if( ! IS::charset($encoding) )
        {
            throw new InvalidArgumentException('Error', 'charsetParameter', '3.($encoding)');
        }

        return Strings::section($str, $starting, $count, $encoding);
    }

    //--------------------------------------------------------------------------------------------------------
    // Parse Get
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $string
    //
    //--------------------------------------------------------------------------------------------------------
    public function parseGet(String $string) : Array
    {
        mb_parse_str($string, $result);

        return $result;
    }

    //--------------------------------------------------------------------------------------------------------
    // Check Encoding
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $string
    // @param string $encoding
    //
    //--------------------------------------------------------------------------------------------------------
    public function checkEncoding(String $string = NULL, String $encoding = 'UTF-8') : Bool
    {
        return mb_check_encoding($string, $encoding);
    }

    //--------------------------------------------------------------------------------------------------------
    // Casing
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $string
    // @param string $flag
    // @param string $encoding
    //
    //--------------------------------------------------------------------------------------------------------
    public function casing(String $string, String $flag = 'upper', String $encoding = 'UTF-8') : String
    {
        return mb_convert_case($string, Converter::toConstant($flag, 'MB_CASE_'), $encoding);
    }

    //--------------------------------------------------------------------------------------------------------
    // Convert Encoding
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $string
    // @param string $toEnoding
    // @param string $fromEncoding
    //
    //--------------------------------------------------------------------------------------------------------
    public function convertEncoding(String $string, String $toEncoding = 'UTF-8', String $fromEncoding = 'ASCII, UTF-8') : String
    {
        return mb_convert_encoding($string, $toEncoding, $fromEncoding);
    }

    //--------------------------------------------------------------------------------------------------------
    // Mime Decode
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $string
    //
    //--------------------------------------------------------------------------------------------------------
    public function mimeDecode(String $string) : String
    {
        return mb_decode_mimeheader($string);
    }

    //--------------------------------------------------------------------------------------------------------
    // Mime Encode
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $string
    // @param string $encoding
    // @param string $transferEncoding
    // @param string $crlf
    // @param int    $indent
    //
    //--------------------------------------------------------------------------------------------------------
    public function mimeEncode(String $string, String $encoding = 'UTF-8', String $transferEncoding = 'B', String $crlf = "\r\n", Int $indent = 0) : String
    {
        return mb_encode_mimeheader($string, $encoding, $transferEncoding, $crlf, $indent);
    }

    //--------------------------------------------------------------------------------------------------------
    // Html To Numeric
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $string
    // @param array  $convertMap
    // @param string $encoding
    //
    //--------------------------------------------------------------------------------------------------------
    public function htmlToNumeric(String $string, Array $convertMap = NULL, String $encoding = 'UTF-8') : String
    {
        return mb_decode_numericentity($string, (array) $convertMap, $encoding);
    }

    //--------------------------------------------------------------------------------------------------------
    // Numeric To Html
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $string
    // @param array  $convertMap
    // @param string $encoding
    //
    //--------------------------------------------------------------------------------------------------------
    public function numericToHtml(String $string, Array $convertMap = NULL, String $encoding = 'UTF-8') : String
    {
        return mb_encode_numericentity($string, $convertMap, $encoding);
    }

    //--------------------------------------------------------------------------------------------------------
    // Detect Encoding
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $string
    // @param mixed  $encodingList
    // @param bool   $strict
    //
    //--------------------------------------------------------------------------------------------------------
    public function detectEncoding(String $string, $encodingList = ['ASCII', 'UTF-8'], Bool $strict = false) : String
    {
        return mb_detect_encoding($string, $encodingList, $strict);
    }

    //--------------------------------------------------------------------------------------------------------
    // Detect Order
    //--------------------------------------------------------------------------------------------------------
    //
    // @param  mixed  $encodingList
    // @return mixed
    //
    //--------------------------------------------------------------------------------------------------------
    public function detectOrder($encodingList = ['ASCII', 'UTF-8'])
    {
        return mb_detect_order($encodingList);
    }

    //--------------------------------------------------------------------------------------------------------
    // Encoding Aliases
    //--------------------------------------------------------------------------------------------------------
    //
    // @param  mixed  $encodingList
    //
    //--------------------------------------------------------------------------------------------------------
    public function encodingAliases(String $string) : Array
    {
        return mb_encoding_aliases($string);
    }

    //--------------------------------------------------------------------------------------------------------
    // Info
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $string
    //
    //--------------------------------------------------------------------------------------------------------
    public function info(String $string = 'all')
    {
        return mb_get_info($string);
    }

    //--------------------------------------------------------------------------------------------------------
    // Http Input
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $type
    //
    //--------------------------------------------------------------------------------------------------------
    public function httpInput(String $type = 'I')
    {
        return mb_http_input($type);
    }

    //--------------------------------------------------------------------------------------------------------
    // Http Output
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $encoding
    //
    //--------------------------------------------------------------------------------------------------------
    public function httpOutput(String $encoding = 'UTF-8')
    {
        return mb_http_output($encoding);
    }

    //--------------------------------------------------------------------------------------------------------
    // Lang
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $lang
    //
    //--------------------------------------------------------------------------------------------------------
    public function lang(String $lang = 'neutral')
    {
        return mb_language($lang);
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
        return mb_list_encodings();
    }

    //--------------------------------------------------------------------------------------------------------
    // Output Handler
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $contents
    // @param int    $status
    //
    //--------------------------------------------------------------------------------------------------------
    public function outputHandler(String $contents, Int $status = 0) : String
    {
        return mb_output_handler($contents, $status);
    }

    //--------------------------------------------------------------------------------------------------------
    // Preferred Mime Name
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $encoding
    //
    //--------------------------------------------------------------------------------------------------------
    public function preferredMimeName(String $encoding = 'UTF-8') : String
    {
        return mb_preferred_mime_name($encoding);
    }
}
