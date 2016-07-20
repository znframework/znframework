<?php
class ModelGenerator extends Controller
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
			$application  = Method::post('application');
			$model		  = Method::post('model');
			$functions    = explode(',', Method::post('functions'));
			
			Validation::rules('model', ['required', 'alnum'], 'Model');
			Validation::rules('functions', ['required'], 'Functions');
			
			if( ! $error = Validation::error('string') )
			{
				$modelFile = $application.'/Models/'.suffix($model, '.php');
				
				if( ! is_file($modelFile) )
				{
					$classContent = Import::template('Model', 
					[
						'class'     => $model,
						'functions' => $functions
					], true);
				
					if( File::write($modelFile, $classContent) )
					{
						$success = lang('Generator', 'generateModelSuccess', $model);	
					}	
					else
					{
						$error = lang('Generator', 'generateModelNotSuccess', $model);
					}
				}	
				else
				{
					$error = lang('File', 'alreadyFileError', $model);	
				}	
			}
		}
	
		Import::masterpage
		(
			[
				'page' => 'model-generator',
				'data' => 
				[
					'applications' 	=> $applications,
					'success'		=> $success,
					'error'			=> $error
				]
			],
			
			[
				'title' => 'Model Generator'
			]
		);
    }	
}