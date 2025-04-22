<?php

class AdminUsuario {

	private $id;
	private $objAdminPerfil;
	private $nome;
	private $email;
	private $senha;
	private $senha2;
	private $senhaAntiga;
	private $ativo;
	private $datNovaSenha;
	private $tokenSenha;

	public function __construct(){
	}

	/**
	 * GETTERS
	 */
	public function getId(){ return $this->id; }
	public function getAdminPerfil(){ return $this->objAdminPerfil; }
	public function getNome(){ return $this->nome; }
	public function getEmail(){ return $this->email; }
	public function getSenha(){ return $this->senha; }
	public function getSenha2(){ return $this->senha2; }
	public function getSenhaAntiga(){ return $this->senhaAntiga; }
	public function getAtivo(){ return $this->ativo; }
	public function getDatNovaSenha(){ return $this->datNovaSenha; }
	public function getTokenSenha(){ return $this->tokenSenha; }

	public function getAtivoStatus(){
		if($this->getAtivo() == 1){
			return '<span class="badge bg-success"> Ativo </span>';
		}
		return '<span class="badge bg-danger"> Inativo </span>';
	}

	/**
	 * SETTERS
	 */
	public function setId($id){ $this->id = $id; }
	public function setAdminPerfil($objAdminPerfil){ $this->objAdminPerfil = $objAdminPerfil; }
	public function setNome($nome){ $this->nome = $nome; }
	public function setEmail($email){ $this->email = $email; }
	public function setSenha($senha){ $this->senha = $senha; }
	public function setSenha2($senha2){ $this->senha2 = $senha2; }
	public function setSenhaAntiga($senhaAntiga){ $this->senhaAntiga = $senhaAntiga; }
	public function setAtivo($ativo){ $this->ativo = $ativo; }
	public function setDatNovaSenha($datNovaSenha){ $this->datNovaSenha = $datNovaSenha; }
	public function setTokenSenha($tokenSenha){ $this->tokenSenha = $tokenSenha; }


	/**
	 * VALIDA OS ATRIBUTOS DO OBJETO
	 * @param ing $acao 
	 * @return array ou true
	 */
	public function validaAtributos($acao = null){

		$arrErro = array();

		if($acao != "perfil"){

			$arrAdminUsuario = ControllerAdminUsuario::listar("email = :email AND id != :id", array(':email' => $this->getEmail(), ':id' => $this->getId()), null);
			if($arrAdminUsuario){
				$arrErro[] = "- Este e-mail já pertence a um usuário";
			}
			if(!$this->getAdminPerfil() instanceof AdminPerfil){
				$arrErro[] = "- Perfil não encontrado";
			}

		}

		if(!Controller::validaVar($this->getNome(), 'min', 3)){
			$arrErro[] = "- O nome deve conter no mínimo 3 caracteres";
		}
		if(!Controller::validaVar($this->getEmail(), 'email')){
			$arrErro[] = "- O e-mail informado está em formato inválido";
		}

		if(($acao == "editar" OR $acao == "perfil") AND empty($this->getSenha()) ){
			$this->setSenha($this->getSenhaAntiga());
		}else{
			if(!Controller::validaVar($this->getSenha(), 'min', 4)){
				$arrErro[] = "- A senha deve conter no mínimo 4 caracteres";
			}
			if($this->getSenha() != $this->getSenha2()){
				$arrErro[] = "- A senha e a confirmação da senha não conferem";
			}else{
				$this->setSenha(password_hash($this->getSenha(), PASSWORD_DEFAULT));
			}
		}

		if(count($arrErro)>0){
			return $arrErro;
		}

		return true;
	}

}