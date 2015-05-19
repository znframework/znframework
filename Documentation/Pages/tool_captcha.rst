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
    <div id="content-document"><a href="#">Döküman</a> » <a href="tools.html">Araçlar</a> » Captcha(Güvenlik Kodu) Aracı</div> 
    <p class="ctfont">Captcha(Güvenlik Kodu) Aracı</p>
    <p>Güvenlik kodu uygulaması yapmak için kullanılır.</p>
    <ul><li><a href="#" class="infont">Captcha(Güvenlik Kodu) Aracı ve Yöntemleri</a><br><br>
        <ul>
        	<li><a href="#captcha_import">Captcha Aracını Dahil Etmek</b></a></li>
            <li><a href="#create_captcha">Güvenlik Kodu Oluşturmak » <b>create_captcha()</b></a></li>
            <li><a href="#get_captcha_code">Güvenlik Kodunu Öğrenmek » <b>get_captcha_code()</b></a></li> 
        </ul>
    </li></ul>
    
    
   	<p class="cstfont" id="captcha_import">Captcha Aracını Dahil Etmek</p>
	<div type="code">import::tool(<sf>'Captcha'</sf>)</div>
    
    
    <p class="cstfont" id="create_captcha">Güvenlik Kodu Oluşturmak</p>
    <p><ftype>create_captcha( [ <kf>boolean</kf> <vf>$img_etiketi</vf> = <kf>false</kf> ] )</ftype></p>
    <p>Xml belgesi oluşturmak için kullanılır.</p>
    
    <p>
    	<table class="cfont">
        	<tr><th>No</th><th>Parametreler</th><td>Anlamları</td></tr>
            <tr><th>1</th><th>[ boolean Img Etiketi Kullanılsın Mı? ]</th><td>Çıktının img etiketi içerisinde kullanılacak şekilde bilgisi mi yoksa doğrudan img etiketi ile birlikte mi getirilsin.</td></tr>
        </table>
    </p>
    
	<div type="code">
	<pre>
<kf>echo</kf> create_captcha(<kf>true</kf>); <comment>/* Doğrudan güvenlik kodu resmi görüntülenecektir.*/</comment>

<vf>$kod</vf> = create_captcha(); <comment>/* Güvenlik kodu bir değişkene aktarılacaktır.*/</comment>
<kf>echo</kf> <sf>'<x><</x>img src="'.<vf>$kod</vf>.'" />'</sf>; <comment>/* Bu kullanımın amacı resim bilgisinin bazı durumlarda diğer nesnelerden önce tanımlanmasının gerekmesidir. */</comment>
	</pre>
    </div>
    
        
    <p class="cstfont" id="get_captcha_code">Güvenlik Kodunu Öğrenmek</p>
    <p><ftype>get_captcha_code()</ftype></p>
    <p>Oluşturulan güvenlik kodunu öğrenmek için kullanılır.</p>
  
  	<div type="code">
	<pre>
<vf>$kod</vf> = create_captcha();
<kf>echo</kf> <sf>'<x><</x>img src="'.<vf>$kod</vf>.'" />'</sf>;
<kf>echo</kf> get_captcha_code(); <comment>// Çıktı: 1A4D31 </comment>

	</pre>
    </div>
    
    <div type="prev-next">
    	<div type="prev-btn"><a href="tool_builder.html">Önceki</a></div><div type="next-btn"><a href="tool_cleaner.html">Sonraki</a></div>
    </div>
 
</body>
</html>              