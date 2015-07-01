<?php
/************************************************************/
/*                            CURL                          */
/************************************************************/
/*

Author: Ozan UYKUN
Site: http://www.zntr.net
Copyright 2012-2015 zntr.net - Tüm hakları saklıdır.

/******************************************************************************************
* CURL                                                                           	  	  *
*******************************************************************************************
| Genel Kullanım: Curl işlemleri için kullanılabilir seçenekler yer almaktadır.       	  |
******************************************************************************************/

/******************************************************************************************
* OPTIONS                                                                           	  *
*******************************************************************************************
| Genel Kullanım: Curl ile kullanılan seçeneklerin yerini alacak yeni değerleri ayarlamak |
| için kullanılır. Parametre:Anahtar değer içeren bir dizi bilgisi içerir. 				  |
| Örnek: array('url' => CURLOPT_URL);								                      |
******************************************************************************************/
$config['Curl']['options'] = array( // Array

	'url' 					=> CURLOPT_URL,
	'postFields' 			=> CURLOPT_POSTFIELDS,
	'header' 				=> CURLOPT_HEADER, // 
	'referer' 				=> CURLOPT_REFERER,
	'userAgent' 			=> CURLOPT_USERAGENT,	
	'nobody' 				=> CURLOPT_NOBODY,	
	'returnTransfer' 		=> CURLOPT_RETURNTRANSFER,	
	'timeout' 				=> CURLOPT_TIMEOUT,
	'connectionTimeout' 	=> CURLOPT_CONNECTTIMEOUT,	
	'httpProxyTunnel' 		=> CURLOPT_HTTPPROXYTUNNEL,	
	'proxyUserPwd' 			=> CURLOPT_PROXYUSERPWD,	
	'proxy' 				=> CURLOPT_PROXY,
	'post' 					=> CURLOPT_POST,
	'sslVerifyHost' 		=> CURLOPT_SSL_VERIFYHOST,
	'sslVerifyPeer' 		=> CURLOPT_SSL_VERIFYPEER,
	'file' 					=> CURLOPT_FILE	,
	'followLocation' 		=> CURLOPT_FOLLOWLOCATION,
	'encoding' 				=> CURLOPT_ENCODING,
	'autoReferer' 			=> CURLOPT_AUTOREFERER,
	'maxredirs' 			=> CURLOPT_MAXREDIRS,
	'verbose' 				=> CURLOPT_VERBOSE,	
	'binaryTranfer' 		=> CURLOPT_BINARYTRANSFER,
	'cookieSession' 		=> CURLOPT_COOKIESESSION,
	'crlf' 					=> CURLOPT_CRLF,
	'dnsUseGlobalCache' 	=> CURLOPT_DNS_USE_GLOBAL_CACHE,
	'failOnError' 			=> CURLOPT_FAILONERROR,
	'fileTime' 				=> CURLOPT_FILETIME,
	'forbidReuse' 			=> CURLOPT_FORBID_REUSE,
	'freshConnect' 			=> CURLOPT_FRESH_CONNECT,
	'ftpUseEprt' 			=> CURLOPT_FTP_USE_EPRT,
	'ftpUseEpsv' 			=> CURLOPT_FTP_USE_EPSV,
	'ftpAppend' 			=> CURLOPT_FTPAPPEND,
	//'ftpAscii' 			=> CURLOPT_FTPASCII,
	'ftpListOnly'			=> CURLOPT_FTPLISTONLY,
	'httpGet' 				=> CURLOPT_HTTPGET,
	//'mute' 				=> CURLOPT_MUTE,
	'netrc' 				=> CURLOPT_NETRC,
	'noProgress' 			=> CURLOPT_NOPROGRESS,
	'noSignal' 				=> CURLOPT_NOSIGNAL,
	'put' 					=> CURLOPT_PUT,
	'transferText' 			=> CURLOPT_TRANSFERTEXT,
	'unrestrictedAuth' 		=> CURLOPT_UNRESTRICTED_AUTH,
	'upload' 				=> CURLOPT_UPLOAD,
	'bufferSize' 			=> CURLOPT_BUFFERSIZE,
	'closePolicy' 			=> CURLOPT_CLOSEPOLICY,
	//'connectTimeoutMs' 	=> CURLOPT_CONNECTTIMEOUT_MS,
	'dnsCacheTimeout' 		=> CURLOPT_DNS_CACHE_TIMEOUT,
	'ftpSslAuth' 			=> CURLOPT_FTPSSLAUTH,
	'httpVersion' 			=> CURLOPT_HTTP_VERSION,
	'httpAuth' 				=> CURLOPT_HTTPAUTH,
	'inFileSize' 			=> CURLOPT_INFILESIZE,
	'lowSpeedLimit' 		=> CURLOPT_LOW_SPEED_LIMIT,
	'lowSpeedTime' 			=> CURLOPT_LOW_SPEED_TIME,
	'maxConnects'			=> CURLOPT_MAXCONNECTS,
	'port' 					=> CURLOPT_PORT,
	//'protocols' 			=> CURLOPT_PROTOCOLS,
	'proxyAuth' 			=> CURLOPT_PROXYAUTH,
	'proxyPort' 			=> CURLOPT_PROXYPORT,
	'proxyType' 			=> CURLOPT_PROXYTYPE,
	//'redirProtocols' 		=> CURLOPT_REDIR_PROTOCOLS,
	'resumeFrom' 			=> CURLOPT_RESUME_FROM,
	'sslVersion' 			=> CURLOPT_SSLVERSION,
	'timeCondition' 		=> CURLOPT_TIMECONDITION,
	//'timeoutMs' 			=> CURLOPT_TIMEOUT_MS,
	'timeValue' 			=> CURLOPT_TIMEVALUE,
	'cainfo' 				=> CURLOPT_CAINFO,
	'capath' 				=> CURLOPT_CAPATH,
	'cookie' 				=> CURLOPT_COOKIE,
	'cookieFile' 			=> CURLOPT_COOKIEFILE,
	'cookieJar' 			=> CURLOPT_COOKIEJAR,
	'customRequest' 		=> CURLOPT_CUSTOMREQUEST,
	'egdSocket' 			=> CURLOPT_EGDSOCKET,
	'ftpPort' 				=> CURLOPT_FTPPORT,
	'interface' 			=> CURLOPT_INTERFACE,
	'krb4Level' 			=> CURLOPT_KRB4LEVEL,
	'randomFile' 			=> CURLOPT_RANDOM_FILE,
	'range' 				=> CURLOPT_RANGE,
	'sslCipherList' 		=> CURLOPT_SSL_CIPHER_LIST,
	'sslCert' 				=> CURLOPT_SSLCERT,
	'sslCertPasswd' 		=> CURLOPT_SSLCERTPASSWD,
	'sslCertType' 			=> CURLOPT_SSLCERTTYPE,
	'sslEngine' 			=> CURLOPT_SSLENGINE,
	'sslEngineDefault' 		=> CURLOPT_SSLENGINE_DEFAULT,
	'sslKey' 				=> CURLOPT_SSLKEY,
	'sslKeyPasswd' 			=> CURLOPT_SSLKEYPASSWD,
	'sslKeyType' 			=> CURLOPT_SSLKEYTYPE,
	'userPwd' 				=> CURLOPT_USERPWD,
	'http200Aliases' 		=> CURLOPT_HTTP200ALIASES,
	'httpHeader' 			=> CURLOPT_HTTPHEADER,
	'postQuote' 			=> CURLOPT_POSTQUOTE,
	'quote'					=> CURLOPT_QUOTE,
	'inFile' 				=> CURLOPT_INFILE,
	'stderr' 				=> CURLOPT_STDERR,
	'writeHeader' 			=> CURLOPT_WRITEHEADER,
	'headerFunction' 		=> CURLOPT_HEADERFUNCTION,
	//'passwdFunction' 		=> CURLOPT_PASSWDFUNCTION,
	//'progressFunction' 	=> CURLOPT_PROGRESSFUNCTION,
	'readFunction' 			=> CURLOPT_READFUNCTION,
	'writeFunction' 		=> CURLOPT_WRITEFUNCTION

);

/******************************************************************************************
* INFO                                                                               	  *
*******************************************************************************************
| Genel Kullanım: Curl işlemleri hakkında bilgi almak için kullanılan parametreleri 	  |
| kısaltmak için kullanılır. Parametre:Anahtar değer içeren bir dizi bilgisi içerir. 	  |
| Örnek: array('speed_download' => CURLINFO_SPEED_DOWNLOAD);							  |
******************************************************************************************/
$config['Curl']['infos'] = array(

	'speedDownload' 		=> CURLINFO_SPEED_DOWNLOAD,
	'effectiveUrl' 			=> CURLINFO_EFFECTIVE_URL,
	'httpCode' 				=> CURLINFO_HTTP_CODE,
	'fileTime' 				=> CURLINFO_FILETIME,
	'totalTime' 			=> CURLINFO_TOTAL_TIME,
	'nameLookupTime' 		=> CURLINFO_NAMELOOKUP_TIME,
	'connectTime' 			=> CURLINFO_CONNECT_TIME,
	'preTransferTime' 		=> CURLINFO_PRETRANSFER_TIME,
	'startTransferTime' 	=> CURLINFO_STARTTRANSFER_TIME,
	'redirectCount' 		=> CURLINFO_REDIRECT_COUNT,
	'redirectTime' 			=> CURLINFO_REDIRECT_TIME,
	'redirectUrl' 			=> CURLINFO_REDIRECT_URL ,
	'primaryIp' 			=> CURLINFO_PRIMARY_IP,
	'primaryPort'			=> CURLINFO_PRIMARY_PORT ,
	'localIp' 				=> CURLINFO_LOCAL_IP,
	'localPort' 			=> CURLINFO_LOCAL_PORT,
	'sizeUpload' 			=> CURLINFO_SIZE_UPLOAD,
	'sizeDownload' 			=> CURLINFO_SIZE_DOWNLOAD,
	'speedUpload' 			=> CURLINFO_SPEED_UPLOAD,
	'headerSize' 			=> CURLINFO_HEADER_SIZE,
	'headerOut' 			=> CURLINFO_HEADER_OUT,
	'requestSize' 			=> CURLINFO_REQUEST_SIZE,
	'sslVerifyResult' 		=> CURLINFO_SSL_VERIFYRESULT,
	'contentLengthDownload' => CURLINFO_CONTENT_LENGTH_DOWNLOAD,
	'contentLengthUpload'	=> CURLINFO_CONTENT_LENGTH_UPLOAD,
	'contentType' 			=> CURLINFO_CONTENT_TYPE,
	'private' 				=> CURLINFO_PRIVATE
);

/******************************************************************************************
* ERRORS                                                                               	  *
*******************************************************************************************
| Genel Kullanım: Curl işlemleri sırasında oluşan hataların ne olduklarını öğrenmek 	  |
| için kullanılır. Parametre:Anahtar değer içeren bir dizi bilgisi içerir. 			      |
| Örnek: array(1 => 'CURLE_UNSUPPORTED_PROTOCOL');						                  |
******************************************************************************************/	
$config['Curl']['errors'] = array(

	0  => CURLE_OK,
	1  => 'CURLE_UNSUPPORTED_PROTOCOL', 
	2  => 'CURLE_FAILED_INIT', 
	3  => 'CURLE_URL_MALFORMAT', 
	4  => 'CURLE_URL_MALFORMAT_USER', 
	5  => 'CURLE_COULDNT_RESOLVE_PROXY', 
	6  => 'CURLE_COULDNT_RESOLVE_HOST', 
	7  => 'CURLE_COULDNT_CONNECT', 
	8  => 'CURLE_FTP_WEIRD_SERVER_REPLY',
	9  => 'CURLE_REMOTE_ACCESS_DENIED',
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