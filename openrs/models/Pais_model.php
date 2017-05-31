<?php defined('BASEPATH') OR exit('No direct script access allowed');

require_once APPPATH . 'core/MY_Model.php';

class Pais_model extends MY_Model
{

    public function __construct()
    {
        $this->table = 'paises';
        $this->primary_key = 'id';
        
        parent::__construct();
    }
    
    /**
     * Devuelve un array de paises en formato dropdown
     *
     * @return array de paises en formato dropdown
     */
    
    function get_paises_dropdown($default_value="")
    {
        // Array de paises
        $paises=$this->as_dropdown('nombre')->get_all();
        // Selección inicial
        $seleccion[$default_value]="- Seleccione pais -";
        // Suma de ambos
        return ($seleccion+$paises);
    }    
    
    /**
     * Devuelve el identificador de un pais que coincida con el nombre suministrado
     *
     * @param	[nombre_pais]   Nombre del pais
     * 
     * @return identificador del pais
     */
    
    function get_id_by_nombre($nombre_pais)
    {
        $this->db->select($this->table.'.id');
        $this->db->from($this->table);
        $this->db->where('nombre', $nombre_pais);
        $query = $this->db->get();
        $row = $query->row();
        if ($row) {
            return $row->id;
        } else {
            return NULL;
        }
    }
}
