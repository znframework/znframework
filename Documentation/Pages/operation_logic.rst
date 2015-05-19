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
    <div id="content-document"><a href="#">Döküman</a> » <a href="overview.html">Genel Bakış</a> » Çalışma Mantığını Anlamak</div> 
  
    <p class="ctfont">Çalışma Mantığını Anlamak</p>
    <p>
    Kod Çatısı <b>Controllers ve Views</b> denilen iki farklı dizinin yönetimiyle çalışır. <b>Controllers</b> dizini PHP kodlarınının yazılacağı bölümdür. <b>Views</b> bölümü ise html içerikli sayfa tasarımlarının yapılacağı bölümdür.
    </p>
    
     <p class="cfont">
    	ZN kod çatısının temel olarak çalışma mantığı adres çubuğuna gireceğiniz URL adresinin bir sayfa içindeki <strong>sınıfı</strong> ve o <strong>sınıfa ait fonksiyonu</strong> çalıştırması üzerine dayalıdır. Yani çalışmasını istediğiniz kodlar bir sınıfın herhangi bir fonksiyonu içerisinde yer almalıdır. Peki bu tam olarak neyi ifade etmektedir. ZN kod çatısı ilk kurulduğunda çalıştırmak için adres çubuğuna gireceğiniz URL adresi <cf>http://www.siteadi.xxx</cf>'dir. Bu yolu adres çubuğuna girip çalıştırdığınızda URL adresi <cf>http://www.siteadi.xxx/index.php/home</cf> şeklinde değişecektir. URL adresinin otomatik olarak <cf>index.php/home</cf> eki aldığını görebilirsiniz. Bu ekteki <strong>home</strong> kelimesi, <strong>Controllers/</strong> dizinindeki <cf>home.php</cf> dosyasını ve bu dosya içerisinde yer alan <cf><kf>class</kf></cf> ibaresinin yanındaki <strong>Home</strong> kelimesini ifade etmektedir. Gördüğünüz gibi URL, üzerinde çalıştıracağı <strong>Controllers/</strong> dizini içerisindeki dosya ve o dosyaya ait sınıf adını içerir. <strong>Home</strong> kelimesinin yanında <strong>index</strong> ibaresininde olması gerekirdi ancak ZN kod çatısı fonksiyon adı <strong>index</strong> olan metot isimlerinin kullanılmasını zorunlu tutmuyor. Aslında çağrılan URL adresi <cf>http://www.siteadi.xxx/index.php/home/index</cf>'tir. Burada <strong>home</strong> bir sınıf ismini temsil ederken <strong>index</strong>, <strong>home.php</strong> dosyasında yer alan sınıfa ait fonksiyonu ifade etmektedir.
    </p>
    
    <p  class="cfont">
    	<strong>Sonuç</strong> olarak URL adresi çalıştırmak istediğiniz sayfanın sınıf ve foksiyon bilgilerini içermek zorundadır ancak fonksiyon <strong>index</strong> isminde ise URL adresinde, sınıf adından sonra bu fonksiyon ismini kullanmanıza gerek yoktur.
    </p>
    
    <p>
    Kod Çatısını ilk kurulduğunda <strong>Controllers</strong> dizini içerisinde home.php dosyasını göreceksiniz ve bu dosyayı açtığınızda aşağıdaki kodla karşılacaksınız.
    </p>
    
    <div type="code">
    <p>Controllers/home.php</p>
<pre><x><</x><x>?</x>php<br><span class="keyfont">class</span> Home
{
	<span class="funcfont">function</span> index(<span class="varfont">$params</span> = <span class="strfont">""</span>) 
    	{
                <comment>// Aşağıda çağrılan Views/Pages/welcome.php sayfasına veriler gönderiliyor.</comment>
                <vf>$data</vf>[<sf>"title"</sf>] = <sf>"ZN FRAMEWORK</sf>";
                <vf>$data</vf>[<sf>"welcome_message"</sf>] = <sf>"ZN KOD ÇATISINA HOŞ GELDİNİZ"</sf>;
                
                <comment>// Parametre1: Çağrılan Sayfanın Yolu: Views/Pages/welcome.php</comment>
                <comment>// Parametre2: Çağrılan Sayfaya Gönderilen Veriler: $data</comment>
    		import::page(<sf>"welcome"</sf> , <vf>$data</vf>);	
	}
}</pre>
    </div>
    
    <p>
    <strong>index</strong> fonksiyonu içerisinde bir <span class="code-font">import::page()</span> yapısı görüyorsunuz. Import bir dahil etme sınıfıdır ve page ise <strong>Views/Pages</strong> Dizini içerisindeki sayfaları çağıran fonksiyondur. Parametrede yazan <b>welcome</b> ifadesi <cf>Views/Pages/welcome.php</cf> yolunu ifade etmektedir. Çağrılan sayfa php uzantılı bir sayfa ise paremetrede <cf>welcome.php</cf> yerine <cf>welcome</cf> yazılabilir yani parametreye .php uzantısı koymaya gerek yoktur.
    </p>
    
    <p class="cstfont">Uygulama Akış Şeması</p>
    <p>Aşağıda sistemin nasıl çalıştığını gösteren temsili bir akış şeması görmektesiniz.</p>
	<p><img width="1050" height="500" src="../Images/FlowChart/flowchart.jpg" /></p>
  
    <p class="cstfont">Sayfayı Çalıştırmak İçin Adres Çubuğuna Nasıl Bir URL Yazmalıyım?</p>
    <p>
    Adres çubuğuna <span class="code-font">http://www.siteadi.xxx/[index.php]/<span class="keyfont">[coder-sınıf adı]</span>/<span class="funcfont">[coder-fonksiyon adı]</span>/<span class="strfont">[varsa parametreler param1/param2/...]</span></span>
    </p>
    
    <p>
    Localhostta çalışıyorsanız da adres çubuğuna <span class="code-font">http://localhost/[index.php]/<span class="keyfont">[coder-sınıf adı]</span>/<span class="funcfont">[coder-fonksiyon adı]</span>/<span class="strfont">[varsa parametreler param1/param2/...]</span></span>
    </p>
    <p>Dikkat edilmesi gereken nokta Controllers dizini içerisinde <b>sayfaların adı</b> ne ise sayfanın içerisindeki <b>class adı</b> da o olmalı. <cf>Controllers/ içindeki dosya adı home.php ise home.php içerisindeki class ibaresinden sonrada Home veya home yazmak gerekir.</cf></p>
    <p>
    Bizde bu sayfayı çalıştırmak için url'yi şu şekilde yazıyoruz. <span class="code-font">http://localhost/<b>index.php</b>/home/index</span><br>
    Eğer URL'niz <b>parametre içermiyor</b> ve <b>fonksiyon adı index</b> ise</i> index ifadesinide yazmanıza gerek yoktur. Yani URL'yi şu şekilde <span class="code-font">http://localhost/index.php/home</span> şeklinde düzenlemeniz sayfanın açılması için yeterli olacaktır. 
    </p>
  	
    <p>
    Temel olarak <strong>PHP Kodları Controllers/ dizini</strong> içerisinde yer alırken <strong>tasarım sayfaları Views/Pages dizini</strong> içerisinde yer alır. Böylelikle <strong>kod ve tasarım bölümümlerinin bir birinden ayrılması sağlanır.</strong> Sonuç olarak okunması kolay, temiz ve profesyonel bir kodlama geliştirilmiş olur.
    </p>
    
     <div type="prev-next">
    	<div type="prev-btn"><a href="concepts.html">Önceki</a></div><div type="next-btn"><a href="import_page.html">Sonraki</a></div>
    </div>
</body>
</html>              