<?php namespace ZN\Filesystem;
/**
 * ZN PHP Web Framework
 * 
 * "Simplicity is the ultimate sophistication." ~ Da Vinci
 * 
 * @package ZN
 * @license MIT [http://opensource.org/licenses/MIT]
 * @author  Ozan UYKUN [ozan@znframework.com]
 */

use ZN\Controller\Factory;

class Folder extends Factory
{
    const factory =
    [
        'methods' =>
        [
            'exists'      => 'Info::existsFolder',
            'fileinfo'    => 'Info::fileInfo',
            'basepath'    => 'Info::basePath',
            'disk'        => 'Info::disk',
            'totalspace'  => 'Info::totalSpace',
            'freespace'   => 'Info::freeSpace',
            'disk'        => 'Info::disk',
            'create'      => 'Forge::createFolder',
            'rename'      => 'Forge::renameFolder',
            'deleteempty' => 'Forge::deleteEmptyFolder',
            'delete'      => 'Forge::deleteFolder',
            'copy'        => 'Forge::copy',
            'change'      => 'Forge::changeFolder',
            'permission'  => 'Forge::permission',
            'files'       => 'FileList::files',
            'allfiles'    => 'FileList::allFiles'
        ]
    ];
}
