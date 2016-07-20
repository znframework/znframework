<?php
class Home extends Controller
{	
    public function main($params = '')
    {	
        Import::masterpage
		(
			[
				'page' => 'home',
				'data' => []
			],
			
			[
				'title' => 'ZN Framework Generator'
			]
		);
    }	
}