<?php
class CryptoExample extends Controller
{	
    public function main($params = '')
    {	
		$data['title']        = str_replace('Example', ' Example', __CLASS__);
		$data['subtitle']     = __CLASS__;
		$data['examples']     = 
		[
			'encryptDecrypt',
			'keygen'
		];
		
		$data['requirements'] = [];
		
       	Import::view('main', $data); 
    }
	
	public function encryptDecrypt()
	{
		// mcrypt, openssl, hash, mhash sürüleri destekler.
		$encrypt = Crypto::encrypt('Crypto Example');
		
		writeLine('Encrypt Data:'.$encrypt);
		
		$decrypt = Crypto::decrypt($encrypt);
		
		writeLine('Decrypt Data:'.$decrypt);
		
		// farklı bir sürücü kullanılmak istenirse
		
		$encrypt = Crypto::driver('openssl')->encrypt('Crypto Example');
		
		writeLine('Openssl Encrypt Data:'.$encrypt);
		
		$decrypt = Crypto::driver('openssl')->decrypt($encrypt);
		
		writeLine('Openssl Decrypt Data:'.$decrypt);
	}
	
	public function keygen()
	{
		// rasgele anahtar üretmek için kullanılır.	
		// tüm sürücüler tarafından desteklenir.
		// p1: anahtarın kaç karakter olacağı belirtilir.
		echo Crypto::driver('hash')->keygen(10);
	}
}