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
    <div id="content-document"><a href="#">Döküman</a> » <a href="libraries.html">Kütüphaneler</a> » File Sınıfı</div> 
    <p class="ctfont">File(Dosya) Sınıfı</p>
    <p>Dosya yönetimi için oluşturulmuş bir sınıftır. Kes, kopyala, yapıştır ve dosya oluşturma gibi bir kaç yöntemi vardır.</p>
    <ul><li><a href="#" class="infont">File(Dosya) Sınıfı ve Yöntemleri</a><br><br>
        <ul>
        	<li><a href="#file_import">File Kütüphanesini Dahil Etmek</a></li>
            <li><a href="#file_read">Dosya Okumak » <b>file::read()</b></a></li>
            <li><a href="#file_write">Dosyaya Veri Yazmak » <b>file::write()</b></a></li>
            <li><a href="#file_append">Dosyaya Veri Yazmak » <b>file::append()</b></a></li> 
            <li><a href="#file_create">Dosya Oluşturmak »<b>file::create()</b></a></li>
            <li><a href="#file_delete">Dosya Silmek »<b>file::delete()</b></a></li>
            <li><a href="#file_contents">Dosya İçeriğini Almak » <b>file::contents()</b></a></li>   
            <li><a href="#file_find">Dosya İçinde Arama Yapmak » <b>file::find()</b></a></li>               
            <li><a href="#file_permission">Dosya İzinlerini Yönetmek » <b>file::permission()</b></a></li>
            <li><a href="#file_create_date">Dosyanın Oluşturulma Tarihini Öğrenmek » <b>file::create_date()</b></a></li>
            <li><a href="#file_create_date">Dosyanın Değiştirilme Tarihini Öğrenmek » <b>file::change_date()</b></a></li> 
            <li><a href="#file_size">Dosyanın Boyutunu Öğrenmek » <b>file::size()</b></a></li>
            <li><a href="#file_zip_extract">Zip Dosyasını Çıkartmak » <b>file::zip_extract()</b></a></li>     
        </ul>
    </li></ul>
    
    <p class="cstfont" id="file_import">File Kütüphanesini Dahil Etmek</p>
    <div type="code">
  	import::library(<sf>'File'</sf>);
    </div>
    
    
   	<p class="cstfont" id="file_read">Dosya Okumak</p>
    <p><ftype> file::read( <kf>string</kf> <vf>$dosya_yolu</vf> )</ftype></p>
    <p>Dosya okumak için kullanılır. 1 parametresi vardır.</p>
    
    <p>
    	<table class="cfont">
        	<tr><th>Parametre</th><td>Anlamları</td></tr>
            <tr><th>1. Parametre = Dosya Yolu</th><td>Okunacak dosyanın yolunu ifade eder.</td></tr>
        </table>
    </p>
	<p><div type="code"><strong>file::read</strong>(<sf>'x/ornek.txt'</sf>); <comment> // x/ornek.txt dosyasının içeriğini okuyacaktır.</comment></div></p>
    
    <p class="cstfont" id="file_write">Dosyadaki Veri Üzerine Yazmak</p>
    <p><ftype> file::write( <kf>string</kf> <vf>$dosya_yolu</vf> , <kf>string</kf> <vf>$yazilacak_veri</vf> )</ftype></p>
    <p>Dosyaya veri yazmak için kullanılır. 2 parametresi vardır.</p>
    
    <p>
    	<table class="cfont">
        	<tr><th>Parametre</th><td>Anlamları</td></tr>
            <tr><th>1. Parametre = Dosya Yolu</th><td>Veri yazılacak dosyanın yolunu ifade eder.</td></tr>
            <tr><th>2. Parametre = Yazılacak Veri</th><td>Yazılacak verileri ifade eder.</td></tr>
        </table>
    </p>
    
	<p><div type="code">
    <strong>file::write(</strong><sf>'x/ornek.txt'</sf>, <sf>'ZN'ye Hoş Geldiniz.'</sf>); <comment> // x/ornek.txt dosyasına veriyi yazdırdık.</comment><br>
  	<strong>file::read</strong>(<sf>'x/ornek.txt'</sf>); <comment> // x/ornek.txt dosyasının içeriğini okuyacaktır.</comment></div>
    </p>
    
    <p class="cstfont" id="file_append">Dosyadaki Verinin Devamına Yazmak</p>
    <p><ftype> file::append( <kf>string</kf> <vf>$dosya_yolu</vf> , <kf>string</kf> <vf>$yazilacak_veri</vf> )</ftype></p>
    <p>Dosyaya veri yazmak için kullanılır ancak write() fonksiyonu sayfanın içini silip sadece veriyi yazarken append() sayfadaki veriye dokunmadan devamına yazar. 2 parametresi vardır.</p>
    
    <p>
    	<table class="cfont">
        	<tr><th>Parametre</th><td>Anlamları</td></tr>
            <tr><th>1. Parametre = Dosya Yolu</th><td>Veri yazılacak dosyanın yolunu ifade eder.</td></tr>
            <tr><th>2. Parametre = Yazılacak Veri</th><td>Yazılacak verileri ifade eder.</td></tr>
        </table>
    </p>
    
	<p><div type="code">
    <strong>file::append</strong>(<sf>'x/ornek.txt'</sf>, <sf>'ZN'ye Hoş Geldiniz.'</sf>); <comment> // x/ornek.txt dosyasına veriyi yazdırdık.</comment><br>
    file::read(<sf>'x/ornek.txt'</sf>); <comment> // x/ornek.txt dosyasının içeriğini okuyacaktır.</comment></div>
    </p>
    
    
    <p class="cstfont" id="file_create">Dosya Oluşturmak</p>
    <p><ftype> file::create( <kf>string</kf> <vf>$dosya_adi</vf> )</ftype></p>
    <p>Dosyayı silmek için kullanılır. 1 parametresi vardır.</p>
    
    <p>
    	<table class="cfont">
        	<tr><th>Parametre</th><td>Anlamları</td></tr>
            <tr><th>1. Parametre = Dosya Yolu/Adı</th><td>Oluşturulacak dosyanın yolunu veya adını ifade eder.</td></tr>
        </table>
    </p>
    
	<p><div type="code">
    <strong>file::create</strong>(<sf>'x/ornek.txt'</sf>); <comment> // x/ dizinine ornek.txt dosyası oluşturduk.</comment></div>
    </p>
    
    <div type="note"><div>NOT</div><div>Dosyayı yazdırabilmeniz için yazdıracağınız dizinin var olması gerekir.</div></div>
    
    
     <p class="cstfont" id="file_delete">Dosya Silmek</p>
     <p><ftype> file::delete( <kf>string</kf> <vf>$dosya_yolu</vf> )</ftype></p>
    <p>Dosyayı silmek için kullanılır. 1 parametresi vardır.</p>
    
    <p>
    	<table class="cfont">
        	<tr><th>Parametre</th><td>Anlamları</td></tr>
            <tr><th>1. Parametre = Dosya Yolu/Adı</th><td>Oluşturulacak dosyanın yolunu veya adını ifade eder.</td></tr>
        </table>
    </p>
    
	<p><div type="code">
    <strong>file::delete(</strong><sf>'x/ornek.txt'</sf>); <comment> // x/ornek.txt dosyasını sildik.</comment></div>
    </p>
    
    <p class="cstfont" id="file_contents">Dosyanın İçeriğini Çekmek</p>
    <p><ftype> file::contents( <kf>string</kf> <vf>$dosya_yolu</vf> )</ftype></p>
    <p>Dosyanın içeriğini almak için kullanılır. 1 parametresi vardır.</p>
    
    <p>
    	<table class="cfont">
        	<tr><th>Parametre</th><td>Anlamları</td></tr>
            <tr><th>1. Parametre = Dosya Yolu/Adı</th><td>İçeriği alınacak dosyanın yolunu veya adını ifade eder.</td></tr>
        </table>
    </p>
    
	<p><div type="code">
    <vf>$icerik</vf> = <strong>file::contents</strong>(<sf>'x/ornek.txt'</sf>); <comment> // x/ dizinindeki ornek.txt dosyasının içeriğini aldık.</comment>
    </div>
    </p>
    
    <div type="note"><div>NOT</div><div>file::read() fonksiyonundan farkı içeriği bir değişkene aktararak kullanıyoruz. Oysa file::read() fonksiyonunda içeriği doğrudan ekrana yazdırıyordu.</div></div>
    
    
    <p class="cstfont" id="file_find">Dosya İçinde Aramak</p>
    <p><ftype> file::find( <kf>string</kf> <vf>$dosya_yolu</vf> , <kf>string</kf> <vf>$aranacak_veri</vf> )</ftype></p>
    <p>Dosyanın içinde arama yapmak için kullanılır. 2 parametresi vardır.</p>
    
    <p>
    	<table class="cfont">
        	<tr><th>Parametre</th><td>Anlamları</td></tr>
            <tr><th>1. Parametre = Dosya Yolu/Adı</th><td>İçeriği alınacak dosyanın yolunu veya adını ifade eder.</td></tr>
            <tr><th>2. Parametre = Aranacak Veri</th><td>Dosya içerisinde aranacak veriyi ifad eder.</td></tr>
        </table>
    </p>
    
    <p><cf>file::find()</cf> çalıştırıldıktan sonra iki değer döndürür. <b>index</b> ve <b>contents</b>.</p>
    
	<p><div type="code">
    <pre>
    <vf>$index_numarasi</vf> = <strong>file::find</strong>(<sf>'x/ornek.txt'</sf>)->index; <comment> // Sonuç bulunursa kelimenin ilk harfinin index numarasını verecektir.</comment>
    <vf>$icerik</vf> = <strong>file::find</strong>(<sf>'x/ornek.txt'</sf>)->contents; <comment> // Sayfanın içeriğini verir.</comment>
    <kf>echo</kf> <sf>'Bulunan Kelimenin Index Numarası: '</sf>.<vf>$index_numarasi</vf>;
    <kf>echo</kf> <sf>'Sayfanın İçeriği: '</sf>.<vf>$icerik</vf>;
    </pre></div>
    </p>
    
    <p class="cstfont" id="file_permission">Dosyaya İzinler Vermek</p>
    <p><ftype> file::permission( <kf>string</kf> <vf>$dosya_adi</vf> , [ <kf>numeric</kf> <vf>$izin_numarasi</vf> = <if>0775</if> ] </pf>)</ftype></p>
    <p>Dosyanın kullanımına izin vermek için kullanılır. 2 parametresi vardır.</p>
    
   <p>
    	<table class="cfont">
        	<tr><th>Parametre</th><td>Anlamları</td></tr>
            <tr><th>1. Parametre = Dosya Yolu/Adı</th><td>İzin verilecek dosyanın yolunu veya adını ifade eder.</td></tr>
            <tr><th>2. Parametre = İzin Numarası</th><td>0777, 0775 gibi yetki numaraları.</td></tr>
        </table>
    </p>
    
	<p><div type="code">
    <strong>file::permission</strong>(<sf>'x/ornek.txt'</sf>,0777); <comment> // ornek.txt dosyasına hem okuma hem yazma izni vermiş olduk.</comment>
    </div>
    </p>
    
    <p class="cstfont" id="file_create_date">Dosya Oluşturmak ve Değiştirilme Tarihini Öğrenmek</p>
    <p><ftype> file::create_date( <kf>string</kf> <vf>$dosya_yolu</vf> , <kf>string</kf> <vf>$tarih_bilgisi_formati</vf> = <sf>'d.m.Y G:i:s'</sf> )</ftype></p>
    <p><ftype> file::change_date( <kf>string</kf> <vf>$dosya_yolu</vf> , <kf>string</kf> <vf>$tarih_bilgisi_formati</vf> = <sf>'d.m.Y G:i:s'</sf> )</ftype></p>
    <p>Dosyanın oluşturma tarihini öğrenmek için kullanılır. 2 parametresi vardır.</p>
    
   <p>
    	<table class="cfont">
        	<tr><th>Parametre</th><td>Anlamları</td></tr>
            <tr><th>1. Parametre = Dosya Yolu/Adı</th><td>Oluşturma tarihi öğrenilecek dosyanın yolunu veya adını ifade eder.</td></tr>
            <tr><th>2. Parametre = [Tarih Bilgisi Formatı]</th><td>Varsayılan tarih bilgisi "d.m.Y G:i:s".</td></tr>
        </table>
    </p>
    
	<p><div type="code">
    <kf>echo</kf> <strong>file::create_date</strong>(<sf>'x/ornek.txt'</sf>); <comment> // Çıktı: 20.01.2015 16:28:41</comment>
    <kf>echo</kf> <strong>file::change_date</strong>(<sf>'x/ornek.txt'</sf>); <comment> // Çıktı: 20.01.2015 16:47:31</comment>
    </div>
    </p>
    
    
     <p class="cstfont" id="file_create_date">Dosya Boyutunu Öğrenmek</p>
     <p><ftype> file::size( <kf>string</kf> <vf>$dosya_yolu</vf> , [ <kf>string</kf> <vf>$boyut_bilgisi_turu</vf> = <sf>'b'</sf> ] )</ftype></p>
    <p>Dosyanın boyutunu öğrenmek için kullanılır. 2 parametresi vardır.</p>
    
   <p>
    	<table class="cfont">
        	<tr><th>Parametre</th><td>Anlamları</td></tr>
            <tr><th>1. Parametre = Dosya Yolu/Adı</th><td>Oluşturma tarihi öğrenilecek dosyanın yolunu veya adını ifade eder.</td></tr>
            <tr><th>2. Parametre = [Tip]</th><td>Varsayılan boyut bilgisi "byte".</td></tr>
        </table>
    </p>
    
     <p>
    	<table class="cfont">
        	<tr><th>Tip Parametresi 4 Farklı Değer Alır</th><td>Anlamları</td></tr>
            <tr><th>b</th><td>Bytes</td></tr>
            <tr><th>kb</th><td>Kilo Bytes</td></tr>
            <tr><th>mb</th><td>Mega Bytes</td></tr>
            <tr><th>gb</th><td>Giga Bytes</td></tr>
        </table>
    </p>
    
    
	<p><div type="code">
    <kf>echo</kf> <strong>file::size</strong>(<sf>'x/ornek.txt'</sf>,<sf>'b'</sf>); <comment> // Çıktı: 62</comment><br>
    <kf>echo</kf> <strong>file::size</strong>(<sf>'x/ornek.txt'</sf>,<sf>'kb'</sf>); <comment> // Çıktı: 0.06</comment><br>
    <kf>echo</kf> <strong>file::size</strong>(<sf>'x/ornek.txt'</sf>,<sf>'mb'</sf>); <comment> // Çıktı: 0</comment>
    </div>
    </p>
    
    <p class="cstfont" id="file_zip_extract">Zip Dosyalarını Çıkarmak</p>
    <p><ftype> file::zip_extract( <kf>string</kf> <vf>$zip_dosyasi_yolu</vf> , <kf>string</kf> <vf>$cikarilacak_dizin</vf> )</ftype></p>
    <p>Zip dosyalarını çıkarmak için kullanılır. 2 parametresi vardır.</p>
    
   <p>
    	<table class="cfont">
        	<tr><th>Parametre</th><td>Anlamları</td></tr>
            <tr><th>1. Parametre = Zip Dosyası</th><td>Zip dosyasının adı veya yolunu ifade eder.</td></tr>
            <tr><th>2. Parametre = Dosyaların Çıkartılacağı Dizin</th><td>Çıkarma işlemin yapılacağı hedef dizini ifade eder.</td></tr>
        </table>
    </p>
    
	<p><div type="code">
   <strong> file::zip_extract</strong>(<sf>'x/ornek.zip'</sf>,<sf>'x/'</sf>); <comment> // ornek.txt dosyasına hem okuma hem yazma izni vermiş olduk.</comment>
    </div>
    </p>
    
    
    <div type="prev-next">
    	<div type="prev-btn"><a href="lib_encode.html">Önceki</a></div><div type="next-btn"><a href="lib_folder.html">Sonraki</a></div>
    </div>
 
</body>
</html>              