<?php
class WelcomeExample extends Controller
{	
    //--------------------------------------------------------------------------------------------------------
    // Called URL: http://example.com/example/WelcomeExample
    //--------------------------------------------------------------------------------------------------------
    public function main($params = '')
    {	
        $data['title'] = 'Welcome Example';
		$data['text']  = 'Welcome Example Page';
		$data['examples'] = 
		[
			'UserExample',
			'BenchmarkExample'
		];

        Import::view('welcome-example', $data);
    }	
}