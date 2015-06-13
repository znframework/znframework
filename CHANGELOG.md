<h4>Kodların Yazımında camelCase Notasyonu Kullanıldı</h4>
<p>ZN Framework 2 Sınıf ve yöntem tanımlamalarında camelCase notasyonu kullanılmıştır.</p>

<h4>Kütüphane ve Bileşenler İçin Import(Dahil Etme) Zorunluluğu Kaldırıldı</h4>
<p>2 Sürümü ile artık hiç bir kütüphane veya bileşen kullanmak için dahil etme zorunluluğu kaldırıldı. Dilediğiniz yerde kütüphaneleri doğrunda kullanabilirsiniz.</p>

<h4>Config/Autoload.php ve Config/Libraires.php Ayar Dosyaları Kaldırıldı</h4>
<p>Bu sürümde bu dosyalar işlevlerini yitmiş olması neden ile artık kullanılmayacaklardır.</p>

<h4>Config/Namespace.php Ayar Dosyası Eklendi</h4>
<p>Libraries/ ve Components/ dizinleri içinde farklı bir dizinde yer alan sınıflar için namespace isim alanları kullanılmıştır. Bu neden isim alanı olan sınıfları daha kolay ve basit isimlerle kullanabilmek için bu ayar dosyası oluşturulmuştur.<br>
Örnek:

Test\Deneme\Uygulama alan adına sahip olana A sınıfını Sadece A isimlendirmesi ile kullanmak için bu ayar dosyasına A => Test\Deneme\Uygulama\A tanımlaması eklenirse artık A harfi ile bu sınıf kullanabilecektir. $this->A->yontemler(); Böyle bir tanımla yapılmazsa $this->{'Test\Deneme\Uygulama\A'}->yontemler() şeklinde kullanılması gerekir. Bu söylenenler isim alanı içeren sınıflar için geçerlidir.
</p>

<h4>This() Erişim Yöntemi Kaldırıldı Yerine uselib() Erişim Yöntemi Eklendi</h4>
<p>uselib('Encode')->super('a'); şeklinde bir kullanım içeren bu yeni yöntem this() yöntemine göre oldukça hızlı çalışmaktadır. Diğer erişim yöntemleri varlığını sürdürmektedir.</p>

<h4>MagicGet ve Model Extends Sınıfları Kaldırıldı</h4>
<p>Model veya kütüphane dosyaları içinde $this erişimini kullanabilmek için extends zorunluluğu gerektiren bu yapılar yerine artık sadece Controller sınıfı kullanılacaktır. Bu nedenle bu sınıflar kaldırılmıştır.</p>

<h4>Araçlar Sınıflara Çevrilerek Kütüphaneler Bölümüne Tanışındı</h4>
<p>Yeni sürümde artık araçlar olmayacak. Bu araçlar gerekli değişikliklerle sınıflara dönüştürülüp Kütüpaneler dizinine taşınmıştır. Artık hiç bir dahil etmeye ihtiyaç duymadan araçlarınızı sınıf olarak doğrudan kullanabileceksiniz.</p>

<h4>Veritabanı Kütüphanesine Increment ve Decrement Yöntemleri Eklendi</h4>
<p>Sütun değerini bir artırmak veya bir azalmak için kullanılan 2 yeni yöntem eklenmiştir.
<br>
1. Kullanım -> $this->db->incerement('TabloAdi', 'SutunAdi'); <br>
2. Kullanım -> $this->db->incerement('TabloAdi', array('SutunAdi1', 'SutunAdi2')); <br>
3. Kullanım -> $this->db->table('TabloAdi')->incerement(array('SutunAdi1', 'SutunAdi2'));</p>
