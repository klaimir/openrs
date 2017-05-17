<?php defined('BASEPATH') OR exit('No direct script access allowed');

require_once APPPATH . '/core/MY_Model.php';

class Inmueble_opcion_extra_model extends MY_Model
{

    public function __construct()
    {
        $this->table = 'inmuebles_opciones_extras';
        $this->primary_key = 'id';        

        parent::__construct();
    }

}
