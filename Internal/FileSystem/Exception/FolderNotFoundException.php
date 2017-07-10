<?php namespace ZN\FileSystem\Exception;

use GeneralException;

class FolderNotFoundException extends GeneralException
{
    public function __construct($folder)
    {
        parent::__construct(lang('Exception', 'folderNotFound', $folder));
    }
}
