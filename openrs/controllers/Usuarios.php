<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require_once APPPATH . 'core/MY_Controller.php';

class Usuarios extends MY_Controller
{

    function __construct()
    {        
        parent::__construct();       

        // Secure the access
        $this->_security();
    }

    // dashboard
    function dashboard($personal=1)
    {
        $this->load->model('Inmueble_model');
        // Inmuebles por estado
        $inmuebles_estados = $this->Inmueble_model->get_stats_by_estado($personal);
        $this->data['inmuebles_estados']=$inmuebles_estados;
        // Inmuebles por oferta
        $inmuebles_ofertas = $this->Inmueble_model->get_stats_by_oferta($personal);
        $this->data['inmuebles_ofertas']=$inmuebles_ofertas;
        // Inmuebles por tipo
        $inmuebles_tipos = $this->Inmueble_model->get_stats_by_tipo($personal);
        $this->data['inmuebles_tipos']=$inmuebles_tipos;
        // Tipo de estadística
        $this->data['personal']=$personal;
        $this->data['texto_titulo']= $personal ? 'Personales' : 'Generales';
        // Render
        $this->render_private('usuarios/dashboard', $this->data);
    }

    public function delete_user($id)
    {
        // Comprobación de acceso
        $this->utilities->check_security_access_perfiles_or(array("session_es_admin"));

        // Restricciones de existencia
        $this->data['element'] = $this->Usuario_model->get_by_id($id);
        // Existe usuario
        $this->Usuario_model->check_access($this->data['element']);
        
        // Restricciones del modelo
        if ($this->Usuario_model->check_delete($id))
        {
            if ($this->Usuario_model->delete_usuario($id))
            {
                $this->session->set_flashdata('message', 'El usuario ha sido borrado con éxito');
                $this->session->set_flashdata('message_color', 'success');
            }
            else
            {
                $this->session->set_flashdata('message', 'Error al borrar el usuario');
            }
        }
        else
        {
            $this->session->set_flashdata('message', $this->Usuario_model->get_error());
        }

        redirect(site_url('auth'), 'refresh');
    }
    
    public function cargar_idioma($id = 0) {
        // Deshabilitar profiler
        $this->output->enable_profiler(FALSE);
        // Permisos acceso
        if (!$this->ion_auth->is_admin() && !($this->ion_auth->user()->row()->id == $id))
        {
            echo "No tiene permiso para realizar esta acción";
        } 
        // Consultamos listado de idiomas
        $this->data['idiomas']=$this->Idioma_model->get_idiomas_subidos_activos();
        // Consultamos el idioma del usuario
        $usuario_idioma=$this->Idioma_model->get_usuario_idioma($id);
        // Asignamos a vista resto de datos
        $this->data['id_idioma']=$usuario_idioma->id_idioma;
        $this->data['usuario_id']=$id;
        // Cargamos la vista
        $this->load->view('usuarios/cambiar_idioma', $this->data);
    }
    
    public function cambiar_idioma() {
        // Deshabilitar profiler
        $this->output->enable_profiler(FALSE);
        // Comprobación de petición por AJAX
        if($this->input->is_ajax_request())
        {     
            // Id. usuario seleccionado
            $id=$this->input->post('id');
            // Permisos acceso
            if (!$this->ion_auth->is_admin() && !($this->ion_auth->user()->row()->id == $id))
            {
                echo "No tiene permiso para realizar esta acción";
            } 
            // Datos federado
            $check_cambiar_idioma = $this->Usuario_model->modificar_idioma_usuario($id, $this->input->post('id_idioma'));            
            // Actualización de datos        
            if($check_cambiar_idioma)
            {
                echo 1;
            }
            else
            {
                echo "Error al introducir los datos. Inténtelo más tarde";
            }
        }
    }

}
