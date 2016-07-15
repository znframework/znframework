<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $title; ?></title>
<style>
body{ font-family:Consolas, Monaco, monospace; font-size:14px; }
</style>
</head>

<body>
	<p><h4>Requirements(Gereksinimler)</h4></p>
    <?php foreach( $requirements as $key => $require ): ?>
    	<?php echo Html::bold($key + 1).' - '.$require.Html::br(); ?>
    <?php endforeach; ?>
    
	<p><h4><?php echo ! empty($subtitle) ? $subtitle.' Functions' : ''; ?></h4></p>
    <p>Run URL: www.xxx.xxx/<?php echo $subtitle; ?>/&darr;</p>
	<?php foreach( $examples as $key => $example ): ?>
    	<?php echo Html::parag(Html::bold($key + 1).' - '.Html::target('blank')->anchor('example/'.$subtitle.'/'.$example, $example)); ?>
    <?php endforeach; ?>
</body>

</html>