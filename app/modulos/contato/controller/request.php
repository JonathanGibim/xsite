<?php

if($objRoute->getArrUrl(0) == 'contato'){

	$nome = null;
	$email = null;
	$telefone = null;
	$assunto = null;
	$mensagem = null;

	if(isset($_POST['submitForm'])){

		$nome = Controller::validaPost($_POST['nome']);
		$email = Controller::validaPost($_POST['email']);
		$telefone = Controller::validaPost($_POST['telefone']);
		$assunto = Controller::validaPost($_POST['assunto']);
		$mensagem = Controller::validaPost($_POST['mensagem']);

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

				$arrDe = array('autenticacao@xweb.com.br', 'Contato - Xweb');
				$arrPara[] = array('contato@xweb.com.br');

				Controller::emailEnviar($arrDe, $arrPara, "Form de Contato", $assunto."<br>".$mensagem);

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

	$objRoute->setView(PATH_PUBLIC.$objRoute->getArrUrl(0).".php");

}