<?php namespace ZN\Hypertext;

use Html;
use Form;

class BootstrapTest extends \PHPUnit\Framework\TestCase
{
    public function testGridsystem()
    {
        $this->assertStringContainsString
        (
            '<div class="col-sm-8">column size 8</div>', 
            (string) Html::colsm4('column size 4')->colsm4('column size 4')->colsm4('column size 4')
            ->colsm8('column size 8')->colsm2('column size 2')->colsm2('column size 2')
        );

        $this->assertStringContainsString
        (
            '<div class="col-lg-6">col size 6</div>', 
            (string) Html::collg6(function(){ echo 'col size 6'; })->collg6(function(){ echo 'col size 6'; })
        );
    }

    public function testForm()
    {
        $this->assertStringContainsString
        (
            '<div class="form-group">', 
            (string) Form::group()->text('email')
        );

        $this->assertStringContainsString
        (
            '<div class="form-group row">', 
            (string) Form::group(function()
            {
               echo Form::text('email');
               echo Form::password('pass');
            }) 
        );

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

        $this->assertStringContainsString
        (
            'help-block', 
            (string) Form::helptext('Bu bölüm e-posta alanıdır.')
            ->group()
            ->label('email', 'Email:')->col('sm-4')
            ->text('email')
        );
    }

    public function testModalbox()
    {
        $this->assertStringContainsString
        (
            '<button data-toggle="modal" data-target="#myModal" type="button">', 
            (string) Html::modal('myModal')->button('Open Modal')
        );

        $this->assertStringContainsString
        (
            '<div id="myModal" class="modal fade" role="dialog">', 
            (string) Html::modalbox('myModal')
        );

        $this->assertStringContainsString
        (
            '<div class="modal-dialog modal-lg">', 
            (string) Html::modalSize('lg')->modalbox('myModal')
        );

        $this->assertStringContainsString
        (
            '<button type="button" class="close" data-dismiss="modal">', 
            (string) Html::modalDismissButton()->modalHeader('abc')->modalbox('myModal')
        );
    }

    public function testAlert()
    {
        $this->assertStringContainsString
        (
            '<div role="alert" class="alert alert-danger">', 
            (string) Html::alert('danger', 'Hi!')
        );

        $this->assertStringContainsString
        (
            '<div role="alert" class="alert alert-danger">', 
            (string) Html::alertDanger('Hi!')
        );

        $this->assertStringContainsString
        (
            '<button class="close" data-dismiss="alert" aria-label="Close" type="button">', 
            (string) Html::dismissButton()->alertWarning('Hi!')
        );

        $this->assertStringContainsString
        (
            'alert-dismissible fade', 
            (string) Html::dismissFade()->dismissButton()->alertInfo('Hi!')
        );
    }

    public function testBreadcrumb()
    {
        $this->assertStringContainsString
        (
            '<nav aria-label="breadcrumb">', 
            (string) Html::breadcrumb('Products/Asus/Computer')
        );

        $this->assertStringContainsString
        (
            '<nav aria-label="breadcrumb">', 
            (string) Html::breadcrumb(NULL, 2)
        );
    }

    public function testCarousel()
    {
        $this->assertStringContainsString
        (
            '<div class="carousel-inner">', 
            (string) Html::item('slide1.jpg')->item('slide2.jpg')->carousel()
        );

        $this->assertStringContainsString
        (
            '<div class="carousel-inner">', 
            (string) Html::item('slide1.jpg')->item('slide2.jpg')->carousel4()
        );

        $this->assertStringContainsString
        (
            '<ol class="carousel-indicators">', 
            (string) Html::indicators()->item('slide1.jpg')->item('slide2.jpg')->carousel('myCarousel')
        );

        $this->assertStringContainsString
        (
            '<span class="sr-only">[next]</span>', 
            (string) Html::prev('[prev]')->next('[next]')->item('slide1.jpg')->carousel('myCarousel')
        );

        $this->assertStringContainsString
        (
            '$(\'#myCarousel\').carousel("pause")', 
            (string) Html::transition('pause')->item('slide1.jpg')->item('slide2.jpg')->carousel('myCarousel') .
                     Html::activeCarouselOptions('myCarousel')
        );
    }

    public function testBadge()
    {
        $this->assertStringContainsString
        (
            '<span class="label label-danger">', 
            (string) Html::badge('danger', 5)
        );

        $this->assertStringContainsString
        (
            '<span class="badge badge-danger">', 
            (string) Html::badge4('danger', 5)
        );
    }

    public function testProgressbar()
    {
        $this->assertStringContainsString
        (
            '<div style="height:50px" class="progress">', 
            (string) Html::progressbar('danger', 89, 50)
        );

        $this->assertStringContainsString
        (
            '<div style="height:50px" class="progress">', 
            (string) Html::progressbar4('danger', 89, 50)
        );

        $this->assertStringContainsString
        (
            '<div class="progress-bar progress-bar-danger progress-bar-striped" style="width:18%">', 
            (string) Html::progressbarStriped()->progressbarAnimated()->progressbarDanger(18, 45)
        );
    }

    public function testMediaOjbect4()
    {
        $this->assertStringContainsString
        (
            '<div class="media border p-3">', 
            (string) Html::mediaObject4('micheal_avatar.png', 'Micheal', 'Good job!', 'February 19, 2016')
        );

        $this->assertStringContainsString
        (
            '<h4>John <small><i>February 20, 2016</i></small></h4>', 
            (string) Html::mediaObjectReply(function()
            {            
                echo Html::mediaObject4('john_avatar.png', 'John', 'Yes.', 'February 20, 2016');
                echo Html::mediaObject4('alax_avatar.png', 'Alex', 'No!', 'February 21, 2016');
            
            })->mediaObject4('avatar.png', 'Micheal', 'Good job!', 'February 19, 2016')
        );
    }

    public function testFaIcon()
    {
        $this->assertStringContainsString
        (
            '<i class="fa fa-pencil fa-lg"></i>', 
            (string) Html::faIcon('pencil', 'lg')
        );

        $this->assertStringContainsString
        (
            '<i class="fas fa-pencil fa-lg"></i>', 
            (string) Html::fasIcon('pencil', 'lg')
        );
    }

    public function testFlex()
    {
        $this->assertStringContainsString
        (
            '<div class="d-flex bg-secondary">', 
            (string) Html::flex(function()
            {
            
                echo Html::flexItem('Example 1', 'bg-danger');
                echo Html::flexItem('Example 2', 'bg-success');
                echo Html::flexItem('Example 3', 'bg-success');
            
            }, 'bg-secondary')
        );

        $this->assertStringContainsString
        (
            '<div class="d-flex bg-secondary flex-flexwrap-wrap">', 
            (string) Html::flexWrap()->flex(function()
            {
                echo Html::flexGrow(1)->flexItem('Example 1', 'bg-danger');
                echo Html::flexItem('Example 2', 'bg-success');
            
            }, 'bg-secondary')
        );
    }

    public function testSpinner()
    {
        $this->assertStringContainsString
        (
            '<div class="spinner-grow text-danger spinner-grow-sm"></div>', 
            (string) Html::spinner('grow', 'danger', 'sm')
        );
    }

    public function testPopover()
    {
        $this->assertStringContainsString
        (
            ' data-toggle="popover"', 
            (string) Html::class('btn btn-danger')->popover('right', 'ZN Framework')->button('NAME') .
                     Html::popoverEvent('all', ['delay' => 100])
        );
    }

    public function testTooltip()
    {
        $this->assertStringContainsString
        (
            ' data-toggle="tooltip"', 
            (string) Html::class('btn btn-danger')->tooltip('right', 'ZN Framework')->button('NAME') .
                     Html::tooltipEvent('all', ['delay' => 100])
        );
    }
}