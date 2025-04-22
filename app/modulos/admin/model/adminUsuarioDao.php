<?php

class AdminUsuarioDao  {

	private $pdo;
	private $idAdmimLog;
	private $tabela;

	public function __construct() {
		$this->pdo = Conexao::getPdo();
		$this->idAdmimLog = $_SESSION[COD_SESSION."_id_admin_log"];
		$this->tabela = "admin_usuario";
	}

	/**
	 * Insere o regio no BD
	 * @param obj $objAdminUsuario 
	 * @return 
	 */
	public function cadastrar($objAdminUsuario){

		try{

			$query = " INSERT INTO ".$this->tabela." ( id_perfil, nome, email, senha, ativo, dat_nova_senha, token_senha, dat_inc, id_log_inc ) VALUES ( :id_perfil, :nome, :email, :senha, :ativo, :dat_nova_senha, :token_senha, :dat_inc, :id_log_inc ) ";

			$stmt = $this->pdo->prepare($query);
			$stmt->bindValue(":id_perfil", $objAdminUsuario->getAdminPerfil()->getId());
			$stmt->bindValue(":nome", $objAdminUsuario->getNome());
			$stmt->bindValue(":email", $objAdminUsuario->getEmail());
			$stmt->bindValue(":senha", $objAdminUsuario->getSenha());
			$stmt->bindValue(":ativo", $objAdminUsuario->getAtivo());
			$stmt->bindValue(":dat_nova_senha", $objAdminUsuario->getDatNovaSenha());
			$stmt->bindValue(":token_senha", $objAdminUsuario->getTokenSenha());
			$stmt->bindValue(":dat_inc", date("Y-m-d H:i:s"));
			$stmt->bindValue(":id_log_inc", $this->idAdmimLog);

			if($stmt->execute()){
				$id = $this->pdo->lastInsertId();
				$objAdminUsuario->setId($id);
				return $id;
			}

		} catch (Exception $e) {
			Controller::debug($e);
		}

	}

	/**
	 * Altera o regio no BD
	 * @param obj $objAdminUsuario 
	 * @return bol
	 */
	public function editar($objAdminUsuario){

		try{

			$query = " UPDATE ".$this->tabela." SET id_perfil = :id_perfil, nome = :nome, email = :email, senha = :senha, ativo = :ativo, dat_nova_senha = :dat_nova_senha, token_senha = :token_senha, dat_alt = :dat_alt, id_log_alt = :id_log_alt WHERE id = :id ";

			$stmt = $this->pdo->prepare($query);
			$stmt->bindValue(":id", $objAdminUsuario->getId());
			$stmt->bindValue(":id_perfil", $objAdminUsuario->getAdminPerfil()->getId());
			$stmt->bindValue(":nome", $objAdminUsuario->getNome());
			$stmt->bindValue(":email", $objAdminUsuario->getEmail());
			$stmt->bindValue(":senha", $objAdminUsuario->getSenha());
			$stmt->bindValue(":ativo", $objAdminUsuario->getAtivo());
			$stmt->bindValue(":dat_nova_senha", $objAdminUsuario->getDatNovaSenha());
			$stmt->bindValue(":token_senha", $objAdminUsuario->getTokenSenha());
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
	 * @param obj $objAdminUsuario 
	 * @return bol
	 */
	public function excluir($objAdminUsuario){

		try{

			$query = " UPDATE ".$this->tabela." SET dat_exc = :dat_exc, id_log_exc = :id_log_exc WHERE id = :id ";

			$stmt = $this->pdo->prepare($query);
			$stmt->bindValue(":id", $objAdminUsuario->getId());
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

			$colunas = "id, id_perfil, nome, email, senha, ativo, dat_nova_senha, token_senha";

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
						$objAdminUsuario = new AdminUsuario();
						if(array_key_exists('id', $arrDados)){ $objAdminUsuario->setId($arrDados['id']); }
						if(array_key_exists('id_perfil', $arrDados)){
							$objAdminPerfil = ControllerAdminPerfil::listar("id = :id", array(':id' => $arrDados['id_perfil']), null, "obj");
							$objAdminUsuario->setAdminPerfil($objAdminPerfil);
						}
						if(array_key_exists('nome', $arrDados)){ $objAdminUsuario->setNome($arrDados['nome']); }
						if(array_key_exists('email', $arrDados)){ $objAdminUsuario->setEmail($arrDados['email']); }
						if(array_key_exists('senha', $arrDados)){ $objAdminUsuario->setSenha($arrDados['senha']); }
						if(array_key_exists('ativo', $arrDados)){ $objAdminUsuario->setAtivo($arrDados['ativo']); }
						if(array_key_exists('dat_nova_senha', $arrDados)){ $objAdminUsuario->setDatNovaSenha($arrDados['dat_nova_senha']); }
						if(array_key_exists('token_senha', $arrDados)){ $objAdminUsuario->setTokenSenha($arrDados['token_senha']); }
						$arrObjetos[] = $objAdminUsuario;
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