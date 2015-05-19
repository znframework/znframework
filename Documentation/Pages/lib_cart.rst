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
    <div id="content-document"><a href="#">Döküman</a> » <a href="libraries.html">Kütüphaneler</a> » Cart Sınıfı</div> 
    <p class="ctfont">Cart(Sepete Ekle) Sınıfı</p>
    <p>E-ticaret siteleri için düşünülmüş sepete ekle, sepetten çıkar gibi bir dizi fonksiyonu barındıran sınıftır.</p>
    <ul><li><a href="#" class="infont">Cart(Sepete Ekle) Sınıfı ve Yöntemleri</a><br><br>
        <ul>
        	<li><a href="#cart_import">Cart Kütüphanesini Dahil Etmek</a></li>
            <li><a href="#cart_insert">Sepete Eklemek » <b>cart::insert_item()</b></a></li>
            <li><a href="#cart_select">Sepeteki Ürünü Seçmek » <b>cart::select_item()</b></a></li>
            <li><a href="#cart_items">Sepetteki Verileri Öğrenmek » <b>cart::select_items()</b></a></li>
            <li><a href="#cart_total_items">Sepetteki Ürünlerin Toplam Fiyatını Öğrenmek » <b>cart::total_prices()</b></a></li>        
            <li><a href="#cart_total_items">Sepetteki Toplam Ürünü Öğrenmek » <b>cart::total_items()</b></a></li>
            <li><a href="#cart_update">Sepetteki Verileri Güncellemek » <b>cart::update_item()</b></a></li>
            <li><a href="#cart_delete">Sepetteki Veriyi Silmek » <b>cart::delete_item()</b></a></li>
            <li><a href="#cart_delete">Sepetteki Tüm Veriyi Silmek » <b>cart::delete_items()</b></a></li>
            <li><a href="#cart_money_format">Para Biçimine Çevirmek » <b>cart::money_format()</b></a></li>
            <li><a href="#cart_error">Sepet Sınıfı Kullanımı Esnasında Hata Tespiti Yapmak » <b>cart::error()</b></a></li>
            
        </ul>
    </li></ul>
    
    <p class="cstfont" id="cart_import">Cart Kütüphanesini Dahil Etmek</p>
    <div type="code">
  	import::library(<sf>'Cart'</sf>);
    </div>
    
   	<p class="cstfont" id="cart_insert">Sepete Ekleme Yöntemi</p>
    <p><ftype>cart::insert_item( <kf>array</kf> <vf>$urun</vf> )</ftype></p>
    <p>Sepete ürün eklemek için kullanılan bir yöntemdir. Tek parametresi vardır. Ürün bilgilerini tutan dizi parametresi.</p>
    
    <p>
    	<table class="cfont">
        	<tr><th>No</th><th>Parametre</th><td>Anlamları</td></tr>
            <tr><th>1</th><th>array Urun Bilgileri</th><td>Ürün bilgilerini tutacak bir dizi bilgisidir.</td></tr>
            <tr><th colspan="3">Parametede Olması Gereken Anahtar İfadeler</th></tr>
            <tr><th>1</th><th>quantity</th><td>Ürünün adet bilgisi. Ürünün adeti 1 ise kullanmaya gerek yoktur.</td></tr>
            <tr><th>2</th><th>price</th><td>Ürünün fiyat bilgisi.</td></tr>
        </table>
    </p>
    
    <div type="code">
    <pre><x><</x>?php
<kf>class</kf> SepeteEkle
{
	<kf>public</kf> <ff>function</ff> index()
        {
            import::library(<sf>'Cart'</sf>); <comment>// Önce Cart sınıf dahil edilir. </comment>
            
            <vf>$urun</vf> = <kf>array</kf>(
            	<sf>"name"</sf> => <sf>"Elma"</sf>,
                <sf>"quantity"</sf> => 2, 	<comment>// Ürün Adeti bildirmek için quantity anahtar ifadesi kullanılmak zorudadır.</comment>
                <sf>"price"</sf> => 20 		<comment>// Ürün Fiyatını bildirmek için price anahtar ifadesi kullanılmak zorundadır.</comment>
            );
            
            <strong>cart::insert_item</strong>(<vf>$urun</vf>); <comment>// Kod çalıştırıldığınında sepete bir ürün eklenmiş oldu.</comment>
        }
}</pre>
    </div>
    <p></p>
    <div type="important"><div>ÖNEMLİ</div><div>Ürün adeti için:<b>quantity</b>, Ürün fiyatı için:<b>price</b> kullanılmak zorundadır çünkü toplam fiyat ve toplam adet hesaplanırken bu anahtar ifadeler kullanılmaktadır.</div></div>
    
    <p class="cstfont" id="cart_items">Sepetteki Ürünleri Öğrenme Yöntemi</p>
    <p><ftype>cart::select_items()</ftype></p>
    <p>Sepetteki ürünlerin listelenmesini sağlayan yöntemdir. Kullanımına yönelik kod aşağıda verilmiştir.</p>
    
     <div type="code">
    <pre><x><</x>?php
<kf>class</kf> SepeteEkle
{
	<kf>public</kf> <ff>function</ff> index()
        {
            import::library(<sf>'Cart'</sf>); <comment>// Önce Cart sınıf dahil edilir. </comment>
            
            <vf>$urun</vf> = <kf>array</kf>(
            	<sf>"name"</sf> => <sf>"Elma"</sf>,
                <sf>"quantity"</sf> => 2, 	<comment>// Ürün Adeti bildirmek için quantity anahtar ifadesi kullanılmak zorudadır.</comment>
                <sf>"price"</sf> => 20 		<comment>// Ürün Fiyatını bildirmek için price anahtar ifadesi kullanılmak zorundadır.</comment>
            );
            
            <comment>// cart::insert_item($urun); Aynı ürünü tekrar eklememesi için bu kodu açıklama satırı içerisine aldık.</comment>
            
            <vf>$urunler</vf> = <strong>cart::select_items()</strong>;
            <ff>var_dump</ff>(<vf>$urunler</vf>); <comment>// Kodu çalıştırdığınızda eklenmiş olan ürünlerin listelendiğini görebilirsiniz.</comment>
        }
}</pre>
    </div>
    
    <p class="cstfont" id="cart_items">Sepetteki Ürünlerin Adetini ve Fiyatını Öğrenme Yöntemi</p>
    <p><ftype>cart::total_items(), cart::total_prices()</ftype></p>
    <p><cf>cart::total_items()</cf> Toplam ürün adetini verirken <cf>cart::total_prices()</cf> Ürünlerin toplam fiyatını verir. Aşağıda kullanımlarına örnek verilmiştir.</p>
    
     <div type="code">
    <pre><x><</x>?php
<kf>class</kf> SepeteEkle
{
	<kf>public</kf> <ff>function</ff> index()
        {
            import::library(<sf>'Cart'</sf>); <comment>// Önce Cart sınıf dahil edilir. </comment>
            
            <vf>$adet</vf> = <strong>cart::total_items()</strong>;
            <vf>$toplam_fiyat</vf> = <strong>cart::total_prices()</strong>;
            
            <kf>echo</kf> <sf>"Adet: "</sf>.<vf>$adet</vf>.<sf>" - Toplam Fiyat: "</sf>.<vf>$toplam_fiyat</vf>; <comment>// Çıkt: Adet: 2 - Toplam Fiyat: 40</comment>
        }
}</pre>
    </div>
    
    <p class="cstfont" id="cart_update">Sepetteki Ürünleri Güncelleme Yöntemi</p>
    <p><ftype>cart::update_item( <kf>string</kf> <vf>$anahtar</vf> , <kf>array</kf> <vf>$guncellenecek_veriler</vf> )</ftype></p>
    <p>Sepetteki ürün güncellemek istenirse <strong>ürünleri birbirinden ayıran eşsiz anahtar ifade</strong> kullanmalısınız. Bu eşsiz anahtar ifade; modeli veya ürün numarası olabilir. Aşağıda güncellemeye yönelik bir kullanım bulunmaktadır.</p>
    
    <p>
    	<table class="cfont">
        	<tr><th>No</th><th>Parametreler</th><td>Anlamları</td></tr>
            <tr><th>1</th><th>string Birincil Ürün Anahtarı</th><td>Ürünün ayırıcı bilgisidir. Özellikle ürün silme veya güncelleme işlemlerinde bir ürünü diğerinden ayırması açısından bu bilginin eşsiz seçilmesi önemli. Model, id, ürün no, seri no...</td></tr>
            <tr><th>2</th><th>array Güncellenecek Ürün Bilgileri</th><td>Ürün bilgilerini tutan dizi.</td></tr>
        </table>
    </p>
    
    <div type="code">
    <pre><x><</x>?php
<kf>class</kf> SepeteEkle
{
	<kf>public</kf> <ff>function</ff> index()
        {
            import::library(<sf>'Cart'</sf>); <comment>// Önce Cart sınıf dahil edilir. </comment>
            
            <vf>$urun</vf> = <kf>array</kf>(
            	<sf>"name"</sf> => <sf>"Elma"</sf>,
                <sf>"quantity"</sf> => 2, 	<comment>// Ürün Adeti bildirmek için quantity anahtar ifadesi kullanılmak zorudadır.</comment>
                <sf>"price"</sf> => 20 		<comment>// Ürün Fiyatını bildirmek için price anahtar ifadesi kullanılmak zorundadır.</comment>
            );
            
            <comment>// cart::insert_item($urun); Aynı ürünü tekrar eklememesi için bu kodu açıklama satırı içerisine aldık.</comment>
            
            <strong>cart::update_item</strong>(<sf>'Elma'</sf>, <kf>array(<sf>'quantity'</sf> => 5, <sf>'price'</sf> => 10)</kf>); <comment>// Elma isimli ürünün yeni adeti 5 her adetinin yeni fiyatı ise 10 olarak ayarlandı.</comment>
            
            <vf>$urunler</vf> = cart::select_items();
            <ff>var_dump</ff>(<vf>$urunler</vf>); <comment>// Kodu çalıştırdığınızda değişiklikleri görebilirsiniz.</comment>
        }
}</pre>
    </div>
    <p></p>
    <div type="note"><div>NOT</div><div>Eşsiz anahtar seçilmez ve birden fazla ürün için geçerli anahtar kullanılırsa o ürünlerin hepsinde güncelleme işlemi yapılır. Bu yüzden eşsiz anahtar seçerken dikkat edin.</div></div>
    
    <p class="cstfont" id="cart_delete">Sepeti Silme Yöntemi </p>
    <p><ftype>cart::delete_item() , cart::delete_items()</ftype></p>
    <p>Bu yöntemler, sepetten ürün silmek için kullanılır. <cf>cart::delete_item()</cf> belli bir ürünü silmek için kullanılırken <cf>cart::delete_items()</cf> sepetteki tüm ürünleri silmek için kullanılır. Silme işlemi yapılırken dikkat etmeniz gereken nokta ayıcı bilgisidir. Eğer birden fazla ürün için geçerli eşsiz bilgi kullanırsanız aynı eşsiz bilgiyi barındıran ürünlerin hepsi silinecektir. Önerilen ayırıcılar id, seri no veya ürün numarasıdır.</p>
    
     <p>
    	<table class="cfont">
        	<tr><th>No</th><th>Parametreler</th><td>Anlamları</td></tr>
            <tr><th>1</th><th>string Birincil Ürün Anahtarı</th><td>Ürünün ayırıcı bilgisidir. Silmek istediğiniz ürünün herhangi bir özelliğinden yayarlanılarak silme işlemi gerçekleştirilebilir. Ancak bu bilgi ayırıcı bilgi olursa tek bir ürünün silmesini sağlamış olursunuz.</td></tr>
  
        </table>
    </p>
    
    <div type="code">
    <pre><x><</x>?php
<kf>class</kf> SepeteEkle
{
	<kf>public</kf> <ff>function</ff> index()
        {
            import::library(<sf>'Cart'</sf>); <comment>// Önce Cart sınıf dahil edilir. </comment>
            
            <vf>$urun</vf> = <kf>array</kf>(
            	<sf>"name"</sf> => <sf>"Elma"</sf>,
                <sf>"quantity"</sf> => 2, 	<comment>// Ürün Adeti bildirmek için quantity anahtar ifadesi kullanılmak zorudadır.</comment>
                <sf>"price"</sf> => 20 		<comment>// Ürün Fiyatını bildirmek için price anahtar ifadesi kullanılmak zorundadır.</comment>
            );
            
            <comment>// cart::insert_item($urun); Aynı ürünü tekrar eklememesi için bu kodu açıklama satırı içerisine aldık.</comment>
            
            <strong>cart::delete_item</strong>(<sf>'Elma'</sf>); <comment>// Spetteki Elma isimli ürünü sildik.</comment>
            
            <strong>cart::delete_items()</strong>; <comment>// Sepetteki tüm ürünleri sildik.</comment>
            
        }
}</pre>
    </div>
    
    <p class="cstfont" id="cart_money_format">Para Biçimine Çevirme </p>
    <p><ftype>cart::money_format( <kf>numeric</kf> <vf>$fiyat</vf> , <kf>string</kf> <vf>$para_tipi</vf> )</ftype></p>
    <p>Ürünlerin fiyatlarını para biçimine çevirmek için kullanılır. İki parametre kullanır;</p>
    
    <p>
    	<table class="cfont">
        	<tr><th>No</th><th>Parametreler</th><td>Anlamları</td></tr>
            <tr><th>1</th><th>numeric Fiyat veya Miktar</th><td>Fiyat ya da miktar bilgisi.</td></tr>
            <tr><th>2</th><th>[string Birim]</th><td>Para biçimine çevrilen verinin sonuna birim eklemek isterseniz isteğe bağlı olarak kullanabilirsiniz.</td></tr>
        </table>
    </p>
    
      <div type="code">
    <pre><x><</x>?php
<kf>class</kf> SepeteEkle
{
	<kf>public</kf> <ff>function</ff> index()
        {
            import::library(<sf>'Cart'</sf>); <comment>// Önce Cart sınıf dahil edilir. </comment>
      
            <kf>echo</kf> <strong>cart::money_format</strong>(<sf>'1200'</sf>, <sf>'TL'</sf>); <comment>// Çıktı: 1.200,00 TL .</comment>
            <kf>echo</kf> <strong>cart::money_format</strong>(<sf>'1000'</sf>, <sf>'£'</sf>); <comment>// Çıktı: 1.000,00 £ .</comment>
        }
}</pre>
    </div>
    
    <p class="cstfont" id="cart_error">Sepet Sınıfı Kullanımı Esnasında Hata Tespiti Yapmak</p>
    <p><ftype>cart::error()</ftype></p></ftype></p>
    <p>Sepet sınıfı kullanımı esnasında oluşan hataları tespit etmek için kullanılır. Hata oluşmussa <strong>hata bilgisi</strong>, oluşmamışsa <kf>false</kf> değeri döner.</p>
    
    <div type="code">
    <pre>
<kf>echo</kf> cart::error(); <comment>// Hata var ise hata değeri döndürecektir. </comment>
	</pre>
    </div>
    
    <div type="prev-next">
    	<div type="prev-btn"><a href="lib_bench.html">Önceki</a></div><div type="next-btn"><a href="lib_cookie.html">Sonraki</a></div>
    </div>
 
</body>
</html>              