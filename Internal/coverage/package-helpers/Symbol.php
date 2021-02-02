<?php namespace ZN\Helpers;
/**
 * ZN PHP Web Framework
 * 
 * "Simplicity is the ultimate sophistication." ~ Da Vinci
 * 
 * @package ZN
 * @license MIT [http://opensource.org/licenses/MIT]
 * @author  Ozan UYKUN [ozan@znframework.com]
 */

use ZN\Config;

class Symbol
{
    /**
     * Magic Call
     * 
     * @param string $method
     * @param array  $parameters
     * 
     * @return string|false
     */
    public function __call($method, $parameters)
    {
        return $this->symbols[$method] ?? false;
    }

    /**
     * Magic Constructor
     */
    public function __construct()
    {
        $this->symbols = array_merge(Config::get('Expressions', 'symbols'), $this->symbols);
    }

    /**
     * Keeps Symbols
     * 
     * @var array
     */
    public $symbols =
    [
        'copyright'             => '&copy;',        //©
        'register'              => '&#174;',        //®
        'euro'                  => '&#8364;',       //€
        'dolar'                 => '$',             //$
        'usd'                   => '$',             //$
        'rightDoubleArrow'      => '&#187;',        //»
        'leftDoubleArrow'       => '&#171;',        //«
        'invertQuestion'        => '&#191;',        //¿
        'tradeMark'             => '&#8482;',       //™
        'turkishLira'           => '&#x20BA;',      //t
        'cent'                  => '&#162;',        //¢
        'yen'                   => '&#165;',        //¥
        'pound'                 => '&#163;',        //£
        'currency'              => '&#164;',        //¤
        'division'              => '&#247;',        //÷
        'minus'                 => '&#177;',        //±
        'micro'                 => '&#181;',        //µ
        'degree'                => '&#176;',        //°
        'section'               => '&#167;',        //§
        'bigSlash'              => '&#216;',        //Ø
        'smallSlash'            => '&#248;',        //ø
        'permil'                => '&permil;',      //‰
        'tilde'                 => '&#126;',        //~
        'spade'                 => '&spades;',      //♠
        'club'                  => '&clubs;',       //♣
        'heart'                 => '&hearts;',      //♥
        'diam'                  => '&diams;',       //♦
        'at'                    => '&#64;',         //@
        'function'              => '&fnof;',        //ƒ
        'product'               => '&prod;',        //∏
        'equivalent '           => '&equiv;',       //≡
        'partial'               => '&part;',        //∂
        'integral'              => '&int;',         //∫
        'infinity'              => '&infin;',       //∞
        'squareRoot'            => '&radic;',       //√
        'approximately'         => '&asymp;',       //≈
        'notEquals'             => '&ne;',          //≠
        'triangle'              => '&there4;',      //∴
        'greaterEquals'         => '&ge;',          //≥
        'lessEquals'            => '&le;',          //≤
        'paragraph'             => '&para;',        //¶
        'bigDote'               => '&bull;',        //•
        'midDote'               => '&middot;',      //·
        'dagger'                => '&dagger;',      //†
        'doubleDagger'          => '&Dagger;',      //‡
        'diamond'               => '&loz;',         //◊
        'upArrow'               => '&uarr;',        //↑
        'downArrow'             => '&darr;',        //↓
        'leftArrow'             => '&larr;',        //←
        'rightArrow'            => '&rarr;',        //→
        'doubleHeadedArrow'     => '&harr;',        //↔
        'notSymbol'             => '&not;'          //¬
    ];
}
