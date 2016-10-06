<?php namespace ZN\EncodingSupport;

use Strings, Converter, CallController;
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
    public function split(string $string, string $pattern, int $limit = -1) : array
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
    public function search(string $str, string $needle, string $type = 'string', bool $case = true) : string
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
    public function section(string $str, int $starting = 0, int $count = NULL, string $encoding = 'UTF-8') : string
    {
        if( ! isCharset($encoding) )
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
    public function parseGet(string $string) : array
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
    public function checkEncoding(string $string = NULL, string $encoding = 'UTF-8') : bool
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
    public function casing(string $string, string $flag = 'upper', string $encoding = 'UTF-8') : string
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
    public function convertEncoding(string $string, string $toEncoding = 'UTF-8', string $fromEncoding = 'ASCII, UTF-8') : string
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
    public function mimeDecode(string $string) : string
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
    public function mimeEncode(string $string, string $encoding = 'UTF-8', string $transferEncoding = 'B', string $crlf = "\r\n", int $indent = 0) : string
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
    public function htmlToNumeric(string $string, array $convertMap = NULL, string $encoding = 'UTF-8') : string
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
    public function numericToHtml(string $string, array $convertMap = NULL, string $encoding = 'UTF-8') : string
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
    public function detectEncoding(string $string, $encodingList = ['ASCII', 'UTF-8'], bool $strict = false) : string
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
    public function encodingAliases(string $string) : array
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
    public function info(string $string = 'all')
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
    public function httpInput(string $type = 'I')
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
    public function httpOutput(string $encoding = 'UTF-8')
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
    public function lang(string $lang = 'neutral')
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
    public function encodings() : array
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
    public function outputHandler(string $contents, int $status = 0) : string
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
    public function preferredMimeName(string $encoding = 'UTF-8') : string
    {
        return mb_preferred_mime_name($encoding);
    }
}
