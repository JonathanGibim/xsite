<?php

class AdminPerfilDao  {

	private $pdo;
	private $idAdmimLog;
	private $tabela;

	public function __construct() {
		$this->pdo = Conexao::getPdo();
		$this->idAdmimLog = $_SESSION[COD_SESSION."_id_admin_log"];
		$this->tabela = "admin_perfil";
	}

	/**
	 * Insere o regio no BD
	 * @param obj $objAdminPerfil 
	 * @return 
	 */
	public function cadastrar($objAdminPerfil){

		try{

			$query = " INSERT INTO ".$this->tabela." ( nome, descricao, dat_inc, id_log_inc ) VALUES ( :nome, :descricao, :dat_inc, :id_log_inc ) ";

			$stmt = $this->pdo->prepare($query);
			$stmt->bindValue(":nome", $objAdminPerfil->getNome());
			$stmt->bindValue(":descricao", $objAdminPerfil->getDescricao());
			$stmt->bindValue(":dat_inc", date("Y-m-d H:i:s"));
			$stmt->bindValue(":id_log_inc", $this->idAdmimLog);

			if($stmt->execute()){
				$id = $this->pdo->lastInsertId();
				$objAdminPerfil->setId($id);
				return $id;
			}

		} catch (Exception $e) {
			Controller::debug($e);
		}

	}

	/**
	 * Altera o regio no BD
	 * @param obj $objAdminPerfil 
	 * @return bol
	 */
	public function editar($objAdminPerfil){

		try{

			$query = " UPDATE ".$this->tabela." SET nome = :nome, descricao = :descricao, dat_alt = :dat_alt, id_log_alt = :id_log_alt WHERE id = :id ";

			$stmt = $this->pdo->prepare($query);
			$stmt->bindValue(":id", $objAdminPerfil->getId());
			$stmt->bindValue(":nome", $objAdminPerfil->getNome());
			$stmt->bindValue(":descricao", $objAdminPerfil->getDescricao());
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
	 * @param obj $objAdminPerfil 
	 * @return bol
	 */
	public function excluir($objAdminPerfil){

		try{

			$query = " UPDATE ".$this->tabela." SET dat_exc = :dat_exc, id_log_exc = :id_log_exc  WHERE id = :id ";

			$stmt = $this->pdo->prepare($query);
			$stmt->bindValue(":id", $objAdminPerfil->getId());
			$stmt->bindValue(":dat_exc", date('Y-m-d H:i:s'));
			$stmt->bindValue(":id_log_exc", $this->idAdmimLog);

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

			$colunas = "id, nome, descricao ";

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
						$objAdminPerfil = new AdminPerfil();
						if(array_key_exists('id', $arrDados)){ $objAdminPerfil->setId($arrDados['id']); }
						if(array_key_exists('nome', $arrDados)){ $objAdminPerfil->setNome($arrDados['nome']); }
						if(array_key_exists('descricao', $arrDados)){ $objAdminPerfil->setDescricao($arrDados['descricao']); }
						$arrObjetos[] = $objAdminPerfil;
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