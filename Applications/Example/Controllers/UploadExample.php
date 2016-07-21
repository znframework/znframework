<?php
class UploadExample extends Controller
{	
    public function main($params = '')
    {	
		$data['title']        = str_replace('Example', ' Example', __CLASS__);
		$data['subtitle']     = __CLASS__;
		$data['examples']     = 
		[
			'example'
		];
		
		$data['requirements'] = [];
		
       	Import::view('main', $data); 
    }	
	
	public function example()
	{
		$error = '';
		$info  = [];
		if( Method::post('doUpload') )
		{
			Upload::settings
			([
				'encode'     => false, 					  // Dosya imini şifrelemesini şirelemesini istemedik.
				'prefix'     => time(),  				  // Yüklenen dosya isminin önüne _onek_ ibaresinin gelmesini istedik.
				'extensions' => 'jpg|jpeg|png|gif|exe',   // Sadece yanda verilen uzantılı dosyaları yüklemesini istedik.
				'maxsize'	 => 8096					  // Yüklenecek maximum dosya boyutu. 8096 byte olarak belirlendi.
			])
			->start('inputFileObject');  // Varsayılan Dizi Yolu: Resources/Uploads.
		
			if( ! $error = Upload::error() )
			{
				$error = 'Upload Successfully!';	
			}
			
			$info = Upload::info();
		}
		
		import::view('upload-example', ['title' => 'Upload Example', 'info' => $info, 'error' => $error]);
	}
}