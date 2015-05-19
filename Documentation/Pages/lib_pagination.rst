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
    <div id="content-document"><a href="#">Döküman</a> » <a href="libraries.html">Kütüphaneler</a> » Pagination(Sayfalama) Sınıfı</div> 
    <p class="ctfont">Pagination(Sayfalama) Sınıfı</p>
    <p>Verileri sayfalamak için oluşturulmuş  sayfalama yöntemini oldukça kolaylaştırmış sınıftır.</p>
    <ul><li><a href="#" class="infont">Pagination(Sayfalama) Sınıfı ve Yöntemleri</a><br><br>
        <ul>    
        	<li><a href="#pag_import">Pagination Kütüphanesini Dahil Etmek</a></li>
            <li><a href="#pag_settings">Sayfalama Ayarlarını Yapmak » <b>pag::settings()</b></a></li>
            <li><a href="#pag_create">Sayfalamayı Oluşturmak » <b>pag::create()</b></a></li>
        </ul>
    </li></ul>
    
    <p class="cstfont" id="pag_import">Pagination Kütüphanesini Dahil Etmek</p>
    <div type="code">
  	import::library(<sf>'Pagination'</sf>);
    </div>
    
   	<p class="cstfont" id="pag_settings">Sayfalama Ayarlarını Yapmak</p>
    <p><ftype>pag::settings( <kf>array</kf> <vf>$ayarlar</vf> )</ftype></p>
    <p>Sayfalama ayarlarını yapmak için kullanılır. Tek parametresi vardır. Ayarlar.</p>
 
    <p>
    	<table class="cfont">
        	<tr><th>Parametre</th><td>Anlamları</td></tr>
            <tr><th>1. Parametre = Ayarlar</th><td>Sayfalama ayarları.</td></tr>
            <tr><th>Ayarlar Parametresinin Alt Ayarları</th><th>Anlamları.</th></tr>
            <tr><th>total_rows = 0</th><td>Toplam kayıt sayısı.</td></tr>
            <tr><th>limit = 0</th><td>Bir sayfada gösterilecek kayıt sayısı.</td></tr>
            <tr><th>url</th><td>Sayfa numaralarının ekleneceği url. Örnek: urunler/sayfa/ böyle bir url ekinin sonuna sayfa numaraları eklenecektir.</td></tr>
            <tr><th>[count_links = 10]</th><td>Sayfalama aracında gösterilecek link sayısı. Örnek: << < 1 2 3 4 5 6 7 8 9 10 > >>.</td></tr>
            <tr><th>[prev_name = [first]]</th><td>Bir önceki sayfa işareti. Örnek  [prev] 1 2 3 4 5 </td></tr>
            <tr><th>[next_name = [next]]</th><td>Bir sonraki sayfa işareti. Örnek   1 2 3 4 5 [next]</td></tr>
            <tr><th>[first_name = [first]]</th><td>En baştaki sayfa işareti. Örnek  [first] [prev] ... 21 22 23 24 25 </td></tr>
            <tr><th>[last_name = [last]]</th><td>Bir sonraki sayfa işareti. Örnek   1 2 3 4 5 ... [next] [last]</td></tr>
            <tr><th>[style = array()]</th><th>Stil Dizisi</th></tr>
            <tr><th>Stil Dizisi Ayarları</th><th>Anlamları</th></tr>
            <tr><th>$style['current'] = 'color:red'</th><td>Stil eklenecek o anki açık olan sayfanın numarası.</td></tr>
            <tr><th>$style['links'] = 'color:blue'</th><td>Stil eklenecek diğer sayfa numaraları.</td></tr>
            <tr><th>$style['next'] = 'color:green'</th><td>Stil eklenecek bir sonraki sayfa butonu.</td></tr>
            <tr><th>$style['prev'] = 'color:green'</th><td>Stil eklenecek bir önceki sayfa butonu.</td></tr>
            <tr><th>$style['last'] = 'color:pink'</th><td>Stil eklenecek son sayfa butonu.</td></tr>
            <tr><th>$style['first'] = 'color:pink'</th><td>Stil eklenecek ilk sayfa butonu.</td></tr>
            <tr><th>[class = array()]</th><th>Css Sınıf Dizisi</th></tr>
            <tr><th>Css Sınıf Dizisi Ayarları</th><th>Anlamları</th></tr>
            <tr><th>$class['current'] = 'current'</th><td>Sınıf eklenecek o anki açık olan sayfanın numarası.</td></tr>
            <tr><th>$class['links'] = 'links'</th><td>Sınıf eklenecek diğer sayfa numaraları.</td></tr>
            <tr><th>$class['next'] = 'next'</th><td>Sınıf eklenecek bir sonraki sayfa butonu.</td></tr>
            <tr><th>$class['prev'] = 'prev'</th><td>Sınıf eklenecek bir önceki sayfa butonu.</td></tr>
            <tr><th>$class['last'] = 'last'</th><td>Sınıf eklenecek son sayfa butonu.</td></tr>
            <tr><th>$class['first'] = 'first'</th><td>Sınıf eklenecek ilk sayfa butonu.</td></tr>
            
        </table>
    </p>
	<p>
 
    	<div type="code">
<pre>
<x><</x>?php
<kf>class</kf> PaginationUygulamasi
{
<ff>function</ff> index()
    {
        import::library(<sf>'Pagination'</sf>);
        
        <vf>$ayarlar</vf> = <kf>array</kf>(
         	<sf>'total_rows'</sf> => 20,
            <sf>'limit'</sf> => 5,
            <sf>'url'</sf> => <sf>'PaginationUygulamasi/index/'</sf>,
            <sf>'style'</sf> => <kf>array</kf>(<sf>'current'</sf> => <sf>'color:red'</sf>)
       	);
        
        <strong>pag::settings</strong>(<vf>$ayarlar</vf>);
     	<kf>echo</kf> pag::create();
        <comment>/* 
        <img src="../Images/Result/pagination1.PNG" />
        */</comment>
    }
}
</pre>
    	</div>
    </p>

    
    <p class="cstfont" id="pag_create">Sayfalamayı Oluşturmak</p>
    <p><ftype>pag::create( [ <kf>numeric</kf> <vf>$baslangic</vf> ] )</ftype></p>
    <p>Ayarları yapılan sayfalamayı oluşturmak için kullanılır. Tek parametresi vardır. Başlangıç.</p>
    
    <p>
    	<table class="cfont">
        	<tr><th>Parametre</th><td>Anlamları</td></tr>
            <tr><th>1. Parametre = [ Başlangıç ]</th><td>Kaçıncı indeksten sonra kayıtların gösterileceğini belirtir.</td></tr>
        </table>
    </p>
    
    
	<p>
 
    	<div type="code">
<pre>
<x><</x>?php
<kf>class</kf> PaginationUygulamasi
{
<ff>function</ff> index(<vf>$baslangic</vf> = 0)
    {
        import::library(<sf>'Pagination'</sf>);
        
        <vf>$ayarlar</vf> = <kf>array</kf>(
         	<sf>'total_rows'</sf> => 20,
            <sf>'limit'</sf> => 5,
            <sf>'url'</sf> => <sf>'PaginationUygulamasi/index/'</sf>,
            <sf>'style'</sf> => <kf>array</kf>(<sf>'current'</sf> => <sf>'color:red'</sf>)
       	);
        
        pag::settings(<vf>$ayarlar</vf>);
     	<kf>echo</kf> <strong>pag::create</strong>(<vf>$baslangic</vf>);
        <comment>/* 
        <img src="../Images/Result/pagination1.PNG" />
        */</comment>
    }
}
</pre>
    	</div>
    </p>

    <div type="note"><div>NOT</div><div>Başlangıç parametresi isteğe bağlıdır şayet kullanılmaz ise URL'nin son bölümünü otomatik olarak kullanmaktadır. Yani bu durumda URL'deki en son bölümün <b>sayfalama indeks numarası</b> olması gerekmektedir.</div></div>
    
    
    <div type="code">
<pre>
<vf>$ayarlar</vf> = <kf>array</kf>(
    <sf>'total_rows'</sf> => 20,
    <sf>'limit'</sf> => 5,
    <sf>'url'</sf> => <sf>'PaginationUygulamasi/index/'</sf>,
    <sf>'style'</sf> => <kf>array</kf>(
    	<sf>'current'</sf> => <sf>'color:red; font-size:20px;'</sf>, 
        <sf>'links'</sf> => <sf>'font-family:Tahoma; font-size:16px; color:black; text-decoration:none'</sf>
    ),
    <sf>'prev_name'</sf> => <sf>'Önceki'</sf>,
    <sf>'next_name'</sf> => <sf>'Sonraki'</sf>,
);

pag::settings(<vf>$ayarlar</vf>);
<kf>echo</kf> <strong>pag::create()</strong>; 
<comment>/* 
<img src="../Images/Result/pagination2.PNG" />
http://www.ornek.com/PaginationUygulamasi/index/<b class="strfont">10</b> Son segment sayfalama indeks numarası olan 10'dur.
[prev](5) 1(0) 2(5) <b class="strfont">3(10)</b> 4(15) [next](15)
*/</comment>
</pre>
    	</div>
        
       <div type="note"><div>NOT</div><div>Kayıt indeks numarası kaçıncı kayıttan itibaren listelemeye başlayacağını ifade eder. Yukarıdaki açıklama satırında bulunan <b>(x)</b> içerisinde yazılan sayılar kayıt indeks numarasıdır.</div></div> 
    
    <div type="prev-next">
    	<div type="prev-btn"><a href="lib_method.html">Önceki</a></div><div type="next-btn"><a href="lib_perm.html">Sonraki</a></div>
    </div>
 
</body>
</html>              