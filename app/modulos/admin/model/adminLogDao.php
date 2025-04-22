<?php

class AdminLogDao  {

	private $pdo;
	private $idAdmimLog;
	private $tabela;

	public function __construct() {
		$this->pdo = Conexao::getPdo();
		$this->idAdmimLog = $_SESSION[COD_SESSION."_id_admin_log"];
		$this->tabela = "admin_log";
	}

	/**
	 * Insere o regio no BD
	 * @param obj $objAdminLog 
	 * @return 
	 */
	public function cadastrar($objAdminLog){

		try{

			$query = " INSERT INTO ".$this->tabela." ( id_admin_usuario, email, senha, navegador, ip, acesso, dat_acesso ) VALUES ( :id_admin_usuario, :email, :senha, :navegador, :ip, :acesso, :dat_acesso ) ";

			$stmt = $this->pdo->prepare($query);
			$stmt->bindValue(":id_admin_usuario", $objAdminLog->getIdAdminUsuario());
			$stmt->bindValue(":email", $objAdminLog->getEmail());
			$stmt->bindValue(":senha", $objAdminLog->getSenha());
			$stmt->bindValue(":navegador", $objAdminLog->getNavegador());
			$stmt->bindValue(":ip", $objAdminLog->getIp());
			$stmt->bindValue(":acesso", $objAdminLog->getAcesso());
			$stmt->bindValue(":dat_acesso", date("Y-m-d H:i:s"));

			if($stmt->execute()){
				$id = $this->pdo->lastInsertId();
				$objAdminLog->setId($id);
				return $id;
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

			$colunas = "id, id_admin_usuario, email, senha, navegador, ip, acesso, dat_acesso";

			if(is_array($arrCampos)){
				$colunas = implode(', ', $arrCampos);
			}

			/*
			if(!$excluido){
				$queryAdd .= " WHERE ( 1 = 1 ) ";
			}
			*/

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
						$objAdminLog = new AdminModulo();
						if(array_key_exists('id', $arrDados)){ $objAdminLog->setId($arrDados['id']); }
						if(array_key_exists('id_admin_usuario', $arrDados)){ $objAdminLog->setIdAdminUsuario($arrDados['id_admin_usuario']); }
						if(array_key_exists('email', $arrDados)){ $objAdminLog->setEmail($arrDados['email']); }
						if(array_key_exists('senha', $arrDados)){ $objAdminLog->setSenha($arrDados['senha']); }
						if(array_key_exists('navegador', $arrDados)){ $objAdminLog->setNavegador($arrDados['navegador']); }
						if(array_key_exists('ip', $arrDados)){ $objAdminLog->setIp($arrDados['ip']); }
						if(array_key_exists('acesso', $arrDados)){ $objAdminLog->setAcesso($arrDados['acesso']); }
						if(array_key_exists('dat_acesso', $arrDados)){ $objAdminLog->setDatAcesso($arrDados['dat_acesso']); }
						$arrObjetos[] = $objAdminLog;
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