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
        $this->form_validation->set_rules('fichero', 'Nombre del fichero', 'required|is_unique_global_foreign_key[clientes_ficheros;' . $id . ';fichero;id;cliente_id;' . $this->cliente_id . ']|max_length[100]|xss_clean');
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
        $data['fichero'] = array(
            'name' => 'fichero',
            'id' => 'fichero',
            'type' => 'text',
            'value' => $this->form_validation->set_value('fichero', is_object($datos) ? $datos->fichero : ""),
        );

        return $data;
    }

    /**
     * Devuelve los datos formateado de la interfaz
     *
     * @return array con los datos formateado
     */
    public function get_formatted_datas()
    {
        $datas['fichero'] = $this->input->post('fichero');
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
        // Formatted datas
        $formatted_datas = $this->get_formatted_datas();
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
        $formatted_datas = $this->get_formatted_datas();
        // Parent update
        return $this->update($formatted_datas, $id);
    }

    
    function get_ficheros_cliente($cliente_id)
    {
        $this->db->from($this->table);
        $this->db->where('cliente_id', $cliente_id);
        $this->db->order_by('fichero');
        return $this->db->get()->result();
    }    

}
