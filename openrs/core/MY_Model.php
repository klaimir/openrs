<?php defined('BASEPATH') OR exit('No direct script access allowed');

require_once APPPATH . '/core/Base_Model.php';

class MY_Model extends Base_Model
{
    // Error controls
    public $error_access=FALSE;
    public $show_errors=TRUE;
    public $text_error='';
    // Model internal datas (for example, from the database, but, for conventios, always it will be a object)
    public $datas=NULL;
    
    public function __construct()
    {
        $this->timestamps = FALSE;
        $this->protected = array($this->primary_key);
        
        parent::__construct();
    }
    
    // Security Section
    public function _check_security_access_by_id($id) {
        return $this->_check_security_access(NULL,$id);
    }
    
    public function _check_security_access_by_object($datos) {
        return $this->_check_security_access($datos);
    }
    
    public function _check_security_exist($datos,$id=NULL) {
        if(!is_null($id))
        {
            $this->datas=$this->get_by_id($id);
        }
        else
        {
            $this->datas=$datos;
        }
        // Seguridad
        if($this->datas)
        {
            return TRUE;
        }
        else
        {
            $this->text_error = "Error al cargar el registro";
            $this->error_access=TRUE;
        }
        // Check del error
        if($this->error_access && $this->show_errors)
        {          
            show_error($this->text_error);
        }
        
        return FALSE;
    }
    
    public function _check_security_access($datos,$id=NULL) {
        // Existe        
        $this->_check_security_exist($datos,$id);                
        // Definir en la clase hija
        $this->check_access_conditions();
        // Check del error
        if($this->error_access && $this->show_errors)
        {          
            show_error($this->text_error);
        }
        
        return FALSE;
    }
    
    // Others functions
    
    public function set_datas($datas)
    {
        $this->datas=$datas;
    }
    
    public function set_datas_object($id)
    {
        $this->datas=$this->get_by_id($id);
    }

    function get_by_id($id)
    {
        $this->db->where($this->primary_key, $id);
        $query = $this->db->get($this->table);
        if ($query->num_rows === 0)
            return FALSE;
        return $query->first_row();
    }

    function getFieldsTable($table, $db = 'db')
    {
        $fields = $this->$db->list_fields($table);
        $separador = ",";
        $cont = 1;
        $tamfields = count($fields);
        $fieldslist = "";
        foreach ($fields as $field)
        {
            if ($tamfields == $cont)
                $fieldslist.=$table . '.' . $field;
            else
                $fieldslist.=$table . '.' . $field . $separador;
            $cont++;
        }
        return $fieldslist;
    }

}
