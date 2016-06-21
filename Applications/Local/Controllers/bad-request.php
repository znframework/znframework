<?php
//--------------------------------------------------------------------------------------------------------
// Bad Request
//--------------------------------------------------------------------------------------------------------
//
// Geçersiz istek yapıldığında çalıştırılacak olan yönlendirmedir. Hangi isteklerin hangi rotaya
// gideceğini ayarlamak için Configurations/Route.php ayar dosyasında yer alan 'errorDocuments' 
// ayarı kullanılır.
//
//--------------------------------------------------------------------------------------------------------
Route::run('code', function($code = '')
{
	report('BadRequest', Http::code($code) ,'BadRequest');
		
	die(Errors::message(Http::code($code), true));
});