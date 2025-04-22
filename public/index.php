<?php

/**
 * Configurações do sistema
 */
require_once '../app/config.php';

/**
 * Carregamento de classes do vendor composer
 */
require_once PATH.'vendor/autoload.php';

/**
 * Carregamento de classes do sistema
 */
require_once PATH_SISTEMA.'autoload.php';

/**
 * Carregamento de rotas do sistema
 */
require_once PATH_SISTEMA.'core/routes.php';


/**
 * Definição de configuraçoes/personalização via admin
 */
$arrConfiguracao = ControllerConfiguracao::listar();
foreach ($arrConfiguracao as $objConfiguracao) {
	$arrCampos[$objConfiguracao->getNome()] = $objConfiguracao->getDescricao();
	if($objConfiguracao->getNome() == 'imagem'){
		$arrCampos[$objConfiguracao->getNome()] = $objConfiguracao->getImagemUrl();
	}
	if($objConfiguracao->getNome() == 'telefone'){
		$arrCampos['telefone_limpo'] = $objConfiguracao->getNumLimpo($objConfiguracao->getDescricao());
	}
	if($objConfiguracao->getNome() == 'whatsapp'){
		$arrCampos['whatsapp_limpo'] = $objConfiguracao->getNumLimpo($objConfiguracao->getDescricao());
	}
}
$arrCampos['formulario'] = "";

/**
 * Criar array com variaveis inseridas no editor, para alterar na exibição
 */
if($arrCampos){
	foreach ($arrCampos as $key => $value) {
		$arrCamposKeys[] = '{{'.$key.'}}';
	}
}

/**
 * Carregamento de view
 */
if(!empty($objRoute->getView())){
	require_once($objRoute->getView());
}