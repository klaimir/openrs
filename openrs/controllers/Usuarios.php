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
    function dashboard($option='default')
    {
        if($option=='default')
        {
            if ($this->data['session_es_agente'])
            {
                $personal=1;
            }
            else
            {
                $personal=0;
            }
        }
        else
        {
            $personal=intval($option);
        }
        
        // Bloque de estadísticas para agentes
        if($personal==1 || $personal==0)
        {
            if(!$this->data['session_es_agente'] && $this->data['session_es_admin'] && $personal==1)
            {
                show_error("No tiene permiso para consultar estadísticas personales");
                return;
            }
        }
        else
        {
            show_error("Error en los parámetros de la página");
            return;
        }
        
        // Si es ambos perfiles se debe poder elegir
        if($this->data['session_es_agente'])
        {
            $this->data['show_options']=TRUE;
        }
        else
        {
            $this->data['show_options']=FALSE;
        }
        // Debe poder ver los listados
        if($this->data['session_es_agente'])
        {
            $this->data['show_lists']=TRUE;
        }
        else
        {
            $this->data['show_lists']=FALSE;
        }        
        // Sección activa
        $this->data['_active_section'] = 'inicio';
        
        // INMUEBLES
        $this->load->model('Inmueble_model');
        // Inmuebles por estado
        $this->data['inmuebles_estados'] = $this->Inmueble_model->get_stats_by_estado($personal);
        // Inmuebles por oferta
        $this->data['inmuebles_ofertas'] = $this->Inmueble_model->get_stats_by_oferta($personal);
        // Inmuebles por tipo
        $this->data['inmuebles_tipos'] = $this->Inmueble_model->get_stats_by_tipo($personal);
        // Evolución de inmuebles registrados
        $this->data['anio_actual']=date("Y");
        $this->data['inmuebles_altas'] = $this->Inmueble_model->get_stats_plot_by_alta($this->data['anio_actual'],$personal);
        $this->data['dropdown_anios']=$this->Inmueble_model->get_dropdown_anios_stats($personal); 
        // Inmuebles por publicación
        $this->data['inmuebles_publicacion'] = $this->Inmueble_model->get_stats_by_publicacion($personal);
        // Inmuebles por cartel
        $this->data['inmuebles_cartel']=$this->Inmueble_model->get_stats_by_cartel($personal);
        // Últimos Inmuebles registrados
        $this->data['ultimos_registrados']=$this->Inmueble_model->get_ultimos_inmuebles_registrados($personal);
        // Últimos Inmuebles modificados
        $this->data['ultimos_modificados']=$this->Inmueble_model->get_ultimos_inmuebles_modificados($personal);
        // Últimos Inmuebles pendientes de evaluar
        $this->data['pendientes_evaluar']=$this->Inmueble_model->get_inmuebles_demandas($personal,1);
        // Últimos Inmuebles propuestos para visita
        $this->data['propuestos_visita']=$this->Inmueble_model->get_inmuebles_demandas($personal,2);        
        // Inmuebles por agente
        if(!$personal)
        {
            $inmuebles_agentes = $this->Inmueble_model->get_stats_by_agente();
            $this->data['inmuebles_agentes']=$inmuebles_agentes;
        }
        else
        {
            $this->data['inmuebles_agentes']=array();
        }
        // CLIENTES
        $this->load->model('Cliente_model');
        // Clientes por estado
        $this->data['clientes_estados'] = $this->Cliente_model->get_stats_by_estado($personal);
        // Evolución de clientes registrados
        $this->data['clientes_altas'] = $this->Cliente_model->get_stats_plot_by_alta($this->data['anio_actual'],$personal);
        $this->data['dropdown_anios_clientes']=$this->Cliente_model->get_dropdown_anios_stats($personal);
        // Clientes por medio_captacion
        $this->data['clientes_medios_captacion'] = $this->Cliente_model->get_stats_by_medio_captacion($personal);
        // Clientes por interes
        $this->data['clientes_intereses'] = $this->Cliente_model->get_stats_by_interes($personal);
        // Últimos Clientes registrados
        $this->data['ultimos_clientes_registrados']=$this->Cliente_model->get_ultimos_clientes_registrados($personal);
        // Últimos Clientes modificados
        $this->data['ultimos_clientes_modificados']=$this->Cliente_model->get_ultimos_clientes_modificados($personal);  
        // Clientes por agente
        if(!$personal)
        {
            $clientes_agentes = $this->Cliente_model->get_stats_by_agente();
            $this->data['clientes_agentes']=$clientes_agentes;
        }
        else
        {
            $this->data['clientes_agentes']=array();
        }
        // DEMANDAS
        $this->load->model('Demanda_model');
        // Demandas por estado
        $this->data['demandas_estados'] = $this->Demanda_model->get_stats_by_estado($personal);
        // Evolución de demandas registrados
        $this->data['demandas_altas'] = $this->Demanda_model->get_stats_plot_by_alta($this->data['anio_actual'],$personal);
        $this->data['dropdown_anios_demandas']=$this->Demanda_model->get_dropdown_anios_stats($personal);
        // Demandas por oferta
        $this->data['demandas_ofertas'] = $this->Demanda_model->get_stats_by_oferta($personal);
        // Demandas por tipo_demanda
        $this->data['demandas_tipos_demandas'] = $this->Demanda_model->get_stats_by_tipo_demanda($personal);
        // Demandas por tipo_inmueble
        $this->data['demandas_tipos_inmuebles'] = $this->Demanda_model->get_stats_by_tipo_inmueble($personal);
        // Demandas por evaluacion
        $this->data['demandas_evaluacion_inmuebles'] = $this->Demanda_model->get_stats_by_evaluacion_inmueble($personal);
        // Últimos Demandas registrados
        $this->data['ultimos_demandas_registrados']=$this->Demanda_model->get_ultimos_demandas_registrados($personal);
        // Últimos Demandas modificados
        $this->data['ultimos_demandas_modificados']=$this->Demanda_model->get_ultimos_demandas_modificados($personal);
        // Demandas con Inmuebles pendientes de evaluar
        $this->data['demandas_pendientes_evaluar']=$this->Demanda_model->get_view_demandas_estado_inmueble($personal,1);
        // Demandas con Inmuebles propuestos para visita
        $this->data['demandas_propuestos_visita']=$this->Demanda_model->get_view_demandas_estado_inmueble($personal,2);
        // Demandas por agente
        if(!$personal)
        {
            $demandas_agentes = $this->Demanda_model->get_stats_by_agente();
            $this->data['demandas_agentes']=$demandas_agentes;
        }
        else
        {
            $this->data['demandas_agentes']=array();
        }
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
