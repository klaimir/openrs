<?php defined('BASEPATH') OR exit('No direct script access allowed');

require_once APPPATH . 'core/Base_Model.php';

class MY_Model extends Base_Model
{
    // Error controls
    public $exists_error=FALSE;
    public $show_errors=TRUE;
    public $text_error='';
    // Model internal datas (for example, from the database, but, for conventios, always it will be a object)
    public $datas=NULL;
    // Vista principal que se usa para mostrar datos
    public $view=NULL;
    
    public function __construct()
    {
        $this->timestamps = FALSE;
        $this->protected = array($this->primary_key);
        $this->datas=new stdClass();
        
        parent::__construct();
    }
    
    // Security Section    
    
    public function set_error($text_error) {
        $this->text_error=$text_error;
    }
    
    public function get_error() {
        return $this->text_error;
    }
    
    public function _check_security_exist($datos) {
        // Seguridad
        if($datos)
        {
            return TRUE;
        }
        else
        {
            $this->text_error = "Error al cargar el registro";
            $this->exists_error=TRUE;
        }
        // Check del error
        if($this->exists_error && $this->show_errors)
        {          
            show_error($this->text_error);
        }
        
        return FALSE;
    }
    
    public function check_access($datos) {
        // Existe        
        $this->_check_security_exist($datos);                
        // Definir en la clase hija
        $this->check_access_conditions($datos);
        // Check del error
        if($this->exists_error)
        {          
            if($this->show_errors)
            {
                show_error($this->text_error);
            }
            else
            {
                return FALSE;
            }
        }
        
        return TRUE;
    }
    
    function get_view_by_id($id)
    {
        $this->db->where($this->primary_key, $id);
        $query = $this->db->get($this->view);
        if ($query->num_rows === 0)
            return FALSE;
        return $query->first_row();
    }

    function get_by_id($id)
    {
        $this->db->where($this->primary_key, $id);
        $query = $this->db->get($this->table);
        if ($query->num_rows === 0)
            return FALSE;
        return $query->first_row();
    }
    
    // Otras funciones para simular manejo tipo ORM
    
    public function set_datas_array($array)
    {
        foreach ($array as $key => $value)
        {
            $this->datas->$key=$value;
        }
    }
    
    public function set_datas_object($id)
    {
        $this->datas=$this->get_by_id($id);
        return $this->datas;
    }
    
    function _get_value($field)
    {
        if(isset($this->datas->$field))
        {
            return $this->datas->$field;
        }
        else
        {
            return NULL;
        }
    }
    
    function get_value($fields)
    {
        if(is_array($fields))
        {
            $array=array();
            foreach ($fields as $key => $value)
            {
                $array[$key]=$this->_get_value($key,$value);
            }
            return $array;
        }
        else
        {
            return $this->_get_value($fields);
        }
    }
        
    private function _set_value($field,$value)
    {
        return $this->datas->$field=$value;
    }
    
    function set_value($fields,$value)
    {
        if(is_array($fields))
        {
            foreach ($fields as $key => $value)
            {
                $this->_set_value($key,$value);
            }
        }
        else
        {
            $this->_set_value($fields,$value);
        }
        
    }
    
    function _create()
    {
        // Formatted datas
        $formatted_datas=$this->get_formatted_datas();
        
        // Set datas
        $this->set_datas_array($formatted_datas);
        
        // Parent insert
        $last_id=$this->insert($formatted_datas);
        
        $this->set_value($this->primary_key,$last_id);
        
        return $last_id;
    }
    
    function _edit()
    {
        // Formatted datas
        $formatted_datas=$this->get_formatted_datas();
        
        // Set datas
        $this->set_datas_array($formatted_datas);
        
        // Parent update
        return $this->update($formatted_datas,$this->get_value($this->primary_key));
    }
    
    function _remove()
    {        
        return $this->delete($this->get_value($this->primary_key));
    }

}
