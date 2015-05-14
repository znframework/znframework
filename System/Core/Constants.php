<?php
/************************************************************/
/*                     SYSTEM CONSTANTS                     */
/************************************************************/
/*

Author: Ozan UYKUN
Site: http://www.zntr.net
Copyright 2012-2015 zntr.net - Tüm hakları saklıdır.

*/

$base_dir = explode("index.php",$_SERVER['SCRIPT_NAME']); // sistem dizini belirleniyor...

if(isset($base_dir[0]))
{
	define('BASE_DIR', $base_dir[0]);
}

define('SYSTEM_DIR', 'System/'); 							/* SYSTEM_DIR */

define('CONFIG_DIR', APP_DIR.'Config/'); 					/* CONFIG_DIR */

define('CORE_DIR', SYSTEM_DIR.'Core/'); 					/* CORE_DIR */

define('REFERENCES_DIR', SYSTEM_DIR.'References/'); 		/* REFERENCES_DIR */

define('SYSTEM_LANGUAGES_DIR', SYSTEM_DIR.'Languages/');	/* SYSTEM_LANGUAGES_DIR */

define('LANGUAGES_DIR', APP_DIR.'Languages/'); 				/* LANGUAGES_DIR */

define('SYSTEM_LIBRARIES_DIR', SYSTEM_DIR.'Libraries/');	/* SYSTEM_LIBRARIES_DIR */

define('LIBRARIES_DIR', APP_DIR.'Libraries/'); 				/* LIBRARIES_DIR */

define('SYSTEM_TOOLS_DIR', SYSTEM_DIR.'Tools/'); 			/* SYSTEM_TOOLS_DIR */

define('TOOLS_DIR', APP_DIR.'Tools/'); 						/* TOOLS_DIR */

define('CONTROLLERS_DIR', APP_DIR.'Controllers/'); 			/* CONTROLLERS_DIR */

define('MODELS_DIR', APP_DIR.'Models/'); 					/* MODELS_DIR */

define('VIEWS_DIR', APP_DIR.'Views/'); 						/* VIEWS_DIR */
	
define('SCRIPTS_DIR', VIEWS_DIR.'Scripts/'); 				/* SCRIPTS_DIR */

define('PAGES_DIR', VIEWS_DIR.'Pages/'); 					/* PAGES_DIR */

define('STYLES_DIR', VIEWS_DIR.'Styles/'); 					/* STYLES_DIR */

define('TRINKETS_DIR', VIEWS_DIR.'Trinkets/');				/* TRINKETS_DIR */

define('FONTS_DIR', VIEWS_DIR.'Fonts/');					/* FONTS_DIR */

define('FILES_DIR', TRINKETS_DIR.'Files/');					/* FILES_DIR */

define('UPLOADS_DIR', TRINKETS_DIR.'Uploads/');				/* UPLOADS_DIR */

define('DB_DIR', SYSTEM_DIR.'Database/');					/* DB_DIR */

define('DRIVERS_DIR', DB_DIR.'Drivers/');					/* DRIVERS_DIR */

define('SYSTEM_COMPONENTS_DIR', SYSTEM_DIR.'Components/');	/* SYSTEM_COMPONENTS_DIR */