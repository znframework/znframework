<?php
/************************************************************/
/*                          LOG                             */
/************************************************************/
/*

Author: Ozan UYKUN
Site: http://www.zntr.net
Copyright 2012-2015 zntr.net - Tüm hakları saklıdır.

/******************************************************************************************
* LOG                                                                        		  	  *
*******************************************************************************************
| Genel Kullanım: Log dosyası ile ilgili ayarları içerir.	     						  |
******************************************************************************************/

/******************************************************************************************
* CREATE FILE                                                                      		  *
*******************************************************************************************
| Genel Kullanım: Çalışma esnasında oluşan kod hatalarını kayıt altına alır.			  |
| Parametreler: true veya false															  |
| Varsayılan: false																		  |
| Kayıtlar Logs/ dizini içerisinde kayıt altına alınmaktadır.	     					  |
******************************************************************************************/
$config['Log']['create_file'] = false;

/******************************************************************************************
* FILE TIME                                                                      		  *
*******************************************************************************************
| Genel Kullanım: Log dosyalarının ne kadar süre ile kayıtları tutacağı ayarlanır.		  |
| Parametreler: Metinsel türde zaman bilgileri day, month, year							  |
| Varsayılan: 30 day																	  |
| Sürenin dolması durumunda herhangi bir hata oluştuğunda eski kayıtlar					  |
| silinir ve yeni hata kaydı eklenir. Böylece Log dosyalarının şismesinin				  |
| önüne geçilmiş olur.	     					  										  |					
******************************************************************************************/
$config['Log']['file_time'] = '30 day';