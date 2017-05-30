<?php defined('BASEPATH') OR exit('No direct script access allowed');

require_once APPPATH . 'core/MY_Model.php';

class Marca_documentacion_model extends MY_Model
{

    public function __construct()
    {
        $this->table = 'marcas_documentacion';
        $this->primary_key = 'id';
        
        parent::__construct();
    }

}
