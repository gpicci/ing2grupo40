<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/viajes/config.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/viajes/common/log.php');

/**
 * DB Class
 *
 * Encapsula la funcionalidad de accesos a la base de datos.
 *
 */
class DB {

	private $_connection;
	private static $_instance; //The single instance
	private $_host = DB_CONN_HOSTNAME;
	private $_username = DB_CONN_USER;
	private $_password = DB_CONN_PASS;
	private $_database = DB_CONN_DB;


	/*
	 Get an instance of the Database
	 @return Instance
	 */
	public static function singleton() {
		if(!self::$_instance) { // If no instance then make one
			self::$_instance = new self();
		}
		return self::$_instance;
	}

	// Constructor
	private function __construct() {
		$this->_connection = new mysqli($this->_host, $this->_username,
				$this->_password, $this->_database);

		// Error handling
		if(mysqli_connect_error()) {
			trigger_error("Failed to conencto to MySQL: " . mysql_connect_error(),
					E_USER_ERROR);
		}
	}

	// Magic method clone is empty to prevent duplication of connection
	private function __clone() { }

	// Get mysqli connection
	public function getConnection() {
		return $this->_connection;
	}

	public function num_rows($rs) {
		return mysqli_num_rows($rs);
	}

	public function getLastAutoIncId() {
		return mysqli_insert_id($this->_connection);
	}

	public function goToFirstRecord($rs) {
		return mysqli_data_seek($rs, 0);
	}

	public function close() {
		if(!mysqli_close($this->_connection)){
			mysqli_close($this->_connection);
		}
	}

	public function executeQuery( $sql ) {
		if (!$rs = $this->_connection ->query($sql)) {
			applog(mysqli_error()." | query = ".$sql, 0);
			return false;
		} else {
			return $rs;
		}
	}

	public function fetch_assoc($rs) {
		return mysqli_fetch_assoc($rs);
	}

	public function escapeString( $string ) {
		return $this->_connection ->real_escape_string($string);
	}

}

function db_error() {
	return null;
}

?>
