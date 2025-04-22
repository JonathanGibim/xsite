<?php

class MenuDao  {

	private $pdo;
    private $idAdmimLog;
    private $tabela;

    public function __construct() {
      $this->pdo = Conexao::getPdo();
      $this->idAdmimLog = $_SESSION[COD_SESSION."_id_admin_log"];
      $this->tabela = "menu";
  }

    /**
     * Insere um novo menu ou submenu no BD
     */
    public function cadastrar($objMenu){
    	try{
    		$query = "INSERT INTO ".$this->tabela." (id_superior, nome, link, target, ordem, dat_inc, id_log_inc) 
    		VALUES (:id_superior, :nome, :link, :target, :ordem, :dat_inc, :id_log_inc) ";

    		$stmt = $this->pdo->prepare($query);
    		$stmt->bindValue(":id_superior", $objMenu->getIdSuperior());
    		$stmt->bindValue(":nome", $objMenu->getNome());
    		$stmt->bindValue(":link", $objMenu->getLink());
    		$stmt->bindValue(":target", $objMenu->getTarget());
    		$stmt->bindValue(":ordem", $objMenu->getOrdem());
    		$stmt->bindValue(":dat_inc", date("Y-m-d H:i:s"));
            $stmt->bindValue(":id_log_inc", $this->idAdmimLog);

            if($stmt->execute()){
               $id = $this->pdo->lastInsertId();
               $objMenu->setId($id);
               return $id;
           }
       } catch (Exception $e) {
          Controller::debug($e);
      }
  }

    /**
     * Atualiza um menu existente
     */
    public function editar($objMenu){
    	try{
    		$query = "UPDATE ".$this->tabela." SET id_superior = :id_superior, nome = :nome, link = :link, target = :target, ordem = :ordem, dat_alt = :dat_alt, id_log_alt = :id_log_alt WHERE id = :id";

    		$stmt = $this->pdo->prepare($query);
    		$stmt->bindValue(":id", $objMenu->getId());
    		$stmt->bindValue(":id_superior", $objMenu->getIdSuperior());
    		$stmt->bindValue(":nome", $objMenu->getNome());
    		$stmt->bindValue(":link", $objMenu->getLink());
    		$stmt->bindValue(":target", $objMenu->getTarget());
    		$stmt->bindValue(":ordem", $objMenu->getOrdem());
            $stmt->bindValue(":dat_alt", date("Y-m-d H:i:s"));
            $stmt->bindValue(":id_log_alt", $this->idAdmimLog);

            return $stmt->execute();
        } catch (Exception $e) {
          Controller::debug($e);
      }
  }

    /**
     * Exclusão lógica do menu
     */
    public function excluir($objMenu){
    	try{
    		$query = "UPDATE ".$this->tabela." SET dat_exc = :dat_exc, id_log_exc = :id_log_exc WHERE id = :id";

    		$stmt = $this->pdo->prepare($query);
    		$stmt->bindValue(":id", $objMenu->getId());
    		$stmt->bindValue(":dat_exc", date('Y-m-d H:i:s'));
            $stmt->bindValue(":id_log_exc", $this->idAdmimLog);

            return $stmt->execute();
        } catch (Exception $e) {
          Controller::debug($e);
      }
  }

    /**
     * Salva ordem das menu
     */
    public function ordenar($objMenu){
        try{
            $query = "UPDATE ".$this->tabela." SET ordem = :ordem WHERE id = :id";
            $stmt = $this->pdo->prepare($query);
            $stmt->bindValue(":ordem", $objMenu->getOrdem());
            $stmt->bindValue(":id", $objMenu->getId());
            return $stmt->execute();
        } catch (Exception $e) {
            Controller::debug($e);
        }
    }

    /**
     * Lista menus e submenus
     */
    public function listar($parametro = null, $arrParamValor = null, $arrCampos = null, $retorno = null, $excluido = false){

        try{

            $queryAdd = null;

            $colunas = "id, id_superior, nome, link, target, ordem";

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
                        $objMenu = new Menu();
                        if(array_key_exists('id', $arrDados)){ $objMenu->setId($arrDados['id']); }
                        if(array_key_exists('id_superior', $arrDados)){ $objMenu->setIdSuperior($arrDados['id_superior']); }
                        if(array_key_exists('nome', $arrDados)){ $objMenu->setNome($arrDados['nome']); }
                        if(array_key_exists('link', $arrDados)){ $objMenu->setLink($arrDados['link']); }
                        if(array_key_exists('target', $arrDados)){ $objMenu->setTarget($arrDados['target']); }
                        if(array_key_exists('ordem', $arrDados)){ $objMenu->setOrdem($arrDados['ordem']); }
                        $arrObjetos[] = $objMenu;
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
