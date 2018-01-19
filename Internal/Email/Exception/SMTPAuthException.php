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

class SMTPAuthException extends \InvalidArgumentException
{
    use Exclusion;

    const lang = 
    [
        'en' => 'Failed to authenticate username! %',
        'tr' => 'Kullanıcı adı kimliği doğrulanamadı! %'
    ];
}
