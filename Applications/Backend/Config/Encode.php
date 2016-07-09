<?php
//----------------------------------------------------------------------------------------------------
// ENCODE 
//----------------------------------------------------------------------------------------------------
//
// Author     : Ozan UYKUN <ozanbote@windowslive.com> | <ozanbote@gmail.com>
// Site       : www.znframework.com
// License    : The MIT License
// Copyright  : Copyright (c) 2012-2016, ZN Framework
//
//----------------------------------------------------------------------------------------------------

//----------------------------------------------------------------------------------------------------
// Crypto Driver
//----------------------------------------------------------------------------------------------------
//
// Genel Kullanım: Veri şifrelemede kullanılan şifreleme sürücüleri.						  
//
// @drivers: mcyrpt, openssl, hash, phash, mhash
//																						  								
//----------------------------------------------------------------------------------------------------
$config['Encode']['driver'] = 'mcrypt';

//----------------------------------------------------------------------------------------------------
// Type
//----------------------------------------------------------------------------------------------------
//
// Genel Kullanım: Encode.php kütüphanesinde yer alan yöntemlerin temel olarak hangi		  
// şifreleme algoritmasını kullanacağı seçmek için kullanılır. Şifrelenmesini istediğiniz  
// hash algoritmasını yazmanız yeterlidir.				 								  										
//
//----------------------------------------------------------------------------------------------------
$config['Encode']['type'] = 'md5';

//----------------------------------------------------------------------------------------------------
// Project Key
//----------------------------------------------------------------------------------------------------
// Genel Kullanım: Encode sınıfına ait super() yöntemi için oluşturulmuş şifrelemeye	      
// dahil edilecek ilave karakter ayarıdır. Böyle bir kullanımın oluşturulmasının temel	  
// amacı her projede yer alan kullanıcı şifrelerinin birbirlerinden farklı olmasını 		  
// sağlayarak şifre güvenliğini sağlamaktır.					     						  
//----------------------------------------------------------------------------------------------------
$config['Encode']['projectKey'] = 'default project';