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
    <div id="content-document"><a href="#">Döküman</a> » <a href="access_methods.html">Nesne Erişim Yöntemleri</a> » Statik Erişim</div> 
    <p class="ctfont">Statik Erişim</p>
 	<p>Sınıflar ve import yöntemleri statik formda oluşturulduktan dolayı nesnelere statik olarak erişilebilmektedir.</p>
    <p>Statik çağrı, <strong>performans açısından en verilimli</strong> çağrıdır.</p>
  
    <div type="code">
Controllers/Anasayfa.php
<pre><x><</x>?php
<kf>class</kf> Anasayfa
{
	<ff>function</ff> index()
        {
            import::page(<sf>'Anasayfa'</sf>);
        }
}</pre>   
    </div>
 	
    <p>Böyle bir kullanım için herhangi bir yapıyı extends etmeye gerek yoktur.</p>
    <p>
     <div type="code">
<pre>import::library(<sf>'Session'</sf>);

sess::insert(<sf>'kullanici'</sf>, <sf>'zntr'</sf>);

<kf>echo</kf> sess::select(<sf>'kullanici'</sf>);</pre>   
    </div>
    </p>
    
    <p>Statik formda tanımlanan her kütüphaneye statik olarak erişilebilmektedir.</p>
   
    <div type="prev-next">
    	<div type="prev-btn"><a href="access_dynamic.html">Önceki</a></div><div type="next-btn"><a href="access_znuse.html">Sonraki</a></div>
    </div>
 	
 
</body>
</html>              