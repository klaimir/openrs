<?php defined('BASEPATH') OR exit('No direct script access allowed');

require_once APPPATH . 'core/MY_Model.php';

class Demanda_model extends MY_Model
{

    public function __construct()
    {
        $this->table = 'demandas';
        $this->primary_key = 'id';
        
        parent::__construct();
    }
    
    /**
     * Devuelve los inmuebles demandados por un cliente en un idioma determinado
     *
     * @param [$cliente_id]		Identificador del cliente
     * @param [$id_idioma]		Identificador del idioma
     * 
     * @return Array con la información del inmueble y la demanda asociada
     */
    
    function get_inmuebles_demandados($cliente_id,$id_idioma=NULL)
    {
        // Si el idioma es NULL, consultamos el de la sesion
        if(is_null($id_idioma))
        {
            $id_idioma = $this->data['session_id_idioma'];
        }
        // Consulta
        $this->db->select('v_inmuebles.*, inmuebles_demandas.demanda_id');
        $this->db->from('v_inmuebles');
        $this->db->join('inmuebles_demandas', 'inmuebles_demandas.inmueble_id='.'v_inmuebles.id');
        $this->db->join('demandas', 'inmuebles_demandas.demanda_id='.'demandas.id');
        $this->db->where("idioma_id",$id_idioma);
        $this->db->where("cliente_id",$cliente_id);
        return $this->db->get()->result();
    }
    
}
