<?php defined('BASEPATH') OR exit('No direct script access allowed');

require_once APPPATH . 'core/MY_Model.php';

class Inmueble_demanda_model extends MY_Model
{

    public function __construct()
    {
        parent::__construct();
        
        $this->table = 'inmuebles_demandas';
        $this->view = 'v_inmuebles_demandas';
        $this->primary_key = 'id';
    }
    
    
    /**
     * Comprueba que ningún inmueble ya está asociado al demanda
     *
     * @param [$demanda_id]                 Identificador del inmueble
     * @param [$inmuebles]                  Array de identificadores de demandas seleccionados
     *
     * @return TRUE OR FALSE
     */
    function check_exists_inmuebles_demanda($demanda_id,$inmuebles)
    {        
        $this->db->select('id');
        $this->db->from($this->table);
        $this->db->where("demanda_id",$demanda_id);
        $this->db->where_in("inmueble_id",$inmuebles);
        $result=$this->db->get()->result();
        // Si existen
        if ($result)
        {
            return TRUE;
        }
        else
        {
            return FALSE;
        }
    }
    
    /**
     * Devuelve los inmuebles demandados por un demanda en un idioma determinado
     *
     * @param [$demanda_id]		Identificador del demanda
     * @param [$id_idioma]		Identificador del idioma
     * 
     * @return Array con la información del inmueble y la demanda asociada
     */
    
    function get_view_inmuebles_demanda($demanda_id,$id_idioma=NULL)
    {
        // Si el idioma es NULL, consultamos el de la sesion
        if(is_null($id_idioma))
        {
            $id_idioma = $this->data['session_id_idioma'];
        }
        // Consulta
        $fieldslist=$this->utilities->getFieldsTable($this->view); 
        $this->db->select($fieldslist);
        $this->db->from('v_inmuebles_demandas');
        $this->db->where("idioma_id",$id_idioma);
        $this->db->where("demanda_id",$demanda_id);
        return $this->db->get()->result();
    }
    
}
