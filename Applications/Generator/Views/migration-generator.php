<div id="generator">
	<?php echo Form::open('migrationGeneratorForm'); ?>
    <div id="title">Migration Generator Form</div>
    
    <div id="content">
        <div class="mb10 description">Modelin oluşturulacağı uygulamayı seçin.</div>
        <div class="mb20"><?php echo Form::addClass('input')->select('application', $applications, Validation::postBack('application')); ?></div>
        
        <div class="mb10 description">Migration ismini belirleyin. <strong>Örnek: Account</strong></div>
        <div class="mb20"><?php echo Form::placeholder('Migration')->addClass('input')->text('migration', Validation::postBack('migration')); ?></div>
        
        <div class="mb10 description">Migration dosyasının versiyonu belirtilir. <strong>Örnek: 1</strong></div>
        <div class="mb20"><?php echo Form::placeholder('Version')->addClass('input')->text('version', ( Validation::postBack('version') ? Validation::postBack('version') : '' )); ?></div>
        
        <div class="mb10 description">Migration dosyasını oluşturmak için butona basın.</div>
        <div class="mb20"><?php echo Form::addClass('button')->submit('generate', 'Generate'); ?></div>
        
        <?php if( ! empty($success) || ! empty($error) ): ?>
        <div class="mb10 description<?php echo ! empty($success) ? ' success' : ' error';?>"><?php echo $success.$error; ?></div>
        <?php endif; ?>
    </div>
    <?php echo Form::close(); ?>
</div>