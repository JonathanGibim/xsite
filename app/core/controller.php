<?php

Class Controller{

    /**
     * válida variaveis conforme o tipo de validaçao escolhido
     * @param str|int|array $variavel 
     * @param str $tipo 
     * @param str|int|null $parametro 
     * @return bol
     */
    public static function validaVar($variavel, $tipo, $parametro = null){
    	$objValida = new Valida();
    	return $objValida->validaVar($variavel, $tipo, $parametro);
    }
    public static function validaPost($variavel){
        $objValida = new Valida();
        return $objValida->validaVar($variavel, 'post');
    }
    public static function validaGet($variavel){
        $objValida = new Valida();
        return $objValida->validaVar($variavel, 'get');
    }
    public static function validaArray($variavel){
        $objValida = new Valida();
        return $objValida->validaVar($variavel, 'arr');
    }
    public static function valida($function, $param1 = null, $param2 = null, $param3 = null){
        $objValida = new Valida();
        return $objValida->$function($param1, $param2, $param3);
    }

    /**
     * converte variaveis conforme o tipo de conversão escolhido
     * @param str|int|array $variavel 
     * @param str $tipo 
     * @param str|int|null $parametro 
     * @return all
     */
    public static function converteVar($variavel, $tipo, $parametro = null){
    	$objConverte = new Converte();
    	return $objConverte->converteVar($variavel, $tipo, $parametro);
    }
    public static function converte($function, $param1 = null, $param2 = null, $param3 = null){
        $objConverte = new Converte();
        return $objConverte->$function($param1, $param2, $param3);
    }

	/**
	 * Define os alertas do sistema.
	 * @param str $mensagem 
	 * @param str|null $tipo 
	 * @param str|null $titulo 
	 * @return string
	 */
	public static function utilsAlert($mensagem, $tipo = null, $titulo = null){
		$objUtils = new Utils();
		return $objUtils->alert($mensagem, $tipo, $titulo);
	}
    public static function utilsAlertFloat($mensagem, $tipo = null, $seg = null){
        $objUtils = new Utils();
        return $objUtils->alertFloat($mensagem, $tipo, $seg);
    }
    public static function utils($function, $param1 = null, $param2 = null, $param3 = null){
        $objUtils = new Utils();
        return $objUtils->$function($param1, $param2, $param3);
    }


    /**
     * Envia emails do sistema.
     * @param arr $arrDe 
     * @param arr $arrPara 
     * @param str|null $strAssunto 
     * @param str|null $strMensagem 
     * @param arr $arrAnexo 
     * @param arr $arrReplyTo 
     * @return string
     */
    public static function emailEnviar($arrDe, $arrPara, $strAssunto, $strMensagem, $arrReplyTo = null, $arrAnexo = null){
        $objEmail = new Email();
        return $objEmail->enviar($arrDe, $arrPara, $strAssunto, $strMensagem, $arrReplyTo, $arrAnexo);
    }

    /**
     * Debug BD
     * @param type $e 
     * @return string
     */
    public static function debug($e){
        $objBd = new Debug();
        return $objBd->debug($e);
    }

}