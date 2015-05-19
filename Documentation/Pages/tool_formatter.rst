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
    <div id="content-document"><a href="#">Döküman</a> » <a href="tools.html">Araçlar</a> » Formatter(Biçimlendirme) Aracı</div> 
    <p class="ctfont">Formatter(Biçimlendirme) Aracı</p>
    <p>İfadeler üzerinde belirli biçimlendirme işlemleri yapar.</p>
    <ul><li><a href="#" class="infont">Formatter(Biçimlendirme) Aracı ve Yöntemleri</a><br><br>
        <ul>
        	<li><a href="#formatter_import">Formatter Aracını Dahil Etmek</b></a></li>
            <li><a href="#byte_formatter">Byte Biçimlendirme Aracı » <b>byte_formatter()</b></a></li>
            <li><a href="#money_formatter">Para Biçimlendirme Aracı » <b>money_formatter()</b></a></li>
            <li><a href="#time_formatter">Zaman Biçimlendirme Aracı » <b>time_formatter()</b></a></li>
        </ul>
    </li></ul>
    
    
   	<p class="cstfont" id="formatter_import">Formatter Aracını Dahil Etmek</p>
	<div type="code">import::tool(<sf>'Formatter'</sf>)</div>
    
    
    <p class="cstfont" id="byte_formatter">Byte Biçimlendirme Aracı</p>
    <p><ftype>byte_formatter( <kf>numeric</kf> <vf>$formatlanacak_byte_miktari</vf> , [ <kf>numeric</kf> <vf>$ondalik</vf> = <if>1</if> ] , [ <kf>boolean</kf> <vf>$birim_goster</vf> = <kf>true</kf> ] )</ftype></p>
    <p>Girilen bayt miktarını biçimlendirir.</p>
    
    <p>
    	<table class="cfont">
        	<tr><th>No</th><th>Parametreler</th><td>Anlamları</td></tr>
            <tr><th>1</th><th>string/int Fortmalanacak Byte Miktarı</th><td>Bayt miktarı.</td></tr>
            <tr><th>2</th><th>[ string/int Ondalık = 1 ]</th><td>Biçimlendirme sonrası oluşan yeni ifadenin virgülünden sonraki basamak sayısı.</td></tr> 
            <tr><th>3</th><th>[ boolean Birim Gösterilsin Mi?]</th><td>Birim gösterilsin mi? False değeri olması durumnda birim gösterilmeyecektir.</td></tr> 
        </table>
    </p>
    
	<div type="code">
    <kf>echo</kf> byte_formatter(<sf>1231324</sf>);  <comment>/* Çıktı: 1.2 MB */</comment><br> 
    <kf>echo</kf> byte_formatter(<sf>3453454353</sf>, <sf>3</sf>);  <comment>/* Çıktı: 3.216 GB */</comment><br>
    <kf>echo</kf> byte_formatter(<sf>568567655465476575</sf>, <sf>2</sf>, <kf>false</kf>);  <comment>/* Çıktı: 504.99 */</comment><br>
    </div>
    
    
    
    <p class="cstfont" id="money_formatter">Para Biçimlendirme Aracı</p>
    <p><ftype>money_formatter( <kf>numeric</kf> <vf>$formatlanacak_para_miktari</vf> , [ <kf>string</kf> <vf>$para_birimi</vf> ] )</ftype></p>
    <p>Girilen sayısal değeri para biçimine çevirir.</p>
    
    <p>
    	<table class="cfont">
        	<tr><th>No</th><th>Parametreler</th><td>Anlamları</td></tr>
            <tr><th>1</th><th>string/int Fortmalanacak Para Miktarı</th><td>Para miktarı.</td></tr>
            <tr><th>2</th><th>[ string Para Birimi ]</th><td>Biçimlendirme sonrası oluşan yeni değerin sonuna eklenecek para birimi.</td></tr>  
        </table>
    </p>
    
	<div type="code">
    <kf>echo</kf> money_formatter(<sf>1231324</sf>);  <comment>/* Çıktı: 1.231.324,00 */</comment><br> 
    <kf>echo</kf> money_formatter(<sf>3453454353</sf>, <sf>'TL'</sf>);  <comment>/* Çıktı: 3.453.454.353,00 TL */</comment><br>
    <kf>echo</kf> money_formatter(<sf>568567655465</sf>, <sf>'£'</sf>);  <comment>/* Çıktı: 568.567.655.465,00 £ */</comment><br>
    </div> 
    
    
    <p class="cstfont" id="time_formatter">Zaman Biçimlendirme Aracı</p>
    <p><ftype>time_formatter( <kf>numeric</kf> <vf>$formatlanacak_saniye_miktari</vf> , [ <kf>string</kf> <vf>$giris_tipi</vf> = <sf>'day'</sf> ] , [ <kf>string</kf> <vf>$cikis_tipi</vf> = <sf>'second'</sf> ] )</ftype></p>
    <p>Girilen sayısal değeri bir türden diğer türe çeviren araçtır.</p>
    
    <p>
    	<table class="cfont">
        	<tr><th>No</th><th>Parametreler</th><td>Anlamları</td></tr>
            <tr><th>1</th><th>string/int Fortmalanacak Zaman Miktarı</th><td>Zaman miktarı.</td></tr>
            <tr><th>2</th><th>[ string Giriş Tip = "day"]</th><td>1. parametrenin ne cinsinden ifade edileceği.</td></tr> 
            <tr><th colspan="3">2. Parametrenin Alabileceği Değerler</th></tr>
            <tr><th>second</th><td colspan="2">Saniye.</td></tr>
            <tr><th>minute</th><td colspan="2">Dakika.</td></tr>
            <tr><th>hour</th><td colspan="2">Saat.</td></tr>
            <tr><th>day</th><td colspan="2">Gün.</td></tr>
            <tr><th>month</th><td colspan="2">Ay.</td></tr>
            <tr><th>year</th><td colspan="2">Yıl.</td></tr>
            <tr><th>3</th><th>[ string Çıktı = "second"]</th><td>Çıktının ne cinsinden ifade edileceği.</td></tr> 
            <tr><th colspan="3">3. Parametrenin Alabileceği Değerler</th></tr>
            <tr><th>second</th><td colspan="2">Saniye.</td></tr>
            <tr><th>minute</th><td colspan="2">Dakika.</td></tr>
            <tr><th>hour</th><td colspan="2">Saat.</td></tr>
            <tr><th>day</th><td colspan="2">Gün.</td></tr>
            <tr><th>month</th><td colspan="2">Ay.</td></tr>
            <tr><th>year</th><td colspan="2">Yıl.</td></tr>
        </table>
    </p>
    
	<div type="code">
    <kf>echo</kf> time_formatter(<sf>90</sf> , <sf>'second'</sf> , <sf>'minute'</sf>);  <comment>/* 90 Saniyeyi Dakikaya Çevir Çıktı: 1.5 */</comment><br> 
    <kf>echo</kf> time_formatter(<sf>30</sf> , <sf>'day'</sf> , <sf>'month'</sf>);  <comment>/* 30 Günü Aya Çevir Çıktı: 1 */</comment><br> 
    <kf>echo</kf> time_formatter(<sf>12</sf> , <sf>'month'</sf> , <sf>'year'</sf>);  <comment>/* 12 Ayı Yıla Çevir Çıktı: 1 */</comment><br>
    </div> 
    
    <div type="prev-next">
    	<div type="prev-btn"><a href="tool_filter.html">Önceki</a></div><div type="next-btn"><a href="tool_html.html">Sonraki</a></div>
    </div>
 
</body>
</html>              