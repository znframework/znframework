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
    <div id="content-document"><a href="#">Döküman</a> » <a href="tools.html">Araçlar</a> » Email(E-posta) Aracı</div> 
    <p class="ctfont"> Email(E-posta) Aracı</p>
    <p>E-posta göndermeye yönelik bir kaç aracı içerir.</p>
    <ul><li><a href="#" class="infont"> Email(E-posta) Aracı ve Yöntemleri</a><br><br>
        <ul>
        	<li><a href="#email_import">Email Aracını Dahil Etmek</b></a></li>
            <li><a href="#email">E-posta Gönderme Aracı » <b>send_email()</b></a></li> 
            <li><a href="#imap_email">Imap E-posta Gönderme Aracı » <b>send_imap_email()</b></a></li>
        </ul>
    </li></ul>
    
    
   	<p class="cstfont" id="email_import">Email Aracını Dahil Etmek</p>
	<div type="code">import::tool(<sf>'Email'</sf>)</div>
    
    
    <p class="cstfont" id="email">E-posta Gönderme Aracı</p>
    <p><ftype>send_email( <kf>string</kf> <vf>$kime</vf> ,  <kf>string</kf> <vf>$konu</vf> , <kf>string</kf> <vf>$mesaj</vf> , [ <kf>string</kf> <vf>$baslik_bilgileri</vf> ] )</ftype></p>
    <p>E-posta göndermek için kullanılan araçtır.</p>
    
	<div type="code">
    send_email(<sf>'bilgi@zntr.net'</sf>, <sf>'Örnek'</sf>, <sf>'Deneme Mesajı'</sf>);
    </div>
    
    
     <p class="cstfont" id="imap_email">Imap E-posta Gönderme Aracı</p>
    <p><ftype>send_imap_email( <kf>string</kf> <vf>$kime</vf> ,  <kf>string</kf> <vf>$konu</vf> , <kf>string</kf> <vf>$mesaj</vf> , [ <kf>string</kf> <vf>$baslik_bilgileri</vf> ] )</ftype></p>
    <p>E-posta göndermek için kullanılan araçtır.</p>
    
	<div type="code">
    send_imap_email(<sf>'bilgi@zntr.net'</sf>, <sf>'Örnek'</sf>, <sf>'Deneme Mesajı'</sf>);
    </div>
    
    <div type="prev-next">
    	<div type="prev-btn"><a href="tool_datetime.html">Önceki</a></div><div type="next-btn"><a href="tool_encoder.html">Sonraki</a></div>
    </div>
 
</body>
</html>              