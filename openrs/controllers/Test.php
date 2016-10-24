<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//session_start(); # Aqui para que inicie la sesión
class Test extends MY_Controller {
	function index()     {
		 
		# Variables de sesion de KCFinder, deben declararse al hacer LogIn con un usuario
		//$_SESSION['KCFINDER'] = array();
		//$_SESSION['KCFINDER']['disabled'] = false;
				 
		# Al hacer LogOut deberíamos cambiar disabled a true: $_SESSION['KCFINDER']['disabled'] = true;
		$this->load->library('ckeditor', array('instanceName' => 'CKEDITOR1','basePath' => base_url()."ckeditor/", 'outPut' => true));

		# Cargamos la vista
		$this->render_private('test/ckeditor', $this->data);
	}
}