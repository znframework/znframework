<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>@$title:</title>
<style>
body{ font-family:Consolas, Monaco, monospace; font-size:14px; }
</style>
</head>

<body>
	<p><h4>Dikkat Edilmesi Gerekenler</h4></p>
    <p>1 - /@, : gibi symboller şablon sihirbazının kullandığı özel karakterler olduğu içi bu karakterler, normal karakter gibi kullanmak için başına / sembolü getirin. Örnek /@, /: gibi</p>
	<br />
    
    <p><h4>Değişkenlerin ve Fonksiyonlın Yazdırılması</h4></p>
    <p>@@baseUrl(CURRENT_PATH):</p>
    <p>{{ baseUrl(CURRENT_PATH) }}</p>
    <p>@$title:</p>
    <p>Html Entities/: {{{ $title }}}</p>
    <br />
    
    <p><h4>Karar Yapıların Kullanımı</h4></p>
    <p>
    @if( 3 > 1 ):
    	true.
    @elseif( 1 > 3):
    	real true.
    @else:
    	false.
    @endif:
    </p>
    <br />
    
    <p><h4>Döngülerin Kullanımı</h4></p>
    <p>
    @for( $i = 0; $i < 10; $i++):
    	@$i:<br>
    @endfor:  
    </p>   
  	<br />

	<p><h4>Sınıfların Kullanımı</h4></p>
    <p>@@Form::id('example')->button('example', 'Example'):</p>  
    <p>{{ output(DB::get('user_example')->result()) }}</p> 
</body>

</html>