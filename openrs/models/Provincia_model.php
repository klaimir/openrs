<?php defined('BASEPATH') OR exit('No direct script access allowed');

require_once APPPATH . 'core/MY_Model.php';

class Provincia_model extends MY_Model
{

    public function __construct()
    {
        $this->table = 'provincias';
        $this->primary_key = 'id';
        $this->has_many['poblaciones'] = array('local_key'=>'id', 'foreign_key'=>'provincia_id', 'foreign_model'=>'Poblacion_model');
        
        parent::__construct();
        
        // Carga del modelo
        $this->load->model('Poblacion_model');
    }
    
    /************************* SECURITY *************************/
    
    public function check_access_conditions($datos)
    {
        return TRUE;
    }
    
    /**
     * Devuelve un array de provincias en formato dropdown
     *
     * @return array de provincias en formato dropdown
     */
    
    function get_provincias_dropdown($default_value="", $text_value="- Seleccione provincia -")
    {
        // Array de provincias
        $provincias=$this->as_dropdown('provincia')->get_all();
        // Selección inicial
        $seleccion[$default_value]=$text_value;
        // Si devolvemos un merge se pierden las claves numéricas
        // http://php.net/manual/es/function.array-merge.php
        // return array_merge($seleccion,$provincias);
        // Por tanto devolvemos el operador suma para que mantenga las claves numéricas
        return ($seleccion+$provincias);
    }
    
    /**
     * Consulta las provincias
     *
     * @param [$ids_provincias]                  Array de provincia
     *
     * @return array de provincias
     */

    function get_provincias_in_array($ids_provincias)
    {
        // Consulta
        $this->db->from($this->table);
        if(count($ids_provincias))
        {
            $this->db->where_in($this->primary_key, $ids_provincias);
        }
        else
        {
            $this->db->where($this->primary_key, 0);
        }
        return $this->db->get()->result();
    }
    
    /**
     * Devuelve el identificador de un provincia que coincida con el nombre suministrado
     *
     * @param	[nombre_provincia]   Nombre del provincia
     * 
     * @return identificador del provincia
     */
    
    function get_id_by_nombre($nombre_provincia)
    {
        $this->db->select($this->table.'.id');
        $this->db->from($this->table);
        $this->db->where('provincia', $nombre_provincia);
        $query = $this->db->get();
        $row = $query->row();
        if ($row) {
            return $row->id;
        } else {
            return NULL;
        }
    }
    
}
