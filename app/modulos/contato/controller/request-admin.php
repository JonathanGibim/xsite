<?php

/**
 * 
 * CONTATO
 * 
 **/

$codeModulo = "contato";
if($objRoute->getArrUrl(1) == $codeModulo){

	$modulo = "Contato";
	$UrlAdminModulo = URL_ADMIN.$codeModulo."/";
	$pathModulo = PATH_MODULO."contato/";

	if($objRoute->getArrUrl(2) == 'gerenciar'){

		$pagina = "Gerenciar";
		$arrContato = ControllerContato::listar(null, null, array('id','nome','email', 'assunto'));

		$arrRecursos[] = 'data-table';
		$arrRecursos[] = 'toastr';
		$arrRecursos[] = 'sweet-alert';
		$objRoute->setView($pathModulo.'view/admin/gerenciar.php');

	}

	if($objRoute->getArrUrl(2) == 'cadastrar'){

		$pagina = "Cadastrar";

		$nome = null;
		$email = null;
		$telefone = null;
		$assunto = null;
		$mensagem = null;

		if(isset($_POST['submitForm'])){

			$nome = Controller::validaPost($_POST['Nome']);
			$email = Controller::validaPost($_POST['Email']);
			$telefone = Controller::validaPost($_POST['Telefone']);
			$assunto = Controller::validaPost($_POST['Assunto']);
			$mensagem = Controller::validaPost($_POST['Mensagem']);

			$objContato = new Contato();
			$objContato->setNome($nome);
			$objContato->setEmail($email);
			$objContato->setTelefone($telefone);
			$objContato->setAssunto($assunto);
			$objContato->setMensagem($mensagem);
			$objContato->setVisualizado(0);

			$arrValidaAtributo = $objContato->validaAtributos('cadastrar');
			if($arrValidaAtributo === true){
				if(ControllerContato::cadastrar($objContato)){
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

		$arrRecursos[] = 'bootstrap-switch';
		$objRoute->setView($pathModulo.'view/admin/cadastrar.php');

	}

	if($objRoute->getArrUrl(2) == 'detalhes'){

		$pagina = "Detalhes";

		$id = Controller::validaGet($objRoute->getArrUrl(3));

		$objContato = ControllerContato::listar("id = :id", array(':id' => $id), null, "obj");
		if($objContato instanceof Contato){

			$nome = $objContato->getNome();
			$email = $objContato->getEmail();
			$telefone = $objContato->getTelefone();
			$assunto = $objContato->getAssunto();
			$mensagem = $objContato->getMensagem();

			$objContato->setVisualizado(1);
			ControllerContato::visualizado($objContato);

			$objRoute->setView($pathModulo.'view/admin/detalhes.php');

		}else{

			$objRoute->setView(PATH_ADMIN."404.php");

		}

	}

	if($objRoute->getArrUrl(2) == 'excluir'){
		$pagina = "Excluir";
		// Exclusão por ajax -- _footer.php
		$id = Controller::validaGet($objRoute->getArrUrl(3));
		$objContato = ControllerContato::listar("id = :id", array(':id' => $id), array('id'), "obj");
		if($objContato instanceof contato){
			if(ControllerContato::excluir($objContato)){
				echo 1;
				die();
			}
		}
		echo 0;
		die();
	}

}