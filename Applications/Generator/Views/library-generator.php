<div id="generator">
	<?php echo Form::open('libraryGeneratorForm'); ?>
    <div id="title">Library Generator Form</div>
    
    <div id="content">
        <div class="mb10 description">Kütüphanenin oluşturulacağı uygulamayı seçin.</div>
        <div class="mb20"><?php echo Form::addClass('input')->select('application', $applications, Validation::postBack('application')); ?></div>
        
        <div class="mb10 description">Kütüphane ismini belirleyin. <strong>Örnek: TestController</strong></div>
        <div class="mb20"><?php echo Form::placeholder('Library')->addClass('input')->text('library', Validation::postBack('library')); ?></div>
        
        <div class="mb10 description">Kütüphanede yer alacak fonksiyonlar belirlenir. Birden fazla fonksiyon oluşturulacaksa aralarına <strong>virgül(,)</strong> koyarak yazın.<br>
        <strong>Örnek: main,example</strong></div>
        <div class="mb20"><?php echo Form::placeholder('Functions')->addClass('input')->text('functions', ( Validation::postBack('functions') ? Validation::postBack('functions') : '' )); ?></div>
        
        <div class="mb10 description">Kütüphaneyi oluşturmak için butona basın.</div>
        <div class="mb20"><?php echo Form::addClass('button')->submit('generate', 'Generate'); ?></div>
        
        <?php if( ! empty($success) || ! empty($error) ): ?>
        <div class="mb10 description<?php echo ! empty($success) ? ' success' : ' error';?>"><?php echo $success.$error; ?></div>
        <?php endif; ?>
    </div>
    <?php echo Form::close(); ?>
</div>