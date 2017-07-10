<?php namespace ZN\FileSystem\Exception;

use GeneralException;

class FileNotFoundException extends GeneralException
{
    public function __construct($file)
    {
        parent::__construct(lang('Exception', 'fileNotFound', $file));
    }
}
