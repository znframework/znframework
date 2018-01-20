<?php namespace ZN\Filesystem;
/**
 * ZN PHP Web Framework
 * 
 * "Simplicity is the ultimate sophistication." ~ Da Vinci
 * 
 * @package ZN
 * @license MIT [http://opensource.org/licenses/MIT]
 * @author  Ozan UYKUN [ozan@znframework.com]
 */

interface UploadInterface
{
    /**
     * Settings
     * 
     * @param array $settings = []
     * 
     * @return Upload
     */
    public function settings(Array $settings = []) : Upload;

    /**
     * Sets extensions
     * 
     * @param string ...$args
     * 
     * @return Upload
     */
    public function extensions(...$args) : Upload;

    /**
     * Sets mimes
     * 
     * @param string ...$args
     * 
     * @return Upload
     */
    public function mimes(...$args) : Upload;

    /**
     * Sets convert name
     * 
     * @param bool $convert = true
     * 
     * @return Upload
     */
    public function convertName(Bool $convert = true) : Upload;

    /**
     * Defines encode type
     * 
     * @param string $hash = 'md5'
     * 
     * @return Upload
     */
    public function encode(String $hash = 'md5') : Upload;

    /**
     * Sets prefix
     * 
     * @param string $prefix
     * 
     * @return Upload
     */
    public function prefix(String $prefix) : Upload;

    /**
     * Sets maxsize
     * 
     * @param int $maxsize = 0
     * 
     * @return Upload
     */
    public function maxsize(Int $maxsize = 0) : Upload;

    /**
     * Sets encode length
     * 
     * @param int $encodeLength = 8
     * 
     * @return Upload
     */
    public function encodeLength(Int $encodeLength = 8) : Upload;

    /**
     * Sets target
     * 
     * @param string $target
     * 
     * @return Upload
     */
    public function target(String $target) : Upload;

    /**
     * Sets source
     * 
     * @param string $source = 'upload'
     * 
     * @return Upload
     */
    public function source(String $source = 'upload') : Upload;

    /**
     * Start file upload
     * 
     * @param string $fileName = 'upload'
     * @param string $rootDir  = NULL
     * 
     * @return bool
     */
    public  function start(String $fileName = 'upload', String $rootDir = NULL) : Bool;

    /**
     * Gets info
     * 
     * @param string $info = NULL
     * 
     * @return object|false
     */
    public function info(String $info = NULL);

    /**
     * Gets error
     * 
     * @return string|false
     */
    public function error();
}
