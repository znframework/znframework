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
    <div id="content-document"><a href="#">Döküman</a> » <a href="config.html">Ayarlar</a> » Libraries(Kütüphane) Ayarları</div> 
    <p class="ctfont">Libraries(Kütüphane)) Ayarları</p>
    <p>Kütüphaneler ile ilgili ayar içeren dosyadır.</p>
    
  	<p>
    <div type="code">
    <strong>Config/Libraries.php</strong>
<pre><comment>//-------------------------------------------------------------------------------------
// İşlev: Kütüphanelerin sınıf isimlerinde dosya isminden farklı bir
// isim kullanılması düşünülüyorsa bu bölüme ilave edilmelidir.
// Veri: array().
// Kullanımı: array('Database' => 'Db' , ...);
//-------------------------------------------------------------------------------------</comment>
<vf>$config</vf>[<sf>'Libraries'</sf>][<sf>'short_name'</sf>] 	= <kf>array</kf>
(
	<sf>'Benchmark'</sf> 	=> <sf>'Bench'</sf>,
	<sf>'Cookie'</sf>	=> <sf>'Cook'</sf>,
	<sf>'Pagination'</sf>	=> <sf>'Pag'</sf>,
	<sf>'Permission'</sf>	=> <sf>'Perm'</sf>,
	<sf>'Regex'	</sf>	=> <sf>'Reg'</sf>,
	<sf>'Security'</sf>	=> <sf>'Sec'</sf>,
	<sf>'Session'</sf>	=> <sf>'Sess'</sf>,
	<sf>'Validation'</sf>	=> <sf>'Val'</sf>
);	

<comment>//-------------------------------------------------------------------------------------
// İşlev: Kütüphane olarak çağrılmak istenen dosyaların yer aldığı dizin
// aşağıdaki diziye belirtilerek kütüphane gibi dahil edilibilir hale gelir.
// Veri: array().
// Kullanımı: array(DB_DIR, 'System/xx/' , a/c/);
//-------------------------------------------------------------------------------------</comment>
<vf>$config</vf>[<sf>'Libraries'</sf>][<sf>'different_directory'</sf>] = <kf>array</kf>(DB_DIR);</pre>
    </div>
    </p>

    <div type="prev-next">
    	<div type="prev-btn"><a href="config_language.html">Önceki</a></div><div type="next-btn"><a href="config_log.html">Sonraki</a></div>
    </div>
 
</body>
</html>              