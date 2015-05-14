<h4>Dosya ve Dizinlerde Yapısal Değişikliğe Gidildi</h4>
<p>Sistemde yer dosya ve dizinler System/ dizini hariç Application/ dizini içerisine alındı. Eski isimleri ile Coder dizini Controllers olarak değiştirildi. Yine Designer dizini ise Views olarak yeniden isimlendirildi. Models dizini eklendi.</p>
<h4>ZNDynamic Extends Sınıfı Controller Olarak Değiştirildi</h4>
<p>Daha önce doğrudan erişim kullanabilmek için extends edilen ZNDynamic sınıfı yerine Controller sınıfı oluşturuldu.</p>
<h4>MagicGet ve Model Extends Sınıfıları Oluşturuldu</h4>
<p>Harici bir model dosyası veya kütüphane oluşturulacaksa doğrudan erişim sağlanması için Model veya MagicGet sınıfları extends edilerek kullanılabilir.</p>
<h4>Components(Bileşenler) Eklendi</h4>
<p>Bileşenler yeni yeni geliştirilmekte olup şuan için 9 adet genel bir kaçtanede alt bileşen oluşturuldu. Bileşenlerin geliştirilmesi ve kılavuza eklenmesi devam edecektir.</p>
<h4>4 Farklı Erişim Yöntemi Oluşturuldu</h4>
<p>1- Dinamik $this nesne erişimi; Aktif çalışılan sayfada Controller extendsi gerektirmemektedir.<br>
2- Statik erişim; Kütüphaneler genel olarak statik tanımlı geliştirildiği için statik erişim kullanmanız mümkündür.<br>
3- Değişken erişimi; zn::$use özel değişkeni ile her sayfadan nesnelere doğrudan erişim gerçekleştirebilirsiniz.<br>
4- Yöntemsel erişim; this() özel fonksiyonu ile nesnelere doğrudan erişim sağlayabilirsiniz.</p>
