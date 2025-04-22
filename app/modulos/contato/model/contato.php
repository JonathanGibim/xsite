<?php

class Contato {

	private $id;
	private $nome;
	private $email;
	private $telefone;
	private $assunto;
	private $mensagem;
	private $visualizado;

	public function __construct(){
	}

	/**
	 * GETTERS
	 */
	public function getId(){ return $this->id; }
	public function getNome(){ return $this->nome; }
	public function getEmail(){ return $this->email; }
	public function getTelefone(){ return $this->telefone; }
	public function getAssunto(){ return $this->assunto; }
	public function getMensagem(){ return $this->mensagem; }
	public function getVisualizado(){ return $this->visualizado; }

	/**
	 * SETTERS
	 */
	public function setId($id){ $this->id = $id; }
	public function setNome($nome){ $this->nome = $nome; }
	public function setEmail($email){ $this->email = $email; }
	public function setTelefone($telefone){ $this->telefone = $telefone; }
	public function setAssunto($assunto){ $this->assunto = $assunto; }
	public function setMensagem($mensagem){ $this->mensagem = $mensagem; }
	public function setVisualizado($visualizado){ $this->visualizado = $visualizado; }

	/**
	 * VALIDA OS ATRIBUTOS DO OBJETO
	 * @param ing $acao 
	 * @return array ou true
	 */
	public function validaAtributos($acao = null){

		$arrErro = [];

		if(!Controller::validaVar($this->getNome(), 'min', 3)){
			$arrErro[] = "- O nome deve conter no mínimo 3 caracteres";
		}

		if(!Controller::validaVar($this->getEmail(), 'email')){
			$arrErro[] = "- O e-mail informado está em formato inválido";
		}
		
		if(!Controller::validaVar($this->getMensagem(), 'min', 3)){
			$arrErro[] = "- A mensagem deve conter no mínimo 3 caracteres";
		}

		return empty($arrErro) ? true : $arrErro;

	}

}