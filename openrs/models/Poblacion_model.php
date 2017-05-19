<?php defined('BASEPATH') OR exit('No direct script access allowed');

require_once APPPATH . '/core/MY_Model.php';

class Poblacion_model extends MY_Model
{

    public $provincia_id=NULL;
    
    public function __construct()
    {
        $this->table = 'poblaciones';
        $this->primary_key = 'id';
        $this->has_one['provincia'] = array('local_key'=>'id', 'foreign_key'=>'provincia_id', 'foreign_model'=>'Provincia_model');
        $this->has_many['clientes'] = array('local_key'=>'id', 'foreign_key'=>'poblacion_id', 'foreign_model'=>'Cliente_model');
        $this->has_many['inmuebles'] = array('local_key'=>'id', 'foreign_key'=>'poblacion_id', 'foreign_model'=>'Inmueble_model');
        
        parent::__construct();
        
        // Carga del modelo
        $this->load->model('Provincia_model');
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
        $this->form_validation->set_rules('poblacion', 'Nombre de la población', 'required|is_unique_global_foreign_key[poblaciones,id,poblacion,'.$id.',provincia_id,'.$this->provincia_id.']|max_length[100]|xss_clean');
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
        $data['poblacion'] = array(
            'name' => 'poblacion',
            'id' => 'poblacion',
            'type' => 'text',
            'value' => $this->form_validation->set_value('poblacion',is_object($datos) ? $datos->poblacion : ""),
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
        $datas['poblacion'] = $this->input->post('poblacion');
        $datas['provincia_id'] = $this->provincia_id;
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
        $datos_asociados=$this->with_inmuebles()->with_clientes()->get($id);
        if (count($datos_asociados->inmuebles) || count($datos_asociados->clientes))
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
     * Activa\desactiva todos los municipios asociados a la provincia indicada
     *
     * @param [id]                  Indentificador de la provincia
     * @param [activar]             Acción
     *
     * @return void
     */
    
    function activar_all($provincia_id,$activar)
    {
        // Datos personales
        $poblaciones = $this->where('provincia_id',$provincia_id)->get_all();        
        $datos = array();
        $cont=0;
        // Es mejor implementar un batch por eficiencia, debido al número elevado de municipios que hay por provincia
        foreach ($poblaciones as $poblacion)
        {
            $datos[$cont]['id'] = $poblacion->id;
            $datos[$cont]['activa'] = $activar;
            $cont++;
        }
        // Update Batch
        return $this->db->update_batch($this->table, $datos, 'id');
    }
    
    /**
     * Activa\desactiva el municipio indicado
     *
     * @param [id]                  Indentificador del municipio
     * @param [activar]             Acción
     *
     * @return void
     */
    
    function activar($id,$activar)
    {
        // Activación de provincia
        return $this->update(array("activa" => $activar),$id);
    }

}
