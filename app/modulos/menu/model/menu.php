<?php

class Menu {

	private $id;
    private $idSuperior; // ID do menu pai (null se for um menu principal)
    private $nome;
    private $link;
    private $target; // _self, _blank, etc.
    private $ordem;

    public function __construct() {
    }

    /**
     * GETTERS
     */
    public function getId() { return $this->id; }
    public function getIdSuperior() { return $this->idSuperior; }
    public function getNome() { return $this->nome; }
    public function getLink() { return $this->link; }
    public function getTarget() { return $this->target; }
    public function getOrdem() { return $this->ordem; }

    public function getMenuSuperior() {
        $objMenuSuperior = ControllerMenu::listar("id = :id", array(':id' => $this->getIdSuperior()), null, "obj");
        if($objMenuSuperior instanceof Menu){
            return $objMenuSuperior;
        }
        return false;
    }

    public function getUrlLink(){
        if(!empty($this->getLink())){
            $pos = strpos("://", $this->getLink());
            if ($pos === false) {
                return URL.$this->getLink();
            }
        }else{
            return URL;
        }
        return $this->getLink();
    }

    /**
     * SETTERS
     */
    public function setId($id) { $this->id = $id; }

    public function setIdSuperior($idSuperior) {
        $this->idSuperior = $idSuperior;
        if($this->idSuperior == 0){
            $this->idSuperior = NULL;
        }
    }

    public function setNome($nome) { $this->nome = $nome; }
    public function setLink($link) { $this->link = $link; }
    public function setTarget($target) { $this->target = $target; }
    public function setOrdem($ordem) { $this->ordem = $ordem; }

    /**
     * Valida os atributos do menu
     * @return array|true
     */
    public function validaAtributos($acao = null) {
    	
    	$arrErro = [];

    	if(!Controller::validaVar($this->getNome(), 'min', 3)){
    		$arrErro[] = "- O nome deve ter pelo menos 3 caracteres";
    	}
        /*
    	if(!Controller::validaVar($this->getLink(), 'urls', 3)){
    		$arrErro[] = "- O link deve ser uma URL válida ou '#'";
    	}
        */
    	if (!empty($this->getTarget()) && (!in_array($this->getTarget(), ["_self", "_blank", "_parent", "_top"]))) {
    		$arrErro[] = "- O target deve ser '_self', '_blank', '_parent' ou '_top'";
    	}

    	return empty($arrErro) ? true : $arrErro;

    }

}
