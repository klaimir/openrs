<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require_once APPPATH . 'models/Documento_generado_model.php';

class Inmueble_cartel_model extends Documento_generado_model
{

    public function __construct()
    {
        parent::__construct();
        
        $this->table = 'inmuebles_carteles';
        $this->view = 'v_inmuebles_carteles';
        $this->primary_key = 'id';
        
        $this->has_one['inmueble'] = array('local_key' => 'id', 'foreign_key' => 'inmueble_id', 'foreign_model' => 'Inmueble_model');

        // Carga de modelos
        $this->load->model('Plantilla_documentacion_model');
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
        if($id)
        {
            $this->form_validation->set_rules('html', 'Contenido del cartel', 'required');
            $this->form_validation->set_rules('impreso', 'Impreso', 'xss_clean');
        }
        else
        {
            $this->form_validation->set_rules('plantilla_id', 'Plantilla', 'required');
            $this->form_validation->set_rules('idioma_id', 'Idioma', 'required');
        }
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
        if(is_object($datos))
        {
            $data['impreso_checked'] = is_object($datos) ? $datos->impreso : $this->form_validation->set_checkbox('impreso', '1');
            $data['impreso'] = is_object($datos) ? $datos->impreso : 0;
            
            $data['html'] = array(
                'name' => 'html',
                'id' => 'html',
                'type' => 'text',
                'value' => $this->form_validation->set_value('html', is_object($datos) ? $this->utilities->process_html($datos->html) : ""),
            );
        }
        else
        {
            // Selector de plantillas
            $data['plantillas'] = $this->Plantilla_documentacion_model->get_dropdown(3);                
            $data['plantilla_id'] = $this->form_validation->set_value('plantilla_id', is_object($datos) ? $datos->plantilla_id : "");

            // Selector de idiomas
            $data['idiomas'] = $this->Idioma_model->get_dropdown();                
            $data['idioma_id'] = $this->form_validation->set_value('idioma_id', is_object($datos) ? $datos->idioma_id : "");
        }

        return $data;
    }

    /**
     * Devuelve los datos formateado de la interfaz
     *
     * @return array con los datos formateado
     */
    public function get_formatted_datas_insert()
    {        
        $datas['plantilla_id'] = $this->input->post('plantilla_id');
        $datas['idioma_id'] = $this->input->post('idioma_id');
        $datas['inmueble_id'] = $this->inmueble_id;
        $datas['agente_id'] = $this->data['session_user_id'];
        $datas['fecha'] = date("Y-m-d");
        $datas['hash_qr_image'] = uniqid();
        $html=$this->generar_html_cartel($datas['inmueble_id'],$datas['plantilla_id'],$datas['idioma_id'],$datas['agente_id'],$datas['hash_qr_image']);
        // Hay que quitar el dominio local
        $datas['html'] = $this->utilities->process_html($html,'input');
        return $datas;
    }
    
    /**
     * Devuelve los datos formateado de la interfaz
     *
     * @return array con los datos formateado
     */
    public function get_formatted_datas_edit()
    {        
        $datas['impreso'] = $this->utilities->get_sql_value_string($this->input->post('impreso'), 'defined', $this->input->post('impreso'), 0);
        $datas['html'] = $this->utilities->process_html($this->input->post('html'),'input');
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
        // Borramos antes por concurrencia
        $this->delete(array("inmueble_id" => $this->inmueble_id));
        // Formatted datas
        $formatted_datas=$this->get_formatted_datas_insert();                
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
        $formatted_datas=$this->get_formatted_datas_edit();        
        // Parent update
        return $this->update($formatted_datas,$id);
    }
    
    /**
     * Devuelve los carteles adjuntos de un determinado inmueble
     *
     * @param [inmueble_id]                  Indentificador del elemento
     *
     * @return void
     */
    function get_carteles_inmueble($inmueble_id)
    {
        $this->db->from($this->table);
        $this->db->where('inmueble_id', $inmueble_id);
        return $this->db->get()->row();
    } 
    
    /**
     * Reemplaza una imagen QR en un documento existente
     *
     * @return TRUE OR FALSE
     */
    function reemplazar_qr_image($inmueble_id,$idioma_id,$url_seo)
    {
        // Hash
        $hash_qr_image=uniqid();        
        // Reemplazamos hash en html cartel
        $cartel=$this->get_by_inmueble($inmueble_id);
        $html_formateado = str_replace($cartel->hash_qr_image, $hash_qr_image, $cartel->html);
        // For testing pourpose
        /*
        var_dump($cartel->hash_qr_image);
        var_dump($hash_qr_image);
        var_dump($cartel->html);
        var_dump($html_formateado);
        die();
         * 
         */
        // Generamos la imagen
        $this->generate_qr_image($inmueble_id, $idioma_id, $url_seo, $hash_qr_image);
        // Salvamos hash en bd
        $formatted_datas['hash_qr_image']=$hash_qr_image;
        $formatted_datas['html']=$html_formateado;
        return $this->update($formatted_datas,$cartel->id);
    }
    
    /**
     * Formatea los datos introducidos por el usuario y crea un registro en la base de datos
     *
     * @return void
     */
    function generar_html_cartel($inmueble_id,$plantilla_id,$idioma_id,$agente_id,$hash_qr_image=NULL)
    {
        // Establecemos los identificadores necesarios para generar el documento
        $this->inmueble_id=$inmueble_id;
        $this->idioma_id=$idioma_id;
        $this->plantilla_id=$plantilla_id;
        $this->agente_id=$agente_id;
        if(is_null($hash_qr_image))
        {
            $this->hash_qr_image=uniqid();
        }
        else
        {
            $this->hash_qr_image=$hash_qr_image;
        }
        // Aplicamos datos de la plantilla
        $this->aplicar_plantilla();
        // Devolemos el HTML generado
        return $this->html;
    }
    
    /**
     * Devuelve el cartel correspondiente al inmueble
     *
     * @return array de datos de plantilla
     */
    
    function get_by_inmueble($inmueble_id)
    {
        return $this->get(array("inmueble_id" => $inmueble_id));
    }
    
    /**
     * Elimina el fichero del sistema de ficheros y de la bd
     *
     * @param [$cartel]        Datos del fichero en la base de datos
     *
     * @return void
     */
    function remove($cartel)
    {        
        // Borrado físico del fichero
        if(file_exists(FCPATH . 'uploads/inmuebles/' . $cartel->inmueble_id . '/'.$cartel->hash_qr_image.'.png'))
        {
            if(!unlink(FCPATH . 'uploads/inmuebles/' . $cartel->inmueble_id . '/'.$cartel->hash_qr_image.'.png'))
            {
                $this->set_error('El código qr generado está en uso. Inténtelo más tarde');
                return FALSE;
            }
        }
        // Borrado bd
        if($this->delete($cartel->id))
        {
            return TRUE;
        }
        else
        {
            $this->set_error(lang('common_error_delete'));
            return FALSE;
        }
    }

}
