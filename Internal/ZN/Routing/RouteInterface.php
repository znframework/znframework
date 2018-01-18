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
    public function restore($ips, String $uri = NULL);

    /**
     * CSRF
     * 
     * @param bool $usable = true
     * 
     * @return Route
     */
    public function usable(Bool $usable = true);

    /**
     * CSRF
     * 
     * @param string $uri = 'post'
     * 
     * @return Route
     */
    public function CSRF(String $uri = 'post');

    /**
     * Ajax
     * 
     * @return Route
     */
    public function ajax();

    /**
     * CURL
     * 
     * @return Route
     */
    public function curl();

    /**
     * Restful
     * 
     * @return Route
     */
    public function restful();

    /**
     * Callback
     * 
     * @param callable $callback
     * 
     * @return Route
     */
    public function callback(Callable $callback);

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
    public function method(String ...$methods);

    /**
     * Sets redirect
     * 
     * @param string $redirect
     * 
     * @return Route
     */
    public function redirect(String $redirect);

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
