<?php defined('BASEPATH') OR exit('No direct script access allowed');

require_once APPPATH . 'core/CRUD_controller.php';

class Demandas_ficheros extends CRUD_controller
{
    
    function __construct()
    {
        $this->_model = "Demanda_fichero_model";
        $this->_controller = "demandas_ficheros";
        $this->_view = "demandas/ficheros";
        
        parent::__construct();
        
        // Sección activa
        $this->data['_active_section']="demandas";
        
        // Secure the access
        $this->_security();
        
        // Comprobación de acceso
        $this->utilities->check_security_access_perfiles_or(array("session_es_agente"));
    }
    
    // index
    public function index($demanda_id)
    {        
        $this->data['demanda'] = $this->Demanda_model->get_by_id($demanda_id);
        // Permisos acceso
        $this->Demanda_model->check_access($this->data['demanda']);            
        
        // Elementos
        $this->data['elements'] = $this->{$this->_model}->get_ficheros_demanda($demanda_id);
        // Render
        $this->render_private($this->_view.'/index', $this->data);
    }
    
    // insert
    public function insert($demanda_id)
    {        
        $this->data['demanda'] = $this->Demanda_model->get_by_id($demanda_id);
        // Permisos acceso
        $this->Demanda_model->check_access($this->data['demanda']);
        
        $this->{$this->_model}->demanda_id=$demanda_id;
        
        // Validation
        if ($this->is_post())
        {
            // Check
            if ($this->{$this->_model}->validation())
            {
                // Insert
                $last_id=$this->{$this->_model}->create();
                // Check
                if ($last_id) {
                    $this->session->set_flashdata('message', lang('common_success_insert'));
                    $this->session->set_flashdata('message_color', 'success');
                    redirect($this->_controller."/index/".$demanda_id, 'refresh');
                } else {
                    $this->data['message'] = $this->{$this->_model}->get_error();
                }
            }
            else
            {
                $this->data['message'] = validation_errors();
            }
        }
        
        // Set datas
        $this->_set_datas_html();
        
        // Render
        $this->render_private($this->_view.'/insert', $this->data);
    }
    
    public function _set_datas_html($datos=NULL)
    {
        $this->data=array_merge_recursive($this->data,$this->{$this->_model}->set_datas_html($datos));
    }
    
    public function delete($id)
    {
        $this->data['element'] = $this->{$this->_model}->get_by_id($id);
        // Permisos acceso
        $this->{$this->_model}->check_access($this->data['element']);
        
        $this->data['demanda'] = $this->Demanda_model->get_by_id($this->data['element']->demanda_id);
        // Permisos acceso
        $this->Demanda_model->check_access($this->data['demanda']);
                
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

        redirect( $this->_controller."/index/".$this->data['element']->demanda_id, 'refresh');
    }

}
