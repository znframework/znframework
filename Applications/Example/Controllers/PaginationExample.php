<?php
class PaginationExample extends Controller
{	
    public function main($params = '')
    {	
		$data['title']        = str_replace('Example', ' Example', __CLASS__);
		$data['subtitle']     = __CLASS__;
		$data['examples']     = 
		[
			'pagination'
		];
		
		$data['requirements'] = [];
		
       	Import::view('main', $data); 
    }	
	
	public function pagination()
	{
		$title = 'Pagination Component';
		
		// p1: Kayıt başlangıç numarasıdır.
		// Null belirtilirse URL deki son değer 
		// kayıt başlangıç sayısını ifade eder.
		// sayfalama numarası başka bir konumda ise
		// URI::get() ile sayıyı 1. parametreye yazdırabilirsiniz.
		// p2: limit miktarıdır. Kaçar kaçar listeleneceği belirtilir.
		$get = DB::limit(NULL, 1)->get('user_example');
		
		// Database Kayıtları
		$result 	= $get->result();
		
		// Sayfalama Barı
		// Barın görünebilmesi için en az limit + 1 kayıtın olması gerekmektedir.
		// user_example tablosunda kayıt yoksa kayıt olan farklı bir tablo 
		// kullanabilirsiniz.
		// p1: Sayfalama barının kullanacağı sayfa kayıt numarası bilgisinin
		// ekleneceği URI bilgisidir.
		$pagination = $get->pagination('example/PaginationExample/pagination');

		Import::view('pagination-example', 
		[
			'title'			=> $title,
			'result'		=> $result,
			'pagination'	=> $pagination
		]);
	}
}