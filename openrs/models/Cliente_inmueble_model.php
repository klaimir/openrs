<?php defined('BASEPATH') OR exit('No direct script access allowed');

require_once APPPATH . 'core/MY_Model.php';

class Cliente_Inmueble_model extends MY_Model
{

    public function __construct()
    {
        $this->table = 'clientes_inmuebles';
        $this->primary_key = 'id';
        
        parent::__construct();
    }
    
    /**
     * Comprueba que ningún cliente ya está asociado como propietario
     *
     * @param [$inmueble_id]                 Identificador del inmueble
     * @param [$clientes_seleccionados]      Array de identificadores de clientes seleccionados
     *
     * @return TRUE OR FALSE
     */
    function check_exists_clientes_inmueble($inmueble_id,$clientes)
    {        
        $this->db->select('id');
        $this->db->from($this->table);
        $this->db->where("inmueble_id",$inmueble_id);
        $this->db->where_in("cliente_id",$clientes);
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
     * Comprueba que ningún inmueble ya está asociado al cliente
     *
     * @param [$cliente_id]                 Identificador del inmueble
     * @param [$inmuebles]                  Array de identificadores de clientes seleccionados
     *
     * @return TRUE OR FALSE
     */
    function check_exists_inmuebles_cliente($cliente_id,$inmuebles)
    {        
        $this->db->select('id');
        $this->db->from($this->table);
        $this->db->where("cliente_id",$cliente_id);
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
}
