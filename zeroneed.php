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
| Project Type
|--------------------------------------------------------------------------
|
| It shows you which framework you are using.
| SE for single edition, EIP for multi edition.
|
*/

define('PROJECT_TYPE', 'EIP');

/*
|--------------------------------------------------------------------------
| Internal Directory
|--------------------------------------------------------------------------
|
| The system directory is determined according to ZN project type.
|
*/

define('INTERNAL_DIR', 
(
    PROJECT_TYPE === 'SE' ? 'Libraries' : 'Internal') . '/'
);

/*
|--------------------------------------------------------------------------
| Requirements Directory
|--------------------------------------------------------------------------
|
| It keeps path of the files needed for the system.
|
*/

define('REQUIREMENTS_DIR', INTERNAL_DIR.'Requirements/System/');

/*
|--------------------------------------------------------------------------
| Real Base Directory Path
|--------------------------------------------------------------------------
|
| The system gives the knowledge of the actual root directory.
|
*/

define('REAL_BASE_DIR', __DIR__ . '/');

/*
|--------------------------------------------------------------------------
| Working Directory
|--------------------------------------------------------------------------
|
| Select system's working directory.
|
*/

chdir(REAL_BASE_DIR);

/*
|--------------------------------------------------------------------------
| Require Core File
|--------------------------------------------------------------------------
|
| It includes the necessary things for the operation of the system.
|
*/

require_once REAL_BASE_DIR . 'zerocore.php';

/*
|--------------------------------------------------------------------------
| Console Usage
|--------------------------------------------------------------------------
|
| If the operation is executed via console, the code flow is not continue.
|
*/

if( defined('CONSOLE_ENABLED') )
{
    return false;
}

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
