<?php defined('BASEPATH') OR exit('No direct script access allowed');

require_once APPPATH . '/core/MY_Model.php';

class Cliente_model extends MY_Model
{

    public function __construct()
    {
        $this->table = 'clientes';
        $this->primary_key = 'id';
        $this->view = 'v_clientes';
        
        parent::__construct();
        
        $this->load->model('Provincia_model'); 
        $this->load->model('Pais_model'); 
    }
    
    /************************* SECURITY *************************/
    
    public function check_access_conditions($datos)
    {
        return TRUE;
    }
    
    /************************* FORMS *************************/
    
    /**
     * Establece las reglas utilizadas para la validación de datos
     * 
     * @param [id]                  Indentificador del elemento
     *
     * @return void
     */
    
    public function set_rules($id=0)
    {
        $pais_id=$this->input->post('pais_id');
        
        $this->form_validation->set_rules('nif', 'NIF/NIE/CIF', 'required|max_length[15]|is_unique_global[clientes.nif,'.$id.']|is_nif_valido['.$pais_id.']|xss_clean');
        $this->form_validation->set_rules('nombre', 'Nombre del cliente', 'xss_clean|max_length[100]');
        $this->form_validation->set_rules('apellidos', 'Apellidos del cliente', 'xss_clean|max_length[150]');
        $this->form_validation->set_rules('direccion', 'Dirección del cliente', 'xss_clean|max_length[200]');
        if($this->utilities->es_pais_extranjero($pais_id))
        {
            $required_poblacion="";
        }
        else
        {
            $required_poblacion="required";
        }
        $this->form_validation->set_rules('poblacion_id', 'Población', $required_poblacion);
    }
    
    /**
     * Ejecuta las validaciones
     *
     * @return void
     */
    public function validation($id=0)
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
    
    public function set_datas_html($datos=NULL)
    {        
        // Plantillas
        $data['tipos_plantillas'] = $this->Tipo_plantilla_documentacion_model->as_dropdown('nombre')->get_all();
                
        // Datos
        $data['nombre'] = array(
            'name' => 'nombre',
            'id' => 'nombre',
            'type' => 'text',
            'value' => $this->form_validation->set_value('nombre',is_object($datos) ? $datos->nombre : ""),
        );
        
        $data['descripcion'] = array(
            'name' => 'descripcion',
            'id' => 'descripcion',
            'type' => 'text',
            'value' => $this->form_validation->set_value('descripcion',is_object($datos) ? $datos->descripcion : ""),
        );
        
        $data['tipo_plantilla_id']=$this->form_validation->set_value('tipo_plantilla_id',is_object($datos) ? $datos->tipo_plantilla_id : "");

        $data['html'] = array(
            'name' => 'html',
            'id' => 'html',
            'type' => 'text',
            'value' => $this->form_validation->set_value('html',is_object($datos) ? $datos->html : ""),
        );

        return $data;
    }

    /**
     * Devuelve los datos formateado de la interfaz
     *
     * @return array con los datos formateado
     */
    
    public function get_formatted_datas()
    {
        $datas['nombre'] = $this->input->post('nombre');
        $datas['descripcion'] = $this->input->post('descripcion');
        $datas['tipo_plantilla_id'] = $this->input->post('tipo_plantilla_id');
        $datas['html'] = $this->input->post('html');
        return $datas;
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
        if (count($this->with_documentos_generados()->get($id)->documentos_generados))
        {
            return FALSE;
        }
        else
        {
            return TRUE;
        }
    }
    
    /**
     * Formatea los datos introducidos por el usuario y crea un registro en la base de datos
     *
     * @return void
     */
    
    function create()
    {
        // Formatted datas
        $formatted_datas=$this->get_formatted_datas();                
        // Parent insert
        return $this->insert($formatted_datas);
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
        $formatted_datas=$this->get_formatted_datas();        
        // Parent update
        return $this->update($formatted_datas,$id);
    }
    
    /**
     * Lee los clientes en formato vista según los filtros indicados
     *
     * @return array de datos de plantilla
     */
    
    function get_by_filtros($filtros)
    {
        // Filtro Pais
        if (isset($filtros['pais_id']) && $filtros['pais_id'] >= 0)
        {
            $this->db->where('pais_id', $filtros['pais_id']);
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
        // Filtro Agente Asignado
        if (isset($filtros['agente_asignado_id']) && $filtros['agente_asignado_id'] >= 0)
        {
            $this->db->where('agente_asignado_id', $filtros['agente_asignado_id']);
        }
        // Intereses        
        switch ($filtros['interes_id'])
        {
            case 1:
                $this->db->where('busca_vender', 1);
                break;
            case 2:
                $this->db->where('busca_alquilar', 1);
                break;
            case 3:
                $this->db->where('busca_alquiler', 1);
                break;
            case 4:
                $this->db->where('busca_comprar', 1);
                break;
            default:
                break;
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
        // Consulta
        $this->db->from($this->view);
        return $this->db->get()->result();
    }
    
    /**
     * Duplica los datos de una plantilla dada
     *
     * @return identificador de la plantilla insertada
     */
    function duplicar($plantilla) {
        // Conversión de Datos
        unset($plantilla->id);
        unset($plantilla->fecha_alta);
        //$plantilla->descripcion = $plantilla->descripcion." - Copia";
        // Crear duplicado
        return $this->insert($plantilla);
    }
    
    /**
     * Devuelve un array de provincias en formato para buscador de clientes
     *
     * @return array de provincias en formato para buscador de clientes
     */
    
    function get_provincias_buscador()
    {
        return $this->Provincia_model->get_provincias_dropdown(-1);
    }
    
    /**
     * Devuelve un array de provincias en formato para formularios de clientes
     *
     * @return array de provincias en formato para formularios de clientes
     */
    
    function get_provincias_form()
    {
        return $this->Provincia_model->get_provincias_dropdown();
    }
    
    /**
     * Devuelve un array de paises en formato para buscador de clientes
     *
     * @return array de paises en formato para buscador de clientes
     */
    
    function get_paises_buscador()
    {
        return $this->Pais_model->get_paises_dropdown(-1);
    }
    
    /**
     * Devuelve un array de paises en formato para formularios de clientes
     *
     * @return array de paises en formato para formularios de clientes
     */
    
    function get_paises_form()
    {
        return $this->Pais_model->get_paises_dropdown();
    }
    
    /**
     * Devuelve un array de agentes en formato para buscador de clientes
     *
     * @return array de agentes en formato para buscador de clientes
     */
    
    function get_agentes_buscador()
    {
        return $this->Usuario_model->get_agentes_dropdown(-1);
    }
    
    /**
     * Devuelve un array de agentes en formato para formularios de clientes
     *
     * @return array de agentes en formato para formularios de clientes
     */
    
    function get_agentes_form()
    {
        return $this->Usuario_model->get_agentes_dropdown();
    }
    
    /**
     * Devuelve un array de intereses en formato para buscador de clientes
     *
     * @return array de intereses en formato para buscador de clientes
     */
    
    function get_intereses_buscador()
    {
        $intereses = array();
        $intereses[-1] = '- Seleccione interés -';
        $intereses[1] = 'Busca vender';
        $intereses[2] = 'Busca alquilar';
        $intereses[3] = 'Busca un alquiler';
        $intereses[4] = 'Busca comprar'; 
        return $intereses;
    }

}
