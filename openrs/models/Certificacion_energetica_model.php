<?php defined('BASEPATH') OR exit('No direct script access allowed');

require_once APPPATH . 'core/MY_Model.php';

class Certificacion_energetica_model extends MY_Model
{

    public function __construct()
    {
        $this->table = 'tipos_certificacion_energetica';
        $this->primary_key = 'id';
        $this->has_many['inmuebles'] = array('local_key'=>'id', 'foreign_key'=>'certificacion_energetica_id', 'foreign_model'=>'Inmueble_model');       

        parent::__construct();
    }

    /**
     * Devuelve un array de datos en formato dropdown
     *
     * @return array de datos en formato dropdown
     */
    
    function get_tipos_certificacion_energetica_dropdown($default_value="")
    {
        // Array de datos
        $datos_dropdown=$this->as_dropdown('nombre')->get_all();
        // Selección inicial
        $seleccion[$default_value]="- Seleccione certificación -";
        // Suma de ambos
        return ($seleccion+$datos_dropdown);
    }
    
    /**
     * Devuelve el identificador de una certificación energética que coincida con el nombre suministrado
     *
     * @param	[nombre_certificacion_energetica]   Nombre del certificacion_energetica
     * 
     * @return identificador del certificacion_energetica
     */
    
    function get_id_by_nombre($nombre_certificacion_energetica)
    {
        $this->db->select($this->table.'.id');
        $this->db->from($this->table);
        $this->db->where('nombre', $nombre_certificacion_energetica);
        $query = $this->db->get();
        $row = $query->row();
        if ($row) {
            return $row->id;
        } else {
            return NULL;
        }
    }
    
}
