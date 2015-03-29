<?php
/************************************************************/
/*                      COOKIE(OTURUM)                      */
/************************************************************/
/*

Author: Ozan UYKUN
Site: http://www.zntr.net
Copyright 2012-2015 zntr.net - Tüm hakları saklıdır.

//--------------------------------------------------------------------------------------------------------------------------
SETTINGS
//--------------------------------------------------------------------------------------------------------------------------
1-encode
2-time
3-path
4-domain
5-secure
6-httponly
//--------------------------------------------------------------------------------------------------------------------------
/* ENCODE	*/
// İşlev: cookie değerlerini tutan anahtar ifadeler şifrelensin mi?
// true olması durumunda session bilgisini tutan anahtar ifadeler şifrelenir.
// false olması durumunda anahtar ifadeler şifrelenmez.
$config['Cookie']['encode'] = true;

/* TIME	*/
// İşlev:Çerez süresini ayarlamak için kullanılır.
// Parametre:Saniye cinsinden sayısal zaman değeri girilir.
// Örnek: 604800;
$config['Cookie']['time'] = 604800; // Integer / Numeric / String Numeric

/* PATH	*/
// İşlev:Çerez nesnelerinin hangi dizinde tutulacağını ayarlamak için kullanılır.
// Parametre:Metinsel yol bilgisi girilir.
// Örnek: '/';
$config['Cookie']['path'] = '/'; // String

/* DOMAIN	*/
// İşlev:Çerezlerin hangi domain adresiden geçerli olacağını belirlemek için kullanılır.
// Parametre:Domain yani site adresi girilir. Herhangi bir değer girilmez ise tüm adresler için geçerli kabul edilir.
// Örnek: 'http://www.zntr.net';
$config['Cookie']['domain'] = ''; // String

/* SECURE	*/
// İşlev:Çerezin istemciye güvenli bir HTTPS bağlantısı üzerinden mi aktarılması gerektiğini belirtmek için kullanılır.
// Parametre:True veya false değerlerini alan bir boolean veri bilgisi içerir.
// Örnek: true/false
$config['Cookie']['secure'] = false; // Boolean

/* HTTPONLY	*/
// İşlev:TRUE olduğu takdirde çerez sadece HTTP protokolü üzerinden erişilebilir olacaktır. Yani çerez, JavaScript gibi betik dilleri tarafından erişilebilir olmayacaktır. 
// Parametre:True veya false değerlerini alan bir boolean veri bilgisi içerir.
// Örnek: true/false
$config['Cookie']['httponly'] = true; // Boolean
//--------------------------------------------------------------------------------------------------------------------------
