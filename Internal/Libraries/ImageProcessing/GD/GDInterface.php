<?php
namespace ZN\ImageProcessing;

interface GDInterface
{
	/***********************************************************************************/
	/* GRAPHIC LIBRARY						                   	                       */
	/***********************************************************************************/
	/* Yazar: Ozan UYKUN <ozanbote@windowslive.com> | <ozanbote@gmail.com>
	/* Site: www.zntr.net
	/* Lisans: The MIT License
	/* Telif Hakkı: Copyright (c) 2012-2016, zntr.net
	/*
	/* Sınıf Adı: GD
	/* Versiyon: 2.0 Eylül Güncellemesi
	/* Tanımlanma: Statik, Dinamik
	/* Dahil Edilme: Gerektirmez
	/* Erişim: GD::, $this->GD, zn::$use->GD, uselib('GD')
	/* Not: Büyük-küçük harf duyarlılığı yoktur.
	/***********************************************************************************/
	
	/******************************************************************************************
	* INFO                                                                                    *
	*******************************************************************************************
	| Genel Kullanım: Kurulu GD kütüphanesi hakkında bilgi verir.							  |
	
	  @param  void 
	  @return array
	|          																				  |
	******************************************************************************************/
	public function info();
	
	/******************************************************************************************
	* THUMB                                                                               *
	*******************************************************************************************
	| Genel Kullanım: Image kütüphanesinin thumb() işlevini uygular.     					  |
	
	  @param  string $filePath 
	  @param  array  $settings
	  @return string
	|          																				  |
	******************************************************************************************/
	public function thumb($filePath, $settings);
	
	/******************************************************************************************
	* CANVAS                                                                                  *
	*******************************************************************************************
	| Genel Kullanım: Yeni bir paletli resim oluşturur.										  |
	
	  @param  numeric  $width
	  @param  numeric  $height
	  @param  numeric  $rgb transparent
	  @param  numeric  $real false -> false:create, true:createtruecolor
	   
	  @return resource
	|          																				  |
	******************************************************************************************/
	public function canvas($width, $height, $rgb, $real, $p1);
	
	/******************************************************************************************
	* CREATE FROM                                                                             *
	*******************************************************************************************
	| Genel Kullanım: Belirtilen türe göre kaynaktan resim oluşturulur. 					  |
	
	  @param  string  $type -> gd2, gd2p, gd, gif, jpeg, png, string, wbmp, webp, xbm, xpm
	  @param  string  $source
	   
	  @return resource
	|          																				  |
	******************************************************************************************/
	public function createFrom($type, $source, $x, $y, $width, $height);
	
	/******************************************************************************************
	* SIZE                                                                                    *
	*******************************************************************************************
	| Genel Kullanım: Bir resmin boyutlarını döndürür.										  |
	
	  @param  string $fileName 
	  @return object
	|          																				  |
	******************************************************************************************/
	public function size($fileName);
	
	/******************************************************************************************
	* TYPE EXTENSION                                                                          *
	*******************************************************************************************
	| Genel Kullanım: Resim türüne göre uzantısını verir.				        			  |
	
	  @param  mixed $type
	  @param  bool  $dote true 
	  @return string
	|          																				  |
	******************************************************************************************/
	public function extension($type, $dote);
	
	/******************************************************************************************
	* TYPE MIME                                                                               *
	*******************************************************************************************
	| Genel Kullanım: Resim türüne göre mime türünü verir.				        			  |
	
	  @param  mixed $type
	  @return string
	|          																				  |
	******************************************************************************************/
	public function mime($type);
	
	/******************************************************************************************
	* TO WBMP                                                                                 *
	*******************************************************************************************
	| Genel Kullanım: Bir dosyaya veya tarayıcıya bir WBMP resmi çıktılar.	      			  |
	
	  @param  string   $fileName
	  @param  numeric  $threshold
	  @return bool
	|          																				  |
	******************************************************************************************/
	public function toWbmp($fileName, $threshold);
	
	/******************************************************************************************
	* JPEG TO WBMP                                                                            *
	*******************************************************************************************
	| Genel Kullanım: Jpeg formatlı resmi wbmp formatına çevirir.			      			  |
	
	  @param  string   $jpegFile
	  @param  string   $wbmpFile
	  @param  array	   $settings -> width, height, threshold
	  
	  @return bool
	|          																				  |
	******************************************************************************************/
	public function jpegToWbmp($jpegFile, $wbmpFile, $settings);
	
	/******************************************************************************************
	* PNG TO WBMP                                                                             *
	*******************************************************************************************
	| Genel Kullanım: Png formatlı resmi wbmp formatına çevirir.			      			  |
	
	  @param  string   $jpegFile
	  @param  string   $wbmpFile
	  @param  array	   $settings -> width, height, threshold
	  
	  @return bool
	|          																				  |
	******************************************************************************************/
	public function pngToWbmp($pngFile, $wbmpFile, $settings);
	
	/******************************************************************************************
	* ALPHA BLENDING                                                                          *
	*******************************************************************************************
	| Genel Kullanım: Bir resim için harmanlama kipini etkinleştirir.		      			  |
	
	  @param  bool     $blendMode false
	  @return bool
	|          																				  |
	******************************************************************************************/
	public function alphaBlending($blendMode);
	
	/******************************************************************************************
	* SAVE ALPHA                                                                              *
	*******************************************************************************************
	| Genel Kullanım: PNG resimleri kaydederken (tek renkli şeffaflığın tersine) alfa kanalı  |
	  bilgisinin kaydedilip kaydedilmeyeceğini belirtir.		      			 
	
	  @param  bool     $save true
	  @return object
	|          																				  |
	******************************************************************************************/
	public function saveAlpha($save);
	
	/******************************************************************************************
	* SMOOTH	                                                                              *
	*******************************************************************************************
	| Genel Kullanım: Resmin kenarlarına yumuşatma uygular .	        	      			  |

	  @param  bool     $mode true
	  @return bool
	|          																				  |
	******************************************************************************************/
	public function smooth($mode);
	
	/******************************************************************************************
	* ARC                                                                                     *
	*******************************************************************************************
	| Genel Kullanım: Yay çizer.	  								      	      			  |
	
	  @param  array    $settings
				       $settings['type'] = pie, chord, nofill, edged
	  @return bool
	|          																				  |
	******************************************************************************************/
	public function arc($settings);
	
	/******************************************************************************************
	* ELLIPSE                                                                                 *
	*******************************************************************************************
	| Genel Kullanım: Bir elips çizer.	 							      	      			  |
	
	  @param  array    $settings
	  				   $settings['type'] fill veya NULL
	  @return bool
	|          																				  |
	******************************************************************************************/
	public function ellipse($settings);
	
	/******************************************************************************************
	* POLYGON                                                                                 *
	*******************************************************************************************
	| Genel Kullanım: Çokgen çizer.	 								      	      			  |
	
	  @param  array    $settings
	  				   $settings['type'] fill ve NULL
	  @return bool
	|          																				  |
	******************************************************************************************/
	public function polygon($settings);
	
	/******************************************************************************************
	* RECTANGLE                                                                               *
	*******************************************************************************************
	| Genel Kullanım: Dörtgen çizer.								      	      			  |
	
	  @param  array    $settings
	  				   $settings['type'] fill ve NULL
	  @return bool
	|          																				  |
	******************************************************************************************/
	public function rectangle($settings);
	
	
	/******************************************************************************************
	* FILL                                                                                    *
	*******************************************************************************************
	| Genel Kullanım: Resmi boyar.	 								      	      			  |

	  @param  array    $settings
	  @return bool
	|          																				  |
	******************************************************************************************/
	public function fill($settings);
	
	/******************************************************************************************
	* FILL AREA                                                                               *
	*******************************************************************************************
	| Genel Kullanım: Resmin belirli bir alanını boyamak için kullanılır.					  |
	
	  @param  array    $settings
	  @return bool
	|          																				  |
	******************************************************************************************/
	public function fillArea($settings);
	
	/******************************************************************************************
	* FILTER                                                                                  *
	*******************************************************************************************
	| Genel Kullanım: Bir resme bir süzgeç uygular.											  |
	
	  @param  mixed    $filter negate, grayscale, brigthness, contrast, colorize, edgedetect
	  						   emboss, gaussian_blur, selective_blur, mean_removel, smooth
							   pixelate
	  [ @param  mixed    $arg1 ]
	  [ @param  mixed    $arg2 ]
	  [ @param  mixed    $arg3 ]
	  [ @param  mixed    $arg4 ]
	  
	  @return bool
	|          																				  |
	******************************************************************************************/
	public function filter($filter, $arg1, $arg2, $arg3, $arg4);
	
	/******************************************************************************************
	* FLIP                                                                                    *
	*******************************************************************************************
	| Genel Kullanım: Belirli bir modunu kullanarak görüntüyü çevirir.						  |
	
	  @param  mixed    $type both, horizontal, vertical
	  
	  @return bool
	|          																				  |
	******************************************************************************************/
	public function flip($type);
	
	/******************************************************************************************
	* CHAR                                                                                    *
	*******************************************************************************************
	| Genel Kullanım: Yatay olarak bir karakter çizer.				      	      			  |
	
	  @param  string   $char
	  @param  array    $settings
	  				   $settings['type'] horizontal, vertical
	  @return bool
	|          																				  |
	******************************************************************************************/
	public function char($char, $settings); 
	
	/******************************************************************************************
	* TEXT                                                                                    *
	*******************************************************************************************
	| Genel Kullanım: Yatay olarak bir metin çizer.		     		      	      			  |
	
	  @param  string   $text
	  @param  array    $settings
	  				   $settings['type'] horizontal, vertical
	  @return bool
	|          																				  |
	******************************************************************************************/
	public function text($text, $settings);
	
	/******************************************************************************************
	* CLOSEST                                                                                 *
	*******************************************************************************************
	| Genel Kullanım: Alfası ile birlikte belirtilen rengin en yakın benzerinin renk 		  |
	  indisini verir.	     	      			 
	
	  @param  numeric  $alpha 0
	  @param  string   $rgb
	  
	  @return int
	|          																				  |
	******************************************************************************************/
	public function closest($rgb);
	
	/******************************************************************************************
	* ALPHA RESOLVE                                                                           *
	*******************************************************************************************
	| Genel Kullanım: Alfası ile birlikte belirtilen rengin en yakın benzerinin renk 		  |
	  indisini verir.	     	      			 
	
	  @param  numeric  $alpha 0
	  @param  string   $rgb
	  
	  @return int
	|          																				  |
	******************************************************************************************/
	public function resolve($rgb);
	
	/******************************************************************************************
	* ALPHA INDEX                                                                             *
	*******************************************************************************************
	| Genel Kullanım: Alfası ile birlikte belirtilen rengin indisini verir.					  |	     	      			 
	
	  @param  numeric  $alpha 0
	  @param  string   $rgb
	  
	  @return int
	|          																				  |
	******************************************************************************************/
	public function index($rgb);
	
	/******************************************************************************************
	* PIXEL INDEX                                                                             *
	*******************************************************************************************
	| Genel Kullanım: Bir pikselin renk indisini döndürür.	    		 	      			  |
	
	  @param  numeric  $x 0
	  @param  numeric  $y 0
	  
	  @return int
	|          																				  |
	******************************************************************************************/
	public function pixelIndex($x, $y);
	
	/******************************************************************************************
	* CLOSEST HWB	             		                                                      *
	*******************************************************************************************
	| Genel Kullanım: Belirtilen En yakın renk sıcaklığına, beyaz ve siyahlığa sahip renk	  | 
	  indisini verir.	  			

	  @param  string   $rgb
	  
	  @return int
	|          																				  |
	******************************************************************************************/
	public function closestHwb($rgb);
	
	/******************************************************************************************
	* MATCH         	         		                                                      *
	*******************************************************************************************
	| Genel Kullanım: Bir resmin paletli sürümünün renklerini gerçek renkli sürümünün 		  |	
	| renkleriyle aynı yapar.	  								  						
	
	  @param  resource $sourceImage
	  
	  @return bool
	|          																				  |
	******************************************************************************************/
	public function match($sourceImage);
	
	/******************************************************************************************
	* SET		       	         		                                                      *
	*******************************************************************************************
	| Genel Kullanım: Bir palet indisi için renk tanımlar.	  								  |		
	
	  @param  numeric  $index 0
	  @param  string   $rgb
	  
	  @return void
	|          																				  |
	******************************************************************************************/
	public function set($index, $rgb);
	
	/******************************************************************************************
	* TOTAL		    	         		                                                      *
	*******************************************************************************************
	| Genel Kullanım: Bir resim paletindeki renk sayısını döndürür.							  |		
	
	  @return int
	|          																				  |
	******************************************************************************************/
	public function total();
	
	/******************************************************************************************
	* TRANSPARENT     	         		                                                      *
	*******************************************************************************************
	| Genel Kullanım: Bir rengi şeffaflaştırır.	 			 								  |		
	
	  @param  string   $rgb
	  
	  @return int
	|          																				  |
	******************************************************************************************/
	public function transparent($rgb);
	
	/******************************************************************************************
	* CONVOLUTION     	         		                                                      *
	*******************************************************************************************
	| Genel Kullanım: Bir konum ve katsayı ile 3x3'lük bir kıvrım matrisini uygular.		  |		
	
	  @param  array    $matrix
	  @param  float    $div
	  @param  float    $offset
	  
	  @return bool
	|          																				  |
	******************************************************************************************/
	public function convolution($matrix, $div, $offset);
	
	/******************************************************************************************
	* INTERLACE     	         		                                                      *
	*******************************************************************************************
	| Genel Kullanım: Karışımlılığı açıp kapar.		 										  |		
	
	  @param  numeric $interlace 0
	  
	  @return int
	|          																				  |
	******************************************************************************************/
	public function interlace($interlace);
	
	/******************************************************************************************
	* COPY                                                                                    *
	*******************************************************************************************
	| Genel Kullanım: Bir resim parçasını kopyalar.					      	      			  |
	
	  @param  resource $target
	  @param  array    $settings -> xt, yt, xs, ys, width, height
	  
	  @return bool
	|          																				  |
	******************************************************************************************/
	public function copy($source, $settings);
	
	/******************************************************************************************
	* MIX                                                                                     *
	*******************************************************************************************
	| Genel Kullanım: Bir resmi kopyalar ve karıştırır.				      	      			  |

	  @param  resource $target
	  @param  array    $settings -> xt, yt, xs, ys, width, height, percent
	  
	  @return bool
	|          																				  |
	******************************************************************************************/
	public function mix($source, $settings);
	
	/******************************************************************************************
	* MIX GRAY                                                                                *
	*******************************************************************************************
	| Genel Kullanım: Bir resmi kopyalar ve VE gri ile karıştırır.	     	      			  |
	
	  @param  resource $source
	  @param  resource $target
	  @param  array    $settings -> xt, yt, xs, ys, width, height, percent
	  
	  @return bool
	|          																				  |
	******************************************************************************************/
	public function mixGray($source, $settings);
	
	/******************************************************************************************
	* RESAPMPLE                                                                               *
	*******************************************************************************************
	| Genel Kullanım: Resmin bir parçasını örnekleyerek kopyalar ve boyutlandırır. 			  |
	
	  @param  resource $source
	  @param  array    $settings -> xt, yt, xs, ys, wt, ht, ws, hs
	
	  @return bool
	|          																				  |
	******************************************************************************************/
	public function resample($source, $settings);
	
	/******************************************************************************************
	* RESIZE                                                                                  *
	*******************************************************************************************
	| Genel Kullanım: Resmin bir parçasını kopyalar ve boyutlandırır. 		             	  |
	
	  @param  resource $source
	  @param  array    $settings -> xt, yt, xs, ys, wt, ht, ws, hs
	
	  @return bool
	|          																				  |
	******************************************************************************************/
	public function resize($source, $settings);
	
	/******************************************************************************************
	* CROP                                                                                    *
	*******************************************************************************************
	| Genel Kullanım: Resmin bellir bir parçasını alır.				 		             	  |
	
	  @param  array    $settings -> x, y, width, height
	
	  @return resource
	|          																				  |
	******************************************************************************************/
	public function crop($settings);
	
	/******************************************************************************************
	* AUTO CROP                                                                               *
	*******************************************************************************************
	| Genel Kullanım: Resmin belli bir parçasını alır.				 		             	  |
	
	  @param  mixed    $mode default, transparent, black, white, threshold, sides
	  @param  numeric  $threshold
	  @param  numeric  $color   
	
	  @return resource
	|          																				  |
	******************************************************************************************/
	public function autoCrop($mode, $threshold, $color);
	
	/******************************************************************************************
	* LINE                                                                                    *
	*******************************************************************************************
	| Genel Kullanım: Çizgi çizmek için kullanılır. 						             	  |
	
	  @param  array    $settings -> x1, y1, x2, y2, color, type -> solid, dashed
	
	  @return bool
	|          																				  |
	******************************************************************************************/
	public function line($settings);
	
	/******************************************************************************************
	* FONT HEIGHT                                                                             *
	*******************************************************************************************
	| Genel Kullanım: Font yüksekliğini döndürür.											  |
	
	  @param  numeric $height = 0
	  
	  @return int
	|          																				  |
	******************************************************************************************/
	public function fontHeight($height);
	
	/******************************************************************************************
	* FONT WIDTH                                                                              *
	*******************************************************************************************
	| Genel Kullanım: Font genişliğini döndürür.											  |
	
	  @param  numeric $width = 0
	  
	  @return int
	|          																				  |
	******************************************************************************************/
	public function fontWidth($width);
	
	/******************************************************************************************
	* QUALITY                                                                                 *
	*******************************************************************************************
	| Genel Kullanım: Resim kalitesini ayarlar.												  |
	
	  @param  numeric $quality
	  
	  @return numeric
	|          																				  |
	******************************************************************************************/
	public function quality($quality);
	
	/******************************************************************************************
	* SAVE                                                                                    *
	*******************************************************************************************
	| Genel Kullanım: Resmin hangi dosyaya kaydedileceği.									  |
	
	  @param  string $file NULL
	  
	  @return object
	|          																				  |
	******************************************************************************************/
	public function save($file);
	
	/******************************************************************************************
	* TYPE                                                                                    *
	*******************************************************************************************
	| Genel Kullanım: Resmin hangi türde olacağı ayarlanır.									  |
	
	  @param  string $type jpeg
	  
	  @return object
	|          																				  |
	******************************************************************************************/
	public function type($type);
	
	/******************************************************************************************
	* OUTPUT                                                                                  *
	*******************************************************************************************
	| Genel Kullanım: Resim çıktısı oluşturulsun mu?.										  |
	
	  @param  bool $output true
	  
	  @return object
	|          																				  |
	******************************************************************************************/
	public function output($output);
	
	/******************************************************************************************
	* SCREEN SHOT                                                                             *
	*******************************************************************************************
	| Genel Kullanım: Ekran görüntüsünü alır.												  |
	
	  @param  void
	  
	  @return object
	|          																				  |
	******************************************************************************************/
	public function screenshot();
	
	/******************************************************************************************
	* ROTATE                                                                                  *
	*******************************************************************************************
	| Genel Kullanım: Resmi döndürür.	    												  |
	
	  @param  numeric $angle 0
	  [ @param string $spaceColor 0|0|0 ]
	  [ @param numeric $ignoreTransparent 0 ]
	  
	  @return resource
	|          																				  |
	******************************************************************************************/
	public function rotate($angle, $spaceColor, $ignoreTransparent);
	
	/******************************************************************************************
	* SCALE                                                                                   *
	*******************************************************************************************
	| Genel Kullanım: Resmin ölçülendirmek için kullanılır.									  |
	
	  @param  numeric $width
	  [ @param numeric $height -1 ]
	  [ @param numeric $mode bilinear_fixed, nearest_neightbour, bicubic, bicubic_fixed ]
	  
	  @return resource
	|          																				  |
	******************************************************************************************/
	public function scale($width, $height, $mode);
	
	/******************************************************************************************
	* INTERPOLATION                                                                           *
	*******************************************************************************************
	| Genel Kullanım: Interpolation değeri ayarlanır.		     							  |
	
	  [ @param numeric $height bilinear_fixed, bell, bessel, bicubic, hamming, hanning ... ]
	  
	  @return object
	|          																				  |
	******************************************************************************************/
	public function interpolation($method);
	
	/******************************************************************************************
	* PIXEL                                                                                   *
	*******************************************************************************************
	| Genel Kullanım: Bir pikselin rengini değiştirir.		     							  |
	
	  @param array $settings
	  
	  @return object
	|          																				  |
	******************************************************************************************/
	public function pixel($settings);
	
	/******************************************************************************************
	* STYLE                                                                                   *
	*******************************************************************************************
	| Genel Kullanım: Çizgi tarzını ayarlar.				     							  |
	
	  @param array $style
	  
	  @return object
	|          																				  |
	******************************************************************************************/
	public function style($style);
	
	/******************************************************************************************
	* THICKNESS                                                                               *
	*******************************************************************************************
	| Genel Kullanım: Çizgi kalınlığını ayarlar.			     							  |
	
	  @param numeric $thickness
	  
	  @return object
	|          																				  |
	******************************************************************************************/
	public function thickness($thickness);
	
	/******************************************************************************************
	* TILE                                                                                    *
	*******************************************************************************************
	| Genel Kullanım: Resmi doldurmak için döşemeyi etkin kılar.							  |
	
	  @param resource $tile
	  
	  @return object
	|          																				  |
	******************************************************************************************/
	public function tile($tile);
	
	/******************************************************************************************
	* WINDOW DISPLAY                                                                          *
	*******************************************************************************************
	| Genel Kullanım: Bir pencereyi yakalar.												  |
	
	  @param  numeric $window 0
	  @param  numeric $clientArea 0
	  
	  @return object
	|          																				  |
	******************************************************************************************/
	public function windowDisplay($window, $clientArea);
	
	/******************************************************************************************
	* LAYER EFFECT                                                                            *
	*******************************************************************************************
	| Genel Kullanım:  PHP ile gelen libgd'nin katmanlama etkisini kullanmak için alfa		  | 
	  harmanlama seçeneğini ayarlar.											 	
	
	  @param  mixed $effect normal, replace, overlay
	  
	  @return int
	|          																				  |
	******************************************************************************************/
	public function layerEffect($effect);
	
	/******************************************************************************************
	* LOAD FONT                                                                               *
	*******************************************************************************************
	| Genel Kullanım: Yeni bir bit eşlemli yazı tipi yükler.								  |											 	
	
	  @param  mixed $effect normal, replace, overlay
	  
	  @return int
	|          																				  |
	******************************************************************************************/
	public function loadFont($file);
	
	/******************************************************************************************
	* COPY PALETTE                                                                            *
	*******************************************************************************************
	| Genel Kullanım: Paleti bir resimden diğerine kopyalar.								  |											 	
	
	  @param  resource $source
	  
	  @return void
	|          																				  |
	******************************************************************************************/
	public function copyPalette($source);
	
	/******************************************************************************************
	* CANVAS WIDTH                                                                            *
	*******************************************************************************************
	| Genel Kullanım: Resmin genişliğini verir.												  |											 	
	
	  @param  void
	  
	  @return numeric
	|          																				  |
	******************************************************************************************/
	public function canvasWidth();
	
	/******************************************************************************************
	* CANVAS HEIGHT                                                                           *
	*******************************************************************************************
	| Genel Kullanım: Resmin yüksekliğini verir.											  |											 	
	
	  @param  void
	  
	  @return numeric
	|          																				  |
	******************************************************************************************/
	public function canvasHeight();
	
	/******************************************************************************************
	* TYPES                                                                                   *
	*******************************************************************************************
	| Genel Kullanım: Kurulu PHP'nin desteklediği resim türlerini döndürür.					  |											 	
	
	  @param  void
	  
	  @return numeric
	|          																				  |
	******************************************************************************************/
	public function types();
	
	/******************************************************************************************
	* GENERATE                                                                                *
	*******************************************************************************************
	| Genel Kullanım: Resmi oluşturur.														  |
	
	  @param  void
	  
	  @return resource
	|          																				  |
	******************************************************************************************/
	public function generate($type, $save);
	
	/******************************************************************************************
	* RESULT         				                                                          *
	*******************************************************************************************
	| Genel Kullanım: Kaydedilen resmi çıktısını görüntülemek için kullanılır.				  |
	
	  @param void
	  
	  @retur string
	|          																				  |
	******************************************************************************************/
	public function result();
}