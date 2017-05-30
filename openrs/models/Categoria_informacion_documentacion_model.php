<?php defined('BASEPATH') OR exit('No direct script access allowed');

require_once APPPATH . 'core/MY_Model.php';

class Categoria_informacion_documentacion_model extends MY_Model
{

    public function __construct()
    {
        $this->table = 'categorias_informacion_documentacion';
        $this->primary_key = 'id';
        $this->has_many['marcas'] = array('local_key'=>'id', 'foreign_key'=>'categoria_inf_id', 'foreign_model'=>'Marca_documentacion_model');
       
        /*
        $this->has_many_pivot['tipos_plantilla'] = array(
           		    'foreign_model'=>'Tipo_plantilla_documentacion_model',
           		    'pivot_table'=>'tipos_plantilla_documentacion_categorias_asignadas',
           		    'local_key'=>'id',
           		    'pivot_local_key'=>'categoria_inf_id',
           		    'pivot_foreign_key'=>'tipo_plantilla_id',
           		    'foreign_key'=>'id',
           		    'get_relate'=>FALSE
           		);
         * 
         */
        

        parent::__construct();
    }
         
    function get_categorias_asignadas_by_tipo_plantilla($tipo_plantilla_id)
    {
        $fieldslist=$this->utilities->getFieldsTable('tipos_plantilla_documentacion_categorias_asignadas'); 
        $this->db->select($fieldslist);
        $this->db->from('tipos_plantilla_documentacion_categorias_asignadas');
        $this->db->where('tipo_plantilla_id',$tipo_plantilla_id);
        return $this->db->get()->result();
    }

}
