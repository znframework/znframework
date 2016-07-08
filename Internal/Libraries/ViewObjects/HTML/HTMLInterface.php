<?php
namespace ZN\ViewObjects;

interface HTMLInterface
{
	//----------------------------------------------------------------------------------------------------
	//
	// Yazar      : Ozan UYKUN <ozanbote@windowslive.com> | <ozanbote@gmail.com>
	// Site       : www.zntr.net
	// Lisans     : The MIT License
	// Telif Hakkı: Copyright (c) 2012-2016, zntr.net
	//
	//----------------------------------------------------------------------------------------------------
	
	// Function: html_element()
	// İşlev: Herhangi bir html elemanını oluşturmak için kullanılır.
	// Parametreler
	// @element = Hangi html elemanı kullanılacağı. Örnek: strong
	// @str = Html etiketinin uygulanacağı veri. Örnek: veri
	// @attributes = Etikete uygulanacak özellik değer çiftleri. array("id" => "12")
	// Dönen Değer: <strong id="12>veri</strong>
	public function element($element, $str, $attributes);	

	// Function: multiAttr()
	// İşlev: Bir veriye birden fazla html etiketi uygulamak için kullanılır.
	// Parametreler
	// @str = Özelliklerin uygulanacağı metin.
	// @array = Uygulanacak html etikeleri. array("b", "i" => array("id" => 2))
	// Dönen Değer: Etiketlerin uygulanmış hali.
	public function multiAttr($str, $array);

	// Function: heading()
	// İşlev: Başlık etiketi uygulamak için kullanılır.
	// Parametreler
	// @str = Özelliklerin uygulanacağı metin.
	// @type = Uygulanacak olan başlık etiketinin türü. h1, h2, h3...
	// @attributes = Etikete özellik değer çifti eklemek için kullanılır.
	// Dönen Değer: Etiketin uygulanmış hali.
	public function heading($str, $type, $attributes);	

	// Function: font()
	// İşlev: Metne renk, biçim ve boyut eklemek için kullanılır.
	// Parametreler
	// @str = Özelliklerin uygulanacağı metin.
	// @attributes = Etikete özellik değer çifti eklemek için kullanılır.
	// Dönen Değer: Etiketin uygulanmış hali.
	public function font($str, $attributes);

	// Function: parag()
	// İşlev: Html <p> etiketini uygulamak için kullanılır
	// Parametreler
	// @str = Özelliklerin uygulanacağı metin.
	// @attributes = Etikete özellik değer çifti eklemek için kullanılır.
	// Dönen Değer: Etiketin uygulanmış hali.
	public function parag($str, $attributes);

	// Function: bold()
	// İşlev: Html <b> etiketini uygulamak için kullanılır
	// Parametreler
	// @str = Özelliklerin uygulanacağı metin.
	// @attributes = Etikete özellik değer çifti eklemek için kullanılır.
	// Dönen Değer: Etiketin uygulanmış hali.
	public function bold($str, $attributes);

	// Function: strong()
	// İşlev: Html <strong> etiketini uygulamak için kullanılır
	// Parametreler
	// @str = Özelliklerin uygulanacağı metin.
	// @attributes = Etikete özellik değer çifti eklemek için kullanılır.
	// Dönen Değer: Etiketin uygulanmış hali.
	public function strong($str, $attributes);

	// Function: italic()
	// İşlev: Html <i> etiketini uygulamak için kullanılır
	// Parametreler
	// @str = Özelliklerin uygulanacağı metin.
	// @attributes = Etikete özellik değer çifti eklemek için kullanılır.
	// Dönen Değer: Etiketin uygulanmış hali.
	public function italic($str, $attributes);

	// Function: underLine()
	// İşlev: Html <u> etiketini uygulamak için kullanılır
	// Parametreler
	// @str = Özelliklerin uygulanacağı metin.
	// @attributes = Etikete özellik değer çifti eklemek için kullanılır.
	// Dönen Değer: Etiketin uygulanmış hali.
	public function underLine($str, $attributes);

	// Function: overLine()
	// İşlev: Html <del> etiketini uygulamak için kullanılır
	// Parametreler
	// @str = Özelliklerin uygulanacağı metin.
	// @attributes = Etikete özellik değer çifti eklemek için kullanılır.
	// Dönen Değer: Etiketin uygulanmış hali.
	public function overLine($str, $attributes);

	// Function: overText()
	// İşlev: Html <sup> etiketini uygulamak için kullanılır
	// Parametreler
	// @str = Özelliklerin uygulanacağı metin.
	// @attributes = Etikete özellik değer çifti eklemek için kullanılır.
	// Dönen Değer: Etiketin uygulanmış hali.
	public function overText($str, $attributes);

	// Function: underText()
	// İşlev: Html <sub> etiketini uygulamak için kullanılır
	// Parametreler
	// @str = Özelliklerin uygulanacağı metin.
	// @attributes = Etikete özellik değer çifti eklemek için kullanılır.
	// Dönen Değer: Etiketin uygulanmış hali.
	public function underText($str, $attributes);

	// Function: space()
	// İşlev: İstenilen sayıda boşluk eklemek için kullanılır.
	// Parametreler
	// @count = Boşluk sayısı.
	public function space($count);

	// Function: anchor()
	// İşlev: Html <a> etiketini uygulamak için kullanılır
	// Parametreler
	// @url = Köprüye tıklanınca gidilecek url adresi.
	// @value = Köprünün görünen değeri.
	// @attributes = Etikete özellik değer çifti eklemek için kullanılır.
	// Dönen Değer: Etiketin uygulanmış hali.
	public function anchor($url, $value, $_attributes);

	// Function: mailTo()
	// İşlev: Html <a> etiketini uygulamak için kullanılır.
	// Parametreler
	// @mail = E-posta adresi.
	// @attributes = Etikete özellik değer çifti eklemek için kullanılır.
	// Dönen Değer: Etiketin uygulanmış hali.
	public function mailTo($mail, $_attributes);

	// Function: image()
	// İşlev: Html <img> etiketini uygulamak için kullanılır.
	// Parametreler
	// @src = Resmin kaynağı.
	// @attributes = Etikete özellik değer çifti eklemek için kullanılır.
	// Dönen Değer: Etiketin uygulanmış hali.
	public function image($src, $_attributes);

	// Function: br()
	// İşlev: Html <br> etiketini uygulamak için kullanılır.
	// Parametreler
	// @count = Kaç alt satır bırakılacağı.
	public function br($count);
	
	// Function: meta()
	// İşlev: Html <meta> etiketini uygulamak için kullanılır.
	// Parametreler
	// @name = Meta'nın isim bilgisi.
	// @content = Meta'nın içerik bilgisi.
	// @type = Meta isim bilgisinin türü. Parametrenin alabileceği değerler: name, http
	// Dönen Değer: Etiketin uygulanmış hali.
	public function meta($name, $content ,$type);
	
	/******************************************************************************************
	* HEADER                                                                                  *
	*******************************************************************************************
	| Genel Kullanım: Html <header></header> tagının kullanımıdır.    			          	  |
	|															                              |
	| Parametreler: Tek parametresi vardır.		                                              |
	| 1. string var @html => HTML nesnesinin içeriği belirtilir.	  				          |
	|          																				  |
	| Örnek Kullanım: header('İçerik');          											  |
	| // <header>İçerik</header>											       	          | 
	|          																				  |
	******************************************************************************************/
	public function header($html);
	
	/******************************************************************************************
	* FOOTER                                                                                  *
	*******************************************************************************************
	| Genel Kullanım: Html <footer></footer> tagının kullanımıdır.    			          	  |
	|															                              |
	| Parametreler: Tek parametresi vardır.		                                              |
	| 1. string var @html => HTML nesnesinin içeriği belirtilir.	  				          |
	|          																				  |
	| Örnek Kullanım: footer('İçerik');          											  |
	| // <footer>İçerik</footer>											       	          | 
	|          																				  |
	******************************************************************************************/
	public function footer($html);
	
	/******************************************************************************************
	* NAV                                                                                     *
	*******************************************************************************************
	| Genel Kullanım: Html <nav></nav> tagının kullanımıdır.    			          	      |
	|															                              |
	| Parametreler: Tek parametresi vardır.		                                              |
	| 1. string var @html => HTML nesnesinin içeriği belirtilir.	  				          |
	|          																				  |
	| Örnek Kullanım: footer('İçerik');          											  |
	| // <nav>İçerik</nav>											       	          		  | 
	|          																				  |
	******************************************************************************************/
	public function nav($html);
	
	/******************************************************************************************
	* ARTICLE                                                                                 *
	*******************************************************************************************
	| Genel Kullanım: Html <article></article> tagının kullanımıdır.    			          |
	|															                              |
	| Parametreler: Tek parametresi vardır.		                                              |
	| 1. string var @html => HTML nesnesinin içeriği belirtilir.	  				          |
	|          																				  |
	| Örnek Kullanım: article('İçerik');          											  |
	| // <article>İçerik</article>											       	          | 
	|          																				  |
	******************************************************************************************/
	public function article($html);
	
	/******************************************************************************************
	* ASIDE                                                                                   *
	*******************************************************************************************
	| Genel Kullanım: Html <aside></aside> tagının kullanımıdır.    			              |
	|															                              |
	| Parametreler: Tek parametresi vardır.		                                              |
	| 1. string var @html => HTML nesnesinin içeriği belirtilir.	  				          |
	|          																				  |
	| Örnek Kullanım: aside('İçerik');          											  |
	| // <aside>İçerik</aside>											       	              | 
	|          																				  |
	******************************************************************************************/
	public function aside($html);
	
	/******************************************************************************************
	* SECTION                                                                                 *
	*******************************************************************************************
	| Genel Kullanım: Html <section></section> tagının kullanımıdır.    			          |
	|															                              |
	| Parametreler: Tek parametresi vardır.		                                              |
	| 1. string var @html => HTML nesnesinin içeriği belirtilir.	  				          |
	|          																				  |
	| Örnek Kullanım: section('İçerik');          											  |
	| // <section>İçerik</section>											       	          | 
	|          																				  |
	******************************************************************************************/
	public function section($html);
	
	/******************************************************************************************
	* HGROUP                                                                                  *
	*******************************************************************************************
	| Genel Kullanım: Html <hgroup></hgroup> tagının kullanımıdır.    			              |
	|															                              |
	| Parametreler: Tek parametresi vardır.		                                              |
	| 1. string var @html => HTML nesnesinin içeriği belirtilir.	  				          |
	|          																				  |
	| Örnek Kullanım: hgroup('İçerik');          											  |
	| // <hgroup>İçerik</hgroup>											       	          | 
	|          																				  |
	******************************************************************************************/
	public function hgroup($html);
	
	/******************************************************************************************
	* CANVAS                                                                                  *
	*******************************************************************************************
	| Genel Kullanım: Html <canvas></canvas> tagının kullanımıdır.    			              |
	|															                              |
	| Parametreler: 2 parametresi vardır.		                                              |
	| 1. string var @html => HTML nesnesinin içeriği belirtilir.	  				          |
	| 2. array var @attributes => HTML nesnesinin özellik ve değerleri.	  				      |
	|          																				  |
	| Örnek Kullanım: canvas('İçerik', array('name' => 'nesne'));          					  |
	| // <canvas name="nesne">İçerik</canvas>											      | 
	|          																				  |
	******************************************************************************************/
	public function canvas($content, $_attributes);
	
	/******************************************************************************************
	* DATALIST                                                                                *
	*******************************************************************************************
	| Genel Kullanım: Html <datalist></datalist> tagının kullanımıdır.    			          |
	|															                              |
	| Parametreler: 2 parametresi vardır.		                                              |
	| 1. string var @html => HTML nesnesinin içeriği belirtilir.	  				          |
	| 2. array var @attributes => HTML nesnesinin özellik ve değerleri.	  				      |
	|          																				  |
	| Örnek Kullanım: dataList('İçerik', array('name' => 'nesne'));          				  |
	| // <datalist name="nesne">İçerik</datalist>											  | 
	|          																				  |
	******************************************************************************************/
	public function dataList($content, $_attributes);
	
	/******************************************************************************************
	* OUTPUT                                                                                  *
	*******************************************************************************************
	| Genel Kullanım: Html <output></output> tagının kullanımıdır.    			              |
	|															                              |
	| Parametreler: 2 parametresi vardır.		                                              |
	| 1. string var @html => HTML nesnesinin içeriği belirtilir.	  				          |
	| 2. array var @attributes => HTML nesnesinin özellik ve değerleri.	  				      |
	|          																				  |
	| Örnek Kullanım: output('İçerik', array('name' => 'nesne'));          				      |
	| // <output name="nesne">İçerik</output>											      | 
	|          																				  |
	******************************************************************************************/
	public function output($content, $_attributes);	
	
	/******************************************************************************************
	* DETAILS                                                                                 *
	*******************************************************************************************
	| Genel Kullanım: Html <details></details> tagının kullanımıdır.    			          |
	|															                              |
	| Parametreler: 2 parametresi vardır.		                                              |
	| 1. string var @html => HTML nesnesinin içeriği belirtilir.	  				          |
	| 2. array var @attributes => HTML nesnesinin özellik ve değerleri.	  				      |
	|          																				  |
	| Örnek Kullanım: details('İçerik', array('name' => 'nesne'));          				  |
	| // <details name="nesne">İçerik</details>											      | 
	|          																				  |
	******************************************************************************************/
	public function details($content, $_attributes);
	
	/******************************************************************************************
	* SUMMARY                                                                                 *
	*******************************************************************************************
	| Genel Kullanım: Html <summary></summary> tagının kullanımıdır.    			          |
	|															                              |
	| Parametreler: 2 parametresi vardır.		                                              |
	| 1. string var @html => HTML nesnesinin içeriği belirtilir.	  				          |
	| 2. array var @attributes => HTML nesnesinin özellik ve değerleri.	  				      |
	|          																				  |
	| Örnek Kullanım: summary('İçerik', array('name' => 'nesne'));          				  |
	| // <summary name="nesne">İçerik</summary>											      | 
	|          																				  |
	******************************************************************************************/
	public function summary($content, $_attributes);
	
	/******************************************************************************************
	* FIGURE                                                                                  *
	*******************************************************************************************
	| Genel Kullanım: Html <figure></figure> tagının kullanımıdır.    			              |
	|															                              |
	| Parametreler: 2 parametresi vardır.		                                              |
	| 1. string var @html => HTML nesnesinin içeriği belirtilir.	  				          |
	| 2. array var @attributes => HTML nesnesinin özellik ve değerleri.	  				      |
	|          																				  |
	| Örnek Kullanım: figure('İçerik', array('name' => 'nesne'));          				      |
	| // <figure name="nesne">İçerik</figure>											      | 
	|          																				  |
	******************************************************************************************/
	public function figure($content, $_attributes);
	
	/******************************************************************************************
	* FIGCAPTION                                                                              *
	*******************************************************************************************
	| Genel Kullanım: Html <figcaption></figcaption> tagının kullanımıdır.    			      |
	|															                              |
	| Parametreler: 2 parametresi vardır.		                                              |
	| 1. string var @html => HTML nesnesinin içeriği belirtilir.	  				          |
	| 2. array var @attributes => HTML nesnesinin özellik ve değerleri.	  				      |
	|          																				  |
	| Örnek Kullanım: figCaption('İçerik', array('name' => 'nesne'));          				  |
	| // <figcaption name="nesne">İçerik</figcaption>										  | 
	|          																				  |
	******************************************************************************************/
	public function figCaption($content, $_attributes);
	
	/******************************************************************************************
	* MARK                                                                                    *
	*******************************************************************************************
	| Genel Kullanım: Html <mark></mark> tagının kullanımıdır.    			      			  |
	|															                              |
	| Parametreler: 2 parametresi vardır.		                                              |
	| 1. string var @html => HTML nesnesinin içeriği belirtilir.	  				          |
	| 2. array var @attributes => HTML nesnesinin özellik ve değerleri.	  				      |
	|          																				  |
	| Örnek Kullanım: mark('İçerik', array('name' => 'nesne'));          				  	  |
	| // <mark name="nesne">İçerik</mark>										 			  | 
	|          																				  |
	******************************************************************************************/
	public function mark($content, $_attributes);
	
	/******************************************************************************************
	* TIME                                                                                    *
	*******************************************************************************************
	| Genel Kullanım: Html <time></time> tagının kullanımıdır.    			      			  |
	|															                              |
	| Parametreler: 2 parametresi vardır.		                                              |
	| 1. string var @html => HTML nesnesinin içeriği belirtilir.	  				          |
	| 2. array var @attributes => HTML nesnesinin özellik ve değerleri.	  				      |
	|          																				  |
	| Örnek Kullanım: time('İçerik', array('name' => 'nesne'));          				  	  |
	| // <time name="nesne">İçerik</time>										 			  | 
	|          																				  |
	******************************************************************************************/ 
	public function time($content, $_attributes);

	/******************************************************************************************
	* DIALOG                                                                                  *
	*******************************************************************************************
	| Genel Kullanım: Html <dialog></dialog> tagının kullanımıdır.    			      	      |
	|															                              |
	| Parametreler: 2 parametresi vardır.		                                              |
	| 1. string var @html => HTML nesnesinin içeriği belirtilir.	  				          |
	| 2. array var @attributes => HTML nesnesinin özellik ve değerleri.	  				      |
	|          																				  |
	| Örnek Kullanım: dialog('İçerik', array('name' => 'nesne'));          				  	  |
	| // <dialog name="nesne">İçerik</dialog>										 		  | 
	|          																				  |
	******************************************************************************************/ 
	public function dialog($content, $_attributes);
	
	/******************************************************************************************
	* COMMAND                                                                                 *
	*******************************************************************************************
	| Genel Kullanım: Html <command></command> tagının kullanımıdır.    			      	  |
	|															                              |
	| Parametreler: 2 parametresi vardır.		                                              |
	| 1. string var @html => HTML nesnesinin içeriği belirtilir.	  				          |
	| 2. array var @attributes => HTML nesnesinin özellik ve değerleri.	  				      |
	|          																				  |
	| Örnek Kullanım: command('İçerik', array('name' => 'nesne'));          				  |
	| // <command name="nesne">İçerik</command>										 		  | 
	|          																				  |
	******************************************************************************************/ 
	public function command($content, $_attributes);
	
	/******************************************************************************************
	* METER                                                                                   *
	*******************************************************************************************
	| Genel Kullanım: Html <meter></meter> tagının kullanımıdır.    			      	      |
	|															                              |
	| Parametreler: 2 parametresi vardır.		                                              |
	| 1. string var @html => HTML nesnesinin içeriği belirtilir.	  				          |
	| 2. array var @attributes => HTML nesnesinin özellik ve değerleri.	  				      |
	|          																				  |
	| Örnek Kullanım: meter('İçerik', array('name' => 'nesne'));          				      |
	| // <meter name="nesne">İçerik</meter>										 		      | 
	|          																				  |
	******************************************************************************************/ 
	public function meter($content, $_attributes);
	
	/******************************************************************************************
	* PROGRESS                                                                                *
	*******************************************************************************************
	| Genel Kullanım: Html <progress></progress> tagının kullanımıdır.    			      	  |
	|															                              |
	| Parametreler: 2 parametresi vardır.		                                              |
	| 1. string var @html => HTML nesnesinin içeriği belirtilir.	  				          |
	| 2. array var @attributes => HTML nesnesinin özellik ve değerleri.	  				      |
	|          																				  |
	| Örnek Kullanım: progress('İçerik', array('name' => 'nesne'));          				  |
	| // <progress name="nesne">İçerik</progress>										 	  | 
	|          																				  |
	******************************************************************************************/ 
	public function progress($content, $_attributes);
	
	/******************************************************************************************
	* KEYGEN                                                                                  *
	*******************************************************************************************
	| Genel Kullanım: Html <keygen></keygen> tagının kullanımıdır.    			      	      |
	|															                              |
	| Parametreler: Tek parametresi vardır.		                                              |
	| 1. array var @attributes => HTML nesnesinin özellik ve değerleri.	  				      |
	|          																				  |
	| Örnek Kullanım: keygen(array('name' => 'nesne'));          				  			  |
	| // <keygen name="nesne">										 	  				      | 
	|          																				  |
	******************************************************************************************/ 
	public function keygen($_attributes);
	
	/******************************************************************************************
	* EMBED                                                                                   *
	*******************************************************************************************
	| Genel Kullanım: Html <embed></embed> tagının kullanımıdır.    			      	      |
	|															                              |
	| Parametreler: 2 parametresi vardır.		                                              |
	| 1. string var @src => HTML nesnesinin kaynağı belirtilir.	  				              |
	| 2. array var @attributes => HTML nesnesinin özellik ve değerleri.	  				      |
	|          																				  |
	| Örnek Kullanım: embed('http://www.ornek.com/kaynak', array('name' => 'nesne'));         |
	| // <embed src="http://www.ornek.com/kaynak" name="nesne">								  | 
	|          																				  |
	******************************************************************************************/ 
	public function embed($src, $_attributes);
	
	/******************************************************************************************
	* SOURCE                                                                                  *
	*******************************************************************************************
	| Genel Kullanım: Html <source></source> tagının kullanımıdır.    			      	      |
	|															                              |
	| Parametreler: 2 parametresi vardır.		                                              |
	| 1. string var @src => HTML nesnesinin kaynağı belirtilir.	  				              |
	| 2. array var @attributes => HTML nesnesinin özellik ve değerleri.	  				      |
	|          																				  |
	| Örnek Kullanım: source('http://www.ornek.com/kaynak', array('name' => 'nesne'));        |
	| // <source src="http://www.ornek.com/kaynak" name="nesne">							  | 
	|          																				  |
	******************************************************************************************/
	public function source($src, $_attributes);
	
	/******************************************************************************************
	* VIDEO                                                                                   *
	*******************************************************************************************
	| Genel Kullanım: Html <video></video> tagının kullanımıdır.    			      	      |
	|															                              |
	| Parametreler: 3 parametresi vardır.		                                              |
	| 1. string var @src => HTML nesnesinin kaynağı belirtilir.	  				              |
	| 2. string var @content => HTML nesnesinin içeriği belirtilir.	  				          |
	| 3. array var @attributes => HTML nesnesinin özellik ve değerleri.	  				      |
	|          																				  |
	| Örnek Kullanım: video('http://www.ornek.com/kaynak', 'İçerik', array('name' => 'nesne'))|
	| // <video src="http://www.ornek.com/kaynak" name="nesne">İçerik</video>				  | 
	|          																				  |
	******************************************************************************************/
	public function video($src, $content, $attributes);
	
	/******************************************************************************************
	* AUDIO                                                                                   *
	*******************************************************************************************
	| Genel Kullanım: Html <audio></audio> tagının kullanımıdır.    			      	      |
	|															                              |
	| Parametreler: 3 parametresi vardır.		                                              |
	| 1. string var @src => HTML nesnesinin kaynağı belirtilir.	  				              |
	| 2. string var @content => HTML nesnesinin içeriği belirtilir.	  				          |
	| 3. array var @attributes => HTML nesnesinin özellik ve değerleri.	  				      |
	|          																				  |
	| Örnek Kullanım: audio('http://www.ornek.com/kaynak', 'İçerik', array('name' => 'nesne'))|
	| // <audio src="http://www.ornek.com/kaynak" name="nesne">İçerik</audio>				  | 
	|          																				  |
	******************************************************************************************/
	public function audio($src, $content, $attributes);
}