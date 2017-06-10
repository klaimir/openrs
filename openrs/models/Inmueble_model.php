<?php defined('BASEPATH') OR exit('No direct script access allowed');

require_once APPPATH . 'core/MY_Model.php';

class Inmueble_model extends MY_Model
{
    
    public $idiomas_activos=array();

    public function __construct()
    {        
        parent::__construct();

        $this->table = 'inmuebles';
        $this->primary_key = 'id';
        $this->view = 'v_inmuebles';

        $this->has_many['demandas'] = array('local_key' => 'id', 'foreign_key' => 'inmueble_id', 'foreign_model' => 'Inmueble_demanda_model');
        $this->has_one['poblacion'] = array('local_key' => 'poblacion_id', 'foreign_key' => 'id', 'foreign_model' => 'Poblacion_model');
        $this->has_one['zona'] = array('local_key' => 'zona_id', 'foreign_key' => 'id', 'foreign_model' => 'Zona_model');
        $this->has_one['tipo'] = array('local_key' => 'tipo_id', 'foreign_key' => 'id', 'foreign_model' => 'Tipo_inmueble_model');
        $this->has_one['certificacion_energetica'] = array('local_key' => 'certificacion_energetica_id', 'foreign_key' => 'id', 'foreign_model' => 'Certificacion_energetica_model');
        
        $this->has_many_pivot['propietarios'] = array(
            'foreign_model'=>'Cliente_model',
            'pivot_table'=>'clientes_inmuebles',
            'local_key'=>'id',
            'pivot_local_key'=>'inmueble_id',
            'pivot_foreign_key'=>'cliente_id',
            'foreign_key'=>'id',
            'get_relate'=>TRUE
        );

        // Modelos axiliares
        $this->load->model('Zona_model');
        $this->load->model('Tipo_inmueble_model');
        $this->load->model('Certificacion_energetica_model');
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
        $this->form_validation->set_rules('referencia', 'Referencia', 'required|max_length[40]|is_unique_global[inmuebles;' . $id . ';referencia;id]|xss_clean');
        $this->form_validation->set_rules('metros', 'Metros totales', 'required|xss_clean|max_length[4]|is_natural_no_zero');
        $this->form_validation->set_rules('metros_utiles', 'Metros útiles', 'required|xss_clean|max_length[4]|is_natural_no_zero|less_than_equal_to['.$this->form_validation->get_validation_data('metros').']');
        $this->form_validation->set_rules('habitaciones', 'Habitaciones', 'required|is_natural');
        $this->form_validation->set_rules('banios', 'Baños', 'required|is_natural');
        $this->form_validation->set_rules('anio_construccion', 'Año Construcción', 'is_natural|exact_length[4]');
        $this->form_validation->set_rules('fecha_alta', 'Fecha de nacimiento', 'xss_clean|checkDateFormat');
        $this->form_validation->set_rules('direccion', 'Dirección', 'required|xss_clean|max_length[200]');
        $this->form_validation->set_rules('observaciones', 'Observaciones', 'trim');
        $this->form_validation->set_rules('precio_compra', 'Precio Compra', 'xss_clean|is_natural');
        $this->form_validation->set_rules('precio_alquiler', 'Precio Alquiler', 'xss_clean|is_natural');
        $this->form_validation->set_rules('poblacion_id', 'Población', 'required');
        $this->form_validation->set_rules('zona_id', 'Zona', 'xss_clean');
        $this->form_validation->set_rules('provincia_id', 'Provincia', 'required');
        $this->form_validation->set_rules('tipo_id', 'Tipo', 'required');
        $this->form_validation->set_rules('certificacion_energetica_id', 'Certificación energética', 'required');
        // Cuidado que hay que poner reglas a los campos para que se puedan aplicar los helpers
        $this->form_validation->set_rules('captador_id', 'Captador', 'xss_clean');
        /*	

	13	direccion_publica	varchar(200)	utf8_general_ci		No 	Ninguna		Cambiar Cambiar	Eliminar Eliminar	

	14	publicado	tinyint(2)			No 	0		Cambiar Cambiar	Eliminar Eliminar	

	15	estado` INT(11	utf8_general_ci		No 	activo		Cambiar Cambiar	Eliminar Eliminar	

	16	obra_nueva	varchar(30)	utf8_general_ci		No 	inmueble_usado		Cambiar Cambiar	Eliminar Eliminar	

         * 
         * 
         * 	

	18	cuota_comunidad	double			Sí 	NULL		Cambiar Cambiar	Eliminar Eliminar	

	19	forma_pago	varchar(200)	utf8_general_ci		Sí 	NULL		Cambiar Cambiar	Eliminar Eliminar	
	20	anejos	text	utf8_general_ci		Sí 	NULL		Cambiar Cambiar	Eliminar Eliminar	

	21	cargas_vivienda	text	utf8_general_ci		Sí 	NULL		Cambiar Cambiar	Eliminar Eliminar	
	22	descripcion_vivienda	text	utf8_general_ci		Sí 	NULL		Cambiar Cambiar	Eliminar Eliminar	

	23	descripcion_edificio	text	utf8_general_ci		Sí 	NULL		Cambiar Cambiar	Eliminar Eliminar	

	24	antiguedad_edificio	varchar(200)	utf8_general_ci		Sí 	NULL		Cambiar Cambiar	Eliminar Eliminar	

         */
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
        // Selector de provincias
        $data['provincias'] = $this->Provincia_model->get_provincias_dropdown();

        // Selector de tipos_inmuebles
        $data['tipos_inmuebles'] = $this->Tipo_inmueble_model->get_tipos_inmuebles_dropdown();
        
        // Selector de tipos_certificacion_energetica
        $data['tipos_certificacion_energetica'] = $this->Certificacion_energetica_model->get_tipos_certificacion_energetica_dropdown();

        // Selector de agentes
        $data['agentes'] = $this->Usuario_model->get_agentes_dropdown();

        // selector de intereses
        $data['intereses'] = $this->get_intereses_dropdown();

        // Datos
        $data['referencia'] = array(
            'name' => 'referencia',
            'id' => 'referencia',
            'type' => 'text',
            'value' => $this->form_validation->set_value('referencia', is_object($datos) ? $datos->referencia : ""),
        );

        $data['metros'] = array(
            'name' => 'metros',
            'id' => 'metros',
            'type' => 'text',
            'value' => $this->form_validation->set_value('metros', is_object($datos) ? $datos->metros : ""),
        );
        
        $data['metros_utiles'] = array(
            'name' => 'metros_utiles',
            'id' => 'metros_utiles',
            'type' => 'text',
            'value' => $this->form_validation->set_value('metros_utiles', is_object($datos) ? $datos->metros_utiles : ""),
        );

        $data['habitaciones'] = array(
            'name' => 'habitaciones',
            'id' => 'habitaciones',
            'type' => 'text',
            'value' => $this->form_validation->set_value('habitaciones', is_object($datos) ? $datos->habitaciones : ""),
        );
        
        $data['banios'] = array(
            'name' => 'banios',
            'id' => 'banios',
            'type' => 'text',
            'value' => $this->form_validation->set_value('banios', is_object($datos) ? $datos->banios : ""),
        );
        
        $data['anio_construccion'] = array(
            'name' => 'anio_construccion',
            'id' => 'anio_construccion',
            'type' => 'text',
            'value' => $this->form_validation->set_value('anio_construccion', is_object($datos) ? $datos->anio_construccion : ""),
        );
        
        $data['fecha_alta'] = array(
            'name' => 'fecha_alta',
            'id' => 'fecha_alta',
            'type' => 'text',
            'value' => $this->form_validation->set_value('fecha_alta', is_object($datos) ? $this->utilities->cambiafecha_bd($datos->fecha_alta) : date("d/m/Y")),
        );

        $data['direccion'] = array(
            'name' => 'direccion',
            'id' => 'direccion',
            'type' => 'text',
            'value' => $this->form_validation->set_value('direccion', is_object($datos) ? $datos->direccion : ""),
        );

        $data['tipo_id'] = $this->form_validation->set_value('tipo_id', is_object($datos) ? $datos->tipo_id : "");
        $data['certificacion_energetica_id'] = $this->form_validation->set_value('certificacion_energetica_id', is_object($datos) ? $datos->certificacion_energetica_id : "");
        $data['captador_id'] = $this->form_validation->set_value('captador_id', is_object($datos) ? $datos->captador_id : "-1");
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
        
        $data['zona_id'] = $this->form_validation->set_value('zona_id', is_object($datos) ? $datos->zona_id : "");

        // Selector de poblaciones
        $data['poblaciones'] = $this->Poblacion_model->get_poblaciones_dropdown($data['provincia_id']);
        
        // Selector de zonas
        $data['zonas'] = $this->Zona_model->get_zonas_dropdown($data['poblacion_id']);

        $data['precio_compra'] = array(
            'name' => 'precio_compra',
            'id' => 'precio_compra',
            'type' => 'text',
            'value' => $this->form_validation->set_value('precio_compra', is_object($datos) ? $datos->precio_compra : ""),
        );
        
        $data['precio_alquiler'] = array(
            'name' => 'precio_alquiler',
            'id' => 'precio_alquiler',
            'type' => 'text',
            'value' => $this->form_validation->set_value('precio_alquiler', is_object($datos) ? $datos->precio_alquiler : ""),
        );

        $data['observaciones'] = array(
            'name' => 'observaciones',
            'id' => 'observaciones',
            'type' => 'text',
            'value' => $this->form_validation->set_value('observaciones', is_object($datos) ? $datos->observaciones : ""),
        );

        return $data;
    }

    /**
     * Devuelve los datos formateado de la interfaz
     *
     * @return array con los datos formateado
     */
    public function get_formatted_datas($id = 0)
    {
        $datas['referencia'] = $this->input->post('referencia');
        $datas['metros'] = $this->input->post('metros');
        $datas['metros_utiles'] = $this->input->post('metros_utiles');
        $datas['habitaciones'] = $this->input->post('habitaciones');
        $datas['banios'] = $this->input->post('banios');
        $datas['anio_construccion'] = $this->utilities->get_sql_value_string($this->input->post('anio_construccion'), "int", $this->input->post('anio_construccion'), NULL);
        $datas['fecha_alta'] = $this->utilities->cambiafecha_form($this->input->post('fecha_alta'));
        $datas['direccion'] = $this->input->post('direccion');
        $datas['observaciones'] = $this->input->post('observaciones');
        $datas['precio_compra'] = $this->input->post('precio_compra');
        $datas['precio_alquiler'] = $this->input->post('precio_alquiler');
        $datas['tipo_id'] = $this->input->post('tipo_id');
        $datas['certificacion_energetica_id'] = $this->input->post('certificacion_energetica_id');
        $datas['poblacion_id'] = $this->input->post('poblacion_id');
        $datas['zona_id'] = $this->utilities->get_sql_value_string($this->input->post('zona_id'), "int", $this->input->post('zona_id'), NULL);
        $datas['captador_id'] = $this->utilities->get_sql_value_string($this->input->post('captador_id'), "int", $this->input->post('captador_id'), NULL);

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
     * Elimina al inmueble del sistema de ficheros y de la bd
     *
     * @param [id]        Identificador del inmueble en la base de datos
     *
     * @return void
     */
    function remove($id)
    {        
        // Borrado físico de la carpeta de datos
        if($this->utilities->full_rmdir(FCPATH . 'uploads/inmuebles/'.$id))
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
    function create($formatted_datas)
    {
        // Parent insert
        $id = $this->insert($formatted_datas);
        if ($id)
        {
            // Creación de carpeta
            if (!file_exists(FCPATH . "uploads/inmuebles/" . $id))
            {
                if (!mkdir(FCPATH . "uploads/inmuebles/" . $id, DIR_READ_MODE, true))
                {
                    $this->set_error('Error en la creación de la carpeta de datos. Póngase en contacto con el administrador');
                    return FALSE;
                }
                // Copiamos fichero html de protección
                if(!copy(FCPATH . "uploads/inmuebles/index.html", FCPATH . "uploads/inmuebles/" . $id."/index.html"))
                {
                    $this->set_error('Error al escribir en la carpeta de datos. Póngase en contacto con el administrador');
                    return FALSE;
                }
            }
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
     * Lee los inmuebles en formato vista según los filtros indicados
     *
     * @return array de datos de plantilla
     */
    function get_by_filtros($filtros=NULL)
    {
        // Filtro Tipo de inmueble
        if (isset($filtros['tipo_id']) && $filtros['tipo_id'] >= 0)
        {
            $this->db->where('tipo_id', $filtros['tipo_id']);
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
        // Filtro Zona
        if (isset($filtros['zona_id']) && !empty($filtros['zona_id']))
        {
            $this->db->where('zona_id', $filtros['zona_id']);
        }
        // Filtro Agente Asignado
        if (isset($filtros['captador_id']) && $filtros['captador_id'] >= 0)
        {
            $this->db->where('captador_id', $filtros['captador_id']);
        }
        // Filtro certificación energética
        if (isset($filtros['certificacion_energetica_id']) && $filtros['certificacion_energetica_id'] >= 0)
        {
            $this->db->where('certificacion_energetica_id', $filtros['certificacion_energetica_id']);
        }
        // Intereses        
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
        // Fechas
        if (isset($filtros['fecha_desde']) && $filtros['fecha_desde'] != "")
        {
            $this->db->where('fecha_alta >=', $this->utilities->cambiafecha_form($filtros['fecha_desde']));
        }
        if (isset($filtros['fecha_hasta']) && $filtros['fecha_hasta'] != "")
        {
            $this->db->where('fecha_alta <=', $this->utilities->cambiafecha_form($filtros['fecha_hasta']));
        }
        // Idioma
        if (isset($filtros['idioma_id']) && $filtros['idioma_id'] != "")
        {
            $this->db->where('idioma_id', $filtros['idioma_id']);
        }
        else
        {
            $this->db->where('idioma_id', $this->data['session_id_idioma']);
        }
        // Consulta
        $this->db->from($this->view);
        return $this->db->get()->result();
    }

    /**
     * Duplica los datos de un inmueble
     *
     * @return datos del inmueble
     */
    function duplicar($inmueble)
    {
        // Conversión de Datos
        unset($inmueble->id);
        $inmueble->direccion = '';
        unset($inmueble->fecha_alta);
        unset($inmueble->fecha_actualizacion);
        // Crear duplicado
        return $this->insert($inmueble);
    }

    /**
     * Devuelve un array de intereses en formato dropdown
     *
     * @return array de intereses en formato dropdown
     */
    function get_intereses_dropdown($default = "")
    {
        $intereses = array();
        $intereses[$default] = '- Seleccione interés -';
        $intereses[1] = 'Busca vender';
        $intereses[2] = 'Busca alquilar';
        $intereses[3] = 'Busca un alquiler';
        $intereses[4] = 'Busca comprar';
        return $intereses;
    }

    /**
     * Devuelve toda la información de un inmueble
     *
     * @return array con toda la información del inmueble
     */
    function get_info($id)
    {
        $info = $this->get_by_id($id);
        if($info)
        {
            // Modelos axiliares
            $this->load->model('Cliente_model');
            $this->load->model('Demanda_model');
            // Consulta de datos
            $info->propietarios = $this->Cliente_model->get_propietarios_inmueble($id);
            $info->demandantes = $this->Demanda_model->get_demandantes_inmueble($id);
            // Devolvemos toda la información calculada
            return $info;
        }
        else
        {
            return NULL;
        }
    }
    
    /**
     * Asigna los clientes seleccionados al inmueble especificado
     *
     * @param [$inmueble_id]                Identificador del inmueble
     * @param [$clientes_seleccionados]     Array de identificadores de clientes seleccionados
     *
     * @return TRUE si todo fue bien o exception
     */
    function asociar_clientes($inmueble_id, $clientes_seleccionados) {
        // Modelos axiliares
        $this->load->model('Cliente_inmueble_model');
        // Asignación de clientes
        $datos['inmueble_id']=$inmueble_id;
        foreach($clientes_seleccionados as $cliente_id)
        {
            $datos['cliente_id']=$cliente_id;
            $this->Cliente_inmueble_model->insert($datos);            
        }
        return TRUE;
    }
    
    /**
     * Quita los clientes seleccionados al inmueble especificado
     *
     * @param [$inmueble_id]                Identificador del inmueble
     * @param [$clientes_seleccionados]      Array de identificadores de clientes seleccionados
     *
     * @return Número de clientes borrados para el inmueble seleccionado
     */
    function quitar_cliente($cliente_id, $inmueble_id) {
        // Modelos axiliares
        $this->load->model('Cliente_inmueble_model');
        // Borrado de cliente
        $datos['cliente_id']=$cliente_id;
        $datos['inmueble_id']=$inmueble_id;
        return $this->Cliente_inmueble_model->delete($datos);
    }
    
    /**
     * Devuelve los clientes que se pueden asociar al inmueble especificado
     *
     * @param [$id]                         Identificador del inmueble
     *
     * @return array de identificadores de clientes que se pueden asociar al inmueble especificado
     */
    function get_clientes_asociar($id) {
        // Modelos axiliares
        $this->load->model('Cliente_model');
        $this->load->model('Demanda_model');
        // Consulta de propietarios
        $propietarios = $this->Cliente_model->get_propietarios_cliente($id);
        $demandantes = $this->Demanda_model->get_demandantes_inmueble($id);
        // Calculamos los ids de los clientes que no se pueden asignar a partir de los propietarios y demandantes
        $array_ids_demandantes=$this->utilities->get_keys_objects_array($demandantes,'id');
        $array_ids_propietarios=$this->utilities->get_keys_objects_array($propietarios,'id');
        // Suma de ambos
        $array_ids_incompatibles = array_merge($array_ids_demandantes, $array_ids_propietarios);
        // Devuelve los clientes que no estén contenidos en los incompatibles
        return $this->Cliente_model->get_clientes_excepciones($array_ids_incompatibles);
    }

    /**
     * Realizar el proceso de importación de inmuebles por CSV
     *
     * @return void
     */
    function import_csv()
    {
        // Opciones de configuración para subida de csv
        $config['upload_path'] = './uploads/temp';
        $config['allowed_types'] = 'csv';
        $config['file_name'] = 'import_inmuebles.csv';
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
        $filename = FCPATH . 'uploads/temp/import_inmuebles.csv';
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
            $referencias_importados = array();
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
                    $linedata['nombre_tipo'] = @$data_csv[0];
                    $linedata['referencia'] = @$data_csv[0];
                    $linedata['metros'] = @$data_csv[1];
                    $linedata['metros_utiles'] = @$data_csv[1];
                    $linedata['habitaciones'] = @$data_csv[2];
                    $linedata['banios'] = @$data_csv[2];
                    $linedata['anio_construccion'] = @$data_csv[2];
                    $linedata['fecha_alta'] = @$data_csv[3];
                    $linedata['direccion'] = @$data_csv[4];
                    $linedata['precio_compra'] = @$data_csv[6];
                    $linedata['precio_alquiler'] = @$data_csv[6];
                    $linedata['nombre_provincia'] = @$data_csv[8];
                    $linedata['nombre_poblacion'] = @$data_csv[9];
                    $linedata['nombre_zona'] = @$data_csv[9];
                    $linedata['observaciones'] = @$data_csv[10];
                    
                    //Vivienda piso 	Almería 	Zona	carretera granada 	300.000,00 	0,00 	70 	3 	2

                    // Conversión de todos los elementos del array                
                    $linedata=$this->utilities->encoding_array($linedata,'windows-1252','UTF-8//IGNORE');

                    // Validación de datos
                    $datos_validados = $this->_validar_datos_inmueble($linedata, $referencias_importados, $emails_importados);

                    // Se anota como email importado
                    if (!empty($linedata['correo']))
                    {
                        $emails_importados[] = $linedata['correo'];
                    }

                    // Se anota como referencia importado
                    if (!empty($linedata['referencia']))
                    {
                        $referencias_importados[] = $linedata['referencia'];
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
     * Realiza validación de los datos de un inmueble importado por CSV. Se realiza conversión de datos anotando los errores encontrados, y si todo fue bien, 
     * se pasa a reutilizar la validación de los datos respecto a lo almacenado en la bd
     *
     * @param [$linedata]                         Array con los datos leidos del CSV
     * @param [$referencias_importados]                  Array de referencias importados previamente
     * @param [$emails_importados]                Array de emails importados previamente
     * 
     * @return array con los datos validados y formateados y los errores encontrados
     */
    
    private function _validar_datos_inmueble($linedata, $referencias_importados, $emails_importados)
    {
        // Hay que reconvertir los datos de validación para que puedan pasar el validation
        $datos_formateados = $this->_format_datos_import_csv($linedata, $referencias_importados, $emails_importados);
        $datos_formateados['texto_errores'] = NULL;
        if (!$datos_formateados['error'])
        {
            // Reseteamos datos de validación anterior
            $this->form_validation->reset_validation();
            // Inicializamos los datos de validación para reutilizar la validación del inmueble
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
     * @param [$referencias_importados]                  Array de referencias importados previamente
     * @param [$emails_importados]                Array de emails importados previamente
     * 
     * @return array con los datos importados y reconvertidos
     */
    private function _format_datos_import_csv($linedata, $referencias_importados, $emails_importados)
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
        if (!is_null($referencias_importados))
        {
            if (in_array($linedata['referencia'], $referencias_importados))
            {
                $linedata['referencia'].=' <span class="label label-warning">Repetido</span>';
                $error = TRUE;
            }
        }

        // Tipo
        $linedata['tipo_id'] = $this->Tipo_inmueble_model->get_id_by_nombre($linedata['nombre_tipo']);
        if (empty($linedata['tipo_id']))
        {
            $linedata['nombre_tipo'].=' <span class="label label-warning">No existe</span>';
            $error = TRUE;
        }
        
        // Certificación energética
        $linedata['certificacion_energetica_id'] = $this->Certificacion_energetica_model->get_id_by_nombre($linedata['nombre_certificacion_energetica']);
        if (empty($linedata['certificacion_energetica_id']))
        {
            $linedata['nombre_certificacion_energetica'].=' <span class="label label-warning">No existe</span>';
            $error = TRUE;
        }
        
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
            else
            {
                // Zona
                $linedata['zona_id'] = $this->Zona_model->get_id_by_nombre($linedata['nombre_zona'],$linedata['poblacion_id']);
                if (!$linedata['zona_id'])
                {
                    $linedata['nombre_zona'].=' <span class="label label-success">No existe</span>';
                    $error = TRUE;
                }
            }
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
        
        $datos['referencia'] = $data['referencia'];
        $datos['metros'] = $data['metros'];
        $datos['metros_utiles'] = $data['metros_utiles'];
        $datos['habitaciones'] = $data['habitaciones'];
        $datos['banios'] = $data['banios'];
        $datos['anio_construccion'] = $data['anio_construccion'];
        $datos['fecha_alta'] = $this->utilities->cambiafecha_form($data['fecha_alta']);
        $datos['direccion'] = $data['direccion'];
        $datos['correo'] = $data['correo'];
        $datos['observaciones'] = $data['observaciones'];
        $datos['precio_compra'] = $this->utilities->formatear_numero($data['precio_compra']);
        $datos['precio_alquiler'] = $this->utilities->formatear_numero($data['precio_alquiler']);
        $datos['tipo_id'] = $data['tipo_id'];
        $datos['certificacion_energetica_id'] = $data['certificacion_energetica_id'];
        $datos['poblacion_id'] = $data['poblacion_id'];
        $datos['zona_id'] = $data['zona_id'];

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
            
            if(file_exists(FCPATH . 'uploads/temp/import_inmuebles.csv'))
            {
                if(!unlink(FCPATH . 'uploads/temp/import_inmuebles.csv'))
                {
                    $this->set_error('El fichero de importación no ha podido ser borrado. Inténtelo más tarde');
                    return FALSE;
                }
            }
        }
        // Devolvemos resultados importados
        return $importdata;
    }
    
    public function format_google_map_path($inmueble)
    {
        $direccion_formateada="$inmueble->direccion, $inmueble->nombre_poblacion, $inmueble->nombre_provincia, Spain";
        // Al parecer hay que hacerle esto porque hay nombres con acentos y demás que no los coge bien
        return $this->utilities->cleantext($direccion_formateada);
    }
    
    public function format_google_map_center($filtros)
    {
        if(($filtros['provincia_id']!=-1 && $filtros['provincia_id']!="") || ($filtros['poblacion_id']!=-1 && $filtros['poblacion_id']!=""))
        {
            if(($filtros['poblacion_id']==-1 || $filtros['poblacion_id']==""))
            {
                $nombre_provincia = $this->Provincia_model->get_by_id($filtros['provincia_id'])->provincia;
                $direccion_formateada="$nombre_provincia, Spain";
            }
            else 
            {
                $nombre_poblacion = $this->Poblacion_model->get_by_id($filtros['poblacion_id'])->poblacion;
                $nombre_provincia = $this->Provincia_model->get_by_id($filtros['provincia_id'])->provincia;
                $direccion_formateada="$nombre_poblacion, $nombre_provincia, Spain";
            }
            // Al parecer hay que hacerle esto porque hay nombres con acentos y demás que no los coge bien
            return $this->utilities->cleantext($direccion_formateada);
        }
        else
        {
            return "auto";
        }        
    }
    
    /**
     * Devuelve los inmuebles que son propiedad de un cliente en un idioma determinado
     *
     * @param [$cliente_id]		Identificador del cliente
     * @param [$id_idioma]		Identificador del idioma
     * 
     * @return Array con la información del inmueble
     */
    
    function get_propiedades_cliente($cliente_id,$id_idioma=NULL)
    {
        // Si el idioma es NULL, consultamos el de la sesion
        if(is_null($id_idioma))
        {
            $id_idioma = $this->data['session_id_idioma'];
        }
        // Consulta
        $this->db->select($this->view.'.*');
        $this->db->from($this->view);
        $this->db->join('clientes_inmuebles', 'clientes_inmuebles.inmueble_id='.'v_inmuebles.id');
        $this->db->where("idioma_id",$id_idioma);
        $this->db->where("cliente_id",$cliente_id);
        return $this->db->get()->result();
    }
    
    /**
     * Devuelve los inmuebles que no están contenidos en el listado
     *
     * @param [$array_exceptions]	Array de identificador de inmuebles que no pueden asociarse
     * @param [$id_idioma]		Identificador del idioma
     * 
     * @return Array con la información del inmueble
     */
    
    function get_inmuebles_excepciones($array_exceptions,$id_idioma=NULL)
    {
        // Si el idioma es NULL, consultamos el de la sesion
        if(is_null($id_idioma))
        {
            $id_idioma = $this->data['session_id_idioma'];
        }
        // Consulta
        $this->db->select($this->view.'.*');
        $this->db->from($this->view);
        $this->db->where("idioma_id",$id_idioma);
        $this->db->where_not_in("id",$array_exceptions);
        return $this->db->get()->result();
    }

}
