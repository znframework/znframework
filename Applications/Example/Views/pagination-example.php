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
	<table>
    <tr><td>ID</td><td>Username</td></tr>
    <?php foreach( $result as $row ): ?>
		<tr><td><?php echo $row->id?></td><td><?php echo $row->username?></td></tr> 
    <?php endforeach; ?> 	
    <tr><td colspan="2"><?php echo $pagination; ?></td></tr>
    </table>
</body>

</html>