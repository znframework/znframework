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
    <div id="content-document"><a href="#">Döküman</a> » <a href="db_dynamic.html">Database(Veritabanı) Sınıfı Yöntemleri</a> » Statik Formda Veritabanı Kullanımı</div> 
    <p class="ctfont">Statik Formda Veritabanı Kullanımı</p>
    <p>Bu bölümde veritabanı sınıfının yöntemlerinin statik formda nasıl kullanıldığı ile ilgili anlatıma yer verdik. Tüm yöntemler dinamik formdaki ile aynıdır. Sadece kullanım statiktir.</p>
    <p>
        <ul content="list">
        <li><a href="#db_import">Statik Formda Database Kütüphanesini Dahil Etmek</a></li>
        <li><a href="#quick_start">Statik Formda Örnek Kullanımlar</a></li>
        </ul>
    </p>
    
    <p class="cstfont" id="db_import">Database Kütüphanesini Dahil Etmek</p>
    <div type="code">
  	import::library(<sf>'SDb'</sf>);<br>
    import::library(<sf>'SDbForge'</sf>);<br>
    import::library(<sf>'SDbTool'</sf>);<br>
    </div>
    <p><strong>Ya da</strong></p>
    <div type="code">
  	<vf>$this</vf>->import->library(<sf>'SDb'</sf>);<br>
    <vf>$this</vf>->import->library(<sf>'SDbForge'</sf>);<br>
    <vf>$this</vf>->import->library(<sf>'SDbTool'</sf>);
    </div>
   
   	<p class="cstfont" id="quick_start">Statik Formda Örnek Kullanımlar</p>
    <p>Bir önceki sayfalarda yöntemlerin nasıl kullanıldığı anlatıldığı için bu bölümde anlatımdan ziyade kullanıma örnekler verilmiştir.</p>
    <p>
    <div type="code"><pre>
sdb::get(<sf>'ornektablo'</sf>);
<vf>$sonuclar</vf> = sdb::result();
<kf>foreach</kf>(<vf>$sonuclar</vf> as <vf>$satir</vf>)
{
    <kf>echo</kf> <vf>$satir</vf>->id;
    <kf>echo</kf> <vf>$satir</vf>->isim;
}</pre></div>
    </p>
    
    <p>
    <div type="code"><pre>
sdb::where(<sf>'id = '</sf>, <if>1</if>);
sdb::get(<sf>'ornektablo'</sf>);
<vf>$satir</vf> = sdb::row();
<kf>echo</kf> <vf>$satir</vf>->id;</pre></div>
    </p>
    
    
    <p>
    <div type="code"><pre>
sdb::secure(<kf>array</kf>(<sf>':x:'</sf> => <if>1</if> , <sf>':y:'</sf> => <if>2</if> , ));
sdb::where(<sf>'id = '</sf>, <sf>':x:'</sf>, <sf>'or'</sf>);
sdb::where(<sf>'id = '</sf>, <sf>':y:'</sf>);
sdb::get(<sf>'ornektablo'</sf>);
<vf>$sonuclar</vf> = sdb::result_array();
<kf>foreach</kf>(<vf>$sonuclar</vf> as <vf>$satir</vf>)
{
    <kf>echo</kf> <vf>$satir</vf>[<sf>'id'</sf>];
    <kf>echo</kf> <vf>$satir</vf>[<sf>'isim'</sf>];
}</pre></div>
    </p>
    
    <p>
    <div type="code">
sdbforge::create_table(<sf>'ornektablo'</sf>, <kf>array</kf>(<sf>'id'</sf> => <sf>'varchar(11) not null'</sf>));</div
    </p>
    
     <p>
    <div type="code">
sdbforge::drop_table(<sf>'ornektablo'</sf>);</div
    </p>
    
    
    <p>
    <div type="code">
sdbtool::backup();</div
    </p>
    
    
    <div type="prev-next">
    	<div type="prev-btn"><a href="db_different_connect.html">Önceki</a></div><div type="next-btn"><a href="db_libraries.html">Sonraki</a></div>
    </div>
 
</body>
</html>              