<?php defined('BASEPATH') OR exit('No direct script access allowed');

require_once APPPATH . '/core/MY_Model.php';

class Inmueble_lugar_interes_model extends MY_Model
{

    public function __construct()
    {
        $this->table = 'inmuebles_lugares_interes';
        $this->primary_key = 'id';        

        parent::__construct();
    }

}
