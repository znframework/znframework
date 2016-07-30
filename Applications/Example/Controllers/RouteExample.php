<?php
Route::run('main', function()
{	
	$data['title']        = 'Route Example';
	$data['subtitle']     = 'RouteExample';
	$data['examples']     = 
	[
		'example',
		'change-uri',
	];
	
	$data['requirements'] = [];
	
	Import::view('main', $data); 
});

Route::run('example', function()
{
	echo 'Route Example Page';
});

// change() yöntemi ile rota değişikliği yapabilirsiniz.
Route::change(['change-uri' => 'helloWorld'])->run('helloWorld', function()
{
	echo 'Change URI: Hello World';
});