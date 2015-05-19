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
    <div id="content-document"><a href="#">Döküman</a> » <a href="tools.html">Araçlar</a> » Converter(Dönüştürme) Aracı</div> 
    <p class="ctfont">Converter(Dönüştürme) Aracı</p>
    <p>Metinsel ifadelerde bir takım dönüştürmeler yapan araçtır.</p>
    <ul><li><a href="#" class="infont">Converter(Dönüştürme) Aracı ve Yöntemleri</a><br><br>
        <ul>
        	<li><a href="#converter_import">Converter Aracını Dahil Etmek</b></a></li>
            <li><a href="#char_converter">Karakter Dönüştürücü » <b>char_converter()</b></a></li>
            <li><a href="#accent_converter">Aksan Dönüştürücü » <b>accent_converter()</b></a></li>
            <li><a href="#url_word_converter">URL'ye Uygun Kelime Dönüştürücü » <b>url_word_converter()</b></a></li>
            <li><a href="#case_converter">Büyük Küçük Harf Dönüştürücü » <b>case_converter()</b></a></li>
        </ul>
    </li></ul>
    
    
   	<p class="cstfont" id="converter">Converter Aracını Dahil Etmek</p>
	<div type="code">import::tool(<sf>'Converter'</sf>)</div>
    
    
    <p class="cstfont" id="char_converter">Karakter Dönüştürücü</p>
    <p><ftype>char_converter( <kf>string</kf> <vf>$metin</vf> , [ <kf>string</kf> <vf>$metnin_karakter_tipi</vf> = <sf>'char'</sf> ] , [ <kf>string</kf> <vf>$metnin_donusecegi_karakter_tipi</vf> = <sf>'html'</sf> ] )</ftype></p>
    <p>Karakterleri html, decimal veya hexdecimal karakter formatına dönüştürmek için kullanılır.</p>
    
    <p>
    	<table class="cfont">
        	<tr><th>No</th><th>Parametreler</th><td>Anlamları</td></tr>
            <tr><th>1</th><th>string Metin</th><td>Değişiklik yapılacak metin.</td></tr>
            <tr><th>2</th><th>[ string Metnin Karakter Tipi = "char" ]</th><td>Metnin karakter tipi. Varsayılan: char</td></tr>
            <tr><th>3</th><th>[ string Metnin Dönüşeceği Karakter Tipi = "html" ]</th><td>Metnin dönüştürüleceği karakter tipi. Varsayılan: html</td></tr>
            <tr><th>No</th><th colspan="2">Dönüşüm Yapılacak Karakter Tipleri</th></tr>
            <tr><th>1</th><td colspan="2">char</td></tr>
            <tr><th>2</th><td colspan="2">html</td></tr>
            <tr><th>3</th><td colspan="2">dec</td></tr>
            <tr><th>4</th><td colspan="2">hex</td></tr>
        </table>
    </p>
    
	<div type="code">
    <comment>/* --- Char'dan Diğer Tiplere Dönüştürme --- */</comment><br>
    <kf>echo</kf> char_converter(<sf>'Metin'</sf>); <comment>/* Kaynak Kod Çıktı: <x>&</x>#77;<x>&</x>#101;<x>&</x>#116;<x>&</x>#105;<x>&</x>#110; */</comment><br>
    <kf>echo</kf> char_converter(<sf>'Metin'</sf>, <sf>'char'</sf>, <sf>'dec'</sf>); <comment>/* Çıktı: 77 101 116 105 110 */</comment><br>
    <kf>echo</kf> char_converter(<sf>'Metin'</sf>, <sf>'char'</sf>, <sf>'hex'</sf>); <comment>/* Çıktı: 4D 65 74 69 6E */</comment><br><br>
    <comment>/* --- Kendi Aralarında Dönüştürme --- */</comment><br>
    <vf>$html</vf> = char_converter(<sf>'Metin'</sf>);<br>
    <vf>$dec</vf>  = char_converter(<sf>'Metin'</sf>, <sf>'char'</sf>, <sf>'dec'</sf>);<br>
    <vf>$hex</vf>  = char_converter(<sf>'Metin'</sf>, <sf>'char'</sf>, <sf>'hex'</sf>);<br>  <br>  
    <kf>echo</kf> char_converter(<vf>$hex</vf>, <sf>'hex'</sf>, <sf>'char'</sf>); <comment>/* Çıktı: Metin */</comment><br>
    <kf>echo</kf> char_converter(<vf>$dec</vf>, <sf>'dec'</sf>, <sf>'hex'</sf>); <comment>/* Çıktı: 4D 65 74 69 6E */</comment><br>
    <kf>echo</kf> char_converter(<vf>$html</vf>, <sf>'html'</sf>, <sf>'dec'</sf>); <comment>/* Çıktı: 77 101 116 105 110 */</comment>  
    </div>
    
    <p class="cstfont" id="accent_converter">Aksan Dönüştürücü</p>
    <p><ftype>accent_converter( <kf>string</kf> <kf>$metin</kf> )</ftype></p>
    <p>Farklı dillerdeki aksan farklılıklarından oluşan akrakterleri standart karakter formatına çevirir.</p>
    
    <p>
    	<table class="cfont">
        	<tr><th>No</th><th>Parametreler</th><td>Anlamları</td></tr>
            <tr><th>1</th><th>string Metin</th><td>Değişiklik yapılacak metin.</td></tr>
        </table>
    </p>
    
	<div type="code">
    <kf>echo</kf> accent_converter(<sf>'Åķŝǻň'</sf>); <comment>/* Çıktı: Aksan */</comment>  
    </div>
    
    <p class="cstfont" id="url_word_converter">URL Yapısına Uygun Kelime Dönüştürücü</p>
    <p><ftype>url_word_converter( <kf>string</kf> <vf>$metin</vf> , <kf>string</kf> [ <vf>$ayrac</vf> = <sf>'-'</sf> ] </pf>)</ftype></p>
    <p>Cümle yapılarını URL yapısına uygun cümle yapısına çevirir.</p>
    
    <p>
    	<table class="cfont">
        	<tr><th>No</th><th>Parametreler</th><td>Anlamları</td></tr>
            <tr><th>1</th><th>string Metin</th><td>Değişiklik yapılacak metin.</td></tr>
            <tr><th>2</th><th>[ string Ayraç = "-" ]</th><td>Kelimeler arasına konulacak ayraç. Varsayılan: "-"</td></tr>
        </table>
    </p>
    
	<div type="code">
    <kf>echo</kf> url_word_converter(<sf>'Zn Kod Çatısına Hoş Geldiniz'</sf>); <comment>/* Çıktı: zn-kod-catisina-hos-geldiniz */</comment><br>
    <kf>echo</kf> url_word_converter(<sf>'Zn Kod Çatısına Hoş Geldiniz'</sf>, <sf>'/'</sf>); <comment>/* Çıktı: zn/kod/catisina/hos/geldiniz */</comment><br>
    </div>
    
    
    <p class="cstfont" id="case_converter">Büyük Küçük Harf Dönüştürücü</p>
    <p><ftype>case_converter( <kf>string</kf> <vf>$metin</vf> , [ <kf>string</kf> <vf>$tip</vf> = <sf>'lower'</sf> ] , [ <kf>string</kf> <vf>$karakter_kodlamasi</vf> = <sf>'utf-8'</sf> ]</pf>)</ftype></p>
    <p>Büyük metinsel ifadeleri küçük, büyük veya sadece ilk harfini büyük harfe dönüştürmek için kullanılır.</p>
    
    <p>
    	<table class="cfont">
        	<tr><th>No</th><th>Parametreler</th><td>Anlamları</td></tr>
            <tr><th>1</th><th>string Metin</th><td>Değişiklik yapılacak metin.</td></tr>
            <tr><th>2</th><th>[ string Tip = "lower" ]</th><td>Dönüştürme işleminin türü varsayılan: lower(küçük harf)'dir. </td></tr>
            <tr><th colspan="2">Tip Parametresinin Alabileceği Değerler</th><th>Anlamları</th></tr>
            <tr><th colspan="2">lower</td><td>Küçük harfe çevirir.</td></tr>
            <tr><th colspan="2">upper</td><td>Büyük harfe çevirir.</td></tr>
            <tr><th colspan="2">title</td><td>Sadece ilk harfleri büyük harfe diğerlerini küçük harfe çevirir.</td></tr>
        </table>
    </p>
    
	<div type="code">
    <kf>echo</kf> case_converter(<sf>'Zn Kod Çatısına Hoş Geldiniz'</sf>); <comment>/* Çıktı: zn kod çatısına hoş geldiniz */</comment><br>
    <kf>echo</kf> case_converter(<sf>'Zn Kod Çatısına Hoş Geldiniz'</sf>, <sf>'upper'</sf>); <comment>/* Çıktı: ZN KOD ÇATISINA HOŞ GELDİNİZ */</comment><br>
    <kf>echo</kf> case_converter(<sf>'Zn Kod Çatısına Hoş Geldiniz'</sf>, <sf>'title'</sf>); <comment>/* Çıktı: Zn Kod Çatısına Hoş Geldiniz */</comment><br><br>
    
    </div>
    
    <div type="prev-next">
    	<div type="prev-btn"><a href="tool_cleaner.html">Önceki</a></div><div type="next-btn"><a href="tool_creator.html">Sonraki</a></div>
    </div>
 
</body>
</html>              