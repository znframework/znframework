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
    <div id="content-document"><a href="#">Döküman</a> » <a href="config.html">Ayarlar</a> » Permission(Yetki) Ayarları</div> 
    <p class="ctfont">Permission(Yetki) Ayarları</p>
    <p>Sayfalara ve diğer nesnelere erişim yetkilerini düzenleyen ayarları içerir.</p>
 
	<p>
   	<div type="code">
<strong>Config/Permission.php</strong>
<pre>
<comment>//İzin verilen sayfaları belirlemek için "perm=>|s1|s2" şeklinde kullanın.
//İzin vermek istemediğiniz sayfaları belirlemek için "noperm=>|s1|s2" şeklinde kullanın.
//Hiç bir sayfaya izin vermemek için any parametresini kullanın.
//Her sayfaya izin vermek için all parametresiniz kullanın
//Tek bir sayfaya izin vermek istediğinide normal olarak yazın.
//Tek bir sayfaya izin vermek istemediğinizde ise başına "!" işareti koyarak yazın
</comment>
<vf>$config</vf>[<sf>'Permission'</sf>][<sf>'page'</sf>] = <kf>array</kf>
(
	<sf>'1' <pf>=></pf> 'any',
	'2' <pf>=></pf> 'any',
	'3' <pf>=></pf> 'noperm=>|sayfa1|sayfa2',
	'4' <pf>=></pf> 'perm=>|sayfa3|sayfa4',
	'5' <pf>=></pf> 'noperm=>|sayfa5|sayfa6',
	'6' <pf>=></pf> 'all'</sf>
);

<comment>//İzin verilen nesneleri belirlemek için "perm=>|s1|s2" şeklinde kullanın.
//İzin vermek istemediğiniz nesneleri belirlemek için "noperm=>|s1|s2" şeklinde kullanın.
//Hiç bir nesneye izin vermemek için any parametresini kullanın.
//Her nesneye izin vermek için all parametresiniz kullanın
//Tek bir nesneye izin vermek istediğinide normal olarak yazın.
//Tek bir nesneye izin vermek istemediğinizde ise başına "!" işareti koyarak yazın
<vf>$config</vf>[<sf>'Permission'</sf>][<sf>'process'</sf>] = <kf>array</kf>
(
	<sf>'1' <pf>=></pf> 'any',
	'2' <pf>=></pf> 'any',
	'3' <pf>=></pf> 'noperm=>|yetki1|yetki2',
	'4' <pf>=></pf> 'perm=>|yetki3|yetki4',
	'5' <pf>=></pf> 'noperm=>|yetki5|yetki6',
	'6' <pf>=></pf> 'all'</sf>
);
</comment>
</pre>
   	</div>
  	</p>

    <div type="prev-next">
    	<div type="prev-btn"><a href="config_masterpage.html">Önceki</a></div><div type="next-btn"><a href="config_regex.html">Sonraki</a></div>
    </div>
 
</body>
</html>              