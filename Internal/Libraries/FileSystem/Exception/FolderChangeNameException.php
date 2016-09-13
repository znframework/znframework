<?php namespace ZN\FileSystem\Exception;

use GeneralException;

class FolderChangeNameException extends GeneralException
{
    public function __construct($folder)
    {
        parent::__construct(lang('Exception', 'folderChangeName', $folder));
    }
}
