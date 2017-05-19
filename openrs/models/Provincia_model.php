<?php defined('BASEPATH') OR exit('No direct script access allowed');

require_once APPPATH . '/core/MY_Model.php';

class Provincia_model extends MY_Model
{

    public function __construct()
    {
        $this->table = 'provincias';
        $this->primary_key = 'id';
        $this->has_many['poblaciones'] = array('local_key'=>'id', 'foreign_key'=>'provincia_id', 'foreign_model'=>'Poblacion_model');
        
        parent::__construct();
        
        // Carga del modelo
        $this->load->model('Poblacion_model');
    }
    
    /************************* SECURITY *************************/
    
    public function check_access_conditions($datos)
    {
        return TRUE;
    }
    
    
    /**
     * Activa\desactiva la provincia y todos los municipios asociados
     *
     * @param [id]                  Indentificador de la provincia
     * @param [activar]             Acción
     *
     * @return void
     */
    
    function activar($id,$activar)
    {
        // Activación de provincia
        $this->update(array("activa" => $activar),$id);          
        // Activación de municipios
        return $this->Poblacion_model->activar_all($id,$activar);
    }
}
