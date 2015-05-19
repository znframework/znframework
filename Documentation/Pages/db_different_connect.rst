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
    <div id="content-document"><a href="#">Döküman</a> » <a href="db_dynamic.html">Database(Veritabanı) Sınıfı Yöntemleri</a> » Farklı Bir Veritabanı Bağlantısı Oluşturmak</div> 
    <p class="ctfont">Farklı Bir Veritabanı Bağlantısı Oluşturmak</p>
    <p>Bu bölümde birden fazla farklı veritabanına birden fazla bağlantının nasıl yapılacağını gösterdik.</p>
    <p>
        <ul content="list">
        <li><a href="#db_config">Database Ayarlarını Yapılandırmak</a></li>
        <li><a href="#db_different_connect">Farklı Bir Veritabanı Bağlantısı Oluşturmak</a></li>
        </ul>
    </p>
    
    <p class="cstfont" id="db_config">Database Ayarlarını Yapılandırmak</p>
    <p>Farklı bir veritabanı bağlantısı sağlayabilmek için aşağıdaki ayarlarda yer alan <cf><vf>$config</vf>[<sf>'Database'</sf>][<sf>'different_connection'</sf>] = <kf>array</kf>();</cf> ayarı kullanılacaktır.</p>
    <div type="code">
  	<strong>Config/Database.php</strong>
<pre>
<vf>$config</vf>[<sf>'Database'</sf>][<sf>'driver'</sf>] 	= <sf>"mysqli"</sf>;
<vf>$config</vf>[<sf>'Database'</sf>][<sf>'host'</sf>] 	= <sf>"localhost"</sf>;
<vf>$config</vf>[<sf>'Database'</sf>][<sf>'user'</sf>] 	= <sf>"root"</sf>;
<vf>$config</vf>[<sf>'Database'</sf>][<sf>'password'</sf>]	= <sf>""</sf>;
<vf>$config</vf>[<sf>'Database'</sf>][<sf>'database'</sf>] = <sf>"test"</sf>;
<vf>$config</vf>[<sf>'Database'</sf>][<sf>'dsn'</sf>] 	= <sf>''</sf>;
<vf>$config</vf>[<sf>'Database'</sf>][<sf>'server'</sf>] 	= <sf>''</sf>;
<vf>$config</vf>[<sf>'Database'</sf>][<sf>'port'</sf>] 	= <sf>''</sf>;
<vf>$config</vf>[<sf>'Database'</sf>][<sf>'appname'</sf>] 	= <sf>''</sf>;
<vf>$config</vf>[<sf>'Database'</sf>][<sf>'service'</sf>] 	= <sf>''</sf>;
<vf>$config</vf>[<sf>'Database'</sf>][<sf>'protocol'</sf>] = <sf>''</sf>;
<vf>$config</vf>[<sf>'Database'</sf>][<sf>'role'</sf>] 	= <sf>''</sf>;
<vf>$config</vf>[<sf>'Database'</sf>][<sf>'pconnect'</sf>] = <kf>false</kf>; 
<vf>$config</vf>[<sf>'Database'</sf>][<sf>'encode'</sf>] 	= <kf>false</kf>;
<vf>$config</vf>[<sf>'Database'</sf>][<sf>'prefix'</sf>] 	= <sf>""</sf>;
<vf>$config</vf>[<sf>'Database'</sf>][<sf>'charset'</sf>] 	= <sf>"utf8"</sf>;
<vf>$config</vf>[<sf>'Database'</sf>][<sf>'collation'</sf>] = <sf>"utf8_general_ci"</sf>;
<vf>$config</vf>[<sf>'Database'</sf>][<sf>'different_connection'</sf>] = <kf>array</kf>();
</pre>
    </div>
    
    <p>Şimdi farklı bir veritabanı bağlantısı sağlanacaksa <cf>different_connection</cf> ayar dizisinde aşağıdaki gibi yeni bir ayar kümesi oluşturmanız gerekmektedir.</p>
    <div type="code">
  	<strong>Config/Database.php</strong>
<pre>
<vf>$config</vf>[<sf>'Database'</sf>][<sf>'different_connection'</sf>] = <kf>array</kf>
(
	<sf>'xAyarlari'</sf> => <kf>array</kf>
        (
            <sf>'driver'</sf> 	=> <sf>'pdo'</sf>,
            <sf>'database'</sf>	=> <sf>'test'</sf>,
            <sf>'user'</sf>	=> <sf>'yeni_kullanici'</sf>,
            <sf>'password'</sf> 	=> <sf>'yeni_sifre'</sf>           
            <comment>// Aynı ayarları içeren bilgileri yazmanıza gerek yoktur.</comment>
        ),
        
        <sf>'yAyarlari'</sf> => <kf>array</kf>
        (
            <sf>'driver'</sf> 	=> <sf>'mysql'</sf>,
            <sf>'database'</sf>	=> <sf>'test2'</sf>,
            <sf>'user'</sf>	=> <sf>'yeni_kullanici'</sf>,
            <sf>'password'</sf> 	=> <sf>'yeni_sifre'</sf>        
            <comment>// Aynı ayarları içeren bilgileri yazmanıza gerek yoktur.</comment>
        )
    
);
</pre>
    </div>
    <p>Yukarıda iki farklı bağlantı nesnesi oluşturduk. Eğer farklı bağlantılarda ana bağlantı ile aynı ayarlar ilçeren parametreler yer alacaksa tekrardan belirtilmesine gerek yoktur. Mesela iki farklı bağlantı <strong>host</strong> bilgisi olarak <strong>localhost</strong> kullanacağından dolayı tekrardan belirtilmesine gerek kalmamıştır. Aşağıda yer alan bölümde ise bu ayar kümelerinin nasıl kullanılacağını gösteren bölüm yer almaktadır.</p>
    
    <p class="cstfont" id="db_different_connect">Farklı Bir Veritabanı Bağlantısı Oluşturmak</p>
    <p><ftype>$this->db->different_connection( <kf>string</kf> <vf>$ayar_kumesinin_adi</vf> )</ftype></p>
    
    <p>
    <table class="cfont">
    	<tr><th>Parametreler</th><th>Kullanımı</th></tr>
        <tr><th>string Ayar Kümesinin Adı</th><td><strong>Config/Database.php</strong> dosyasında yer alan <cf>different_connecion</cf> ayar parametesinde tanımlanan ayar kümesini tutan anahtar ifade. Örnek: xAyarlari, yAyarlari</td></tr>
    </table>
    </p>
    
     <p>
    <div type="code">
<pre><vf>$dbx </vf>= <vf>$this</vf>->db->different_connection(<sf>'xAyarlari'</sf>);
<vf>$dby </vf>= <vf>$this</vf>->db->different_connection(<sf>'yAyarlari'</sf>);

<ff>var_dump</ff>(<vf>$dbx</vf>->get(<sf>'eposta'</sf>)->result());
<ff>var_dump</ff>(<vf>$dby</vf>->get(<sf>'yorumlar'</sf>)->result());</pre>
    </div>
    </p>
    
    <div type="code">
<pre><vf>$dbx </vf>= <vf>$this</vf>->dbtool->different_connection(<sf>'xAyarlari'</sf>);
<vf>$dby </vf>= <vf>$this</vf>->dbtool->different_connection(<sf>'yAyarlari'</sf>);

<ff>var_dump</ff>(<vf>$dbx</vf>->list_tables());
<ff>var_dump</ff>(<vf>$dby</vf>->list_tables());</pre>
    </div>

    <div type="prev-next">
    	<div type="prev-btn"><a href="db_tool.html">Önceki</a></div><div type="next-btn"><a href="db_static.html">Sonraki</a></div>
    </div>
 
</body>
</html>              