<?php namespace ZN\FileSystem\Exception;

use GeneralException;

class FileRemoteDownloadException extends GeneralException
{
    public function __construct($file)
    {
        parent::__construct(\Lang::select('Exception', 'fileRemoteDownload', $file));
    }
}
