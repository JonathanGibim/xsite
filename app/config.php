<?php

define("DEBUG", true);

if(!DEBUG){
	ini_set("display_errors",0);
	error_reporting(0);
}else{
	ini_set('display_errors', 1);
	error_reporting(E_ALL);
}

define("DOMINIO", "sites.xweb.com.br/xsite");


// CONFIG LOCAL E PUBLICA
if($_SERVER['SERVER_NAME'] == 'localhost'){

	define("URL", "http://localhost/sites.xweb.com.br/xsite/");
	define("PATH", $_SERVER['DOCUMENT_ROOT']."/".DOMINIO."/");

	// CONFIGURACOES DO BANCO DE DADOS
	define("DB_HOST", "localhost");
	define("DB_USUARIO", "root");
	define("DB_SENHA", "");
	define("DB_BANCO", "xweb-xsite");

}else{

	define("URL", "https://sites.xweb.com.br/xsite/");
	define("PATH", $_SERVER['DOCUMENT_ROOT']."/");

	// CONFIGURACOES DO BANCO DE DADOS
	define("DB_HOST", "localhost");
	define("DB_USUARIO", "xwebcomb_xweb");
	define("DB_SENHA", "kcq8oOwepguD");
	define("DB_BANCO", "xwebcomb_xweb");

}


define("DIR_ADMIN", "admin");
define("URL_ADMIN", URL.DIR_ADMIN."/");
define("PATH_ADMIN", PATH.'public/'.DIR_ADMIN."/");

define("PATH_PUBLIC", PATH."public/");
define("PATH_SISTEMA", PATH."app/");
define("PATH_MODULO", PATH."app/modulos/");

define("URL_ATUAL", $_SERVER['REQUEST_SCHEME']."://".$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI']);

// IDENTIFICACAO CLIENTE
define("NOME_SITE", "Xweb");
define("NOME_CLIENTE", "XWEB");
define("TITLE", "XWEB");
define("COD_SESSION", "XWB");

// ESSE E O E-MAIL QUE RECEBER NOTIFICACOES SOBRE O SISTEMA
define("ADMIN_EMAIL", "contato@xweb.com.br");

// AUTENTICACAO/CONFIGURACAO DO ENVIO DE E-MAIL
define("MAIL_HOST", "mail.xweb.com.br");
define("MAIL_USUARIO", "autenticacao@xweb.com.br");
define("MAIL_SENHA", "XwebAut753*");
define("MAIL_PORTA", "587");
define("MAIL_TIPO", "");

// TRABALHA COM SESSSAO
session_start();

// DEFINE TIMEZONE SAO PAULO
date_default_timezone_set('America/Sao_Paulo');