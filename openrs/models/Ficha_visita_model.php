<?php defined('BASEPATH') OR exit('No direct script access allowed');

require_once APPPATH . 'core/MY_Model.php';

class Ficha_visita_model extends MY_Model
{

    public function __construct()
    {
        parent::__construct();
        
        $this->table = 'fichas_visita';
        $this->primary_key = 'id';
    }
    

}
