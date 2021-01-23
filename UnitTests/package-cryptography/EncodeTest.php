<?php namespace ZN\Crypto;

use Encode;
use Validator;

class EncodeTest extends \PHPUnit\Framework\TestCase
{
    public function testCreateKey()
    {
        $this->assertSame(10, strlen(Encode::create(10)));
    }

    public function testCreateKeyOnlyAlpha()
    {
        $this->assertTrue(Validator::alpha(Encode::create(10, 'alpha')));
    }

    public function testCreateKeyOnlyNumeric()
    {
        $this->assertTrue(Validator::numeric(Encode::create(10, 'numeric')));
    }

    public function testCreateKeyOnlySpecial()
    {
        $this->assertTrue((bool) preg_match('/\W/', Encode::create(10, 'special')));
    }

    public function testCreateGoldenKey()
    {
        $xkey = Encode::golden('Example Data', 'xkey');
        $ykey = Encode::golden('Example Data', 'ykey');

        $this->assertSame('c5c386872f7cdeabd560a0bb331d1ab7', $xkey);
        $this->assertSame('396e449bbf9ddc2929174dd105bcec23', $ykey);

    }

    public function testCreateSuperKey()
    {
        $this->assertIsString(Encode::golden('Example Data'));
    }

    public function testCreateKeyByAlgo()
    {
        $this->assertSame('82855e89f2a92981d1f5578816579742', Encode::type('Example Data', 'md5'));
        $this->assertSame('d848a9d8d6e8844cd69b1724cc6bd4cab631f94ceb65c5ded7f3e98009c41fd9', Encode::type('Example Data', 'gost'));
    }
}