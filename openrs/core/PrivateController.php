<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once APPPATH.'/core/BaseController.php';

class PrivateController extends BaseController {

	public function initialize()
	{
        $this->load->database();		
		$this->load->helper(array('url','language','date_helper'));
		//$this->load->model('Users_Model');
		$this->lang->load('auth');
        
        $this->data['session_logged_in'] = true;
        $this->data['session_user_id'] = $this->session->userdata('user_id');
        $this->data['session_user_name'] = $this->session->userdata('username');
        $this->data['session_user_group'] = $this->ion_auth->get_users_groups()->row()->id;
    }
    
    public function __construct() {
        parent::__construct();
        
        $this->load->library(array('ion_auth','form_validation'));
        
        if($this->config->item('mantenimiento')) {         
            redirect(site_url('auth/mantenimiento'), 'refresh');
            return;
        }
        
        // logged
        if ($this->ion_auth->logged_in())
        {            
            $this->initialize();
        }
        else
        {
            redirect(site_url('auth/logout'), 'refresh');            
        }
    }

}