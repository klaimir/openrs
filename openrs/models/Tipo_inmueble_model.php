<?php defined('BASEPATH') OR exit('No direct script access allowed');

require_once APPPATH . 'core/MY_Model.php';

class Tipo_inmueble_model extends MY_Model
{
    
    public $idiomas_activos=array();

    public function __construct()
    {
        $this->table = 'tipos_inmueble';
        $this->primary_key = 'id';    
        $this->has_many['inmuebles'] = array('local_key'=>'id', 'foreign_key'=>'tipo_id', 'foreign_model'=>'Inmueble_model');
                
        parent::__construct();
        
        // Cargamos modelo de tipos de plantilla
        $this->load->model('Tipo_inmueble_idiomas_model');
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
        // Para cada idioma creamos su regla para el nombre
        foreach($this->idiomas_activos as $idioma)
        {            
            $this->form_validation->set_rules('nombre_'.$idioma->id_idioma, 'Nombre en '.$idioma->nombre, 'required|max_length[100]|xss_clean|is_unique_global_foreign_key[tipos_inmueble_idiomas;' . $id . ';nombre;tipo_inmueble_id;idioma_id;' . $idioma->id_idioma . ']');
        }        
        $this->form_validation->set_rules('descripcion', 'Descripción', 'xss_clean|max_length[255]');
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
        // Idiomas
        $data['idiomas_activos'] = $this->idiomas_activos;
        // Leemos los idiomas para la edición
        if($datos)
        {
            // Buscamos los nombre de los idiomas
            $array_datos_idioma=$this->Tipo_inmueble_idiomas_model->get_info_idiomas_by_tipo_inmueble($datos->id);
        }
        else
        {
            $array_datos_idioma=NULL;
        }
        // Datos de idiomas
        $data['datos_idioma']=array();
        foreach($data['idiomas_activos'] as $idioma)
        {
            // Leemos datos de idiomas de la entrada
            if($array_datos_idioma)
            {
                // Buscamos los nombre de los idiomas
                $datos_idioma=$array_datos_idioma[$idioma->id_idioma];
            }
            else
            {
                $datos_idioma=NULL;
            }
            $data['datos_idioma'][$idioma->id_idioma] = array(
                'name' => 'nombre_'.$idioma->id_idioma,
                'id' => 'nombre_'.$idioma->id_idioma,
                'type' => 'text',
                'value' => $this->form_validation->set_value('nombre',is_object($datos_idioma) ? $datos_idioma->nombre : ""),
            );
        }
        
        $data['descripcion'] = array(
            'name' => 'descripcion',
            'id' => 'descripcion',
            'type' => 'text',
            'value' => $this->form_validation->set_value('descripcion',is_object($datos) ? $datos->descripcion : ""),
        );

        return $data;
    }

    /**
     * Devuelve los datos formateado de la interfaz principales
     *
     * @return array con los datos formateado
     */
    
    public function get_formatted_datas()
    {
        $datas['descripcion'] = $this->input->post('descripcion');
        return $datas;
    }
    
    /**
     * Devuelve los datos formateado de la interfaz de todos los idiomas
     *
     * @return array con los datos formateado
     */
    
    public function get_formatted_datas_idiomas()
    {
        $datos_idiomas=array();
        foreach($this->idiomas_activos as $idioma)
        {
            $datos_idiomas[$idioma->id_idioma]=$this->get_formatted_datas_idioma($idioma->id_idioma);
        }
        return $datos_idiomas;
    }
    
    /**
     * Devuelve los datos formateado de la interfaz de un idioma en concreto
     *
     * @return array con los datos formateado
     */
    
    public function get_formatted_datas_idioma($id)
    {
        return array( "nombre" => $this->input->post('nombre_'.$id));
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
        if (count($this->with_inmuebles()->get($id)->inmuebles))
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
        $id=$this->insert($formatted_datas);        
        // Insertamos los datos de los idiomas
        $this->Tipo_inmueble_idiomas_model->save_datos_idiomas($id,$this->get_formatted_datas_idiomas());
        // Devolvemos id insertado
        return $id;
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
        $affected_rows=$this->update($formatted_datas,$id);
        // Insertamos los datos de los idiomas
        $this->Tipo_inmueble_idiomas_model->save_datos_idiomas($id,$this->get_formatted_datas_idiomas());
        // Devolvemos id insertado
        return $affected_rows;
    }    
    
    /**
     * Devuelve un array de tipos de inmuebles en formato dropdown
     *
     * @return array de tipos de inmuebles en formato dropdown
     */
    
    function get_tipos_inmuebles_dropdown($default_value="", $idioma_id=NULL, $show_default_value=TRUE, $text_value="- Seleccione tipo -")
    {
        // Idioma
        if (is_null($idioma_id))
        {
            $idioma_id=$this->data['session_id_idioma'];
        }
        // Array de tipos de inmuebles
        $tipos_inmuebles=$this->Tipo_inmueble_idiomas_model->order_by('nombre')->get_all(array('idioma_id' => $idioma_id));
        $tipos_inmuebles_dropdown=$this->utilities->dropdown($tipos_inmuebles,'tipo_inmueble_id','nombre');
        // Selección inicial
        if($show_default_value)
        {
            $seleccion[$default_value]=$text_value;
            // Suma de ambos
            return ($seleccion+$tipos_inmuebles_dropdown);
        }
        else
        {
            return $tipos_inmuebles_dropdown;
        }
    }    
    
    /**
     * Devuelve el identificador de un tipo de inmueble que coincida con el nombre suministrado
     *
     * @param	[nombre_tipo_inmueble]   Nombre del tipo_inmueble
     * 
     * @return identificador del tipo_inmueble
     */
    
    function get_id_by_nombre($nombre_tipo_inmueble, $idioma_id=NULL)
    {
        return $this->Tipo_inmueble_idiomas_model->get_id_by_nombre($nombre_tipo_inmueble, $idioma_id);
    }
    
    /**
     * Lee todas los tipos de inmuebles con el idioma formateado
     *
     * @return array de datos de plantilla
     */
    
    function get_all_for_table($id_idioma)
    {
        // Lista de campos
        $this->db->select($this->table.'.*,tipos_inmueble_idiomas.nombre');
        $this->db->from($this->table);
        $this->db->join($this->Tipo_inmueble_idiomas_model->table, $this->Tipo_inmueble_idiomas_model->table.'.tipo_inmueble_id='.$this->table.'.'.$this->primary_key);
        $this->db->where("idioma_id",$id_idioma);
        return $this->db->get()->result();
    }
    
}
