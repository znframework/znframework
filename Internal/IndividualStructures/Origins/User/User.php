<?php namespace ZN\IndividualStructures;

class User extends \FactoryController
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
            'register'           => 'User\Register::do',
            'column'             => 'User\UserExtends::column:this',
            'autologin'          => 'User\Register::autoLogin:this',
            'returnlink'         => 'User\UserExtends::returnLink:this',
            'activationcomplete' => 'User\Register::activationComplete',
            'update'             => 'User\Update::do',
            'oldpassword'        => 'User\Update::oldPassword:this',
            'newpassword'        => 'User\Update::newPassword:this',
            'passwordagain'      => 'User\Update::passwordAgain:this',
            'username'           => 'User\Login::username:this',
            'password'           => 'User\Login::password:this',
            'remember'           => 'User\Login::remember:this',
            'login'              => 'User\Login::do',
            'islogin'            => 'User\Login::is',
            'logout'             => 'User\Logout::do',
            'forgotpassword'     => 'User\ForgotPassword::do',
            'email'              => 'User\ForgotPassword::email:this',
            'data'               => 'User\Data::get',
            'activecount'        => 'User\Data::activeCount',
            'bannedcount'        => 'User\Data::bannedCount',
            'count'              => 'User\Data::count',
            'error'              => 'User\Information::error',
            'success'            => 'User\Information::success',
            'attachment'         => 'User\SendEmail::attachment:this',
            'sendemailall'       => 'User\SendEmail::send',
            'ipv4'               => 'User\IP::v4',
            'ip'                 => 'User\IP::v4',
        ]
    ];
}
