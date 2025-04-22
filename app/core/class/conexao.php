<?php
/**
 * Conexão com BD em PDO
 */
class Conexao {

	public static $pdo;

	private function __construct() {
	}

	public static function getPdo() {

		if (!isset(self::$pdo)) {

			try {

				self::$pdo = new PDO('mysql:host='.DB_HOST.';dbname='.DB_BANCO, DB_USUARIO, DB_SENHA, array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES UTF8'));
				self::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				self::$pdo->setAttribute(PDO::ATTR_ORACLE_NULLS, PDO::NULL_EMPTY_STRING);

			} catch(PDOException $e) {

				Controller::debug($e);

			}

		}
		
		return self::$pdo;

	}

}
