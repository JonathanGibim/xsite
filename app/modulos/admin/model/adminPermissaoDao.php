<?php

class AdminPermissaoDao  {

	private $pdo;
	private $idAdmimLog;
	private $tabela;

	public function __construct() {
		$this->pdo = Conexao::getPdo();
		$this->idAdmimLog = $_SESSION[COD_SESSION."_id_admin_log"];
		$this->tabela = "admin_perfil_permissao";
	}

	/**
	 * Insere o regio no BD
	 * @param obj $objAdminPermissao 
	 * @return 
	 */
	public function cadastrar($objAdminPermissao){

		try{

			$query = " INSERT INTO ".$this->tabela." (id_perfil, id_modulo, id_pagina ) VALUES ( :id_perfil, :id_modulo, :id_pagina ) ";

			$stmt = $this->pdo->prepare($query);
			$stmt->bindValue(":id_perfil", $objAdminPermissao->getAdminPerfil()->getId());
			$stmt->bindValue(":id_modulo", $objAdminPermissao->getAdminModulo()->getId());
			$stmt->bindValue(":id_pagina", $objAdminPermissao->getAdminPagina()->getId());

			if($stmt->execute()){
				return true;
			}

		} catch (Exception $e) {
			Controller::debug($e);
		}

	}



	/**
	 * Exclusão logica do regio
	 * @param obj $objAdminPermissao 
	 * @return bol
	 */
	public function excluir($objAdminPermissao){

		try{

			$query = " DELETE FROM ".$this->tabela." WHERE id_perfil = :id_perfil ";
			$stmt = $this->pdo->prepare($query);
			$stmt->bindValue(":id_perfil", $objAdminPermissao->getAdminPerfil()->getId());

			if($stmt->execute()){
				return true;
			}

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

			$colunas = "id, id_perfil, id_modulo, id_pagina ";

			if(is_array($arrCampos)){
				$colunas = implode(', ', $arrCampos);
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
						$objAdminPermissao = new AdminPermissao();
						if(array_key_exists('id', $arrDados)){ $objAdminPermissao->setId($arrDados['id']); }
						if(array_key_exists('id_perfil', $arrDados)){
							$objAdminPerfil = ControllerAdminPerfil::listar("id = :id", array(':id' => $arrDados['id_perfil']), null, "obj");
							$objAdminPermissao->setAdminPerfil($objAdminPerfil);
						}
						if(array_key_exists('id_modulo', $arrDados)){
							$objAdminModulo = ControllerAdminModulo::listar("id = :id", array(':id' => $arrDados['id_modulo']), null, "obj");
							$objAdminPermissao->setAdminModulo($objAdminModulo);
						}
						if(array_key_exists('id_pagina', $arrDados)){
							$objAdminPagina = ControllerAdminPagina::listar("id = :id", array(':id' => $arrDados['id_pagina']), null, "obj");
							$objAdminPermissao->setAdminPagina($objAdminPagina);
						}

						if($objAdminPermissao->getAdminPagina() instanceof AdminPagina){
							$arrObjetos[] = $objAdminPermissao;
						}

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