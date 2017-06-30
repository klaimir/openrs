<?php defined('BASEPATH') OR exit('No direct script access allowed');

require_once APPPATH . 'core/MY_Model.php';

class Tipo_plantilla_documentacion_model extends MY_Model
{

    public function __construct()
    {
        $this->table = 'tipos_plantilla_documentacion';
        $this->primary_key = 'id';
        /*
        $this->has_many_pivot['tipos_plantilla'] = array(
           		    'foreign_model'=>'Categoria_informacion_documentacion_model',
           		    'pivot_table'=>'tipos_plantilla_documentacion_categorias_asignadas',
           		    'local_key'=>'id',
           		    'pivot_local_key'=>'tipo_plantilla_id',
           		    'pivot_foreign_key'=>'categoria_inf_id',
           		    'foreign_key'=>'id',
           		    'get_relate'=>FALSE
           		);
         * 
         */
        
        parent::__construct();
        
        // Cargamos modelo de tipos de plantilla
        $this->load->model('Categoria_informacion_documentacion_model');
    }
    
    /**
     * Obtiene las marcas agrupadas por categorías de una determinada plantilla
     *
     * @return array de datos de plantilla
     */
    
    function get_categorias_with_marcas($id)
    {
        $results=array();
        // Consultar categorías asignadas al tipo de plantilla de documentación actual
        $categorias=$this->Categoria_informacion_documentacion_model->get_categorias_asignadas_by_tipo_plantilla($id);
        foreach($categorias as $categoria)
        {
            $results[$categoria->categoria_inf_id]=$this->Categoria_informacion_documentacion_model->with_marcas()->get($categoria->categoria_inf_id);
        }
        
        return $results;
    }

}
