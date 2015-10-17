<?php
class __USE_STATIC_ACCESS__Route
{
	/***********************************************************************************/
	/* ROUTE LIBRARY																   */
	/***********************************************************************************/
	/* Yazar: Ozan UYKUN <ozanbote@windowslive.com> | <ozanbote@gmail.com>
	/* Site: www.zntr.net
	/* Lisans: The MIT License
	/* Telif Hakkı: Copyright (c) 2012-2015, zntr.net
	/*
	/* Sınıf Adı: Driver
	/* Versiyon: 2.0 Ekim Güncellemesi
	/* Tanımlanma: Mixed
	/* Dahil Edilme: Gerektirmez
	/* Erişim: Route::.
	/* Not: Büyük-küçük harf duyarlılığı yoktur.
	/***********************************************************************************/
	
	/******************************************************************************************
	* RUN                                                                                     *
	*******************************************************************************************
	| Genel Kullanım: Çalıştırılmak istenen kod bloklarını yönetmek için kullanılır.										  							  
	  
	  @param  string   $functionName
	  @param  function $functionRun
	  @return mixed
	|          																				  |
	******************************************************************************************/
	public function run($functionName = '', $functionRun = '')
	{
		$datas = Structure::datas();
		
		$parameters = $datas['parameters'];
		$isFile     = $datas['isFile'];
		$function   = $datas['function'];
	
		if( file_exists($isFile) )
		{
			if( $functionName === $function )
			{
				if( is_callable($functionRun) )
				{
					if( APP_TYPE === 'local' )
					{
						set_error_handler('Exceptions::table');	
					}
						
					call_user_func_array($functionRun, $parameters);	
					
					if( APP_TYPE === 'local' )
					{
						restore_error_handler();
					}
				}
				else
				{
					// Sayfa bilgisine erişilemezse hata bildir.
					if( ! Config::get('Route', 'show404') )
					{				
						// Hatayı ekrana yazdır.
						echo Error::message('Error', 'callUserFuncArrayError', $functionRun);
						
						// Hatayı rapor et.
						report('Error', getMessage('Error', 'callUserFuncArrayError'), 'SystemCallUserFuncArrayError');
						
						// Çalışmayı durdur.
						return false;
					}
					else
					{
						redirect(Config::get('Route', 'show404'));
					}
				}
			}
		}
	}	
}