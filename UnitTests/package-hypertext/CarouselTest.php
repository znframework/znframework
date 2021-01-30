<?php namespace ZN\Hypertext;

use Html;

class CarouselTest extends \PHPUnit\Framework\TestCase
{
    public function testCarousel()
    {
        $this->assertStringContainsString
        (
            '<div class="carousel-inner">', 
            (string) Html::item('slide1.jpg')->item('slide2.jpg')->carousel()
        );
    }

    public function testCarousel4()
    {
        $this->assertStringContainsString
        (
            '<div class="carousel-inner">', 
            (string) Html::item('slide1.jpg')->item('slide2.jpg')->carousel4()
        );
    }

    public function testCarouselIndicators()
    {
        $this->assertStringContainsString
        (
            '<ol class="carousel-indicators">', 
            (string) Html::indicators()->item('slide1.jpg')->item('slide2.jpg')->carousel('myCarousel')
        );
    }

    public function testCarouselPrevNext()
    {
        $this->assertStringContainsString
        (
            '<span class="sr-only">[next]</span>', 
            (string) Html::prev('[prev]')->next('[next]')->item('slide1.jpg')->carousel('myCarousel')
        );
    }

    public function testTransition()
    {
        $this->assertStringContainsString
        (
            '$(\'#myCarousel\').carousel("pause")', 
            (string) Html::transition('pause')->item('slide1.jpg')->item('slide2.jpg')->carousel('myCarousel') .
                     Html::activeCarouselOptions('myCarousel')
        );
    }
}