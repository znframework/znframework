<?php namespace ZN\Helpers;

use Config, Folder, File, Date, User;

class InternalLogger implements InternalLoggerInterface
{
    //--------------------------------------------------------------------------------------------------------
    //
    // Author     : Ozan UYKUN <ozanbote@gmail.com>
    // Site       : www.znframework.com
    // License    : The MIT License
    // Copyright  : (c) 2012-2016, znframework.com
    //
    //--------------------------------------------------------------------------------------------------------

    //--------------------------------------------------------------------------------------------------
    // notice()
    //--------------------------------------------------------------------------------------------------
    //
    // @param string $message
    // @param string $time
    //
    // @return bool
    //
    //--------------------------------------------------------------------------------------------------
    public function notice(String $message, String $time = NULL)
	{
		return $this->report(__FUNCTION__, $message, NULL, $time);
	}

    //--------------------------------------------------------------------------------------------------
    // emergency()
    //--------------------------------------------------------------------------------------------------
    //
    // @param string $message
    // @param string $time
    //
    // @return bool
    //
    //--------------------------------------------------------------------------------------------------
    public function emergency(String $message, String $time = NULL)
	{
		return $this->report(__FUNCTION__, $message, NULL, $time);
	}

    //--------------------------------------------------------------------------------------------------
    // alert()
    //--------------------------------------------------------------------------------------------------
    //
    // @param string $message
    // @param string $time
    //
    // @return bool
    //
    //--------------------------------------------------------------------------------------------------
    public function alert(String $message, String $time = NULL)
	{
		return $this->report(__FUNCTION__, $message, NULL, $time);
	}

    //--------------------------------------------------------------------------------------------------
    // error()
    //--------------------------------------------------------------------------------------------------
    //
    // @param string $message
    // @param string $time
    //
    // @return bool
    //
    //--------------------------------------------------------------------------------------------------
    public function error(String $message, String $time = NULL)
	{
		return $this->report(__FUNCTION__, $message, NULL, $time);
	}

    //--------------------------------------------------------------------------------------------------
    // warning()
    //--------------------------------------------------------------------------------------------------
    //
    // @param string $message
    // @param string $time
    //
    // @return bool
    //
    //--------------------------------------------------------------------------------------------------
    public function warning(String $message, String $time = NULL)
	{
		return $this->report(__FUNCTION__, $message, NULL, $time);
	}

    //--------------------------------------------------------------------------------------------------
    // critical()
    //--------------------------------------------------------------------------------------------------
    //
    // @param string $message
    // @param string $time
    //
    // @return bool
    //
    //--------------------------------------------------------------------------------------------------
    public function critical(String $message, String $time = NULL)
	{
		return $this->report(__FUNCTION__, $message, NULL, $time);
	}

    //--------------------------------------------------------------------------------------------------
    // info()
    //--------------------------------------------------------------------------------------------------
    //
    // @param string $message
    // @param string $time
    //
    // @return bool
    //
    //--------------------------------------------------------------------------------------------------
    public function info(String $message, String $time = NULL)
	{
		return 	$this->report(__FUNCTION__, $message, NULL, $time);
	}

    //--------------------------------------------------------------------------------------------------
    // debug()
    //--------------------------------------------------------------------------------------------------
    //
    // @param string $message
    // @param string $time
    //
    // @return bool
    //
    //--------------------------------------------------------------------------------------------------
    public function debug(String $message, String $time = NULL)
	{
		return $this->report(__FUNCTION__, $message, NULL, $time);
	}

    //--------------------------------------------------------------------------------------------------
    // report()
    //--------------------------------------------------------------------------------------------------
    //
    // @param string $subject
    // @param string $message
    // @param string $destination
    // @param string $time
    //
    // @return bool
    //
    //--------------------------------------------------------------------------------------------------
    function report(String $subject, String $message, String $destination = NULL, String $time = NULL) : Bool
    {
        if( ! Config::get('Project', 'log')['createFile'] )
        {
            return false;
        }

        if( empty($destination) )
        {
            $destination = str_replace(' ', '-', $subject);
        }

        $logDir    = STORAGE_DIR.'Logs/';
        $extension = '.log';

        if( ! is_dir($logDir) )
        {
            Folder::create($logDir, 0755);
        }

        if( is_file($logDir.suffix($destination, $extension)) )
        {
            if( empty($time) )
            {
                $time = Config::get('Project', 'log')['fileTime'];
            }

            $createDate = File::createDate($logDir.suffix($destination, $extension), 'd.m.Y');
            $endDate    = strtotime("$time", strtotime($createDate));
            $endDate    = date('Y.m.d', $endDate);

            if( date('Y.m.d')  >  $endDate )
            {
                File::delete($logDir.suffix($destination, $extension));
            }
        }

        $message = 'IP: ' . User::ip().
                   ' | Subject: ' . $subject.
                   ' | Date: '.Date::set('{dayNumber0}.{monthNumber0}.{year} {H024}:{minute}:{second}').
                   ' | Message: ' . $message . EOL;

        return error_log($message, 3, $logDir.suffix($destination, $extension));
    }
}
