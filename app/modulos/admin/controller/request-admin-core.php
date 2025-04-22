<?php
/**
 * Verifica se o usuario possui permissão para acessar determinada página
 */
if(isset($_SESSION[COD_SESSION."_id_admin_usuario"])){

	$idAdmimUsuario = $_SESSION[COD_SESSION."_id_admin_usuario"];
	$idAdmimLog = $_SESSION[COD_SESSION."_id_admin_log"];

	$objAdminUsuarioLogado = ControllerAdminUsuario::listar("id = :id", array(':id' => $idAdmimUsuario), null, "obj");

	if($objAdminUsuarioLogado instanceof AdminUsuario){

		/**
		 * Rotas permitidas no perfil
		 */
		$arrAdminPermissoes = $objAdminUsuarioLogado->getAdminPerfil()->getArrPermissoes();
		$blnAcessoLiberado = false;

		if($arrAdminPermissoes[$objRoute->getArrUrl(1)]){
			if(is_array($arrAdminPermissoes[$objRoute->getArrUrl(1)])){
				if($arrAdminPermissoes[$objRoute->getArrUrl(1)][$objRoute->getArrUrl(2)]){
					$blnAcessoLiberado = true;
				}
			}elseif($arrAdminPermissoes[$objRoute->getArrUrl(1)] == 1){
				$blnAcessoLiberado = true;
			}
		}

		/**
		 * REDIRECIONA PARA A PAGINA PERMISSAO NEGADA
		 */
		if($blnAcessoLiberado == false){
			header("LOCATION: ".URL_ADMIN."permissao-negada");
			die();
		}

	}

}else{

	if($objRoute->getArrUrl(1) != "login" AND $objRoute->getArrUrl(1) != "recuperar-senha"){
		header("LOCATION: ".URL_ADMIN."login");
		die();
	}

}


/**
 * 
 * ADMIN CORE
 * 
 **/

$pathModulo = PATH_MODULO."admin/";

/**
 * pagina de recuperar senha
 */
if($objRoute->getArrUrl(1) == 'recuperar-senha'){
	$objRoute->setView(PATH_MODULO."admin/view/login/recuperar-senha.php");
	require_once(PATH_ADMIN."login.php");
	die();
}


/**
 * pagina de login
 */
if($objRoute->getArrUrl(1) == 'login'){
	$objRoute->setView(PATH_MODULO."admin/view/login/login.php");
	require_once(PATH_ADMIN."login.php");
	die();
}

/**
 * rotina ao clicar em sair
 */
if($objRoute->getArrUrl(1) == "sair"){
	unset($_SESSION[COD_SESSION."_id_admin_usuario"]);
	unset($_SESSION[COD_SESSION."_id_admin_log"]);
	session_destroy();
	header("LOCATION: ".URL_ADMIN."login");
	die();
}

/**
 * pagina inicial do admin
 */
if($objRoute->getArrUrl(1) == "dashboard"){
	$modulo = "Dashboard";
	$alertaSistema .= Controller::utilsAlert('Utilize o menu ao lado para navegar!', 'info');
	$objRoute->setView($pathModulo."view/core/dashboard.php");
}

/**
 * pagina de permissao negada
 */
if($objRoute->getArrUrl(1) == "permissao-negada"){
	$modulo = "Permissão Negada";
	$alertaSistema = Controller::utilsAlert("Você não possui permissão para acessar essa página", 'danger');
	$objRoute->setView($pathModulo."view/core/permissao-negada.php");
}

/*
print '<pre>';
print_r($GLOBALS);
die();
*/