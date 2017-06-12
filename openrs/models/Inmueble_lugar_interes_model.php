<?php defined('BASEPATH') OR exit('No direct script access allowed');

require_once APPPATH . 'core/MY_Model.php';

class Inmueble_lugar_interes_model extends MY_Model
{

    public function __construct()
    {
        $this->table = 'inmuebles_lugares_interes';
        $this->primary_key = 'id';        

        parent::__construct();
    }
    
    /**
     * Marca o desmarca un lugar de interés para un inmueble en concreto
     *
     * @param [inmueble_id]             Indentificador del inmueble
     * @param [lugar_interes_id]        Indentificador del lugar de interés
     * @param [marcar]                  1 si tiene que marcar la opción en el inmueble, 0 en caso contrario
     *
     * @return void
     */
    
    function marcar($inmueble_id,$lugar_interes_id,$marcar)
    {
        // Comprobar si existe
         $where=array("inmueble_id" => $inmueble_id, "lugar_interes_id" => $lugar_interes_id);
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
     * Devuelve los lugares de interes seleccionados para un inmueble determinado
     *
     * @param [$inmueble_id]		Identificador del inmueble
     * 
     * @return Array con las opciones extras seleccionadas
     */
    
    function get_lugares_interes_inmueble($inmueble_id)
    {
        // Consulta
        $this->db->select('lugar_interes_id');
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
                array_push($datos, $result->lugar_interes_id);
            }
        }
        return $datos;
    }
}
