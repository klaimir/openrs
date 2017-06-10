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
     * Devuelve un array de tipos de inmuebles en formato dropdown
     *
     * @return array de tipos de inmuebles en formato dropdown
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
    
}
