<?php namespace ZN\ViewObjects\Exception;

class PermissionRoleIdException extends \GeneralException
{
    const lang = 
    [
        'tr'        => 'Bu kullanım için # tanımlaması yapınız!',
        'en'        => 'Do the # definition for this use!',
        'placement' => 
        [
            '#' => 'Permission::roleId()'
        ]
    ];
}