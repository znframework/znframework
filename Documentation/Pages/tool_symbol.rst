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
    <div id="content-document"><a href="#">Döküman</a> » <a href="tools.html">Araçlar</a> » Symbol(Sembol) Aracı</div> 
    <p class="ctfont">Symbol(Sembol) Aracı</p>
    <p>Belirli sembolleri kullanabilmek için geliştirilmiş bir araçtır.</p>
    <ul><li><a href="#" class="infont">Symbol(Sembol) Aracı ve Yöntemleri</a><br><br>
        <ul>
        	<li><a href="#symbol_import">Symbol Aracını Dahil Etmek</b></a></li>
            <li><a href="#symbol">Sembol Aracı » <b>symbol()</b></a></li>
        </ul>
    </li></ul>
    
    
   	<p class="cstfont" id="symbol_import">Symbol Aracını Dahil Etmek</p>
	<div type="code">import::tool(<sf>'Symbol'</sf>)</div>
    
    
    <p class="cstfont" id="symbol">Sembol Aracı</p>
    <p><ftype>symbol( [ <kf>string</kf> <vf>$sembol_ismi</vf> = <sf>'turkish_lira'</sf> ] )</ftype></p>
    <p>Tüm kullanılabilir semboller <strong>Config/Symbols.php</strong> dosyasında yer almaktadır siz isterseniz bu listeyi genişletebilirsiniz.</p>
    
    <p>
    	<table class="cfont">
        	<tr><th>No</th><th>Parametreler</th><td>Anlamları</td></tr>
            <tr><th>1</th><th>string Sembol Adı</th><td><strong>Config/Symbols.php</strong> dosyasında yer alan sembol listesinden herhangi bir isim.</td></tr>
            <tr><th colspan="3">Sembol İsimleri</th></tr> 
            <tr><th>copyright</th><td colspan="2">©</td></tr>
            <tr><th>register</th><td colspan="2">®</td></tr>
            <tr><th>euro</th><td colspan="2">€</td></tr>
            <tr><th>right_double_arrow</th><td colspan="2">»</td></tr>
            <tr><th>left_double_arrow</th><td colspan="2">«</td></tr>
            <tr><th>invert_question</th><td colspan="2">¿</td></tr>
            <tr><th>trade_mark</th><td colspan="2">™</td></tr>
            <tr><th>turkish_lira</th><td colspan="2">t</td></tr>
            <tr><th>cent</th><td colspan="2">¢</td></tr>
            <tr><th>yen</th><td colspan="2">¥</td></tr>
            <tr><th>pound</th><td colspan="2">£</td></tr>
            <tr><th>currency</th><td colspan="2">¤</td></tr>
            <tr><th>division</th><td colspan="2">÷</td></tr>
            <tr><th>minus</th><td colspan="2">±</td></tr>
            <tr><th>micro</th><td colspan="2">µ</td></tr>
            <tr><th>degree</th><td colspan="2">°</td></tr>
            <tr><th>section</th><td colspan="2">§</td></tr>
            <tr><th>big_slash</th><td colspan="2">Ø</td></tr>
            <tr><th>small_slash</th><td colspan="2">ø</td></tr>
            <tr><th>permil</th><td colspan="2">‰</td></tr>
            <tr><th>tilde</th><td colspan="2">~</td></tr>
            <tr><th>spade</th><td colspan="2">♠</td></tr>
            <tr><th>club</th><td colspan="2">♣</td></tr>
            <tr><th>heart</th><td colspan="2">♥</td></tr>
            <tr><th>diam</th><td colspan="2">♦</td></tr>
            <tr><th>at</th><td colspan="2">@</td></tr>
            <tr><th>function</th><td colspan="2">ƒ</td></tr>
            <tr><th>product</th><td colspan="2">∏</td></tr>
            <tr><th>equivalent</th><td colspan="2">≡</td></tr>
            <tr><th>partial</th><td colspan="2">∂</td></tr>
            <tr><th>integral</th><td colspan="2">∫</td></tr>
            <tr><th>infinity</th><td colspan="2">∞</td></tr>
            <tr><th>square_root</th><td colspan="2">√</td></tr>
            <tr><th>approximately</th><td colspan="2">≈</td></tr>
            <tr><th>not_equals</th><td colspan="2">≠</td></tr>
            <tr><th>triangle</th><td colspan="2">∴</td></tr>
            <tr><th>greater_equals</th><td colspan="2">≥</td></tr>
            <tr><th>less_equals</th><td colspan="2">≤</td></tr>
            <tr><th>paragraph</th><td colspan="2">¶</td></tr>
            <tr><th>big_dote</th><td colspan="2">•</td></tr>
            <tr><th>mid_dote</th><td colspan="2">·</td></tr>
            <tr><th>dagger</th><td colspan="2">†</td></tr>
            <tr><th>double_dagger</th><td colspan="2">‡</td></tr>
            <tr><th>diamond</th><td colspan="2">◊</td></tr>
            <tr><th>up_arrow</th><td colspan="2">↑</td></tr>
            <tr><th>down_arrow</th><td colspan="2">↓</td></tr>
            <tr><th>left_arrow</th><td colspan="2">←</td></tr>
            <tr><th>right_arrow</th><td colspan="2">→</td></tr>
            <tr><th>double_headed_arrow</th><td colspan="2">↔</td></tr>
            <tr><th>not_symbol</th><td colspan="2">¬</td></tr>       
        </table>
    </p>
    
	<div type="code">
    <kf>echo</kf> symbol(<sf>'heart'</sf>);  <comment>/* Çıktı: ♥ */</comment><br> 
    <kf>echo</kf> symbol(<sf>'micro'</sf>);  <comment>/* Çıktı: µ */</comment><br> 
    <kf>echo</kf> symbol(<sf>'diamond'</sf>);  <comment>/* Çıktı: ◊ */</comment><br> 
    </div> 
    
    <div type="prev-next">
    	<div type="prev-btn"><a href="tool_string.html">Önceki</a></div><div type="next-btn"><a href="tool_uploader.html">Sonraki</a></div>
    </div>
 
</body>
</html>              