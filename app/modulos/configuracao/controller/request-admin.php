<?php

/**
 * 
 * PÁGINA
 * 
 **/

$codeModulo = "configuracao";
if ($objRoute->getArrUrl(1) == $codeModulo) {

	$modulo = "Página";
	$urlAdminModulo = URL_ADMIN . $codeModulo . "/";
	$pathModulo = PATH_MODULO . "configuracao/";

	if($objAdminUsuarioLogado->getId() == '1' ){

		if ($objRoute->getArrUrl(2) == 'gerenciar') {

			/* exibir imagem antiga */
			$src = null;
			$class = null;
			$arrCampos = null;

			$arrConfiguracao = ControllerConfiguracao::listar();
			foreach ($arrConfiguracao as $objConfiguracao) {
				$arrCampos[$objConfiguracao->getNome()] = $objConfiguracao->getDescricao();
				if($objConfiguracao->getNome() == 'imagem'){
					$src = $objConfiguracao->getImagemUrl();
					$class = "img-thumbnail";
				}
			}

			if (isset($_POST['submitForm'])) {

				$alertaErro = null;

				$arrCampos = Controller::validaArray($_POST['arrCampos']);

				foreach ($arrCampos as $key => $value) {

					$objConfiguracao = new configuracao();
					$objConfiguracao->setNome($key);
					$objConfiguracao->setDescricao($value);

					if($key == 'imagem'){
						$src = $objConfiguracao->getImagemUrl();
						$class = "img-thumbnail";
					}

					if(!ControllerConfiguracao::cadastrar($objConfiguracao)){
						$alertaErro .= "<br> Erro ao modificar o campo ".$key." com valor de ".$value;
					}

				}

				if (empty($alertaErro)) {
					$alertaSistema .= Controller::utilsAlert('Modificação realizada com sucesso!', 'success');
				} else {
					$alertaSistema .= Controller::utilsAlert($alertaErro, 'danger');
				}

			}elseif(isset($_FILES["croppedImage"])) {

				$objConfiguracao = new configuracao();
				$response = $objConfiguracao->uploadImagem();
				echo json_encode($response);
				die();

			}

			$arrRecursos[] = 'colorpicker';
			$arrRecursos[] = 'cropperjs';
			$arrRecursos[] = 'inputmask';
			$objRoute->setView($pathModulo . 'view/admin/gerenciar.php');
		}

	}else{

		/* exibir imagem antiga */
		$src = null;
		$class = null;
		$arrCampos = null;

		$arrConfiguracao = ControllerConfiguracao::listar();
		foreach ($arrConfiguracao as $objConfiguracao) {
			$arrCampos[$objConfiguracao->getNome()] = $objConfiguracao->getDescricao();
			if($objConfiguracao->getNome() == 'imagem'){
				$src = $objConfiguracao->getImagemUrl();
				$class = "img-thumbnail";
			}
		}
		
		$alertaSistema .= Controller::utilsAlert('Informações não podem ser modificadas na versão demo!', 'info');
		$arrRecursos[] = 'colorpicker';
		$arrRecursos[] = 'cropperjs';
		$arrRecursos[] = 'inputmask';
		$objRoute->setView($pathModulo . 'view/admin/gerenciar.php');
	}

}