<?php
//--------------------------------------------------------------------------------------------------
// This file automatically created and updated
//--------------------------------------------------------------------------------------------------

class URL extends StaticAccess
{
	const SCHEME = PHP_URL_SCHEME;

	const HOST = PHP_URL_HOST;

	const PORT = PHP_URL_PORT;

	const USER = PHP_URL_USER;

	const PASS = PHP_URL_PASS;

	const PATH = PHP_URL_PATH;

	const QUERY = PHP_URL_QUERY;

	const FRAGMENT = PHP_URL_FRAGMENT;

	const RFC1738 = PHP_QUERY_RFC1738;

	const RFC3986 = PHP_QUERY_RFC3986;

	public static function getClassName()
	{
		return __CLASS__;
	}
}

//--------------------------------------------------------------------------------------------------