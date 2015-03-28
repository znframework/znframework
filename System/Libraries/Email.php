<?php
/************************************************************/
/*                       CLASS  EMAIL                       */
/************************************************************/
/*

Author: Ozan UYKUN
Site: http://www.zntr.net
Copyright 2012-2015 zntr.net - Tüm hakları saklıdır.

*/
class Email {
	
	private static $mail			= '';
	private static $from_email		= '';
	private static $from_name		= '';
	private static $subject			= '';
	private static $message			= '';
	private static $error			= '';
	private static $detail			= '';
	
	private static $settings 		= array(
		'username'					=> '', // kullanici@site.xxx
		'fromname'					=> '', // Kullanici İsmi
		'password'					=> '', // Kullanıcı Şifresi
		'port'						=> '',// Port Numarası
		'host'						=> '', // mail.alanadi.xxx
		'is_html'					=> '', 
		'is_smtp'					=> '', 
		'smtp_auth'					=> '',
		'smtp_debug' 				=> '', // false
		'smtp_secure'				=> '', // 'ssl', 'tsl', ''
		'smtp_keep_alive'			=> '',
		'charset'					=> '',	
		'alt_body'					=> '',
		'priorty'					=> '', // 3
		'content'					=> '', // text/plain
		'encoding'					=> '', // 8bit
		'word_wrap'					=> '',
		'send_mail'					=> '', // /usr/sbin/sendmail
		'mailer'					=> '', // mail
		'sender'					=> '',
		'return_path'				=> '',
		'use_send_mail_options' 	=> '', // true
		'lugin_dir' 				=> '',
		'confirm_reading_to' 		=> '',
		'host_name' 				=> '',
		'message_id' 				=> '',
		'message_date' 				=> '',
		'helo'	 					=> '',
		'auth_type'	 				=> '',
		'plugin_dir'				=> '',
		'realm'		 				=> '',
		'work_station'				=> '',
		'timeout'		 			=> '',
		'debug_output'				=> '',
		'single_to'					=> '',
		'single_to_array'			=> array(),
		'le'						=> '',
		'dkim_selector'				=> '',
		'dkim_identity'				=> '',
		'dkim_pass_phrase'			=> '',
		'dkim_domain'				=> '',
		'dkim_private'				=> '',
		'action_function'			=> '',
		'version'					=> '', // 5.2.4
		'xmailer'					=> ''
	);
	
	
	public static function settings($settings = array())
	{
		if(is_array($settings)) foreach($settings as $k => $v)
		{
			self::$settings[$k] = $v;
		}
	}
	
	
	public static function receiver($email = '', $name = '')
	{
		if(empty(self::$mail)) return false;
		 
		if( ! is_string($name)) $name = '';
		if(isset($email))
		{
			if( ! is_array($email)) 
				self::$mail->AddAddress($email, $name);
			else 
				foreach($email as $e => $n) 
					self::$mail->AddAddress($e, $n);
		}	
	}
	
	
	public static function add_reply_to($email = '', $name = '')
	{
		if(empty(self::$mail)) return false;
		
		if( ! is_string($name)) $name = '';
		if(isset($email))
		{
			if( ! is_array($email)) 
				self::$mail->AddReplyTo($email, $name);
			else 
				foreach($email as $e => $n) 
					self::$mail->AddReplyTo($e, $n);
		}
	}
	
	
	public static function add_cc($email = '', $name = '')
	{
		if(empty(self::$mail)) return false;
		
		if( ! is_string($name)) $name = '';
		if(isset(self::$email))
		{
			if( ! is_array($email)) 
				self::$mail->AddCC($email, $name);
			else 
				foreach($email as $e => $n) 
					self::$mail->AddCC($e, $n);
		}
	}
	
	
	public static function add_bcc($email = '', $name = '')
	{
		if(empty(self::$mail)) return false;
		
		if( ! is_string($name)) $name = '';
		if(isset($email))
		{
			if( ! is_array($email)) 
				self::$mail->AddBCC($email, $name);
			else 
				foreach($email as $e => $n) 
					self::$mail->AddBCC($e, $n);
		}
	}
	
	
	public static function sender($email = '', $name = '')
	{
		if(empty(self::$mail)) return false;
		
		if( ! is_string($email)) return false;
		if( ! is_string($name)) $name = '';
		
		self::$from_email = $email;
		self::$from_name  = $name;	
	}
	
	
	public static function subject($subject = '')
	{
		if( ! is_string($subject)) return false;
		self::$subject = $subject;
	}
	
	
	public static function message($message = '')
	{
		if( ! is_string($message)) return false;
		self::$message = $message;
	}
	
	
	public static function error()
	{
		return self::$error;
	}
	
	
	public static function detail()
	{
		return self::$detail;
	}
	
	
	public static function open()
	{
		import::language('Email');
		import::package(REFERENCES_DIR.'PHPMailer');	
		self::$mail = new PHPMailer();
	}
	
	
	public static function is_mail()
	{
		if(empty(self::$mail)) return false;
		
		self::$mail->IsMail();
	}
	
	
	public static function is_send_mail()
	{
		if(empty(self::$mail)) return false;
		self::$mail->IsSendmail();
	}
	
	
	public static function is_q_mail()
	{
		if(empty(self::$mail)) return false;
		self::$mail->IsQmail();
	}
	
	
	public static function validate_address()
	{
		return self::$mail->ValidateAddress();
	}
	
	
	public static function pre_send()
	{
		if(empty(self::$mail)) return false;
		return self::$mail->PreSend();
	}
	
	
	public static function post_send()
	{
		if(empty(self::$mail)) return false;
		return self::$mail->PostSend();
	}
	
	
	public static function smtp_connect()
	{
		if(empty(self::$mail)) return false;
		return self::$mail->SmtpConnect();
	}
	
	
	public static function smpt_close()
	{
		if(empty(self::$mail)) return false;
		self::$mail->SmtpClose();
	}
	
	
	public static function addr_append($type = '', $addr = '')
	{
		if(empty(self::$mail)) return false;
		if( ! is_string($type)) $type = '';
		if( ! is_string($addr)) $addr = '';
		
		return self::$mail->AddrAppend($type, $addr);
	}
	
	public static function addr_format($addr = '')
	{
		if(empty(self::$mail)) return false;
		if( ! is_string($addr)) $addr = '';
		return self::$mail->AddrFormat($addr);
	}

	
	public static function wrap_text($message = '', $length = 0, $qp_mode = false)
	{
		if(empty(self::$mail)) return false;
		if( ! is_string($message)) return false;		
		if( ! is_numeric($length)) $length = 0;
		if( ! is_bool($qp_mode)) $qp_mode = false;
		
		return self::$mail->WrapText($message, $length, $qp_mode);
	}
	
	public static function utf8_char_boundary($encode_text = '', $max_length = 0)
	{
		if(empty(self::$mail)) return false;
		if( ! is_string($encode_text)) return false;
		if( ! is_numeric($max_length)) $max_length = 0;
		return self::$mail->UTF8CharBoundary($encode_text, $max_length);
	}
	
	
	public static function set_word_wrap()
	{
		if(empty(self::$mail)) return false;
		return self::$mail->SetWordWrap();
	}
	
	
	public static function create_header()
	{
		if(empty(self::$mail)) return false;
		return self::$mail->CreateHeader();
	}
	
	
	public static function get_mail_mime()
	{
		if(empty(self::$mail)) return false;
		return self::$mail->GetMailMIME();
	}
	
	
	public static function get_sent_mime_message()
	{
		if(empty(self::$mail)) return false;
		return self::$mail->GetSentMIMEMessage();
	}
	
	
	public static function create_body()
	{
		if(empty(self::$mail)) return false;
		return self::$mail->CreateBody();
	}
	
	
	public static function heder_line($name = '', $value = '')
	{
		if(empty(self::$mail)) return false;
		if( ! is_string($name)) return false;
		if( ! is_string($value)) $value = '';
		return self::$mail->HeaderLine($name, $value);
	}
	
	
	public static function text_line($value = '')
	{
		if(empty(self::$mail)) return false;
		if( ! (is_string($value) || is_numeric($value))) return false;
		return self::$mail->TextLine($value);
	}
	
	
	public static function get_attachments()
	{
		if(empty(self::$mail)) return false;
		return self::$mail->GetAttachments();
	}
	
	
	public static function encode_string($str = '', $encoding = 'base64')
	{
		if(empty(self::$mail)) return false;
		if( ! is_string($str)) return false;
		if( ! is_string($encoding)) $encoding = 'base64';
		
		return self::$mail->EncodeString($str, $encoding);
	}
	
	
	public static function encode_header($str = '', $position = 'text')
	{
		if(empty(self::$mail)) return false;
		if( ! is_string($str)) return false;
		if( ! is_string($position)) $position = 'text';
		return self::$mail->EncodeHeader($str, $position);
	}
	
	
	public static function has_multi_bytes($str = '')
	{
		if(empty(self::$mail)) return false;
		if( ! is_string($str)) return false;
		return self::$mail->HasMultiBytes($str);
	}
	
	
	public static function base64_encode_wrap_mb($str = '', $lf = NULL)
	{
		if(empty(self::$mail)) return false;
		if( ! is_string($str)) return false;
		if( ! is_string($lf)) $lf = NULL;
		return self::$mail->Base64EncodeWrapMB($str, $lf);
	}
	
	
	public static function encode_qp_php($input = '', $line_max = 76, $space_conv = false)
	{
		if(empty(self::$mail)) return false;
		if( ! is_string($input)) return false;
		if( ! is_numeric($line_max)) $line_max = 76;
		if( ! is_bool($space_conv)) $space_conv = false;
		
		return self::$mail->EncodeQPphp($input, $line_max, $space_conv);
	}

	
	public static function encode_qp($string = '', $line_max = 76, $space_conv = false)
	{
		if(empty(self::$mail)) return false;
		if( ! is_string($string)) return false;
		if( ! is_numeric($line_max)) $line_max = 76;
		if( ! is_bool($space_conv)) $space_conv = false;
		return self::$mail->EncodeQP($string, $line_max, $space_conv);
	}

	
	public static function encode_q($str = '', $position = 'text')
	{
		if(empty(self::$mail)) return false;
		if( ! is_string($str)) return false;
		if( ! is_string($position)) $position = 'text';
		return self::$mail->EncodeQ($str, $position);
	}	

	
	public static function add_string_attachment($string = '', $filename = '', $encoding = 'base64', $type = 'application/octet-stream')
	{
		if(empty(self::$mail)) return false;
		if( ! is_string($string)) return false;
		if( ! is_string($filename)) $filename = '';
		if( ! is_string($encoding)) $encoding = 'base64';
		if( ! is_string($type)) $type = 'application/octet-stream';
		
		return self::$mail->AddStringAttachment($string, $filename, $encoding, $type);
	}

	
	public static function add_embedded_image($path = '', $cid = '', $name = '', $encoding = 'base64', $type = 'application/octet-stream')
	{
		if(empty(self::$mail)) return false;
		if( ! is_string($path)) return false;
		if( ! (is_string($cid) || is_numeric($cid))) return false;
		if( ! is_string($name)) $name = '';
		if( ! is_string($encoding)) $encoding = 'base64';
		if( ! is_string($type)) $type = 'application/octet-stream';
		return self::$mail->AddEmbeddedImage($path, $cid, $name, $encoding, $type);
	}

	
	public static function add_string_embedded_image($string = '', $cid = '', $name = '', $encoding = 'base64', $type = 'application/octet-stream')
	{
		if(empty(self::$mail)) return false;
		if( ! is_string($string)) return false;
		if( ! (is_string($cid) || is_numeric($cid))) return false;
		if( ! is_string($name)) $name = '';
		if( ! is_string($encoding)) $encoding = 'base64';
		if( ! is_string($type)) $type = 'application/octet-stream';
		return self::$mail->AddStringEmbeddedImage($string, $cid, $name, $encoding, $type);
	}
	
	
	public static function inline_image_exists()
	{
		if(empty(self::$mail)) return false;
		return self::$mail->InlineImageExists();
	}
	
	
	public static function attachment_exists()
	{
		if(empty(self::$mail)) return false;
		return self::$mail->AttachmentExists();
	}
	
	
	public static function alternative_exists()
	{
		if(empty(self::$mail)) return false;
		return self::$mail->AlternativeExists();
	}
	
	
	public static function clear_address()
	{
		if(empty(self::$mail)) return false;
		self::$mail->ClearAddresses();
	}
	
	
	public static function clear_cc()
	{
		if(empty(self::$mail)) return false;
		self::$mail->ClearCCs();
	}
	
	
	public static function clear_bcc()
	{
		if(empty(self::$mail)) return false;
		self::$mail->ClearBCCs();
	}
	
	
	public static function clear_reply_to()
	{
		if(empty(self::$mail)) return false;
		self::$mail->ClearReplyTos();
	}
	
	
	public static function clear_all_recipients()
	{
		if(empty(self::$mail)) return false;
		self::$mail->ClearAllRecipients();
	}
	
	
	public static function clear_attachments()
	{
		if(empty(self::$mail)) return false;
		self::$mail->ClearAttachments();
	}
	
	
	public static function clear_custom_headers()
	{
		if(empty(self::$mail)) return false;
		self::$mail->ClearCustomHeaders();
	}
	
	
	public static function rfc_date()
	{
		if(empty(self::$mail)) return false;
		return self::$mail->RFCDate();
	}
	
	
	public static function is_error()
	{
		if(empty(self::$mail)) return false;
		return self::$mail->IsError();
	}
	
	
	public static function fix_eol($str = '')
	{
		if(empty(self::$mail)) return false;
		if( ! is_string($str)) return false;
		return self::$mail->FixEOL($str);
	}
	
	
	public static function add_custom_header($name = '', $value = NULL)
	{
		if(empty(self::$mail)) return false;
		if( ! is_string($name)) return false;
		if( ! is_string($value)) $value = NULL;
		return self::$mail->AddCustomHeader($name = '', $value = '');
	}
	
	
	public static function msg_html($message = '', $basedir = '')
	{
		if(empty(self::$mail)) return false;
		if( ! is_string($message)) return false;
		if( ! is_string($basedir)) $basedir = '';
		return self::$mail->MsgHTML($message, $basedir);
	}
	
	
	public static function set($name = '', $value = '')
	{
		if(empty(self::$mail)) return false;
		if( ! is_string($name)) return false;
		if( ! is_string($value)) $value = '';
		return self::$mail->set($name, $value);
	}
	
	
	public static function secure_header($str = '')
	{
		if(empty(self::$mail)) return false;
		if( ! is_string($str)) return false;
		return self::$mail->SecureHeader($str);
	}
	
	
	public static function sign($cert_filename = '', $key_filename = '', $key_pass = '')
	{
		if(empty(self::$mail)) return false;
		if( ! is_string($cert_filename) || ! is_string($key_filename)) return false;
		if( ! is_string($key_pass)) $key_pass = '';
		
		return self::$mail->Sign($cert_filename, $key_filename, $key_pass);
	}
	
	
	public static function dkim_qp($txt = '')
	{
		if(empty(self::$mail)) return false;
		if( ! is_string($txt)) return false;
		return self::$mail->DKIM_QP($txt);
	}
	
	
	public static function dkim_sign($s = '')
	{
		if(empty(self::$mail)) return false;
		if( ! is_string($s)) return false;
		return self::$mail->DKIM_Sign($s);
	}
	
	
	public static function dkim_header_c($s = '')
	{
		if(empty(self::$mail)) return false;
		if( ! is_string($s)) return false;
		return self::$mail->DKIM_HeaderC($s);
	}
	
	
	public static function dkim_body_c($body = '')
	{
		if(empty(self::$mail)) return false;
		if( ! is_string($body)) return false;
		return self::$mail->DKIM_BodyC($body);
	}
	
	
	public static function dkim_add($headers_line = '', $subject = '', $body = '')
	{
		if(empty(self::$mail)) return false;
		if( ! (is_string($headers_line) || is_numeric($headers_line))) return false;
		if( ! is_string($subject)) $subject = '';
		if( ! is_string($body)) $body = '';
		return self::$mail->DKIM_Add($headers_line, $subject, $body);
	}
	
	
	public static function add_attachment($add_attachment = '', $add_attachment_file_name = '', $encoding = 'base64', $type = 'application/octet-stream')
	{
		if(empty(self::$mail)) return false;
		
		if( ! is_string($add_attachment_file_name)) $add_attachment_file_name = '';
		if( ! is_string($encoding)) $encoding = 'base64';
		if( ! is_string($type)) $type = 'application/octet-stream';
		
		if(isset($add_attachment))
		{
			if( ! is_array($add_attachment)) 
				self::$mail->AddAttachment($add_attachment, $add_attachment_file_name, $encoding, $type);
			else 
				foreach($add_attachment as $k => $v) 
					self::$mail->AddAttachment($k, $v);
		}
	}
	
	
	public static function send($subject = '', $message = '')
	{	
		if(empty(self::$mail)) return false;
		
		if( ! is_string($subject)) $subject = '';
		if( ! is_string($message)) $message = '';
		
		$genset = config::get('Email');	
		
		$from_email = (self::$from_email) 			? self::$from_email 			: $genset['username'];
		$from_name  = (self::$from_name)  			? self::$from_name  			: $genset['fromname'];
		$is_html	= (self::$settings['is_html']) 	? self::$settings['is_html'] 	: $genset['is_html'];
		$is_smtp	= (self::$settings['is_smtp'])  ? (self::$settings['is_smtp'])	: $genset['is_smtp'];
				
		if($is_smtp) 
			self::$mail->IsSMTP();  
			
		self::$mail->IsHTML($is_html);
		self::$mail->SetFrom($from_email, $from_name);                       		
		self::$mail->Subject = ($subject === '') ? self::$subject : $subject;
		self::$mail->Body = ($message === '') ? self::$message : $message;;
		
		if(self::$settings['smtp_auth'] || $genset['smtp_auth']) 
			self::$mail->SMTPAuth 	= (self::$settings['smtp_auth']) 	? self::$settings['smtp_auth'] 		: $genset['smtp_auth'];
		if(self::$settings['charset'] || $genset['charset']) 
			self::$mail->CharSet  	= (self::$settings['charset']) 		? self::$settings['charset'] 		: $genset['charset'];	
		if(self::$settings['host'] || $genset['host'])
			self::$mail->Host     	= (self::$settings['host']) 		? self::$settings['host'] 			: $genset['host'];
		if(self::$settings['port'] || $genset['port'])
			self::$mail->Port 		= (self::$settings['port']) 		? self::$settings['port'] 			: $genset['port']; 
		if(self::$settings['username'] || $genset['username'])
			self::$mail->Username 	= (self::$settings['username']) 	? self::$settings['username'] 		: $genset['username'];
		if(self::$settings['password'] || $genset['password'])
			self::$mail->Password 	= (self::$settings['password']) 	? self::$settings['password'] 		: $genset['password'];	
		if(self::$settings['smtp_secure'] || $genset['smtp_secure'])
			self::$mail->SMTPSecure 	= (self::$settings['smtp_secure']) 	? self::$settings['smtp_secure'] 	: $genset['smtp_secure'];
		if(self::$settings['priorty'] || $genset['priorty'])
			self::$mail->Priority		= (self::$settings['priorty']) 		? self::$settings['priorty']		: $genset['priorty'];
		if(self::$settings['content'] || $genset['content'])
			self::$mail->ContentType 	= (self::$settings['content']) 		? self::$settings['content'] 		: $genset['content'];
		if(self::$settings['encoding'] || $genset['encoding'])
			self::$mail->Encoding 	= (self::$settings['encoding']) 	? self::$settings['encoding']		: $genset['encoding'];
		if(self::$settings['sender'] || $genset['sender'])
			self::$mail->Sender		= (self::$settings['sender']) 		? self::$settings['sender']			: $genset['sender'];
		if(self::$settings['return_path'] || $genset['return_path'])
			self::$mail->ReturnPath	= (self::$settings['return_path'])	? self::$settings['return_path']	: $genset['return_path'];
		if(self::$settings['alt_body'] || $genset['alt_body'])
			self::$mail->AltBody		= (self::$settings['alt_body']) 	? self::$settings['alt_body']		: $genset['alt_body'];
		if(self::$settings['word_wrap'] || $genset['word_wrap'])
			self::$mail->WordWrap 	= (self::$settings['word_wrap']) 	? self::$settings['word_wrap']		: $genset['word_wrap'];		
		if(self::$settings['mailer'] || $genset['mailer'])
			self::$mail->Mailer		= (self::$settings['mailer'])	 	? self::$settings['mailer']			: $genset['mailer'];
		if(self::$settings['send_mail'] || $genset['send_mail'])
			self::$mail->Sendmail		= (self::$settings['send_mail'])  	? self::$settings['send_mail']		: $genset['send_mail'];
		if(self::$settings['use_send_mail_options'] || $genset['use_send_mail_options'])
			self::$mail->UseSendmailOptions = (self::$settings['use_send_mail_options']) ? self::$settings['use_send_mail_options'] : $genset['use_send_mail_options'];
		if(self::$settings['plugin_dir'] || $genset['plugin_dir'])
			self::$mail->PluginDir 	= (self::$settings['plugin_dir']) 	? self::$settings['plugin_dir']		: $genset['plugin_dir'];
		if(self::$settings['confirm_reading_to'] || $genset['confirm_reading_to'])
			self::$mail->ConfirmReadingTo = (self::$settings['confirm_reading_to']) ? self::$settings['confirm_reading_to'] : $genset['confirm_reading_to'];
		if(self::$settings['message_id'] || $genset['message_id'])
			self::$mail->MessageID 	= (self::$settings['message_id']) 	? self::$settings['message_id']		: $genset['message_id'];
		if(self::$settings['message_date'] || $genset['message_date'])
			self::$mail->MessageDate 	= (self::$settings['message_date']) ? self::$settings['message_date']	: $genset['message_date'];
		if(self::$settings['helo'] || $genset['helo'])
			self::$mail->Helo			= (self::$settings['helo']) 		? self::$settings['helo']			: $genset['helo'];
		if(self::$settings['realm'] || $genset['realm'])
			self::$mail->Realm		= (self::$settings['realm'])		? self::$settings['realm']			: $genset['realm'];
		if(self::$settings['work_station'] || $genset['work_station'])
			self::$mail->Workstation	= (self::$settings['work_station']) ? self::$settings['work_station']	: $genset['work_station'];
		if(self::$settings['timeout'] || $genset['timeout'])
			self::$mail->Timeout		= (self::$settings['timeout']) 		? self::$settings['timeout']		: $genset['timeout'];
		if(self::$settings['smtp_debug'] || $genset['smtp_debug'])
			self::$mail->SMTPDebug	= (self::$settings['smtp_debug']) 	? self::$settings['smtp_debug']		: $genset['smtp_debug'];
		if(self::$settings['debug_output'] || $genset['debug_output'])
			self::$mail->Debugoutput	= (self::$settings['debug_output']) ? self::$settings['debug_output'] 	: $genset['debug_output'];
		if(self::$settings['smtp_keep_alive'] || $genset['smtp_keep_alive'])
			self::$mail->SMTPKeepAlive = (self::$settings['smtp_keep_alive']) ? self::$settings['smtp_keep_alive'] : $genset['smtp_keep_alive'];
		if(self::$settings['single_to'] || $genset['single_to'])
			self::$mail->SingleTo		= (self::$settings['single_to']) 	? self::$settings['single_to']		: $genset['single_to'];
		if(! empty(self::$settings['single_to_array']) || ! empty($genset['single_to_array']))
			self::$mail->SingleToArray = ( ! empty(self::$settings['single_to_array'])) ? self::$settings['single_to_array'] : $genset['single_to_array'];
		if(self::$settings['le'] || $genset['le'])
			self::$mail->LE	= (self::$settings['le']) ? self::$settings['le'] 	: $genset['le'];
		if(self::$settings['dkim_selector'] || $genset['dkim_selector'])
			self::$mail->DKIM_selector = (self::$settings['dkim_selector']) ? self::$settings['dkim_selector']: $genset['dkim_selector'];
		if(self::$settings['dkim_identity'] || $genset['dkim_identity'])
			self::$mail->DKIM_identity = (self::$settings['dkim_identity']) ? self::$settings['dkim_identity']: $genset['dkim_identity'];
		if(self::$settings['dkim_pass_phrase'] || $genset['dkim_pass_phrase'])
			self::$mail->DKIM_passphrase = (self::$settings['dkim_pass_phrase']) ? self::$settings['dkim_pass_phrase'] : $genset['dkim_pass_phrase'];
		if(self::$settings['dkim_domain'] || $genset['dkim_domain'])
			self::$mail->DKIM_domain	= (self::$settings['dkim_domain'])	? self::$settings['dkim_domain']	: $genset['dkim_domain'];
		if(self::$settings['dkim_private'] || $genset['dkim_private'])
			self::$mail->DKIM_private = (self::$settings['dkim_private']) ? self::$settings['dkim_private']	: $genset['dkim_private'];
		if(self::$settings['action_function'] || $genset['action_function'])
			self::$mail->action_function = (self::$settings['action_function']) ? self::$settings['action_function'] : $genset['action_function'];
		if(self::$settings['version'] || $genset['version'])
			self::$mail->Version		= (self::$settings['version'])		? self::$settings['version']		: $genset['version'];
		if(self::$settings['xmailer'] || $genset['xmailer'])
			self::$mail->XMailer 		= (self::$settings['xmailer']) 		? self::$settings['xmailer']		: $genset['xmailer'];
		
		self::$detail = self::$mail;
		
		if(self::$mail->Send())
		{
			return true;
		}
		else
		{ 
			if(self::$mail->ErrorInfo) self::$error = lang(self::$mail->ErrorInfo);
			return false;
		}
	}
	
	public static function close()
	{
		if(isset(self::$mail))  	self::$mail = NULL;
		if(isset(self::$error)) 	self::$error = NULL;
		if(isset(self::$from_mail)) self::$from_mail = NULL;
		if(isset(self::$from_name)) self::$from_name = NULL;
		if(isset(self::$subject)) 	self::$subject = NULL;
		if(isset(self::$message)) 	self::$message = NULL;
		if(isset(self::$detail)) 	self::$detail = NULL;	
	}

}
