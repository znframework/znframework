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

class File extends \FactoryController
{
    const factory =
    [
        'methods' =>
        [
            'settings'        => 'File\Transfer::settings',
            'upload'          => 'File\Transfer::upload',
            'download'        => 'File\Transfer::download',
            'exists'          => 'File\Info::exists',
            'originpath'      => 'File\Info::originpath',
            'relativepath'    => 'File\Info::relativepath',
            'absolutepath'    => 'File\Info::absolutepath',
            'available'       => 'File\Info::available',
            'executable'      => 'File\Info::executable',
            'writable'        => 'File\Info::writable',
            'writeable'       => 'File\Info::writeable',
            'readable'        => 'File\Info::readable',
            'uploaded'        => 'File\Info::uploaded',
            'access'          => 'File\Info::access:this',
            'rpath'           => 'File\Info::rpath',
            'info'            => 'File\Info::get',
            'pathinfo'        => 'File\Info::pathInfo',
            'size'            => 'File\Info::size',
            'createdate'      => 'File\Info::createDate',
            'changedate'      => 'File\Info::changeDate',
            'owner'           => 'File\Info::owner',
            'group'           => 'File\Info::group',
            'rowcount'        => 'File\Info::rowCount',
            'required'        => 'File\Info::required',
            'read'            => 'File\Content::read',
            'contents'        => 'File\Content::read',
            'find'            => 'File\Content::find',
            'write'           => 'File\Content::write',
            'append'          => 'File\Content::append',
            'generate'        => 'File\Forge::generate',
            'create'          => 'File\Forge::create',
            'replace'         => 'File\Forge::replace',
            'delete'          => 'File\Forge::delete',
            'zipextract'      => 'File\Forge::zipExtract',
            'createzip'       => 'File\Forge::createZip',
            'rename'          => 'File\Forge::rename',
            'cleancache'      => 'File\Forge::cleanCache',
            'truncate'        => 'File\Forge::truncate',
            'permission'      => 'File\Forge::permission',
            'require'         => 'File\Loader::require',
            'requireonce'     => 'File\Loader::requireOnce',
            'include'         => 'File\Loader::include',
            'includeonce'     => 'File\Loader::includeOnce',
            'extension'       => 'File\Extension::get',
            'removeextension' => 'File\Extension::remove'
        ]
    ];
}
