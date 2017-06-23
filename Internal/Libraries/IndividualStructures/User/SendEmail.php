<?php namespace ZN\IndividualStructures\User;

use DB, Email, Arrays, IS;

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
        Email::attachment($file, $disposition, $newName, $mime);

        return $this;
    }

    //--------------------------------------------------------------------------------------------------------
    // Send Email All -> 5.0.0
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $subject
    // @param string $body
    //
    //--------------------------------------------------------------------------------------------------------
    public function send(String $subject, String $body)
	{
        $columns = INDIVIDUALSTRUCTURES_USER_CONFIG['matching']['columns'];
        $table   = INDIVIDUALSTRUCTURES_USER_CONFIG['matching']['table'];
        $sender  = INDIVIDUALSTRUCTURES_USER_CONFIG['emailSenderInfo'];

        if( ! empty($columns['banned']) )
        {
        	DB::where($columns['banned'], 0);
        }

		$result    = DB::get($table)->result();
		$users     = Arrays::apportion($result, 35);
		$sendCount = count($users);

		$from = $sender['mail'];
		$name = $sender['name'];

        Email::sender($from, $name);

		for( $i = 0; $i < $sendCount; $i++ )
		{
			foreach( $users[$i] as $user )
			{
                $username = $user->{$columns['username']};

                $email = IS::email($username)
                       ? $username
                       : ($user->{$columns['email']} ?? NULL);

                if( IS::email($email) )
                {
                    Email::bcc($email, $username);
                }
			}

		   	Email::send($subject, $body);
		}
	}
}
