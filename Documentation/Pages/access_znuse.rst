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
    <div id="content-document"><a href="#">Döküman</a> » <a href="access_methods.html">Nesne Erişim Yöntemleri</a> » Değişkensel Erişim</div> 
    <p class="ctfont">Değişkensel Erişim</p>
 	<p>Değişkensel erişim, sınıflar sitatik veya dinamik olarak tanımlanması farketmeksizin erişim sağlayabilen çağrı yöntemidir.</p>
    <p>Değişkensel çağrı, <strong>performans açısından <strong>statik ve dinamik </strong> çağrılardan biraz daha yavaş bir</strong> çağrıdır. Ancak bu yavaşlık önemsenmeyecek derecede azdır.</p>
  
    <div type="code">
Controllers/Anasayfa.php
<pre><x><</x>?php
<kf>class</kf> Anasayfa
{
	<ff>function</ff> index()
        {
            zn::<vf>$use</vf>->import->page(<sf>'Anasayfa'</sf>);
        }
}</pre>   
    </div>
 	
    <p>Böyle bir kullanım için herhangi bir yapıyı extends etmeye gerek yoktur.</p>
    <p>
     <div type="code">
<pre>zn::<vf>$use</vf>->import->library(<sf>'Session'</sf>);

zn::<vf>$use</vf>->sess->insert(<sf>'kullanici'</sf>, <sf>'zntr'</sf>);

<kf>echo</kf> zn::<vf>$use</vf>->sess->select(<sf>'kullanici'</sf>);</pre>   
    </div>
    </p>
    
    <p>Değişkensel çağrı, herhangi bir yapının extend'ine gerek kalmadan her sayfadan erişim imkanı sağlar.</p>
   
    <div type="prev-next">
    	<div type="prev-btn"><a href="access_static.html">Önceki</a></div><div type="next-btn"><a href="access_this.html">Sonraki</a></div>
    </div>
 	
 
</body>
</html>              