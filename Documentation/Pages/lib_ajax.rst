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
    <div id="content-document"><a href="#">Döküman</a> » <a href="libraries.html">Kütüphaneler</a> » Ajax Sınıfı</div> 
    <p class="ctfont">Ajax Sınıfı</p>
    <p>Ajax ilemleri, veri gönderme, veri döndürme ve sayfalama gibi metotlar(fonksiyonlar) içeren sınıftır. Şimdi bu metotların kullanımını açıklayalım.</p>
    <ul><li><a href="#" class="infont">Ajax Sınıfı ve Yöntemleri</a><br><br>
        <ul>
        	<li><a href="#ajax_import">Ajax Kütüphanesini Dahil Etmek</a></li>
            <li><a href="#ajax_send">Ajax ile Veri Göndermek » <b>ajax::send()</b></a></li>
            <li><a href="#ajax_json_send_back">JSON Tipinde Veri Döndürmek » <b>ajax::json_send_back()</b></a></li>
            <li><a href="#ajax_send_back">Veri Döndürmek » <b>ajax::send_back()</b></a></li>
            <li><a href="#ajax_dump">Gelen Verileri Kontrol Etmek » <b>ajax::pr()</b></a></li>
            <li><a href="#ajax_dump">Gelen Verileri Değer Kontrol Etmek » <b>ajax::dump()</b></a></li>
            <li><a href="#ajax_pagination">Ajax Yöntemiyle Sayfalama Yapmak » <b>ajax::pagination()</b></a></li>
            
        </ul>
    </li></ul>
    
    <p class="cstfont" id="ajax_import">Ajax Kütüphanesini Dahil Etmek</p>
    <div type="code">
  	import::library(<sf>'Ajax'</sf>);
    </div>
    
   	<p class="cstfont" id="ajax_send">Ajax ile Veri Gönderme Yöntemi</p>
    <p><ftype>ajax::send( <kf>array</kf> <vf>$ayarlar</vf> )</ftype></p>
   	
    <p>
    Ayarlar dizisinde kullanılabilir parametreler.
    	<table class="cfont">
        	<tr><th>No</th><th>Ayarlar</th><td>Kullanımı</td></tr>
            <tr><th>1</th><th>type</th><td>[ type => post ]</td></tr>
            <tr><th>2</th><th>dataType</th><td>[ dataType => json ]</td></tr>
            <tr><th>3</th><th>url</th><td> url => http://www.ornek.com/ajax </td></tr>
            <tr><th>4</th><th>data</th><td> data => deger=1 </td></tr>
            <tr><th>5</th><th>success</th><td> success => kodlar </td></tr>
            <tr><th>6</th><th>error</th><td> error => kodlar </td></tr>
            <tr><th>7</th><th>complete</th><td> complete => kodlar </td></tr>
            <tr><th>8</th><th>beforeSend</th><td> beforeSend => kodlar </td></tr>
            <tr><th>9</th><th>done</th><td> done => kodlar </td></tr>
        </table>
    </p>
    
    <p>Ajax işleminde veri göndermek için <cf>ajax::send()</cf> fonksiyonu kullanılır. Bu yöntem <strong>jquery kodları barındırdığı için</strong> bu yöntemi kullanmadan önce <strong>Jquery</strong> script dosyasının dahil edilmesi gerekir. Aşağıda bu yöntemin nasıl kullandığını anlatan örnek yer almaktadır. </p>
    <p><b>Controllers/Anasayfa.php</b> sayfanıza aşağıda yer alan kodları ekleyiniz.</p>
    
    <div type="code">
    <pre><x><</x>?php
<kf>class</kf> Anasayfa
{
	<kf>public</kf> <ff>function</ff> index()
        {
            import::library(<sf>'Ajax'</sf>); <comment>// Önce Ajax sınıf dahil edilir. </comment>
            
            <vf>$ajax_veriler</vf> = <kf>array</kf>(
            	<sf>'type'</sf> => <sf>'post'</sf>,			<comment>// Bu satır kullanılmadığında varsayılan değer:post'tur. </comment>   
                <sf>'dataType'</sf> => <sf>'json'</sf>,     		<comment>// Bu satır kullanılmadığında varsayılan değer:json'dur.</comment>     			
            	<sf>'url'</sf> => <sf>'Ajax/Ajax_islemleri'</sf>,		<comment>// Verilerin gönderildiği sayfa. Bu sayfa aşağıdaki diğer konuda verilmiştir.</comment> 
                <sf>'data'</sf> => <sf>'deger=1'</sf>,			<comment>// 1 değeri gönderdik.</comment> 
                <sf>'success'</sf> => <sf>' alert(data.sonuc); '</sf>,	<comment>// Veri başarı ile gönderildikten sonra yapılmak istenen js kodları.</comment> 
                <sf>'error'</sf> => <sf>' alert("Hata!"); '</sf>		<comment>// Veri gönderimi başarısız olursa yapılmak istenen js kodları.</comment>
                
            );
            
            $veriler[<sf>'ajax'</sf>] = <strong>ajax::send</strong>(<vf>$ajax_veriler</vf>);
            import::page(<sf>'anasayfa'</sf>, <vf>$veriler</vf>);
        }
}</pre>
    </div>
    
    <p>Şimdi ise <b>Views/Pages/anasayfa.php</b> sayfanıza aşağıda yer alan kodları ekleyiniz.</p>
    
    <div type="code"><pre><ff><x><</x>html>
<</x>head>
        <</x>title></ff>Anasayfa<ff><</x>/title></ff>
        
        <x><</x>?php import::script(<sf>'Jquery'</sf>); ?> <comment><x><</x>!-- Views/Scripts/Jquery.js dosyasının var olduğu kabul edilmektedir. --></comment>
        
        <tf><x><</x>script></tf>
        	$(document).ready(function(e)){
            		<x><</x>?php <kf>echo</kf> <vf>$ajax</vf>; ?>
            	});	
        <tf><x><</x>/script></tf>
<ff>       
<</x>/head>
<</x>body>
       <</x>h1></ff>Web sitemize hoşgeldiniz.<ff><</x>/h1>
<</x>/body>
<</x>/html></ff></pre></div>

	<p>
    	<div type="note"><div>NOT</div><div>Ajax::send() fonksiyonunu kullanıyorsanız, <b>jquery dosyasını dahil edip</b> gelen ajax verisini, script kodları arasında kullanmanız gerekmektedir. Ancak <strong>Controllers</strong> sayfası içerisinde yazılıp veri olarakta gönderilebilir.</div></div>
    </p>
    
    <p class="cstfont" id="ajax_json_send_back">Ajax İşlemi Sonrasında JSON Tipinde Veri Döndürme</p>
    <p><ftype>ajax::json_send_back( <kf>array</kf> <vf>$geri_gonderilecek_json_tipinde_bilgiler_dizisi</vf> )</ftype></p>
    <p>Ajax ile veri gönderdiğimiz sayfada işlemler sonrasında bir takım verilerin geriye döndürülmesi istenir eğer bu veriler JSON tipinde döndürülmek isteniyorsa bu kod kullanılır. Aşağıda örnek bir uygulama var.</p>
    
    <p><b>Controllers/Ajax/Ajax_islemleri.php</b> dosyamızı aşağıdaki şekilde düzenliyoruz.</p>
    
    <div type="code">
    <pre><x><</x>?php
<kf>class</kf> Ajax_islemleri
{
	<kf>public</kf> <ff>function</ff> index()
        {
            import::library(<sf>'Method'</sf>,<sf>'Ajax'</sf>); <comment>// Post veya Get ile gönderilen bilgileri almak için Method sınıfını dahil ediyoruz. </comment>
            
            <vf>$veriler</vf> = method::post(<sf>'deger'</sf>);
            
            <kf>if</kf>(<vf>$veriler</vf>[<sf>'deger'</sf>] == 1)
            	<vf>$donen_veriler</vf>[<sf>'sonuc'</sf>] = <sf>'İşlem Başarılı.'</sf>;
            <kf>else</kf>
            	<vf>$donen_veriler</vf>[<sf>'sonuc'</sf>] = <sf>'İşlem Başarısız!'</sf>;
                
            <strong>ajax::json_send_back</strong>(<vf>$donen_veriler</vf>);
        }
}</pre>
    </div>
    <p></p>
    <div type="important"><div>ÖNEMLİ</div><div>JSON Tipinde veri döndermek için Ajax ile veri gönderme işlemleri yapılırken <b>dataType="json"</b> olarak ayarlanmalıdır.</div></div>
    
    <p class="cstfont" id="ajax_send_back">Ajax İşlemi Sonrası Veri Döndürme</p>
    <p><ftype>ajax::send_back( <kf>string</kf> <vf>$yazdirilicak_metin</vf> )</ftype></p>
    <p>Yukarıdaki <b>Controllers/Ajax/Ajax_islemleri.php</b> dosyayı baz alırsak aşağıdaki gibi bir kullanım söz konusudur.</p>
    <pre><x><</x>?php
<kf>class</kf> Ajax_islemleri
{
	<kf>public</kf> <ff>function</ff> index()
        {
            import::library(<sf>'Method'</sf>,<sf>'Ajax'</sf>); <comment>// Post veya Get ile gönderilen bilgileri almak için Method sınıfını dahil ediyoruz. </comment>
            
            <vf>$veriler</vf> = method::post(<sf>'deger'</sf>);
            
            <kf>if</kf>(<vf>$veriler</vf>[<sf>'deger'</sf>] == 1)
            	<strong>ajax::send_back</strong>(<sf>'İşlem Başarılı.'</sf>);
            <kf>else</kf>
            	<strong>ajax::send_back</strong>(<sf>'İşlem Başarısız!'</sf>);
            
        }
}</pre>
    </div>
    
    <p></p>
    	<div type="important"><div>ÖNEMLİ</div><div>JSON tipinde veri göndermiyorsak <b>success fonksiyonu içinde</b> dönen değeri kullanmak için <b>data.sonuc</b> yerine <b>data</b> kullanıyoruz.</div></div>
    
    
    <p class="cstfont" id="ajax_dump">Ajax İşlemi Sırasında Gönderilen Değerleri Kontrol Etmek</p>
    <p><ftype>ajax::pr() ve ajax::dump()</ftype></p>
    <p>Gelen değerlerin doğru bir şekilde ulaşıp ulaşmadığını kontrol etmek amacıyla kullanılırlar. Kullanımına aşağıda bir örnek.</p>
    <pre><x><</x>?php
<kf>class</kf> Ajax_islemleri
{
	<kf>public</kf> <ff>function</ff> index()
        {
            import::library(<sf>'Method'</sf>,<sf>'Ajax'</sf>); <comment>// Post veya Get ile gönderilen bilgileri almak için Method sınıfını dahil ediyoruz. </comment>
            
            <vf>$veriler</vf> = method::post(<sf>'deger'</sf>);
            
            <strong>ajax::pr</strong>(<vf>$veriler</vf>); <comment>// Çıktılarını kontrol edebilmek için success fonksiyonu içerisinde yazdırma fonksiyonları ile görebilirsiniz. </comment>
            <strong>ajax::dump</strong>(<vf>$veriler</vf>);
        }
}</pre>
    </div>
    
    <p class="cstfont"  id="ajax_pagination">Ajax Sayfalama Yöntemi</p>
    <p><ftype>ajax::pagination( [ <kf>numeric</kf> <vf>$baslangic</vf> = <if>0</if> ] , [ <kf>numeric</kf> <vf>$limit</vf> = <if>5</if> ] , [ <kf>numeric</kf> <vf>$toplam_kayit</vf> = <if>20</if> ] , [ <kf>array</kf> <vf>$ayarlar</vf> = <kf>array</kf>() ] )</ftype></p>
    <p>Sayfa yenilenmesine gerek kalmadan sayfalama yöntemi kullanabilirsiniz.</p>
    <p>
    <b>1.</b> Birinci parametre <b>kaçıcıncı kayıttan başlayacağını</b> ifade eder.<br>
    <b>2.</b> İkinci parametre bir sayfada <b>en fazla kaç kayıt olacağını</b> ifade eder.<br>
    <b>3.</b> Üçüncü parametre <b>toplam kayıtı</b> ifade eder.<br>
    <b>4.</b> [ Dördüncü parametre ] <b>bir takım ayarlamalar</b> yapmak için kullanılır.<br>
    </p>
    <p>
    Ayarlar parametresinde kullanılabilecek değerler.
    	<table class="cfont">
        	<tr><th>No</th><th>Ayarlar Parametresi</th><td>Anlamları</td></tr>
            <tr><th>1</th><th>[ prev_name = "Önceki" ]</th><td>Bir önceki butonunun adı yani değerini belirler.</td></tr>
            <tr><th>2</th><th>[ next_name = "Sonraki" ]</th><td>Bir sonraki butonunun adı yani değerini belirler.</td></tr>
            <tr><th>3</th><th>style = array()</th><td>Nesnelere stil tanımlamak için kullanılır. Dizi içerisinde 3 ayar adı kulanılır.<br> 1. <strong>current => 'stil adı'</strong> aktif sayfa butonuna stil eklemek için kullanılır.<br>2. <strong>prev => 'stil adı'</strong> bir önceki butonuna stil eklemek için kullanılır.<br>3. <strong>next => 'stil adı'</strong> bir sonraki butonuna class eklemek için kullanılır.</td></tr>
            <tr><th>4</th><th>class = array()</th><td>Nesnelere css tanımlamak için kullanılır. Dizi içerisinde 3 ayar adı kulanılır.<br> 1. <strong>current => 'class adı'</strong> aktif sayfa butonuna stil eklemek için kullanılır.<br>2. <strong>prev => 'class adı'</strong> bir önceki butonuna class eklemek için kullanılır.<br>3. <strong>next => 'class adı'</strong> bir sonraki butonuna class eklemek için kullanılır.</td></tr>
        </table>
    </p>
    <div type="code">
    <pre><x><</x>?php
<kf>class</kf> Anasayfa
{
	<kf>public</kf> <ff>function</ff> index()
        {
            import::library(<sf>'Ajax'</sf>); <comment>// Önce Ajax sınıf dahil edilir. </comment>
            
            <vf>$start</vf> = 0;
            <vf>$limit</vf> = 5;
            <vf>$toplam_kayit</vf> = 20;
            <vf>$ayarlar</vf>[<sf>"class"</sf>] = <kf>array</kf>(<sf>"current"</sf> => <sf>"sayfalama"</sf>);
            
            <kf>echo</kf> <strong>ajax::pagination</strong>(<vf>$start</vf>, <vf>$limit</vf>, <vf>$toplam_kayit</vf>, <vf>$ayarlar</vf>); <comment>// Toplam Kayıt / Limit = Sayfa Sayısı, Toplam 4 sayfa görüntülenecektir.</comment>
        }
}</pre>
    </div>
    
    <p>Çalıştırdığımızda aşağıdaki gibi bir görüntü oluşacaktır.</p>
    <p><img src="../Images/Result/pagination.PNG" /></p>
    
    <p>Kaynak kodda ise şöyle bir çıktı oluşacaktır.</p>
    <p>
   
    <cf>
    <pre><comment><x><</x>div ajax='pagination'>
    <x><</x>input type='button' page='0' value='1'>
    <x><</x>input type='button' page='4' value='2'>
    <x><</x>input type='button' page='9' value='3'>
    <x><</x>input type='button' page='14' value='4'>
    <x><</x>input type='button' page='5' value='Sonraki'>
<x><</x>/div></comment></pre>   
    </cf>
   
	</p>
    
    <p><strong>div[ ajax="pagination" ]</strong> anahtar değeri içeren bir divin içerisine görüldüğü gibi inputların oluşturulması mantığında bir çıktı oluşur. Siz <strong>bu anahtar değer çiftini kullanarak</strong> inputlara erişebilirsiniz.</p>
    
    <p><strong>input[ page="x" ]</strong> yapısı bir sonraki sayfanın kaçıncı kayıttan başlayacağını ifade eder. <strong>Yani page='4' demek 2. sayfa, 4. kayıttan itibaren listelenmeye başlacaktır</strong> demektir.</p>
    
    <p><div type="note"><div>NOT</div><div>Kod çalıştırıldığında sadece numaralı inputlar listelenecektir. Gerekli ajax kodlarınız sizin yazmanız gerekmektedir.</div></div></p>
    
    <div type="prev-next">
    	<div type="prev-btn"><a href="libraries.html">Önceki</a></div><div type="next-btn"><a href="lib_bench.html">Sonraki</a></div>
    </div>
 
</body>
</html>              