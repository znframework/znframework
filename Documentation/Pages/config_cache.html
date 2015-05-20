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
    <div id="content-document"><a href="#">Döküman</a> » <a href="config.html">Ayarlar</a> » Cache(Ön Bellekleme) Ayarları</div> 
    <p class="ctfont">Cache(Ön Bellekleme) Ayarları</p>
    <p>Sistemin daha hızlı çalışması için resim, yazi gibi dosyaların ön belleklenmesini sağlayan sistemdir. Sistemin temel amacı aynı dosyaların tekrar tekrar yüklenmesine engel olup sayfaların hızlı açılmasını sağlamaktır. ZN kod çatısı ön bellekleme adına bir kaç yöntem içermektedir. Bunlar gzip ön bellekleme, tarayıcı ön bellekleme ve header ön belleklemedir. Ön bellekleme .htaccess dosyası üzerinden gerçekleştiği için ön belleklemeyi kullanabilmek için <strong>Config/Htaccess.php</strong> dosyasından <cf>create_file</cf> ayarının <cf>true</cf> olarak ayarlanması gerekmektedir yani .htaccess dosyasının otomatik olarak oluşturulması gerekiyor. Bu ayar yapıldıktan sonra ön bellekleme ayarları kullanılabilir hale gelmiş olacaktır.</p> 
    
    <p><strong>Cache.php</strong> dosyasında aşağıdaki ön tanımlı ayarlar yer almaktadır.</p>
    
    <p>
    <div type="code">
<strong>Config/Cache.php</strong>
<pre>
<comment>/* MOD OB_GZHANDLER	*/
// İşlev:ob_start('ob_gzhandler') yöntemini açmak için kullanılır
// Parametre:Gzip modu açık(true), gzip modu kapalı(false)
// Örnek: true/false</comment>
<vf>$config</vf>[<sf>'Cache'</sf>][<sf>'ob_gzhandler'<sf>] = <kf>false</kf>;

<comment>/* MOD GZIP	*/
// İşlev:Gzip önbelleklemeyi açmak için kullanılır
// Parametre:Gzip modu açık(true), gzip modu kapalı(false)
// Örnek: true/false</comment>
<vf>$config</vf>[<sf>'Cache'</sf>][<sf>'mod_gzip'</sf>] = <kf>false</kf>;

<comment>/* MOD GZIP ITEM INCLUDE FILE */
// İşlev:Gzip önbelleklemeye alınacak dosya türleri belirlemek için kullanılır.
// Parametre:Önbelleklemeye alınacak dosya türleri "|" işareti ile ayrılacak şekilde yazılır. 
// Örnek: 'html?|txt|css|js|php|pl'</comment>
<vf>$config</vf>[<sf>'Cache'</sf>][<sf>'mod_gzip_item_include_file'</sf>] = <sf>'html?|txt|css|js|php|pl'</sf>;

<comment>/* MOD EXPIRES */
// İşlev:Tarayıcı ön belleklemeyi açmak için kullanılır.
// Parametre:Tarayıcı ön bellekleme modu açık(true), gzip modu kapalı(false)
// Örnek: true/false</comment>
<vf>$config</vf>[<sf>'Cache'</sf>][<sf>'mod_expires'</sf>] = <kf>false</kf>;

<comment>/* MOD EXPIRES */
// İşlev:Tarayıcı ön belleklemenin varsayılan zamanını saniye cinsinden belirlemek için kullanılır.
// Parametre:Tarayıcı önbelleklemenin zamanı belirlemek için saniye cinsinden bir sayı girilir.
// Örnek: 1</comment>
<vf>$config</vf>[<sf>'Cache'</sf>][<sf>'expires_default_time'</sf>] = <sf>1</sf>;

<comment>/* EXPIRES BY TYPE */
// İşlev:Tarayıcı ön belleklemeye alınacak dosya türleri ve süreleri saniye cinsinden belirtilir.
// Parametre:Anahtar değer çifti içeren bir dizi bilgisi içerir.
// Örnek: array('text/html' => 1);</comment>
<vf>$config</vf>[<sf>'Cache'</sf>][<sf>'expires_by_type'</sf>] = <kf>array</kf>
(
	<sf>'text/html'</sf> 			=> <sf>1</sf>,		<comment>// 1 Saniye</comment>
	<sf>'image/gif'</sf> 			=> <sf>2592000</sf>,	<comment>// 1 Ay</comment>
	<sf>'image/jpeg'</sf> 			=> <sf>2592000</sf>,	<comment>// 1 Ay</comment>
	<sf>'image/png'</sf> 			=> <sf>2592000</sf>,	<comment>// 1 Ay</comment>
	<sf>'text/css'</sf> 			=> <sf>604800</sf>, 	<comment>// 1 Hafta</comment>
	<sf>'text/javascript'</sf> 		=> <sf>216000</sf>, 	<comment>// 2.5 Gün</comment>
	<sf>'application/x-javascript'</sf> 	=> <sf>216000</sf>	<comment>// 2.5 Gün</comment>
);

<comment>/* MOD HEADERS */
// İşlev:Header önbelleklemeyi açmak için kullanılır
// Parametre:Header modu açık(true), gzip modu kapalı(false)
// Örnek: true/false</comment>
<vf>$config</vf>[<sf>'Cache'</sf>][<sf>'mod_headers'</sf>] = <kf>false</kf>;

<comment>/* FILE MATCH CACHE CONTROL */
// İşlev:Belirtilen türlerden eşleşenlerin karşılarında belirtilen süreler kadar ön belleğe alınması için kullanılır.
// Parametre:Anahtar değer çifti içeren bir dizi bilgisi içerir.
// Örnek: array('DosyaTuru1|DosyaTuru2' => array('time' => Saniye Cinsinden Zaman ,  'access' => 'ErisimYontemi')</comment>
<vf>$config</vf>[<sf>'Cache'</sf>][<sf>'file_match_cache_control'</sf>] = <kf>array</kf>
(
	<sf>'ico|pdf|flv|jpg|jpeg|png|gif|swf'</sf> 	=> <kf>array</kf>(<sf>'time'</sf> => <sf>2592000</sf> , 	<sf>'access'</sf> => <sf>'public'</sf>),
	<sf>'css'</sf> 					=> <kf>array</kf>(<sf>'time'</sf> => <sf>604800</sf> , 	<sf>'access'</sf> => <sf>'public'</sf>),
	<sf>'js'</sf> 					=> <kf>array</kf>(<sf>'time'</sf> => <sf>216000</sf> , 	<sf>'access'</sf> => <sf>'private'</sf>),
	<sf>'xml|txt'</sf>				=> <kf>array</kf>(<sf>'time'</sf> => <sf>216000</sf> , 	<sf>'access'</sf> => <sf>'public, must-revalidate'</sf>),
	<sf>'html|htm|php'</sf> 				=> <kf>array</kf>(<sf>'time'</sf> => <sf>1</sf> , 		<sf>'access'</sf> => <sf>'private, must-revalidate'</sf>)
);
</pre>
    </div>
    </p>
    
  	<p>Yukarıdaki ayarlar varsayılan olarak oluşturulmuş ideal ayarlardır siz kendi projenizin içeriğine göre değişiklikler yapabilirsiniz.</p>
    
    <div type="important"><div>ÖNEMLİ</div><div>Bu dosyada gerçekleştireceğiniz olası yanlış ayarlar <strong>.htaccess</strong> dosyasının çalışmamasına sebep olacaktır buda sitenizin <strong>500 internal server error</strong> gibi bir hata almasına sebep olabilir bu durumda yapmanız gereken. Açık olan ön bellekleme ayarını kapatıp .htaccess dosyasını silmektir. Sistem silme işleminden sonra .htaccess dosyasını yeniden oluşturmayı deneyecek sayfayı bir kaç kez yenilediğinizde oluşturma işlemi tamamlanmış olacaktır. Hala aynı hatayı almaya devam ediyorsanız <strong>Config/Htaccess.php</strong> dosyasından <strong>create_file</strong> ayarının değerini <strong>false</strong> ayarlayın ve .htaccess dosyasını silin hatanın nerden kaynaklandığını çözmek adına yaptığınız değişiklikleri yeniden gözden geçirin.</div></div>
    	
    <div type="prev-next">
    	<div type="prev-btn"><a href="config_autoload.html">Önceki</a></div><div type="next-btn"><a href="config_captcha.html">Sonraki</a></div>
    </div>
 
</body>
</html>              