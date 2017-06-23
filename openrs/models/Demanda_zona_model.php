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

    /**
     * Devuelve las zonas asignados a una demanda
     *
     * @param	[$demanda_id]   Identificador de la demanda
     * 
     * @return String con las zonas seperados por , si existe o NULL en caso contrario
     */
    
    function get_nombres_zonas_demanda($demanda_id)
    {
        // Consulta
        $this->db->select('poblaciones_zonas.nombre');
        $this->db->from($this->table);        
        $this->db->join('poblaciones_zonas', 'poblaciones_zonas.id = '.$this->table.'.zona_id');
        $this->db->where('demanda_id',$demanda_id);
        $query = $this->db->get();
        $results = $query->result();
        // Formateamos los resultados
        if ($results) {
            $array=array();      
            foreach($results as $result)
            {
                $array[]=$result->nombre;
            }
            return implode(', ', $array);
        } else {
            return NULL;
        }
    }
    
}
