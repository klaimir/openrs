<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Idioma extends MY_Controller_Front
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('Usuario_model');
		$this->load->model('Idioma_model');
		$this->load->model('General_model');
	}
	
	public function cambiar_idioma($cookie = 0){
		$idioma = $this->Idioma_model->get_idioma($this->input->post('id'));
		$idioma_actual = $this->Idioma_model->get_idioma($this->input->post('id_actual'));
		if($dir = opendir(APPPATH."language/".$idioma->carpeta_idioma)){
			while(($archivo = readdir($dir)) !== false){
				if($archivo != '.' && $archivo != '..' && $archivo != '.htaccess' && $archivo != '.svn'){
					$nombre_archivo = explode('_', $archivo);
					$this->lang->load($nombre_archivo[0], $idioma->carpeta_idioma);
				}
			}
		}
		$url_antigua = $this->input->post('location');
		$url_nueva = str_replace('/'.$idioma_actual->nombre_seo2.'/', '/'.$idioma->nombre_seo2.'/', $url_antigua);
		if(!$cookie){
			$this->Usuario_model->modificar_idioma_usuario($this->ion_auth->user()->row()->id, $idioma->id_idioma);
		}else{
			if(get_cookie('cookieLOPD')){
				$cookie = array(
					'name'   => 'cookieIdioma',
					'value'  => $idioma->id_idioma,
					'expire' => '31622400'
				);	
				set_cookie($cookie);
			}
		}
		echo $url_nueva;
	}
	
	function index(){
		if($this->input->cookie('cookieIdioma')){
			$cookie = get_cookie('cookieIdioma');
			$idioma = $this->Idioma_model->get_idioma($cookie);
			if($dir = opendir(APPPATH."language/".$idioma->carpeta_idioma)){
				while(($archivo = readdir($dir)) !== false){
					if($archivo != '.' && $archivo != '..' && $archivo != '.htaccess' && $archivo != '.svn'){
						$nombre_archivo = explode('_', $archivo);
						$this->lang->load($nombre_archivo[0], $idioma->carpeta_idioma);
					}
				}
			}
			$url="http://".$_SERVER['HTTP_HOST'].":".$_SERVER['SERVER_PORT'].$_SERVER['REQUEST_URI'];
			redirect($url.$idioma->nombre_seo2.'/seccion');
		}else{
			$accept = strtolower($_SERVER["HTTP_ACCEPT_LANGUAGE"]);
			$lang = explode( ",", $accept);
			$idioma_primario = explode('-',$lang[0]);
			$idioma_aux = $idioma_primario[0];
			if(isset($idioma_primario[1]) && $idioma_primario[1]){
				$pais = explode( "-", $lang[0]);
				$pais = $pais[1];
			}
			if(isset($pais) && $pais){
				$idioma = $this->Idioma_model->get_id_idioma_by_nombre($idioma_aux.'-'.$pais);
				if($idioma){
					if($dir = opendir(APPPATH."language/".$idioma->carpeta_idioma)){
						while(($archivo = readdir($dir)) !== false){
							if($archivo != '.' && $archivo != '..' && $archivo != '.htaccess' && $archivo != '.svn'){
								$nombre_archivo = explode('_', $archivo);
								$this->lang->load($nombre_archivo[0], $idioma->carpeta_idioma);
							}
						}
					}
					if(get_cookie('cookieLOPD')){
						$cookie = array(
								'name'   => 'cookieIdioma',
								'value'  => $idioma->id_idioma,
								'expire' => '31622400'
						);
						set_cookie($cookie);
					}
					$url="http://".$_SERVER['HTTP_HOST'].":".$_SERVER['SERVER_PORT'].$_SERVER['REQUEST_URI'];
					redirect($url.$idioma->nombre_seo2.'/seccion');
				}else{
					$idioma = $this->Idioma_model->get_id_idioma_by_nombre($idioma_aux);
					if($idioma){
						if($dir = opendir(APPPATH."language/".$idioma->carpeta_idioma)){
							while(($archivo = readdir($dir)) !== false){
								if($archivo != '.' && $archivo != '..' && $archivo != '.htaccess' && $archivo != '.svn'){
									$nombre_archivo = explode('_', $archivo);
									$this->lang->load($nombre_archivo[0], $idioma->carpeta_idioma);
								}
							}
						}
						if(get_cookie('cookieLOPD')){
							$cookie = array(
									'name'   => 'cookieIdioma',
									'value'  => $idioma->id_idioma,
									'expire' => '31622400'
							);
							set_cookie($cookie);
						}
						$url="http://".$_SERVER['HTTP_HOST'].":".$_SERVER['SERVER_PORT'].$_SERVER['REQUEST_URI'];
						redirect($url.$idioma->nombre_seo2.'/seccion');
					}else{
						$idioma = $this->Idioma_model->get_idioma($this->General_model->get_config('1')->idioma_defecto);
						if($dir = opendir(APPPATH."language/".$idioma->carpeta_idioma)){
							while(($archivo = readdir($dir)) !== false){
								if($archivo != '.' && $archivo != '..' && $archivo != '.htaccess' && $archivo != '.svn'){
									$nombre_archivo = explode('_', $archivo);
									$this->lang->load($nombre_archivo[0], $idioma->carpeta_idioma);
								}
							}
						}
						if(get_cookie('cookieLOPD')){
							$cookie = array(
									'name'   => 'cookieIdioma',
									'value'  => $idioma->id_idioma,
									'expire' => '31622400'
							);
							set_cookie($cookie);
						}
						$url="http://".$_SERVER['HTTP_HOST'].":".$_SERVER['SERVER_PORT'].$_SERVER['REQUEST_URI'];
						redirect($url.$idioma->nombre_seo2.'/seccion');
					}
				}
			}else{
				$idioma = $this->Idioma_model->get_id_idioma_by_nombre($idioma_aux);
				if($idioma){
					if($dir = opendir(APPPATH."language/".$idioma->carpeta_idioma)){
						while(($archivo = readdir($dir)) !== false){
							if($archivo != '.' && $archivo != '..' && $archivo != '.htaccess' && $archivo != '.svn'){
								$nombre_archivo = explode('_', $archivo);
								$this->lang->load($nombre_archivo[0], $idioma->carpeta_idioma);
							}
						}
					}
					if(get_cookie('cookieLOPD')){
						$cookie = array(
								'name'   => 'cookieIdioma',
								'value'  => $idioma->id_idioma,
								'expire' => '31622400'
						);
						set_cookie($cookie);
					}
					$url="http://".$_SERVER['HTTP_HOST'].":".$_SERVER['SERVER_PORT'].$_SERVER['REQUEST_URI'];
					redirect($url.$idioma->nombre_seo2.'/seccion');
				}else{
					$idioma = $this->Idioma_model->get_idioma($this->General_model->get_config('1')->idioma_defecto);
					if($dir = opendir(APPPATH."language/".$idioma->carpeta_idioma)){
						while(($archivo = readdir($dir)) !== false){
							if($archivo != '.' && $archivo != '..' && $archivo != '.htaccess' && $archivo != '.svn'){
								$nombre_archivo = explode('_', $archivo);
								$this->lang->load($nombre_archivo[0], $idioma->carpeta_idioma);
							}
						}
					}
					if(get_cookie('cookieLOPD')){
						$cookie = array(
								'name'   => 'cookieIdioma',
								'value'  => $idioma->id_idioma,
								'expire' => '31622400'
						);
						set_cookie($cookie);
					}
					$url="http://".$_SERVER['HTTP_HOST'].":".$_SERVER['SERVER_PORT'].$_SERVER['REQUEST_URI'];
					redirect($url.$idioma->nombre_seo2.'/seccion');
				}
			}
		}
	}
}