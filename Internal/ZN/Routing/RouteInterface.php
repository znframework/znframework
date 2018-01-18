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

interface RouteInterface
{
    /**
     * Route Show404
     * 
     * @param string $controllerAndMethod
     */
    public function show404(String $controllerAndMethod);

    /**
     * Container
     * 
     * @param callable $callback
     */
    public function container(Callable $callback);

    /**
     * Restore
     * 
     * @param string|array $ips
     * @param string       $uri = NULL
     * 
     * @return Route
     */
    public function restore($ips, String $uri = NULL) : Route;

    /**
     * Cache
     * 
     * @param string|int  $time     = 60
     * @param string|bool $compress = false
     * @param string      $driver   = 'file'
     * 
     * @return Route
     */
    public function cache($time = 60, $compress = false, String $driver = 'file') : Route;

    /**
     * No Cache
     * 
     * @return Route
     */
    public function nocache() : Route;

    /**
     * CSRF
     * 
     * @param string $uri = 'post'
     * 
     * @return Route
     */
    public function CSRF(String $uri = 'post') : Route;

    /**
     * Ajax
     * 
     * @return Route
     */
    public function ajax() : Route;

    /**
     * CURL
     * 
     * @return Route
     */
    public function curl() : Route;

    /**
     * Restful
     * 
     * @return Route
     */
    public function restful() : Route;

    /**
     * Callback
     * 
     * @param callable $callback
     * 
     * @return Route
     */
    public function callback(Callable $callback) : Route;

    /**
     * Apply Filters
     */
    public function filter();

    /**
     * Sets methods
     * 
     * @param string ...$methods
     * 
     * @return Route
     */
    public function method(String ...$methods) : Route;

    /**
     * Sets redirect
     * 
     * @param string $redirect
     * 
     * @return Route
     */
    public function redirect(String $redirect) : Route;

    /**
     * Get Filters
     * 
     * @return array
     */
    public function getFilters() : Array;

    /**
     * Sets old URI
     * 
     * @param string $path   = NULL
     * @param bool   $usable = true
     */
    public function uri(String $path = NULL, Bool $usable = true);

    /**
     * Sets all route
     */
    public function all();

    /**
     * Change URI
     * 
     * @param string $route
     * 
     * @return Route
     */
    public function change(String $route) : Route;

     /**
     * Run Route Controller
     * 
     * @param string   $functionName
     * @param callable $functionRun = NULL
     * @param bool     $usable      = true
     */
    public function run(String $functionName, Callable $functionRun = NULL, Bool $usable = true);

    /**
     * Redirect Show 404
     * 
     * @param string $function
     * @param string $lang
     * @param report
     */
    public function redirectShow404(String $function, String $lang = 'callUserFuncArrayError', String $report = 'SystemCallUserFuncArrayError');
}
