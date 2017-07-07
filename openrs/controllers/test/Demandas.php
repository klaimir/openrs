<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require_once APPPATH . 'core/MY_Controller.php';

class Demandas extends MY_Controller
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

    function asignar_tipos_inmuebles($demanda_id)
    {
        // Realizamos test con todas las combinaciones porque el validation fallaba
        $this->load->model('Demanda_model');
        
        // Asignamos tipos de inmuebles a una demanda con inmuebles
        $tipos_inmuebles_seleccionados=array('3','1');        
        $this->Demanda_model->asignar_tipos_inmuebles($demanda_id,$tipos_inmuebles_seleccionados);
        
        // Rescatamos los tipos asignados
        $tipos_inmuebles_asignados=$this->Demanda_model->get_tipos_inmuebles_asignados($demanda_id);
        
        var_dump($tipos_inmuebles_seleccionados);
        var_dump($tipos_inmuebles_asignados);
        
        // Comparación
        $this->unit->run(TRUE, $tipos_inmuebles_seleccionados == $tipos_inmuebles_asignados, 'Validación de asignación de tipos de inmuebles');
        // The report will be formatted in an HTML table for viewing. If you prefer the raw data you can retrieve an array using:
        var_dump($this->unit->result());
    }
    
    function nombres_tipos_inmuebles_demanda($demanda_id)
    {
        // Realizamos test con todas las combinaciones porque el validation fallaba
        $this->load->model('Demanda_tipo_inmueble_model');
        
        // Asignamos tipos de inmuebles a una demanda con inmuebles      
        $result=$this->Demanda_tipo_inmueble_model->get_nombres_tipos_inmuebles_demanda($demanda_id);
        if($result)
        {
            echo $result;
        }
        else
        {
            echo "No existen tipos de inmuebles asociados";
        }
    }
    
    function check_inmuebles_coincidentes_filtros($demanda_id)
    {
        $this->load->model('Demanda_model');
        $this->Demanda_model->check_inmuebles_coincidentes_filtros($demanda_id);
    }
}
