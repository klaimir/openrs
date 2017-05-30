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
}
