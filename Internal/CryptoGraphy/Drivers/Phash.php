<?php namespace ZN\CryptoGraphy\Drivers;
/**
 * ZN PHP Web Framework
 * 
 * "Simplicity is the ultimate sophistication." ~ Da Vinci
 * 
 * @package ZN
 * @license MIT [http://opensource.org/licenses/MIT]
 * @author  Ozan UYKUN [ozan@znframework.com]
 */

use ZN\CryptoGraphy\CryptoMapping;
use ZN\ErrorHandling\Errors;
use ZN\IndividualStructures\IS;
use ZN\CryptoGraphy\Exception\InvalidVersionException;

class PhashDriver extends CryptoMapping
{
	/**
     * Magic constructor
     * 
     * @param void
     * 
     * @return void
     */
	public function __construct()
	{
		if( ! IS::phpVersion('5.5') )
		{
			throw new InvalidVersionException();
		}

        parent::__construct();
	}

	/**
     * Generates a random password.
     * 
     * @param int $length
     * 
     * @return string
     */
	public function keygen($length)
	{
		return mb_substr(password_hash(PROJECT_CONFIG['key'], PASSWORD_BCRYPT), -$length);
	}
}
