<?php
class MigrationGenerator extends Controller
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
			$migration	  = Method::post('migration');
			$version	  = Method::post('version');
			
			Validation::rules('migration', ['required', 'alnum'], 'Migration');
			Validation::rules('version', ['numeric'], 'Version');
			
			if( ! $error = Validation::error('string') )
			{
				$migrationDir = $application.'/Models/Migrations/';
				
				if( Migration::path($migrationDir)->create($migration, $version) )
				{
					$success = lang('Generator', 'generateMigrationSuccess', $migration);	
				}
				else
				{
					$error = lang('Generator', 'generateMigrationNotSuccess', $migration);		
				}
			}
		}
	
		Import::masterpage
		(
			[
				'page' => 'migration-generator',
				'data' => 
				[
					'applications' 	=> $applications,
					'success'		=> $success,
					'error'			=> $error
				]
			],
			
			[
				'title' => 'Migration Generator'
			]
		);
    }	
}