<?php

class PaginaDao {

    private $pdo;
    private $idAdmimLog;
    private $tabela;

    public function __construct() {
        $this->pdo = Conexao::getPdo();
        $this->idAdmimLog = $_SESSION[COD_SESSION."_id_admin_log"];
        $this->tabela = "pagina";
    }

    /**
     * Insere uma nova página no BD
     */
    public function cadastrar($objPagina){
        try{
            $query = "INSERT INTO ".$this->tabela." (id_menu, link, nome, conteudo, meta_title, meta_description, ordem, dat_inc, id_log_inc) 
            VALUES (:id_menu, :link, :nome, :conteudo, :meta_title, :meta_description, :ordem, :dat_inc, :id_log_inc) ";

            $stmt = $this->pdo->prepare($query);
            $stmt->bindValue(":id_menu", $objPagina->getIdMenu());
            $stmt->bindValue(":link", $objPagina->getLink());
            $stmt->bindValue(":nome", $objPagina->getNome());
            $stmt->bindValue(":conteudo", $objPagina->getConteudo());
            $stmt->bindValue(":meta_title", $objPagina->getMetaTitle());
            $stmt->bindValue(":meta_description", $objPagina->getMetaDescription());
            $stmt->bindValue(":ordem", $objPagina->getOrdem());
            $stmt->bindValue(":dat_inc", date("Y-m-d H:i:s"));
            $stmt->bindValue(":id_log_inc", $this->idAdmimLog);

            if($stmt->execute()){
                $id = $this->pdo->lastInsertId();
                $objPagina->setId($id);
                return $id;
            }
        } catch (Exception $e) {
            Controller::debug($e);
        }
    }

    /**
     * Atualiza uma página existente
     */
    public function editar($objPagina){
        try{
            $query = "UPDATE ".$this->tabela." SET id_menu = :id_menu, link = :link, nome = :nome, conteudo = :conteudo, meta_title = :meta_title, meta_description = :meta_description, ordem = :ordem, dat_alt = :dat_alt, id_log_alt = :id_log_alt  WHERE id = :id";

            $stmt = $this->pdo->prepare($query);
            $stmt->bindValue(":id", $objPagina->getId());
            $stmt->bindValue(":id_menu", $objPagina->getIdMenu());
            $stmt->bindValue(":link", $objPagina->getLink());
            $stmt->bindValue(":nome", $objPagina->getNome());
            $stmt->bindValue(":conteudo", $objPagina->getConteudo());
            $stmt->bindValue(":meta_title", $objPagina->getMetaTitle());
            $stmt->bindValue(":meta_description", $objPagina->getMetaDescription());
            $stmt->bindValue(":ordem", $objPagina->getOrdem());
            $stmt->bindValue(":dat_alt", date("Y-m-d H:i:s"));
            $stmt->bindValue(":id_log_alt", $this->idAdmimLog);

            return $stmt->execute();
        } catch (Exception $e) {
            Controller::debug($e);
        }
    }

    /**
     * Exclusão lógica da página
     */
    public function excluir($objPagina){
        try{
            $query = "UPDATE ".$this->tabela." SET dat_exc = :dat_exc, id_log_exc = :id_log_exc WHERE id = :id";

            $stmt = $this->pdo->prepare($query);
            $stmt->bindValue(":id", $objPagina->getId());
            $stmt->bindValue(":dat_exc", date('Y-m-d H:i:s'));
            $stmt->bindValue(":id_log_exc", $this->idAdmimLog);

            return $stmt->execute();
        } catch (Exception $e) {
            Controller::debug($e);
        }
    }


    /**
     * Salva ordem das páginas
     */
    public function ordenar($objPagina){
        try{
            $query = "UPDATE ".$this->tabela." SET ordem = :ordem WHERE id = :id";
            $stmt = $this->pdo->prepare($query);
            $stmt->bindValue(":ordem", $objPagina->getOrdem());
            $stmt->bindValue(":id", $objPagina->getId());
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
            $colunas = "id, id_menu, link, nome, conteudo, meta_title, meta_description, ordem";

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
                        $objPagina = new Pagina();
                        if(array_key_exists('id', $arrDados)){ $objPagina->setId($arrDados['id']); }
                        if(array_key_exists('id_menu', $arrDados)){ $objPagina->setIdMenu($arrDados['id_menu']); }
                        if(array_key_exists('link', $arrDados)){ $objPagina->setLink($arrDados['link']); }
                        if(array_key_exists('nome', $arrDados)){ $objPagina->setNome($arrDados['nome']); }
                        if(array_key_exists('conteudo', $arrDados)){ $objPagina->setConteudo($arrDados['conteudo']); }
                        if(array_key_exists('meta_title', $arrDados)){ $objPagina->setMetaTitle($arrDados['meta_title']); }
                        if(array_key_exists('meta_description', $arrDados)){ $objPagina->setMetaDescription($arrDados['meta_description']); }
                        if(array_key_exists('ordem', $arrDados)){ $objPagina->setOrdem($arrDados['ordem']); }
                        $arrObjetos[] = $objPagina;
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
