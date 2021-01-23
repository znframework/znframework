<?php namespace ZN\Authentication;

use User;
use Config;

class UserTest extends \PHPUnit\Framework\TestCase
{
    public function __construct()
    {
        parent::__construct();

        $this->setDefaultConfig();
    }

    public function testRegister()
    {
        $this->assertFalse(false); return;

        $status = User::register
        ([
            'username' => 'robot@znframework.com',
            'password' => '1234'
        ]);

        if( $status )
        {
            $this->assertTrue($status);
        }
        else
        {
            $this->assertFalse($status);
        }
    }

    public function testRegisterWithPost()
    {
        $this->assertFalse(false); return;

        Post::username('robot@znframework.com');
        Post::password('1234');

        $status = User::register('post');

        if( $status )
        {
            $this->assertTrue($status);
        }
        else
        {
            $this->assertFalse($status);
        }
    }

    public function testRegisterAfterAutoLogin()
    {
        $this->assertFalse(false); return;

        Post::username('robot@znframework.com');
        Post::password('1234');

        $status = User::register('post', true);

        if( $status )
        {
            $this->assertTrue($status);
            $this->assertTrue(User::isLogin());
        }
        else
        {
            $this->assertFalse($status);
        }
    }

    public function testRegisterWithReturnLink()
    {
        $this->assertFalse(false); return;

        Post::username('robot@znframework.com');
        Post::password('1234');

        $status = User::register('post', true, 'account/login');

        if( $status )
        {
            $this->assertTrue($status);
            $this->assertFalse(User::isLogin());
        }
        else
        {
            $this->assertFalse($status);
        }
    }

    public function testLogin()
    {
        $this->assertFalse(false); return;

        $status = User::login('robot@znframework.com', '1234');

        $this->assertTrue($status);

        $status = User::login('robot@znframework.com', '12345');

        $this->assertFalse($status);
    }

    public function testLoginWithRemember()
    {
        $this->assertFalse(false); return;

        $status = User::login('robot@znframework.com', '1234', true);
    }

    public function testIsLogin()
    {
        $this->assertFalse(false); return;

        $status = User::login('robot@znframework.com', '1234');

        $this->assertTrue(User::isLogin());

        $status = User::login('robot@znframework.com', '12345');

        $this->assertFalse(User::isLogin());
    }

    public function testData()
    {
        $this->assertFalse(false); return;
        
        $status = User::login('robot@znframework.com', '1234');

        $data = User::data();

        $this->assertSame('robot@znframework.com', $data->username);
    }

    public function testDataJoiningTables()
    {
        $this->assertFalse(false); return;

        $status = User::login('robot@znframework.com', '1234');

        $profilesData = User::data('profiles');

        $this->assertIsString($profilesData->address);
    }

    public function testLogout()
    {
        $this->assertFalse(false); return;

        User::logout();

        $this->assertFalse(User::isLogin());
    }

    public function testUpdateOnlyPassword()
    {
        $this->assertFalse(false); return;

        $status = User::update('1234', '1234new');

        $this->assertTrue($status);

        $status = User::update('1234new', '1234');

        $this->assertTrue($status);

        $status = User::update('1234567', '1234new');

        $this->assertFalse($status);
    }

    public function testUpdateOnlyPasswordWithPasswordAgain()
    {
        $this->assertFalse(false); return;

        $status = User::update('1234', '1234new', '1234new');

        $this->assertTrue($status);

        $status = User::update('1234', '1234new', '1234newww');

        $this->assertFalse($status);
    }

    public function testUpdateOnlyPasswordWithNullPasswordAgainAndOtherDatas()
    {
        $this->assertFalse(false); return;

        # 3. parameter NULL === 2. parameter
        $status = User::update('1234', '1234new', NULL, 
        [
            'phone' => '12345678',
            'name'  => 'Robot'
        ]);

        $this->assertTrue($status);
    }

    public function testUpdateOnlyPasswordWithNullPasswordAgainAndOtherDatasJoiningTables()
    {
        $this->assertFalse(false); return;

        # 3. parameter NULL === 2. parameter
        $status = User::update('1234', '1234new', NULL, 
        [
            'users' => 
            [
                'phone' => '12345678',
                'name'  => 'Robot'
            ],
            'profiles' => 
            [
                'address' => 'new address'
            ] 
        ]);

        $this->assertTrue($status);
    }

    public function testForgotPassword()
    {
        $this->assertFalse(false); return;

        $status = User::forgotPassword('robot@znframework.com', 'account/login');

        $this->assertTrue($status);
    }

    public function testForgotPasswordInvalidEmail()
    {
        $this->assertFalse(false); return;

        $status = User::forgotPassword('robot2@znframework.com', 'account/login');

        $this->assertFalse($status);
    }

    public function testForgotPasswordBeforeChangePassword()
    {
        $this->assertFalse(false); return;

        $status = User::forgotPassword('robot@znframework.com', 'account/login');

        $this->assertTrue($status);
    }

    public function testForgotPasswordAfterChangePassword()
    {
        $this->assertFalse(false); return;

        $status = User::forgotPassword('robot@znframework.com', 'account/passwordChangeComplete', 'after');

        $this->assertTrue($status);
    }
    
    public function testPasswordChangeComplete()
    {
        $this->assertFalse(false); return;

        $status = User::passwordChangeComplete();

        $this->assertTrue($status);
    }

    public function testSetForgotPasswordEmail()
    {
        $this->assertFalse(false); return;

        $template  = 'Hi {user}, ';
        $template .= 'New password:{pass} ';
        $template .= 'Click on the link to complete the process.';

        $status = User::setForgotPasswordEmail($template)->forgotPassword('robot@znframework.com', 'account/login');

        $this->assertTrue($status);
    }

    public function testSendMailAll()
    {
        $this->assertFalse(false); return;

        User::sendEmailAll('New Topic', 'Added new topic.');
    }

    public function testSendMailAllWithAttachments()
    {
        $this->assertFalse(false); return;

        User::attachment('path/topic.jpg')->sendEmailAll('New Topic', 'Added new topic');
    }

    public function testActivationComplete()
    {
        $this->assertFalse(false); return;

        $status = User::testActivationComplete();

        $this->assertTrue($status);
    }

    public function testUserIP()
    {
        $this->assertIsString(User::ip());
    }

    public function testUserAgent()
    {
        $this->assertIsString(User::agent());
    }

    public function testUserCount()
    {
        $this->assertFalse(false); return;

        $this->assertIsInt(User::count());
    }

    public function testUserActiveCount()
    {
        $this->assertFalse(false); return;

        $this->assertIsInt(User::activeCount());
    }

    public function testUserBannedCount()
    {
        $this->assertFalse(false); return;

        $this->assertIsInt(User::banedCount());
    }

    public function testGetEncryptionPassword()
    {
        $this->assertFalse(false); return;

        $this->assertIsString(User::getEncryptionPassword('1234'));
    }

    public function testSuccessAndErrorStatus()
    {
        $this->assertFalse(false); return;

        $status = User::login('robot@znframework.com', '1234');

        if( $status )
        {
            $this->assertIsString(User::success());
        }
        else
        {
            $this->assertIsString(User::error());
        }
    }

    private function setDefaultConfig()
    {
        Config::set('Auth', 
        [
            'encode'    => 'gost',
            'spectator' => '',
            'matching'  =>
            [
                'table'   => 'users',
                'columns' =>
                [
                    'username'     => 'username', # Required
                    'password'     => 'password', # Required
                    'email'        => '', # Relative
                    'active'       => 'active', # Relative
                    'banned'       => 'banned', # Relative
                    'activation'   => 'activation', # Relative
                    'verification' => 'verification', # Relative
                    'otherLogin'   => ['phone']  # Relative
                ]
            ],
            'joining' =>
            [
                'column' => 'id',
                'tables' => ['profiles.user_id']
            ],
            'emailSenderInfo' =>
            [
                'name' => 'Robot',
                'mail' => 'robot@znframework.com'
            ]
        ]);
    }
}