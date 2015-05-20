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
    <div id="content-document"><a href="#">Döküman</a> » <a href="access_methods.html">Nesne Erişim Yöntemleri</a> » Dinamik Erişim</div> 
    <p class="ctfont">Dinamik Erişim</p>
 	<p>Bu yöntem, <vf><b>$this</b></vf> anahtar ifadesi ile nesnelere doğrudan erişimi sağlamak içindir. Bununla ilgili aşağıda kullanım örnekleri yer almaktadır.</p>
   
  	<p>Dinamik çağrı, <strong>performans açısından statik çağrıdan biraz daha yavaştır.</strong></p>
    
    <div type="code">
Controllers/Anasayfa.php
<pre><x><</x>?php
<kf>class</kf> Anasayfa
{
	<kf>public</kf> <ff>function</ff> index()
        {
            <vf>$this</vf>->import->page(<sf>'Anasayfa'</sf>);
        }
}</pre>   
    </div>
 	
    <p>Herhangi bir yapıyı extends etmeye gerek kalmadan nesnelere doğrudan erişim sağlamak mümkün.</p>
    <p>
     <div type="code">
<pre><vf>$this</vf>->import->library(<sf>'Session'</sf>);

<vf>$this</vf>->sess->insert(<sf>'kullanici'</sf>, <sf>'zntr'</sf>);

<kf>echo</kf> <vf>$this</vf>->sess->select(<sf>'kullanici'</sf>); <comment>// Çıktı: zntr</comment></pre>   
    </div>
    </p>
    
    <p class="ctfont">Controller Kullanımı Gerektiren İstisnai Durumlar</p>
    
    <p>İstisnai durumlarda <strong>Controller</strong> yapısının extends edilmesi gerekmektedir.</p>
   	
   	<p>Şayet <strong>Controllers</strong> dosyası içerisinde <cf>__construct()</cf> sihirli yöntemi kullanılmışsa bu yöntem içerisinde <vf>$this</vf> ifadesi kullanılamaz ancak <strong>Controller</strong> sınıfını dahil ederek kullanabilir. Ya da <cf>__construct()</cf> sihirli yöntemi içerisinde dinamik çağrı yerine statik çağrı kullanıp <strong>Controller</strong> sınıfını extends etmenize gerek kalmaz.</p>
    
    <p> Aşağıda <strong>extends</strong> durumu gerektiren kullanıma yer verilmiştir.</p>
   	<p>
   <div type="code">
Controllers/Anasayfa.php
<pre><x><</x>?php
<kf>class</kf> Anasayfa <kf>extends</kf> <strong>Controller</strong>
{
	<ff>function</ff> __construct()
        {
            <kf>parent</kf>::__construct();
            <vf>$this</vf>->import->library(<sf>'Db'</sf>);
        }
}</pre>   
    </div>
    </p>
    
    <p>Ya da <strong>Controller</strong> sınıfını dahil etmek istemiyorsanız <cf>__construct()</cf> sihirli yöntemi içerisinde diğer çağrı yöntemlerini kullanabilirsiniz.</p>
   	
    <p>
   <div type="code">
Controllers/Anasayfa.php
<pre><x><</x>?php
<kf>class</kf> Anasayfa
{
	<ff>function</ff> __construct()
        {
            import::library(<sf>'Db'</sf>); <comment>// Kesinlikle Önerilir.</comment>
        }
}</pre>   
    </div>
    </p>
	
     <p>
   <div type="code">
Controllers/Anasayfa.php
<pre><x><</x>?php
<kf>class</kf> Anasayfa
{
	<ff>function</ff> __construct()
        {
            zn::<vf>$use</vf>->import->library(<sf>'Db'</sf>); <comment>// Önerilir.</comment>
        }
}</pre>   
    </div>
    </p>
    
    <p>
   <div type="code">
Controllers/Anasayfa.php
<pre><x><</x>?php
<kf>class</kf> Anasayfa
{
	<ff>function</ff> __construct()
        {
            this()->import->library(<sf>'Db'</sf>); <comment>// Gerekli Olmadıkça Önerilmez.</comment>
        }
}</pre>   
    </div>
    </p>
    
    <p><div type="important"><div>ÖNEMLİ</div><div><strong>Controller</strong> sınıfı, sadece aktif olarak çalışılan sayfada <strong>extends</strong> gerektirmez.</div></div></p>
    
    <div type="prev-next">
    	<div type="prev-btn"><a href="access_methods.html">Önceki</a></div><div type="next-btn"><a href="access_static.html">Sonraki</a></div>
    </div>
 	
 
</body>
</html>              