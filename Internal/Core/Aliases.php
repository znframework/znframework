<?php
//----------------------------------------------------------------------------------------------------
// ALIASES
//----------------------------------------------------------------------------------------------------
//
// Author     : Ozan UYKUN <ozanbote@windowslive.com> | <ozanbote@gmail.com>
// Site       : www.znframework.com
// License    : The MIT License
// Copyright  : Copyright (c) 2012-2016, ZN Framework
//
//----------------------------------------------------------------------------------------------------

//----------------------------------------------------------------------------------------------------
// Sistem Takma İsimleri
//----------------------------------------------------------------------------------------------------
class_alias('ZN\Core\Autoloader', 'Autoloader');
class_alias('ZN\Foundations\Structures\StaticAccess', 'StaticAccess');
class_alias('ZN\Foundations\Structures\Restoration', 'Restoration');
class_alias('ZN\Foundations\Extend\Model', 'Model');
class_alias('ZN\Foundations\Extend\Grand', 'Grand');
class_alias('ZN\Foundations\Extend\Controller', 'Controller');
class_alias('ZN\Foundations\Extend\BaseController', 'BaseController');
class_alias('ZN\Foundations\Extend\CallController', 'CallController');
class_alias('ZN\Foundations\Extend\Requirements', 'Requirements');
//----------------------------------------------------------------------------------------------------

//----------------------------------------------------------------------------------------------------
// Takma isimler alınıyor.
//----------------------------------------------------------------------------------------------------
$autoloaderAliases = Config::get('Autoloader')['aliases'];
//----------------------------------------------------------------------------------------------------

//----------------------------------------------------------------------------------------------------
// Takma isimler işleniyor.
//----------------------------------------------------------------------------------------------------
if( ! empty($autoloaderAliases) ) foreach( $autoloaderAliases as $alias => $origin )
{
	class_alias($origin, $alias);
}
//----------------------------------------------------------------------------------------------------