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
    <div id="content-document"><a href="#">Döküman</a> » <a href="config.html">Ayarlar</a> » Repair(Onarım) Ayarları</div> 
    <p class="ctfont">Repair(Onarım) Ayarları</p>
    <p>Sitenin tadilat durumunda ne gibi ayarlamalar yapılabileceği bilgilerini içeren ayar dosyasıdır.</p>
 
	<p>
   	<div type="code">
<strong>Config/Repair.php</strong>
<pre>
<comment>*-------------------------------------------------------------------------------
*	İşlev: Düzenleme yapılan bilgisayar/bilgisayarların, kullanıcılardan 
	ayırt edilmesini sağlar. System Repair moda alındığında aktif olur, 
	sistem çalışırken sistemde düzenleme yapma olanağı sağlar.
*	Not: Sistem repair moda alınmadan önce bu değer ip'nize göre ayarlanmalıdır.
* 	Varsayılan: 127.0.0.1.
*-------------------------------------------------------------------------------
*/
// aşağıdaki özelliklerin çalışması için bu özelliğin true yapılması gerekmektedir.</comment>
<vf>$config</vf>[<sf>'Repair'</sf>][<sf>'mode'</sf>] = <kf>false</kf>; 

<comment>// Tadilat işlemi yapılırken hangi bilgisayar üzerinde
// düzenleme işlemi yapılıyorsa o bilgisayara ait ip adresi
// Eğer birden fazla bilgisayar üzerinden yapılacaksa ve ipleri farklı ise 
// bu durumda dizi içerisine sırası ile ip değerleri yazılır.</comment>
<vf>$config</vf>[<sf>'Repair'</sf>][<sf>'machines'</sf>] = <kf>array</kf>(); 

<comment>// Onarım yapılan site sayfaları belirlenir.
// array() veya string Onarım işlemi yapılan sayfalar belirtiliyor.
// Tüm sayfaları belirtmek için array('all') veya 'all' şeklinde kullanılmalıdır.</comment>
<vf>$config</vf>[<sf>'Repair'</sf>][<sf>'pages'</sf>] = <kf>array</kf>();

<comment>// Onarım yapılan sayfalar diğer iplerden bağlanılmaya çalışıldığında yönlendirilecek sayfa belirlenir.</comment>
<vf>$config</vf>[<sf>'Repair'</sf>][<sf>'route_page'</sf>] = <sf>''</sf>;
</pre>
   	</div>
  	</p>

    <div type="prev-next">
    	<div type="prev-btn"><a href="config_regex.html">Önceki</a></div><div type="next-btn"><a href="config_route.html">Sonraki</a></div>
    </div>
 
</body>
</html>              