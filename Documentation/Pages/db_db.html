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
    <div id="content-document"><a href="#">Döküman</a> » <a href="db_dynamic.html">Database(Veritabanı) Sınıfı Yöntemleri</a> » Database Sınıfı ve Kullanımı</div> 
    <p class="ctfont">Database Sınıfı ve Kullanımı</p>
    <p>Bu bölümde veritabanı sınıfının yöntemlerinin nasıl kullanıldığı ile ilgili anlatıma yer verdik.</p>
    <p>
        <ul content="list">
        <li><a href="#db_import">Database Kütüphanesini Dahil Etmek</a></li>
        <li><a href="#quick_start">Hızlı Başlangıç ve Kullanım Örnekleri</a></li>
        <li><a href="#standart_query">Standart Sorgu Oluşturmak » <strong>$this->db->query()</strong></a></li>
        <li><a href="#exec_query">Tek Seferlik Çalıştırılabilir Sorgu Oluşturmak » <strong>$this->db->exec_query()</strong></a></li>
        <li><a href="#get">Veritabanından Veri Çekmek » <strong>$this->db->get()</strong></a></li>
        <li><a href="#result">Sorgu Sonucu Verilerini Kullanmak</a></li>
        <li><a href="#select_from">Select, From ve Where Deyimlerini Kullanmak</a></li>
        <li><a href="#insert">Veritabanına Veri Eklemek » <strong>$this->db->insert()</strong></a></li>
 		<li><a href="#update">Veritabanında Veri Güncellemek » <strong>$this->db->update()</strong></a></li>
        <li><a href="#delete">Veritabanından Veri Silmek » <strong>$this->db->delete()</strong></a></li>
        <li><a href="#secure">Veri Güvenliğini Sağlamak » <strong>$this->db->secure()</strong></a></li>
        <li><a href="#other">Diğer Veritabanı Yöntemleri</a></li>
        </ul>
    </p>
    
    <p class="cstfont" id="db_import">Database Kütüphanesini Dahil Etmek</p>
    <div type="code">
  	import::library(<sf>'Db'</sf>);
    </div>
    <p><strong>Ya da</strong></p>
    <div type="code">
  	<vf>$this</vf>->import->library(<sf>'Db'</sf>);
    </div>

    <p class="ctfont" id="quick_start">Hızlı Başlangıç ve Kullanım Örnekleri</p>
   
   	<p class="cstfont">Standart Sorgu Oluşturmak</p>
    <p>Klasik sql sorgularını kullanmak için kullanılan bir yöntemdir.</p>
    <div type="code">
  	<vf>$get</vf> = <vf>$this</vf>->db->query(<sf>'select * from ornektablo'</sf>);<br>
    
    <kf>echo</kf> <vf>$get</vf>->row()->id;<br>
    
    <kf>echo</kf> <sf>'Toplam Satır:'</sf>.<vf>$this</vf>->db->total_rows();
    
    </div>
    
    <p class="cstfont">ZN Özel Sorgu Oluşturmak</p>
    <p>Özel yapılı sorgular oluşturmak için aşağıdaki gibi kullanımlar mümkündür.</p>
    <p>
    <div type="code">
<pre><vf>$get</vf> = <vf>$this</vf>->db->get(<sf>'ornektablo'</sf>);

<kf>echo</kf> <vf>$get</vf>->row()->id;</pre>
    </div>
    </p>
    
     <p>
    <div type="code">
<pre><vf>$get</vf> = <vf>$this</vf>->db->where(<sf>'id = '</sf>, <if>2</if>)->get(<sf>'ornektablo'</sf>);
    
<kf>echo</kf> <vf>$get</vf>->row()->id;</pre>

</div>
    </p>
    
     <p>
    <div type="code">
<pre><vf>$get</vf> = <vf>$this</vf>->db->where(<sf>'id, isim'</sf>)->select(<sf>'id = '</sf>, <if>2</if>)->get(<sf>'ornektablo'</sf>);
    
<kf>foreach</kf>(<vf>$get</vf>->result() as <vf>$satir</vf>)
{
    <kf>echo</kf> <vf>$satir</vf>->id;
    <kf>echo</kf> <vf>$satir</vf>->isim;
}</pre>
    
    </div>
    </p>
    
    <p><strong>Sorgu sonucu verileri dizi olarak elde etmek</strong> içinde aşağıdaki gibi bir kullanım yeterlidir.</p>
      <p>
    <div type="code">
<pre><vf>$get</vf> = <vf>$this</vf>->db->where(<sf>'id, isim'</sf>)->select(<sf>'id = '</sf>, <if>2</if>)->get(<sf>'ornektablo'</sf>);
    
<kf>foreach</kf>(<vf>$get</vf>-><if>result_array()</if> as <vf>$satir</vf>)
{
    <kf>echo</kf> <vf>$satir</vf>[<sf>'id'</sf>]
    <kf>echo</kf> <vf>$satir</vf>[<sf>'isim'</sf>];
}</pre>
    
    </div>
    </p>
    
    <p class="cstfont">Veri Eklemek</p>
    <p>Veritabanına basit bir veri ekleme örneği.</p>
    <div type="code">
  	<vf>$this</vf>->db->insert(<sf>'ornektablo'</sf>, <kf>array</kf>(<sf>'id'</sf> => <if>2</if>, <sf>'isim'</sf> => <sf>'zntr'</sf>));
    </div>
    
    <p class="cstfont">Veri Güncellemek</p>
    <p>Veritabanına basit bir veri güncelleme örneği.</p>
    <div type="code">
  	<vf>$this</vf>->db->where(<sf>'id'</sf> => <if>1</if>)->update(<sf>'ornektablo'</sf>, <kf>array</kf>(<sf>'id'</sf> => <if>2</if>, <sf>'isim'</sf> => <sf>'zntr'</sf>));
    </div>
    
    <p class="ctfont">Database Sınıfı Yöntemleri</p>
    
    <p class="cstfont" id="standart_query">Standart Sorgu Oluşturmak</p>
    <p><ftype>$this->db->query( <kf>string</kf> <vf>$sorgu</vf> )</ftype></p>
    <p>Standart sorgu oluşturmak için <cf>query()</cf> yöntemi kullanılır.</p>
    <p>
        <table class="cfont">
            <tr><th colspan="2">query()</th></tr>
            <tr><th>Parametre</th><th>Kullanımı</th></tr>
            <tr><th>string Sorgu</th><td>Sorgu ifadesi</td></tr>
        </table>
    </p>
    <p>
    <div type="code">
  	<vf>$get</vf> = <vf>$this</vf>->db->query(<sf>'select * from ornektablo'</sf>);<br>
    
    <kf>echo</kf> <vf>$get</vf>->row()->id;<br>
    
    <kf>echo</kf> <sf>'Toplam Satır:'</sf>.<vf>$this</vf>->total_rows();
    
    </div>
  	</p>
    
     <p>
    <div type="code">
  	<vf>$this</vf>->db->query(<sf>'delete from ornektablo where id = 1'</sf>);<br>
    </div>
  	</p>
    
    <p class="cstfont" id="exec_query">Tek Seferlik Çalıştırılabilir Sorgu Oluşturmak</p>
    <p><ftype>$this->db->exec_query( <kf>string</kf> <vf>$sorgu</vf> )</ftype></p>
    <p>Basit bir sorgu oluşturmak için <cf>exec_query()</cf> yöntemi kullanılır. Genellik bu yöntem <strong>çıktı üretmeyen sorgular</strong> yazılacağı zaman kullanılır.</p>
    <p>
        <table class="cfont">
            <tr><th colspan="2">exec_query()</th></tr>
            <tr><th>Parametre</th><th>Kullanımı</th></tr>
            <tr><th>string Sorgu</th><td>Sorgu ifadesi</td></tr>
        </table>
    </p>
    <p>
    <div type="code">
  	<vf>$this</vf>->db->exec_query(<sf>'create table ornektablo'</sf>);<br>
    <vf>$this</vf>->db->exec_query(<sf>'drop table ornektablo'</sf>);<br>
    </div>
  	</p>
    
    <p class="cstfont" id="get">Veritabanından Veri Çekmek</p>
    <p><ftype>$this->db->get( [ <kf>string</kf> <vf>$tablo_adi</vf> ] )</ftype></p>
    <p>Veritabanından veri çekmek için kullanılır. Ayrıca oluşturulan özel yapılı sorguları sonlandırmak için kullanılır.</p>
    <p>
        <table class="cfont">
            <tr><th colspan="2">get()</th></tr>
            <tr><th>Parametre</th><th>Kullanımı</th></tr>
            <tr><th>[string Tablo Adı]</th><td>from() yöntemi ile tablo ismi belirtilmemişse bu parametre ile tablo ismi belirtilebilir.</td></tr>
        </table>
    </p>
    <p>
    <div type="code">
  	<vf>$get</vf> = <vf>$this</vf>->db->get(<sf>'ornektablo'</sf>);
    </div>
  	</p>
    
    <p class="cstfont" id="result">Sorgu Sonucu Verileri Kullanmak</p>
    <p><ftype>$get->result() , $get->result_array() , $get->row() , $get->columns() , $get->total_rows() , $get->total_columns() , $get->column_data()</ftype></p>
    <p>Veritabanından çekilen verileri <strong>object türünde</strong> kullanmak için <cf>result()</cf> yöntemi kullanılır.</p>
    <p>
    <div type="code">
  	<vf>$get</vf> = <vf>$this</vf>->db->get(<sf>'ornektablo'</sf>);<br><br>
    <ff>var_dump</ff>(<vf>$get</vf>->result());
    </div>
  	</p>
    
    <p>Verileri <strong>dizi türünde</strong> kullanmak için <cf>result_array()</cf> yöntemi kullanılır.</p>
    <p>
    <div type="code">
  	<vf>$get</vf> = <vf>$this</vf>->db->get(<sf>'ornektablo'</sf>);<br><br>
    <ff>var_dump</ff>(<vf>$get</vf>->result_array());
    </div>
  	</p>
    
    <p>Tek <strong>bir satır veriyi</strong> kullanmak için <cf>row()</cf> yöntemi kullanılır.</p>
    <p>
    <div type="code">
  	<vf>$get</vf> = <vf>$this</vf>->db->get(<sf>'ornektablo'</sf>);<br><br>
    <kf>echo</kf> <vf>$get</vf>->row()->id;
    </div>
  	</p>
    
    <p class="cstfont" id="select_from">Select, From ve Where Deyimlerini Kullanmak</p>
    <p><ftype>$this->db->select( [ <kf>string</kf> <vf>$sutun_isimleri</vf> = <sf>'*'</sf> ] )</ftype></p>
    <p><ftype>$this->db->from( <kf>string</kf> <vf>$tablo_adi</vf> )</ftype></p>
    <p><ftype>$this->db->where( <kf>string</kf> <vf>$sutun_adi_kosul_ifadesi</vf> , <kf>string/numeric</kf> <vf>$deger</vf> , [ <kf>string</kf> <vf>$baglac</vf> ] )</ftype></p>
    <p>SELECT, FROM ve WHERE deyimlerini kullanmak.</p>
    <p>
    <div type="code">
<pre><vf>$get</vf> = <vf>$this</vf>->db
	    ->select(<sf>'id'</sf>)
            ->from(<sf>'ornektablo'</sf>)
            ->get();
            
<kf>echo</kf> <vf>$get</vf>->row()->id;</pre>
    </div>
  	</p>
    
    <p>
    <div type="code">
<pre><vf>$get</vf> = <vf>$this</vf>->db
	    ->select() <comment> // Varsayılan parametresi *</comment>
            ->from(<sf>'ornektablo'</sf>)
            ->where(<sf>'id = '</sf>, <if>2</if>)
            ->get();
            
<kf>echo</kf> <vf>$get</vf>->row()->id;</pre>
    </div>
  	</p>
    
    <p><strong>Birden fazla where yapısı</strong> kullanmakta mümkündür.</p>
    
     <p>
    <div type="code">
<pre><vf>$get</vf> = <vf>$this</vf>->db
	    ->select() <comment> // Varsayılan parametresi *</comment>
            ->from(<sf>'ornektablo'</sf>)
            ->where(<sf>'id = '</sf>, <if>2</if>, <sf>'or'</sf>)
            ->where(<sf>'id = '</sf>, <if>1</if>)
            ->get();
            
<kf>echo</kf> <vf>$get</vf>->row()->id;</pre>
    </div>
  	</p>
    
     <p>
    <div type="code">
<pre><vf>$get</vf> = <vf>$this</vf>->db
	    ->select() <comment> // Varsayılan parametresi *</comment>
            ->from(<sf>'ornektablo'</sf>)
            ->where(<sf>'id = '</sf>, <if>1</if>, <sf>'and'</sf>)
            ->where(<sf>'isim = '</sf>, <sf>'zntr'</sf>)
            ->get();
            
<kf>echo</kf> <vf>$get</vf>->row()->id;</pre>
    </div>
  	</p>
    
    <p class="cstfont" id="insert">Veritabanına Veri Eklemek</p>
    <p><ftype>$this->db->insert( <kf>string</kf> <vf>$tablo_adi</vf> , <kf>array</kf> <vf>$eklenecek_veriler</vf> )</ftype></p>
    <p>INSERT deyimi kullanmak.</p>
    <p>
        <table class="cfont">
            <tr><th colspan="2">insert()</th></tr>
            <tr><th>Parametre</th><th>Kullanımı</th></tr>
            <tr><th>string Tablo Adı</th><td>Verilerin ekleneceği tablo adı.</td></tr>
            <tr><th>array Eklenecek Veriler</th><td>Tabloya eklenecek veriler.</td></tr>
        </table>
    </p>
    <p>
    <div type="code">
  	<vf>$this</vf>->db->insert(<sf>'ornektablo'</sf>, <kf>array</kf>(<sf>'id'</sf> => <if>1</if>, <sf>'isim'</sf> => <sf>'zntr'</sf>));
    </div>
  	</p>
    
    <p class="cstfont" id="update">Veritabanında Veri Güncellemek</p>
    <p><ftype>$this->db->update( <kf>string</kf> <vf>$tablo_adi</vf> , <kf>array</kf> <vf>$guncellenecek_veriler</vf> )</ftype></p>
    <p>UPDATE deyimi kullanmak.</p>
    <p>
        <table class="cfont">
            <tr><th colspan="2">update()</th></tr>
            <tr><th>Parametre</th><th>Kullanımı</th></tr>
            <tr><th>string Tablo Adı</th><td>Verilerin güncelleneceği tablo adı.</td></tr>
            <tr><th>array Güncellenecek Veriler</th><td>Tablodaki güncellenecek veriler.</td></tr>
        </table>
    </p>
    <p>
    <div type="code">
  	<vf>$this</vf>->db->where(<sf>'id = '</sf>, <if>1</if>)->update(<sf>'ornektablo'</sf>, <kf>array</kf>(<sf>'isim'</sf> => <sf>'zntr'</sf>));
    </div>
  	</p>
    
    <p class="cstfont" id="delete">Veritabanından Veri Silmek</p>
    <p><ftype>$this->db->delete( <kf>string</kf> <vf>$tablo_adi</vf>)</ftype></p>
    <p>DELETE deyimi kullanmak.</p>
    <p>
        <table class="cfont">
            <tr><th colspan="2">delete()</th></tr>
            <tr><th>Parametre</th><th>Kullanımı</th></tr>
            <tr><th>string Tablo Adı</th><td>Verilerin silineceği tablo adı.</td></tr>
        </table>
    </p>
    <p>
    <div type="code">
  	<vf>$this</vf>->db->where(<sf>'id = '</sf>, <if>1</if>)->delete(<sf>'ornektablo'</sf>);
    </div>
  	</p>
    
    <p class="cstfont" id="secure">Veri Güvenliğini Sağlamak</p>
    <p><ftype>$this->db->secure( <kf>array</kf> <vf>$veriler</vf>)</ftype></p>
    <p>Veritabanı işlemleri gerçekleştirilirken veri güvenliğini tehdit eden unsurların yok edilmesi amacıyla geliştirilmiştir.</p>
    <p>
    <div type="code">
<pre><vf>$this</vf>->db
     ->secure(<kf>array</kf>(<sf>':x'</sf> => <if>1</if>))
     ->where(<sf>'id = '</sf>, <sf>':x'</sf>)
     ->delete(<sf>'ornektablo'</sf>);</pre>
    </div>
  	</p>
    
     <p>
    <div type="code">
<pre><vf>$this</vf>->db
     ->secure(<kf>array</kf>(<if>1</if>, <sf>'zntr'</sf>))
     ->where(<sf>'id = '</sf>, <sf>'?'</sf>, <sf>'and'</sf>)
     ->where(<sf>'isim = '</sf>, <sf>'?'</sf>)
     ->get(<sf>'ornektablo'</sf>);</pre>
    </div>
  	</p>
    
    <p>
    <div type="code">
<pre><vf>$this</vf>->db
     ->secure(<kf>array</kf>(<sf>'secureId'</sf> => <if>1</if>, <sf>'secureName'</sf> => <sf>'zntr'</sf>))
     ->insert(<sf>'ornektablo'</sf>, <kf>array</kf>(<sf>'id'</sf> => <sf>'secureId'</sf>, <sf>'isim'</sf> => <sf>'secureName'</sf>));</pre>
    </div>
  	</p>
    
    <p class="ctfont" id="other">Diğer Veritabanı Yöntemleri</p>
    <p>Bu bölümde veritabanı sınıfının diğer yöntemlerinin nasıl kullanıldığı ile ilgili anlatıma yer verdik.</p>
    <p>
        <table class="cfont">
            <tr><th colspan="3">Diğer Yöntemler</th></tr>
            <tr><th>Yöntem</th><th>İşlev</th><th>Kullanım</th></tr>
            <tr>
            	<th>math()</th>
                <td>AVG, COUNT gibi matematiksel deyimlerin kullanılmasını sağlar.</td>
                <td>
                	<comment> 
                    	// @params array => fonksiyon ismi ve alacağı değerler.<br>                   
                    </comment>
                	<cf><vf>$this</vf>->db->math(<kf>array</kf>(<sf>'avg'</sf> => <kf>array</kf>(<sf>'sayi'</sf>, <sf>'id'</sf>)));</cf><br>
                    <comment> // ... AVG(sayi, id) ...</comment>
                </td>
            </tr>
            <tr>
            	<th>having()</th>
                <td>HAVING deyiminin kullanılmasını sağlar.</td>
                <td>
                	<comment> 
                    	// @params string => sütun bilgisi.<br>
                        // @params mixed => değer.<br>                   
                    </comment>
                	<cf><vf>$this</vf>->db->having(<sf>'avg(yas) > '</sf>, <if>30</if>);</cf><br>
                    <comment> // ... HAVING AVG(yas) > 30 ...</comment>
                </td>
            </tr>
            <tr>
            	<th>join()</th>
                <td>JOIN deyiminin kullanılmasını sağlar.</td>
                <td>
                	<comment> 
                    	// @params string => tablo adı.<br>
                        // @params string => karşılaştırma.<br> 
                        // @params string => birleştirme türü.<br>                    
                    </comment>
                	<cf><vf>$this</vf>->db->join(<sf>'OrnekTablo'</sf>, <sf>'OrnekTablo.id = Tablo.id'</sf>, <sf>'left'</sf>);</cf><br>
                    <comment> // ... LEFT JOIN OrnekTablo ON OrnekTablo.id = Tablo.id ...</comment>
                </td>
            </tr>
            <tr>
            	<th>group_by()</th>
                <td>GROUP BY deyiminin kullanılmasını sağlar.</td>
                <td>
                	<comment> 
                    	// @params string => sütun adı.<br>
                                    
                    </comment>
                	<cf><vf>$this</vf>->db->group_by(<sf>'ID'</sf>);</cf><br>
                    <comment> // ... GROUP BY ID ...</comment>
                </td>
            </tr>
            <tr>
            	<th>order_by()</th>
                <td>ORDER BY deyiminin kullanılmasını sağlar.</td>
                <td>
                	<comment> 
                    	// @params string => sütun adı.<br>
                        // @params string => sıralama türü.<br>                    
                    </comment>
                	<cf><vf>$this</vf>->db->order_by(<sf>'ID'</sf>, <sf>'desc'</sf>);</cf><br>
                    <comment> // ... ORDER BY DESC ...</comment>
                </td>
            </tr>
            <tr>
            	<th>limit()</th>
                <td>LIMIT deyiminin kullanılmasını sağlar.</td>
                <td>
                	<comment> 
                    	// @params numeric => başlangıç indeks numarası.<br>
                        // @params numeric => kaç satır veri alınacağı.<br>               
                    </comment>
                	<cf><vf>$this</vf>->db->limit(<if>0</if>, <if>2</if>);</cf><br>
                    <comment> // ... LIMIT 0, 2 ...</comment>
                </td>
            </tr>
            <tr>
            	<th>fetch_array()</th>
                <td>Standart fetch_array çıktısı üretir.</td>
                <td>   		
                	<cf><vf>$this</vf>->db->get(<sf>'OrnekTablo'</sf>)->fetch_array();<br></cf>
                </td>
            </tr>
            <tr>
            	<th>fetch_assoc()</th>
                <td>Standart fetch_assoc çıktısı üretir.</td>
                 <td>   		
                	<cf><vf>$this</vf>->db->get(<sf>'OrnekTablo'</sf>)->fetch_assoc();<br></cf>
                </td>
            </tr>
            <tr>
            	<th>fetch_row()</th>
                <td>Standart fetch_row çıktısı üretir.</td>
                 <td>   		
                	<cf><vf>$this</vf>->db->get(<sf>'OrnekTablo'</sf>)->fetch_row();<br></cf>
                </td>
            </tr>
            <tr>
            	<th>affected_rows()</th>
                <td>Sorgu sonucu etkilenen satır sayısını verir.</td>
                <td>
                	<cf><vf>$this</vf>->db->affected_rows();</cf><br>
                </td>
            </tr>
            
            <tr>
            	<th>insert_id()</th>
                <td>Tabloya Id sütunu eklemek için kullanılır.</td>
                <td>
                	<cf><vf>$this</vf>->db->insert_id();</cf><br>
                </td>
            </tr>
            
            <tr>
            	<th>all()</th>
                <td>ALL deyiminin kullanılmasını sağlar.</td>
                <td>
                	<cf><vf>$this</vf>->db->all();</cf><br>
                    <comment> // ... ALL ...</comment>
                </td>
            </tr>
            <tr>
            	<th>distinct()</th>
                <td>DISTINCT deyiminin kullanılmasını sağlar.</td>
                <td>
                	<cf><vf>$this</vf>->db->distinct();</cf><br>
                    <comment> // ... DISTINCT ...</comment>
                </td>
            </tr>
            <tr>
            	<th>distinctrow()</th>
                <td>DISTINCTROW deyiminin kullanılmasını sağlar.</td>
                <td>
                	<cf><vf>$this</vf>->db->distinctrow();</cf><br>
                    <comment> // ... DISTINCTROW ...</comment>
                </td>
            </tr>
            <tr>
            	<th>straight_join()</th>
                <td>STRAIGHT_JOIN deyiminin kullanılmasını sağlar.</td>
                <td>
                	<cf><vf>$this</vf>->db->straight_join();</cf><br>
                    <comment> // ... STRAIGHT JOIN ...</comment>
                </td>
            </tr>
            <tr>
            	<th>high_priority()</th>
                <td>HIGH_PRIORTY deyiminin kullanılmasını sağlar.</td>
                <td>
                	<cf><vf>$this</vf>->db->high_priority();</cf><br>
                    <comment> // ... HIGH_PRIORTY ...</comment>
                </td>
            </tr>
            <tr>
            	<th>small_result()</th>
                <td>SQL_SMALL_RESULT deyiminin kullanılmasını sağlar.</td>
                <td>
                	<cf><vf>$this</vf>->db->small_result();</cf><br>
                    <comment> // ... SQL_SMALL_RESULT ...</comment>
                </td>
            </tr>
            <tr>
            	<th>big_result()</th>
                <td>SQL_BIG_RESULT deyiminin kullanılmasını sağlar.</td>
                <td>
                	<cf><vf>$this</vf>->db->big_result();</cf><br>
                    <comment> // ... SQL_BIG_RESULT ...</comment>
                </td>
            </tr>
            <tr>
            	<th>buffer_result()</th>
                <td>SQL_BUFFER_RESULT deyiminin kullanılmasını sağlar.</td>
                <td>
                	<cf><vf>$this</vf>->db->buffer_result();</cf><br>
                    <comment> // ... SQL_BUFFER_RESULT ...</comment>
                </td>
            </tr>
            <tr>
            	<th>cache()</th>
                <td>SQL_CACHE deyiminin kullanılmasını sağlar.</td>
                <td>
                	<cf><vf>$this</vf>->db->cache();</cf><br>
                    <comment> // ... SQL_CACHE ...</comment>
                </td>
            </tr>
            <tr>
            	<th>no_cache()</th>
                <td>SQL_NO_CACHE deyiminin kullanılmasını sağlar.</td>
                <td>
                	<cf><vf>$this</vf>->db->no_cache();</cf><br>
                    <comment> // ... SQL_NO_CACHE ...</comment>
                </td>
            </tr>
            <tr>
            	<th>calc_found_rows()</th>
                <td>SQL_CACL_FOUND_ROWS deyiminin kullanılmasını sağlar.</td>
                <td>
                	<cf><vf>$this</vf>->db->calc_found_rows();</cf><br>
                    <comment> // ... SQL_CACL_FOUND_ROWS ...</comment>
                </td>
            </tr>
            
            <tr>
            	<th>version()</th>
                <td>Veritabanının versiyon bilgisini öğrenmek için kullanılır.</td>
                <td>
                	<cf><vf>$this</vf>->db->version();</cf><br>
                </td>
            </tr>
            
            <tr>
            	<th>error()</th>
                <td>Veritabanı sorgularında oluşacak hatalar hakkında bilgi almak için kullanılır.</td>
                <td>
                	<cf><vf>$this</vf>->db->error();</cf><br>
                </td>
            </tr>
        </table>
    </p>
    
    <div type="prev-next">
    	<div type="prev-btn"><a href="db_config.html">Önceki</a></div><div type="next-btn"><a href="db_trans.html">Sonraki</a></div>
    </div>
 
</body>
</html>              