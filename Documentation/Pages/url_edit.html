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
    <div id="content-document"><a href="#">Döküman</a> » <a href="overview.html">Genel Bakış</a> » URL Düzenleme</div> 
    <p class="ctfont">URL Düzenleme</p>
    <p>URL adresinde bazı düzenlemeler yapmak için <b>Config/Uri.php</b> dosyasından yararlanılır. Bu dosyada aşağıdaki ayarlar mevcuttur.</p>
	<p class="cstfont">Uri Config Ayarları</p>
    <div type="code">
<pre>Config/Uri.php

<vf>$config</vf>[<sf>'Uri'</sf>][<sf>'index.php'</sf>] 		= <kf>true</kf> <comment>// index.php kaldırılsın mı? Alacağı değerler true veya false</comment>;
<vf>$config</vf>[<sf>'Uri'</sf>][<sf>'index_suffix'</sf>]  	= <sf>"?"</sf>; <comment>// Bazı sunuculardan kaynaklanan yönlendirme sorunu gidermek için kullanılır. Alacağı değerler "" veya "?"</comment>;
<vf>$config</vf>[<sf>'Uri'</sf>][<sf>'lang'</sf>] 			= <kf>false</kf>; <comment>// Birden fazla dil seçeni kullanılıyorsa URL'de hangi dilin aktif olduğunun görülmesi için true olarak ayarlanmalıdır.</comment>;
<vf>$config</vf>[<sf>'Uri'</sf>][<sf>'ssl'</sf>] 			= <kf>false</kf>; <comment>// Sitenizde ssl sertifikası kullanılıyor ise bu değerin true olarak ayarlanması gerekir.</comment>;</pre> 
    </div>
    <p>Şimdi bu ayarları tek tek inceleyelim.</p>
    <p class="cstfont">Index.php</p>
    <p>
    	Bu ayarın <kf>true</kf> olması durumunda URL adresleriniz <cf>http://www.siteadi.xxx/<b class="strfont">index.php</b>/[coder-sınıf adı]/[coder-fonksiyon adı]/[parametreler]</cf> şeklinde olur.<br>
        Bu ayarın <kf>false</kf> olması durumunda URL adresleriniz <cf>http://www.siteadi.xxx/[coder-sınıf adı]/[coder-fonksiyon adı]/[parametreler]</cf> şeklinde olur.<br> 
    </p>
    
    <p class="cstfont">Htaccess Dosyasını Otomatik Olarak Oluşturmak</p>
    <p>
    <cf>index.php = <kf>false</kf></cf> değeri ayarlandıktan sonra <strong>Config/Htaccess.php</strong> dosyasındaki create_file ayarı <cf>create_file = <kf>true</kf></cf> olarak düzenlenmelidir. Bu değişiklikten sonra sistem otomatik olarak <cf>.htaccess</cf> dosyası oluşturacaktır.
    </p>
     <p>
    Eğer localhostta çalışıyorsanız htaccess yönlendirmenin aktif hale getirilebilmesi için farklı olarak bir kaç ayar daha yapmanız gerekir. Bunlar şu ayarlardır. Wamp veya diğer PHP serverlerde bulunan <b>httpd.conf</b> konfigürasyon dosyasındaki <cf>#LoadModule rewrite_module modules/mod_rewrite.so</cf> satırındaki <cf>'#'</cf> işaretini kaldırarak apache server servislerinin yeniden başlatılması gerekir. Bu değişiklikten sonra htaccess yönlendirmesi kullanılabilir hale gelecektir.
    </p>
    <p>Şayet sunucu üzerinde çalışıyorsanız böyle bir ayar yapmanıza gerek yoktur.</p>
    <p><b>Uyarı:500 Internal Server Error</b> veya sayfa bulunamıyor gibi bir hata alırsanız <strong>adres çubuğu üzerinden sitenin url adresini bir kaç kez yeniden çağırmayı deneyiniz.</strong> Ayarlar doğru bir şekilde yapılmışsa sayfa yönlendirmesi sağlanacaktır. Hatanın devam etmesi durumunda değişikliklerinizi kontrol ediniz.</p>
    
    <p class="cstfont">Index_suffix Yönlendirme Ayarı</p>
    <p>Bazı sunucular güvenlik yada başka sebeplerle, .htaccess erişim dosyasında yönlendirme için yazılmış olan <strong>index.php</strong> ibaresinden sonra <strong class="strfont">?</strong> karakterini kullanmanızı isteyebilir. Yönlendirmede bir sorun yaşarsanız <cf><vf>$config</vf>[<sf>'Uri'</sf>][<sf>'index_suffix'</sf>]  	= <sf>""</sf>;</cf> ayarını <cf><vf>$config</vf>[<sf>'Uri'</sf>][<sf>'index_suffix'</sf>] = <sf>"?"</sf>;</cf> şeklinde düzenleyiniz.</p>
    <p>Bu değişiklikten sonra <strong>.httacess erişim dosyası</strong>nın içeriği aşağıdaki gibi olacaktır. </p>
    <div type="code">
<pre><x><</x>IfModule mod_rewrite.c>
RewriteEngine On
RewriteBase /
RewriteCond %{REQUEST_FILENAME} !-f
RewriteCond %{REQUEST_FILENAME} !-d
RewriteRule ^(.*)$  /index.php<b class="strfont">?</b>/$1 [L]
<x><</x>/IfModule></pre>
    </div>
    <p>Dikkat edilirse <strong>index.php</strong> ibaresinden sonra <strong class="strfont">?</strong> karakteri ilave edilmiştir.</p>
    <p class="cstfont">Lang Dil Ayarı</p>
    <p>Sitenizde birden fazla dil seçeniği kullanıyorsanız ve dil seçeneğinin URL adresinde görülmesini istiyorsanız bu ayarın <cf>lang = <kf>true</kf></cf> olarak ayarlanması gerekir.</p>
    <p>Eğer bu ayarı <strong>true</strong> olarak ayarlamışsanız URL adresiniz, <cf>http://www.siteadi.xxx/<b class="strfont">[dil seçeneği = tr,en,fr]</b>/[coder-sınıf adı]/[coder-fonksiyon adı]/[parametreler]</cf> şeklinde görünecektir.</p>
    
    <p class="cstfont">SSL Sertifikası Ayarı</p>
    <p>Sitenizde ssl sertifikası kullanılıyor ise bu ayarın <cf>ssl = <kf>true</kf></cf> olarak ayarlanması gerekir.</p>
    <p>Eğer bu ayarı <strong>true</strong> olarak ayarlamışsanız URL adresiniz, <cf>http<b class="strfont">s</b>://www.siteadi.xxx/[coder-sınıf adı]/[coder-fonksiyon adı]/[parametreler]</cf> şeklinde görünecektir.</p>
    
    <div type="prev-next">
    	<div type="prev-btn"><a href="basic_app.html">Önceki</a></div><div type="next-btn"><a href="import_library.html">Sonraki</a></div>
    </div>
</body>
</html>              