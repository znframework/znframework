<?php
class WelcomeExample extends Controller
{	
    //--------------------------------------------------------------------------------------------------------
    // Called URL: http://example.com/example/WelcomeExample
    //--------------------------------------------------------------------------------------------------------
    public function main($params = '')
    {	
        $data['title'] = str_replace('Example', ' Example', __CLASS__);
		$data['text']  = 'Welcome Example Page';
		$data['examples'] = 
		[
			'UserExample',
			'BenchmarkExample',
			'BufferExample',
			'CacheExample',
			'CalendarExample',
			'CaptchaExample',
			'DataGridExample',
			'PaginationExample',
			'ScheduleExample',
			'TableExample',
			'TerminalExample',
			'CompressExample',
			'CryptoExample',
			'EncodeExample',
			'RouteExample',
			'TemplateWizardExample',
			'MasterpageExample',
			'DatabaseExample',
			'DateTimeExample',
			'MultiLanguageExample',
			'UploadExample'
		];

        Import::view('welcome-example', $data);
    }	
}