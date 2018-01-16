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

use ZN\IS;
use ZN\Singleton;

class SendEmail extends UserExtends
{
    /**
     * Magic construct
     * 
     * @param void
     * 
     * @return void
     */
    public function __construct()
    {
        parent::__construct();

        $this->emailClass = Singleton::class('ZN\Email\Sender');
    }
    
    /**
     * Attachment
     * 
     * @param string $file
     * @param string $disposition = NULL
     * @param string $newName     = NULL
     * @param mixed  $mime        = NULL
     * 
     * @return SendEmail
     */
    public function attachment(String $file, String $disposition = NULL, String $newName = NULL, $mime = NULL)
    {
        $this->emailClass->attachment($file, $disposition, $newName, $mime);

        return $this;
    }

    /**
     * Send
     * 
     * @param string $subject
     * @param string $body
     * @param int    $count = 35
     * 
     * @return void
     */
    public function send(String $subject, String $body, Int $count = 35)
	{
        $columns = $this->getConfig['matching']['columns'];
        $table   = $this->getConfig['matching']['table'];
        $sender  = $this->getConfig['emailSenderInfo'];

        if( ! empty($columns['banned']) )
        {
        	$this->dbClass->where($columns['banned'], 0);
        }

        $usernamecol = $columns['username'];
        $emailcol    = $columns['email'];

        if( empty($usernamecol) )
        {
            return false;
        }

        $result    = $this->dbClass->get($table)->result();              
		$users     = array_chunk($result, $count);
		$sendCount = count($users);

		$from  = $sender['mail'];
		$name  = $sender['name'];

        $this->emailClass->sender($from, $name);

		for( $i = 0; $i < $sendCount; $i++ )
		{
			foreach( $users[$i] as $user )
			{
                $username = $user->$usernamecol;

                $email = IS::email($username)
                       ? $username
                       : ($user->$emailcol ?? NULL);

                if( IS::email($email) )
                {
                    $this->emailClass->bcc($email, $username);
                }
			}

            $this->emailClass->send($subject, $body);
		}
	}
}
