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
    <div id="content-document"><a href="#">Döküman</a> » <a href="libraries.html">Kütüphaneler</a> » Permission(Yetkiler) Sınıfı</div> 
    <p class="ctfont">Permission(Yetkiler) Sınıfı</p>
    <p>Sayfalara veya nesnelere erişim yetkilerinin düzenlemesi için oluşturulumuş bir sınıftır.</p>
    <ul><li><a href="#" class="infont">Permission(Yetkiler) Sınıfı ve Yöntemleri</a><br><br>
        <ul>    
        	<li><a href="#perm_import">Permission Kütüphanesini Dahil Etmek</a></li>
            <li><a href="#perm_process">Nesne Erişim Yetkilerini Düzenlemek » <b>perm::process()</b></a></li>
            <li><a href="#perm_page">Sayfa Erişim Yetkilerini Düzenlemek » <b>pag::page()</b></a></li>
        </ul>
    </li></ul>
    
    <p class="cstfont" id="perm_import">Permission Kütüphanesini Dahil Etmek</p>
    <div type="code">
  	import::library(<sf>'Permission'</sf>);
    </div>
    
   	<p class="cstfont" id="perm_process">Nesne Erişim Yetkilerini Düzenlemek</p>
    <p><ftype>perm::process( <kf>numeric</kf> <vf>$rol_id</vf> , <kf>string</kf> <vf>$islem</vf> , <kf>string</kf> <vf>$nesne</vf> )</ftype></p>
    <p>Nesnelere erişim yöntemi belirlemek için kullanılır. 3 parametresi vardır. Rol Id, İşlem, Nesne.</p> 
    <p>
    	<table class="cfont">
        	<tr><th>Parametre</th><td>Anlamları</td></tr>
            <tr><th>1. Parametre = Rol Id</th><td>Kullanıcıların rol id'si.</td></tr>
			<tr><th>2. Parametre = İşlem</th><td>Berlirlenen yetkiler.</td></tr>
            <tr><th>3. Parametre = Nesne</th><td>Yetkilere konu olacak nesne.</td></tr>
        </table>
    </p>
    <p>Yetki sınıfı <b>Config/Permission.php</b> dosyası ile birlikte kullanılır bu yüzden bu dosyanın içeriğinide incelemekte fayda görüyoruz.</p>
    
    <p>
    	<div type="code">
        Config/Permission.php
<pre>
<vf>$config</vf>[<sf>'Permission'</sf>][<sf>'process'</sf>] = <kf>array</kf>
(
	<sf>'1'</sf> => <sf>'any'</sf>,
	<sf>'2'</sf> => <sf>'any'</sf>,
	<sf>'3'</sf> => <sf>'noperm=>|yetki1|yetki2'</sf>,
	<sf>'4'</sf> => <sf>'perm=>|yetki3|yetki4'</sf>,
	<sf>'5'</sf> => <sf>'noperm=>|yetki5|yetki6'</sf>,
	<sf>'6'</sf> => <sf>'all'</sf>
);
</pre>
        Yukarıdaki ayarlarda <b>1,2,3,4,5,6</b> gibi rakamlarla birlikte <b>any, all, perm, noperm</b> gibi kavramlar görüyorsunuz. Bunların ne olduklarını açıklayalım.<br>
        <p><b>1. Rakamlar</b><br> kullanıcıların rol numaralarını ifade eder yukarıda 6 adet id var bu varsayılan adettir siz isterseniz 2 yapabileceğiniz gibi 10 da yapabilirsiniz bu sizin sitenizdeki kullanıcıların rütbesiyle alakalıdır. Örneğin kullanici, admin, super admin, administrator olmak üzere 4 farklı rol olduğunu düşünürsek rol adetide 4 olacaktır 1 en alt yetkiye sahip olan kullanicilari ifade ederken 4 en yüksek yetkili administrator'u ifade edecektir.
        </p>
        <p><b>2. Yetkiler</b><br>
        <b>any:</b> Hiç bir yetkisi yok demektir.<br>
        <b>all:</b> Bütün yetkilere sahip demektir.<br>
        <b>noperm=>:</b>Belirlenen nesnelere izin yok demektir. Yetkilerde <b>|y1|y2..</b> şeklinde yazılacaktır.<br>
        <b>perm=>:</b>Belirlenen nesnelere izin var demektir. Yetkilerde <b>|y1|y2..</b> şeklinde yazılacaktır.<br>
       
        </p>
        </div>
    </p>
    
    <p>Aşağıdaki örnek uygulamada bir butona erişim yetkisi veren bir örnek yer almaktadır.</p>
    
	<p>
    	<div type="code">
<pre>
<x><</x>?php
<kf>class</kf> Yekiler
{
	<ff>function</ff> index()
    	{
        	import::library(<sf>'Permission'</sf>, <sf>'Form'</sf>);
        	
                <comment>/*
                Config/Permission.php ayarlar aşağıdaki gibi kabul edilirse.
                 
                '1' => 'any'</sf>, // Rol Id'si 1 olanın hiç bir yetkisi yok.
                '2' => 'any'</sf>, // Rol Id'si 2 olanın hiç bir yetkisi yok.
                '3' => 'noperm=>|silme_islemi'</sf>, // Rol Id'si 3 olanın silme_islemi için yetkisi yok.
                '4' => 'perm=>|silme_islemi'</sf>, // Rol Id'si 4 olanın silme_islemi için yetisi var.
                */</comment>
            
            	<vf>$role_id</vf> = 4;
        	<vf>$buton</vf> = form::button(<sf>'silme_butonu'</sf>, <sf>'Silme İşlemi'</sf>);
                <kf>echo</kf> <strong>perm::process</strong>(<vf>$role_id</vf>, <sf>'silme_islemi'</sf>, <vf>$buton</vf>); 
                <comment>/* 
                Sonuç: Buton Rol Id'si 4 olan kullanıcı için görünecekken 1,2 ve 3 Rol Id'li kullanıcı için görünmeyecektir.
                */</comment>
    	}
}
</pre>
    	</div>
    </p>
    
    <p>Yetki ayarları dosyasını aşağıdaki gibi düzenleyip bir örnek üzerinde tekrar inceleyecelim.</p>
    <div type="code">
        Config/Permission.php
<pre>
<vf>$config</vf>[<sf>'Permission'</sf>][<sf>'process'</sf>] = <kf>array</kf>
(
	<sf>'1'</sf> => <sf>'any'</sf>,
	<sf>'2'</sf> => <sf>'any'</sf>,
	<sf>'3'</sf> => <sf>'perm=>|guncelleme_yetkisi'</sf>,
	<sf>'4'</sf> => <sf>'perm=>|guncelleme_yetkisi|ekleme_yetkisi'</sf>,
	<sf>'5'</sf> => <sf>'perm=>|guncelleme_yetkisi|ekleme_yetkisi|silme_yetkisi'</sf>,
   	<sf>'6'</sf> => <sf>'noperm=>|erisimleri_duzenleme_yetkisi'</sf>,
	<sf>'7'</sf> => <sf>'all'</sf>
);
</pre>
	</div>
    <p>Kodlarımızı aşağıdaki gibi düzenliyoruz.</p>
    <p>
    	<div type="code">
<pre>
<vf>$role_id</vf> = 4;
<kf>echo</kf> <strong>perm::process</strong>(<vf>$role_id</vf>, <sf>'guncelleme_yetkisi'</sf>, form::button(<sf>'guncelleme_butonu'</sf>, <sf>'Güncelleme İşlemi'</sf>));
<kf>echo</kf> <strong>perm::process</strong>(<vf>$role_id</vf>, <sf>'ekleme_yetkisi'</sf>, form::button(<sf>'ekleme_butonu'</sf>, <sf>'Ekleme İşlemi'</sf>)); 
<kf>echo</kf> <strong>perm::process</strong>(<vf>$role_id</vf>, <sf>'silme_yetkisi'</sf>, form::button(<sf>'silme_butonu'</sf>, <sf>'Silme İşlemi'</sf>)); 
<kf>echo</kf> <strong>perm::process</strong>(<vf>$role_id</vf>, <sf>'erisimleri_duzenleme_yetkisi'</sf>, form::button(<sf>'erisim_butonu'</sf>, <sf>'Erişimleri Düzenleme İşlemi'</sf>)); 
<comment>/* 
$role_id = 1 ise hiç bir buton görünmeyecektir.
$role_id = 2 ise hiç bir buton görünmeyecektir.
$role_id = 3 ise sadece güncelleme butonu görünecektir. <img src="../Images/Result/perm1.PNG" />
$role_id = 4 ise hem güncelleme hem de ekleme butonu görünecektir. <img src="../Images/Result/perm2.PNG" />
$role_id = 5 ise güncelleme, ekleme ve silme butonu görünecektir. <img src="../Images/Result/perm3.PNG" />
$role_id = 6 ise sadece erişimleri düzenleme butonu görünmeyecektir. <img src="../Images/Result/perm3.PNG" />
$role_id = 7 ise tüm butonlar görünecektir. <img src="../Images/Result/perm4.PNG" />
*/</comment>
</pre>
    	</div>
    </p>
    
    <div type="note"><div>NOT</div><div>Örneklerde genellik nesne olarak buton kullandık ancak yetkiler butonlarla sınırlı değildir siz herhangi bir nesne kullanabilirsiniz. Örnek: div, texarea, checkbox, radio...</div></div>
    
    
    
    <p class="cstfont" id="perm_page">Sayfa Erişim Yetkilerini Düzenlemek</p>
    <p><ftype>perm::page( <kf>numeric</kf> <vf>$rol_id</vf> )</ftype></p>
    <p>Sayfalara erişim yöntemi belirlemek için kullanılır. 1 parametresi vardır. Rol Id.</p> 
    <p>
    	<table class="cfont">
        	<tr><th>Parametre</th><td>Anlamları</td></tr>
            <tr><th>1. Parametre = Rol Id</th><td>Kullanıcıların rol id'si.</td></tr>
        </table>
    </p>
    
    <p>
    	<div type="code">
        Config/Permission.php
<pre>
<vf>$config</vf>[<sf>'Permission'</sf>][<sf>'page'</sf>] = <kf>array</kf>
(
	<sf>'1'</sf> => <sf>'any'</sf>,
	<sf>'2'</sf> => <sf>'any'</sf>,
	<sf>'3'</sf> => <sf>'noperm=>|sayfa1|sayfa2'</sf>,
	<sf>'4'</sf> => <sf>'perm=>|sayfa3|sayfa4'</sf>,
	<sf>'5'</sf> => <sf>'noperm=>|sayfa5|sayfa6'</sf>,
	<sf>'6'</sf> => <sf>'all'</sf>
);
</pre>
	Ayarlar yukarıda anlatığımız gibidir. Tek fark nesne adı yerine sayfa ismi kullanılmasıdır.
        </div>
    </p>
    
    <p>Örnek bir uygulama üzerinde kodlarımızı inceleyelim.</p>
    
    <div type="code">
        Config/Permission.php
<pre>
<vf>$config</vf>[<sf>'Permission'</sf>][<sf>'page'</sf>] = <kf>array</kf>
(
	<sf>'1'</sf> => <sf>'perm=>|anasayfa|iletisim|hakkimizda'</sf>,
	<sf>'2'</sf> => <sf>'perm=>|ansayfa|iletisim|hakkimizda|urunler'</sf>,
	<sf>'3'</sf> => <sf>'noperm=>|yonetim_paneli|dizin_yonetimi'</sf>,
	<sf>'4'</sf> => <sf>'noperm=>|dizin_yonetimi|'</sf>,
	<sf>'5'</sf> => <sf>'all'</sf>,
);
</pre>
	</div>
    <p>Kodlarımızı aşağıdaki gibi düzenliyoruz.</p>
    <p>
    	<div type="code">
<pre>
<vf>$role_id</vf> = 4;
<kf>if</kf>( ! <strong>perm::page(</strong><vf>$role_id</vf>)) redirect(<sf>'yetkiniz_yok'</sf>);
<comment>/* 
Rol Id'sine göre girilen sayfa yetki sınırları içerisinde ise değer true dönecektir. Yetki sınırları dışında ise false dönecektir. Kodda yapılmak istenende eğer yetkileri dışında bir sayfaya girilmişse yetkiniz_yok.php sayfasına yönlendirilsin.

$role_id = 1 ise sadece anasayfa, iletisim ve hakkimizda sayfalarına girebilsin farklı bir sayfa ise yönlendirilsin.
$role_id = 2 ise sadece anasayfa, iletisim, hakkimizda ve urunler sayfalarına girebilsin farklı bir sayfa ise yönlendirilsin.
$role_id = 3 ise sadece yonetim_paneli ve dizin_yonetimi sayfalarına giremesin ve yönlendirilsin.
$role_id = 4 ise sadece dizin_yonetimi sayfasına giremesin ve yönlendirilsin.
$role_id = 5 ise tüm sayfalara girebilsin.
*/</comment>
</pre>
    	</div>
    </p>

	<div type="note"><div>NOT</div><div>Permission sınıfını session(oturum) işlemlerinde veya  yönetim panelinde hangi adminlerin hangi yetkilerlerle hareket edeceğinin belirlenmesinde oldukça faydalı olabilir.</div></div>
    
    
    <div type="prev-next">
    	<div type="prev-btn"><a href="lib_pagination.html">Önceki</a></div><div type="next-btn"><a href="lib_reg.html">Sonraki</a></div>
    </div>
 
</body>
</html>              