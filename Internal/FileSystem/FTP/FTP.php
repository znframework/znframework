<?php namespace ZN\FileSystem;

class FTP extends \FactoryController
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
