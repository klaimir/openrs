<?php defined('BASEPATH') OR exit('No direct script access allowed');

require_once APPPATH . '/core/MY_Model.php';

class Cliente_model extends MY_Model
{

    public function __construct()
    {  
        parent::__construct();
        
        $this->table = 'clientes';
        $this->primary_key = 'id';
        $this->view = 'v_clientes';
        
        $this->has_many['demandas'] = array('local_key'=>'id', 'foreign_key'=>'cliente_id', 'foreign_model'=>'Demanda_model');
        $this->has_one['poblacion'] = array('local_key' => 'poblacion_id', 'foreign_key' => 'id', 'foreign_model' => 'Poblacion_model');
        $this->has_one['pais'] = array('local_key'=>'pais_id', 'foreign_key'=>'id', 'foreign_model'=>'Pais_model');
        
        // Guardamos datos
        $this->timestamps=TRUE;
        $this->_created_at_field="fecha_alta";
        $this->_updated_at_field="fecha_actualizacion";
        
        // Modelos axiliares
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
        
        $this->form_validation->set_rules('nif', 'NIF/NIE/CIF', 'required|max_length[11]|is_unique_global[clientes;' . $id . ';nif;id]|is_nif_valido['.$pais_id.']|xss_clean');
        $this->form_validation->set_rules('nombre', 'Nombre', 'required|xss_clean|max_length[100]');
        $this->form_validation->set_rules('apellidos', 'Apellidos', 'required|xss_clean|max_length[150]');
        $this->form_validation->set_rules('direccion', 'Dirección', 'xss_clean|max_length[200]');
        $this->form_validation->set_rules('correo', 'Correo electrónico', 'required|xss_clean|max_length[250]|valid_email|is_unique_global[clientes;' . $id . ';correo;id]');
        $this->form_validation->set_rules('observaciones', 'Observaciones', 'xss_clean|max_length[500]');
        $this->form_validation->set_rules('telefonos', 'Teléfonos', 'xss_clean|max_length[70]');
        if($this->utilities->es_pais_extranjero($pais_id))
        {
            $required_poblacion="";
        }
        else
        {
            $required_poblacion="required";
        }
        $this->form_validation->set_rules('poblacion_id', 'Población', $required_poblacion);
        $this->form_validation->set_rules('provincia_id', 'Provincia', $required_poblacion);
        $this->form_validation->set_rules('pais_id', 'País de residencia', 'required');
        // Cuidado que hay que poner reglas a los campos para que se puedan aplicar los helpers
        $this->form_validation->set_rules('agente_asignado_id', 'Agente Asignado', 'xss_clean');
        /*
	12	busca_vender	tinyint(4)			No 	0	
	13	busca_comprar	tinyint(4)			No 	0	
	14	busca_alquilar	tinyint(4)			No 	0	
	15	busca_alquiler	tinyint(4)			No 	0	
	16	estado	varchar(20)	utf8_general_ci		No 	activo	
	17	estado_civil	varchar(50)	utf8_general_ci		Sí 	NULL	
	*/
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
        // Selector de provincias
        $data['provincias'] = $this->get_provincias_form();
        
        // Selector de paises
        $data['paises'] = $this->get_paises_form();
        
        // Selector de agentes
        $data['agentes'] = $this->get_agentes_form();
        
        // selector de intereses
        $data['intereses'] = $this->get_intereses_form();   
                                
        // Datos
        $data['nif'] = array(
            'name' => 'nif',
            'id' => 'nif',
            'type' => 'text',
            'value' => $this->form_validation->set_value('nif',is_object($datos) ? $datos->nif : ""),
        );
        
        $data['nombre'] = array(
            'name' => 'nombre',
            'id' => 'nombre',
            'type' => 'text',
            'value' => $this->form_validation->set_value('nombre',is_object($datos) ? $datos->nombre : ""),
        );
        
        $data['apellidos'] = array(
            'name' => 'apellidos',
            'id' => 'apellidos',
            'type' => 'text',
            'value' => $this->form_validation->set_value('apellidos',is_object($datos) ? $datos->apellidos : ""),
        );
        
        $data['direccion'] = array(
            'name' => 'direccion',
            'id' => 'direccion',
            'type' => 'text',
            'value' => $this->form_validation->set_value('direccion',is_object($datos) ? $datos->direccion : ""),
        );
                
        $data['pais_id']=$this->form_validation->set_value('pais_id',is_object($datos) ? $datos->pais_id : 64);
        $data['agente_asignado_id']=$this->form_validation->set_value('agente_asignado_id',is_object($datos) ? $datos->agente_asignado_id : "-1");
        $data['poblacion_id']=$this->form_validation->set_value('poblacion_id',is_object($datos) ? $datos->poblacion_id : "");
        
        if(!empty($data['poblacion_id']))
        {
            $poblacion=$this->Poblacion_model->get_by_id($data['poblacion_id']);
            $data['provincia_id']=$this->form_validation->set_value('provincia_id',$poblacion->provincia_id);
        }
        else
        {
            $data['provincia_id']=$this->form_validation->set_value('provincia_id',"");
        }        
        
        $data['correo'] = array(
            'name' => 'correo',
            'id' => 'correo',
            'type' => 'text',
            'value' => $this->form_validation->set_value('correo',is_object($datos) ? $datos->correo : ""),
        );
        
        $data['telefonos'] = array(
            'name' => 'telefonos',
            'id' => 'telefonos',
            'type' => 'text',
            'value' => $this->form_validation->set_value('telefonos',is_object($datos) ? $datos->telefonos : ""),
        );

        $data['observaciones'] = array(
            'name' => 'observaciones',
            'id' => 'observaciones',
            'type' => 'text',
            'value' => $this->form_validation->set_value('observaciones',is_object($datos) ? $datos->observaciones : ""),
        );

        return $data;
    }

    /**
     * Devuelve los datos formateado de la interfaz
     *
     * @return array con los datos formateado
     */
    
    public function get_formatted_datas($id=0)
    {
        $datas['nif'] = $this->input->post('nif');
        $datas['nombre'] = $this->input->post('nombre');
        $datas['apellidos'] = $this->input->post('apellidos');
        $datas['direccion'] = $this->input->post('direccion');
        $datas['correo'] = $this->input->post('correo');
        $datas['observaciones'] = $this->input->post('observaciones');
        $datas['telefonos'] = $this->input->post('telefonos');
        $datas['pais_id'] = $this->input->post('pais_id');
        $datas['poblacion_id'] = $this->input->post('poblacion_id');
        $datas['agente_asignado_id'] = $this->input->post('agente_asignado_id');
        // En la edición actualizamos el campo de actualización
        /*
        if($id>0)
        {
            $datas['fecha_alta'] = date()
        }
        // En la inserción el de creación
        else
        {
            
        }
         * 
         */
        
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
        if (count($this->with_demandas()->get($id)->demandas))
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
        $formatted_datas=$this->get_formatted_datas($id);        
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
     * Duplica los datos de un cliente
     *
     * @return datos del cliente
     */
    function duplicar($cliente) {
        // Conversión de Datos
        unset($cliente->id);
        $cliente->nif='';
        $cliente->correo='';
        unset($cliente->fecha_alta);
        unset($cliente->fecha_actualizacion);
        // Crear duplicado
        return $this->insert($cliente);
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
        return $this->get_intereses_dropdown(-1);
    }
    
    /**
     * Devuelve un array de intereses en formato para formulario de clientes
     *
     * @return array de intereses en formato para formulario de clientes
     */
    
    function get_intereses_form()
    {
        return $this->get_intereses_dropdown();
    }
    
    /**
     * Devuelve un array de intereses en formato dropdown
     *
     * @return array de intereses en formato dropdown
     */
    
    function get_intereses_dropdown($default="")
    {
        $intereses = array();
        $intereses[$default] = '- Seleccione interés -';
        $intereses[1] = 'Busca vender';
        $intereses[2] = 'Busca alquilar';
        $intereses[3] = 'Busca un alquiler';
        $intereses[4] = 'Busca comprar'; 
        return $intereses;
    }
    
    /**
     * Devuelve toda la información de un cliente
     *
     * @return array con toda la información del inmueble
     */
    
    function get_info($id)
    {
        $info=$this->with_poblacion()->with_pais()->with_demandas()->get($id);
        return $info;
    }

}
