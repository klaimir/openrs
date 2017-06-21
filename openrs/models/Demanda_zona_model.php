<?php defined('BASEPATH') OR exit('No direct script access allowed');

require_once APPPATH . 'core/MY_Model.php';

class Demanda_zona_model extends MY_Model
{

    public function __construct()
    {
        $this->table = 'demandas_poblaciones_zonas';
        $this->primary_key = 'id';
        
        parent::__construct();        
    }
    
    /**
     * Almacena un dato de un idioma determinado
     *
     * @return array de datos de plantilla
     */
    
    function get_zonas_demanda($id)
    {
        $this->db->select();
        $this->db->from($this->table);
        $this->db->where('demanda_id',$id);
        $results=$this->db->get()->result();
        $array=array();
        if($results)
        {            
            foreach($results as $result)
            {
                $array[]=$result->zona_id;
            }
        }
        return $array;
    }

}
