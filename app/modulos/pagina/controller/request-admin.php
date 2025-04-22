<?php

/**
 * 
 * PÁGINA
 * 
 **/

$codeModulo = "pagina";
if ($objRoute->getArrUrl(1) == $codeModulo) {

	$modulo = "Página";
	$urlAdminModulo = URL_ADMIN . $codeModulo . "/";
	$pathModulo = PATH_MODULO . "pagina/";

	if ($objRoute->getArrUrl(2) == 'gerenciar') {
		$pagina = "Gerenciar";
		$arrPagina = ControllerPagina::listar(" 1 = 1 ORDER BY ordem ASC", null, array('id', 'id_menu', 'link', 'nome', 'conteudo', 'meta_title', 'meta_description', 'ordem'));
		
		$arrRecursos[] = 'data-table';
		$arrRecursos[] = 'sweet-alert';
		$arrRecursos[] = 'toastr';
		$arrRecursos[] = 'ordenar';
		$objRoute->setView($pathModulo . 'view/admin/gerenciar.php');
	}

	if ($objRoute->getArrUrl(2) == 'cadastrar') {
		$pagina = "Cadastrar";

		$arrMenu = ControllerMenu::listar("nome <> '{{categorias}}'");
		$nome = $link = $conteudo = $metaTitle = $metaDescription = null;
		$idMenu = $ordem = null;

		if (isset($_POST['submitForm'])) {
			$nome = Controller::validaPost($_POST['nome']);
			$link = Controller::validaPost($_POST['link']);
			$conteudo = Controller::validaPost($_POST['conteudo']);
			$metaTitle = Controller::validaPost($_POST['meta_title']);
			$metaDescription = Controller::validaPost($_POST['meta_description']);
			$idMenu = Controller::validaPost($_POST['id_menu']);

			$objPagina = new Pagina();
			$objPagina->setNome($nome);
			$objPagina->setLink($link);
			$objPagina->setConteudo($conteudo);
			$objPagina->setMetaTitle($metaTitle);
			$objPagina->setMetaDescription($metaDescription);
			$objPagina->setIdMenu($idMenu);
			$objPagina->setOrdem($ordem);

			$arrValidaAtributo = $objPagina->validaAtributos('cadastrar');
			if ($arrValidaAtributo === true) {
				if (ControllerPagina::cadastrar($objPagina)) {
					$alertaSistema .= Controller::utilsAlert('Cadastro realizado com sucesso!', 'success');
					
					Controller::utilsAlertFloat('Cadastro realizado com sucesso!', 'success', 2000);
					header('LOCATION:'.URL_ADMIN.$objRoute->getArrUrl(1)."/gerenciar");
					
				} else {
					$alertaSistema .= Controller::utilsAlert(null, 'error');
				}
			} else {
				$alertaErro = implode("<br>", $arrValidaAtributo);
				$alertaSistema .= Controller::utilsAlert($alertaErro, 'danger');
			}
		}

		$arrRecursos[] = 'select2';
		$arrRecursos[] = 'summernote';
		$arrRecursos[] = 'pagina-cad-edit';
		$objRoute->setView($pathModulo . 'view/admin/cadastrar.php');
	}

	if ($objRoute->getArrUrl(2) == 'editar') {
		$pagina = "Editar";

		$id = Controller::validaGet($objRoute->getArrUrl(3));
		$objPagina = ControllerPagina::listar("id = :id", array(':id' => $id), null, "obj");
		if ($objPagina instanceof Pagina) {

			$arrMenu = ControllerMenu::listar("nome <> '{{categorias}}'");
			$idMenu = $objPagina->getIdMenu();
			$nome = $objPagina->getNome();
			$link = $objPagina->getLink();
			$conteudo = $objPagina->getConteudo();
			$metaTitle = $objPagina->getMetaTitle();
			$metaDescription = $objPagina->getMetaDescription();

			if (isset($_POST['submitForm'])) {

				$idMenu = Controller::validaPost($_POST['id_menu']);
				if(!empty($idMenu)){
					$link = null;
				}else{
					$link = Controller::validaPost($_POST['link']);
				}
				$nome = Controller::validaPost($_POST['nome']);
				$conteudo = Controller::validaPost($_POST['conteudo']);
				$metaTitle = Controller::validaPost($_POST['meta_title']);
				$metaDescription = Controller::validaPost($_POST['meta_description']);

				$objPagina->setIdMenu($idMenu);
				$objPagina->setNome($nome);
				$objPagina->setLink($link);
				$objPagina->setConteudo($conteudo);
				$objPagina->setMetaTitle($metaTitle);
				$objPagina->setMetaDescription($metaDescription);
				
				$arrValidaAtributo = $objPagina->validaAtributos('editar');
				if ($arrValidaAtributo === true) {
					if (ControllerPagina::editar($objPagina)) {
						$alertaSistema .= Controller::utilsAlert('Modificação realizada com sucesso!', 'success');
					} else {
						$alertaSistema .= Controller::utilsAlert(null, 'error');
					}
				} else {
					$alertaErro = implode("<br>", $arrValidaAtributo);
					$alertaSistema .= Controller::utilsAlert($alertaErro, 'danger');
				}
			}

			$arrRecursos[] = 'select2';
			$arrRecursos[] = 'summernote';
			$arrRecursos[] = 'pagina-cad-edit';
			$objRoute->setView($pathModulo . "view/admin/editar.php");
		} else {
			$objRoute->setView(PATH_ADMIN . "404.php");
		}
	}

	if ($objRoute->getArrUrl(2) == 'excluir') {
		$pagina = "Excluir";
		$id = Controller::validaGet($objRoute->getArrUrl(3));
		$objPagina = ControllerPagina::listar("id = :id", array(':id' => $id), array('id'), "obj");
		if ($objPagina instanceof Pagina) {
			if (ControllerPagina::excluir($objPagina)) {
				echo 1;
				die();
			}
		}
		echo 0;
		die();
	}


	if ($objRoute->getArrUrl(2) == 'ordenar') {
		// Receber a ordem dos itens via AJAX
		$dados = json_decode($_POST['ordem'], true);
		if ($dados) {
			foreach ($dados as $item) {
				$objPagina = new Pagina();
				$objPagina->setId($item['id']);
				$objPagina->setOrdem($item['ordem']);
				ControllerPagina::ordenar($objPagina);
			}
			echo 1;
			die();
		} else {
			echo 0;
			die();
		}
	}

}
