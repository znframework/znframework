<?php
return 
[
	/*
    |--------------------------------------------------------------------------
    | Benchmark
    |--------------------------------------------------------------------------
    |
    | The language of the Benchmark library.
    |
	*/
	
	'benchmark:elapsedTime'         => 'System Load Time',
	'benchmark:memoryUsage'         => 'Memory Usage',
	'benchmark:maxMemoryUsage'      => 'Maximum Memory Usage',
	'benchmark:resultTable'         => 'BENCHMARK RESULT TABLE',
	'benchmark:performanceTips'     => 'PERFORMANCE ENHANCING TIPS',
	'benchmark:laterProcess'        => 'Use the following settings are recommended after completion of your project.',
	'benchmark:configAutoloader'    => 'Config/Autoloader.php',
	'benchmark:configHtaccess'      => 'Config/Htaccess.php',
	'benchmark:second'              => 'Seconds',
	'benchmark:byte'                => 'Bytes',
	'benchmark:countFile'           => 'Count Load Files',
	
	/*
    |--------------------------------------------------------------------------
    | Cache
    |--------------------------------------------------------------------------
    |
    | The language of the Cache library.
    |
	*/

	'cache:driverError'             => '`%` driver not found!',
	'cache:unsupported'             => '`%` PHP extension must be loaded to use Wincache Cache!',
	'cache:invalidDriver'           => '`%` driver is invalid!',
	'cache:connectionRefused'       => 'Connection refused! Error:`%`',
	'cache:authenticationFailed'    => 'Authentication failed!',

	/*
    |--------------------------------------------------------------------------
    | User
    |--------------------------------------------------------------------------
    |
    | The language of the User library.
    |
	*/

	'user:registerSuccess'          => 'Your registration was completed successfully.',
	'user:registerError'            => 'You have already registered with the system for the transaction could not be performed!',
	'user:registerEmailError'       => 'Your process because the system could not be performed previously registered e-mail!',
	'user:registerUsernameError'    => "The data should include the user name and password!",
	'user:loginError'               => 'Login failed. The user name or password is incorrect!',
	'user:bannedError'              => 'You can not login because you have been banned from the system!',
	'user:loginSuccess'             => 'You have logged in successfully. Redirecting .. Please wait.',
	'user:registerUnknownError'     => 'Unknown error!',
	'user:oldPasswordError'         => 'You have entered the wrong password!',
	'user:passwordNotMatchError'    => 'Passwords do not match!',
	'user:updateProcessSuccess'     => 'The update process is successful.',
	'user:forgotPasswordError'      => "You are not registered on the system or your username is incorrect!",
	'user:forgotPasswordSuccess'    => "Your password has been sent to your email.",
	'user:newYourPassword'          => "Sent New Password.",
	'user:emailError'               => "Don't send your mail!",
	'user:emailImformationError'    => "E-mail information is found!",
	'user:username'                 => "User Name",
	'user:password'                 => "Password",
	'user:learnNewPassword'         => "Click to login with your new password.",
	'user:activation'               => "Click to complete the activation process.",
	'user:activationProcess'        => "User activation process.",
	'user:activationError'          => "You can not log in to complete the activation process.",
	'user:activationEmail'          => "For the completion of your registration, please click on the activation link sent to your e-mail address.",
	'user:activationCompleteError'  => "The activation process could not be completed!",
	'user:activationComplete'       => "The activation process is completed with success.",
	'user:verificationEmail'        => 'Verification Email',
	'user:verificationOrEmailError' => 'Verification code or email information is wrong!'
];