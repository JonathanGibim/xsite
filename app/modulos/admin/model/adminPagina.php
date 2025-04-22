<?php

class AdminPagina {

	private $id;
	private $objAdminModulo;
	private $code;
	private $nome;
	private $descricao;
	private $ordem;
	private $oculto;

	public function __construct(){
	}

	/**
	 * GETTERS
	 */
	public function getId(){ return $this->id; }
	public function getAdminModulo(){ return $this->objAdminModulo; }
	public function getCode(){ return $this->code; }
	public function getNome(){ return $this->nome; }
	public function getDescricao(){ return $this->descricao; }
	public function getOrdem(){ return $this->ordem; }
	public function getOculto(){ return $this->oculto; }

	/**
	 * SETTERS
	 */
	public function setId($id){ $this->id = $id; }
	public function setAdminModulo($objAdminModulo){ $this->objAdminModulo = $objAdminModulo; }
	public function setCode($code){ $this->code = $code; }
	public function setNome($nome){ $this->nome = $nome; }
	public function setDescricao($descricao){ $this->descricao = $descricao; }
	public function setOrdem($ordem){ $this->ordem = $ordem; }
	public function setOculto($oculto){ $this->oculto = $oculto; }

	/**
	 * VALIDA OS ATRIBUTOS DO OBJETO
	 * @param ing $acao 
	 * @return array ou true
	 */
	public function validaAtributos($acao = null){

		$arrErro = array();
		if(!$this->getAdminModulo() instanceof AdminModulo){
			$arrErro[] = "- Módulo não encontrado";
		}
		if(!Controller::validaVar($this->getNome(), 'min', 3)){
			$arrErro[] = "- O nome deve conter no mínimo 3 caracteres";
		}
		if(!Controller::validaVar($this->getNome(), 'min', 3)){
			$arrErro[] = "- A descrição deve conter no mínimo 3 caracteres";
		}

		if(count($arrErro)>0){
			return $arrErro;
		}

		$this->geraCode();
		$this->geraOrdenacao();

		return true;
	}


    /**
     * Cria um código (code) para utilizar na URL, sendo um code único para cada registro
     */
    public function geraCode(){
    	$code = Controller::converteVar($this->getNome(), "code");
    	$codeAdd = $code;
    	$id = ($this->getId() == NULL) ? 0 : $this->getId();
    	$i = 0;
    	do {
    		$intPagina = ControllerAdminPagina::listar("code = :code AND id <> :id", array(':code' => $codeAdd, ':id' => $id), null, 'int');
    		if($intPagina > 0){
    			$i++;
    			$codeAdd = $code."-".$i;
    		}
    	} while ($intPagina > 0);
    	$this->setCode($codeAdd);
    }


    public function geraOrdenacao(){
    	if(empty($this->id)){ $this->id = 0; }
    	$objAdminPagina = ControllerAdminPagina::listar(" id_modulo != :id_modulo ORDER BY ordem DESC ", array('id_modulo' => $this->id), array('id_modulo','ordem'), "obj" );
    	if($objAdminPagina instanceof adminPagina){
    		$this->ordem = $objAdminPagina->getOrdem()+1;
    	}else{
    		$this->ordem = 1;
    	}
    }


    public function getCodeLink(){
    	return URL_ADMIN.$this->getAdminModulo()->getCode()."/".$this->getCode();
    }

}