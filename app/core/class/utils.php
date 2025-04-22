<?php
class Utils {

	public function __construct(){
	}

	/**
	 * Define os alertas do sistema.
	 * @param type $mensagem 
	 * @param type|null $tipo 
	 * @param type|null $titulo 
	 * @return string
	 */
	public function alert($mensagem, $tipo = null, $titulo = null){

		switch ($tipo) {

			case 'success':
			if(empty($titulo)){ $titulo = '<h4><i class="fas fa-check-circle"></i> Sucesso!</h4>'; }
			return $this->geraAlert($mensagem, $tipo, $titulo);
			break;

			case 'info':
			if(empty($titulo)){ $titulo = '<h4><i class="fas fa-info-circle"></i> Informação!</h4>'; }
			return $this->geraAlert($mensagem, $tipo, $titulo);
			break;

			case 'warning':
			if(empty($titulo)){ $titulo = '<h4><i class="fas fa-exclamation-triangle"></i> Atenção!</h4>'; }
			return $this->geraAlert($mensagem, $tipo, $titulo);
			break;

			case 'danger':
			if(empty($titulo)){ $titulo = '<h4><i class="fas fa-ban"></i> Atenção!</h4>'; }
			return $this->geraAlert($mensagem, $tipo, $titulo);
			break;

			case 'error':
			if(empty($titulo)){ $titulo = '<h4><i class="fas fa-ban"></i> Atenção!</h4>'; }
			return $this->geraAlert("Ops, ocorreu um erro.", "danger", $titulo);
			break;

			default:
			return false;
			break;
		}

	}

	/**
	 * Gera a string do alerta para exibição.
	 * @param type $mensagem 
	 * @param type|null $tipo 
	 * @param type|null $titulo 
	 * @return string
	 */
	public function geraAlert($mensagem, $tipo = null, $titulo = null){
		return '<div class="alert alert-'.$tipo.' alert-dismissable">
		'.$titulo.$mensagem.'</div>';
	}

	public function alertFloat($mensagem, $tipo = null, $seg = null){
		$_SESSION['alert-float'] = 'toastr.'.$tipo.'("'.$mensagem.'");';
	}

	/**
	 * Lista os estados do brasil por nome ou sigla
	 * @return array
	 */
	public function listaEstados(){
		$arrEstados = array(
			array("sigla" => "AC", "nome" => "Acre"),
			array("sigla" => "AL", "nome" => "Alagoas"),
			array("sigla" => "AM", "nome" => "Amazonas"),
			array("sigla" => "AP", "nome" => "Amapá"),
			array("sigla" => "BA", "nome" => "Bahia"),
			array("sigla" => "CE", "nome" => "Ceará"),
			array("sigla" => "DF", "nome" => "Distrito Federal"),
			array("sigla" => "ES", "nome" => "Espírito Santo"),
			array("sigla" => "GO", "nome" => "Goiás"),
			array("sigla" => "MA", "nome" => "Maranhão"),
			array("sigla" => "MT", "nome" => "Mato Grosso"),
			array("sigla" => "MS", "nome" => "Mato Grosso do Sul"),
			array("sigla" => "MG", "nome" => "Minas Gerais"),
			array("sigla" => "PA", "nome" => "Pará"),
			array("sigla" => "PB", "nome" => "Paraíba"),
			array("sigla" => "PR", "nome" => "Paraná"),
			array("sigla" => "PE", "nome" => "Pernambuco"),
			array("sigla" => "PI", "nome" => "Piauí"),
			array("sigla" => "RJ", "nome" => "Rio de Janeiro"),
			array("sigla" => "RN", "nome" => "Rio Grande do Norte"),
			array("sigla" => "RO", "nome" => "Rondônia"),
			array("sigla" => "RS", "nome" => "Rio Grande do Sul"),
			array("sigla" => "RR", "nome" => "Roraima"),
			array("sigla" => "SC", "nome" => "Santa Catarina"),
			array("sigla" => "SE", "nome" => "Sergipe"),
			array("sigla" => "SP", "nome" => "São Paulo"),
			array("sigla" => "TO", "nome" => "Tocantins")
		);
		return $arrEstados;
	}

	/**
	 * Gera um string com letras e números
	 * @param type $tamanho 
	 * @return string
	 */
	public function geraString($tamanho){
		$strHash = "1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZ";
		$strGerada = null;
		for( $cont=0; $cont < $tamanho; $cont++ ){
			$strGerada .= $strHash[rand(0,35)];
		}
		return $strGerada;
	}

	public function geraLoren($tamanho){
		$strGerada = null;
		for( $cont=0; $cont < $tamanho; $cont++ ){
			$strGerada .= "<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>";
		}
		return $strGerada;
	}

}