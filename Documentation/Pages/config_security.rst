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
    <div id="content-document"><a href="#">Döküman</a> » <a href="config.html">Ayarlar</a> » Security(Güvenlik) Ayarları</div> 
    <p class="ctfont">Security(Güvenlik) Ayarları</p>
    <p>Sistem güvenlik açıklarını gidermeye yönelik bir kaç ayardan oluşan ayar dosyasıdır.</p>
 
	<p>
   	<div type="code">
<strong>Config/Security.php</strong>
<pre>
<comment>// Security sınıfında kullanılan nc_encode() yönteminin temizlemesi istenilen kelimeler.
// Temizlenen kelimelerin yerini alacak yeni kelime.</comment>
<vf>$config</vf>[<sf>'Security'</sf>][<sf>'nc_encode'</sf>] = <kf>array</kf> 
(
	<sf>'bad_chars'</sf> => <kf>array</kf> <comment>// string veya array veri tipi içerebilir.</comment>
        (
        	<sf>'<x><</x>script>'</sf>, 
            	<sf>'<x><</x>/script>'</sf>, 
            	<sf>'<x><</x>?'</sf>, 
        	<sf>'<x><</x>?php'</sf>, 
                <sf>'?>'</sf>, 
                <sf>'<x><</x>%'</sf>, 
                <sf>'%>'</sf>, 
                <sf>'<x><</x>script'</sf>, 
                <sf>'<x><</x>/script'</sf>
        ), 
        
	<sf>'change_bad_chars'</sf> => <sf>'[badchars]'</sf> <comment>// string veya array veri tipi olmalıdır.</comment>
);

<comment>// URL saldırılarına karşı tehlike arz edeceğini düşündüğünüz ve değiştirilmesini istediğiniz kelimeler veya imgeler.
// Anahtar ifade olarak değişmesini istediğiniz karakterler, değer olarak değişecek karakterlerin yerini alacak yeni karakterler.
// NOT: Küçük-Büyük harf duyarlılığı yoktur. 
// Değişmesini istediğiniz karaketer özel karakter ise özel karaketerin başına \ karakteri koymanız gereklidir. Örnek \.
// Değiştirme işlemi için preg_replace() yöntemi kullanıldığı için özel karakterlerin başına \ karaketeri getirmelisiniz.
// Sınırlayıcı karakterler olan / / karakterleri kullanmanıza gerek yoktur. Örnek: Yanlış kullanım: /ab\./, doğru kullanım: ab\.</comment>
<vf>$config</vf>[<sf>'Security'</sf>][<sf>'url_change_chars'</sf>] = <kf>array</kf> 
(
	<sf>'\s+or\s+'</sf> 	=> <sf>' '</sf>,
        <sf>'\''</sf> 		=> <sf>'`'</sf>,
        <sf>'\"'</sf> 		=> <sf>'``'</sf>
        <comment>.</comment>
        <comment>.</comment>
        <comment>.</comment>
);  </pre>
   	</div>
  	</p>

    <div type="prev-next">
    	<div type="prev-btn"><a href="config_route.html">Önceki</a></div><div type="next-btn"><a href="config_session.html">Sonraki</a></div>
    </div>
 
</body>
</html>              