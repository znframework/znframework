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
    <div id="content-document"><a href="#">Döküman</a> » <a href="tools.html">Araçlar</a> » Ajax Aracı</div> 
    <p class="ctfont">Ajax Aracı</p>
    <p>Bu araç, ajax yöntemi ile başka sayfaya gönderilen veriler sonucunda oluşan yeni verilerin, geri gönderilmesini sağlayan bir kaç yöntem içerir .</p>
    <ul><li><a href="#" class="infont">Ajax Aracı ve Yöntemleri</a><br><br>
        <ul>
        	<li><a href="#ajax_import">Ajax Aracını Dahil Etmek</b></a></li>
            <li><a href="#ajax_json_send_back">JSON Tipinde Veri Döndürmek » <b>json_send_back()</b></a></li>
            <li><a href="#ajax_send_back">Standart Veri Döndürmek » <b>send_back()</b></a></li>           
        </ul>
    </li></ul>
    
    <p class="cstfont" id="ajax_import">Ajax Aracını Dahil Etmek</p>
	<div type="code">import::tool(<sf>'Ajax'</sf>)</div> 	
    
    <p class="cstfont" id="ajax_json_send_back">JSON Tipinde Veri Döndürmek</p>
    <p><ftype>json_send_back( <kf>array</kf> <vf>$veri</vf> )</ftype></p>
    <p>Ajax ile veri gönderdiğimiz sayfada, bir takım işlemler sonrasında oluşan yeni verilerin geriye döndürülmesi istenir. Eğer bu veriler JSON tipinde döndürülmek istenirse bu kod kullanılır. Aşağıda örnek bir uygulama yer almaktadır.</p>
    
    <p><b>Controllers/Ajax/Ajax_islemleri.php</b> dosyamızı aşağıdaki şekilde düzenliyoruz.</p>
    
    <div type="code">
	<pre>
<vf>$veriler</vf> = method::post(<sf>'deger'</sf>);

<kf>if</kf>(<vf>$veriler</vf>[<sf>'deger'</sf>] == 1)
    <vf>$donen_veriler</vf>[<sf>'sonuc'</sf>] = <sf>'İşlem Başarılı.'</sf>;
<kf>else</kf>
    <vf>$donen_veriler</vf>[<sf>'sonuc'</sf>] = <sf>'İşlem Başarısız!'</sf>;
    
<strong>json_send_back</strong>(<vf>$donen_veriler</vf>);
	</pre>
    </div>
    <p></p>
    <div type="important"><div>ÖNEMLİ</div><div>JSON Tipinde veri döndürmek için Ajax yöntemi kullanılırken <b>dataType</b> parametresi, <b>"json"</b> olarak ayarlanmalıdır.</div></div>
    
    <p class="cstfont" id="ajax_send_back">Standart Veri Döndürmek</p>
    <p><ftype>send_back( <kf>string</kf> <vf>$veri</vf> )</ftype></p>
    <p>Bu yöntemin yaptığı işlem, herhangi bir çıktı üretip kullanıldığı satır itibari ile kod akışı kesilir. Aslında bu yöntemin görevi, <kf>echo</kf> ve <kf>exit</kf> yöntemlerinin yaptığı işin aynı anda yapılmasını sağlamaktır.</p>
    <p>Yukarıdaki <b>Controllers/Ajax/Ajax_islemleri.php</b> dosyayı baz alırsak aşağıdaki gibi bir kullanım söz konusudur.</p>
    <pre>  
<vf>$veriler</vf> = method::post(<sf>'deger'</sf>);

<kf>if</kf>(<vf>$veriler</vf>[<sf>'deger'</sf>] == 1)
    <strong>send_back</strong>(<sf>'İşlem Başarılı.'</sf>);
<kf>else</kf>
    <strong>send_back</strong>(<sf>'İşlem Başarısız!'</sf>);          
	</pre>
    </div>
    
    <div type="prev-next">
    	<div type="prev-btn"><a href="tools.html">Önceki</a></div><div type="next-btn"><a href="tool_array.html">Sonraki</a></div>
    </div>
 
</body>
</html>              