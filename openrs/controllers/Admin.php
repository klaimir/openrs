<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require_once APPPATH . '/core/MY_Controller.php';

class Admin extends MY_Controller
{

    function __construct()
    {        
        parent::__construct();       

        // Secure the access
        $this->_security();
        
        // Comprobación de acceso
        $this->utilities->check_security_access_perfiles_or(array("session_es_admin"));
    }
    
    function inicializar($seccion, $titulo){
    	$this->data['cargar_idiomas'] = $this->Idioma_model->get_idiomas_subidos_activos();
    	$opc_cliente_col1 = $this->Admin_model->get_footer_cliente(1, 1);
    	$opc_cliente_col2 = $this->Admin_model->get_footer_cliente(1, 2);
    	$opc_cliente_col3 = $this->Admin_model->get_footer_cliente(1, 3);
    	$opc_cliente_col4 = $this->Admin_model->get_footer_cliente(1, 4);
    	//echo $opc_cliente_col1->id.' '.$opc_cliente_col2->id.' '.$opc_cliente_col3->id.' '.$opc_cliente_col4->id;exit();
    	foreach($this->data['cargar_idiomas'] as $idioma){
    		if($opc_cliente_col1 != NULL && $opc_cliente_col1->id_opc == 3)
    			$this->data['texto_footer1'][$idioma->id_idioma] = $this->Admin_model->get_texto_footer($opc_cliente_col1->id, $idioma->id_idioma);
    		if($opc_cliente_col2 != NULL && $opc_cliente_col2->id_opc == 3)
    			$this->data['texto_footer2'][$idioma->id_idioma] = $this->Admin_model->get_texto_footer($opc_cliente_col2->id, $idioma->id_idioma);
    		if($opc_cliente_col3 != NULL && $opc_cliente_col3->id_opc == 3)
    			$this->data['texto_footer3'][$idioma->id_idioma] = $this->Admin_model->get_texto_footer($opc_cliente_col3->id, $idioma->id_idioma);
    		if($opc_cliente_col4 != NULL && $opc_cliente_col4->id_opc == 3)
    			$this->data['texto_footer4'][$idioma->id_idioma] = $this->Admin_model->get_texto_footer($opc_cliente_col4->id, $idioma->id_idioma);
    	}
    	$this->data['idioma_actual'] = $this->Idioma_model->get_usuario_idioma($this->ion_auth->user()->row()->id);
    	$this->data['config']=$this->Admin_model->datos_config(1);
    	$this->data['title']= $titulo.' - '.$this->data['config']->nombre;
    	//$data['secciones'] = $this->seccion_model->get_secciones($data['idioma_actual']->id_idioma);
    	//$this->data['sec'] = $seccion;
    	return $this->data;
    }
    
    function index()
    {
    	$this->cabecera();
    }
    
    public function cabecera(){
    	$this->data = $this->inicializar('0', 'Cabecera');
    	//Cargamos configuración cabecera
    	//$this->data['config'] = $this->Admin_model->datos_config(1);
    	// Render
    	$this->data['color'] = $this->session->flashdata('color');
    	$this->data['mensaje'] = $this->session->flashdata('mensaje');
    	$this->render_private('admin/cabecera', $this->data);
    }
    
    public function modificarCabecera(){
    	$this->form_validation->set_rules('nombre',$this->lang->line('admin_nombre_web'),'trim|required');
    	$this->form_validation->set_rules('cabecera_fija',$this->lang->line('admin_cabecera_fija'),'trim|required');
    	$this->form_validation->set_rules('ccabecera',$this->lang->line('admin_color_cabecera'),'trim|required');
    	$this->form_validation->set_rules('cfuentecabecera',$this->lang->line('admin_color_fuente_cabecera'),'trim|required');
    	$this->form_validation->set_rules('cbordecabecera',$this->lang->line('admin_color_borde_cabecera'),'trim|required');
    	$this->form_validation->set_rules('cfondo',$this->lang->line('admin_color_fondo'),'trim|required');
    	$this->form_validation->set_rules('cfuentefondo',$this->lang->line('admin_color_fuente_fondo'),'trim|required');
    	$this->form_validation->set_rules('cpie',$this->lang->line('admin_color_pie'),'trim|required');
    	$this->form_validation->set_rules('cfuentepie',$this->lang->line('admin_color_fuente_pie'),'trim|required');
    	 
    	//editamos mensajes
    	$this->form_validation->set_message('required',$this->lang->line('login_c_required'));
    	 
    	if ($this->form_validation->run()){
    		$preferencias = array(
    				'nombre' => $this->input->post('nombre'),
    				'cabecera_fija' => $this->input->post('cabecera_fija'),
    				'ccabecera' => $this->input->post('ccabecera'),
    				'cfuentecabecera' => $this->input->post('cfuentecabecera'),
    				'cbordecabecera' => $this->input->post('cbordecabecera'),
    				'cfondo' => $this->input->post('cfondo'),
    				'cfuentefondo' => $this->input->post('cfuentefondo'),
    				'cpie' => $this->input->post('cpie'),
    				'cfuentepie' => $this->input->post('cfuentepie'),
    		);
    		//Si se cambia la imagen
    		if($this->input->post('change_logo') == 1){
    			if (isset($_FILES['userfile']['tmp_name'])) {
    				//Para panales independientes
    				/*if(!file_exists('img/preferencias/'.$this->simple_sessions->get_value('id_usuario')))
    				 mkdir('img/preferencias/'.$this->simple_sessions->get_value('id_usuario'), '0755', true);*/
    					
    				//Para panales independientes
    				//$config['upload_path'] = 'img/preferencias/'.$this->simple_sessions->get_value('id_usuario').'/';
    				$config['upload_path'] = 'assets/admin/img/preferencias/';
    				$config['allowed_types']='gif|jpg|jpeg|png';
    				$config['max_size']	= '1000';
    				$config['overwrite']=TRUE;
    				//$config['encrypt_name'] = TRUE;
    				 
    				$this->load->library('upload', $config);
    				 
    				if (!$this->upload->do_upload()) {
    					$this->session->set_flashdata('color','danger');
    					$this->session->set_flashdata('error', 'La imagen no puede superar 1MB');
    					redirect('admin/cabecera', 'refresh');
    				}else {
    					//Para paneles independientes
    					//$configuracion = $this->user_model->datos_config($this->simple_sessions->get_value('id_usuario'));
    					//if($configuracion && isset($configuracion->imagen) && file_exists('img/preferencias/'.$this->simple_sessions->get_value('id_usuario').'/'.$configuracion->imagen)){
    					//unlink('img/preferencias/'.$this->simple_sessions->get_value('id_usuario').'/'.$configuracion->imagen);
    					//unlink('img/preferencias/'.$this->simple_sessions->get_value('id_usuario').'/'.$configuracion->imagen_thumb);
    					//}
    					$configuracion = $this->Admin_model->datos_config(1);
    					if($configuracion && isset($configuracion->imagen) && file_exists('assets/admin/img/preferencias/'.$configuracion->imagen)){
    						unlink('assets/admin/img/preferencias/'.$configuracion->imagen);
    						//unlink('img/preferencias/1/'.$configuracion->imagen_thumb);
    					}
    					$file_data = $this->upload->data();
    					$preferencias['imagen'] = $file_data['file_name'];
    					//Ahora creamos una copia de la imagen a tamaño 279*98
    					$this->load->library('image_lib');
    					$config['image_library']='gd2';
    					//Para paneles independientes
    					//$config['source_image']='img/preferencias/'.$this->simple_sessions->get_value('id_usuario').'/'.$file_data['file_name'];
    					//$config['new_image']='img/preferencias/'.$this->simple_sessions->get_value('id_usuario').'/';
    					$config['source_image']='assets/admin/img/preferencias/'.$file_data['file_name'];
    					$config['new_image']='assets/admin/img/preferencias/';
    					$config['create_thumb'] = TRUE;
    					$config['maintain_ratio'] = FALSE;
    					$config['width'] = 182;
    					$config['height'] = 47;
    
    					$this->image_lib->clear();
    					$this->image_lib->initialize($config);
    
    					$preferencias['imagen_thumb'] = $file_data['raw_name'].'_thumb'.$file_data['file_ext'];
    					$this->image_lib->resize();
    					//Para paneles independientes
    					//$this->user_model->actualizar_configuracion($this->simple_sessions->get_value('id_usuario'), $preferencias);
    					$this->Admin_model->actualizar_configuracion(1, $preferencias);
    					$this->session->set_flashdata('color','success');
    					$this->session->set_flashdata('mensaje','Cambios realizados correctamente.');
    					redirect('admin/cabecera','refresh');
    				}
    			}else{
    				$this->session->set_flashdata('color','danger');
    				$this->session->set_flashdata('mensaje', validation_errors());
    				redirect('admin/cabecera', 'refresh');
    			}
    		}else{
    			$this->Admin_model->actualizar_configuracion(1, $preferencias);
    			redirect('admin/cabecera','refresh');
    		}
    	}else{
    		$this->session->set_flashdata('color','danger');
    		$this->session->set_flashdata('mensaje', validation_errors());
    		redirect('admin/cabecera', 'refresh');
    	}
    }
    
    public function pie(){
    	$this->data = $this->inicializar('0', 'Pie');
    	//Cargamos configuración pie
    	$this->data['opc_footer'] = $this->Admin_model->get_footer_opciones();
    	for($i=1;$i<5;$i++){//sacamos las opciones segun columna
    		//Para panales independientes
    		//$opc_cliente = $this->user_model->get_footer_cliente($this->simple_sessions->get_value('id_usuario'), $i);
    		$opc_cliente = $this->Admin_model->get_footer_cliente(1, $i);
    		if($opc_cliente != NULL)
    			$this->data['opc_col'.$i]=$opc_cliente;
    	}
    	// Render
    	$this->data['color'] = $this->session->flashdata('color');
    	$this->data['mensaje'] = $this->session->flashdata('mensaje');
    	$this->load->library('ckeditor', array('instanceName' => 'CKEDITOR1','basePath' => base_url()."assets/admin/ckeditor/", 'outPut' => true));
    	$this->render_private('admin/pie2', $this->data);
    }
    
    function modificarPie(){  
    	//echo 'Idioma: '.$this->input->post('idioma').'<br>Contenido: '.$this->input->post('contenido2_1');exit();
    	//Comprobación borrado de columna
    	if($this->input->post('col') == 0){
    		$cliente_opc = $this->Admin_model->get_footer_cliente(1, $this->input->post('columna'));
    		$this->Admin_model->borrar_texto_columna($cliente_opc->id);
    		$this->Admin_model->borrar_columna_pie(1, $this->input->post('columna'));
    	}
    		 
    	//Comprobación opción redes sociales
    	if($this->input->post('facebook')){
    		$datos_profile = array('facebook' => $this->input->post('facebook'));
    		$this->Admin_model->actualizar_red_social(1, $datos_profile);
    	}
    	if($this->input->post('twitter')){
    		$datos_profile = array('twitter' => $this->input->post('twitter'));
    		$this->Admin_model->actualizar_red_social(1, $datos_profile);
    	}
    	if($this->input->post('google')){
    		$datos_profile = array('google' => $this->input->post('google'));
    		$this->Admin_model->actualizar_red_social(1, $datos_profile);
    	}
    	if($this->input->post('vimeo')){
    		$datos_profile = array('vimeo' => $this->input->post('vimeo'));
    		$this->Admin_model->actualizar_red_social(1, $datos_profile);
    	}
    		 
    	//Comprobación Inserción de texto
    	if($this->input->post('idioma')){
    		//echo 'entro en idioma';exit();
    		$opc_cliente = $this->Admin_model->get_footer_cliente(1, $this->input->post('columna'));
    		//echo var_dump($opc_cliente);
    		$this->Admin_model->actualizar_texto($opc_cliente->id, $this->input->post('contenido'),$this->input->post('idioma'));
    	}
    	//Comprobación Edición de texto
    	if($this->input->post('idiomas')){
    		//echo 'entro en idiomas';exit();
    		$opc_cliente = $this->Admin_model->get_footer_cliente(1, $this->input->post('columna'));
    		$idiomas = $this->input->post('idiomas');
    		if($opc_cliente){
	    		foreach($idiomas as $idioma){
	    			$col=$this->input->post('columna');
	    			if($col == 1)
	    				$this->Admin_model->actualizar_texto($opc_cliente->id, $this->input->post('contenido_'.$idioma),$idioma);
	    			elseif($col == 2)
	    				$this->Admin_model->actualizar_texto($opc_cliente->id, $this->input->post('contenido2_'.$idioma),$idioma);
	    			elseif($col == 3)
	    				$this->Admin_model->actualizar_texto($opc_cliente->id, $this->input->post('contenido3_'.$idioma),$idioma);
	    			elseif($col == 4)
	    				$this->Admin_model->actualizar_texto($opc_cliente->id, $this->input->post('contenido4_'.$idioma),$idioma);
	    		}
    		}else{
    			$opc_cliente = $this->Admin_model->insert_footer_cliente(1, $this->input->post('columna'), 3);
	    		foreach($idiomas as $idioma){
	    			$col=$this->input->post('columna');
	    			if($col == 1)
	    				$this->Admin_model->actualizar_texto($opc_cliente, $this->input->post('contenido_'.$idioma),$idioma);
	    			elseif($col == 2)
	    				$this->Admin_model->actualizar_texto($opc_cliente, $this->input->post('contenido2_'.$idioma),$idioma);
	    			elseif($col == 3)
	    				$this->Admin_model->actualizar_texto($opc_cliente, $this->input->post('contenido3_'.$idioma),$idioma);
	    			elseif($col == 4)
	    				$this->Admin_model->actualizar_texto($opc_cliente, $this->input->post('contenido4_'.$idioma),$idioma);
	    		}
    		}
    	}
    	
    	$this->Admin_model->actualizar_pie_cliente(1, $this->input->post('columna'), $this->input->post('col'));
    	
    	$this->session->set_flashdata('color','success');
    	$this->session->set_flashdata('mensaje', 'Modificación realizada correctamente');
    	redirect('admin/pie','refresh');
    }
    
    function limpiar_red($red){
    	//Para paneles independientes
    	//$this->user_model->limpiar_red_social($this->simple_sessions->get_value('id_usuario'), $red);
    	$this->Admin_model->limpiar_red_social(1, $red);
    	$this->session->set_flashdata('color','success');
    	$this->session->set_flashdata('mensaje', 'Modificación realizada correctamente');
    	redirect('admin/pie','refresh');
    }
}
