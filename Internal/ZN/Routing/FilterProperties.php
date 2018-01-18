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

class FilterProperties
{
    /**
     * Keeps Filters
     * 
     * @var array
     */
    protected $filters = [];

    /**
     * Restore
     * 
     * @param string|array $ips
     * @param string       $uri = NULL
     * 
     * @return Route
     */
    public function restore($ips, String $uri = NULL)
    {
        $this->filters['restore']['ips'] = (array) $ips;
        $this->filters['restore']['uri'] = $uri;

        return $this;
    }

    /**
     * CSRF
     * 
     * @param bool $usable = true
     * 
     * @return Route
     */
    public function usable(Bool $usable = true)
    {
        $this->filters['usable'] = $usable;

        return $this;
    }

    /**
     * CSRF
     * 
     * @param string $uri = 'post'
     * 
     * @return Route
     */
    public function CSRF(String $uri = 'post')
    {
        $this->filters['csrf'] = $uri;

        return $this;
    }

    /**
     * Ajax
     * 
     * @return Route
     */
    public function ajax()
    {
        $this->filters['ajax'] = true;

        return $this;
    }

    /**
     * CURL
     * 
     * @return Route
     */
    public function curl()
    {
        $this->filters['curl'] = true;

        return $this;
    }

    /**
     * Restful
     * 
     * @return Route
     */
    public function restful()
    {
        $this->filters['restful'] = true;

        return $this;
    }

    /**
     * Callback
     * 
     * @param callable $callback
     * 
     * @return Route
     */
    public function callback(Callable $callback)
    {
        $this->filters['callback'] = $callback;

        return $this;
    }

    /**
     * Sets methods
     * 
     * @param string ...$methods
     * 
     * @return Route
     */
    public function method(String ...$methods)
    {
        $this->filters['method'] = $methods;

        return $this;
    }

    /**
     * Sets redirect
     * 
     * @param string $redirect
     * 
     * @return Route
     */
    public function redirect(String $redirect)
    {
        $this->filters['redirect'] = $redirect;

        return $this;
    }
}
