<?php namespace ZN\DataTypes;
/**
 * ZN PHP Web Framework
 * 
 * "Simplicity is the ultimate sophistication." ~ Da Vinci
 * 
 * @package ZN
 * @license MIT [http://opensource.org/licenses/MIT]
 * @author  Ozan UYKUN [ozan@znframework.com]
 */

use ZN\Helper;
use ZN\Controller\Factory;
use ZN\Ability\Functionalization;

class Strings extends Factory
{
    use Functionalization;

    const factory =
    [
        'methods' =>
        [
            'mtrim'            => 'Strings\Trim::middle',
            'trimslashes'      => 'Strings\Trim::slashes',
            'casing'           => 'Strings\Casing::use',
            'lowercase'        => 'Strings\Casing::lower',
            'uppercase'        => 'Strings\Casing::upper',
            'titlecase'        => 'Strings\Casing::title',
            'pascalcase'       => 'Strings\Casing::pascal',
            'camelcase'        => 'Strings\Casing::camel',
            'underscorecase'   => 'Strings\Casing::underscore',
            'search'           => 'Strings\Search::use',
            'searchposition'   => 'Strings\Search::position',
            'searchstring'     => 'Strings\Search::string',
            'reshuffle'        => 'Strings\Substitution::reshuffle',
            'placement'        => 'Strings\Substitution::placement',
            'replace'          => 'Strings\Substitution::replace',
            'addslashes'       => 'Strings\Security::addSlashes',
            'removeslashes'    => 'Strings\Security::removeSlashes',
            'section'          => 'Strings\Section::use',
            'splituppercase'   => 'Strings\Split::upperCase',
            'apportion'        => 'Strings\Split::apportion',
            'divide'           => 'Strings\Split::divide',
            'removeelement'    => 'Strings\Element::remove',
            'removefirst'      => 'Strings\Element::removeFirst',
            'removelast'       => 'Strings\Element::removeLast',
        ]
    ];

    /**
     * Functionalization
     * 
     * @var array
     */
    const functionalization = 
    [
        'repeat' => 'str_repeat',
        'length' => 'mb_strlen'
    ];

    /**
     * String to Array
     * 
     * @param string $string
     * @param string $split = ' '
     * 
     * @return array
     */
    public static function toArray(String $string, String $split = ' ')
    {
        if( empty($split) )
        {
            return str_split($string, 1);
        }

        return explode($split, $string);
    }

    /**
     * Pad
     * 
     * @param string $string
     * @param int    $count = 1
     * @param string $chars = ' '
     * @param string $type  = 'right' - options[right|left|both]
     * 
     * @return string
     */
    public static function pad(String $string, Int $count = 1, String $chars = ' ', String $type = 'right') : String
    {
        return str_pad($string, $count, $chars, Helper::toConstant($type, 'STR_PAD_'));
    }

    /**
     * Recurrent Count
     * 
     * @param string $str
     * @param string $char
     * 
     * @return int
     */
    public static function recurrentCount(String $str, String $char) : Int
    {
        return count(explode($char, $str)) - 1;
    }
}
