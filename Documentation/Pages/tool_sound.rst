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
    <div id="content-document"><a href="#">Döküman</a> » <a href="tools.html">Araçlar</a> » Sound(Ses) Aracı</div> 
    <p class="ctfont">Sound(Ses) Aracı</p>
    <p>Ses dosyası eklemek için kullanılır.</p>
    <ul><li><a href="#" class="infont">Sound(Ses) Aracı ve Yöntemleri</a><br><br>
        <ul>
        	<li><a href="#sound_import">Sound Aracını Dahil Etmek</b></a></li>
            <li><a href="#add_sound">Ses Dosyası Ekleme Aracı » <b>add_sound()</b></a></li>
        </ul>
    </li></ul>
    
    
   	<p class="cstfont" id="sound_import">Sound Aracını Dahil Etmek</p>
	<div type="code">import::tool(<sf>'Sound'</sf>)</div>
    
    
    <p class="cstfont" id="add_sound">Ses Dosyası Ekleme Aracı</p>
    <p><ftype>add_sound( <kf>string</kf> <vf>$dosya</vf> , [ <kf>boolean</kf> <vf>$otomatik_baslama</vf> = <kf>true</kf> ] , [ <kf>boolean</kf> <vf>$tekrar = <vf>true</vf> ] )</ftype></p>
    <p>Ses dosyası eklemek için kullanılan araçtır. Desteklediği uzantılar: wma, mp3 ve mid.</p>
    
    <p>
    	<table class="cfont">
        	<tr><th>No</th><th>Parametreler</th><td>Anlamları</td></tr>
            <tr><th>1</th><th>string Ses Dosyasının Yolu</th><td>Eklenecek ses dosyasının yolu.</td></tr>
            <tr><th>2</th><th>[ string/boolean Otomatik Başlama = true ]</th><td>Çağrılan ses dosyasının otomatik olarak başlaması.</td></tr> 
            <tr><th>3</th><th>[ string/boolean Tekrar = true ]</th><td>Müzik bitiminde tekrar başlaması.</td></tr> 
        </table>
    </p>
    
	<div type="code">
    <kf>echo</kf> add_sound(<sf>'ornek.mp3'</sf>);
    </div> 
    
    <div type="prev-next">
    	<div type="prev-btn"><a href="tool_searcher.html">Önceki</a></div><div type="next-btn"><a href="tool_string.html">Sonraki</a></div>
    </div>
 
</body>
</html>              