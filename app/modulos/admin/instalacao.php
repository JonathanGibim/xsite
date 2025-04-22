<?php
/**
 * Configurações do sistema
 */
require_once '../../config.php';

/**
 * Carregamento de classes do sistema
 */
require_once '../../autoload.php';
/*
$idAdmimUsuario = $_SESSION[COD_SESSION."_id_admin_usuario"];
if($idAdmimUsuario != 1){ echo "não permitido"; die(); }
*/

$_SESSION[COD_SESSION."_id_admin_log"] = null;

$pdo = Conexao::getPdo();
$sql = "
CREATE TABLE `admin_log` (
	`id` int(11) NOT NULL AUTO_INCREMENT,
	`id_admin_usuario` int(11) DEFAULT NULL,
	`email` varchar(250) DEFAULT NULL,
	`senha` varchar(250) DEFAULT NULL,
	`navegador` varchar(250) DEFAULT NULL,
	`ip` varchar(250) DEFAULT NULL,
	`acesso` int(1) DEFAULT NULL,
	`dat_acesso` datetime DEFAULT NULL,
	PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=0 DEFAULT CHARSET=utf8;

/*Table structure for table `admin_modulo` */

CREATE TABLE `admin_modulo` (
	`id` int(9) NOT NULL AUTO_INCREMENT,
	`code` varchar(200) DEFAULT NULL,
	`nome` varchar(200) DEFAULT NULL,
	`descricao` text DEFAULT NULL,
	`icone` varchar(50) DEFAULT NULL,
	`ordem` int(2) DEFAULT NULL,
	`dat_inc` datetime DEFAULT NULL,
	`id_log_inc` int(9) DEFAULT NULL,
	`dat_alt` datetime DEFAULT NULL,
	`id_log_alt` int(9) DEFAULT NULL,
	`dat_exc` datetime DEFAULT NULL,
	`id_log_exc` int(9) DEFAULT NULL,
	PRIMARY KEY (`id`),
	UNIQUE KEY `dsc_code` (`code`),
	UNIQUE KEY `dsc_nome` (`nome`)
) ENGINE=MyISAM AUTO_INCREMENT=0 DEFAULT CHARSET=utf8;

/*Table structure for table `admin_pagina` */

CREATE TABLE `admin_pagina` (
	`id` int(9) NOT NULL AUTO_INCREMENT,
	`id_modulo` int(9) DEFAULT NULL,
	`code` varchar(200) DEFAULT NULL,
	`nome` varchar(200) DEFAULT NULL,
	`descricao` text DEFAULT NULL,
	`ordem` int(9) DEFAULT NULL,
	`oculto` tinyint(1) DEFAULT NULL,
	`dat_inc` datetime DEFAULT NULL,
	`id_log_inc` int(9) DEFAULT NULL,
	`dat_alt` datetime DEFAULT NULL,
	`id_log_alt` int(9) DEFAULT NULL,
	`dat_exc` datetime DEFAULT NULL,
	`id_log_exc` int(9) DEFAULT NULL,
	PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=0 DEFAULT CHARSET=utf8;

/*Table structure for table `admin_perfil` */

CREATE TABLE `admin_perfil` (
	`id` int(9) NOT NULL AUTO_INCREMENT,
	`nome` varchar(200) DEFAULT NULL,
	`descricao` text DEFAULT NULL,
	`dat_inc` datetime DEFAULT NULL,
	`id_log_inc` int(9) DEFAULT NULL,
	`dat_alt` datetime DEFAULT NULL,
	`id_log_alt` int(9) DEFAULT NULL,
	`dat_exc` datetime DEFAULT NULL,
	`id_log_exc` int(9) DEFAULT NULL,
	PRIMARY KEY (`id`),
	UNIQUE KEY `dsc_nome` (`nome`)
) ENGINE=MyISAM AUTO_INCREMENT=0 DEFAULT CHARSET=utf8;

/*Table structure for table `admin_perfil_permissao` */

CREATE TABLE `admin_perfil_permissao` (
	`id` int(9) NOT NULL AUTO_INCREMENT,
	`id_perfil` int(9) NOT NULL,
	`id_modulo` int(9) NOT NULL,
	`id_pagina` int(9) NOT NULL,
	PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=0 DEFAULT CHARSET=utf8;

/*Table structure for table `admin_usuario` */

CREATE TABLE `admin_usuario` (
	`id` int(9) NOT NULL AUTO_INCREMENT,
	`id_perfil` int(9) DEFAULT NULL,
	`nome` varchar(100) DEFAULT NULL,
	`email` varchar(100) DEFAULT NULL,
	`senha` varchar(255) DEFAULT NULL,
	`ativo` tinyint(1) DEFAULT NULL,
	`dat_nova_senha` datetime DEFAULT NULL,
	`token_senha` varchar(100) DEFAULT NULL,
	`dat_inc` datetime DEFAULT NULL,
	`id_log_inc` int(9) DEFAULT NULL,
	`dat_alt` datetime DEFAULT NULL,
	`id_log_alt` int(9) DEFAULT NULL,
	`dat_exc` datetime DEFAULT NULL,
	`id_log_exc` int(9) DEFAULT NULL,
	PRIMARY KEY (`id`),
	UNIQUE KEY `dsc_email` (`email`)
) ENGINE=MyISAM AUTO_INCREMENT=0 DEFAULT CHARSET=utf8;
";
$pdo->query($sql);

/**
 * Cadastra Módulo
 */
$objAdminModulo = new AdminModulo();
$objAdminModulo->setNome("Módulo");
$objAdminModulo->setCode("modulo");
$objAdminModulo->setDescricao("Gerenciamento de Módulos do admin");
$objAdminModulo->setIcone("fas fa-cubes");
ControllerAdminModulo::cadastrar($objAdminModulo);
/**
 * Cadastra paginas do modulo de Módulo
 */
$objAdminPagina = new AdminPagina();
$objAdminPagina->setAdminModulo($objAdminModulo);
$objAdminPagina->setNome("Gerenciar");
$objAdminPagina->setCode("gerenciar");
$objAdminPagina->setDescricao("Gerenciar Módulos do admin");
$objAdminPagina->setOculto(0);
ControllerAdminPagina::cadastrar($objAdminPagina);

$objAdminPagina = new AdminPagina();
$objAdminPagina->setAdminModulo($objAdminModulo);
$objAdminPagina->setNome("Cadastrar");
$objAdminPagina->setCode("cadastrar");
$objAdminPagina->setDescricao("Cadastrar Módulo do admin");
$objAdminPagina->setOculto(0);
ControllerAdminPagina::cadastrar($objAdminPagina);

$objAdminPagina = new AdminPagina();
$objAdminPagina->setAdminModulo($objAdminModulo);
$objAdminPagina->setNome("Editar");
$objAdminPagina->setCode("editar");
$objAdminPagina->setDescricao("Editar Módulo");
$objAdminPagina->setOculto(1);
ControllerAdminPagina::cadastrar($objAdminPagina);

$objAdminPagina = new AdminPagina();
$objAdminPagina->setAdminModulo($objAdminModulo);
$objAdminPagina->setNome("Excluir");
$objAdminPagina->setCode("excluir");
$objAdminPagina->setDescricao("Excluir Módulo");
$objAdminPagina->setOculto(1);
ControllerAdminPagina::cadastrar($objAdminPagina);

$objAdminPagina = new AdminPagina();
$objAdminPagina->setAdminModulo($objAdminModulo);
$objAdminPagina->setNome("Páginas");
$objAdminPagina->setCode("paginas");
$objAdminPagina->setDescricao("Gerenciar Páginas do Módulo");
$objAdminPagina->setOculto(1);
ControllerAdminPagina::cadastrar($objAdminPagina);

$objAdminPagina = new AdminPagina();
$objAdminPagina->setAdminModulo($objAdminModulo);
$objAdminPagina->setNome("Ordenar");
$objAdminPagina->setCode("ordenar");
$objAdminPagina->setDescricao("Ordenar Módulo");
$objAdminPagina->setOculto(1);
ControllerAdminPagina::cadastrar($objAdminPagina);

$objAdminPagina = new AdminPagina();
$objAdminPagina->setAdminModulo($objAdminModulo);
$objAdminPagina->setNome("Excluir Páginas");
$objAdminPagina->setCode("excluir-pagina");
$objAdminPagina->setDescricao("Excluir Páginas do Módulo");
$objAdminPagina->setOculto(1);
ControllerAdminPagina::cadastrar($objAdminPagina);

$objAdminPagina = new AdminPagina();
$objAdminPagina->setAdminModulo($objAdminModulo);
$objAdminPagina->setNome("Ordenar Páginas");
$objAdminPagina->setCode("ordenar-pagina");
$objAdminPagina->setDescricao("Ordenar Páginas do Módulo");
$objAdminPagina->setOculto(1);
ControllerAdminPagina::cadastrar($objAdminPagina);

$objAdminPagina = new AdminPagina();
$objAdminPagina->setAdminModulo($objAdminModulo);
$objAdminPagina->setNome("Config");
$objAdminPagina->setCode("config");
$objAdminPagina->setDescricao("Configuração e instalação dos modulos");
$objAdminPagina->setOculto(1);
ControllerAdminPagina::cadastrar($objAdminPagina);


/**
 * Cadastra Modulo de Perfil
 */
$objAdminModulo = new AdminModulo();
$objAdminModulo->setNome("Perfil");
$objAdminModulo->setCode("perfil");
$objAdminModulo->setDescricao("Gerenciamento de Perfis do admin");
$objAdminModulo->setIcone("fas fa-lock");
ControllerAdminModulo::cadastrar($objAdminModulo);
/**
 * Cadastra paginas do modulo de Perfil
 */
$objAdminPagina = new AdminPagina();
$objAdminPagina->setAdminModulo($objAdminModulo);
$objAdminPagina->setNome("Gerenciar");
$objAdminPagina->setCode("gerenciar");
$objAdminPagina->setDescricao("Gerenciar Perfis do admin");
$objAdminPagina->setOculto(0);
ControllerAdminPagina::cadastrar($objAdminPagina);

$objAdminPagina = new AdminPagina();
$objAdminPagina->setAdminModulo($objAdminModulo);
$objAdminPagina->setNome("Cadastrar");
$objAdminPagina->setCode("cadastrar");
$objAdminPagina->setDescricao("Cadastrar Perfil do admin");
$objAdminPagina->setOculto(0);
ControllerAdminPagina::cadastrar($objAdminPagina);

$objAdminPagina = new AdminPagina();
$objAdminPagina->setAdminModulo($objAdminModulo);
$objAdminPagina->setNome("Editar");
$objAdminPagina->setCode("editar");
$objAdminPagina->setDescricao("Editar Perfil");
$objAdminPagina->setOculto(1);
ControllerAdminPagina::cadastrar($objAdminPagina);

$objAdminPagina = new AdminPagina();
$objAdminPagina->setAdminModulo($objAdminModulo);
$objAdminPagina->setNome("Excluir");
$objAdminPagina->setCode("excluir");
$objAdminPagina->setDescricao("Excluir Perfil");
$objAdminPagina->setOculto(1);
ControllerAdminPagina::cadastrar($objAdminPagina);

$objAdminPagina = new AdminPagina();
$objAdminPagina->setAdminModulo($objAdminModulo);
$objAdminPagina->setNome("Permissões");
$objAdminPagina->setCode("permissoes");
$objAdminPagina->setDescricao("Gerenciar Permissões do Perfil");
$objAdminPagina->setOculto(1);
ControllerAdminPagina::cadastrar($objAdminPagina);




/**
 * Cadastra modulo de Usuário
 */
$objAdminModulo = new AdminModulo();
$objAdminModulo->setNome("Usuário");
$objAdminModulo->setCode("usuario");
$objAdminModulo->setDescricao("Gerenciamento de Usuários do admin");
$objAdminModulo->setIcone("fas fa-cubes");
ControllerAdminModulo::cadastrar($objAdminModulo);
/**
 * Cadastra paginas do modulo de Usuário
 */
$objAdminPagina = new AdminPagina();
$objAdminPagina->setAdminModulo($objAdminModulo);
$objAdminPagina->setNome("Gerenciar");
$objAdminPagina->setCode("gerenciar");
$objAdminPagina->setDescricao("Gerenciar Usuários do admin");
$objAdminPagina->setOculto(0);
ControllerAdminPagina::cadastrar($objAdminPagina);

$objAdminPagina = new AdminPagina();
$objAdminPagina->setAdminModulo($objAdminModulo);
$objAdminPagina->setNome("Cadastrar");
$objAdminPagina->setCode("cadastrar");
$objAdminPagina->setDescricao("Cadastrar Usuário do admin");
$objAdminPagina->setOculto(0);
ControllerAdminPagina::cadastrar($objAdminPagina);

$objAdminPagina = new AdminPagina();
$objAdminPagina->setAdminModulo($objAdminModulo);
$objAdminPagina->setNome("Editar");
$objAdminPagina->setCode("editar");
$objAdminPagina->setDescricao("Editar Usuário do admin");
$objAdminPagina->setOculto(1);
ControllerAdminPagina::cadastrar($objAdminPagina);

$objAdminPagina = new AdminPagina();
$objAdminPagina->setAdminModulo($objAdminModulo);
$objAdminPagina->setNome("Excluir");
$objAdminPagina->setCode("excluir");
$objAdminPagina->setDescricao("Excluir Usuário do admin");
$objAdminPagina->setOculto(1);
ControllerAdminPagina::cadastrar($objAdminPagina);

$objAdminPagina = new AdminPagina();
$objAdminPagina->setAdminModulo($objAdminModulo);
$objAdminPagina->setNome("Perfil");
$objAdminPagina->setCode("perfil");
$objAdminPagina->setDescricao("Perfil de Usuário do admin");
$objAdminPagina->setOculto(1);
ControllerAdminPagina::cadastrar($objAdminPagina);



/* CADASTRA ADMIN PERFIL ROOT */
$objAdminPerfil = new AdminPerfil();
$objAdminPerfil->setNome("ROOT");
$objAdminPerfil->setDescricao("ADMIN ROOT");
ControllerAdminPerfil::cadastrar($objAdminPerfil);


/* CADASTRA ADMIN USUARIO ROOT */
$objAdminUsuario = new AdminUsuario();
$objAdminUsuario->setAdminPerfil($objAdminPerfil);
$objAdminUsuario->setNome("Root Xweb");
$objAdminUsuario->setEmail("root@xweb.com.br");
$objAdminUsuario->setSenha('$2y$10$VlvwBF9s/JBbnp1ukSqXzOoKHAEvEdn2Y8WesRW1KteEBmwQs/k8W');
$objAdminUsuario->setAtivo(1);
ControllerAdminUsuario::cadastrar($objAdminUsuario);