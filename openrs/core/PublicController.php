<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once APPPATH.'/core/BaseController.php';

class PublicController extends BaseController {
    
    var $config_template;
	
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        
        $this->config_template=array('menu_izquierda' => 'template', 'mostrar_copyright' => 0);
        $this->data['config_template']=$this->config_template;
	}

}