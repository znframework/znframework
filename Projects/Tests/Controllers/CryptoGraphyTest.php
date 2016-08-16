<?php class CryptoGraphyTest extends Controller
{
    public function crypto()
    {
        writeLine(Crypto::driver('mcrypt')->encrypt('Şifre'));
        writeLine(Crypto::driver('openssl')->encrypt('Şifre'));
        writeLine(Crypto::decrypt(Crypto::encrypt('Şifreli Veri')));
        writeLine(Crypto::driver('hash')->keygen(10));
        writeLine(Crypto::driver('mhash')->keygen(10));
        writeLine(Crypto::driver('phash')->keygen(10));
    }

    public function encode()
    {
        writeLine(Encode::create(6));
        writeLine(Encode::golden('veriyi şifrele','£>#$^'));
        writeLine(Encode::super('veriyi şifrele'));
        writeLine(Encode::type('Metin')); 
        writeLine(Encode::type('Metin' , 'sha1')); 
    }
}