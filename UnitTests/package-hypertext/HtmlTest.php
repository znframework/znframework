<?php namespace ZN\Hypertext;

use Html;

class HtmlTest extends \PHPUnit\Framework\TestCase
{
    public function testAnchor()
    {
        $this->assertStringContainsString
        (
            '<a href="https://example.xxx">Example</a>', 
            (string) Html::anchor('https://example.xxx', 'Example')
        );

        $this->assertStringContainsString
        (
            '<a href="javascript:void(0);">Edit</a>', 
            (string) Html::anchor(':void', 'Edit')
        );
    }

    public function testButton()
    {
        $this->assertStringContainsString
        (
            '<button onclick="ajaxFunc()" type="button">Send</button>', 
            (string) Html::onclick('ajaxFunc()')->button('Send')
        );
    }

    public function testImage()
    {
        $this->assertStringContainsString
        (
            'width="200" height="200" title="" alt=""', 
            (string) Html::image('image/example.jpg', 200, 200)
        );
    }

    public function testHeading()
    {
        $this->assertStringContainsString
        (
            '<h2 id="example">Data</h2>', 
            (string) Html::heading('Data', 2, ['id' => 'example'])
        );
    }

    public function testFont()
    {
        $this->assertStringContainsString
        (
            '<font size="9" color="red" face="tahoma">Data</font>', 
            (string) Html::font('Data', 9, 'red', 'tahoma')
        );
    }

    public function testParag()
    {
        $this->assertStringContainsString
        (
            '<p style="color:red">Metin</p>', 
            (string) Html::parag('Metin', ['style' => 'color:red'])
        );
    }

    public function testStrong()
    {
        $this->assertStringContainsString
        (
            '<strong>Data</strong>', 
            (string) Html::strong('Data')
        );
    }

    public function testItalic()
    {
        $this->assertStringContainsString
        (
            '<em>Data</em>', 
            (string) Html::italic('Data')
        );
    }

    public function testUnderline()
    {
        $this->assertStringContainsString
        (
            '<u>Data</u>', 
            (string) Html::underline('Data')
        );
    }

    public function testOverline()
    {
        $this->assertStringContainsString
        (
            '<del>Data</del>', 
            (string) Html::overline('Data')
        );
    }

    public function testUndertext()
    {
        $this->assertStringContainsString
        (
            '10<sub>2</sub>', 
            '10' . Html::undertext('2')
        );
    }

    public function testOvertext()
    {
        $this->assertStringContainsString
        (
            '10<sup>2</sup>', 
            '10' . Html::overtext('2')
        );
    }

    public function testMailto()
    {
        $this->assertStringContainsString
        (
            '<a href="mailto:robot@znframework.com">Robot</a>', 
            (string) Html::mailTo('robot@znframework.com', 'Robot')
        );
    }

    public function testTable()
    {
        $this->assertStringContainsString
        (
            '<table border="1" bordercolor="red">', 
            (string) Html::table()
            ->border(1)
            ->borderColor('red')
            ->create
            (
                [1, 2, 3, 4],
                ['a', 'b' => ['colspan' => 3]]
            )
        );
    }

    public function testUl()
    {
        $this->assertStringContainsString
        (
            '<ul class="example"><li>Value1</li><li>Value2</li></ul>', 
            (string) Html::class('example')->ul(function($list){
    
                echo $list->li('Value1');
                echo $list->li('Value2');
            })
        );
    }

    public function testLabel()
    {
        $this->assertStringContainsString
        (
            '<label for="checkBoxId">Do you like peas?</label>', 
            (string) Html::label('checkBoxId', 'Do you like peas?')
        );
    }

    public function testMeta()
    {
        $this->assertStringContainsString
        (
            '<meta name="author" content="Ozan UYKUN" />', 
            (string) Html::meta('name:author', 'Ozan UYKUN')
        );
    }

    public function testSpace()
    {
        $this->assertStringContainsString
        (
            'Hello&nbsp;&nbsp;brother!', 
            'Hello' . Html::space(2) . 'brother!'
        );
    }

    public function testBr()
    {
        $this->assertStringContainsString
        (
            'Hello<br><br>brother!', 
            'Hello' . Html::br(2) . 'brother!'
        );
    }

    public function testHTML5Elements()
    {
        $this->assertStringContainsString
        (
            '<audio src="music.mp3" controls="controls"></audio>', 
            Html::controls()->audio('music.mp3')
        );
    }
}