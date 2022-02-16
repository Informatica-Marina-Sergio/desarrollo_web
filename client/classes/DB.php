<?php

define('HOST', 'des-web.mysql.database.azure.com');
define('USER', 'flpi@des-web');
define('PASSWORD', 'FlyingPigs1');
define('DATABASE_NAME', 'tienda');
class DB
{
	private $con;
	public function connect(){
		$this->con = new Mysqli(HOST, USER, PASSWORD,DATABASE_NAME);
		return $this->con;
	}
}

?>