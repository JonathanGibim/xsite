<?php
/**
 * verifica se existe a view caso não encontre, procura no admin 
*/

if(!is_file($objRoute->getView())){
	$objPagina = ControllerPagina::listar('link = :link OR id_menu IN (SELECT m.id FROM menu m WHERE m.link = :link)', array(':link' => $objRoute->getArrUrl(0)), null, 'obj');
	if($objPagina instanceof Pagina){
		$objRoute->setView(PATH_PUBLIC."sistema-pagina.php");
	}
}
