<?php
class Debug {

	public function __construct(){
	}

	public function debug($e){
		if(DEBUG){

			print "Ocorreu um erro ao tentar executar esta ação, tente novamente mais tarde.";
			print "<br> Erro: ".$e->getMessage();

			$texto = "\n".date("Y-m-d H:i:s")." - Mensagem:".$e->getMessage()." - URL: ".URL_ATUAL;
			$arquivo = fopen(PATH.'error_log_debug.txt','a');
			fwrite($arquivo, $texto);
			fclose($arquivo);

		}
	}

}