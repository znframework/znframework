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
    <p><?php echo str_replace(', ', '<br>', preg_replace('/([0-9]+\s\-\s)/', '<b>$1</b>', $requirements)); ?></p>
	<p><h4><?php echo $subtitle = ! empty($subtitle) ? $subtitle : ''; ?></h4></p>
    <p>Run URL: www.xxx.xxx/<?php echo str_replace(' ', '', $title); ?>/&darr;</p>
	<p><?php echo str_replace(', ', '<br>', preg_replace('/([0-9]+\s\-\s)/', '<b>$1</b>', $text)); ?></p>
</body>

</html>