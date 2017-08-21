<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require_once APPPATH . 'core/MY_Model.php';

class Cliente_model extends MY_Model
{

    public function __construct()
    {
        parent::__construct();

        $this->table = 'clientes';
        $this->primary_key = 'id';
        $this->view = 'v_clientes';

        $this->has_many['demandas'] = array('local_key' => 'id', 'foreign_key' => 'cliente_id', 'foreign_model' => 'Demanda_model');
        $this->has_one['poblacion'] = array('local_key' => 'poblacion_id', 'foreign_key' => 'id', 'foreign_model' => 'Poblacion_model');
        $this->has_one['pais'] = array('local_key' => 'pais_id', 'foreign_key' => 'id', 'foreign_model' => 'Pais_model');
        $this->has_one['estado'] = array('local_key' => 'estado_id', 'foreign_key' => 'id', 'foreign_model' => 'Estado_model');
        $this->has_one['medio_captacion'] = array('local_key' => 'medio_captacion_id', 'foreign_key' => 'id', 'foreign_model' => 'Medio_captacion_model');
        
        $this->has_many_pivot['propiedades'] = array(
            'foreign_model'=>'Inmueble_model',
            'pivot_table'=>'clientes_inmuebles',
            'local_key'=>'id',
            'pivot_local_key'=>'cliente_id', /* this is the related key in the pivot table to the local key
                this is an optional key, but if your column name inside the pivot table
                doesn't respect the format of "singularlocaltable_primarykey", then you must set it. In the next title
                you will see how a pivot table should be set, if you want to  skip these keys */
            'pivot_foreign_key'=>'inmueble_id', /* this is also optional, the same as above, but for foreign table's keys */
            'foreign_key'=>'id',
            'get_relate'=>TRUE /* another optional setting, which is explained below */
        );

        // Guardamos datos
        $this->timestamps = TRUE;
        $this->_created_at_field = "fecha_alta";
        $this->_updated_at_field = "fecha_actualizacion";

        // Modelos axiliares
        $this->load->model('Provincia_model');
        $this->load->model('Pais_model');
        $this->load->model('Estado_model');
        $this->load->model('Medio_captacion_model');
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
        $pais_id = $this->form_validation->get_validation_data('pais_id');

        $this->form_validation->set_rules('nif', 'NIF/NIE/CIF', 'required|max_length[11]|is_unique_global[clientes;' . $id . ';nif;id]|is_nif_valido[' . $pais_id . ']|xss_clean');
        $this->form_validation->set_rules('nombre', 'Nombre', 'required|xss_clean|max_length[100]');
        $this->form_validation->set_rules('apellidos', 'Apellidos', 'required|xss_clean|max_length[150]');
        $this->form_validation->set_rules('fecha_nac', 'Fecha de nacimiento', 'xss_clean|checkDateFormat');
        $this->form_validation->set_rules('direccion', 'Dirección', 'xss_clean|max_length[200]');
        $this->form_validation->set_rules('correo', 'Correo electrónico', 'required|xss_clean|max_length[250]|valid_email|is_unique_global[clientes;' . $id . ';correo;id]');
        $this->form_validation->set_rules('observaciones', 'Observaciones', 'xss_clean|max_length[500]');
        $this->form_validation->set_rules('telefonos', 'Teléfonos', 'xss_clean|max_length[70]');
        if ($this->utilities->es_pais_extranjero($pais_id))
        {
            $required_poblacion = "";
        }
        else
        {
            $required_poblacion = "required";
        }
        $this->form_validation->set_rules('poblacion_id', 'Población', $required_poblacion);
        $this->form_validation->set_rules('provincia_id', 'Provincia', $required_poblacion);
        $this->form_validation->set_rules('pais_id', 'País de residencia', 'required');
        // Cuidado que hay que poner reglas a los campos para que se puedan aplicar los helpers
        $this->form_validation->set_rules('agente_asignado_id', 'Agente Asignado', 'xss_clean');
        $this->form_validation->set_rules('estado_id', 'Estado', 'required');
        $this->form_validation->set_rules('medio_captacion_id', 'Medio captación', 'required');
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
    public function set_datas_html($datos = NULL,$inmueble_id)
    {
        // Selector de provincias
        $data['provincias'] = $this->Provincia_model->get_provincias_dropdown();

        // Selector de paises
        $data['paises'] = $this->Pais_model->get_paises_dropdown();

        // Selector de agentes
        $data['agentes'] = $this->Usuario_model->get_agentes_dropdown();

        // selector de intereses
        $data['intereses'] = $this->get_intereses_dropdown();
        
        // Selector de estados
        $data['estados'] = $this->Estado_model->get_estados_dropdown(1);
        
        // Selector de medios_captacion
        $data['medios_captacion'] = $this->Medio_captacion_model->get_medios_captacion_dropdown();

        // Datos
        $data['nif'] = array(
            'name' => 'nif',
            'id' => 'nif',
            'type' => 'text',
            'value' => $this->form_validation->set_value('nif', is_object($datos) ? $datos->nif : ""),
        );

        $data['nombre'] = array(
            'name' => 'nombre',
            'id' => 'nombre',
            'type' => 'text',
            'value' => $this->form_validation->set_value('nombre', is_object($datos) ? $datos->nombre : ""),
        );

        $data['apellidos'] = array(
            'name' => 'apellidos',
            'id' => 'apellidos',
            'type' => 'text',
            'value' => $this->form_validation->set_value('apellidos', is_object($datos) ? $datos->apellidos : ""),
        );
        
        $data['fecha_nac'] = array(
            'name' => 'fecha_nac',
            'id' => 'fecha_nac',
            'type' => 'text',
            'value' => $this->form_validation->set_value('fecha_nac', is_object($datos) ? $this->utilities->cambiafecha_bd($datos->fecha_nac) : ""),
        );

        $data['direccion'] = array(
            'name' => 'direccion',
            'id' => 'direccion',
            'type' => 'text',
            'value' => $this->form_validation->set_value('direccion', is_object($datos) ? $datos->direccion : ""),
        );

        $data['pais_id'] = $this->form_validation->set_value('pais_id', is_object($datos) ? $datos->pais_id : 64);
        $data['estado_id'] = $this->form_validation->set_value('estado_id', is_object($datos) ? $datos->estado_id : "");
        $data['medio_captacion_id'] = $this->form_validation->set_value('medio_captacion_id', is_object($datos) ? $datos->medio_captacion_id : "");
        $data['agente_asignado_id'] = $this->form_validation->set_value('agente_asignado_id', is_object($datos) ? $datos->agente_asignado_id : $this->data['session_user_id']);
        $data['poblacion_id'] = $this->form_validation->set_value('poblacion_id', is_object($datos) ? $datos->poblacion_id : "");

        if (!empty($data['poblacion_id']))
        {
            $poblacion = $this->Poblacion_model->get_by_id($data['poblacion_id']);
            $data['provincia_id'] = $this->form_validation->set_value('provincia_id', $poblacion->provincia_id);
        }
        else
        {
            $data['provincia_id'] = $this->form_validation->set_value('provincia_id', "");
        }

        // Selector de poblaciones
        $data['poblaciones'] = $this->Poblacion_model->get_poblaciones_dropdown($data['provincia_id']);

        $data['correo'] = array(
            'name' => 'correo',
            'id' => 'correo',
            'type' => 'text',
            'value' => $this->form_validation->set_value('correo', is_object($datos) ? $datos->correo : ""),
        );

        $data['telefonos'] = array(
            'name' => 'telefonos',
            'id' => 'telefonos',
            'type' => 'text',
            'value' => $this->form_validation->set_value('telefonos', is_object($datos) ? $datos->telefonos : ""),
        );

        $data['observaciones'] = array(
            'name' => 'observaciones',
            'id' => 'observaciones',
            'type' => 'text',
            'value' => $this->form_validation->set_value('observaciones', is_object($datos) ? $datos->observaciones : ""),
        );
        
        // Especifica si se va a demandar un inmueble determinado
        if($inmueble_id)
        {
            $data['inmueble_id']=$inmueble_id;
            $this->load->model('Inmueble_model');
            $inmueble=$this->Inmueble_model->get_by_id($inmueble_id);
            if($inmueble)
            {
                $data['referencia_inmueble'] = $inmueble->referencia;
            }
            else
            {
                show_error("El inmueble seleccionado para asignarse al nuevo cliente no existe");
            }
        }

        return $data;
    }

    /**
     * Devuelve los datos formateado de la interfaz
     *
     * @return array con los datos formateado
     */
    public function get_formatted_datas($id = 0)
    {
        $datas['nif'] = $this->input->post('nif');
        $datas['nombre'] = $this->input->post('nombre');
        $datas['apellidos'] = $this->input->post('apellidos');
        $datas['fecha_nac'] = $this->utilities->cambiafecha_form($this->input->post('fecha_nac'));
        $datas['direccion'] = $this->input->post('direccion');
        $datas['correo'] = $this->input->post('correo');
        $datas['observaciones'] = $this->input->post('observaciones');
        $datas['telefonos'] = $this->input->post('telefonos');
        $datas['pais_id'] = $this->input->post('pais_id');
        $datas['estado_id'] = $this->input->post('estado_id');
        $datas['medio_captacion_id'] = $this->input->post('medio_captacion_id');
        $datas['poblacion_id'] = $this->utilities->get_sql_value_string($this->input->post('poblacion_id'), "int", $this->input->post('poblacion_id'), NULL);
        $datas['agente_asignado_id'] = $this->utilities->get_sql_value_string($this->input->post('agente_asignado_id'), "int", $this->input->post('agente_asignado_id'), NULL);

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
        if (count($this->with_demandas()->get($id)->demandas))
        {
            return FALSE;
        }
        else
        {
            return TRUE;
        }
    }
    
    /**
     * Elimina al cliente del sistema de ficheros y de la bd
     *
     * @param [id]        Identificador del cliente en la base de datos
     *
     * @return void
     */
    function remove($id)
    {        
        // Borrado físico de la carpeta de datos
        if($this->utilities->full_rmdir(FCPATH . 'uploads/clientes/'.$id))
        {
            if($this->delete($id))
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
            $this->set_error('Error al borrar la carpeta de datos. Póngase en contacto con el administrador');
            return FALSE;
        }
    }

    /**
     * Formatea los datos introducidos por el usuario y crea un registro en la base de datos
     *
     * @return void
     */
    function create($formatted_datas,$inmueble_id=0)
    {
        // Parent insert
        $id = $this->insert($formatted_datas);
        if ($id)
        {
            // Creación de carpeta
            if (!file_exists(FCPATH . "uploads/clientes/" . $id))
            {
                if (!mkdir(FCPATH . "uploads/clientes/" . $id, DIR_READ_MODE, true))
                {
                    $this->set_error('Error en la creación de la carpeta de datos. Póngase en contacto con el administrador');
                    return FALSE;
                }
                // Copiamos fichero html de protección
                if(!copy(FCPATH . "uploads/clientes/index.html", FCPATH . "uploads/clientes/" . $id."/index.html"))
                {
                    $this->set_error('Error al escribir en la carpeta de datos. Póngase en contacto con el administrador');
                    return FALSE;
                }
            }
            // Si está definido el inmueble
            $this->asignar_inmueble($id,$inmueble_id);
            // Devolvemos id
            return $id;
        }
        else
        {
            $this->set_error(lang('common_error_insert'));
            return FALSE;
        }
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
        $formatted_datas = $this->get_formatted_datas($id);
        // Parent update
        return $this->update($formatted_datas, $id);
    }
    
    /**
     * Aplica los filtros a una determinada consulta
     *
     * @param [$filtros]                  Filtros a aplicar
     *
     * @return void
     */
    function procesar_filtros_generales($filtros)
    {
        // Filtro Intereses
        if (isset($filtros['interes_id']) && $filtros['interes_id'] > 0)
        {
            // Intereses  
            /*
            switch ($filtros['interes_id'])
            {
                case 1:
                    $this->db->where('busca_vender', 1);
                    break;
                case 2:
                    $this->db->where('busca_alquilar', 1);
                    break;
                case 3:
                    $this->db->where('busca_alquiler', 1);
                    break;
                case 4:
                    $this->db->where('busca_comprar', 1);
                    break;
                default:
                    break;
            }
             * 
             */            
            $ids_clientes=array();
            switch ($filtros['interes_id'])
            {
                case 1:
                    $this->load->model('Cliente_inmueble_model');
                    // Devuelve los ids de los clientes que tienen propiedades en venta
                    $ids_clientes = $this->Cliente_inmueble_model->get_ids_clientes(1, $filtros['tipo_interes_id']);
                    break;
                case 2:
                    $this->load->model('Cliente_inmueble_model');
                    // Devuelve los ids de los clientes que tienen propiedades en alquiler
                    $ids_clientes = $this->Cliente_inmueble_model->get_ids_clientes(2, $filtros['tipo_interes_id']);
                    break;
                case 3:
                    $this->load->model('Demanda_model');
                    // Devuelve los ids de los clientes que tienen demandas que buscan alquier
                    $ids_clientes = $this->Demanda_model->get_ids_clientes(2, $filtros['tipo_interes_id']);
                    break;
                case 4:
                    $this->load->model('Demanda_model');
                    // Devuelve los ids de los clientes que tienen demandas que buscan comprar
                    $ids_clientes = $this->Demanda_model->get_ids_clientes(1, $filtros['tipo_interes_id']);
                    break;
                default:
                    break;
            }
            // Comparamos los ids de cliente obtenidos
            if(count($ids_clientes))
            {
                $this->db->where_in('id', $ids_clientes);
            }
            else
            {
                $this->db->where('id', 0);
            }
        }
        // Filtro Pais
        if (isset($filtros['pais_id']) && $filtros['pais_id'] >= 0)
        {
            $this->db->where('pais_id', $filtros['pais_id']);
        }
        // Filtro Provincia
        if (isset($filtros['provincia_id']) && $filtros['provincia_id'] >= 0)
        {
            $this->db->where('provincia_id', $filtros['provincia_id']);
        }
        // Filtro Población
        if (isset($filtros['poblacion_id']) && !empty($filtros['poblacion_id']) && $filtros['provincia_id'] >= 0)
        {
            $this->db->where('poblacion_id', $filtros['poblacion_id']);
        }
        // Filtro Agente Asignado
        if (isset($filtros['agente_asignado_id']) && $filtros['agente_asignado_id'] >= 0)
        {
            $this->db->where('agente_asignado_id', $filtros['agente_asignado_id']);
        }
        // Filtro estado
        if (isset($filtros['estado_id']) && $filtros['estado_id'] >= 0)
        {
            $this->db->where('estado_id', $filtros['estado_id']);
        }
        // Filtro medio_captacion
        if (isset($filtros['medio_captacion_id']) && $filtros['medio_captacion_id'] >= 0)
        {
            $this->db->where('medio_captacion_id', $filtros['medio_captacion_id']);
        }
        // Fechas
        if (isset($filtros['fecha_desde']) && $filtros['fecha_desde'] != "")
        {
            $this->db->where('fecha_alta >=', $this->utilities->cambiafecha_form($filtros['fecha_desde']));
        }
        if (isset($filtros['fecha_hasta']) && $filtros['fecha_hasta'] != "")
        {
            $this->db->where('fecha_alta <=', $this->utilities->cambiafecha_form($filtros['fecha_hasta']));
        }
    }
    
    /**
     * Aplica datos adicionales
     *
     * @param [$results]                  Clientes 
     *
     * @return void
     */
    function set_datos_adicionales_listado($results)
    {
        if($results)
        {
            // Modelos axiliares
            $this->load->model('Inmueble_model');
            $this->load->model('Demanda_model');
            // Datos adicionales de cada inmueble
            foreach ($results as $result)
            {
                $result->num_propiedades = count($this->Inmueble_model->get_propiedades_cliente($result->id));
                $result->num_inmuebles_demandados = count($this->Demanda_model->get_inmuebles_demandados($result->id));
            }
        }
    }

    /**
     * Lee los inmuebles en formato vista según los filtros indicados
     *
     * @return array de datos de plantilla
     */
    function get_by_filtros($filtros = NULL)
    {
        // Filtros generales
        $this->procesar_filtros_generales($filtros);
        // Consulta
        $this->db->from($this->view);
        $results=$this->db->get()->result();
        // Set datos adicionales
        $this->set_datos_adicionales_listado($results);
        // Return
        return $results;
    }

    /**
     * Duplica los datos de un cliente
     *
     * @return datos del cliente
     */
    function duplicar($cliente)
    {
        // Conversión de Datos
        unset($cliente->id);
        // Ponemos estos ids para que no de error de unique constraint
        $cliente->nif = uniqid();
        $cliente->correo = uniqid();
        unset($cliente->fecha_alta);
        unset($cliente->fecha_actualizacion);
        // Crear duplicado
        return $this->create($cliente);
    }
    
    /**
     * Devuelve el identificador del cliente que coincide con el email indicado
     *
     * @param [$email]		E-mail del cliente
     * 
     * @return Int con el identificador del cliente
     */
    
    function get_id_by_email($email)
    {
        $this->db->select($this->table.'.id');
        $this->db->from($this->table);
        $this->db->where("correo",$email);
        $row=$this->db->get()->row();
        if($row)
        {
            return $row->id;
        }
        else
        {
            return NULL;
        }
    }

    /**
     * Devuelve un array de intereses en formato dropdown
     *
     * @return array de intereses en formato dropdown
     */
    function get_intereses_dropdown($default = "",$get_default=TRUE)
    {
        $intereses = array();
        if($get_default)
        {
            $intereses[$default] = '- Seleccione interés -';
        }
        $intereses[1] = 'Ofrece algún inmueble en venta';
        $intereses[2] = 'Ofrece algún inmueble en alquiler';
        $intereses[3] = 'Demanda inmuebles en alquiler';
        $intereses[4] = 'Demanda inmuebles en venta';
        return $intereses;
    }
    
    /**
     * Devuelve un array de tipo de intereses en formato dropdown
     *
     * @return array de tipo de intereses en formato dropdown
     */
    function get_tipo_intereses_dropdown($default = "")
    {
        $intereses = array();
        $intereses[$default] = '- Seleccione -';
        $intereses[0] = 'La demanda u oferta es actual';
        $intereses[1] = 'La demanda u oferta es antigua';
        return $intereses;
    }

    /**
     * Devuelve toda la información de un cliente
     *
     * @return array con toda la información del cliente
     */
    function get_info($id)
    {
        // Estos devuelven las informaciones de las tablas pero no de las vistas
        //$info = $this->with_poblacion()->with_pais()->with_demandas()->with_propiedades()->get($id);
        //$info = $this->with_demandas()->with_propiedades()->get($id);
        $info = $this->get_by_id($id);
        if($info)
        {
            // Modelos axiliares
            $this->load->model('Inmueble_model');
            $this->load->model('Demanda_model');
            // Consulta de propiedades
            $info->propiedades = $this->Inmueble_model->get_propiedades_cliente($id);
            $info->inmuebles_demandados = $this->Demanda_model->get_inmuebles_demandados($id);
            $info->demandas = $this->Demanda_model->get_view_demandas_cliente($id);
            // Devolvemos toda la información calculada
            return $info;
        }
        else
        {
            return NULL;
        }
    }
    
    /**
     * Devuelve un array de clientes en formato dropdown
     *
     * @return array de clientes en formato dropdown
     */
    
    function get_clientes_dropdown($default_value="")
    {
        // Array de clientes
        $clientes=$this->order_by('apellidos')->get_all();
        // Drop down
        $array_clientes=$this->dropdown($clientes);
        // Selección inicial
        $seleccion[$default_value]="- Seleccione cliente -";
        // Suma de ambos
        return ($seleccion+$array_clientes);
    }  
    
    function dropdown($object_array) {
        // Datos necesarios
        $array_valores=array();        
        // Eliminamos repetidos de objetos
        if($object_array)
        {
            foreach($object_array as $object) {
                    $array_valores[$object->id]=$object->apellidos.", ".$object->nombre;
            }
        }
        return $array_valores;
    }
    
    /**
     * Asigna el inmueble a la cliente
     *
     * @param [$cliente_id]              Indentificador de la cliente
     * @param [$inmueble_id]             Indentificador del inmueble
     *
     * @return TRUE OR FALSE
     */
    public function asignar_inmueble($cliente_id,$inmueble_id)
    {
        if(empty($inmueble_id))
        {
            return TRUE;
        }       
        else
        {
            $inmuebles_seleccionados=array( 0 => $inmueble_id);
            return $this->asociar_inmuebles($cliente_id, $inmuebles_seleccionados);
        }        
    }
    
    /**
     * Asigna los inmuebles seleccionados al cliente especificado
     *
     * @param [$id]                         Identificador del cliente
     * @param [$inmuebles_seleccionados]    Array de identificadores de inmuebles seleccionados
     *
     * @return TRUE si todo fue bien o exception
     */
    function asociar_inmuebles($cliente_id, $inmuebles_seleccionados) {
        // Modelos axiliares
        $this->load->model('Cliente_inmueble_model');
        // Asignación de inmuebles
        $datos['cliente_id']=$cliente_id;
        foreach($inmuebles_seleccionados as $inmueble_id)
        {
            $datos['inmueble_id']=$inmueble_id;
            $this->Cliente_inmueble_model->insert($datos);            
        }
        return TRUE;
    }
    
    /**
     * Quita los inmuebles seleccionados al cliente especificado
     *
     * @param [$cliente_id]                 Identificador del cliente
     * @param [$inmuebles_seleccionados]    Array de identificadores de inmuebles seleccionados
     *
     * @return Número de inmuebles borrado para el cliente seleccionado
     */
    function quitar_inmueble($cliente_id, $inmueble_id) {
        // Modelos axiliares
        $this->load->model('Cliente_inmueble_model');
        // Borrado de inmueble
        $datos['cliente_id']=$cliente_id;
        $datos['inmueble_id']=$inmueble_id;
        return $this->Cliente_inmueble_model->delete($datos);
    }
    
    /**
     * Devuelve los inmuebles que se pueden asociar al cliente especificado
     *
     * @param [$id]                         Identificador del cliente
     *
     * @return array de identificadores de inmuebles que se pueden asociar al cliente especificado
     */
    function get_inmuebles_asociar($id) {
        // Modelos axiliares
        $this->load->model('Inmueble_model');
        $this->load->model('Demanda_model');
        // Consulta de propiedades
        $propiedades = $this->Inmueble_model->get_propiedades_cliente($id);
        $inmuebles_demandados = $this->Demanda_model->get_inmuebles_demandados($id);
        // Calculamos los ids de los inmuebles que no se pueden asignar a partir de los demandados y las propiedades actuales
        $array_ids_inmuebles_demandados=$this->utilities->get_keys_objects_array($inmuebles_demandados,'id');
        $array_ids_propiedades=$this->utilities->get_keys_objects_array($propiedades,'id');
        // Suma de ambos
        $array_ids_incompatibles = array_merge($array_ids_inmuebles_demandados, $array_ids_propiedades);
        // Devuelve los inmubles que no estén contenidos en los incompatibles
        return $this->Inmueble_model->get_inmuebles_excepciones($array_ids_incompatibles);
    }
    
    /**
     * Comprueba que ningún inmueble ya está asociado al cliente
     *
     * @param [$cliente_id]                 Identificador del inmueble
     * @param [$inmuebles]                  Array de identificadores de clientes seleccionados
     *
     * @return TRUE OR FALSE
     */
    function check_asociar_inmuebles($cliente_id,$inmuebles)
    {
        $this->load->model('Cliente_inmueble_model');
        // Consulta
        $exists=$this->Cliente_inmueble_model->check_exists_inmuebles_cliente($cliente_id,$inmuebles);
         // Si existen
        if ($exists)
        {
            $this->set_error('Algunos de los inmuebles seleccionados están asignados al cliente actual');
            return FALSE;
        }
        else
        {
            return TRUE;
        }
    }
    
    /**
     * Devuelve los clientes que son propietarios de un inmueble en un idioma determinado
     *
     * @param [$inmueble_id]		Identificador del inmueble
     * 
     * @return Array con la información de los propietarios
     */
    
    function get_propietarios_inmueble($inmueble_id)
    {
        $this->db->select($this->view.'.*');
        $this->db->from($this->view);
        $this->db->join('clientes_inmuebles', 'clientes_inmuebles.cliente_id='.'v_clientes.id');
        $this->db->where("inmueble_id",$inmueble_id);
        return $this->db->get()->result();
    }
    
    /**
     * Devuelve los clientes que no están contenidos en el listado
     *
     * @param [$array_exceptions]	Array de identificador de clientes que no pueden asociarse
     * 
     * @return Array con la información de los clientes
     */
    
    function get_clientes_excepciones($array_exceptions)
    {
        // Consulta
        $this->db->select($this->view.'.*');
        $this->db->from($this->view);
        if(is_array($array_exceptions) && count($array_exceptions)>0)
        {
            $this->db->where_not_in("id",$array_exceptions);
        }
        return $this->db->get()->result();
    }

    /**
     * Realizar el proceso de importación de clientes por CSV
     *
     * @return void
     */
    function import_csv()
    {
        // Opciones de configuración para subida de csv
        $config['upload_path'] = './uploads/temp';
        $config['allowed_types'] = 'csv';
        $config['file_name'] = 'import_clientes.csv';
        $config['overwrite'] = TRUE;
        $config['max_size'] = (MEGABYTE*ini_get('post_max_size'));

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('fichero'))
        {
            $this->set_error($this->upload->display_errors());
            return FALSE;
        }
        else
        {
            // Realizamos análisis y validación de datos
            return $this->_get_import_csv();
        }
    }

    /**
     * Realiza validación de todos los datos del fichero CSV importado
     * 
     * @return array con los datos validados y formateados y los errores encontrados
     */
    private function _get_import_csv()
    {
        // Fichero a leer
        $filename = FCPATH . 'uploads/temp/import_clientes.csv';
        // Comprobación
        if (file_exists($filename))
        {
            // Cargamos librería CSVReader
            $this->load->library('CSVReader');
            // Leemos los datos
            $csv = $this->csvreader->parse_file($filename, FALSE);
            // Dorsales importados
            $emails_importados = array();
            // Dnis importados
            $nifs_importados = array();
            // Contador CSV
            $cont = 0;
            // Lectura CSV
            foreach ($csv as $data_csv)
            {
                $cont++;
                // Ignoramos la cabecera
                if($cont!=1)
                {
                    // Procesar datos
                    $linedata = array();

                    // Asignación datos
                    $linedata['nif'] = @$data_csv[0];
                    $linedata['nombre'] = @$data_csv[1];
                    $linedata['apellidos'] = @$data_csv[2];
                    $linedata['fecha_nac'] = @$data_csv[3];
                    $linedata['direccion'] = @$data_csv[4];
                    $linedata['correo'] = @$data_csv[5];
                    $linedata['telefonos'] = @$data_csv[6];
                    $linedata['nombre_pais'] = @$data_csv[7];
                    $linedata['nombre_provincia'] = @$data_csv[8];
                    $linedata['nombre_poblacion'] = @$data_csv[9];
                    $linedata['nombre_estado'] = @$data_csv[10];
                    $linedata['nombre_medio_captacion'] = @$data_csv[11];
                    $linedata['observaciones'] = @$data_csv[12];

                    // Conversión de todos los elementos del array                
                    $linedata=$this->utilities->encoding_array($linedata,'windows-1252','UTF-8//IGNORE');

                    // Validación de datos
                    $datos_validados = $this->_validar_datos_cliente($linedata, $nifs_importados, $emails_importados);

                    // Se anota como email importado
                    if (!empty($linedata['correo']))
                    {
                        $emails_importados[] = $linedata['correo'];
                    }

                    // Se anota como nif importado
                    if (!empty($linedata['nif']))
                    {
                        $nifs_importados[] = $linedata['nif'];
                    }

                    // Resultados
                    $import[] = $datos_validados;
                }
            }
        }
        else
        {
            $this->set_error("El fichero cargado no existe. Por favor, inténtelo de nuevo.");
            return FALSE;
        }
        // Resultado final
        return $import;
    }

    /**
     * Realiza validación de los datos de un cliente importado por CSV. Se realiza conversión de datos anotando los errores encontrados, y si todo fue bien, 
     * se pasa a reutilizar la validación de los datos respecto a lo almacenado en la bd
     *
     * @param [$linedata]                         Array con los datos leidos del CSV
     * @param [$nifs_importados]                  Array de nifs importados previamente
     * @param [$emails_importados]                Array de emails importados previamente
     * 
     * @return array con los datos validados y formateados y los errores encontrados
     */
    
    private function _validar_datos_cliente($linedata, $nifs_importados, $emails_importados)
    {
        // Hay que reconvertir los datos de validación para que puedan pasar el validation
        $datos_formateados = $this->_format_datos_import_csv($linedata, $nifs_importados, $emails_importados);
        $datos_formateados['texto_errores'] = NULL;
        if (!$datos_formateados['error'])
        {
            // Reseteamos datos de validación anterior
            $this->form_validation->reset_validation();
            // Inicializamos los datos de validación para reutilizar la validación del cliente
            $this->form_validation->set_data($datos_formateados);
            // Realizamos validacion
            if (!$this->validation())
            {
                $datos_formateados['error'] = TRUE;
                $datos_formateados['texto_errores'] = validation_errors('<p><strong>','</strong></p>');
            }
        }

        return $datos_formateados;
    }

    /**
     * Detectamos errores de reconversión de datos del CSV a formato de BD y realizamos la conversión
     *
     * @param [$linedata]                         Array con los datos leidos del CSV
     * @param [$nifs_importados]                  Array de nifs importados previamente
     * @param [$emails_importados]                Array de emails importados previamente
     * 
     * @return array con los datos importados y reconvertidos
     */
    private function _format_datos_import_csv($linedata, $nifs_importados, $emails_importados)
    {
        // Procesar datos
        $error = FALSE;

        // Comprueba que no está repetido
        if (!is_null($emails_importados))
        {
            if (in_array($linedata['correo'], $emails_importados))
            {
                $linedata['correo'].=' <span class="label label-warning">Repetido</span>';
                $error = TRUE;
            }
        }

        // Comprueba que no está repetido
        if (!is_null($nifs_importados))
        {
            if (in_array($linedata['nif'], $nifs_importados))
            {
                $linedata['nif'].=' <span class="label label-warning">Repetido</span>';
                $error = TRUE;
            }
        }

        // Estado
        $linedata['estado_id'] = $this->Estado_model->get_id_by_nombre(1,$linedata['nombre_estado']);
        if (empty($linedata['estado_id']))
        {
            $linedata['nombre_estado'].=' <span class="label label-warning">No existe</span>';
            $error = TRUE;
        }
        
        // Medio captación
        $linedata['medio_captacion_id'] = $this->Medio_captacion_model->get_id_by_nombre($linedata['nombre_medio_captacion']);
        if (empty($linedata['medio_captacion_id']))
        {
            $linedata['nombre_medio_captacion'].=' <span class="label label-warning">No existe</span>';
            $error = TRUE;
        }
        
        // País
        $linedata['pais_id'] = $this->Pais_model->get_id_by_nombre($linedata['nombre_pais']);
        if (empty($linedata['pais_id']))
        {
            $linedata['nombre_pais'].=' <span class="label label-warning">No existe</span>';
            $error = TRUE;
        }

        // Se comprueba la provincia y municipio si procede
        if (!empty($linedata['pais_id']) && !$this->utilities->es_pais_extranjero($linedata['pais_id']))
        {
            // Provincia
            $linedata['provincia_id'] = $this->Provincia_model->get_id_by_nombre($linedata['nombre_provincia']);
            if (empty($linedata['provincia_id']))
            {
                $linedata['nombre_provincia'].=' <span class="label label-success">No existe</span>';
                $error = TRUE;
            }
            else
            {
                // Población
                $linedata['poblacion_id'] = $this->Poblacion_model->get_id_by_nombre($linedata['nombre_poblacion'],$linedata['provincia_id']);
                if (!$linedata['poblacion_id'])
                {
                    $linedata['nombre_poblacion'].=' <span class="label label-success">No existe</span>';
                    $error = TRUE;
                }
            }
        }
        else
        {
            $linedata['nombre_poblacion'] = NULL;
            $linedata['nombre_provincia'] = NULL;
            $linedata['provincia_id'] = NULL;
            $linedata['poblacion_id'] = NULL;
        }

        // Marcamos si ha habido errores
        $linedata['error'] = $error;

        // Devolvemos la linea de datos formateada
        return $linedata;
    }

    /**
     * Devuelve los datos formateado desde un CSV
     *
     * @return array con los datos formateado
     */
    public function get_csv_formatted_datas($data)
    {
        $datos=array();
        
        $datos['nif'] = $data['nif'];
        $datos['nombre'] = $data['nombre'];
        $datos['apellidos'] = $data['apellidos'];
        $datos['fecha_nac'] = $this->utilities->cambiafecha_form($data['fecha_nac']);
        $datos['direccion'] = $data['direccion'];
        $datos['correo'] = $data['correo'];
        $datos['observaciones'] = $data['observaciones'];
        $datos['telefonos'] = $data['telefonos'];
        $datos['pais_id'] = $data['pais_id'];
        $datos['estado_id'] = $data['estado_id'];
        $datos['medio_captacion_id'] = $data['medio_captacion_id'];
        $datos['poblacion_id'] = $data['poblacion_id'];
        $datos['agente_asignado_id'] = $this->data['session_user_id'];

        return $datos;
    }

    /**
     * Realiza el proceso de importación volviendo a validar los datos de entrada y borrando el csv introducido
     *
     * @return array con los datos importados si todo fue bien o en caso contrario FALSE
     */
    public function do_import_csv()
    {
        // Realizamos la validación nuevamente
        $importdata = $this->_get_import_csv();
        // Se procesan los datos
        if($importdata)
        {
            foreach ($importdata as $key => $data)
            {
                if (!$data['error'])
                {
                    // Creación
                    $id = $this->create($this->get_csv_formatted_datas($data));
                    //Fin comprobaciones
                    $importdata[$key]['importado'] = ($id) ? TRUE : FALSE;
                }
                else
                {
                    $importdata[$key]['importado'] = FALSE;
                }
            }
            
            if(file_exists(FCPATH . 'uploads/temp/import_clientes.csv'))
            {
                if(!unlink(FCPATH . 'uploads/temp/import_clientes.csv'))
                {
                    $this->set_error('El fichero de importación no ha podido ser borrado. Inténtelo más tarde');
                    return FALSE;
                }
            }
        }
        // Devolvemos resultados importados
        return $importdata;
    }        
    
    /**
     * Calcula el número de clientes agrupados por estado
     *
     * @param [$personal]          Indica si la estadística es personal
     * @param [$historico]         Indica si la estadística pertenece al histórico, está vigente o son todas
     * 
     * @return array
     */
    function get_stats_by_estado($personal=1,$historico=0)
    {
        $this->db->select('estados.nombre as label,count(*) as data');
        $this->db->from($this->table);
        $this->db->join('estados', $this->table.'.estado_id=estados.id');    
        if($historico!=2)
        {
            $this->db->where('historico', $historico);
        }
        if($personal)
        {
            $this->db->where('agente_asignado_id', $this->data['session_user_id']);
        }
        $this->db->group_by($this->table.'.estado_id');
        return $this->db->get()->result();
    }
    
    /**
     * Calcula el número de clientes agrupados por interes
     *
     * @param [$tipo_interes]      Indica el tipo de interés (si es vigente o histórico)
     * @param [$personal]          Indica si la estadística es personal
     * @param [$historico]         Indica si la estadística pertenece al histórico, está vigente o son todas
     * 
     * @return array
     */
    function get_stats_by_interes($personal=1,$historico=0,$tipo_interes=0)
    {
        $intereses=$this->get_intereses_dropdown("",FALSE);
        $array=array();
        foreach ($intereses as $key => $value)
        {
            $row['label']=$value;
            $row['data']=$this->get_num_stats_by_interes_id($key,$tipo_interes,$personal,$historico);
            if($row['data'])
            {
                array_push($array, $row);
            }
        }
        // Hay que devolver NULL si no hay datos que mostrar
        if(count($array)==0)
        {
            return NULL;
        }
        return $array;
    }
    
    /**
     * Calcula el número de clientes agrupados por interes
     *
     * @param [$interes_id]         Indica la interes a consulta
     * @param [$personal]          Indica si la estadística es personal
     * @param [$historico]         Indica si la estadística pertenece al histórico, está vigente o son todas
     * 
     * @return array
     */
    function get_num_stats_by_interes_id($interes_id,$tipo_interes_id,$personal=1,$historico=0)
    {
        // Filtros
        $filtros['interes_id']=$interes_id;
        $filtros['tipo_interes_id']=$tipo_interes_id;
         // Filtros generales
        $this->procesar_filtros_generales($filtros);
        // Select
        $this->db->select($this->view.'.id');
        $this->db->from($this->view);   
        if($historico!=2)
        {
            $this->db->where($this->view.'.historico_estado', $historico);
        }
        if($personal)
        {
            $this->db->where($this->view.'.agente_asignado_id', $this->data['session_user_id']);
        }
        // Consulta
        return $this->db->get()->num_rows();
    }
    
    /**
     * Calcula el número de clientes por mes
     *
     * @param [$personal]          Indica si la estadística es personal
     * 
     * @return array
     */
    function get_stats_by_alta($anio,$personal=1)
    {
        $this->db->select('mes_alta,count(*) as total');
        $this->db->from($this->view);
        if($personal)
        {
            $this->db->where('agente_asignado_id', $this->data['session_user_id']);
        }
        $this->db->where('anio_alta', $anio);
        $this->db->group_by($this->view.'.mes_alta');
        return $this->db->get()->result();
    }
    
    /**
     * Calcula el número de clientes por mes
     *
     * @param [$personal]          Indica si la estadística es personal
     * 
     * @return array
     */
    function get_anios_stats($personal=1)
    {
        $this->db->select('distinct(anio_alta) as anio');
        $this->db->from($this->view);
        if($personal)
        {
            $this->db->where('agente_asignado_id', $this->data['session_user_id']);
        }
        return $this->db->get()->result();
    }
    
    /**
     * Calcula el número de clientes por mes
     *
     * @param [$personal]          Indica si la estadística es personal
     * 
     * @return array
     */
    function get_dropdown_anios_stats($personal=1)
    {
        $result=$this->get_anios_stats($personal);
        if($result)
        {
            return $this->utilities->dropdown($result, 'anio', 'anio');
        }
        else
        {
            return NULL;
        }
    }
    
    /**
     * Devuelve el número de clientes por mes con un array en formato plot
     *
     * @param [$personal]          Indica si la estadística es personal
     * 
     * @return array
     */
    function get_stats_plot_by_alta($anio,$personal=1)
    {
        $result=$this->get_stats_by_alta($anio,$personal);
        $result_dropdown=$this->utilities->dropdown($result, 'mes_alta', 'total');  
        for($cont=1;$cont<=12;$cont++)
        {
            if(isset($result_dropdown[$cont]))
            {
                $total=intval($result_dropdown[$cont]);
            }
            else
            {
                $total=0;
            }
            $array[] = array($cont, $total);
        }
        return $array;
    }
    
    /**
     * Calcula el número de clientes agrupados por medio_captacion
     *
     * @param [$personal]          Indica si la estadística es personal
     * @param [$historico]         Indica si la estadística pertenece al histórico, está vigente o son todas
     * 
     * @return array
     */
    function get_stats_by_medio_captacion($personal=1,$historico=0)
    {
        $this->db->select('nombre_medio_captacion as label,count(*) as data');
        $this->db->from($this->view);   
        if($historico!=2)
        {
            $this->db->where('historico_estado', $historico);
        }
        if($personal)
        {
            $this->db->where('agente_asignado_id', $this->data['session_user_id']);
        }
        // Idioma
        $this->db->group_by($this->view.'.nombre_medio_captacion');
        return $this->db->get()->result();
    }
    
    /**
     * Calcula el número de clientes agrupados por agente
     *
     * @param [$historico]         Indica si la estadística pertenece al histórico, está vigente o son todas
     * 
     * @return array
     */
    function get_stats_by_agente($historico=0)
    {
        $this->db->select('nombre_agente_asignado as label,count(*) as data');
        $this->db->from($this->view);   
        if($historico!=2)
        {
            $this->db->where('historico_estado', $historico);
        }
        $this->db->where('agente_asignado_id is not null');
        // Idioma
        $this->db->group_by($this->view.'.agente_asignado_id');
        return $this->db->get()->result();
    }    
    
    /**
     * Lee los clientes en formato vista según los filtros indicados
     *
     * @return array de datos de plantilla
     */
    function get_ultimos_clientes_modificados($personal = 1, $limit = 5)
    {
        // Captador
        if($personal)
        {
            $this->db->where('agente_asignado_id', $this->data['session_user_id']);
        }
        // Fecha
        $this->db->where('fecha_actualizacion is not null');
        // Consulta
        $this->db->from($this->view);
        $this->db->order_by('fecha_actualizacion', 'desc');
        $this->db->limit($limit);
        $results=$this->db->get()->result();
        // Set datos adicionales
        $this->set_datos_adicionales_listado($results);
        // Return
        return $results;
    }
    
    /**
     * Lee los clientes en formato vista según los filtros indicados
     *
     * @return array de datos de plantilla
     */
    function get_ultimos_clientes_registrados($personal = 1, $limit = 5)
    {
        // Captador
        if($personal)
        {
            $this->db->where('agente_asignado_id', $this->data['session_user_id']);
        }
        // Consulta
        $this->db->from($this->view);
        $this->db->order_by('fecha_alta', 'desc');
        $this->db->limit($limit);
        $results=$this->db->get()->result();
        // Set datos adicionales
        $this->set_datos_adicionales_listado($results);
        // Return
        return $results;
    }

}
