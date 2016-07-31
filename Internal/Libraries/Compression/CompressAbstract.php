 <?php
abstract class CompressAbstract
{
 	//----------------------------------------------------------------------------------------------------
	//
	// Yazar      : Ozan UYKUN <ozanbote@windowslive.com> | <ozanbote@gmail.com>
	// Site       : www.zntr.net
	// Lisans     : The MIT License
	// Telif Hakkı: Copyright (c) 2012-2016, zntr.net
	//
	//----------------------------------------------------------------------------------------------------

 	public function extract()
	{
		return false;	
	}
	
	public function write()
	{
		return false;	
	}
	
	public function read()
	{
		return false;	
	}

	public function compress()
	{
		return false;
	}

	public function uncompress()
	{
		return false;
	}
	
	public function encode()
	{
		return false;	
	}
	
	public function decode()
	{
		return false;	
	}
	
	public function deflate()
	{
		return false;	
	}
	
	public function inflate()
	{
		return false;
	}
}