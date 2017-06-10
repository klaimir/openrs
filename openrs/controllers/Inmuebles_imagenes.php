<?php defined('BASEPATH') OR exit('No direct script access allowed');

require_once APPPATH . 'core/CRUD_controller.php';

class Inmuebles_imagenes extends CRUD_controller
{
    
    function __construct()
    {
        $this->_model = "Inmueble_imagen_model";
        $this->_controller = "inmuebles_imagenes";
        $this->_view = "inmuebles/imagenes";
        
        parent::__construct();
        
        // Sección activa
        $this->data['_active_section']="inmuebles";
        
        // Secure the access
        $this->_security();
        
        // Comprobación de acceso
        $this->utilities->check_security_access_perfiles_or(array("session_es_agente"));
        
        // Carga del modelo
        $this->load->model('Inmueble_model');
    }
    
    // index
    public function index($inmueble_id)
    {        
        $this->data['inmueble'] = $this->Inmueble_model->get_by_id($inmueble_id);
        // Permisos acceso
        $this->Inmueble_model->check_access($this->data['inmueble']);
        // Elementos
        $this->data['elements'] = $this->{$this->_model}->where('inmueble_id',$inmueble_id)->get_all();
        // Render
        $this->render_private($this->_view.'/index', $this->data);
    }
    
    // upload
    public function upload($inmueble_id)
    {       
        // Deshabilitar profiler
        $this->output->enable_profiler(FALSE);
        // Comprobación de petición por AJAX
        if(!$this->input->is_ajax_request())
        {
            echo 'Petición no realizada a través de AJAX';
            return;
        }
        
        $this->{$this->_model}->inmueble_id=$inmueble_id;
        
        // Insert
        $last_id=$this->{$this->_model}->create();
        // Check
        if ($last_id) {
            return TRUE;
        } else {
            // Establecemos mensaje de error
            $output['error'] = $this->{$this->_model}->get_error();
            http_response_code (401);
            //set Content-Type to JSON
            header( 'Content-Type: application/json; charset=utf-8' );
            //echo error message as JSON
            echo json_encode( $output );
        }
    }
    
    // insert
    public function insert($inmueble_id)
    {        
        $this->data['inmueble'] = $this->Inmueble_model->get_by_id($inmueble_id);
        // Permisos acceso
        $this->Inmueble_model->check_access($this->data['inmueble']);
        
        // Render
        $this->render_private($this->_view.'/insert', $this->data);
    }
    
    public function publicar($id,$publicar)
    {
        $this->data['element'] = $this->{$this->_model}->get_by_id($id);
        // Permisos acceso
        $this->{$this->_model}->check_access($this->data['element']);
        
        $this->data['inmueble'] = $this->Inmueble_model->get_by_id($this->data['element']->inmueble_id);
        // Permisos acceso
        $this->Inmueble_model->check_access($this->data['inmueble']);
        
        $error=FALSE;
        // Check de acciones
        if($publicar && $this->data['element']->publicada)
        {
            $this->session->set_flashdata('message', 'La imagen seleccionada ya estaba publicada');
            $error=TRUE;
        }
        
        if(!$publicar && !$this->data['element']->publicada)
        {
            $this->session->set_flashdata('message', 'La imagen seleccionada no estaba publicada');
            $error=TRUE;
        }
           
        // Publicar
        if(!$error)
        {
            if($this->{$this->_model}->publicar($id,$publicar))
            {
                if($publicar)
                {
                    $this->session->set_flashdata('message', 'La imagen seleccionada ha sido publicada');
                }
                else
                {
                    $this->session->set_flashdata('message', 'La imagen seleccionada ha dejado de estar publicada');
                }                
                $this->session->set_flashdata('message_color', 'success');
            }
        }
        
        // Redirect
        redirect( $this->_controller."/index/".$this->data['element']->inmueble_id, 'refresh');
    }
    
    public function download($id)
    {
        $this->data['element'] = $this->{$this->_model}->get_by_id($id);
        // Permisos acceso
        $this->{$this->_model}->check_access($this->data['element']);
        
        $this->data['inmueble'] = $this->Inmueble_model->get_by_id($this->data['element']->inmueble_id);
        // Permisos acceso
        $this->Inmueble_model->check_access($this->data['inmueble']);
                
        $this->load->helper('download');
                
        force_download(FCPATH.$this->data['element']->imagen,NULL);
    }
    
    public function delete($id)
    {
        $this->data['element'] = $this->{$this->_model}->get_by_id($id);
        // Permisos acceso
        $this->{$this->_model}->check_access($this->data['element']);
        
        $this->data['inmueble'] = $this->Inmueble_model->get_by_id($this->data['element']->inmueble_id);
        // Permisos acceso
        $this->Inmueble_model->check_access($this->data['inmueble']);
                
        if ($this->{$this->_model}->check_delete($id))
        {
            if ($this->{$this->_model}->remove($this->data['element']))
            {
                $this->session->set_flashdata('message', lang('common_success_delete'));
                $this->session->set_flashdata('message_color', 'success');
            }
            else
            {
                $this->session->set_flashdata('message', $this->{$this->_model}->get_error());
            }
        }
        else
        {
            $this->session->set_flashdata('message', lang('common_error_elemento_asociado_delete'));
        }

        redirect( $this->_controller."/index/".$this->data['element']->inmueble_id, 'refresh');
    }

}
