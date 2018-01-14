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

class File extends Factory
{
    const factory =
    [
        'methods' =>
        [   
            'copy'            => 'Forge::copyFolder',
            'settings'        => 'Transfer::settings',
            'upload'          => 'Transfer::upload',
            'download'        => 'Transfer::download',
            'exists'          => 'Info::exists',
            'originpath'      => 'Info::originpath',
            'relativepath'    => 'Info::relativepath',
            'absolutepath'    => 'Info::absolutepath',
            'available'       => 'Info::available',
            'executable'      => 'Info::executable',
            'writable'        => 'Info::writable',
            'writeable'       => 'Info::writeable',
            'readable'        => 'Info::readable',
            'uploaded'        => 'Info::uploaded',
            'access'          => 'Info::access:this',
            'rpath'           => 'Info::rpath',
            'info'            => 'Info::get',
            'pathinfo'        => 'Info::pathInfo',
            'size'            => 'Info::size',
            'createdate'      => 'Info::createDate',
            'changedate'      => 'Info::changeDate',
            'owner'           => 'Info::owner',
            'group'           => 'Info::group',
            'rowcount'        => 'Info::rowCount',
            'required'        => 'Info::required',
            'read'            => 'Content::read',
            'contents'        => 'Content::read',
            'find'            => 'Content::find',
            'write'           => 'Content::write',
            'append'          => 'Content::append',
            'generate'        => 'Forge::generate',
            'create'          => 'Forge::create',
            'replace'         => 'Forge::replace',
            'delete'          => 'Forge::delete',
            'zipextract'      => 'Forge::zipExtract',
            'createzip'       => 'Forge::createZip',
            'rename'          => 'Forge::rename',
            'cleancache'      => 'Forge::cleanCache',
            'truncate'        => 'Forge::truncate',
            'permission'      => 'Forge::permission',
            'require'         => 'Loader::require',
            'requireonce'     => 'Loader::requireOnce',
            'include'         => 'Loader::include',
            'includeonce'     => 'Loader::includeOnce',
            'extension'       => 'Extension::get',
            'removeextension' => 'Extension::remove'
        ]
    ];
}
