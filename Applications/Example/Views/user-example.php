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
	<!-- Register Page -->
	<?php if( URI::get('UserExample') === 'register' ): ?>
    
		<?php echo Form::open('register'); ?>
        <table>
            <tr><td>Username: </td><td><?php echo Form::placeholder('Username:')->text('username', Validation::postBack('username'));?></td></tr>
            <tr><td>Password: </td><td><?php echo Form::placeholder('Password:')->password('password', Validation::postBack('password'));?></td></tr>
            <tr><td>Password Again: </td><td><?php echo Form::placeholder('Password Again:')->password('passwordAgain', Validation::postBack('passwordAgain'));?></td></tr>
            <tr><td colspan="2" align="right"><?php echo Form::submit('register', 'Register');?></td></tr>
        </table>
        <?php echo Form::close(); ?>
        <p><?php echo ! empty($error) ? $error : ''; ?></p>
    
    <?php endif; ?>
    <!-- Register Page -->
    
    
    
    <!-- Login Page -->
	<?php if( URI::get('UserExample') === 'login' ): ?>
    
		<?php if( ! User::isLogin() ): ?>
			<?php echo Form::open('login'); ?>
            <table>
                <tr><td>Username: </td><td><?php echo Form::placeholder('Username:')->text('username', Validation::postBack('username'));?></td></tr>
                <tr><td>Password: </td><td><?php echo Form::placeholder('Password:')->password('password', Validation::postBack('password'));?></td></tr>
                <tr><td colspan="2" align="right"><?php echo Form::submit('login', 'Login');?></td></tr>
            </table>
            <?php echo Form::close(); ?>   
        <?php else: ?>  
       		Welcome, <?php echo User::data()->username; ?> - <?php echo Html::anchor('example/UserExample/logout', 'Sign Out'); ?>
        <?php endif; ?>
        
        <p><?php echo ! empty($error) ? $error : ''; ?></p>
     
    <?php endif; ?>
    <!-- Login Page -->
</body>

</html>