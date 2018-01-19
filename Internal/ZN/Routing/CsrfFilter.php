<?php namespace ZN\Routing;
/**
 * ZN PHP Web Framework
 * 
 * "Simplicity is the ultimate sophistication." ~ Da Vinci
 * 
 * @package ZN
 * @license MIT [http://opensource.org/licenses/MIT]
 * @author  Ozan UYKUN [ozan@znframework.com]
 */

use ZN\Security;

class CsrfFilter
{
    public function __construct($filters, $get, $config)
    {
        $redirect = $filters['redirects'][CURRENT_CFURI]['redirect'] ?? $config['requestMethods']['page'];

        Security::CSRFToken($redirect, $get);
    }
}
