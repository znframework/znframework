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
    <div id="content-document"><a href="#">Döküman</a> » <a href="config.html">Ayarlar</a> » Symbols(Sembol) Ayarları</div> 
    <p class="ctfont">Symbols(Sembol) Ayarları</p>
    <p>Klavye üzerinden yapılamayan sembolleri kolaylıkla oluşturabilmenizi sağlamak için kullanılan dosyadır ve içerisinde özel sembolleri içeren liste mevcuttur.</p>
 
	<p>
   	<div type="code">
<strong>Config/Symbols.php</strong>
<pre>
<vf>$config</vf>[<sf>'Symbols'</sf>] = <kf>array</kf>
(
	<sf>'copyright' 		<pf>=></pf> '<x>&</x>copy;',		<comment>//©</comment>
	'register' 		<pf>=></pf> '<x>&</x>#174;',		<comment>//®</comment>
	'euro'			<pf>=></pf> '<x>&</x>#8364;',		<comment>//€</comment>
	'right_double_arrow'	<pf>=></pf> '<x>&</x>#187;',		<comment>//»</comment>
	'left_double_arrow' 	<pf>=></pf> '<x>&</x>#171;',		<comment>//«</comment>
	'invert_question'	<pf>=></pf> '<x>&</x>#191;',		<comment>//¿</comment>
	'trade_mark'		<pf>=></pf> '<x>&</x>#8482;',		<comment>//™</comment>
	'turkish_lira'		<pf>=></pf> '<x>&</x>#x20BA;',		<comment>//t</comment>
	'cent'			<pf>=></pf> '<x>&</x>#162;',		<comment>//¢</comment>
	'yen'			<pf>=></pf> '<x>&</x>#165;',		<comment>//¥</comment>
	'pound'			<pf>=></pf> '<x>&</x>#163;',		<comment>//£</comment>
	'currency'		<pf>=></pf> '<x>&</x>#164;',		<comment>//¤</comment>
	'division'		<pf>=></pf> '<x>&</x>#247;',		<comment>//÷</comment>
	'minus'			<pf>=></pf> '<x>&</x>#177;',		<comment>//±</comment>
	'micro'			<pf>=></pf> '<x>&</x>#181;',		<comment>//µ</comment>
	'degree'		<pf>=></pf> '<x>&</x>#176;',		<comment>//°</comment>
	'section'		<pf>=></pf> '<x>&</x>#167;',		<comment>//§</comment>
	'big_slash'		<pf>=></pf> '<x>&</x>#216;',		<comment>//Ø</comment>
	'small_slash'		<pf>=></pf> '<x>&</x>#248;',		<comment>//ø</comment>
	'permil'		<pf>=></pf> '<x>&</x>permil;',		<comment>//‰</comment>
	'tilde'			<pf>=></pf> '<x>&</x>#126;',		<comment>//~</comment>
	'spade'			<pf>=></pf> '<x>&</x>spades;',    	<comment>//♠</comment>
	'club'			<pf>=></pf> '<x>&</x>clubs;',		<comment>//♣</comment>
	'heart'			<pf>=></pf> '<x>&</x>hearts;',		<comment>//♥</comment>
	'diam'			<pf>=></pf> '<x>&</x>diams;',		<comment>//♦</comment>
	'at'			<pf>=></pf> '<x>&</x>#64;',		<comment>//@</comment>
	'function'		<pf>=></pf> '<x>&</x>fnof;',		<comment>//ƒ</comment>
	'product'		<pf>=></pf> '<x>&</x>prod;',		<comment>//∏</comment>
	'equivalent '		<pf>=></pf> '<x>&</x>equiv;',		<comment>//≡</comment>
	'partial'		<pf>=></pf> '<x>&</x>part;',		<comment>//∂</comment>
	'integral'		<pf>=></pf> '<x>&</x>int;',		<comment>//∫</comment>
	'infinity'		<pf>=></pf> '<x>&</x>infin;',		<comment>//∞</comment>
	'square_root'		<pf>=></pf> '<x>&</x>radic;',		<comment>//√</comment>
	'approximately'		<pf>=></pf> '<x>&</x>asymp;',		<comment>//≈</comment>
	'not_equals'		<pf>=></pf> '<x>&</x>ne;',		<comment>//≠</comment>
	'triangle'		<pf>=></pf> '<x>&</x>there4;',		<comment>//∴</comment>
	'greater_equals'	<pf>=></pf> '<x>&</x>ge;',		<comment>//≥</comment>
	'less_equals'		<pf>=></pf> '<x>&</x>le;',		<comment>//≤</comment>
	'paragraph'		<pf>=></pf> '<x>&</x>para;',		<comment>//¶</comment>
	'big_dote'		<pf>=></pf> '<x>&</x>bull;',		<comment>//•</comment>
	'mid_dote'		<pf>=></pf> '<x>&</x>middot;',		<comment>//·</comment>
	'dagger'		<pf>=></pf> '<x>&</x>dagger;',		<comment>//†</comment>
	'double_dagger'		<pf>=></pf> '<x>&</x>Dagger;',		<comment>//‡</comment>
	'diamond'		<pf>=></pf> '<x>&</x>loz;',		<comment>//◊</comment>
	'up_arrow'		<pf>=></pf> '<x>&</x>uarr;',		<comment>//↑</comment>
	'down_arrow'		<pf>=></pf> '<x>&</x>darr;',		<comment>//↓</comment>
	'left_arrow'		<pf>=></pf> '<x>&</x>larr;',		<comment>//←</comment>
	'right_arrow'		<pf>=></pf> '<x>&</x>rarr;',		<comment>//→</comment>
	'double_headed_arrow' 	<pf>=></pf> '<x>&</x>harr;',		<comment>//↔</comment>
	'not_symbol'		<pf>=></pf> '<x>&</x>not;'</sf>		<comment>//¬</comment>
	
);
	</pre>
   	</div>
  	</p>
    
    <p>
    <div type="note"><div>NOT</div><div>Bu ifadeleri kullanabilmek için <strong>System/Tools/Symbol.php</strong> dosyasında yer alan <a target="pages" href="tool_symbol.html"><strong><cf>symbol()</cf></strong></a> yöntemi kullanılır. Bu yöntemin nasıl kullanıdığı <a target="pages" href="tools.html"><strong>araçlar</strong></a> bölümünde anlatılmıştır.
    </div>
    </div>
    </p>

    <div type="prev-next">
    	<div type="prev-btn"><a href="config_session.html">Önceki</a></div><div type="next-btn"><a href="config_upload.html">Sonraki</a></div>
    </div>
 
</body>
</html>              