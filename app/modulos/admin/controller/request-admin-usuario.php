<?php

/**
 * 
 * ADMIN USUARIO
 * 
 **/

$codeModulo = "usuario";
if($objRoute->getArrUrl(1) == $codeModulo){

	$modulo = "Admin Usuário";
	$urlAdminModulo = URL_ADMIN.$codeModulo."/";
	$pathModulo = PATH_MODULO."admin/";

	if($objRoute->getArrUrl(2) == 'gerenciar'){

		$pagina = "Gerenciar";
		$arrAdminUsuario = ControllerAdminUsuario::listar("id > :id AND id <> :id_login ", array(':id' => '1', ':id_login' => $objAdminUsuarioLogado->getId() ), null, array('id','nome','email','ativo'));

		$arrRecursos[] = 'data-table';
		$arrRecursos[] = 'sweet-alert';
		$arrRecursos[] = 'toastr';
		$objRoute->setView($pathModulo."view/usuario/gerenciar.php");
	}

	if($objRoute->getArrUrl(2) == 'cadastrar'){

		$pagina = "Cadastrar";

		$arrAdminPerfil = ControllerAdminPerfil::listar("id > 1");
		$idPerfil = null;
		$nome = null;
		$email = null;
		$senha = null;
		$senha2 = null;
		$ativo = null;

		if(isset($_POST['submitForm'])){

			$idPerfil = Controller::validaPost($_POST['perfil']);
			$nome = Controller::validaPost($_POST['nome']);
			$email = Controller::validaPost($_POST['email']);
			$senha = Controller::validaPost($_POST['senha']);
			$senha2 = Controller::validaPost($_POST['senha2']);
			$ativo = Controller::validaPost(isset($_POST['ativo']) ? $_POST['ativo'] : "off" );
			$ativo = Controller::converteVar($ativo, 'checkbox');

			$objAdminUsuario = new AdminUsuario();
			$objAdminPerfil = ControllerAdminPerfil::listar("id = :id AND id > 1", array(':id' => $idPerfil), array('id'), "obj");
			if($objAdminPerfil instanceof adminPerfil){
				$objAdminUsuario->setAdminPerfil($objAdminPerfil);
			}
			$objAdminUsuario->setNome($nome);
			$objAdminUsuario->setEmail($email);
			$objAdminUsuario->setSenha($senha);
			$objAdminUsuario->setSenha2($senha2);
			$objAdminUsuario->setAtivo($ativo);

			$arrValidaAtributo = $objAdminUsuario->validaAtributos('cadastrar');
			if($arrValidaAtributo === true){
				if(ControllerAdminUsuario::cadastrar($objAdminUsuario)){
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

		$arrRecursos[] = 'select2';
		$arrRecursos[] = 'bootstrap-switch';
		$objRoute->setView($pathModulo."view/usuario/cadastrar.php");

	}

	if($objRoute->getArrUrl(2) == 'editar'){

		$pagina = "Editar";

		$id = Controller::validaGet($objRoute->getArrUrl(3));

		$objAdminUsuario = ControllerAdminUsuario::listar("id = :id AND id_perfil > 1", array(':id' => $id), null, "obj");
		if($objAdminUsuario instanceof AdminUsuario){

			$arrAdminPerfil = ControllerAdminPerfil::listar("id > 1");
			$idPerfil = $objAdminUsuario->getAdminPerfil()->getId();
			$nome = $objAdminUsuario->getNome();
			$email = $objAdminUsuario->getEmail();
			$senha = null;
			$senha2 = null;
			$ativo = $objAdminUsuario->getAtivo();

			if(isset($_POST['submitForm'])){

				$idPerfil = Controller::validaPost($_POST['perfil']);
				$nome = Controller::validaPost($_POST['nome']);
				$email = Controller::validaPost($_POST['email']);
				$senha = Controller::validaPost($_POST['senha']);
				$senha2 = Controller::validaPost($_POST['senha2']);
				$ativo = Controller::validaPost(isset($_POST['ativo']) ? $_POST['ativo'] : "off" );
				$ativo = Controller::converteVar($ativo, 'checkbox');

				$objAdminPerfil = ControllerAdminPerfil::listar("id = :id", array(':id' => $idPerfil), null, "obj");
				if($objAdminPerfil instanceof adminPerfil){
					$objAdminUsuario->setAdminPerfil($objAdminPerfil);
				}
				$objAdminUsuario->setNome($nome);
				$objAdminUsuario->setEmail($email);
				$objAdminUsuario->setSenhaAntiga($objAdminUsuario->getSenha());
				$objAdminUsuario->setSenha($senha);
				$objAdminUsuario->setSenha2($senha2);
				if($objAdminUsuarioLogado->getId() != $id){
					$objAdminUsuario->setAtivo($ativo);
				}

				$arrValidaAtributo = $objAdminUsuario->validaAtributos('editar');
				if($arrValidaAtributo === true){
					if(ControllerAdminUsuario::editar($objAdminUsuario)){
						$alertaSistema .= Controller::utilsAlert('Modificação realizado com sucesso!', 'success');
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
			$arrRecursos[] = 'bootstrap-switch';
			$objRoute->setView($pathModulo."view/usuario/editar.php");

		}else{

			$objRoute->setView(PATH_ADMIN."404.php");

		}

	}


	if($objRoute->getArrUrl(2) == 'perfil'){

		$modulo = "Meu Perfil";
		$pagina = "Perfil";

		if(isset($_GET['altera-senha']) AND !isset($_POST['submitForm'])){
			$alertaSistema .= Controller::utilsAlert("Por segurança, recomendamos que você altere sua senha", 'info');
		}

		$objAdminUsuario = $objAdminUsuarioLogado;

		if($objAdminUsuarioLogado instanceof AdminUsuario){

			$nome = $objAdminUsuario->getNome();
			$email = $objAdminUsuario->getEmail();
			$senha = null;
			$senha2 = null;

			if(isset($_POST['submitForm'])){

				$nome = Controller::validaPost($_POST['nome']);
				$email = Controller::validaPost($_POST['email']);
				$senha = Controller::validaPost($_POST['senha']);
				$senha2 = Controller::validaPost($_POST['senha2']);

				$objAdminUsuario->setNome($nome);
				$objAdminUsuario->setEmail($email);
				$objAdminUsuario->setSenhaAntiga($objAdminUsuario->getSenha());
				$objAdminUsuario->setSenha($senha);
				$objAdminUsuario->setSenha2($senha2);

				$arrValidaAtributo = $objAdminUsuario->validaAtributos('editar');
				if($arrValidaAtributo === true){
					if(ControllerAdminUsuario::editar($objAdminUsuario)){
						$alertaSistema .= Controller::utilsAlert('Modificação realizado com sucesso!', 'success');
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
			$arrRecursos[] = 'bootstrap-switch';
			$objRoute->setView($pathModulo."view/usuario/perfil.php");

		}else{

			$objRoute->setView(PATH_ADMIN."404.php");

		}

	}

	if($objRoute->getArrUrl(2) == 'excluir'){
		$pagina = "Excluir";
		// Exclusão por ajax -- _footer.php
		$id = Controller::validaGet($objRoute->getArrUrl(3));
		$objAdminUsuario = ControllerAdminUsuario::listar("id = :id", array(':id' => $id), array('id'), "obj");
		if($objAdminUsuario instanceof AdminUsuario){
			if(ControllerAdminUsuario::excluir($objAdminUsuario)){
				echo 1;
				die();
			}
		}
		echo 0;
		die();
	}


}