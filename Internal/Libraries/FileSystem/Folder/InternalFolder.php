<?php namespace ZN\FileSystem;

class InternalFolder extends \FactoryController implements InternalFolderInterface
{
    //--------------------------------------------------------------------------------------------------------
    //
    // Author     : Ozan UYKUN <ozanbote@gmail.com>
    // Site       : www.znframework.com
    // License    : The MIT License
    // Copyright  : (c) 2012-2016, znframework.com
    //
    //--------------------------------------------------------------------------------------------------------

    const factory =
    [
        'methods' =>
        [
            'exists'      => 'Folder\Info::exists',
            'fileinfo'    => 'Folder\Info::fileInfo',
            'basepath'    => 'Folder\Info::basePath',
            'disk'        => 'Folder\Info::disk',
            'totalspace'  => 'Folder\Info::totalSpace',
            'freespace'   => 'Folder\Info::freeSpace',
            'disk'        => 'Folder\Info::disk',
            'create'      => 'Folder\Forge::create',
            'rename'      => 'Folder\Forge::rename',
            'deleteempty' => 'Folder\Forge::deleteEmpty',
            'delete'      => 'Folder\Forge::delete',
            'copy'        => 'Folder\Forge::copy',
            'change'      => 'Folder\Forge::change',
            'permission'  => 'Folder\Forge::permission',
            'files'       => 'Folder\FileList::files',
            'allfiles'    => 'Folder\FileList::allFiles'
        ]
    ];
}
