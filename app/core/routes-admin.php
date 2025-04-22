<?php
/**
* ROUTES
* Responsavel por chamar as rotas de admin
*/

/**
 * seta variaveis globais de alerta e array de recursos
 */
$alertaSistema = null;
$arrRecursos = array();

/**
 * Atribul e inicia as rotas e caso não tenha aponta para home
 */
$url = DIR_ADMIN.'/'.(isset($_GET['url']) ? $_GET['url'] : 'dashboard');
$objRoute = new Route($url);

/**
 * importa as reuqests do admin
 */
require_once PATH_MODULO.DIR_ADMIN.'/controller/request.php';

/**
 * inclui a request do modulo
 */
$pathRequest = PATH_MODULO.$objRoute->getArrUrl(1).'/controller/request-admin.php';
if(is_file($pathRequest)){
	require_once $pathRequest;
}

/**
 * verifica se existe a view caso não encontre, procura na public 
 */
if(!is_file($objRoute->getView())){
	$objRoute->setView(PATH_MODULO.DIR_ADMIN.'/view/'.$objRoute->getArrUrl(1)."/".$objRoute->getArrUrl(2).'.php');
}

/**
 * verifica se existe a view caso não encontre exibe a pagina 404
 */
if(!is_file($objRoute->getView())){
	header('HTTP/1.1 404 Not Found');
	$objRoute->setView(PATH_ADMIN."404.php");
}