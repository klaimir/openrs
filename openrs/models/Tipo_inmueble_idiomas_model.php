<?php defined('BASEPATH') OR exit('No direct script access allowed');

require_once APPPATH . 'core/MY_Model.php';

class Tipo_inmueble_idiomas_model extends MY_Model
{

    public function __construct()
    {
        $this->table = 'tipos_inmueble_idiomas';
        $this->primary_key = 'id';
        
        parent::__construct();        
    }
    
    /**
     * Almacena un dato de un idioma determinado
     *
     * @return array de datos de plantilla
     */
    
    function save($datos,$idioma_id,$tipo_inmueble_id)
    {
        // Comprobar si existe
        $where=array("idioma_id" => $idioma_id, "tipo_inmueble_id" => $tipo_inmueble_id);
        $datos_bd=$this->get($where);
        // Update
        if($datos_bd)
        {
            $this->update($datos, $datos_bd->id);
        }
        // En caso contrario, insert
        else
        {
            $this->insert($datos);
        }
    }
    
    /**
     * Almacena un dato de un idioma determinado
     *
     * @return array de datos de plantilla
     */
    
    function save_datos_idiomas($tipo_inmueble_id,$datos)
    {
        foreach ($datos as $key => $value)
        {         
            // keys
            $value['idioma_id']=$key;
            $value['tipo_inmueble_id']=$tipo_inmueble_id;
            // Save
            $this->save($value,$key,$tipo_inmueble_id);
        }
    }
    
    /**
     * Consulta los nombres que tiene un determinado inmueble en todos los idiomas
     *
     * @return array de datos de plantilla
     */
    
    function get_info_idiomas_by_tipo_inmueble($id)
    {
        $this->db->select();
        $this->db->from($this->table);
        $this->db->where('tipo_inmueble_id',$id);
        $results=$this->db->get()->result();
        if($results)
        {
            $array=array();
            foreach($results as $result)
            {
                $array[$result->idioma_id]=$result;
            }
        }
        return $array;
    }
    
    /**
     * Devuelve el identificador de un tipo de inmueble que coincida con el nombre suministrado
     *
     * @param	[nombre_tipo_inmueble]   Nombre del tipo_inmueble
     * 
     * @return identificador del tipo_inmueble
     */
    
    function get_id_by_nombre($nombre_tipo_inmueble, $idioma_id=NULL)
    {
        // Idioma
        if (is_null($idioma_id))
        {
            $idioma_id=$this->data['session_id_idioma'];
        }
        // Consulta
        $this->db->select($this->table.'.tipo_inmueble_id');
        $this->db->from($this->table);
        $this->db->where('nombre', $nombre_tipo_inmueble);
        $this->db->where('idioma_id', $idioma_id);
        $query = $this->db->get();
        $row = $query->row();
        if ($row) {
            return $row->tipo_inmueble_id;
        } else {
            return NULL;
        }
    }

}
