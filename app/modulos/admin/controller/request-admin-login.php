<?php

/**
 * 
 * LOGIN
 * 
 **/

if($objRoute->getArrUrl(1) == "login"){

	$modulo = "Login";
	$email = null;

	if(isset($_POST['submitForm'])){

		$email = Controller::validaPost($_POST['email']);
		$senha = Controller::validaPost($_POST['senha']);

		$objAdminLogin = new AdminLogin();
		$objAdminLogin->setEmail($email);
		$objAdminLogin->setSenha($senha);

		$arrValidaAtributo = $objAdminLogin->validaAtributos('login');
		if($arrValidaAtributo === true){

			$alertaSistema .= Controller::utilsAlert('Login realizado com sucesso!', 'success');
			header("LOCATION:".URL_ADMIN."dashboard");
			die();

		}else{
			$alertaErro = null;
			foreach($arrValidaAtributo as $MsgErro){
				$alertaErro .= $MsgErro."<br>";
			}
			$alertaSistema .= Controller::utilsAlert($alertaErro, 'danger');
		}

	}

	$objRoute->setView(PATH_MODULO."admin/view/login/login.php");

}


if($objRoute->getArrUrl(1) == "recuperar-senha"){

	$modulo = "Recuperação de senha";

	$email = null;

	if(isset($_POST['submitForm'])){

		$email = Controller::validaPost($_POST['email']);

		$objAdminLogin = new AdminLogin();
		$objAdminLogin->setEmail($email);

		$arrValidaAtributo = $objAdminLogin->validaAtributos('recuperar-senha');
		if($arrValidaAtributo === true){

			$alertaSucesso = '
			<p>Enviamos um link para recuperação de senha no seu e-mail.</p>
			<p>Verifique sua caixa de entrada (ou spam) e siga as instruções para criar uma nova senha.</p>
			';
			$alertaSistema .= Controller::utilsAlert($alertaSucesso, 'success');

		}else{

			$alertaErro = null;
			foreach($arrValidaAtributo as $MsgErro){
				$alertaErro .= $MsgErro."<br>";
			}
			$alertaSistema .= Controller::utilsAlert($alertaErro, 'danger');

		}

	}elseif(isset($_GET['token'])){


		$tokenSenha = Controller::validaGet($_GET['token']);

		$objAdminLogin = new AdminLogin();
		$objAdminLogin->setTokenSenha($tokenSenha);

		$arrValidaAtributo = $objAdminLogin->validaAtributos('recuperar-senha-token');

		if($arrValidaAtributo === true){

			header("LOCATION:".URL_ADMIN."usuario/perfil?altera-senha=1");
			die();

		}else{

			$alertaErro = null;
			foreach($arrValidaAtributo as $MsgErro){
				$alertaErro .= $MsgErro."<br>";
			}
			$alertaSistema .= Controller::utilsAlert($alertaErro, 'danger');

		}

	}

	$objRoute->setView(PATH_MODULO."admin/view/login/login.php");

}