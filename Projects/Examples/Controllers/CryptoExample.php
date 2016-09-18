<?php namespace Project\Controllers;

use Crypto;

class CryptoExample extends Controller
{
    public function main(String $params = NULL)
    {
        $encrypt = Crypto::encrypt('Example Data');

        writeLine('Encrypt: '.$encrypt);

        $decrypt = Crypto::decrypt($encrypt);

        writeLine('Decrypt: '.$decrypt);

        $keygen  = Crypto::keygen(10);

        writeLine('Keygen: '.$keygen);

        $differentDriverKeygen = Crypto::driver('openssl')->keygen(10);

        writeLine('Openssl Keygen: '.$differentDriverKeygen);
    }
}
