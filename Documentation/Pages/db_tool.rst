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
    <div id="content-document"><a href="#">Döküman</a> » <a href="db_dynamic.html">Database(Veritabanı) Sınıfı Yöntemleri</a> » Database Tool Sınıfı ve Kullanımı</div> 
    <p class="ctfont">Database Tool Sınıfı ve Kullanımı</p>
    <p>Bu bölümde veritabanı için yararlı bir kaç aracın anlatımına yer verdik.</p>
    <p>
        <ul content="list">
        <li><a href="#db_import">Database Tool Kütüphanesini Dahil Etmek</a></li>
        <li><a href="#db_list_databases">Oluşturulan Veritabanlarının Listesini Almak » <strong>$this->db->list_databases()</strong></a></li>
        <li><a href="#db_list_tables">Veritabanında Oluşturalan Tabloların Listesini Almak » <strong>$this->db->list_tables()</strong></a></li>
        <li><a href="#db_backup">Veritabanının Yedeğini Almak » <strong>$this->db->backup()</strong></a></li>
        <li><a href="#db_optimize_tables">Tabloları Uygun Hale Getirmek » <strong>$this->db->optimize_tables()</strong></a></li>
        <li><a href="#db_repair_tables">Tabloları Onarmak » <strong>$this->db->repair_tables()</strong></a></li>
        </ul>
    </p>
    
    <p class="cstfont" id="db_import">Database Tool Kütüphanesini Dahil Etmek</p>
    <div type="code">
  	import::library(<sf>'DbTool'</sf>);
    </div>
    <p><strong>Ya da</strong></p>
    <div type="code">
  	<vf>$this</vf>->import->library(<sf>'DbTool'</sf>);
    </div>

    <p class="cstfont" id="db_list_databases">Oluşturulan Veritabanlarının Listesini Almak</p>
    <p><ftype>$this->dbtool->list_databases()</ftype></p>
    <p>Oluşturulan veritabanlarının listesini verir.</p>
    
    <p>
    <div type="code">
  	<ff>var_dump</ff>(<vf>$this</vf>->dbtool->list_databases());<br>
    </div>
    </p>
    
    <p class="cstfont" id="db_list_tables">Veritabanında Oluşturalan Tabloların Listesini Almak</p>
    <p><ftype>$this->dbtool->list_tables()</ftype></p>
    <p>Veritabanında oluşturulan tabloların listesini verir.</p>
  
    
    <div type="code">
  	<ff>var_dump</ff>(<vf>$this</vf>->dbtool->list_tables());<br>
    </div>
    
    
    <p class="cstfont" id="db_backup">Veritabanının Yedeğini Almak</p>
    <p><ftype>$this->dbtool->backup( [ <kf>string/array</kf> <vf>$tablo_isimleri</vf> = <sf>'*'</sf> ] , [ <kf>string</kf> <vf>$dosya_adi</vf> = <sf>'db-backup-time-tablolar.sql'</sf> ] , [ <kf>string</kf> <vf>$kaydedilece_yol</vf> = <sf>'Views/Trinkets/Files'</sf> ] )</ftype></p>
    <p>Veritabanının yedeğini almak için kullanılır.</p>
    
      <p>
    	<table class="cfont">
        	<tr><th colspan="2">$this->dbtool->backup()</th></tr>
            <tr><th colspan="2">Parametreler</th></tr>
            <tr><th>[string/array Tablo İsimleri = '*']</th><td>Varsayılan <strong>*</strong>(Tüm tablolar) ayarlıdır. Farklı bir parametre girilecekse dizi bilgisi veya virgüllerle ayrılmış string içerikli tablo isimleri bilgisi girilir.</td></tr>
    		<tr><th>[string Dosyanın Adı = 'db-backup-time-tablolar.sql']</th><td>Dosyanın hangi isimle kaydedileceği.</td></tr>
            <tr><th>[string Dosyanın Kaydedileceği Yol = 'Views/Trinkets/Files']</th><td>Dosyanın nereye kaydedileceği.</td></tr>
        </table>
    </p>
    
    <div type="code"><pre>
<vf>$this</vf>->dbtool->backup(<sf>'tbl1, tbl2, tbl3'</sf>, <sf>'a.sql'</sf>, <sf>'Views/Trinkets/Uploads'</sf>);
<vf>$this</vf>->dbtool->backup(<kf>array</kf>(<sf>'tbl1'</sf>, <sf>'tbl2'</sf>, <sf>'tbl3'</sf>));
<vf>$this</vf>->dbtool->backup(<sf>'*'</sf>);
    </pre></div>
    
    
     <p class="cstfont" id="db_optimize_tables">Tabloları Uygun Hale Getirmek</p>
     <p><ftype> $this->dbtool->optimize_tables( [ <kf>string/array</kf> <vf>$tablo_adlari</vf> = <sf>'*'</sf> ] )</ftype></p>
     <p>Tabloları optimize etmek için kullanılır.</p>
    
      <p>
    	<table class="cfont">
        	<tr><th>Parametreler</th><th>Kullanımı</th></tr>
            <tr><th>[string/array Tablo Adı = '*']</th><td>Optimize edilmek istenen tabloların ismi. Tüm tablolar optimize edilecekse <strong>*</strong> parametresi kullanılır. Hali hazırda varsayılan olarakta <strong>*</strong> ayarlarıdır. </td></tr>
        </table>
    </p>
    
    <div type="code">
    <strong><vf>$this</vf>->dbtool->optimize_tables</strong>(<sf>'*'</sf>);<br>
    <strong><vf>$this</vf>->dbtool->optimize_tables</strong>(<sf>'tbl1, tbl2, tbl3'</sf>);<br>
    <strong><vf>$this</vf>->dbtool->optimize_tables</strong>(<kf>array</kf>(<sf>'tbl1'</sf>, <sf>'tbl2'</sf>, <sf>'tbl3'</sf>));<br>
    </div>
    
    
    <p class="cstfont" id="db_repair_tables">Tabloları Onarmak</p>
     <p><ftype> $this->dbtool->repair_tables( [ <kf>string/array</kf> <vf>$tablo_adlari</vf> = <sf>'*'</sf> ] )</ftype></p>
     <p>Tabloları onarmak için kullanılır.</p>
    
      <p>
    	<table class="cfont">
        	<tr><th>Parametreler</th><th>Kullanımı</th></tr>
            <tr><th>[string/array Tablo Adı = '*']</th><td>Onarılmak istenen tabloların ismi. Tüm tablolar onarılacaksa <strong>*</strong> parametresi kullanılır. Hali hazırda varsayılan olarakta <strong>*</strong> ayarlarıdır. </td></tr>
        </table>
    </p>
    
    <div type="code">
    <strong><vf>$this</vf>->dbtool->repair_tables</strong>(<sf>'*'</sf>);<br>
    <strong><vf>$this</vf>->dbtool->repair_tables</strong>(<sf>'tbl1, tbl2, tbl3'</sf>);<br>
    <strong><vf>$this</vf>->dbtool->repair_tables</strong>(<kf>array</kf>(<sf>'tbl1'</sf>, <sf>'tbl2'</sf>, <sf>'tbl3'</sf>));<br>
    </div>
     
    <div type="prev-next">
    	<div type="prev-btn"><a href="db_trans.html">Önceki</a></div><div type="next-btn"><a href="db_forge.html">Sonraki</a></div>
    </div>
 
</body>
</html>              