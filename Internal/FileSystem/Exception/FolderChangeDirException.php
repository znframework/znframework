<?php namespace ZN\FileSystem\Exception;

use GeneralException;

class FolderChangeDirException extends GeneralException
{
    public function __construct($folder)
    {
        parent::__construct(lang('Exception', 'folderChangeDir', $folder));
    }
}
