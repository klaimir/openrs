<?php defined('BASEPATH') OR exit('No direct script access allowed');

require_once APPPATH . 'core/MY_Model.php';

class Demanda_tipo_inmueble_model extends MY_Model
{

    public function __construct()
    {
        $this->table = 'demandas_tipos_inmueble';
        $this->primary_key = 'id';
        
        parent::__construct();        
    }
    
    /**
     * Almacena un dato de un idioma determinado
     *
     * @return array de datos de plantilla
     */
    
    function get_tipos_inmuebles_demanda($id)
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
                $array[]=$result->tipo_id;
            }
        }
        return $array;
    }
    
    /**
     * Devuelve los tipos de inmuebles asignados a una demanda en un idioma determinado
     *
     * @param	[$demanda_id]   Identificador de la demanda
     * 
     * @return String con los tipos de inmuebles seperados por , si existe o NULL en caso contrario
     */
    
    function get_nombres_tipos_inmuebles_demanda($demanda_id, $idioma_id=NULL)
    {
        // Idioma
        if (is_null($idioma_id))
        {
            $idioma_id=$this->data['session_id_idioma'];
        }
        // Consulta
        $this->db->select('tipos_inmueble_idiomas.nombre');
        $this->db->from($this->table);
        $this->db->join('tipos_inmueble_idiomas', 'tipos_inmueble_idiomas.tipo_inmueble_id = '.$this->table.'.tipo_id')->where('idioma_id', $idioma_id);
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
