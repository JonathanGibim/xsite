<?php

class AdminModuloDao  {

	private $pdo;
	private $idAdmimLog;
	private $tabela;

	public function __construct() {
		$this->pdo = Conexao::getPdo();
		$this->idAdmimLog = $_SESSION[COD_SESSION."_id_admin_log"];
		$this->tabela = "admin_modulo";
	}

	/**
	 * Insere o regio no BD
	 * @param obj $objAdminModulo 
	 * @return 
	 */
	public function cadastrar($objAdminModulo){

		try{

			$query = " INSERT INTO ".$this->tabela." ( code, nome, descricao, icone, ordem, dat_inc, id_log_inc ) VALUES ( :code, :nome, :descricao, :icone, :ordem, :dat_inc, :id_log_inc ) ";

			$stmt = $this->pdo->prepare($query);
			$stmt->bindValue(":code", $objAdminModulo->getCode());
			$stmt->bindValue(":nome", $objAdminModulo->getNome());
			$stmt->bindValue(":descricao", $objAdminModulo->getDescricao());
			$stmt->bindValue(":icone", $objAdminModulo->getIcone());
			$stmt->bindValue(":ordem", $objAdminModulo->getOrdem());
			$stmt->bindValue(":dat_inc", date("Y-m-d H:i:s"));
			$stmt->bindValue(":id_log_inc", $this->idAdmimLog);

			if($stmt->execute()){
				$id = $this->pdo->lastInsertId();
				$objAdminModulo->setId($id);
				return $id;
			}

		} catch (Exception $e) {
			Controller::debug($e);
		}

	}

	/**
	 * Altera o regio no BD
	 * @param obj $objAdminModulo 
	 * @return bol
	 */
	public function editar($objAdminModulo){

		try{

			$query = " UPDATE ".$this->tabela." SET code = :code, nome = :nome, descricao = :descricao, icone = :icone, ordem = :ordem, dat_alt = :dat_alt, id_log_alt = :id_log_alt WHERE id = :id ";

			$stmt = $this->pdo->prepare($query);
			$stmt->bindValue(":id", $objAdminModulo->getId());
			$stmt->bindValue(":code", $objAdminModulo->getCode());
			$stmt->bindValue(":nome", $objAdminModulo->getNome());
			$stmt->bindValue(":descricao", $objAdminModulo->getDescricao());
			$stmt->bindValue(":icone", $objAdminModulo->getIcone());
			$stmt->bindValue(":ordem", $objAdminModulo->getOrdem());
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
	 * @param obj $objAdminModulo 
	 * @return bol
	 */
	public function excluir($objAdminModulo){

		try{

			$query = " UPDATE ".$this->tabela." SET dat_exc = :dat_exc, id_log_exc = :id_log_exc WHERE id = :id ";

			$stmt = $this->pdo->prepare($query);
			$stmt->bindValue(":id", $objAdminModulo->getId());
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
     * Salva ordem dos modulos
     */
    public function ordenar($objAdminModulo){
    	try{
    		$query = "UPDATE ".$this->tabela." SET ordem = :ordem WHERE id = :id";
    		$stmt = $this->pdo->prepare($query);
    		$stmt->bindValue(":ordem", $objAdminModulo->getOrdem());
    		$stmt->bindValue(":id", $objAdminModulo->getId());
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

			$colunas = "id, code, nome, descricao, icone, ordem ";

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
						$objAdminModulo = new AdminModulo();
						if(array_key_exists('id', $arrDados)){ $objAdminModulo->setId($arrDados['id']); }
						if(array_key_exists('code', $arrDados)){ $objAdminModulo->setCode($arrDados['code']); }
						if(array_key_exists('nome', $arrDados)){ $objAdminModulo->setNome($arrDados['nome']); }
						if(array_key_exists('descricao', $arrDados)){ $objAdminModulo->setDescricao($arrDados['descricao']); }
						if(array_key_exists('icone', $arrDados)){ $objAdminModulo->setIcone($arrDados['icone']); }
						if(array_key_exists('ordem', $arrDados)){ $objAdminModulo->setOrdem($arrDados['ordem']); }
						$arrObjetos[] = $objAdminModulo;
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