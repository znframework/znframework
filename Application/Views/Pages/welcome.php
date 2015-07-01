<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $title; // Controllers/home.php sayfasından gönderilen başlık bilgisi ?></title>
<?php echo $style; // Çağrılan Stil Dosyasının Yolu: Views/Styles/style.css ?>
<?php echo $font; // Çağrılan Font Dosyasının Yolu: Views/Fonts/textfont.ttf ?>
</head>

<body>
    <div id="logo" class="font">
    	<div id="logo-text" class="text-shadow"><?php echo $title; ?></div>
    	<div id="logo-sub-text"><?php echo $welcome_message; ?></div>
    </div>
</body>

</html>
