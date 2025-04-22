<?php

/**
 * Carrega a model e DAO do modulo
 */
require_once PATH_MODULO.'pagina/model/pagina.php';
require_once PATH_MODULO.'pagina/model/paginaDao.php';

Class ControllerPagina{

	public static function cadastrar($objPagina){
		$objPaginaDao = new PaginaDao();
		return $objPaginaDao->cadastrar($objPagina);
	}
	public static function editar($objPagina){
		$objPaginaDao = new PaginaDao();
		return $objPaginaDao->editar($objPagina);
	}
	public static function excluir($objPagina){
		$objPaginaDao = new PaginaDao();
		return $objPaginaDao->excluir($objPagina);
	}
	public static function ordenar($objPagina){
		$objPaginaDao = new PaginaDao();
		return $objPaginaDao->ordenar($objPagina);
	}
	public static function listar($parametro = null, $arrParamValor = null, $arrCampos = null, $retorno = null, $excluido = false){
		$objPaginaDao = new PaginaDao();
		return $objPaginaDao->listar($parametro, $arrParamValor, $arrCampos, $retorno, $excluido);
	}

}