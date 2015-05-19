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
    <div id="content-document"><a href="#">Döküman</a> » <a href="config.html">Ayarlar</a> » Htaccess(Erişim) Ayarları</div> 
    <p class="ctfont">Htaccess(Erişim) Ayarları</p>
    <p>Bu dosyanın amacı .htaccess dosyası üzerinde ayarlamalar yapabilmenizi sağlamaktır.</p>
    
  	<p>
    <div type="code">
<strong>Config/Htaccess.php</strong>
    <pre>
    <comment>/*
*-------------------------------------------------------------------------------
*	İşlev: .htaccess dosyasının oluşturulup oluşturulmayacağına karar verir.
*	Parametreler: true veya false
*	Varsayılan: true
*	Url'de index.php ekini kullanmak istemiyorsanız ve .htaccess yönlendirmesi
*	sunucunuzda aktifse bu değeri true yapıp bu dosyanın oluşmasını sağlayın.
*	Bu işlem dışında Config/Uri.php dosyasındaki index.php ayarını false 
*	durumuna getirmeyi unutmayın.
*-------------------------------------------------------------------------------
*/</comment>
<vf>$config</vf>[<sf>'Htaccess'</sf>][<sf>'create_file'</sf>] = <kf>true</kf>

<comment>/*
*-------------------------------------------------------------------------------
/* SET HTTACESS FILE  */
// ini_set() yöntemiyle yapamadığınız ayarlamaları buradan yapabilirsiniz.
// .htaccess dosyasında ini ayarları yapılabilsin mi? 
*-------------------------------------------------------------------------------
*/</comment>
<vf>$config</vf>[<sf>'Htaccess'</sf>][<sf>'set_file'</sf>] = <kf>false</kf>

<comment>/*
*-------------------------------------------------------------------------------
* Bu yöntemin kullanılabilmesi için yukarıdaki ayarın true olması gerekmektedir.
* İşlev: .htaccess dosyasına header ayarları eklemek için kullanılır.
* Parametreler: array( 'module' => array('setting1', 'setting2' ...))
* Varsayılan: array()
* Bu yöntemi kullanırken < > işaretlerini kullanmayınız.
* Modülü kapatma işlemini kendisi gerçekleştirmektedir.
* Dizi içerisindeki birinci parametre modül adı ve tip
* İkinci parametre ise bu aralıkta olması gereken kodlar.  
*-------------------------------------------------------------------------------
*/</comment>
<vf>$config</vf>[<sf>'Htaccess'</sf>][<sf>'settings'</sf>] = <kf>array</kf>
(
	<comment>// 'ifmodule mod_headers.c' => array('Header set Connection keep-alive')</comment>
);

    </pre>
    </div>
    </p>

    <div type="prev-next">
    	<div type="prev-btn"><a href="config_headers.html">Önceki</a></div><div type="next-btn"><a href="config_ini.html">Sonraki</a></div>
    </div>
 
</body>
</html>              