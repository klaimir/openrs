<?php defined('BASEPATH') OR exit('No direct script access allowed');

require_once APPPATH . 'core/MY_Model.php';

class Inmueble_idiomas_model extends MY_Model
{

    public function __construct()
    {
        $this->table = 'inmuebles_idiomas';
        $this->primary_key = 'id';
        
        parent::__construct();        
    }
    
    /**
     * Almacena un dato de un idioma determinado
     *
     * @return array de datos de plantilla
     */
    
    function save($datos,$idioma_id,$inmueble_id)
    {
        // Comprobar si existe
        $where=array("idioma_id" => $idioma_id, "inmueble_id" => $inmueble_id);
        $datos_bd=$this->get($where);
        // Update
        if($datos_bd)
        {
            return $this->update($datos, $datos_bd->id);
        }
        // En caso contrario, insert
        else
        {
            return $this->insert($datos);
        }
    }
    
    /**
     * Almacena un dato de un idioma determinado
     *
     * @return array de datos de plantilla
     */
    
    function save_datos_idiomas($inmueble_id,$datos)
    {
        foreach ($datos as $key => $value)
        {        
            // Puede no tener datos introducidos un determinado idioma
            if(isset($value['titulo']))
            {
                // keys
                $value['idioma_id']=$key;
                $value['inmueble_id']=$inmueble_id;
                // Save
                $result=$this->save($value,$key,$inmueble_id);
                // Testing
                //var_dump($value);
                //var_dump($key);
                //var_dump($inmueble_id);
                //var_dump($result);
                //die();
                // Save
                if($result===FALSE)
                {
                    return FALSE;
                }
            }
        }
        return TRUE;
    }
    
    /**
     * Consulta los datos que tiene un determinado inmueble en todos los idiomas
     *
     * @return array de datos
     */
    
    function get_info_idiomas_by_inmueble($id)
    {
        $this->db->select();
        $this->db->from($this->table);
        $this->db->where('inmueble_id',$id);
        $results=$this->db->get()->result();
        $array=array();
        if($results)
        {            
            foreach($results as $result)
            {
                $array[$result->idioma_id]=$result;
            }
        }
        return $array;
    }
    
    /**
     * Consulta los datos que tiene un determinado inmueble en un idioma en concreto
     *
     * @return array de datos
     */
    
    function get_info($inmueble_id,$idioma_id)
    {
        $this->db->select();
        $this->db->from($this->table);
        $this->db->where('inmueble_id',$inmueble_id);
        $this->db->where('idioma_id',$idioma_id);
        return $this->db->get()->row();
    }
    
    /**
     * Obtiene la url pública de un inmueble
     *
     * @return array de datos
     */
    
    function get_url_publica($inmueble_id,$idioma_id)
    {
        $info_idioma=$this->get_info($inmueble_id,$idioma_id);
        $idioma=$this->Idioma_model->get_idioma($idioma_id);
        if($info_idioma && !empty($info_idioma->url_seo))
        {
            return base_url($idioma->nombre_seo.'/inmueble/'.$inmueble_id.'-'.$info_idioma->url_seo);
        }
        else
        {
            return NULL;
        }
    }
    
}
