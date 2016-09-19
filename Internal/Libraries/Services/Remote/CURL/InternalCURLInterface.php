<?php namespace ZN\Services\Remote;

interface InternalCURLInterface
{
    //--------------------------------------------------------------------------------------------------------
    //
    // Author     : Ozan UYKUN <ozanbote@gmail.com>
    // Site       : www.znframework.com
    // License    : The MIT License
    // Telif Hakkı: Copyright (c) 2012-2016, znframework.com
    //
    //--------------------------------------------------------------------------------------------------------

    //--------------------------------------------------------------------------------------------------------
    // Init
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $url
    //
    //--------------------------------------------------------------------------------------------------------
    public function init(String $url = NULL) : InternalCURL;

    //--------------------------------------------------------------------------------------------------------
    // Exec
    //--------------------------------------------------------------------------------------------------------
    //
    // @param void
    //
    //--------------------------------------------------------------------------------------------------------
    public function exec() : Bool;

    //--------------------------------------------------------------------------------------------------------
    // Escape
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $url
    //
    //--------------------------------------------------------------------------------------------------------
    public function escape(String $str) : String;

    //--------------------------------------------------------------------------------------------------------
    // Unescape
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $url
    //
    //--------------------------------------------------------------------------------------------------------
    public function unescape(String $str) : String;

    //--------------------------------------------------------------------------------------------------------
    // Info
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $opt
    //
    //--------------------------------------------------------------------------------------------------------
    public function info(String $opt);

    //--------------------------------------------------------------------------------------------------------
    // Error
    //--------------------------------------------------------------------------------------------------------
    //
    // @param void
    //
    //--------------------------------------------------------------------------------------------------------
    public function error() : String;

    //--------------------------------------------------------------------------------------------------------
    // Errno
    //--------------------------------------------------------------------------------------------------------
    //
    // @param void
    //
    //--------------------------------------------------------------------------------------------------------
    public function errno() : Int;

    //--------------------------------------------------------------------------------------------------------
    // Pause
    //--------------------------------------------------------------------------------------------------------
    //
    // @param int $bitmask
    //
    //--------------------------------------------------------------------------------------------------------
    public function pause(Int $bitmask = 0) : Int;

    //--------------------------------------------------------------------------------------------------------
    // Reset
    //--------------------------------------------------------------------------------------------------------
    //
    // @param void
    //
    //--------------------------------------------------------------------------------------------------------
    public function reset() : Bool;

    //--------------------------------------------------------------------------------------------------------
    // Option
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $options
    // @param mixed  $value
    //
    //--------------------------------------------------------------------------------------------------------
    public function option(String $options, $value) : InternalCURL;

    //--------------------------------------------------------------------------------------------------------
    // Close
    //--------------------------------------------------------------------------------------------------------
    //
    // @param void
    //
    //--------------------------------------------------------------------------------------------------------
    public function close() : Bool;

    //--------------------------------------------------------------------------------------------------------
    // Errval
    //--------------------------------------------------------------------------------------------------------
    //
    // @param int $errno
    //
    //--------------------------------------------------------------------------------------------------------
    public function errval(Int $errno = 0) : String;

    //--------------------------------------------------------------------------------------------------------
    // Version
    //--------------------------------------------------------------------------------------------------------
    //
    // @param int $errno
    //
    //--------------------------------------------------------------------------------------------------------
    public function version($data = NULL);
}