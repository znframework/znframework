<?php
/************************************************************/
/*                            CURL                          */
/************************************************************/
/*

Author: Ozan UYKUN
Site: http://www.zntr.net
Copyright 2012-2015 zntr.net - Tüm hakları saklıdır.

//--------------------------------------------------------------------------------------------------------------------------
SETTINGS
//--------------------------------------------------------------------------------------------------------------------------
1-options
2-info
3-errors
//--------------------------------------------------------------------------------------------------------------------------

/* OPTIONS */
// İşlev:Curl ile kullanılan seçeneklerin yerini alacak yeni değerleri ayarlamak için kullanılır.
// Parametre:Anahtar değer içeren bir dizi bilgisi içerir. 
// Örnek: array('url' => CURLOPT_URL);
$config['Curl']['options'] = array( // Array

	'url' => CURLOPT_URL, // bir oturumu açmak için ya da değiştirmek için kullanılan adresi tutar
	'post_fields' => CURLOPT_POSTFIELDS, // bilgilerin gönderilmesini sağlıyor
	'header' => CURLOPT_HEADER, // 
	'referer' => CURLOPT_REFERER,
	'user_agent' => CURLOPT_USERAGENT,	
	'nobody' => CURLOPT_NOBODY,	
	'return_transfer' => CURLOPT_RETURNTRANSFER,	
	'timeout' => CURLOPT_TIMEOUT,
	'connection_timeout' => CURLOPT_CONNECTTIMEOUT,	
	'http_proxy_tunnel' => CURLOPT_HTTPPROXYTUNNEL,	
	'proxy_user_pwd' => CURLOPT_PROXYUSERPWD,	
	'proxy' => CURLOPT_PROXY,
	'post' => CURLOPT_POST,
	'ssl_verify_host' => CURLOPT_SSL_VERIFYHOST,
	'ssl_verify_peer' => CURLOPT_SSL_VERIFYPEER,
	'file' => CURLOPT_FILE	,
	'follow_location' => CURLOPT_FOLLOWLOCATION,
	'encoding' => CURLOPT_ENCODING,
	'auto_referer' => CURLOPT_AUTOREFERER,
	'maxredirs' => CURLOPT_MAXREDIRS,
	'verbose' => CURLOPT_VERBOSE,	
	'binary_tranfer' => CURLOPT_BINARYTRANSFER,
	'cookie_session' => CURLOPT_COOKIESESSION,
	'crlf' => CURLOPT_CRLF,
	'dns_use_global_cache' => CURLOPT_DNS_USE_GLOBAL_CACHE,
	'fail_on_error' => CURLOPT_FAILONERROR,
	'file_time' => CURLOPT_FILETIME,
	'forbid_reuse' => CURLOPT_FORBID_REUSE,
	'fresh_connect' => CURLOPT_FRESH_CONNECT,
	'ftp_use_eprt' => CURLOPT_FTP_USE_EPRT,
	'ftp_use_epsv' => CURLOPT_FTP_USE_EPSV,
	'ftp_append' => CURLOPT_FTPAPPEND,
	//'ftp_ascii' => CURLOPT_FTPASCII,
	'ftp_list_only' => CURLOPT_FTPLISTONLY,
	'http_get' => CURLOPT_HTTPGET,
	//'mute' => CURLOPT_MUTE,
	'netrc' => CURLOPT_NETRC,
	'no_progress' => CURLOPT_NOPROGRESS,
	'no_signal' => CURLOPT_NOSIGNAL,
	'put' => CURLOPT_PUT,
	'transfer_text' => CURLOPT_TRANSFERTEXT,
	'unrestricted_auth' => CURLOPT_UNRESTRICTED_AUTH,
	'upload' => CURLOPT_UPLOAD,
	'buffer_size' => CURLOPT_BUFFERSIZE,
	'close_policy' => CURLOPT_CLOSEPOLICY,
	//'connect_timeout_ms' => CURLOPT_CONNECTTIMEOUT_MS,
	'dns_cache_timeout' => CURLOPT_DNS_CACHE_TIMEOUT,
	'ftp_ssl_auth' => CURLOPT_FTPSSLAUTH,
	'http_version' => CURLOPT_HTTP_VERSION,
	'http_auth' => CURLOPT_HTTPAUTH,
	'in_file_size' => CURLOPT_INFILESIZE,
	'low_speed_limit' => CURLOPT_LOW_SPEED_LIMIT,
	'low_speed_time' => CURLOPT_LOW_SPEED_TIME,
	'max_connects' => CURLOPT_MAXCONNECTS,
	'port' => CURLOPT_PORT,
	//'protocols' => CURLOPT_PROTOCOLS,
	'proxy_auth' => CURLOPT_PROXYAUTH,
	'proxy_port' => CURLOPT_PROXYPORT,
	'proxy_type' => CURLOPT_PROXYTYPE,
	//'redir_protocols' => CURLOPT_REDIR_PROTOCOLS,
	'resume_from' => CURLOPT_RESUME_FROM,
	'ssl_version' => CURLOPT_SSLVERSION,
	'time_condition' => CURLOPT_TIMECONDITION,
	//'timeout_ms' => CURLOPT_TIMEOUT_MS,
	'time_value' => CURLOPT_TIMEVALUE,
	'cainfo' => CURLOPT_CAINFO,
	'capath' => CURLOPT_CAPATH,
	'cookie' => CURLOPT_COOKIE,
	'cookie_file' => CURLOPT_COOKIEFILE,
	'cookie_jar' => CURLOPT_COOKIEJAR,
	'custom_request' => CURLOPT_CUSTOMREQUEST,
	'egd_socket' => CURLOPT_EGDSOCKET,
	'ftp_port' => CURLOPT_FTPPORT,
	'interface' => CURLOPT_INTERFACE,
	'krb4_level' => CURLOPT_KRB4LEVEL,
	'random_file' => CURLOPT_RANDOM_FILE,
	'range' => CURLOPT_RANGE,
	'ssl_cipher_list' => CURLOPT_SSL_CIPHER_LIST,
	'ssl_cert' => CURLOPT_SSLCERT,
	'ssl_cert_passwd' => CURLOPT_SSLCERTPASSWD,
	'ssl_cert_type' => CURLOPT_SSLCERTTYPE,
	'ssl_engine' => CURLOPT_SSLENGINE,
	'ssl_engine_default' => CURLOPT_SSLENGINE_DEFAULT,
	'ssl_key' => CURLOPT_SSLKEY,
	'ssl_key_passwd' => CURLOPT_SSLKEYPASSWD,
	'ssl_key_type' => CURLOPT_SSLKEYTYPE,
	'user_pwd' => CURLOPT_USERPWD,
	'http_200_aliases' => CURLOPT_HTTP200ALIASES,
	'http_header' => CURLOPT_HTTPHEADER,
	'post_quote' => CURLOPT_POSTQUOTE,
	'quote' => CURLOPT_QUOTE,
	'in_file' => CURLOPT_INFILE,
	'stderr' => CURLOPT_STDERR,
	'write_header' => CURLOPT_WRITEHEADER,
	'header_function' => CURLOPT_HEADERFUNCTION,
	//'passwd_function' => CURLOPT_PASSWDFUNCTION,
	//'progress_function' => CURLOPT_PROGRESSFUNCTION,
	'read_function' => CURLOPT_READFUNCTION,
	'write_function' => CURLOPT_WRITEFUNCTION

);

/* INFO */
// İşlev:Curl işlemleri hakkında bilgi almak için kullanılan parametreleri kısaltmak için kullanılır.
// Parametre:Anahtar değer içeren bir dizi bilgisi içerir. 
// Örnek: array('speed_download' => CURLINFO_SPEED_DOWNLOAD);
$config['Curl']['info'] = array(

	'speed_download' => CURLINFO_SPEED_DOWNLOAD,
	'effective_url' => CURLINFO_EFFECTIVE_URL,
	'http_code' => CURLINFO_HTTP_CODE,
	'file_time' => CURLINFO_FILETIME,
	'total_time' => CURLINFO_TOTAL_TIME,
	'name_lookup_time' => CURLINFO_NAMELOOKUP_TIME,
	'connect_time' => CURLINFO_CONNECT_TIME,
	'pre_transfer_time' => CURLINFO_PRETRANSFER_TIME,
	'start_transfer_time' => CURLINFO_STARTTRANSFER_TIME,
	'redirect_count' => CURLINFO_REDIRECT_COUNT,
	'redirect_time' => CURLINFO_REDIRECT_TIME,
	'redirect_url' => CURLINFO_REDIRECT_URL ,
	'primary_ip' => CURLINFO_PRIMARY_IP,
	'primary_port' => CURLINFO_PRIMARY_PORT ,
	'local_ip' => CURLINFO_LOCAL_IP,
	'local_port' => CURLINFO_LOCAL_PORT,
	'size_upload' => CURLINFO_SIZE_UPLOAD,
	'size_download' => CURLINFO_SIZE_DOWNLOAD,
	'speed_upload' => CURLINFO_SPEED_UPLOAD,
	'header_size' => CURLINFO_HEADER_SIZE,
	'header_out' => CURLINFO_HEADER_OUT,
	'request_size' => CURLINFO_REQUEST_SIZE,
	'ssl_verify_result' => CURLINFO_SSL_VERIFYRESULT,
	'content_length_download' => CURLINFO_CONTENT_LENGTH_DOWNLOAD,
	'content_length_upload' => CURLINFO_CONTENT_LENGTH_UPLOAD,
	'content_type' => CURLINFO_CONTENT_TYPE,
	'private' => CURLINFO_PRIVATE
);

/* ERRORS */
// İşlev:Curl işlemleri sırasında oluşan hataların ne olduklarını öğrenmek için kullanılır.
// Parametre:Anahtar değer içeren bir dizi bilgisi içerir. 
// Örnek: array(1 => 'CURLE_UNSUPPORTED_PROTOCOL');
$config['Curl']['errors'] = array(

	0 => CURLE_OK,
	1 => 'CURLE_UNSUPPORTED_PROTOCOL', 
	2 => 'CURLE_FAILED_INIT', 
	3 => 'CURLE_URL_MALFORMAT', 
	4 => 'CURLE_URL_MALFORMAT_USER', 
	5 => 'CURLE_COULDNT_RESOLVE_PROXY', 
	6 => 'CURLE_COULDNT_RESOLVE_HOST', 
	7 => 'CURLE_COULDNT_CONNECT', 
	8 => 'CURLE_FTP_WEIRD_SERVER_REPLY',
	9 => 'CURLE_REMOTE_ACCESS_DENIED',
	11 => 'CURLE_FTP_WEIRD_PASS_REPLY',
	13 => 'CURLE_FTP_WEIRD_PASV_REPLY',
	14 => 'CURLE_FTP_WEIRD_227_FORMAT',
	15 => 'CURLE_FTP_CANT_GET_HOST',
	17 => 'CURLE_FTP_COULDNT_SET_TYPE',
	18 => 'CURLE_PARTIAL_FILE',
	19 => 'CURLE_FTP_COULDNT_RETR_FILE',
	21 => 'CURLE_QUOTE_ERROR',
	22 => 'CURLE_HTTP_RETURNED_ERROR',
	23 => 'CURLE_WRITE_ERROR',
	25 => 'CURLE_UPLOAD_FAILED',
	26 => 'CURLE_READ_ERROR',
	27 => 'CURLE_OUT_OF_MEMORY',
	28 => 'CURLE_OPERATION_TIMEDOUT',
	30 => 'CURLE_FTP_PORT_FAILED',
	31 => 'CURLE_FTP_COULDNT_USE_REST',
	33 => 'CURLE_RANGE_ERROR',
	34 => 'CURLE_HTTP_POST_ERROR',
	35 => 'CURLE_SSL_CONNECT_ERROR',
	36 => 'CURLE_BAD_DOWNLOAD_RESUME',
	37 => 'CURLE_FILE_COULDNT_READ_FILE',
	38 => 'CURLE_LDAP_CANNOT_BIND',
	39 => 'CURLE_LDAP_SEARCH_FAILED',
	41 => 'CURLE_FUNCTION_NOT_FOUND',
	42 => 'CURLE_ABORTED_BY_CALLBACK',
	43 => 'CURLE_BAD_FUNCTION_ARGUMENT',
	45 => 'CURLE_INTERFACE_FAILED',
	47 => 'CURLE_TOO_MANY_REDIRECTS',
	48 => 'CURLE_UNKNOWN_TELNET_OPTION',
	49 => 'CURLE_TELNET_OPTION_SYNTAX',
	51 => 'CURLE_PEER_FAILED_VERIFICATION',
	52 => 'CURLE_GOT_NOTHING',
	53 => 'CURLE_SSL_ENGINE_NOTFOUND',
	54 => 'CURLE_SSL_ENGINE_SETFAILED',
	55 => 'CURLE_SEND_ERROR',
	56 => 'CURLE_RECV_ERROR',
	58 => 'CURLE_SSL_CERTPROBLEM',
	59 => 'CURLE_SSL_CIPHER',
	60 => 'CURLE_SSL_CACERT',
	61 => 'CURLE_BAD_CONTENT_ENCODING',
	62 => 'CURLE_LDAP_INVALID_URL',
	63 => 'CURLE_FILESIZE_EXCEEDED',
	64 => 'CURLE_USE_SSL_FAILED',
	65 => 'CURLE_SEND_FAIL_REWIND',
	66 => 'CURLE_SSL_ENGINE_INITFAILED',
	67 => 'CURLE_LOGIN_DENIED',
	68 => 'CURLE_TFTP_NOTFOUND',
	69 => 'CURLE_TFTP_PERM',
	70 => 'CURLE_REMOTE_DISK_FULL',
	71 => 'CURLE_TFTP_ILLEGAL',
	72 => 'CURLE_TFTP_UNKNOWNID',
	73 => 'CURLE_REMOTE_FILE_EXISTS',
	74 => 'CURLE_TFTP_NOSUCHUSER',
	75 => 'CURLE_CONV_FAILED',
	76 => 'CURLE_CONV_REQD',
	77 => 'CURLE_SSL_CACERT_BADFILE',
	78 => 'CURLE_REMOTE_FILE_NOT_FOUND',
	79 => 'CURLE_SSH',
	80 => 'CURLE_SSL_SHUTDOWN_FAILED',
	81 => 'CURLE_AGAIN',
	82 => 'CURLE_SSL_CRL_BADFILE',
	83 => 'CURLE_SSL_ISSUER_ERROR',
	84 => 'CURLE_FTP_PRET_FAILED',
	84 => 'CURLE_FTP_PRET_FAILED',
	85 => 'CURLE_RTSP_CSEQ_ERROR',
	86 => 'CURLE_RTSP_SESSION_ERROR',
	87 => 'CURLE_FTP_BAD_FILE_LIST',
	88 => 'CURLE_CHUNK_FAILED'
);
//--------------------------------------------------------------------------------------------------------------------------