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
    <div id="content-document"><a href="#">Döküman</a> » <a href="import.html">Dahil Etme Sınıfı ve Yöntemleri</a> » Masterpage Kullanımı</div>  
    <p class="ctfont">Masterpage Kullanımı</p>
    <p>Masterpage sitenin iskelet yapısını oluşturan temel sayfadır. Kullanıcıların ihtiyacı olacağını düşündüğümüz bir çatı sistemidir.</p>
    <ul><li><a href="#" class="infont">Masterpage Kullanımı</a><br><br>
        <ul>
        	<li><a href="#import_masterpage">Herhangi Bir Sayfayı Masterpage'e Dönüştürmek</a></li>
            <li><a href="#import_masterpage_send_data">Masterpage Olarak Belirlenen Sayfaya Veri Göndermek</a></li>
            <li><a href="#import_masterpage_send_head_data">Masterpage'e Başlık Bilgileri Göndermek</a></li>
            <li><a href="#import_masterpage_config">Masterpage Konfigürasyon Dosyasını Kullanarak Başlık Bilgileri Göndermek</a></li>
        </ul>
    </li></ul>
    
    <p class="cstfont" id="import_masterpage">Herhangi Bir Sayfayı Masterpage Sayfasına Dönüştürmek</p>
    <p><strong>Config/Masterpage/</strong> dizininden <cf><vf>$config</vf>[<sf>'Masterpage'</sf>][<sf>'body_page'</sf>] = <sf>''</sf>;</cf>  ayarının yapılması gerekmektedir. Tırnak işareletleri arasına <strong>Views/Pages/</strong> dizininden masterpage olarak ayarlanması düşünülen sayfanın adı yazılır. Böylece hangi sayfanın, temel html yapılarını barındıracağı belirlenmiş olur. Sayfa .php uzatılı ise uzantıyı yazamaya gerek yoktur. Örneğin <strong>Views/Pages/</strong> dizinindaki <strong>anasayfa.php</strong> dosyasını masterpage olarak ayarlamak istersek; <cf><vf>$config</vf>[<sf>'Masterpage'</sf>][<sf>'body_page'</sf>] = <sf>'anasayfa'</sf>;</cf> şeklinde yazmamız yeterlidir.</p>
    <p><strong>Views/Pages/</strong> dizini içerisinden herhangi bir boş sayfayı masterpage yapısına dönüştürerek gerekli html taglarını, meta, başlık ve içerik bilgilerini eklemek için kullanılır. Genellikle masterpage düşünülen sayfanın anlamlı bir ismi olmalıdır ki biz anasayfa olarak uygun gördük. Yukarıdaki kod <strong>anasayfa.php</strong> dosyasını masterpage yapısına dönüştürmek için kullanılıyor. Aşağıda masterpage kullanımına örnek verilmiştir.</p> 	
    
   <p>
   <div type="code">
<pre>
Controllers/urunler.php
<x><</x>?php
<kf>class</kf> Urunler
{
	<kf>public</kf> <vf>$baslik_bilgileri</vf> = <kf>array</kf>();
    	<kf>public</kf> <vf>$sayfa_bilgileri</vf> = <kf>array</kf>();
    	<kf>public</kf> <vf>$veriler</vf> = <kf>array</kf>();
    
    
	<ff>function</ff> index()
        {
        	<comment> // Masterpage olarak ayarlanmış sayfaya başlık ve meta bilgileri gönderiyoruz.</comment>
            <vf>$this</vf>->baslik_bilgileri[<sf>'title'</sf>] = <sf>"Ürünler Sayfamıza Hoş Geldiniz."</sf>;
            <vf>$this</vf>->baslik_bilgileri[<sf>'author'</sf>] = <sf>"Ozan Uykun"</sf>;
            
            <comment> // Masterpage olarak ayarlanmış sayfa üzerinde başka bir sayfanın açılması için sayfaya başka bir sayfayı veri olarak gönderiyoruz.</comment>
            <vf>$this</vf>->veriler[<sf>'sayfa'</sf>] = import::page(<sf>'Urunler/index'</sf>,<vf>$this</vf>->sayfa_bilgileri,<kf>true</kf>);
            
            <comment> // Masterpage olarak ayarlanmış sayfaya tüm sayfa ve üst başlık bilgilerini gönderiyoruz.</comment>
            import::masterpage(<vf>$this</vf>->veriler, <vf>$this</vf>->baslik_bilgileri);
            
        }
    
        <ff>function</ff> detay()
        {
        	<comment> // Masterpage olarak ayarlanmış sayfaya başlık ve meta bilgileri gönderiyoruz.</comment>
            <vf>$this</vf>->baslik_bilgileri[<sf>'title'</sf>] = <sf>"Ürün Detay."</sf>;
            <vf>$this</vf>->baslik_bilgileri[<sf>'author'</sf>] = <sf>"Ozan Uykun"</sf>;
            
            <comment> // Masterpage olarak ayarlanmış sayfa üzerinde başka bir sayfanın açılması için sayfaya başka bir sayfayı veri olarak gönderiyoruz.</comment>
            <vf>$this</vf>->veriler[<sf>'sayfa'</sf>] = import::page(<sf>'Urunler/detay'</sf>,<vf>$this</vf>->sayfa_bilgileri,<kf>true</kf>);
            
            <comment> // Masterpage olarak ayarlanmış sayfaya tüm sayfa ve üst başlık bilgilerini gönderiyoruz.</comment>
            import::masterpage(<vf>$this</vf>->veriler, <vf>$this</vf>->baslik_bilgileri);
        }
}
</pre>
   </div>
   </p>
	
    <p>Yukarıdaki kodda dikkat edilirse bir sayfanın, <strong>masterpage</strong> olarak ayarlanan başka bir sayfaya veri olarak gönderilidiği görülür. Bu durum bir iskelet yapısı sağlayıp diğer tüm sayfaların aynı sayfa içerisinde açılmasını sağlar. Sayfanın ana şablonunu oluşturulup diğer sayfaların, bu ana şablonu içeren <strong>masterpage</strong> olarak ayarlanmış sayfa üzerinde açılmasını sağlanır. Bu işlemleri yaparken masterpage olarak ayarlanmış sayfaya veri gönderebileceğiniz gibi masterpage'in head yani üst bölümüne title, author gibi meta bilgileri de gönderebilirsiniz.</p>
    
    <p>Aşağıda <strong>Views/Pages/</strong> dizini içerisinde olduğu kabul edilen <strong>anasayfa.php</strong> sayfasının içeği yer almaktadır.</p>
    
    <div type="code">
Views/Pages/anasayfa.php
<pre>
<ff><x><<x>div></ff> Üst Bilgi <ff><x><<x>/div></ff>

<ff><x><<x>div></ff>
	İçerik 
	<sf><x><<x>?php</sf> <kf>echo</kf> <vf>$sayfa</vf>; <sf>?<x>></x></sf> <comment> <x><</x>!-- Veriler dizisinde gönderdiğimiz sayfa bilgisi -- <x>></x></comment>
<ff><x><<x>/div></ff>

<ff><x><<x>div></ff> Alt Bilgi <ff><x><<x>/div></ff>
</pre>
    
    <p>Kaynak kodu incelersek aslında sayfanın gerçek yapısı aşağıdaki gibidir.</p>
  
<pre>
Kaynak Kodu:
<ff><x><</x>!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<x><</x>html xmlns="http://www.w3.org/1999/xhtml">
<x><</x>head>
<x><</x>meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<x><</x>meta name="author" content="Ozan Uykun" /> <comment> <x><</x>!-- Başlık bilgileri dizisinde gönderdiğimiz author bilgisi -- <x>></x></comment>
<x><</x>title><pf>Ürünler Sayfamıza Hoş Geldiniz.</pf><x><</x>/title> <comment> <x><</x>!-- Başlık bilgileri dizisinde gönderdiğimiz title bilgisi -- <x>></x></comment>
<x><</x>/head>
<x><</x>body>

<ff><x><<x>div></ff> <pf>Üst Bilgi</pf> <ff><x><<x>/div></ff>

<ff><x><<x>div></ff>
	<pf>İçerik</pf>
	<pf>Merhaba ürünler sayfasına hoş geldiniz.</pf> <comment> <x><</x>!-- Veriler dizisinde gönderdiğimiz sayfa bilgisi -- <x>></x></comment>
<ff><x><<x>/div></ff>

<ff><x><<x>div></ff> <pf>Alt Bilgi</pf> <ff><x><<x>/div></ff>
	
<x><</x>/body>
<x><</x>/html></ff>
</pre>   
    </div>
    
    <p>Aslında basit bir kod içeren bir sayfanın, masterpage yapısı ile ne hale geldiğini gösteren örnek bir uygulama yapmış olduk. Bom boş bir sayfaya, gerekli olan html taglarını <strong>masterpage</strong> sayesinde otomatik olarak eklemiş bulunduk. Eğer istersek meta, başlık veya içerik bilgileri de gönderebiliriz.</p>
    
    
    <p class="cstfont" id="import_masterpage_send_data">Masterpage Olarak Belirlenen Sayfaya Veri Göndermek</p>
    <p>Masterpage olarak ayarlanmış sayfaya başlık, meta ve içerik bilgileri gönderebilirsiniz. Bu bölümde masterpage olarak ayarlanan sayfaya veri gönderimini göstereceğiz. Bu yöntem sayesinde masterpage olarak ayarlanan sayfada istediğiniz verileri kullanabileceksiniz. Aşağıda veri gönderimine uygun bir örnek yer almaktadır.</p> 	
    
    <p>
   	<div type="code">
<pre>
<vf>$veriler</vf> = <kf>array</kf>(
    <sf>'ust_bilgi'</sf> => <sf>'Üst Bilgi'</sf>,
    <sf>'icerik'</sf>	=> <sf>'İçerik'</sf>,
    <sf>'alt_bilgi'</sf>	=> <sf>'Atl Bilgi'</sf>
);

import::masterpage(<vf>$veriler</vf>);
</pre>
şimdi bu verileri <strong>Views/Pages/anasayfa.php</strong> sayfasında kullanalım.
   	</div>
  	</p>
    
    <p>
   	<div type="code">
<pre>
<ff><x><<x>div></ff> <pf><sf><x><</x>?php</sf> <kf>echo</kf> <vf>$ust_bilgi</vf>;</pf> <sf>?<x>></x></sf><pf> <ff><x><<x>/div></ff>

<ff><x><<x>div></ff> <pf><sf><x><</x>?php</sf> <kf>echo</kf> <vf>$icerik</vf>;</pf> <sf>?<x>></x></sf><pf> <ff><x><<x>/div></ff>

<ff><x><<x>div></ff> <pf><sf><x><</x>?php</sf> <kf>echo</kf> <vf>$alt_bilgi</vf>;</pf> <sf>?<x>></x></sf><pf> <ff><x><<x>/div></ff>
   	</div>
  	</p>
    
    <p><strong>Controllers</strong> sayfasından gönderilen verileri, <strong>masterpage</strong> olarak belirlenmiş sayfa içerisinde nasıl kullanılacağını gösterdik. Örnek amaçlı olduğu için basit veriler gönderdik. Siz isterseniz bir sayfa içeriği veya baner gibi gelişmiş verilerde gönderebilirsiniz.  Şimdi masterpage olarak ayarlanan sayfaya başlık, meta gibi head verilerinin nasıl gönderildiğini gösterelim.</p>
    
    
    <p class="cstfont" id="import_masterpage_send_head_data">Masterpage Sayfasına Başlık Bilgileri Göndermek</p>
    <p>Bir sayfanın masterpage olarak ayarlanması o sayfaya gerekli html kodlarının ilave edilmesi demektir. Bu nedenle siz head tagları arasında farklı yapılar, taglar veya veriler kullanmak isteyebilirsiniz. İşte bu gibi işlemler için masterpage yönteminin kendisine de veriler gönderebilirsiniz. Şimdi bu işlemin nasıl yapıldığını gösterelim. Öncelikle hangi başlık bilgileri gönderebilirsiniz bunu bir liste üzerinde incelemeye çalışalım.</p> 	
    
    
    <table class="cfont">
    	<tr><th>Gönderilebilecek Başlık Bilgileri</th><td>Anlamları</td></tr>
        <tr><th>string title</th><td>Masterpage'e başlık bilgisi gönderir.</td></tr>
        <tr><th>string cache</th><td>Masterpage'e ön bellekleme bilgisi gönderir.</td></tr>
        <tr><th>string refresh</th><td>Masterpage'e sayfa yenileme bilgisi gönderir.</td></tr>
        <tr><th>string abstract</th><td>Masterpage'e varsayılan site bilgisi gönderir.</td></tr>
        <tr><th>string description</th><td>Masterpage'e ön açıklama bilgisi gönderir.</td></tr>
        <tr><th>string copyright</th><td>Masterpage'e ön telif hakkı bilgisi gönderir.</td></tr>
        <tr><th>string expires</th><td>Masterpage'e zaman aşımı bilgisi gönderir.</td></tr>
        <tr><th>string pragma</th><td>Masterpage'e arama motoru bilgisi gönderir.</td></tr>
        <tr><th>string keywords</th><td>Masterpage'e anahtar kelime bilgisi gönderir.</td></tr>
        <tr><th>string author</th><td>Masterpage'e sayfa yazarı bilgisi gönderir.</td></tr>
        <tr><th>string designer</th><td>Masterpage'e sayfa tasarımcısı bilgisi gönderir.</td></tr>
        <tr><th>string distribution</th><td>Masterpage'e hitap bilgisi gönderir.</td></tr>
        <tr><th>string revisit</th><td>Masterpage'e güncelleme bilgisi gönderir.</td></tr>
        <tr><th>string/array robots</th><td>Masterpage'e aramam motoru takip linkleri bilgisi gönderir.</td></tr>
        <tr><th>array meta => name</th><td>Masterpage'e farklı isim içerikli meta bilgileri eklemek için kullanılır.</td></tr>
        <tr><th>array meta => http</th><td>Masterpage'e farklı http-equiv içerikli meta bilgileri eklemek için kullanılır.</td></tr>
        <tr><th>array data</th><td>Masterpage'e farklı bir kod eklemek için kullanılır.</td></tr>
        <tr><th>string/array font</th><td>Masterpage'e harici font eklemek için kullanılır.</td></tr>
        <tr><th>string/array style</th><td>Masterpage'e harici stil dosyası eklemek için kullanılır.</td></tr>
        <tr><th>string/array script</th><td>Masterpage'e harici java script dosyası eklemek için kullanılır.</td></tr>
    </table>
    
      
<p>
   	<div type="code">
<pre>
<vf>$veriler</vf> = <kf>array</kf>();

<vf>$baslik_veriler</vf> = <kf>array</kf>
(
        <sf>'title'</sf> 	=> <sf>'Burası Anasayfadır'</sf>,
        <sf>'author'</sf>	=> <sf>'Ozan Uykun'</sf>,
        <sf>'description'</sf>	=> <sf>'Örnek Uygulama'</sf>,
        <sf>'keywords'</sf>	=> <sf>'Bilgi, Zntr, Kod Çatısı, Uygulama, Örnek'</sf>,
        <sf>'meta'</sf>		=> <kf>array</kf>
        (
            <sf>'name'</sf> => <kf>array</kf>(<sf>'farkli1'</sf> => <sf>'meta1'</sf>, <sf>'farkli2'</sf> => <sf>'meta2'</sf>),
            <sf>'http'</sf> => <kf>array</kf>(<sf>'farkli1'</sf> => <sf>'meta1'</sf>, <sf>'farkli2'</sf> => <sf>'meta2'</sf>)
        ),
        <sf>'data'</sf>		=> <kf>array</kf>
        (
            <sf>'<x><</x>farkli1>bir kod<x><</x>/farkli1>'</sf>,
            <sf>'<x><</x>farkli2>bir kod<x><</x>/farkli2>'</sf>
        )
);

import::masterpage(<vf>$veriler</vf>, <vf>$baslik_veriler</vf>);
</pre>
   	</div>
  	</p>
    
    <p>Şimdi masterpage olarak ayarlanan sayfanın kaynak kodunu inceleyip sayfada ne gibi değişiklikler olduğunu görelim.</p>
    
    <div type="code">
<pre><comment>
<x><</x>!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//TR" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<x><</x>html xmlns="http://www.w3.org/1999/xhtml">
<x><</x>head>
<x><</x>meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<x><</x>meta http-equiv="Content-Language" content="tr" />
<x><</x>title>Burası Anasayfadır<x><</x>/title>
<x><</x>meta name="description" content="Örnek Uygulama" />
<x><</x>meta name="farkli1" content="meta1" />
<x><</x>meta name="farkli2" content="meta2" />
<x><</x>meta http-equiv="farkli1" content="meta1" />
<x><</x>meta http-equiv="farkli2" content="meta2" />
<x><</x>meta name="keywords" content="Bilgi, Zntr, Kod Çatısı, Uygulama, Örnek" />
<x><</x>meta name="author" content="Ozan Uykun" />
<x><</x>farkli1>bir kod<x><</x>/farkli1>
<x><</x>farkli2>bir kod<x><</x>/farkli2>
<x><</x>/head>
<x><</x>body>

<x><</x>/body>
<x><</x>/html>
</comment></pre>
	</div>    
   
<p>Gördüğünüz gibi masterpage yöntemine kodsal bir müdahale etmeden istenilen her türlü bilgiyi ilave edebiliyoruz.</p>



<p class="cstfont" id="import_masterpage_config">Masterpage Konfigürasyon Dosyasını Kullanarak Başlık Bilgileri Göndermek</p>
    <p>Başlık bilgileri masterpage'e parametre olarak gönderilebileceği gibi konfigürasyon dosyasındanda gönderilebilir bunu yapmak için <strong>Config/Masterpage.php</strong> dosyasını kullanabilirsiniz. Dosyayı açtığınızıda yukarıdaki başlık bilgisi listesine benzer ayarların olduğunu göreceksiniz.</p> 
    
    <p>Bilmeniz gereken<strong> tüm sayfalar için geçerli olacağını düşündüğünüz ayarlar</strong> için bu konfigürasyon dosyasını kullanmanızdır şayet sayfadan sayfaya meta bilgileri veya diğer bilgilerde <strong>değişiklik oluyorsa</strong> bu dosyadan ayar yapmanız <strong>çok akıllıca olmayacaktır</strong> yinede varsayılan mantıkta ayarlamalar yapmak mantıklı olabilir. Yine bilmeniz gereken bir diğer önemli nokta hem konfigürasyon dosyasından hemde parametre olarak aynı ayarlar yapılmışsa parametrik olarak gönderilen ayarlar geçerli olacaktır. Şimdi konfigürasyon dosyamızın içeriğini inceleyelim.</p>	
    
 
	<p>
   	<div type="code">
<strong>Config/Masterpage.php</strong>
<pre>
<comment> // ---------------------------------------------------------------------------------------------------------------------------------</comment>
<vf>$config</vf>[<sf>'Masterpage'</sf>][<sf>'head_page'</sf>] = <sf>''</sf>;
<comment> // Masterpage'in head bölümüne tüm sayfalarda geçerli olacak kodlar ilave edilmek istenirse kullanılır.
 // Yani harici herhangi bir dosyayı body page mantığındaki gibi kullanabilirsiniz.
 // Bu durum size tüm sayfalar için geçerli olacağını düşündüğünüz kodları yazmanıza imkan tanır. </comment>
<comment> // ---------------------------------------------------------------------------------------------------------------------------------</comment>

<comment> // ---------------------------------------------------------------------------------------------------------------------------------</comment>
<vf>$config</vf>[<sf>'Masterpage'</sf>][<sf>'doctype'</sf>] = <sf>'xhtml1_transitional'</sf>; 
<comment> // <x><</x>!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//TR" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"> </comment>
<comment> // ---------------------------------------------------------------------------------------------------------------------------------</comment>

<comment> // ---------------------------------------------------------------------------------------------------------------------------------</comment>
<vf>$config</vf>[<sf>'Masterpage'</sf>][<sf>'content_charset'</sf>] = <kf>array</kf>(<sf>'utf-8'</sf>);
<comment> // <x><</x>meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> </comment>
<comment> // ---------------------------------------------------------------------------------------------------------------------------------</comment>

<comment> // ---------------------------------------------------------------------------------------------------------------------------------</comment>
<vf>$config</vf>[<sf>'Masterpage'</sf>][<sf>'content_language'</sf>] = <sf>'tr'</sf>;
<comment> // <x><</x>meta http-equiv="Content-Language" content="tr" /> </comment>
<comment> // ---------------------------------------------------------------------------------------------------------------------------------</comment>

<comment> // ---------------------------------------------------------------------------------------------------------------------------------</comment>
<vf>$config</vf>[<sf>'Masterpage'</sf>][<sf>'logo'</sf>] = <sf>'ornek/logo.png'</sf>;
<comment> // <x><</x>link rel="shortcut icon" href="http://siteadi.xxx/ornek/icon.jpg" /> </comment>
<comment> // ---------------------------------------------------------------------------------------------------------------------------------</comment>

<comment> // ---------------------------------------------------------------------------------------------------------------------------------</comment>
<vf>$config</vf>[<sf>'Masterpage'</sf>][<sf>'bg_image'</sf>] = <sf>'ornek/bg.jpg'</sf>;
<comment> // <x><</x>body background='http://localhost/znfw/ornek/bg.jpg' bgproperties='fixed'> </comment>
<comment> // ---------------------------------------------------------------------------------------------------------------------------------</comment>

<comment> // ---------------------------------------------------------------------------------------------------------------------------------</comment>
<vf>$config</vf>[<sf>'Masterpage'</sf>][<sf>'font'</sf>] 	= <kf>array</kf>(<sf>'ornekfont1'</sf> , <sf>'ornekfont2'</sf>);
<comment>/*
<x><</x>style>
@font-face{font-family:"ornekfont1"; src:url("http://www.siteadi.xxx/Views/Fonts/ornekfont1.svg") format("truetype")}
@font-face{font-family:"ornekfont1"; src:url("http://www.siteadi.xxx/Views/Fonts/ornekfont1.woff") format("truetype")}
@font-face{font-family:"ornekfont1"; src:url("http://www.siteadi.xxx/Views/Fonts/ornekfont1.otf") format("truetype")}
@font-face{font-family:"ornekfont1"; src:url("http://www.siteadi.xxx/Views/Fonts/ornekfont1.ttf") format("truetype")}
@font-face{font-family:"ornekfont2"; src:url("http://www.siteadi.xxx/Views/Fonts/ornekfont2.svg") format("truetype")}
@font-face{font-family:"ornekfont2"; src:url("http://www.siteadi.xxx/Views/Fonts/ornekfont2.woff") format("truetype")}
@font-face{font-family:"ornekfont2"; src:url("http://www.siteadi.xxx/Views/Fonts/ornekfont2.otf") format("truetype")}
@font-face{font-family:"ornekfont2"; src:url("http://www.siteadi.xxx/Views/Fonts/ornekfont2.ttf") format("truetype")}
<x><</x>/style>
*/</comment>
<comment> // ---------------------------------------------------------------------------------------------------------------------------------</comment>

<comment> // ---------------------------------------------------------------------------------------------------------------------------------</comment>
<vf>$config</vf>[<sf>'Masterpage'</sf>][<sf>'style'</sf>] 	= <kf>array</kf>(<sf>'a'</sf>, <sf>'b'</sf>);
<comment> // <x><</x>link href="http://www.siteadi.xxx/Views/Styles/a.css" rel="stylesheet" type="text/css" /> </comment>
<comment> // <x><</x>link href="http://www.siteadi.xxx/Views/Styles/b.css" rel="stylesheet" type="text/css" /> </comment>
<comment> // ---------------------------------------------------------------------------------------------------------------------------------</comment>

<comment> // ---------------------------------------------------------------------------------------------------------------------------------</comment>
<vf>$config</vf>[<sf>'Masterpage'</sf>][<sf>'script'</sf>] 	= <kf>array</kf>(<sf>'a'</sf>, <sf>'b'</sf>);
<comment> // <x><</x>script type="text/javascript" src="http://www.siteadi.xxx/Views/Scripts/a.js"><x><</x>/script> </comment>
<comment> // <x><</x>script type="text/javascript" src="http://www.siteadi.xxx/Views/Scripts/b.js"><x><</x>/script> </comment>
<comment> // ---------------------------------------------------------------------------------------------------------------------------------</comment>

<comment> // ---------------------------------------------------------------------------------------------------------------------------------</comment>
<vf>$config</vf>[<sf>'Masterpage'</sf>][<sf>'title'</sf>] 	= <sf>'ZN Kod Çatısına Hoş Geldiniz'</sf>;
<comment> // <x><</x>title>ZN Kod Çatısına Hoş Geldiniz<x><</x>/title> </comment>
<comment> // ---------------------------------------------------------------------------------------------------------------------------------</comment>

<comment> // ---------------------------------------------------------------------------------------------------------------------------------</comment>
<vf>$config</vf>[<sf>'Masterpage'</sf>][<sf>'description'</sf>] = <sf>'Açıklama'</sf>;
<comment> // <x><</x>meta name="description" content="Açıklama" /> </comment>
<comment> // ---------------------------------------------------------------------------------------------------------------------------------</comment>

<comment> // ---------------------------------------------------------------------------------------------------------------------------------</comment>
<vf>$config</vf>[<sf>'Masterpage'</sf>][<sf>'author'</sf>] = <sf>'zntr.net'</sf>;
<comment> // <x><</x>meta name="author" content="zntr.net" /> </comment>
<comment> // ---------------------------------------------------------------------------------------------------------------------------------</comment>

<comment> // ---------------------------------------------------------------------------------------------------------------------------------</comment>
<vf>$config</vf>[<sf>'Masterpage'</sf>][<sf>'designer'</sf>] = <sf>'zntr.net'</sf>;
<comment> // <x><</x>meta name="author" content="zntr.net" /> </comment>
<comment> // ---------------------------------------------------------------------------------------------------------------------------------</comment>

<comment> // ---------------------------------------------------------------------------------------------------------------------------------</comment>
<vf>$config</vf>[<sf>'Masterpage'</sf>][<sf>'distribution'</sf>] = <sf>'zntr.net'</sf>;
<comment> // <x><</x>meta name="distribution" content="zntr.net" /> </comment>
<comment> // ---------------------------------------------------------------------------------------------------------------------------------</comment>

<comment> // ---------------------------------------------------------------------------------------------------------------------------------</comment>
<vf>$config</vf>[<sf>'Masterpage'</sf>][<sf>'keywords'</sf>] = <sf>'zntr, kod çatısı, framework'</sf>;
<comment> // <x><</x>meta name="keywords" content="zntr, kod çatısı, framework" /> </comment>
<comment> // ---------------------------------------------------------------------------------------------------------------------------------</comment>

<comment> // ---------------------------------------------------------------------------------------------------------------------------------</comment>
<vf>$config</vf>[<sf>'Masterpage'</sf>][<sf>'cache'</sf>] 	= <sf>'no-cache'</sf>;
<comment> // <x><</x>meta http-equiv="cache-control" content="no-cache" />  </comment>
<comment> // ---------------------------------------------------------------------------------------------------------------------------------</comment>

<comment> // ---------------------------------------------------------------------------------------------------------------------------------</comment>
<vf>$config</vf>[<sf>'Masterpage'</sf>][<sf>'refresh'</sf>] = <sf>'30'</sf>;
<comment> // <x><</x>meta http-equiv="refresh" content="30" /> </comment>
<comment> // ---------------------------------------------------------------------------------------------------------------------------------</comment>

<comment> // ---------------------------------------------------------------------------------------------------------------------------------</comment>
<vf>$config</vf>[<sf>'Masterpage'</sf>][<sf>'abstract'</sf>] = <sf>'Kısa Açıklama'</sf>;
<comment> // <x><</x>meta name="abstract" content="Kısa Açıklama" /> </comment>
<comment> // ---------------------------------------------------------------------------------------------------------------------------------</comment>

<comment> // ---------------------------------------------------------------------------------------------------------------------------------</comment>
<vf>$config</vf>[<sf>'Masterpage'</sf>][<sf>'copyright'</sf>] = <sf>'zntr.net'</sf>;
<comment> // <x><</x>meta name="copyright" content="zntr.net" /> </comment>
<comment> // ---------------------------------------------------------------------------------------------------------------------------------</comment>

<comment> // ---------------------------------------------------------------------------------------------------------------------------------</comment>
<vf>$config</vf>[<sf>'Masterpage'</sf>][<sf>'expires'</sf>] = <sf>'1'</sf>;
<comment> // <x><</x>meta http-equiv="expires" content="1" /> </comment>
<comment> // ---------------------------------------------------------------------------------------------------------------------------------</comment>

<comment> // ---------------------------------------------------------------------------------------------------------------------------------</comment>
<vf>$config</vf>[<sf>'Masterpage'</sf>][<sf>'pragma'</sf>] = <sf>'no-cache'</sf>;
<comment> // <x><</x>meta http-equiv="pragma" content="no-cache" />  </comment>
<comment> // ---------------------------------------------------------------------------------------------------------------------------------</comment>

<comment> // ---------------------------------------------------------------------------------------------------------------------------------</comment>
<vf>$config</vf>[<sf>'Masterpage'</sf>][<sf>'revisit'</sf>] = <sf>'7 days'</sf>;
<comment> // <x><</x>meta name="revisit-after" content="7 days"></comment>
<comment> // ---------------------------------------------------------------------------------------------------------------------------------</comment>

<comment> // ---------------------------------------------------------------------------------------------------------------------------------</comment>
<vf>$config</vf>[<sf>'Masterpage'</sf>][<sf>'robots'</sf>] = <kf>array</kf>(<sf>'nofollow'</sf> , <sf>'noindex'</sf>);
<comment> // <x><</x>meta name="robots" content="nofollow" /></comment>
<comment> // <x><</x>meta name="robots" content="noindex" /></comment>
<comment> // ---------------------------------------------------------------------------------------------------------------------------------</comment>

<comment> // ---------------------------------------------------------------------------------------------------------------------------------</comment>
<vf>$config</vf>[<sf>'Masterpage'</sf>][<sf>'meta'</sf>][<sf>'name'</sf>] = <kf>array</kf>
(
	<sf>'googlebot'</sf> => <sf>'nofollow'</sf>,
    	<sf>'ornekbot'</sf> => <sf>'nofollow'</sf>
);
<comment> // <x><</x>meta name="googlebot" content="nofollow" /></comment>
<comment> // <x><</x>meta name="ornekbot" content="nofollow" /></comment>
<comment> // ---------------------------------------------------------------------------------------------------------------------------------</comment>

<comment> // ---------------------------------------------------------------------------------------------------------------------------------</comment>
<vf>$config</vf>[<sf>'Masterpage'</sf>][<sf>'meta'</sf>][<sf>'http'</sf>] = <kf>array</kf>
(
	<sf>'ornek1'</sf> => <sf>'deger1'</sf>,
    	<sf>'ornek2'</sf> => <sf>'deger2'</sf>
);
<comment> // <x><</x>meta http-equiv="ornek1" content="deger1" /></comment>
<comment> // <x><</x>meta http-equiv="ornek2" content="deger2" /></comment>
<comment> // ---------------------------------------------------------------------------------------------------------------------------------</comment>

<comment> // ---------------------------------------------------------------------------------------------------------------------------------</comment>
<vf>$config</vf>[<sf>'Masterpage'</sf>][<sf>'data'</sf>] = <kf>array</kf>
(
	<sf>'<x><</x>ornek1 icerik="deneme1" />'</sf>,
    	<sf>'<x><</x>ornek2 icerik="deneme2" />'</sf>
);
<comment> // <x><</x>ornek1 icerik="deneme1" /></comment>
<comment> // <x><</x>ornek2 icerik="deneme2" /></comment>

<comment> // ---------------------------------------------------------------------------------------------------------------------------------</comment>
</pre>
   	</div>
  	</p>

	<p>Yukarıdaki ayarlar örnek amaçlı kullanılmıştır. Bir kaç ayar dışında geri kalan ayarlar varsayılan olarak değer almamıştır.</p>
    
    <div type="note"><div>NOT</div><div>Konfigürasyon dosyasından ayar yapacaksanız bu ayarların tüm sayfalar için geçerli olacağını unutmayınız. İsterseniz sayfa içinden bazı bilgilerin girilmesi unutulursa varsayılan olarak konfigürasyon dosyasında yer alan ayarların geçerli olmasını sağlamak gibi bir mantıkta ayarlamalar yapabilirsiniz. Bu durum işinize yarayacaktır. <strong>Neticede konfigürasyon dosyasından ayarlar yapılmış bile olsa aynı ayarlar, sayfa içinde parametre olarak kullanılmışsa parametrik ayarlar geçerli olacaktır.</strong></div></div>
       
<div type="prev-next">
    	<div type="prev-btn"><a href="import_functions.html">Önceki</a></div><div type="next-btn"><a href="db_dynamic.html">Sonraki</a></div>
    </div>
 
</body>
</html>              