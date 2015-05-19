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
    <div id="content-document"><a href="#">Döküman</a> » <a href="general_topic.html">Genel Konular</a> » Model Kullanımı</div> 
    <p class="ctfont">Model Kullanımı</p>
 	<p><b>Models/</b> dizini, içerisinde oluşturulacak olan <strong>model</strong> dosyaları kullanımının temel mantığı veritabanı sorgularının bir kez yazılıp tekrar tekrar kullanılmasını sağlamaya dayanır. Sadece sorgular mı yazılır? Hayır istenirse harici olarak dahil edilmesi düşünülen farklı kodlarda yazılabilir.</p>
    
    <p class="cstfont">Model Dosyası Oluşturmak</p>
    <p>Aşağıdaki gibi örnek bir model dosyası oluşturabilirsiniz.</p>
    
    <div type="code">
<pre><x><</x>?php
<kf>class</kf> OrnekModel <kf>extends</kf> Model <comment> // <<<<<<<<<<<<< </comment>
{
    <kf>public</kf> <ff>function</ff> __construct()
    {
         <kf>parent</kf>::__construct();

         <vf>$this</vf>->import->library(<sf>'Db'</sf>);
    }

    <kf>public</kf> <ff>function</ff> get()
    {
         <kf>return</kf> <vf>$this</vf>->db->get(<sf>'OrnekTablo'</sf>)->result();
    }
}</pre>   
    </div>
    
    <p>Yukarıdaki kullanım sadece örnek amaçlıdır.</p>
    
    <p class="cstfont">Model Dosyasını Dahil Etmek</p>
    
    <p>Oluşturulan Model dosyalarının <strong>Controller</strong> içerisinde kullanmak için dahil edilmesi gerekir. Model dosyalarını dahil etmek için aşağıdaki gibi bir kullanım söz konusudur.</p>
    
    <p><div type="code">import::model(<sf>'OrnekModel'</sf>);</div></p>
    
    <p>Ya da</p>
    
    <p><div type="code"><vf>$this</vf>->import->model(<sf>'OrnekModel'</sf>);</div></p>
    
    <p class="cstfont">Model Dosyasını Kullanmak</p>
    
    <p>Model dosyası dahil edildikten aşağıdaki gibi kullanılabilir.</p>
    
     <p><div type="code"><vf>$this</vf>->ornekmodel->get();</div></p>
    
    <div type="prev-next">
    	<div type="prev-btn"><a href="pages.html">Önceki</a></div><div type="next-btn"><a href="reserved_functions.html">Sonraki</a></div>
    </div>
 	
 
</body>
</html>              