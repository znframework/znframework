<?php
class LibraryGenerator extends Controller
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
			$library	  = Method::post('library');
			$functions    = explode(',', Method::post('functions'));
			
			Validation::rules('library', ['required', 'alnum'], 'Library');
			Validation::rules('functions', ['required'], 'Functions');
			
	
			
			if( ! $error = Validation::error('string') )
			{
				$libraryFile = $application.'/Libraries/'.suffix($library, '.php');
				
				if( ! is_file($libraryFile) )
				{
					$classContent = Import::template('Library', 
					[
						'class'     => $library,
						'functions' => $functions
					], true);
				
					if( File::write($libraryFile, $classContent) )
					{
						$success = lang('Generator', 'generateLibrarySuccess', $library);	
					}	
					else
					{
						$error = lang('Generator', 'generateLibraryNotSuccess', $library);
					}
				}	
				else
				{
					$error = lang('File', 'alreadyFileError', $library);	
				}	
			}
		}
	
		Import::masterpage
		(
			[
				'page' => 'library-generator',
				'data' => 
				[
					'applications' 	=> $applications,
					'success'		=> $success,
					'error'			=> $error
				]
			],
			
			[
				'title' => 'Library Generator'
			]
		);
    }	
}