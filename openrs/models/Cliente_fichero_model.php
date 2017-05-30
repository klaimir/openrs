<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require_once APPPATH . '/core/MY_Model.php';

class Cliente_fichero_model extends MY_Model
{

    public $cliente_id = NULL;

    public function __construct()
    {
        $this->table = 'clientes_ficheros';
        $this->primary_key = 'id';
        $this->has_one['cliente'] = array('local_key' => 'id', 'foreign_key' => 'cliente_id', 'foreign_model' => 'Cliente_model');

        parent::__construct();

        // Carga del modelo
        $this->load->model('Cliente_model');
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
        $this->form_validation->set_rules('texto_fichero', 'Nombre del fichero', 'required|is_unique_global_foreign_key[clientes_ficheros;' . $id . ';texto_fichero;id;cliente_id;' . $this->cliente_id . ']|max_length[200]|xss_clean');
    }

    /**
     * Ejecuta las validaciones
     *
     * @return void
     */
    public function validation($id = 0)
    {
        // Rules
        $this->set_rules($id);

        // Other functions validations
        // Run form validation        
        return $this->form_validation->run();
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
        $data['texto_fichero'] = array(
            'name' => 'texto_fichero',
            'id' => 'texto_fichero',
            'type' => 'text',
            'value' => $this->form_validation->set_value('texto_fichero', is_object($datos) ? $datos->texto_fichero : ""),
        );

        return $data;
    }

    /**
     * Devuelve los datos formateado de la interfaz
     *
     * @return array con los datos formateado
     */
    public function get_formatted_datas($upload_data)
    {
        $datas['fichero'] = 'uploads/clientes/'.$this->cliente_id.'/'.$upload_data['file_name'];
        $datas['texto_fichero'] = $this->input->post('texto_fichero');
        $datas['cliente_id'] = $this->cliente_id;
        return $datas;
    }

    /**
     * Comprueba si semánticamente, es posible eliminar el elemento indicado
     *
     * @param [id]                  Indentificador del elemento
     *
     * @return void
     */
    function check_delete($id)
    {
        return TRUE;
    }

    /**
     * Formatea los datos introducidos por el usuario y crea un registro en la base de datos
     *
     * @return void
     */
    function create()
    {
        $config['upload_path'] = './uploads/clientes/'.$this->cliente_id;
        $config['allowed_types'] = '*';
        $config['max_size'] = 2000;   
        $config['encrypt_name'] = TRUE;     

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('fichero'))
        {
            $this->set_error($this->upload->display_errors());
            return FALSE;
        }
        else
        {
            // Formatted datas
            $formatted_datas = $this->get_formatted_datas($this->upload->data());
            // Parent insert
            $id=$this->insert($formatted_datas);
            if($id)
            {
                return $id;
            }
            else
            {
                $this->set_error(lang('common_error_insert'));
                return FALSE;
            }
        }
    }

    
    /**
     * Devuelve los ficheros adjuntos de un determinado cliente
     *
     * @param [cliente_id]                  Indentificador del elemento
     *
     * @return void
     */
    function get_ficheros_cliente($cliente_id)
    {
        $this->db->from($this->table);
        $this->db->where('cliente_id', $cliente_id);
        $this->db->order_by('fichero');
        return $this->db->get()->result();
    }    
    
    /**
     * Elimina el fichero del sistema de ficheros y de la bd
     *
     * @param [fichero_cliente]        Datos del fichero en la base de datos
     *
     * @return void
     */
    function remove($fichero)
    {        
        // Borrado físico del fichero
        if(file_exists(FCPATH . $fichero->fichero))
        {
            if(unlink(FCPATH . $fichero->fichero))
            {
                if($this->delete($fichero->id))
                {
                    return TRUE;
                }
                else
                {
                    $this->set_error(lang('common_error_delete'));
                    return FALSE;
                }
            }
            else
            {
                $this->set_error('El fichero está en uso. Inténtelo más tarde');
                return FALSE;
            }
        }
        else
        {
            $this->set_error('El fichero a borrar no existe. Póngase en contacto con el administrador');
            return FALSE;
        }
    }

}
