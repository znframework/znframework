<?php namespace ZN\FileSystem\Exception;

use GeneralException;
use ZN\IndividualStructures\Lang;

class FolderChangeDirException extends GeneralException
{
    public function __construct($folder)
    {
        parent::__construct(Lang::select('Exception', 'folderChangeDir', $folder));
    }
}
