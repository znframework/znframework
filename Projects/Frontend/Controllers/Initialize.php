<?php namespace Project\Controllers;

class Initialize extends Controller
{
    /**
     * The codes to run at startup.
     * It enters the circuit before all controllers. 
     * You can change this setting in Config/Starting.php file.
     */
    public function main(String $params = NULL)
    {
        # The theme is activated.
        # Location: Resources/Themes/Default/
        Theme::active('Default');
        
        # The current settings are being configured.
        Masterpage::title(ucfirst(CURRENT_CONTROLLER))
                  ->headPage('Sections/head')
                  ->bodyPage('Sections/body')
                  ->backgroundImage(FILES_DIR . 'background.jpg');
    }
}