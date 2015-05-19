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
    <div id="content-document"><a href="#">Döküman</a> » <a href="libraries.html">Kütüphaneler</a> » XML Sınıfı</div> 
    <p class="ctfont">XML Sınıfı</p>
    <p>Xml sınıfının statik forma çevrilmiş halidir.</p>
    <ul><li><a href="#" class="infont">XML Sınıfı ve Yöntemleri</a><br><br>
        <ul>  	  
        	<li><a href="#xml_import">Xml Kütüphanesini Dahil Etmek</a></li>  
            <li><a href="#xml_create">XML Verisi Oluşturmak » <b>xml::create()</b></a></li> 
            <li><a href="#xml_add_element">Element Eklemek » <b>xml::add_element()</b></a></li>
            <li><a href="#xml_remove_element">Element Silmek » <b>xml::remove_element()</b></a></li> 
            <li><a href="#xml_add_attr">Elemente Özellik Eklemek » <b>xml::add_attr()</b></a></li>
            <li><a href="#xml_remove_attr">Elementin Özelliğini Kaldırmak » <b>xml::remove_attr()</b></a></li>
            <li><a href="#xml_get_attr">Özelliğin Değerine Ulaşmak » <b>xml::get_attr()</b></a></li>
            <li><a href="#xml_add_content">Elemente İçerik Eklemek » <b>xml::add_content()</b></a></li>
            <li><a href="#xml_get_content">Elementin Değerine Ulaşmak » <b>xml::get_content()</b></a></li>
            <li><a href="#xml_get_content">Elementin İsmine Göre İçeriği Dizi Olarak Almak » <b>xml::get_contents_by_name()</b></a></li>
            <li><a href="#xml_get_content">Elementin Id'sine Göre İçeriği Almak » <b>xml::get_content_by_id()</b></a></li>
            <li><a href="#xml_save">XML Versini Kaydetmek » <b>xml::save()</b></a></li>
            <li><a href="#xml_load">Harici XML Dosyası Veya XML Metni Yüklemek » <strong>xml::load()</strong></b></a></li>
        	<li><a href="#xml_path">Yüklenmiş Harici XML Dosyasının Element ve Değerlerine Ulaşmak » <b>xml::path()</b></a></li>  
        </ul>
    </li></ul>
    
    <p class="cstfont" id="xml_import">Xml Kütüphanesini Dahil Etmek</p>
    <div type="code">
  	import::library(<sf>'Xml'</sf>);
    </div>
    
    <p class="cstfont" id="xml_create">XML Verisi Oluşturmak</p>
    <p><ftype>xml::create( [ <kf>string</kf> <vf>$versiyon</vf> = <sf>'1.0'</sf> ] , [ <kf>string</kf> <vf>$karakterseti</vf> = <sf>'iso-8859-8'</sf> ] , [ <kf>boolean</kf> <vf>$duzenli_cikti</vf> = <kf>true</kf> ] )</ftype></p>
    <p>Bir xml verisini oluşturmak için kullanılan yöntemdir. Oluşturma işlemi bu yöntem ile başlar 3 ön tanımlı parametresi vardır. Versiyon, Karakter Seti, Düzenli Çıktı</p> 
    
    <p>
    	<table class="cfont">
        	<tr><th>Parametre</th><td>Anlamları</td></tr>
            <tr><th>1. Parametre = [Versiyon = "1.0"]</th><td>Xml verisinin versiyonu.</td></tr>
            <tr><th>2. Parametre = [Karakter Seti = "iso-8859-8"]</th><td>Xml verisinin karakter seti.</td></tr>
            <tr><th>3. Parametre = [Düzenli Çıktı = true]</th><td>Oluşturulan Xml verisinin düzenli görünmesi.</td></tr>
        </table>
    </p>
    
    <div type="code">
    <pre>
import::library(<sf>'Xml'</sf>);
<strong>xml::create</strong>(); <comment> // Şuan itibaren xml verisi oluşturma işlemi başladı.</comment>
<kf>echo</kf> xml::save();<comment> // Kaynak Kod: <x><</x>?xml version="1.0" encoding="iso-8859-8"?></comment>
    </pre>
    </div>
    
    <p class="cstfont" id="xml_add_element">Element Eklemek</p>
    <p><ftype>xml::add_element( <kf>string</kf> <vf>$element</vf> , [ <kf>object</kf> <vf>$hangi_element_icine_eklenecek</vf> = <kf>NULL</kf> ] )</ftype></p>
    <p>Element eklemek için kullanılır 2 parametresi vardır. İlk parametre eklenecek elementin adıdır. İkinci parametre ise hangi elementin içine ekleneceğidir eğer bu parametre boş geçilirse node denilen kök element oluşturulmuş olur. Şimdi aşağıda tekrar parametrelerini inceleyelim sonrada örnek üzerinde gösterelim.</p> 
    
    <p>
    	<table class="cfont">
        	<tr><th>Parametre</th><td>Anlamları</td></tr>
            <tr><th>1. Parametre = Element Adı</th><td>Eklenecek element adı.</td></tr>
            <tr><th>2. Parametre = [Hangi Elemente Eklenecek]</th><td>Hangi elementin içerisine ekleneceği.</td></tr>
        </table>
    </p>
    
    <div type="code">
    <pre>
import::library(<sf>'Xml'</sf>);

xml::create(); <comment> // Şuan itibaren xml verisi oluşturma işlemi başladı.</comment>

<vf>$medya</vf> = <strong>xml::add_element</strong>(<sf>'medya'</sf>); <comment> // medya isminde kök element oluşturuluyor.</comment>

<vf>$vidyo</vf> = xml::add_element(<sf>'vidyo'</sf>, <vf>$medya</vf>); <comment> // medya elementi içerisine vidyo isminde yeni bir element ekleniyor.</comment>
<vf>$muzik</vf> = xml::add_element(<sf>'muzik'</sf>, <vf>$medya</vf>);
<vf>$resim</vf> = xml::add_element(<sf>'resim'</sf>, <vf>$medya</vf>);

<kf>echo</kf> xml::save();
<comment>
/* Kaynak Kod ---------------- 
<x><</x>?xml version="1.0" encoding="iso-8859-8"?>
<x><</x>medya>
	<x><</x>vidyo>
	<x><</x>/vidyo>
    
    	<x><</x>muzik>
	<x><</x>/muzik>
    
    	<x><</x>resim>
	<x><</x>/resim>
<x><</x>/medya>
*/
</comment>
    </pre>
    </div>
    
    <p class="cstfont" id="xml_remove_element">Element Kaldırmak</p>
    <p><ftype>xml::remove_element( <kf>string</kf> <vf>$element</vf> , <kf>object/array_object</kf> <vf>$kaldirilacak_elementler</vf> )</ftype></p>
    <p>Element kaldırmak için kullanılır 2 parametresi vardır. İlk parametre hangi elementin kaldırılacak alt elementinin adıdır. İkinci parametre ise kaldırılıcak element veya elemetnlerin adıdır.</p> 
    
    <p>
    	<table class="cfont">
        	<tr><th>Parametre</th><td>Anlamları</td></tr>
            <tr><th>1. Parametre = Element Adı</th><td>Eklenecek element adı.</td></tr>
            <tr><th>2. Parametre = Kaldırılacak Element/Elementler</th><td>Kaldırılacak element veya elementlerin isimleri.</td></tr>
        </table>
    </p>
    
    <div type="code">
    <pre>
import::library(<sf>'Xml'</sf>);

xml::create(); <comment> // Şuan itibaren xml verisi oluşturma işlemi başladı.</comment>

<vf>$medya</vf> = xml::add_element(<sf>'medya'</sf>);
<vf>$vidyo</vf> = xml::add_element(<sf>'vidyo'</sf>, <vf>$medya</vf>);
<vf>$muzik</vf> = xml::add_element(<sf>'muzik'</sf>, <vf>$medya</vf>);
<vf>$resim</vf> = xml::add_element(<sf>'resim'</sf>, <vf>$medya</vf>);

<strong>xml::remove_element</strong>(<vf>$medya</vf>, <kf>array</kf>(<vf>$muzik</vf>, <vf>$resim</vf>)); <comment> // Tek eleman kaldırılacaksa dizi kullanmanıza gerek yok.</comment>

<kf>echo</kf> xml::save();
<comment>
/* Kaynak Kod ---------------- 
<x><</x>?xml version="1.0" encoding="iso-8859-8"?>
<x><</x>medya>
	<x><</x>vidyo>
	<x><</x>/vidyo>
<x><</x>/medya>
*/
</comment>
    </pre>
    </div>
    
    
    
    <p class="cstfont" id="xml_add_attr">Elemente Özellik Eklemek</p>
    <p><ftype>xml::add_attr( <kf>object</kf> <vf>$element</vf> , [ <kf>array/string</kf> <vf>$ozellik</vf> ] , [ <kf>string</kf> <vf>$deger</vf> ] )</ftype></p>
    <p>Elemente özellik eklemek için kullanılır 1. parametre özelliğin ekleneceği element adıdır. 2 parametre hem dizi hemde strin olarak kullanılabilen bir parametredir eğer ekleyeceğini özellik bir tane ise bu parametreye özellğin adı bir sonraki 3. parametreye ise özelliğin değeri yazılır şayet birden fazla özellik eklemek istiyorsanız 2. parametreye anahtar değer çiftleri içeren dizi değişken yazılır 3. parametrenin kullanımına gerek yoktur.</p> 
    
    <p>
    	<table class="cfont">
        	<tr><th>Parametre</th><td>Anlamları</td></tr>
            <tr><th>1. Parametre = Element Adı</th><td>Özelliğin ekleneceği element adı.</td></tr>
            <tr><th>2. Parametre = [string Özellik / array Özellik Değer Çiftleri]</th><td>Özelliğin adı.</td></tr>
            <tr><th>3. Parametre = [string Değer]</th><td> 2. Parametre string özellik içeriyorsa bu parametre zzelliğin değeri olarak kullanılır. Bu parametresnin kullanılabilmesi için 2. parametrenin string tür veri içeriyor olması gerekir.</td></tr>
        </table>
    </p>
    
    <div type="code">
    <pre>
import::library(<sf>'Xml'</sf>);

xml::create(); <comment> // Şuan itibaren xml verisi oluşturma işlemi başladı.</comment>

<vf>$medya</vf> = xml::add_element(<sf>'medya'</sf>);
<vf>$vidyo</vf> = xml::add_element(<sf>'vidyo'</sf>, <vf>$medya</vf>);
<vf>$muzik</vf> = xml::add_element(<sf>'muzik'</sf>, <vf>$medya</vf>);
<vf>$resim</vf> = xml::add_element(<sf>'resim'</sf>, <vf>$medya</vf>);

<strong>xml::add_attr</strong>(<vf>$vidyo</vf>, <kf>array</kf>(<sf>'id'</sf> => <sf>'vidyo'</sf>, <sf>'name'</sf> => <sf>'vidyo'</sf>, <sf>'extensions'</sf> => <sf>'mp4|mpeg|avi'</sf>));
<strong>xml::add_attr</strong>(<vf>$muzik</vf>, <kf>array</kf>(<sf>'id'</sf> => <sf>'muzik'</sf>, <sf>'name'</sf> => <sf>'muzik'</sf>, <sf>'extensions'</sf> => <sf>'mp3'</sf>));
<strong>xml::add_attr</strong>(<vf>$resim</vf>, <kf>array</kf>(<sf>'id'</sf> => <sf>'resim'</sf>, <sf>'name'</sf> => <sf>'resim'</sf>, <sf>'extensions'</sf> => <sf>'jpeg|jpg|gif|png'</sf>));
<kf>echo</kf> xml::save();
<comment>
/* Kaynak Kod ---------------- 
<x><</x>?xml version="1.0" encoding="iso-8859-8"?>
<x><</x>medya>
	<x><</x>vidyo id="vidyo" name="vidyo" extensions="mp4|mpeg|avi">
	<x><</x>/vidyo>
    
    	<x><</x>muzik id="muzik" name="muzik" extensions="mp3">
	<x><</x>/muzik>
    
    	<x><</x>resim id="resim" name="resim" extensions="jpeg|jpg|gif|png">
	<x><</x>/resim>
<x><</x>/medya>
*/
</comment>
    </pre>
    </div>
    
    
    <p class="cstfont" id="xml_remove_attr">Özellik Kaldırmak</p>
    <p><ftype>xml::remove_attr( <kf>object</kf> <vf>$element</vf> , [ <kf>array/string</kf> <vf>$ozellik</vf> ] )</ftype></p>
    <p>Eklenen özellikleri kaldırmak için kullanılır. 2 parametresi vardır 1. parametre kaldırılacak elementin adı iken 2. parametre kaldırılacak özellik veya özelliklerdir. </p> 
    
    <p>
    	<table class="cfont">
        	<tr><th>Parametre</th><td>Anlamları</td></tr>
            <tr><th>1. Parametre = Element Adı</th><td>Özelliğin ekleneceği element adı.</td></tr>
            <tr><th>2. Parametre = [string Özellik / array Özellikler]</th><td>Özelliğin adı.</td></tr>

        </table>
    </p>
    
    <div type="code">
    <pre>
import::library(<sf>'Xml'</sf>);

xml::create(); <comment> // Şuan itibaren xml verisi oluşturma işlemi başladı.</comment>

<vf>$medya</vf> = xml::add_element(<sf>'medya'</sf>);
<vf>$vidyo</vf> = xml::add_element(<sf>'vidyo'</sf>, <vf>$medya</vf>);
<vf>$muzik</vf> = xml::add_element(<sf>'muzik'</sf>, <vf>$medya</vf>);
<vf>$resim</vf> = xml::add_element(<sf>'resim'</sf>, <vf>$medya</vf>);

xml::add_attr(<vf>$vidyo</vf>, <kf>array</kf>(<sf>'id'</sf> => <sf>'vidyo'</sf>, <sf>'name'</sf> => <sf>'vidyo'</sf>, <sf>'extensions'</sf> => <sf>'mp4|mpeg|avi'</sf>));
xml::add_attr(<vf>$muzik</vf>, <kf>array</kf>(<sf>'id'</sf> => <sf>'muzik'</sf>, <sf>'name'</sf> => <sf>'muzik'</sf>, <sf>'extensions'</sf> => <sf>'mp3'</sf>));
xml::add_attr(<vf>$resim</vf>, <kf>array</kf>(<sf>'id'</sf> => <sf>'resim'</sf>, <sf>'name'</sf> => <sf>'resim'</sf>, <sf>'extensions'</sf> => <sf>'jpeg|jpg|gif|png'</sf>));

<strong>xml::remove_attr</strong>(<vf>$vidyo</vf>, '<sf>id</sf>');
<strong>xml::remove_attr</strong>(<vf>$muzik</vf>, <kf>array</kf>(<sf>'name'</sf>, <sf>'id'</sf>));

<kf>echo</kf> xml::save();
<comment>
/* Kaynak Kod ---------------- 
<x><</x>?xml version="1.0" encoding="iso-8859-8"?>
<x><</x>medya>
	<x><</x>vidyo name="vidyo" extensions="mp4|mpeg|avi">
	<x><</x>/vidyo>
    
    	<x><</x>muzik extensions="mp3">
	<x><</x>/muzik>
    
    	<x><</x>resim id="resim" name="resim" extensions="jpeg|jpg|gif|png">
	<x><</x>/resim>
<x><</x>/medya>
*/
</comment>
    </pre>
    </div>
    
    
    <p class="cstfont" id="xml_get_attr">Özellik Değerine Ulaşmak</p>
    <p><ftype>xml::get_attr( <kf>object</kf> <vf>$element</vf> , [ <kf>array/string</kf> <vf>$ozellik</vf> ] )</ftype></p>
    <p>Eklenen özelliklerin değerine uleşmak kullanılır. 2 parametresi vardır 1. parametre özelliğine ulaşılacak elementin adı iken 2. parametre elementin özellik veya özelliklerdir. </p> 
    
    <p>
    	<table class="cfont">
        	<tr><th>Parametre</th><td>Anlamları</td></tr>
            <tr><th>1. Parametre = Element Adı</th><td>Element adı.</td></tr>
            <tr><th>2. Parametre = [string Özellik / array Özellikler]</th><td>Özelliğin adı.</td></tr>

        </table>
    </p>
    
    <div type="code">
    <pre>
import::library(<sf>'Xml'</sf>);

xml::create(); <comment> // Şuan itibaren xml verisi oluşturma işlemi başladı.</comment>

<vf>$medya</vf> = xml::add_element(<sf>'medya'</sf>);
<vf>$vidyo</vf> = xml::add_element(<sf>'vidyo'</sf>, <vf>$medya</vf>);
<vf>$muzik</vf> = xml::add_element(<sf>'muzik'</sf>, <vf>$medya</vf>);
<vf>$resim</vf> = xml::add_element(<sf>'resim'</sf>, <vf>$medya</vf>);

xml::add_attr(<vf>$vidyo</vf>, <kf>array</kf>(<sf>'id'</sf> => <sf>'vidyo'</sf>, <sf>'name'</sf> => <sf>'vidyo'</sf>, <sf>'extensions'</sf> => <sf>'mp4|mpeg|avi'</sf>));
xml::add_attr(<vf>$muzik</vf>, <kf>array</kf>(<sf>'id'</sf> => <sf>'muzik'</sf>, <sf>'name'</sf> => <sf>'muzik'</sf>, <sf>'extensions'</sf> => <sf>'mp3'</sf>));
xml::add_attr(<vf>$resim</vf>, <kf>array</kf>(<sf>'id'</sf> => <sf>'resim'</sf>, <sf>'name'</sf> => <sf>'resim'</sf>, <sf>'extensions'</sf> => <sf>'jpeg|jpg|gif|png'</sf>));

<kf>echo</kf> <strong>xml::get_attr</strong>(<vf>$vidyo</vf>, '<sf>extensions</sf>'); <comment> // Çıktı: mp4|mpeg|avi</comment>
<ff>var_dump</ff>(<strong>xml::get_attr</strong>(<vf>$muzik</vf>, <kf>array</kf>(<sf>'name'</sf>, <sf>'id'</sf>))); <comment> // Birden fazla özellik için dizi değişken kullanılır tabi çıktı dizi olarak döner.</comment>
<comment>
*/
array (size=2)
  'name' => string 'muzik' (length=5)
  'id' => string 'muzik' (length=5)
*/
</comment>

<kf>echo</kf> xml::save();
<comment>
/* Kaynak Kod ---------------- 
<x><</x>?xml version="1.0" encoding="iso-8859-8"?>
<x><</x>medya>
	<x><</x>vidyo id="vidyo" name="vidyo" extensions="mp4|mpeg|avi">
	<x><</x>/vidyo>
    
    	<x><</x>muzik id="muzik" name="muzik" extensions="mp3">
	<x><</x>/muzik>
    
    	<x><</x>resim id="resim" name="resim" extensions="jpeg|jpg|gif|png">
	<x><</x>/resim>
<x><</x>/medya>
*/
</comment>
    </pre>
    </div>
    
    
    
    <p class="cstfont" id="xml_add_content">Elemente İçerik Eklemek</p>
    <p><ftype>xml::add_content( <kf>object</kf> <vf>$element</vf> , [ <kf>string</kf> <vf>$icerik</vf> ] )</ftype></p>
    <p>Elemente içerik eklemek için kullanılır 2 parametresi vardır 1. parametre eklencek elementin adı iken 2. parametre içeriktir.</p> 
    
    <p>
    	<table class="cfont">
        	<tr><th>Parametre</th><td>Anlamları</td></tr>
            <tr><th>1. Parametre = Element Adı</th><td>Element adı.</td></tr>
            <tr><th>2. Parametre = [string İçerik]</th><td>Eklenecek içerik.</td></tr>

        </table>
    </p>
    
<div type="code">
    <pre>
import::library(<sf>'Xml'</sf>);

xml::create(); <comment> // Şuan itibaren xml verisi oluşturma işlemi başladı.</comment>

<vf>$medya</vf> = xml::add_element(<sf>'medya'</sf>);
<vf>$vidyo</vf> = xml::add_element(<sf>'vidyo'</sf>, <vf>$medya</vf>);
<vf>$muzik</vf> = xml::add_element(<sf>'muzik'</sf>, <vf>$medya</vf>);
<vf>$resim</vf> = xml::add_element(<sf>'resim'</sf>, <vf>$medya</vf>);

xml::add_attr(<vf>$vidyo</vf>, <kf>array</kf>(<sf>'id'</sf> => <sf>'vidyo'</sf>, <sf>'name'</sf> => <sf>'vidyo'</sf>, <sf>'extensions'</sf> => <sf>'mp4|mpeg|avi'</sf>));
xml::add_attr(<vf>$muzik</vf>, <kf>array</kf>(<sf>'id'</sf> => <sf>'muzik'</sf>, <sf>'name'</sf> => <sf>'muzik'</sf>, <sf>'extensions'</sf> => <sf>'mp3'</sf>));
xml::add_attr(<vf>$resim</vf>, <kf>array</kf>(<sf>'id'</sf> => <sf>'resim'</sf>, <sf>'name'</sf> => <sf>'resim'</sf>, <sf>'extensions'</sf> => <sf>'jpeg|jpg|gif|png'</sf>));

<strong>xml::add_content</strong>(<vf>$vidyo</vf>, <sf>"Burası vidyo bölümüdür."</sf>);
<strong>xml::add_content</strong>(<vf>$muzik</vf>, <sf>"Burası muzik bölümüdür."</sf>);
<strong>xml::add_content</strong>(<vf>$resim</vf>, <sf>"Burası resim bölümüdür."</sf>);

<kf>echo</kf> xml::save();
<comment>
/* Kaynak Kod ---------------- 
<x><</x>?xml version="1.0" encoding="iso-8859-8"?>
<x><</x>medya>
	<x><</x>vidyo id="vidyo" name="vidyo" extensions="mp4|mpeg|avi">
    		Burası vidyo bölümüdür.
	<x><</x>/vidyo>
    
    	<x><</x>muzik id="muzik" name="muzik" extensions="mp3">
        	Burası muzik bölümüdür.
	<x><</x>/muzik>
    
    	<x><</x>resim id="resim" name="resim" extensions="jpeg|jpg|gif|png">
        	Burası resim bölümüdür.
	<x><</x>/resim>
<x><</x>/medya>
*/
</comment>
    </pre>
    </div>
    
    
    
    <p class="cstfont" id="xml_get_content">Elementin Değerine Ulaşmak</p>
    <p><ftype>xml::get_content( <kf>object</kf> <vf>$element</vf> )</ftype></p>
    <p><ftype>xml::get_content_by_id( <kf>string</kf> <vf>$element</vf> )</ftype></p>
    <p><ftype>xml::get_content_by_name( <kf>string</kf> <vf>$element</vf> )</ftype></p>
    <p>Elementin içeriğine ulaşmak için kullanılır tek parametresi vardır. Element Adı</p> 
    
    <p>
    	<table class="cfont">
        	<tr><th>Parametre</th><td>Anlamları</td></tr>
            <tr><th>1. Parametre = Element Adı</th><td>Element adı.</td></tr>
        </table>
    </p>
    
<div type="code">
    <pre>
import::library(<sf>'Xml'</sf>);

xml::create(); <comment> // Şuan itibaren xml verisi oluşturma işlemi başladı.</comment>

<vf>$medya</vf> = xml::add_element(<sf>'medya'</sf>);
<vf>$vidyo</vf> = xml::add_element(<sf>'vidyo'</sf>, <vf>$medya</vf>);
<vf>$muzik</vf> = xml::add_element(<sf>'muzik'</sf>, <vf>$medya</vf>);
<vf>$resim</vf> = xml::add_element(<sf>'resim'</sf>, <vf>$medya</vf>);

xml::add_attr(<vf>$vidyo</vf>, <kf>array</kf>(<sf>'<strong>xml:id</strong>'</sf> => <sf>'vidyo'</sf>, <sf>'name'</sf> => <sf>'vidyo'</sf>, <sf>'extensions'</sf> => <sf>'mp4|mpeg|avi'</sf>));
xml::add_attr(<vf>$muzik</vf>, <kf>array</kf>(<sf>'id'</sf> => <sf>'muzik'</sf>, <sf>'name'</sf> => <sf>'muzik'</sf>, <sf>'extensions'</sf> => <sf>'mp3'</sf>));
xml::add_attr(<vf>$resim</vf>, <kf>array</kf>(<sf>'id'</sf> => <sf>'resim'</sf>, <sf>'name'</sf> => <sf>'resim'</sf>, <sf>'extensions'</sf> => <sf>'jpeg|jpg|gif|png'</sf>));

xml::add_content(<vf>$vidyo</vf>, <sf>"Burası vidyo bölümüdür."</sf>);
xml::add_content(<vf>$muzik</vf>, <sf>"Burası muzik bölümüdür."</sf>);
xml::add_content(<vf>$resim</vf>, <sf>"Burası resim bölümüdür."</sf>);

<kf>echo</kf> <strong>xml::get_content</strong>(<vf>$resim</vf>); <comment> // Çıktı: Burası resim bölümüdür.</comment>

<kf>echo</kf> <strong>xml::get_content_by_id</strong>(<sf>'vidyo'</sf>); <comment> // Id kullanabilmek için çağıracağınız elementte xml:id="" formatında özellik bulunmalıdır. Çıktı: Burası vidyo bölümüdür.</comment>

<ff>var_dump</ff>(<strong>xml::get_contents_by_name</strong>(<sf>'muzik'</sf>));
<comment>
array (size=1)
  0 => string 'Burası muzik bölümüdür.' (length=28)
*/
</comment>

<kf>echo</kf> xml::save();
<comment>
/* Kaynak Kod ---------------- 
<x><</x>?xml version="1.0" encoding="iso-8859-8"?>
<x><</x>medya>
	<x><</x>vidyo id="vidyo" name="vidyo" extensions="mp4|mpeg|avi">
    		Burası vidyo bölümüdür.
	<x><</x>/vidyo>
    
    	<x><</x>muzik id="muzik" name="muzik" extensions="mp3">
        	Burası muzik bölümüdür.
	<x><</x>/muzik>
    
    	<x><</x>resim id="resim" name="resim" extensions="jpeg|jpg|gif|png">
        	Burası resim bölümüdür.
	<x><</x>/resim>
<x><</x>/medya>
*/
</comment>
    </pre>
    </div>
    
    
    <p class="cstfont" id="xml_save">XML Versini Kaydetmek</p>
    <p><ftype>xml::save()</ftype></p>
    <p>XML verisini tamamlamak için kullanılır. Temel amacı <strong>Xml belgesinin son halini</strong> yazdırmaktır. Yukarıdaki örneklerde dikkat ettiyseniz Xml verilerinin en altında kullandık.</p> 
   	
    <p class="cstfont" id="xml_load">Harici XML Dosyası Veya XML Metni Yüklemek</p>
    <p><ftype>xml::load( <kf>string</kf> <vf>$dosya_adi</vf> , [ <kf>string</kf> <vf>$tip</vf> = <sf>'file'</sf> ] )</ftype></p>
    <p>Harici bir XML belgesini yüklemek için kullanılır. 2 parametresi vardır. Dosya Adı, Tip.</p> 
    
    <p>
    	<table class="cfont">
        	<tr><th>Parametre</th><td>Anlamları</td></tr>
            <tr><th>1. Parametre = Dosya Adı</th><td>Çağrılacak dosyanın veya string bir xml verisinin adı.</td></tr>
            <tr><th>2. Parametre = [Tip = "file"]</th><td>Yüklenecek olan bir dosyamı yoksa string bir xml verisimi. <strong>Alabileceği değerler: file, string</strong></td></tr>
        </table>
    </p>
    
<div type="code">
    <pre>
<vf>$xml</vf> = xml::load(<sf>'data.xml'</sf>); <comment> // Harici bir xml belgesi yükledik.</comment>

<vf>$xml</vf> = <sf>'
<x><</x>?xml version='1.0'?>
<x><</x>document>
 <x><</x>title>Deneme<x><</x>/title>
 <x><</x>from>Kimden<x><</x>/from>
 <x><</x>to>Kime<x><</x>/to>
<x><</x>/document>'<x></sf>;

<vf>$xml</vf> = xml::load(<vf>$xml</vf>, <sf>'string'</sf>); <comment> // Bu şekilde ise hali hazırda oluşturulmuş xml verisini yüklemiş olduk .</comment>
    </pre>
    </div>
    
    
    <p class="cstfont" id="xml_path">Yüklenmiş Harici XML Dosyasının Element ve Değerlerine Ulaşmak</p>
    <p><ftype>xml::path( <kf>string</kf> <vf>$bilgi</vf> )</ftype></p>
    <p><strong>xml::load()</strong> yöntmi ile yüklenmiş harici xml metnin element, özellik gibi değerlerine ulaşmak için kullanılır.</p> 
    
    <p>
    	<table class="cfont">
        	<tr><th>Parametre</th><td>Anlamları</td></tr>
            <tr><th>1. Parametre = Bilgi</th><td>Çağrılacak dosyanın veya string bir xml verisinin adı.</td></tr>
        </table>
    </p>
    
<div type="code">
    <pre>
<vf>$string</vf> = <sf>'
<x><</x>a>
     <x><</x>b>
           <x><</x>c>birinci<x><</x>/c>
           <x><</x>c>ikinci<x><</x>/c>
     <x><</x>/b>
     <x><</x>d>
      	   <x><</x>c>ücüncü<x><</x>/c>
     <x><</x>/d>
<x><</x>/a>
'</sf>;

<vf>$xml</vf> = xml::load(<vf>$string</vf>, <sf>'string'</sf>);

<vf>$xml</vf> = xml::path(<sf>'c'</sf>);

<kf>echo</kf> <vf>$xml</vf>[0]<vf>.$xml</vf>[1]; <comment> // Çıktı: birinci ikinci</comment>
    </pre>
    </div>
    
    
    
    
    <div type="prev-next">
    	<div type="prev-btn"><a href="lib_val.html">Önceki</a></div><div type="next-btn"><a href="tools.html">Sonraki</a></div>
    </div>
 
</body>
</html>              