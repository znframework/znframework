<div id="generator">
	<?php echo Form::open('controllerGeneratorForm'); ?>
    <div id="title">Controller Generator Form</div>
    
    <div id="content">
        <div class="mb10 description">Kontrolcünün oluşturulacağı uygulamayı seçin.</div>
        <div class="mb20"><?php echo Form::addClass('input')->select('application', $applications, Validation::postBack('application')); ?></div>
        
        <div class="mb10 description">Kontrolcü ismini belirleyin. <strong>Örnek: TestController</strong></div>
        <div class="mb20"><?php echo Form::placeholder('Controller')->addClass('input')->text('controller', Validation::postBack('controller')); ?></div>
        
        <div class="mb10 description">Kontrolcüde yer alacak fonksiyonlar belirlenir. Birden fazla fonksiyon oluşturulacaksa aralarına <strong>virgül(,)</strong> koyarak yazın.<br>
       <strong> Örnek: main,example</strong></div>
        <div class="mb20"><?php echo Form::placeholder('Functions')->addClass('input')->text('functions', ( Validation::postBack('functions') ? Validation::postBack('functions') : '' )); ?></div>
        
        <div class="mb10 description">Kontrolcüyü oluşturmak için butona basın.</div>
        <div class="mb20"><?php echo Form::addClass('button')->submit('generate', 'Generate'); ?></div>
        
        <?php if( ! empty($success) || ! empty($error) ): ?>
        <div class="mb10 description<?php echo ! empty($success) ? ' success' : ' error';?>"><?php echo $success.$error; ?></div>
        <?php endif; ?>
    </div>
    <?php echo Form::close(); ?>
</div>