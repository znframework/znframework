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
    <div id="content-document"><a href="#">Döküman</a> » <a href="config.html">Ayarlar</a> » Session(Oturum) Ayarları</div> 
    <p class="ctfont">Session(Oturum) Ayarları</p>
    <p>Oturum işlemleri ile ilgili bir takım ayarlamaları içeren dosyadır. Genel olarak php_ini oturum yapılandırmasını içeren ayarlar yer almaktadır.</p>
 
	<p>
   	<div type="code">
<strong>Config/Session.php</strong>
<pre>
<comment>// Oturumların anahtar kelimeleri şifrelensin mi?
// true olması durumunda anahtar kelimeler şifrelenecektir.
// false olması durumunda ise anahtar kelimeler üzerinden
// herhangi bir şifreleme işlemi söz konusu olmayacaktır.
// Varsayılan: true.</comment>
<vf>$config</vf>[<sf>'Session'</sf>][<sf>'encode'</sf>] = <kf>true</kf>;

<comment>// true olması durumunda alttaki ayarlar .htaccess  dosyasına eklenir.
// false olması durumunda ayalar iniset() yöntemi üzerinden set 
// edilmeye çalışılacaktır.</comment>
<vf>$config</vf>[<sf>'Session'</sf>][<sf>'set_htaccess_file'</sf>] = <kf>false</kf>; 

<comment>// Aşağıda php_ini dosyası üzerinde değişiklik yapılabilecek oturum
// ayarları yer almaktadır. 
// Ayarların herhangi bir değer almaması varsayılan ayarlarının
// geçerli olduğu anlamına gelir.
//---------------------------------------------// VARSAYILAN DEĞERLER</comment>
<vf>$config</vf>[<sf>'Session'</sf>][<sf>'settings'</sf>] = <kf>array</kf>(
	<sf>'session.save_path'			<pf>=></pf> '', <comment>// NULL</comment>
	'session.name' 				<pf>=></pf> '', <comment>// PHPSESSID</comment>
	'session.save_handler'			<pf>=></pf> '', <comment>// files</comment>
	'session.auto_start' 			<pf>=></pf> '', <comment>// 0</comment>
	'session.gc_probability' 		<pf>=></pf> '', <comment>// 1</comment>
	'session.gc_divisor' 			<pf>=></pf> '', <comment>// 100</comment>
	'session.gc_maxlifetime'		<pf>=></pf> '', <comment>// 1440</comment>
	'session.serialize_handler' 		<pf>=></pf> '', <comment>// php</comment>
	'session.cookie_lifetime' 		<pf>=></pf> '', <comment>// 0</comment>
	'session.cookie_path' 			<pf>=></pf> '', <comment>// /</comment>
	'session.cookie_domain' 		<pf>=></pf> '', <comment>// NULL</comment>
	'session.cookie_secure' 		<pf>=></pf> '', <comment>// NULL</comment>
	'session.cookie_httponly' 		<pf>=></pf> '', <comment>// NULL</comment>
	'session.use_strict_mode' 		<pf>=></pf> '', <comment>// 0</comment>
	'session.use_cookies' 			<pf>=></pf> '', <comment>// 1</comment>
	'session.referer_check' 		<pf>=></pf> '', <comment>// NULL</comment>
	'session.entropy_file' 			<pf>=></pf> '', <comment>// NULL</comment>
	'session.entropy_length' 		<pf>=></pf> '', <comment>// 0</comment>
	'session.cache_limiter' 		<pf>=></pf> '', <comment>// nocache</comment>
	'session.cache_expire'			<pf>=></pf> '', <comment>// 180</comment>
	'session.use_trans_sid'			<pf>=></pf> '', <comment>// 0</comment>
	'session.hash_function'			<pf>=></pf> '', <comment>// 0</comment>
	'session.hash_bits_per_character' 	<pf>=></pf> '', <comment>// 4</comment>
	'session.upload_progress.enabled'	<pf>=></pf> '', <comment>// 1</comment>
	'session.upload_progress.cleanup' 	<pf>=></pf> '', <comment>// 1</comment>
	'session.upload_progress.prefix' 	<pf>=></pf> '', <comment>// upload_progress</comment>
	'session.upload_progress.name'		<pf>=></pf> '', <comment>// PHP_SESSION_UPLOAD_PROGRESS</comment>
	'session.upload_progress.freq' 		<pf>=></pf> '', <comment>// 1%</comment>
	'session.upload_progress.min_freq'  	<pf>=></pf> ''</sf>  <comment>// 1</comment>
);
	</pre>
   	</div>
  	</p>

    <div type="prev-next">
    	<div type="prev-btn"><a href="config_security.html">Önceki</a></div><div type="next-btn"><a href="config_symbols.html">Sonraki</a></div>
    </div>
 
</body>
</html>              