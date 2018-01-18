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
    public function restore($ips, String $uri = NULL) : Route
    {
        $this->filters['restore']['ips'] = (array) $ips;
        $this->filters['restore']['uri'] = $uri;

        return $this;
    }

    /**
     * Cache
     * 
     * @param string|int  $time     = 60
     * @param string|bool $compress = false
     * @param string      $driver   = 'file'
     * 
     * @return Route
     */
    public function cache($time = 60, $compress = false, String $driver = 'file') : Route
    {
        $this->filters['cache']['time']     = $time;
        $this->filters['cache']['compress'] = $compress;
        $this->filters['cache']['driver']   = $driver;
        $this->filters['cache']['status']   = true;

        return $this;
    }

    /**
     * No Cache
     * 
     * @return Route
     */
    public function nocache() : Route
    {
        $this->filters['nocache']['status'] = false;

        return $this;
    }

    /**
     * CSRF
     * 
     * @param string $uri = 'post'
     * 
     * @return Route
     */
    public function CSRF(String $uri = 'post') : Route
    {
        $this->filters['csrf'] = $uri;

        return $this;
    }

    /**
     * Ajax
     * 
     * @return Route
     */
    public function ajax() : Route
    {
        $this->filters['ajax'] = true;

        return $this;
    }

    /**
     * CURL
     * 
     * @return Route
     */
    public function curl() : Route
    {
        $this->filters['curl'] = true;

        return $this;
    }

    /**
     * Restful
     * 
     * @return Route
     */
    public function restful() : Route
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
    public function callback(Callable $callback) : Route
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
    public function method(String ...$methods) : Route
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
    public function redirect(String $redirect) : Route
    {
        $this->filters['redirect'] = $redirect;

        return $this;
    }
}
