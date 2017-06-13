<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require_once APPPATH . 'core/MY_Model.php';

class Inmueble_imagen_model extends MY_Model
{

    public $inmueble_id = NULL;

    public function __construct()
    {
        $this->table = 'inmuebles_imagenes';
        $this->primary_key = 'id';
        $this->has_one['inmueble'] = array('local_key' => 'id', 'foreign_key' => 'inmueble_id', 'foreign_model' => 'Inmueble_model');

        parent::__construct();
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
        return TRUE;
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
        $data = array();

        return $data;
    }

    /**
     * Devuelve los datos formateado de la interfaz
     *
     * @return array con los datos formateado
     */
    public function get_formatted_datas($upload_data)
    {
        $datas['imagen'] = 'uploads/inmuebles/'.$this->inmueble_id.'/imagenes/'.$upload_data['file_name'];
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
        $config['upload_path'] = './uploads/inmuebles/'.$this->inmueble_id.'/imagenes';
        $config['allowed_types'] = 'png|jpg|jpeg';
        $config['max_size'] = (MEGABYTE*ini_get('post_max_size'));  

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('file'))
        {
            $this->set_error($this->upload->display_errors('',''));
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
     * Devuelve la imagen de portada de determinado inmueble
     *
     * @param [inmueble_id]                  Indentificador del elemento
     *
     * @return void
     */
    function get_portada($inmueble_id)
    {
        $this->db->from($this->table);
        $this->db->where('inmueble_id', $inmueble_id);
        $this->db->where('portada', 1);
        return $this->db->get()->row();
    }
    
    /**
     * Devuelve los imagenes adjuntos de un determinado inmueble
     *
     * @param [inmueble_id]                  Indentificador del elemento
     *
     * @return void
     */
    function get_imagenes_inmueble($inmueble_id)
    {
        $this->db->from($this->table);
        $this->db->where('inmueble_id', $inmueble_id);
        $this->db->order_by('imagen');
        return $this->db->get()->result();
    }    
    
    /**
     * Elimina el imagen del sistema de imagenes y de la bd
     *
     * @param [imagen]        Datos del imagen en la base de datos
     *
     * @return void
     */
    function remove($imagen)
    {       
        // No se puede eliminar la imagen de portada
        if($imagen->portada)
        {
            $this->set_error('La imagen de portada no puede ser eliminada');
            return FALSE;
        }        
        // Borrado físico del imagen
        if(file_exists(FCPATH . $imagen->imagen))
        {
            if(unlink(FCPATH . $imagen->imagen))
            {
                if($this->delete($imagen->id))
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
                $this->set_error('La imagen está en uso. Inténtelo más tarde');
                return FALSE;
            }
        }
        else
        {
            $this->set_error('La imagen a borrar no existe. Póngase en contacto con el administrador');
            return FALSE;
        }
    }
    
    /**
     * Publica o despublica una imagen en función de la opción indicada
     *
     * @param [id]                  Indentificador del elemento
     * @param [publicar]             1 para publicar, 0 para quitar la publicación
     *
     * @return void
     */
    function publicar($id,$publicar)
    {
        $datas['publicada'] = $publicar;
        return $this->update($datas, $id);
    }
    
    /**
     * Publica o despublica una imagen en función de la opción indicada
     *
     * @param [id]                  Indentificador del elemento
     * @param [$inmueble_id]        Indentificador del inmueble
     *
     * @return void
     */
    function set_portada($id,$inmueble_id)
    {
        // Quitamos la portada anterior
        $datas['portada'] = 0;
        if($this->update($datas, array("inmueble_id" => $inmueble_id, "portada" => 1))>=0)
        {
            // Establecemos la nueva
            $datas['portada'] = 1;
            return $this->update($datas, $id);
        }
        else
        {
            return FALSE;
        }
    }

}
