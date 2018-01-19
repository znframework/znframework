<?php namespace ZN\Email\Exception;
/**
 * ZN PHP Web Framework
 * 
 * "Simplicity is the ultimate sophistication." ~ Da Vinci
 * 
 * @package ZN
 * @license MIT [http://opensource.org/licenses/MIT]
 * @author  Ozan UYKUN [ozan@znframework.com]
 */

use ZN\Ability\Exclusion;

class SMTPConnectException extends IOException
{
    use Exclusion;

    const lang = 
    [
        'en' => 'The following SMTP error was encountered: %',
        'tr' => 'Aşağıdaki SMTP hatası ile karşılaşıldı: %'
    ];
}
