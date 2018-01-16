<?php namespace ZN\Authentication;
/**
 * ZN PHP Web Framework
 * 
 * "Simplicity is the ultimate sophistication." ~ Da Vinci
 * 
 * @package ZN
 * @license MIT [http://opensource.org/licenses/MIT]
 * @author  Ozan UYKUN [ozan@znframework.com]
 */

/**
 * Default Cookie Configuration
 * 
 * Enabled when the configuration file can not be accessed.
 */
class AuthenticationDefaultLanguage
{
    /*
    |--------------------------------------------------------------------------
    | User
    |--------------------------------------------------------------------------
    |
    | The language of the User library.
    |
	*/

    public $en = 
    [
        'registerSuccess'          => 'Your registration was completed successfully.',
        'registerError'            => 'You have already registered with the system for the transaction could not be performed!',
        'registerEmailError'       => 'Your process because the system could not be performed previously registered e-mail!',
        'registerUsernameError'    => "The data should include the user name and password!",
        'loginError'               => 'Login failed. The user name or password is incorrect!',
        'bannedError'              => 'You can not login because you have been banned from the system!',
        'loginSuccess'             => 'You have logged in successfully. Redirecting .. Please wait.',
        'registerUnknownError'     => 'Unknown error!',
        'oldPasswordError'         => 'You have entered the wrong password!',
        'passwordNotMatchError'    => 'Passwords do not match!',
        'updateProcessSuccess'     => 'The update process is successful.',
        'forgotPasswordError'      => "You are not registered on the system or your username is incorrect!",
        'forgotPasswordSuccess'    => "Your password has been sent to your email.",
        'newYourPassword'          => "Sent New Password.",
        'emailError'               => "Don't send your mail!",
        'emailImformationError'    => "E-mail information is found!",
        'username'                 => "User Name",
        'password'                 => "Password",
        'learnNewPassword'         => "Click to login with your new password.",
        'activation'               => "Click to complete the activation process.",
        'activationProcess'        => "User activation process.",
        'activationError'          => "You can not log in to complete the activation process.",
        'activationEmail'          => "For the completion of your registration, please click on the activation link sent to your e-mail address.",
        'activationCompleteError'  => "The activation process could not be completed!",
        'activationComplete'       => "The activation process is completed with success.",
        'resendActivationError'    => 'Activation code e-mail could not be sent if the specified e-mail address has already been activated!',
        'verificationEmail'        => 'Verification Email',
        'verificationOrEmailError' => 'Verification code or email information is wrong!'
    ];	

    public $tr = 
    [
        'registerSuccess'          => 'Kaydınızı başarı ile tamamlandı.',
        'registerError'            => 'Sisteme daha önceden kayıt olduğunuz için işleminiz gerçekleştirilemedi!',
        'registerEmailError'       => 'Sisteme daha önceden kayıtlı e-posta olduğu için işleminiz gerçekleştirilemedi!',
        'registerUsernameError'    => 'Veri, kullanıcı adı ve şifre bilgisini içermelidir!',
        'loginError'               => 'Giriş başarısız. Kullanıcı adı veya şifre yanlış!',
        'bannedError'              => 'Sistemden banlamış olduğunuz için giriş yapamazsınız!',
        'loginSuccess'             => 'Başarı ile giriş yaptınız. Yönlendiriliyorsunuz.. Lütfen bekleyin.',
        'registerUnknownError'     => 'Bilinmeyen hata!',
        'oldPasswordError'         => 'Şifrenizi yanlış girdiniz!',
        'passwordNotMatchError'    => 'Şifreler uyumlu değil!',
        'updateProcessSuccess'     => 'Güncelleme işlemi başarılı.',
        'forgotPasswordError'      => 'Sistemde kayıtlı değilsiniz ya da kullanıcı adınız yanlış!',
        'forgotPasswordSuccess'    => 'Şifreniz e-postanıza gönderilmiştir.',
        'newYourPassword'          => 'Gönderilen Yeni Şifreniz.',
        'emailError'               => 'E-posta gönderilemedi!',
        'emailImformationError'    => 'E-posta bilgisi bulunmamaktadır!',
        'username'                 => 'Kullanıcı Adınız',
        'password'                 => 'Şifreniz',
        'learnNewPassword'         => 'Yeni şifrenizle giriş yapmak için lütfen tıklayınız.',
        'activation'               => 'Aktivasyon işlemini tamamlamak için tıklayınız.',
        'activationProcess'        => 'Üye aktivasyon işlemi.',
        'activationError'          => 'Aktivasyon işlemini tamamlamadan giriş yapamazsınız.',
        'activationEmail'          => 'Kaydınızın tamamlanması için lütfen e-posta adresinize gönderilen aktivasyon linkine tıklayınız.',
        'activationCompleteError'  => 'Aktivasyon işlemi tamamlanamadı!',
        'activationComplete'       => 'Aktivasyon işlemi başarı ile tamamlandı.',
        'resendActivationError'    => 'Belirtilen e-posta adresinin etkinleştirilmesi zaten yapılmış olduğundan aktivasyon kodu e-postası gönderilemedi!',
        'verificationEmail'        => 'Doğrulama E-postası',
        'verificationOrEmailError' => 'Doğrulama kodu veya Eposta bilgisi yanlış!'
    ];
}
