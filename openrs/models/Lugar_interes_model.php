<?php defined('BASEPATH') OR exit('No direct script access allowed');

require_once APPPATH . '/core/MY_Model.php';

class Lugar_interes_model extends MY_Model
{
    
    public $idiomas_activos=array();

    public function __construct()
    {
        $this->table = 'lugares_interes';
        $this->primary_key = 'id';
        
        $this->has_many['inmuebles'] = array('local_key'=>'id', 'foreign_key'=>'lugar_interes_id', 'model'=>'Inmueble_lugar_interes_model');
                
        parent::__construct();
        
        // Cargamos modelo de tipos de plantilla
        $this->load->model('Lugar_interes_idiomas_model');
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
            $this->form_validation->set_rules('nombre_'.$idioma->id_idioma, 'Nombre en '.$idioma->nombre, 'required|max_length[100]|xss_clean');
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
            $array_datos_idioma=$this->Lugar_interes_idiomas_model->get_info_idiomas_by_lugar_interes($datos->id);
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
        $this->Lugar_interes_idiomas_model->save_datos_idiomas($id,$this->get_formatted_datas_idiomas());
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
        $this->Lugar_interes_idiomas_model->save_datos_idiomas($id,$this->get_formatted_datas_idiomas());
        // Devolvemos id insertado
        return $affected_rows;
    }
    
    /**
     * Lee todas los tipos de lugares de interés con el idioma formateado
     *
     * @return array de datos de plantilla
     */
    
    function get_all_for_table($id_idioma)
    {
        // Lista de campos
        $this->db->select($this->table.'.*,'.$this->Lugar_interes_idiomas_model->table.'.nombre');
        $this->db->from($this->table);
        $this->db->join($this->Lugar_interes_idiomas_model->table, $this->Lugar_interes_idiomas_model->table.'.lugar_interes_id='.$this->table.'.'.$this->primary_key);
        $this->db->where("idioma_id",$id_idioma);
        return $this->db->get()->result();
    }
    
}
