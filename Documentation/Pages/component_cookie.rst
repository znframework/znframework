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
    <div id="content-document"><a href="#">Döküman</a> » <a href="components.html">Bileşenler</a> » Cookie(Çerez) Bileşeni</div> 
    <p class="ctfont">Cookie(Çerez) Bileşeni</p>
    <p>Çerez işlemlerini yapmak için oluşturulmuştur .</p>
    <ul><li><a href="#" class="infont">Çerez Bileşenini ve Yöntemleri</a><br><br>
        <ul>
        	<li><a href="#cookie_import">Çerez Bileşenini Dahil Etmek</b></a></li>
            <li><a href="#cookie_others">Çerez Bileşeni Yöntemleri</b></a></li>          
        </ul>
    </li></ul>
    
    <p class="cstfont" id="cookie_import">Çerez Bileşenini Dahil Etmek</p>
	<div type="code">import::component(<sf>'Cookie'</sf>)</div> 	
    
    <p class="cstfont" id="cookie_others">Çerez Bileşeni Yöntemleri</p>
    <p>Çerez bileşenine ait yöntemler aşağıdaki tabloda listelenmiştir</p>
    
  	<p>
    <table class="cfont">
    	<tr><th>Çerez Oluşturma Yöntemleri</th><td>Anlamları</td><td>Kullanımları</td></tr>
        <tr><td><cf>name( <vf>$ad</vf> )</cf></td><td>Çerez ismi.</td><td><cf><vf>$this</vf>->cook->name(<sf>'Çerez Adı'</sf>)</cf></td></tr>
        <tr><td><cf>value( <vf>$deger</vf> )</cf></td><td>Çerez değeri.</td><td><cf>->value(<sf>'Değer'</sf>)</cf></td></tr>
        <tr><td><cf>time( <vf>$zaman</vf> = <if>604800</if> )</cf></td><td>Çerez süresi.</td><td><cf>->time(<sf>64800</sf>)</cf></td></tr>	
        <tr><td><cf>path( <vf>$yol</vf> = <sf>'/'</sf> )</cf></td><td>Çerez dizini.</td><td><cf>->path(<sf>'/cerezler'</sf>)</cf></td></tr>
        <tr><td><cf>domain( <vf>$domain</vf> = <sf>'/'</sf> )</cf></td><td>Çerezin geçerli olacağı site.</td><td><cf>->domain(<sf>'http://xxx.xxx.xxx/'</sf>)</cf></td></tr>
        <tr><td><cf>secure( <vf>$domain</vf> = <kf>false</kf> )</cf></td><td>Güvenli kullanım.</td><td><cf>->secure(<kf>true</kf>)</cf></td></tr>
        <tr><td><cf>httponly( <vf>$http</vf> = <kf>true</kf> )</cf></td><td>Sadece web kullanımı için.</td><td><cf>->httponly(<kf>false</kf>)</cf></td></tr>
        <tr><td><cf>regenerate( <vf>$regenere</vf> = <kf>true</kf> )</cf></td><td>PHPSESSID şifrelemek.</td><td><cf>->regenerate(<kf>true</kf>)</cf></td></tr>
        <tr><td><cf>encode( <vf>$anahtar_hash_algo</vf> , <vf>$deger_hash_algo</vf> )</cf></td><td>Çerezi şifrelemek için kullanılır. 2 parametresi vardır. 1. parametre çerezin anahtar değerini, 2. parametre çerezin tuttuğu veriyi şifrelemek için kullanılır. Bu yöntemin kullanımı isteğe bağlıdır. Sadece anahtar veya sadece değer bilgisini şifreleyebilirsiniz.</td><td><cf>->encode(<sf>'md5'</sf>, <sf>'sha1'</sf>)</cf></td></tr>
        <tr><td><cf>create( [ <vf>$name</vf> ] , [ <vf>$value</vf> ] )</cf></td><td>Çerez oluşumunu tamamlama yöntemidir. Ancak isteğe bağlı olarak isim veya değer bilgisi içerebilir.</td><td><cf>->create(<sf>'cerez'</sf>, <sf>'Değer'</sf>); <comment>// Sonlandırma komutu</comment></cf></td></tr>
    </table>
    </p>
    
    <p>Yukarıdaki yöntemlerin kullanımına yönelik örnekler aşağıda verilmiştir.</p>
    
    <p>
    <strong>Kısayoldan</strong> çerez oluşturmak için;
    <div type="code">
    <vf>$this</vf>->cook->create(<sf>'ornek_isim'</sf>, <sf>'Örnek Değer'</sf>);
    </div>
    </p>
    
    <p>
    İsim ve değer için <strong>yöntem</strong> kullanma;
    <div type="code">
    <vf>$this</vf>->cook->name(<sf>'ornek_isim'</sf>)->value(<sf>'Örnek Değer'</sf>)->create();
    </div>
    </p>
    
    <p>
    Çerez için <strong>zaman</strong> belirtmek;
    <div type="code">
    <vf>$this</vf>->cook->name(<sf>'ornek_isim'</sf>)->value(<sf>'Örnek Değer'</sf>)->time(<if>3600</if>)->create();
    </div>
    </p>
    
    <p>
    Çerezi <strong>şifrelemek</strong>;
    <div type="code">
    <vf>$this</vf>->cook->encode(<sf>'sha1'</sf>)->create(<sf>'ornek_isim'</sf>, <sf>'Örnek Değer'</sf>);
    </div>
    </p>
    
  	<p>
    <table class="cfont">
    	<tr><th>Çerezi Kullanma Yöntemleri</th><td>Anlamları</td><td>Kullanımları</td></tr>
        <tr><td><cf>name( <vf>$ad</vf> )</cf></td><td>Çerez ismi.</td><td><cf><vf>$this</vf>->cook->name(<sf>'cerez'</sf>)</cf></td></tr>
        <tr><td><cf>decode( <vf>$anahtar_hash_algo</vf> )</cf></td><td>Anahtarı şifrelenen çerezi kullanabilmek için kullanılır. Hangi algoritma ile şifrelenmişse o algoritma ile kullanılmak durumundadır.</td><td><cf>->decode(<sf>'md5'</sf>)</cf></td></tr>
        <tr><td><cf>select( [ <vf>$name</vf> ] )</cf></td><td>Çerez seçimini tamamlama yöntemidir. Ancak isteğe bağlı olarak isim bilgisi içerebilir.</td><td><cf>->select(<sf>'cerez'</sf>); </cf></td></tr>
    </table>
    </p>
    
    <p>
    <strong>Kısayoldan</strong> çerezi kullanmak için;
    <div type="code">
    <vf>$this</vf>->cook->select(<sf>'ornek_isim'</sf>); <comment>// Örnek Çerez</comment>
    </div>
    </p>
    
    <p>
    <strong>Şifrelenmiş</strong> çerezi kullanmak için;
    <div type="code">
    <vf>$this</vf>->cook->decode(<sf>'sha1'</sf>)->select(<sf>'ornek_isim'</sf>); <comment>// Örnek Çerez</comment>
    </div>
    </p>
    
    <p>
    <strong>Tüm oluşturulumuş</strong> çerezleri listelemek;
    <div type="code">
    <vf>$this</vf>->cook->select(); <comment>// Parametre belirtilmediği taktirde daha önce oluşturulmuş tüm çerezlerin listesini verir.</comment>
    </div>
    </p>
    
    
    <p>
    <table class="cfont">
    	<tr><th>Çerezi Silme Yöntemleri</th><td>Anlamları</td><td>Kullanımları</td></tr>
        <tr><td><cf>name( <vf>$ad</vf> )</cf></td><td>Çerez ismi.</td><td><cf><vf>$this</vf>->cook->name(<sf>'cerez'</sf>)</cf></td></tr>
        <tr><td><cf>path( <vf>$yol</vf> = <sf>'/'</sf> )</cf></td><td>Çerez dizini.</td><td><cf>->path(<sf>'/cerezler'</sf>)</cf></td></tr>
        <tr><td><cf>decode( <vf>$anahtar_hash_algo</vf> )</cf></td><td>Anahtarı şifrelenen çerezi kullanabilmek için kullanılır. Hangi algoritma ile şifrelenmişse o algoritma ile kullanılmak durumundadır.</td><td><cf>->decode(<sf>'md5'</sf>)</cf></td></tr>
        <tr><td><cf>delete( [ <vf>$name</vf> ] )</cf></td><td>Çerez silme işlemini tamamlama yöntemidir. Ancak isteğe bağlı olarak isim bilgisi içerebilir.</td><td><cf>->delete(<sf>'cerez'</sf>); </cf></td></tr>
    </table>
    </p>
    
    <p>
    <strong>Kısayoldan</strong> çerezi silmek için;
    <div type="code">
    <vf>$this</vf>->cook->delete(<sf>'ornek_isim'</sf>); 
    </div>
    </p>
    
    <p>
    <strong>Şifrelenmiş</strong> çerezi silmek için;
    <div type="code">
    <vf>$this</vf>->cook->decode(<sf>'sha1'</sf>)->delete(<sf>'ornek_isim'</sf>); <comment>// Örnek Çerez</comment>
    </div>
    </p>
    
    <p>
    <strong>Tüm oluşturulumuş</strong> çerezleri silmek için;
    <div type="code">
    <vf>$this</vf>->cook->delete(); <comment>// Parametre belirtilmediği taktirde daha önce oluşturulmuş tüm çerezlerin silinmesini sağlar.</comment>
    </div>
    </p>
    
    
    <div type="prev-next">
    	<div type="prev-btn"><a href="components.html">Önceki</a></div><div type="next-btn"><a href="component_css.html">Sonraki</a></div>
    </div>
 
</body>
</html>              