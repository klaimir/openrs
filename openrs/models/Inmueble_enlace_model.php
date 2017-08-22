<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require_once APPPATH . 'core/MY_Model.php';

class Inmueble_enlace_model extends MY_Model
{

    public $inmueble_id = NULL;

    public function __construct()
    {
        $this->table = 'inmuebles_enlaces';
        $this->primary_key = 'id';
        $this->has_one['inmueble'] = array('local_key' => 'id', 'foreign_key' => 'inmueble_id', 'foreign_model' => 'Inmueble_model');

        parent::__construct();

        // Carga del modelo
        $this->load->model('Inmueble_model');
    }

    /*     * *********************** SECURITY ************************ */

    public function check_access_conditions($datos)
    {
        return TRUE;
    }

    /*     * *********************** FORMS ************************ */

    /**
     * Establece las reglas utilizadas para la validación de datos
     * 
     * @param [id]                  Indentificador del elemento
     *
     * @return void
     */
    public function set_rules($id = 0)
    {
        $this->form_validation->set_rules('titulo', 'Título del enlace', 'required|is_unique_global_foreign_key[inmuebles_enlaces;' . $id . ';titulo;id;inmueble_id;' . $this->inmueble_id . ']|max_length[150]|xss_clean');
        // Si es un video youtube debe comprobarse que es un recurso de youtube válido
        $youtube_rules="";
        if($this->form_validation->get_validation_data('youtube'))
        {
            $youtube_rules.="|is_valid_youtube_url";
            // Si además está publicado, hay que comprobar que puede embederse correctamente
            if($this->form_validation->get_validation_data('publicado'))
            {
                $youtube_rules.="|is_embeddable_youtube_url";
            }
        }
        // For testing proposes
        // echo $youtube_rules; die();
        
        $this->form_validation->set_rules('url', 'Dirección web (URL)', 'required|valid_url|is_unique_global_foreign_key[inmuebles_enlaces;' . $id . ';url;id;inmueble_id;' . $this->inmueble_id . ']|max_length[255]|xss_clean'.$youtube_rules);
        // Recordar que hay que tener una regla para que funcionen los set_checkbox
        $this->form_validation->set_rules('publicado', 'Publicado', 'xss_clean');
        $this->form_validation->set_rules('youtube', 'Video Youtube', 'xss_clean');
    }

    /**
     * Ejecuta las validaciones
     *
     * @return void
     */
    public function validation($id = 0, $data=NULL)
    {
        // Inicializamos los datos para que sean accesibles en el set_rules
        if(is_null($data))
        {            
            $this->form_validation->set_data($this->input->post()); 
        }
        
        // Rules
        $this->set_rules($id);

        // Other functions validations
        if($this->form_validation->run())
        {
            return $this->check_exists_youtube_publicado($id,$this->inmueble_id,$this->form_validation->get_validation_data('youtube'),$this->form_validation->get_validation_data('publicado'));
        }
        // En caso contrario, los errores son los de las reglas definidas
        else
        {
            $this->set_error(validation_errors());
            return FALSE;
        }
    }
    
    /**
     * Comprueba que ya existe otro enlace publicado de youtube
     *
     * @param [id]                 Indentificador del elemento
     * @param [inmueble_id]        identificador del inmueble
     * @param [youtube]            1 si es youtube, 0 en caso contrario
     * @param [publicado]          1 si está publicado, 0 en caso contrario
     *
     * @return TRUE OR FALSE
     */            
    public function check_exists_youtube_publicado($id,$inmueble_id,$youtube,$publicado)
    {
        if ($inmueble_id && $youtube && $publicado)
        {
            if($this->check_youtube_publicado($id,$inmueble_id))
            {
                $this->set_error('Ya existe otro enlace publicado de Youtube');
                return FALSE;
            }
        }
        
        return TRUE;
    }

    /**
     * Establece los datos para su visualización en HTML
     *
     * @param [id]                  Indentificador del elemento
     *
     * @return array con los datos especificados para utilizarlos en los diferentes helpers
     */
    public function set_datas_html($datos = NULL)
    {
        $data['titulo'] = array(
            'name' => 'titulo',
            'id' => 'titulo',
            'type' => 'text',
            'value' => $this->form_validation->set_value('titulo', is_object($datos) ? $datos->titulo : ""),
        );
        
        $data['url'] = array(
            'name' => 'url',
            'id' => 'url',
            'type' => 'text',
            'value' => $this->form_validation->set_value('url', is_object($datos) ? $datos->url : ""),
        );
        
        $data['publicado_checked'] = is_object($datos) ? $datos->publicado : $this->form_validation->set_checkbox('publicado', '1', TRUE);
        $data['publicado'] = is_object($datos) ? $datos->publicado : 1;
        
        $data['youtube_checked'] = is_object($datos) ? $datos->youtube : $this->form_validation->set_checkbox('youtube', '1');
        $data['youtube'] = is_object($datos) ? $datos->youtube : 0;

        return $data;
    }

    /**
     * Devuelve los datos formateado de la interfaz
     *
     * @return array con los datos formateado
     */
    public function get_formatted_datas()
    {
        $datas['titulo'] = $this->input->post('titulo');
        $datas['url'] = $this->input->post('url');
        $datas['publicado'] = $this->utilities->get_sql_value_string($this->input->post('publicado'), 'defined', $this->input->post('publicado'), 0);
        $datas['youtube'] = $this->utilities->get_sql_value_string($this->input->post('youtube'), 'defined', $this->input->post('youtube'), 0);
        $datas['inmueble_id'] = $this->inmueble_id;
        return $datas;
    }

    /**
     * Comprueba si semánticamente, es posible eliminar el elemento indicado
     *
     * @param [id]                  Indentificador del elemento
     *
     * @return void
     */
    function check_delete($element)
    {
        if($element->publicado)
        {
            $this->set_error("No se puede eliminar un enlace publicado");
            return FALSE;
        }
        
        return TRUE;
    }

    /**
     * Formatea los datos introducidos por el usuario y crea un registro en la base de datos
     *
     * @return void
     */
    
    function create()
    {
        // Formatted datas
        $formatted_datas=$this->get_formatted_datas();                
        // Parent insert
        return $this->insert($formatted_datas);
    }
    
    /**
     * Formatea los datos introducidos por el usuario y actualiza un registro en la base de datos
     *
     * @param [id]                  Indentificador del elemento
     *
     * @return void
     */
    
    function edit($id)
    {
        // Formatted datas
        $formatted_datas=$this->get_formatted_datas();        
        // Parent update
        return $this->update($formatted_datas,$id);
    }
    
    /**
     * Devuelve los enlaces adjuntos de un determinado inmueble
     *
     * @param [inmueble_id]                  Indentificador del elemento
     *
     * @return void
     */
    function get_enlaces_inmueble($inmueble_id)
    {
        $this->db->from($this->table);
        $this->db->where('inmueble_id', $inmueble_id);
        $this->db->order_by('enlace');
        return $this->db->get()->result();
    } 

    /**
     * Comprueba si existe otro enlace publicado de youtube en el inmueble
     *
     * @param [id]                  Indentificador del enlace
     * @param [inmueble_id]         Indentificador del inmueble
     *
     * @return void
     */
    function check_youtube_publicado($id, $inmueble_id)
    {
        $this->db->from($this->table);
        if(!empty($id))
        {
            $this->db->where('id <>', $id);
        }
        $this->db->where('inmueble_id', $inmueble_id);
        $this->db->where('publicado', 1);
        $this->db->where('youtube', 1);
        return $this->db->get()->row();
    } 
    
}
