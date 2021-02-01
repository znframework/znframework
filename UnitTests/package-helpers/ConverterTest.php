<?php namespace ZN\Helpers;

use Converter;

class ConverterTest extends \PHPUnit\Framework\TestCase
{
    public function testByte()
    {
        $this->assertSame('976.56KB', Converter::byte(1000000, 2));
        $this->assertSame('976.6', Converter::byte(1000000, 1, false));
        $this->assertSame('976.56 KB', Converter::byte(1000000, 2, true, ' '));
    }

    public function testToBytes()
    {
        $this->assertSame(1024, (int) Converter::toBytes('1KB'));
    
    }

    public function testMoney()
    {
        $this->assertSame('1.000.000,00 £', Converter::money(1000000, '£'));
        $this->assertSame('1.000.000 $', Converter::money(1000000, '$', false));
        $this->assertSame('£ 1.000.000,00', Converter::money(1000000, '!£'));
    }

    public function testMoneyToNumber()
    {
        $this->assertSame(1000000, (int) Converter::moneyToNumber('1.000.000'));
    }

    public function testTime()
    {
        $this->assertSame(2, (int) Converter::time(120, 'second', 'minute'));
        $this->assertSame(4, (int) Converter::time(120, 'day', 'month'));
        $this->assertSame(1, (int) Converter::time(12, 'month', 'year'));
    }

    public function testSlug()
    {
        $this->assertSame('example-file.php', Converter::slug('Example File.php', true));
        $this->assertSame('example-file-php', Converter::slug('Example File.php'));
    }

    public function testWord()
    {
        $this->assertSame('Hi, [badwords] Guys', Converter::word('Hi, ? Guys', '?'));
        $this->assertSame('Hi[badwords] [badwords] Guys', Converter::word('Hi, ? Guys', [',', '?']));
        $this->assertSame('Hix y Guys', Converter::word('Hi, ? Guys', [',', '?'], ['x', 'y'])); 
    }

    public function testAnchor()
    {
        $this->assertSame
        ( 
            '<a href="https://www.znframework.com" id="convert">znframework</a>',
            Converter::anchor('https://www.znframework.com', 'short', ['id' => 'convert']) 
        );
        $this->assertSame
        ( 
            '<a href="https://www.znframework.com" id="convert">https://www.znframework.com</a>',
            Converter::anchor('https://www.znframework.com', 'long', ['id' => 'convert']) 
        );
    }

    public function testChar()
    {
        $this->assertSame
        (
            '69 120 97 109 112 108 101  68 97 116 97',
            Converter::char('Example Data', 'char', 'dec') 
        );
        $this->assertSame
        ( 
            '45 78 61 6D 70 6C 65  44 61 74 61',
            Converter::char('Example Data', 'char', 'hex') 
        );
    }

    public function testAccent()
    {
        $this->assertSame('Accent', Converter::accent('Åççeňt'));
    }

    public function testCharset()
    {
        $this->assertSame('ﾃ?ﾃｧﾃｧeﾅ?t', Converter::charset('Åççeňt', 'UTF-8', 'JIS'));
    }

    public function testToString()
    {
        $this->assertSame('Z N', Converter::toString(['Z', 'N']));
    }

    public function testToConstant()
    {
        $this->assertSame(PHP_VERSION, Converter::toConstant('phpVersion') );
        $this->assertSame(PHP_VERSION, Converter::toConstant('php', '', '_VERSION') );
        $this->assertSame(PHP_VERSION, Converter::toConstant('version', 'php_') );
        $this->assertSame(PHP_VERSION, Converter::toConstant('PHP_VERSION') );
        $this->assertSame(PHP_VERSION, Converter::toConstant('VERSION', 'PHP_') );
        $this->assertSame(PHP_VERSION, Converter::toConstant('VER', 'PHP_', 'SION') ); 
    }
}