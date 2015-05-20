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
    <div id="content-document"><a href="#">Döküman</a> » <a href="libraries.html">Kütüphaneler</a> » Security(Güvenlik) Sınıfı</div> 
    <p class="ctfont">Security(Güvenlik) Sınıfı</p>
    <p>PHP güvenlik açıklarını en aza indirmek için oluşturulmuş sınıftır.</p>
    <ul><li><a href="#" class="infont">Security(Güvenlik) Sınıfı ve Yöntemleri</a><br><br>
        <ul>  
        	<li><a href="#sec_import">Security Kütüphanesini Dahil Etmek</a></li>
        	<li><a href="#sec_nc_encode">Kötü Amaçlı Kodları Değiştirmek » <b>sec::nc_encode()</b></a></li>
            <li><a href="#sec_nail_encode">Kötü Amaçlı Çapraz Kodları Dönüştürmek » <b>sec::xss_encode()</b></a></li>
            <li><a href="#sec_injection_encode">Tırnak Enjeksiyonları Dönüştürmek ve Eski Haline Getirmek » <b>sec::injection_encode() , sec::html::injection_decode()</b></a></li>
            <li><a href="#sec_html_encode">Html Karakterlerini Dönüştürmek ve Eski Haline Getirmek » <b>sec::html_encode() , sec::html::decode()</b></a></li>
        </ul>
    </li></ul>
    
    <p class="cstfont" id="sec_import">Security Kütüphanesini Dahil Etmek</p>
    <div type="code">
  	import::library(<sf>'Security'</sf>);
    </div>
    
   	<p class="cstfont" id="sec_nc_encode">Kötü Amaçlı Kodları Değiştirmek</p>
    <p><ftype>sec::nc_encode( <kf>string</kf> <vf>$metin</vf> , <kf>string/array</kf> <vf>$kotu_amacli_kodlar</vf> , [ <kf>string/array</kf> <vf>$degistirilecek_ifade</vf> = <sf>'[badword]'</vf> ] )</ftype></p>
    <p>Kötü içerikli olduğunu düşündüğünüz ifadeleri değiştirmek için kullanılır. 3 parametresi vardır. Metin, Kötü Amaçlı Kodlar, Değiştirilecek İfade.</p> 
    <p>2. Parametrede kötü kodlar aranırken küçük büyük harf duyarlılığı dikkate alınmaz bu durum güvenlik açısından yarar sağlar ayrıca kötü kodları yazarken tek bir ifade yazılacaksa string olarak yazılabilir eğer birden fazla yazılacaksa dizi içerisinde kullanılabilir.</p>
    <p>
    	<table class="cfont">
        	<tr><th>Parametre</th><td>Anlamları</td></tr>
            <tr><th>1. Parametre = Metin</th><td>Kötü kodları barındırma ihtimali olan metin.</td></tr>
			<tr><th>2. Parametre = Aranacak Kelime</th><td>Kötü kodlar.</td></tr>
            <tr><th>3. Parametre = [Değiştirilecek İfade = [badwords]]</th><td></td></tr>
       
        </table>
    </p>
    
    <p>
    	<div type="code">
<pre>
import::library(<sf>'Security'</sf>);

<vf>$metin</vf> = <sf>"OR sifre = '1'"</sf>;

<comment> // Metin içerisinde geçen 'or' ve 'from' kötü amaçlı ifadeleri değiştir.  </comment>
<vf>$metin</vf> = <strong>sec::nc_encode</strong>(<vf>$metin</vf>, <kf>array</kf>(<sf>'or'</sf>,<sf>'from'</sf>), <sf>'[kötü-kelime]'</sf>);

<comment> // ------------------------------ VEYA ------------------------- </comment>

<comment> // Metin içerisinde geçen 'or' kötü amaçlı ifadesini değiştir.  </comment>
<vf>$metin</vf> = <strong>sec::nc_encode</strong>(<vf>$metin</vf>, <sf>'or'</sf>, <sf>'[kötü-kelime]'</sf>);

<kf>echo</kf> <vf>$metin</vf>; <comment> // Çıktı: [kötü-kelime] sifre = '1'</comment>
</pre>
        </div>
    </p>
    
    
    
    <p class="cstfont" id="sec_nail_encode">Kötü Amaçlı Çapraz Kodları Dönüştürmek</p>
    <p><ftype>sec::xss_encode( <kf>string</kf> <vf>$metin</vf> )</ftype></p>
    <p>Genel olarak script kodlardan kaynaklı çapraz enjeksiyonları engellemek için geliştirilmiştir. Hangi karakterleri engellemesi gerektiği <strong>Aplication/Config/Security.php</strong> dosyasında yer almaktadır.</p> 
    
    <p>
    	<table class="cfont">
        	<tr><th>Parametre</th><td>Anlamları</td></tr>
            <tr><th>1. Parametre = Metin</th><td>Tırnaklar temizlenecek metin.</td></tr> 
        </table>
    </p>
    
    <p>
    	<div type="code">
<pre>
import::library(<sf>'Security'</sf>);

<vf>$metin</vf> = <sf>"<x><</x>script><x><</x>/script>"</sf>;

<vf>$metin</vf> = <strong>sec::xss_encode</strong>(<vf>$metin</vf>);

<kf>echo</kf> <vf>$metin</vf>; <comment> // Çıktı: <x>&</x>#60;script<x>&</x>#62;<x>&</x>#60;/script<x>&</x>#62;</comment>
</pre>
        </div>
    </p>
    
	<p>Dönüştürülen tırnak işaretlerini eski haline getirmek içinde sec::nail_decode() yöntemi kullanılır.</p>
    
    <div type="code">
<pre>
import::library(<sf>'Security'</sf>);

<vf>$metin</vf> = <sf>"OR sifre = '1'"</sf>;

<vf>$metin</vf> = sec::nail_encode(<vf>$metin</vf>);

<vf>$metin</vf> = <strong>sec::nail_decode</strong>(<vf>$metin</vf>);

<kf>echo</kf> <vf>$metin</vf>; <comment> // Çıktı: OR sifre = '1'</comment>
</pre>
        </div>
    </p>
    
    
    <p class="cstfont" id="sec_injection_encode">Tırnak Enjeksiyonları Dönüştürmek ve Eski Haline Getirmek </p>
    <p><ftype>sec::injection_encode( <kf>string</kf> <vf>$metin</vf> )</ftype></p>
    <p><ftype>sec::injection_decode( <kf>string</kf> <vf>$metin</vf> )</ftype></p>
    <p>Sorgu ifadeleri içerisinde geçen (') ve (") tırnak işaretleri veri güvenliği için (\') ve (\") şekline dönüştürülmesini sağlar. Tek parametresi vardır. Metin</p> 
    
    <p>
    	<table class="cfont">
        	<tr><th>Parametre</th><td>Anlamları</td></tr>
            <tr><th>1. Parametre = Metin</th><td>Tırnaklar temizlenecek metin.</td></tr> 
        </table>
    </p>
    
    <p>
    	<div type="code">
<pre>
import::library(<sf>'Security'</sf>);

<vf>$metin</vf> = <sf>"OR sifre = '1'"</sf>;

<vf>$metin</vf> = <strong>sec::injection_encode</strong>(<vf>$metin</vf>);

<kf>echo</kf> <vf>$metin</vf>; <comment> // Çıktı: OR sifre = \'1\'</comment>
</pre>
        </div>
    </p>
    
	<p>Dönüştürülen tırnak işaretlerini eski haline getirmek içinde sec::injection_decode() yöntemi kullanılır.</p>
    
    <div type="code">
<pre>
import::library(<sf>'Security'</sf>);

<vf>$metin</vf> = <sf>"OR sifre = '1'"</sf>;

<vf>$metin</vf> = sec::injection_encode(<vf>$metin</vf>);

<vf>$metin</vf> = <strong>sec::injection_decode</strong>(<vf>$metin</vf>);

<kf>echo</kf> <vf>$metin</vf>; <comment> // Çıktı: OR sifre = '1'</comment>
</pre>
        </div>
    </p>
    
    
    
    <p class="cstfont" id="sec_html_encode">Html Karakterlerini Dönüştürmek ve Eski Haline Getirmek </p>
    <p><ftype>sec::html_encode( <kf>string</kf> <vf>$metin</vf> , [ <kf>string> <vf>$donusum</vf> = <sf>'quotes'</sf> ] )</ftype></p>
    <p><ftype>sec::html_decode( <kf>string</kf> <vf>$metin</vf> , [ <kf>string> <vf>$donusum</vf> = <sf>'quotes'</sf> ] )</ftype></p>
    <p>Html'ye ait <x><</x> , <x>></x> gibi karakterler ile tırnak işaretleri dönüştürülür böylece text alanları üzerinden script saldırıların önüne geçilmiş olur. 2 parametresi vardır. Metin, Dönüşüm.</p> 
    
    <p>
    	<table class="cfont">
        	<tr><th>Parametre</th><td>Anlamları</td></tr>
            <tr><th>1. Parametre = Metin</th><td>Dönüşütürülecek metin.</td></tr>
            <tr><th>2. Parametre = [Dönüşüm = quotes]</th><td>Alabileceği değerler = quotes, nonquotes, compat</td></tr>
        </table>
    </p>
    
    <p>
    	<div type="code">
<pre>
import::library(<sf>'Security'</sf>);

<vf>$metin</vf> = <sf>"<x><</x>script>alert('1');<x><</x>/script>"</sf>;

<vf>$metin</vf> = <strong>sec::html_encode</strong>(<vf>$metin</vf>);

<kf>echo</kf> <vf>$metin</vf>; <comment> // Çıktı: <x>&</x>lt;script<x>&</x>gt;alert(<x>&</x>#039;1<x>&</x>#039;);<x>&</x>lt;/script<x>&</x>gt;gt;'</comment>
</pre>
        </div>
    </p>
   
    <p>Şimdede dönüştürdüğümüz verileri eski hallerine geri getirelim.</p>
    
    <p>
    	<div type="code">
<pre>
import::library(<sf>'Security'</sf>);

<vf>$metin</vf> = <sf>"<x><</x>script>alert('1');<x><</x>/script>"</sf>;

<vf>$metin</vf> = sec::html_encode(<vf>$metin</vf>);

<vf>$metin</vf> = <strong>sec::html_decode</strong>(<vf>$metin</vf>);

<kf>echo</kf> <vf>$metin</vf>; <comment> // Çıktı: <x><</x>script>alert('1');<x><</x>/script></comment>
</pre>
        </div>
    </p>
    
    
    <div type="prev-next">
    	<div type="prev-btn"><a href="lib_search.html">Önceki</a></div><div type="next-btn"><a href="lib_sess.html">Sonraki</a></div>
    </div>
 
</body>
</html>              