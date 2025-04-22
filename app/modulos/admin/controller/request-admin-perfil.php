<?php


/**
* 
* MODULO
* 
**/

$codeModulo = "perfil";

if($objRoute->getArrUrl(1) == $codeModulo){

	$modulo = "Perfil";
	$urlAdminModulo = URL_ADMIN.$codeModulo."/";
	$pathModulo = PATH_MODULO."admin/";

	if($objRoute->getArrUrl(2) == 'gerenciar'){

		$pagina = "Gerenciar";

		$arrAdminPerfil = ControllerAdminPerfil::listar("id > 1");

		$arrRecursos[] = 'data-table';
		$arrRecursos[] = 'sweet-alert';
		$arrRecursos[] = 'toastr';
		$objRoute->setView($pathModulo."view/perfil/gerenciar.php");

	}


	if($objRoute->getArrUrl(2) == 'cadastrar'){

		$pagina = "Cadastrar";

		$nome = null;
		$descricao = null;
		$icone = null;

		if(isset($_POST['submitForm'])){

			$nome = Controller::validaPost($_POST['nome']);
			$descricao = Controller::validaPost($_POST['descricao']);

			$objAdminPerfil = new AdminPerfil();
			$objAdminPerfil->setNome($nome);
			$objAdminPerfil->setDescricao($descricao);

			$arrValidaAtributo = $objAdminPerfil->validaAtributos('cadastrar');
			if($arrValidaAtributo === true){
				if(ControllerAdminPerfil::cadastrar($objAdminPerfil)){
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
		$objRoute->setView($pathModulo."view/perfil/cadastrar.php");

	}


	if($objRoute->getArrUrl(2) == 'editar'){

		$pagina = "Editar";

		$id = Controller::validaGet($objRoute->getArrUrl(3));

		$objAdminPerfil = ControllerAdminPerfil::listar("id > 1 AND id = :id", array(':id' => $id), null, "obj");
		if($objAdminPerfil instanceof adminPerfil){

			$nome = $objAdminPerfil->getNome();
			$descricao = $objAdminPerfil->getDescricao();

			if(isset($_POST['submitForm'])){

				$nome = Controller::validaPost($_POST['nome']);
				$descricao = Controller::validaPost($_POST['descricao']);

				$objAdminPerfil->setNome($nome);
				$objAdminPerfil->setDescricao($descricao);

				$arrValidaAtributo = $objAdminPerfil->validaAtributos('editar');
				if($arrValidaAtributo === true){
					if(ControllerAdminPerfil::editar($objAdminPerfil)){
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

			$arrRecursos[] = 'bootstrap-switch';
			$objRoute->setView($pathModulo."view/perfil/editar.php");

		}else{

			$objRoute->setView(PATH_ADMIN."404.php");
			
		}
	}

	if($objRoute->getArrUrl(2) == 'excluir'){
		$pagina = "Excluir";
		// Exclusão por ajax -- _footer.php
		$id = Controller::validaGet($objRoute->getArrUrl(3));
		$objAdminPerfil = ControllerAdminPerfil::listar("id > 1 AND id = :id", array(':id' => $id), array('id'), "obj");
		if($objAdminPerfil instanceof adminPerfil){
			if(ControllerAdminPerfil::excluir($objAdminPerfil)){
				echo 1;
				die();
			}
		}
		echo 0;
		die();
	}







	/**
	 * 
	 * PERMISSÕES
	 * 
	 **/

	if($objRoute->getArrUrl(2) == 'permissoes'){

		$arrRecursos[] = 'icheck';

		$pagina = "Permissões";

		$id = Controller::validaGet($objRoute->getArrUrl(3));

		/* não lista as permissoes do proprio perfil */
		$idListaModuloMaiorQue = 1;
		if($objAdminUsuarioLogado->getAdminPerfil()->getId() == $id){
			$idListaModuloMaiorQue = 2;
		}

		$objAdminPerfil = ControllerAdminPerfil::listar("id > 1 AND id = :id", array(':id' => $id), null, "obj");

		$arrAdminModulo = ControllerAdminModulo::listar("id > ".$idListaModuloMaiorQue." ORDER BY ordem ASC ");

		$arrPermissoes = array();
		$arrChkPermissoes = array();

		if(isset($_POST['submitForm'])){

			if(isset($_POST['chkPermissoes'])){
				$arrChkPermissoes = Controller::validaArray($_POST['chkPermissoes']);

				/* adiciona as permissoes do proprio perfil */
				if($objAdminUsuarioLogado->getAdminPerfil()->getId() == $id){
					$arrChkPermissoes[2] = array(7 => 'on', 8 => 'on', 9 => 'on', 10 => 'on', 11 => 'on');
				}

			}
			
			if($arrChkPermissoes){

				$objAdminPermissao = new AdminPermissao();
				$objAdminPermissao->setAdminPerfil($objAdminPerfil);
				
				ControllerAdminPermissao::excluir($objAdminPermissao);

				foreach ($arrChkPermissoes as $idModulo => $arrModulo) {

					foreach ($arrModulo as $idPagina => $OnOff) {

						$objAdminModulo = ControllerAdminModulo::listar("id > 1 AND id = :id", array(':id' => $idModulo), null, "obj");

						$objAdminPagina = ControllerAdminPagina::listar("id = :id", array(':id' => $idPagina), null, "obj");

						$objAdminPermissao = new AdminPermissao();
						$objAdminPermissao->setAdminPerfil($objAdminPerfil);
						$objAdminPermissao->setAdminModulo($objAdminModulo);
						$objAdminPermissao->setAdminPagina($objAdminPagina);

						$arrValidaAtributo = $objAdminPermissao->validaAtributos();
						if($arrValidaAtributo === true){
							if(ControllerAdminPermissao::cadastrar($objAdminPermissao)){
								//$alertaSistema .= Controller::utilsAlert('Permissões de <b>'.$objAdminModulo->getNome().'</b> atualizadas com sucesso!', 'success');
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
				}

				if(empty($alertaSistema)){
					$alertaSistema .= Controller::utilsAlert('Permissões atualizadas com sucesso!', 'success');
				}

			}

		}

		$arrRecursos[] = 'bootstrap-switch';
		$objRoute->setView($pathModulo."view/perfil/permissoes.php");

	}

}