<?php namespace ZN\Helpers;

use Reflect;

/**
 * @encode      :Encode::type(1, 'md5')
 * @jsonArray   [0,5,6]
 * @json        {"test":"deneme"}
 * @array       :['a' => 5]
 */
class ReflectorTest extends \PHPUnit\Framework\TestCase
{
    public function testClass()
    {
        $reflector = Reflect::annotation(__CLASS__);

        $this->assertSame('c4ca4238a0b923820dcc509a6f75849b', $reflector->encode);
        $this->assertSame([0, 5, 6], $reflector->jsonArray);
        $this->assertSame('deneme', $reflector->json->test);
        $this->assertSame(['a' => 5], $reflector->array);
    }

    /**
     * @encode :Encode::type(1, 'md5')
     */
    public function testMethod()
    {
        $reflector = Reflect::annotation(__CLASS__, 'testMethod');

        $this->assertSame('c4ca4238a0b923820dcc509a6f75849b', $reflector->encode);
    }

    /**
     * @encode :Encode::type(1, 'md5')
     */
    protected $property;

    public function testProperty()
    {
        $reflector = Reflect::annotation(__CLASS__, '$property');

        $this->assertSame('c4ca4238a0b923820dcc509a6f75849b', $reflector->encode);
    }
}