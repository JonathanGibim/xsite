<?php

$blnAcessoLiberado = false;
$modulo = null;

/**
 * 
 * ADMIN LOGIN
 * 
 **/
require('request-admin-login.php');

/**
 * 
 * AUTENTICA ACESSO
 * 
 **/
require('request-admin-core.php');

/**
 * 
 * ADMIN MODULO
 * 
 **/
require('request-admin-modulo.php');

/**
 * 
 * ADMIN USUARIO
 * 
 **/
require('request-admin-usuario.php');

/**
 * 
 * PERFIL
 * 
 **/
require('request-admin-perfil.php');