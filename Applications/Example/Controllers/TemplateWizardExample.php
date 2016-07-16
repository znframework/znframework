<?php
class TemplateWizardExample extends Controller
{	
    public function main($params = '')
    {	
		$data['title']        = str_replace('Example', ' Example', __CLASS__);
		$data['subtitle']     = __CLASS__;
		$data['examples']     = 
		[
			'wizard'
		];
		
		$data['requirements'] = [];
		
       	Import::view('main', $data); 
    }
	
	public function wizard()
	{
		$data['title'] = 'Template Wizard Example';
		
		// Şablon sihirbazının kullnılabilmesi için
		// görünüm sayfalarına .wizard uzantısı eklenir.
		Import::view('template-example.wizard', $data);	
	}
}