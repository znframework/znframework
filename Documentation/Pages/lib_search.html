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
    <div id="content-document"><a href="#">Döküman</a> » <a href="libraries.html">Kütüphaneler</a> » Search(Arama) Sınıfı</div> 
    <p class="ctfont">Search(Arama) Sınıfı</p>
    <p>Site içi aramalar yapmak için veritabanı ile ilişkili arama motoru sınıfıdır.</p>
    <ul><li><a href="#" class="infont">Search(Arama) Sınıfı ve Yöntemleri</a><br><br>
        <ul>  
        	<li><a href="#search_import">Search Kütüphanesini Dahil Etmek</a></li>
        	<li><a href="#search_get">Site İçi Arama Yapmak ve Arama Sonuçlarını Almak » <b>search::get()</b></a></li>
            <li><a href="#search_filter">Arama Sonuçlarına Filtre Uygulamak » <b>search::filter() ve search::or_filter()</b></a></li>
        </ul>
    </li></ul>
    
    <p class="cstfont" id="search_import">Search Kütüphanesini Dahil Etmek</p>
    <div type="code">
  	import::library(<sf>'Search'</sf>);
    </div>
    
   	<p class="cstfont" id="search_get">Site İçi Arama Yapmak</p>
    <p><ftype>search::get( <kf>array</kf> <vf>$tablolar_sutunlar</vf> , <kf>string</kf> <vf>$aranacak_kelime</vf> , [ <kf>string</kf> <vf>$arama_turu</vf> = <sf>'inside'</sf>] )</ftype></p>
    <p>Site içi arama yapmak için kullanılır. 3 parametresi vardır. Tablolar Sütunlar, Aranacak Kelime, Arama Türü.</p> 
    <p>
    	<table class="cfont">
        	<tr><th>Parametre</th><td>Anlamları</td></tr>
            <tr><th>1. Parametre = Tablolar Sütunlar</th><td>Arama yapılacak tabloları ve sütunları ifade eder. array('tablo adı' => array('sütun1', 'sütun2'))</td></tr>
			<tr><th>2. Parametre = Aranacak Kelime</th><td>Aranacak kelimeyi.</td></tr>
            <tr><th>3. Parametre = [Arama Türü = inside]</th><td>Aranacak kelimenin sorgulanacak veriler içerisinde içinde geçen ifademi, başlayan ifademi, biten ifademi bunu belirtir. 3 parametre değeri vardır. inside, starting, ending</td></tr>
            <tr><th>Arama Türü Parametreleri</th><th>Anlamları</th></tr>
            <tr><th>inside</th><td>İçinde geçen</td></tr>
            <tr><th>starting</th><td>İle başlayan</td></tr>
            <tr><th>ending</th><td>İle biten</td></tr>
        </table>
    </p>
    
    <p>
    	<div type="code">
<pre>
<comment>/* array(
	'tablo1' => array('sutun1','sutun2', ...), 
        'tablo2' => array('sutun1','sutun2', ...),
        'tablo3' => array('sutun1','sutun2', ...),
        .
        .
        .
   );

*/</comment>
import::library(<sf>'Search'</sf>);

<vf>$tablolar_sutunlar</vf> = <kf>array</kf>(
    <sf>'urunler'</sf> => <kf>array</kf>(<sf>'urun_adi'</sf>,<sf>'fiyati'</sf>),
    <sf>'projeler'</sf> => <kf>array</kf>(<sf>'proje_adi'</sf>,<sf>'proje_tarihi'</sf>)
);

<vf>$aranacak_kelime</vf> = <sf>'Elma'</sf>;
<vf>$arama_turu</vf> = <sf>'starting'</sf>; <comment> // inside, starting, ending varsayılan:inside</comment>

<vf>$arama</vf> = <b>search::get</b>(<vf>$tablolar_sutunlar</vf>, <vf>$aranacak_kelime</vf>, <vf>$arama_turu</vf>);
<kf>foreach</kf>(<vf>$arama</vf>->urunler <kf>as</kf> <vf>$sonuc</vf>)
{
	<kf>echo</kf> <vf>$sonuc</vf>->id; 
	<kf>echo</kf> <vf>$sonuc</vf>->urun_adi;
    	<kf>echo</kf> <vf>$sonuc</vf>->fiyati; 
        <kf>echo</kf> <vf>$sonuc</vf>->markasi;
        <kf>echo</kf> <vf>$sonuc</vf>->modeli;
        <kf>echo</kf> <vf>$sonuc</vf>->uretim_yeri;   	
}

<kf>foreach</kf>(<vf>$arama</vf>->projeler <kf>as</kf>  <vf>$sonuc</vf>)
{
	<kf>echo</kf> <vf>$sonuc</vf>->id; 
	<kf>echo</kf> <vf>$sonuc</vf>->proje_adi;
    	<kf>echo</kf> <vf>$sonuc</vf>->proje_fiyati;
        <kf>echo</kf> <vf>$sonuc</vf>->proje_suresi;
    	<kf>echo</kf> <vf>$sonuc</vf>->proje_tarihi;  		
}
</pre>
        </div>
    </p>
    
    <p>Yukarıdaki kodda dikkat edilirse tablo ve sütun bilgileri dizi olarak gönderilmektedir. Dizi içersinde anahtarlar tablo isimlerini oluştururken değerler ise sütunları içeren dizi bilgisi tutmaktadır. Arama türü olarak inside seçilecekse yazılmasına gerek yoktur varsılayan olarak zaten inside ayarladır. Sonuçlar <strong>object veri tipi dizi değişken</strong> olarak döner.</p>
    
    <div type="note"><div>NOT</div><div>Arama işleminde kullanılan sütun isimlerine ait bulunan verilerin, bulunduğu tablodaki tüm sütun bilgileri elde edilmiş olur.</div></div>
    
 
    <p class="cstfont" id="search_filter">Arama Sonuçlarına Filtre Uygulamak</p>
    <p><ftype>search::filter( <kf>string</kf> <vf>$sutun_adi</vf> , <kf>string</kf> <vf>$kosul</vf> , <kf>string</kf> <vf>$karsilastirilacak_deger</vf> )</ftype></p>
    <p><ftype>search::or_filter( <kf>string</kf> <vf>$sutun_adi</vf> , <kf>string</kf> <vf>$kosul</vf> , <kf>string</kf> <vf>$karsilastirilacak_deger</vf> )</ftype></p>
    <p>Search::get() ile aranacak verilere filtre uygulamak için kullanılan 2 yöntemi vardır <cf>filter()</cf> ve <cf>or_filter()</cf> yöntemleridir. Aynı anda birden fazla filtre de uygulanabilir. 3 parametresi vardır. Bu parametreler tıpkı <cf>db::where()</cf> yöntemindeki gibidir. Sütun Adı, Koşul, Değer</p>
    
    <table class="cfont">
        	<tr><th>Parametre</th><td>Anlamları</td></tr>
            <tr><th>1. Parametre = Sütun Adı</th><td>Koşulun ilk değeri tablo adı.</td></tr>
			<tr><th>2. Parametre = Koşul</th><td>Koşulun türü. !=, =, <, >..</td></tr>
            <tr><th>3. Parametre = Değer</th><td>Koşulun ikinci değeri.</td></tr>
        </table>
    
   	    <p>
    	<div type="code">
<pre>

    
<vf>$tablolar_sutunlar</vf> = <kf>array</kf>(
    <sf>'urunler'</sf> => <kf>array</kf>(<sf>'urun_adi'</sf>,<sf>'fiyati'</sf>),
    <sf>'projeler'</sf> => <kf>array</kf>(<sf>'proje_adi'</sf>,<sf>'proje_tarihi'</sf>)
);

<vf>$aranacak_kelime</vf> = <sf>'Elma'</sf>;
<vf>$arama_turu</vf> = <sf>'starting'</sf>;

<b>search::filter</b>(<sf>'fiyati'</sf>, <sf>'>'</sf>, <sf>'200'</sf>);
<b>search::filter</b>(<sf>'proje_tarihi'</sf>, <sf>'>'</sf>, <sf>'2013'</sf>);
<b>search::or_filter</b>(<sf>'proje_tarihi'</sf>, <sf>'<'</sf>, <sf>'2015'</sf>);
<vf>$arama</vf> = search::get(<vf>$tablolar_sutunlar</vf>, <vf>$aranacak_kelime</vf>, <vf>$arama_turu</vf>);
 

<ff>var_dump</ff>(<vf>$arama</vf>);
<comment>/*
Yukarıdaki Filtreleme İşlemi: İçinde Elma kelimesi geçen tüm veriler arasında, fiyatı 200'den büyük ve proje tarihi 2013 den büyük veya 2015 den küçük olanları getir.
*/</comment>
</pre>
        </div>
    </p>
    
    
    
    <div type="prev-next">
    	<div type="prev-btn"><a href="lib_reg.html">Önceki</a></div><div type="next-btn"><a href="lib_sec.html">Sonraki</a></div>
    </div>
 
</body>
</html>              