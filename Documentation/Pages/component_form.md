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
    <div id="content-document"><a href="#">Döküman</a> » <a href="components.html">Bileşenler</a> » Form Bileşeni</div> 
    <p class="ctfont">Form Bileşeni</p>
    <p>Form işlemlerini yapmak için oluşturulmuştur .</p>
    <ul><li><a href="#" class="infont">Form Bileşenini ve Yöntemleri</a><br><br>
        <ul>
        	<li><a href="#form_import">Form Bileşenini Dahil Etmek</b></a></li>
            <li><a href="#form_css">Form Bileşeni Yöntemleri</b></a></li> 
        </ul>
    </li></ul>
    
    <p class="cstfont" id="form_import">Form Bileşenini Dahil Etmek</p>
	<div type="code">import::component(<sf>'Form'</sf>)</div> 	
    
    <p class="cstfont" id="form_css">Form Bileşeni Yöntemleri</p>
    <p>Form bileşenine ait yöntemler aşağıdaki tabloda listelenmiştir</p>
    
  	<p>
    <table class="cfont">
    	<tr><th>Form Bileşeni ve Yöntemleri</th><td>Anlamları</td><td>Kullanımları</td></tr>
        <tr><td><cf>name( <vf>$isim</vf> )</cf></td><td>name="" özelliğinin karşılığıdır.</td><td><cf><vf>$this</vf>->form->name(<sf>'isim'</sf>)</cf></td></tr>
        <tr><td><cf>value( <vf>$deger</vf> )</cf></td><td>value="" özelliğinin karşılığıdır.</td><td><cf>->value(<sf>'Değer'</sf>)</cf></td></tr>
        <tr><td><cf>text <vf>$text</vf> )</cf></td><td>value() yönteminin alternatifidir.</td><td><cf>->text(<sf>'İçerik'</sf>)</cf></td></tr>
        <tr><td><cf>type( <vf>$tip</vf> )</cf></td><td>type="" özelliğinin karşılığıdır.</td><td><cf>->type(<sf>'textarea'</sf>)</cf></td></tr>
        <tr><td><cf>id( <vf>$id</vf> )</cf></td><td>id="" özelliğinin karşılığıdır.</td><td><cf>->id(<sf>'nesne'</sf>)</cf></td></tr>
        <tr><td><cf>options( <vf>$secenekler</vf>, <vf>secili_oge</vf> )</cf></td><td>select nesnesi için seçenek ekleme yöntemidir.</td><td><cf>->options(<kf>array</kf>(<sf>'anahtar'</sf> => <sf>'deger'</sf>, <sf>'anahtar'</sf>)</cf></td></tr>
        <tr><td><cf>attr( <vf>$ozellik_deger_dizisi</vf> )</cf></td><td>Eklenecek özellikler ve değerleri. Bu yöntem dizi parametresi içerir.</td><td><cf>->attr(<kf>array</kf>(<sf>'name'</sf> => <sf>'nesne'</sf>));</cf></td></tr>
        <tr><td><cf>style( <vf>$stil</vf> )</cf></td><td>Eklenecek stil özellikleri ve değerleri. Bu yöntem dizi parametresi içerir.</td><td><cf>->style(<kf>array</kf>(<sf>'border'</sf> => <sf>'solid 1px #000'</sf>));</cf></td></tr>
        <tr><td><cf>css( <vf>$class</vf> )</cf></td><td>class="" özelliğinin karşılığıdır.</td><td><cf>->css(<sf>'sinif1'</sf>, <sf>'sinif2'</sf>));</cf></td></tr>
        <tr><td><cf>match( <vf>$eslestirme</vf> )</cf></td><td>Form değerinin karşılaştırılacağı değer.</td><td><cf>->match(<sf>'Bilgiler Uyuşuyor Mu?'</sf>)</cf></td></tr>
        <tr><td><cf>limit( <vf>$min</vf> , <vf>$max</vf> )</cf></td><td>Form değerinin alabileceği maksimum ve minimum değerler belirtilir.</td><td><cf>->max(<if>4</if> , <if>16</if>)</cf></td></tr>
        <tr><td><cf>secure( <vf>$guvenlik_parametreleri</vf>)</cf></td><td>Parmetre olarak: xss, injection, nc ve html değerleri alır. Security sınıfının yöntemleri olan bu değerler veri güvenliğini sağlamak açısından oluşturulur.</td><td><cf>->secure(<sf>'nc'</sf> , <sf>'xss'</sf>)</cf></td></tr>
        <tr><td><cf>validate( <vf>$kontrol_parametreleri</vf>)</cf></td><td>Parmetre olarak: required, email, url, numeric, specialchar ve identity değerleri alır.</td><td><cf>->validate(<sf>'email'</sf> , <sf>'required'</sf>)</cf></td></tr>
        <tr><td><cf>create( [ <vf>$tip</vf> ] )</cf></td><td>Form nesne oluştumunu tamamlama yöntemidir. İsteğe bağlı olarak type() yöntemine gerek kalmadan parametresi kullanılarak oluşturulacak nesne belirlenebilir.</td><td><cf>->create(<sf>'text'</sf>);</cf></td></tr>
        <tr><td><cf>open( [ <vf>$isim</vf> ] )</cf></td><td>Form açmak için kullanılır. İsteğe bağlı form ismi belirlemek için bir parametre içerir</td><td><cf><vf>$this</vf>->form->open(<sf>'isim'</sf>);</cf></td></tr>
        <tr><td><cf>method( [ <vf>$yontem</vf> = <sf>'post'</sf> ] )</cf></td><td>Açılan formun metotunu belirlemek için kullanılır.</td><td><cf>->method(<sf>'get'</sf>);</cf></td></tr>
        <tr><td><cf>action( [ <vf>$etki_sayfasi</vf> ] )</cf></td><td>Formdan verilerinin hangi sayfaya gönderileceği.</td><td><cf>->action(<sf>'iletisim.php'</sf>);</cf></td></tr>
        <tr><td><cf>enctype( [ <vf>$veri_tipi</vf> ] )</cf></td><td>Formlarda kullanılan encytpe="" özelliğinin karşılığıdır. Alabileceği değerler: multipart, application ve text</td><td><cf>->enctype(<sf>'multipart'</sf>);</cf></td></tr>
        <tr><td><cf>close()</cf></td><td>Form kapatmak için kullanılır.</td><td><cf><vf>$this</vf>->form->close();</cf></td></tr>
        <tr><td><cf>validate_error( [ <vf>$cikti_tipi</vf> = <sf>'array'</sf> ] )</cf></td><td>Form validasyon işlemlerinde herhangi bir uyumsuzluk olup olmadığı hakkında bize bilgi verir. Alabileceği değerler: array, echo ve nesne ismi.</td><td><cf><vf>$this</vf>->form->validate_error(<sf>'echo'</sf>);</cf></td></tr>
    </table>
    </p>
    
    <p>Yukarıdaki yöntemlerin kullanımına yönelik örnekler aşağıda verilmiştir.</p>
    
    <p>
    <div type="code">
    <vf>$this</vf>->form->name(<sf>'nesne'</sf>)->value(<sf>'Merhaba'</sf>)->create(<sf>'text'<sf>);
    </div>
    </p>
    
    <p>Formlarda validasyon işlemleri için <strong>validate()</strong> yöntemi kullanılır.</p>
    
    <p>
    <div type="code">
    <vf>$this</vf>->form->name(<sf>'nesne'</sf>)->value(<sf>'Merhaba'</sf>)-><strong>validate</strong>(<sf>'numeric'</sf>, <sf>'required'</sf>)->create(<sf>'text'</sf>);<br>
    <kf>echo</kf> <vf>$this</vf>->form->validate_error(<sf>'echo'</sf>);<br>
    <ff>var_dump</ff>(<vf>$this</vf>->form->validate_error(<sf>'array'</sf>));<br>
    <ff>var_dump</ff>(<vf>$this</vf>->form->validate_error(<sf>'nesne'</sf>));<br>
    </div>
    </p>
   	
    <p>Formlarda güvenlik işlemleri için <strong>secure()</strong> yöntemi kullanılır.</p>
   
   	<p>
    <div type="code">
    <vf>$this</vf>->form->name(<sf>'nesne'</sf>)->value(<sf>'Merhaba'</sf>)-><strong>secure</strong>(<sf>'xss'</sf>, <sf>'injection'</sf>)->create(<sf>'text'</sf>);<br>
    </div>
    </p>
	
    <p>Form açmak için;</p>
   
   	<p>
    <div type="code">
    <vf>$this</vf>->form->open(<sf>'form'</sf>)->method(<sf>'Get'</sf>)->open();<br>
    <comment>//form kodları</comment><br>
    <vf>$this</vf>->form->close();<br>
    </div>
    </p>
	
    <div type="prev-next">
    	<div type="prev-btn"><a href="component_css.html">Önceki</a></div><div type="next-btn"><a href="component_jquery.html">Sonraki</a></div>
    </div>
 
</body>
</html>              
