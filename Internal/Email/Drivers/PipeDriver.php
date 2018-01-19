<?php namespace ZN\Email\Drivers;
/**
 * ZN PHP Web Framework
 * 
 * "Simplicity is the ultimate sophistication." ~ Da Vinci
 * 
 * @package ZN
 * @license MIT [http://opensource.org/licenses/MIT]
 * @author  Ozan UYKUN [ozan@znframework.com]
 */

use ZN\Lang;
use ZN\Support;
use ZN\Email\DriverMappingAbstract;
use ZN\Email\Exception\FailureSendEmailException;
use ZN\Email\Exception\IOException;

class PipeDriver extends DriverMappingAbstract
{
    /**
     * Magic Constructor
     */
    public function __construct()
    {
        Support::func('popen');
    }

    /**
     * Send Email
     * 
     * @param string $to
     * @param string $subject
     * @param string $message
     * @param mixed  $headers
     * @param mixed  $settings
     * 
     * @return bool
     */
    public function send($to, $subject, $message, $headers = NULL, $settings = [])
    {
        $returnPath = $settings['mailPath'].' -oi -f '.$settings['from'].' -t -r '.$settings['returnPath'];

        $open = @popen($returnPath, 'w');

        if( empty($open) )
        {
            throw new FailureSendEmailException();
        }

        @fputs($open, $headers);
        @fputs($open, $message);

        $status = @pclose($open);

        if( $status !== 0 )
        {
            $exceptionMessage  = Lang::select('Services', 'email:noSocket').' ';
            $exceptionMessage .= Lang::select('Services', 'email:exitStatus', $status);

            throw new IOException($exceptionMessage);
        }

        return true;
    }
}
