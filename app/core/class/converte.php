<?php

class Converte {

    public function __construct(){
    }

    public function converteVar($variavel, $tipo, $parametro = null){

        switch ($tipo) {

            case 'checkbox':
            return $this->checkboxOnOff($variavel);
            break;

            case 'code':
            return $this->code($variavel);
            break;

            case 'data':
            return $this->dataEnPt($variavel, $parametro);
            break;

            default:
            return false;
            break;
        }

    }

    private function checkboxOnOff($variavel){
        if($variavel == 'on'){
            return 1;
        }
        return 0;
    }

    private function dataEnPt($variavel, $parametro = null){
        if($parametro == 'data'){
            return (new DateTime($variavel))->format('d/m/Y');
        }elseif($parametro == 'hora'){
            return (new DateTime($variavel))->format('H:i:s');
        }
        return (new DateTime($variavel))->format('d/m/Y H:i:s');
    }

    private function code($variavel){
        return strtolower(str_replace(" ", "-", preg_replace("/[^\w\s-]/", "", iconv("UTF-8", "ASCII//TRANSLIT", $variavel))));
    }


}