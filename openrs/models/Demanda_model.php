<?php defined('BASEPATH') OR exit('No direct script access allowed');

require_once APPPATH . 'core/MY_Model.php';

class Demanda_model extends MY_Model
{

    public function __construct()
    {
        $this->table = 'demandas';
        $this->primary_key = 'id';
        
        parent::__construct();
    }
    
}
