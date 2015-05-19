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
    <div id="content-document"><a href="#">Döküman</a> » <a href="libraries.html">Kütüphaneler</a> » Json Sınıfı</div> 
    <p class="ctfont">Json Sınıfı</p>
    <p>Json kodlarını içeren bir sınıftır.</p>
    <ul><li><a href="#" class="infont">Json Sınıfı ve Yöntemleri</a><br><br>
        <ul>    
        	<li><a href="#json_import">Json Kütüphanesini Dahil Etmek</a></li>
            <li><a href="#json_encode">Dizi Verilerini Özel Veri Türüne Çevirmek » <b>json::encode()</b></a></li>
            <li><a href="#json_decode">Özel Verileri Object Dizi Verilerine Çevirmek » <b>json::decode()</b></a></li>
        </ul>
    </li></ul>
    
    <p class="cstfont" id="json_import">Json Kütüphanesini Dahil Etmek</p>
    <div type="code">
  	import::library(<sf>'Json'</sf>);
    </div>
    
   	<p class="cstfont" id="jquery_encode">Dizi Verilerini Özel Veri Türüne Çevirmek</p>
    <p><ftype> json::encode( <kf>array</kf> <vf>$veriler</vf> , [ <kf>string</kf> <vf>$anahtar_deger_ayraci</vf> = <sf>'+-?||?-+'</sf> ] , [ <kf>string</kf> <vf>$verileri_ayirma_ayraci</vf> = <sf>'|?-++-?|'</sf> ] )</ftype></p>
    <p>Dizi olarak gelen verileri özel verilere dönüştürür. Özellikle veritabanı sorgularında, tablonun bir sütununa birden fazla farklı türde veri kaydetmek istediğinizde kullanabilirsiniz. 3 parametresi vardır. </p>
 
    <p>
    	<table class="cfont">
        	<tr><th>Parametre</th><td>Anlamları</td></tr>
            <tr><th>1. Parametre = Veriler</th><td>Özel veriye çevrilecek verileri ifade eder.</td></tr>
            <tr><th>2. Parametre = [ Anahtar Değer Ayracı = "+-?||?-+" ]</th><td>Anahtar ile değer çiftini ayıran ifade.</td></tr>
            <tr><th>3. Parametre = [ Verileri Ayırma Ayracı = "|?-++-?|" ]</th><td>Verileri ayırma ayracı.</td></tr>
        </table>
    </p>
	<p>
 
    	<div type="code">
<pre>
<x><</x>?php
<kf>class</kf> JsonUygulamasi
{
	<ff>function</ff> index()
        {
            import::library(<sf>'Json'</sf>);
            
            <vf>$veriler</vf> = <kf>array</kf>(<sf>'sehir'</sf> => <sf>'İstanbul'</sf>, <sf>'plaka'</sf> => 30);
            <kf>echo</kf> <strong>json::encode</strong>(<vf>$veriler</vf>);
            
            <comment>/* 
            sehir+-?||?-+İstanbul|?-++-?|plaka+-?||?-+30
            */</comment>
        }
}
</pre>
    	</div>
    </p>
    	
    <p>Veriler yukarıda açıklama satırındaki hali aldılar. Şimdide bunu çözelim.</p>
    
    
    <p class="cstfont" id="json_decode">Özel Verileri Object Dizi Verilerine Çevirmek</p>
    <p><ftype> json::decode( <kf>string</kf> <vf>$json_veriler</vf> , [ <kf>string</kf> <vf>$anahtar_deger_ayraci</vf> = <sf>'+-?||?-+'</sf> ] , [ <kf>string</kf> <vf>$verileri_ayirma_ayraci</vf> = <sf>'|?-++-?|'</sf> ] )</ftype></p>
    <p>Özel hal almış verileri çözer. 3 parametresi vardır. Özel Veriler</p>
 
    <p>
    	<table class="cfont">
        	<tr><th>Parametre</th><td>Anlamları</td></tr>
            <tr><th>1. Parametre = Özel Veriler</th><td>Özel veriyi çevirir.</td></tr>
            <tr><th>2. Parametre = [ Anahtar Değer Ayracı = "+-?||?-+" ]</th><td>Anahtar ile değer çiftini ayıran ifade.</td></tr>
            <tr><th>3. Parametre = [ Verileri Ayırma Ayracı = "|?-++-?|" ]</th><td>Verileri ayırma ayracı.</td></tr>
        </table>
    </p>
	<p>
 
    	<div type="code">
<pre>
<x><</x>?php
<kf>class</kf> JsonUygulamasi
{
	<ff>function</ff> index()
        {
            import::library(<sf>'Json'</sf>);
            
            <vf>$veriler</vf> = <kf>array</kf>(<sf>'sehir'</sf> => <sf>'İstanbul'</sf>, <sf>'plaka'</sf> => 30);
            <vf>$json</vf> = json::encode(<vf>$veriler</vf>);
            
            <vf>$decode</vf> = <strong>json::decode</strong>(<vf>$json</vf>);
            
            <kf>echo</kf> <vf>$decode</vf>->sehir;
            <kf>echo</kf> <vf>$decode</vf>->plaka;
            
            <comment>/* 
            İstanbul 30
            */</comment>
        }
}
</pre>
    	</div>
    </p>
	
    <p>Ajax işlemlerinde veri gönderirken fazlasıyla işinize yaracağınız düşündüğümüz bir sınıf.</p>
    
    <div type="prev-next">
    	<div type="prev-btn"><a href="lib_jquery.html">Önceki</a></div><div type="next-btn"><a href="lib_method.html">Sonraki</a></div>
    </div>
 
</body>
</html>              