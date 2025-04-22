<?php

class Pagina {

    private $id;
    private $idMenu;
    private $link;
    private $nome;
    private $conteudo;
    private $metaTitle;
    private $metaDescription;
    private $ordem;

    public function __construct() {
    }

    /**
     * GETTERS
     */
    public function getId() { return $this->id; }
    public function getIdMenu() { return $this->idMenu; }
    public function getLink() { return $this->link; }
    public function getNome() { return $this->nome; }
    public function getConteudo() { return $this->conteudo; }
    public function getMetaTitle() { return $this->metaTitle; }
    public function getMetaDescription() { return $this->metaDescription; }
    public function getOrdem() { return $this->ordem; }
    
    public function getMenu() {
        $objMenu = ControllerMenu::listar("id = :id", array(':id' => $this->getIdMenu()), null, "obj");
        if($objMenu instanceof Menu){
            return $objMenu;
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
    public function setIdMenu($idMenu) { 
        $this->idMenu = $idMenu;
        if($this->idMenu == 0){
            $this->idMenu = NULL;
        }
    }
    public function setLink($link) { $this->link = $link; }
    public function setNome($nome) { $this->nome = $nome; }
    public function setConteudo($conteudo) { $this->conteudo = $conteudo; }
    public function setMetaTitle($metaTitle) { $this->metaTitle = $metaTitle; }
    public function setMetaDescription($metaDescription) { $this->metaDescription = $metaDescription; }
    public function setOrdem($ordem) { $this->ordem = $ordem; }

    /**
     * Valida os atributos da página
     * @return array|true
     */
    public function validaAtributos($acao = null) {

        $arrErro = [];

        if (!Controller::validaVar($this->getNome(), 'min', 3) AND empty($this->idMenu)) {
            $arrErro[] = "- O nome deve ter pelo menos 3 caracteres";
        }
        if (!Controller::validaVar($this->getLink(), 'urls', 3) AND empty($this->idMenu)) {
            $arrErro[] = "- O link deve ser uma URL válida ou '#'";
        }
        /*
        if (!Controller::validaVar($this->getMetaTitle(), 'min', 3)) {
            $arrErro[] = "- O meta title deve ter pelo menos 3 caracteres";
        }
        if (!Controller::validaVar($this->getMetaDescription(), 'min', 3)) {
            $arrErro[] = "- O meta description deve ter pelo menos 3 caracteres";
        }
        */
        return empty($arrErro) ? true : $arrErro;
    }
}
