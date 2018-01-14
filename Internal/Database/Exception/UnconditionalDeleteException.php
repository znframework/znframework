<?php namespace ZN\Database\Exception;
/**
 * ZN PHP Web Framework
 * 
 * "Simplicity is the ultimate sophistication." ~ Da Vinci
 * 
 * @package ZN
 * @license MIT [http://opensource.org/licenses/MIT]
 * @author  Ozan UYKUN [ozan@znframework.com]
 */

use ZN\Exception;

class UnconditionalDeleteException extends Exception
{
    const lang = 
    [
        'tr' => 'Koşulsuz silme işlemi gerçekleştiremezsiniz! Lütfen where() ile koşul tanımlayın.',
        'en' => 'You can not perform unconditional deletion! Please define the condition with where ().'
    ];
}
