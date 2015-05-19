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
    <div id="content-document"><a href="#">Döküman</a> » <a href="config.html">Ayarlar</a> » Language(Dil) Ayarları</div> 
    <p class="ctfont">Language(Dil) Ayarları</p>
    <p>Dil seçenekleri ile ilgili ayar içeren dosyadır.</p>
    
  	<p>
    <div type="code">
    <strong>Config/Language.php</strong>
    <pre>
<comment>/* LANGUAGES  */
//Dizi içerisindeki anahtar aktif dili belirtirken değer dil dosyalarının çağrılacağı klasörü belirtir.
//Varsayılan olarak iki adet dil belirtilmiştir. Language/ dizinine bakıldığında neden 2 adet dil seçildiği anlaşılacaktır.
//Dilin anahtar kelimesi => Temsil ettiği Language/ dizinindeki alt dizin.
</comment>
<vf>$config</vf>[<sf>'Language'</sf>] = <kf>array</kf>
(
	<sf>'tr'</sf> => <sf>'turkish'</sf>,
	<sf>'en'</sf> => <sf>'english'</sf>
);
    </pre>
    </div>
    </p>

    <div type="prev-next">
    	<div type="prev-btn"><a href="config_ini.html">Önceki</a></div><div type="next-btn"><a href="config_libraries.html">Sonraki</a></div>
    </div>
 
</body>
</html>              