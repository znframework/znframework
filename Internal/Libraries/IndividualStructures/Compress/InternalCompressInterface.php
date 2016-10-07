<?php namespace ZN\IndividualStructures;

interface InternalCompressInterface
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
    // Extract
    //--------------------------------------------------------------------------------------------------------
    //
    // @param  string $source
    // @param  string $target
    // @return bool
    //
    //--------------------------------------------------------------------------------------------------------
    public function extract(string $source, ? string $target = NULL, string $password = NULL) : bool;

    //--------------------------------------------------------------------------------------------------------
    // Write
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $file
    // @param string $data
    // @param string $mode
    //
    //--------------------------------------------------------------------------------------------------------
    public function write(string $file, string $data) : bool;

    //--------------------------------------------------------------------------------------------------------
    // Read
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string  $file
    // @param numeric $length
    // @param string  $type
    //
    //--------------------------------------------------------------------------------------------------------
    public function read(string $file) : string;

    //--------------------------------------------------------------------------------------------------------
    // Do
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string  $data
    // @param numeric $blockSize
    // @param mixed   $workFactor
    //
    //--------------------------------------------------------------------------------------------------------
    public function do(string $data) : string;

    //--------------------------------------------------------------------------------------------------------
    // Undo
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string  $data
    // @param numeric $small
    //
    //--------------------------------------------------------------------------------------------------------
    public function undo(string $data) : string;
}
