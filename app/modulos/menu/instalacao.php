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
  CREATE TABLE `menu` (
    `id` int(9) NOT NULL AUTO_INCREMENT,
    `id_superior` int(9) DEFAULT NULL,
    `nome` varchar(250) DEFAULT NULL,
    `link` text DEFAULT NULL,
    `target` varchar(20) DEFAULT NULL,
    `ordem` int(2) DEFAULT NULL,
    `dat_inc` datetime DEFAULT NULL,
    `id_log_inc` int(11) DEFAULT NULL,
    `dat_alt` datetime DEFAULT NULL,
    `id_log_alt` int(11) DEFAULT NULL,
    `dat_exc` datetime DEFAULT NULL,
    `id_log_exc` int(11) DEFAULT NULL,
    PRIMARY KEY (`id`)
  ) ENGINE=MyISAM AUTO_INCREMENT=0 DEFAULT CHARSET=utf8;
  ";

  $pdo->query($sql);

}

if(isset($_GET['cad-modulo'])){
/**
 * Cadastra modulo de menu
 */
$objAdminModulo = new AdminModulo();
$objAdminModulo->setNome("Menu");
$objAdminModulo->setCode("menu");
$objAdminModulo->setDescricao("Gerenciamento de menus do site");
$objAdminModulo->setIcone("fa fa-bars");
$objAdminModulo->geraOrdenacao();
ControllerAdminModulo::cadastrar($objAdminModulo);

/**
 * Cadastra paginas do modulo de menu
 */
$objAdminPagina = new AdminPagina();
$objAdminPagina->setAdminModulo($objAdminModulo);
$objAdminPagina->setNome("Gerenciar");
$objAdminPagina->setCode("gerenciar");
$objAdminPagina->setDescricao("Gerenciamento de menus do site");
$objAdminPagina->setOculto(0);
ControllerAdminPagina::cadastrar($objAdminPagina);

$objAdminPagina = new AdminPagina();
$objAdminPagina->setAdminModulo($objAdminModulo);
$objAdminPagina->setNome("Cadastrar");
$objAdminPagina->setCode("cadastrar");
$objAdminPagina->setDescricao("Cadastrar menu do site");
$objAdminPagina->setOculto(0);
ControllerAdminPagina::cadastrar($objAdminPagina);

$objAdminPagina = new AdminPagina();
$objAdminPagina->setAdminModulo($objAdminModulo);
$objAdminPagina->setNome("Editar");
$objAdminPagina->setCode("editar");
$objAdminPagina->setDescricao("Editar do menu do site");
$objAdminPagina->setOculto(1);
ControllerAdminPagina::cadastrar($objAdminPagina);

$objAdminPagina = new AdminPagina();
$objAdminPagina->setAdminModulo($objAdminModulo);
$objAdminPagina->setNome("Excluir");
$objAdminPagina->setCode("excluir");
$objAdminPagina->setDescricao("Excluir menu do site");
$objAdminPagina->setOculto(1);
ControllerAdminPagina::cadastrar($objAdminPagina);

$objAdminPagina = new AdminPagina();
$objAdminPagina->setAdminModulo($objAdminModulo);
$objAdminPagina->setNome("Ordenar");
$objAdminPagina->setCode("ordenar");
$objAdminPagina->setDescricao("Ordenar menu do site");
$objAdminPagina->setOculto(1);
ControllerAdminPagina::cadastrar($objAdminPagina);

}

if(isset($_GET['dados'])){

}