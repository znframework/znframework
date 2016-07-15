<?php
class ScheduleExample extends Controller
{	
    public function main($params = '')
    {	
		$data['title']        = str_replace('Example', ' Example', __CLASS__);
		$data['subtitle']     = __CLASS__;
		$data['examples']     = 
		[
			'schedule'
		];
		
		$data['requirements'] = [];
		
       	Import::view('main', $data); 
    }	
	
	public function schedule()
	{
		$title = 'Schedule Component';
		
		$schedule = Schedule::create
					([
						'ul type="disc"' =>
						[
							'Antalya', 
							'Ankara', 
							'Istanbul',
							'ol type="i" order="1"' => ['Zeytinburnu', 'Kadikoy', 'Sancaktepe', 'ul type="solid"' => ['Eyupsultan', 'Osmangazi', 'Samandira']],
						]
					]); 
					 
		Import::view('components-example', 
		[
			'component'	=> $schedule,
			'title' 	=> $title
		]);
	}
}