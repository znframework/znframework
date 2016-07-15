<?php
class ScheduleExample extends Controller
{	
    public function main($params = '')
    {	
		$data['title']        = str_replace('Example', ' Example', __CLASS__);
		$data['subtitle']     = __CLASS__;
		$data['examples']     = 
		[
			
		];
		
		$data['requirements'] = [];
		
       	Import::view('main', $data); 
    }	
}