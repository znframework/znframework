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
    <div id="content-document"><a href="#">Döküman</a> » <a href="tools.html">Araçlar</a> » Html Aracı</div> 
    <p class="ctfont">Html Aracı</p>
    <p>İfadeler üzerinde belirli biçimlendirme işlemleri yapar.</p>
    <ul><li><a href="#" class="infont">Html Aracı ve Yöntemleri</a><br><br>
        <ul>
        	<li><a href="#html_import">Html Aracını Dahil Etmek</b></a></li>
            <li><a href="#html_element">Eleman Aracı » <b>html_element()</b></a></li>
            <li><a href="#multi_attr">Çoklu Özellik Ekleme Aracı » <b>multi_attr()</b></a></li>
            <li><a href="#heading">Başlık Aracı » <b>heading()</b></a></li>          
            <li><a href="#font">Yazı Biçimlendirme Aracı » <b>font()</b></a></li>
            <li><a href="#parag">Paragraf Aracı » <b>parag()</b></a></li>
            <li><a href="#bold">Koyu Yazı Aracı » <b>bold()</b></a></li>
            <li><a href="#strong">Koyu Yazı Aracı » <b>strong()</b></a></li>
            <li><a href="#italic">Eğik Yazı Aracı » <b>italic()</b></a></li>
            <li><a href="#underline">Altı Çizgili Yazı Aracı » <b>underline()</b></a></li>
            <li><a href="#overline">Üstü Çizgili Yazı Aracı » <b>overline()</b></a></li>
            <li><a href="#undertext">Alt Yazı Aracı » <b>undertext()</b></a></li>
            <li><a href="#overtext">Üst Yazı Aracı » <b>overtext()</b></a></li>
            <li><a href="#anchor">Köprü Aracı » <b>anchor()</b></a></li>
            <li><a href="#mailto">Mail Köprü Aracı » <b>mailto()</b></a></li>
            <li><a href="#image">Resim Aracı » <b>image()</b></a></li>
            <li><a href="#space">Boşluk Bırakma Aracı » <b>space()</b></a></li>
            <li><a href="#br">Bir Alt Satıra Geçirme Aracı » <b>br()</b></a></li>
            <li><a href="#meta">Meta Etiketi Aracı » <b>meta()</b></a></li>
            
        </ul>
    </li></ul>
    
    
   	<p class="cstfont" id="html_import">Html Aracını Dahil Etmek</p>
	<div type="code">import::tool(<sf>'Html'</sf>)</div>
    
    
    <p class="cstfont" id="html_element">Eleman Aracı</p>
    <p><ftype>html_element( <kf>string</kf> <vf>$element</vf> , <kf>string</kf> <vf>$metin</vf> , [ <kf>array</kf> <vf>$ozellikler</vf> ] )</ftype></p>
    <p>Herhangi bir html biçim etiketi uygulamak için kullanılır.</p>
    
    <p>
    	<table class="cfont">
        	<tr><th>No</th><th>Parametreler</th><td>Anlamları</td></tr>
            <tr><th>1</th><th>string Element</th><td>Kullanılacak html etiketi.</td></tr>
            <tr><th>2</th><th>string Metin</th><td>Biçimin uygulanacağı metin.</td></tr> 
            <tr><th>3</th><th>[ array Özellikler ]</th><td>Eklenecekse özellikler.</td></tr> 
        </table>
    </p>
    
	<div type="code">
    <kf>echo</kf> html_element(<sf>'u'</sf>, <sf>'Metin'</sf>);  <comment>/* Kaynak Kod Çıktı: <x><</x>u>Metin<x><</x>/u> */</comment><br> 
    <kf>echo</kf> html_element(<sf>'i'</sf>, <sf>'Metin'</sf>);  <comment>/* Kaynak Kod Çıktı: <x><</x>i>Metin<x><</x>/i> */</comment><br> 
    <kf>echo</kf> html_element(<sf>'strong'</sf>, <sf>'Metin'</sf>, <kf>array</kf>(<sf>'id'</sf> => <sf>'metin'</sf>));  <comment>/* Kaynak Kod Çıktı: <x><</x>strong id="metin">Metin<x><</x>/strong> */</comment>
    </div>
    
    
    <p class="cstfont" id="multi_attr">Çoklu Özellik Ekleme Aracı</p>
    <p><ftype>multi_attr( <kf>string</kf> <vf>$metin</vf> , [ <kf>array</kf> <vf>$bicimler</vf> ] )</ftype></p>
    <p>Herhangi bir metne birden fazla biçim eklemek için kullanılır.</p>
    
    <p>
    	<table class="cfont">
        	<tr><th>No</th><th>Parametreler</th><td>Anlamları</td></tr>
            <tr><th>1</th><th>string Metin</th><td>Biçimin uygulanacağı metin.</td></tr> 
            <tr><th>2</th><th>[ array Biçimler ]</th><td>Uygulanacak birden fazla biçim.</td></tr> 
        </table>
    </p>
    
	<div type="code">
    <kf>echo</kf> multi_attr(<sf>'Metin'</sf>, <kf>array</kf>(<sf>'u'</sf> , <sf>'i'</sf> , <sf>'b'</sf>));  <comment>/* Kaynak Kod Çıktı: <x><</x>u><x><</x>i><x><</x>b>Metin<x><</x>/b<x>><</x>/i<x>><</x>/u> */</comment><br> 
    <comment> // Özellik değer çifti eklemek isterseniz şöyle bir kullanımda mümkündür. </comment><br> 
    <kf>echo</kf> multi_attr(<sf>'Metin'</sf>, <kf>array</kf>(<sf>'u'</sf> , <sf>'i'</sf> => <kf>array</kf>(<sf>'id'</sf> = <sf>2</sf>)));  <comment>/* Kaynak Kod Çıktı: <x><</x>u><x><</x>i id="2">Metin<x><</x>/i<x>><</x>/u> */</comment><br> 
    </div>
    
    
    
    <p class="cstfont" id="heading">Başlık Aracı</p>
    <p><ftype>heading( <kf>string</kf> <vf>$metin</vf> , [ <kf>numeric</kl> <vf>$size</vf> = <if>3</if> ] , [ <kf>array</kf> <vf>$ozellikler</vf> ] )</ftype></p>
    <p>Bir metni başlık bilgisi olarak düzenlemek için kullanılır.</p>
    
    <p>
    	<table class="cfont">
        	<tr><th>No</th><th>Parametreler</th><td>Anlamları</td></tr>
            <tr><th>1</th><th>string Metin</th><td>Biçimin uygulanacağı metin.</td></tr> 
            <tr><th>2</th><th>[ string/int Başlığın Boyutu = "3" ]</th><td>Başlığın boyutu.</td></tr>           
            <tr><th>3</th><th>[ array Özellikler ]</th><td>Eklenecekse özellikler.</td></tr> 
        </table>
    </p>
    
	<div type="code">
    <kf>echo</kf> heading(<sf>'Metin'</sf>);  <comment>/* Kaynak Kod Çıktı: <x><</x>h3>Metin<x><</x>/h3> */</comment><br> 
    <kf>echo</kf> heading(<sf>'Metin'</sf>, <sf>1</sf>);  <comment>/* Kaynak Kod Çıktı: <x><</x>h1>Metin<x><</x>/h1> */</comment><br>
    <kf>echo</kf> heading(<sf>'Metin'</sf>, <sf>2</sf>, <kf>array</kf>(<sf>'id'</sf> , <sf>'metin'</sf>));  <comment>/* Kaynak Kod Çıktı: <x><</x>h2 id="metin">Metin<x><</x>/h2> */</comment><br>
    </div>
    
    
    
    <p class="cstfont" id="font">Yazı Biçimlendirme Aracı</p>
    <p><ftype>font( <kf>string</kf> <vf>$metin</vf> , [ <kf>array</kf> <vf>$ozellikler</vf> ] )</ftype></p>
    <p>Metnin font özelliklerini biçimlendirmek için kullanılır.</p>
    
    <p>
    	<table class="cfont">
        	<tr><th>No</th><th>Parametreler</th><td>Anlamları</td></tr>
            <tr><th>1</th><th>string Metin</th><td>Biçimin uygulanacağı metin.</td></tr>  
            <tr><th>2</th><th>[ array Özellikler ]</th><td>Eklenecekse özellikler.</td></tr> 
        </table>
    </p>
    
	<div type="code">
    <kf>echo</kf> font(<sf>'Metin'</sf>, <kf>array</kf>(<sf>'size'</sf> => <sf>10</sf>, <sf>'color'</sf> => <sf>'red'</sf>));  <comment>/* Kaynak Kod Çıktı: <x><</x>font size="10" color="red">Metin<x><</x>/font> */</comment><br> 
    </div>
    
    
    <p class="cstfont" id="parag">Paragraf Aracı</p>
    <p><ftype>parag( <kf>string</kf> <vf>$metin</vf> , [ <kf>array</kf> <vf>$ozellikler</vf> ] )</ftype></p>
    <p>Paragraf başı yapmak için kullanılır.</p>
    
    <p>
    	<table class="cfont">
        	<tr><th>No</th><th>Parametreler</th><td>Anlamları</td></tr>
            <tr><th>1</th><th>string Metin</th><td>Biçimin uygulanacağı metin.</td></tr>  
            <tr><th>2</th><th>[ array Özellikler ]</th><td>Eklenecekse özellikler.</td></tr> 
        </table>
    </p>
    
	<div type="code">
    <kf>echo</kf> parag(<sf>'Metin'</sf>);  <comment>/* Kaynak Kod Çıktı: <x><</x>p>Metin<x><</x>/p> */</comment><br> 
    </div>
    
    
    
    <p class="cstfont" id="bold">Koyu Yazı Aracı</p>
    <p><ftype>bold( <kf>string</kf> <vf>$metin</vf> , [ <kf>array</kf> <vf>$ozellikler</vf> ] )</ftype></p>
    <p>Yazıyı koyu yazmak için kullanılır.</p>
    
    <p>
    	<table class="cfont">
        	<tr><th>No</th><th>Parametreler</th><td>Anlamları</td></tr>
            <tr><th>1</th><th>string Metin</th><td>Biçimin uygulanacağı metin.</td></tr>  
            <tr><th>2</th><th>[ array Özellikler ]</th><td>Eklenecekse özellikler.</td></tr> 
        </table>
    </p>
    
	<div type="code">
    <kf>echo</kf> bold(<sf>'Metin'</sf>);  <comment>/* Kaynak Kod Çıktı: <x><</x>b>Metin<x><</x>/b> */</comment><br> 
    </div>
    
    
    
    <p class="cstfont" id="strong">Koyu Yazı Aracı</p>
    <p><ftype>strong( <kf>string</kf> <vf>$metin</vf> , [ <kf>array</kf> <vf>$ozellikler</vf> ] )</ftype></p>
    <p>Yazıyı koyu yazmak için kullanılır.</p>
    
    <p>
    	<table class="cfont">
        	<tr><th>No</th><th>Parametreler</th><td>Anlamları</td></tr>
            <tr><th>1</th><th>string Metin</th><td>Biçimin uygulanacağı metin.</td></tr>  
            <tr><th>2</th><th>[ array Özellikler ]</th><td>Eklenecekse özellikler.</td></tr> 
        </table>
    </p>
    
	<div type="code">
    <kf>echo</kf> strong(<sf>'Metin'</sf>);  <comment>/* Kaynak Kod Çıktı: <x><</x>strong>Metin<x><</x>/strong> */</comment><br> 
    </div>
    
    
    
    <p class="cstfont" id="italic">Eğik Yazı Aracı</p>
    <p><ftype>italic( <kf>string</kf> <vf>$metin</vf> , [ <kf>array</kf> <vf>$ozellikler</vf> ] )</ftype></p>
    <p>Eğik yazı yazmak için kullanılır.</p>
    
    <p>
    	<table class="cfont">
        	<tr><th>No</th><th>Parametreler</th><td>Anlamları</td></tr>
            <tr><th>1</th><th>string Metin</th><td>Biçimin uygulanacağı metin.</td></tr>  
            <tr><th>2</th><th>[ array Özellikler ]</th><td>Eklenecekse özellikler.</td></tr> 
        </table>
    </p>
    
	<div type="code">
    <kf>echo</kf> italic(<sf>'Metin'</sf>);  <comment>/* Kaynak Kod Çıktı: <x><</x>i>Metin<x><</x>/i> */</comment><br> 
    </div>
    
    
    <p class="cstfont" id="underline">Altı Çizgili Yazı Aracı</p>
    <p><ftype>underline( <kf>string</kf> <vf>$metin</vf> , [ <kf>array</kf> <vf>$ozellikler</vf> ] )</ftype></p>
    <p>Yazının altını çizmek için kullanılır.</p>
    
    <p>
    	<table class="cfont">
        	<tr><th>No</th><th>Parametreler</th><td>Anlamları</td></tr>
            <tr><th>1</th><th>string Metin</th><td>Biçimin uygulanacağı metin.</td></tr>  
            <tr><th>2</th><th>[ array Özellikler ]</th><td>Eklenecekse özellikler.</td></tr> 
        </table>
    </p>
    
	<div type="code">
    <kf>echo</kf> underline(<sf>'Metin'</sf>);  <comment>/* Kaynak Kod Çıktı: <x><</x>u>Metin<x><</x>/u> */</comment><br> 
    </div>
    
    
    <p class="cstfont" id="overline">Üstü Çizgili Yazı Aracı</p>
    <p><ftype>overline( <kf>string</kf> <vf>$metin</vf> , [ <kf>array</kf> <vf>$ozellikler</vf> ] )</ftype></p>
    <p>Yazının üzerini çizmek için kullanılır.</p>
    
    <p>
    	<table class="cfont">
        	<tr><th>No</th><th>Parametreler</th><td>Anlamları</td></tr>
            <tr><th>1</th><th>string Metin</th><td>Biçimin uygulanacağı metin.</td></tr>  
            <tr><th>2</th><th>[ array Özellikler ]</th><td>Eklenecekse özellikler.</td></tr> 
        </table>
    </p>
    
	<div type="code">
    <kf>echo</kf> overline(<sf>'Metin'</sf>);  <comment>/* Kaynak Kod Çıktı: <x><</x>del>Metin<x><</x>/del> */</comment><br> 
    </div>
    
    
    <p class="cstfont" id="undertext">Alt Yazı Aracı</p>
    <p><ftype>undertext( <kf>string</kf> <vf>$metin</vf> , [ <kf>array</kf> <vf>$ozellikler</vf> ] )</ftype></p>
    <p>Taban ifade türünde alt yazı yazmak için kullanılır.</p>
    
    <p>
    	<table class="cfont">
        	<tr><th>No</th><th>Parametreler</th><td>Anlamları</td></tr>
            <tr><th>1</th><th>string Metin</th><td>Biçimin uygulanacağı metin.</td></tr>  
            <tr><th>2</th><th>[ array Özellikler ]</th><td>Eklenecekse özellikler.</td></tr> 
        </table>
    </p>
    
	<div type="code">
    <kf>echo</kf> undertext(<sf>'Metin'</sf>);  <comment>/* Kaynak Kod Çıktı: <x><</x>sub>Metin<x><</x>/sub> */</comment><br> 
    </div>
    
    <p class="cstfont" id="overtext">Üst Yazı Aracı</p>
    <p><ftype>overtext( <kf>string</kf> <vf>$metin</vf> , [ <kf>array</kf> <vf>$ozellikler</vf> ] )</ftype></p>
    <p>Üstlü ifade türünde üst yazı yazmak için kullanılır.</p>
    
    <p>
    	<table class="cfont">
        	<tr><th>No</th><th>Parametreler</th><td>Anlamları</td></tr>
            <tr><th>1</th><th>string Metin</th><td>Biçimin uygulanacağı metin.</td></tr>  
            <tr><th>2</th><th>[ array Özellikler ]</th><td>Eklenecekse özellikler.</td></tr> 
        </table>
    </p>
    
	<div type="code">
    <kf>echo</kf> overtext(<sf>'Metin'</sf>);  <comment>/* Kaynak Kod Çıktı: <x><</x>sup>Metin<x><</x>/sup> */</comment><br> 
    </div>
    
    
    <p class="cstfont" id="anchor">Köprü Ekleme Aracı</p>
    <p><ftype>anchor( <kf>string</kf> <vf>$url</vf> , <kf>string</kf> <vf>$link_uzerinde_gorunecek_isim</vf> , [ <kf>array</kf> <vf>$ozellikler</vf> ] )</ftype></p>
    <p>Köprü eklemek için kullanılır.</p>
    
    <p>
    	<table class="cfont">
        	<tr><th>No</th><th>Parametreler</th><td>Anlamları</td></tr>
            <tr><th>1</th><th>string URL</th><td>Köprünün URL bilgisi.</td></tr> 
            <tr><th>2</th><th>string Metin</th><td>Linkin görünen ifadesi.</td></tr> 
            <tr><th>3</th><th>[ array Özellikler ]</th><td>Eklenecekse özellikler.</td></tr> 
        </table>
    </p>
    
	<div type="code">
    <kf>echo</kf> anchor(<sf>'http://www.siteadi.xxx'</sf>, <sf>'Site Adı'</sf>);  <comment>/* Kaynak Kod Çıktı: <x><</x>a href="http://www.siteadi.xxx">Site Adı<x><</x>/a> */</comment><br> 
    <kf>echo</kf> anchor(<sf>'http://www.siteadi.xxx'</sf>);  <comment>/* Kaynak Kod Çıktı: <x><</x>a href="http://www.siteadi.xxx">http://www.siteadi.xxx<x><</x>/a> */</comment><br>
    </div>
    
    
    <p class="cstfont" id="mailto">E-posta Köprü Ekleme Aracı</p>
    <p><ftype>mailto( <kf>string</kf> <vf>$url</vf> , <kf>string</kf> <vf>$link_uzerinde_gorunecek_isim</vf> , [ <kf>array</kf> <vf>$ozellikler</vf> ] )</ftype></p>
    <p>Köprü eklemek için kullanılır.</p>
    
    <p>
    	<table class="cfont">
        	<tr><th>No</th><th>Parametreler</th><td>Anlamları</td></tr>
            <tr><th>1</th><th>string E-posta</th><td>Köprünün e-posta bilgisi.</td></tr> 
            <tr><th>2</th><th>[ array Özellikler ]</th><td>Eklenecekse özellikler.</td></tr> 
        </table>
    </p>
    
	<div type="code">
    <kf>echo</kf> mailto(<sf>'bilgi@zntr.net'</sf>);  <comment>/* Kaynak Kod Çıktı: <x><</x>a href="mailto:bilgi@zntr.net">bilgi@zntr.net<x><</x>/a> */</comment><br> 
    </div>
    
    
    <p class="cstfont" id="image">Resim Aracı</p>
    <p><ftype>image( <kf>string</kf> <vf>$kaynak</vf> , [ <kf>array</kf> <vf>$ozellikler</vf> ] )</ftype></p>
    <p>Köprü eklemek için kullanılır.</p>
    
    <p>
    	<table class="cfont">
        	<tr><th>No</th><th>Parametreler</th><td>Anlamları</td></tr>
            <tr><th>1</th><th>string Kaynak</th><td>Resmin kaynağı.</td></tr> 
            <tr><th>2</th><th>[ array Özellikler ]</th><td>Eklenecekse özellikler.</td></tr> 
        </table>
    </p>
    
	<div type="code">
    <kf>echo</kf> image(<sf>'resim/ornek.jpg'</sf>);  <comment>/* Kaynak Kod Çıktı: <x><</x>img src="http://www.siteadi.xxx/resim/ornek.jpg"> */</comment><br> 
    </div>
    
    
    
    <p class="cstfont" id="space">Boşluk Bırakma Aracı</p>
    <p><ftype>space( [ <kf>numeric</kf> <vf>$bosluk_sayisi</vf> = <if>5</if> ] )</ftype></p>
    <p>Boşluk bırakmak için kullanılır.</p>
    
    <p>
    	<table class="cfont">
        	<tr><th>No</th><th>Parametreler</th><td>Anlamları</td></tr>
            <tr><th>1</th><th>[ string/int Boşluk Sayısı = 5]</th><td>Bırakılmak istenen boşluk sayısı.</td></tr> 
        </table>
    </p>
    
	<div type="code">
    <kf>echo</kf> <sf>'ZNTR'ye'</sf>.space(<sf>6</sf>).<sf>'hoş geldiniz.'</sf>;  <comment>/* Çıktı: ZNTR'ye&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;hoş geldiniz. 6 adet <x>&</x>nbsp; ilave etti.*/</comment><br> 
    </div>
    
    
    <p class="cstfont" id="br">Bir Alt Satıra Geçirme Aracı</p>
    <p><ftype>br( [ <kf>numeric</kf> <vf>$satir_sayisi</vf> = <if>1</if> ] )</ftype></p>
    <p>Boşluk bırakmak için kullanılır.</p>
    
    <p>
    	<table class="cfont">
        	<tr><th>No</th><th>Parametreler</th><td>Anlamları</td></tr>
            <tr><th>1</th><th>[ string/int Satır Sayısı = 5]</th><td>Bırakılmak istenen boşluk sayısı.</td></tr> 
        </table>
    </p>
    
	<div type="code">
    <kf>echo</kf> <sf>'ZNTR'ye'</sf>.br(<sf>4</sf>).<sf>'hoş geldiniz.'</sf>;  <comment>/* Çıktı: ZNTR'ye<x><</x>br><x><</x>br><x><</x>br><x><</x>br>hoş geldiniz. */</comment><br> 
    </div>
    
    
    <p class="cstfont" id="meta">Meta Etiketi Aracı</p>
    <p><ftype>meta( <kf>string/array</kf> <vf>$isim</vf> , <kf>string</kf> <vf>$icerik</vf> , [ <kf>string</kf> <vf>$tip</vf> = <sf>'name'</sf> ] </pf>)</ftype></p>
    <p>Meta tag veya taglar eklemek için kullanılır.</p>
    
    <p>
    	<table class="cfont">
        	<tr><th>No</th><th>Parametreler</th><td>Anlamları</td></tr>
            <tr><th>1</th><th>string/array İsim</th><td>Eklenmek istenen isim. Author, description...</td></tr> 
            <tr><th>2</th><th>string İçerik</th><td>Eklenmek istenen içerikler.</td></tr>
            <tr><th>3</th><th>[ string İsim Tipi = "name" ]</th><td>name veya http değerleri alır.</td></tr>
        </table>
    </p>
    
	<div type="code">
    <kf>echo</kf> meta(<sf>'author'</sf>, <sf>'Ozan Uykun'</sf>);  <comment>/* Kaynak Kod Çıktı: <x><</x>meta name="author" content="Ozan Uykun"> */</comment><br> 
    <kf>echo</kf> meta(<sf>'refresh'</sf>, <sf>'20'</sf>, <sf>'http'</sf>);  <comment>/* Kaynak Kod Çıktı: <x><</x>meta http-equiv="refresh" content=20"> */</comment><br>
    </div>
    
    <p><strong>Çoklu meta tagı kullanmak isterseniz</strong> kodunuzu aşağıdaki gibi düzenliyorsunuz.</p>
    
    <div type="code">
    <pre>
<vf>$metas</vf> = <kf>array</kf>(
        <kf>array</kf>(<sf>'name'</sf> => <sf>'author'</sf>, <sf>'content'</sf> => <sf>'Ozan Uykun'</sf>),
        <kf>array</kf>(<sf>'name'</sf> => <sf>'refresh'</sf>, <sf>'content'</sf> => <sf>'20'</sf>, <sf>'type'</sf> => <sf>'http'</sf>)
);
<kf>echo</kf> meta(<vf>$metas</vf>);
	</pre>
    </div>
    
    <div type="prev-next">
    	<div type="prev-btn"><a href="tool_formatter.html">Önceki</a></div><div type="next-btn"><a href="tool_limiter.html">Sonraki</a></div>
    </div>
 
</body>
</html>              