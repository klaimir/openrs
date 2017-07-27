<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

function pdo_connect(){

	try{
		$dbdriver   = 'mysql';
		$hostname   = getenv('dbhost');
		$database   = getenv('dbname');
		$username   = getenv('dbuser');
		$password   = getenv('dbpass');

		//to connect
		$DB = new PDO($dbdriver.':host='.$hostname.'; dbname='.$database, $username, $password);
		return $DB;

	}catch(PDOException $e) {
		echo 'Please contact Admin: '.$e->getMessage();
	}

}
