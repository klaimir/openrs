<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require_once APPPATH . '/core/MY_Controller.php';

class Test extends MY_Controller
{

    function __construct()
    {
        parent::__construct();

        // Secure the access
        $this->_security();

        $this->load->library('unit_test');
       
    }

    function kcfinder()
    {
        # Variables de sesion de KCFinder, deben declararse al hacer LogIn con un usuario
        $_SESSION['KCFINDER'] = array();
        $_SESSION['KCFINDER']['disabled'] = false;

        # Al hacer LogOut deberíamos cambiar disabled a true: $_SESSION['KCFINDER']['disabled'] = true;
        $this->load->library('ckeditor', array('instanceName' => 'CKEDITOR1', 'basePath' => base_url() . "assets/admin/ckeditor/", 'outPut' => true));

        # Cargamos la vista
        $this->render_private('test/ckeditor', $this->data);
    }

    function load_example()
    {
        //$this->load->model('Usuario_model');
        // Es sensible a mayúsculas
        //echo $this->usuarios_model->get_lang(1);
        //echo $this->Usuario_model->get_lang(1);

        $test = $this->Usuario_model->get_lang(1);

        $expected_result = 'English';

        $this->unit->run($test, $expected_result, 'Test de idioma');

        echo $this->unit->report();

        // The report will be formatted in an HTML table for viewing. If you prefer the raw data you can retrieve an array using:
        var_dump($this->unit->result());
        $array_results = $this->unit->result();
        $result = $array_results[0]['Result'];

        if ($result == 'Passed')
        {
            echo "MARAVILLA¡¡";
        }
        else
        {
            echo "PLOOOFF";
        }
    }

    function validation()
    {
        if ($this->is_post())
        {
            /*             * ************* RULES ************* */
            $rules_first_name = array(
                'required',
                array('test_names', array($this->Usuario_model, 'test_names'))
            );
            $this->form_validation->set_rules('first_name', $this->lang->line('create_user_validation_fname_label'), $rules_first_name);
            $this->form_validation->set_rules('last_name', 'Apellidos', 'required');

            /*             * ************* DATAS ************* */
            /*
              $data = array(
              'first_name' => '',
              'last_name' => ''
              ); */
            $data = $this->input->post();
            $data['validation_datas_test_names'] = array('first_name' => $data['first_name'], 'last_name' => $data['last_name']);
            $this->form_validation->set_data($data);

            /*             * ************* CHECK ************* */
            if ($this->form_validation->run() == true)
            {
                $this->session->set_flashdata('message', 'NICEEEEEE¡¡');
                redirect("usuarios/test", 'refresh');
            }
            else
            {
                $this->data['message'] = validation_errors();
            }
        }

        $this->data['first_name'] = array(
            'name' => 'first_name',
            'id' => 'first_name',
            'type' => 'text',
            'value' => $this->form_validation->set_value('first_name'),
        );

        $this->data['last_name'] = array(
            'name' => 'last_name',
            'id' => 'last_name',
            'type' => 'text',
            'value' => $this->form_validation->set_value('last_name'),
        );

        // Render
        $this->render_private('admin/test', $this->data);
    }

    public function email()
    {
        $this->load->library('email');
        $config = Array(
            'protocol' => 'smtp',
            'smtp_host' => 'ssl://smtp.googlemail.com',
            'smtp_port' => 465,
            'smtp_user' => 'angel.berasuain@gmail.com',
            'smtp_pass' => 'BreakbeaT',
            'mailtype' => 'html',
            'charset' => 'UTF-8'
        );
        $this->email->initialize($config);
        $this->email->set_newline("\r\n");


        //$message = $this->load->view($this->config->item('email_templates', 'ion_auth').$this->config->item('email_forgot_password', 'ion_auth'), $data, true);
        $message = "HOLA";
        $this->email->clear();
        $this->email->from('angel.berasuain@gmail.com', 'OPENRS');
        $this->email->to('angel.berasuain@gmail.com');
        $this->email->subject('Correo');
        $this->email->message($message);

        $this->email->send();
        echo $this->email->print_debugger();
    }

}
