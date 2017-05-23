<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require_once APPPATH . '/core/MY_Controller.php';

class Google_maps extends MY_Controller
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

    function test()
    {
        // Load the library
        $this->load->library('googlemaps');
        
        $config=array();
        $config['center']='Avenida Ana de Viya, 3, Cádiz, Cádiz, Spain';
        $config['zoom']=15;        
        // Initialize our map. Here you can also pass in additional parameters for customising the map (see below)
        $this->googlemaps->initialize($config);
        
        // Marker
        $marker=array();
        $marker['position']='Avenida Ana de Viya, 3, Cádiz, Cádiz, Spain';
        $this->googlemaps->add_marker($marker);
        
        // Marker
        $marker2=array();
        $marker2['position']='Calle Pablo Ruiz Picasso, 4, Cádiz, Cádiz, Spain';
        $marker2['infowindow_content']='<img class="nav-user-photo" src="http://[::1]/openrs/assets/admin/avatars/user.jpg" alt="Jason Photo">'
            . '<br>La casa de mis padres'
            . '<br><a href="#">Solicitar información</a>';
        $this->googlemaps->add_marker($marker2);
        
        // Create the map. This will return the Javascript to be included in our pages <head></head> section and the HTML code to be
        // placed where we want the map to appear.
        $this->data['map'] = $this->googlemaps->create_map();
        
        // Load our view, passing the map data that has just been created
        $this->load->view('test/google_maps/test', $this->data);
    }
    
    function directions()
    {
        // Load the library
        $this->load->library('googlemaps');       
        
        $this->output->enable_profiler(FALSE);
        
        //$config['center'] = 'Calle Pablo Ruiz Picasso, 4, Cádiz, Cádiz, Spain';
        $config['zoom'] = 'auto';
        $config['directions'] = TRUE;
        $config['directionsStart'] = 'Calle Pablo Ruiz Picasso, 4, Cádiz, Cádiz, Spain';
        $config['directionsEnd'] = 'Avenida Ana de Viya, 3, Cádiz, Cádiz, Spain';
        $config['directionsDivID'] = 'directionsDiv';
        $this->googlemaps->initialize($config);
        
        // Create the map. This will return the Javascript to be included in our pages <head></head> section and the HTML code to be
        // placed where we want the map to appear.
        $this->data['map'] = $this->googlemaps->create_map();
        
        // Load our view, passing the map data that has just been created
        $this->load->view('test/google_maps/directions', $this->data);
    }
    
}
