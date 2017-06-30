<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

if (!function_exists('array_to_csv_binary')) {

    function create_qr($data,$savename,$size=2)
    {
        $CI = & get_instance();
        
        $CI->load->library('ciqrcode');

        $config['cacheable']            = true; //boolean, the default is true
        //$config['cachedir']		= 'openrs/cache'; //string, the default is application/cache/
        //$config['errorlog']		= 'openrs/logs'; //string, the default is application/logs/
        $config['quality']		= true; //boolean, the default is true
        $config['size']			= ''; //interger, the default is 1024
        $config['black']		= array(224,255,255); // array, default is array(255,255,255)
        $config['white']		= array(70,130,180); // array, default is array(0,0,0)
        $CI->ciqrcode->initialize($config);

        $params['data'] = $data;
        $params['level'] = 'H';
        $params['size'] = $size;
        $params['savename'] = $savename;
        $CI->ciqrcode->generate($params);
    }
}
