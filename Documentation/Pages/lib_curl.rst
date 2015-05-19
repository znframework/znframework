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
    <div id="content-document"><a href="#">Döküman</a> » <a href="libraries.html">Kütüphaneler</a> » CURL Sınıfı</div> 
    <p class="ctfont"> Clien URL Sınıfı</p>
    <p>CURL Sınıfı ile başka sitelerin içeriğini çekme, dosya indirme, çerez oluşturma gibi bir çok işi yerine getirir.</p>
    <ul><li><a href="#" class="infont">CURL Sınıfı ve Yöntemleri</a><br><br>
        <ul>
       		<li><a href="#curl_import">Curl Kütüphanesini Dahil Etmek</a></li>
            <li><a href="#curl_open">CURL Uygulamasını Başlatmak » <b>curl::open()</b></a></li>
            <li><a href="#curl_settings">CURLOPT_XXX Seçenekleri Eklemek » <b>curl::settings()</b></a></li>
            <li><a href="#curl_execute">CURL Uygulamasını Çalıştırmak » <b>curl::execute()</b></a></li>  
            <li><a href="#curl_close">CURL Uygulamasını Kapatmak » <b>curl::close()</b></a></li>      
            <li><a href="#curl_info">CURL Uygulaması Hakkında CURLINFO_XXX Bilgisi Almak » <b>curl::info()</b></a></li>
            <li><a href="#curl_error">CURL Uygulaması Esnasında Hata Kontrolü Yapmak » <b>curl::error()</b></a></li>
            <li><a href="#curl_error">Hata Numarasını Öğrenmek » <b>curl::errno()</b></a></li> 
            <li><a href="#curl_error">Hatanın Ne Olduğunu Öğrenmek » <b>curl::errval()</b></a></li>        
            <li><a href="#curl_version">CURL Versiyonunu Öğrenmek » <b>curl::version()</b></a></li>
        </ul>
    </li></ul>
    
    
    <p class="cstfont" id="curl_import">Curl Kütüphanesini Dahil Etmek</p>
    <div type="code">
  	import::library(<sf>'Curl'</sf>);
    </div>
    
    
   	<p class="cstfont" id="curl_open">CURL İşlemi Başlatmak</p>
    <p><ftype> curl::open( [ <kf>string</kf> <vf>$url</vf> ] )</ftype></p>
   	<p>Bir curl oturumunun başlatılmasını sağlar. 1 parametresi vardır.</p>
    <p>
    <table class="cfont">
    	<tr><th>Parametreler</th><td>Varsayılan Değer</td><td>Alacağı Değer</td><td>Anlamı</td></tr>
        <tr><th>URL</th><td>NULL</td><td>'herhangi bir url'</td><td>bağlantının kurulacağı url belirtilir.</td></tr>
    </table>
    </p>
    <div type="code">
    <pre><x><</x>?php
<kf>class</kf> CurlIslemleri
{
	<kf>public</kf> <ff>function</ff> index()
        {
            import::library(<sf>'Curl'</sf>); <comment>// Önce Curl sınıfı dahil edilir. </comment>
            
            <vf>$site</vf> = <sf>'http://www.ornek.com'</sf>;
            <strong>curl::open</strong>(<vf>$site</vf>); <comment>// Şuanda curl oturumunu başlatmış olduk.</comment>
        }
}</pre>
    </div>
    
    <p class="cstfont" id="curl_settings">CURL Ayar Seçenekleri Eklemek</p>
    <p><ftype> curl::settings( <kf>string/array</kf> <vf>$ayarlar</vf> , <kf>string/boolean</kf> <vf>$deger</vf> )</ftype></p>
   	<p>Bir curl işlemleri için seçeneklerin belirlenmesini sağlar. 2 parametresi vardır.</p>
    <p>
    <table class="cfont">
    	<tr><th>Parametreler</th><td>Varsayılan Değer</td><td>Alacağı Değer</td><td>Anlamı</td></tr>
        <tr><th>Eğer birden fazla seçenek kullanılacaksa 1. Parametreye dizi değişken gönderilir.</th><td>array()</td><td>1. Parametre = array('senecek_adi' => 'secenek_degeri')</td><td>curl işlemleri için hangi seçeneklerin seçileceği belirtilir.</td></tr>
        <tr><th>Tek bir seçenek kullanılacaksa 2 parametre gönderilir.</th><td>NULL</td><td>1. Parametre = 'senecek_adi', 2. Parametre = 'secenek_degeri'</td><td>curl işlemleri için hangi seçeneklerin seçileceği belirtilir.</td></tr>
    </table>
    </p>
     <p>CURLOPT_XXX Tipindeki seçenekler <b>Config/Curl.php</b> doyasında düzenlenmiş ve yeni değerler kazanmıştır yani CURLOPT_COOKIESESSION böyle bir ifade 'cookie_session' şeklinde düzenlenmiştir gördüğünüz gibi CURLOPT ibaresi kaldırılmış ve kalan bölüm küçük harfle yazılıp sözcükler arasına alt tire konulmuştur. Değişikliklere <b>Config/Curl.php</b> buradan bakabilirsiniz. Yinede CURLOPT_XXX tipindeki seçeneklerinide kullanabilirsiniz.</p>
   
    <div type="code">
    <pre><x><</x>?php
<kf>class</kf> CurlIslemleri
{
	<kf>public</kf> <ff>function</ff> index()
        {
            import::library(<sf>'Curl'</sf>); <comment>// Önce Curl sınıfı dahil edilir. </comment>
            
            <vf>$site</vf> = <sf>'http://www.ornek.com'</sf>;
            curl::open(<vf>$site</vf>); <comment>// Şuanda curl oturumunu başlatmış olduk.</comment>
            <vf>$opt</vf> = <kf>array</kf>(
            	<sf>'return_transfer'</sf> => <kf>true</kf>,
                <sf>'header'</sf> => <kf>true</kf>
            );
            <strong>curl::settings</strong>(<vf>$opt</vf>); <comment>// Ayarlar belirlendi.</comment>
        }
}</pre>
    </div>
    <p>Seçenekleri aşağıdaki gibi standart curl tipindede yazabilirsiniz.</p>
    <div type="code">
    <pre><x><</x>?php
<kf>class</kf> CurlIslemleri
{
	<kf>public</kf> <ff>function</ff> index()
        {
            import::library(<sf>'Curl'</sf>); <comment>// Önce Curl sınıfı dahil edilir. </comment>
            
            <vf>$site</vf> = <sf>'http://www.ornek.com'</sf>;
            curl::open(<vf>$site</vf>); <comment>// Şuanda curl oturumunu başlatmış olduk.</comment>
            <vf>$opt</vf> = <kf>array</kf>(
            	<tf>CURLOPT_RETURNTRANSFER</tf> => <kf>true</kf>,
                <tf>CURLOPT_HEADER</tf> => <kf>true</kf>
            );
            <strong>curl::settings</strong>(<vf>$opt</vf>); <comment>// Ayarlar belirlendi.</comment>
        }
}</pre>
    </div>
		
    <p>Yukarıda settings() yönteminde birden fazla seçenek kullanıldığı için seçenekler dizi olarak gönderildi. Tek bir seçenek yollasaydık aşağıdaki gibide kullanabilirdiniz.</p>
    <div type="code">curl::settings(<sf>'return_transfer'</sf>, <kf>true</sf>);</div>
    
    <p class="cstfont" id="curl_execute">CURL İşlemlerini Çalıştırmak</p>
    <p><ftype> curl::execute()</ftype></p>
   	<p>Yapılan curl işlemlerinin çalıştırılmasını sağlar.</p>
   
    <div type="code">
    <pre><x><</x>?php
<kf>class</kf> CurlIslemleri
{
	<kf>public</kf> <ff>function</ff> index()
        {
            import::library(<sf>'Curl'</sf>); <comment>// Önce Curl sınıfı dahil edilir. </comment>
            
            <vf>$site</vf> = <sf>'http://www.ornek.com'</sf>;
            curl::open(<vf>$site</vf>); <comment>// Şuanda curl oturumunu başlatmış olduk.</comment>
            <vf>$opt</vf> = <kf>array</kf>(
            	<sf>'return_transfer'</sf> => <kf>true</kf>,
                <sf>'header'</sf> => <kf>true</kf>
            );
            curl::settings(<vf>$opt</vf>); <comment>// Ayarlar belirlendi.</comment>
           <strong> curl::execute()</strong>; <comment>// Curl işlemleri çalıştırılıyor.</comment>
        }
}</pre>
    </div>
    
    <p class="cstfont" id="curl_close">CURL İşlemlerini Sonlandırmak</p>
    <p><ftype> curl::close()</ftype></p>
   	<p>Yapılan curl işlemlerinin sonlandırılmasını sağlar. Her farklı curl oturumunun kapatılması gerekir.</p>
   
    <div type="code">
    <pre><x><</x>?php
<kf>class</kf> CurlIslemleri
{
	<kf>public</kf> <ff>function</ff> index()
        {
            import::library(<sf>'Curl'</sf>); <comment>// Önce Curl sınıfı dahil edilir. </comment>
            
            <vf>$site</vf> = <sf>'http://www.ornek.com'</sf>;
            curl::open(<vf>$site</vf>); <comment>// Şuanda curl oturumunu başlatmış olduk.</comment>
            <vf>$opt</vf> = <kf>array</kf>(
            	<sf>'return_transfer'</sf> => <kf>true</kf>,
                <sf>'header'</sf> => <kf>true</kf>
            );
            curl::settings(<vf>$opt</vf>); <comment>// Ayarlar belirlendi.</comment>
            curl::execute(); <comment>// Curl işlemleri çalıştırılıyor.</comment>
            
            <strong>curl::close()</strong>; <comment>// Başlatılmış Curl işlemleri sonlandırır.</comment>
        }
}</pre>
    </div>
    
    <p class="cstfont" id="curl_info">CURL İşlemleri Hakkında Bilgi Almak</p>
    <p><ftype> curl::info( <kf>string</kf> <vf>$bilgi_adi</kf> )</ftype></p>
   	<p>Bir curl işlemleri hakkında bilgi sağlar. 1 parametresi vardır.</p>
     <table class="cfont">
    	<tr><th>Parametreler</th><td>Varsayılan Değer</td><td>Alacağı Değer</td><td>Anlamı</td></tr>
        <tr><th>Bilgi</th><td>NULL</td><td>'bilgi_adi'</td><td>curl işlemleri sırasında öğrenilmek istenen bilgileri belirtilir.</td></tr>
    </table>
     <p>CURLOPT_XXX Tipindeki seçenekler <b>Config/Curl.php</b> doyasında düzenlenmiş ve yeni değerler kazanmıştır yani CURLINFO_SPEED_DOWNLOAD böyle bir ifade 'speed_download' şeklinde düzenlenmiştir gördüğünüz gibi CURLINFO ibaresi kaldırılmış ve kalan bölüm küçük harfle yazılıp sözcükler arasına alt tire konulmuştur. Değişikliklere <b>Config/Curl.php</b> buradan bakabilirsiniz.</p>
   
    <div type="code">
    <pre><x><</x>?php
<kf>class</kf> CurlIslemleri
{
	<kf>public</kf> <ff>function</ff> index()
        {
            import::library(<sf>'Curl'</sf>); <comment>// Önce Curl sınıfı dahil edilir. </comment>
            
            <vf>$site</vf> = <sf>'http://www.ornek.com'</sf>;
            curl::open(<vf>$site</vf>); <comment>// Şuanda curl oturumunu başlatmış olduk.</comment>
            <vf>$opt</vf> = <kf>array</kf>(
            	<sf>'return_transfer'</sf> => <kf>true</kf>,
                <sf>'header'</sf> => <kf>true</kf>
            );
            curl::settings(<vf>$opt</vf>); <comment>// Ayarlar belirlendi.</comment>
            curl::execute(); <comment>// Curl işlemleri çalıştırılıyor.</comment>
            
            <strong>curl::info(<sf>'speed_download'</sf>)</strong>;     
            
            curl::close(); <comment>// Başlatılmış Curl işlemleri sonlandırır.</comment>
        }
}</pre>
    </div>
      
    <p class="cstfont" id="curl_php5">CURL İşlemleri Hata Denedimi</p>
    <p><ftype> curl::error() , curl::errno(), curl::errval()</ftype></p>
   	<p>Bir curl işlemleri sırasında oluşan hataların ne olduklarını anlamak için bu fonksiyonlardan yararlanılı.</p>
   
    <div type="code"><kf>echo</kf> <strong>curl::error()</strong>;</div>
    <p><div type="code"><kf>echo</kf> <strong>curl::errno()</strong>;</div></p>
    <p><div type="code"><kf>echo</kf> <strong>curl::errval()</strong>;  <comment>// Config/Curl.php dosyasında hata numaraları ve anlamları yer almaktadır. Dönecek hata numarasına göre size hatanın anlamını verecektir.</comment></div>
    
    <div type="note"><div>NOT</div><div>Amacımız sizlere curl işlemerinin ZN'de nasıl düzenlendiğini göstermektir doğrudan doğruya curl anlatmak değildir. Curl işlemleri hakkında daha detaylı bilgiye curl ile ilgili kaynaklardan ulaşabilirsiniz.</div></div>
    
    
    <p class="cstfont" id="curl_version">CURL Versiyonu Öğrenmek</p>
    <p><ftype> curl::version()</ftype></p>
   	<p>Curl versiyonu hakkında bilgi almak için kullanılır. İsteğe bağlı 1 parametre alır herhangi bir parametre kullanımazsak bilgiler dizi olarak döner.</p>
	<div type="code"><ff>var_dump</ff>(<strong>curl::version()</strong>);</div>
    <p>
    <table class="cfont">
    	<tr><th>curl::version() Parametre Değerleri</th><td>Anlamları</td></tr>
        <tr><th>version_number</th><td>CURL 24 bitlik versiyon numarası</td></tr>
        <tr><th>version</th><td>CURL versiyonu</td></tr>
        <tr><th>ssl_version_number</th><td>24 bitlik SSL versiyon numarası</td></tr>
        <tr><th>ssl_version</th><td>SSL versiyonu</td></tr>
        <tr><th>libz_version</th><td>Zlib versiyon numarası</td></tr>
        <tr><th>host</th><td>Host bilgisi</td></tr>
        <tr><th>age</th><td>Dönem bilgisi</td></tr>
        <tr><th>features</th><td>Özellikler bilgisi</td></tr>
        <tr><th>protocols</th><td>Protokoller. Dizi olarak tutulur.</td></tr>
    </table>
    </p>
    <div type="prev-next">
    	<div type="prev-btn"><a href="lib_css3.html">Önceki</a></div><div type="next-btn"><a href="lib_download.html">Sonraki</a></div>
    </div>
 
</body>
</html>              