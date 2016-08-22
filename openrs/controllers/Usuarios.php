<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require_once APPPATH . '/core/MY_Controller.php';

class Usuarios extends MY_Controller
{

    function __construct()
    {
        $this->s_model = "Usuarios_model";
        $this->m_model = "usuarios_model";
        $this->_controller = "usuarios";
        $this->_view = "admin";
        
        parent::__construct();       

        // Secure the access
        $this->_security();
    }

    // dashboard
    function dashboard()
    {
        // Render
        $this->render_private('admin/index', $this->data);
    }

    public function delete_user($id)
    {
        // Otros usuario no pueden borrar cuentas
        if (!$this->ion_auth->is_admin() && !($this->ion_auth->user()->row()->id == $id))
        {
            redirect('auth', 'refresh');
        }

        if ($this->_model->check_delete($id))
        {
            if ($this->_model->delete_all($id))
            {
                $this->session->set_flashdata('message', 'El usuario ha sido borrado con éxito');
                $this->session->set_flashdata('color_message', 'success');
            }
            else
            {
                $this->session->set_flashdata('message', 'Error al borrar el usuario');
                $this->session->set_flashdata('color_message', 'danger');
            }
        }
        else
        {
            $this->session->set_flashdata('message', 'El usuario seleccionado tiene datos asociados o es un usuario especial del sistema');
            $this->session->set_flashdata('color_message', 'danger');
        }

        redirect(site_url('auth'), 'refresh');
    }

    // test
    function test()
    {
        if ($this->is_post())
        {
            /*             * ************* RULES ************* */
            $rules_first_name = array(
                'required',
                array('test_names', array($this->Usuarios_model, 'test_names'))
            );
            $this->form_validation->set_rules('first_name', $this->lang->line('create_user_validation_fname_label'), $rules_first_name);
            $this->form_validation->set_rules('last_name', 'Apellidos', 'required');

            /*             * ************* DATAS ************* */
            /*
              $data = array(
              'first_name' => '',
              'last_name' => ''
              ); */
            $data = $this->input->post();
            $data['validation_datas_test_names'] = array('first_name' => $data['first_name'], 'last_name' => $data['last_name']);
            $this->form_validation->set_data($data);

            /*             * ************* CHECK ************* */
            if ($this->form_validation->run() == true)
            {
                $this->session->set_flashdata('message', 'NICEEEEEE¡¡');
                redirect("usuarios/test", 'refresh');
            }
            else
            {
                $this->data['message'] = validation_errors();
            }
        }

        $this->data['first_name'] = array(
            'name' => 'first_name',
            'id' => 'first_name',
            'type' => 'text',
            'value' => $this->form_validation->set_value('first_name'),
        );

        $this->data['last_name'] = array(
            'name' => 'last_name',
            'id' => 'last_name',
            'type' => 'text',
            'value' => $this->form_validation->set_value('last_name'),
        );

        // Render
        $this->render_private('admin/test', $this->data);
    }

    public function email()
    {
        $this->load->library('email');
        $config = Array(
            'protocol' => 'smtp',
            'smtp_host' => 'ssl://smtp.googlemail.com',
            'smtp_port' => 465,
            'smtp_user' => 'angel.berasuain@gmail.com',
            'smtp_pass' => 'BreakbeaT2',
            'mailtype' => 'html',
            'charset' => 'UTF-8'
        );
        $this->email->initialize($config);
        $this->email->set_newline("\r\n");


        //$message = $this->load->view($this->config->item('email_templates', 'ion_auth').$this->config->item('email_forgot_password', 'ion_auth'), $data, true);
        $message = "HOLA";
        $this->email->clear();
        $this->email->from('angel.berasuain@gmail.com', 'OPENRS');
        $this->email->to('angel.berasuain@gmail.com');
        $this->email->subject('Correo');
        $this->email->message($message);

        $this->email->send();
        echo $this->email->print_debugger();
    }
    
    public function cabecera(){
    	//Comprobamos permisos
    	if (!$this->ion_auth->is_admin() && !($this->ion_auth->user()->row()->id == $id)){
    		redirect('auth', 'refresh');
    	}
    	//Cargamos configuración cabecera
    	$this->data['config'] = $this->Usuarios_model->datos_config(1);
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
    				$config['upload_path'] = 'img/preferencias/1/';
    				$config['allowed_types']='gif|jpg|jpeg|png';
    				$config['max_size']	= '1000';
    				$config['overwrite']=TRUE;
    				//$config['encrypt_name'] = TRUE;
    	
    				$this->load->library('upload', $config);
    	
    				if (!$this->upload->do_upload()) {
    					$this->session->set_flashdata('color','danger');
    					$this->session->set_flashdata('error', 'La imagen no puede superar 1MB');
                		redirect('usuarios/cabecera', 'refresh');
    				}else {
    					//Para paneles independientes
    					//$configuracion = $this->user_model->datos_config($this->simple_sessions->get_value('id_usuario'));
    					//if($configuracion && isset($configuracion->imagen) && file_exists('img/preferencias/'.$this->simple_sessions->get_value('id_usuario').'/'.$configuracion->imagen)){
    					//unlink('img/preferencias/'.$this->simple_sessions->get_value('id_usuario').'/'.$configuracion->imagen);
    					//unlink('img/preferencias/'.$this->simple_sessions->get_value('id_usuario').'/'.$configuracion->imagen_thumb);
    					//}
    					$configuracion = $this->user_model->datos_config(1);
    					if($configuracion && isset($configuracion->imagen) && file_exists('img/preferencias/1/'.$configuracion->imagen)){
    						unlink('img/preferencias/1/'.$configuracion->imagen);
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
    					$config['source_image']='img/preferencias/1/'.$file_data['file_name'];
    					$config['new_image']='img/preferencias/1/';
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
    					$this->Usuarios_model->actualizar_configuracion(1, $preferencias);
    					$this->session->set_flashdata('color','success');
    					$this->session->set_flashdata('mensaje','Cambios realizados correctamente.');
    					redirect('usuarios/caecera','refresh');
    				}
    			}else{
    				$this->session->set_flashdata('color','danger');
    				$this->session->set_flashdata('mensaje', validation_errors());
                	redirect('usuarios/cabecera', 'refresh');
    			}
    		}else{
    			//Para paneles independientes
    			//$this->user_model->actualizar_configuracion($this->simple_sessions->get_value('id_usuario'), $preferencias);
    			$this->user_model->actualizar_configuracion(1, $preferencias);
    			redirect('usuarios/cabecera','refresh');
    		}
    	}else{
    		$this->session->set_flashdata('color','danger');
    		$this->session->set_flashdata('mensaje', validation_errors());
            redirect('usuarios/cabecera', 'refresh');
    	}
    }
    
    public function pie(){
    	//Comprobamos permisos
    	if (!$this->ion_auth->is_admin() && !($this->ion_auth->user()->row()->id == $id)){
    		redirect('auth', 'refresh');
    	}
    	//Cargamos configuración cabecera
    	$this->data['config'] = $this->Usuarios_model->datos_config(1);
    	$data['opc_footer'] = $this->user_model->get_footer_opciones();
    	for($i=1;$i<5;$i++){//sacamos las opciones segun columna
    		//Para panales independientes
    		//$opc_cliente = $this->user_model->get_footer_cliente($this->simple_sessions->get_value('id_usuario'), $i);
    		$opc_cliente = $this->user_model->get_footer_cliente(1, $i);
    		if($opc_cliente != NULL)
    			$data['opc_col'.$i]=$opc_cliente;
    	}
    	// Render
    	$this->data['color'] = $this->session->flashdata('color');
    	$this->data['mensaje'] = $this->session->flashdata('mensaje');
    	$this->render_private('admin/pie', $this->data);
    }
    
    function modificarPie(){
    	$this->comprobar_sesion();
    
    	if($this->user_model->get_user($this->simple_sessions->get_value('id_usuario'))){
    		//Comprobación borrado de columna
    		if($this->input->post('col') == 'vacio'){
    			//Para paneles independientes
    			//$cliente_opc = $this->user_model->get_footer_cliente($this->simple_sessions->get_value('id_usuario'), $this->input->post('columna'));
    			//$this->user_model->borrar_texto_columna($cliente_opc->id);
    			//$this->user_model->borrar_columna_pie($this->simple_sessions->get_value('id_usuario'), $this->input->post('columna'));
    			$cliente_opc = $this->user_model->get_footer_cliente(1, $this->input->post('columna'));
    			$this->user_model->borrar_texto_columna($cliente_opc->id);
    			$this->user_model->borrar_columna_pie(1, $this->input->post('columna'));
    		}
    			
    		//Comprobación opción articulos
    		if($this->input->post('num_art')){
    			//Para paneles independientes
    			//$this->user_model->actualizar_pie_cliente($this->simple_sessions->get_value('id_usuario'), $this->input->post('columna'), $this->input->post('col'), $this->input->post('num_art'));
    			$this->user_model->actualizar_pie_cliente(1, $this->input->post('columna'), $this->input->post('col'), $this->input->post('num_art'));
    		}else{
    			//Para paneles independientes
    			//$this->user_model->actualizar_pie_cliente($this->simple_sessions->get_value('id_usuario'), $this->input->post('columna'), $this->input->post('col'));
    			$this->user_model->actualizar_pie_cliente(1, $this->input->post('columna'), $this->input->post('col'));
    		}
    		//Comprobación opción redes sociales
    		if($this->input->post('facebook')){
    			$datos_profile = array('facebook' => $this->input->post('facebook'));
    			//Para paneles independientes
    			//$this->user_model->actualizar_red_social($this->simple_sessions->get_value('id_usuario'), $datos_profile);
    			$this->user_model->actualizar_red_social(1, $datos_profile);
    		}
    		if($this->input->post('twitter')){
    			$datos_profile = array('twitter' => $this->input->post('twitter'));
    			//Para paneles independientes
    			//$this->user_model->actualizar_red_social($this->simple_sessions->get_value('id_usuario'), $datos_profile);
    			$this->user_model->actualizar_red_social(1, $datos_profile);
    		}
    		if($this->input->post('google')){
    			$datos_profile = array('google' => $this->input->post('google'));
    			//Para paneles independientes
    			//$this->user_model->actualizar_red_social($this->simple_sessions->get_value('id_usuario'), $datos_profile);
    			$this->user_model->actualizar_red_social(1, $datos_profile);
    		}
    		if($this->input->post('vimeo')){
    			$datos_profile = array('vimeo' => $this->input->post('vimeo'));
    			//Para paneles independientes
    			//$this->user_model->actualizar_red_social($this->simple_sessions->get_value('id_usuario'), $datos_profile);
    			$this->user_model->actualizar_red_social(1, $datos_profile);
    		}
    			
    		//Comprobación Inserción de texto
    		if($this->input->post('idioma')){
    			//Para paneles independientes
    			//$opc_cliente = $this->user_model->get_footer_cliente($this->simple_sessions->get_value('id_usuario'), $this->input->post('columna'));
    			$opc_cliente = $this->user_model->get_footer_cliente(1, $this->input->post('columna'));
    			$this->user_model->actualizar_texto($opc_cliente->id, $this->input->post('contenido'),$this->input->post('idioma'));
    		}
    		//Comprobación Edición de texto
    		if($this->input->post('idiomas')){
    			//Para paneles independientes
    			//$opc_cliente = $this->user_model->get_footer_cliente($this->simple_sessions->get_value('id_usuario'), $this->input->post('columna'));
    			$opc_cliente = $this->user_model->get_footer_cliente(1, $this->input->post('columna'));
    			$idiomas = $this->input->post('idiomas');
    			foreach($idiomas as $idioma){
    				$col=$this->input->post('columna');
    				if($col == 1)
    					$this->user_model->actualizar_texto($opc_cliente->id, $this->input->post('contenido_'.$idioma),$idioma);
    				elseif($col == 2)
    				$this->user_model->actualizar_texto($opc_cliente->id, $this->input->post('contenido2_'.$idioma),$idioma);
    				elseif($col == 3)
    				$this->user_model->actualizar_texto($opc_cliente->id, $this->input->post('contenido3_'.$idioma),$idioma);
    				elseif($col == 4)
    				$this->user_model->actualizar_texto($opc_cliente->id, $this->input->post('contenido4_'.$idioma),$idioma);
    			}
    		}
    		redirect('admin-mi-cuenta/4/13','refresh');
    	}else{
    		$this->mi_cuenta(4,3);
    	}
    }
    
    function limpiar_red($red){
    	//Para paneles independientes
    	//$this->user_model->limpiar_red_social($this->simple_sessions->get_value('id_usuario'), $red);
    	$this->user_model->limpiar_red_social(1, $red);
    	redirect('admin-mi-cuenta/4/13','refresh');
    }

}
