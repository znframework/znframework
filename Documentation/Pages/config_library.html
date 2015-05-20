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
    <div id="content-document"><a href="#">Döküman</a> » <a href="config.html">Ayarlar</a> » Config(Ayarlar) Sınıfı ve Kullanımı</div> 
    <p class="ctfont">Config(Ayarlar) Sınıfı ve Kullanımı</p>
    <p>Ayarlar <strong>Config/</strong> dizininde yer alır ve config kütüphanesi ön tanımlı olarak kullanılır herhangi bir etme işlemine tabi tutulmaz ve doğrudan erişim sağlanır. Bilmeniz gereken önemli nokta Ayar dosyasının adı ile içesindeki ayar dizilerinin ilk elemanının adı ile aynı olmalıdır.</p> 
    
    <ul><li><a href="#" class="infont">Config(Ayarlar) Sınıfı ve Kullanımı</a><br><br>
        <ul>
            <li><a href="#config_get">Herhangi Bir Ayarın Değerini Almak » <b>config::get()</b></a></li>
            <li><a href="#config_set">Herhangi Bir Ayarın Değerini Değiştirmek » <b>config::set()</b></a></li>
            <li><a href="#config_iniget">Php Ini Ayarlarının Değerini Almak » <b>config::iniget()</b></a></li>  
			<li><a href="#config_iniset">Php Ini Ayarlarını Yapılandırmak » <b>config::iniset()</b></a></li> 
            <li><a href="#config_iniget_all">Tüm Php Ini Ayarlarını Dizi Olarak Almak » <b>config::iniget_all()</b></a></li>
            <li><a href="#config_inirestore">Php Ini Ayarını Varsayılan Değerine Döndürmek » <b>config::inirestore()</b></a></li>
            <li><a href="#config_create">Konfigürasyon Dosyası Oluşturmak</b></a></li>
        </ul>
    </li></ul>
    
    <p id="config_get" class="cstfont">Herhangi Bir Ayarın Değerini Almak</p>
    <p><ftype>config::get( <kf>string</kf> <vf>$dosya_adi</vf> , <kf>string</kf> <vf>$ayar_adi</vf> );</ftype></p>
    <p>
    	<div type="code">
        	<vf>$config</vf>[<sf>'DosyaAdi'</sf>][<sf>'AyarAdi'</sf>] = <sf>'Ayar Değeri'</sf><br />
            <p>Böyle bir ayarı aşağıdaki gibi kullanıyoruz.</p>       
            <kf>echo</kf> config::get(<sf>"DosyaAdi"</sf>,<sf>"AyarAdi"</sf>); <comment>// Çıktı: Ayar Değeri</comment>
        </div>
    </p>
    <p>Misal Config/Language.php dosyasındaki tr ayarının değeri olan turkish'i ekrana yazdırmak istersek aşağıdaki gibi kullanırız.</p>
    <div type="code"><kf>echo</kf> config::get(<sf>"Language"</sf>,<sf>"tr"</sf>); <comment>// Çıktı: turkish</comment></div>
    
    <p id="config_set" class="cstfont">Herhangi Bir Ayarın Değerini Değiştirmek</p>
    <p><ftype>config::set( <kf>string</kf> <vf>$dosya_adi</vf> , <kf>string</kf> <vf>$ayar_adi</vf> , <kf>string</kf> <vf>$yeni_ayar_degeri</vf> );</ftype></p> 
    <div type="code">config::set(<sf>"Ayar Dosyasının Adı"</sf>,<sf>"Ayar Adı"</sf>,<sf>"Yeni Değer"</sf>);</div>
    <p>Misal Config/Language.php dosyasındaki tr ayarının değeri olan turkish'i türkçe olarak değiştirip ekrana yazdırmak istersek aşağıdaki gibi kullanırız.</p>
    <div type="code">
    	config::set(<sf>"Language"</sf>,<sf>"tr"</sf>,<sf>"türkçe"</sf>);<br>
        <kf>echo</kf> config::get(<sf>"Language"</sf>,<sf>"tr"</sf>);<comment>// Çıktı: türkçe</comment><br>
    </div>
    <p>
      <div type="note"><div>NOT</div><div>Ayar değişikliği dosya üzerinde gerçekleşmediği için kalıcı değildir. O an için değiştirilmiş geçici ayardır.</div></div>
    </p>
    
    
    <p id="config_iniget" class="cstfont">Php Ini Ayarlarının Değerini Almak</p>
    <p><ftype>config::iniget( <kf>string/array</kf> <vf>$ayar_adi</vf> );</ftype></p>
    
    <p>Önceden set edilmiş veya default olarak ayarlanmış olan ini ayarlarının değerine ulaşmak için kullanılır. Eğer tek bir ayarın değerine ulaşmak isteniliyorsa metinsel ifade olarak ayarın adı şayet birden fazla istenilen ayarların değerini aynı anda alınmak isteniyorsa dizi verisi olarak ayarların adı yazılır.</p>
    
    <div type="code">
    	<kf>echo</kf> config::iniget(<sf>'post_max_size'</sf>);
        <p><comment> // Eğer birden fazla ayarın değeri aynı alınmak isteniyorsa parametreyi aşağıdaki gibi düzenliyoruz.</comment></p>
        <ff>var_dump</ff>( config::iniget(<kf>array</kf>(<sf>'post_max_size'</sf> , <sf>'max_input_vars'</sf>) );
    </div>
    
    
    <p id="config_iniset" class="cstfont">Php Ini Ayarlarını Yapılandırmak</p>
    <p><ftype>config::iniset( <kf>string/array</kf> <vf>$ayar_adi</vf> , <kf>string</kf> </vf>$yeni_ayar_degeri</vf> );</ftype></p>
    
    <p>Herhangi bir ini ayarını yapmak için kullanılır. PHP'de ön tanımlı olarak zaten ini_set() yöntemi bulunmaktadır ancak biz biraz daha opsiyonel olarak çoklu ayar yapabilme olanağı sağlamak için bu yöntemi geliştirdik.</p>
    
    <div type="code">
    	config::iniset(<sf>'post_max_size'</sf> , <sf>'8M'</sf>);
        <p><comment> // Eğer birden fazla ayarın aynı anda yapılması düşünülüyorsa parametreyi aşağıdaki gibi düzenliyoruz.</comment></p>
        config::iniget(<kf>array</kf>(<sf>'post_max_size'</sf> => <sf>'8M'</sf>, <sf>'max_input_vars'</sf> => <sf>'2000'</sf>);
    </div>
    
    
    <p id="config_iniget_all" class="cstfont">Tüm Php Ini Ayarlarını Dizi Olarak Almak</p>
    <p><ftype>config::iniget_all( [ <kf>string</kf> <vf>$uzanti</vf> ] , [ <kf>boolean</kf> <vf>$detay</vf> = <kf>true</kf> ] );</ftype></p>
    
    <p>Tüm yapılandırılmış ini ayarlarına ulaşmak için kullanılır.</p>
    
    <div type="code">
    	<ff>var_dump</ff>( config::iniget_all() );
    </div>
    
    
    <p id="config_inirestore" class="cstfont">Php Ini Ayarını Varsayılan Değerine Döndürmek</p>
    <p><ftype>config::inirestore( <kf>string</kf> <vf>$ayar_adi</vf> );</ftype></p>
    
    <p>Önceden set edilmiş bir ini ayarını varsayılan hale getirmek için kullanılır.</p>
    
    <div type="code">
    	config::inirestore(<sf>'post_max_size'</sf>);
    </div>
    
    
    <p id="config_create" class="cstfont">Konfigürasyon Dosyası Oluşturmak</p>  
    <p>İsterseniz kendi kişisel ayar dosyalarınızıda oluşturabilirsiniz. Bunu yapabilmek için bir kaç dikkat etmeniz gereken nokta vardır. Oluşturduğunu dosyanın adı ne ise içerisine ekleyeceğiniz ayar dizisininde ilk elemanının adıda o olmalıdır bu durumu aşağıda örnek üzerinde gösterelim.</p>
    
   	<p><strong>Config/</strong> dizinine <strong>BenimAyarim.php</strong> adında bir ayar dosyası oluşturuduğunuzu var sayalım. Bu ayar dosyamızın içeriğini şu şekilde oluşturmalıyız.</p>
    
    <p>
    <div type="code">
    	<strong>Config/BenimAyarim.php</strong><br />
    	<comment> // Dizinin birinci elemanının adı dosya adı ile aynı olmak zorundadır BenimAyarim.php dosya adına göre ilk eleman BenimAyarim olmalıdır. </comment><br>
    	<vf>$config</vf>[<sf>'BenimAyarim'</sf>][<sf>'ayar1'</sf>] = <sf>'Ayar Değeri 1'</sf><br />
		<vf>$config</vf>[<sf>'BenimAyarim'</sf>][<sf>'ayar2'</sf>] = <sf>'Ayar Değeri 2'</sf><br />
		<vf>$config</vf>[<sf>'BenimAyarim'</sf>][<sf>'ayar3'</sf>] = <sf>'Ayar Değeri 3'</sf>   
    </div>
    </p>
    
    <p><div type="important"><div>ÖNEMLİ</div><div>Yukarıdaki diziye dikkat ederseniz ilk <strong>elemanın adı ile dosyanın adı aynıdır</strong> sistemin çalışma yapısı gereği bu kurala uyulmak zorundadır.</div></div></p>
  
  	
    	
    <div type="prev-next">
    	<div type="prev-btn"><a href="config.html">Önceki</a></div><div type="next-btn"><a href="config_autoload.html">Sonraki</a></div>
    </div>
 
</body>
</html>              