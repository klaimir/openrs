<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require_once APPPATH . 'core/MY_Controller.php';

class Clientes extends MY_Controller
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
        
        $this->load->model('Cliente_model');
    }
    
    function propietarios($tipo_oferta,$historico=0)
    {
        $this->load->model('Cliente_Inmueble_model');
        var_dump($this->Cliente_Inmueble_model->get_ids_clientes($tipo_oferta,$historico));
    }

    function general()
    {
        // Realizamos test con todas las combinaciones porque el validation fallaba        
        $nombre = 'Fotografías';
        $descripcion = 'Descripción';        
        $_POST['nombre']=$nombre;
        $_POST['descripcion']=$descripcion;
        
        // Validation Insert (FALSE)
        $this->form_validation->reset_validation();
        $this->form_validation->set_data($_POST);
        $result_validation_insert=$this->Cliente_model->validation(); 
        $this->unit->run(FALSE, $result_validation_insert, 'Test de validación al insertar 1');

        $nombre2 = 'Nombre fichero';
        $descripcion2 = 'Descripción';        
        $_POST['nombre']=$nombre2;
        $_POST['descripcion']=$descripcion2;
        
        // Validation Insert (TRUE)
        $this->form_validation->reset_validation();
        // Esta linea hay que añadirla para que pille bien los datos de validación
        $this->form_validation->set_data($_POST);
        $result_validation_insert2=$this->Cliente_model->validation(); 
        $this->unit->run(TRUE, $result_validation_insert2, 'Test de validación al insertar 2');
                    
        // Insert
        $datos_formateados = $this->Cliente_model->get_formatted_datas();
        $id=$this->Cliente_model->insert($datos_formateados);
        
        $datos_bd_insert=$this->Cliente_model->get_by_id($id);
        
        $this->unit->run($datos_bd_insert->nombre, $nombre2, 'Test de nombre al insertar');
        $this->unit->run($datos_bd_insert->descripcion, $descripcion2, 'Test de descripción al insertar');
        
        // Validation update (FALSE)
        $nombre_edit = 'Nombre fichero';
        $descripcion_edit = 'Descripción';        
        $_POST['nombre']=$nombre_edit;
        $_POST['descripcion']=$descripcion_edit;
        
        $this->form_validation->reset_validation();
        $this->form_validation->set_data($_POST);
        $result_validation_edit=$this->Cliente_model->validation($id);
        
        $this->unit->run(FALSE, $result_validation_edit, 'Test de validación al update 1');
        
        // Update
        $nombre_edit2 = 'Nombre fichero2';
        $descripcion_edit2 = 'Descripción2';        
        $_POST['nombre']=$nombre_edit2;
        $_POST['descripcion']=$descripcion_edit2;
        
        $this->form_validation->reset_validation();
        $this->form_validation->set_data($_POST);
        $result_validation_edit2=$this->Cliente_model->validation($id);
        
        $this->unit->run(TRUE, $result_validation_edit2, 'Test de validación al update 2');
        
        $datos_formateados2 = $this->Cliente_model->get_formatted_datas();
        $affected=$this->Cliente_model->update($datos_formateados2,$id);
        
        $datos_bd_edit2=$this->Cliente_model->get_by_id($id);
        
        $this->unit->run($affected, 1, 'Test de nombre (affected)');
        $this->unit->run($datos_bd_edit2->nombre, $nombre_edit2, 'Test de nombre (update)');
        $this->unit->run($datos_bd_edit2->descripcion, $descripcion_edit2, 'Test de descripción (update)');

        // Delete        
        $result_validation_delete=$this->Cliente_model->delete($id);
        $this->unit->run($result_validation_delete, 1, 'Test de delete');

        // The report will be formatted in an HTML table for viewing. If you prefer the raw data you can retrieve an array using:
        var_dump($this->unit->result());
    }

}
