<?php namespace ZN\FileSystem\Exception;

use GeneralException;

class FileAllreadyException extends GeneralException
{
    public function __construct($file)
    {
        parent::__construct(\Lang::select('Exception', 'fileAllready', $file));
    }
}
