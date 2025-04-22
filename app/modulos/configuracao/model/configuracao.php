<?php

class Configuracao {

    private $id;
    private $nome;
    private $descricao;

    public function __construct() {
    }

    /**
     * GETTERS
     */
    public function getId() { return $this->id; }
    public function getNome() { return $this->nome; }
    public function getDescricao() { return $this->descricao; }

    /**
     * SETTERS
     */
    public function setId($id) { $this->id = $id; }
    public function setNome($nome) { $this->nome = $nome; }
    public function setDescricao($descricao) { $this->descricao = $descricao; }

    /**
     * Valida os atributos da página
     * @return array|true
     */
    public function validaAtributos($acao = null) {

        $arrErro = [];

        if (!Controller::validaVar($this->getNome(), 'min', 3)) {
            $arrErro[] = "- O nome deve ter pelo menos 3 caracteres";
        }

        if (!Controller::validaVar($this->getDescricao(), 'min', 3)) {
            $arrErro[] = "- A descrição deve ter pelo menos 3 caracteres";
        }

        return empty($arrErro) ? true : $arrErro;
    }

    public function getImagemUrl() {
        if(!empty($this->getDescricao())){
            return URL."assets/uploads/configuracoes/".$this->getDescricao();
        }
        return false;
    }

    public function uploadImagem(){

        $uploadDir = PATH_PUBLIC."assets/uploads/configuracoes/";
        if (!file_exists($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }

        $file = $_FILES["croppedImage"];
        $nameFile = "cropped_" . time() . ".png";
        $filePath = $uploadDir . $nameFile;

        $arrErro = [];

        // Lista de extensões permitidas
        $extensoesPermitidas = ['jpg', 'jpeg', 'png'];

        // Verifica se houve erro no upload
        if ($file['error'] !== 0) {
            $arrErro[] = '- Erro no envio do arquivo.';
        }

        // Obtém a extensão do arquivo
        $extensao = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));

        if (!in_array($extensao, $extensoesPermitidas)) {
            $arrErro[] = '- Extensão não permitida.';
        }

        // Verifica o tipo MIME real do arquivo
        $mimeReal = mime_content_type($file['tmp_name']);
        $tiposValidos = [
            'image/jpeg',
            'image/png'
        ];

        if (!in_array($mimeReal, $tiposValidos)) {
            $arrErro[] = '- Tipo de arquivo inválido.';
        }

        $arrResponse = array();
        if(!count($arrErro)>0){
            if (move_uploaded_file($file["tmp_name"], $filePath)) {
                $arrResponse[0] = 1;
                $arrResponse[1] = $nameFile;
            } else {
                $arrResponse[0] = 0;
                $arrResponse[1] = "Erro ao salvar";
            }
        }else{
            $arrResponse[0] = 0;
            $arrResponse[1] = implode("\n", $arrErro);
        }
        return $arrResponse;

    }


    public function getNumLimpo($numero) {
        return str_replace(array(" ", "-", "(", ")"), "", $numero);
    }

}
