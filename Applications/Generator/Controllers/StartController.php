<?php
class StartController extends Controller
{	
	public function main($params = '')
	{	
		$generatorConfig = Config::get('Generator');
		
		if( $generatorConfig['status'] === false || ! in_array(ipv4(), $generatorConfig['machinesIP']) )
		{
			die(getErrorMessage('Generator', 'permissionDenied'));
		}
	}	
}