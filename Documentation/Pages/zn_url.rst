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
    <div id="content-document"><a href="#">Döküman</a> » <a href="general_topic.html">Genel Konular</a> » ZN URL Yapıları</div> 
    <p class="ctfont">ZN URL Yapıları</p>
    <p>
    ZN kod çatısında URL <strong>temiz bir görünüm</strong> sunarken, <strong>enjeksiyonlara karşı güvenli</strong> ve <strong>arama motoru dostu</strong> bir yapı karşımıza çıkar. ZN de URL'ler fiziksel olarak bir sayfayı çalıştırmazlar. Esasen yaptıkları işlem, bir sınıfın fonksiyonunu çağırmaktır. Aşağıda örnek bir URL adresine yer verilmiştir.
    </p>
    <div type="code">
    ornek.com/<kf>haberler</kf>/<ff>detay</ff>/<sf>12</sf>
    </div>
   	
    <p class="cstfont">URL Bölümleri(Segmentleri)</p>
    <p>Controllers - Views Yönetim sisteminde yazılan URL adresleri, <strong>Controllers/</strong> dizini içerisindeki <strong>dosya(sınıf)</strong> ismi, bu sınıfın içindeki <strong>fonksiyon</strong> ismi ve bu fonksiyonun <strong>parametlerinden</strong> oluşur.</p>
    <div type="code">
    ornek.com/<kf>sınıf</kf>/<ff>fonksiyon</ff>/<sf>parametre1/parametre2...</sf>
    </div>
    <p>
    1-<kf>Birinci bölüm</kf> Controllers/ dizini içerisinde yer alan <kf>sınıfın</kf> adını belirtir.<br>
    2-<ff>İkinci bölüm</ff> sınıfın içerisinde yer alan <ff>fonksiyonun</ff> adını belirtir.<br>
    3-<sf>Üçüncü bölüm</sf> ve sonraki bölümler, fonksiyona gönderilen <sf>parametreyi</sf> veya parametreleri ifade eder.
    </p>
    
    <div type="important">
   		<div>Önemli</div>
        <div><strong>Controllers/haberler.php</strong> gibi bir sayfanız varsa, bu haberler sayfasının içerisinde yer alan <strong>sınıf ismininde, haberler</strong> olması gerekir. Yani <b>dosya ve sınıf ismi aynı olmak zorundadır</b>.</div>
    </div>
    
    <p class="cstfont">Index.php İfadesini Kaldırma</p>
    <p>Normalde URL de index.php ibaresi varsayılan ayar olarak bulunur. <strong>Config/Uri.php</strong> dosyasında herhangi bir ayarlama yapılmamış ise URL adresinin görünümü aşağıdaki gibi olur.</p>
    
    <div type="code">
    ornek.com/<sf><b>index.php</b></sf>/<kf>haberler</kf>/<ff>detay</ff>/<sf>12</sf>
    </div>
    
    <p>Index.php ibaresinin kaldırılması için, <strong>Config/Uri.php</strong> dosyasındaki <cf><sf>index.php</sf> = <kf>false</kf></cf> ve <strong>Config/Htaccess.php</strong> dosyasındaki <cf><sf>create_file</sf> = <kf>false</kf></cf> ayarlarının <strong class="keyfont">true</strong> olarak değiştirilmesi gerekir. Localde çalışıyorsanız ve serverinizde yeniden yazma modülü kapalı ise serverinizden gerekli yönlendirme ayarlarını aktif hale getirmeniz gereklidir.</p>
    <p>Bu ayarlardan sonra sistem otomatik olarak <b>.htaccess</b> dosyası oluşturacak ve yönlendirme işlemi yapılmış olacaktır. Sistemde tanımlı olan .htaccess dosyasının içeriği ise aşağıdaki şekildedir.</p>
     <div type="code">
<pre><x><</x>IfModule mod_rewrite.c>
RewriteEngine On
RewriteBase /
RewriteCond %{REQUEST_FILENAME} !-f
RewriteCond %{REQUEST_FILENAME} !-d
RewriteRule ^(.*)$  /index.php?/$1 [L]
<x><</x>/IfModule>
</pre>
    </div>
    
     <p class="cstfont">ZN Kod Çatısında GET Yönteminin Kullanımı</p>
     <p>ZN kod çatısında get yöntemi ile veri gönderip almak için URL adresini aşağıdaki örnekte olduğu gibi düzenleyebilirsiniz.</p>
     
    <div type="code">
    ornek.com/index.php/urunler/detay<strong>?<strong class="varfont">u</strong>=<strong class="strfont">urun</strong>&amp;<strong class="varfont">f</strong>=<strong class="strfont">fiyat</strong>&amp;<strong class="varfont">id</strong>=<strong class="strfont">19</strong></strong>
    </div>
    <p></p>
     
    <div type="prev-next">
    	<div type="prev-btn"><a href="general_topic.html">Önceki</a></div><div type="next-btn"><a href="management.html">Sonraki</a></div>
    </div>
 
</body>
</html>              