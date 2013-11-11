<?php

class MySQL{
	protected $_host = 'localhost';
	protected $_username = 'root';
	protected $_password = '';
	protected $_db = 'kixeyetest';

	protected $_connection;

	protected static $_instance = null;

	private function __construct(){
		$this->_connection = mysqli_connect($this->_host, $this->_username, $this->_password, $this->_db);
	}

	public static function getInstance(){
		if(!self::$_instance){
			self::$_instance = new MySQL();
		}

		return self::$_instance;
	}

	public function query($queryString){
		return mysqli_query($this->_connection, $queryString);
	}
}