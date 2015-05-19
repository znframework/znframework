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
    <div id="content-document"><a href="#">Döküman</a> » <a href="config.html">Ayarlar</a> » Upload(Yükleme) Ayarları</div> 
    <p class="ctfont">Upload(Yükleme) Ayarları</p>
    <p>Dosya yüklenmesi ile ilgili ayarların yer aldığı dosyadır. PHP de yer alan iniset() yöntemi ile ayarlanabilir bazı ayarlar yer almaktadır.</p>
 
	<p>
   	<div type="code">
<strong>Config/Upload.php</strong>
<pre>
<comment>// true olması durumunda alttaki ayarlar .htaccess  dosyasına eklenir.
// false olması durumunda ise php_ini() yöntemi üzerinden değişikliler
// yapılmaya çalışılır.</comment>
<vf>$config</vf>[<sf>'Upload'</sf>][<sf>'set_htaccess_file'</sf>] = <kf>false</kf>; 

<comment>//------------------------------------------------------// VARSAYILAN DEĞERLER</comment>
<vf>$config</vf>[<sf>'Upload'</sf>][<sf>'file_uploads'</sf>] 		= ""; 	<comment>// "1"</comment>
<vf>$config</vf>[<sf>'Upload'</sf>][<sf>'post_max_size'</sf>] 		= "";   <comment>// "8M"</comment>
<vf>$config</vf>[<sf>'Upload'</sf>][<sf>'upload_max_filesize'</sf>] 	= "";   <comment>// "2M"</comment>
<vf>$config</vf>[<sf>'Upload'</sf>][<sf>'upload_tmp_dir'</sf>] 		= "";   <comment>// NULL</comment>
<vf>$config</vf>[<sf>'Upload'</sf>][<sf>'max_input_nesting_level'</sf>] 	= "";	<comment>// 64</comment>
<vf>$config</vf>[<sf>'Upload'</sf>][<sf>'max_input_vars'</sf>] 		= "";	<comment>// 1000</comment>
<vf>$config</vf>[<sf>'Upload'</sf>][<sf>'max_file_uploads'</sf>] 		= "";	<comment>// 20</comment>	
<vf>$config</vf>[<sf>'Upload'</sf>][<sf>'max_input_time'</sf>] 		= "";	<comment>// "-1"</comment>
<vf>$config</vf>[<sf>'Upload'</sf>][<sf>'max_execution_time'</sf>] 	= "";	<comment>// "30"</comment>
	</pre>
   	</div>
  	</p>

    <div type="prev-next">
    	<div type="prev-btn"><a href="config_symbols.html">Önceki</a></div><div type="next-btn"><a href="config_uri.html">Sonraki</a></div>
    </div>
 
</body>
</html>              