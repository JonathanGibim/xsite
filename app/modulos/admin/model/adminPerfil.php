<?php

class AdminPerfil {

	private $id;
	private $nome;
	private $descricao;

	public function __construct(){
	}

	/**
	 * GETTERS
	 */
	public function getId(){ return $this->id; }
	public function getNome(){ return $this->nome; }
	public function getDescricao(){ return $this->descricao; }

	/**
	 * SETTERS
	 */
	public function setId($id){ $this->id = $id; }
	public function setNome($nome){ $this->nome = $nome; }
	public function setDescricao($descricao){ $this->descricao = $descricao; }

	/**
	 * VALIDA OS ATRIBUTOS DO OBJETO
	 * @param ing $acao 
	 * @return array ou true
	 */
	public function validaAtributos($acao = null){

		$arrErro = array();
		if(!Controller::validaVar($this->getNome(), 'min', 3)){
			$arrErro[] = "- O nome deve conter no mínimo 3 caracteres";
		}
		if(!Controller::validaVar($this->getNome(), 'min', 3)){
			$arrErro[] = "- A descrição deve conter no mínimo 3 caracteres";
		}

		if(count($arrErro)>0){
			return $arrErro;
		}

		return true;
	}


	public function getArrPermissoes(){
		$arrPermissaoLogado = array();
		if($this->getId() == 1){
			$arrPermissaoLogado = $this->getAllPermissoes();
		}else{
			$arrAdminPermissao = ControllerAdminPermissao::listar("id_perfil = :id_perfil", array(':id_perfil' => $this->getId()), null);
			$arrAdminPermissao = array_reverse($arrAdminPermissao);
			if($arrAdminPermissao){
				foreach ($arrAdminPermissao as $objAdminPermissao) {
					$arrPermissaoLogado[$objAdminPermissao->getAdminModulo()->getCode()][$objAdminPermissao->getAdminPagina()->getCode()] = 1;
				}
			}
		}

		/* Rotas permitidas */
		$arrPermissaoLogado['dashboard'] = "1";
		$arrPermissaoLogado['permissao-negada'] = "1";
		$arrPermissaoLogado['sair'] = "1";

		return $arrPermissaoLogado;   
	}

	public function getAllPermissoes(){
		$arrPermissaoLogado = array();
		$arrAdminPagina = ControllerAdminPagina::listar();
		if($arrAdminPagina){
			foreach ($arrAdminPagina as $objAdminPagina) {
				$arrPermissaoLogado[$objAdminPagina->getAdminModulo()->getCode()][$objAdminPagina->getCode()] = 1;
			}
		}
		return $arrPermissaoLogado;
	}


}