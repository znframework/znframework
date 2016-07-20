<div id="generator">
	<?php echo Form::open('modelGeneratorForm'); ?>
    <div id="title">Model Generator Form</div>
    
    <div id="content">
        <div class="mb10 description">Modelin oluşturulacağı uygulamayı seçin.</div>
        <div class="mb20"><?php echo Form::addClass('input')->select('application', $applications, Validation::postBack('application')); ?></div>
        
        <div class="mb10 description">Model ismini belirleyin. <strong>Örnek: TestController</strong></div>
        <div class="mb20"><?php echo Form::placeholder('Model')->addClass('input')->text('model', Validation::postBack('model')); ?></div>
        
        <div class="mb10 description">Modelde yer alacak fonksiyonlar belirlenir. Birden fazla fonksiyon oluşturulacaksa aralarına <strong>virgül(,)</strong> koyarak yazın.<br>
        <strong>Örnek: main,example</strong></div>
        <div class="mb20"><?php echo Form::placeholder('Functions')->addClass('input')->text('functions', ( Validation::postBack('functions') ? Validation::postBack('functions') : '' )); ?></div>
        
        <div class="mb10 description">Modeli oluşturmak için butona basın.</div>
        <div class="mb20"><?php echo Form::addClass('button')->submit('generate', 'Generate'); ?></div>
        
        <?php if( ! empty($success) || ! empty($error) ): ?>
        <div class="mb10 description<?php echo ! empty($success) ? ' success' : ' error';?>"><?php echo $success.$error; ?></div>
        <?php endif; ?>
    </div>
    <?php echo Form::close(); ?>
</div>