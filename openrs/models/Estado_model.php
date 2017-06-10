<?php defined('BASEPATH') OR exit('No direct script access allowed');

require_once APPPATH . 'core/MY_Model.php';

class Estado_model extends MY_Model
{

    public function __construct()
    {
        $this->table = 'estados';
        $this->primary_key = 'id';
        $this->has_many['inmuebles'] = array('local_key'=>'id', 'foreign_key'=>'estado_id', 'foreign_model'=>'Inmueble_model');       

        parent::__construct();
    }

    /**
     * Devuelve un array de datos en formato dropdown
     *
     * @return array de datos en formato dropdown
     */
    
    function get_estados_dropdown($ambito,$default_value="")
    {
        // Array de datos
        $datos_dropdown=$this->as_dropdown('nombre')->get_all(array("ambito" => $ambito));
        // Selección inicial
        $seleccion[$default_value]="- Seleccione estado -";
        // Suma de ambos
        return ($seleccion+$datos_dropdown);
    }
    
    /**
     * Devuelve el identificador de un estado que coincida con el nombre suministrado
     *
     * @param	[nombre_estado]   Nombre del estado
     * 
     * @return identificador del estado
     */
    
    function get_id_by_nombre($nombre_estado)
    {
        $this->db->select($this->table.'.id');
        $this->db->from($this->table);
        $this->db->where('nombre', $nombre_estado);
        $query = $this->db->get();
        $row = $query->row();
        if ($row) {
            return $row->id;
        } else {
            return NULL;
        }
    }
    
}
