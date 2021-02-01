<?php namespace ZN\Hypertext;

use DB;
use Form;
use Config;
use Session;

class FormTest extends \PHPUnit\Framework\TestCase
{
    public function testOpen()
    {
        $this->assertStringStartsWith('<form id="formId" name="formName" method="post">', (string) Form::open('formName', ['id' => 'formId']));
        $this->assertStringStartsWith('<form name="upload-form" method="post" enctype="multipart/form-data">', (string) Form::enctype('multipart')->open('upload-form'));
        $this->assertGreaterThan(0, strpos((string) Form::csrf()->open('form'), 'token'));

        $form = (string) Form::where('username', 'robot@znframework.com')->open('persons');

        $this->assertStringStartsWith("SELECT  *  FROM persons  WHERE username =  'robot@znframework.com'", DB::stringQuery());

        $form = (string) Form::query("SELECT  *  FROM persons  WHERE username =  'robot@znframework.com'")->open('persons');

        $this->assertStringStartsWith("SELECT  *  FROM persons  WHERE username =  'robot@znframework.com'", DB::stringQuery());
        $this->assertStringStartsWith('<form name="formName" method="post" onsubmit="event.preventDefault()">', (string) Form::prevent()->open('formName'));
    }

    public function testClose()
    {
        $this->assertStringStartsWith('</form>', (string) Form::close());
    }

    public function testText()
    {
        $this->assertStringStartsWith
        (
            '<input type="text" name="textBox" value="Welcome!" id="example-text" maxlength="10">', 
            (string) Form::id('example-text')->maxlength(10)->text('textBox', 'Welcome!')
        );
    }

    public function testPassword()
    {
        $this->assertStringStartsWith
        (
            '<input type="password" maxlength="10" name="password" value="*****">', 
            (string) Form::password('password', '*****', ['maxlength' => 10])
        );
    }

    public function testTextarea()
    {
        $this->assertStringStartsWith
        (
            '<textarea cols="50" rows="5" name="address">Address</textarea>', 
            (string) Form::cols(50)->rows(5)->textarea('address', 'Address')
        );
    }

    public function testSubmit()
    {
        $this->assertStringStartsWith
        (
            '<input type="submit" name="sendSubmit" value="Send">', 
            (string) Form::submit('sendSubmit', 'Send')
        );
    }

    public function testReset()
    {
        $this->assertStringStartsWith
        (
            '<input type="reset" name="clear" value="Clear">', 
            (string) Form::reset('clear', 'Clear')
        );
    }

    public function testButton()
    {
        $this->assertStringStartsWith
        (
            '<input type="button" name="sendButton" value="Send">', 
            (string) Form::button('sendButton', 'Send')
        );
    }

    public function testRadio()
    {
        $this->assertStringStartsWith
        (
            '<input type="radio" name="gender" value="Female" checked="checked">', 
            (string) Form::checked()->radio('gender', 'Female')
        );
    }

    public function testCheckbox()
    {
        $this->assertStringContainsString
        (
            '<input type="checkbox" name="trueType" value="true" checked="checked">', 
            (string) Form::checked()->checkbox('trueType', 'true')
        );
    }

    public function testSelect()
    {
        $options = [ '34' => 'Istanbul', '19' => 'Corum' ];

        $this->assertStringContainsString
        (
            '<option value="34">Istanbul</option>', 
            (string) Form::select('cities', $options, '19')
        );

        $this->assertStringContainsString
        (
            '<option value="19">Corum</option>', 
            (string) Form::including(['19'])->select('cities', $options)
        );

        $this->assertStringContainsString
        (
            '<option value="34">Istanbul</option>', 
            (string) Form::excluding(['19'])->select('cities', $options)
        );
    }

    public function testFile()
    {
        $this->assertStringContainsString
        (
            '<input type="file" name="upload[]" value="" multiple="multiple">', 
            (string) Form::file('upload', true)
        );
    }

    public function testCallHTML5Element()
    {
        $this->assertStringContainsString
        (
            '<input type="color" name="myColor" value="">', 
            (string) Form::color('myColor')
        );
    }

    public function testToString()
    {
        $this->assertStringContainsString
        (
            '<input type="color" name="myColor" value="">', 
            (string) Form::open()->color('myColor')->close()
        );
    }

    public function testPostback()
    {
        $_POST['myColor'] = 'My Color';

        $this->assertStringContainsString
        (
            '<input type="color" name="myColor" value="My Color">', 
            (string) Form::postback()->color('myColor')
        );
    }

    public function testValidate()
    {
        $form = (string) Form::open('validationForm')->validate('required')->text('name')->close();

        $rules = Session::select('FormValidationRulesvalidationForm');

        $this->assertSame(['name' => ['required', 'value' => 'name']], $rules);
    }

    public function testVMethods()
    {
        $this->assertStringContainsString
        (
            'pattern="^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$"', 
            (string) Form::vEmail()->vMaxchar(100)->text('email')
        );

        $this->assertStringContainsString('minlength="3"', (string) Form::vMinchar(3)->text('name'));
        $this->assertStringContainsString('pattern="^[a-zA-Z]+$"', (string) Form::vAlpha()->text('name'));
        $this->assertStringContainsString('***-***-**-**', (string) Form::vPhone('***-***-**-**')->text('phone'));
    }

    public function testSerializer()
    {
        $this->assertStringContainsString
        (
            'serializer', 
            (string) Form::serializer('Contact/ajaxSendForm', '#successDiv')->button('send', 'SEND')
        );
    }

    public function testTrigger()
    {
        $this->assertStringContainsString
        (
            'trigger', 
            (string) Form::trigger('keyup', 'Validations/control', function(){})->button('send', 'SEND')
        );
    }
}