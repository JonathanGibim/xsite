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
	$sql = "CREATE TABLE `contato` (
		`id` int(9) NOT NULL AUTO_INCREMENT,
		`nome` varchar(250) DEFAULT NULL,
		`email` varchar(250) DEFAULT NULL,
		`telefone` varchar(250) DEFAULT NULL,
		`assunto` varchar(250) DEFAULT NULL,
		`mensagem` text DEFAULT NULL,
		`visualizado` tinyint(1) DEFAULT NULL,
		`dat_inc` datetime DEFAULT NULL,
		`id_log_inc` int(11) DEFAULT NULL,
		`dat_alt` datetime DEFAULT NULL,
		`id_log_alt` int(11) DEFAULT NULL,
		`dat_exc` datetime DEFAULT NULL,
		`id_log_exc` int(11) DEFAULT NULL,
		PRIMARY KEY (`id`)
	) ENGINE=MyISAM AUTO_INCREMENT=0 DEFAULT CHARSET=utf8;";

	$pdo->query($sql);
}

if(isset($_GET['cad-modulo'])){
/**
 * Cadastra modulo de contato
 */
$objAdminModulo = new AdminModulo();
$objAdminModulo->setNome("Contato");
$objAdminModulo->setCode("contato");
$objAdminModulo->setDescricao("Gerenciamento de contatos do site");
$objAdminModulo->setIcone("fas fa-comment-dots");
$objAdminModulo->geraOrdenacao();
ControllerAdminModulo::cadastrar($objAdminModulo);

/**
 * Cadastra paginas do modulo de contato
 */
$objAdminPagina = new AdminPagina();
$objAdminPagina->setAdminModulo($objAdminModulo);
$objAdminPagina->setNome("Gerenciar");
$objAdminPagina->setCode("gerenciar");
$objAdminPagina->setDescricao("Gerenciamento de contatos do site");
$objAdminPagina->setOculto(0);
ControllerAdminPagina::cadastrar($objAdminPagina);

$objAdminPagina = new AdminPagina();
$objAdminPagina->setAdminModulo($objAdminModulo);
$objAdminPagina->setNome("Cadastrar");
$objAdminPagina->setCode("cadastrar");
$objAdminPagina->setDescricao("Cadastrar contato do site");
$objAdminPagina->setOculto(0);
ControllerAdminPagina::cadastrar($objAdminPagina);

$objAdminPagina = new AdminPagina();
$objAdminPagina->setAdminModulo($objAdminModulo);
$objAdminPagina->setNome("Detalhes");
$objAdminPagina->setCode("detalhes");
$objAdminPagina->setDescricao("Detalhes do contato do site");
$objAdminPagina->setOculto(1);
ControllerAdminPagina::cadastrar($objAdminPagina);

$objAdminPagina = new AdminPagina();
$objAdminPagina->setAdminModulo($objAdminModulo);
$objAdminPagina->setNome("Excluir");
$objAdminPagina->setCode("excluir");
$objAdminPagina->setDescricao("Excluir contato do site");
$objAdminPagina->setOculto(1);
ControllerAdminPagina::cadastrar($objAdminPagina);

}


if(isset($_GET['dados'])){
}