<?php namespace ZN\Database;
/**
 * ZN PHP Web Framework
 * 
 * "Simplicity is the ultimate sophistication." ~ Da Vinci
 * 
 * @package ZN
 * @license MIT [http://opensource.org/licenses/MIT]
 * @author  Ozan UYKUN [ozan@znframework.com]
 */

interface MigrationInterface
{
    /**
     * Up all migrations
     * 
     * @param string ...$migrations
     * 
     * @return bool
     */
    public function upAll(String ...$migrations) : Bool;

    /**
     * Down all migrations
     * 
     * @param string ...$migrations
     * 
     * @return bool
     */
    public function downAll(String ...$migrations) : Bool;

    /**
     * Create table
     * 
     * @param array $data
     * 
     * @return bool
     */
    public function createTable(Array $data) : Bool;

    /**
     * Drop table
     * 
     * @param void
     * 
     * @return bool
     */
    public function dropTable() : Bool;

    /**
     * Add column
     * 
     * @param array $column
     * 
     * @return bool
     */
    public function addColumn(Array $columns) : Bool;

    /**
     * Drop column
     * 
     * @param mixed $column
     * 
     * @return bool
     */
    public function dropColumn($columns) : Bool;

    /**
     * Modify column
     * 
     * @param array $column
     * 
     * @param bool
     */
    public function modifyColumn(Array $columns) : Bool;

    /**
     * Rename column
     * 
     * @param array $column
     * 
     * @return bool
     */
    public function renameColumn(Array $column) : Bool;

    /**
     * Truncate table
     * 
     * @param void
     * 
     * @return bool
     */
    public function truncate() : Bool;

    /**
     * Sets migration path
     * 
     * @param string $path = NULL
     * 
     * @return Migration
     */
    public function path(String $path) : Migration;

    /**
     * Selects migration version
     * 
     * @param int $version = 0
     * 
     * @return object
     */
    public function version(Int $version = 0);

    /**
     * Create migration
     * 
     * @param string $name
     * @param int    $version = 0
     * 
     * @return bool
     */
    public function create(String $name, Int $ver = 0) : Bool;

    /**
     * Delete migration
     * 
     * @param string $name
     * @param int    $version = 0
     * 
     * @return bool
     */
    public function delete(String $name, Int $ver = 0) : Bool;

    /**
     * Delete all migrations
     * 
     * @param void
     * 
     * @return bool
     */
    public function deleteAll() : Bool;
}
