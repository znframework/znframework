<?php
class StaticSSL
{	
	/***********************************************************************************/
	/* SSL LIBRARY	     					                   	                       */
	/***********************************************************************************/
	/* Yazar: Ozan UYKUN
	/* Site: www.zntr.net
	/* Lisans: The MIT License
	/* Telif Hakkı: Copyright (c) 2012-2015, zntr.net
	/*
	/* Sınıf Adı: SSL
	/* Versiyon: 2.0
	/* Tanımlanma: Statik
	/* Dahil Edilme: Gerektirmez
	/* Erişim: ssl::, $this->ssl, zn::$use->ssl, uselib('ssl')
	/* Not: Büyük-küçük harf duyarlılığı yoktur.
	/***********************************************************************************/
	
	/******************************************************************************************
	* OPEN                                                                             	  	  *
	*******************************************************************************************
	| Genel Kullanımı :	Detaylı kullanım için openssl ile ilgili kaynakları inceleyiniz.      |
	******************************************************************************************/
	public function open($sealedData = '', $data = '', $envKey = '', $privKeyId = '')
	{
		if
		( 
			! is_string($sealedData) ||
			! is_string($data) ||
			! is_string($envKey)
		)
		{
			return false;	
		}
		
		return openssl_open($sealedData, $data, $envKey, $privKeyId);
	}
	
	/******************************************************************************************
	* SEAL                                                                             	  	  *
	*******************************************************************************************
	| Genel Kullanımı :	Detaylı kullanım için openssl ile ilgili kaynakları inceleyiniz.      |
	******************************************************************************************/
	public function seal($data = '', $sealedData = '', $envKey = '', $privKeyId = '')
	{
		if
		( 
			! is_string($sealedData) ||
			! is_string($data) ||
			! is_string($envKey)
		)
		{
			return false;	
		}
		
		return openssl_seal($data, $sealedData, $envKey, $privKeyId);
	}
	
	/******************************************************************************************
	* SIGN                                                                             	  	  *
	*******************************************************************************************
	| Genel Kullanımı :	Detaylı kullanım için openssl ile ilgili kaynakları inceleyiniz.      |
	******************************************************************************************/
	public function sign($data = '', $signature = '', $privKeyId = '', $signatureAlgo = OPENSSL_ALGO_SHA1 )
	{
		if( ! is_string($data) || ! is_string($signature) )
		{
			return false;	
		}
		
		return openssl_sign($data, $signature, $privKeyId, $signatureAlgo);
	}
	
	/******************************************************************************************
	* VERIFY                                                                         	  	  *
	*******************************************************************************************
	| Genel Kullanımı :	Detaylı kullanım için openssl ile ilgili kaynakları inceleyiniz.      |
	******************************************************************************************/
	public function verify($data = '', $signature = '', $privKeyId = '', $signatureAlgo = OPENSSL_ALGO_SHA1 )
	{
		if( ! is_string($data) || ! is_string($signature) )
		{
			return false;	
		}
		
		return openssl_verify($data, $signature, $privKeyId, $signatureAlgo);
	}
	
	/******************************************************************************************
	* SPKI EXPORT CHALLENGE                                                                   *
	*******************************************************************************************
	| Genel Kullanımı :	Detaylı kullanım için openssl ile ilgili kaynakları inceleyiniz.      |
	******************************************************************************************/
	public function spkiExportChallenge($spkac = '')
	{
		if( ! is_string($spkac) )
		{
			return false;	
		}
		
		return openssl_spki_export_challenge($spkac);
	}
	
	/******************************************************************************************
	* SPKI EXPORT                                                                      	  	  *
	*******************************************************************************************
	| Genel Kullanımı :	Detaylı kullanım için openssl ile ilgili kaynakları inceleyiniz.      |
	******************************************************************************************/
	public function spkiExport($spkac = '')
	{
		if( ! is_string($spkac) )
		{
			return false;	
		}
		
		return openssl_spki_export($spkac);
	}
	
	/******************************************************************************************
	* SPKI VERIFY                                                                      	  	  *
	*******************************************************************************************
	| Genel Kullanımı :	Detaylı kullanım için openssl ile ilgili kaynakları inceleyiniz.      |
	******************************************************************************************/
	public function spkiVerify($spkac = '')
	{
		if( ! is_string($spkac) )
		{
			return false;	
		}
		
		return openssl_spki_verify($spkac);
	}
	
	/******************************************************************************************
	* SPKI NEW                                                                         	  	  *
	*******************************************************************************************
	| Genel Kullanımı :	Detaylı kullanım için openssl ile ilgili kaynakları inceleyiniz.      |
	******************************************************************************************/
	public function spkiNew($privKey = '', $challenge = '', $algorithm = 0)
	{
		if
		( 
			! is_resource($privKey) ||
			! is_string($challenge) ||
			! is_numeric($algorithm)
		)
		{
			return false;	
		}
		
		return openssl_spki_new($privKey, $challenge, $algorithm);
	}
	
	/******************************************************************************************
	* CIPHER INITIALIZING VECTOR LENGTH                                                	  	  *
	*******************************************************************************************
	| Genel Kullanımı :	Detaylı kullanım için openssl ile ilgili kaynakları inceleyiniz.      |
	******************************************************************************************/
	public function cipherIvLength($method = '')
	{
		if( ! is_string($method) )
		{
			return false;	
		}
		
		return openssl_cipher_iv_length($method);
	}
	
	/******************************************************************************************
	* CSR EXPORT TO FILE                                                               	  	  *
	*******************************************************************************************
	| Genel Kullanımı :	Detaylı kullanım için openssl ile ilgili kaynakları inceleyiniz.      |
	******************************************************************************************/
	public function csrExportToFile($csr = '', $outFileName = '', $noText = true)
	{
		if
		( 
			! is_resource($csr) ||
			! is_string($outFileName) ||
			! is_bool($noText)
		)
		{
			return false;	
		}
		
		return openssl_csr_export_to_file($csr, $outFileName, $noText);
	}
	
	/******************************************************************************************
	* CSR EXPORT                                                                       	  	  *
	*******************************************************************************************
	| Genel Kullanımı :	Detaylı kullanım için openssl ile ilgili kaynakları inceleyiniz.      |
	******************************************************************************************/
	public function csrExport($csr = '', $output = '', $noText = true)
	{
		if
		( 
			! is_resource($csr) ||
			! is_string($output) ||
			! is_bool($noText)
		)
		{
			return false;	
		}
		
		return openssl_csr_export($csr, $output, $noText);
	}
	
	/******************************************************************************************
	* CSR GET PUBLIC KEY                                                               	  	  *
	*******************************************************************************************
	| Genel Kullanımı :	Detaylı kullanım için openssl ile ilgili kaynakları inceleyiniz.      |
	******************************************************************************************/
	public function csrGetPublicKey($csr = '', $shortnames = true)
	{
		if( ! is_bool($shortnames) )
		{
			return false;	
		}
		
		return openssl_csr_get_public_key($csr, $shortnames);
	}
	
	/******************************************************************************************
	* CSR GET SUBJECT                                                                  	  	  *
	*******************************************************************************************
	| Genel Kullanımı :	Detaylı kullanım için openssl ile ilgili kaynakları inceleyiniz.      |
	******************************************************************************************/
	public function csrGetSubject($csr = '', $shortnames = true)
	{
		if( ! is_bool($shortnames) )
		{
			return false;	
		}
		
		return openssl_csr_get_subject($csr, $shortnames);
	}
	
	/******************************************************************************************
	* CSR NEW                                                                         	  	  *
	*******************************************************************************************
	| Genel Kullanımı :	Detaylı kullanım için openssl ile ilgili kaynakları inceleyiniz.      |
	******************************************************************************************/
	public function csrNew($dn = array(), $privKey = '', $configArgs = array(), $extraAttrs = array())
	{
		if
		( 
			! is_array($dn) ||
			! is_resource($privKey) ||
			! is_array($configArgs) ||
			! is_array($extraAttrs)
		)
		{
			return false;	
		}
		
		return openssl_csr_new($dn, $privKey, $configArgs, $extraAttrs);
	}
	
	/******************************************************************************************
	* CSR SIGN                                                                        	  	  *
	*******************************************************************************************
	| Genel Kullanımı :	Detaylı kullanım için openssl ile ilgili kaynakları inceleyiniz.      |
	******************************************************************************************/
	public function csrSign($csr = '', $cacert = '', $privKey = '', $days = 0, $configs = array(), $serial = 0)
	{
		if
		( 
			! is_numeric($days) ||
			! is_array($configs) ||
			! is_numeric($serial)
		)
		{
			return false;	
		}
		
		return openssl_csr_sign($csr, $cacert, $privKey, $days, $configs, $serial);
	}
	
	/******************************************************************************************
	* ENCODE                                                                          	  	  *
	*******************************************************************************************
	| Genel Kullanımı :	Detaylı kullanım için openssl ile ilgili kaynakları inceleyiniz.      |
	******************************************************************************************/
	public function encode($data = '', $method = '', $password = '', $options = 0, $iv = '')
	{
		if
		( 
			! is_string($data) ||
			! is_string($method) ||
			! is_string($password) ||
			! is_numeric($options) ||
			! is_string($iv)
		)
		{
			return false;	
		}
		
		return openssl_encrypt($data, $method, $password, $options, $iv);
	}
	
	/******************************************************************************************
	* DECODE                                                                           	  	  *
	*******************************************************************************************
	| Genel Kullanımı :	Detaylı kullanım için openssl ile ilgili kaynakları inceleyiniz.      |
	******************************************************************************************/
	public function decode($data = '', $method = '', $password = '', $options = 0, $iv = '')
	{
		if
		( 
			! is_string($data) ||
			! is_string($method) ||
			! is_string($password) ||
			! is_numeric($options) ||
			! is_string($iv)
		)
		{
			return false;	
		}
		
		return openssl_decrypt($data, $method, $password, $options, $iv);
	}
	
	/******************************************************************************************
	* DH COMPUTE KEY                                                                   	  	  *
	*******************************************************************************************
	| Genel Kullanımı :	Detaylı kullanım için openssl ile ilgili kaynakları inceleyiniz.      |
	******************************************************************************************/
	public function dhComputeKey($pubKey = '', $dhKey = '')
	{
		if( ! is_string($pubKey) || ! is_resource($dhKey) )
		{
			return false;	
		}
		
		return openssl_dh_compute_key($pubKey, $dhKey);
	}
	
	/******************************************************************************************
	* DIGEST                                                                          	  	  *
	*******************************************************************************************
	| Genel Kullanımı :	Detaylı kullanım için openssl ile ilgili kaynakları inceleyiniz.      |
	******************************************************************************************/
	public function digest($data = '', $method = '', $rawOutput = true)
	{
		if
		( 
			! is_string($data) ||
			! is_string($method) ||
			! is_bool($rawOutput)
		)
		{
			return false;	
		}
		
		return openssl_digest($data, $method, $rawOutput);
	}
	
	/******************************************************************************************
	* ERROR STRING                                                                     	  	  *
	*******************************************************************************************
	| Genel Kullanımı :	Detaylı kullanım için openssl ile ilgili kaynakları inceleyiniz.      |
	******************************************************************************************/
	public function error()
	{
		return openssl_error_string();
	}
	
	/******************************************************************************************
	* FREE KEY                                                                         	  	  *
	*******************************************************************************************
	| Genel Kullanımı :	Detaylı kullanım için openssl ile ilgili kaynakları inceleyiniz.      |
	******************************************************************************************/
	public function freeKey($key = '')
	{
		if( ! is_resource($key) )
		{
			return false;	
		}
		
		return openssl_free_key($key);
	}
	
	/******************************************************************************************
	* GET CERT LOCATIONS                                                               	  	  *
	*******************************************************************************************
	| Genel Kullanımı :	Detaylı kullanım için openssl ile ilgili kaynakları inceleyiniz.      |
	******************************************************************************************/
	public function getCertLocations()
	{
		return openssl_get_cert_locations();
	}
	
	/******************************************************************************************
	* GET CIPHER METHODS                                                               	  	  *
	*******************************************************************************************
	| Genel Kullanımı :	Detaylı kullanım için openssl ile ilgili kaynakları inceleyiniz.      |
	******************************************************************************************/
	public function getCipherMethods($aliases = false)
	{
		if( ! is_bool($aliases) )
		{
			return false;	
		}
		
		return openssl_get_cipher_methods($aliases);
	}
	
	/******************************************************************************************
	* GET MD METHODS                                                                   	  	  *
	*******************************************************************************************
	| Genel Kullanımı :	Detaylı kullanım için openssl ile ilgili kaynakları inceleyiniz.      |
	******************************************************************************************/
	public function getMdMethods($aliases = false)
	{
		if( ! is_bool($aliases) )
		{
			return false;	
		}
		
		return openssl_get_md_methods($aliases);
	}
	
	/******************************************************************************************
	* PBKDF2                                                                          	  	  *
	*******************************************************************************************
	| Genel Kullanımı :	Detaylı kullanım için openssl ile ilgili kaynakları inceleyiniz.      |
	******************************************************************************************/
	public function pbkdf2($password = '', $salt = '', $keyLength = 0, $iterations = 0, $digestAlgo = '')
	{
		if
		( 
			! is_string($password) ||
			! is_string($salt) ||
			! is_numeric($keyLength) ||
			! is_numeric($iterations) ||
			! is_string($digestAlgo)
		)
		{
			return false;	
		}
		
		return openssl_pbkdf2($password, $salt, $keyLength, $iterations, $digestAlgo);
	}
	
	/******************************************************************************************
	* PKCS12 EXPORT TO FILE                                                           	  	  *
	*******************************************************************************************
	| Genel Kullanımı :	Detaylı kullanım için openssl ile ilgili kaynakları inceleyiniz.      |
	******************************************************************************************/
	public function pkcs12ExportToFile($x509 = '', $file = '', $privKey = '', $password = '', $params = array())
	{
		if
		( 
			! is_string($x509) ||
			! is_string($file) ||
			! is_string($privKey) ||
			! is_string($password) ||
			! is_array($params)
		)
		{
			return false;	
		}
		
		return openssl_pkcs12_export_to_file($x509, $file, $privKey, $password, $params);
	}
	
	/******************************************************************************************
	* PKCS12 EXPORT                                                                    	  	  *
	*******************************************************************************************
	| Genel Kullanımı :	Detaylı kullanım için openssl ile ilgili kaynakları inceleyiniz.      |
	******************************************************************************************/
	public function pkcs12Export($x509 = '', $out = '', $privKey = '', $password = '', $args = array())
	{
		if
		( 
			! is_string($x509) ||
			! is_string($out) ||
			! is_string($privKey) ||
			! is_string($password) ||
			! is_array($args)
		)
		{
			return false;	
		}
		
		return openssl_pkcs12_export($x509, $out, $privKey, $password, $args);
	}
	
	/******************************************************************************************
	* PKCS12 READ                                                                     	  	  *
	*******************************************************************************************
	| Genel Kullanımı :	Detaylı kullanım için openssl ile ilgili kaynakları inceleyiniz.      |
	******************************************************************************************/
	public function pkcs12Read($pkcs12 = '', $cert = array(), $password = '')
	{
		if
		( 
			! is_string($pkcs12) ||
			! is_string($password) ||
			! is_array($cert)
		)
		{
			return false;	
		}
		
		return openssl_pkcs12_read($pkcs12, $cert, $password);
	}
	
	/******************************************************************************************
	* PKCS7 DECODE                                                                    	  	  *
	*******************************************************************************************
	| Genel Kullanımı :	Detaylı kullanım için openssl ile ilgili kaynakları inceleyiniz.      |
	******************************************************************************************/
	public function pkcs7Decode($inFileName = '', $outFileName = '', $recIpCert = '', $recIpKey = '')
	{
		if( ! is_string($inFileName) || ! is_string($outFileName) )
		{
			return false;	
		}
		
		return openssl_pkcs7_decrypt($inFileName, $outFileName, $recIpCert, $recIpKey);
	}
	
	/******************************************************************************************
	* PKCS7 ENCODE                                                                    	  	  *
	*******************************************************************************************
	| Genel Kullanımı :	Detaylı kullanım için openssl ile ilgili kaynakları inceleyiniz.      |
	******************************************************************************************/
	public function pkcs7Encode($inFile = '', $outFile = '', $recipcerts  = '', $headers  = array(), $flags = PKCS7_DETACHED, $cipherId = OPENSSL_CIPHER_RC2_40)
	{
		if
		( 
			! is_string($inFile) ||
			! is_string($outFile) ||
			! is_array($headers) ||
			! is_numeric($flags) ||
			! is_numeric($cipherId)
		)
		{
			return false;	
		}
		
		return openssl_pkcs7_encrypt($inFile, $outFile, $recipcerts, $headers, $flags, $cipherId);
	}
	
	/******************************************************************************************
	* PKCS7 SIGN                                                                      	  	  *
	*******************************************************************************************
	| Genel Kullanımı :	Detaylı kullanım için openssl ile ilgili kaynakları inceleyiniz.      |
	******************************************************************************************/
	public function pkcs7Sign($inFile = '', $outFile = '', $signcert  = '', $privKey = '', $headers  = array(), $flags = PKCS7_DETACHED, $extraCerts = '')
	{
		if
		( 
			! is_string($inFile) ||
			! is_string($outFile) ||
			! is_array($headers) ||
			! is_numeric($flags) ||
			! is_string($extraCerts)
		)
		{
			return false;	
		}
		
		return openssl_pkcs7_sign($inFile, $outFile, $signcert, $privKey, $headers, $flags, $extraCerts);
	}
	
	/******************************************************************************************
	* PKCS7 VERIFY                                                                     	  	  *
	*******************************************************************************************
	| Genel Kullanımı :	Detaylı kullanım için openssl ile ilgili kaynakları inceleyiniz.      |
	******************************************************************************************/
	public function pkcs7Verify($fileName = '', $flags = 0, $outFileName  = '', $caInfo = array(), $extraCerts = '', $content = '')
	{
		if
		( 
			! is_string($fileName) ||
			! is_string($outFileName) ||
			! is_array($caInfo) ||
			! is_numeric($flags) ||
			! is_string($extraCerts) ||
			! is_string($content)
		)
		{
			return false;	
		}
		
		return openssl_pkcs7_verify($fileName, $flags, $outFileName, $caInfo, $extraCerts, $content);
	}
	
	/******************************************************************************************
	* PKEY GET PRIVATE                                                                 	  	  *
	*******************************************************************************************
	| Genel Kullanımı :	Detaylı kullanım için openssl ile ilgili kaynakları inceleyiniz.      |
	******************************************************************************************/
	public function pkeyGetPrivate($key = '', $passPhrase = '')
	{
		if( ! is_string($passPhrase) )
		{
			return false;	
		}
		
		return openssl_pkey_get_private($key, $passPhrase);
	}
	
	/******************************************************************************************
	* PKEY GET PUBLIC                                                                  	  	  *
	*******************************************************************************************
	| Genel Kullanımı :	Detaylı kullanım için openssl ile ilgili kaynakları inceleyiniz.      |
	******************************************************************************************/
	public function pkeyGetPublic($cert = '')
	{
		return openssl_pkey_get_public($cert);
	}
	
	/******************************************************************************************
	* PKEY EXPORT TO FILE                                                             	  	  *
	*******************************************************************************************
	| Genel Kullanımı :	Detaylı kullanım için openssl ile ilgili kaynakları inceleyiniz.      |
	******************************************************************************************/
	public function pkeyExportToFile($key = '', $file = '', $password = '', $configs = array())
	{
		if
		( 
			! is_string($file) ||
			! is_string($password) ||
			! is_array($configs)
		)
		{
			return false;	
		}
		
		return openssl_pkey_export_to_file($key, $file, $password, $configs);
	}
	
	/******************************************************************************************
	* PKEY EXPORT                                                                     	  	  *
	*******************************************************************************************
	| Genel Kullanımı :	Detaylı kullanım için openssl ile ilgili kaynakları inceleyiniz.      |
	******************************************************************************************/
	public function pkeyExport($key = '', $file = '', $password = '', $configs = array())
	{
		if
		( 
			! is_string($file) ||
			! is_string($password) ||
			! is_array($configs)
		)
		{
			return false;	
		}
		
		return openssl_pkey_export($key, $file, $password, $configs);
	}
	
	/******************************************************************************************
	* PKEY FREE                                                                       	  	  *
	*******************************************************************************************
	| Genel Kullanımı :	Detaylı kullanım için openssl ile ilgili kaynakları inceleyiniz.      |
	******************************************************************************************/
	public function pkeyFree($key = '')
	{
		if( ! is_resource($key) )
		{
			return false;	
		}
		
		return openssl_pkey_free($key);
	}
	
	/******************************************************************************************
	* PEKY GET DETAILS                                                               	  	  *
	*******************************************************************************************
	| Genel Kullanımı :	Detaylı kullanım için openssl ile ilgili kaynakları inceleyiniz.      |
	******************************************************************************************/
	public function pkeyGetDetails($key = '')
	{
		if( ! is_resource($key) )
		{
			return false;	
		}
		
		return openssl_pkey_get_details($key);
	}
	
	/******************************************************************************************
	* PKEY NEW                                                                         	  	  *
	*******************************************************************************************
	| Genel Kullanımı :	Detaylı kullanım için openssl ile ilgili kaynakları inceleyiniz.      |
	******************************************************************************************/
	public function pkeyNew($configs = array())
	{
		if( ! is_array($configs) )
		{
			return false;	
		}
		
		return openssl_pkey_new($configs);
	}
	
	/******************************************************************************************
	* PRIVATE DECODE                                                                   	  	  *
	*******************************************************************************************
	| Genel Kullanımı :	Detaylı kullanım için openssl ile ilgili kaynakları inceleyiniz.      |
	******************************************************************************************/
	public function privateDecode($data = '', $decrypted = '', $key = '', $padding = OPENSSL_PKCS1_PADDING)
	{
		if
		( 
			! is_string($data) || 
			! is_string($decrypted) ||
			! is_numeric($padding) 
		)
		{
			return false;	
		}
		
		return openssl_private_decrypt($data, $decrypted, $key, $padding);
	}
	
	/******************************************************************************************
	* PRIVATE ENCODE                                                                   	  	  *
	*******************************************************************************************
	| Genel Kullanımı :	Detaylı kullanım için openssl ile ilgili kaynakları inceleyiniz.      |
	******************************************************************************************/
	public function privateEncode($data = '', $decrypted = '', $key = '', $padding = OPENSSL_PKCS1_PADDING)
	{
		if
		( 
			! is_string($data) || 
			! is_string($decrypted) ||
			! is_numeric($padding) 
		)
		{
			return false;	
		}
		
		return openssl_private_encrypt($data, $decrypted, $key, $padding);
	}
	
	/******************************************************************************************
	* PUBLIC DECODE                                                                    	  	  *
	*******************************************************************************************
	| Genel Kullanımı :	Detaylı kullanım için openssl ile ilgili kaynakları inceleyiniz.      |
	******************************************************************************************/
	public function publicDecode($data = '', $decrypted = '', $key = '', $padding = OPENSSL_PKCS1_PADDING)
	{
		if
		( 
			! is_string($data) || 
			! is_string($decrypted) ||
			! is_numeric($padding) 
		)
		{
			return false;	
		}
		
		return openssl_public_decrypt($data, $decrypted, $key, $padding);
	}
	
	/******************************************************************************************
	* PUBLIC ENCODE                                                                   	  	  *
	*******************************************************************************************
	| Genel Kullanımı :	Detaylı kullanım için openssl ile ilgili kaynakları inceleyiniz.      |
	******************************************************************************************/
	public function publicEncode($data = '', $decrypted = '', $key = '', $padding = OPENSSL_PKCS1_PADDING)
	{
		if
		( 
			! is_string($data) || 
			! is_string($decrypted) ||
			! is_numeric($padding) 
		)
		{
			return false;	
		}
		
		return openssl_public_encrypt($data, $decrypted, $key, $padding);
	}
	
	/******************************************************************************************
	* RANDOM PSEUDO BYTES                                                             	  	  *
	*******************************************************************************************
	| Genel Kullanımı :	Detaylı kullanım için openssl ile ilgili kaynakları inceleyiniz.      |
	******************************************************************************************/
	public function randomPseudoBytes($length = 0, $strong = true)
	{
		if( ! is_numeric($length) || ! is_bool($strong) )
		{
			return false;	
		}
		
		return openssl_random_pseudo_bytes($length, $strong);
	}
	
	/******************************************************************************************
	* X509 CHECK PRIVATE KEY                                                           	  	  *
	*******************************************************************************************
	| Genel Kullanımı :	Detaylı kullanım için openssl ile ilgili kaynakları inceleyiniz.      |
	******************************************************************************************/
	public function x509CheckPrivateKey($cert = '', $key = '')
	{
		return openssl_x509_check_private_key($cert, $key);
	}
	
	/******************************************************************************************
	* X509 CHECK PURPOSE                                                              	  	  *
	*******************************************************************************************
	| Genel Kullanımı :	Detaylı kullanım için openssl ile ilgili kaynakları inceleyiniz.      |
	******************************************************************************************/
	public function x509CheckPurpose($x509cert = '', $purpose = 0, $caInfo = array(), $untrustedFile = '')
	{
		if
		( 
			! is_numeric($purpose) || 
			! is_array($caInfo) ||
			! is_string($untrustedFile) 
		)
		{
			return false;	
		}
		
		return openssl_x509_checkpurpose($x509cert, $purpose, $caInfo, $untrustedFile);
	}
	
	/******************************************************************************************
	* X509 EXPORT TO FILE                                                             	  	  *
	*******************************************************************************************
	| Genel Kullanımı :	Detaylı kullanım için openssl ile ilgili kaynakları inceleyiniz.      |
	******************************************************************************************/
	public function x509ExportToFile($x509cert = '', $outFileName = '', $noText = true)
	{
		if( ! is_bool($noText) || ! is_string($outFileName) )
		{
			return false;	
		}
		
		return openssl_x509_export_to_file($x509cert, $outFileName, $noText);
	}
	
	/******************************************************************************************
	* X509 EXPORT                                                                    	  	  *
	*******************************************************************************************
	| Genel Kullanımı :	Detaylı kullanım için openssl ile ilgili kaynakları inceleyiniz.      |
	******************************************************************************************/
	public function x509Export($x509cert = '', $outFileName = '', $noText = true)
	{
		if( ! is_bool($noText) || ! is_string($outFileName) )
		{
			return false;	
		}
		
		return openssl_x509_export($x509cert, $outFileName, $noText);
	}
	
	/******************************************************************************************
	* X509 FINGER PRINT                                                                	  	  *
	*******************************************************************************************
	| Genel Kullanımı :	Detaylı kullanım için openssl ile ilgili kaynakları inceleyiniz.      |
	******************************************************************************************/
	public function x509FingerPrint($x509 = '', $hashAlgorithm = 'sha1', $rawOutput = false)
	{
		if( ! isHash($hashAlgorithm) || ! is_bool($rawOutput) )
		{
			return false;	
		}
		
		return openssl_x509_fingerprint($x509, $hashAlgorithm, $rawOutput);
	}
	
	/******************************************************************************************
	* X509 FREE                                                                        	  	  *
	*******************************************************************************************
	| Genel Kullanımı :	Detaylı kullanım için openssl ile ilgili kaynakları inceleyiniz.      |
	******************************************************************************************/
	public function x509Free($x509cert = '')
	{
		if( ! is_resource($x509cert) )
		{
			return false;	
		}
		
		return openssl_x509_free($x509cert);
	}
	
	/******************************************************************************************
	* X509 PARSE                                                                       	  	  *
	*******************************************************************************************
	| Genel Kullanımı :	Detaylı kullanım için openssl ile ilgili kaynakları inceleyiniz.      |
	******************************************************************************************/
	public function x509Parse($x509 = '', $shortNames = false)
	{
		if( ! is_bool($shortNames) )
		{
			return false;	
		}
		
		return openssl_x509_parse($x509, $shortNames);
	}
	
	/******************************************************************************************
	* X509 READ                                                                        	  	  *
	*******************************************************************************************
	| Genel Kullanımı :	Detaylı kullanım için openssl ile ilgili kaynakları inceleyiniz.      |
	******************************************************************************************/
	public function x509Read($x509certData = '')
	{
		return openssl_x509_read($x509certData);
	}
}