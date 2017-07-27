<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

function pdo_connect(){

	try{
		$dbdriver   = 'mysql';
		$hostname   = 'produccion.es';
		$database   = 'openrs';
		$username   = 'openrs';
		$password   = 'password';

		//to connect
		$DB = new PDO($dbdriver.':host='.$hostname.'; dbname='.$database, $username, $password);
		return $DB;

	}catch(PDOException $e) {
		echo 'Please contact Admin: '.$e->getMessage();
	}

}
