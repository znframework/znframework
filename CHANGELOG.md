<h4>Bileşenler Genişletiliyor ve Daha Stabil Hale Getirildi</h4>
<p>Template bileşenine Parser alt bileşeni eklenmiştir. Css bileşenine css dosyalarına müdahele edilebilecek yeni yöntemler eklenmiştir. </p>

<h4>Yeni Fonksiyonlar Eklendi</h4>
<p>1 - output() : var_dump(), print_r() gibi dizi ve obje içeriği hakkında bilgi almayı sağlayan yöntemlere alternatif olarak output() yöntemi oluşturulmuştur. Bu yöntem diğerlerine göre çok daha düzenli ve anlaşılabilir çıktı üretmektedir.
2 - write() : Yazdırma yöntemi eklenmiştir.
3 - writeln() : Yazdırma yöntemi eklenmiştir.
4 - uselib() : Kütüphane kullanım yöntemi eklenmiştir.</p>

<h4>Çekirdek Yapıya Autoloader Kütüphanesi Eklendi</h4>
<p>Bu sınıfın eklenmesi ile herhangi bir sınıfa veya kütüphaneyi tanımlanmasına gerek kalmadan kullanılabilir oldu. Ancak $this->sınıf->yontem() şeklinde bir erişim sağlanamaz. Bu tip erişim için sınıfın import edilmesi gerekir. Yani $var = new Class() veya class::yontem() şeklinde kullanımlar için import edilme işlemine ihtiyaç yoktur. </p>

<h4>Import Kütüphanesi Düzenlendi</h4>
<p>Import kütüphanesinde ciddi güncellemelere gidilmiştir.</p>

<h4>Kütüphane İsimlerinde Kullanılan Kısaltmalar Kaldırıldı</h4>
<p>Kısa isim kullamak için oluşturulan ayarlama kaldırıldı. Şu an için bütün kütüphanler tam ismiyle kullanılabilir. </p>

<h4>Component(Bileşen) İsimlerine C Ön Eki Getirildi</h4>
<p>Kütüphane ile aynı isimde olabilen bileşen isimlerinin bir birinden ayrılması için C ön eki kullanılmıştır. Örnek: import::component('CUpload'); $this->cupload->...
Namespace kullanılmamasının nedeni kod çatısını alt yapısının buna elverişli olmamasından dolayıdır. Biz de böyle bir kullanıma gittik. </p>
