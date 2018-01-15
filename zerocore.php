<?php
/**
 * ZN PHP Web Framework
 * 
 * "Simplicity is the ultimate sophistication." ~ Da Vinci
 * 
 * @package ZN
 * @license MIT [http://opensource.org/licenses/MIT]
 * @author  Ozan UYKUN [ozan@znframework.com]
 */

/*
|--------------------------------------------------------------------------
| Autoloader
|--------------------------------------------------------------------------
|
| ZN Framework uses its own autoloader system, unlike other 
| implementations. In this system, the libraries are written to 
| Config/ClassMap.php file. Subsequent calls are made from this file.
|
*/

require ZEROCORE . 'Autoloader.php';

/*
|--------------------------------------------------------------------------
| Autoload Register
|--------------------------------------------------------------------------
|
| Enables class loading by automatically activating the object call.
|
*/

ZN\Autoloader::register();

/*
|--------------------------------------------------------------------------
| Autoloader Constant Definitions
|--------------------------------------------------------------------------
|
| Defines constants required for system and user.
|
*/


ZN\Autoloader::defines('5.6.0', 'Nikola Tesla');

/*
|--------------------------------------------------------------------------
| Top Layer
|--------------------------------------------------------------------------
|
| The code to be written to this layer runs before the system files are 
| loaded. For this reason, you can not use ZN libraries.
|
*/

ZN\Base::layer('Top');

/*
|--------------------------------------------------------------------------
| Top Bottom Layer
|--------------------------------------------------------------------------
|
| You can use system constants and libraries in this layer since the code 
| to write to this layer is used immediately after the auto loader. 
| All Config files can be configured on this layer since this layer runs 
| immediately after the auto installer.
|
*/

ZN\Base::layer('TopBottom');

/*
|--------------------------------------------------------------------------
| Strucutre Constants
|--------------------------------------------------------------------------
|
| Provides data about the current working url.
|
*/

ZN\Structure::defines();