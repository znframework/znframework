<?php
$autoloaderAliases = Config::get('Autoloader')['aliases'];

foreach( $autoloaderAliases as $alias => $origin )
{
	class_alias($origin, $alias);
}