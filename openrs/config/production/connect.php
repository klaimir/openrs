<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

function pdo_connect(){

	try{
		$dbdriver   = 'mysql';
		$hostname   = 'gesticadiz.es';
		$database   = 'openrs';
		$username   = 'openrs';
		$password   = 'Ytoh^267';

		//to connect
		$DB = new PDO($dbdriver.':host='.$hostname.'; dbname='.$database, $username, $password);
		return $DB;

	}catch(PDOException $e) {
		echo 'Please contact Admin: '.$e->getMessage();
	}

}
