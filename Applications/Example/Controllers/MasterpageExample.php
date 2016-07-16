<?php
class MasterpageExample extends Controller
{	
    public function main($params = '')
    {	
		$data['title']        = str_replace('Example', ' Example', __CLASS__);
		$data['subtitle']     = __CLASS__;
		$data['examples']     = 
		[
			'page1',
			'page2'
		];
		
		$data['requirements'] = 
		[
			'Ayarları kontrol etmek için Applications/Example/Config/Masterpage.php dosyasına bakın.'
		];
		
       	Import::view('main', $data); 
    }
	
	public function page1()
	{
		// Applications/Example/Config/Masterpage.php
		// istenilen ayarların değer düzenlenebilir.	
		$conf = 
		[
			// Title
			'title' => 'Example Page 1',	
			
			// Resources/Styles/example.css
			'style' => ['example'],
			
			// Meta Tags
			'meta'  => 
			[
				'name:author'   => 'ZN Framework',
				'name:keywords' => 'ZN Framework, zeroneed'
			],
			
			'attributes' => 
			[
				'body' => ['class' => 'content-page']
			],
			
			'data' => ['<example></example>']
		];
		
		$data = 
		[
			'contentPage' => 'masterpage-example/page1',
			'contentData' => 
			[
				'content' => 'This is example page 1!'
			]
		];	
		
		// p1: masterpage olarak belirlenen sayfaya data göndermek için.
		// p2: ayarları düzenlemek için.
		Import::masterpage($data, $conf);
	}
	
	public function page2()
	{
		// Applications/Example/Config/Masterpage.php
		// istenilen ayarların değer düzenlenebilir.	
		$conf = 
		[
			// Title
			'title' => 'Example Page 2',	
			
			// Meta Tags
			'meta'  => 
			[
				'name:author'   => 'ZERONEED',
				'name:keywords' => 'Example Page 2'
			],
			
			'attributes' => 
			[
				'body' => ['class' => 'form-page']
			],
			
			'data' => ['<page></page>']
		];
		
		$data = 
		[
			'contentPage' => 'masterpage-example/page2',
			'contentData' => 
			[
				'content' => 'This is example page 2!'
			]
		];	
		
		// p1: masterpage olarak belirlenen sayfaya data göndermek için.
		// p2: ayarları düzenlemek için.
		Import::masterpage($data, $conf);
	}
}