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
    <div id="content-document"><a href="#">Döküman</a> » <a href="tools.html">Araçlar</a> » Repeater(Tekralama) Aracı</div> 
    <p class="ctfont">Repeater(Tekralama) Aracı</p>
    <p>Herhangi bir ifadeyi belli bir sayı tekrar etmesi için kullanılan araçtır.</p>
    <ul><li><a href="#" class="infont">Repeater(Tekralama) Aracı ve Yöntemleri</a><br><br>
        <ul>
        	<li><a href="#repeater_import">Repeater Aracını Dahil Etmek</b></a></li>
            <li><a href="#repeater">Tekrarlama Aracı » <b>repeater()</b></a></li>
        </ul>
    </li></ul>
    
    
   	<p class="cstfont" id="repeater_import">Repeater Aracını Dahil Etmek</p>
	<div type="code">import::tool(<sf>'Repeater'</sf>)</div>
    
    
    <p class="cstfont" id="repeater">Tekrarlama Aracı</p>
    <p><ftype>repeater( <kf>string/int</kf> <vf>$tekrarlanacak_ifade</vf> , [ <kf>numeric</kf> <vf>$tekrar_sayisi</vf> = <if>1</if> ])</ftype></p>
    <p>Girilen metni istenilen sayı kadar tekrar etmesini sağlayan araçtır.</p>
    
    <p>
    	<table class="cfont">
        	<tr><th>No</th><th>Parametreler</th><td>Anlamları</td></tr>
            <tr><th>1</th><th>string/int Tekrarlanacak Metin</th><td>Eekrar etmesini istediğiniz metin.</td></tr>
            <tr><th>2</th><th>[ string/int Tekrar Sayısı = 1 ]</th><td>Kaç kez tekrar edeceği.</td></tr>  
        </table>
    </p>
    
	<div type="code">
    <kf>echo</kf> repeater(<sf>'a'</sf>, <sf>10</sf>);  <comment>/* Çıktı: aaaaaaaaaa */</comment><br> 
    <kf>echo</kf> repeater(<sf>'b'</sf>, <sf>5</sf>);  <comment>/* Çıktı: bbbbb */</comment><br>
    </div> 
    
    <div type="prev-next">
    	<div type="prev-btn"><a href="tool_reader.html">Önceki</a></div><div type="next-btn"><a href="tool_rounder.html">Sonraki</a></div>
    </div>
 
</body>
</html>              