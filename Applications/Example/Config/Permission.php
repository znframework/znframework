<?php
//----------------------------------------------------------------------------------------------------
// PERMISSION 
//----------------------------------------------------------------------------------------------------
//
// Author     : Ozan UYKUN <ozanbote@windowslive.com> | <ozanbote@gmail.com>
// Site       : www.znframework.com
// License    : The MIT License
// Copyright  : Copyright (c) 2012-2016, ZN Framework
//
//----------------------------------------------------------------------------------------------------

//----------------------------------------------------------------------------------------------------
// Örnek Kullanıcı Rolleri                                               
//----------------------------------------------------------------------------------------------------
//
// 1 User																				  
// 2 Moderator																			  
// 3 Supermoderator																		  
// 4 admin																				  
// 5 Superadmin																			  
// 6 Administrator										 	     					  	  
// .																						  
// .																						  
//																						  
//----------------------------------------------------------------------------------------------------

//----------------------------------------------------------------------------------------------------
// Page
//----------------------------------------------------------------------------------------------------
//
// Genel Kullanım: İzin verilen sayfaları belirlemek için "perm->|s1|s2" şeklinde kullanın.
// İzin vermek istemediğiniz sayfaları belirlemek için "noperm->|s1|s2" şeklinde kullanın. 
// Hiç bir sayfaya izin vermemek için any parametresini kullanın.						  
// Her sayfaya izin vermek için all parametresiniz kullanın								  
// Tek bir sayfaya izin vermek istediğinide normal olarak yazın.							  
// Tek bir sayfaya izin vermek istemediğinizde ise başına "!" işareti koyarak yazın.	
//	  
//----------------------------------------------------------------------------------------------------
$config['Permission']['page'] =
[
	//'1' => 'any',
	//'2' => 'any',
	//'3' => ['noperm' 	=> ['sayfa1', 'sayfa2']],
	//'4' => ['perm' 	=> ['sayfa3', 'sayfa4']],
	//'5' => ['noperm' 	=> ['sayfa5', 'sayfa6']],
	//'6' => 'all'
];

//----------------------------------------------------------------------------------------------------
// Process
//----------------------------------------------------------------------------------------------------
//
// Genel Kullanım: İzin verilen nesneleri belirlemek için "perm->|s1|s2" şeklinde kullanın.
// İzin vermek istemediğiniz nesneleri belirlemek için "noperm->|s1|s2" şeklinde kullanın. 
// Hiç bir nesneye izin vermemek için any parametresini kullanın.						  
// Her nesneye izin vermek için all parametresiniz kullanın								  
// Tek bir nesneye izin vermek istediğinide normal olarak yazın.						      
// Tek bir nesneye izin vermek istemediğinizde ise başına "!" işareti koyarak yazın.		  
//
//----------------------------------------------------------------------------------------------------
$config['Permission']['process'] =
[
	//'1' => 'any',
	//'2' => 'any',
	//'3' => ['noperm' 	=> ['yetki1', 'yetki2']],
	//'4' => ['noperm' 	=> ['yetki3', 'yetki4']],
	//'5' => ['noperm' 	=> ['yetki5', 'yetki6']],
	//'6' => 'all'
];