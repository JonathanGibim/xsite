<?php

class AdminPaginaDao  {

	private $pdo;
	private $idAdmimLog;
	private $tabela;

	public function __construct() {
		$this->pdo = Conexao::getPdo();
		$this->idAdmimLog = $_SESSION[COD_SESSION."_id_admin_log"];
		$this->tabela = "admin_pagina";
	}

/**
* Insere o regio no BD
* @param obj $objAdminPagina 
* @return 
*/
public function cadastrar($objAdminPagina){

	try{

		$query = " INSERT INTO ".$this->tabela." (id_modulo, code, nome, descricao, ordem, oculto, dat_inc, id_log_inc ) VALUES ( :id_modulo, :code, :nome, :descricao, :ordem, :oculto, :dat_inc, :id_log_inc ) ";

		$stmt = $this->pdo->prepare($query);
		$stmt->bindValue(":id_modulo", $objAdminPagina->getAdminModulo()->getId());
		$stmt->bindValue(":code", $objAdminPagina->getCode());
		$stmt->bindValue(":nome", $objAdminPagina->getNome());
		$stmt->bindValue(":descricao", $objAdminPagina->getDescricao());
		$stmt->bindValue(":ordem", $objAdminPagina->getOrdem());
		$stmt->bindValue(":oculto", $objAdminPagina->getOculto());
		$stmt->bindValue(":dat_inc", date("Y-m-d H:i:s"));
		$stmt->bindValue(":id_log_inc", $this->idAdmimLog);

		if($stmt->execute()){
			$id = $this->pdo->lastInsertId();
			$objAdminPagina->setId($id);
			return $id;
		}

	} catch (Exception $e) {
		Controller::debug($e);
	}

}

/**
* Altera o regio no BD
* @param obj $objAdminPagina 
* @return bol
*/
public function editar($objAdminPagina){

	try{

		$query = " UPDATE ".$this->tabela." SET id_modulo = :id_modulo, code = :code, nome = :nome, descricao = :descricao, ordem = :ordem, oculto = :oculto, dat_alt = :dat_alt, id_log_alt = :id_log_alt WHERE id = :id ";

		$stmt = $this->pdo->prepare($query);
		$stmt->bindValue(":id", $objAdminPagina->getId());
		$stmt->bindValue(":id_modulo", $objAdminPagina->getAdminModulo()->getId());
		$stmt->bindValue(":code", $objAdminPagina->getCode());
		$stmt->bindValue(":nome", $objAdminPagina->getNome());
		$stmt->bindValue(":descricao", $objAdminPagina->getDescricao());
		$stmt->bindValue(":ordem", $objAdminPagina->getOrdem());
		$stmt->bindValue(":oculto", $objAdminPagina->getOculto());
		$stmt->bindValue(":dat_alt", date("Y-m-d H:i:s"));
		$stmt->bindValue(":id_log_alt", $this->idAdmimLog);

		if($stmt->execute()){
			return true;
		}

	} catch (Exception $e) {
		Controller::debug($e);
	}

}

/**
* Exclusão logica do regio
* @param obj $objAdminPagina 
* @return bol
*/
public function excluir($objAdminPagina){

	try{

		$query = " UPDATE ".$this->tabela." SET dat_exc = :dat_exc, id_log_exc = :id_log_exc WHERE id = :id ";

		$stmt = $this->pdo->prepare($query);
		$stmt->bindValue(":id", $objAdminPagina->getId());
		$stmt->bindValue(":dat_exc", date('Y-m-d H:i:s'));
		$stmt->bindValue(":id_log_exc", $this->idAdmimLog);

		if($stmt->execute()){

			/* Remove permissões da página */
			$query = " DELETE FROM admin_perfil_permissao WHERE id = :id ";
			$stmt = $this->pdo->prepare($query);
			$stmt->bindValue(":id", $objAdminPagina->getId());
			$stmt->execute();

			return true;
		}

	} catch (Exception $e) {
		Controller::debug($e);
	}

}


    /**
     * Salva ordem das paginas
     */
    public function ordenar($objAdminPagina){
    	try{
    		$query = "UPDATE ".$this->tabela." SET ordem = :ordem WHERE id = :id";
    		$stmt = $this->pdo->prepare($query);
    		$stmt->bindValue(":ordem", $objAdminPagina->getOrdem());
    		$stmt->bindValue(":id", $objAdminPagina->getId());
    		return $stmt->execute();
    	} catch (Exception $e) {
    		Controller::debug($e);
    	}
    }


/**
* Lista osnresultados de acordo com paratmetros e campos tipo ou regios excluidos.
* @param  $parametro 
* @param  $arrParamValor 
* @param  $arrCampos 
* @param  $retorno 
* @param bool $excluido 
* @return arr|
*/
public function listar($parametro = null, $arrParamValor = null, $arrCampos = null, $retorno = null, $excluido = false){

	try{

		$queryAdd = null;

		$colunas = "id, id_modulo, code, nome, descricao, ordem ";

		if(is_array($arrCampos)){
			$colunas = implode(', ', $arrCampos);
		}

		if(!$excluido){
			$queryAdd .= " WHERE ( id_log_exc IS NULL AND dat_exc IS NULL ) ";
		}

		if(!empty($parametro)){
			$queryAdd .= isset($queryAdd) ? " AND " : " WHERE ";
			$queryAdd .= $parametro;
		}

		$query = " SELECT ".$colunas." FROM ".$this->tabela.$queryAdd;

		$stmt = $this->pdo->prepare($query);

		if(is_array($arrParamValor)){
			foreach ($arrParamValor as $key => $value) {
				$stmt->bindValue($key, $value);
			}
		}

		$stmt->execute();

		if($retorno == "int"){

			return $stmt->rowCount();

		}else{


			$arrFetchAll = $stmt->fetchAll(PDO::FETCH_ASSOC);
			$arrObjetos = array();

			if($arrFetchAll){

				foreach ($arrFetchAll as $arrDados) {
					$objAdminPagina = new AdminPagina();
					if(array_key_exists('id', $arrDados)){ $objAdminPagina->setId($arrDados['id']); }
					if(array_key_exists('id_modulo', $arrDados)){ 
						$objAdminModulo = ControllerAdminModulo::listar("id = :id", array(':id' => $arrDados['id_modulo']), null, "obj");
						$objAdminPagina->setAdminModulo($objAdminModulo);
					}
					if(array_key_exists('code', $arrDados)){ $objAdminPagina->setCode($arrDados['code']); }
					if(array_key_exists('nome', $arrDados)){ $objAdminPagina->setNome($arrDados['nome']); }
					if(array_key_exists('descricao', $arrDados)){ $objAdminPagina->setDescricao($arrDados['descricao']); }
					if(array_key_exists('ordem', $arrDados)){ $objAdminPagina->setOrdem($arrDados['ordem']); }
					if(array_key_exists('oculto', $arrDados)){ $objAdminPagina->setOculto($arrDados['oculto']); }
					$arrObjetos[] = $objAdminPagina;
				}

				if($retorno == "obj"){
					return $arrObjetos[0];
				}
			}

			return $arrObjetos;

		}

		return false;

	} catch (Exception $e) {
		Controller::debug($e);
	}

}

}