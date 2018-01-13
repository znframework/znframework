<?php namespace ZN\Services\Exception;
/**
 * ZN PHP Web Framework
 * 
 * "Simplicity is the ultimate sophistication." ~ Da Vinci
 * 
 * @package ZN
 * @license MIT [http://opensource.org/licenses/MIT]
 * @author  Ozan UYKUN [ozan@znframework.com]
 */

class FailureSendEmailException extends IOException
{
    const lang = 
    [
        'tr' => 'PHP Sendmail kullanarak e-posta göndermek için açılamıyor! Sunucunuz bu yöntemi kullanarak posta göndermek için yapılandırılmamış olabilir!',
        'en' => 'Unable to send email using PHP Sendmail! Your server might not be configured to send mail using this method!'
    ];
}
