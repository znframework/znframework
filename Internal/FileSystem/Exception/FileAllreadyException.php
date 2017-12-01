<?php namespace ZN\FileSystem\Exception;

use GeneralException;
use ZN\IndividualStructures\Lang;

class FileAllreadyException extends GeneralException
{
    public function __construct($file)
    {
        parent::__construct(Lang::select('Exception', 'fileAllready', $file));
    }
}
