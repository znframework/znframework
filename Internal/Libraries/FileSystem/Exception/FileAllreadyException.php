<?php namespace ZN\FileSystem\Exception;

use GeneralException;

class FileAllreadyException extends GeneralException
{
    public function __construct($file)
    {
        parent::__construct(lang('Exception', 'fileAllready', $file));
    }
}
