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
class_alias('ZN\Foundations\Traits\CallUndefinedMethodTrait', 'CallUndefinedMethodTrait');
class_alias('ZN\Foundations\Traits\ConfigMethodTrait', 'ConfigMethodTrait');
class_alias('ZN\Foundations\Traits\ConfigMethodInterface', 'ConfigMethodInterface');
class_alias('ZN\Foundations\Traits\DriverMethodTrait', 'DriverMethodTrait');
class_alias('ZN\Foundations\Traits\DriverMethodInterface', 'DriverMethodInterface');
class_alias('ZN\Foundations\Traits\ErrorControlTrait', 'ErrorControlTrait');
class_alias('ZN\Foundations\Traits\ErrorControlInterface', 'ErrorControlInterface');
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