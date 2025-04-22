<?php

class AdminModulo {

	private $id;
	private $code;
	private $nome;
	private $descricao;
	private $icone;
	private $ordem;

	public function __construct(){
	}

	/**
	 * GETTERS
	 */
	public function getId(){ return $this->id; }
	public function getCode(){ return $this->code; }
	public function getNome(){ return $this->nome; }
	public function getDescricao(){ return $this->descricao; }
	public function getIcone(){ return $this->icone; }
	public function getOrdem(){ return $this->ordem; }

	/**
	 * SETTERS
	 */
	public function setId($id){ $this->id = $id; }
	public function setCode($code){ $this->code = $code; }
	public function setNome($nome){ $this->nome = $nome; }
	public function setDescricao($descricao){ $this->descricao = $descricao; }
	public function setIcone($icone){ $this->icone = $icone; }
	public function setOrdem($ordem){ $this->ordem = $ordem; }

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
    		$intModulo = ControllerAdminModulo::listar("code = :code AND id <> :id", array(':code' => $codeAdd, ':id' => $id), null, 'int');
    		if($intModulo > 0){
    			$i++;
    			$codeAdd = $code."-".$i;
    		}
    	} while ($intModulo > 0);
    	$this->setCode($codeAdd);
    }

    public function geraOrdenacao(){
    	if(empty($this->id)){ $this->id = 0; }
    	$objAdminModulo = ControllerAdminModulo::listar(" id != :id ORDER BY ordem DESC ", array('id' => $this->id), array('id','ordem'), "obj" );
    	if($objAdminModulo instanceof adminModulo){
    		$this->ordem = $objAdminModulo->getOrdem()+1;
    	}else{
    		$this->ordem = 1;
    	}
    }


}