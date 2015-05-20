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
    <div id="content-document"><a href="#">Döküman</a> » <a href="general_topic.html">Genel Konular</a> » Views Sayfa Tasarımı</div> 
    <p class="ctfont">Views Sayfa Tasarımı</p>
 	<p><b>Views/Pages/</b> dizini, html içerikli sayfaların yer alacağı dizindir. Bu bölümdeki sayfalar, <strong>Controllers/</strong> dizini içerisinde yer alan kodlayıcı dosyaları tarafından yönetilir.</p>
    
    <p>Sayfa tasarımlarının ve yönetimlerinin ayrılmasındaki temel mantık; bir sayfadaki kod fazlalığını engellemek, daha hızlı açılmalarını sağlamak ve iş bölümü yapmaktır.</p>
    
    <p class="cstfont">Tasarım Sayfası Oluşturun</p>
    <p>İçerisinde asağıdaki kodların yer aldığı <cf>Anasayfa.php</cf> isimli bir dosya oluşturup <b>Views/Pages/</b> dizini içerisine atın.</p>
    
    <div type="code">Views/Pages/Anasayfa.php<pre><ff><x><</x>html>
<</x>head>
        <</x>title></ff>Anasayfa<ff><</x>/title>
<</x>/head>
<</x>body>
       <</x>h1></ff>Web sitemize hoşgeldiniz.<ff><</x>/h1>
<</x>/body>
<</x>/html></ff></pre></div>
    
    <p class="cstfont">Tasarım Sayfasını Dahil Edin</p>
    <p><strong>Views/Pages/</strong> dizini içerisindeki tasarım sayfasını dahil etmek için <strong class="sitefont">import::page()</strong> <strong>ya da</strong> <strong class="sitefont">import::view()</strong> komutu kullanılır.</p>
    <div type="code">import::page(<sf>"Anasayfa"</sf>);</div>
    <p>Ya da;</p>
    <div type="code">import::view(<sf>"Anasayfa"</sf>);</div>
    <p></p>
    <div type="note"><div>NOT</div><div>Dahil edeceğiniz sayfa <strong>.php</strong> uzantılı dosya ise <strong>.php</strong> uzantısını kullanmaya gerek yoktur.</div></div>
    
    <p><strong>Views/Pages/</strong> dizininde yer alan tasarım sayfasının, <strong>Controllers/</strong> dizinindeki yönetim sayfasının içerisine nasıl dahil edileceğini gösterelim.</p>
    <div type="code">
<pre><x><</x>?php
<kf>class</kf> Anasayfa
{
	<kf>public</kf> <ff>function</ff> index()
        {
            import::page(<sf>'Anasayfa'</sf>);
        }
}</pre>   
    </div>
    <p>Adres çubuğuna <cf>ornek.com/index.php/anasayfa/index</cf> URL adresini girdiğimizde <cf>Views/Pages/Anasayfa.php</cf> tasarım sayfasının görüntülendiğini görebiliriz.</p>
    <div type="note"><div>NOT</div><div>İsterseniz aynı anda birden fazla tasarım sayfası da dahil edebilirsiniz.</div></div>
    
    <p class="cstfont">Dahil Edilen Tasarım Sayfasına Veri Göndermek</p>
    <p>Oluşturduğunuz tasarım sayfası içerisinde dinamik olarak değişen veriler kullanmak istiyorsanız yönetim sayfasından veri gönderebilirsiniz. Aşağıda nasıl yapılacağını gösteren örnek bir kod yer almaktadır.</p>
    
        <div type="code">
<pre>Controllers/Anasayfa.php

<x><</x>?php
<kf>class</kf> Anasayfa
{
	<kf>public</kf> <ff>function</ff> index()
    {
    	<vf>$veriler</vf>[<sf>'baslik'</sf>] = <sf>'Web Sayfamıza Hoş Geldiniz'</sf>; 
        <vf>$veriler</vf>[<sf>'icerik'</sf>] = import::page(<sf>'anasayfa_icerik'</sf>,<sf>''</sf>,<kf>true</kf>); <comment>// Bir sayfanın içeriğinide değişkene aktarabilirsiniz.</comment>
    	import::page(<sf>'Anasayfa'</sf>, <vf>$veriler</vf>);
    }
}</pre>   
    </div>
    <p></p>
      <div type="code"><pre>
Views/Pages/Anasayfa.php

<ff><x><</x>html>
<</x>head>
        <</x>title></ff><x><</x>?php <kf>echo</kf> <vf>$baslik</vf>; ?<x>></x><ff><</x>/title>
<</x>/head>
<</x>body>
       </ff><x><</x>?php <kf>echo</kf> <vf>$icerik</vf>; ?<x>></x><ff>
<</x>/body>
<</x>/html></ff></pre></div>
    
    <p>Dikkat ettiyseniz <strong>Controllers</strong> yönetim sayfasından dizi olarak gönderilen ifadeler, <strong>Views</strong> tasarım sayfasında değişken olarak kullanılmıştır.</p>
    
    <p class="cstfont">Tasarım Sayfasının İçeriğini Almak</p>
    <p><strong>Views</strong> tasarım sayfasının içeriğini alıp bir değişkene aktarmak isterseniz aşağıdaki gibi bir ifade kullanmanız gerekmektedir.</p>
    
    <div type="code"><vf>$icerigi_al</vf> = import::page(<sf>"Sayfa"</sf>,<sf>""</sf>,<kf>true</kf>);</div>
    <p>Fonksiyonun içerisindeki 3. parametre olan <kf>true</kf> ibaresi, o web sayfasının içeriğini almanızı sağlar.</p>
    
    <div type="prev-next">
    	<div type="prev-btn"><a href="management.html">Önceki</a></div><div type="next-btn"><a href="model.html">Sonraki</a></div>
    </div>
 	
 
</body>
</html>              