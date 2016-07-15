<?php
class UserExample extends Controller
{	
    public function main($params = '')
    {	
		$data['title']        = 'User Example';
		$data['subtitle']     = 'UserExample';
		$data['examples']     = 
		[
			'register',
			'login',
			'logout',
			'update'
		];
		
		$data['requirements'] = 
		[
			'Applications/Example/Config/Database.php dosyasından veritabanı ayarlarını yapın.',
			'www.xxx.xxx/example/UserExample/createTable URL\'sini çalıştırıp veritabanına "user_example" tablosunun oluşturun.'
		];
		
       	Import::view('main', $data); 
    }	
	
	public function register()
	{
		$data['title'] = 'Register Example';
		
		if( Method::post('register') )
		{
			// p1: post verisi.
			// p2: kurallar dizisi.
			// p3: Geçersizlik durumunda post verisinin görünen adı.
			// Bu değer belirtilmez ise post verisinin name değer baz alınır.
			Validation::rules('username', ['email'], 'Username');
			Validation::rules('password', ['required', 'xss', 'alnum', 'matchPassword' => 'passwordAgain', 'minchar' => 4, 'maxchar' => 8], 'Password');
			Validation::rules('passwordAgain', ['required'], 'Password Again');
			
			if( $error = Validation::error('string') )
			{
				$data['error'] = $error;	
			}
			else
			{
				$userData = 
				[
					'username' 		=> Validation::nval('username'),
					'password'		=> Validation::nval('password')
				];
				
				// p1: Veritabanına kaydedilecek veriler.
				// p2: Kayıt sonra yönlenicek sayfa.
				User::register($userData, 'example/UserExample/login');		
			}
		}
		
		Import::view('user-example', $data);
	}
	
	public function login()
	{
		$data['title'] = 'Login Example';
		
		if( Method::post('login') )
		{
			Validation::rules('username', ['email'], 'Username');
			Validation::rules('password', ['required', 'alnum'], 'Password');
			
			if( $error = Validation::error('string') )
			{
				$data['error'] = $error;	
			}
			else
			{
				// p1: Veritabanına kaydedilecek veriler.
				// p2: Kayıt sonra yönlenicek sayfa.
				User::login(Validation::nval('username'), Validation::nval('password'));

				if( ! User::isLogin() )
				{
					$data['error'] = User::error() ? User::error() : 'Wrong! Username or password!';	
				}		
				else
				{
					$data['error'] = User::success();	
				}
			}
		}
		
		Import::view('user-example', $data);	
	}
	
	public function logout()
	{
		// p1: çıkış sonrası yönlendirelecek adres belirtilir.
		User::logout('example/UserExample/login');	
	}
	
	public function createTable()
	{
		DBForge::createTable('user_example', 
		[
			'id' 		=> [DB::int(11), DB::notNull(), DB::autoIncrement(), DB::primaryKey()],
			'username' 	=> [DB::varchar(255), DB::notNull()],
			'password'  => [DB::varchar(64), DB::notNull()]
		], DB::encoding('utf8', 'utf8_general_ci'));	
		
		echo DBForge::error();
	}
}