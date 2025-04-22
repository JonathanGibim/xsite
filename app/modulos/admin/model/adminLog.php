<?php

class AdminLog {

	private $id;
	private $idAdminUsuario;
	private $email;
	private $senha;
	private $navegador;
	private $ip;
	private $acesso; // Login: 0 = acesso negado, 1 = acesso liberado ||| Recuperacao de Senha: 2 = usuario existente, 3 = usuario não existente
	private $datAcesso;

	public function __construct(){
	}

	/**
	 * GETTERS
	 */
	public function getId(){ return $this->id; }
	public function getIdAdminUsuario(){ return $this->idAdminUsuario; }
	public function getEmail(){ return $this->email; }
	public function getSenha(){ return $this->senha; }
	public function getNavegador(){ return $this->navegador; }
	public function getIp(){ return $this->ip; }
	public function getAcesso(){ return $this->acesso; }
	public function getDatAcesso(){ return $this->datAcesso; }

	/**
	 * SETTERS
	 */
	public function setId($id){ $this->id = $id; }
	public function setIdAdminUsuario($idAdminUsuario){ $this->idAdminUsuario = $idAdminUsuario; }
	public function setEmail($email){ $this->email = $email; }
	public function setSenha($senha){ $this->senha = $senha; }
	public function setNavegador($navegador){ $this->navegador = $navegador; }
	public function setIp($ip){ $this->ip = $ip; }
	public function setAcesso($acesso){ $this->acesso = $acesso; }
	public function setDatAcesso($datAcesso){ $this->datAcesso = $datAcesso; }

}