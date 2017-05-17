<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require_once APPPATH . '/core/MY_Controller.php';

class Usuarios extends MY_Controller
{

    function __construct()
    {        
        parent::__construct();       

        // Secure the access
        $this->_security();
    }

    // dashboard
    function dashboard()
    {
        // Render
        $this->render_private('dashboard', $this->data);
    }

    public function delete_user($id)
    {
        // Otros usuario no pueden borrar cuentas
        if (!$this->ion_auth->is_admin() && !($this->ion_auth->user()->row()->id == $id))
        {
            redirect('auth', 'refresh');
        }

        // Restricciones de existencia
        $this->data['element'] = $this->Usuario_model->get_by_id($id);
        // Existe usuario
        if ($this->Usuario_model->check_access($this->data['element']))
        {
            // Restricciones del modelo
            if ($this->Usuario_model->check_delete($id))
            {
                if ($this->Usuario_model->delete_usuario($id))
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
        }
        else
        {
            $this->session->set_flashdata('message', 'Error usuario seleccionado no existe');
            $this->session->set_flashdata('color_message', 'danger');
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
