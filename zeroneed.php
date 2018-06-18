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
| Require Core File
|--------------------------------------------------------------------------
|
| It includes the necessary things for the operation of the system.
|
*/

require __DIR__ . '/vendor/autoload.php';

/*
|--------------------------------------------------------------------------
| Run ZN
|--------------------------------------------------------------------------
|
| Simplicity is our principle. Enjoy it.
|
*/

ZN\ZN::run('EIP', '5.7.7.1', 'Vecihi Hürkuş');
