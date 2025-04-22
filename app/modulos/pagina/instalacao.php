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
  CREATE TABLE `pagina` (
    `id` int(9) NOT NULL AUTO_INCREMENT,
    `id_menu` int(9) DEFAULT NULL,
    `link` varchar(250) DEFAULT NULL,
    `nome` varchar(250) DEFAULT NULL,
    `conteudo` text DEFAULT NULL,
    `meta_title` varchar(250) DEFAULT NULL,
    `meta_description` varchar(250) DEFAULT NULL,
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
 * Cadastra modulo de pagina
 */
$objAdminModulo = new AdminModulo();
$objAdminModulo->setNome("Página");
$objAdminModulo->setCode("pagina");
$objAdminModulo->setDescricao("Gerenciamento de páginas do site");
$objAdminModulo->setIcone("fa fa-file-code");
$objAdminModulo->geraOrdenacao();
ControllerAdminModulo::cadastrar($objAdminModulo);

/**
 * Cadastra páginas do modulo de pagina
 */
$objAdminPagina = new AdminPagina();
$objAdminPagina->setAdminModulo($objAdminModulo);
$objAdminPagina->setNome("Gerenciar");
$objAdminPagina->setCode("gerenciar");
$objAdminPagina->setDescricao("Gerenciamento de páginas do site");
$objAdminPagina->setOculto(0);
ControllerAdminPagina::cadastrar($objAdminPagina);

$objAdminPagina = new AdminPagina();
$objAdminPagina->setAdminModulo($objAdminModulo);
$objAdminPagina->setNome("Cadastrar");
$objAdminPagina->setCode("cadastrar");
$objAdminPagina->setDescricao("Cadastrar página do site");
$objAdminPagina->setOculto(0);
ControllerAdminPagina::cadastrar($objAdminPagina);

$objAdminPagina = new AdminPagina();
$objAdminPagina->setAdminModulo($objAdminModulo);
$objAdminPagina->setNome("Editar");
$objAdminPagina->setCode("editar");
$objAdminPagina->setDescricao("Editar do página do site");
$objAdminPagina->setOculto(1);
ControllerAdminPagina::cadastrar($objAdminPagina);

$objAdminPagina = new AdminPagina();
$objAdminPagina->setAdminModulo($objAdminModulo);
$objAdminPagina->setNome("Excluir");
$objAdminPagina->setCode("excluir");
$objAdminPagina->setDescricao("Excluir pagina do site");
$objAdminPagina->setOculto(1);
ControllerAdminPagina::cadastrar($objAdminPagina);

}

if(isset($_GET['dados'])){

}