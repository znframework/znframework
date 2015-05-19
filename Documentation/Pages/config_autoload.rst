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
    <div id="content-document"><a href="#">Döküman</a> » <a href="config.html">Ayarlar</a> » Autoload(Otomatik Dahil Etme) Ayarları</div> 
    <p class="ctfont">Autoload(Otomatik Dahil Etme) Ayarları</p>
    <p>Kütüphane, araç, dil ve yönetim dosyalarını otomatik olarak dahil etmek için kullanılır. Eğer bu dosyalardan herhangi birini projenizin tamamında kullanmayı düşünüyorsanız otomatik olarak dahil edebilirsiniz. Şayet kullanacağınız kütüphane veya araçlar belli sayfalarda kullanılacak otomatik dahil etmek işlemini önermiyoruz çünkü bu durum siteminizin gereksiz yere şismesine sebep olacaktır.</p> 

    <p><strong>Autoload.php</strong> dosyasında aşağıdaki ayarlar ve örnek kullanımlar yer almaktadır.</p>
    
    <p>
    <div type="code">
<strong>Config/Autoload.php</strong>
<pre>
<comment>/* LIBRARY	*/
// İşlev:Otomatik olarak kütüphane yüklemek için kullanılır
// Parametre:Dahil etmek istediğiniz kütüphaneleri diziye elaman olarak sırayla ekleyin.
// Örnek: array("Database", "Validation");</comment>
<vf>$config</vf>[<sf>'Autoload'</sf>][<sf>'Library'</sf>] 	= <kf>array</kf>(<sf>'OrnekKutuphane1'</sf>, <sf>'OrnekKutuphane2'</sf>, <sf>'OrnekKutuphane3'</sf>);

<comment>/* TOOL	*/
// İşlev:Otomatik olarak araç yüklemek için kullanılır
// Parametre:Dahil etmek istediğiniz araçları diziye elaman olarak sırayla ekleyin.
// Örnek: array("Cleaner", "Rounder");</comment>
<vf>$config</vf>[<sf>'Autoload'</sf>][<sf>'Tool'</sf>] 	= <kf>array</kf>(<sf>'OrnekArac1'</sf>, <sf>'OrnekArac2'</sf>, <sf>'OrnekArac3'</sf>);

<comment>/* CODER	*/
// İşlev:Otomatik olarak kodlayıcı dosyası yüklemek için kullanılır
// Parametre:Dahil etmek istediğiniz kodlayıcı dosyalarını diziye elaman olarak sırayla ekleyin.
// Örnek: array("ControllersPage1", "ControllersPage2");</comment>
<vf>$config</vf>[<sf>'Autoload'</sf>][<sf>'Controllers'</sf>] 	= <kf>array</kf>(<sf>'MysqlKodlari'</sf>, <sf>'AjaxKodlari'</sf>, <sf>'GerekliDosya'</sf>);

<comment>/* LANGUAGE	*/
// İşlev:Otomatik olarak dil dosyası yüklemek için kullanılır
// Parametre:Dahil etmek istediğiniz dil dosyalarını diziye elaman olarak sırayla ekleyin.
// Örnek: array("DilDosyasi1", "DilDosyasi2");</comment>
<vf>$config</vf>[<sf>'Autoload'</sf>][<sf>'Language'</sf>] = <kf>array</kf>(<sf>'DilDosya1'</sf>, <sf>'DilDosya2'</sf>, <sf>'DilDosya3'</sf>);

</pre>
    </div>
    </p>
    
    
  	<p>Bu ayarlara eklemeyi düşündüğünüz yapıların sistemin tümünde geçerli olacağını ve <strong>her sayfadan erişim</strong> sağlanabileceğini unutmayın.</p>
    	
    <div type="prev-next">
    	<div type="prev-btn"><a href="config_library.html">Önceki</a></div><div type="next-btn"><a href="config_cache.html">Sonraki</a></div>
    </div>
 
</body>
</html>              