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
    <div id="content-document"><a href="#">Döküman</a> » Nesne Erişim Yöntemleri</div> 
    <p class="ctfont">Nesne Erişim(Çağrı) Yöntemleri</p>
    <p>Bu bölümde nesnelere hangi yöntemlerle erişebileceğiniz hakkında kullanımlara yer verilmiştir.</p>
    <p>
    	<ul class="cfont">
        	<li><a href="access_dynamic.html">Dinamik Erişim(Çağrı) ($this->class->func())</a></li>
            <li><a href="access_static.html">Statik Erişim(Çağrı) (class::func())</a></li>
            <li><a href="access_znuse.html">Değişkensel Erişim(Çağrı) (zn::$use->class->func())</a></li>
            <li><a href="access_this.html">Yöntemsel Erişim(Çağrı) (this()->class->func())</a></li>
        </ul>
    </p>
    
    <p>Erişim yöntemlerinin özellikleri ve performans değerleri aşağıda verilmiştir.</p>
    
    <p>
    	<table class="cfont">
        	<tr><th>No</th><th>Erişim(Çağrı) Yöntemleri</th><th>Performans Farkı(Saniye)</th><th>Kullanım Tavsiyesi</th><th>Controller Çağrısı(Extends)</th><th>Kullanılabileceği Yerler</th></tr>
            <tr><td>1</td><td><strong><span class="keyfont">class</span>::<span class="funcfont">func</span>()</strong> (Statik Çağrı )</td><td><span class="green">+0.0000</span></td><td><span class="green">Kesinlikle Önerilir</span></th><td><span class="bgreen">Gerekmez</span></td><td><span class="bgreen">Her Sayfada</span></td></tr>
            <tr><td>2</td><td><strong><span class="varfont">$this</span>-><span class="keyfont">class</span>-><span class="funcfont">func</span>()</strong> (Dynamic Çağrı )</td><td><span class="bgreen">-0.0003</span></td><td><span class="bgreen">Önerilir</span></th><td><span class="bgreen">Aktif sayfada gerekmez.</span></td><td><span class="orange">Sadece sınıflar içerisinde</span></td></tr>
            <tr><td>3</td><td><strong>zn::<span class="varfont">$use</span>-><span class="keyfont">class</span>-><span class="funcfont">func</span>()</strong> (Değişkensel Çağrı )</td><td><span class="orange">-0.0006</span></td><td><span class="orange">Önerilir</span></th><td><span class="bgreen">Gerekmez</span></td><td><span class="bgreen">Her Sayfada</span></td></tr>
            <tr><td>4</td><td><strong>this()-><span class="keyfont">class</span>-><span class="funcfont">func</span>()</strong> (Yöntemsel Çağrı )</td><td><span class="borange">-0.0080</span></td><td><span class="borange">Gerekli Olmadıkça Önerilmez</span></th><td><span class="bgreen">Gerekmez</span></td><td><span class="bgreen">Her Sayfada</span></td></tr>
        </table>
    </p>
    
    <p>Tabloda görüldüğü üzere en verimli çağrı <strong>statik çağrı</strong> yöntemidir.</p>
    
    <div type="prev-next">
    	<div type="prev-btn"><a href="lang.html">Önceki</a></div><div type="next-btn"><a href="access_dynamic.html">Sonraki</a></div>
    </div>
 
</body>
</html>              