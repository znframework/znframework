<?php namespace ZN\Crypto;

use Crypto;

class CryptoTest extends \PHPUnit\Framework\TestCase
{
    public function testEncrypt()
    {
        $encrypt = Crypto::encrypt('Example');

        $this->assertIsString($encrypt);
    } 

    public function testDecrypt()
    {
        $encrypt = Crypto::encrypt('Example');

        $decrypt = Crypto::decrypt($encrypt);

        $this->assertSame('Example', $decrypt);
    }

    public function testAES128()
    {
        $encrypt = Crypto::encrypt('Example', 'aes-128-cbc');

        $decrypt = Crypto::decrypt($encrypt, 'aes-128-cbc');

        $this->assertTrue('Example' === $decrypt);

        $encrypt = Crypto::encrypt('Example', 'aes-256-cbc');

        $decrypt = Crypto::decrypt($encrypt, 'aes-128-cbc');

        $this->assertFalse('Example' === $decrypt);
    }

    public function testAES128WithKey()
    {
        $encrypt = Crypto::encrypt('Example', ['cipher' => 'aes-128', 'key' => 'myKey']);

        $decrypt = Crypto::decrypt($encrypt, ['cipher' => 'aes-128', 'key' => 'myKey']);

        $this->assertTrue('Example' === $decrypt);
    }

    public function testAES128WithKeyAndVector()
    {
        $encrypt = Crypto::encrypt('Example', ['cipher' => 'aes-128', 'key' => 'myKey', 'vector' => 16]);

        $decrypt = Crypto::decrypt($encrypt, ['cipher' => 'aes-128', 'key' => 'myKey', 'vector' => 16]);

        $this->assertTrue('Example' === $decrypt);
    }

    public function testKeygen()
    {
        $this->assertSame(10, strlen(Crypto::keygen(10)));
    }
}