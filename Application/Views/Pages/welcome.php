<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $title; // Controllers/home.php sayfasından gönderilen başlık bilgisi ?></title>
<?php echo $style; // Çağrılan Stil Dosyasının Yolu: Views/Styles/style.css ?>
<?php echo $font; // Çağrılan Font Dosyasının Yolu: Views/Fonts/textfont.ttf ?>
</head>

<body>
    <div id="header">
    	<div class="font white-color">ZNTR.NET</div>
    </div>
    <div id="title" class="border font"><?php echo $welcome_message; // Controllers/home.php sayfasından gönderilen mesaj bilgisi ?></div>
    <div id="content" class="font black-color">
    	<p>Merhaba, ZN kod çatısı açılış sayfasına hoş geldiniz. Bu sayfa bilgi amaçlı oluşturulmuştur.</p>
        <p>Bu sayfanın kontrolü, <strong>Controllers/</strong> dizininde yer alan <strong>home.php</strong> sayfası tarafından yapılmaktadır.</p>
        <p>Açılış sayfası varsayılan olarak <strong>Views/pages</strong> dizininde yer alan <strong>welcome.php</strong> sayfasıdır. Açılış sayfasının belirlenmesi, <b class="red-color">Config/Route.php</b> dosyasında yer alan <strong>open_page</strong> ayarı ile yapılmaktadır.</p>
        <p>Daha iyi kullanım için <a target="_blank" href="<?php echo base_url("Documentation/index.html")?>" class="bold">kullanma kılavuzundan</a> yararlanabilirsiniz</p>
    </div>
    <div id="footer">
    	<div class="font white-color">(c) copyright 2015 - Tüm hakları saklıdır. www.zntr.net </div>
    </div>
    <div id="logo"><img width="500" height="417" src="<?php echo base_url(FILES_DIR.'znlogo.png');?>" /></div>
</body>

</html>
