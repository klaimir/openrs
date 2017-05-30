<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require_once APPPATH . '/core/MY_Controller.php';

class Upload extends MY_Controller
{

    function __construct()
    {
        parent::__construct();

        // Secure the access
        $this->_security();

        $this->load->library('unit_test');
        
        $str = '
        <table border="0" cellpadding="4" cellspacing="1">
        {rows}
        <tr>
        <td>{item}</td>
        <td>{result}</td>
        </tr>
        {/rows}
        </table>';

        $this->unit->set_template($str);
        
        // Comprobación de acceso
        //$this->utilities->check_security_access_perfiles_or(array("session_es_admin"));
    }

    public function index()
    {
        $this->load->view('test/upload/form', array('error' => ' '));
    }

    public function do_upload()
    {
        $config['upload_path'] = './uploads/';
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size'] = 500;
        $config['max_width'] = 1024;
        $config['max_height'] = 768;

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('userfile'))
        {
            $error = array('error' => $this->upload->display_errors());

            $this->load->view('test/upload/form', $error);
        }
        else
        {
            $data = array('upload_data' => $this->upload->data());

            $this->load->view('test/upload/success', $data);
        }
    }
    
    public function encrypt()
    {
        $this->load->view('test/upload/form_encrypt', array('error' => ' '));
    }

    public function do_upload_encrypt()
    {
        $config['upload_path'] = './uploads/';
        $config['allowed_types'] = '*';
        $config['max_size'] = 500;
        $config['encrypt_name'] = TRUE;        

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('userfile'))
        {
            $error = array('error' => $this->upload->display_errors());
            var_dump($this->upload->data());

            $this->load->view('test/upload/form_encrypt', $error);
        }
        else
        {
            $data = array('upload_data' => $this->upload->data());

            $this->load->view('test/upload/success', $data);
        }
    }
    
    public function multiple()
    {
        $this->load->view('test/upload/form_multiple', array('error' => ' '));
    }

    public function do_upload_multiple()
    {
        $config['upload_path'] = './uploads/';
        $config['allowed_types'] = '*';
        $config['max_size'] = 2000;   
        $config['overwrite'] = TRUE;        

        $this->load->library('upload', $config);

        if (!$this->upload->do_multi_upload('userfile'))
        {
            $error = array('error' => $this->upload->display_errors());
            var_dump($this->upload->data());

            $this->load->view('test/upload/form_multiple', $error);
        }
        else
        {
            $data = array('upload_data' => $this->upload->data());
            var_dump($this->upload->data());
            $this->load->view('test/upload/success', $data);
        }
    }

}
