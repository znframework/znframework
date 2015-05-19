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
    <div id="content-document"><a href="#">Döküman</a> » <a href="libraries.html">Kütüphaneler</a> » CSS 3 Sınıfı</div> 
    <p class="ctfont">CSS 3 Sınıfı</p>
    <p>Geliştirilmekte olan bir sınıftır. CSS3 özelliklerinin standart ve daha pratik kullanılabilmesi amaçlanmıştır.</p>
    <ul><li><a href="#" class="infont">CSS 3 Sınıfı ve Yöntemleri</a><br><br>
        <ul>
        	<li><a href="#css3_import">Css3 Kütüphanesini Dahil Etmek</a></li>
            <li><a href="#css3_open">Style Tagı Açmak » <b>css3::open()</b></a></li>
            <li><a href="#css3_open">Style Tagı Kapatmak » <b>ss3::close()</b></a></li>
            <li><a href="#css3_transform">Dönüşüm Stilleri Eklemek » <b>css3::transform()</b></a></li>
            <li><a href="#css3_transition">Geçiş Efektleri Uygulamak » <b>css3::transition()</b></a></li>        
            <li><a href="#css3_box_shadow">Gölge Efekti Uygulamak » <b>css3::box_shadow()</b></a></li>
            <li><a href="#css3_border_radius">Köşeleri Yumuşatmak » <b>css3::border_radius()</b></a></li>
            <li><a href="#css3_code">Herhangi Bir CSS3 Stili Kullanmak » <b>css3::code()</b></a></li>
        </ul>
    </li></ul>
    
    <p class="cstfont" id="css3_import">Css3 Kütüphanesini Dahil Etmek</p>
    <div type="code">
  	import::library(<sf>'Css3'</sf>);
    </div>
    
   	<p class="cstfont" id="css3_open">Css 3 <x><</x>style> Tagı Açmak ve Kapatmak</p>
    <p><ftype>css3::open() ve css3::close()</ftype></p>
    <p>Önce Css3 sınıfını dahil edelim.</p>

    <div type="code">
    <pre><x><</x>?php
<kf>class</kf> Css3Kullanimi
{
	<kf>public</kf> <ff>function</ff> index()
        {
            import::library(<sf>'Css3'</sf>); <comment>// Önce CSS3 sınıfı dahil edilir. </comment>
            
            import::page(<sf>'css3_kullanimi'</sf>);
        }
}</pre>
    </div>
    
    <p>Views/Pages/css3_kullanimi.php sayfası oluşturalım ve içerisini aşağıdaki gibi düzenleyelim.</p>
    <p><b>Views/Pages/css3_kullanimi.php</b></p>
    <div type="code"><pre><ff><x><</x>html>
<</x>head>
       	<x><</x>title></ff>Css3 Kullanimi<ff><</x>/title></ff>
       	<x><</x>?php 
        
       		<kf>echo</kf> <strong>css3::open()</strong>; <comment>// <x><</x>style> tagı açtık. Bu kod yerine <x><</x>style> tagıda kullanabilirsiniz.</comment>
       			 <comment>// Css3 Sınıfı Kodları.. </comment>
       		<kf>echo</kf> <strong>css3::close()</strong>; <comment>// <x><</x>/style> tagı kapattık. Bu kod yerine <x><</x>/style> tagıda kullanabilirsiniz.</comment>
       	?> 
<ff><</x>/head>
<</x>body>
       <x><</x>h1></ff>Web sitemize hoşgeldiniz.<ff><</x>/h1>
<</x>/body>
<</x>/html></ff></pre></div>

 	<p class="cstfont" id="css3_transform">Css 3 Dönüşüm Yöntemleri</p>
    <p><ftype> css3::transform( <kf>string</kf> <vf>$erisim_bilgisi</vf> , <kf>string/array</kf> <vf>$uygulanacak_ozellik</vf> )</ftype></p>
    <p>Eğme, bükme, döndürme gibi işlemleri yapan fonksiyondur. 2 parametreden oluşur bu parametreler aşağıdaki gibidir.</p>
    
    <p>
    	<table class="cfont">
        	<tr><th>No</th><th>Parametreler</th><td>Anlamları</td></tr>
            <tr><th>1</th><th>string Erişim Bilgisi</th><td>Erişilecek nesnenin erişim bilgisi. id, name, class...</td></tr>
            <tr><th>2</th><th>string/array Dönüşüm Özellikleri</th><td>Tek bir dönüşüm özelliği eklenecekse parametreye string veri girilebilir ancak birden fazla özellik aynı anda eklenecekse özellikler dizi olarak girilmelidir.</td></tr>
        </table>
    </p>
    
    <p><b>Views/Pages/css3_kullanimi.php</b></p>
    <div type="code"><pre><ff><x><</x>html>
<</x>head>
       	<x><</x>title></ff>Css3 Kullanimi<ff><</x>/title></ff>
       	<x><</x>?php 
        
       		<kf>echo</kf> css3::open(); <comment>// <x><</x>style> tagı açtık. Bu kod yerine <x><</x>style> tagıda kullanabilirsiniz.</comment>
       			 
                 <kf>echo</kf> <strong>css3::transform</strong>(<sf>'.dondur'</sf>, <sf>'rotate(30deg)'</sf>);
                 <kf>echo</kf> <strong>css3::transform</strong>(<sf>'.eg'</sf>, <sf>'skewX(30deg)'</sf>);
                 
       		<kf>echo</kf> css3::close(); <comment>// <x><</x>/style> tagı kapattık. Bu kod yerine <x><</x>/style> tagıda kullanabilirsiniz.</comment>
       	?> 
<ff><</x>/head>
<</x>body>
       <x><</x>div class="dondur eg"></ff>Web sitemize hoşgeldiniz.<ff><</x>/div>
<</x>/body>
<</x>/html></ff></pre></div>

	<p>Eğer bir elemente <b>birden fazla transform özelliğini aynı anda uygulamak</b> isterseniz parametreyi dizi olarak girmeniz gerekmektedir.</p>
    <div type="code">css3::transform(<sf>'.element'</sf>, <kf>array</kf>(<sf>'rotate'</sf> => <sf>'30deg'</sf>, <sf>'skew'</sf> => <sf>'20deg'</sf>))</div>

	<p>Daha detaylı kullanım için css3 kaynaklarını inceleyiniz.</p>
	<p><div type="note"><div>NOT</div><div>Farklı web tarayıcılarını destekler. Her farklı tarayıcı için -ms- , -moz- gibi ibareler kullanmanız gerekmez.</div></div></p>
    
    <p class="cstfont" id="css3_transition">Css 3 Geçiş Efektleri Yöntemi</p>
    <p><ftype> css3::transition( <kf>string</kf> <vf>$erisim_bilgisi</vf>  , <kf>array</kf> <vf>$uygulanacak_ozellik</vf> )</ftype></p>
    <p>Nesnelerinize geçiş efekti uyugulamak için kullanılır. 2 parametreden oluşur bu parametreler aşağıdaki gibidir.</p>
    
   <p>
    	<table class="cfont">
        	<tr><th>No</th><th>Parametreler</th><td>Anlamları</td></tr>
            <tr><th>1</th><th>string Erişim Bilgisi</th><td>Erişilecek nesnenin erişim bilgisi. id, name, class...</td></tr>
            <tr><th>2</th><th>array Geçiş Özellikleri</th><td>Nesneye eklenecek geçiş özelliklerini tutacak dizi bilgisi.</td></tr>
            <tr><th colspan="3">2. Parametrede Kullanılabilecek Geçiş Özellikleri</td></tr>
            <tr><th>1</th><th>property</th><td>Geçiş efekti uygulanacak özellik bilgisi.</td></tr>
            <tr><th>2</th><th>duration</th><td>Geçiş efektinin ne kadar sürede tamamlanacağı bilgisi.</td></tr>
            <tr><th>3</th><th>delay</th><td>Geçiş efektinin ne kadar süre sonra başlayacağı bilgisi.</td></tr>
            <tr><th>4</th><th>animation</th><td>Geçiş efekti türü bilgisi.</td></tr>
        </table>
    </p>
    
        <p><b>Views/Pages/css3_kullanimi.php</b></p>
    <div type="code"><pre><ff><x><</x>html>
<</x>head>
       	<x><</x>title></ff>Css3 Kullanimi<ff><</x>/title></ff>
       	<x><</x>?php 
        
       		<kf>echo</kf> css3::open(); <comment>// <x><</x>style> tagı açtık. Bu kod yerine <x><</x>style> tagıda kullanabilirsiniz.</comment>
       			 
                 <vf>$ozellikler</vf> = <kf>array</kf>(
                 	
                    <sf>'property'</sf> => <sf>'opacity:.3'</sf>, <comment>// Geçiş efekti uygulanacak özellik.</comment>
                    <sf>'duration'</sf> => <sf>'2s'</sf>, <comment>// Geçiş efektinin ne kadar sürede tamamlanacağı.</comment>
                    <sf>'delay'</sf> => <sf>'2s'</sf>, <comment>// Geçiş efektinin ne kadar süre sonra başlayacağı.</comment>
                    <sf>'animation'</sf> => <sf>'ease-in-out'</sf> <comment>// Geçiş efekti türü.</comment>
                    
                 );
                 <kf>echo</kf> <strong>css3::transition</strong>(<sf>'.gecis'</sf>, <vf>$ozellikler</vf>);
                 
       		<kf>echo</kf> css3::close(); <comment>// <x><</x>/style> tagı kapattık. Bu kod yerine <x><</x>/style> tagıda kullanabilirsiniz.</comment>
       	?> 
<ff><</x>/head>
<</x>body>
       <x><</x>div class="gecis"></ff>Web sitemize hoşgeldiniz.<ff><</x>/div>
<</x>/body>
<</x>/html></ff></pre></div>

	<p><div type="note"><div>NOT</div><div>Dilerseniz kodları Controllers sayfalarında yazıp değişkene atayabilir sonrada bu değişkeni veri olarak çağrılacak sayfaya gönderip o sayfanın head tagları içinde o değişkeni kullanabilirsiniz.</div></div></p>
    
    <p class="cstfont" id="css3_box_shadow">Css 3 Gölge Efekti Yöntemi</p>
    <p><ftype> css3::box_shadow( <kf>string</kf> <vf>$erisim_bilgisi</vf> , <kf>array</kf> <vf>$uygulanacak_ozellik</vf> )</ftype></p>
    <p>Nesnelerinize gölge efekti uyugulamak için kullanılır. 2 parametreden oluşur bu parametreler aşağıdaki gibidir.</p>
    
  	<p>
    	<table class="cfont">
        	<tr><th>No</th><th>Parametreler</th><td>Anlamları</td></tr>
            <tr><th>1</th><th>string Erişim Bilgisi</th><td>Erişilecek nesnenin erişim bilgisi. id, name, class...</td></tr>
            <tr><th>2</th><th>string/array Gölge Efekt Özellikleri</th><td>Gölge eklenecek nesneye ait gölge özellikleri</td></tr>
            <tr><th colspan="3">2. Parametrede Kullanılabilecek Efekt Özellikleri</td></tr>
            <tr><th>1</th><th>x</th><td>Gölgenin yataydaki boyutu bilgisi.</td></tr>
            <tr><th>2</th><th>y</th><td>Gölgenin dikeydeki boyutu bilgisi.</td></tr>
            <tr><th>3</th><th>blur</th><td>Gölge görünürlüğü bilgisi.</td></tr>
            <tr><th>4</th><th>diffusion</th><td>Gölge yayılma alanı bilgisi.</td></tr>
            <tr><th>5</th><th>color</th><td>Gölgenin renk bilgisi.</td></tr>
        </table>
    </p>
    
        <p><b>Views/Pages/css3_kullanimi.php</b></p>
    <div type="code"><pre><ff><x><</x>html>
<</x>head>
       	<x><</x>title></ff>Css3 Kullanimi<ff><</x>/title></ff>
       	<x><</x>?php 
        
       		<kf>echo</kf> css3::open(); <comment>// <x><</x>style> tagı açtık. Bu kod yerine <x><</x>style> tagıda kullanabilirsiniz.</comment>
       			 
                 <vf>$ozellikler</vf> = <kf>array</kf>(
                 	
                    <sf>'x'</sf> => <sf>'3px'</sf>, <comment>// Gölgenin yataydaki boyutu.</comment>
                    <sf>'y'</sf> => <sf>'5px'</sf>, <comment>// Gölgenin dikeydeki boyutu.</comment>
                    <sf>'blur'</sf> => <sf>'8px'</sf>, <comment>// Gölgenin görünürlüğü.</comment>
                    <sf>'diffusion'</sf> => <sf>'8px'</sf>, <comment>// Gölgenin yayılma alanı.</comment>
                    <sf>'color'</sf> => <sf>'#777'</sf> <comment>// Gölgenin rengi.</comment>
                    
                 );
                 <kf>echo</kf> <strong>css3::box_shadow</strong>(<sf>'.golge'</sf>, <vf>$ozellikler</vf>);
                 
       		<kf>echo</kf> css3::close(); <comment>// <x><</x>/style> tagı kapattık. Bu kod yerine <x><</x>/style> tagıda kullanabilirsiniz.</comment>
       	?> 
<ff><</x>/head>
<</x>body>
       <x><</x>div class="golge"></ff>Web sitemize hoşgeldiniz.<ff><</x>/div>
<</x>/body>
<</x>/html></ff></pre></div>

 	<p class="cstfont" id="css3_border_radius">Css 3 Köşeleri Yumuşatma Yöntemi</p>
 	<p><ftype> css3::border_radius( <kf>string</kf> <vf>$erisim_bilgisi</vf> , <kf>array</kf> <vf>$uygulanacak_ozellik</vf> )</ftype></p>
    <p>Nesnelerinizin köşelerini yumuşatmak için kullanılır. 2 parametreden oluşur bu parametreler aşağıdaki gibidir.</p>
    
    <p>
    	<table class="cfont">
        	<tr><th>No</th><th>Parametreler</th><td>Anlamları</td></tr>
            <tr><th>1</th><th>string Erişim Bilgisi</th><td>Erişilecek nesnenin erişim bilgisi. id, name, class...</td></tr>
            <tr><th>2</th><th>string/array Yumusatma Yöntemleri</th><td>Yumuşatma özellikleri.</td></tr>
            <tr><th colspan="3">2. Parametrede Kullanılabilecek Yumuşatma Yöntemleri</td></tr>
            <tr><th>1</th><th>radius</th><td>Nesnenin tüm köşelerini yumuşatır.</td></tr>
            <tr><th>2</th><th>top-left-radius</th><td>Nesnenin sol üst köşesini yumuşatır.</td></tr>
            <tr><th>3</th><th>top-right-radius</th><td>Nesnenin sağ üst köşesini yumuşatır.</td></tr>
            <tr><th>4</th><th>bottom-left-radius</th><td>Nesnenin sol alt köşesini yumuşatır.</td></tr>
            <tr><th>5</th><th>bottom-right-radius</th><td>Nesnenin sağ alt köşesini yumuşatır.</td></tr>
        </table>
    </p>
    
        <p><b>Views/Pages/css3_kullanimi.php</b></p>
<div type="code"><pre><ff><x><</x>html>
<</x>head>
       	<x><</x>title></ff>Css3 Kullanimi<ff><</x>/title></ff>
       	<x><</x>?php 
        
       		<kf>echo</kf> css3::open(); <comment>// <x><</x>style> tagı açtık. Bu kod yerine <x><</x>style> tagıda kullanabilirsiniz.</comment>
       			 
                 <vf>$ozellikler</vf> = <kf>array</kf>(
                 	
                    <sf>'radius'</sf> => <sf>'10px'</sf>, <comment>// Nesnenin tüm köşelerini 10px yarı çağında yumuşatır.</comment>
                    <sf>'top-left-radius'</sf> => <sf>'10px'</sf>, <comment>// Nesnenin Sol Üst Köşesini 10px yarı çağında yumuşatır.</comment>
                    <sf>'top-right-radius'</sf> => <sf>'10px'</sf>, <comment>// Nesnenin Sağ Üst Köşesini 10px yarı çağında yumuşatır.</comment>
                    <sf>'bottom-left-radius'</sf> => <sf>'10px'</sf>, <comment>// Nesnenin Sol Alt Köşesini 10px yarı çağında yumuşatır.</comment>
                    <sf>'bottom-right-radius'</sf> => <sf>'10px'</sf>, <comment>// Nesnenin Sağ Alt Köşesini 10px yarı çağında yumuşatır.</comment>
                    
                
                 );
                 <kf>echo</kf> <strong>css3::border_radius</strong>(<sf>'.yumusat'</sf>, <vf>$ozellikler</vf>);
                 
       		<kf>echo</kf> css3::close(); <comment>// <x><</x>/style> tagı kapattık. Bu kod yerine <x><</x>/style> tagıda kullanabilirsiniz.</comment>
       	?> 
<ff><</x>/head>
<</x>body>
       <x><</x>div class="yumusat"></ff>Web sitemize hoşgeldiniz.<ff><</x>/div>
<</x>/body>
<</x>/html></ff></pre></div>

 	<p class="cstfont" id="css3_code">Css 3 Herhangi Bir Kod Kullanmak css3::code()</p>
 	<p><ftype> css3::code( <kf>string</kf> <vf>$erisim_bilgisi</vf> , <kf>string</kf> <vf>$uygulanacak_kod</vf> , <kf>string</kf> <vf>$uygulanacak_ozellik</vf> )</ftype></p>
    <p>Css3 kodlarından herhangi birini kullanmak için bu yapıyı kullanabilirsiniz.</p>
   
    <p>
    	<table class="cfont">
        	<tr><th>No</th><th>Parametreler</th><td>Anlamları</td></tr>
            <tr><th>1</th><th>string Erişim Bilgisi</th><td>Erişilecek nesnenin erişim bilgisi. id, name, class...</td></tr>
            <tr><th>2</th><th>string Uygulanacak Kodun Türü</th><td>Eklenmek istenen kodun tür bilgisi.</td></tr>
            <tr><th>3</th><th>string Uygulanacak Kodun Özellikleri </th><td>Eklenmek istenen kodun özellikleri bilgisi.</td></tr>
        </table>
    </p>
    
    <p><b>Views/Pages/css3_kullanimi.php</b></p>
<div type="code"><pre><ff><x><</x>html>
<</x>head>
       	<x><</x>title></ff>Css3 Kullanimi<ff><</x>/title></ff>
       	<x><</x>?php 
        
       		<kf>echo</kf> css3::open(); <comment>// <x><</x>style> tagı açtık. Bu kod yerine <x><</x>style> tagıda kullanabilirsiniz.</comment>		 
                
                 <kf>echo</kf> <strong>css3::code</strong>(<sf>'.donusum'</sf>, <sf>'transform'</sf>, <sf>'scaleX(2.7)'</sf>);
                 
       		<kf>echo</kf> css3::close(); <comment>// <x><</x>/style> tagı kapattık. Bu kod yerine <x><</x>/style> tagıda kullanabilirsiniz.</comment>
       	?> 
<ff><</x>/head>
<</x>body>
       <x><</x>div class="donusum"></ff>Web sitemize hoşgeldiniz.<ff><</x>/div>
<</x>/body>
<</x>/html></ff></pre></div>
   
    <div type="prev-next">
    	<div type="prev-btn"><a href="lib_cookie.html">Önceki</a></div><div type="next-btn"><a href="lib_curl.html">Sonraki</a></div>
    </div>
 
</body>
</html>              