<?php


/**
 * Carregas as models e DAO do sistema adminiativo
 */
if (is_dir(PATH_MODULO.DIR_ADMIN.'/model/')) {
	if ($handleAdmin = opendir(PATH_MODULO.DIR_ADMIN.'/model/')) {
		while (false !== ($entryAdmin = readdir($handleAdmin))) {
			if ($entryAdmin != "." && $entryAdmin != "..") {
				require_once(PATH_MODULO.DIR_ADMIN.'/model/'.$entryAdmin);
			}
		}
		closedir($handleAdmin);
	}
}


/**
 * Modulos do sistema adminiativo (menu)
 */
Class ControllerAdminModulo{

	public static function cadastrar($objAdminModulo){
		$objAdminModuloDao = new AdminModuloDao();
		return $objAdminModuloDao->cadastrar($objAdminModulo);
	}
	public static function editar($objAdminModulo){
		$objAdminModuloDao = new AdminModuloDao();
		return $objAdminModuloDao->editar($objAdminModulo);
	}
	public static function excluir($objAdminModulo){
		$objAdminModuloDao = new AdminModuloDao();
		return $objAdminModuloDao->excluir($objAdminModulo);
	}
	public static function ordenar($objAdminModulo){
		$objAdminModuloDao = new AdminModuloDao();
		return $objAdminModuloDao->ordenar($objAdminModulo);
	}
	public static function listar($parametro = null, $arrParamValor = null, $arrCampos = null, $retorno = null, $excluido = false){
		$objAdminModuloDao = new AdminModuloDao();
		return $objAdminModuloDao->listar($parametro, $arrParamValor, $arrCampos, $retorno, $excluido);
	}
	
}


/**
 * Páginas do sistema administrativo
 */
Class ControllerAdminPagina{

	public static function cadastrar($objAdminPagina){
		$objAdminPaginaDao = new AdminPaginaDao();
		return $objAdminPaginaDao->cadastrar($objAdminPagina);
	}
	public static function editar($objAdminPagina){
		$objAdminPaginaDao = new AdminPaginaDao();
		return $objAdminPaginaDao->editar($objAdminPagina);
	}
	public static function excluir($objAdminPagina){
		$objAdminPaginaDao = new AdminPaginaDao();
		return $objAdminPaginaDao->excluir($objAdminPagina);
	}
	public static function ordenar($objAdminPagina){
		$objAdminPaginaDao = new AdminPaginaDao();
		return $objAdminPaginaDao->ordenar($objAdminPagina);
	}
	public static function listar($parametro = null, $arrParamValor = null, $arrCampos = null, $retorno = null, $excluido = false){
		$objAdminPaginaDao = new AdminPaginaDao();
		return $objAdminPaginaDao->listar($parametro, $arrParamValor, $arrCampos, $retorno, $excluido);
	}
	
}

/**
 * Usuarios do sistema adminiativo
 */
Class ControllerAdminUsuario{

	public static function cadastrar($objAdminUsuario){
		$objAdminUsuarioDao = new AdminUsuarioDao();
		return $objAdminUsuarioDao->cadastrar($objAdminUsuario);
	}
	public static function editar($objAdminUsuario){
		$objAdminUsuarioDao = new AdminUsuarioDao();
		return $objAdminUsuarioDao->editar($objAdminUsuario);
	}
	public static function excluir($objAdminUsuario){
		$objAdminUsuarioDao = new AdminUsuarioDao();
		return $objAdminUsuarioDao->excluir($objAdminUsuario);
	}
	public static function listar($parametro = null, $arrParamValor = null, $arrCampos = null, $retorno = null, $excluido = false){
		$objAdminUsuarioDao = new AdminUsuarioDao();
		return $objAdminUsuarioDao->listar($parametro, $arrParamValor, $arrCampos, $retorno, $excluido);
	}

}

/**
 * Perfil de usuarios do sistema adminiativo
 */
Class ControllerAdminPerfil{

	public static function cadastrar($objAdminPerfil){
		$objAdminPerfilDao = new AdminPerfilDao();
		return $objAdminPerfilDao->cadastrar($objAdminPerfil);
	}
	public static function editar($objAdminPerfil){
		$objAdminPerfilDao = new AdminPerfilDao();
		return $objAdminPerfilDao->editar($objAdminPerfil);
	}
	public static function excluir($objAdminPerfil){
		$objAdminPerfilDao = new AdminPerfilDao();
		return $objAdminPerfilDao->excluir($objAdminPerfil);
	}
	public static function listar($parametro = null, $arrParamValor = null, $arrCampos = null, $retorno = null, $excluido = false){
		$objAdminPerfilDao = new AdminPerfilDao();
		return $objAdminPerfilDao->listar($parametro, $arrParamValor, $arrCampos, $retorno, $excluido);
	}

}

/**
 * permissão do perfil de usuarios para modulos e paginas do sistema adminiativo
 */
Class ControllerAdminPermissao{

	public static function cadastrar($objAdminPermissao){
		$objAdminPermissaoDao = new AdminPermissaoDao();
		return $objAdminPermissaoDao->cadastrar($objAdminPermissao);
	}
	public static function excluir($objAdminPermissao){
		$objAdminPermissaoDao = new AdminPermissaoDao();
		return $objAdminPermissaoDao->excluir($objAdminPermissao);
	}
	public static function listar($parametro = null, $arrParamValor = null, $arrCampos = null, $retorno = null, $excluido = false){
		$objAdminPermissaoDao = new AdminPermissaoDao();
		return $objAdminPermissaoDao->listar($parametro, $arrParamValor, $arrCampos, $retorno, $excluido);
	}

}


/**
 * log de acesso de usuarios do sistema adminiativo
 */
Class ControllerAdminLog{

	public static function cadastrar($objAdminLog){
		$objAdminLogDao = new AdminLogDao();
		return $objAdminLogDao->cadastrar($objAdminLog);
	}
	public static function listar($parametro = null, $arrParamValor = null, $arrCampos = null, $retorno = null, $excluido = false){
		$objAdminLogDao = new AdminLogDao();
		return $objAdminLogDao->listar($parametro, $arrParamValor, $arrCampos, $retorno, $excluido);
	}

}