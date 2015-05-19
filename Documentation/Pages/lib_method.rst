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
    <div id="content-document"><a href="#">Döküman</a> » <a href="libraries.html">Kütüphaneler</a> » Method Sınıfı</div> 
    <p class="ctfont">Method Sınıfı</p>
    <p>Post, get, request veya files verileri kullanmak için oluşturulmuş sınıftır.</p>
    <ul><li><a href="#" class="infont">Method Sınıfı ve Yöntemleri</a><br><br>
        <ul>    
        	<li><a href="#method_import">Method Kütüphanesini Dahil Etmek</a></li>
            <li><a href="#method_post">POST Verilerini Verileri Kullanmak » <b>method::post()</b></a></li>
            <li><a href="#method_get">GET Verilerini Kullanmak » <b>method::files()</b></a></li>
            <li><a href="#method_request">REQUEST Verilerini Kullanmak » <b>method::request()</b></a></li>
            <li><a href="#method_files">FILES Verilerini Kullanmak » <b>method::files()</b></a></li>
        </ul>
    </li></ul>
    
    <p class="cstfont" id="method_import">Method Kütüphanesini Dahil Etmek</p>
    <div type="code">
  	import::library(<sf>'Method'</sf>);
    </div>
    
   	<p class="cstfont" id="method_post">POST Verilerini Kullanmak</p>
    <p><ftype>method::post( <kf>string</kf> <vf>$veri</vf> , [ <kf>string</kf> <vf>$deger</vf> ] )</ftype></p>
    <p>POST Yöntemiyle gelen verileri almak için kullanılır. 2 parametresi vardır. Veri, Değer.</p>
 
    <p>
    	<table class="cfont">
        	<tr><th>Parametre</th><td>Anlamları</td></tr>
            <tr><th>1. Parametre = Veri</th><td>Gelen verinin adı.</td></tr>
            <tr><th>2. Parametre = [Değer]</th><td>Veriye değer atamak için kullanılır.</td></tr>
        </table>
    </p>
	<p>
 
    	<div type="code">
<pre>
<x><</x>?php
<kf>class</kf> MethodUygulamasi
{
<ff>function</ff> index()
    {
        import::library(<sf>'Method'</sf>);
        
       <strong> method::post</strong>(<sf>'nesne'</sf>, <sf>'Nesnenin Değeri'</sf>);
	<kf>echo</kf> method::post(<sf>'nesne'</sf>);
        <comment>/* 
        $_POST['nesne'] = 'Nesnenin Değeri'; => Çıktı: Nesnenin Değeri
        */</comment>
    }
}
</pre>
    	</div>
    </p>

    
    <p class="cstfont" id="method_get">GET Verilerini Kullanmak</p>
    <p><ftype>method::get( <kf>string</kf> <vf>$veri</vf> , [ <kf>string</kf> <vf>$deger</vf> ] )</ftype></p>
    <p>GET Yöntemiyle gelen verileri almak için kullanılır. 2 parametresi vardır. Veri, Değer.</p>
 
    <p>
    	<table class="cfont">
        	<tr><th>Parametre</th><td>Anlamları</td></tr>
            <tr><th>1. Parametre = Veri</th><td>Gelen verinin adı.</td></tr>
            <tr><th>2. Parametre = [Değer]</th><td>Veriye değer atamak için kullanılır.</td></tr>
        </table>
    </p>
	<p>
 
    	<div type="code">
<pre>
method::get(<sf>'nesne'</sf>, <sf>'Nesnenin Değeri'</sf>);
<kf>echo</kf> <strong>method::get</strong>(<sf>'nesne'</sf>);
<comment>/* 
$_GET['nesne'] = 'Nesnenin Değeri'; => Çıktı: Nesnenin Değeri
*/</comment>
</pre>
    	</div>
    </p>
    
    
    <p class="cstfont" id="method_request">REQUEST Verilerini Kullanmak</p>
    <p><ftype>method::request( <kf>string</kf> <vf>$veri</vf> , [ <kf>string</kf> <vf>$deger</vf> ] )</ftype></p>
    <p>REQUEST Yöntemiyle gelen verileri almak için kullanılır. 2 parametresi vardır. Veri, Değer.</p>
 
    <p>
    	<table class="cfont">
        	<tr><th>Parametre</th><td>Anlamları</td></tr>
            <tr><th>1. Parametre = Veri</th><td>Gelen verinin adı.</td></tr>
            <tr><th>2. Parametre = [Değer]</th><td>Veriye değer atamak için kullanılır.</td></tr>
        </table>
    </p>
	<p>
 
    	<div type="code">
<pre>
method::request(<sf>'nesne'</sf>, <sf>'Nesnenin Değeri'</sf>);
<kf>echo</kf> <strong>method::request</strong>(<sf>'nesne'</sf>);
<comment>/* 
$_REQUEST['nesne'] = 'Nesnenin Değeri'; => Çıktı: Nesnenin Değeri
*/</comment>
</pre>
    	</div>
    </p>
    
    
    <p class="cstfont" id="method_files">FILES Verilerini Kullanmak</p>
    <p><ftype>method::files( <kf>string</kf> <vf>$input_file_nesne_ismi</vf> , [ <kf>string</kf> <vf>$tur</vf> = <sf>'name'</sf> ] )</ftype></p>
    <p>REQUEST Yöntemiyle gelen verileri almak için kullanılır. 2 parametresi vardır. Veri, Değer.</p>
 
    <p>
    	<table class="cfont">
        	<tr><th>Parametre</th><td>Anlamları</td></tr>
            <tr><th>1. Parametre = Input File Nesnesinin Adı</th><td>File nesnesinin adı.</td></tr>
            <tr><th>2. Parametre = [Tür = name]</th><td>Verinin hangi türde bilgisinin alınacağı.</td></tr>
        </table>
    </p>
	<p>
 
    	<div type="code">
<pre>
<kf>echo</kf> <strong>method::files</strong>(<sf>'file_name'</sf>);
<comment>/* 
$_FILES['file_name']['name']; => Çıktı: ornek.jpg
*/</comment>
</pre>
    	</div>
    </p>

    
   
    <div type="prev-next">
    	<div type="prev-btn"><a href="lib_json.html">Önceki</a></div><div type="next-btn"><a href="lib_pagination.html">Sonraki</a></div>
    </div>
 
</body>
</html>              