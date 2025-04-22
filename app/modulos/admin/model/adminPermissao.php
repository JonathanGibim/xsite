<?php

class AdminPermissao {

	private $id;
	private $objAdminPerfil;
	private $objAdminModulo;
	private $objAdminPagina;

	public function __construct(){
	}

	/**
	 * GETTERS
	 */
	public function getId(){ return $this->id; }
	public function getAdminPerfil(){ return $this->objAdminPerfil; }
	public function getAdminModulo(){ return $this->objAdminModulo; }
	public function getAdminPagina(){ return $this->objAdminPagina; }

	/**
	 * SETTERS
	 */
	public function setId($id){ $this->id = $id; }
	public function setAdminPerfil($objAdminPerfil){ $this->objAdminPerfil = $objAdminPerfil; }
	public function setAdminModulo($objAdminModulo){ $this->objAdminModulo = $objAdminModulo; }
	public function setAdminPagina($objAdminPagina){ $this->objAdminPagina = $objAdminPagina; }

	/**
	 * VALIDA OS ATRIBUTOS DO OBJETO
	 * @param ing $acao 
	 * @return array ou true
	 */
	public function validaAtributos($acao = null){
		$arrErro = array();
		if(!$this->getAdminPerfil() instanceof AdminPerfil){
			$arrErro[] = "- Perfil não encontrado";
		}
		if(!$this->getAdminModulo() instanceof AdminModulo){
			$arrErro[] = "- Módulo não encontrado";
		}
		if(!$this->getAdminPagina() instanceof AdminPagina){
			$arrErro[] = "- Página não encontrada";
		}
		if(count($arrErro)>0){
			return $arrErro;
		}
		return true;
	}

}