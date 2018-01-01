<?php namespace ZN\IndividualStructures\User;
/**
 * ZN PHP Web Framework
 * 
 * "Simplicity is the ultimate sophistication." ~ Da Vinci
 * 
 * @package ZN
 * @license MIT [http://opensource.org/licenses/MIT]
 * @author  Ozan UYKUN [ozan@znframework.com]
 */

use ZN\IndividualStructures\IS;

class SendEmail extends UserExtends
{
    //--------------------------------------------------------------------------------------------------------
    // Attachment ->5.0.0
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $file
    // @param string $disposition
    // @param string $newName
    // @param mixed  $mime
    //
    //--------------------------------------------------------------------------------------------------------
    public function attachment(String $file, String $disposition = NULL, String $newName = NULL, $mime = NULL)
    {
        \Email::attachment($file, $disposition, $newName, $mime);

        return $this;
    }

    //--------------------------------------------------------------------------------------------------------
    // Send Email All -> 5.0.0|5.3.6[edited]
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $subject
    // @param string $body
    // @param int    $count = 35
    //
    //--------------------------------------------------------------------------------------------------------
    public function send(String $subject, String $body, Int $count = 35)
	{
        $columns = INDIVIDUALSTRUCTURES_USER_CONFIG['matching']['columns'];
        $table   = INDIVIDUALSTRUCTURES_USER_CONFIG['matching']['table'];
        $sender  = INDIVIDUALSTRUCTURES_USER_CONFIG['emailSenderInfo'];

        if( ! empty($columns['banned']) )
        {
        	\DB::where($columns['banned'], 0);
        }

        $usernamecol = $columns['username'];
        $emailcol    = $columns['email'];

        if( empty($usernamecol) )
        {
            return false;
        }

        $result    = \DB::get($table)->result();              
		$users     = array_chunk($result, $count);
		$sendCount = count($users);

		$from = $sender['mail'];
		$name = $sender['name'];

        \Email::sender($from, $name);

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
                    \Email::bcc($email, $username);
                }
			}

		   	\Email::send($subject, $body);
		}
	}
}
