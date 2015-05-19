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
    <div id="content-document"><a href="#">Döküman</a> » <a href="db_dynamic.html">Database(Veritabanı) Sınıfı Yöntemleri</a> » Database Forge Sınıfı ve Kullanımı</div> 
    <p class="ctfont">Database Forge Sınıfı ve Kullanımı</p>
    <p>Bu bölümde veritabanı oluşturma yöntemlerinin anlatımına yer verdik.</p>
    <p>
        <ul content="list">
        <li><a href="#db_import">Database Forge Kütüphanesini Dahil Etmek</a></li>
        <li><a href="#db_create">Veritabanı Oluşturmak » <strong>$this->db->create_database()</strong></a></li>
        <li><a href="#db_drop">Veritabanını Silmek » <strong>$this->db->drop_database()</strong></a></li>
        <li><a href="#db_create_table">Tablo Oluşturmak » <strong>$this->db->create_table()</strong></a></li>
        <li><a href="#db_drop_table">Tablo Silmek » <strong>$this->db->drop_table()</strong></a></li>
        <li><a href="#db_alter_table">Tabloyu Düzenlemek » <strong>$this->db->alter_table()</strong></a></li>
        <li><a href="#db_rename_table">Tablo İsmini Değiştirmek » <strong>$this->db->rename_table()</strong></a></li>
        <li><a href="#db_add_column">Tabloya Sütun Eklemek » <strong>$this->db->add_column()</strong></a></li>
        <li><a href="#db_drop_column">Tablodan Sütun Silmek » <strong>$this->db->drop_column()</strong></a></li>
        <li><a href="#db_rename_column">Sütun İsmini Değiştirmek » <strong>$this->db->rename_column()</strong></a></li>
        <li><a href="#db_modify_column">Sütün Bilgilerini Düzenlemek » <strong>$this->db->modify_column()</strong></a></li>
        <li><a href="#db_truncate">Tablo Verilerini Boşaltmak » <strong>$this->db->truncate()</strong></a></li>
        </ul>
    </p>
    
    <p class="cstfont" id="db_import">Database Forge Kütüphanesini Dahil Etmek</p>
    <div type="code">
  	import::library(<sf>'DbForge'</sf>);
    </div>
    <p><strong>Ya da</strong></p>
    <div type="code">
  	<vf>$this</vf>->import->library(<sf>'DbForge'</sf>);
    </div>

    <p class="cstfont" id="db_create">Veritabanı Oluşturmak</p>
    <p><ftype>$this->dbforge->create_database( <kf>string</kf> <vf>$veritabani_adi</vf> )</ftype></p>
    <p>Veritabanı oluşturmak için kullanılır.</p>
    
    <table class="cfont">
    	<tr><th>Parametre</th><td>Kullanımı</td></tr>
        <tr><th>string Veritabanı Adı</th><td>Oluşturulacak veritabanının adı.</td></tr>
    </table>
    
    <p>
    <div type="code">
  	<vf>$this</vf>->dbforge->create_database(<sf>'OrnekDatabase'</sf>);<br>
    </div>
    </p>
    
    <p class="cstfont" id="db_drop">Veritabanını Silmek</p>
    <p><ftype>$this->dbforge->drop_database( <kf>string</kf> <vf>$veritabani_adi</vf> )</ftype></p>
    <p>Veritabanı oluşturmak için kullanılır.</p>
    
    <table class="cfont">
    	<tr><th>Parametre</th><td>Kullanımı</td></tr>
        <tr><th>string Veritabanı Adı</th><td>Silinecek veritabanının adı.</td></tr>
    </table>
    
    <div type="code">
  	<vf>$this</vf>->dbforge->drop_database(<sf>'OrnekDatabase'</sf>);<br>
    </div>
    
    
    <p class="cstfont" id="db_create_table">Tablo Oluşturmak</p>
    <p><ftype>$this->db->create_table( <kf>string</kf> <vf>$tablo_adi</vf> , <kf>array</kf> <vf>$sutun_ozellikleri</vf> )</ftype></p>
    <p>Yeni bir tablo oluşturmak için kullanılır.</p>
    
      <p>
    	<table class="cfont">
        	<tr><th colspan="2">$this->db->create_table()</th></tr>
            <tr><th colspan="2">Parametreler</th></tr>
            <tr><th>1.Parametre Tablo Adı</th><td>'YeniTablo'</td></tr>
    		<tr><th>2.Parametre Tablo Sütunları</th><td>array('sutun adı' => 'sutun ozelligi')</td></tr>
        </table>
    </p>
    
    <div type="code"><pre>
<vf>$sutunlar</vf> = <kf>array</kf>(
	<sf>'id'</sf> => <sf>'int(11) not null'</sf>,
    	<sf>'isim'</sf> => <sf>'varchar(50) COLLATE utf8_unicode_ci NOT NULL'</sf>
);
<strong><vf>$this</vf>->db->create_table</strong>(<sf>'IF NOT EXISTS YeniTablo'</sf>,<vf>$sutunlar</vf>);
    </pre></div>
    
    
     <p class="cstfont" id="db_drop_table">Tablo Silmek</p>
     <p><ftype> $this->db->drop_table( <kf>string</kf> <vf>$tablo_adi</vf> )</ftype></p>
     <p>Tablo silmek için kullanılır.</p>
    
      <p>
    	<table class="cfont">
        	<tr><th>Parametreler</th><th>Kullanımı</th></tr>
            <tr><th>string Tablo Adı</th><td>Silinecek tablo adı.</td></tr>
        </table>
    </p>
    
    <div type="code"><strong><vf>$this</vf>->db->drop_table</strong>(<sf>'YeniTablo'</sf>);<comment> // Tek bir tablo silinecekse değeri string olarak girin.</comment></div>
    
    
     <p class="cstfont" id="db_alter_table">Tabloyu Düzenlemek</p>
     <p><ftype> <vf>$this</vf>->db->alter_table( <kf>string</kf> <vf>$tablo_adi</vf> , <kf>array</kf> <vf>$degisiklikler</vf> )</ftype></p>
     <p>Tablo ismini değiştirmek sütun eklemek veya kaldırmak için kullanılır. 2 Parametre kullanır.</p>
    
      <p>
    	<table class="cfont">
        	<tr><th colspan="2">$this->db->alter_table()</th></tr>
            <tr><th>Parametreler</th><th>Anlamları</th></tr>
            <tr><th>1.Parametre Tablo İsmi</th><td>Değişiklik yapılacak tablo adı girilir. 'OrnekTablo'</td></tr>
    		<tr><th>2.Parametre Değişikliğin Ne Olacakğını Belirtir.</th><td>Anahtar değer çiftlerinden oluşan bilgi dizisi ister.</td></tr>
            <tr><th colspan="2">2. Parametrede Kullanılabilir Anahtar Kelimeler.</th></tr>
            <tr><th>rename_table</th><td>Tablo ismini değiştirmek için kullanılır.</td></tr>
            <tr><th>add_column</th><td>Tabloya sütun eklemek için kullanılır.</td></tr>
            <tr><th>drop_column</th><td>Tablodan sütun silmek için kullanılır.</td></tr>
            <tr><th>rename_column</th><td>Tablodan sütun adını değiştirmek için kullanılır.</td></tr>
            <tr><th>modify_column</th><td>Tablodan sütun bilgilerini düzenlemek için kullanılır.</td></tr>
        </table>
    </p>
    
    <div type="code"><strong><vf>$this</vf>->db->alter_table</strong>(<sf>'YeniTablo'</sf>, <kf>array</kf>(<sf>'rename_table'</sf> => <sf>'YeniIsim'</sf>));<comment> // Tablonun ismini değiştirmek için kullanılan form.</comment></div>
    <p></p>
    <div type="code"><strong><vf>$this</vf>->db->alter_table</strong>(<sf>'YeniTablo'</sf>, <kf>array</kf>(<sf>'add_column'</sf> => <kf>array</kf>(<sf>'numara'</sf> => <sf>'varchar(50)'</sf>)));<comment> // Tabloya sütun eklemek için kullanılan form.</comment></div>
    <p></p>
    <div type="code"><strong><vf>$this</vf>->db->alter_table</strong>(<sf>'YeniTablo'</sf>, <kf>array</kf>(<sf>'drop_column'</sf> => <sf>'numara'</sf>));<comment> // Tablodan sütun çıkarmak için kullanılan form.</comment></div>
    <p></p>
    
    <p class="cstfont" id="db_rename_table">Tablo İsmini Değiştirmek</p>
     <p><ftype> $this->db->rename_table( <kf>string</kf> <vf>$eski_tablo_ismi</vf> , <kf>string</kf> <vf>$yeni_tablo_ismi</vf> )</ftype></p>
     <p>Tablo ismini değiştirmek için <strong>alter table yöntemine alternatif</strong> olarak geliştirilmiş pratik tablo adı değiştirmek yöntemidir.</p>
    
      <p>
    	<table class="cfont">
            <tr><th>Parametreler</th><th>Anlamları</th></tr>
            <tr><th>1.Parametre Eski Tablo İsmi</th><td>Eski tablo adı girilir. 'OrnekTablo'</td></tr>
    		<tr><th>2.Parametre Yeni Tablo İsmi</th><td>Yeni tablo adı girilir. 'YeniOrnekTablo'</td></tr>
        </table>
    </p>
    
    <p>
    <div type="code"><strong><vf>$this</vf>->db->rename_table</strong>(<sf>'EskiTablo'</sf> , <sf>'YeniTablo'</sf>);<comment> // Tek bir tablo silinecekse değeri string olarak girin.</comment></div>
  	</p>
    
    
    <p class="cstfont" id="db_add_column">Tabloya Sütun Eklemek</p>
     <p><ftype> $this->db->add_column( <kf>string</kf> <vf>$tablo_adi</vf> , <kf>array</kf> <vf>$sutunlar</vf> )</ftype></p>
     <p>Tabloya sütun eklemek için <strong>alter table yöntemine alternatif</strong> olarak geliştirilmiş pratik sütun ekleme yöntemidir.</p>
    
      <p>
    	<table class="cfont">
            <tr><th>Parametreler</th><th>Anlamları</th></tr>
            <tr><th>1.Parametre Tablo İsmi</th><td>Sütunların ekleneceği tablonunun ismi.</td></tr>
    		<tr><th>2.Parametre Eklenecek Sütunlar</th><td>Eklenecek sütunlar dizisi</td></tr>
        </table>
    </p>
    
    <p>
    <div type="code"><strong><vf>$this</vf>->db->add_column</strong>(<sf>'OrnekTablo'</sf> , <kf>array</kf>(<sf>'sutun1'</sf> => <kf>array</kf>(<sf>'int'</sf>, <sf>'not null'</sf>)));</div>
  	</p>
    
    <p>
    <div type="code"><strong><vf>$this</vf>->db->add_column</strong>(<sf>'OrnekTablo'</sf> , <kf>array</kf>(<sf>'sutun1'</sf> => <sf>'int not null'</sf>));<comment> // Sütun bilgileri string olarakta girilebilir.</comment></div>
  	</p>
    
    <p class="cstfont" id="db_drop_column">Tablodan Sütun Silmek</p>
     <p><ftype> $this->db->drop_column( <kf>string</kf> <vf>$tablo_adi</vf> , <kf>string/array</kf> <vf>$sutunlar</vf> )</ftype></p>
     <p>Tablodan sütun silmek için <strong>alter table yöntemine alternatif</strong> olarak geliştirilmiş pratik sütun silme yöntemidir.</p>
    
      <p>
    	<table class="cfont">
            <tr><th>Parametreler</th><th>Anlamları</th></tr>
            <tr><th>1.Parametre Tablo İsmi</th><td>Sütunların silineceği tablonunun ismi.</td></tr>
    		<tr><th>2.Parametre Silinecek Sütunlar</th><td>Silinecek sütunlar.</td></tr>
        </table>
    </p>
    
    <p>
    <div type="code"><strong><vf>$this</vf>->db->drop_column</strong>(<sf>'OrnekTablo'</sf> , <kf>array</kf>(<sf>'sutun1'</sf> , <sf>'sutun2'</sf>));</div>
  	</p>
    
    <p>
    <div type="code"><strong><vf>$this</vf>->db->drop_column</strong>(<sf>'OrnekTablo'</sf> , <sf>'sutun1'</sf>);<comment> // Tek bir sütun silinecekse parametre string girilebilir .</comment></div>
  	</p>
    
    
    <p class="cstfont" id="db_rename_column">Sütun Adını Değiştirmek</p>
     <p><ftype> $this->db->rename_column( <kf>string</kf> <vf>$tablo_adi</vf> , <kf>array</kf> <vf>$sutunlar</vf> )</ftype></p>
     <p>Sütun adını değiştirmek için <strong>alter table yöntemine alternatif</strong> olarak geliştirilmiş pratik sütun adı değiştirme yöntemidir.</p>
    
      <p>
    	<table class="cfont">
            <tr><th>Parametreler</th><th>Anlamları</th></tr>
            <tr><th>1.Parametre Tablo İsmi</th><td>Sütunların ekleneceği tablonunun ismi.</td></tr>
    		<tr><th>2.Parametre Eklenecek Sütunlar</th><td>Adı değiştirilecek sütun bilgisi</td></tr>
        </table>
    </p>
    
    <p>
    <div type="code"><strong><vf>$this</vf>->db->rename_column</strong>(<sf>'OrnekTablo'</sf> , <kf>array</kf>(<sf>'sutun1 sutun2'</sf> => <kf>array</kf>(<sf>'int'</sf>, <sf>'not null'</sf>)));</div>
  	</p>
    
    <p>
    <div type="code"><strong><vf>$this</vf>->db->rename_column</strong>(<sf>'OrnekTablo'</sf> , <kf>array</kf>(<sf>'sutun1 sutun2'</sf> => <sf>'int not null'</sf>));<comment> // Sütun bilgileri string olarakta girilebilir.</comment></div>
  	</p>
    
    
     <p class="cstfont" id="db_modify_column">Sütun Bilgisini Güncellemek</p>
     <p><ftype> $this->db->modify_column( <kf>string</kf> <vf>$tablo_adi</vf> , <kf>array</kf> <vf>$sutunlar</vf> )</ftype></p>
     <p>Tabloya sütun bilgisini güncellemek için <strong>alter table yöntemine alternatif</strong> olarak geliştirilmiş pratik sütun güncelleme yöntemidir.</p>
    
      <p>
    	<table class="cfont">
            <tr><th>Parametreler</th><th>Anlamları</th></tr>
            <tr><th>1.Parametre Tablo İsmi</th><td>Sütunların ekleneceği tablonunun ismi.</td></tr>
    		<tr><th>2.Parametre Güncellenecek Sütunlar</th><td>Güncellenecek sütunlar dizisi</td></tr>
        </table>
    </p>
    
    <p>
    <div type="code"><strong><vf>$this</vf>->db->modify_column</strong>(<sf>'OrnekTablo'</sf> , <kf>array</kf>(<sf>'sutun1'</sf> => <kf>array</kf>(<sf>'int'</sf>, <sf>'not null'</sf>)));</div>
  	</p>
    
    <p>
    <div type="code"><strong><vf>$this</vf>->db->modify_column</strong>(<sf>'OrnekTablo'</sf> , <kf>array</kf>(<sf>'sutun1'</sf> => <sf>'int not null'</sf>));<comment> // Sütun bilgileri string olarakta girilebilir.</comment></div>
  	</p>
    
        
    <p class="cstfont" id="db_truncate">Tablo İçerğini Boşaltmak</p>
    <p><ftype> $this->db->truncate( <kf>string</kf> <vf>$tablo_adi</vf> )</ftype></p>
     <p>Tablo içeriğini boşaltmak için kullanılır.</p>
    
      <p>
    	<table class="cfont">
        	<tr><th colspan="2">$this->db->truncate()</th></tr>
            <tr><th>Parametreler</th><th>Anlamları</th></tr>
            <tr><th>1.Parametre Tablo İsmi</th><td>İçi boşaltılacak tablo adı girilir. 'OrnekTablo'</td></tr>
        </table>
    </p>
   	<p><div type="code"><strong><vf>$this</vf>->db->truncate</strong>(<sf>'YeniTablo'</sf>);</div></p>
  
    <div type="prev-next">
    	<div type="prev-btn"><a href="db_trans.html">Önceki</a></div><div type="next-btn"><a href="db_forge.html">Sonraki</a></div>
    </div>
 
</body>
</html>              