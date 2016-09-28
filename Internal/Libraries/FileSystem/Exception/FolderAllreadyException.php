<?php namespace ZN\FileSystem\Exception;

use GeneralException;

class FolderAllreadyException extends GeneralException
{
    public function __construct($folder)
    {
        parent::__construct(lang('Exception', 'folderAllready', $folder));
    }
}
