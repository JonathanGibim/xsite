<?php


/**
 * 
 * MODULO
 * 
 **/

$codeModulo = "modulo";

if($objRoute->getArrUrl(1) == $codeModulo){

	$modulo = "Módulo";
	$urlAdminModulo = URL_ADMIN.$codeModulo."/";
	$pathModulo = PATH_MODULO."admin/";
	
	if($objRoute->getArrUrl(2) == 'gerenciar'){

		$pagina = "Gerenciar";

		$arrAdminModulo = ControllerAdminModulo::listar("1 = 1 ORDER BY ordem ASC");

		$arrRecursos[] = 'data-table';
		$arrRecursos[] = 'sweet-alert';
		$arrRecursos[] = 'ordenar';
		$objRoute->setView($pathModulo."view/modulo/gerenciar.php");

	}


	if($objRoute->getArrUrl(2) == 'cadastrar'){

		$pagina = "Cadastrar";

		$nome = null;
		$descricao = null;
		$icone = null;

		if(isset($_POST['submitForm'])){

			$nome = Controller::validaPost($_POST['nome']);
			$descricao = Controller::validaPost($_POST['descricao']);
			$icone = Controller::validaPost($_POST['icone']);

			$objAdminModulo = new AdminModulo();
			$objAdminModulo->setNome($nome);
			$objAdminModulo->setDescricao($descricao);
			$objAdminModulo->setIcone($icone);

			$arrValidaAtributo = $objAdminModulo->validaAtributos('cadastrar');
			if($arrValidaAtributo === true){
				if(ControllerAdminModulo::cadastrar($objAdminModulo)){
					$alertaSistema .= Controller::utilsAlert('Cadastro realizado com sucesso!', 'success');
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
		$objRoute->setView($pathModulo."view/modulo/cadastrar.php");

	}


	if($objRoute->getArrUrl(2) == 'editar'){

		$pagina = "Editar";

		$id = Controller::validaGet($objRoute->getArrUrl(3));

		$objAdminModulo = ControllerAdminModulo::listar("id = :id", array(':id' => $id), null, "obj");
		if($objAdminModulo instanceof adminModulo){

			$nome = $objAdminModulo->getNome();
			$descricao = $objAdminModulo->getDescricao();
			$icone = $objAdminModulo->getIcone();

			if(isset($_POST['submitForm'])){

				$nome = Controller::validaPost($_POST['nome']);
				$descricao = Controller::validaPost($_POST['descricao']);
				$icone = Controller::validaPost($_POST['icone']);

				$objAdminModulo->setNome($nome);
				$objAdminModulo->setDescricao($descricao);
				$objAdminModulo->setIcone($icone);

				$arrValidaAtributo = $objAdminModulo->validaAtributos('editar');
				if($arrValidaAtributo === true){
					if(ControllerAdminModulo::editar($objAdminModulo)){
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
			$objRoute->setView($pathModulo."view/modulo/editar.php");

		}else{

			$objRoute->setView(PATH_ADMIN."404.php");

		}

	}

	if($objRoute->getArrUrl(2) == 'excluir'){
		$pagina = "Excluir";
		// Exclusão por ajax -- _footer.php
		$id = Controller::validaGet($objRoute->getArrUrl(3));
		$objAdminModulo = ControllerAdminModulo::listar("id = :id", array(':id' => $id), array('id'), "obj");
		if($objAdminModulo instanceof adminModulo){

			/**
			 * Exclui as paginas do modulo
			 */
			$arrAdminPagina = ControllerAdminPagina::listar("id_modulo = :id_modulo", array(':id_modulo' => $id));
			if($arrAdminPagina){
				foreach($arrAdminPagina as $objAdminPagina){
					ControllerAdminPagina::excluir($objAdminPagina);
				}
			}

			/**
			 * Excluio modulo
			 */
			if(ControllerAdminModulo::excluir($objAdminModulo)){
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
				$objAdminModulo = new AdminModulo();
				$objAdminModulo->setId($item['id']);
				$objAdminModulo->setOrdem($item['ordem']);
				ControllerAdminModulo::ordenar($objAdminModulo);
			}
			echo 1;
			die();
		} else {
			echo 0;
			die();
		}
	}


	/**
	 * 
	 * PAGINA
	 * 
	 **/

	if($objRoute->getArrUrl(2) == 'paginas'){

		$arrRecursos[] = 'sweet-alert';
		$arrRecursos[] = 'ordenar';

		$UrlAdminPagina = URL_ADMIN.$codeModulo."/";

		$pagina = "Páginas";

		$id = Controller::validaGet($objRoute->getArrUrl(3));
		$objAdminModulo = ControllerAdminModulo::listar("id = :id", array(':id' => $id), null, "obj");
		$arrAdminPagina = ControllerAdminPagina::listar("id_modulo = :id_modulo ORDER BY ordem ASC", array(':id_modulo' => $id));

		$nomeModulo = $objAdminModulo->getNome();

		$nome = null;
		$descricao = null;
		$oculto = null;

		if(isset($_POST['submitForm'])){

			$nome = Controller::validaPost($_POST['nome']);
			$descricao = Controller::validaPost($_POST['descricao']);
			$oculto = Controller::validaPost(isset($_POST['oculto']) ? $_POST['oculto'] : "off" );
			$oculto = Controller::converteVar($oculto, 'checkbox');

			$objAdminPagina = new AdminPagina();
			$objAdminPagina->setAdminModulo($objAdminModulo);
			$objAdminPagina->setNome($nome);
			$objAdminPagina->setDescricao($descricao);
			$objAdminPagina->setOculto($oculto);

			$arrValidaAtributo = $objAdminPagina->validaAtributos('cadastrar');
			if($arrValidaAtributo === true){
				if(ControllerAdminPagina::cadastrar($objAdminPagina)){
					$alertaSistema .= Controller::utilsAlert('Cadastro realizado com sucesso!', 'success');
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
		$objRoute->setView($pathModulo."view/modulo/paginas.php");

	}

	if ($objRoute->getArrUrl(2) == 'ordenar-pagina') {
		// Receber a ordem dos itens via AJAX
		$dados = json_decode($_POST['ordem'], true);
		if ($dados) {
			foreach ($dados as $item) {
				$objAdminPagina = new AdminPagina();
				$objAdminPagina->setId($item['id']);
				$objAdminPagina->setOrdem($item['ordem']);
				ControllerAdminPagina::ordenar($objAdminPagina);
			}
			echo 1;
			die();
		} else {
			echo 0;
			die();
		}
	}


	if($objRoute->getArrUrl(2) == 'excluir-pagina'){
		// Exclusão por ajax -- _footer.php
		$id = Controller::validaGet($objRoute->getArrUrl(3));
		$objAdminPagina = ControllerAdminPagina::listar("id = :id", array(':id' => $id), array('id'), "obj");
		if($objAdminPagina instanceof adminPagina){
			if(ControllerAdminPagina::excluir($objAdminPagina)){
				echo 1;
				die();
			}
		}
		echo 0;
		die();
	}



	if($objRoute->getArrUrl(2) == 'config'){
		
		$pagina = "Config";
		$objRoute->setView($pathModulo."view/modulo/config.php");

	}


}