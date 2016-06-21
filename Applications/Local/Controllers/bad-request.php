<?php
//--------------------------------------------------------------------------------------------------------
// Bad Request
//--------------------------------------------------------------------------------------------------------
//
// Geçersiz istek yapıldığında çalıştırılacak olan yönlendirmedir. Hangi isteklerin hangi rotaya
// gideceğini ayarlamak için Configurations/Route.php ayar dosyasında yer alan 'errorDocuments' 
// ayarı kullanılır. 
//
// setHtaccessFile: ayarı true olarak ayarlanırsa geçersiz istekler bu sayfaya yönlendirilir.
//
//--------------------------------------------------------------------------------------------------------
Route::run('code', function($code = '')
{
	$message = Http::code($code);
	$title   = 'BadRequest';
	
	report($title, $message ,$title);
		
	die(Errors::message($message, true));
});