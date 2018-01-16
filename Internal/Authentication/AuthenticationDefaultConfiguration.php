<?php namespace ZN\Authentication;
/**
 * ZN PHP Web Framework
 * 
 * "Simplicity is the ultimate sophistication." ~ Da Vinci
 * 
 * @package ZN
 * @license MIT [http://opensource.org/licenses/MIT]
 * @author  Ozan UYKUN [ozan@znframework.com]
 */

/**
 * Default Cookie Configuration
 * 
 * Enabled when the configuration file can not be accessed.
 */
class AuthenticationDefaultConfiguration
{
    /*
    |--------------------------------------------------------------------------
    | User
    |--------------------------------------------------------------------------
    |
    | Includes configurations for the User library.
    |
    | encode: When the user is registered in, the algorithm to encrypt the 
    | password is set.
    |
    | matching: It specifies which tables and columns the User class will use.
    |
    | joining: This setting is used if the users table consists of joined 
    | tables.
    |
    | emailSenderInfo: This is to specify the sender name and email 
    | information of the e-mail to be sent during the activation process or 
    | password forgotten operations.
    |
    */

    public $encode   = 'super';
    public $matching =
    [
        'table'   => '',
        'columns' =>
        [
            'username'     => '', # Required
            'password'     => '', # Required
            'email'        => '', # Relative
            'active'       => '', # Relative
            'banned'       => '', # Relative
            'activation'   => '', # Relative
            'verification' => '', # Rleative
            'otherLogin'   => []  # Relative
        ]
    ];
    public $joining =
    [
        'column' => '',
        'tables' => []
    ];
    public $emailSenderInfo =
    [
        'name' => '',
        'mail' => ''
    ];
}
