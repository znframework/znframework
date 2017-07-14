<?php namespace ZN\FileSystem\Exception;

use GeneralException;

class FolderAllreadyException extends GeneralException
{
    public function __construct($folder)
    {
        parent::__construct(\Lang::select('Exception', 'folderAllready', $folder));
    }
}
