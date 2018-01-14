<?php namespace ZN\Database\Tests;
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

class DBUser extends UnitTest
{
    const unit =
    [
        'class'   => 'DBUser',
        'methods' =>
        [
            'name'                  => ['p1'],
            'host'                  => ['p1'],
            'password'              => ['p1'],
            'identifiedBy'          => ['p1'],
            'identifiedByPassword'  => ['p1'],
            'identifiedWith'        => ['p1', 'p2', 'p3'],
            'identifiedWithBy'      => ['p1', 'p2'],
            'identifiedWithAs'      => ['p1', 'p2'],
            'required'              => [],
            'with'                  => [],
            'option'                => ['p1', 'p2'],
            'encode'                => ['p1', 'p2', 'p3'],
            'resource'              => ['p1', 0],
            'passwordExpire'        => ['p1', 0],
            'lock'                  => ['p1'],
            'unlock'                => ['p1'],
            'type'                  => ['p1'],
            'select'                => ['p1'],
            'grantOption'           => [],
            'alter'                 => ['p1'],
            'create'                => ['p1'],
            'drop'                  => ['p1'],
            'grant'                 => ['p1', 'p2', 'p3'],
            'revoke'                => ['p1', 'p2', 'p3'],
            'rename'                => ['p1', 'p2'],
            'setPassword'           => ['p1', 'p2']
        ]
    ];
}
