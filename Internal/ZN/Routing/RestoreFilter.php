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

use ZN\Config;
use ZN\Restoration;

class RestoreFilter
{
    public function __construct($filters, $get, $config)
    {
        $routeURI = empty($get['uri'])
                  ? $filters['redirects'][CURRENT_CFURI]['redirect'] ?? Config::get('Project', 'restoration')['routePage']
                  : $get['uri'];

        Restoration::routeURI($get['ips'], $routeURI);
    }
}
