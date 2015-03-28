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
define('BASE_DIR', $base_dir[0]);

define('SYSTEM_DIR', 'System/'); 						/* SYSTEM_DIR */

define('CONFIG_DIR', 'Config/'); 						/* CONFIG_DIR */

define('CORE_DIR', 'System/Core/'); 					/* CORE_DIR */

define('REFERENCES_DIR', 'System/References/'); 		/* REFERENCES_DIR */

define('SYSTEM_LANGUAGES_DIR', 'System/Languages/'); 	/* SYSTEM_LANGUAGES_DIR */

define('LANGUAGES_DIR', 'Languages/'); 					/* LANGUAGES_DIR */

define('SYSTEM_LIBRARIES_DIR', 'System/Libraries/'); 	/* SYSTEM_LIBRARIES_DIR */

define('LIBRARIES_DIR', 'Libraries/'); 					/* LIBRARIES_DIR */

define('SYSTEM_TOOLS_DIR', 'System/Tools/'); 			/* SYSTEM_TOOLS_DIR */

define('TOOLS_DIR', 'Tools/'); 							/* TOOLS_DIR */
	
define('SCRIPTS_DIR', 'Designer/Scripts/'); 			/* SCRIPTS_DIR */

define('CODER_DIR', 'Coder/'); 							/* CODER_DIR */

define('PAGES_DIR', 'Designer/Pages/'); 				/* PAGES_DIR */

define('STYLES_DIR', 'Designer/Styles/'); 				/* STYLES_DIR */

define('TRINKETS_DIR', 'Designer/Trinkets/');			/* TRINKETS_DIR */

define('FONTS_DIR', 'Designer/Fonts/');					/* FONTS_DIR */

define('UPLOADS_DIR', 'Designer/Trinkets/Uploads/');	/* UPLOADS_DIR */