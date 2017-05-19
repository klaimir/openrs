<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

class MY_Controller extends CI_controller
{
    
    public function __construct()
    {
        parent::__construct();
        
        // Mantenimiento        
        if ($this->config->item('mantenimiento'))
        {
            redirect(site_url('auth/mantenimiento'), 'refresh');
            return;
        }
        
        $this->load->database();
        $this->load->library(array('ion_auth', 'form_validation', 'formularios'));
        $this->load->helper(array('url', 'language', 'date_helper', 'file', 'text', 'form', 'html', 'security'));
        $this->load->model('Usuario_model');
        $this->load->model('Admin_model');
        $this->load->model('Idioma_model');
        $this->load->model('Seccion_model');
        $this->load->model('General_model');
        // Public
        $this->initialize_public();
        // Private
        if ($this->ion_auth->logged_in())
        {
            $this->initialize_private();
        }
        else
        {
            $this->lang->load('auth');
        }
        // Enable profiler if ENVIRONMENT is development or testing
        if(ENVIRONMENT=='development' || ENVIRONMENT=='testing')
        {
            $this->output->enable_profiler(TRUE);
        }
        // Para que no de fallos en layout se definen inicializamente
        $this->data['_active_section']=NULL;
        $this->data['_breadcrumbs']=NULL;
    }

    protected function _security()
    {
        // logged
        if (!$this->ion_auth->logged_in())
        {
            redirect(site_url('auth/logout'), 'refresh');
        }
    }

    // Por si se desea inicializar algo publico
    private function initialize_public()
    {
        
    }

    private function initialize_private()
    {
        // Datos de sesión
        $this->data['session_logged_in'] = true;
        $this->data['session_user_id'] = $this->session->userdata('user_id');
        $this->data['session_user_name'] = $this->session->userdata('username');
        //$this->data['session_user_group'] = $this->ion_auth->get_users_groups()->row()->id;

        // Permisos
        $this->data['session_es_admin'] = $this->Usuario_model->is_admin($this->data['session_user_id']);
        $this->data['session_es_agente'] = $this->Usuario_model->is_agente($this->data['session_user_id']);
        
        // Idioma
        $idioma_usuario = $this->Usuario_model->get_lang($this->session->userdata('user_id'));
        $this->data['session_user_language'] = $idioma_usuario->carpeta_idioma;
        $this->data['session_id_idioma'] = $idioma_usuario->id_idioma;
        // Si la sesión se va muestra un warning
        if(empty($this->data['session_user_language']))
        {            
            $this->lang->load('auth',$this->config->item('language'));
            $this->lang->load('common',$this->config->item('language'));
        }
        else
        {
            $this->lang->load('auth',$this->data['session_user_language']);
            $this->lang->load('common',$this->data['session_user_language']);
        }
    }

    protected function is_post()
    {
        return $_SERVER['REQUEST_METHOD'] == 'POST' ? TRUE : FALSE;
    }

    protected function render_private($cuerpo, $data)
    {
        $data['_view_path'] = $cuerpo;
        $this->load->view('template/admin/layout', $data);
    }

    protected function render_public($cuerpo, $data)
    {
        $data['_view_path'] = $cuerpo;
        $this->load->view('public/template/layout', $data);
    }
    
    public function listado ($config){
    	$this->data['cargar_idiomas'] = $this->Idioma_model->get_idiomas_subidos_activos();
		$this->data['idioma_actual'] = $this->Usuario_model->get_usuario_idioma($this->ion_auth->user()->row()->id);
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
		$this->data['idioma_actual'] = $this->Usuario_model->get_usuario_idioma($this->ion_auth->user()->row()->id);
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
    
    public function ordenar ($config){
    	//$data = $this->inicializar(6, $config['title']);
    	$this->data['title'] = $config['title'];
    	$this->data['ordenar']=$this->$config['model_get']['model_name']->$config['model_get']['model_method'](isset($config['model_get']['idioma']) ? $config['model_get']['idioma']:'', isset($config['model_get']['model_param']) ? $config['model_get']['model_param']:'');
    	if($this->input->post()){
    		$ids_ordenadas = explode(";", $this->input->post('input_orden'));
    		for($i=0; $i<count($ids_ordenadas); $i++){
    			$this->$config['model_update']['model_name']->$config['model_update']['model_method']($config['model_update']['tabla'],array('prioridad' => ($i+1)),array($config['model_update']['id_tabla']=>$ids_ordenadas[$i]));
    		}
    		redirect($config['redirect']);
    	}
    
    	$this->render_private($config['view'], $this->data);
    }

}
