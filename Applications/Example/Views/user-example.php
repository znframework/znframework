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
    <?php endif; ?>
    <!-- Login Page -->
    
    
    
    <!-- Update Page -->
	<?php if( URI::get('UserExample') === 'update' ): ?>
    
		<?php if( User::isLogin() ): ?>
			<?php echo Form::open('update'); ?>
            <table>
                <tr><td>Old Password: </td><td><?php echo Form::placeholder('Old Password:')->password('oldPassword', Validation::postBack('oldPassword'));?></td></tr>
                <tr><td>New Password: </td><td><?php echo Form::placeholder('New Password:')->password('newPassword', Validation::postBack('newPassword'));?></td></tr>
                <tr><td colspan="2" align="right"><?php echo Form::submit('update', 'Update');?></td></tr>
            </table>
            <?php echo Form::close(); ?>   
        <?php else: ?>  
       		Please do login, <?php echo Html::anchor('example/UserExample/login', 'Sign Up'); ?>
        <?php endif; ?>
     
    <?php endif; ?>
    <!-- Update Page -->
    
     <!-- Update Page -->
	<?php if( URI::get('UserExample') === 'forgotPassword' ): ?>
    
		<?php echo Form::open('update'); ?>
        <table>
            <tr><td>E-mail: </td><td><?php echo Form::placeholder('E-mail:')->text('email', Validation::postBack('email'));?></td></tr>
            <tr><td colspan="2" align="right"><?php echo Form::submit('send', 'Send');?></td></tr>
        </table>
        <?php echo Form::close(); ?>   
        
    <?php endif; ?>
    <!-- Update Page -->
    
    <p><?php echo ! empty($error) ? $error : ''; ?></p>
</body>

</html>