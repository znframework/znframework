<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>ZN FRAMEWORK PHP TABANLI KOD ÇATISI</title>
<link rel="shortcut icon" href="Images/Logo/logo.png" />
<link type="text/css" rel="stylesheet" href="Styles/Structure.css" />
<script src="Scripts/Jquery.js"></script>
<script src="Scripts/Structure.js"></script>
</head>

<body>

<div id="header">
	<div header="logo"><a target="pages" href="Pages/home.html"><img src="Images/Logo/logo.png" /></a></div>
	<div header="title" class="title-font white-font-color">ZN FRAMEWORK</div>
</div>
<div id="center">
	<div id="left" class="site-bg-color">
    	<div id="search">
        	<div search="logo" class="title-font white-font-color"><div type="logo-img"><a target="pages" href="Pages/home.html"><img src="Images/Icons/home.png" /></a> </div><div  type="logo-text">ZN Kod Çatısı</div></div>
        	<div search="text">
            <form id="search-form" target="pages" action="Pages/search.html" method="get">
            	<input type="text" name="search-text" id="search-text" value="Döküman ara..." />
            </form>
            </div>
        </div>
        
        <div id="menu">
        	<ul id="home-menu" class="menu-font">
            	<li><a target="pages" href="Pages/welcome.html">ZN'ye Hoş Geldiniz</a></li>
                <li><a target="pages" href="Pages/download.html">Kurulum Talimatları</a>
                	<ul id="sub-menu">
                    	<li><a target="pages" href="Pages/download.html">ZN İndir</a></li>
                        <li><a target="pages" href="Pages/installation.html">Kurulum Talimatları</a></li>
                        <li><a target="pages" href="Pages/directory_structure.html">Dizin ve Dosya Yapısı</a></li>
                        <li><a target="pages" href="Pages/troubleshooting.html">Sorun Giderme</a></li>
                   
                    </ul>
                </li>
                <li><a target="pages" href="Pages/overview.html">Genel Bakış</a>
                    <ul id="sub-menu">
                    	<li><a target="pages" href="Pages/concepts.html">Bazı Kavramların Anlamları</a></li>
                        <li><a target="pages" href="Pages/operation_logic.html">Çalışma Mantığını Anlamak</a></li>
                        <li><a target="pages" href="Pages/import_page.html">Sayfa Çağırma</a></li>
                        <li><a target="pages" href="Pages/basic_app.html">Basit Bir Uygulama Yapmak</a></li>
                        <li><a target="pages" href="Pages/url_edit.html">URL Düzenleme</a></li>
                        <li><a target="pages" href="Pages/import_library.html">Sınıfların Dahil Edilmesi</a></li>
                        <li><a target="pages" href="Pages/import_helper.html">Araçların Dahil Edilmesi</a></li>
                        <li><a target="pages" href="Pages/autoload.html">Otomatik Dahil Etme</a></li>
                   	</ul>
                </li>
                <li><a target="pages" href="Pages/general_topic.html">Genel Konular</a>
                    <ul id="sub-menu">
                        <li><a target="pages" href="Pages/zn_url.html">ZN URL Yapıları</a></li>
                        <li><a target="pages" href="Pages/management.html">Controllers Sayfa Kontrolü</a></li>
                        <li><a target="pages" href="Pages/pages.html">Views Sayfa Tasarımı</a></li>
                        <li><a target="pages" href="Pages/model.html">Model Kullanımı</a></li>
                        <li><a target="pages" href="Pages/reserved_functions.html">Tanımlı Sabitler ve Fonksiyonlar</a></li>
                        <li><a target="pages" href="Pages/core_libraries.html">Çekirdek Sınıflar Import ve Config</a></li>
                        <li><a target="pages" href="Pages/create_library.html">Kütüphane ve Araç Oluşturma</a></li>
                        <li><a target="pages" href="Pages/lang.html">Dil(Lang) Metodu</a></li>                        
                    </ul>
                </li>  
                
                <li><a target="pages" href="Pages/access_methods.html">Nesne Erişim Yöntemleri</a>
                    <ul id="sub-menu">
                        <li><a target="pages" href="Pages/access_dynamic.html">Dinamik Erişim($this->class->func())</a></li>
                        <li><a target="pages" href="Pages/access_static.html">Statik Erişim(class::func())</a></li> 
                        <li><a target="pages" href="Pages/access_znuse.html">Değişkensel Erişim(zn::$use->class->func())</a></li>
                        <li><a target="pages" href="Pages/access_this.html">Yöntemsel Erişim(this()->class->func())</a></li>          
                    </ul>
                </li>  
                       
                <li><a target="pages" href="Pages/functions.html">Ön Tanımlı Fonksiyonlar</a>
                    <ul id="sub-menu">
                        <li><a target="pages" href="Pages/user_functions.html">Kullanılabilir Fonksiyonlar</a></li>
                        <li><a target="pages" href="Pages/system_functions.html">Sistem İçin Gerekli Fonksiyonlar</a></li>                
                    </ul>
                </li>
                
                 <li><a target="pages" href="Pages/import.html">Masterpage(Anasayfa) Kullanımı</a>
                    <ul id="sub-menu">
                        <li><a target="pages" href="Pages/import_functions.html">Dahil Etme Yöntemleri</a></li>
                        <li><a target="pages" href="Pages/import_masterpage.html">Masterpage Kullanımı</a></li>                
                    </ul>
                </li>
                
                
                <li><a target="pages" href="Pages/db_dynamic.html">Database(Veritabanı) Kullanımı</a>
                    <ul id="sub-menu">
                        <li><a target="pages" href="Pages/db_config.html">Database Ayarlarını Yapılandırma</a></li>
                        <li><a target="pages" href="Pages/db_db.html">Db Sınıfı</a></li>
                        <li><a target="pages" href="Pages/db_trans.html">Transaction Sorgu Oluşturmak</a></li> 
                        <li><a target="pages" href="Pages/db_forge.html">DbForge Sınıfı</a></li>  
                        <li><a target="pages" href="Pages/db_tool.html">DbTool Sınıfı</a></li>
                        <li><a target="pages" href="Pages/db_different_connect.html">Farklı Bağlantı Oluşturmak</a></li>
                        <li><a target="pages" href="Pages/db_static.html">Statik Formda Veritabanı Kullanımı</a></li>         
                    </ul>
                </li>
                
                <li><a target="pages" href="Pages/libraries.html">Kütüphaneler(Libraries)</a>
                    <ul id="sub-menu">
                        <li><a target="pages" href="Pages/lib_ajax.html">Ajax Sınıfı</a></li>
                        <li><a target="pages" href="Pages/lib_bench.html">Benchmark Sınıfı</a></li>
                        <li><a target="pages" href="Pages/lib_cart.html">Cart Sınıfı</a></li>                
                        <li><a target="pages" href="Pages/lib_cookie.html">Cookie Sınıfı</a></li>
                        <li><a target="pages" href="Pages/lib_css3.html">Css3 Sınıfı</a></li>
                        <li><a target="pages" href="Pages/lib_curl.html">Curl Sınıfı</a></li>
                        <li><a target="pages" href="Pages/lib_download.html">Download Sınıfı</a></li>
                        <li><a target="pages" href="Pages/lib_email.html">Email Sınıfı</a></li>
                        <li><a target="pages" href="Pages/lib_encode.html">Encode Sınıfı</a></li>
                        <li><a target="pages" href="Pages/lib_file.html">File Sınıfı</a></li>
                        <li><a target="pages" href="Pages/lib_folder.html">Folder Sınıfı</a></li>
                        <li><a target="pages" href="Pages/lib_form.html">Form Sınıfı</a></li>
                        <li><a target="pages" href="Pages/lib_ftp.html">FTP Sınıfı</a></li>
                        <li><a target="pages" href="Pages/lib_html5.html">Html5 Sınıfı</a></li>
                        <li><a target="pages" href="Pages/lib_image.html">Image Sınıfı</a></li>
                        <li><a target="pages" href="Pages/lib_jquery.html">Jquery Sınıfı</a></li>
                        <li><a target="pages" href="Pages/lib_json.html">Json Sınıfı</a></li>
                        <li><a target="pages" href="Pages/lib_method.html">Method Sınıfı</a></li>
                        <li><a target="pages" href="Pages/lib_pagination.html">Pagination Sınıfı</a></li>
                        <li><a target="pages" href="Pages/lib_perm.html">Permission Sınıfı</a></li>
                        <li><a target="pages" href="Pages/lib_reg.html">Regex Sınıfı</a></li>
                        <li><a target="pages" href="Pages/lib_search.html">Search Sınıfı</a></li>
                        <li><a target="pages" href="Pages/lib_sec.html">Security Sınıfı</a></li>
                        <li><a target="pages" href="Pages/lib_sess.html">Session Sınıfı</a></li>
                        <li><a target="pages" href="Pages/lib_upload.html">Upload Sınıfı</a></li>
                        <li><a target="pages" href="Pages/lib_uri.html">Uri Sınıfı</a></li>
                        <li><a target="pages" href="Pages/lib_user.html">User Sınıfı</a></li>
                        <li><a target="pages" href="Pages/lib_val.html">Validation Sınıfı</a></li>
                        <li><a target="pages" href="Pages/lib_xml.html">Xml Sınıfı</a></li>
                    </ul>
                </li>
             
                <li><a target="pages" href="Pages/tools.html">Araçlar(Tools)</a>
                <ul id="sub-menu">
                        <li><a target="pages" href="Pages/tool_ajax.html">Ajax Aracı</a></li>
                        <li><a target="pages" href="Pages/tool_array.html">Array Aracı</a></li>
                        <li><a target="pages" href="Pages/tool_builder.html">Builder Aracı</a></li>
                        <li><a target="pages" href="Pages/tool_captcha.html">Captcha Aracı</a></li>
                        <li><a target="pages" href="Pages/tool_cleaner.html">Cleaner Aracı</a></li>
                        <li><a target="pages" href="Pages/tool_converter.html">Converter Aracı</a></li>
                        <li><a target="pages" href="Pages/tool_creator.html">Creator Aracı</a></li>
                        <li><a target="pages" href="Pages/tool_datetime.html">DateTime Aracı</a></li>
                        <li><a target="pages" href="Pages/tool_email.html">Email Aracı</a></li>
                        <li><a target="pages" href="Pages/tool_encoder.html">Encoder Aracı</a></li>
                        <li><a target="pages" href="Pages/tool_filter.html">Filter Aracı</a></li>
                        <li><a target="pages" href="Pages/tool_formatter.html">Formatter Aracı</a></li>
                        <li><a target="pages" href="Pages/tool_html.html">Html Aracı</a></li>
                        <li><a target="pages" href="Pages/tool_limiter.html">Limiter Aracı</a></li>
                        <li><a target="pages" href="Pages/tool_parser.html">Parser Aracı</a></li>
                        <li><a target="pages" href="Pages/tool_reader.html">Reader Aracı</a></li>
                        <li><a target="pages" href="Pages/tool_repeater.html">Repeater Aracı</a></li>
                        <li><a target="pages" href="Pages/tool_rounder.html">Rounder Aracı</a></li>
                        <li><a target="pages" href="Pages/tool_searcher.html">Searcher Aracı</a></li>
                        <li><a target="pages" href="Pages/tool_sound.html">Sound Aracı</a></li>
                        <li><a target="pages" href="Pages/tool_string.html">String Aracı</a></li>
                        <li><a target="pages" href="Pages/tool_symbol.html">Symbol Aracı</a></li>
                        <li><a target="pages" href="Pages/tool_uploader.html">Uploader Aracı</a></li>
                    </ul>
                </li>
                
                 <li><a target="pages" href="Pages/components.html">Bileşenler(Components)</a>
                    <ul id="sub-menu">
                        <li><a target="pages" href="Pages/component_cookie.html">Cookie(Çerez) Bileşeni</a></li>
                        <li><a target="pages" href="Pages/component_css.html">Css Bileşeni</a></li>  
                        <li><a target="pages" href="Pages/component_form.html">Form Bileşeni</a></li> 
                        <li><a target="pages" href="Pages/component_jquery.html">Jquery Bileşeni</a></li> 
                        <li><a target="pages" href="Pages/component_list.html">List(Liste) Bileşeni</a></li>
                        <li><a target="pages" href="Pages/component_pagination.html">Pagination(Sayfalama) Bileşeni</a></li> 
                        <li><a target="pages" href="Pages/component_session.html">Session(Oturum) Bileşeni</a></li>
                        <li><a target="pages" href="Pages/component_table.html">Table(Tablo) Bileşeni</a></li>
                        <li><a target="pages" href="Pages/component_template.html">Template(Şablon) Bileşeni</a></li>       
                    </ul>
                </li>
                
                <li><a target="pages" href="Pages/config.html">Ayarlar(Config)</a>
                <ul id="sub-menu">
                		<li><a target="pages" href="Pages/config_library.html">Config Sınıfı ve Kullanımı</a></li>
                        <li><a target="pages" href="Pages/config_autoload.html">Autoload Ayarları</a></li>
                        <li><a target="pages" href="Pages/config_cache.html">Cache Ayarları</a></li>
                        <li><a target="pages" href="Pages/config_captcha.html">Captcha Ayarları</a></li>
                        <li><a target="pages" href="Pages/config_cookie.html">Cookie Ayarları</a></li>
                        <li><a target="pages" href="Pages/config_curl.html">Curl Ayarları</a></li>
                        <li><a target="pages" href="Pages/config_database.html">Database Ayarları</a></li>
                        <li><a target="pages" href="Pages/config_datetime.html">DateTime Ayarları</a></li>
                        <li><a target="pages" href="Pages/config_doctype.html">Doctype Ayarları</a></li>      
                        <li><a target="pages" href="Pages/config_email.html">Email Ayarları</a></li>
                        <li><a target="pages" href="Pages/config_encode.html">Encode Ayarları</a></li>
                        <li><a target="pages" href="Pages/config_foreignchars.html">ForeignChars Ayarları</a></li>
                        <li><a target="pages" href="Pages/config_headers.html">Headers Ayarları</a></li>
                        <li><a target="pages" href="Pages/config_htaccess.html">Htaccess Ayarları</a></li>
                        <li><a target="pages" href="Pages/config_ini.html">Ini Ayarları</a></li>
                        <li><a target="pages" href="Pages/config_language.html">Language Ayarları</a></li>
                        <li><a target="pages" href="Pages/config_libraries.html">Libraries Ayarları</a></li>
                        <li><a target="pages" href="Pages/config_log.html">Log Ayarları</a></li>
                        <li><a target="pages" href="Pages/config_masterpage.html">Masterpage Ayarları</a></li>
                        <li><a target="pages" href="Pages/config_permission.html">Permission Ayarları</a></li>
                        <li><a target="pages" href="Pages/config_regex.html">Regex Ayarları</a></li>
                        <li><a target="pages" href="Pages/config_repair.html">Repair Ayarları</a></li>
                        <li><a target="pages" href="Pages/config_route.html">Route Ayarları</a></li>
                        <li><a target="pages" href="Pages/config_security.html">Security Ayarları</a></li>
                        <li><a target="pages" href="Pages/config_session.html">Session Ayarları</a></li>
                        <li><a target="pages" href="Pages/config_symbols.html">Symbols Ayarları</a></li>
                        <li><a target="pages" href="Pages/config_upload.html">Upload Ayarları</a></li>
                        <li><a target="pages" href="Pages/config_uri.html">Uri Ayarları</a></li>
                        <li><a target="pages" href="Pages/config_user.html">User Ayarları</a></li>
                    </ul>
                </li>
                <li><a target="pages" href="Pages/contribution.html">ZN Kod Çatısına Katkıda Bulunun</a></li>
            </ul>
        </div>
        
    </div>
    
    <div id="right">
    	<div id="content">
        	
            <iframe name="pages" width="100%" height="100%" marginheight="0" marginwidth="0" frameborder="0" src="Pages/home.html"></iframe>
        	
        </div>
        <div id="content-footer" class="menu-font"><span class="site-font-color">ZN Framework</span> <span class="black-font-color"> Versiyon 1.2 </span></div>
    </div>
	
</div>
<div class="clear"></div>
<div id="footer">
	<div class="footer-title-font">© copyright 2015 - Tüm hakları saklıdır. www.zntr.net</div>
</div>


</body>
</html>
