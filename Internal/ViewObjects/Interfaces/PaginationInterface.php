<?php namespace ZN\ViewObjects;
/**
 * ZN PHP Web Framework
 * 
 * "Simplicity is the ultimate sophistication." ~ Da Vinci
 * 
 * @package ZN
 * @license MIT [http://opensource.org/licenses/MIT]
 * @author  Ozan UYKUN [ozan@znframework.com]
 */

interface PaginationInterface
{
    /**
     * Specifies the URL.
     * 
     * @param string $url
     * 
     * @return Pagination
     */
    public function url(String $url) : Pagination;
    
    /**
     * Sets the paging initial value.
     * 
     * @param mixed $start
     * 
     * @return Pagination
     */
    public function start($start) : Pagination;

    /**
     * Sets the amount of data to be displayed at one time.
     * 
     * @param int $limit
     * 
     * @return Pagination
     */
    public function limit(Int $limit) : Pagination;

    /**
     * Pagination usage type.
     * If you select Ajax, ajax needs to be written. 
     * Several data are defined for this.
     * 
     * @param string $type - options[ajax|classic]
     */
    public function type(String $type) : Pagination;

    /**
     * Sets the total number of records.
     * 
     * @param int $totalRows
     * 
     * @return Pagination
     */
    public function totalRows(Int $totalRows) : Pagination;

    /**
     * Sets the number of page links to be displayed at one time.
     * 
     * @param int $countLinks
     * 
     * @return Pagination
     */
    public function countLinks(Int $countLinks) : Pagination;

    /**
     * Change the names of links.
     * 
     * @param string $prev
     * @param string $next
     * @param string $first
     * @param string $last
     * 
     * @return Pagination
     */
    public function linkNames(String $prev, String $next, String $first, String $last) : Pagination;

    /**
     * Sets paging's css values.
     * 
     * @param array $css
     * 
     * @return Pagination
     */
    public function css(Array $css) : Pagination;

    /**
     * Sets paging's style values.
     * 
     * @param array $style
     * 
     * @return Pagination
     */
    public function style(Array $style) : Pagination;

    /**
     * Returns the current URL for paging.
     * 
     * @param string $page = NULL
     * 
     * @return string
     */
    public function getURI(String $page = NULL) : String;

    /**
     * Configures all settings of the page.
     * 
     * @param array $cofig = []
     * 
     * @return Pagination
     */
    public function settings(Array $config = []) : Pagination;

    /**
     * Creates the pagination.
     * 
     * @param mixed $start
     * @param array $settings = []
     * 
     * @return string
     */
    public function create($start, Array $settings = []) : String;
}
