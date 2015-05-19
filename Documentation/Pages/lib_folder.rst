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
    <div id="content-document"><a href="#">Döküman</a> » <a href="libraries.html">Kütüphaneler</a> » Folder Sınıfı</div> 
    <p class="ctfont">Folder(Dizin) Sınıfı</p>
    <p>Dizinleri daha kolay yönetmek için geliştirilmiş sınıftır.</p>
    <ul><li><a href="#" class="infont">Folder(Dizin) Sınıfı ve Yöntemleri</a><br><br>
        <ul>
        	<li><a href="#folder_import">Folder Kütüphanesini Dahil Etmek</a></li>
            <li><a href="#folder_create">Dizin Oluşturmak » <b>folder::create()</b></a></li>
            <li><a href="#folder_delete_empty">Boş Dizini Silmek » <b>folder::delete_empty()</b></a></li>
            <li><a href="#folder_delete">Tüm Dizini Silmek » <b>db::delete()</b></a></li> 
            <li><a href="#folder_copy">Tüm Dizini Kopyalamak » <b>folder::copy()</b></a></li>
            <li><a href="#folder_files">Dizin İçindeki İstenilen Dosya ve Dizinleri Öğrenmek » <b>folder::files()</b></a></li>
            <li><a href="#folder_all_files">Dizin İçindeki Tüm Dosya ve Dizinleri Öğrenmek » <b>folder::all_files()</b></a></li>   
            <li><a href="#folder_permission">Dosya Yetkilerini Düzenlemek » <b>folder::permission()</b></a></li>               
   
        </ul>
    </li></ul>
    
    <p class="cstfont" id="folder_import">Folder Kütüphanesini Dahil Etmek</p>
    <div type="code">
  	import::library(<sf>'Folder'</sf>);
    </div>
    
   	<p class="cstfont" id="folder_create">Dizin Oluşturmak</p>
    <p><ftype> folder::create( <kf>string</kf> <vf>$dizin_yolu</vf> , [ <kf>numeric</kf> <vf>$dizin_yetkisi</vf> = <if>0755</if> ] )</ftype></p>
    <p>Dizin oluşturmak için kullanılır. 2 parametresi vardır. Dizin Adı, İzinler</p>
    
    <p>
    	<table class="cfont">
        	<tr><th>Parametre</th><td>Anlamları</td></tr>
            <tr><th>1. Parametre = Dizin Adı</th><td>Oluşturulacak dizin adını ifade eder.</td></tr>
            <tr><th>1. Parametre = [İsteğe Bağlı - İzinler] Varsayılan: 0755</th><td>Oluşturulacak dizinin yetkileri. </td></tr>
        </table>
    </p>
	<p><div type="code"><strong>folder::create</strong>(<sf>'x/OrnekDizin'</sf>, 0755); <comment> // x/ dizini içerisine OrnekDizin adlı yeni dizin oluşturacaktır.</comment></div></p>
    
    
    <p class="cstfont" id="folder_delete_empty">Boş Dizini Silmek</p>
    <p><ftype> folder::delete_empty( <kf>string</kf> <vf>$dizin_adi</vf> )</ftype></p>
    <p>Dizin içerisinde hiç bir dosya veya dizin yok ise kullanılabilir. Tek parametresi vardır. Dizin Adı.</p>
    
    <p>
    	<table class="cfont">
        	<tr><th>Parametre</th><td>Anlamları</td></tr>
            <tr><th>1. Parametre = Dizin Adı</th><td>Silinecek dizin adını ifade eder.</td></tr>
        </table>
    </p>
	<p><div type="code"><strong>folder::delete_empty</strong>(<sf>'x/OrnekDizin'</sf>); <comment> // x/ dizini içerisindeki OrnekDizin adlı dizini silecektir.</comment></div></p>
    
    
    <p class="cstfont" id="folder_delete">Tüm Dizini Silmek</p>
    <p><ftype> folder::delete( <kf>string</kf> <vf>$dizin_adi</vf> )</ftype></p>
    <p>Dizini içerisindeki tüm dosya ve dizinlerle birlikte siler. Tek parametresi vardır. Dizin Adı</p>
    
    <p>
    	<table class="cfont">
        	<tr><th>Parametre</th><td>Anlamları</td></tr>
            <tr><th>1. Parametre = Dizin Adı</th><td>Silinecek dizin adını ifade eder.</td></tr>
        </table>
    </p>
	<p><div type="code"><strong>folder::delete</strong>(<sf>'x/DizinVeIcindekiler'</sf>); <comment> // x/ dizini içerisindeki DizinVeIcindekiler adlı dizini ve içerisindeki dosya ve dizinleri silecektir.</comment></div></p>
    
    
    <p class="cstfont" id="folder_copy">Tüm Dizini Kopyalamak</p>
    <p><ftype> folder::copy( <kf>string</kf> <vf>$kaynak_dizin</vf> , <kf>string</kf> <vf>$hedef_dizin</vf> )</ftype></p>
    <p>Dizini içerisindeki tüm dosya ve dizinlerle birlikte kopyalar. 2 parametresi vardır. Kaynak Dizin, Hedef Dizin</p>
    
    <p>
    	<table class="cfont">
        	<tr><th>Parametre</th><td>Anlamları</td></tr>
            <tr><th>1. Parametre = Kaynak Dizin</th><td>Kopyalanacak dizin adı.</td></tr>
            <tr><th>2. Parametre = Hedef Dizin</th><td>Kopyalama işleminin yapılacağı dizin.</td></tr>
        </table>
    </p>
	<p><div type="code"><strong>folder::copy</strong>(<sf>'x/DizinVeIcindekiler'</sf>,<sf>'x/YeniDizin'</sf>); <comment> // x/ dizini içerisindeki DizinVeIcindekiler adlı dizini ve içerisindeki dosya ve dizinleri x/ dizini içerisindeki YeniDizin adlı dizine kopyalayacaktır.</comment></div></p>
    
     <p class="cstfont" id="folder_files">Dizin İçindeki İstenilen Dosya ve Dizinleri Öğrenmek</p>
     <p><ftype> folder::files( <kf>string</kf> <vf>$hedef_dizin</vf> , [ <kf>string</kf> <vf>$dosya_uzantisi</vf> ] )</ftype></p>
    <p>Dizini içerisindeki istenilen tüm dosya ve dizinlerlerin listesini almak için kullanılır. 2 parametresi vardır. Hedef Dizin, Uzantı</p>
    
    <p>
    	<table class="cfont">
        	<tr><th>Parametre</th><td>Anlamları</td></tr>
            <tr><th>1. Parametre = Hedef Dizin</th><td>İçindekileri listelenecek dizin adı.</td></tr>
            <tr><th>2. Parametre = [İsteğe Bağlı - Uzantı]</th><td>Listede görüntülenmesi istenen uzantılı dosyalar. Hiç bir parametrik değer girilmez ise tüm dosya ve dizinleri listeleyecektir.</td></tr>
        </table>
    </p>
	<p><div type="code"><ff>var_dump</ff>(<strong>folder::files</strong>(<sf>'x/DizinVeIcindekiler'</sf>)); <comment> // x/DizinVeIcindekiler dizini içerisindeki dosya ve dizinleri listeleyecektir.</comment></div></p>
    <p><b>html</b> uzantılı dosyaları listeyelim.</p>
    <p><div type="code"><ff>var_dump</ff>(<strong>folder::files</strong>(<sf>'x/DizinVeIcindekiler'</sf>,<sf>'html'</sf>)); <comment> // x/DizinVeIcindekiler dizini içerisindeki html uzantılı dosyaları listeleyecektir.</comment></div></p>
    <p>Sadece <b>dizinleri</b> listeyelim.</p>
    <p><div type="code"><ff>var_dump</ff>(<strong>folder::files</strong>(<sf>'x/DizinVeIcindekiler'</sf>,<sf>'dir'</sf>)); <comment> // x/DizinVeIcindekiler dizini içerisindeki sadece dizinleri listeleyecektir.</comment></div></p>
    
    
    <p class="cstfont" id="folder_all_files">Dizin İçindeki Tüm Dosya ve Dizinleri Öğrenmek</p>
    <p><ftype> folder::all_files(<kf>string</kf> <vf>$hedef_dizin</vf> )</ftype></p>
    <p>Dizin içerisindeki tüm dosya ve dizinlerlerin listesini almak için kullanılır. Tek parametresi vardır. Hedef Dizin</p>
    
    <p>
    	<table class="cfont">
        	<tr><th>Parametre</th><td>Anlamları</td></tr>
            <tr><th>1. Parametre = [İsteğe Bağlı - Hedef Dizin] Varsayılan: *</th><td>İçindekileri listelenecek dizin adı.</td></tr>
        
        </table>
    </p>
	<p><div type="code"><ff>var_dump</ff>(<strong>folder::all_files</strong>(<sf>'x/DizinVeIcindekiler'</sf>)); <comment> // x/DizinVeIcindekiler dizini içerisindeki dosya ve dizinleri listeleyecektir.</comment></div></p>
    
    
     <p class="cstfont" id="folder_permission">Dizin İzinlerini Düzenlemek</p>
     <p><ftype> folder::permission( <kf>string</kf> <vf>$hedef_dizin</vf> , [ <kf>numeric</kf> <vf>$dizin_yetki_numarasi</vf> = <if>0755</if> ] )</ftype></p>
    <p>Dizinlere izinlerini düzenlemek için kullanılır. 2 parametresi vardır. Hedef Dizin, İzinler</p>
    
   <p>
    	<table class="cfont">
        	<tr><th>Parametre</th><td>Anlamları</td></tr>
            <tr><th>1. Parametre = Hedef Dizin</th><td>İzinleri düzenlenecek dizin</td></tr>
            <tr><th>2. Parametre = İzinler</th><td>Verilecek izin türü.</td></tr>
        </table>
    </p>
	<p><div type="code"><ff>var_dump</ff>(<strong>folder::permission</strong>(<sf>'x/DizinVeIcindekiler'</sf>, 0777)); <comment> // x/DizinVeIcindekiler dizinini silme, okuma ve değiştirebilme izni verilmiştir.</comment></div></p>

    <div type="prev-next">
    	<div type="prev-btn"><a href="lib_file.html">Önceki</a></div><div type="next-btn"><a href="lib_form.html">Sonraki</a></div>
    </div>
 
</body>
</html>              