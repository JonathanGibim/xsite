<?php

class Valida{

    public function __construct(){
    }

    /**
     * válida variaveis conforme o tipo de validaçao escolhido
     * @param type $variavel 
     * @param type $tipo 
     * @param type|null $parametro 
     * @return bol
     */
    public function validaVar($variavel, $tipo, $parametro = null){

        switch ($tipo) {

            case 'get':
            return $this->get($variavel);
            break;

            case 'post':
            return $this->post($variavel);
            break;

            case 'arr':
            return $this->arr($variavel);
            break;

            case 'urls':
            return $this->urls($variavel);
            break;

            case 'url':
            return $this->url($variavel);
            break;

            case 'min':
            return $this->qtdMin($variavel, $parametro);
            break;

            case 'max':
            return $this->qtdMax($variavel, $parametro);
            break;

            case 'email':
            return $this->email($variavel);
            break;

            case 'cep':
            return $this->cep($variavel);
            break;

            case 'cpf':
            return $this->cpf($variavel);
            break;

            case 'cnpj':
            return $this->cnpj($variavel);
            break;

            default:
            return false;
            break;
        }

    }

    


    /**
     * válida get
     * @param type $strGet 
     * @return bol
     */
    public function get($strGet){
        if(filter_var($strGet, FILTER_SANITIZE_STRING)){
            return $strGet;
        }
        return false;
    }

    /**
     * válida post
     * @param type $strPost 
     * @return bol
     */
    public function post($strPost){
        if(filter_var($strPost, FILTER_SANITIZE_STRING)){
            return $strPost;
        }
        return false;
    }


    /**
     * válida array
     * @param type $arrArray 
     * @return bol
     */
    public function arr($arrArray){
        if(filter_var_array($arrArray, FILTER_SANITIZE_STRING)){
            return $arrArray;
        }
        return false;
    }

    /**
     * válida URL
     * @param type $strUrl 
     * @return bol
     */
    public function urls($strUrl){
        if(filter_var($strUrl, FILTER_SANITIZE_URL)){
            return $strUrl;
        }
        return false;
    }

    /**
     * válida URL
     * @param type $strUrl 
     * @return bol
     */
    public function url($strUrl){
        if(filter_var($strUrl, FILTER_VALIDATE_URL)){
            return true;
        }
        return false;
    }

    /**
     * válida qtde min de caracteres
     * @param type $strTexto 
     * @param type $intQuantidade 
     * @return bol
     */
    public function qtdMin($strTexto, $intQuantidade){
        if( strlen($strTexto) >= $intQuantidade ){
            return true;
        }
        return false;
    }

    /**
     * válida qtde max de caracteres
     * @param type $strTexto 
     * @param type $intQuantidade 
     * @return bol
     */
    public function qtdMax($strTexto, $intQuantidade){
        if( strlen($strTexto) <= $intQuantidade ){
            return true;
        }
        return false;
    }

    /**
     * válida e-mail por expressao regular
     * @param type $strEmail 
     * @return bol
     */
    public function emailRegex($strEmail){
        if(preg_match("/^([[:alnum:]_.-]){2,}@([[:lower:][:digit:]_.-]{2,})(\.[[:lower:]]{2,3})(\.[[:lower:]]{2})?$/", $strEmail)) {
            return true;
        }
        return false;
    }

    /**
     * válida e-mail funcao php
     * @param type $strEmail 
     * @return bol
     */
    public function email($strEmail){
        if(filter_var($strEmail, FILTER_VALIDATE_EMAIL)){
            return true;
        }
        return false;
    }

    /**
     * válida CEP
     * @param type $cep 
     * @return bol
     */
    public function cep($cep){
        if(preg_match('/^[0-9]{5,5}([- ]?[0-9]{3,3})?$/', trim($cep))) {
            return true;
        }
        return false;
    }

    /**
     * válida CPF
     * @param type $cpf 
     * @return bol
     */
    public function cpf($cpf) {
        // pega somente os números do cpf.
        $cpf = preg_replace( '/[^0-9]/is', '', $cpf );
        // Verifica se possui 11 caracteres e se não são repetidos.
        if ( strlen($cpf) != 11 || preg_match('/(\d)\1{10}/', $cpf) ) {
            return false;
        }
        // Realiza todos os calculos para validar o CPF informado.
        for ($t = 9; $t < 11; $t++) {
            for ($d = 0, $c = 0; $c < $t; $c++) {
                $d += $cpf[$c] * (($t + 1) - $c);
            }
            $d = ((10 * $d) % 11) % 10;
            if ($cpf[$c] != $d) {
                return false;
            }
        }
        return true;
    }

    /**
     * válida CNPJ
     * @param type $cnpj 
     * @return bol
     */
    public function cnpj($cnpj){
        $cnpj = preg_replace('/[^0-9]/', '', (string) $cnpj);
        // Verifica se possui 14 caracteres e se não são repetidos.
        if ( strlen($cnpj) != 14 || preg_match('/(\d)\1{13}/', $cnpj) ) {
            return false;   
        }
        // Valida primeiro dígito verificador
        for ($i = 0, $j = 5, $soma = 0; $i < 12; $i++){
            $soma += $cnpj[$i] * $j;
            $j = ($j == 2) ? 9 : $j - 1;
        }
        $resto = $soma % 11;
        if ($cnpj[12] != ($resto < 2 ? 0 : 11 - $resto)){
            return false;
        }

        // Valida segundo dígito verificador
        for ($i = 0, $j = 6, $soma = 0; $i < 13; $i++){
            $soma += $cnpj[$i] * $j;
            $j = ($j == 2) ? 9 : $j - 1;
        }
        $resto = $soma % 11;
        if($cnpj[13] != ($resto < 2 ? 0 : 11 - $resto)){
            return false;
        }
        return true;
    }
}