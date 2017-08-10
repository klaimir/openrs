<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

function pdo_connect(){
    
        // Integración de base de datos de CI para uso de conexión PDO
        require(ENVIRONMENT.'/database.php');    
        
        $pdo_db = $db['default'];

	try{
		$dbdriver   = 'mysql';
		$hostname   = $pdo_db['hostname'];
		$database   = $pdo_db['database'];
		$username   = $pdo_db['username'];
		$password   = $pdo_db['password'];

		//to connect
		$DB = new PDO($dbdriver.':host='.$hostname.'; dbname='.$database, $username, $password);
		return $DB;

	}catch(PDOException $e) {
		echo 'Please contact Admin: '.$e->getMessage();
	}

}
