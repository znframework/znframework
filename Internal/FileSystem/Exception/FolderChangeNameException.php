<?php namespace ZN\FileSystem\Exception;

use GeneralException;

class FolderChangeNameException extends GeneralException
{
    public function __construct($folder)
    {
        parent::__construct(\Lang::select('Exception', 'folderChangeName', $folder));
    }
}
