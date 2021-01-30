<?php namespace ZN\Hypertext;

use Form;

class GroupTest extends \PHPUnit\Framework\TestCase
{
    public function testGroup()
    {
        $this->assertStringContainsString
        (
            '<div class="form-group">', 
            (string) Form::group()->text('email')
        );
    }

    public function testGroupCallable()
    {
        $this->assertStringContainsString
        (
            '<div class="form-group row">', 
            (string) Form::group(function()
            {
               echo Form::text('email');
               echo Form::password('pass');
            }) 
        );
    }

    public function testLabel()
    {
        $this->assertStringContainsString
        (
            '<div class="form-group">', 
            (string) Form::group()->label('pass', 'Şifre:')->password('pass')
        );

        $this->assertStringContainsString
        (
            '<div class="radio">', 
            (string) Form::group()->label('Bay')->radio('gender')
        );

        $this->assertStringContainsString
        (
            '<div class="col-sm-4">', 
            (string) Form::group()->label('email', 'Email:')->col('sm-4')->text('email')
        );
    }

    public function testHelptext()
    {
        $this->assertStringContainsString
        (
            'help-block', 
            (string) Form::helptext('Bu bölüm e-posta alanıdır.')
            ->group()
            ->label('email', 'Email:')->col('sm-4')
            ->text('email')
        );
    }
}