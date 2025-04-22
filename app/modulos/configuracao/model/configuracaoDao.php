<?php

class ConfiguracaoDao {

    private $pdo;
    private $idAdmimLog;
    private $tabela;

    public function __construct() {
        $this->pdo = Conexao::getPdo();
        $this->idAdmimLog = $_SESSION[COD_SESSION."_id_admin_log"];
        $this->tabela = "configuracao";
    }

    /**
     * Insere uma nova página no BD
     */
    public function cadastrar($objConfiguracao){
        try{

            $query = " UPDATE ".$this->tabela." SET dat_exc = :dat_exc, id_log_exc = :id_log_exc WHERE nome = :nome";
            $stmt = $this->pdo->prepare($query);
            $stmt->bindValue(":nome", $objConfiguracao->getNome());
            $stmt->bindValue(":dat_exc", date('Y-m-d H:i:s'));
            $stmt->bindValue(":id_log_exc", $this->idAdmimLog);

            if($stmt->execute()){

                $query = "INSERT INTO ".$this->tabela." (nome, descricao) VALUES (:nome, :descricao) ";
                $stmt = $this->pdo->prepare($query);
                $stmt->bindValue(":nome", $objConfiguracao->getNome());
                $stmt->bindValue(":descricao", $objConfiguracao->getDescricao());

                if($stmt->execute()){
                    $id = $this->pdo->lastInsertId();
                    $objConfiguracao->setId($id);
                    return $id;
                }
            }
            
        } catch (Exception $e) {
            Controller::debug($e);
        }
    }

    /**
     * Atualiza uma página existente
     */
    public function editar($objConfiguracao){
        try{
            $query = "UPDATE ".$this->tabela." SET nome = :nome, descricao = :descricao WHERE id = :id";

            $stmt = $this->pdo->prepare($query);
            $stmt->bindValue(":id", $objConfiguracao->getId());
            $stmt->bindValue(":nome", $objConfiguracao->getNome());
            $stmt->bindValue(":descricao", $objConfiguracao->getDescricao());

            return $stmt->execute();
        } catch (Exception $e) {
            Controller::debug($e);
        }
    }


    /**
     * Lista páginas cadastradas
     */
    public function listar($parametro = null, $arrParamValor = null, $arrCampos = null, $retorno = null, $excluido = false){
        try{
            $queryAdd = null;
            $colunas = "id, nome, descricao";

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
                        $objConfiguracao = new Configuracao();
                        if(array_key_exists('id', $arrDados)){ $objConfiguracao->setId($arrDados['id']); }
                        if(array_key_exists('nome', $arrDados)){ $objConfiguracao->setNome($arrDados['nome']); }
                        if(array_key_exists('descricao', $arrDados)){ $objConfiguracao->setDescricao($arrDados['descricao']); }
                        $arrObjetos[] = $objConfiguracao;
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
