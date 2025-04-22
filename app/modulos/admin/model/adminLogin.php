<?php

class AdminLogin {

	private $id;
	private $email;
	private $senha;
	private $tokenSenha;

	public function __construct(){
	}

	/**
	 * GETTERS
	 */
	public function getId(){ return $this->id; }
	public function getEmail(){ return $this->email; }
	public function getSenha(){ return $this->senha; }
	public function getTokenSenha(){ return $this->tokenSenha; }

	/**
	 * SETTERS
	 */
	public function setId($id){ $this->id = $id; }
	public function setEmail($email){ $this->email = $email; }
	public function setSenha($senha){ $this->senha = $senha; }
	public function setTokenSenha($tokenSenha){ $this->tokenSenha = $tokenSenha; }


	/**
	 * VALIDA OS ATRIBUTOS DO OBJETO
	 * @param ing $acao 
	 * @return array ou true
	 */
	public function validaAtributos($acao = null){

		$arrErro = array();

		if($acao != 'recuperar-senha-token'){
			if(!Controller::validaVar($this->getEmail(), 'email')){
				$arrErro[] = "- O e-mail informado está em formato inválido";
			}
		}

		if($acao == 'login'){
			if(!Controller::validaVar($this->getSenha(), 'min', 4)){
				$arrErro[] = "- A senha deve conter no mínimo 4 caracteres";
			}else{
				$this->senhaTemp = $this->getSenha();
				$this->setSenha($this->getSenha());
			}

			if(count($arrErro) == 0){
				if(!$this->fazerLogin()){
					$arrErro[] = "- Login e/ou senha incorretos";
				}
			}

		}elseif($acao == 'recuperar-senha'){
			if(!$this->recuperarSenha()){
				$arrErro[] = "- Usuário não localizado";
			}
		}elseif($acao == 'recuperar-senha-token'){
			if(!$this->recuperarSenhaToken()){
				$arrErro[] = "- Tentativa inválida, tente recuperar a senha novamente";
			}
		}

		if(count($arrErro)>0){
			return $arrErro;
		}

		return true;
	}

	/**
	 * Faz login
	 */
	public function fazerLogin(){

		$objAdminUsuario = ControllerAdminUsuario::listar("email = :email AND ativo = :ativo", array(':email' => $this->getEmail(), ':ativo' => 1 ), null, "obj");

		if($objAdminUsuario instanceof AdminUsuario){

			if (password_verify($this->getSenha(), $objAdminUsuario->getSenha())) {

				// SESSION DE LOGIN
				$_SESSION[COD_SESSION."_id_admin_usuario"] = $objAdminUsuario->getId();
				session_regenerate_id(true);

				/* LOG DE ACESSO */
				$objAdminLog = new AdminLog();
				$objAdminLog->setIdAdminUsuario($objAdminUsuario->getId());
				$objAdminLog->setEmail(null);
				$objAdminLog->setSenha(null);
				$objAdminLog->setNavegador($_SERVER['HTTP_USER_AGENT']);
				$objAdminLog->setIp($_SERVER['REMOTE_ADDR']);
				$objAdminLog->setAcesso(1);
				$idAdminLog = ControllerAdminLog::cadastrar($objAdminLog);

				// SESSION DE LOG
				$_SESSION[COD_SESSION."_id_admin_log"] = $idAdminLog;

				return true;

			}
		}

		/* LOG DE ACESSO */
		$objAdminLog = new AdminLog();
		$objAdminLog->setIdAdminUsuario(null);
		$objAdminLog->setEmail($this->getEmail());
		$objAdminLog->setSenha($this->senhaTemp);
		$objAdminLog->setNavegador($_SERVER['HTTP_USER_AGENT']);
		$objAdminLog->setIp($_SERVER['REMOTE_ADDR']);
		$objAdminLog->setAcesso(0);
		ControllerAdminLog::cadastrar($objAdminLog);

		return false;
	}



	/**
	 * Recuperar Senha
	 */
	public function recuperarSenha(){

		$objAdminUsuario = ControllerAdminUsuario::listar("email = :email AND ativo = :ativo", array(':email' => $this->getEmail(), ':ativo' => 1 ), null, "obj");

		if($objAdminUsuario instanceof AdminUsuario){

			/* LOG DE RECUPERACAO */
			$objAdminLog = new AdminLog();
			$objAdminLog->setIdAdminUsuario($objAdminUsuario->getId());
			$objAdminLog->setEmail(null);
			$objAdminLog->setSenha(null);
			$objAdminLog->setNavegador($_SERVER['HTTP_USER_AGENT']);
			$objAdminLog->setIp($_SERVER['REMOTE_ADDR']);
			$objAdminLog->setAcesso(2);
			ControllerAdminLog::cadastrar($objAdminLog);

			$objAdminUsuario->setDatNovaSenha(date('Y-m-d H:i:s'));
			$objAdminUsuario->setTokenSenha(bin2hex(random_bytes(50)));

			if(ControllerAdminUsuario::editar($objAdminUsuario)){

				$arrDe = array('autenticacao@xweb.com.br', 'Sistema - Xweb');
				$arrPara[] = array($objAdminUsuario->getEmail());

				$strMensagem = '
				<p>Olá, '.$objAdminUsuario->getNome().'</p>
				<p>Recebemos uma solicitação para redefinir a sua senha.</p>
				<p>Para continuar, clique no link abaixo:</p>
				<p>
				<a href="'.URL_ADMIN.'recuperar-senha?token='.$objAdminUsuario->getTokenSenha().'" style="color: #007BFF;">Clique aqui para redefinir sua senha</a>
				</p>
				<p>Se você não fez essa solicitação, pode ignorar esta mensagem.</p>
				<p>Atenciosamente,<br>Equipe '.NOME_SITE.'</p>
				';

				Controller::emailEnviar($arrDe, $arrPara, "Recuperação de senha", $strMensagem);

			}

			return true;
		}

		/* LOG DE RECUPERACAO */
		$objAdminLog = new AdminLog();
		$objAdminLog->setIdAdminUsuario(null);
		$objAdminLog->setEmail($this->getEmail());
		$objAdminLog->setSenha(null);
		$objAdminLog->setNavegador($_SERVER['HTTP_USER_AGENT']);
		$objAdminLog->setIp($_SERVER['REMOTE_ADDR']);
		$objAdminLog->setAcesso(3);
		ControllerAdminLog::cadastrar($objAdminLog);

		return false;
	}


	/**
	 * Valida a recuperação de senha
	 */
	public function recuperarSenhaToken(){

		$dataNovaSenhaIni = date('Y-m-d H:i:s', strtotime('-2 hour', strtotime(date('Y-m-d H:i:s'))));
		$dataNovaSenhaFim = date('Y-m-d H:i:s');

		$objAdminUsuario = ControllerAdminUsuario::listar("token_senha = :token_senha AND ativo = :ativo AND dat_nova_senha BETWEEN :dat_nova_senha_ini AND :dat_nova_senha_fim", array(':token_senha' => $this->getTokenSenha(), ':ativo' => 1, ':dat_nova_senha_ini' => $dataNovaSenhaIni, ':dat_nova_senha_fim' => $dataNovaSenhaFim), null, "obj");

		if($objAdminUsuario instanceof AdminUsuario){

			$objAdminUsuario->setDatNovaSenha(null);
			$objAdminUsuario->setTokenSenha(null);
			$objAdminUsuario->setSenha(password_hash(bin2hex(random_bytes(10)), PASSWORD_DEFAULT));
			ControllerAdminUsuario::editar($objAdminUsuario);

			$_SESSION[COD_SESSION."_id_admin_usuario"] = $objAdminUsuario->getId();
			session_regenerate_id(true);

			/* LOG DE ACESSO */
			$objAdminLog = new AdminLog();
			$objAdminLog->setIdAdminUsuario($objAdminUsuario->getId());
			$objAdminLog->setEmail(null);
			$objAdminLog->setSenha(null);
			$objAdminLog->setNavegador($_SERVER['HTTP_USER_AGENT']);
			$objAdminLog->setIp($_SERVER['REMOTE_ADDR']);
			$objAdminLog->setAcesso(1);
			$idAdminLog = ControllerAdminLog::cadastrar($objAdminLog);

			// SESSION DE LOG
			$_SESSION[COD_SESSION."_id_admin_log"] = $idAdminLog;

			return true;

		}

		return false;

	}

}