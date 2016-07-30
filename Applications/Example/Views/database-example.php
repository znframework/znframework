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
	<table border="1">
    <tr><th>Name</th><th>Phone</th><th>Address</th><th>Delete</th></tr>
    <?php if( ! empty($result) )foreach( $result as $row ): ?>
		<tr>
        	<td><?php echo $row->name?></td>
            <td><?php echo $row->phone?></td>
            <td><?php echo $row->address?></td>
            <td><?php echo Html::anchor('example/DatabaseExample/delete/row/'.(int) URI::get('select').'/id/'.$row->id, 'Delete');?></td>
        </tr> 
    <?php endforeach; ?> 	
    <tr><th>Toplam Kayıt:</th><td colspan="3"><?php echo $limitTotalRows.'/'.$realTotalRows;?></td></tr>
    <tr><td colspan="4"><?php echo ! empty($pagination) ? $pagination : ''; ?></td></tr>
    </table>
    
</body>

</html>