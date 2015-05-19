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
    <div id="content-document"><a href="#">Döküman</a> » <a href="libraries.html">Kütüphaneler</a> » Jquery Sınıfı</div> 
    <p class="ctfont">Jquery Sınıfı</p>
    <p>Jquery kodlarını içeren bir sınıftır.</p>
    <ul><li><a href="#" class="infont">Jquery Sınıfı ve Yöntemleri</a><br><br>
        <ul>    
        	<li><a href="#jquery_import">Jquery Kütüphanesini Dahil Etmek</a></li>
            <li><a href="#jquery_open">Script Tagı Açmak » <b>jquery::open()</b></a></li>
            <li><a href="#jquery_close">Script Tagı Kapatmak » <b>jquery::close()</b></a></li>
            <li><a href="#jquery_ready">Document Ready Yapısını Kullanmak » <b>jquery::ready()</b></a></li>
            <li><a href="#jquery_event">Olay Dinleyicisi Eklemek » <b>jquery::event()</b></a></li>
            <li><a href="#jquery_fade">Fade In, Fade Out Animasyonu Kullanmak » <b>jquery::fade()</b></a></li>
            <li><a href="#jquery_slide">Slide Up, Slide Down Animasyonu Kullanmak » <b>jquery::slide()</b></a></li>
            <li><a href="#jquery_toggle">Toggle Yapısı Kullanmak » <b>jquery::toggle()</b></a></li>
            <li><a href="#jquery_hide">Hide Yapısı Kullanmak » <b>jquery::hide()</b></a></li>
            <li><a href="#jquery_show">Show Yapısı Kullanmak » <b>jquery::show()</b></a></li>
            <li><a href="#jquery_animate">Animage Animasyon Yapıcısı Kullanmak » <b>jquery::animate()</b></a></li>
            <li><a href="#jquery_ajax">Ajax Yapısı Kullanmak » <b>jquery::ajax()</b></a></li>
            <li><a href="#jquery_css">CSS Stil Ekleyicisi Kullanmak » <b>jquery::css()</b></a></li>
            <li><a href="#jquery_attr">Attr Özellik Ekleyicisi Kullanmak » <b>jquery::attr()</b></a></li>
            <li><a href="#jquery_func">Fonksiyon Eklemek » <b>jquery::func()</b></a></li>  
            <li><a href="#jquery_code">Herhangi Bir Kod Kullanmak » <b>jquery::code()</b></a></li>                    
        </ul>
    </li></ul>
    
    <p class="cstfont" id="jquery_import">Jquery Kütüphanesini Dahil Etmek</p>
    <div type="code">
  	import::library(<sf>'Jquery'</sf>);
    </div>
    
   	<p class="cstfont" id="jquery_open">Script Tag Açmak</p>
    <p><ftype> jquery::open( [ <kf>boolean</kf> <vf>$jquery_kutuphanesi</vf> = <kf>true</kf> ] , [ <kf>boolean</kf> <vf>$jquery_ui_kutuphanesi</vf> = <kf>false</kf> ] , [ <kf>boolean</kf> <vf>$ready</vf> = <kf>true</kf> ] )</ftype></p>
    <p>Jquery kodları yazmaya başlamak için script tagının açılmasını sağlar. 2 parametresi vardır. Jquery kütüphanesi dahil edilsin mi, document.ready yöntemi eklensin mi.</p>
 
    <p>
    	<table class="cfont">
        	<tr><th>Parametre</th><td>Anlamları</td></tr>
            <tr><th>1. Parametre = [Jquery Sınıfı = true]</th><td>True olması durumunda jquery kütüphanesini dahil eder.</td></tr>
            <tr><th>2. Parametre = [Jquery Ui Sınıfı = false]</th><td>True olması durumunda jquery-ui kütüphanesini dahil eder.</td></tr>
            <tr><th>3. Parametre = [Ready Metodu = true]</th><td>True olması durumunda document.ready yöntemini dahil eder.</td></tr>
  
        </table>
    </p>
	<p>
 
    	<div type="code">
<pre>
<x><</x>?php
<kf>class</kf> JqueryUygulamasi
{
<ff>function</ff> index()
    {
        import::library(<sf>'Jquery'</sf>, <sf>'Form'</sf>);
        
        <kf>echo</kf> <strong>jquery::open()</strong>; 
        <comment>/* 
        <x><</x>script type="text/javascript" src="http://www.ornek.com/System/References/Jquery/Jquery.js"><x><</x>/script>
        <x><</x>script type="text/javascript">
            $(document).ready(function()
            {
        */</comment>
    }
}
</pre>
    	</div>
    </p>
    
    <p>Yukarıdaki kodun çalıştırılıp sayfanın kaynak kodu incelendiğinde açıklama satırındaki kodları görebilirsiniz.</p>
    
    
    <p class="cstfont" id="jquery_close">Script Tag Kapatmak jquery::close()</p>
    <p><ftype> jquery::close()</ftype></p>
    <p>Açılan script tagının kapatılmasını sağlar.</p>
	<p>
 
    <div type="code">
<pre>
<kf>echo</kf> jquery::open();
<kf>echo</kf> <strong>jquery::close()</strong>;
<comment>/*  
<x><</x>script type="text/javascript" src="http://www.ornek.com/System/References/Jquery/Jquery.js"><x><</x>/script>
<x><</x>script type="text/javascript">
$(document).ready(function()
{

});
<x><</x>/script>
*/</comment>
</pre>
    	</div>
    </p>
    
    
    <p class="cstfont" id="jquery_ready">Jquery Ready Yöntemini Kullanmak</p>
    <p><ftype> jquery::ready( <kf>string</kf> <vf>$js_kodlari</vf> )</ftype></p>
    <p>document.ready yöntemininin kullanılmasını sağlar. 1 parametresi vardır. Js Kodları.</p>
 
    <p>
    	<table class="cfont">
        	<tr><th>Parametre</th><td>Anlamları</td></tr>
            <tr><th>1. Parametre = [Js Kodları]</th><td>Jquery kodlarının yazılmasını sağlar.</td></tr>
  
        </table>
    </p>
	<p>
 
    	<div type="code">
<pre>
<kf>echo</kf> jquery::open(<kf>true</kf>, <kf>false</kf>);
<kf>echo</kf> <strong>jquery::ready</strong>(<sf>'alert("Merhaba!")'</sf>);
<kf>echo</kf> jquery::close();
<comment>/*  
<x><</x>script type="text/javascript" src="http://www.ornek.com/System/References/Jquery/Jquery.js"><x><</x>/script>
<x><</x>script type="text/javascript">
$(document).ready(function()
{
	alert("Merhaba!");
});
<x><</x>/script>
*/</comment>
</pre>
    	</div>
    </p>
    
    <p><div type="note"><div>NOT</div><div>Yukarıdaki kod yerine bir önceki örnekteki kodun kullanılması daha fazla kolaylık sağlar. Biz örneklerimizi kolaylık sağlaması açısından bir önceki tipte oluşturacağız.</div></div></p>
    
    
    
    <p class="cstfont" id="jquery_event">Olay Dinleyicisi Eklemek</p>
    <p><ftype> jquery::event( [ <kf>string</kf> <vf>$nesne_adi</vf> = <sf>'this'</sf> ] , [ <kf>string</kf> <vf>$olay_turu</vf> = <sf>'click'</sf> ] , <kf>string</kf> <vf>$js_kodlari</vf> )</ftype></p>
    <p>Olay eklemek için kullanılır. 3 parametresi vardır. Nesne Adı, Olay Türü, Js Kodları.</p>
 
    <p>
    	<table class="cfont">
        	<tr><th>Parametre</th><td>Anlamları</td></tr>
            <tr><th>1. Parametre = [Nesne Adı = this]</th><td>Olayın ekleneceği obje.</td></tr>
  			<tr><th>2. Parametre = [Olay Türü = click]</th><td>Olayın türü.</td></tr>
            <tr><th>3. Parametre = [Js Kodları]</th><td>Olayın etkileyeceği js kodları.</td></tr>
        </table>
    </p>
	<p>
 
    <div type="code">
<pre>
<kf>echo</kf> jquery::open();
<kf>echo</kf> <strong>jquery::event</strong>(<sf>'#buton'</sf>, <sf>'click'</sf>, <sf>'alert("1")'</sf>);
<kf>echo</kf> jquery::close();
<kf>echo</kf> form::button(<sf>'buton'</sf>, <sf>'Gönder'</sf>);
<comment>/*  
<x><</x>script type="text/javascript" src="http://www.ornek.com/System/References/Jquery/Jquery.js"><x><</x>/script>
<x><</x>script type="text/javascript">
$(document).ready(function()
{
    $("#buton").bind("click", function()
    {
    	alert("1")
    });
});
<x><</x>/script>
<x><</x>input type="button" id="buton" value="Gönder">
*/</comment>
</pre>
    </div>
    </p>
    
    
        
    <p class="cstfont" id="jquery_fade">Fade In, Fade Out Animasyonu Kullanmak</p>
    <p><ftype> jquery::fade( [ <kf>string</kf> <vf>$nesne_adi</vf> = <sf>'this'</sf> ] , [ <kf>string</kf> <vf>$animasyon_turu</vf> = <sf>'in'</sf>] , [ <kf>string/numeric</kf> <vf>$animasyon_hizi</vf> ] , <kf>string</kf> <vf>$js_kodlari</vf> )</ftype></p>
    <p>Fade animasyonu eklemek için kullanılır. 4 parametresi vardır. Nesne Adı, Olay Türü, Animasyon Hızı, Js Kodları.</p>
 
    <p>
    	<table class="cfont">
        	<tr><th>Parametre</th><td>Anlamları</td></tr>
            <tr><th>1. Parametre = [Nesne Adı = this]</th><td>Olayın ekleneceği obje.</td></tr>
  			<tr><th>2. Parametre = [Olay Türü = in]</th><td>Fade In veya Fade Out türü. Kullanılabilir Parametreler = in, out</td></tr>
            <tr><th>3. Parametre = [Animasyon Hızı]</th><td>Fade animasyonunun hızını belirler.</td></tr>
            <tr><th>4. Parametre = [Js Kodları]</th><td>Olayın etkileyeceği js kodları.</td></tr>
        </table>
    </p>
	<p>
 
    <div type="code">
<pre>
<vf>$fade</vf> = <strong>jquery::fade</strong>(<sf>'#buton'</sf>, <sf>'out'</sf>, <sf>'1000'</sf>, <sf>'alert("Buton Nerede?");'</sf>);
<kf>echo</kf> jquery::open();
<kf>echo</kf> jquery::event(<sf>'#buton'</sf>, <sf>'click'</sf>, <vf>$fade</vf>);
<kf>echo</kf> jquery::close();
<kf>echo</kf> form::button(<sf>'buton'</sf>, <sf>'Gönder'</sf>);
<comment>/*  
<x><</x>script type="text/javascript" src="http://www.ornek.com/System/References/Jquery/Jquery.js"><x><</x>/script>
<x><</x>script type="text/javascript">
$(document).ready(function()
{
    $("#buton").bind("click", function()
    {
    	$('#buton').fadeOut('1000', function(){
		alert("Buton Nerede?");
	});
    });
});
<x><</x>/script>
<x><</x>input type="button" id="buton" value="Gönder">
*/</comment>
</pre>
    </div>
    </p>
    
    <p>Yukarıdaki uygulamada iç içe jquery kodlarının kullanımına uygun örnek verilmiştir.</p>
    
    
    
        <p class="cstfont" id="jquery_slide">Slide Up, Slide Down ve Slide Toggle Animasyonu Kullanmak</p>
        <p><ftype> jquery::slide( [ <kf>string</kf> <vf>$nesne_adi</vf> = <sf>'this'</sf> ] , [ <kf>string</kf> <vf>$animasyon_turu</vf> = <sf>'toogle'</sf> ] , [ <kf>string/numeric</kf> <vf>$animasyon_hizi</vf> ] , <kf>string</kf> <vf>$js_kodlari</vf> )</ftype></p>
    <p>Slide animasyonu eklemek için kullanılır. 4 parametresi vardır. Nesne Adı, Olay Türü, Animasyon Hızı, Js Kodları.</p>
 
    <p>
    	<table class="cfont">
        	<tr><th>Parametre</th><td>Anlamları</td></tr>
            <tr><th>1. Parametre = [Nesne Adı = this]</th><td>Olayın ekleneceği obje.</td></tr>
  			<tr><th>2. Parametre = [Olay Türü = toogle]</th><td>Slide türü. Kullanılabilir Parametreler = up, down, toggle</td></tr>
            <tr><th>3. Parametre = [Animasyon Hızı]</th><td>Slide animasyonunun hızını belirler.</td></tr>
            <tr><th>4. Parametre = [Js Kodları]</th><td>Olayın etkileyeceği js kodları.</td></tr>
        </table>
    </p>
	<p>
 
    <div type="code">
<pre>
<vf>$slide</vf> = <strong>jquery::slide</strong>(<sf>'#buton'</sf>, <sf>'up'</sf>, <sf>'1000'</sf>, <sf>'alert("Buton Nerede?");'</sf>);
<kf>echo</kf> jquery::open();
<kf>echo</kf> jquery::event(<sf>'#buton'</sf>, <sf>'click'</sf>, <vf>$slide</vf>);
<kf>echo</kf> jquery::close();
<kf>echo</kf> form::button(<sf>'buton'</sf>, <sf>'Gönder'</sf>);
<comment>/*  
<x><</x>script type="text/javascript" src="http://www.ornek.com/System/References/Jquery/Jquery.js"><x><</x>/script>
<x><</x>script type="text/javascript">
$(document).ready(function()
{
    $("#buton").bind("click", function()
    {
    	$('#buton').slideUp('1000', function(){
		alert("Buton Nerede?");
	});
    });
});
<x><</x>/script>
<x><</x>input type="button" id="buton" value="Gönder">
*/</comment>
</pre>
    </div>
    </p>
    
    <p class="cstfont" id="jquery_toggle">Toggle Animasyonu Kullanmak</p>
    <p><ftype> jquery::toogle( [ <kf>string</kf> <vf>$nesne_adi</vf> = <sf>'this'</sf> ] , [ <kf>string/numeric</kf> <vf>$animasyon_hizi</vf> ] , <kf>string</kf> <vf>$efekt_turu</vf> , <kf>string</kf> <vf>$js_kodlari</vf> )</ftype></p>
    <p>Toggle animasyonu eklemek için kullanılır. 4 parametresi vardır. Nesne Adı, Animasyon Hızı, Animasyon Türü, Js Kodları.</p>
 
    <p>
    	<table class="cfont">
        	<tr><th>Parametre</th><td>Anlamları</td></tr>
            <tr><th>1. Parametre = [Nesne Adı = this]</th><td>Olayın ekleneceği obje.</td></tr>
  			<tr><th>2. Parametre = [Animasyon Hızı]</th><td>Slide animasyonunun hızını belirler.</td></tr>
            <tr><th>3. Parametre = [Efekt Türü]</th><td>Easing efekt türlerinden herhangi biri.</td></tr>
            <tr><th>4. Parametre = [Js Kodları]</th><td>Olayın etkileyeceği js kodları.</td></tr>
        </table>
    </p>
	<p>
 
    <div type="code">
<pre>
<vf>$toggle</vf> = <strong>jquery::toggle</strong>(<sf>'#buton'</sf>, <sf>'fast'</sf>, <sf>'linear'</sf>, <sf>'alert("Buton Nerede?");'</sf>);
<kf>echo</kf> jquery::open();
<kf>echo</kf> jquery::event(<sf>'#buton'</sf>, <sf>'click'</sf>, <vf>$toggle</vf>);
<kf>echo</kf> jquery::close();
<kf>echo</kf> form::button(<sf>'buton'</sf>, <sf>'Gönder'</sf>);
<comment>/*  
<x><</x>script type="text/javascript" src="http://www.ornek.com/System/References/Jquery/Jquery.js"><x><</x>/script>
<x><</x>script type="text/javascript">
$(document).ready(function()
{
    $("#buton").bind("click", function()
    {
    	$('#buton').toggle('fast', 'linear', function(){
		alert("Buton Nerede?");
	});
    });
});
<x><</x>/script>
<x><</x>input type="button" id="buton" value="Gönder">
*/</comment>
</pre>
    </div>
    </p>
    
    
    
    <p class="cstfont" id="jquery_hide">Hide Gizleme Efekti Kullanmak</p>
    <p><ftype> jquery::hide( [ <kf>string</kf> <vf>$nesne_adi</vf> = <sf>'this'</sf> ] , [ <kf>string/numeric</kf> <vf>$animasyon_hizi</vf> ] , <kf>string</kf> <vf>$js_kodlari</vf> )</ftype></p>
    <p>Hide Efekti eklemek için kullanılır. 3 parametresi vardır. Nesne Adı, Animasyon Hızı, Js Kodları.</p>
 
    <p>
    	<table class="cfont">
        	<tr><th>Parametre</th><td>Anlamları</td></tr>
            <tr><th>1. Parametre = [Nesne Adı = this]</th><td>Olayın ekleneceği obje.</td></tr>
  			<tr><th>2. Parametre = [Animasyon Hızı]</th><td>Hide efektinin hızını belirler.</td></tr>
            <tr><th>3. Parametre = [Js Kodları]</th><td>Olayın etkileyeceği js kodları.</td></tr>
        </table>
    </p>
	<p>
 
    <div type="code">
<pre>
<vf>$hide</vf> = <strong>jquery::hide</strong>(<sf>'#buton'</sf>, <sf>'fast'</sf>, <sf>'alert("Buton Nerede?");'</sf>);
<kf>echo</kf> jquery::open();
<kf>echo</kf> jquery::event(<sf>'#buton'</sf>, <sf>'click'</sf>, <vf>$hide</vf>);
<kf>echo</kf> jquery::close();
<kf>echo</kf> form::button(<sf>'buton'</sf>, <sf>'Gönder'</sf>);
<comment>/*  
<x><</x>script type="text/javascript" src="http://www.ornek.com/System/References/Jquery/Jquery.js"><x><</x>/script>
<x><</x>script type="text/javascript">
$(document).ready(function()
{
    $("#buton").bind("click", function()
    {
    	$('#buton').hide('fast', function(){
		alert("Buton Nerede?");
	});
    });
});
<x><</x>/script>
<x><</x>input type="button" id="buton" value="Gönder">
*/</comment>
</pre>
    </div>
    </p>
    
    
    <p class="cstfont" id="jquery_show">Show Gösterme Efekti Kullanmak</p>
    <p><ftype> jquery::show( [ <kf>string</kf> <vf>$nesne_adi</vf> = <sf>'this'</sf> ] , [ <kf>string/numeric</kf> <vf>$animasyon_hizi</sf> ] , <kf>string</kf> <vf>$js_kodlari</vf> )</ftype></p>
    <p>Show Efekti eklemek için kullanılır. 3 parametresi vardır. Nesne Adı, Animasyon Hızı, Js Kodları.</p>
 
    <p>
    	<table class="cfont">
        	<tr><th>Parametre</th><td>Anlamları</td></tr>
            <tr><th>1. Parametre = [Nesne Adı = this]</th><td>Olayın ekleneceği obje.</td></tr>
  			<tr><th>2. Parametre = [Animasyon Hızı]</th><td>Show efektinin hızını belirler.</td></tr>
            <tr><th>3. Parametre = [Js Kodları]</th><td>Olayın etkileyeceği js kodları.</td></tr>
        </table>
    </p>
	<p>
 
    <div type="code">
<pre>
<vf>$show</vf> = <strong>jquery::show</strong>(<sf>'#nesne'</sf>, <sf>'fast'</sf>, <sf>'alert("Nesne Gösterildi.");'</sf>);
<vf>$hide</vf> = jquery::hide(<sf>'#nesne'</sf>, <sf>'fast'</sf>, <sf>'alert("Nesne Gizlendi.");'</sf>);
<kf>echo</kf> jquery::open();
<kf>echo</kf> jquery::event(<sf>'#buton'</sf>, <sf>'mouseover'</sf>, <vf>$show</vf>);
<kf>echo</kf> jquery::event(<sf>'#buton'</sf>, <sf>'mouseout'</sf>, <vf>$hide</vf>);
<kf>echo</kf> jquery::close();
<kf>echo</kf> form::button(<sf>'buton'</sf>, <sf>'Gönder'</sf>);
<kf>echo</kf> <sf>'<x><</x>div id="nesne">Nesne<x><</x>/div>'</sf>;
<comment>/*  
<x><</x>script type="text/javascript" src="http://www.ornek.com/System/References/Jquery/Jquery.js"><x><</x>/script>
<x><</x>script type="text/javascript">
$(document).ready(function()
{
    $("#buton").bind("mouseover", function(e)
    {
        $('#nesne').show('fast', function(){
        alert("Nesne Gösterildi.");
    });
    
    });
    $("#buton").bind("mouseout", function(e)
    {
        $('#nesne').hide('fast', function(){
        alert("Nesne Gizlendi.");
    });
});
<x><</x>/script>
<x><</x>input type="button" id="buton" value="Gönder">
<x><</x>div id="nesne">Nesne<x><</x>/div>
*/</comment>
</pre>
    </div>
    </p>
    
    
    <p class="cstfont" id="jquery_animate">Animate Animasyon Yapıcısı Kullanmak</p>
    <p><ftype> jquery::animate( [ <kf>string</kf> <vf>$nesne_adi</vf> = <sf>'this'</sf> ] , [ <kf>array</kf> <vf>$animasyon_ogeleri</vf> ] , <kf>string</kf> <vf>$animasyon_hizi</vf> , <kf>string</kf> <vf>$efekt_turu</vf> , <kf>string</kf> <vf>$js_kodlari</vf> )</ftype></p>
    <p>Hide Efekti eklemek için kullanılır. 5 parametresi vardır. Nesne Adı, Animasyon Hızı, Js Kodları.</p>
 
    <p>
    	<table class="cfont">
        	<tr><th>Parametre</th><td>Anlamları</td></tr>
            <tr><th>1. Parametre = [Nesne Adı = this]</th><td>Olayın ekleneceği obje.</td></tr>
            <tr><th>2. Parametre = [Animasyon Öğeleri]</th><td>Animasyon öğeleri belirlenir.</td></tr>
  			<tr><th>3. Parametre = [Animasyon Hızı]</th><td>Animasyon hızını belirler.</td></tr>
            <tr><th>4. Parametre = [Efekt Türü]</th><td>Efektin türünü belirler.</td></tr>
            <tr><th>5. Parametre = [Js Kodları]</th><td>Olayın etkileyeceği js kodları.</td></tr>
        </table>
    </p>
	<p>
 
    <div type="code">
<pre>
import::library(<sf>'Jquery'</sf>, <sf>'Form'</sf>);
		
<vf>$anismasyon_nesneleri</vf> = <kf>array</kf>(<sf>'width'</sf> => <sf>'400px'</sf>, <sf>'height'</sf> => <sf>'300px'</sf>, <sf>'opacity'</sf> => <sf>'.5'</sf>, <sf>'boderWidth'</sf> => <sf>'10px'</sf>);		
<vf>$mili_salise</vf> = <sf>''</sf>;	
<vf>$special_easing</vf> = <kf>array</kf>(<sf>'width'</sf> => <sf>'easeOutBounce'</sf>, <sf>'height'</sf> => <sf>'easeOutBounce'</sf>);
<vf>$efektler</vf> = <kf>array</kf>(<sf>'duration'</sf> => <sf>'1000'</sf>, <sf>'specialEasing'</sf> => <vf>$special_easing</vf>);		
<vf>$kodlar</vf> = <sf>'alert("Animasyon Tamamlandı")'</sf>;

<vf>$animate</vf> = <strong>jquery::animate</strong>(<sf>'#nesne'</sf>, <vf>$anismasyon_nesneleri</vf>, <vf>$mili_salise</vf>, <vf>$efektler</vf>, <vf>$kodlar</vf> );

<kf>echo</kf> jquery::open(<kf>true</kf>,<kf>true</kf>);
<kf>echo</kf> jquery::event(<sf>'#buton'</sf>, <sf>'click'</sf>, <vf>$animate</vf>);
<kf>echo</kf> jquery::close();
<kf>echo</kf> form::button(<sf>'buton'</sf>, <sf>'Gönder'</sf>);
<kf>echo</kf> <sf>'<x><</x>div style="border:solid 1px #000" id="nesne">Nesne<x><</x>/div>'</sf>;
<comment>/*  
<x><</x>script type="text/javascript" src="http://www.ornek.com/System/References/Jquery/Jquery.js"><x><</x>/script>
<x><</x>script type="text/javascript" src="http://www.ornek.com/System/References/Jquery/JqueryUi.js"><x><</x>/script>
<x><</x>script type="text/javascript">
$(document).ready(function()
{
    $("#buton").bind("click", function(e)
    {
        $('#nesne').animate(
        	{width:"400px",height:"300px",opacity:.5,boderWidth:"10px"},
        	{duration:1000,specialEasing:{width:"easeOutBounce",height:"easeOutBounce"}},
       	 	function(){alert("Animasyon Tamamlandı")}
        );
    
    });
    
});
<x><</x>/script>
<x><</x>input type="button" id="buton" value="Gönder">
<x><</x>div id="nesne">Nesne<x><</x>/div>
*/</comment>
</pre>
    </div>
    </p>
    
    
    
    <p class="cstfont" id="jquery_ajax">Ajax Kullanmak</p>
    <p><ftype> jquery::ajax( <kf>array</kf> <vf>$yontemler</vf> )</ftype></p>
    <p>Jquery Ajax işleminin ZN kod çatısındaki yazım şekli. 1 dizi parametresi vardır. Ayarlar Dizi Parametresi.</p>
 
    <p>
    	<table class="cfont">
        	<tr><th>Parametre</th><td>Anlamları</td></tr>
            <tr><th>1. Parametre = [Ayarlar]</th><td>Ajax işlemi için gerekli yontemler.</td></tr>	
        </table>
    </p>
    <p>
    Ayarlar dizisinde kullanılacak parametreler.
    	<table class="cfont">
        	<tr><th>No</th><th>Ayarlar</th><td>Kullanımı</td></tr>
            <tr><th>1</th><th>type</th><td>[ type => post ]</td></tr>
            <tr><th>2</th><th>dataType</th><td>dataType => json </td></tr>
            <tr><th>3</th><th>url</th><td> url => http://www.ornek.com/ajax </td></tr>
            <tr><th>4</th><th>data</th><td> data => deger=1 </td></tr>
            <tr><th>5</th><th>success</th><td> success => kodlar </td></tr>
            <tr><th>6</th><th>error</th><td> error => kodlar </td></tr>
            <tr><th>7</th><th>complete</th><td> complete => kodlar </td></tr>
            <tr><th>8</th><th>beforeSend</th><td> beforeSend => kodlar </td></tr>
            <tr><th>9</th><th>done</th><td> done => kodlar </td></tr>
        </table>
    </p>
	<p>
 
    <div type="code">
<pre>
<vf>$ajax_veriler</vf> = <kf>array</kf>(
    <sf>'url'</sf> => <sf>'Ajax/Ajax_islemleri'</sf>, 
    <sf>'data'</sf> => <sf>'deger=1'</sf>,
    <sf>'dataType'</sf> => <sf>'json'</sf>,
    <sf>'error'</sf> => <sf>'alert(data.deger);'</sf>
);
<vf>$ajax</vf> = <strong>jquery::ajax</strong>(<vf>$ajax_veriler</vf>);
<kf>echo</kf> jquery::open();
<kf>echo</kf> jquery::event(<sf>'#buton'</sf>, <sf>'click'</sf>, <vf>$ajax</vf>);
<kf>echo</kf> jquery::close();
<kf>echo</kf> form::button(<sf>'buton'</sf>, <sf>'Gönder'</sf>);
<comment>/*  
<x><</x>script type="text/javascript" src="http://www.ornek.com/System/References/Jquery/Jquery.js"><x><</x>/script>
<x><</x>script type="text/javascript">
$(document).ready(function()
{
    $("#buton").bind("click", function()
    {
    	$.ajax
        ({
            url:"http://localhost/znfw/index.php/Ajax/Ajax_islemleri",
            data:"deger=1",
            error:function(data){
                alert(data.deger);
            },
            type:"post",
            dataType:"json"
        });
    });
});
<x><</x>/script>
<x><</x>input type="button" id="buton" value="Gönder">
*/</comment>
</pre>
    </div>
    </p>
    
    <p><div type="note"><div>NOT</div><div>Type yöntemi varsayılan olarak <strong>post</strong> ayarlıdır. Bu ayar dışında farklı bir ayar kullanacaksanız yöntemler dizisine bu ifadeleri eklemeniz gerekmektedir.</div></div></p>
    
    <p>Success ve Error dönüş komutları yazmak isterseniz şu satırı ilave etmeniz yeterlidir.</p>
    <div type="code"><sf>'error'</sf> => <sf>' // js kodları '</sf></div>
    <p></p>
    <div type="code"><sf>'success'</sf> => <sf>' // js kodları '</sf></div>
    
    <p class="cstfont" id="jquery_css">CSS Stil Ekleyicisi Kullanmak</p>
    <p><ftype> jquery::css([ <kf>string</kf> <vf>$nesne_adi</vf> = <sf>'this'</sf> ] , [ <kf>string</kf> <vf>$tur</vf> = <sf>'add'</sf> ] , [ <kf>string</kf> <vf>$css_sinifi</vf> ] )</ftype></p>
    <p>Jquery addClass, removeClass ve toggleClass işleminin ZN kod çatısındaki yazım şekli. 3 parametresi vardır. Nesne Adı, Tür, Css Sınıfı.</p>
 
    <p>
    	<table class="cfont">
        	<tr><th>Parametre</th><td>Anlamları</td></tr>
            <tr><th>1. Parametre = [Nesne Adı = this]</th><td>Stil eklenecek nesnenin adı.</td></tr>	
            <tr><th>2. Parametre = [Tür = add]</th><td>add, remove veya toggle parametreleri alır.</td></tr>
            <tr><th>3. Parametre = [Sınıf]</th><td>.stil tipi sınıflar.</td></tr>
        </table>
    </p>
	<p>
 
    <div type="code">
<pre>
<vf>$css</vf> = <strong>jquery::css</strong>(<sf>'#nesne'</sf>, <sf>'add'</sf>, <sf>'.arkaplan'</sf>);
<kf>echo</kf> jquery::open();
<kf>echo</kf> jquery::event(<sf>'#buton'</sf>, <sf>'click'</sf>, <vf>$css</vf>);
<kf>echo</kf> jquery::close();
<kf>echo</kf> form::button(<sf>'buton'</sf>, <sf>'Gönder'</sf>);
<kf>echo</kf> <sf>'<x><</x>div id="nesne">Nesne<x><</x>/div>'</sf>;
<comment>/*  
<x><</x>script type="text/javascript" src="http://www.ornek.com/System/References/Jquery/Jquery.js"><x><</x>/script>
<x><</x>script type="text/javascript">
$(document).ready(function()
{
    $("#buton").bind("click", function(e)
    {
        $('#nesne').addClass(".arkaplan");
    });
});
<x><</x>/script>
<x><</x>input type="button" id="buton" value="Gönder">
<x><</x>div id="nesne">Nesne<x><</x>/div>
*/</comment>
</pre>
    </div>
    </p>
    
    
    
    <p class="cstfont" id="jquery_attr">Attr Özellik Ekleyicisi Kullanmak</p>
    <p><ftype> jquery::css( [ <kf>string</kf> <vf>$nesne_adi</sf> = <sf>'this'</sf> ] , [ <kf>string</kf> <vf>$tur</vf> = <sf>'add'</sf> ] , [ <kf>array</kf> <vf>$ozellikler</vf> ] )</ftype></p>
    <p>Jquery attr, removeAttr işleminin ZN kod çatısındaki yazım şekli. 3 parametresi vardır. Nesne Adı, Tür, Özellikler.</p>
 
    <p>
    	<table class="cfont">
        	<tr><th>Parametre</th><td>Anlamları</td></tr>
            <tr><th>1. Parametre = [Nesne Adı = this]</th><td>Özellik eklenecek nesnenin adı.</td></tr>	
            <tr><th>2. Parametre = [Tür = add]</th><td>add, remove parametreleri alır.</td></tr>
            <tr><th>3. Parametre = [Özellikler]</th><td>özellikler.</td></tr>
        </table>
    </p>
	<p>
 
    <div type="code">
<pre>
<vf>$ozellikler</vf> = <kf>array</kf>(
	<sf>'ozellik'</sf> => <sf>'yeni_deger</sf>',
	<sf>'style'</sf> => <sf>'color:red'</sf>'
);
<vf>$attr</vf> = <strong>jquery::attr</strong>(<sf>'#nesne'</sf>, <sf>'add'</sf>, <vf>$ozellikler</vf>);
<kf>echo</kf> jquery::open();
<kf>echo</kf> jquery::event(<sf>'#buton'</sf>, <sf>'click'</sf>, <vf>$attr</vf>);
<kf>echo</kf> jquery::close();
<kf>echo</kf> form::button(<sf>'buton'</sf>, <sf>'Gönder'</sf>);
<kf>echo</kf> <sf>'<x><</x>div id="nesne">Nesne<x><</x>/div>'</sf>;
<comment>/*  
<x><</x>script type="text/javascript" src="http://www.ornek.com/System/References/Jquery/Jquery.js"><x><</x>/script>
<x><</x>script type="text/javascript">
$(document).ready(function()
{
    $("#buton").bind("click", function(e)
    {
        $('#nesne').attr({style:"color:red",name:"yeni_nesne"});
    });
});
<x><</x>/script>
<x><</x>input type="button" id="buton" value="Gönder">
<x><</x>div id="nesne">Nesne<x><</x>/div>
*/</comment>
</pre>
    </div>
    </p>
    
    
    
     <p class="cstfont" id="jquery_func">Function Eklemek</p>
     <p><ftype> jquery::func( [ <kf>string</kf> <vf>$nesne_adi</vf> = <sf>'this'</sf> ] , [ <kf>string</kf> <vf>$parametreler</vf> = <sf>'e'</sf> ] , [ <kf>string</kf> <vf>$js_kodlari</vf> ] </pf>)</ftype></p>
    <p>Jquery ornek:function(){} tipi işlemin ZN kod çatısındaki yazım şekli. 3 parametresi vardır. Nesne Adı, Parametreler, Js Kodları.</p>
 
    <p>
    	<table class="cfont">
        	<tr><th>Parametre</th><td>Anlamları</td></tr>
            <tr><th>1. Parametre = [Nesne Adı = this]</th><td>Fonksiyon eklenecek nesnenin adı.</td></tr>	
            <tr><th>2. Parametre = [Parametreler = e]</th><td>Fonksiyon parametreleri.</td></tr>
            <tr><th>3. Parametre = [Js Kodları]</th><td>özellikler.</td></tr>
        </table>
    </p>
	<p>
 
    <div type="code">
<pre>

<kf>echo</kf> jquery::open();
<kf>echo</kf> <strong>jquery::func</strong>(<sf>'error'</sf>, <sf>'e'</sf>, <sf>'alert(1);'</sf>);
<kf>echo</kf> jquery::close();
<comment>/*  
<x><</x>script type="text/javascript" src="http://www.ornek.com/System/References/Jquery/Jquery.js"><x><</x>/script>
<x><</x>script type="text/javascript">
$(document).ready(function()
{
    error:function(e){
	 alert(1);
    }
});
<x><</x>/script>
*/</comment>
</pre>
    </div>
    </p>
    
    
    <p class="cstfont" id="jquery_code">Herhangi Bir Kod Eklemek</p>
    <p><ftype> jquery::code( [ <kf>string</kf> <vf>$nesne_adi</vf> = <sf>'this'</sf> ] , [ <kf>string</kf> <vf>$js_kodlari</vf> ] )</ftype></p>
    <p>Herhangi bir javascript kodu eklemek için kullanılır. 2 parametresi vardır. Nesne Adı, Js Kodları.</p>
 
    <p>
    	<table class="cfont">
        	<tr><th>Parametre</th><td>Anlamları</td></tr>
            <tr><th>1. Parametre = [Nesne Adı = this]</th><td>Fonksiyon eklenecek nesnenin adı.</td></tr>	
            <tr><th>2. Parametre = [Js Kodları]</th><td>Java script kodları.</td></tr>
        </table>
    </p>
	<p>
 
    <div type="code">
<pre>

<kf>echo</kf> jquery::open();
<kf>echo</kf> <strong>jquery::code</strong>(<sf>'#nesne'</sf>, <sf>'attr("style","color:red")'</sf>);
<kf>echo</kf> jquery::close();
<comment>/*  
<x><</x>script type="text/javascript" src="http://www.ornek.com/System/References/Jquery/Jquery.js"><x><</x>/script>
<x><</x>script type="text/javascript">
$(document).ready(function()
{
   $("#nesne").attr("style","color:red");
});
<x><</x>/script>
*/</comment>
</pre>
    </div>
    </p>
    
    
    
    <div type="prev-next">
    	<div type="prev-btn"><a href="lib_image.html">Önceki</a></div><div type="next-btn"><a href="lib_json.html">Sonraki</a></div>
    </div>
 
</body>
</html>              