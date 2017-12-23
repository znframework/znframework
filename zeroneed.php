<?php
/**
 * ZN PHP Web Framework
 * 
 * "Simplicity is the ultimate sophistication." ~ Da Vinci
 * 
 * @package ZN
 * @license MIT [http://opensource.org/licenses/MIT]
 * @author  Ozan UYKUN [ozan@znframework.com]
 * @since   2011
 */

/*
|--------------------------------------------------------------------------
| Start
|--------------------------------------------------------------------------
|
| The system starts the load time.
|
*/

define('START_BENCHMARK', microtime(true));

/*
|--------------------------------------------------------------------------
| Working Directory
|--------------------------------------------------------------------------
|
| Select system's working directory.
|
*/

chdir(realpath(__DIR__) . DIRECTORY_SEPARATOR);

/*
|--------------------------------------------------------------------------
| Require Core File
|--------------------------------------------------------------------------
|
| It includes the necessary things for the operation of the system.
|
*/

require_once 'zerocore.php';

/*
|--------------------------------------------------------------------------
| Run ZN
|--------------------------------------------------------------------------
|
| Simplicity is our principle. Enjoy it.
|
*/

ZN::run();

/*
|--------------------------------------------------------------------------
| Finish
|--------------------------------------------------------------------------
|
| The system finishes the load time.
|
*/

define('FINISH_BENCHMARK', microtime(true));

/*
|--------------------------------------------------------------------------
| Benchmark Report
|--------------------------------------------------------------------------
|
| Creates a table that calculates the operating performance of the system. 
| To open this table, follow the steps below.
|
| 1 - Go: Config/Project.php
| 2 - Do: benchmark:true
|
*/

ZN\In::benchmarkReport();
