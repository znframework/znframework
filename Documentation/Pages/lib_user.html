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
    <div id="content-document"><a href="#">Döküman</a> » <a href="libraries.html">Kütüphaneler</a> » User(Kullanıcı) Sınıfı</div> 
    <p class="ctfont">User(Kullanıcı) Sınıfı</p>
    <p>Kullanıcılar veya üyelerle ilgili bir takım işlemlerin yapıldığı sınıftır. Yeni üyelik, siteye giriş, aktivasyon, üye bilgilerini kullanma gibi işevleri vardır.</p>
    <ul><li><a href="#" class="infont">User(Kullanıcı) Sınıfı ve Yöntemleri</a><br><br>
        <ul>  
        	<li><a href="#user_import">User Kütüphanesini Dahil Etmek</a></li>
        	<li><a href="#user_config">User Sınıfını Veritabanıyla İlişkilendirmek ve Konfigürasyon Dosyasını Yapılandırmak</b></a></li>
        	<li><a href="#user_register">Siteye Kayıt Olmak » <b>user::register()</b></a></li>
            <li><a href="#user_login">Siteye Giriş Yapmak » <b>urer::login()</b></a></li>
            <li><a href="#user_update">Üyelik Bilgilerini Güncellemek » <b>user::update()</b></a></li> 
            <li><a href="#user_logout">Üyelik Oturumunu Kapatmak » <b>user::logout()</b></a></li> 
            <li><a href="#user_is_login">Üye Girişinin Yapılıp Yapılmadığını Kontrol Etmek » <b>user::is_login()</b></a></li>
            <li><a href="#user_data">Oturum Açan Üyenin Bilgilerine Ulaşmak » <b>user::data()</b></a></li>
            <li><a href="#user_forgot_password">Şifremi Unuttum Sistemi Oluşturmak » <b>user::forgot_password()</b></a></li>
            <li><a href="#user_activation_complete">Aktivasyon İşlemini Tamamlamak » <b>user::activation_complete()</b></a></li>
            <li><a href="#user_error">Üye İşlemleri Esnasında Oluşan Hataları Öğrenmek » <b>user::error()</b></a></li>
            <li><a href="#user_success">Üye İşlemlerinin Başarı İle Tamamlandığı Bilgisini Almak » <b>user::success()</b></a></li>
           
        </ul>
    </li></ul>
    
    <p class="cstfont" id="user_import">User Kütüphanesini Dahil Etmek</p>
    <div type="code">
  	import::library(<sf>'User'</sf>);
    </div>
    
    <p class="cstfont" id="user_config">User Sınıfını Veritabanıyla İlişkilendirmek ve Konfigürasyon Dosyasını Yapılandırmak</p>
    <p>Kullanıcı işlemleri veritabanı kaydı gerektirdiğinden bazı tablo ve sütun bilgilerini konfigürasyon dosyasından ayarlamak gerekmektedir. Bu ayarlar düzgün yapıldığında sınıfı sorunsuzca kullanabilirsiniz. Aşağıda User sınıfına ait konfigürasyon dosyasının içeriğine yer verilmiştir.</p> 
    
    <p><strong>Config/User.php</strong> dosyasını açtığınızda aşağıdaki ayarları göreceksiniz.</p>
    <p>
    <div type="code">
<pre>
<vf>$config</vf>[<sf>"User"</sf>][<sf>"table_name"</sf>] 		= <sf>""</sf>;	// Sınıfın bağlanacağı tablo adı
<vf>$config</vf>[<sf>"User"</sf>][<sf>"username_column"</sf>] 	= <sf>""</sf>;	// varchar içerikli sütun
<vf>$config</vf>[<sf>"User"</sf>][<sf>"password_column"</sf>]  	= <sf>""</sf>;	// varchar içerikli sütun
<vf>$config</vf>[<sf>"User"</sf>][<sf>"email_column"</sf>]  	= <sf>""</sf>;	// varchar içerikli sütun kullanımı zorunlu değildir.
<vf>$config</vf>[<sf>"User"</sf>][<sf>"active_column"</sf>]	= <sf>""</sf>; 	// 0 veya 1 değeri alan sütun kullanımı zorunlu değil ancak kullanılmayacaksa boş bırakılmalıdır.
<vf>$config</vf>[<sf>"User"</sf>][<sf>"banned_column"</sf>]	= <sf>""</sf>; 	// 0 veya 1 değeri alan sütun kullanımı zorunlu değil ancak kullanılmayacaksa boş bırakılmalıdır.
<vf>$config</vf>[<sf>"User"</sf>][<sf>"activation_column"</sf>] 	= <sf>""</sf>;   // 0 veya 1 değeri alan sütun kullanımı zorunlu değil ancak kullanılmayacaksa boş bırakılmalıdır.
</pre>
    </div>
    </p>
    <p>Şimdi yukarıdaki ayarları tek tek açıklayalım.</p>
 	<div type="code">
    <pre><vf>$config</vf>[<sf>"User"</sf>][<sf>"table_name"</sf>] = <sf>"uyeler"</sf>;</pre>
    User sınıfının bağlantı kuracağı kullanıcı bilgilerini tutulduğu veya tutulacak olan tablo adını giriyoruz. Bizim uyeler adında üyelerin bilgilerin tutulduğu bir tablomuz olduğunu varsayalım. Bu tablomuzda da <strong>şu sütunlar</strong> olsun:<br> 
    <strong>ÜYELER TABLOSUNA AİT SÜTUNLAR</strong>,<br>
    <strong>-------------------------------------------</strong><br>
    <strong>1-id</strong>,<br>
    <strong>2-kullanici_adi</strong>,<br> 
    <strong>3-sifre</strong>, <br> 
    <strong>4-eposta</strong>, <br> 
    <strong>5-isim</strong>, <br> 
    <strong>6-soyisim</strong>, <br> 
    <strong>7-aktif</strong>, <br> 
    <strong>8-banli</strong>, <br> 
    <strong>9-kayit_tarihi</strong>, <br> 
    <strong>10-aktivasyon</strong>
    </div>
    <p></p>
    <div type="code">
    <pre><vf>$config</vf>[<sf>"User"</sf>][<sf>"username_column"</sf>] = <sf>"kullanici_adi"</sf>;</pre>
	Site içinde kullanılacak kullanıcı adlarının tutulacağı kullanıcı adı sütununu belirlememiz gerekir. Yukarıda oluşturduğumuz uyeler tablosunda kullanıcı adı olarak kullanılacak sütun <strong>kullanici_adi</strong> olarak belirlenmiştir. Bu nedenle ayarın karşısına bu ifadeyi yazdık.
    </div>
    
    <p></p>
    <div type="code">
    <pre><vf>$config</vf>[<sf>"User"</sf>][<sf>"password_column"</sf>] = <sf>"sifre"</sf>;</pre>
	Kullanıcıların şifrelerininde tutulduğu bir sütun olmalıdır bu sütun adı ne ise ayarın karşısına o sütun adını yazarız. Yukarıda oluşturduğumuzu varsaydığımız tabloyu incelersek şifre bilgilerinin tutulacağı sütun adını <strong>sifre</strong> olarak oluşturduk bu nedenle ayarın karşısınada bu ifadeyi yazdık.
    </div>
    
     <p></p>
    <div type="code">
    <pre><vf>$config</vf>[<sf>"User"</sf>][<sf>"email_column"</sf>] = <sf>"eposta"</sf>;</pre>
	Bu sütun kullanıcı adı sütunu e-posta bilgisi içermeyecekse kullanılır. <strong>Aktivasyon veya şifre hatırlatma yöntemlerini kullanabilmek için veritabanının bir e-posta bilgisi tutan sütuna ihtiyacı vardır</strong> genel olarak bu sütun günümüz uygulamalarında kullanıcı adı sütunudur ancak bu sütun e-posta bilgisi içermiyorsa o halde e-posta bilgisini tutacak sütunun adı bu alana girilmelidir.
    </div>
    
    <p></p>
    <div type="code">
    <pre><vf>$config</vf>[<sf>"User"</sf>][<sf>"active_column"</sf>] = <sf>"aktif"</sf>;</pre>
	Bu ayarın kullanımı <strong>zorunlu değildir</strong> şayet kullanmayı tercih etmiyorsanız <strong>boş</strong> bırakmanız gerekmektedir ancak yukarıda oluşturuduğumuz üyeler tablosunda <strong>aktif</strong> adında bir sütuna yer verdik bu sütun <strong>0 ve 1</strong> değerlerinden oluşan bir veri türü içermelidir. İşlevi kullanıcıların o an için aktif olup olmadığı bilgisini öğrenmektir.
    </div>
    
  	<p></p>
    <div type="code">
    <pre><vf>$config</vf>[<sf>"User"</sf>][<sf>"banned_column"</sf>] = <sf>"banli"</sf>;</pre>
	Bu ayarın kullanımı <strong>zorunlu değildir</strong> şayet kullanmayı tercih etmiyorsanız <strong>boş</strong> bırakmanız gerekmektedir ancak yukarıda oluşturuduğumuz üyeler tablosunda <strong>banli</strong> adında bir sütuna yer verdik bu sütun <strong>0 ve 1</strong> değerlerinden oluşan bir veri türü içermelidir. İşlevi eğer bir kullanıcı banlanmışsa yani sütun değeri 1 olmuş ise o kullanıcın siteye girişine izin vermemektir.
    </div>
    
    <p></p>
    <div type="code">
    <pre><vf>$config</vf>[<sf>"User"</sf>][<sf>"activation_column"</sf>] = <sf>"aktivasyon"</sf>;</pre>
	Bu ayarın kullanımı <strong>zorunlu değildir</strong> şayet kullanmayı tercih etmiyorsanız <strong>boş</strong> bırakmanız gerekmektedir ancak yukarıda oluşturuduğumuz üyeler tablosunda <strong>aktivasyon</strong> adında bir sütuna yer verdik bu sütun <strong>0 ve 1</strong> değerlerinden oluşan bir veri türü içermelidir. İşlevi kullanıcı kayıt olduktan sonra aktivasyon işlemi gerçekleştirsin mi'dir.
    </div>
   
    
    <p>Ayarlarımızı yapılandırdığımıza göre User sınıfı ve yöntemlerini anlatamaya başlayabiliriz.</p>
    
    <p class="cstfont" id="user_register">Siteye Kayıt Olmak</p>
    <p><ftype>user::register( <kf>array</kf> <vf>$kayit_bilgileri</vf> , [ <kf>string</kf> <vf>$aktivasyon_donus_urisi</vf> ] )</ftype></p>
    <p>Üyelerin kayıtlarını oluşturan yöntemdir tek bir dizi parametresi vardır. Kayıt Bilgileri.</p> 
    
    <p>
    	<table class="cfont">
        	<tr><th>Parametre</th><td>Anlamları</td></tr>
            <tr><th>1. Parametre = Kayıt Bilgileri</th><td>Veritabanına kayıt yapılacak veriler.</td></tr>
            <tr><th>2. Parametre = [ Aktivasyon Dönüş Linki ]</th><td>Aktivasyon işlemi yapılacaksa bu parametre girilir. Örnek: kayit/aktivasyon</td></tr>
        </table>
    </p>
    
    <p><strong>Active</strong>, <strong>banned</strong> ve <strong>activasyon</strong> sütunlarını  User sınıfı kendi kullanmaktadır bu yüzden bizim bu sütunlarla işimiz olmayacak.</p>
    
    <div type="code">
    <pre>
import::library(<sf>'User'</sf>);

<comment> // Bu bilgilerin form nesnelerinden geldiğini varsayalım.</comment>

<vf>$bilgiler</vf> = <kf>array</kf>(
    <sf>'kullanici_adi'</sf> 	=> <sf>'bilgi@zntr.net'</sf>,
    <sf>'sifre'</sf>		=> <sf>'zntr1234'</sf>,
    <sf>'eposta'</sf>		=> <sf>'eposta@zntr.net'</sf>,
    <sf>'isim'</sf>		=> <sf>'Ozan'</sf>,
    <sf>'soyisim'</sf>		=> <sf>'UYKUN'</sf>
);

user::register(<vf>$bilgiler</vf>, <sf>'kayit/aktivasyon/kullanici'</sf>);

<ff>var_dump</ff>(user::error()); <comment> // boolean false</comment>
<ff>var_dump</ff>(user::success()); <comment> // string 'Kaydınızı başarı ile tamamlandı.' (length=38)</comment>
<comment>
/*
Aktivasyon e-postası kullanıcıya ulaşmıssa e-posta içinde şöyle bir url ile kaşılacak. 
http://www.ornek.com/index.php/kayit/aktivasyon/kullanici/bilgi@zntr.net/8fe8456bd262ee215555b1fc2d2f76a08
*/
</comment>
<img src="../Images/Result/user.PNG" />
    </pre>
    </div>
    
    <p>Görüldüğü gibi konfigürasyon ayarları yapıldıktan sonra bir üyenin kayıt olması işlemi bu kadar basittir. Tabi burada herhangi bir gelen veri kontrolü yapılmamıştır bu kontrolü <strong>Validation</strong> sınıfını anlatırken değineceğiz siz formlardan gelen verileri validasyon kontrolüne tabi tutmalısınız.</p>
    
    <div type="important"><div>ÖNEMLİ</div><div>Kullanıcı kaydı yapılırken kullanıcı şifreleri, <strong>Encode</strong> kütüphanesine ait <strong><cf>super()</cf></strong> yöntemi kullanılarak yeniden şifrelenir. Sizin başka bir şifreleme yöntemi kullanmanıza gerek yoktur.</div></div>
    
    <p class="cstfont" id="user_login">Siteye Giriş Yapmak</p>
    <p><ftype>user::login( <kf>string</kf> <vf>$kullanici_adi</vf> , <kf>string</kf> <vf>$sifre</vf> , [ <kf>boolean</kf> <vf>$beni_hatirlasin_mi</vf> = <kf>false</kf> ] )</ftype></p>
    <p>Üyelerin kayıtlarını oluşturan yöntemdir tek bir dizi parametresi vardır. Kayıt Bilgileri.</p> 
    
    <p>
    	<table class="cfont">
        	<tr><th>Parametre</th><td>Anlamları</td></tr>
            <tr><th>1. Parametre = Kullanıcı Adı</th><td>Sisteye giriş yapılacak kullanıcı adı.</td></tr>
            <tr><th>2. Parametre = Şifre</th><td>Siteye giriş için gerekli olan kullanıcı şifresi.</td></tr>
            <tr><th>3. Parametre = [Beni Hatırlasın Mı = false]</th><td>Bir sonraki giriş için kullanıcı adı hatırlansın mı?</td></tr>
        </table>
    </p>
    
    <div type="code">
    <pre>
import::library(<sf>'User'</sf>);

<comment> // Bu bilgilerin form nesnelerinden geldiğini varsayalım.</comment>

user::login(<sf>'bilgi@zntr.net'</sf>, <sf>'zntr1234'</sf>); <comment> // Az önce oluşturduğumuz kullanıcı adı ve şifre bilgisini burada veri olarak giriyoruz.</comment>

<ff>var_dump</ff>(user::error()); <comment> // boolean false</comment>
<ff>var_dump</ff>(user::success()); <comment> // string 'Başarı ile giriş yaptınız. Yönlendiriliyorsunuz.. Lütfen bekleyin.' (length=73)</comment>
    </pre>
    </div>
    
    <p class="cstfont" id="user_update">Üyelik Bilgilerini Güncellemek</p>
    <p><ftype>user::update( <kf>string</kf> <vf>$eski_sifre</vf> , <kf>string</kf> <vf>$yeni_sifre</vf> , [ <kf>string</kf> <vf>$yeni_sifre_tekrar</vf> ] , [ <kf>array</kf> <vf>$diger_bilgiler</vf> ] )</ftype></p>
    <p>Bu yöntemin esas işlevi üyenin şifre bilgilerinin güncellemesidir ancak istenirse şifre güncellenirken yanında başka verilerilerin güncellenmesinede olanak sağlar.</p> 
    
    <p>
    	<table class="cfont">
        	<tr><th>Parametre</th><td>Anlamları</td></tr>
            <tr><th>1. Parametre = Eski Şifre</th><td>Kullanıcının eski şifresi.</td></tr>
            <tr><th>2. Parametre = Yeni Şifre</th><td>Kullanıcının yeni şifresi.</td></tr>
            <tr><th>3. Parametre = [Yeni Şifre Tekrar]</th><td>Yeni şifrenin tekrarı girilmezse Yeni Şifre parametresinin değerini alır.</td></tr>
            <tr><th>4. Parametre = [Diğer Bilgiler]</th><td>Güncellenmek istenen başka veriler varsa bu parametreye dizi olarak girilir.</td></tr>
        </table>
    </p>
    
    <div type="code">
    <pre>
import::library(<sf>'User'</sf>);

<comment> // Bu bilgilerin form nesnelerinden geldiğini varsayalım.</comment>

<vf>$bilgiler</vf> = <kf>array</kf>(
    <sf>'isim'</sf> => <sf>'OZAN'</sf>,
    <sf>'eposta'</sf> => <sf>'ozan@zntr.net'</sf>
);
<comment>// param1 = eski şifre, param2 = yeni şifre, param3 = yeni şifre tekrar, param4 = diğer bilgiler.</comment>
user::update(<sf>'zntr1234'</sf>, <sf>'zntr12'</sf>, <sf>'zntr12'</sf>, <vf>$bilgiler</vf>);

<ff>var_dump</ff>(user::error()); <comment> // boolean false</comment>
<ff>var_dump</ff>(user::success()); <comment> // string 'Güncelleme işlemi başarılı.' (length=32)</comment>

<img src="../Images/Result/user1.PNG" />
    </pre>
    </div>
    
    
    <p class="cstfont" id="user_logout">Üyelik Oturumunu Kapatmak</p>
    <p><ftype>user::logout()</ftype></p>
    <p>Aktif kullanıcının oturumunu sonlandırmak için kullanılır.</p> 
    
    
    <div type="code">
    <pre>
import::library(<sf>'User'</sf>);

<comment> // Bu bilgilerin form nesnelerinden geldiğini varsayalım.</comment>

user::logout(); <comment> // Bu satır itibari ile oturum sonlandırılmıştır.</comment>

<ff>var_dump</ff>(user::error()); <comment> // boolean false</comment>
<ff>var_dump</ff>(user::success()); <comment> // boolean false</comment>
    </pre>
    </div>
    
    
    <p class="cstfont" id="user_is_login">Üye Girişinin Yapılıp Yapılmadığını Kontrol Etmek</p>
    <p><ftype>user::is_login()</ftype></p>
    <p>Kullanıcının siteye giriş yapıp yapmadığı bilgisini verir eğer giriş yapmış ise true değeri döner aksi halde false değeri döner.</p> 
    
    
    <div type="code">
    <pre>
import::library(<sf>'User'</sf>);

<comment> // Bu bilgilerin form nesnelerinden geldiğini varsayalım.</comment>

<kf>if</kf>(user::is_login()) 
	<kf>echo</kf> <sf>"Kullanıcı sitede aktif"</sf>;
<kf>else</kf> 
	<kf>echo</kf> <sf>"Kullanıcı aktif değil"</sf>;
    
<comment> // Az önce user::logout() ile çıkış yapıldığından Çıktı: Kullanıcı aktif değil olacaktır.</comment>
    </pre>
    </div>
    
    
    <p class="cstfont" id="user_data">Oturum Açan Üyenin Bilgilerine Ulaşmak</p>
    <p><ftype>user::data()</ftype></p>
    <p>Giriş yapan kullanıcıların üyelik bilgilerine ulaşmak için kullanılır. Bilgiler object veri tipinde dönmektedir.</p> 
    
    
    <div type="code">
    <pre>
import::library(<sf>'User'</sf>);

<comment> // Bu bilgilerin form nesnelerinden geldiğini varsayalım.</comment>

user::login(<sf>'bilgi@zntr.net'</sf>, <sf>'zntr12'</sf>);

<ff>var_dump</ff>(user::data());

<kf>echo</kf> user::data()->kullanici_adi;
    
<comment>
/*
object(stdClass)[2]
  public 'id' => string '1' (length=1)
  public 'kullanici_adi' => string 'bilgi@zntr.net' (length=14)
  public 'sifre' => string 'd21167868a1f8578a3a76667cc81a533' (length=32)
  public 'eposta' => string 'ozan@zntr.net' (length=13)
  public 'isim' => string 'OZAN' (length=4)
  public 'soyisim' => string 'UYKUN' (length=5)
  public 'aktif' => string '1' (length=1)
  public 'banli' => string '0' (length=1)
  public 'kayit_tarihi' => string '' (length=0)
  public 'aktivasyon' => string '0' (length=1)
  
bilgi@zntr.net
*/
</comment>
    </pre>
    </div>
    
    
    <p class="cstfont" id="user_forgot_password">Şifremi Unuttum Sistemi Oluşturmak</p>
    <p><ftype>user::forgot_password( <kf>string</kf> <vf>$eposta_adresi</vf> , [ <kf>string</kf> <vf>$geri_donus_url_adresi</vf> ] )</ftype></p>
    <p>Kullanıcıların şifrelerini unutmaları durumunda kullanıcıların e-posta adreslerine yeni şifrelerinin gönderimini sağlar.</p> 
    
    <p>
    	<table class="cfont">
        	<tr><th>Parametre</th><td>Anlamları</td></tr>
            <tr><th width="400">1. Parametre = E-posta Adresi</th><td>Yeni şifrenin gönderileceği e-posta adresi girilir.</td></tr>
            <tr><th>2. Parametre = [Geri Dönüş URL Adresi]</th><td>Gelen şifremi unuttum e-postası açıldığında içerisinde dönüş için bir link olacak onun belirlenmesini sağlar. Örnek kullanici/giris</td></tr>
        </table>
    </p>
    
    <div type="code">
    <pre>
import::library(<sf>'User'</sf>);

<comment> // Bu bilgilerin form nesnelerinden geldiğini varsayalım.</comment>

<comment> // param1 = e-posta adresi, param2 = http://www.ornek.com/index.php/kullanici/giris.</comment>
user::forgot_password(<sf>'bilgi@zntr.net'</sf>, <sf><strong>'kullanici/giris'</strong></sf>); 
<comment> // 1. Parametre  e-posta.</comment>
<comment> // 2. Parametre'nin esas değeri = http://www.ornek.com/index.php/<strong>kullanici/giris</strong> şeklinde e-posta içeriğine siteye dönüş linki olarak yansıyacaktır.</comment>
<ff>var_dump</ff>(user::success()); <comment> // string 'E-posta başarı ile gönderildi.' (length=22)</comment>
<ff>var_dump</ff>(user::error()); <comment> // boolean false</comment>
    </pre>
    
    </div>
    
    <p>Yeni şifreyi gönderebilmek için önce e-posta sütununa bakılır böyle bir sütun yok ise kullanıcı adı sütununa bakılır kullanıcı adı sütunuda e-posta bilgisi içermiyorsa yeni şifre gönderim işlemi tamamlanamaz ve <strong>"sistemde kayıtlı değilsiniz hatası"</strong> alırsınız.</p>
	
    <p class="cstfont" id="user_activation_complete">Aktivasyon İşlemini Tamamlamak</p>
    <p><ftype>user::activation_complete()</ftype></p>
    <p>Eğer aktivasyon işlemi kullanılmışsa user::register() yönteminin ikinci parametresinde dönüş yolu verilir işte bu dönüş yolu aktivasyon işleminin tamamlanacağı sayfanın ta kendisidir. E-posta adresine gönderilen aktivasyon linkine tıklayan kullanıcı sizin belirlediğiniz sayfaya yönlenir bu sayfaya gelen kullanıcının aktivasyon işleminin tamamlanmış olması için bu sayfada <strong>user::activation_complete(</strong>) fonksiyonun kullanılmış olması gerekir. Aktivasyon işlemi başarılı olursa yöntemin döndüreceği değerler başarılı olursa <cf class="keyfont">true</cf>  aksi halde <cf class="keyfont">false</cf> değerleridir. Yani bu yöntemi dönüş sayfasında uygun bir yerde kullanmanız gerekmektedir herhangi bir parametre gerekmez gerekli işlemi yöntemin kendisi yapar.</p> 
    

    
    <div type="code">
   	user::activation_complete();
    </div>
    
   
    <div type="prev-next">
    	<div type="prev-btn"><a href="lib_uri.html">Önceki</a></div><div type="next-btn"><a href="lib_val.html">Sonraki</a></div>
    </div>
 
</body>
</html>              