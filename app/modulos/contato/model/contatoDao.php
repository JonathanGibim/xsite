<?php

class ContatoDao  {

	private $pdo;
	private $idAdmimLog;
	private $tabela;

	public function __construct() {
		$this->pdo = Conexao::getPdo();
		$this->idAdmimLog = $_SESSION[COD_SESSION."_id_admin_log"];
		$this->tabela = "contato";
	}

	/**
	 * Insere o regio no BD
	 * @param obj $objContato 
	 * @return 
	 */
	public function cadastrar($objContato){

		try{

			$query = " INSERT INTO ".$this->tabela." ( nome, email, telefone, assunto, mensagem, visualizado, dat_inc, id_log_inc ) VALUES ( :nome, :email, :telefone, :assunto, :mensagem, :visualizado, :dat_inc, :id_log_inc ) ";

			$stmt = $this->pdo->prepare($query);
			$stmt->bindValue(":nome", $objContato->getNome());
			$stmt->bindValue(":email", $objContato->getEmail());
			$stmt->bindValue(":telefone", $objContato->getTelefone());
			$stmt->bindValue(":assunto", $objContato->getAssunto());
			$stmt->bindValue(":mensagem", $objContato->getMensagem());
			$stmt->bindValue(":visualizado", $objContato->getVisualizado());
			$stmt->bindValue(":dat_inc", date("Y-m-d H:i:s"));
			$stmt->bindValue(":id_log_inc", $this->idAdmimLog);

			if($stmt->execute()){
				$id = $this->pdo->lastInsertId();
				$objContato->setId($id);
				return $id;
			}

		} catch (Exception $e) {
			Controller::debug($e);
		}

	}


	/**
	* Visualização do regio
	 * @param obj $objContato 
	 * @return bol
	 */
	public function visualizado($objContato){

		try{

			$query = " UPDATE ".$this->tabela." SET visualizado = :visualizado, dat_alt = :dat_alt, id_log_alt = :id_log_alt WHERE id = :id ";

			$stmt = $this->pdo->prepare($query);
			$stmt->bindValue(":id", $objContato->getId());
			$stmt->bindValue(":visualizado", $objContato->getVisualizado());
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
	 * @param obj $objContato 
	 * @return bol
	 */
	public function excluir($objContato){

		try{

			$query = " UPDATE ".$this->tabela." SET dat_exc = :dat_exc, id_log_exc = :id_log_exc WHERE id = :id ";

			$stmt = $this->pdo->prepare($query);
			$stmt->bindValue(":id", $objContato->getId());
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

			$colunas = "id, nome, email, telefone, assunto, mensagem, visualizado";

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

				if($arrFetchAll){
					$arrObjetos = array();
					foreach ($arrFetchAll as $arrDados) {
						$objContato = new Contato();
						if(array_key_exists('id', $arrDados)){ $objContato->setId($arrDados['id']); }
						if(array_key_exists('nome', $arrDados)){ $objContato->setNome($arrDados['nome']); }
						if(array_key_exists('email', $arrDados)){ $objContato->setEmail($arrDados['email']); }
						if(array_key_exists('telefone', $arrDados)){ $objContato->setTelefone($arrDados['telefone']); }
						if(array_key_exists('assunto', $arrDados)){ $objContato->setAssunto($arrDados['assunto']); }
						if(array_key_exists('mensagem', $arrDados)){ $objContato->setMensagem($arrDados['mensagem']); }
						if(array_key_exists('visualizado', $arrDados)){ $objContato->setVisualizado($arrDados['visualizado']); }
						$arrObjetos[] = $objContato;
					}

					if($retorno == "obj"){
						return $arrObjetos[0];
					}

					return $arrObjetos;
					
				}

			}

			return false;

		} catch (Exception $e) {
			Controller::debug($e);
		}

	}

}