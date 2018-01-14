<?php namespace ZN\Validation\Tests;
/**
 * ZN PHP Web Framework
 * 
 * "Simplicity is the ultimate sophistication." ~ Da Vinci
 * 
 * @package ZN
 * @license MIT [http://opensource.org/licenses/MIT]
 * @author  Ozan UYKUN [ozan@znframework.com]
 */

use ZN\Controller\UnitTest;

class Validator extends UnitTest
{
    const unit =
    [
        'class'   => 'Validator',
        'methods' => 
        [
            'between'           => [4, 4, 8],
            'betweenBoth'       => [4, 4, 8],
            'phone'             => ['123', '***'],
            'numeric'           => [10],
            'alnum'             => ['abc123'],
            'alpha'             => ['abc'],
            'identity'          => ['12312312312'],
            'email'             => ['example@example.com'],
            'url'               => ['http://www.znframework.com'],
            'specialChar'       => ['½$'],
            'maxchar'           => ['data', 5],
            'minchar'           => ['data', 2]
        ]
    ];
}
