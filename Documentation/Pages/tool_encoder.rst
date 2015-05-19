<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>ZN KOD ÇATISI</title>
<link type="text/css" rel="stylesheet" href="../Styles/Structure.css" />
<script src="../Scripts/Jquery.js"></script>
<script src="../Scripts/Structure.js"></script>
</head>

<body>
    <div id="content-document"><a href="#">Döküman</a> » <a href="tools.html">Araçlar</a> » Encoder(Şifreleme) Aracı</div> 
    <p class="ctfont">Encoder(Şifreleme) Aracı</p>
    <p>Şifreleme üzerine geliştirilmiş bir araçtır.</p>
    <ul><li><a href="#" class="infont">Encoder(Şifreleme)) Aracı ve Yöntemleri</a><br><br>
        <ul>
        	<li><a href="#encoder_import">Encoder Aracını Dahil Etmek</b></a></li>
            <li><a href="#encoder">Şifreleme Aracı » <b>encoder()</b></a></li>
            <li><a href="#php_tag_encoder">Php Taglarını Şifreleme Aracı » <b>php_tag_encoder()</b></a></li>
            <li><a href="#nail_encoder">Tırnak İşaretlerini Şifreleme Aracı » <b>nail_encoder()</b></a></li>
            <li><a href="#foreign_char_encoder">Yabancı Karakterleri Şifreleme Aracı » <b>foreign_char_encoder()</b></a></li>
        </ul>
    </li></ul>
    
    
   	<p class="cstfont" id="encoder_import">Encoder Aracını Dahil Etmek</p>
	<div type="code">import::tool(<sf>'Encoder'</sf>)</div>
    
    
    <p class="cstfont" id="encoder">Şifreleme Aracı</p>
    <p><ftype>encoder( <kf>string</kf> <vf>$metin</vf> , [ <kf>string</kf> <vf>$tipi</vf> = <sf>'md5'</sf> ] )</ftype></p>
    <p>Şifreleme için kullanılır.</p>
    
    <p>
    	<table class="cfont">
        	<tr><th>No</th><th>Parametreler</th><td>Anlamları</td></tr>
            <tr><th>1</th><th>string Metin</th><td>Şifrelenecek metin.</td></tr>
            <tr><th>2</th><th>[ string Tip = "md5" ]</th><td>Şifreleme türü. Varsayılan: md5</td></tr>
            <tr><th colspan="3">Şifreleme Tipleri</th></tr>
            <tr><th>1</th><td colspan="2">md5</td></tr>
            <tr><th>2</th><td colspan="2">sha1</td></tr>
            <tr><th>3</th><td colspan="2">Hash algoritmalarından herhangi biri( md2 , md4 , sha256 , ripemd128 , crc32 ..)</td></tr>
        </table>
    </p>
    
	<div type="code">
    <kf>echo</kf> encoder(<sf>'Metin'</sf>); <comment>/* Çıktı: 82f86b3ab8d192591fecc24a4db76a6b */</comment><br>
    <kf>echo</kf> encoder(<sf>'Metin'</sf> , <sf>'sha1'</sf>); <comment>/* Çıktı: 2c8a418f0b90694827c9d7735c041c5709fc01f9 */</comment><br>
    </div>
    
    
    <p class="cstfont" id="php_tag_encoder">Php Taglarını Şifreleme Aracı</p>
    <p><ftype>php_tag_encoder( <kf>string</kf> <vf>$metin</vf> )</ftype></p>
    <p>Php taglarını şifrelemek için kullanılır.</p>
    
    <p>
    	<table class="cfont">
        	<tr><th>No</th><th>Parametreler</th><td>Anlamları</td></tr>
            <tr><th>1</th><th>string Metin</th><td>Şifrelenecek metin.</td></tr>
        </table>
    </p>
    
	<div type="code">
    <kf>echo</kf> php_tag_encoder(<sf>'<x><</x>?php Metin ?>'</sf>); <comment>/* Kaynak Kod Çıktı: <x>&</x>#60;<x>&</x>#63;php Metin <x>&</x>#63;<x>&</x>#62; => <x><</x>?php Metin ?> */</comment><br>
    </div>
    
    
    <p class="cstfont" id="nail_encoder">Tırnak İşaretlerini Şifreleme Aracı</p>
    <p><ftype>nail_encoder( <kf>string</kf> <vf>$metin</vf> )</ftype></p>
    <p>Tırnak işaretlerini şifrelemek için kullanılır.</p>
    
    <p>
    	<table class="cfont">
        	<tr><th>No</th><th>Parametreler</th><td>Anlamları</td></tr>
            <tr><th>1</th><th>string Metin</th><td>Şifrelenecek metin.</td></tr>
        </table>
    </p>
    
	<div type="code">
    <kf>echo</kf> nail_encoder(<sf>'"Metin"'</sf>); <comment>/* Kaynak Kod Çıktı: <x>&</x>#147;Metin<x>&</x>#147; => "Metin" */</comment><br>
    </div>
    
    
    <p class="cstfont" id="turkish_char_encoder">Yabancı Karakterleri Şifreleme Aracı</p>
    <p><ftype>foreign_char_encoder( <kf>string</kf> <vf>$metin</vf> )</ftype></p>
    <p>Tırnak işaretlerini şifrelemek için kullanılır.</p>
    
    <p>
    	<table class="cfont">
        	<tr><th>No</th><th>Parametreler</th><td>Anlamları</td></tr>
            <tr><th>1</th><th>string Metin</th><td>Şifrelenecek metin.</td></tr>
        </table>
    </p>
    
	<div type="code">
    <kf>echo</kf> foreign_char_encoder(<sf>'Türkçe'</sf>); <comment>/* Kaynak Kod Çıktı: T<x>&</x>#252;rk<x>&</x>#231;e => Türkçe */</comment><br>
    </div>
    
 
    
    <div type="prev-next">
    	<div type="prev-btn"><a href="tool_email.html">Önceki</a></div><div type="next-btn"><a href="tool_filter.html">Sonraki</a></div>
    </div>
 
</body>
</html>              