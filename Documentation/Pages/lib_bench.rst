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
    <div id="content-document"><a href="#">Döküman</a> » <a href="libraries.html">Kütüphaneler</a> » Benchmark(Performans Test) Sınıfı</div> 
    <p class="ctfont">Benchmark(Performans Test) Sınıfı</p>
    <p>Benchmark sınıfı, yazacağınız sistemin veya kodların performansını test etmek amacıyla oluşturulmuştur.</p>
    <ul><li><a href="#" class="infont">Benchmark(Performans Test) Sınıfı</a><br><br>
        <ul>
        	<li><a href="#bench_import">Benchmark Kütüphanesini Dahil Etmek</a></li>
            <li><a href="#bench_test_start">Benchmark Testini Başlatmak » <b>bench::test_start()</b></a></li>
            <li><a href="#bench_test_end">Benchmark Testini Bitirmek » <b>bench::test_end()</b></a></li>
            <li><a href="#bench_elapsed_time">Test Esnasında Geçen Süreyi Öğrenmek » <b>bench::elapsed_time()</b></a></li> 
            <li><a href="#bench_memory_usage">PHP Betiğinin Kullandığı Bellek Miktarını Öğrenmek » <b>bench::memory_usage()</b></a></li>   
            <li><a href="#bench_max_memory_usage">PHP Betiğine Ayrılan Maksimum Bellek Miktarını Öğrenmek » <b>bench::max_memory_usage()</b></a></li>   
            <li><a href="#bench_calculated_memory">Bir PHP Betiğinin Kullandığı Bellek Miktarını Hesaplamak » <b>bench::calculated_memory()</b></a></li>    
        </ul>
    </li></ul>
    
    <p class="cstfont" id="bench_import">Benchmark Kütüphanesini Dahil Etmek</p>
    <div type="code">
  	import::library(<sf>'Benchmark'</sf>);
    </div>
        
   	<p class="cstfont" id="bench_test_start">Benchmark Testini Başlatmak</p>
    <p><ftype>bench::test_start( [ <kf>string</kf> <vf>$test_adi</vf> ] )</ftype></p>
   	<p>Benchmark testini başlatır. Tek parametresi vardır. Test adı parametresi.</p>
    
    <p>
    	<table class="cfont">
        	<tr><th>No</th><th>Parametre</th><td>Anlamları</td></tr>
            <tr><th>1</th><th>[ string Test Adı ]</th><td>Başlatılan testin ismi.</td></tr>
        </table>
    </p>
   
    
    <div type="code">
    <pre>
bench::test_start(<sf>'test'</sf>);
    <comment> // kodlar </comment>
    </pre>
    </div>
    
    
    <p class="cstfont" id="bench_test_end">Benchmark Testini Bitirmek</p>
    <p><ftype>bench::test_end( [ <kf>string</kf> <vf>$test_adi</vf> ] )</ftype></p>
   	<p>Benchmark testini bitirir. Tek parametresi avrdır. Test adı parametresi</p>
    
    <p>
    	<table class="cfont">
        	<tr><th>No</th><th>Parametre</th><td>Anlamları</td></tr>
            <tr><th>1</th><th>[ string Test Adı ]</th><td>Bitirilecek testin ismi.</td></tr>
        </table>
    </p>
   
    
    <div type="code">
    <pre>
bench::test_start(<sf>'test'</sf>);
    <comment> // kodlar </comment>
bench::test_end(<sf>'test'</sf>);

bench::test_start(<sf>'test1'</sf>);
    <comment> // kodlar </comment>
bench::test_end(<sf>'test1'</sf>);
	</pre>
    </div>
    
    
    <p class="cstfont" id="bench_elapsed_time">Test Test Esnasında Geçen Süreyi Öğrenmek</p>
    <p><ftype>bench::elapsed_time( [ <kf>string</kf> <vf>$test_adi</vf> ] , [ <kf>numeric</kf> <vf>$ondalik</vf> = <if>4</if> ] )</ftype></p>
   	<p>Benchmark testi sonunda geçen süreyi öğrenmek için kullanılır. </p>
   	
    <p>
    	<table class="cfont">
        	<tr><th>No</th><th>Parametre</th><td>Anlamları</td></tr>
            <tr><th>1</th><th>[ string Test Adı ]</th><td>Hangi testin geçen zamanı öğrenilmek isteniyorsa o testin adı yazılır.</td></tr>
            <tr><th>2</th><th>[ string/int Ondalık = 4 ]</th><td>Elapsed Time yani geçen zaman süresinde virgülden sonraki kısmın kaç basamaklı olacağı belirlenir.</td></tr>
        </table>
    </p>
    
    <div type="code">
    <pre>
bench::test_start(<sf>'test'</sf>);
    <comment> // kodlar </comment>
bench::test_end(<sf>'test'</sf>);

bench::test_start(<sf>'test1'</sf>);
    <comment> // kodlar </comment>
bench::test_end(<sf>'test1'</sf>);

<kf>echo</kf> bench::elapsed_time(<sf>'test'</sf>); <comment> // 0.0895 </comment>

<kf>echo</kf> bench::elapsed_time(<sf>'test1'</sf>); <comment> // 0.0595 </comment>
    </pre>
    </div>
    
    
    <p class="cstfont" id="bench_memory_usage">PHP Betiğinin Kullandığı Bellek Miktarını Öğrenmek</p>
    <p><ftype>bench::memory_usage( [ <kf>boolean</kf> <vf>$gercek_bellek_miktari</vf> = <kf>false</kf> ] )</ftype></p>
   	<p>PHP kodlarının sistemde kaç byte yer kapladığını öğrenmek için kullanılır. </p>
   	
    <p>
    	<table class="cfont">
        	<tr><th>No</th><th>Parametre</th><td>Anlamları</td></tr>
            <tr><th>1</th><th>[ boolean Gerçek Bellek Miktarı = false ]</th><td>Gerçek bellek miktarı.</td></tr>
        </table>
    </p>
    
    <div type="code">
<kf>echo</kf> bench::memory_usage(); <comment> // 775.7 KB </comment><br>
    </div>
    
    <p class="cstfont" id="bench_max_memory_usage">PHP Betiğine Ayrılan Maksimum Bellek Miktarını Öğrenmek</p>
    <p><ftype>bench::max_memory_usage( [ <kf>boolean</kf> <vf>$gercek_bellek_miktari</vf> = <kf>false</kf> ] )</ftype></p>
   	<p>PHP kodlarına ayrılan maksimum bellek miktarını öğrenmek için kullanılır. </p>
   	
    <p>
    	<table class="cfont">
        	<tr><th>No</th><th>Parametre</th><td>Anlamları</td></tr>
            <tr><th>1</th><th>[ boolean Gerçek Bellek Miktarı = false ]</th><td>Gerçek bellek miktarı.</td></tr>
        </table>
    </p>
    
    <div type="code">
<kf>echo</kf> bench::max_memory_usage(); <comment> // 926.3 KB </comment><br>
    </div>
    
    <p class="cstfont" id="bench_calculated_memory">Bir PHP Betiğinin Kullandığı Bellek Miktarını Hesaplamak</p>
    <p><ftype>bench::calculated_memory( [ <kf>string</kf> <vf>$test_adi</vf> ] )</ftype></p>
   	<p>Bir PHP kodunun bellekte ne kadar yer kapladığını hesaplamak için kullanılır. </p>
   	
    <p>
    	<table class="cfont">
        	<tr><th>No</th><th>Parametre</th><td>Anlamları</td></tr>
            <tr><th>1</th><th>[ string Test Adı ]</th><td>Hangi testin kodlarının ne kadar yer kapladığını öğrenmek için kullanılır.</td></tr>
        </table>
    </p>
    
    <div type="code">
    <pre>
bench::test_start(<sf>'test'</sf>);
    <comment> // kodlar </comment>
bench::test_end(<sf>'test'</sf>);

bench::test_start(<sf>'test1'</sf>);
    <comment> // kodlar </comment>
bench::test_end(<sf>'test1'</sf>);

<kf>echo</kf> bench::calculated_memory(<sf>'test'</sf>); <comment> // 138896 </comment>

<kf>echo</kf> bench::calculated_memory(<sf>'test1'</sf>); <comment> // 144531</comment>
    </pre>
    </div>
    
    <div type="prev-next">
    	<div type="prev-btn"><a href="lib_ajax.html">Önceki</a></div><div type="next-btn"><a href="lib_cart.html">Sonraki</a></div>
    </div>
 
</body>
</html>              