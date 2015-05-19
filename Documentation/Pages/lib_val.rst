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
    <div id="content-document"><a href="#">Döküman</a> » <a href="libraries.html">Kütüphaneler</a> » Validation(Veri Kontrol) Sınıfı</div> 
    <p class="ctfont">Validation(Veri Kontrol) Sınıfı</p>
    <p>Post, get gibi yöntemlerle gelen verilerin kontrolünü sağlayan sınıftır. Temel amacı veri ve sistem güvenliğini sağlamaktır enjeksiyon veya script saldırıları gibi istenmeyen atakları engellemektir.</p>
    <ul><li><a href="#" class="infont">Validation(Veri Kontrol) Sınıfı ve Yöntemleri</a><br><br>
        <ul> 
        	<li><a href="#val_import">Validation Kütüphanesini Dahil Etmek</a></li>
        	<li><a href="#val_params">Validasyon Kontrol Parametreleri</b></a></li>
        	<li><a href="#val_rules">Validasyon Kontrol Kuralları Oluşturmak » <b>val::rules()</b></a></li>      
            <li><a href="#val_nval">Kontrolleri Sağlanmış Veriyi Kullanmak » <b>val::nval()</b></a></li> 
            <li><a href="#val_error">Validasyon Kontrol Kurallarına Uymayan Verilerin Hata Bilgisini Almak » <b>val::error()</b></a></li> 
            <li><a href="#val_post_back">Post Edilen Sayfa Sonrası Form Değerlerini Korumak » <b>val::post_back()</b></a></li>
        </ul>
    </li></ul>
    
    <p class="cstfont" id="val_import">Validation Kütüphanesini Dahil Etmek</p>
    <div type="code">
  	import::library(<sf>'Validation'</sf>);
    </div>
    
    <p class="cstfont" id="val_params">Validasyon Kontrol Parametreleri</p>
    <p>Validasyon sınıfı bazı parametreleri kullanarak verilerin kontrolünü sağlar. Ne gibi kontrollerin yapıldığını aşağıda listeledik. Bu parametreler <strong>val::rules()</strong> yöntemi ile kullanılacağından işlevleri hakkında kısaca bilgi vermek istedik.</p> 
    
     <p>
    	<table class="cfont">
        	<tr><th>Kontrol Parametreleri</th><td>Anlamları</td></tr>
            <tr><th>identity</th><td>TC Kimlik numarası kontrolü</td></tr>
            <tr><th>email</th><td>E-posta kontrolü.</td></tr>
            <tr><th>url</th><td>URL adres kontrolü.</td></tr>
            <tr><th>specialchar</th><td>Özel karakter kontrolü</td></tr>
            <tr><th>minchar</th><td>Minimum karakter sayısı kontrolü</td></tr>
            <tr><th>maxchar</th><td>Maksimum karakter sayısı kontrolü</td></tr>
            <tr><th>required</th><td>Boş geçilemez verilerin kontrolü</td></tr>
            <tr><th>numeric</th><td>Verilerin sayı kontrolü</td></tr>
            <tr><th>old_password</th><td>Şifre değiştirme işlemlerinde eski şifrenin kontrolü</td></tr>
            <tr><th>match_password</th><td>Kayıt veya güncelleme işlemlerinden şifre ve şifre tekrar verilerinin eşleşip eşleşmediğinin kontrolü</td></tr>
            <tr><th>captcha_code</th><td>Güvenlik kodu bilgisinin kontrolü</td></tr>
            <tr><th>match</th><td>Herhangi iki bilginin eşleşip eşleşmediğinin kontrolü</td></tr>
            <tr><th>trim</th><td>Boş karakter kontrolü</td></tr>
            <tr><th>nc_encode</th><td>Kötü verilerin kontrolü</td></tr>
            <tr><th>html_encode</th><td>Html kodu içerikli verilerin kontrolü</td></tr>
            <tr><th>nail_encode</th><td>Tırnak işaretlerinin kontrolü</td></tr>
            <tr><th>injection_encode</th><td>Veritabanı Enjeksiyon kontrolü</td></tr>
        </table>
    </p>
    
    
    <p class="cstfont" id="val_rules">Validasyon Kontrol Kuralları Oluşturmak</p>
    <p><ftype>val::rules( <kf>string</kf> <vf>$nesne</vf> , <kf>array</kf> <vf>$ayarlar</vf> , <kf>string</kf> <vf>$nesnenin_gorunur_ismi</vf> , [ <kf>string</kf> <vf>$method</vf> = <sf>'post'</sf> ] )</ftype></p>
    <p>Bu yöntemin temel amacı gelen verilerin hangi kontrol parametrelerinden geçeceğini belirlemektir. 4 parametresi vardır. Nesne, Ayarlar, Nesnenin Görünen Adı, Metot</p> 
    
    <p>
    	<table class="cfont">
        	<tr><th>Parametre</th><td>Anlamları</td></tr>
            <tr><th>1. Parametre = Nesne</th><td>Post veya diğer yöntemlerle gönderilen verinin ismi.</td></tr>
            <tr><th>2. Parametre = Ayarlar</th><td>Kontrolu grubu oluşturulur.</td></tr>
            <tr><th>3. Parametre = Görünecek İsim</th><td>Nesnenin görünür ismi.</td></tr>
            <tr><th>4. Parametre = [Yöntemi = post]</th><td>Verinin hangi yöntemle gönderilmişse bu parametre ona ayarlanmalıdır var sayılan post yöntemidir.</td></tr>
        </table>
    </p>
    <p>Şimdi validasyon işlemlerinin iyi anlaşılabilmesi için aşağıdaki örnek kod üzerinde inceleyelim.</p>
    
    <div type="code">
    <pre>
import::library(<sf>'Validation'</sf> , <sf>'Method'</sf>);

method::post(<sf>'email'</sf>, <sf>'bilgi@zntr.net'</sf>);
method::post(<sf>'sifre'</sf>, <sf>'zntr1234'</sf>);

<comment>
/* 
email nesnesine 2 kurak ekledik 1. kural: boş geçilemez - 2. kural: içeriği e-posta adresi olmalıdır. 
3 parametre ise hata oluşturuğunda nesnenin görünecek ismidir.
*
/</comment>
<strong>val::rules</strong>(<sf>'email'</sf>, <kf>array</kf>(<sf>'required'</sf>, <sf>'email'</sf>), <sf>'E-posta'</sf>);
<comment>
/* 
sifre nesnesine 3 kurak ekledik 1. kural: boş geçilemez - 2. kural: Minmum 6 karakter sınırlaması. - 3. kural: Maksimum 16 karakter sınırlaması.
3 parametre ise hata oluşturuğunda sifre nesnesinin görünecek ismidir.
*
/</comment>
<strong>val::rules</strong>(<sf>'sifre'</sf>, <kf>array</kf>(<sf>'required'</sf>, <sf>'minchar'</sf> => <sf>'6'</sf>, <sf>'maxchar'</sf> => <sf>'16'</sf>), <sf>'Şifre'</sf>);

<kf>echo</kf> val::error(<sf>'string'</sf>);
<comment>
/* 
Post değerleri boş gönderilirse aşağıdaki çıktı oluşacaktır.

E-posta alanı boş geçilemez!
E-posta alanı geçersiz posta adresidir!
Şifre alanı boş geçilemez!
Şifre alanı en az 6 karakterden oluşmalıdır!
*
/</comment>
    </pre>
    </div>
    
    <p></p>
    
    <div type="code">
    <pre>
import::library(<sf>'Validation'</sf> , <sf>'Method'</sf>);

method::post(<sf>'email'</sf>, <sf>'Yanlis E-posta'</sf>);
method::post(<sf>'sifre'</sf>, <sf>'1234'</sf>);

<strong>val::rules</strong>(<sf>'email'</sf>, <kf>array</kf>(<sf>'required'</sf>, <sf>'email'</sf>), <sf><strong>'E-posta'</strong></sf>);
<strong>val::rules</strong>(<sf>'sifre'</sf>, <kf>array</kf>(<sf>'required'</sf>, <sf>'minchar'</sf> => <sf>'6'</sf>, <sf>'maxchar'</sf> => <sf>'16'</sf>), <sf><strong>'Şifre'</strong></sf>);

<kf>echo</kf> val::error(<sf>'string'</sf>);
<comment>
/* 
Çıktı-----------------

<strong>E-posta</strong> alanı geçersiz posta adresidir!
<strong>Şifre</strong> alanı en az 6 karakterden oluşmalıdır!
*
/</comment>
    </pre>
    </div>
    
    <p><strong>Şifre eşleşme</strong> kural parametresinin kullanımı aşağıdaki örnek kodda verilmiştir.</p>
    
    <div type="code">
    <pre>
import::library(<sf>'Validation'</sf> , <sf>'Method'</sf>);

method::post(<sf>'email'</sf>, <sf>'Yanlis E-posta'</sf>);
method::post(<sf>'sifre'</sf>, <sf>'1234'</sf>);
method::post(<sf>'sifre_tekrar'</sf>, <sf>'12345'</sf>);

<strong>val::rules</strong>(<sf>'sifre'</sf>, <kf>array</kf>(<sf>'match_password'</sf> => <sf>'sifre_tekrar'</sf>), <sf><strong>'Şifre'</strong></sf>);

<kf>echo</kf> val::error(<sf>'string'</sf>); <comment> // Şifreler uyumsuz!</comment>
    </pre>
    </div>
    <p>Şifre değiştirme işlemleri yapılırken <strong>eski şifrenin</strong> tekrar girmesi istenebilir bu durumdada şifre eşleşme benzeri yöntem uygulanır.</p>
    
    <div type="code">
    <pre>
import::library(<sf>'Validation'</sf> , <sf>'Method'</sf>);

method::post(<sf>'eski_sifre'</sf>, <sf>'123456'</sf>);
method::post(<sf>'sifre'</sf>, <sf>'1234'</sf>);
method::post(<sf>'sifre_tekrar'</sf>, <sf>'12345'</sf>);

<comment> // Eski şifre 123456 iken girilen değer 12345 dolayısı ile Eski şifre yanlış! hatası alacağız</comment>
<strong>val::rules</strong>(<sf>'eski_sifre'</sf>, <kf>array</kf>(<sf>'old_password'</sf> => <sf>'12345'</sf>), <sf><strong>'Eski Şifre'</strong></sf>);

<strong>val::rules</strong>(<sf>'sifre'</sf>, <kf>array</kf>(<sf>'match_password'</sf> => <sf>'sifre_tekrar'</sf>), <sf><strong>'Şifre'</strong></sf>);

<comment> // Ya da aşağıdaki gibi bir kullanım mümkündür</comment>

<strong>val::rules</strong>(<sf>'sifre'</sf>, <kf>array</kf>(<sf>'match'</sf> => <sf>'sifre_tekrar'</sf>), <sf><strong>'Şifre'</strong></sf>);

<kf>echo</kf> val::error(<sf>'string'</sf>); 
<comment> 
/*
Eski şifre yanlış!
Şifreler uyumsuz!
Şifre bilgileri uyumsuz!
*/</comment>
    </pre>
    </div>
    
    <p class="cstfont" id="val_nval">Kontrolleri Sağlanmış Veriyi Kullanmak</p>
    <p><ftype>val::nval( <kf>string</kf> <vf>$nesne</vf> )</ftype></p>
    <p>Bu yöntemin temel amacı gelen veriler güvenlik parametrelerinden geçildikten sonra verinin son halininin kullanılmasını sağlamaktır. Tek parametresi vardır oda gelen post değişkeninin adıdır.</p> 
    
    <p>
    	<table class="cfont">
        	<tr><th>Parametre</th><td>Anlamları</td></tr>
            <tr><th>1. Parametre = Nesne</th><td>Post veya diğer yöntemlerle gönderilen verinin ismi.</td></tr>
        </table>
    </p>
  
    <p>Aşağıda sql enjeksiyon içeren bir şifre bilgisi göndermeye çalışalım ve verinin bu yöntemle yeni değerine bakalım.</p>
    
    <div type="code">
    <pre>
import::library(<sf>'Validation'</sf> , <sf>'Method'</sf>);

method::post(<sf>'email'</sf>, <sf>'Yanlis E-posta'</sf>);
method::post(<sf>'sifre'</sf>, <sf>' or "1" = "1" '</sf>);

<strong>val::rules</strong>(<sf>'email'</sf>, <kf>array</kf>(<sf>'required'</sf>, <sf>'email'</sf>), <sf><strong>'E-posta'</strong></sf>);
<strong>val::rules</strong>(<sf>'sifre'</sf>, <kf>array</kf>(<sf>'nail_encode'</sf> , <sf>'trim'</sf>), <sf><strong>'Şifre'</strong></sf>);

<kf>echo</kf> val::nval(<sf>'sifre'</sf>);
<comment>
/* 
Çıktı-----------------

or \"1\" = \"1\"
*
/</comment>
    </pre>
    </div>
    
    <p><strong>nail_encode</strong> yöntemi veritabanı veya farklı türde saldırıların önüne geçilmesi için tırnak işaretlerini "\'" ve "\"" şeklinde dönüştürerek olası saldırıların önüne geçmiş olur.</p>
    
    <p>
    <div type="code">
    <pre>
import::library(<sf>'Validation'</sf> , <sf>'Method'</sf>);

method::post(<sf>'veri'</sf>, <sf>'<x><</x>script>alert(1);<x><</x>/script>'</sf>);

<strong>val::rules</strong>(<sf>'veri'</sf>, <kf>array</kf>(<sf>'nc_encode'</sf> , <sf>'trim'</sf>), <sf><strong>'Şifre'</strong></sf>);

<kf>echo</kf> val::nval(<sf>'veri'</sf>);
<comment>
/* 
Çıktı-----------------

[badwords]alert(1);[badwords]
*
/</comment>
    </pre>
    </div>
    </p>
    
    <p><strong>nc_encode</strong> parametresinin hangi kötü kodları temizlediğini görmek için <strong>Config/Security.php</strong> dosyasındaki <cf><vf>$config</f>[<sf>'Security'</sf>][<sf>"nc_bad_chars"</sf>]</cf> dizini inceleyebilirsiniz. Bu diziye isterseniz sizde temizlenmesini istediğiniz ifade ekleyebilirsiniz. Temizlenen kötü ifadelerin yerine gelecek ifadeyi belirlemek içinde <cf><vf>$config</f>[<sf>'Security'</sf>][<sf>"nc_change_bad_chars"</sf>]</cf> ibaresini düzenleyebilirsiniz. </p>
    
    <p>
    <div type="code">
    <pre>
import::library(<sf>'Validation'</sf> , <sf>'Method'</sf>);

method::post(<sf>'veri'</sf>, <sf>'<x><</x>script>alert(1);<x><</x>/script>'</sf>);

<strong>val::rules</strong>(<sf>'veri'</sf>, <kf>array</kf>(<sf>'html_encode'</sf> , <sf>'trim'</sf>), <sf><strong>'Şifre'</strong></sf>);

<kf>echo</kf> val::nval(<sf>'veri'</sf>);
<comment>
/* 
Çıktı-----------------

 Kaynak Kod: <x>&</x>lt;script<x>&</x>gt;alert(1);<x>&</x>lt;/script<x>&</x>gt;gt; Çıktı: <x><</x>script>alert(1);<x><</x>/script>
*
/</comment>
    </pre>
    </div>
    </p>
    
 	<p><strong>html_encode</strong> yöntemi html içerikli kodları dönüştürmek için kullanılır aslında yaptığı <x><</x> ve > karakterleri yerine <x>&</x>lt; ve <x>&</x>gt; karakterlerini eklemektir. Böylelikle olası sayfa yönlendirmeleri gibi script ataklarınında önüne geçilmiş olur. İsterseniz <strong>aynı anda birden fazla yöntemide bir arada kullanabilirsiniz</strong>.</p>
    
    <p>
    <div type="code">
    <pre>
import::library(<sf>'Validation'</sf> , <sf>'Method'</sf>);

method::post(<sf>'veri'</sf>, <sf>'<x><</x>script>alert("1");<x><</x>/script>'</sf>);

<strong>val::rules</strong>(<sf>'veri'</sf>, <kf>array</kf>(<sf>'nc_encode'</sf> , <sf>'nail_encode'</sf> , <sf>'trim'</sf>), <sf><strong>'Şifre'</strong></sf>);

<kf>echo</kf> val::nval(<sf>'veri'</sf>);
<comment>
/* 
Çıktı-----------------

[badwords]alert(\"1\");[badwords]
*
/</comment>
    </pre>
    </div>
    </p>
    
    <p><div type="important"><div>ÖNEMLİ</div><div>Şayet gelen veriler <strong>veritabanı ile ilişkili</strong> çalışıyorsa mutlaka <strong>nval()</strong> yöntemini kullanın.</div></div></p>
    
    
    <p class="cstfont" id="val_error">Validasyon Kontrol Kurallarına Uymayan Verilerin Hata Bilgisini Almak</p>
    <p><ftype>val::error( <kf>string</kf> <vf>$tur</vf> = <sf>'array'</sf> )</ftype></p>
    <p>Belirlenen kurallara uymayan veri ile ilgili hata bilgisi üretir. Tek parametresi vardır. Tür </p> 
    
    <p>
    	<table class="cfont">
        	<tr><th>Parametre</th><td>Anlamları</td></tr>
            <tr><th>1. Parametre = [Tür = 'array']</th><td>Dönecek bilginin tipi belirlenir varsayılan olarak <strong>array</strong> ayarlıdır.</td></tr>
            <tr><th>Tür Parametresinin Alabileceği Değerler</th><th>Anlamları</th></tr>
            <tr><th>array</th><td>Hata bilgilerini dizi olarak döndürür.</td></tr>
            <tr><th>string</th><td>Hata bilgilerini string bir metinsel ifade olarak döndürür.</td></tr>
            <tr><th>Nesne Adı</th><td>Hangi nesnenin hata bilgisi alınmak isteniyorsa o nesnenin adı girilir.</td></tr>
        </table>
    </p>
    <p>Şimdi validasyon işlemlerinin iyi anlaşılabilmesi için aşağıdaki örnek kod üzerinde inceleyelim.</p>
    
    <div type="code">
    <pre>
import::library(<sf>'Validation'</sf> , <sf>'Method'</sf>);

method::post(<sf>'email'</sf>, <sf>'bilgi@zntr.net'</sf>);
method::post(<sf>'sifre'</sf>, <sf>'zntr1234'</sf>);

<strong>val::rules</strong>(<sf>'email'</sf>, <kf>array</kf>(<sf>'required'</sf>, <sf>'email'</sf>), <sf>'E-posta'</sf>);
<strong>val::rules</strong>(<sf>'sifre'</sf>, <kf>array</kf>(<sf>'required'</sf>, <sf>'minchar'</sf> => <sf>'6'</sf>, <sf>'maxchar'</sf> => <sf>'16'</sf>), <sf>'Şifre'</sf>);

<comment> // ------------------------ String Parametresi Kullanılarak ----------------</comment>
<kf>echo</kf> val::error(<sf>'string'</sf>);
<comment>
/* 
Post değerleri boş gönderilirse aşağıdaki çıktı oluşacaktır.

E-posta alanı boş geçilemez!
E-posta alanı geçersiz posta adresidir!
Şifre alanı boş geçilemez!
Şifre alanı en az 6 karakterden oluşmalıdır!
*/
</comment>
<comment> // ------------------------ Array Parametresi Kullanılarak ----------------</comment>
<kf>echo</kf> val::error(<sf>'array'</sf>); <comment> // yada val::error();</comment>
<comment>
/* 

array (size=4)
  0 => string 'E-posta alanı boş geçilemez!' (length=31)
  1 => string 'E-posta alanı geçersiz posta adresidir!' (length=41)
  2 => string 'Şifre alanı boş geçilemez!' (length=30)
  3 => string 'Şifre alanı en az 6 karakterden oluşmalıdır!' (length=49)
*/
</comment>
<comment> // ------------------------ Nesne Adı Kullanılarak ----------------</comment>
<kf>echo</kf> val::error(<sf>'sifre'</sf>); <comment> // string 'Şifre alanı boş geçilemez!' (length=30)</comment>
    </pre>
    </div>
    
    <p>Hangi yöntem ihtiyacınızı karşılayacaksa onu seçebilirsiniz.</p>
    
    <p class="cstfont" id="val_post_back">Post Edilen Sayfa Sonrası Form Değerlerini Korumak val::post_back(<pf>string $nesne_adi</pf>);</p>
    <p><ftype>val::post_back( <kf>string</kf> <vf>$nesne_adi</vf> )</ftype></p>
    <p>Form araçları özelliklede yazı ve şifre kutuculakları sayfa post edildiğinde içindeki veriler silinmektedir özellikle de üye kayıt işlemlerinde şifreler yanlış girildiğinde ya da eksik bırakılan form araçları nedeniyle üzerine yazılan bilgiler silinir bilgiler hatalı veya eksik olduğunda bile ilk girilen <strong>verilerin sayfa yenilenmesi esnasında silinmemesi için</strong> bu yöntem kullanılır.</p>
    
    <p>
    Aşağıda bir form nesnesinin value değeri içerisine yazılmış bir fonksiyon görüyorsunuz. Sayfa yenilense dahi son değeri korunur ve value değeri silinmez.
    <div type="code"><kf>echo</kf> form::input(<sf>'sifre'</sf>, val::post_back(<sf>'sifre'</sf>));</div>
    </p>
 
    <div type="prev-next">
    	<div type="prev-btn"><a href="lib_user.html">Önceki</a></div><div type="next-btn"><a href="lib_xml.html">Sonraki</a></div>
    </div>
 
</body>
</html>              