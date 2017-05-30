<?php defined('BASEPATH') OR exit('No direct script access allowed');

require_once APPPATH . 'core/MY_Model.php';

class Lugar_interes_idiomas_model extends MY_Model
{

    public function __construct()
    {
        $this->table = 'lugares_interes_idiomas';
        $this->primary_key = 'id';
        
        parent::__construct();        
    }
    
    /**
     * Almacena un dato de un idioma determinado
     *
     * @return array de datos de plantilla
     */
    
    function save($datos,$idioma_id,$lugar_interes_id)
    {
        // Comprobar si existe
        $where=array("idioma_id" => $idioma_id, "lugar_interes_id" => $lugar_interes_id);
        $datos_bd=$this->get($where);
        // Update
        if($datos_bd)
        {
            $this->update($datos, $datos_bd->id);
        }
        // En caso contrario, insert
        else
        {
            $this->insert($datos);
        }
    }
    
    /**
     * Almacena un dato de un idioma determinado
     *
     * @return array de datos de plantilla
     */
    
    function save_datos_idiomas($lugar_interes_id,$datos)
    {
        foreach ($datos as $key => $value)
        {         
            // keys
            $value['idioma_id']=$key;
            $value['lugar_interes_id']=$lugar_interes_id;
            // Save
            $this->save($value,$key,$lugar_interes_id);
        }
    }
    
    /**
     * Almacena un dato de un idioma determinado
     *
     * @return array de datos de plantilla
     */
    
    function get_info_idiomas_by_lugar_interes($id)
    {
        $this->db->select();
        $this->db->from($this->table);
        $this->db->where('lugar_interes_id',$id);
        $results=$this->db->get()->result();
        if($results)
        {
            $array=array();
            foreach($results as $result)
            {
                $array[$result->idioma_id]=$result;
            }
        }
        return $array;
    }

}
