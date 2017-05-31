<?php defined('BASEPATH') OR exit('No direct script access allowed');

require_once APPPATH . 'core/MY_Model.php';

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
    
    /**
     * Devuelve un array de provincias en formato dropdown
     *
     * @return array de provincias en formato dropdown
     */
    
    function get_provincias_dropdown($default_value="",$activa=NULL)
    {
        // Array de provincias
        if(is_null($activa))
        {
            $provincias=$this->as_dropdown('provincia')->get_all();  
        }
        else
        {
            $provincias=$this->as_dropdown('provincia')->where('activa',1)->get_all();  
        }
        // Selección inicial
        $seleccion[$default_value]="- Seleccione provincia -";
        // Si devolvemos un merge se pierden las claves numéricas
        // http://php.net/manual/es/function.array-merge.php
        // return array_merge($seleccion,$provincias);
        // Por tanto devolvemos el operador suma para que mantenga las claves numéricas
        return ($seleccion+$provincias);
    }
    
    /**
     * Devuelve el identificador de un provincia que coincida con el nombre suministrado
     *
     * @param	[nombre_provincia]   Nombre del provincia
     * 
     * @return identificador del provincia
     */
    
    function get_id_by_nombre($nombre_provincia)
    {
        $this->db->select($this->table.'.id');
        $this->db->from($this->table);
        $this->db->where('provincia', $nombre_provincia);
        $query = $this->db->get();
        $row = $query->row();
        if ($row) {
            return $row->id;
        } else {
            return NULL;
        }
    }
    
}
