<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require_once APPPATH . 'core/MY_Controller.php';

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
    	$this->data['config']=$this->Admin_model->datos_config();
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
        // Sección activa
        $this->data['_active_section']="cabecera";
    	//Cargamos configuración cabecera
    	//$this->data['config'] = $this->Admin_model->datos_config();
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
    				$config['upload_path'] = 'uploads/general/img/preferencias/';
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
    					//$configuracion = $this->user_model->datos_config();
    					//if($configuracion && isset($configuracion->imagen) && file_exists('img/preferencias/'.$this->simple_sessions->get_value('id_usuario').'/'.$configuracion->imagen)){
    					//unlink('img/preferencias/'.$this->simple_sessions->get_value('id_usuario').'/'.$configuracion->imagen);
    					//unlink('img/preferencias/'.$this->simple_sessions->get_value('id_usuario').'/'.$configuracion->imagen_thumb);
    					//}
    					$configuracion = $this->Admin_model->datos_config();
    					if($configuracion && isset($configuracion->imagen) && file_exists('uploads/general/img/preferencias/'.$configuracion->imagen)){
    						unlink('uploads/general/img/preferencias/'.$configuracion->imagen);
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
    					$config['source_image']='uploads/general/img/preferencias/'.$file_data['file_name'];
    					$config['new_image']='uploads/general/img/preferencias/';
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
        $this->data['_active_section']="pie";
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
    	//Comprobación borrado de columna
    	if($this->input->post('col') == 0){
    		$cliente_opc = $this->Admin_model->get_footer_cliente(1, $this->input->post('columna'));
    		$this->Admin_model->borrar_texto_columna($cliente_opc->id);
    		$this->Admin_model->borrar_columna_pie(1, $this->input->post('columna'));
    	}elseif($this->input->post('col') == 2){
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
    	}elseif($this->input->post('col') == 3){	 
			//Comprobación Inserción de texto
			if($this->input->post('idioma')){
				$opc_cliente = $this->Admin_model->get_footer_cliente(1, $this->input->post('columna'));
				$this->Admin_model->actualizar_texto($opc_cliente->id, $this->input->post('contenido'), $this->input->post('columna'), $this->input->post('idioma'));
			}
			//Comprobación Edición de texto
			if($this->input->post('idiomas')){
				$opc_cliente = $this->Admin_model->get_footer_cliente(1, $this->input->post('columna'));
				$idiomas = $this->input->post('idiomas');
				if($opc_cliente){
					foreach($idiomas as $idioma){
						$col=$this->input->post('columna');
						if($col == 1)
							$this->Admin_model->actualizar_texto($opc_cliente->id, $this->input->post('contenidoe_'.$idioma),$idioma);
						elseif($col == 2)
							$this->Admin_model->actualizar_texto($opc_cliente->id, $this->input->post('contenido2e_'.$idioma),$idioma);
						elseif($col == 3)
							$this->Admin_model->actualizar_texto($opc_cliente->id, $this->input->post('contenido3e_'.$idioma),$idioma);
						
					}
				}else{
					//Borramos la columna vacia
					$this->Admin_model->borrar_columna_pie(1, $this->input->post('columna'), 3);
					$opc_cliente = $this->Admin_model->insert_footer_cliente(1, $this->input->post('columna'), 3);
					foreach($idiomas as $idioma){
						$col=$this->input->post('columna');
						if($col == 1)
							$this->Admin_model->actualizar_texto($opc_cliente, $this->input->post('contenido_'.$idioma),$idioma);
						elseif($col == 2)
							$this->Admin_model->actualizar_texto($opc_cliente, $this->input->post('contenido2_'.$idioma),$idioma);
						elseif($col == 3)
							$this->Admin_model->actualizar_texto($opc_cliente, $this->input->post('contenido3_'.$idioma),$idioma);
						
					}
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
    
/***********************************************************************************************************/
/************************************************* IDIOMAS *************************************************/
/***********************************************************************************************************/
    
    public function gestionar_idiomas($error = NULL){
    	$this->data = $this->inicializar(-4, $this->lang->line('admin_gestionar_idiomas'));
        $this->data['_active_section']="idiomas";
    	if($error == 1)
    		$this->data['message'] = $this->lang->line('admin_c_gestionar_idiomas_error1');
    	elseif($error == 2)
    		$this->data['message'] = $this->lang->line('admin_c_gestionar_idiomas_error2');
    	elseif($error == 3)
    		$this->data['message'] = $this->lang->line('admin_c_gestionar_idiomas_exito');
    		$this->data['idiomas'] = $this->Idioma_model->get_idiomas_subidos();
    	$this->render_private('admin/gestionar_idiomas', $this->data);
    }
    
    public function modificar_idioma(){
    	if($this->input->post()){
    		$id = $this->input->post('id_idioma');
    		$this->form_validation->set_rules('nombre_'.$id,$this->lang->line('admin_idioma'),'trim|required|max_length[50]');
    		$this->form_validation->set_rules('nombre_seo_'.$id,$this->lang->line('admin_idioma_seo1'),'trim|required|max_length[3]');
    		$this->form_validation->set_rules('nombre_seo2_'.$id,$this->lang->line('admin_idioma_seo2'),'trim|required|max_length[10]');
    		
    		//editamos mensajes
    		$this->form_validation->set_message('required',$this->lang->line('login_c_required'));
    		$this->form_validation->set_message('max_length',$this->lang->line('login_c_max_length'));
    		
    		if($this->form_validation->run()==FALSE){
    			$this->gestionar_idiomas();
    		}else{
    			if(count($this->Idioma_model->idiomas_activos()) > '1' || $this->input->post('activo_'.$id)){
    				$datos = array('nombre' => $this->input->post('nombre_'.$id),
    						'nombre_seo' => $this->input->post('nombre_seo_'.$id),
    						'nombre_seo2' => $this->input->post('nombre_seo2_'.$id),
    						'activo' => $this->input->post('activo_'.$id));
    				$this->Idioma_model->modificar_idioma($id, $datos);
    				redirect('admin/gestionar_idiomas', 'refresh');
    			}else{
    				$this->gestionar_idiomas(1);
    			}
    		}
    	}
    }
    
    function subir_idiomas($error = NULL){
    	$data = $this->inicializar(-4, $this->lang->line('admin_subir_idiomas'));
        $this->data['_active_section']="idiomas";
    	if($error == 1)
    		$this->data['message'] = $this->lang->line('admin_c_subir_idiomas_error1');
    	elseif($error == 2)
    		$this->data['message'] = $this->lang->line('admin_c_subir_idiomas_exito');
    	elseif($error == 3)
    		$this->data['message'] = $this->lang->line('admin_c_subir_idiomas_error2');
    	elseif($error == 4)
    		$this->data['message'] = $this->lang->line('admin_c_subir_idiomas_error3');
    	elseif($error == 5)
    		$this->data['message'] = $this->lang->line('admin_c_subir_idiomas_error4');
    	foreach($this->Idioma_model->get_idiomas_no_subidos() as $idioma){
    		$this->data['idiomas'][$idioma->id_idioma] = $idioma->nombre;
    	}
    	$this->render_private('admin/subir_idiomas', $this->data);
    }
    
    function subir_idioma(){    	
    	$this->form_validation->set_rules('idioma',$this->lang->line('admin_idioma'),'trim|required');   	
    	if($this->form_validation->run()){
    		$idioma = $this->Idioma_model->get_idioma($this->input->post('idioma'));
    		if(isset($_FILES['userfile']['tmp_name'])){
    			if(file_exists(APPPATH."language/".$idioma->carpeta_idioma)){
    				if($dir = opendir(APPPATH."language/".$idioma->carpeta_idioma)){
    					while(($archivo = readdir($dir)) !== false){
    						if($archivo != '.' && $archivo != '..' && $archivo != '.htaccess' && $archivo != '.svn'){
    							if(!unlink(APPPATH."language/".$idioma->carpeta_idioma.'/'.$archivo))
    								$this->subir_idiomas(3);
    						}
    					}
    					closedir($dir);
    				}
    				if(!rmdir(APPPATH."language/".$idioma->carpeta_idioma))
    					$this->subir_idiomas(3);
    			}
    			if(mkdir(APPPATH."language/".$idioma->carpeta_idioma, 755, true)){
    				$config['upload_path'] = APPPATH."language/".$idioma->carpeta_idioma.'/';
    				$config['allowed_types']='zip';
    				$config['max_size']	= '1000';
    				$config['overwrite']=TRUE;
    				
    				$this->load->library('upload', $config);
    				if (!$this->upload->do_upload()) {
    					$this->subir_idiomas(4);
    				}else{
    					$file_data = $this->upload->data();
    					$zip = new ZipArchive;
    					$res = $zip->open(APPPATH."language/".$idioma->carpeta_idioma.'/'.$file_data['file_name']);
    					if ($res === TRUE) {
    						$zip->extractTo(APPPATH."language/".$idioma->carpeta_idioma.'/');
    						$zip->close();
    						unlink(APPPATH."language/".$idioma->carpeta_idioma.'/'.$file_data['file_name']);
    						$datos = array('activo' => '1',
    								'subido' => '1');
    						$this->Idioma_model->modificar_idioma($this->input->post('idioma'), $datos);
    						redirect('admin/subir_idiomas/2', 'refresh');
    					} else {
    						$this->subir_idiomas(5);
    					}
    				}
    			}else{
    				$this->subir_idiomas(3);
    			}
    		}
    	}else{
    		$this->subir_idiomas(1);
    	}
    }
    
    function eliminar_idioma($idioma_aux){
    	$idioma = $this->Idioma_model->get_idioma($idioma_aux);
    	if(file_exists(APPPATH."language/".$idioma->carpeta_idioma)){
    		if($dir = opendir(APPPATH."language/".$idioma->carpeta_idioma)){
    			while(($archivo = readdir($dir)) !== false){
    				if($archivo != '.' && $archivo != '..' && $archivo != '.htaccess' && $archivo != '.svn'){
    					if(!unlink(APPPATH."language/".$idioma->carpeta_idioma.'/'.$archivo))
    						$this->gestionar_idiomas(2);
    				}
    			}
    			closedir($dir);
    		}else{
    			$this->gestionar_idiomas(2);
    		}
    		if(!rmdir(APPPATH."language/".$idioma->carpeta_idioma))
    			$this->gestionar_idiomas(2);
    			$datos = array('subido' => '0',
    					'activo' => '0');
    			$this->Idioma_model->modificar_idioma($idioma_aux, $datos);
    			redirect('admin/gestionar_idiomas/3');
    	}else{
    		$this->gestionar_idiomas(2);
    	}
    }
}
