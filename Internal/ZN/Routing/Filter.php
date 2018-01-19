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

use ZN\Response;

class Filter
{
    private $config;
    private $filters;

    /**
     * Magic Constructor
     * 
     * @param string $filter
     * @param array  $filters
     * @param array  $config
     */
    public function __construct(String $filter, Array $filters, Array $config)
    {
        $this->config  = $config;
        $this->filters = $filters;
        
        $getFilter = $filters[$filter . 's'] ?? NULL;
        
        if( ! empty($getFilter) )
        {
            $get = $getFilter[CURRENT_CFURI][$filter] ?? NULL;

            if( $get !== NULL )
            {
                $class = 'ZN\Routing\\' . ucfirst($filter) . 'Filter';

                if( class_exists($class) )
                {       
                    new $class($filters, $get, $config, $this);
                }        
            }
        }
    }

    /**
     * Protected Redirect Invalid Request
     */
    public function redirectRequest($direct = NULL)
    {
        if( $redirect = ($this->filters['redirects'][CURRENT_CFURI]['redirect'] ?? $this->config['requestMethods']['page']) )
        {
            Response::redirect($redirect);
        }

        Response::redirectInvalidRequest();
    }
}
