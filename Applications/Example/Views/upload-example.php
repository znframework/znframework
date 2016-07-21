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
	<div>
	<?php echo Form::enctype('multipart')->open('uploadForm');?>
	<?php echo Form::file('inputFileObject');?>
    <?php echo Form::submit('doUpload', 'Do Upload');?>
    <?php echo Form::close();?>
    </div>
    
    <div>
	<?php 
	if( ! empty($info) ) foreach( $info as $key => $val ):
   	 	writeLine('key:{0} - val:{1}', [$key, $val]);
    endforeach;
	?>
    </div>
    
    <div><?php echo ! empty($error) ? $error : ''; ?></div>
</body>

</html>