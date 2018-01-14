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

use ZN\Controller\Factory;

class User extends Factory
{
    const factory =
    [
        'methods' =>
        [
            'register'              => 'Register::do',
            'column'                => 'UserExtends::column:this',
            'autologin'             => 'Register::autoLogin:this',
            'returnlink'            => 'UserExtends::returnLink:this',
            'activationcomplete'    => 'Register::activationComplete',
            'resendactivationemail' => 'Register::resendActivationEmail',
            'update'                => 'Update::do',
            'oldpassword'           => 'Update::oldPassword:this',
            'newpassword'           => 'Update::newPassword:this',
            'passwordagain'         => 'Update::passwordAgain:this',
            'username'              => 'Login::username:this',
            'password'              => 'Login::password:this',
            'remember'              => 'Login::remember:this',
            'login'                 => 'Login::do',
            'islogin'               => 'Login::is',
            'logout'                => 'Logout::do',
            'forgotpassword'        => 'ForgotPassword::do',
            'verification'          => 'ForgotPassword::verification:this',
            'email'                 => 'ForgotPassword::email:this',
            'data'                  => 'Data::get',
            'activecount'           => 'Data::activeCount',
            'bannedcount'           => 'Data::bannedCount',
            'count'                 => 'Data::count',
            'error'                 => 'Information::error',
            'success'               => 'Information::success',
            'attachment'            => 'SendEmail::attachment:this',
            'sendemailall'          => 'SendEmail::send',
            'ipv4'                  => 'IP::v4',
            'ip'                    => 'IP::v4'
        ]
    ];
}
