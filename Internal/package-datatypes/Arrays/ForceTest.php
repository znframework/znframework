<?php namespace ZN\DataTypes\Arrays;

use Arrays;

class ForceTest extends \PHPUnit\Framework\TestCase
{
    public function testForce()
    {
        $array = Arrays::force(['foo', 'bar'], function($keyval)
        {
            return $keyval . '+';
        });

        $this->assertSame(['0+' => 'foo+', '1+' => 'bar+'], $array);
    }

    public function testForceKeys()
    {
        $array = Arrays::forceKeys(['foo', 'bar'], function($key)
        {
            return $key . '+';
        });

        $this->assertSame(['0+' => 'foo', '1+' => 'bar'], $array);
    }

    public function testForceValues()
    {
        $array = Arrays::forceValues(['foo', 'bar'], function($key)
        {
            return $key . '+';
        });

        $this->assertSame(['foo+', 'bar+'], $array);
    }
}