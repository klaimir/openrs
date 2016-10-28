<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

class MY_Controller extends CI_controller
{
    var $config_template = NULL;

    public function __construct()
    {
        parent::__construct();
        
        $this->load->database();
        $this->load->library(array('ion_auth', 'form_validation', 'formularios'));
        $this->load->helper(array('url', 'language', 'date_helper', 'file', 'text', 'form', 'security'));
        $this->load->model('Usuarios_model');
        $this->load->model('Admin_model');
        $this->load->model('Idioma_model');
        $this->load->model('Seccion_model');
        $this->load->model('General_model');
        $this->lang->load('auth');
        // Public
        $this->initializePublic();
        // Private
        if ($this->ion_auth->logged_in())
        {
            $this->initializePrivate();
        }
    }

    protected function _security()
    {
        // Mantenimiento        
        if ($this->config->item('mantenimiento'))
        {
            redirect(site_url('auth/mantenimiento'), 'refresh');
            return;
        }

        // logged
        if (!$this->ion_auth->logged_in())
        {
            redirect(site_url('auth/logout'), 'refresh');
        }
    }

    private function initializePublic()
    {
        $this->config_template = array('menu_izquierda' => 'template', 'mostrar_copyright' => 0);
        $this->data['config_template'] = $this->config_template;
    }

    private function initializePrivate()
    {
        $this->data['session_logged_in'] = true;
        $this->data['session_user_id'] = $this->session->userdata('user_id');
        $this->data['session_user_name'] = $this->session->userdata('username');
        //$this->data['session_user_group'] = $this->ion_auth->get_users_groups()->row()->id;

        $this->data['session_es_admin'] = $this->Usuarios_model->getEsAdmin($this->data['session_user_id']);
        $this->data['session_es_gerente'] = $this->Usuarios_model->getEsGerente($this->data['session_user_id']);
        $this->data['session_es_empleado'] = $this->Usuarios_model->getEsEmpleado($this->data['session_user_id']);
    }

    protected function is_post()
    {
        return $_SERVER['REQUEST_METHOD'] == 'POST' ? TRUE : FALSE;
    }

    protected function render_private($cuerpo, $data)
    {
        $data['_view_path'] = $cuerpo;
        $this->load->view('admin/template/layout', $data);
    }

    protected function render_public($cuerpo, $data)
    {
        $data['_view_path'] = $cuerpo;
        $this->load->view('public/template/layout', $data);
    }
    
    public function listado ($config){
    	$this->data['cargar_idiomas'] = $this->Idioma_model->get_idiomas_subidos_activos();
		$this->data['idioma_actual'] = $this->Usuarios_model->get_usuario_idioma($this->ion_auth->user()->row()->id);
		$this->data['config']=$this->General_model->get_config();
		$this->data['title']= '';
		$this->data['secciones'] = $this->Seccion_model->get_secciones($this->data['idioma_actual']->id_idioma);
		$this->data['max_prioridad_seccion'] = $this->General_model->maximo('seccion','prioridad');
    	//Datos del listado
    	$this->data['listado']=$this->$config['model']['model_name']->$config['model']['model_method'](isset($config['model']['idioma']) ? $config['model']['idioma']:'', isset($config['model']['model_param']) ? $config['model']['model_param']:'');
    	//Botones generales
    	$this->data['botones']=$config['botones'];
    	//Colimnas del listado
    	$this->data['columnas']=$config['columnas'];
    	$this->data['opciones']=$config['opciones'];
   
    	$this->render_private($config['view'], $this->data);
    }
    
    public function crear($inputs,$config,$elementos = NULL){
    	$this->data['cargar_idiomas'] = $this->Idioma_model->get_idiomas_subidos_activos();
		$this->data['idioma_actual'] = $this->Usuarios_model->get_usuario_idioma($this->ion_auth->user()->row()->id);
		$this->data['config']=$this->General_model->get_config();
		$this->data['title']= '';
		$this->data['secciones'] = $this->Seccion_model->get_secciones($this->data['idioma_actual']->id_idioma);
		$this->data['max_prioridad_seccion'] = $this->General_model->maximo('seccion','prioridad');
    	$this->data['inputs']=$inputs;
    	$this->data['nuevo']=$config['nuevo'];
    	$this->data['nombre']=$config['nombre'];
    	$this->data['editando']=$config['editando'];
    	if($elementos)
    		$this->data['elementos']=$elementos;
    	$conf = $this->General_model->get_config($this->ion_auth->user()->row()->id);
    	if($this->input->post()){
    		$this->form_validation->set_message('is_natural_no_zero', $this->lang->line('login_c_is_natural_no_zero'));
    		$this->form_validation->set_message('required',$this->lang->line('login_c_required'));
    		$this->form_validation->set_message('max_length',$this->lang->line('login_c_max_length'));
    		foreach($this->data['cargar_idiomas'] as $idioma){
    			if($idioma->id_idioma == $conf->idioma_defecto){
    				foreach($this->data['inputs'] as $it){
    					if($it['fijo']){
    						if($it['val_req']){
    							$this->form_validation->set_rules($it['form_group']['name'],$it['label'],'required|'.$it['form_validation']);
    						}else{
    							$this->form_validation->set_rules($it['form_group']['name'],$it['label'],$it['form_validation']);
    						}
    					}else{
    						if($it['val_req']){
    							$this->form_validation->set_rules($it['form_group']['name'].'_'.$idioma->id_idioma,$it['label'],'required|'.$it['form_validation']);
    						}else{
    							$this->form_validation->set_rules($it['form_group']['name'].'_'.$idioma->id_idioma,$it['label'],$it['form_validation']);
    						}
    					}
    				}
    			}else{
    				foreach($this->data['inputs'] as $it){
    					if(!$it['fijo'])
    						$this->form_validation->set_rules($it['form_group']['name'].'_'.$idioma->id_idioma,$it['label'],$it['form_validation']);
    				}
    			}
    		}
    		if($this->form_validation->run()){
    			foreach($this->data['inputs'] as $it){
    				if($it['fijo']){
    					$datos_insert[$it['form_group']['name']]=$this->input->post($it['form_group']['name']);
    				}
    			}
    			if($config['nuevo']==true){
    				$id = $this->$config['model_insert']['model']->$config['model_insert']['method']($config['model_insert']['table'],$datos_insert,isset($config['model_insert']['extra'])?$config['model_insert']['extra']:'');
    			}else{
    				$id = $this->$config['model_update']['model']->$config['model_update']['method']($config['model_update']['table'],$datos_insert,$config['model_update']['where']);
    			}
    			foreach($this->data['cargar_idiomas'] as $idioma){
    				foreach($this->data['inputs'] as $it){
    					if(!$it['fijo']){
    						if($this->input->post($it['form_group']['name'].'_'.$idioma->id_idioma)){
    							$datos_insert_idiomas[$it['form_group']['name']]=$this->input->post($it['form_group']['name'].'_'.$idioma->id_idioma);
    						}else{
    							$datos_insert_idiomas[$it['form_group']['name']]=$this->input->post($it['form_group']['name'].'_'.$conf->idioma_defecto).'_'.$idioma->id_idioma;
    						}
    					}
    				}
    				if($config['nuevo']==true){
    					$datos_insert_idiomas['id_idioma'] = $idioma->id_idioma;
    					$datos_insert_idiomas[$config['model_insert_idiomas']['enlace']] = $id;
    					$this->$config['model_insert_idiomas']['model']->$config['model_insert_idiomas']['method']($config['model_insert_idiomas']['table'],$datos_insert_idiomas,isset($config['model_insert_idiomas']['extra'])?$config['model_insert_idiomas']['extra']:'');
    				}else{
    					$config['model_update_idiomas']['where']['id_idioma'] = $idioma->id_idioma;
    					if($this->General_model->existe($config['model_insert_idiomas']['table'], $config['model_update_idiomas']['where'])){
    						$this->$config['model_update_idiomas']['model']->$config['model_update_idiomas']['method']($config['model_update_idiomas']['table'],$datos_insert_idiomas,$config['model_update_idiomas']['where']);
    					}else{
    						$datos_insert_idiomas['id_idioma'] = $idioma->id_idioma;
    						$datos_insert_idiomas[$config['model_insert_idiomas']['enlace']] = $id;
    						$this->$config['model_insert_idiomas']['model']->$config['model_insert_idiomas']['method']($config['model_insert_idiomas']['table'],$datos_insert_idiomas,isset($config['model_insert_idiomas']['extra'])?$config['model_insert_idiomas']['extra']:'');
    					}
    				}
    			}
    			redirect($config['redirect']);
    		}
    	}
    
    	$this->render_private($config['view'], $this->data);
    }

}
