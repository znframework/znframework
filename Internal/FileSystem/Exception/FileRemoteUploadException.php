<?php namespace ZN\FileSystem\Exception;

use GeneralException;
use ZN\IndividualStructures\Lang;

class FileRemoteUploadException extends GeneralException
{
    public function __construct($file)
    {
        parent::__construct(Lang::select('Exception', 'fileRemoteUpload', $file));
    }
}
