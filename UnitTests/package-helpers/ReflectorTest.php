<?php namespace ZN\Helpers;

use Reflect;

/**
 * @encode      :Encode::super(1)
 * @jsonArray   [0,5,6]
 * @json        {"test":"deneme"}
 * @array       :['a' => 5]
 */
class ReflectorTest extends \PHPUnit\Framework\TestCase
{
    public function testClass()
    {
        $reflector = Reflect::annotation(__CLASS__);

        $this->assertSame('241ad2be621979fa47a8603475b9d988', $reflector->encode);
        $this->assertSame([0, 5, 6], $reflector->jsonArray);
        $this->assertSame('deneme', $reflector->json->test);
        $this->assertSame(['a' => 5], $reflector->array);
    }

    /**
     * @encode :Encode::super(1)
     */
    public function testMethod()
    {
        $reflector = Reflect::annotation(__CLASS__, 'testMethod');

        $this->assertSame('241ad2be621979fa47a8603475b9d988', $reflector->encode);
    }

    /**
     * @encode :Encode::super(1)
     */
    protected $property;

    public function testProperty()
    {
        $reflector = Reflect::annotation(__CLASS__, '$property');

        $this->assertSame('241ad2be621979fa47a8603475b9d988', $reflector->encode);
    }
}