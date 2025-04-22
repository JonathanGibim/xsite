<?php

/**
 * 
 * MENU
 * 
 **/

$codeModulo = "menu";
if($objRoute->getArrUrl(1) == $codeModulo){

	$modulo = "Menu";
	$urlAdminModulo = URL_ADMIN.$codeModulo."/";
	$pathModulo = PATH_MODULO."menu/";

	if($objRoute->getArrUrl(2) == 'gerenciar'){

		$pagina = "Gerenciar";
		$arrMenu = ControllerMenu::listar("1 = 1 ORDER BY ordem ASC", null, array('id','id_superior','nome', 'link', 'target', 'ordem'));

		$arrRecursos[] = 'data-table';
		$arrRecursos[] = 'sweet-alert';
		$arrRecursos[] = 'toastr';
		$arrRecursos[] = 'ordenar';
		$objRoute->setView($pathModulo.'view/admin/gerenciar.php');

	}

	if($objRoute->getArrUrl(2) == 'cadastrar'){

		$pagina = "Cadastrar";

		$arrMenuSuperior = ControllerMenu::listar();
		$nome = null;
		$link = null;
		$target = null;
		$idSuperior = null;

		if(isset($_POST['submitForm'])){

			$nome = Controller::validaPost($_POST['nome']);
			$link = Controller::validaPost($_POST['link']);
			$target = Controller::validaPost($_POST['target']);
			$idSuperior = Controller::validaPost($_POST['idSuperior']);

			$objMenu = new Menu();
			$objMenu->setNome($nome);
			$objMenu->setLink($link);
			$objMenu->setTarget($target);
			$objMenu->setIdSuperior($idSuperior);

			$arrValidaAtributo = $objMenu->validaAtributos('cadastrar');
			if($arrValidaAtributo === true){
				if(ControllerMenu::cadastrar($objMenu)){
					
					$alertaSistema .= Controller::utilsAlert('Cadastro realizado com sucesso!', 'success');

					Controller::utilsAlertFloat('Cadastro realizado com sucesso!', 'success', 2000);
					header('LOCATION:'.URL_ADMIN.$objRoute->getArrUrl(1)."/gerenciar");

				}else{
					$alertaSistema .= Controller::utilsAlert(null, 'error');
				}
			}else{
				$alertaErro = null;
				foreach($arrValidaAtributo as $MsgErro){
					$alertaErro .= $MsgErro."<br>";
				}
				$alertaSistema .= Controller::utilsAlert($alertaErro, 'danger');
			}
		}

		$objRoute->setView($pathModulo.'view/admin/cadastrar.php');

	}

	if($objRoute->getArrUrl(2) == 'editar'){

		$pagina = "Editar";
		$arrMenuSuperior = ControllerMenu::listar();

		$id = Controller::validaGet($objRoute->getArrUrl(3));

		$objMenu = ControllerMenu::listar("id = :id", array(':id' => $id), null, "obj");
		if($objMenu instanceof Menu){

			$idSuperior = $objMenu->getIdSuperior();
			$nome = $objMenu->getNome();
			$link = $objMenu->getLink();
			$target = $objMenu->getTarget();

			if(isset($_POST['submitForm'])){

				$idSuperior = Controller::validaPost($_POST['idSuperior']);
				$nome = Controller::validaPost($_POST['nome']);
				$link = Controller::validaPost($_POST['link']);
				$target = Controller::validaPost($_POST['target']);

				$objMenu->setIdSuperior($idSuperior);
				$objMenu->setNome($nome);
				$objMenu->setLink($link);
				$objMenu->setTarget($target);

				$arrValidaAtributo = $objMenu->validaAtributos('editar');
				if($arrValidaAtributo === true){
					if(ControllerMenu::editar($objMenu)){
						$alertaSistema .= Controller::utilsAlert('Modificação realizada com sucesso!', 'success');
					}else{
						$alertaSistema .= Controller::utilsAlert(null, 'error');
					}
				}else{
					$alertaErro = null;
					foreach($arrValidaAtributo as $MsgErro){
						$alertaErro .= $MsgErro."<br>";
					}
					$alertaSistema .= Controller::utilsAlert($alertaErro, 'danger');
				}

			}

			$arrRecursos[] = 'select2';
			$objRoute->setView($pathModulo."view/admin/editar.php");

		}else{
			$objRoute->setView(PATH_ADMIN."404.php");
		}
	}


	if($objRoute->getArrUrl(2) == 'excluir'){
		$pagina = "Excluir";
		// Exclusão por ajax -- _footer.php
		$id = Controller::validaGet($objRoute->getArrUrl(3));
		$objMenu = ControllerMenu::listar("id = :id", array(':id' => $id), array('id'), "obj");
		if($objMenu instanceof Menu){
			if(ControllerMenu::excluir($objMenu)){
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
				$objMenu = new Menu();
				$objMenu->setId($item['id']);
				$objMenu->setOrdem($item['ordem']);
				ControllerMenu::ordenar($objMenu);
			}
			echo 1;
			die();
		} else {
			echo 0;
			die();
		}
	}

}