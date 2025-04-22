<?php
/**
* ROUTES
* Responsavel por chamar as rotas do site
*/

/**
 * seta variaveis globais de alerta e array de recursos
 */
$alertaSistema = null;
$arrRecursos = array();

/**
 * Atribul e inicia as rotas e caso não tenha aponta para inicio
 */
$url = isset($_GET['url']) ? $_GET['url'] : 'inicio';
$objRoute = new Route($url);

/**
 * inclui a request do modulo
 */
$pathRequest = PATH_MODULO.$objRoute->getArrUrl(0).'/controller/request.php';
if(is_file($pathRequest)){
	require_once $pathRequest;
}

/**
 * verifica se existe a view caso não encontre, procura na public 
 */
if(!is_file($objRoute->getView())){
	$objRoute->setView(PATH_PUBLIC.$objRoute->getArrUrl(0).".php");
}


/**
 * inclui a request do modulo pagina
 */
$pathRequest = PATH_MODULO.'pagina/controller/request.php';
if(is_file($pathRequest)){
	require_once $pathRequest;
}


/**
 * verifica se existe a view caso não encontre exibe a pagina 404
 */
if(!is_file($objRoute->getView())){
	header('HTTP/1.1 404 Not Found');
	$objRoute->setView(PATH_PUBLIC."404.php");
}