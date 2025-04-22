<?php
/**
 * Configurações do sistema
 */
//require_once '../../config.php';

/**
 * Carregamento de classes do sistema
 */
//require_once '../../autoload.php';

$idAdmimUsuario = $_SESSION[COD_SESSION."_id_admin_usuario"];
if($idAdmimUsuario != 1){ echo "não permitido"; die(); }


if(isset($_GET['bd'])){
  $pdo = Conexao::getPdo();
  $sql = "
  CREATE TABLE `configuracao` (
    `id` int(9) NOT NULL AUTO_INCREMENT,
    `nome` varchar(250) DEFAULT NULL,
    `descricao` text DEFAULT NULL,
    `dat_exc` datetime DEFAULT NULL,
    `id_log_exc` int(11) DEFAULT NULL,
    PRIMARY KEY (`id`)
    ) ENGINE=MyISAM AUTO_INCREMENT=0 DEFAULT CHARSET=utf8;
  ";
  $pdo->query($sql);

}

if(isset($_GET['cad-modulo'])){
/**
 * Cadastra modulo de configuracao
 */
$objAdminModulo = new AdminModulo();
$objAdminModulo->setNome("Configuração");
$objAdminModulo->setCode("configuracao");
$objAdminModulo->setDescricao("Gerenciamento de Configuracões");
$objAdminModulo->setIcone("fa fa-cogs");
$objAdminModulo->geraOrdenacao();
ControllerAdminModulo::cadastrar($objAdminModulo);

/**
 * Cadastra páginas do modulo de configuracao
 */
$objAdminPagina = new AdminPagina();
$objAdminPagina->setAdminModulo($objAdminModulo);
$objAdminPagina->setNome("Gerenciar");
$objAdminPagina->setCode("gerenciar");
$objAdminPagina->setDescricao("Gerenciamento de configurações do site");
$objAdminPagina->setOculto(0);
ControllerAdminPagina::cadastrar($objAdminPagina);

}

if(isset($_GET['dados'])){

}