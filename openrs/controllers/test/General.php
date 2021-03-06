<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require_once APPPATH . 'core/MY_Controller.php';

class General extends MY_Controller
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
        
    function get_num_admins($user_id)
    { 
        echo $this->Usuario_model->get_num_admins($user_id);
    }
    
    function slugify()
    {        
        $test="Casa grande en pleno centro de Cádiz";
        var_dump($this->utilities->slugify($test));        
        $test2="i'm glad pep´s or ``sds";
        var_dump($this->utilities->slugify($test2));
        $test3="O´donnell bar I'm glad";
        var_dump($this->utilities->slugify($test3));
        
        var_dump(url_title( $test, '-', TRUE ));
        var_dump(url_title( $test2, '-', TRUE ));
        var_dump(url_title( $test3, '-', TRUE ));
    }
    
    function is_valid_youtube_url()
    {        
        $url = 'https://www.youtube.com/watch?v=hnkQNAhSZiU';
        $result_valid=$this->form_validation->is_valid_youtube_url($url);
        $this->unit->run(TRUE, $result_valid, "Test de url: $url válida");
        
        $url_no_valid = 'https://www.youtube.com/watch?v=asdasd';
        $result_no_valid=$this->form_validation->is_valid_youtube_url($url_no_valid);
        $this->unit->run(FALSE, $result_no_valid, "Test de url: $url NO válida");
        
        // The report will be formatted in an HTML table for viewing. If you prefer the raw data you can retrieve an array using:
        var_dump($this->unit->result());
    }
    
    function is_embeddable_youtube_url()
    {        
        $url = 'https://www.youtube.com/watch?v=hnkQNAhSZiU';
        $result_valid=$this->form_validation->is_embeddable_youtube_url($url);
        $this->unit->run(TRUE, $result_valid, "Test de url: $url válida");
        
        $url_no_valid = 'https://www.youtube.com/watch?v=asdasd';
        $result_no_valid=$this->form_validation->is_embeddable_youtube_url($url_no_valid);
        $this->unit->run(FALSE, $result_no_valid, "Test de url: $url NO válida");
        
        // The report will be formatted in an HTML table for viewing. If you prefer the raw data you can retrieve an array using:
        var_dump($this->unit->result());
    }
    
    function provincias_buscador()
    {
        // Carga del modelo
        $this->load->model('Provincia_model');
        $provincias=$this->Provincia_model->get_provincias_dropdown();  
        var_dump($provincias);
        echo form_dropdown('provincia_id',$provincias,4);
    }
    
    function validar_nif($nif, $idpais = 64, $id = 0)
    {
        $data = array('nif' => $nif);
        $this->form_validation->set_data($data);
        
        $this->form_validation->set_rules('nif', 'NIF/NIE/CIF', 'required|is_unique_global[clientes;' . $id . ';nif;id]|is_nif_valido[' . $idpais . ']|max_length[15]|xss_clean');
        
        if ($this->form_validation->run())
        {
            echo "OK";
        }
        else
        {
            echo validation_errors();
        }
    }

    function load()
    {
        // Carga del modelo
        $this->load->model('Provincia_model');
        // Carga del modelo
        $this->load->model('Poblacion_model');

        // Carga del modelo
        $this->load->model('Poblacion_model');

        // Carga del modelo
        $this->load->model('Provincia_model');

        // Por más cargas que hagas el objeto queda en memoria global, da igual donde hagas el load
        // El resto de cargas se ignoran

        var_dump($this->Provincia_model);
        var_dump($this->Poblacion_model);
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

    public function base_model()
    {
        $this->output->enable_profiler(TRUE);
        $this->load->model('test/user_model');
        $this->load->model('test/article_model');

        /*
          $data['user'] = $this->user_model->get(1);
          var_dump($data['user']);
          echo "HOLA";

          $data['user_with'] = $this->user_model->with_details('fields:first_name,last_name')->get(1);
          $data['user_with_count'] = $this->user_model->with_details('fields:*count*')->get(1);
          $data['user_where'] = $this->user_model->where('username', 'avenirer')->get();
          $data['user_where_pass'] = $this->user_model->where(array('username' => 'administrator', 'password' => 'mypass'))->get();
          $data['user_as_array'] = $this->user_model->as_array()->get(1);
          $data['users'] = $this->user_model->get_all();
          $data['users_with'] = $this->user_model->with_details('fields:first_name,last_name,address')->get_all();
          $data['users_with_count'] = $this->user_model->with_details('fields:*count*')->get_all();
          $data['users_with_count_many'] = $this->user_model->with_posts('fields:*count*')->get_all();
          $data['users_with_and_where'] = $this->user_model->with_details('fields:first_name,last_name,address', 'where:`user_details`.`first_name`=\'Admin\'')->get_all();
          $data['users_with_and_non_exclusive_where'] = $this->user_model->with_details('fields:first_name,last_name,address|non_exclusive_where:`user_details`.`first_name`=\'Admin\'')->get_all();
          $data['users_where_pass'] = $this->user_model->where(array('password' => 'nopass'))->get_all();
          $data['users_as_array'] = $this->user_model->as_array()->get_all();
          $data['users_as_dropdown'] = $this->user_model->as_dropdown('username')->get_all();
         * 
         */
        $data['articles_with_authors'] = $this->article_model->with_authors('fields:username')->get_all();
        //$data['articles_with_authors_and_cache'] = $this->article_model->with_authors('fields:username')->set_cache('articles_with_authors')->get_all();
        //$this->article_model->delete_cache('*');
        //$data['user_with'] = $this->user_model->with_details('fields:first_name,last_name')->set_cache('get_users_with_details')->get(1);
        var_dump($data['articles_with_authors']);
        //$this->load->view('test/base_model', $data);
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
            'charset' => 'UTF-8',
            'newline' => "\r\n"
        );
        $this->email->initialize($config);
        //$this->email->set_newline("\r\n");


        //$message = $this->load->view($this->config->item('email_templates', 'ion_auth').$this->config->item('email_forgot_password', 'ion_auth'), $data, true);
        $message = "email";
        $this->email->clear();
        $this->email->from('angel.berasuain@gmail.com', 'OPENRS - email');
        $this->email->to('angel.berasuain@gmail.com');
        $this->email->subject('Correo');
        $this->email->message($message);

        $this->email->send();
        echo $this->email->print_debugger();
    }
    
    public function sendmail()
    {
        $this->load->library('email');
        $config = Array(
            'protocol' => 'sendmail',
            'mailpath' => '/usr/sbin/sendmail',
            'wordwrap' => TRUE,
            'newline' => "\r\n",
            'mailtype' => 'html',
            'charset' => 'UTF-8'
        );
        $this->email->initialize($config);

        //$message = $this->load->view($this->config->item('email_templates', 'ion_auth').$this->config->item('email_forgot_password', 'ion_auth'), $data, true);
        $message = "SENDMAIL";
        $this->email->clear();
        $this->email->from('angel.berasuain@gmail.com', 'OPENRS - sendmail');
        $this->email->to('angel.berasuain@gmail.com');
        $this->email->subject('Correo');
        $this->email->message($message);

        $this->email->send();
        echo $this->email->print_debugger();
    }
    
    function error_db(){
        $this->db->select();
        $this->db->from('tabla_no_existe');
        $query = $this->db->get();
    }

}
