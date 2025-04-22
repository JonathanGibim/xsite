<?php

/**
 * Carrega a model e DAO do modulo
 */
require_once PATH_MODULO.'contato/model/contato.php';
require_once PATH_MODULO.'contato/model/contatoDao.php';

Class ControllerContato{

	public static function cadastrar($objContato){
		$objContatoDao = new ContatoDao();
		return $objContatoDao->cadastrar($objContato);
	}
	public static function visualizado($objContato){
		$objContatoDao = new ContatoDao();
		return $objContatoDao->visualizado($objContato);
	}
	public static function excluir($objContato){
		$objContatoDao = new ContatoDao();
		return $objContatoDao->excluir($objContato);
	}
	public static function listar($parametro = null, $arrParamValor = null, $arrCampos = null, $retorno = null, $excluido = false){
		$objContatoDao = new ContatoDao();
		return $objContatoDao->listar($parametro, $arrParamValor, $arrCampos, $retorno, $excluido);
	}

}