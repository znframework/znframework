<?php namespace ZN\FileSystem;

class InternalFile extends \FactoryController implements InternalFileInterface
{
    //--------------------------------------------------------------------------------------------------------
    //
    // Author     : Ozan UYKUN <ozanbote@gmail.com>
    // Site       : www.znframework.com
    // License    : The MIT License
    // Telif Hakkı: Copyright (c) 2012-2016, znframework.com
    //
    //--------------------------------------------------------------------------------------------------------

    const factory =
    [
        'methods' =>
        [
            'settings'      => 'File\Transfer::settings:this',
            'upload'        => 'File\Transfer::upload',
            'download'      => 'File\Transfer::download',
            'exists'        => 'File\Info::exists',
            'available'     => 'File\Info::available',
            'executable'    => 'File\Info::executable',
            'writable'      => 'File\Info::writable',
            'writeable'     => 'File\Info::writeable',
            'readable'      => 'File\Info::readable',
            'uploaded'      => 'File\Info::uploaded',
            'info'          => 'File\Info::get',
            'size'          => 'File\Info::size',
            'createdate'    => 'File\Info::createDate',
            'changedate'    => 'File\Info::changeDate',
            'owner'         => 'File\Info::owner',
            'group'         => 'File\Info::group',
            'rowcount'      => 'File\Info::rowCount',
            'read'          => 'File\Content::read',
            'contents'      => 'File\Content::read',
            'find'          => 'File\Content::find',
            'write'         => 'File\Content::write',
            'append'        => 'File\Content::append',
            'generate'      => 'File\Forge::generate',
            'create'        => 'File\Forge::create',
            'replace'       => 'File\Forge::replace',
            'delete'        => 'File\Forge::delete',
            'zipextract'    => 'File\Forge::zipExtract',
            'createzip'     => 'File\Forge::createZip',
            'rename'        => 'File\Forge::rename',
            'cleancache'    => 'File\Forge::cleanCache',
            'truncate'      => 'File\Forge::truncate',
            'require'       => 'File\Loader::require',
            'requireonce'   => 'File\Loader::requireOnce',
            'include'       => 'File\Loader::include',
            'includeonce'   => 'File\Loader::includeOnce',
        ]
    ];

}
