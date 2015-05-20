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
    <div id="content-document"><a href="#">Döküman</a> » <a href="libraries.html">Kütüphaneler</a> » Upload(Dosya Yükleme) Sınıfı</div> 
    <p class="ctfont">Upload(Dosya Yükleme) Sınıfı</p>
    <p>Dosya yükleme işlevini yerine getiren sınıftır. Ayrıca çoklu dosya yüklemenizide olanak sağlarken dosya işlemleri hakkında veya süreçte oluşan hatalar hakkında da bilgi alabilmenizi sağlar.</p>
    <ul><li><a href="#" class="infont">Upload(Dosya Yükleme) Sınıfı ve Yöntemleri</a><br><br>
        <ul>  
        	<li><a href="#upload_import">Upload Kütüphanesini Dahil Etmek</a></li>
        	<li><a href="#upload_settings">Dosya Yükleme Ayarlarını Yapılandırmak » <b>upload::settings()</b></a></li>
            <li><a href="#upload_start">Dosya Yükleme İşlemini Başlatmak » <b>upload::start()</b></a></li>
            <li><a href="#upload_info">Dosya Yükleme İşlemleri Hakkında Bilgi Almak » <b>upload::info()</b></a></li>
            <li><a href="#upload_error">Dosya Yükleme İşlemleri Sırasında Ortaya Çıkan Hataları Öğrenmek » <b>upload::error()</b></a></li>
        </ul>
    </li></ul>
    
   
    <p class="cstfont" id="upload_import">Upload Kütüphanesini Dahil Etmek</p>
    <div type="code">
  	import::library(<sf>'Upload'</sf>);
    </div>
    
   	<p class="cstfont" id="upload_settings">Dosya Yükleme Ayarlarını Yapılandırmak</p>
    <p><ftype>upload::settings( <kf>array</kf> <vf>$ayarlar</vf> )</ftype></p>
    <p>Dosya ayalarlarını yapılandırmak için kullanılan bu yöntemin bir dizi parametresi vardır. Ayarlar</p> 
    <p>
    	<table class="cfont">
        	<tr><th>Parametre</th><td>Anlamları</td></tr>
            <tr><th>1. Parametre = Ayarlar</th><td>Dosya yükleme ayarları yapılandırılır.</td></tr>
            <tr><th>Ayarlar Dizisi Parametreleri</th><th>Anlamları.</th></tr>	
            <tr><th>[extensions = Tüm Dosyalar]</th><td>Hangi uzantılı dosyaların yükleneceğini belirlemek için kullanılır. Kullanım jpg|png|swf. Herhangi bir uzantı seçilmezse her uzantılı dosyayı yüklecektir.</td></tr> 
            <tr><th>[encode = 1]</th><td>Yükselenecek dosya ismi şifrelensin mi? Alabileceği değerler: true veya false</td></tr>
            <tr><th>[prefix = ""]</th><td>Yükselenecek dosya ön ek koymak için kullanılır.</td></tr>
            <tr><th>[maxsize = ""]</th><td>Yükselenecek dosyanın byte cinsinden maksimum boyutunu belirlemek için kullanılır.</td></tr>
            <tr><th>Config/Upload.php Genel Dosya Yükleme Ayarları</th><th>Anlamları.</th></tr>	
            <tr><th>[file_uploads = true]</th><td>HTTP üzerinden karşıya dosya yüklemeye izin verilip verilmeyeceğini belirler. Alabileceği değerler: true veya false</td></tr>
            <tr><th>[upload_tmp_dir = "/"]</th><td>Karşıya dosya yüklenirken dosyaların geçici olarak saklanacağı dizin.</td></tr> 
            <tr><th>[max_input_nesting_level = 64]</th><td>Girdi değişkenlerinin ($_GET, $_POST... gibi) azami iç içelik derinliğini ayarlar.</td></tr>
            <tr><th>[max_input_vars = 1000]</th><td>Kabul edilebilecek girdi değişkenlerinin sayısı.</td></tr>
            <tr><th>[max_file_uploads = 20]</th><td>Aynı anda karşıya yüklenebilecek azami dosya sayısı.</td></tr>
            <tr><th>[upload_max_filesize = 2M]</th><td>Yüklenecek maksimum dosya kapasitesi.</td></tr>
            <tr><th>[post_max_size = 8M]</th><td>POST verisinin azami boyutunu belirler.</td></tr>
            <tr><th>[max_input_time = -1]</th><td>Bir betiğin POST ve GET gibi girdileri çözümlemesi için gereken azami süre saniye cinsinden burada belirtilir.</td></tr>
            <tr><th>[max_execution_time = 30]</th><td>Çözümleyici tarafından sonlandırılmadan önce bir betiğin çalışabileceği azami süreyi saniye cinsinden tanımlar.</td></tr>
        </table>
    </p>
    
    <p>
    	<div type="code">
<pre>
import::library(<sf>'Upload'</sf>,<sf>'Form'</sf>);

<vf>$ayarlar</vf> = <kf>array</kf>(
	<sf>'encode'</sf> => <kf>false</kf>, <comment> // Dosya isminin şifrelenmesini istemedik.</comment>
    	<sf>'prefix'</sf> => <sf>'_onek_'</sf>, <comment> // Yüklenen dosya isminin önüne _onek_ ibaresinin gelmesini istedik.</comment>
    	<sf>'extensions'</sf> => <sf>'jpg|jpeg|png|gif|exe'</sf> <comment> // Sadece yanda verilen uzantılı dosyaları yüklemesini istedik.</comment>
        <sf>'maxsize'</sf> => <sf>10 * 1024</sf> <comment> // En fazla 10kb boyutunda dosya yüklenebilir.</comment>
);
<strong>upload::settings</strong>(<vf>$ayarlar</vf>);
</pre>
        </div>
    </p>
    
    <div type="note"><div>NOT</div><div>Ön ek kullanıyorsanız dosya isimlerine şifreleme yöntemi uygulayamazsınız. Bunun için ön ek kullanmamanız gerekmektedir.</div></div>
    
    
    <p class="cstfont" id="upload_start">Dosya Yükleme İşlemini Başlatmak</p>
    <p><ftype>upload::start( <kf>string</kf> <vf>$file_button_name</vf> , [ <kf>string</kf> <vf>$hedef_dizin</vf> = <sf>'Views/Trinkets/Uploads'</sf> ] )</ftype></p>
    <p>Dosya yükleme işlemini başlatmak için kullanılır 2 parametresi vardır. File Butonun Adı, Dosyanın Yükleneceği Hedef Dizin</p> 
    <p>
    	<table class="cfont">
        	<tr><th>Parametre</th><td>Anlamları</td></tr>
            <tr><th>1. Parametre = File Buton Adı</th><td>Form aracı olan input file nesnesinin adı.</td></tr>
            <tr><th>2. Parametre = [Hedef Dizin = Views/Trinkets/Uploads]</th><td>Dosyanın yükleneceği hedef dizin.</td></tr>	
  
        </table>
    </p>
    
    <p>
    	<div type="code">
<pre>
import::library(<sf>'Upload'</sf>,<sf>'Form'</sf>);

<vf>$ayarlar</vf> = <kf>array</kf>(
	<sf>'encode'</sf> => <kf>false</kf>, <comment> // Dosya imini şifrelemesini şirelemesini istemedik.</comment>
    	<sf>'prefix'</sf> => <sf>'_onek_'</sf>, <comment> // Yüklenen dosya isminin önüne _onek_ ibaresinin gelmesini istedik.</comment>
    	<sf>'extensions'</sf> => <sf>'jpg|jpeg|png|gif|exe'</sf> <comment> // Sadece yanda verilen uzantılı dosyaları yüklemesini istedik.</comment>
);
upload::settings(<vf>$ayarlar</vf>);
<strong>upload::start</strong>(<sf><strong>'dosya'</strong></sf>); <comment> // Varsayılan Dizi Yolu: Views/Trinkets/Uploads.</comment>

<kf>echo</kf> form::open(<sf>'form'</sf>, <kf>array</kf>(<sf>'enctype'</sf> => <sf>'multipart'</sf>));
<kf>echo</kf> form::file(<sf><strong>'dosya'</strong></sf>);
<kf>echo</kf> form::submit(<sf>'yukle'</sf>);
<kf>echo</kf> form::close();
<comment>
/*
Views/Trinkets/Uploads/_onek_resim.jpg
*/
</comment>
</pre>
        </div>
    </p>
    
    <p><strong>Çoklu dosya yüklemek</strong> için file nesnesini aşağıdaki gibi düzenleyin.</p>
    <p><div type="code"><kf>echo</kf> form::file(<sf>'dosya<strong>[]'</strong></sf>,<sf>'Dosya Yükleme'</sf>, <kf>array</kf>(<strong><sf>'multiple'</sf></strong>));</div></p>
    <p>File aracının <strong>name</strong> değerine <strong>[ ]</strong> sembollerini eklerken <strong>multiple=>multiple</strong> özelliğini ilave ettik. Artık çoklu dosya yükleyebiliriz.</p>
    
    
    
    <p class="cstfont" id="upload_info">Dosya Yükleme İşlemleri Hakkında Bilgi Almak upload::info()</p>
    <p><ftype>upload::info()</ftype></p>
    <p>Dosya işlemleri sırasında dosya hakkında bilgi almak için kullanılır herhangi bir parametresi yoktur ancak verileri object veri tipinde döndürür.</p> 
   
    
    <p>
    	<div type="code">
<pre>
import::library(<sf>'Upload'</sf>,<sf>'Form'</sf>);

<vf>$ayarlar</vf> = <kf>array</kf>(
	<sf>'encode'</sf> => <kf>false</kf>, <comment> // Dosya imini şifrelemesini şirelemesini istemedik.</comment>
    	<sf>'prefix'</sf> => <sf>'_onek_'</sf>, <comment> // Yüklenen dosya isminin önüne _onek_ ibaresinin gelmesini istedik.</comment>
    	<sf>'extensions'</sf> => <sf>'jpg|jpeg|png|gif|exe'</sf> <comment> // Sadece yanda verilen uzantılı dosyaları yüklemesini istedik.</comment>
);
upload::settings(<vf>$ayarlar</vf>);
upload::start(<sf><strong>'dosya'</strong></sf>);

<kf>echo</kf> form::open(<sf>'form'</sf>, <kf>array</kf>(<sf>'enctype'</sf> => <sf>'multipart'</sf>));
<kf>echo</kf> form::file(<sf>'dosya<strong>[]'</strong></sf>,<sf>'Dosya Yükleme'</sf>, <kf>array</kf>(<strong><sf>'multiple'</sf></strong>));
<kf>echo</kf> form::submit(<sf>'yukle'</sf>);
<kf>echo</kf> form::close();

<ff>var_dump</ff>(<strong>upload::info()</strong>);
<comment>
/*
<img src="../Images/Result/upload1.PNG" />
*/
</comment>
</pre>
        </div>
    </p>

    <p>Sadece yüklenen dosyaların boyutları hakkında bilgi istemis olsaydık info yöntemini <b>upload::info()->size</b> şeklinde yazacaktık.</p>
    
    <p class="cstfont" id="upload_error">Dosya Yükleme İşlemleri Sırasında Ortaya Çıkan Hataları Öğrenmek upload::error()</p>
    <p><ftype>upload::error()</ftype></p>
    <p>Dosya işlemleri sırasında ortaya çıkan hatalar öğrenmek için kullanılır string türünde değer döndürür.</p> 
  
    
    <p>
    	<div type="code">
<pre>
import::library(<sf>'Upload'</sf>,<sf>'Form'</sf>);

<vf>$ayarlar</vf> = <kf>array</kf>(
	<sf>'encode'</sf> => <kf>false</kf>, <comment> // Dosya imini şifrelemesini şirelemesini istemedik.</comment>
    	<sf>'prefix'</sf> => <sf>'_onek_'</sf>, <comment> // Yüklenen dosya isminin önüne _onek_ ibaresinin gelmesini istedik.</comment>
    	<sf>'extensions'</sf> => <sf>'jpg|jpeg|png|gif'</sf> <comment> // Sadece yanda verilen uzantılı dosyaları yüklemesini istedik.</comment>
);
upload::settings(<vf>$ayarlar</vf>);
upload::start(<sf><strong>'dosya'</strong></sf>);

<kf>echo</kf> form::open(<sf>'form'</sf>, <kf>array</kf>(<sf>'enctype'</sf> => <sf>'multipart'</sf>));
<kf>echo</kf> form::file(<sf><strong>'dosya'</strong></sf>);
<kf>echo</kf> form::submit(<sf>'yukle'</sf>);
<kf>echo</kf> form::close();

<kf>echo</kf> <strong>upload::error()</strong>;
<comment>
/*
	ornek.exe adlı dosyayı yüklemeye çalıştığımızı kabul edersek.
    
    Geçersiz dosya uzantısı! hatasını alırız.
*/
</comment>
</pre>
        </div>
    </p>
  
    <div type="prev-next">
    	<div type="prev-btn"><a href="lib_sess.html">Önceki</a></div><div type="next-btn"><a href="lib_uri.html">Sonraki</a></div>
    </div>
 
</body>
</html>              