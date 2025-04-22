<?php
/**
* AUTOLOAD
*/	

if(!isset($_SESSION[COD_SESSION."_id_admin_log"])){
	$_SESSION[COD_SESSION."_id_admin_log"] = null;
}

/**
* Carrega as classes e controller do core da aplicação
*/
if ($handle = opendir(PATH.'app/core/class/')) {
	while (false !== ($entry = readdir($handle))) {
		if ($entry != "." && $entry != "..") {
			require_once(PATH.'app/core/class/'.$entry);
		}
	}
	closedir($handle);
}
require_once 'core/controller.php';


/**
 * Carrega as classes e controller dos modulos caso a aplicação possua modulos
 */
if (is_dir(PATH.'app/modulos/')) {
	if ($handle = opendir(PATH.'app/modulos/')) {
		while (false !== ($entry = readdir($handle))) {
			if ($entry != "." && $entry != "..") {
				require_once(PATH.'app/modulos/'.$entry.'/controller/controller.php');
			}
		}
		closedir($handle);
	}
}

