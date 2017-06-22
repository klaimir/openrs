<?php defined('BASEPATH') OR exit('No direct script access allowed');

require_once APPPATH . 'core/MY_Model.php';

class Demanda_model extends MY_Model
{

    public function __construct()
    {
        parent::__construct();

        $this->table = 'demandas';
        $this->primary_key = 'id';
        $this->view = 'v_demandas';

        $this->has_many['inmuebles'] = array('local_key' => 'id', 'foreign_key' => 'demanda_id', 'foreign_model' => 'Inmueble_demanda_model');
        $this->has_many['fichas_visita'] = array('local_key' => 'id', 'foreign_key' => 'demanda_id', 'foreign_model' => 'Ficha_visita_model');
        $this->has_one['poblacion'] = array('local_key' => 'poblacion_id', 'foreign_key' => 'id', 'foreign_model' => 'Poblacion_model');
        $this->has_one['cliente'] = array('local_key' => 'cliente_id', 'foreign_key' => 'id', 'foreign_model' => 'Cliente_model');
        $this->has_one['certificacion_energetica'] = array('local_key' => 'certificacion_energetica_id', 'foreign_key' => 'id', 'foreign_model' => 'Certificacion_energetica_model');
        $this->has_one['estado'] = array('local_key' => 'estado_id', 'foreign_key' => 'id', 'foreign_model' => 'Estado_model');

        $this->has_many_pivot['opciones_extras'] = array(
            'foreign_model' => 'Opcion_extra_model',
            'pivot_table' => 'demandas_opciones_extras',
            'local_key' => 'id',
            'pivot_local_key' => 'demanda_id',
            'pivot_foreign_key' => 'opcion_extra_id',
            'foreign_key' => 'id',
            'get_relate' => FALSE
        );

        $this->has_many_pivot['lugares_interes'] = array(
            'foreign_model' => 'Lugar_interes_model',
            'pivot_table' => 'demandas_lugares_interes',
            'local_key' => 'id',
            'pivot_local_key' => 'demanda_id',
            'pivot_foreign_key' => 'lugar_interes_id',
            'foreign_key' => 'id',
            'get_relate' => FALSE
        );

        // Modelos axiliares
        $this->load->model('Zona_model');
        $this->load->model('Tipo_inmueble_model');
        $this->load->model('Certificacion_energetica_model');
        $this->load->model('Estado_model');
        $this->load->model('Opcion_extra_model');
        $this->load->model('Lugar_interes_model');
    }

    /*     * *********************** SECURITY ************************ */

    public function check_access_conditions($datos)
    {
        return TRUE;
    }

    /*     * *********************** FORMS ************************ */

    /**
     * Establece las reglas utilizadas para la validación de datos
     * 
     * @param [id]                  Indentificador del elemento
     *
     * @return void
     */
    public function set_rules($id = 0)
    {
        /* Si quisieramos ponerlo solo para insertar tendríamos que ponerlo asi
        if(empty($id))
        {
            $ref_slugify=$this->utilities->slugify($this->form_validation->get_validation_data('referencia'));
            if(empty($ref_slugify))
            {
                $ref_slugify=uniqid();
            }
            $this->form_validation->set_data_field('referencia', $ref_slugify);
            $this->form_validation->set_rules('referencia', 'Referencia', 'required|max_length[40]|is_unique_global[demandas;' . $id . ';referencia;id]|xss_clean');
        }
         * 
         */
        $this->form_validation->set_rules('referencia', 'Referencia', 'required|max_length[40]|is_unique_global[demandas;' . $id . ';referencia;id]|xss_clean');
        $this->form_validation->set_rules('metros_desde', 'Metros (desde)', 'xss_clean|max_length[4]|is_natural|less_than_equal_to[' . $this->form_validation->get_validation_data('metros_hasta') . ']');
        $this->form_validation->set_rules('metros_hasta', 'Metros (hasta)', 'xss_clean|max_length[4]|is_natural');
        $this->form_validation->set_rules('habitaciones_desde', 'Habitaciones (desde)', 'xss_clean|is_natural|less_than_equal_to[' . $this->form_validation->get_validation_data('habitaciones_hasta') . ']');
        $this->form_validation->set_rules('habitaciones_hasta', 'Habitaciones (hasta)', 'xss_clean|is_natural');
        $this->form_validation->set_rules('banios_desde', 'Baños (desde)', 'xss_clean|is_natural|less_than_equal_to[' . $this->form_validation->get_validation_data('banios_hasta') . ']');
        $this->form_validation->set_rules('banios_hasta', 'Baños (hasta)', 'xss_clean|is_natural');
        $this->form_validation->set_rules('anio_construccion_desde', 'Año construcción (desde)', 'xss_clean|is_natural|less_than_equal_to[' . $this->form_validation->get_validation_data('anio_construccion_hasta') . ']');
        $this->form_validation->set_rules('anio_construccion_hasta', 'Año construcción (hasta)', 'xss_clean|is_natural');
        $this->form_validation->set_rules('precio_desde', 'Precio (desde)', 'xss_clean|is_natural|less_than_equal_to[' . $this->form_validation->get_validation_data('precio_hasta') . ']');
        $this->form_validation->set_rules('precio_hasta', 'Precio (hasta)', 'xss_clean|is_natural');
        $this->form_validation->set_rules('fecha_alta', 'Fecha de nacimiento', 'xss_clean|checkDateFormat');
        $this->form_validation->set_rules('observaciones', 'Observaciones', 'required|trim');
        $this->form_validation->set_rules('poblacion_id', 'Población', 'xss_clean');
        $this->form_validation->set_rules('zonas_id[]', 'Zonas', 'xss_clean');
        $this->form_validation->set_rules('provincia_id', 'Provincia', 'xss_clean');
        $this->form_validation->set_rules('tipos_id[]', 'Tipos de inmuebles', 'xss_clean');
        $this->form_validation->set_rules('certificacion_energetica_id', 'Certificación energética', 'xss_clean');
        $this->form_validation->set_rules('estado_id', 'Estado', 'required');
        $this->form_validation->set_rules('agente_asignado_id', 'Agente asignado', 'xss_clean');
        $this->form_validation->set_rules('cliente_id', 'Cliente', 'required|xss_clean');
        $this->form_validation->set_rules('oferta_id', 'Oferta', 'required|xss_clean');
        $this->form_validation->set_rules('tipo_demanda_id', 'Tipo demanda', 'required|xss_clean');
    }
      
    /**
     * Ejecuta las validaciones
     *
     * @return void
     */
    public function validation($id = 0)
    {
        // Rules
        $this->set_rules($id);

        // Other functions validations
        
        // Run form validation        
        return $this->form_validation->run();
    }

    /**
     * Establece los datos para su visualización en HTML
     *
     * @param [id]                  Indentificador del elemento
     *
     * @return array con los datos especificados para utilizarlos en los diferentes helpers
     */
    public function set_datas_html($datos = NULL)
    {
        // Modelos auxiliares
        $this->load->model('Cliente_model');
        $this->load->model('Inmueble_model');
        
        // Selector de provincias
        $data['provincias'] = $this->Provincia_model->get_provincias_dropdown();

        // Selector de tipos_inmuebles
        $data['tipos_inmuebles'] = $this->Tipo_inmueble_model->get_tipos_inmuebles_dropdown("",NULL,FALSE);

        // Selector de opciones_extras
        $data['opciones_extras'] = $this->Opcion_extra_model->get_opciones_extras_dropdown();

        // Selector de lugares_interes
        $data['lugares_interes'] = $this->Lugar_interes_model->get_lugares_interes_dropdown();

        // Selector de tipos_certificacion_energetica
        $data['tipos_certificacion_energetica'] = $this->Certificacion_energetica_model->get_tipos_certificacion_energetica_dropdown();

        // Selector de estados
        $data['estados'] = $this->Estado_model->get_estados_dropdown(3);

        // Selector de agentes
        $data['agentes'] = $this->Usuario_model->get_agentes_dropdown();
        
        // Selector de clientes
        $data['clientes'] = $this->Cliente_model->get_clientes_dropdown();
        
        // selector de ofertas
        $data['ofertas'] = $this->Inmueble_model->get_ofertas_dropdown();
        
        // selector de tipo_demandas
        $data['tipos_demandas'] = $this->get_tipos_demandas_dropdown();

        // Datos
        $data['referencia'] = array(
            'name' => 'referencia',
            'id' => 'referencia',
            'type' => 'text',
            'value' => $this->form_validation->set_value('referencia', is_object($datos) ? $datos->referencia : ""),
        );

        $data['metros_desde'] = array(
            'name' => 'metros_desde',
            'id' => 'metros_desde',
            'type' => 'text',
            'value' => $this->form_validation->set_value('metros_desde', is_object($datos) ? $datos->metros_desde : ""),
        );

        $data['metros_hasta'] = array(
            'name' => 'metros_hasta',
            'id' => 'metros_hasta',
            'type' => 'text',
            'value' => $this->form_validation->set_value('metros_hasta', is_object($datos) ? $datos->metros_hasta : ""),
        );

        $data['habitaciones_desde'] = array(
            'name' => 'habitaciones_desde',
            'id' => 'habitaciones_desde',
            'type' => 'text',
            'value' => $this->form_validation->set_value('habitaciones_desde', is_object($datos) ? $datos->habitaciones_desde : ""),
        );
        
        $data['habitaciones_hasta'] = array(
            'name' => 'habitaciones_hasta',
            'id' => 'habitaciones_hasta',
            'type' => 'text',
            'value' => $this->form_validation->set_value('habitaciones_hasta', is_object($datos) ? $datos->habitaciones_hasta : ""),
        );
        
        $data['banios_desde'] = array(
            'name' => 'banios_desde',
            'id' => 'banios_desde',
            'type' => 'text',
            'value' => $this->form_validation->set_value('banios_desde', is_object($datos) ? $datos->banios_desde : ""),
        );

        $data['banios_hasta'] = array(
            'name' => 'banios_hasta',
            'id' => 'banios_hasta',
            'type' => 'text',
            'value' => $this->form_validation->set_value('banios_hasta', is_object($datos) ? $datos->banios_hasta : ""),
        );
        
        $data['anio_construccion_desde'] = array(
            'name' => 'anio_construccion_desde',
            'id' => 'anio_construccion_desde',
            'type' => 'text',
            'value' => $this->form_validation->set_value('anio_construccion_desde', is_object($datos) ? $datos->anio_construccion_desde : ""),
        );        

        $data['anio_construccion_hasta'] = array(
            'name' => 'anio_construccion_hasta',
            'id' => 'anio_construccion_hasta',
            'type' => 'text',
            'value' => $this->form_validation->set_value('anio_construccion_hasta', is_object($datos) ? $datos->anio_construccion_hasta : ""),
        );        
        
        $data['precio_desde'] = array(
            'name' => 'precio_desde',
            'id' => 'precio_desde',
            'type' => 'text',
            'value' => $this->form_validation->set_value('precio_desde', is_object($datos) ? $datos->precio_desde : ""),
        );
        
        $data['precio_hasta'] = array(
            'name' => 'precio_hasta',
            'id' => 'precio_hasta',
            'type' => 'text',
            'value' => $this->form_validation->set_value('precio_hasta', is_object($datos) ? $datos->precio_hasta : ""),
        );

        $data['fecha_alta'] = array(
            'name' => 'fecha_alta',
            'id' => 'fecha_alta',
            'type' => 'text',
            'value' => $this->form_validation->set_value('fecha_alta', is_object($datos) ? $this->utilities->cambiafecha_bd($datos->fecha_alta) : date("d/m/Y")),
        );

        // Las opciones extras vendrán del info
        //$data['opciones_extras_seleccionadas'] = is_object($datos) ? $datos->opciones_extras : array();

        // Los lugares de interés vendrán del info
        //$data['lugares_interes_seleccionados'] = is_object($datos) ? $datos->lugares_interes : array();
        
        // Las tipos_inmuebles vendrán del info
        if($this->input->post())
        {
            $data['tipos_inmuebles_seleccionados'] = $this->input->post('tipos_id');
        }
        else
        {
            $data['tipos_inmuebles_seleccionados'] = is_object($datos) ? $datos->tipos_inmuebles : array();
        }
        
        // Las zonas vendrán del info
        if($this->input->post())
        {
            $data['zonas_seleccionadas'] = $this->input->post('zonas_id');
        }
        else
        {
            $data['zonas_seleccionadas'] = is_object($datos) ? $datos->zonas : array();
        }

        $data['certificacion_energetica_id'] = $this->form_validation->set_value('certificacion_energetica_id', is_object($datos) ? $datos->certificacion_energetica_id : "");
        $data['estado_id'] = $this->form_validation->set_value('estado_id', is_object($datos) ? $datos->estado_id : "");
        $data['agente_asignado_id'] = $this->form_validation->set_value('agente_asignado_id', is_object($datos) ? $datos->agente_asignado_id : $this->data['session_user_id']);
        $data['poblacion_id'] = $this->form_validation->set_value('poblacion_id', is_object($datos) ? $datos->poblacion_id : "");
        $data['provincia_id'] = $this->form_validation->set_value('provincia_id', is_object($datos) ? $datos->provincia_id : "");
        $data['cliente_id'] = $this->form_validation->set_value('cliente_id', is_object($datos) ? $datos->cliente_id : "");
        $data['oferta_id'] = $this->form_validation->set_value('oferta_id', is_object($datos) ? $datos->oferta_id : "");
        $data['tipo_demanda_id'] = $this->form_validation->set_value('tipo_demanda_id', is_object($datos) ? $datos->tipo_demanda_id : "");

        // Selector de poblaciones
        $data['poblaciones'] = $this->Poblacion_model->get_poblaciones_dropdown($data['provincia_id']);

        // Selector de zonas
        $data['zonas'] = $this->Zona_model->get_zonas_dropdown($data['poblacion_id'],"",FALSE);
        
        $data['observaciones'] = array(
            'name' => 'observaciones',
            'id' => 'observaciones',
            'type' => 'text',
            'value' => $this->form_validation->set_value('observaciones', is_object($datos) ? $datos->observaciones : ""),
        );

        return $data;
    }  

    /**
     * Devuelve los datos formateado de la interfaz
     *
     * @return array con los datos formateado
     */
    public function get_formatted_datas($id = 0)
    {
        $datas['referencia'] = $this->input->post('referencia');
        $datas['metros_desde'] = $this->input->post('metros_desde');
        $datas['metros_hasta'] = $this->input->post('metros_hasta');
        $datas['habitaciones_desde'] = $this->input->post('habitaciones_desde');
        $datas['habitaciones_hasta'] = $this->input->post('habitaciones_hasta');
        $datas['banios_desde'] = $this->input->post('banios_desde');
        $datas['banios_hasta'] = $this->input->post('banios_hasta');
        $datas['anio_construccion_desde'] = $this->input->post('anio_construccion_desde');
        $datas['anio_construccion_hasta'] = $this->input->post('anio_construccion_hasta');
        $datas['precio_desde'] = $this->input->post('precio_desde');
        $datas['precio_hasta'] = $this->input->post('precio_hasta');
        $datas['fecha_alta'] = $this->utilities->cambiafecha_form($this->input->post('fecha_alta'));
        $datas['observaciones'] = $this->input->post('observaciones');
        $datas['certificacion_energetica_id'] = $this->utilities->get_sql_value_string($this->input->post('certificacion_energetica_id'), "defined",$this->input->post('certificacion_energetica_id'),NULL);
        $datas['estado_id'] = $this->input->post('estado_id');
        $datas['provincia_id'] = $this->utilities->get_sql_value_string($this->input->post('provincia_id'), "defined",$this->input->post('provincia_id'),NULL);
        $datas['poblacion_id'] = $this->utilities->get_sql_value_string($this->input->post('poblacion_id'), "defined",$this->input->post('poblacion_id'),NULL);
        //$datas['zona_id'] = $this->utilities->get_sql_value_string($this->input->post('zona_id'), "defined", $this->input->post('zona_id'), NULL);
        $datas['agente_asignado_id'] = $this->utilities->get_sql_value_string($this->input->post('agente_asignado_id'), "defined", $this->input->post('agente_asignado_id'), NULL);
        $datas['cliente_id'] = $this->input->post('cliente_id');
        $datas['oferta_id'] = $this->input->post('oferta_id');
        $datas['tipo_demanda_id'] = $this->input->post('tipo_demanda_id');

        $datos_formateados['demanda']=$datas;
        
        // Datos de tipos de inmuebles
        if(count($this->input->post('tipos_id')))
        {
            $datos_formateados['tipos_inmuebles_seleccionados']=$this->input->post('tipos_id');
        }
        else
        {
            $datos_formateados['tipos_inmuebles_seleccionados']=NULL;
        }
        
        // Datos de zonas
        if(count($this->input->post('zonas_id')))
        {
            $datos_formateados['zonas_seleccionadas']=$this->input->post('zonas_id');
        }
        else
        {
            $datos_formateados['zonas_seleccionadas']=NULL;
        }
        
        return $datos_formateados;
    }

    /**
     * Comprueba si semánticamente, es posible eliminar el elemento indicado
     *
     * @param [id]                  Indentificador del elemento
     *
     * @return void
     */
    function check_delete($id)
    {
        if (count($this->with_fichas_visita()->get($id)->fichas_visita))
        {
            return FALSE;
        }
        else
        {
            return TRUE;
        }
    }

    /**
     * Elimina al demanda del sistema de ficheros y de la bd
     *
     * @param [id]        Identificador del demanda en la base de datos
     *
     * @return void
     */
    function remove($id)
    {
        // Borrado físico de la carpeta de datos
        if ($this->utilities->full_rmdir(FCPATH . 'uploads/demandas/' . $id))
        {
            if ($this->delete($id))
            {
                return TRUE;
            }
            else
            {
                $this->set_error(lang('common_error_delete'));
                return FALSE;
            }
        }
        else
        {
            $this->set_error('Error al borrar la carpeta de datos. Póngase en contacto con el administrador');
            return FALSE;
        }
    }

    /**
     * Formatea los datos introducidos por el usuario y crea un registro en la base de datos
     *
     * @return void
     */
    function create($formatted_datas)
    {
        // Parent insert
        $id = $this->insert($formatted_datas['demanda']);
        if ($id)
        {
            // Creación de carpeta
            if (!file_exists(FCPATH . "uploads/demandas/" . $id))
            {
                if (!mkdir(FCPATH . "uploads/demandas/" . $id, DIR_READ_MODE, true))
                {
                    $this->set_error('Error en la creación de la carpeta de datos. Póngase en contacto con el administrador');
                    return FALSE;
                }
                // Copiamos fichero html de protección
                if (!copy(FCPATH . "uploads/demandas/index.html", FCPATH . "uploads/demandas/" . $id . "/index.html"))
                {
                    $this->set_error('Error al escribir en la carpeta de datos. Póngase en contacto con el administrador');
                    return FALSE;
                }
            }
            // Asignación de tipos de inmuebles seleccionados
            $this->asignar_tipos_inmuebles($id,$formatted_datas['tipos_inmuebles_seleccionados']);
            // Asignación de zonas seleccionados
            $this->asignar_zonas($id,$formatted_datas['zonas_seleccionadas']);
            // Devolvemos id
            return $id;
        }
        else
        {
            $this->set_error(lang('common_error_insert'));
            return FALSE;
        }
    }    

    /**
     * Formatea los datos introducidos por el usuario y actualiza un registro en la base de datos
     *
     * @param [id]                  Indentificador del elemento
     *
     * @return void
     */
    function edit($id)
    {
        // Formatted datas
        $formatted_datas = $this->get_formatted_datas($id);
        // Parent update
        $affected_rows = $this->update($formatted_datas['demanda'], $id);
        // Asignamos datos adicionales
        if ($affected_rows >= 0)
        {
            if($this->asignar_tipos_inmuebles($id,$formatted_datas['tipos_inmuebles_seleccionados']));
            {
                return $this->asignar_zonas($id,$formatted_datas['zonas_seleccionadas']);
            }
        }
        // Devolvemos error
        return FALSE;
    }

    /**
     * Lee los demandas en formato vista según los filtros indicados
     *
     * @return array de datos de plantilla
     */
    function get_by_filtros($filtros = NULL)
    {
        // Filtro Tipo de inmueble
        if (isset($filtros['tipo_id']) && $filtros['tipo_id'] >= 0)
        {
            $this->db->where('tipo_id', $filtros['tipo_id']);
        }
        // Filtro Provincia
        if (isset($filtros['provincia_id']) && $filtros['provincia_id'] >= 0)
        {
            $this->db->where('provincia_id', $filtros['provincia_id']);
        }
        // Filtro Población
        if (isset($filtros['poblacion_id']) && !empty($filtros['poblacion_id']) && $filtros['provincia_id'] >= 0)
        {
            $this->db->where('poblacion_id', $filtros['poblacion_id']);
        }
        // Filtro Zona
        if (isset($filtros['zona_id']) && !empty($filtros['zona_id']))
        {
            $this->db->where('zona_id', $filtros['zona_id']);
        }
        // Filtro Agente Asignado
        if (isset($filtros['agente_asignado_id']) && $filtros['agente_asignado_id'] >= 0)
        {
            $this->db->where('agente_asignado_id', $filtros['agente_asignado_id']);
        }
        // Filtro certificación energética
        if (isset($filtros['certificacion_energetica_id']) && $filtros['certificacion_energetica_id'] >= 0)
        {
            $this->db->where('certificacion_energetica_id', $filtros['certificacion_energetica_id']);
        }
        // Filtro estado
        if (isset($filtros['estado_id']) && $filtros['estado_id'] >= 0)
        {
            $this->db->where('estado_id', $filtros['estado_id']);
        }
        // Filtro oferta
        if (isset($filtros['oferta_id']) && $filtros['oferta_id'] >= 0)
        {
            $this->db->where('oferta_id', $filtros['oferta_id']);
        }   
        // Filtro tipo_demanda
        if (isset($filtros['tipo_demanda_id']) && $filtros['tipo_demanda_id'] >= 0)
        {
            $this->db->where('tipo_demanda_id', $filtros['tipo_demanda_id']);
        }
        // Filtro cliente
        if (isset($filtros['cliente_id']) && $filtros['cliente_id'] >= 0)
        {
            $this->db->where('cliente_id', $filtros['cliente_id']);
        } 
        // Fechas
        if (isset($filtros['fecha_desde']) && $filtros['fecha_desde'] != "")
        {
            $this->db->where('fecha_alta >=', $this->utilities->cambiafecha_form($filtros['fecha_desde']));
        }
        if (isset($filtros['fecha_hasta']) && $filtros['fecha_hasta'] != "")
        {
            $this->db->where('fecha_alta <=', $this->utilities->cambiafecha_form($filtros['fecha_hasta']));
        }
        // Baños
        if (isset($filtros['banios_desde']) && $filtros['banios_desde'] != "")
        {
            $this->db->where('banios_desde', $filtros['banios_desde']);
        }
        if (isset($filtros['banios_hasta']) && $filtros['banios_hasta'] != "")
        {
            $this->db->where('banios_hasta', $filtros['banios_hasta']);
        }
        // Habitaciones
        if (isset($filtros['habitaciones_desde']) && $filtros['habitaciones_desde'] != "")
        {
            $this->db->where('habitaciones_desde', $filtros['habitaciones_desde']);
        }
        if (isset($filtros['habitaciones_hasta']) && $filtros['habitaciones_hasta'] != "")
        {
            $this->db->where('habitaciones_hasta', $filtros['habitaciones_hasta']);
        }
        // Metros
        if (isset($filtros['metros_desde']) && $filtros['metros_desde'] != "")
        {
            $this->db->where('metros_desde', $filtros['metros_desde']);
        }
        if (isset($filtros['metros_hasta']) && $filtros['metros_hasta'] != "")
        {
            $this->db->where('metros_hasta', $filtros['metros_hasta']);
        }
        // Precios
        if (isset($filtros['precios_desde']) && $filtros['precios_desde'] != "")
        {
            $this->db->where('precio_desde', $filtros['precios_desde']);
        }
        if (isset($filtros['precios_hasta']) && $filtros['precios_hasta'] != "")
        {
            $this->db->where('precio_hasta', $filtros['precios_hasta']);
        }
        // Consulta
        $this->db->from($this->view);
        return $this->db->get()->result();
    }
    
    /**
     * Devuelve un array de tipos_demandas en formato dropdown
     *
     * @return array de tipos_demandas en formato dropdown
     */
    function get_tipos_demandas_dropdown($default = "")
    {
        $tipo_demandas = array();
        $tipo_demandas[$default] = '- Seleccione tipo demanda -';
        $tipo_demandas[1] = 'Sin filtros de búsqueda';
        $tipo_demandas[2] = 'Con filtros de búsqueda';
        return $tipo_demandas;
    }

    /**
     * Duplica los datos de un demanda
     *
     * @return datos del demanda
     */
    function duplicar($demanda)
    {
        // Conversión de Datos
        unset($demanda->id);
        $demanda->referencia = uniqid();
        $demanda->fecha_alta = date("Y-m-d");
        unset($demanda->fecha_actualizacion);
        // Crear duplicado
        return $this->create($demanda);
    }

    /**
     * Devuelve toda la información de un demanda
     *
     * @return array con toda la información del demanda
     */
    function get_info($id)
    {
        $info = $this->get($id);
        if ($info)
        {
            // Modelos axiliares
            //$this->load->model('Demanda_opcion_extra_model');
            //$this->load->model('Demanda_lugar_interes_model');
            
            // Consulta de datos
            $info->tipos_inmuebles = $this->get_tipos_inmuebles_asignados($id);
            $info->zonas = $this->get_zonas_asignadas($id);            

            $info->inmuebles_propuestos = $this->get_inmuebles_propuestos($id);
            
            //$info->opciones_extras = $this->Demanda_opcion_extra_model->get_opciones_extras_inmueble($id);
            //$info->lugares_interes = $this->Demanda_lugar_interes_model->get_lugares_interes_inmueble($id);
            // Devolvemos toda la información calculada
            return $info;
        }
        else
        {
            return NULL;
        }
    }    
    
     
    
    /**
     * Asigna los elementos indicados a la demanda, borra el resto
     *
     * @param [$demanda_id]                         Indentificador de la demanda
     *
     * @return array con los tipos de inmuebles seleccionados
     */
    public function get_zonas_asignadas($demanda_id)
    {
        // Modelos axiliares
        $this->load->model('Demanda_zona_model');
        
        return $this->Demanda_zona_model->get_zonas_demanda($demanda_id);
    }
    
    /**
     * Asigna los elementos indicados a la demanda, borra el resto
     *
     * @param [$demanda_id]                         Indentificador de la demanda
     *
     * @return array con los tipos de inmuebles seleccionados
     */
    public function get_tipos_inmuebles_asignados($demanda_id)
    {
        // Modelos axiliares
        $this->load->model('Demanda_tipo_inmueble_model');
        
        return $this->Demanda_tipo_inmueble_model->get_tipos_inmuebles_demanda($demanda_id);
    }
	
    /*
    public function asignar_tipos_inmuebles($demanda_id,$tipos_inmuebles_seleccionados)
    {
        // For testing
        //var_dump($tipos_inmuebles_seleccionados); die();
        // Modelos axiliares
        $this->load->model('Demanda_tipo_inmueble_model');
        
        // Tipos para asignar
        if(!is_array($tipos_inmuebles_seleccionados))
        {
            $tipos_inmuebles_seleccionados=array();
        }
        // Tipos para borrar
        $tipos_inmuebles_asignados=$this->Demanda_tipo_inmueble_model->get_tipos_inmuebles_demanda($demanda_id);
        if(!is_array($tipos_inmuebles_asignados))
        {
            $tipos_inmuebles_asignados=array();
        }
        
        // Datos de demanda
        $datos['demanda_id']=$demanda_id;
        
        // Asignación
        if(count($tipos_inmuebles_seleccionados))
        {
            foreach ($tipos_inmuebles_seleccionados as $tipo_inmueble_id)
            {
                if(!in_array($tipo_inmueble_id, $tipos_inmuebles_asignados))
                {
                    $datos['tipo_id']=$tipo_inmueble_id;
                    $this->Demanda_tipo_inmueble_model->insert($datos); 
                }
            }
        }
        
        // Borrado
        if(count($tipos_inmuebles_asignados))
        {
            foreach ($tipos_inmuebles_asignados as $tipo_inmueble_id)
            {
                if(!in_array($tipo_inmueble_id, $tipos_inmuebles_seleccionados))
                {
                    $datos['tipo_id']=$tipo_inmueble_id;
                    $this->Demanda_tipo_inmueble_model->delete($datos); 
                }
            }
        }
        
        return TRUE;
    }
     * 
     */
        
    /**
     * Asigna los elementos indicados a la demanda, borra el resto
     *
     * @param [$demanda_id]                  Indentificador de la demanda
     * @param [$tipos_inmuebles]             Array con los tipos de inmuebles
     *
     * @return array con los datos formateado
     */
    public function asignar_tipos_inmuebles($demanda_id,$tipos_inmuebles)
    {
        // For testing
        //var_dump($tipos_inmuebles); die();
        // Modelos axiliares
        $this->load->model('Demanda_tipo_inmueble_model');
        
        $this->Demanda_tipo_inmueble_model->delete(array("demanda_id" => $demanda_id)); 
        
        if($tipos_inmuebles)
        {
            $datos['demanda_id']=$demanda_id;
            foreach ($tipos_inmuebles as $tipo_inmueble_id)
            {
                $datos['tipo_id']=$tipo_inmueble_id;
                $this->Demanda_tipo_inmueble_model->insert($datos); 
            }
        }
        return TRUE;
    }
    
    /**
     * Asigna los elementos indicados a la demanda, borra el resto
     *
     * @param [$demanda_id]                  Indentificador de la demanda
     * @param [$zonas]             Array con los tipos de inmuebles
     *
     * @return array con los datos formateado
     */
    public function asignar_zonas($demanda_id,$zonas)
    {
        // Modelos axiliares
        $this->load->model('Demanda_zona_model');
        
        $this->Demanda_zona_model->delete(array("demanda_id" => $demanda_id)); 
        
        if($zonas)
        {
            $datos['demanda_id']=$demanda_id;
            foreach ($zonas as $zona_id)
            {
                $datos['zona_id']=$zona_id;
                $this->Demanda_zona_model->insert($datos); 
            }
        }
        return TRUE;
    }
    
    /**
     * Devuelve los inmuebles asignados a una demanda
     *
     * @param [$demanda_id]                 Identificador de la demanda
     *
     * @return array de vista de inmuebles
     */
    function get_inmuebles_propuestos($demanda_id)
    {
        $this->load->model('Inmueble_demanda_model');
        // Consulta
        return $this->Inmueble_demanda_model->get_view_inmuebles_demanda($demanda_id);
    }
    
    /**
     * Asigna los inmuebles seleccionados al demanda especificado
     *
     * @param [$id]                         Identificador del demanda
     * @param [$inmuebles_seleccionados]    Array de identificadores de inmuebles seleccionados
     *
     * @return TRUE si todo fue bien o exception
     */
    function asociar_inmuebles($demanda_id, $inmuebles_seleccionados) {
        // Modelos axiliares
        $this->load->model('Inmueble_demanda_model');
        // Asignación de inmuebles
        $datos['demanda_id']=$demanda_id;
        $datos['fecha_asignacion']=date("Y-m-d");
        foreach($inmuebles_seleccionados as $inmueble_id)
        {
            $datos['inmueble_id']=$inmueble_id;
            $this->Inmueble_demanda_model->insert($datos);            
        }
        return TRUE;
    }
    
    /**
     * Quita los inmuebles seleccionados al demanda especificado
     *
     * @param [$demanda_id]                 Identificador del demanda
     * @param [$inmuebles_seleccionados]    Array de identificadores de inmuebles seleccionados
     *
     * @return Número de inmuebles borrado para el demanda seleccionado
     */
    function quitar_inmueble($demanda_id, $inmueble_id) {
        // Modelos axiliares
        $this->load->model('Inmueble_demanda_model');
        // Borrado de inmueble
        $datos['demanda_id']=$demanda_id;
        $datos['inmueble_id']=$inmueble_id;
        return $this->Inmueble_demanda_model->delete($datos);
    }
    
    /**
     * Devuelve los inmuebles que se pueden asociar al demanda especificado
     *
     * @param [$id]                         Identificador del demanda
     *
     * @return array de identificadores de inmuebles que se pueden asociar al demanda especificado
     */
    function get_inmuebles_asociar($id) {
        // Modelos axiliares
        $this->load->model('Inmueble_model');
        // Consulta de propiedades
        $inmuebles_asociados = $this->get_inmuebles_propuestos($id);
        // Calculamos los ids de los inmuebles
        $array_ids_inmuebles_asociados=$this->utilities->get_keys_objects_array($inmuebles_asociados,'id');
        // Devuelve los inmubles que no estén contenidos en los incompatibles
        return $this->Inmueble_model->get_inmuebles_excepciones($array_ids_inmuebles_asociados);
    }
    
    /**
     * Comprueba que ningún inmueble ya está asociado al demanda
     *
     * @param [$demanda_id]                 Identificador del inmueble
     * @param [$inmuebles]                  Array de identificadores de demandas seleccionados
     *
     * @return TRUE OR FALSE
     */
    function check_asociar_inmuebles($demanda_id,$inmuebles)
    {
        $this->load->model('Inmueble_demanda_model');
        // Consulta
        $exists=$this->Inmueble_demanda_model->check_exists_inmuebles_demanda($demanda_id,$inmuebles);
         // Si existen
        if ($exists)
        {
            $this->set_error('Algunos de los inmuebles seleccionados están asignados a la demanda actual');
            return FALSE;
        }
        else
        {
            return TRUE;
        }
    }
    

    /**
     * Realizar el proceso de importación de demandas por CSV
     *
     * @return void
     */
    function import_csv()
    {
        // Opciones de configuración para subida de csv
        $config['upload_path'] = './uploads/temp';
        $config['allowed_types'] = 'csv';
        $config['file_name'] = 'import_demandas.csv';
        $config['overwrite'] = TRUE;
        $config['max_size'] = (MEGABYTE * ini_get('post_max_size'));

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('fichero'))
        {
            $this->set_error($this->upload->display_errors());
            return FALSE;
        }
        else
        {
            // Realizamos análisis y validación de datos
            return $this->_get_import_csv();
        }
    }

    /**
     * Realiza validación de todos los datos del fichero CSV importado
     * 
     * @return array con los datos validados y formateados y los errores encontrados
     */
    private function _get_import_csv()
    {
        // Fichero a leer
        $filename = FCPATH . 'uploads/temp/import_demandas.csv';
        // Comprobación
        if (file_exists($filename))
        {
            // Cargamos librería CSVReader
            $this->load->library('CSVReader');
            // Leemos los datos
            $csv = $this->csvreader->parse_file($filename, FALSE);
            // Dnis importados
            $referencias_importados = array();
            // Contador CSV
            $cont = 0;
            // Lectura CSV
            foreach ($csv as $data_csv)
            {
                $cont++;
                // Ignoramos la cabecera
                if ($cont != 1)
                {
                    // Procesar datos
                    $linedata = array();

                    $cont_columnas=0;
                    
                    // Asignación datos
                    $linedata['referencia'] = @$data_csv[$cont_columnas++];
                    $linedata['nombre_tipo'] = @$data_csv[$cont_columnas++];
                    $linedata['fecha_alta'] = @$data_csv[$cont_columnas++];
                    $linedata['nombre_provincia'] = @$data_csv[$cont_columnas++];
                    $linedata['nombre_poblacion'] = @$data_csv[$cont_columnas++];
                    $linedata['nombre_zona'] = @$data_csv[$cont_columnas++];
                    $linedata['direccion'] = @$data_csv[$cont_columnas++];
                    $linedata['metros'] = @$data_csv[$cont_columnas++];
                    $linedata['metros_utiles'] = @$data_csv[$cont_columnas++];
                    $linedata['habitaciones'] = @$data_csv[$cont_columnas++];
                    $linedata['banios'] = @$data_csv[$cont_columnas++];
                    $linedata['precio_compra'] = @$data_csv[$cont_columnas++];
                    $linedata['precio_alquiler'] = @$data_csv[$cont_columnas++];
                    $linedata['nombre_certificacion_energetica'] = @$data_csv[$cont_columnas++];
                    $linedata['anio_construccion'] = @$data_csv[$cont_columnas++];
                    $linedata['nombre_estado'] = @$data_csv[$cont_columnas++];
                    $linedata['observaciones'] = @$data_csv[$cont_columnas++];

                    // Conversión de todos los elementos del array                
                    $linedata = $this->utilities->encoding_array($linedata, 'windows-1252', 'UTF-8//IGNORE');
                    
                    // For testing
                    //var_dump($linedata);

                    // Validación de datos
                    $datos_validados = $this->_validar_datos_demanda($linedata, $referencias_importados);

                    // Se anota como referencia importado
                    if (!empty($linedata['referencia']))
                    {
                        $referencias_importados[] = $linedata['referencia'];
                    }

                    // Resultados
                    $import[] = $datos_validados;
                }
            }
            // For testing
            //die();
        }
        else
        {
            $this->set_error("El fichero cargado no existe. Por favor, inténtelo de nuevo.");
            return FALSE;
        }
        // Resultado final
        return $import;
    }

    /**
     * Realiza validación de los datos de un demanda importado por CSV. Se realiza conversión de datos anotando los errores encontrados, y si todo fue bien, 
     * se pasa a reutilizar la validación de los datos respecto a lo almacenado en la bd
     *
     * @param [$linedata]                         Array con los datos leidos del CSV
     * @param [$referencias_importados]           Array de referencias importados previamente
     * 
     * @return array con los datos validados y formateados y los errores encontrados
     */
    private function _validar_datos_demanda($linedata, $referencias_importados)
    {
        // Hay que reconvertir los datos de validación para que puedan pasar el validation
        $datos_formateados = $this->_format_datos_import_csv($linedata, $referencias_importados);
        $datos_formateados['texto_errores'] = NULL;
        if (!$datos_formateados['error'])
        {
            // Reseteamos datos de validación anterior
            $this->form_validation->reset_validation();
            // Inicializamos los datos de validación para reutilizar la validación del demanda
            $this->form_validation->set_data($datos_formateados);
            // Realizamos validacion
            if (!$this->validation())
            {
                $datos_formateados['error'] = TRUE;
                $datos_formateados['texto_errores'] = validation_errors('<p><strong>', '</strong></p>');
            }
        }

        return $datos_formateados;
    }

    /**
     * Detectamos errores de reconversión de datos del CSV a formato de BD y realizamos la conversión
     *
     * @param [$linedata]                         Array con los datos leidos del CSV
     * @param [$referencias_importados]           Array de referencias importados previamente
     * 
     * @return array con los datos importados y reconvertidos
     */
    private function _format_datos_import_csv($linedata, $referencias_importados)
    {
        // Procesar datos
        $error = FALSE;

        // Comprueba que no está repetido
        if (!is_null($referencias_importados))
        {
            if (in_array($linedata['referencia'], $referencias_importados))
            {
                $linedata['referencia'].=' <span class="label label-warning">Repetido</span>';
                $error = TRUE;
            }
        }

        // Tipo
        $linedata['tipo_id'] = $this->Tipo_inmueble_model->get_id_by_nombre($linedata['nombre_tipo']);
        if (empty($linedata['tipo_id']))
        {
            $linedata['nombre_tipo'].=' <span class="label label-warning">No existe</span>';
            $error = TRUE;
        }

        // Certificación energética
        $linedata['certificacion_energetica_id'] = $this->Certificacion_energetica_model->get_id_by_nombre($linedata['nombre_certificacion_energetica']);
        if (empty($linedata['certificacion_energetica_id']))
        {
            $linedata['nombre_certificacion_energetica'].=' <span class="label label-warning">No existe</span>';
            $error = TRUE;
        }

        // Estado
        $linedata['estado_id'] = $this->Estado_model->get_id_by_nombre(2, $linedata['nombre_estado']);
        if (empty($linedata['estado_id']))
        {
            $linedata['nombre_estado'].=' <span class="label label-warning">No existe</span>';
            $error = TRUE;
        }

        // Provincia
        $linedata['provincia_id'] = $this->Provincia_model->get_id_by_nombre($linedata['nombre_provincia']);
        if (empty($linedata['provincia_id']))
        {
            $linedata['nombre_provincia'].=' <span class="label label-success">No existe</span>';
            $error = TRUE;
        }
        else
        {
            // Población
            $linedata['poblacion_id'] = $this->Poblacion_model->get_id_by_nombre($linedata['nombre_poblacion'], $linedata['provincia_id']);
            if (!$linedata['poblacion_id'])
            {
                $linedata['nombre_poblacion'].=' <span class="label label-success">No existe</span>';
                $error = TRUE;
            }
            else
            {
                // Zona
                $linedata['zona_id'] = $this->Zona_model->get_id_by_nombre($linedata['nombre_zona'], $linedata['poblacion_id']);
                if (!$linedata['zona_id'])
                {
                    $linedata['nombre_zona'].=' <span class="label label-success">No existe</span>';
                }
            }
        }

        // Marcamos si ha habido errores
        $linedata['error'] = $error;

        // Devolvemos la linea de datos formateada
        return $linedata;
    }

    /**
     * Devuelve los datos formateado hasta un CSV
     *
     * @return array con los datos formateado
     */
    public function get_csv_formatted_datas($data)
    {
        $datos = array();
                    
        $datos['referencia'] = $data['referencia'];
        $datos['metros'] = $data['metros'];
        $datos['metros_utiles'] = $data['metros_utiles'];
        $datos['habitaciones'] = $data['habitaciones'];
        $datos['banios'] = $data['banios'];
        $datos['anio_construccion'] = $data['anio_construccion'];
        $datos['fecha_alta'] = $this->utilities->cambiafecha_form($data['fecha_alta']);
        $datos['direccion'] = $data['direccion'];
        $datos['observaciones'] = $data['observaciones'];
        $datos['precio_compra'] = $data['precio_compra'];
        $datos['precio_alquiler'] = $data['precio_alquiler'];
        $datos['tipo_id'] = $data['tipo_id'];
        $datos['certificacion_energetica_id'] = $data['certificacion_energetica_id'];
        $datos['estado_id'] = $data['estado_id'];
        $datos['poblacion_id'] = $data['poblacion_id'];
        $datos['zona_id'] = $this->utilities->get_sql_value_string($data['zona_id'], "defined", $data['zona_id'], NULL);

        return $datos;
    }

    /**
     * Realiza el proceso de importación volviendo a validar los datos de entrada y borrando el csv introducido
     *
     * @return array con los datos importados si todo fue bien o en caso contrario FALSE
     */
    public function do_import_csv()
    {
        // Realizamos la validación nuevamente
        $importdata = $this->_get_import_csv();
        // Se procesan los datos
        if ($importdata)
        {
            foreach ($importdata as $key => $data)
            {
                if (!$data['error'])
                {
                    // Creación
                    $id = $this->create($this->get_csv_formatted_datas($data));
                    //Fin comprobaciones
                    $importdata[$key]['importado'] = ($id) ? TRUE : FALSE;
                }
                else
                {
                    $importdata[$key]['importado'] = FALSE;
                }
            }

            if (file_exists(FCPATH . 'uploads/temp/import_demandas.csv'))
            {
                if (!unlink(FCPATH . 'uploads/temp/import_demandas.csv'))
                {
                    $this->set_error('El fichero de importación no ha podido ser borrado. Inténtelo más tarde');
                    return FALSE;
                }
            }
        }
        // Devolvemos resultados importados
        return $importdata;
    }

    /**
     * Marca o desmarca una opción extra para un demanda en concreto
     *
     * @param [demanda_id]             Indentificador del demanda
     * @param [opcion_extra_id]         Indentificador de la opción extra
     * @param [marcar]                  1 si tiene que marcar la opción en el demanda, 0 en caso contrario
     *
     * @return void
     */
    function marcar_opcion_extra($demanda_id, $opcion_extra_id, $marcar)
    {
        // Carga del modelo
        $this->load->model('Inmueble_opcion_extra_model');
        // Datos de marcado
        return $this->Inmueble_opcion_extra_model->marcar($demanda_id, $opcion_extra_id, $marcar);
    }

    /**
     * Marca o desmarca un lugar de interés para un demanda en concreto
     *
     * @param [demanda_id]             Indentificador del demanda
     * @param [lugar_interes_id]         Indentificador de la opción extra
     * @param [marcar]                  1 si tiene que marcar la opción en el demanda, 0 en caso contrario
     *
     * @return void
     */
    function marcar_lugar_interes($demanda_id, $lugar_interes_id, $marcar)
    {
        // Carga del modelo
        $this->load->model('Inmueble_lugar_interes_model');
        // Datos de marcado
        return $this->Inmueble_lugar_interes_model->marcar($demanda_id, $lugar_interes_id, $marcar);
    }
    
    /**
     * Devuelve los inmuebles demandados por un cliente en un idioma determinado
     *
     * @param [$cliente_id]		Identificador del cliente
     * @param [$id_idioma]		Identificador del idioma
     * 
     * @return Array con la información del inmueble y la demanda asociada
     */
    
    function get_inmuebles_demandados($cliente_id,$id_idioma=NULL)
    {
        // Si el idioma es NULL, consultamos el de la sesion
        if(is_null($id_idioma))
        {
            $id_idioma = $this->data['session_id_idioma'];
        }
        // Consulta
        $this->db->select('v_inmuebles.*, inmuebles_demandas.demanda_id');
        $this->db->from('v_inmuebles');
        $this->db->join('inmuebles_demandas', 'inmuebles_demandas.inmueble_id='.'v_inmuebles.id');
        $this->db->join('demandas', 'inmuebles_demandas.demanda_id='.'demandas.id');
        $this->db->where("idioma_id",$id_idioma);
        $this->db->where("cliente_id",$cliente_id);
        return $this->db->get()->result();
    }
    
    /**
     * Devuelve los clientes demandantes de un inmueble
     *
     * @param [$inmueble_id]		Identificador del inmueble
     * 
     * @return Array con la información del inmueble y la demanda asociada
     */
    
    function get_demandantes_inmueble($inmueble_id)
    {
        $this->db->select('v_clientes.*, inmuebles_demandas.demanda_id');
        $this->db->from('v_clientes');     
        $this->db->join('demandas', 'demandas.cliente_id='.'v_clientes.id');
        $this->db->join('inmuebles_demandas', 'inmuebles_demandas.demanda_id='.'demandas.id');        
        $this->db->where("inmueble_id",$inmueble_id);
        return $this->db->get()->result();
    }
    
}
