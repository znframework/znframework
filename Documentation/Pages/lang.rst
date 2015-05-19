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
    <div id="content-document"><a href="#">Döküman</a> » <a href="general_topic.html">Genel Konular</a> » Dil Metotu</div> 
    <p class="ctfont">Dil Metotu</p>
    <p>Bu bölümde dil dosyası oluşturma ve kullanımına yer verdik. Oluşturulan dil dosyaları <b>Language/</b> dizini içerisine atılır. İlk olarak sistemde Language/ dizini içerisinde iki dile ait dizin bulunur. Bunlar; Türkçe(<strong>turkish</strong>) ve İngilizce(<strong>english</strong>) dizinleridir. Dil dosyası oluşturacaksak her iki dizinede aynı isimle dosya oluşturmamız gerekir. Şimdi adım adım bu işlemlerin nasıl yapıldığını görelim.</p>
    <p>
    	<b>1 - </b>Language/en/site.php ve Language/tr/site.php dosyalarını oluşturun.<br>
        <b>2 - </b>site.php dosyasını açın ve içerisine şu kodu ilave edin.<br>
    </p> 
    <p><b>Language/tr/site.php</b> için;</p>
        <div type="code">
<pre>
<x><</x>?php
<vf>$lang</vf>[<sf>'hello'</sf>] = <sf>"Merhaba!"</sf>;
</pre>
        </div>
     <p><b>Language/en/site.php</b> için;</p>
        <div type="code">
<pre>
<x><</x>?php
<vf>$lang</vf>[<sf>'hello'</sf>] = <sf>"Hello!"</sf>;
</pre>
        </div>
    <p><b>3 - </b> lang() fonksiyonu yardımı ile bu dil dosyalarını kullanalım.</p>
    <div type="code">
    <pre><x><</x>?php
<kf>class</kf> Anasayfa
{
	<kf>public</kf> <ff>function</ff> index()
        {
            import::language(<sf>'site'</sf>); <comment>// Önce oluşturuğumuz dil dosyasını dahil ediyoruz. </comment>
            <kf>echo</kf> lang(<sf>'hello'</sf>); <comment>// Çıktı "Merhaba!" olacaktır. Çünkü varsayılan olarak seçili dil türkçedir. </comment>
        }
}</pre>
    </div>
    
    <p class="cstfont">set_lang() Metodu</p>
    <p>set_lang() dili değiştirmeye yarayan fonksiyondur. Eğer dil seçeneğini değiştirirseniz mesajın değiştiğini göreceksiniz. Aşağıdaki kodu deneyiniz.</p>
    
    <div type="code">
    <pre><x><</x>?php
<kf>class</kf> Anasayfa
{
	<kf>public</kf> <ff>function</ff> index()
        {
            import::language(<sf>'site'</sf>); <comment>// Önce oluşturuğumuz dil dosyasını dahil ediyoruz. </comment>
            set_lang(<sf>'en'</sf>); <comment>// set_lang() dil değiştirme fonksiyonudur. </comment>
            <kf>echo</kf> lang(<sf>'hello'</sf>); <comment>// Çıktı: Hello!. </comment>
        }
}</pre>
    </div>
    
    <p class="cstfont">Dil Ayarı Config/Language.php</p>
    
    <p>Peki neden set_lang() fonksiyona <b>"en"</b> parametresini gönderdik. <b>Config/Language.php</b> incelenirse aşağıdaki gibi bir kod göreceksiniz.</p>
    <div type="code"><vf>$config</vf>[<sf>"Language"</sf>] = <kf>array</kf>(<sf>"tr"</sf> => <sf>"turkish"</sf>,<sf>"en"</sf> => <sf>"english"</sf>);</div>
   	<p>Dizide anahtar değerler dillerin kısaltmasını, karşısındaki değerler ise <b>Language/</b> dizinindeki <strong>dillerin dizin adını</strong> ifade eder. Yani yukarıdaki <cf>set_lang(<sf>'en'</sf>)</cf> fonksiyonu artık <b>Language/english/</b> dizinindeki dosyaları kullan demektir. Zaten <strong>Config/Language.php</strong> dosyasına bakıldığında <sf>'en'</sf> anahtarının <sf>'english'</sf> dizinini temsil ettiği görülür.</p>
    
    <p class="cstfont">URL'de Seçilen Dilin Görünmesi</p>
    <p><strong>Config/Uri.php</strong> dosyasını açtığınızda aşağıdaki gibi bir satır bulacaksınız.</p>
    <div type="code"><vf>$config</vf>[<sf>'Uri'</sf>][<sf>'lang'</sf>] = <kf>false</kf>;</div>
    <p><strong>False</strong> varsayılan olarak ayarlanmış ayardır. Bunu <cf class="keyfont">true</cf> yapmanız durumunda URL şöyle bir şekil alacaktır.</p>
    
    <div type="code">ornek.com/index.php/<sf><b>tr</b></sf>/anasayfa/index</div>
    
    <div type="prev-next">
    	<div type="prev-btn"><a href="create_library.html">Önceki</a></div><div type="next-btn"><a href="access_methods.html">Sonraki</a></div>
    </div>
 
</body>
</html>              