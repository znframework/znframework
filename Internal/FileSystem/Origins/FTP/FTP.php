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

class FTP extends \FactoryController
{
    const factory =
    [
        'methods' =>
        [
            'differentconnection' => 'FTP\Connection::do',
            'createfolder'        => 'FTP\Forge::createFolder',
            'deletefolder'        => 'FTP\Forge::deleteFolder',
            'changefolder'        => 'FTP\Forge::changeFolder',
            'rename'              => 'FTP\Forge::rename',
            'deletefile'          => 'FTP\Forge::deleteFile',
            'permission'          => 'FTP\Forge::permission',
            'upload'              => 'FTP\Transfer::upload',
            'download'            => 'FTP\Transfer::download',
            'files'               => 'FTP\Info::files',
            'filesize'            => 'FTP\Info::fileSize'
        ]
    ];
}
