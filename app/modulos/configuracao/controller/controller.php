<?php

/**
 * Carrega a model e DAO do modulo
 */
require_once PATH_MODULO.'configuracao/model/configuracao.php';
require_once PATH_MODULO.'configuracao/model/configuracaoDao.php';

Class ControllerConfiguracao{

	public static function cadastrar($objConfiguracao){
		$objConfiguracaoDao = new ConfiguracaoDao();
		return $objConfiguracaoDao->cadastrar($objConfiguracao);
	}
	public static function editar($objConfiguracao){
		$objConfiguracaoDao = new ConfiguracaoDao();
		return $objConfiguracaoDao->editar($objConfiguracao);
	}
	public static function listar($parametro = null, $arrParamValor = null, $arrCampos = null, $retorno = null, $excluido = false){
		$objConfiguracaoDao = new ConfiguracaoDao();
		return $objConfiguracaoDao->listar($parametro, $arrParamValor, $arrCampos, $retorno, $excluido);
	}

}