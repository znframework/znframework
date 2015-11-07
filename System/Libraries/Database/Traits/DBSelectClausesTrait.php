<?php
trait DBSelectClausesTrait
{
	/******************************************************************************************
	* ALL                                                                                     *
	*******************************************************************************************
	| Genel Kullanım: Veritabanı sorgusundaki ALL komutunun kullanımıdır.	      			  |
	|															                              |
	| Parametreler: Herhangi bir parametresi yoktur.                                          |
	|          																				  |
	| Örnek Kullanım: ->all();                     			                                  |
	|          																				  |
	******************************************************************************************/
	public function all()
	{ 
		$this->all = ' ALL '; 
		return $this; 
	}
	
	/******************************************************************************************
	* DISTINCT                                                                                *
	*******************************************************************************************
	| Genel Kullanım: Veritabanı sorgusundaki DISTINCT komutunun kullanımıdır.	      		  |
	|															                              |
	| Parametreler: Herhangi bir parametresi yoktur.                                          |
	|          																				  |
	| Örnek Kullanım: ->distinct();                     			                          |
	|          																				  |
	******************************************************************************************/
	public function distinct()
	{ 
		$this->distinct = ' DISTINCT '; 
		return $this; 
	}
	
	/******************************************************************************************
	* DISTINCTROW                                                                             *
	*******************************************************************************************
	| Genel Kullanım: Veritabanı sorgusundaki DISTINCTROW komutunun kullanımıdır.	      	  |
	|															                              |
	| Parametreler: Herhangi bir parametresi yoktur.                                          |
	|          																				  |
	| Örnek Kullanım: ->distinctRow();                     			                          |
	|          																				  |
	******************************************************************************************/
	public function distinctRow()
	{ 
		$this->distinctRow = ' DISTINCTROW '; 
		return $this; 
	}
	
	/******************************************************************************************
	* STRAIGHT JOIN                                                                           *
	*******************************************************************************************
	| Genel Kullanım: Veritabanı sorgusundaki STRAIGHT_JOIN komutunun kullanımıdır.	      	  |
	|															                              |
	| Parametreler: Herhangi bir parametresi yoktur.                                          |
	|          																				  |
	| Örnek Kullanım: ->straightJoin();                     	                              |
	|          																				  |
	******************************************************************************************/
	public function straightJoin()
	{ 
		$this->straightJoin = ' STRAIGHT_JOIN '; 
		return $this; 
	}	
		
	/******************************************************************************************
	* HIGH PRIORITY                                                                           *
	*******************************************************************************************
	| Genel Kullanım: Veritabanı sorgusundaki HIGH_PRIORITY komutunun kullanımıdır.	      	  |
	|															                              |
	| Parametreler: Herhangi bir parametresi yoktur.                                          |
	|          																				  |
	| Örnek Kullanım: ->highPriority();                     	                              |
	|          																				  |
	******************************************************************************************/
	public function highPriority()
	{ 
		$this->highPriority = ' HIGH_PRIORITY '; 
		return $this; 
	}
	
	/******************************************************************************************
	* SQL SMALL RESULT                                                                        *
	*******************************************************************************************
	| Genel Kullanım: Veritabanı sorgusundaki SQL_SMALL_RESULT komutunun kullanımıdır.	      |
	|															                              |
	| Parametreler: Herhangi bir parametresi yoktur.                                          |
	|          																				  |
	| Örnek Kullanım: ->smallResult();                     	                              |
	|          																				  |
	******************************************************************************************/
	public function smallResult()
	{ 
		$this->smallResult = ' SQL_SMALL_RESULT '; 
		return $this; 
	}
	
	/******************************************************************************************
	* SQL BIG RESULT                                                                          *
	*******************************************************************************************
	| Genel Kullanım: Veritabanı sorgusundaki SQL_BIG_RESULT komutunun kullanımıdır.	      |
	|															                              |
	| Parametreler: Herhangi bir parametresi yoktur.                                          |
	|          																				  |
	| Örnek Kullanım: ->bigResult();                        	                              |
	|          																				  |
	******************************************************************************************/
	public function bigResult()
	{ 
		$this->bigResult = ' SQL_BIG_RESULT '; 
		return $this; 
	}
	
	/******************************************************************************************
	* SQL BUFFER RESULT                                                                       *
	*******************************************************************************************
	| Genel Kullanım: Veritabanı sorgusundaki SQL_BUFFER_RESULT komutunun kullanımıdır.	      |
	|															                              |
	| Parametreler: Herhangi bir parametresi yoktur.                                          |
	|          																				  |
	| Örnek Kullanım: ->bufferResult();                        	                          |
	|          																				  |
	******************************************************************************************/
	public function bufferResult()
	{ 
		$this->bufferResult = ' SQL_BUFFER_RESULT '; 
		return $this; 
	}
	
	/******************************************************************************************
	* SQL CACHE                                                                               *
	*******************************************************************************************
	| Genel Kullanım: Veritabanı sorgusundaki SQL_CACHE komutunun kullanımıdır.	      	      |
	|															                              |
	| Parametreler: Herhangi bir parametresi yoktur.                                          |
	|          																				  |
	| Örnek Kullanım: ->cache();                        	                                  |
	|          																				  |
	******************************************************************************************/
	public function cache()
	{ 
		$this->cache = ' SQL_CACHE '; 
		return $this; 
	}
	
	/******************************************************************************************
	* SQL NO CACHE                                                                            *
	*******************************************************************************************
	| Genel Kullanım: Veritabanı sorgusundaki SQL_NO_CACHE komutunun kullanımıdır.	  	      |
	|															                              |
	| Parametreler: Herhangi bir parametresi yoktur.                                          |
	|          																				  |
	| Örnek Kullanım: ->noCache();                        	                                  |
	|          																				  |
	******************************************************************************************/
	public function noCache()
	{ 
		$this->noCache = ' SQL_NO_CACHE '; 
		return $this; 
	}
	
	/******************************************************************************************
	* SQL CALC FOUND ROWS                                                                     *
	*******************************************************************************************
	| Genel Kullanım: Veritabanı sorgusundaki SQL_CALC_FOUND_ROWS komutunun kullanımıdır.	  |
	|															                              |
	| Parametreler: Herhangi bir parametresi yoktur.                                          |
	|          																				  |
	| Örnek Kullanım: ->calcFoundRows();                        	                          |
	|          																				  |
	******************************************************************************************/
	public function calcFoundRows()
	{ 
		$this->calcFoundRows = ' SQL_CALC_FOUND_ROWS '; 
		return $this; 
	}
}