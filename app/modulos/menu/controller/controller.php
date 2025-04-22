<?php

/**
 * Carrega a model e DAO do modulo
 */
require_once PATH_MODULO.'menu/model/menu.php';
require_once PATH_MODULO.'menu/model/menuDao.php';

Class ControllerMenu{

	public static function cadastrar($objMenu){
		$objMenuDao = new MenuDao();
		return $objMenuDao->cadastrar($objMenu);
	}
	public static function editar($objMenu){
		$objMenuDao = new MenuDao();
		return $objMenuDao->editar($objMenu);
	}
	public static function excluir($objMenu){
		$objMenuDao = new MenuDao();
		return $objMenuDao->excluir($objMenu);
	}
	public static function ordenar($objMenu){
		$objMenuDao = new MenuDao();
		return $objMenuDao->ordenar($objMenu);
	}
	public static function listar($parametro = null, $arrParamValor = null, $arrCampos = null, $retorno = null, $excluido = false){
		$objMenuDao = new MenuDao();
		return $objMenuDao->listar($parametro, $arrParamValor, $arrCampos, $retorno, $excluido);
	}

}