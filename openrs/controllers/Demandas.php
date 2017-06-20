<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require_once APPPATH . 'core/CRUD_controller.php';

class Demandas extends CRUD_controller
{

    function __construct()
    {
        $this->_model = "Demanda_model";
        $this->_controller = "demandas";
        $this->_view = "demandas";

        parent::__construct();

        // Secure the access
        $this->_security();

        // Comprobación de acceso
        $this->utilities->check_security_access_perfiles_or(array("session_es_agente"));
                
        // Fichero de lenguaje
        $this->lang->load('inmuebles');
    }
    
    function multiple_google_map()
    {
        // Deshabilitar profiler
        $this->output->enable_profiler(FALSE);
        // Comprobación de petición por AJAX
        if(!$this->input->is_ajax_request())
        {
            echo 'Petición no realizada a través de AJAX';
            return;
        }        
        // Valores de los filtros de búsqueda
        $filtros = $this->_generar_filtros_busqueda();
        // Búsqueda                
        $inmuebles=$this->{$this->_model}->get_by_filtros($filtros); 
        
        // Check
        if($inmuebles)
        {
            // Código de inmuebles
        }
        else
        {
            echo "No hay inmuebles para mostrar en el mapa de Google";
        }
    }

    private function _load_filtros()
    {
        // Modelos auxiliares
        $this->load->model('Inmueble_model');
        $this->load->model('Cliente_model');
        
        // Selector de provincias
        $this->data['provincias'] = $this->Provincia_model->get_provincias_dropdown(-1);

        // Selector de tipos_inmuebles
        $this->data['tipos_inmuebles'] = $this->Tipo_inmueble_model->get_tipos_inmuebles_dropdown(-1);
        
        // Selector de tipos_certificacion_energetica
        $this->data['tipos_certificacion_energetica'] = $this->Certificacion_energetica_model->get_tipos_certificacion_energetica_dropdown(-1);
        
        // Selector de estados
        $this->data['estados'] = $this->Estado_model->get_estados_dropdown(3,-1);

        // Selector de agentes
        $this->data['agentes'] = $this->Usuario_model->get_agentes_dropdown(-1);

        // selector de ofertas
        $this->data['ofertas'] = $this->Inmueble_model->get_ofertas_dropdown(-1);
        
        // Selector de clientes
        $this->data['clientes'] = $this->Cliente_model->get_clientes_dropdown(-1);
    }

    private function _load_filtros_session()
    {
        // Filtro certificacion_energetica_id
        $this->utilities->set_value_session_filter('demandas_buscador', 'certificacion_energetica_id');
        
        // Filtro provincia_id
        $this->utilities->set_value_session_filter('demandas_buscador', 'provincia_id');

        // Filtro poblacion_id
        $this->utilities->set_value_session_filter('demandas_buscador', 'poblacion_id');
        
        // Filtro zona_id
        $this->utilities->set_value_session_filter('demandas_buscador', 'zona_id');

        // Filtro tipo_id
        $this->utilities->set_value_session_filter('demandas_buscador', 'tipo_id');
        
        // Filtro estado_id
        $this->utilities->set_value_session_filter('demandas_buscador', 'estado_id');

        // Filtro agente_asignado_id
        $this->utilities->set_value_session_filter('demandas_buscador', 'agente_asignado_id');
        
         // Filtro cliente_id
        $this->utilities->set_value_session_filter('demandas_buscador', 'cliente_id');
        
        // Filtro oferta_id
        $this->utilities->set_value_session_filter('demandas_buscador', 'oferta_id');
     
        // Filtro fecha_desde
        $this->utilities->set_value_session_filter('demandas_buscador', 'fecha_desde');

        // Filtro fecha_hasta
        $this->utilities->set_value_session_filter('demandas_buscador', 'fecha_hasta');
        
        // Filtro banios_desde
        $this->utilities->set_value_session_filter('demandas_buscador', 'banios_desde');
        
        // Filtro banios_hasta
        $this->utilities->set_value_session_filter('demandas_buscador', 'banios_hasta');
        
        // Filtro habitaciones_desde
        $this->utilities->set_value_session_filter('demandas_buscador', 'habitaciones_desde');
        
        // Filtro habitaciones_hasta
        $this->utilities->set_value_session_filter('demandas_buscador', 'habitaciones_hasta');
        
        // Filtro metros_desde
        $this->utilities->set_value_session_filter('demandas_buscador', 'metros_desde');
        
        // Filtro metros_hasta
        $this->utilities->set_value_session_filter('demandas_buscador', 'metros_hasta');
        
        // Filtro precios_desde
        $this->utilities->set_value_session_filter('demandas_buscador', 'precios_desde');
        
        // Filtro precios_hasta
        $this->utilities->set_value_session_filter('demandas_buscador', 'precios_hasta');
    }

    private function _generar_filtros_busqueda()
    {
        $filtros = array();

        $filtros['tipo_id'] = $this->session->userdata('demandas_buscador_tipo_id');
        $filtros['certificacion_energetica_id'] = $this->session->userdata('demandas_buscador_certificacion_energetica_id');
        $filtros['estado_id'] = $this->session->userdata('demandas_buscador_estado_id');
        $filtros['provincia_id'] = $this->session->userdata('demandas_buscador_provincia_id');
        $filtros['poblacion_id'] = $this->session->userdata('demandas_buscador_poblacion_id');
        $filtros['zona_id'] = $this->session->userdata('demandas_buscador_zona_id');
        $filtros['agente_asignado_id'] = $this->session->userdata('demandas_buscador_agente_asignado_id');
        $filtros['cliente_id'] = $this->session->userdata('demandas_buscador_cliente_id');
        $filtros['oferta_id'] = $this->session->userdata('demandas_buscador_oferta_id');

        // Búsqueda por rangos de búsqueda
        $filtros['fecha_desde'] = $this->session->userdata('demandas_buscador_fecha_desde');
        $filtros['fecha_hasta'] = $this->session->userdata('demandas_buscador_fecha_hasta');
        $filtros['banios_desde'] = $this->session->userdata('demandas_buscador_banios_desde');
        $filtros['banios_hasta'] = $this->session->userdata('demandas_buscador_banios_hasta');
        $filtros['habitaciones_desde'] = $this->session->userdata('demandas_buscador_habitaciones_desde');
        $filtros['habitaciones_hasta'] = $this->session->userdata('demandas_buscador_habitaciones_hasta');
        $filtros['metros_desde'] = $this->session->userdata('demandas_buscador_metros_desde');
        $filtros['metros_hasta'] = $this->session->userdata('demandas_buscador_metros_hasta');
        // Precios es especial por el tipo de consulta que se hace   
        $filtros['precios_desde'] = $this->utilities->get_sql_value_string($this->utilities->formatear_numero($this->session->userdata('demandas_buscador_precios_desde')), "int");
        $filtros['precios_hasta'] = $this->utilities->get_sql_value_string($this->utilities->formatear_numero($this->session->userdata('demandas_buscador_precios_hasta')), "int");

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
            // Inicializamos los datos de validación para reutilizar la validación del demanda
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
                    redirect($this->_controller.'/edit/'.$last_id, 'refresh');
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
            // Inicializamos los datos de validación para reutilizar la validación del demanda
            $this->form_validation->set_data($this->input->post()); 
            // Check
            if ($this->{$this->_model}->validation($id))
            {
                // Edit
                $updated_rows = $this->{$this->_model}->edit($id);
                // Check
                if ($updated_rows>=0)
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
                $this->data['message'] = $this->{$this->_model}->get_error();
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

        $this->load->library('ckeditor', array('instanceName' => 'CKEDITOR1','basePath' => base_url()."assets/admin/ckeditor/", 'outPut' => true));
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

        $demanda_id = $this->{$this->_model}->duplicar($this->data['element']);

        if ($demanda_id)
        {
            $this->session->set_flashdata('message', lang('common_success_duplicate'));
            $this->session->set_flashdata('message_color', 'success');
        }
        else
        {
            $this->session->set_flashdata('message', $this->{$this->_model}->get_error());
        }

        redirect($this->_controller . '/edit/' . $demanda_id, 'refresh');
    }
    
    public function marcar_opcion_extra($demanda_id,$opcion_extra_id,$marcar) {
        // Deshabilitar profiler
        $this->output->enable_profiler(FALSE);
        // Comprobación de petición por AJAX
        if($this->input->is_ajax_request())
        {
            // Datos federado
            $check_marcar = $this->Demanda_model->marcar_opcion_extra($demanda_id,$opcion_extra_id,$marcar);            
            // Actualización de datos        
            if($check_marcar)
            {
                echo 1;
            }
            else
            {
                if($marcar)
                {
                    echo "Error al marcar la opción extra. Inténtelo más tarde";
                }
                else
                {
                    echo "Error al desmarcar la opción extra. Inténtelo más tarde";
                }
            }
        }
    }
    
    public function marcar_lugar_interes($demanda_id,$lugar_interes_id,$marcar) {
        // Deshabilitar profiler
        $this->output->enable_profiler(FALSE);
        // Comprobación de petición por AJAX
        if($this->input->is_ajax_request())
        {
            // Datos federado
            $check_marcar = $this->Demanda_model->marcar_lugar_interes($demanda_id,$lugar_interes_id,$marcar);            
            // Actualización de datos        
            if($check_marcar)
            {
                echo 1;
            }
            else
            {
                if($marcar)
                {
                    echo "Error al marcar el lugar de interés. Inténtelo más tarde";
                }
                else
                {
                    echo "Error al desmarcar el lugar de interés. Inténtelo más tarde";
                }
            }
        }
    }    
    
    public function asociar_inmuebles($demanda_id)
    {
        $this->data['element'] = $this->{$this->_model}->get_by_id($demanda_id);        
        
        // Permisos acceso
        $this->{$this->_model}->check_access($this->data['element']);

        // Validation
        if ($this->is_post())
        {
            // Rules
            $this->form_validation->set_rules('inmuebles[]', 'Inmuebles seleccionados', 'xss_clean|required');
            // Check
            if ($this->form_validation->run())
            {
                if($this->{$this->_model}->check_asociar_inmuebles($demanda_id,$this->input->post('inmuebles')))
                {
                    // Asociar
                    $result = $this->{$this->_model}->asociar_inmuebles($demanda_id,$this->input->post('inmuebles'));
                    // Check
                    if ($result)
                    {
                        $this->session->set_flashdata('message', 'Los inmuebles han sido asignados con éxito');
                        $this->session->set_flashdata('message_color', 'success');
                    }
                    else
                    {
                        $this->session->set_flashdata('message', 'Error al asignar los inmuebles. Inténtelo más tarde');
                    }
                    redirect($this->_controller. '/edit/' . $demanda_id, 'refresh');
                }
                else
                {
                    $this->data['message'] = $this->{$this->_model}->get_error();
                }
            }
            else
            {
                $this->data['message'] = validation_errors();
            }            
        }
        
        // Inmuebles disponibles
        $this->data['inmuebles_disponibles']=$this->{$this->_model}->get_inmuebles_asociar($demanda_id);

        // Render
        $this->render_private($this->_view . '/asociar_inmuebles', $this->data);
    }
    
    public function quitar_inmueble($demanda_id, $inmueble_id)
    {
        $this->data['element'] = $this->{$this->_model}->get_by_id($demanda_id);        
        
        // Permisos acceso
        $this->{$this->_model}->check_access($this->data['element']);

        // Edit
        $result = $this->{$this->_model}->quitar_inmueble($demanda_id,$inmueble_id);
        // Check
        if ($result)
        {
            $this->session->set_flashdata('message', 'Se ha quitado la propiedad de la demanda con éxito');
            $this->session->set_flashdata('message_color', 'success');
        }
        else
        {
            $this->session->set_flashdata('message', 'No se ha podido quitar la propiedad seleccionada de la demanda actual');
        }
        redirect($this->_controller. '/edit/' . $demanda_id, 'refresh');
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
    
    public function export() {
        // Aplicamos los filtros establecidos en el buscador
        $elements = $this->{$this->_model}->get_by_filtros($this->_generar_filtros_busqueda());
        // Creamos array con datos formateados
        if ($elements)
        {
            // Deshabilitar profiler para que no salga anidado al CSV
            $this->output->enable_profiler(FALSE);
            
            $this->load->helper('csv');
            
            // Cabecera
            $cabecera = array('Referencia','Tipo','Fecha Alta','Provincia','Municipio','Zona','Dirección','Metros','Metros útiles','Hab.','Baños'
                ,'Precio Compra','Precio Alquiler','Cert. Energ.','Año Construcción','Estado','Observaciones','Agente Asignado');
            $array[] = $this->utilities->encoding_array($cabecera);
             
            // Resto de datos
            foreach ($elements as $element)
            {
                $datos_formateado = array();

                $datos_formateado[] = $element->referencia;
                $datos_formateado[] = $element->nombre_tipo; 
                $datos_formateado[] = $this->utilities->cambiafecha_bd($element->fecha_alta);
                $datos_formateado[] = $element->nombre_provincia;
                $datos_formateado[] = $element->nombre_poblacion;
                $datos_formateado[] = $element->nombre_zona;
                $datos_formateado[] = $element->direccion;
                $datos_formateado[] = $element->metros;
                $datos_formateado[] = $element->metros_utiles;
                $datos_formateado[] = $element->habitaciones;
                $datos_formateado[] = $element->banios;
                $datos_formateado[] = $element->precio_compra;   
                $datos_formateado[] = $element->precio_alquiler;
                $datos_formateado[] = $element->nombre_certificacion_energetica;
                $datos_formateado[] = $element->anio_construccion;
                $datos_formateado[] = $element->nombre_estado;
                $datos_formateado[] = $element->observaciones;
                $datos_formateado[] = $element->nombre_agente_asignado;
                
                // Conversión de todos los elementos del array
                $array[] = $this->utilities->encoding_array($datos_formateado);
            }
            
            array_to_csv_binary($array, "listado_demandas.csv");
        }
        else
        {
            $this->session->set_flashdata('message', 'No existen datos para exportar con la consulta realizada');
            redirect($this->_controller, 'refresh');
        }
    }
   
}
