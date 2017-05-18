<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require_once APPPATH . '/core/MY_Controller.php';

class QR extends MY_Controller
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
        $this->utilities->check_security_access_perfiles_or(array("session_es_admin"));
    }

    function live()
    {
        $this->load->library('ciqrcode');

        header("Content-Type: image/png");
        $params['data'] = 'This is a text to encode become QR Code';
        $this->ciqrcode->generate($params);
    }

    function save()
    {
        $this->load->library('ciqrcode');

        $params['data'] = 'http://www.prueba.com';
        $params['level'] = 'H';
        $params['size'] = 10;
        $params['savename'] = FCPATH.'downloads/tes.png';
        $this->ciqrcode->generate($params);

        echo '<img src="'.base_url('downloads/tes.png').'">IMAGEN</img>';
    }

    function config()
    {
        $this->load->library('ciqrcode');

        $config['cacheable']            = true; //boolean, the default is true
        //$config['cachedir']		= 'openrs/cache'; //string, the default is application/cache/
        //$config['errorlog']		= 'openrs/logs'; //string, the default is application/logs/
        $config['quality']		= true; //boolean, the default is true
        $config['size']			= ''; //interger, the default is 1024
        $config['black']		= array(224,255,255); // array, default is array(255,255,255)
        $config['white']		= array(70,130,180); // array, default is array(0,0,0)
        $this->ciqrcode->initialize($config);

        $params['data'] = 'http://openrs.com/rota/casa-playa';
        $params['level'] = 'H';
        $params['size'] = 10;
        $params['savename'] = FCPATH.'downloads/prueba.png';
        $this->ciqrcode->generate($params);

        echo '<img src="'.base_url('downloads/prueba.png').'">IMAGEN</img>';
    }   
    
}
