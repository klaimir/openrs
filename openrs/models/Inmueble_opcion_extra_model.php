<?php defined('BASEPATH') OR exit('No direct script access allowed');

require_once APPPATH . 'core/MY_Model.php';

class Inmueble_opcion_extra_model extends MY_Model
{

    public function __construct()
    {
        $this->table = 'inmuebles_opciones_extras';
        $this->primary_key = 'id';        

        parent::__construct();
    }
    
    /**
     * Marca o desmarca una opción extra para un inmueble en concreto
     *
     * @param [inmueble_id]             Indentificador del inmueble
     * @param [opcion_extra_id]         Indentificador de la opción extra
     * @param [marcar]                  1 si tiene que marcar la opción en el inmueble, 0 en caso contrario
     *
     * @return void
     */
    
    function marcar($inmueble_id,$opcion_extra_id,$marcar)
    {
        // Comprobar si existe
         $where=array("inmueble_id" => $inmueble_id, "opcion_extra_id" => $opcion_extra_id);
         $datos_bd=$this->get($where);
        // Si hay que marcar
        if($marcar)
        {
            // OK
            if($datos_bd)
            {
                return TRUE;
            }
            // En caso contrario, insert
            else
            {
                return $this->insert($where);
            }
        }
        else
        {
            // Delete
            if($datos_bd)
            {
                return $this->delete($where);
            }
            // En caso contrario, OK
            else
            {
                return TRUE;
            }
        }
    }
    
    /**
     * Devuelve las opciones extras seleccionadas para un inmueble determinado
     *
     * @param [$inmueble_id]		Identificador del inmueble
     * 
     * @return Array con las opciones extras seleccionadas
     */
    
    function get_opciones_extras_inmueble($inmueble_id)
    {
        // Consulta
        $this->db->select('opcion_extra_id');
        $this->db->from($this->table);       
        $this->db->where("inmueble_id",$inmueble_id);
        $results=$this->db->get()->result();
        // Array de resultados
        $datos=array();
        // Resultado
        if($results)
        {
            foreach ($results as $result)
            {
                array_push($datos, $result->opcion_extra_id);
            }
        }
        return $datos;
    }

}
