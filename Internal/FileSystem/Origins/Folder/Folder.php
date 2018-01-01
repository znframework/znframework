<?php namespace ZN\FileSystem;
/**
 * ZN PHP Web Framework
 * 
 * "Simplicity is the ultimate sophistication." ~ Da Vinci
 * 
 * @package ZN
 * @license MIT [http://opensource.org/licenses/MIT]
 * @author  Ozan UYKUN [ozan@znframework.com]
 */

class Folder extends \FactoryController
{
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
