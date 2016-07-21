<?php
class ControllerGenerator extends Controller
{	
    public function main($params = '')
    {	
		$applicationFolders = Folder::files(APPLICATIONS_DIR, 'dir');
	
		$applications[] 	= 'Select Application';
		
		foreach( $applicationFolders as $app )
		{
			$applications[APPLICATIONS_DIR.$app] = $app;
		}
		
		$success = '';
		$error   = '';
		
		if( Method::post('generate') )
		{
			$application = Method::post('application');
			$controller  = Method::post('controller');
			$functions    = explode(',', Method::post('functions'));
			
			Validation::rules('controller', ['required', 'alnum'], 'Controller');
			Validation::rules('functions', ['required'], 'Functions');
			
			if( ! $error = Validation::error('string') )
			{
				$controllerFile = $application.'/Controllers/'.suffix($controller, '.php');
				
				if( ! is_file($controllerFile) )
				{
					$classContent = Import::template('Controller', 
					[
						'class'     => $controller,
						'functions' => $functions
					], true);
				
					if( File::write($controllerFile, $classContent) )
					{
						$success = lang('Generator', 'generateControllerSuccess', $controller);	
					}	
					else
					{
						$error = lang('Generator', 'generateControllerNotSuccess', $controller);
					}
				}	
				else
				{
					$error = lang('File', 'alreadyFileError', $controller);	
				}	
			}
		}
	
		Import::masterpage
		(
			[
				'page' => 'controller-generator',
				'data' => 
				[
					'applications' 	=> $applications,
					'success'		=> $success,
					'error'			=> $error
				]
			],
			
			[
				'title' => 'Controller Generator'
			]
		);
    }	
}