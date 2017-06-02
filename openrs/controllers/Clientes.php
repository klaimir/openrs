<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require_once APPPATH . 'core/CRUD_controller.php';

class Clientes extends CRUD_controller
{

    function __construct()
    {
        $this->_model = "Cliente_model";
        $this->_controller = "clientes";
        $this->_view = "clientes";

        parent::__construct();

        // Secure the access
        $this->_security();

        // Comprobación de acceso
        $this->utilities->check_security_access_perfiles_or(array("session_es_agente"));
    }

    private function _load_filtros()
    {
        // Selector de provincias
        $this->data['provincias'] = $this->Cliente_model->get_provincias_buscador();

        // Selector de paises
        $this->data['paises'] = $this->Cliente_model->get_paises_buscador();

        // Selector de agentes
        $this->data['agentes'] = $this->Cliente_model->get_agentes_buscador();

        // selector de intereses
        $this->data['intereses'] = $this->Cliente_model->get_intereses_buscador();
    }

    private function _load_filtros_session()
    {
        // Filtro provincia_id
        $this->utilities->set_value_session_filter('clientes_buscador', 'provincia_id');

        // Filtro poblacion_id
        $this->utilities->set_value_session_filter('clientes_buscador', 'poblacion_id');

        // Filtro pais_id
        $this->utilities->set_value_session_filter('clientes_buscador', 'pais_id');

        // Filtro agente_asignado_id
        $this->utilities->set_value_session_filter('clientes_buscador', 'agente_asignado_id');

        // Filtro interes_id
        $this->utilities->set_value_session_filter('clientes_buscador', 'interes_id');

        // Filtro fecha_desde
        $this->utilities->set_value_session_filter('clientes_buscador', 'fecha_desde');

        // Filtro fecha_hasta
        $this->utilities->set_value_session_filter('clientes_buscador', 'fecha_hasta');
    }

    private function _generar_filtros_busqueda()
    {
        $filtros = array();

        $filtros['pais_id'] = $this->session->userdata('clientes_buscador_pais_id');
        $filtros['provincia_id'] = $this->session->userdata('clientes_buscador_provincia_id');
        $filtros['poblacion_id'] = $this->session->userdata('clientes_buscador_poblacion_id');
        $filtros['agente_asignado_id'] = $this->session->userdata('clientes_buscador_agente_asignado_id');
        $filtros['interes_id'] = $this->session->userdata('clientes_buscador_interes_id');

        // Búsqueda por rango de fechas
        $filtros['fecha_desde'] = $this->session->userdata('clientes_buscador_fecha_desde');
        $filtros['fecha_hasta'] = $this->session->userdata('clientes_buscador_fecha_hasta');

        return $filtros;
    }

    // index
    public function index()
    {
        // Valores filtros de sesión
        $this->_load_filtros_session();
        // Valores de los filtros de búsqueda
        $this->data['filtros'] = $this->_generar_filtros_busqueda();
        // Filtros del buscador
        $this->_load_filtros();
        // Búsqueda
        $this->data['elements'] = $this->{$this->_model}->get_by_filtros($this->data['filtros']);
        // Render
        $this->render_private($this->_view . '/index', $this->data);
    }

    // insert
    public function insert()
    {
        // Validation
        if ($this->is_post())
        {
            // Inicializamos los datos de validación para reutilizar la validación del cliente
            $this->form_validation->set_data($this->input->post()); 
            // Check
            if ($this->{$this->_model}->validation())
            {
                // Formatted datas
                $formatted_datas=$this->{$this->_model}->get_formatted_datas();                
                // Insert
                $last_id=$this->{$this->_model}->create($formatted_datas);
                // Check
                if ($last_id) {
                    $this->session->set_flashdata('message', lang('common_success_insert'));
                    $this->session->set_flashdata('message_color', 'success');
                    redirect($this->_controller, 'refresh');
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
        $this->render_private($this->_view . '/insert', $this->data);
    }

    public function edit($id)
    {
        $this->data['element'] = $this->{$this->_model}->get_info($id);
        // Permisos acceso
        $this->{$this->_model}->check_access($this->data['element']);

        // Validation
        if ($this->is_post())
        {
            // Inicializamos los datos de validación para reutilizar la validación del cliente
            $this->form_validation->set_data($this->input->post()); 
            // Check
            if ($this->{$this->_model}->validation($id))
            {
                // Edit
                $updated_rows = $this->{$this->_model}->edit($id);
                // Check
                if ($updated_rows)
                {
                    $this->session->set_flashdata('message', lang('common_success_edit'));
                    $this->session->set_flashdata('message_color', 'success');
                }
                else
                {
                    $this->session->set_flashdata('message', lang('common_error_edit'));
                }
                redirect($this->_controller, 'refresh');
            }
            else
            {
                $this->data['message'] = validation_errors();
            }
        }

        // Set datas
        $this->_set_datas_html($this->data['element']);

        // Render
        $this->render_private($this->_view . '/edit', $this->data);
    }

    public function _set_datas_html($datos = NULL)
    {
        $this->data = array_merge_recursive($this->data, $this->{$this->_model}->set_datas_html($datos));

        //$this->load->library('ckeditor', array('instanceName' => 'CKEDITOR1','basePath' => base_url()."assets/admin/ckeditor/", 'outPut' => true));
    }

    public function delete($id)
    {
        $this->data['element'] = $this->{$this->_model}->get_by_id($id);
        // Permisos acceso
        $this->{$this->_model}->check_access($this->data['element']);

        if ($this->{$this->_model}->check_delete($id))
        {
            if ($this->{$this->_model}->remove($id))
            {
                $this->session->set_flashdata('message', lang('common_success_delete'));
                $this->session->set_flashdata('message_color', 'success');
            }
            else
            {
                $this->session->set_flashdata('message', lang('common_error_delete'));
            }
        }
        else
        {
            $this->session->set_flashdata('message', lang('common_error_elemento_asociado_delete'));
        }

        redirect($this->_controller, 'refresh');
    }

    public function duplicar($id)
    {
        $this->data['element'] = $this->{$this->_model}->get_by_id($id);
        // Permisos acceso
        $this->{$this->_model}->check_access($this->data['element']);

        $cliente_id = $this->{$this->_model}->duplicar($this->data['element']);

        if ($cliente_id)
        {
            $this->session->set_flashdata('message', lang('common_success_duplicate'));
            $this->session->set_flashdata('message_color', 'success');
        }
        else
        {
            $this->session->set_flashdata('message', lang('common_error_duplicate'));
        }

        redirect($this->_controller . '/edit/' . $cliente_id, 'refresh');
    }

    public function import()
    {
        // Validation
        if ($this->is_post())
        {
            // Realizamos subida
            $import=$this->{$this->_model}->import_csv();
            // Check
            if ($import)
            {
                // Si todo fue bien mostraremos un resumen con los registros correctos y los incorrectos
                $this->data['elements'] = $import;               
                // Render del resultado
                $this->render_private($this->_view . '/import_validation', $this->data);
                return;
            }
            else
            {
                $this->data['message'] = $this->{$this->_model}->get_error();
            }
        }
        // Render
        $this->render_private($this->_view . '/import', $this->data);
    }
    
    public function do_import()
    {
        $import=$this->{$this->_model}->do_import_csv();
        if ($import)
        {
            // Si todo fue bien mostraremos un resumen con los registros correctos y los incorrectos
            $this->data['elements'] = $import;
            // Mensaje éxito
            $this->data['message_color'] = "success";
            $this->data['message'] = "Importación realizada con éxito";
        }
        else
        {
            $this->data['message'] = $this->{$this->_model}->get_error();
        }
        // Render
        $this->render_private($this->_view . '/import_result', $this->data);
    }
   
}
