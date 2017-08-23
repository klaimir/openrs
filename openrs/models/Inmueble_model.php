<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require_once APPPATH . 'core/MY_Model.php';

class Inmueble_model extends MY_Model
{

    public $idiomas_activos = array();
    public $markers = array();                  // Array de coordenadas con los markers aplicados
    public $infowindow_type = 'private';        // Indica cómo se mostrará la información si atendiendo a la descripción privada o pública el inmueble
    public $infowindow_language = NULL;         // Almacena en qué idioma se despliega la información. Si está NULL utilizará el idioma de la sesión
    public $infowindow_nombre_seo = NULL;       // Nombre seo del language establecido

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
        $this->has_one['estado'] = array('local_key' => 'estado_id', 'foreign_key' => 'id', 'foreign_model' => 'Estado_model');

        $this->has_many_pivot['propietarios'] = array(
            'foreign_model' => 'Cliente_model',
            'pivot_table' => 'clientes_inmuebles',
            'local_key' => 'id',
            'pivot_local_key' => 'inmueble_id',
            'pivot_foreign_key' => 'cliente_id',
            'foreign_key' => 'id',
            'get_relate' => TRUE
        );

        $this->has_many_pivot['opciones_extras'] = array(
            'foreign_model' => 'Opcion_extra_model',
            'pivot_table' => 'inmuebles_opciones_extras',
            'local_key' => 'id',
            'pivot_local_key' => 'inmueble_id',
            'pivot_foreign_key' => 'opcion_extra_id',
            'foreign_key' => 'id',
            'get_relate' => FALSE
        );

        $this->has_many_pivot['lugares_interes'] = array(
            'foreign_model' => 'Lugar_interes_model',
            'pivot_table' => 'inmuebles_lugares_interes',
            'local_key' => 'id',
            'pivot_local_key' => 'inmueble_id',
            'pivot_foreign_key' => 'lugar_interes_id',
            'foreign_key' => 'id',
            'get_relate' => FALSE
        );

        // Modelos axiliares
        $this->load->model('Zona_model');
        $this->load->model('Tipo_inmueble_model');
        $this->load->model('Certificacion_energetica_model');
        $this->load->model('Estado_model');
        $this->load->model('Opcion_extra_model');
        $this->load->model('Lugar_interes_model');
        $this->load->model('Inmueble_idiomas_model');
        
        // Fichero de lenguaje
        $this->lang->load('inmuebles');
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
        /* Si quisieramos ponerlo solo para insertar tendríamos que ponerlo asi
        if(empty($id))
        {
            $ref_slugify=$this->utilities->slugify($this->form_validation->get_validation_data('referencia'));
            if(empty($ref_slugify))
            {
                $ref_slugify=uniqid();
            }
            $this->form_validation->set_data_field('referencia', $ref_slugify);
            $this->form_validation->set_rules('referencia', 'Referencia', 'required|max_length[40]|is_unique_global[inmuebles;' . $id . ';referencia;id]|xss_clean');
        }
         * 
         */
        $this->form_validation->set_rules('referencia', 'Referencia', 'required|max_length[40]|is_unique_global[inmuebles;' . $id . ';referencia;id]|xss_clean');
        $this->form_validation->set_rules('metros', 'Metros totales', 'required|xss_clean|max_length[4]|is_natural_no_zero');
        $this->form_validation->set_rules('metros_utiles', 'Metros útiles', 'required|xss_clean|max_length[4]|is_natural_no_zero|less_than_equal_to[' . $this->form_validation->get_validation_data('metros') . ']');
        $this->form_validation->set_rules('habitaciones', 'Habitaciones', 'required|is_natural');
        $this->form_validation->set_rules('banios', 'Baños', 'required|is_natural');
        $this->form_validation->set_rules('anio_construccion', 'Año Construcción', 'is_natural|exact_length[4]');
        $this->form_validation->set_rules('fecha_alta', 'Fecha de alta', 'xss_clean|checkDateFormat');
        $this->form_validation->set_rules('direccion', 'Dirección', 'required|xss_clean|max_length[200]');
        $this->form_validation->set_rules('observaciones', 'Observaciones', 'trim');
        $this->form_validation->set_rules('precio_compra', 'Precio Compra', 'xss_clean|is_natural');
        $this->form_validation->set_rules('precio_alquiler', 'Precio Alquiler', 'xss_clean|is_natural');
        $this->form_validation->set_rules('precio_compra_anterior', 'Precio Compra', 'xss_clean|is_natural');
        $this->form_validation->set_rules('precio_alquiler_anterior', 'Precio Alquiler', 'xss_clean|is_natural');
        $this->form_validation->set_rules('poblacion_id', 'Población', 'required');
        $this->form_validation->set_rules('zona_id', 'Zona', 'xss_clean');
        $this->form_validation->set_rules('provincia_id', 'Provincia', 'required');
        $this->form_validation->set_rules('tipo_id', 'Tipo', 'required');
        $this->form_validation->set_rules('certificacion_energetica_id', 'Certificación energética', 'required');
        // Validación especial de kwh_m2
        $certificacion_energetica_id=$this->form_validation->get_validation_data('certificacion_energetica_id');
        $rules_kwh_m2_anio="";
        if ($certificacion_energetica_id!=8 && $certificacion_energetica_id!=9)
        {
            $rules_kwh_m2_anio.="required|max_length[5]|is_natural_no_zero|";
        }
        $this->form_validation->set_rules('kwh_m2_anio', 'Consumo Kwh/m2 anual', $rules_kwh_m2_anio . 'xss_clean');        
        $this->form_validation->set_rules('estado_id', 'Estado', 'required');
        // Cuidado que hay que poner reglas a los campos para que se puedan aplicar los helpers
        $this->form_validation->set_rules('captador_id', 'Agente Asignado', 'xss_clean');

        // Datos de la zona pública   
        if ($id)
        {
            $this->form_validation->set_rules('publicado', 'Publicado', 'xss_clean');
            $this->form_validation->set_rules('oportunidad', 'Oportunidad', 'xss_clean');
            $this->form_validation->set_rules('destacado', 'Destacado', 'xss_clean');
            
            // Reglas sólo para publicados
            $required_rules = "";
            if ($this->form_validation->get_validation_data('publicado'))
            {
                $required_rules.="required|";
            }
            // Campos públicos no dependientes del idioma
            $this->form_validation->set_rules('direccion_publica', 'Dirección Pública', $required_rules . 'xss_clean|max_length[100]');
            // Leemos los idiomas para la edición
            $array_datos_idioma = $this->Inmueble_idiomas_model->get_info_idiomas_by_inmueble($id);
            // Para cada idioma creamos su regla para los campos dependientes del idioma
            foreach ($this->idiomas_activos as $idioma)
            {
                // Según si viene con datos o no hay que mirar en toda la tabla 
                $titulo_rules = "";
                if (isset($array_datos_idioma[$idioma->id_idioma]))
                {
                    $id_inmuebles_idiomas = $array_datos_idioma[$idioma->id_idioma]->id;
                }
                else
                {
                    $id_inmuebles_idiomas = 0;
                }
                
                // Testing
                //var_dump($this->form_validation->get_validation_data('titulo_' . $idioma->id_idioma));
                //var_dump($this->form_validation->get_validation_data('url_seo_' . $idioma->id_idioma));
                //var_dump($this->utilities->slugify($this->form_validation->get_validation_data('url_seo_' . $idioma->id_idioma)));
                
                // Si el SEO está vacío entonces se generará uno a partir de su nombre   
                if (!empty($this->form_validation->get_validation_data('titulo_' . $idioma->id_idioma)) && empty($this->form_validation->get_validation_data('url_seo_' . $idioma->id_idioma)))
                {
                    // Testing
                    //var_dump('Ejecuta set_data_field '.$idioma->id_idioma);
                    $this->form_validation->set_data_field('url_seo_' . $idioma->id_idioma, $this->utilities->slugify($this->form_validation->get_validation_data('titulo_' . $idioma->id_idioma)));
                }
                // También hay que comprobarlo cuando esté rellena
                else if(!empty($this->form_validation->get_validation_data('url_seo_' . $idioma->id_idioma)))
                {
                    $this->form_validation->set_data_field('url_seo_' . $idioma->id_idioma, $this->utilities->slugify($this->form_validation->get_validation_data('url_seo_' . $idioma->id_idioma)));
                }
                
                // Si no está publicado aún ningun campo
                if (empty($required_rules) && (!empty($this->form_validation->get_validation_data('titulo_' . $idioma->id_idioma)) || !empty($this->form_validation->get_validation_data('descripcion_' . $idioma->id_idioma)) || !empty($this->form_validation->get_validation_data('url_seo_' . $idioma->id_idioma)) || !empty($this->form_validation->get_validation_data('descripcion_seo_' . $idioma->id_idioma)) || !empty($this->form_validation->get_validation_data('keywords_seo_' . $idioma->id_idioma))))
                {
                    $required_rules.="required|";
                }
                // Reglas
                //$titulo_rules = 'is_unique_global[inmuebles_idiomas;' . $id_inmuebles_idiomas . ';titulo;id]|';
                $this->form_validation->set_rules('titulo_' . $idioma->id_idioma, 'Título en ' . $idioma->nombre, $required_rules . $titulo_rules . 'max_length[70]|xss_clean');
                $this->form_validation->set_rules('descripcion_' . $idioma->id_idioma, 'Descripción del inmueble en ' . $idioma->nombre, $required_rules . 'trim');
                //$url_seo_rules = 'is_unique_global[inmuebles_idiomas;' . $id_inmuebles_idiomas . ';url_seo;id]|';
                $url_seo_rules = '';
                $this->form_validation->set_rules('url_seo_' . $idioma->id_idioma, 'URL SEO en ' . $idioma->nombre, $url_seo_rules . 'max_length[50]|xss_clean');
                $this->form_validation->set_rules('descripcion_seo_' . $idioma->id_idioma, 'Descripción SEO en ' . $idioma->nombre, $required_rules . 'max_length[150]|xss_clean');
                $this->form_validation->set_rules('keywords_seo_' . $idioma->id_idioma, 'Palabras clave SEO en ' . $idioma->nombre, $required_rules . 'max_length[255]|xss_clean');
            }
            
            // Testing
            //die();
        }
    }

    /**
     * Calcula los datos necesarios para imprimir un inmueble en un mapa de google maps en un determinado idioma
     *
     * @param [inmueble]                  Datos del inmueble
     *
     * @return array con los datos de un inmueble en un mapa de google maps
     */
    private function _get_datos_google_maps($inmueble)
    {
        $id=$inmueble->id;
        // Rescatamos los parámetros del idioma
        $id_idioma = $this->infowindow_language;
        $idioma_nombre_seo = $this->infowindow_nombre_seo;
        // Array datos
        $datos['image_path']=NULL;
        $datos['description']=lang('inmuebles_infowindow_description_no_exist');
        $datos['url_seo']=NULL;
        // Calculamos descripción
        $info=$this->Inmueble_idiomas_model->get_info_idiomas_by_inmueble($id);
        if(isset($info[$id_idioma]))
        {
            $datos['description']=$info[$id_idioma]->descripcion_seo;
            $datos['url_seo']=$idioma_nombre_seo.'/'.$id.'-'.$info[$id_idioma]->url_seo;
        }
        // Calculamos foto
        $this->load->model('Inmueble_imagen_model');
        $foto_portada=$this->Inmueble_imagen_model->get_portada($id);
        if($foto_portada)
        {
            $datos['image_path']=base_url($foto_portada->imagen);
        }
        // Precios
        $texto_precios="";
        if($inmueble->precio_compra)
        {
            $texto_precios.=" - ".number_format($inmueble->precio_compra, 0, ",", ".")." €";
        }
        if($inmueble->precio_alquiler)
        {
            $texto_precios.=" - ".number_format($inmueble->precio_alquiler, 0, ",", ".")." €";
        }
        $datos['datos_generales_1']="Ref: ".$inmueble->referencia.$texto_precios;
        // Datos generales
        $datos_generales_2=$inmueble->metros." m2";
        if($inmueble->habitaciones)
        {
            $datos_generales_2.=" - ".lang('inmuebles_infowindow_habitaciones')." ".$inmueble->habitaciones;
        }
        if($inmueble->banios)
        {
            $datos_generales_2.=" - ".lang('inmuebles_infowindow_banios')." ".$inmueble->banios;
        }
        $datos['datos_generales_2']=$datos_generales_2;
        return $datos;
    }
        
    /**
     * Comprueba que un inmueble puede ser publicado
     *
     * @param [id]                 Indentificador del elemento
     * @param [publicado]          1 si está publicado, 0 en caso contrario
     *
     * @return TRUE OR FALSE
     */            
    public function check_exists_portada($id,$publicado)
    {
        if ($id && $publicado)
        {
            $this->load->model('Inmueble_imagen_model');
            if(!$this->Inmueble_imagen_model->get_portada($id))
            {
                $this->set_error('No puede publicar un inmueble sin haber establecido una imagen como portada');
                return FALSE;
            }
        }
        
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
        if($id)
        {
            // En la edición al tener una comprobación especial, hacemos la comprobación si se pasaron el resto de validaciones
            if($this->form_validation->run())
            {
                return $this->check_exists_portada($id,$this->form_validation->get_validation_data('publicado'));
            }
            // En caso contrario, los errores son los de las reglas definidas
            else
            {
                $this->set_error(validation_errors());
                return FALSE;
            }
        }
        else
        {
            // Run form validation        
            return $this->form_validation->run();
        }
    }

    /**
     * Establece los datos para su visualización en HTML
     *
     * @param [id]                  Indentificador del elemento
     *
     * @return array con los datos especificados para utilizarlos en los diferentes helpers
     */
    public function set_datas_html($datos = NULL, $cliente_id=0)
    {
        // Selector de provincias
        $data['provincias'] = $this->Provincia_model->get_provincias_dropdown();

        // Selector de tipos_inmuebles
        $data['tipos_inmuebles'] = $this->Tipo_inmueble_model->get_tipos_inmuebles_dropdown();

        // Selector de opciones_extras
        $data['opciones_extras'] = $this->Opcion_extra_model->get_opciones_extras_dropdown();

        // Selector de lugares_interes
        $data['lugares_interes'] = $this->Lugar_interes_model->get_lugares_interes_dropdown();

        // Selector de tipos_certificacion_energetica
        $data['tipos_certificacion_energetica'] = $this->Certificacion_energetica_model->get_tipos_certificacion_energetica_dropdown();

        // Selector de estados
        $data['estados'] = $this->Estado_model->get_estados_dropdown(2);

        // Selector de agentes
        $data['agentes'] = $this->Usuario_model->get_agentes_dropdown();

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
        
        $data['kwh_m2_anio'] = array(
            'name' => 'kwh_m2_anio',
            'id' => 'kwh_m2_anio',
            'type' => 'text',
            'value' => $this->form_validation->set_value('kwh_m2_anio', is_object($datos) ? $datos->kwh_m2_anio : ""),
        );

        $data['anio_construccion'] = array(
            'name' => 'anio_construccion',
            'id' => 'anio_construccion',
            'type' => 'text',
            'value' => $this->form_validation->set_value('anio_construccion', is_object($datos) ? $this->utilities->get_sql_value_string($datos->anio_construccion, "int_cero") : ""),
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

        // Las opciones extras vendrán del info
        $data['opciones_extras_seleccionadas'] = is_object($datos) ? $datos->opciones_extras : array();

        // Los lugares de interés vendrán del info
        $data['lugares_interes_seleccionados'] = is_object($datos) ? $datos->lugares_interes : array();

        $data['tipo_id'] = $this->form_validation->set_value('tipo_id', is_object($datos) ? $datos->tipo_id : "");
        $data['certificacion_energetica_id'] = $this->form_validation->set_value('certificacion_energetica_id', is_object($datos) ? $datos->certificacion_energetica_id : "");
        $data['estado_id'] = $this->form_validation->set_value('estado_id', is_object($datos) ? $datos->estado_id : "");
        $data['captador_id'] = $this->form_validation->set_value('captador_id', is_object($datos) ? $datos->captador_id : $this->data['session_user_id']);
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
        
        $data['precio_compra_anterior'] = array(
            'name' => 'precio_compra_anterior',
            'id' => 'precio_compra_anterior',
            'type' => 'text',
            'value' => $this->form_validation->set_value('precio_compra_anterior', is_object($datos) ? $datos->precio_compra_anterior : ""),
        );

        $data['precio_alquiler'] = array(
            'name' => 'precio_alquiler',
            'id' => 'precio_alquiler',
            'type' => 'text',
            'value' => $this->form_validation->set_value('precio_alquiler', is_object($datos) ? $datos->precio_alquiler : ""),
        );

        $data['precio_alquiler_anterior'] = array(
            'name' => 'precio_alquiler_anterior',
            'id' => 'precio_alquiler_anterior',
            'type' => 'text',
            'value' => $this->form_validation->set_value('precio_alquiler_anterior', is_object($datos) ? $datos->precio_alquiler_anterior : ""),
        );

        $data['observaciones'] = array(
            'name' => 'observaciones',
            'id' => 'observaciones',
            'type' => 'text',
            'value' => $this->form_validation->set_value('observaciones', is_object($datos) ? $datos->observaciones : ""),
        );

        // Sólo para la edición (Datos de la zona pública)
        if ($datos)
        {
            // Datos no dependientes del idioma
            $data['direccion_publica'] = array(
                'name' => 'direccion_publica',
                'id' => 'direccion_publica',
                'type' => 'text',
                'value' => $this->form_validation->set_value('direccion_publica', is_object($datos) ? $datos->direccion_publica : ""),
            );

            $data['publicado_checked'] = is_object($datos) ? $datos->publicado : $this->form_validation->set_checkbox('publicado', '1');
            $data['publicado'] = is_object($datos) ? $datos->publicado : 0;

            $data['oportunidad_checked'] = is_object($datos) ? $datos->oportunidad : $this->form_validation->set_checkbox('oportunidad', '1');
            $data['oportunidad'] = is_object($datos) ? $datos->oportunidad : 0;

            $data['destacado_checked'] = is_object($datos) ? $datos->destacado : $this->form_validation->set_checkbox('destacado', '1');
            $data['destacado'] = is_object($datos) ? $datos->destacado : 0;

            // Idiomas
            $data['idiomas_activos'] = $this->idiomas_activos;
            // Leemos los idiomas para la edición
            $array_datos_idioma = $this->Inmueble_idiomas_model->get_info_idiomas_by_inmueble($datos->id);
            // Datos de idiomas
            $data['datos_idioma'] = array();
            foreach ($data['idiomas_activos'] as $idioma)
            {
                // Leemos datos de idiomas de la entrada
                if (isset($array_datos_idioma) && isset($array_datos_idioma[$idioma->id_idioma]))
                {
                    $datos_idioma = $array_datos_idioma[$idioma->id_idioma];
                }
                else
                {
                    $datos_idioma = NULL;
                }
                // Titulo
                $data['datos_idioma'][$idioma->id_idioma]['titulo'] = array(
                    'name' => 'titulo_' . $idioma->id_idioma,
                    'id' => 'titulo_' . $idioma->id_idioma,
                    'type' => 'text',
                    'value' => $this->form_validation->set_value('titulo_' . $idioma->id_idioma, is_object($datos_idioma) ? $datos_idioma->titulo : ""),
                );
                // Descripcion
                $data['datos_idioma'][$idioma->id_idioma]['descripcion'] = array(
                    'name' => 'descripcion_' . $idioma->id_idioma,
                    'id' => 'descripcion_' . $idioma->id_idioma,
                    'type' => 'text',
                    'value' => $this->form_validation->set_value('descripcion_' . $idioma->id_idioma, is_object($datos_idioma) ? $datos_idioma->descripcion : ""),
                );
                // URl SEO
                $data['datos_idioma'][$idioma->id_idioma]['url_seo'] = array(
                    'name' => 'url_seo_' . $idioma->id_idioma,
                    'id' => 'url_seo_' . $idioma->id_idioma,
                    'type' => 'text',
                    'value' => $this->form_validation->set_value('url_seo_' . $idioma->id_idioma, is_object($datos_idioma) ? $datos_idioma->url_seo : ""),
                );
                // URl SEO anterior
                $data['datos_idioma'][$idioma->id_idioma]['url_seo_anterior'] = array(
                    'name' => 'url_seo_anterior_' . $idioma->id_idioma,
                    'id' => 'url_seo_anterior_' . $idioma->id_idioma,
                    'type' => 'text',
                    'value' => $this->form_validation->set_value('url_seo_anterior_' . $idioma->id_idioma, is_object($datos_idioma) ? $datos_idioma->url_seo : ""),
                );
                // Descripción SEO
                $data['datos_idioma'][$idioma->id_idioma]['descripcion_seo'] = array(
                    'name' => 'descripcion_seo_' . $idioma->id_idioma,
                    'id' => 'descripcion_seo_' . $idioma->id_idioma,
                    'type' => 'text',
                    'value' => $this->form_validation->set_value('descripcion_seo_' . $idioma->id_idioma, is_object($datos_idioma) ? $datos_idioma->descripcion_seo : ""),
                );
                // Palabras clave SEO
                $data['datos_idioma'][$idioma->id_idioma]['keywords_seo'] = array(
                    'name' => 'keywords_seo_' . $idioma->id_idioma,
                    'id' => 'keywords_seo_' . $idioma->id_idioma,
                    'type' => 'text',
                    'value' => $this->form_validation->set_value('keywords_seo_' . $idioma->id_idioma, is_object($datos_idioma) ? $datos_idioma->keywords_seo : ""),
                );
            }
        }
        
        // Especifica si se va a demandar un cliente determinado
        if($cliente_id)
        {
            $data['cliente_id']=$cliente_id;
            $this->load->model('Cliente_model');
            $cliente=$this->Cliente_model->get_by_id($cliente_id);
            if($cliente)
            {
                $data['nif_cliente'] = $cliente->nif;
                $data['nombre_completo_cliente'] = $cliente->apellidos.", ".$cliente->nombre;
            }
            else
            {
                show_error("El cliente seleccionado para asignarse como propietario del nuevo inmueble no existe");
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
        $datas['referencia'] = $this->input->post('referencia');
        $datas['metros'] = $this->input->post('metros');
        $datas['metros_utiles'] = $this->input->post('metros_utiles');
        $datas['habitaciones'] = $this->input->post('habitaciones');
        $datas['banios'] = $this->input->post('banios');
        $datas['kwh_m2_anio'] = $this->utilities->get_sql_value_string($this->input->post('kwh_m2_anio'), "defined", $this->input->post('kwh_m2_anio'), '');
        $datas['anio_construccion'] = $this->utilities->get_sql_value_string($this->input->post('anio_construccion'), "defined", $this->input->post('anio_construccion'), '');
        $datas['fecha_alta'] = $this->utilities->cambiafecha_form($this->input->post('fecha_alta'));
        $datas['direccion'] = $this->input->post('direccion');
        $datas['observaciones'] = $this->input->post('observaciones');
        $datas['precio_compra'] = $this->input->post('precio_compra');
        $datas['precio_alquiler'] = $this->input->post('precio_alquiler');
        $datas['precio_compra_anterior'] = $this->input->post('precio_compra_anterior');
        $datas['precio_alquiler_anterior'] = $this->input->post('precio_alquiler_anterior');
        $datas['tipo_id'] = $this->input->post('tipo_id');
        $datas['certificacion_energetica_id'] = $this->input->post('certificacion_energetica_id');
        $datas['estado_id'] = $this->input->post('estado_id');
        $datas['poblacion_id'] = $this->input->post('poblacion_id');
        $datas['zona_id'] = $this->utilities->get_sql_value_string($this->input->post('zona_id'), "defined", $this->input->post('zona_id'), NULL);
        $datas['captador_id'] = $this->utilities->get_sql_value_string($this->input->post('captador_id'), "defined", $this->input->post('captador_id'), NULL);
        // Transformaciones sólo para le edición
        if ($id)
        {
            $datas['direccion_publica'] = $this->input->post('direccion_publica');
            $datas['publicado'] = $this->utilities->get_sql_value_string($this->input->post('publicado'), 'defined', $this->input->post('publicado'), 0);
            $datas['oportunidad'] = $this->utilities->get_sql_value_string($this->input->post('oportunidad'), 'defined', $this->input->post('oportunidad'), 0);
            $datas['destacado'] = $this->utilities->get_sql_value_string($this->input->post('destacado'), 'defined', $this->input->post('destacado'), 0);
        }

        return $datas;
    }

    /**
     * Devuelve los datos formateado de la interfaz de todos los idiomas
     *
     * @return array con los datos formateado
     */
    public function get_formatted_datas_idiomas()
    {
        $datos_idiomas = array();
        foreach ($this->idiomas_activos as $idioma)
        {
            $datos_idiomas[$idioma->id_idioma] = $this->get_formatted_datas_idioma($idioma->id_idioma);
        }
        return $datos_idiomas;
    }

    /**
     * Devuelve los datos formateado de la interfaz de un idioma en concreto
     *
     * @return array con los datos formateado
     */
    public function get_formatted_datas_idioma($id)
    {
        $datos["titulo"] = $this->input->post('titulo_' . $id);
        // Si introducimos el titulo entonces metemos el resto
        if (empty($datos["titulo"]))
        {
            return FALSE;
        }
        else
        {
            $datos["descripcion"] = $this->input->post('descripcion_' . $id);
            /* No hace falta ya que se hace en el set_rules para comprobar el url_seo
            // Utilizar url_title da problemas con los acentos
            // Si el SEO está vacío entonces se generará uno a partir de su nombre
            if (empty($datos["url_seo"]))
            {
                $datos["url_seo"] = $this->utilities->slugify($datos["titulo"]);
            }
            // En caso contrario formatearemos el campo introducido por el usuario
            else
            {
                $datos["url_seo"] = $this->utilities->slugify($this->input->post('url_seo_' . $id));
            }
             * 
             */
            $datos["url_seo"] = $this->form_validation->get_validation_data('url_seo_' . $id);
            $datos["descripcion_seo"] = $this->input->post('descripcion_seo_' . $id);
            $datos["keywords_seo"] = $this->input->post('keywords_seo_' . $id);
            return $datos;
        }
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
        if ($this->utilities->full_rmdir(FCPATH . 'uploads/inmuebles/' . $id))
        {
            if ($this->delete($id))
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
    function create($formatted_datas, $cliente_id=0)
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
                if (!copy(FCPATH . "uploads/inmuebles/index.html", FCPATH . "uploads/inmuebles/" . $id . "/index.html"))
                {
                    $this->set_error('Error al escribir en la carpeta de datos. Póngase en contacto con el administrador');
                    return FALSE;
                }
                // Datos adjuntos
                if (!mkdir(FCPATH . "uploads/inmuebles/" . $id . "/adjuntos", DIR_READ_MODE, true))
                {
                    $this->set_error('Error en la creación de la carpeta de adjuntos. Póngase en contacto con el administrador');
                    return FALSE;
                }
                if (!copy(FCPATH . "uploads/inmuebles/index.html", FCPATH . "uploads/inmuebles/" . $id . "/adjuntos/index.html"))
                {
                    $this->set_error('Error al escribir en la carpeta de datos. Póngase en contacto con el administrador');
                    return FALSE;
                }
                // Datos imagenes                
                if (!mkdir(FCPATH . "uploads/inmuebles/" . $id . "/imagenes", DIR_READ_MODE, true))
                {
                    $this->set_error('Error en la creación de la carpeta de adjuntos. Póngase en contacto con el administrador');
                    return FALSE;
                }
                if (!copy(FCPATH . "uploads/inmuebles/index.html", FCPATH . "uploads/inmuebles/" . $id . "/imagenes/index.html"))
                {
                    $this->set_error('Error al escribir en la carpeta de datos. Póngase en contacto con el administrador');
                    return FALSE;
                }
            }
            // Si está definido el cliente
            $this->asignar_cliente($id,$cliente_id);
            // Buscamos si casa con alguna demanda
            $this->check_demandas_coincidentes_filtros($id);
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
     * Comprueba que demandas cumplen con las características del inmuebles y los asigna a la demanda
     *
     * @param [id]                  Indentificador del elemento
     *
     * @return void
     */
    function check_demandas_coincidentes_filtros($id)
    {
        // Modelos axiliares
        $this->load->model('Demanda_model');
        
        // Consultamos información del inmueble de forma eficiente
        $inmueble=$this->with_estado()->get($id);
        // sólo vamos a analizar inmuebles que no sean históricas
        if($inmueble->estado->historico) return TRUE;
        
        // Seleccionamos demandas que no sean históricas y que tengan filtro especificado
        $demandas=$this->Demanda_model->get_demandas_aplicar_filtros_busqueda();
        //var_dump($demandas);
        
        // Para cada demanda, aplicamos su algoritmo de búsqueda
        if($demandas)
        {
            foreach ($demandas as $demanda)
            {
                $this->Demanda_model->check_inmuebles_coincidentes_filtros($demanda->id);
            }
        }
        
        return TRUE;
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
        $affected_rows = $this->update($formatted_datas, $id);
        // Testear resultado devuelo por update
        // var_dump($affected_rows); die();
        // Insertamos los datos de los idiomas
        if ($affected_rows >= 0)
        {
            $result_idiomas = $this->Inmueble_idiomas_model->save_datos_idiomas($id, $this->get_formatted_datas_idiomas());
            // Testear resultado devuelto por save_datos_idiomas
            //var_dump($result_idiomas); die();
            // Buscamos si casa con alguna demanda
            $this->check_demandas_coincidentes_filtros($id);
            // Devolverá TRUE OR FALSE;
            return $result_idiomas;
        }
        // Devolvemos error
        return FALSE;
    }
    
    /**
     * Lee los inmuebles en formato con los filtros indicados en una demanda
     *
     * @return array de datos
     */
    function get_by_filtros_demandas($filtros = NULL)
    {
        $this->db->select($this->table.'.id');
        // Filtros generales
        $this->procesar_filtros_generales($filtros);
        // Filtro certificación energética minima
        if (isset($filtros['certificacion_energetica_minima_id']) && $filtros['certificacion_energetica_minima_id'] >= 0)
        {
            $this->db->where('certificacion_energetica_id <= ', $filtros['certificacion_energetica_minima_id']);
        }
        // Años de construcción
        if (isset($filtros['anio_construccion_desde']) && $filtros['anio_construccion_desde'] != "")
        {
            $this->db->where('anio_construccion >=', $filtros['anio_construccion_desde']);
        }
        if (isset($filtros['anio_construccion_hasta']) && $filtros['anio_construccion_hasta'] != "")
        {
            $this->db->where('anio_construccion <=', $filtros['anio_construccion_hasta']);
        }
        // Filtro Zonas
        if (isset($filtros['zonas']) && is_array($filtros['zonas']) && count($filtros['zonas'])>0)
        {
            $this->db->where_in('zona_id', $filtros['zonas']);
        }
        // Filtro Tipos
        if (isset($filtros['tipos_inmuebles']) && is_array($filtros['tipos_inmuebles']) && count($filtros['zonas'])>0)
        {
            $this->db->where_in('tipo_id', $filtros['tipos_inmuebles']);
        }
        // For testing
        //var_dump($filtros);
        // Consulta
        $this->db->from($this->table);
        $this->db->join('poblaciones', $this->table.'.poblacion_id=poblaciones.id');
        $this->db->join('provincias', 'poblaciones.provincia_id=provincias.id');
        // Sólo inmuebles en estados que no sean histórico
        $this->db->join('estados', $this->table.'.estado_id=estados.id')->where('historico', 0);
        return $this->db->get()->result();
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
        // Filtro estado
        if (isset($filtros['estado_id']) && $filtros['estado_id'] >= 0)
        {
            $this->db->where('estado_id', $filtros['estado_id']);
        }
        // Ofertas        
        switch ($filtros['oferta_id'])
        {
            case 1:
                $this->db->where('precio_compra > 0');
                break;
            case 2:
                $this->db->where('precio_alquiler > 0');
                break;
            case 3:
                $this->db->where('precio_compra > 0');
                $this->db->where('precio_alquiler > 0');
                break;
            default:
                break;
        }
        // Modificaciones precio        
        switch ($filtros['modificacion_precio_id'])
        {
            case 1:
                $this->db->where('precio_compra > 0 AND precio_compra_anterior > 0  AND precio_compra_anterior > precio_compra');
                break;
            case 2:
                $this->db->where('precio_compra > 0 AND precio_compra_anterior > 0  AND precio_compra_anterior < precio_compra');
                break;
            case 3:
                $this->db->where('precio_alquiler > 0 AND precio_alquiler_anterior > 0  AND precio_alquiler_anterior > precio_alquiler');
                break;
            case 4:
                $this->db->where('precio_alquiler > 0 AND precio_alquiler_anterior > 0  AND precio_alquiler_anterior < precio_alquiler');
                break;
            default:
                break;
        }        
        // Datos de publicado
        if (isset($filtros['publicado_id']) && $filtros['publicado_id'] >= 0)
        {
            $this->db->where('publicado', $filtros['publicado_id']);
        }
        // Datos de destacado
        if (isset($filtros['destacado_id']) && $filtros['destacado_id'] >= 0)
        {
            $this->db->where('destacado', $filtros['destacado_id']);
        }
        // Datos de oportunidad
        if (isset($filtros['oportunidad_id']) && $filtros['oportunidad_id'] >= 0)
        {
            $this->db->where('oportunidad', $filtros['oportunidad_id']);
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
        // Baños
        if (isset($filtros['banios_desde']) && $filtros['banios_desde'] >0)
        {
            $this->db->where('banios >=', $filtros['banios_desde']);
        }
        if (isset($filtros['banios_hasta']) && $filtros['banios_hasta'] >0)
        {
            $this->db->where('banios <=', $filtros['banios_hasta']);
        }
        // Habitaciones
        if (isset($filtros['habitaciones_desde']) && $filtros['habitaciones_desde'] >0)
        {
            $this->db->where('habitaciones >=', $filtros['habitaciones_desde']);
        }
        if (isset($filtros['habitaciones_hasta']) && $filtros['habitaciones_hasta'] >0)
        {
            $this->db->where('habitaciones <=', $filtros['habitaciones_hasta']);
        }
        // Metros
        if (isset($filtros['metros_desde']) && $filtros['metros_desde'] >0)
        {
            $this->db->where('metros >=', $filtros['metros_desde']);
        }
        if (isset($filtros['metros_hasta']) && $filtros['metros_hasta'] >0)
        {
            $this->db->where('metros <=', $filtros['metros_hasta']);
        }
        // Precios
        if (isset($filtros['precios_desde']) && $filtros['precios_desde'] != '')
        {
            $precio_desde=$filtros['precios_desde'];
            $this->db->where("((precio_compra <> 0 AND precio_compra >= '$precio_desde') OR (precio_alquiler <> 0 AND precio_alquiler >= '$precio_desde'))");
        }
        if (isset($filtros['precios_hasta']) && $filtros['precios_hasta']  != '')
        {
            $precio_hasta=$filtros['precios_hasta'];
            $this->db->where("((precio_compra <> 0 AND precio_compra <= '$precio_hasta') OR (precio_alquiler <> 0 AND precio_alquiler <= '$precio_hasta'))");
        }
    }
    
    /**
     * Aplica datos adicionales
     *
     * @param [$results]                        Inmuebles 
     * @param [$get_datos_publicacion]          Determina si deben consultarse los datos de publicación
     *
     * @return void
     */
    function set_datos_adicionales_listado($results, $get_datos_publicacion=FALSE)
    {
        if($results)
        {
            // Modelos axiliares
            $this->load->model('Demanda_model');
            // Datos adicionales de cada inmueble
            foreach ($results as $result)
            {
                // Datos de publicación
                if($get_datos_publicacion)
                {
                    // Modelo Inmueble_imagen_model
                    $this->load->model('Inmueble_imagen_model');
                    // Obtenemos el número de imágenes de cada inmueble
                    $result->num_imagenes=$this->Inmueble_imagen_model->get_num_imagenes_inmueble($result->id);
                    // Obtenemos la portada
                    $result->portada=$this->Inmueble_imagen_model->get_portada($result->id);
                    // Modelo Inmueble_imagen_model
                    $this->load->model('Inmueble_enlace_model');
                    // Obtenemos el número de enlaces que no son videos
                    $result->num_enlaces=$this->Inmueble_enlace_model->get_num_enlaces_inmueble($result->id);
                    // Obtenemos el video
                    $result->video=$this->Inmueble_enlace_model->get_video_youtube($result->id);
                    // Modelo Inmueble_idioma_model
                    $this->load->model('Inmueble_idiomas_model');
                    // Obtenemos la url pública
                    $result->url_publica=$this->Inmueble_idiomas_model->get_url_publica($result->id,$this->data['session_id_idioma']);
                }
                else
                {
                    // Consulta de demandas
                    $result->num_demandas_totales = count($this->Demanda_model->get_demandas_inmueble($result->id));
                    $result->num_demandas_pendientes = count($this->Demanda_model->get_demandas_inmueble($result->id,1));
                    // Propuestas para visita
                    $result->num_demandas_propuestas_visita = count($this->Demanda_model->get_demandas_inmueble($result->id,2));
                }
            }
        }
    }

    /**
     * Lee los inmuebles en formato vista según los filtros indicados
     *
     * @return array de datos de plantilla
     */
    function get_by_filtros($filtros = NULL, $get_datos_publicacion=FALSE)
    {
        // Filtros generales
        $this->procesar_filtros_generales($filtros);
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
        $results=$this->db->get()->result();
        // Set datos adicionales
        $this->set_datos_adicionales_listado($results, $get_datos_publicacion);
        // Return
        return $results;
    }
    
    /**
     * Lee los inmuebles en formato vista según los filtros indicados
     *
     * @return array de datos de plantilla
     */
    function get_ultimos_inmuebles_modificados($personal = 1, $limit = 5)
    {
        // Captador
        if($personal)
        {
            $this->db->where('captador_id', $this->data['session_user_id']);
        }
        // Idioma
        $this->db->where('idioma_id', $this->data['session_id_idioma']);
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
     * Lee los inmuebles en formato vista según los filtros indicados
     *
     * @return array de datos de plantilla
     */
    function get_ultimos_inmuebles_registrados($personal = 1, $limit = 5)
    {
        // Captador
        if($personal)
        {
            $this->db->where('captador_id', $this->data['session_user_id']);
        }
        // Idioma
        $this->db->where('idioma_id', $this->data['session_id_idioma']);
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
    
    /**
     * Lee los inmuebles en formato vista según los filtros indicados
     *
     * @return array de datos de plantilla
     */
    function get_inmuebles_demandas($personal = 1, $evaluacion_id=1)
    {
        // Lista de campos
        $fieldslist=$this->utilities->getFieldsTable('v_inmuebles_demandas'); 
        $this->db->select($fieldslist);
        // Captador
        if($personal)
        {
            $this->db->where('captador_id', $this->data['session_user_id']);
        }
        // Idioma
        $this->db->where('idioma_id', $this->data['session_id_idioma']);
        // Evaluación
        $this->db->where('evaluacion_id', $evaluacion_id);
        // Consulta
        $this->db->from('v_inmuebles_demandas');
        return $this->db->get()->result();
    }
    
    /*
    function get_inmuebles_demandas($personal = 1, $evaluacion_id=1)
    {
        // Lista de campos
        $fieldslist=$this->utilities->getFieldsTable($this->view); 
        $this->db->select($fieldslist.',inmuebles_demandas.demanda_id,demandas.referencia as referencia_demanda');
        // Captador
        if($personal)
        {
            $this->db->where('captador_id', $this->data['session_user_id']);
        }
        // Idioma
        $this->db->where('idioma_id', $this->data['session_id_idioma']);
        // Consulta
        $this->db->from($this->view);
        $this->db->join('inmuebles_demandas', $this->view.'.id=inmuebles_demandas.inmueble_id')->where("evaluacion_id",$evaluacion_id);
        $this->db->join('demandas', 'demandas.id=inmuebles_demandas.demanda_id');
        $results=$this->db->get()->result();
        // Return
        return $results;
    }
     * 
     */
    
    /**
     * Duplica los datos de un inmueble
     *
     * @return datos del inmueble
     */
    function duplicar($inmueble)
    {
        // Conversión de Datos
        unset($inmueble->id);
        $inmueble->referencia = uniqid();
        $inmueble->fecha_alta = date("Y-m-d");
        unset($inmueble->fecha_actualizacion);
        // Crear duplicado
        return $this->create($inmueble);
    }

    /**
     * Devuelve un array de ofertas en formato dropdown
     *
     * @return array de ofertas en formato dropdown
     */
    function get_ofertas_dropdown($default = "")
    {
        $ofertas = array();
        $ofertas[$default] = '- Seleccione oferta -';
        $ofertas[1] = lang('inmuebles_ofertas_vender');
        $ofertas[2] = lang('inmuebles_ofertas_alquilar');
        $ofertas[3] = lang('inmuebles_ofertas_ambos');
        return $ofertas;
    }
    
    /**
     * Devuelve el texto de una oferta de inmueble
     *
     * @return string con el texto de la oferta del inmueble
     */
    function get_oferta_by_id($id)
    {
        $ofertas = $this->get_ofertas_dropdown();
        return $ofertas[$id];
    }
    
    /**
     * Devuelve un array de modificacion_precios en formato dropdown
     *
     * @return array de modificacion_precios en formato dropdown
     */
    function get_modificacion_precios_dropdown($default = "")
    {
        $modificacion_precios = array();
        $modificacion_precios[$default] = '- Seleccione modificación precio -';
        $modificacion_precios[1] = "Precio de venta rebajado";
        $modificacion_precios[2] = "Precio de venta aumentado";
        $modificacion_precios[3] = "Precio de alquiler rebajado";
        $modificacion_precios[4] = "Precio de alquiler aumentado";
        return $modificacion_precios;
    }
    
    /**
     * Devuelve un array de publicados en formato dropdown
     *
     * @return array de publicados en formato dropdown
     */
    function get_publicado_dropdown($default = "")
    {
        $publicados = array();
        $publicados[$default] = '- Indiferente -';
        $publicados[1] = 'Publicado';
        $publicados[0] = 'No Publicado';        
        return $publicados;
    }
    
    /**
     * Devuelve un array de oportunidads en formato dropdown
     *
     * @return array de oportunidads en formato dropdown
     */
    function get_oportunidad_dropdown($default = "")
    {
        $oportunidads = array();
        $oportunidads[$default] = '- Indiferente -';
        $oportunidads[1] = 'Oportunidad';
        $oportunidads[0] = 'No Oportunidad';        
        return $oportunidads;
    }
    
    /**
     * Devuelve un array de destacados en formato dropdown
     *
     * @return array de destacados en formato dropdown
     */
    function get_destacado_dropdown($default = "")
    {
        $destacados = array();
        $destacados[$default] = '- Indiferente -';
        $destacados[1] = 'Destacado';
        $destacados[0] = 'No Destacado';        
        return $destacados;
    }

    /**
     * Devuelve toda la información de un inmueble
     *
     * @return array con toda la información del inmueble
     */
    function get_info($id)
    {
        $info = $this->get($id); //$this->get_by_id($id); 
        if ($info)
        {
            // Modelos axiliares
            $this->load->model('Cliente_model');
            $this->load->model('Demanda_model');
            $this->load->model('Inmueble_opcion_extra_model');
            $this->load->model('Inmueble_lugar_interes_model');
            // Consulta de datos
            $info->propietarios = $this->Cliente_model->get_propietarios_inmueble($id);
            //$info->demandantes = $this->Demanda_model->get_demandantes_inmueble($id);
            $info->demandas = $this->Demanda_model->get_view_demandas_inmueble($id);
            $info->opciones_extras = $this->Inmueble_opcion_extra_model->get_opciones_extras_inmueble($id);
            $info->lugares_interes = $this->Inmueble_lugar_interes_model->get_lugares_interes_inmueble($id);
            // Devolvemos toda la información calculada
            return $info;
        }
        else
        {
            return NULL;
        }
    }
        
    /**
     * Devuelve toda la información de un inmueble en un idioma completo en formato vista
     *
     * @return array con toda la información del inmueble
     */
    function get_view_by_idioma($inmueble_id,$idioma_id)
    {
        $this->db->where($this->primary_key, $inmueble_id);
        $this->db->where('idioma_id', $idioma_id);
        $query = $this->db->get($this->view);
        if ($query->num_rows === 0)
            return FALSE;
        return $query->first_row();
    }
    
    /**
     * Devuelve toda la información de un inmueble en un idioma completo para la impresión de un documento
     *
     * @return array con toda la información del inmueble
     */
    function get_info_documento($inmueble_id,$idioma_id)
    {
        $info = $this->get_view_by_idioma($inmueble_id,$idioma_id);
        if ($info)
        {
            // Modelos axiliares
            $this->load->model('Inmueble_idiomas_model');
            // Consulta de datos
            $info->info_idioma = $this->Inmueble_idiomas_model->get_info($inmueble_id,$idioma_id);
            // Devolvemos toda la información calculada
            return $info;
        }
        else
        {
            return NULL;
        }
    }
    
    /**
     * Comprueba que ningún cliente ya está asociado como propietario
     *
     * @param [$inmueble_id]                Identificador del inmueble
     * @param [$clientes_seleccionados]     Array de identificadores de clientes seleccionados
     *
     * @return TRUE OR FALSE
     */
    function check_asociar_clientes($inmueble_id,$clientes)
    {
        $this->load->model('Cliente_inmueble_model');
        // Consulta
        $exists=$this->Cliente_inmueble_model->check_exists_clientes_inmueble($inmueble_id,$clientes);
         // Si existen
        if ($exists)
        {
            $this->set_error('Algunos de los clientes seleccionados están asignados al inmueble actual');
            return FALSE;
        }
        else
        {
            return TRUE;
        }
    }
    
    /**
     * Asigna el cliente al inmueble
     *
     * @param [$cliente_id]              Indentificador de la cliente
     * @param [$inmueble_id]             Indentificador del inmueble
     *
     * @return TRUE OR FALSE
     */
    public function asignar_cliente($inmueble_id,$cliente_id)
    {
        if(empty($cliente_id))
        {
            return TRUE;
        }       
        else
        {
            $clientes_seleccionados=array( 0 => $cliente_id);
            return $this->asociar_clientes($inmueble_id, $clientes_seleccionados);
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
    function asociar_clientes($inmueble_id, $clientes_seleccionados)
    {
        // Modelos axiliares
        $this->load->model('Cliente_inmueble_model');
        // Asignación de clientes
        $datos['inmueble_id'] = $inmueble_id;
        foreach ($clientes_seleccionados as $cliente_id)
        {
            $datos['cliente_id'] = $cliente_id;
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
    function quitar_cliente($cliente_id, $inmueble_id)
    {
        // Modelos axiliares
        $this->load->model('Cliente_inmueble_model');
        // Borrado de cliente
        $datos['cliente_id'] = $cliente_id;
        $datos['inmueble_id'] = $inmueble_id;
        return $this->Cliente_inmueble_model->delete($datos);
    }

    /**
     * Devuelve los clientes que se pueden asociar al inmueble especificado
     *
     * @param [$id]                         Identificador del inmueble
     *
     * @return array de identificadores de clientes que se pueden asociar al inmueble especificado
     */
    function get_clientes_asociar($id)
    {
        // Modelos axiliares
        $this->load->model('Cliente_model');
        $this->load->model('Demanda_model');
        // Consulta de propietarios
        $propietarios = $this->Cliente_model->get_propietarios_inmueble($id);
        $demandantes = $this->Demanda_model->get_demandantes_inmueble($id);
        // Calculamos los ids de los clientes que no se pueden asignar a partir de los propietarios y demandantes
        $array_ids_demandantes = $this->utilities->get_keys_objects_array($demandantes, 'id');
        $array_ids_propietarios = $this->utilities->get_keys_objects_array($propietarios, 'id');
        // Suma de ambos
        $array_ids_incompatibles = array_merge($array_ids_demandantes, $array_ids_propietarios);
        // Devuelve los clientes que no estén contenidos en los incompatibles
        return $this->Cliente_model->get_clientes_excepciones($array_ids_incompatibles);
    }
    
    
    /**
     * Comprueba que ningún demanda ya está asociado como propietario
     *
     * @param [$inmueble_id]                Identificador del inmueble
     * @param [$demandas_seleccionados]     Array de identificadores de demandas seleccionados
     *
     * @return TRUE OR FALSE
     */
    function check_asociar_demandas($inmueble_id,$demandas)
    {
        $this->load->model('Inmueble_demanda_model');
        // Consulta
        $exists=$this->Inmueble_demanda_model->check_exists_demandas_inmueble($inmueble_id,$demandas);
         // Si existen
        if ($exists)
        {
            $this->set_error('Algunos de las demandas seleccionadas están asignados al inmueble actual');
            return FALSE;
        }
        else
        {
            return TRUE;
        }
    }

    /**
     * Asigna los demandas seleccionados al inmueble especificado
     *
     * @param [$inmueble_id]                Identificador del inmueble
     * @param [$demandas_seleccionados]     Array de identificadores de demandas seleccionados
     *
     * @return TRUE si todo fue bien o exception
     */
    function asociar_demandas($inmueble_id, $demandas_seleccionados)
    {
        // Modelos axiliares
        $this->load->model('Inmueble_demanda_model');
        // Asignación de demandas
        $datos['inmueble_id'] = $inmueble_id;
        $datos['fecha_asignacion']=date("Y-m-d");
        foreach ($demandas_seleccionados as $demanda_id)
        {
            $datos['demanda_id'] = $demanda_id;
            $this->Inmueble_demanda_model->insert($datos);
        }
        return TRUE;
    }

    /**
     * Quita los demandas seleccionados al inmueble especificado
     *
     * @param [$inmueble_id]                Identificador del inmueble
     * @param [$demandas_seleccionados]      Array de identificadores de demandas seleccionados
     *
     * @return Número de demandas borrados para el inmueble seleccionado
     */
    function quitar_demanda($demanda_id, $inmueble_id)
    {
        // Modelos axiliares
        $this->load->model('Inmueble_demanda_model');
        // Borrado de demanda
        $datos['demanda_id'] = $demanda_id;
        $datos['inmueble_id'] = $inmueble_id;
        return $this->Inmueble_demanda_model->delete($datos);
    }

    /**
     * Devuelve los demandas que se pueden asociar al inmueble especificado
     *
     * @param [$id]                         Identificador del inmueble
     *
     * @return array de identificadores de demandas que se pueden asociar al inmueble especificado
     */
    function get_demandas_asociar($id)
    {
        // Modelos axiliares
        $this->load->model('Demanda_model');
        // Consulta de demandas
        $demandas = $this->Demanda_model->get_demandas_inmueble($id);
        // Calculamos los ids de los demandas que no se pueden asignar a partir de las demandas
        $array_ids_demandas = $this->utilities->get_keys_objects_array($demandas, 'demanda_id');
        // Devuelve los demandas que no estén contenidos en los incompatibles
        return $this->Demanda_model->get_demandas_excepciones($array_ids_demandas);
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
        $config['max_size'] = (MEGABYTE * ini_get('post_max_size'));

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
            // Modelos auxiliares
            $this->load->model('Cliente_model');
            // Cargamos librería CSVReader
            $this->load->library('CSVReader');
            // Leemos los datos
            $csv = $this->csvreader->parse_file($filename, FALSE);
            // Dnis importados
            $referencias_importados = array();
            // Contador CSV
            $cont = 0;
            // Lectura CSV
            foreach ($csv as $data_csv)
            {
                $cont++;
                // Ignoramos la cabecera
                if ($cont != 1)
                {
                    // Procesar datos
                    $linedata = array();

                    $cont_columnas=0;
                    
                    // Asignación datos                    
                    $linedata['referencia'] = @$data_csv[$cont_columnas++];
                    $linedata['nombre_tipo'] = @$data_csv[$cont_columnas++];
                    $linedata['fecha_alta'] = @$data_csv[$cont_columnas++];
                    $linedata['nombre_provincia'] = @$data_csv[$cont_columnas++];
                    $linedata['nombre_poblacion'] = @$data_csv[$cont_columnas++];
                    $linedata['nombre_zona'] = @$data_csv[$cont_columnas++];
                    $linedata['direccion'] = @$data_csv[$cont_columnas++];
                    $linedata['metros'] = @$data_csv[$cont_columnas++];
                    $linedata['metros_utiles'] = @$data_csv[$cont_columnas++];
                    $linedata['habitaciones'] = @$data_csv[$cont_columnas++];
                    $linedata['banios'] = @$data_csv[$cont_columnas++];
                    $linedata['precio_compra'] = @$data_csv[$cont_columnas++];
                    $linedata['precio_compra_anterior'] = @$data_csv[$cont_columnas++];
                    $linedata['precio_alquiler'] = @$data_csv[$cont_columnas++];
                    $linedata['precio_alquiler_anterior'] = @$data_csv[$cont_columnas++];
                    $linedata['nombre_certificacion_energetica'] = @$data_csv[$cont_columnas++];
                    $linedata['kwh_m2_anio'] = @$data_csv[$cont_columnas++];
                    $linedata['anio_construccion'] = @$data_csv[$cont_columnas++];
                    $linedata['nombre_estado'] = @$data_csv[$cont_columnas++];
                    $linedata['observaciones'] = @$data_csv[$cont_columnas++];
                    $linedata['email_cliente'] = @$data_csv[$cont_columnas++];

                    // Conversión de todos los elementos del array                
                    $linedata = $this->utilities->encoding_array($linedata, 'windows-1252', 'UTF-8//IGNORE');
                    
                    // For testing
                    //var_dump($linedata);

                    // Validación de datos
                    $datos_validados = $this->_validar_datos_inmueble($linedata, $referencias_importados);

                    // Se anota como referencia importado
                    if (!empty($linedata['referencia']))
                    {
                        $referencias_importados[] = $linedata['referencia'];
                    }

                    // Resultados
                    $import[] = $datos_validados;
                }
            }
            // For testing
            //die();
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
     * @param [$referencias_importados]           Array de referencias importados previamente
     * 
     * @return array con los datos validados y formateados y los errores encontrados
     */
    private function _validar_datos_inmueble($linedata, $referencias_importados)
    {
        // Hay que reconvertir los datos de validación para que puedan pasar el validation
        $datos_formateados = $this->_format_datos_import_csv($linedata, $referencias_importados);
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
                $datos_formateados['texto_errores'] = validation_errors('<p><strong>', '</strong></p>');
            }
        }

        return $datos_formateados;
    }

    /**
     * Detectamos errores de reconversión de datos del CSV a formato de BD y realizamos la conversión
     *
     * @param [$linedata]                         Array con los datos leidos del CSV
     * @param [$referencias_importados]           Array de referencias importados previamente
     * 
     * @return array con los datos importados y reconvertidos
     */
    private function _format_datos_import_csv($linedata, $referencias_importados)
    {
        // Procesar datos
        $error = FALSE;
        
        // Email cliente
        if(empty($linedata['email_cliente']))
        {
            $linedata['email_cliente'].=' <span class="label label-success">Sin especificar</span>';
            $linedata['cliente_id'] = NULL;
        }
        else
        {
            $linedata['cliente_id'] = $this->Cliente_model->get_id_by_email($linedata['email_cliente']);
            if (empty($linedata['cliente_id']))
            {
                $linedata['email_cliente'].=' <span class="label label-warning">No existe</span>';
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

        // Estado
        $linedata['estado_id'] = $this->Estado_model->get_id_by_nombre(2, $linedata['nombre_estado']);
        if (empty($linedata['estado_id']))
        {
            $linedata['nombre_estado'].=' <span class="label label-warning">No existe</span>';
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
            $linedata['poblacion_id'] = $this->Poblacion_model->get_id_by_nombre($linedata['nombre_poblacion'], $linedata['provincia_id']);
            if (!$linedata['poblacion_id'])
            {
                $linedata['nombre_poblacion'].=' <span class="label label-success">No existe</span>';
                $error = TRUE;
            }
            else
            {
                // Zona
                if(empty($linedata['nombre_zona']))
                {
                    $linedata['nombre_zona'].=' <span class="label label-success">Sin especificar</span>';
                    $linedata['zona_id'] = NULL;
                }
                else
                {
                    $linedata['zona_id'] = $this->Zona_model->get_id_by_nombre($linedata['nombre_zona'], $linedata['poblacion_id']);
                    if (!$linedata['zona_id'])
                    {
                        $linedata['nombre_zona'].=' <span class="label label-warning">No existe</span>';
                        $error = TRUE;
                    }
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
        // Datos del inmueble
        $datos_inmueble = array();
             
        $datos_inmueble['referencia'] = $data['referencia'];
        $datos_inmueble['metros'] = $data['metros'];
        $datos_inmueble['metros_utiles'] = $data['metros_utiles'];
        $datos_inmueble['habitaciones'] = $data['habitaciones'];
        $datos_inmueble['banios'] = $data['banios'];
        $datos_inmueble['kwh_m2_anio'] = $data['kwh_m2_anio'];
        $datos_inmueble['anio_construccion'] = $data['anio_construccion'];
        $datos_inmueble['fecha_alta'] = $this->utilities->cambiafecha_form($data['fecha_alta']);
        $datos_inmueble['direccion'] = $data['direccion'];
        $datos_inmueble['observaciones'] = $data['observaciones'];
        $datos_inmueble['precio_compra'] = $data['precio_compra'];
        $datos_inmueble['precio_compra_anterior'] = $data['precio_compra_anterior'];
        $datos_inmueble['precio_alquiler'] = $data['precio_alquiler'];
        $datos_inmueble['precio_alquiler_anterior'] = $data['precio_alquiler_anterior'];
        $datos_inmueble['tipo_id'] = $data['tipo_id'];
        $datos_inmueble['certificacion_energetica_id'] = $data['certificacion_energetica_id'];
        $datos_inmueble['estado_id'] = $data['estado_id'];
        $datos_inmueble['poblacion_id'] = $data['poblacion_id'];
        $datos_inmueble['zona_id'] = $this->utilities->get_sql_value_string($data['zona_id'], "defined", $data['zona_id'], NULL);
        $datos_inmueble['captador_id'] = $this->data['session_user_id'];
        $datos_formateados['inmueble'] = $datos_inmueble;
        
        // Propietario asociado
        $datos_formateados['cliente_id'] = $data['cliente_id'];

        return $datos_formateados;
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
        if ($importdata)
        {
            foreach ($importdata as $key => $data)
            {
                if (!$data['error'])
                {
                    // Datos formateados
                    $datos_formateados=$this->get_csv_formatted_datas($data);
                    // Creación
                    $id = $this->create($datos_formateados['inmueble'],$datos_formateados['cliente_id']);
                    //Fin comprobaciones
                    $importdata[$key]['importado'] = ($id) ? TRUE : FALSE;
                }
                else
                {
                    $importdata[$key]['importado'] = FALSE;
                }
            }

            if (file_exists(FCPATH . 'uploads/temp/import_inmuebles.csv'))
            {
                if (!unlink(FCPATH . 'uploads/temp/import_inmuebles.csv'))
                {
                    $this->set_error('El fichero de importación no ha podido ser borrado. Inténtelo más tarde');
                    return FALSE;
                }
            }
        }
        // Devolvemos resultados importados
        return $importdata;
    }
    
    function exists_marker($position)
    {
        // Recorremos el array de marker buscando las coordenadas
        foreach ($this->markers as $key => $marker)
        {
            $array_position=$marker['position'];
            $string_position=$position[0].",".$position[1];
            if($string_position==$array_position)
            {
                return $key;
            }
        }
        
        return FALSE;
    }
    
    public function get_infowindow_content_private($inmueble)
    {
        // Calculamos datos
        $datos=$this->_get_datos_google_maps($inmueble);
        // Incluimos los datos en un infowindow
        if($datos['image_path'])
        {
            $html_image='<img width="225" height="150" class="nav-user-photo" src="'.  $datos['image_path'] .'" alt="Imagen principal del inmueble">';
        }
        else
        {
            $html_image='Portada sin especificar';
        }
        $infowindow_content= $html_image                  
            . '<br>'. $datos['description']
            . '<br>'. $datos['datos_generales_1']
            . '<br>'. $datos['datos_generales_2']
            . '<br><a href="'.  site_url('inmuebles/edit/'.$inmueble->id) .'">Editar</a>';
        // Devolvemos el infowindow
        return $infowindow_content;
    }
    
    public function get_infowindow_content_public($inmueble)
    {
        // Calculamos datos
        $datos=$this->_get_datos_google_maps($inmueble);
        // Incluimos los datos en un infowindow
        if($datos['image_path'])
        {
            $html_image='<img width="225" height="150" class="nav-user-photo" src="'.  $datos['image_path'] .'" alt="'.lang('inmuebles_infowindow_portada_title').'">';
        }
        else
        {
            $html_image=lang('inmuebles_infowindow_portada_no_exist');
        }      
        // Url-SEO
        if($datos['url_seo'])
        {
            $url_seo='<a href="'.  site_url($datos['url_seo']) .'">'.lang('inmuebles_infowindow_view_details').'</a>';
        }
        else
        {
            $url_seo='URL-SEO sin especificar';
        }
        // Contenido
        $infowindow_content= $html_image                  
            . '<br>'. $datos['description']
            . '<br>'. $datos['datos_generales_1']
            . '<br>'. $datos['datos_generales_2']
            . '<br>'.$url_seo;
        // Añadir editar si está logueado como agente inmobiliario
        if($this->data["session_es_agente"])
        {
            $infowindow_content.=' | <a href="'.  site_url('inmuebles/edit/'.$inmueble->id) .'">Editar</a>';
        }
        // Devolvemos el infowindow
        return $infowindow_content;
    }
    
    private function add_infowindow_content($infowindow_content,$array_position)
    {
        $this->markers[$array_position]['infowindow_content'].='<hr>'.$infowindow_content;
    }
    
    public function calculate_unique_markers($inmuebles)
    {
        foreach ($inmuebles as $inmueble)
        {            
            $marker=array();
            // Formateamos la posición
            $address=$this->format_google_map_path($inmueble,$this->infowindow_type);
            $position=$this->googlemaps->get_lat_long_from_address($address);
            // Calculamos la ventana de información
            if($this->infowindow_type=="private")
            {
                $infowindow_content=$this->get_infowindow_content_private($inmueble);
            }
            else
            {
                $infowindow_content=$this->get_infowindow_content_public($inmueble);
            }
            // Si existe marker, entonces hay que anidar el infowindow content con el marker detectado
            $array_key=$this->exists_marker($position);            
            // Si existe el marker se anida al existente
            if($array_key)
            {
                $this->add_infowindow_content($infowindow_content,$array_key);
            }
            // En caso contrario, creamos uno nuevo
            else
            {
                $marker['position']=$position[0].','.$position[1];
                $marker['infowindow_content']=$infowindow_content;
                array_push($this->markers, $marker);
            }            
        }
        // For testing
        //var_dump($this->markers); die();
        // Devolvemos los markers calculados
        return $this->markers;
    }
    
    public function create_google_map($inmuebles,$filtros,$infowindow_type="private",$infowindow_language=NULL)
    {
        // Establecemos el tipo información del inmueble a mostrar y sus idiomas
        $this->infowindow_type=$infowindow_type;        
        // Si el idioma es NULL, consultamos el de la sesion
        if (is_null($infowindow_language))
        {
            $this->infowindow_language = $this->data['session_id_idioma'];
            $this->infowindow_nombre_seo = $this->data['session_idioma_nombre_seo'];
        }
        else
        {
            $this->infowindow_language = $infowindow_language;
            $this->infowindow_nombre_seo = $this->Idioma_model->get_idioma($this->infowindow_language)->nombre_seo;
        }
        // Load the library
        $this->load->library('googlemaps');
        // Config
        $config['loadAsynchronously'] = TRUE;
        // Activamos geocoding para mejorar rendimiento
        $config['geocodeCaching'] = TRUE;
        // Establecemos marcas de mapa        
        if($infowindow_type=="public")
        {
            $map_name='map_one';
            $map_div_id='google_maps1';
        }
        else
        {
            $map_name='map_two';
            $map_div_id='google_maps2';
        }
        $config['map_name'] = $map_name;
        $config['map_div_id'] = $map_div_id;        
        // Si hay filtros de provincia o población establecidos, los usamos, en caso contrario será nuestra posición actual (auto)
        $config['center']=$this->format_google_map_center($filtros);
        $config['zoom']=12;        
        // Initialize our map. Here you can also pass in additional parameters for customising the map (see below)
        $this->googlemaps->initialize($config);

        // Hay que unificar antes los markers repetidos
        $markers=$this->calculate_unique_markers($inmuebles);
        foreach($markers as $marker)
        {
            // Añadimos el marker
            $this->googlemaps->add_marker($marker);
        }

        // Para entornos que no sean development es necesario una API-KEY
        $this->load->model('Config_model');
        $config=$this->Config_model->get_config();
        $this->googlemaps->apiKey=$config->google_api_key;

        // Create the map.
        return $this->googlemaps->create_map();
    }

    public function format_google_map_path($inmueble,$infowindow_type='private')
    {
        // Obtenemos la dirección de otro lugar
        if($infowindow_type=='private')
        {
            $direccion=$inmueble->direccion;
        }
        else
        {
            $direccion=$inmueble->direccion_publica;
        }
        $direccion_formateada = "$direccion, $inmueble->nombre_poblacion, $inmueble->nombre_provincia, Spain";
        // Al parecer hay que hacerle esto porque hay nombres con acentos y demás que no los coge bien
        return $this->utilities->cleantext($direccion_formateada);
    }

    public function format_google_map_center($filtros)
    {
        if (($filtros['provincia_id'] != -1 && $filtros['provincia_id'] != "") || ($filtros['poblacion_id'] != -1 && $filtros['poblacion_id'] != ""))
        {
            if (($filtros['poblacion_id'] == -1 || $filtros['poblacion_id'] == ""))
            {
                $nombre_provincia = $this->Provincia_model->get_by_id($filtros['provincia_id'])->provincia;
                $direccion_formateada = "$nombre_provincia, Spain";
            }
            else
            {
                $nombre_poblacion = $this->Poblacion_model->get_by_id($filtros['poblacion_id'])->poblacion;
                $nombre_provincia = $this->Provincia_model->get_by_id($filtros['provincia_id'])->provincia;
                $direccion_formateada = "$nombre_poblacion, $nombre_provincia, Spain";
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
     * Determina si hay que regenarar el código QR de un inmueble pq haya cambiado su url-seo
     *
     * @param [$cliente_id]		Identificador del inmueble
     * 
     * @return Array con la información del inmueble
     */
    function check_regenerate_qr($inmueble_id)
    {
        // Carga del modelo
        $this->load->model('Inmueble_cartel_model');
        // Mirar si hay cartel generado
        $cartel=$this->Inmueble_cartel_model->get_by_inmueble($inmueble_id);
        // Leemos el url-seo anterior del inmueble en el idioma del cartel para compararlo con el actual
        if($cartel)
        {
            $idioma_id=$cartel->idioma_id;
            $url_seo_anterior=$this->input->post('url_seo_anterior_'.$idioma_id);
            $url_seo_actual=$this->input->post('url_seo_'.$idioma_id);
            // Si ahora no tiene URL-seo
            if(empty($url_seo_actual))
            {
                // Si tiene url-seo generado
                if($cartel->impreso && is_file(FCPATH . 'uploads/inmuebles/' . $inmueble_id . '/'.$cartel->hash_qr_image.'.png'))
                {
                    // Hay que borrar el cartel pq ya no tiene código QR
                    // Por si acaso no pero avisaremos
                    //$this->Cartel_model->remove($cartel);
                    return 2;
                }
            }
            else
            {
                // Si difieren, hay que regenerar el QR
                if($url_seo_anterior!=$url_seo_actual)
                {
                    return $this->Inmueble_cartel_model->reemplazar_qr_image($inmueble_id,$idioma_id,$url_seo_actual);
                }
            }
        }
        // En el resto de casos no hay que hacer acciones con el cartel
        return FALSE;
    }

    /**
     * Devuelve los inmuebles que son propiedad de un cliente en un idioma determinado
     *
     * @param [$cliente_id]		Identificador del cliente
     * @param [$id_idioma]		Identificador del idioma
     * 
     * @return Array con la información del inmueble
     */
    function get_propiedades_cliente($cliente_id, $id_idioma = NULL)
    {
        // Si el idioma es NULL, consultamos el de la sesion
        if (is_null($id_idioma))
        {
            $id_idioma = $this->data['session_id_idioma'];
        }
        // Consulta
        $this->db->select($this->view . '.*');
        $this->db->from($this->view);
        $this->db->join('clientes_inmuebles', 'clientes_inmuebles.inmueble_id=' . 'v_inmuebles.id');
        $this->db->where("idioma_id", $id_idioma);
        $this->db->where("cliente_id", $cliente_id);
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
    function get_inmuebles_excepciones($array_exceptions, $id_idioma = NULL)
    {
        // Si el idioma es NULL, consultamos el de la sesion
        if (is_null($id_idioma))
        {
            $id_idioma = $this->data['session_id_idioma'];
        }
        // Consulta
        $this->db->select($this->view . '.*');
        $this->db->from($this->view);
        $this->db->where("idioma_id", $id_idioma);
        if(is_array($array_exceptions) && count($array_exceptions)>0)
        {
            $this->db->where_not_in("id",$array_exceptions);
        }
        return $this->db->get()->result();
    }
    
    /**
     * Consulta los identificadores de las provincias existentes
     *
     *
     * @return array de identificares de provincias
     */

    function get_id_provincias_existentes()
    {
        $this->db->select('distinct(provincia_id) as provincia_id');
        $this->db->from($this->view);
        $result=$this->db->get()->result();
        return $this->utilities->get_keys_objects_array($result,'provincia_id');
    }
    
    /**
     * Consulta las provincia
     *
     * @return array de provincia
     */

    function get_provincias_existentes_dropdown($default_value="")
    {
        // Consulta existentes
        $ids_provincias=$this->get_id_provincias_existentes();
        // Consulta provincias
        $provincias=$this->Provincia_model->get_provincias_in_array($ids_provincias);        
        $provincias_dropdown=$this->utilities->dropdown($provincias, 'id', 'provincia');        
        // Selección inicial
        $seleccion[$default_value]="- Seleccione provincia -";
        return ($seleccion+$provincias_dropdown);
    }
    
    /**
     * Consulta los identificadores de las poblaciones existentes
     *
     *
     * @return array de identificares de poblaciones
     */

    function get_id_poblaciones_existentes()
    {
        $this->db->select('distinct(poblacion_id) as poblacion_id');
        $this->db->from($this->table);
        $result=$this->db->get()->result();
        return $this->utilities->get_keys_objects_array($result,'poblacion_id');
    }
    
    /**
     * Consulta las poblaciones de una provincia
     *
     * @param [$provincia_id]                  Indentificador de provincia
     *
     * @return array de poblaciones
     */

    function get_poblaciones_provincia_existentes($provincia_id)
    {
        // Consulta existentes
        $ids_poblaciones=$this->get_id_poblaciones_existentes();
        // Consulta poblaciones
        return $this->Poblacion_model->get_poblaciones_provincia_in_array($provincia_id,$ids_poblaciones);
    }
    
    /**
     * Consulta los identificadores de las zonas existentes
     *
     *
     * @return array de identificares de zonas
     */

    function get_id_zonas_existentes()
    {
        $this->db->select('distinct(zona_id) as zona_id');
        $this->db->from($this->table);
        $result=$this->db->get()->result();
        return $this->utilities->get_keys_objects_array($result,'zona_id');
    }
    
    /**
     * Consulta las zonas de una población
     *
     * @param [$poblacion_id]                  Indentificador de poblaciones
     *
     * @return array de zonas
     */

    function get_zonas_poblacion_existentes($poblacion_id)
    {
        // Consulta existentes
        $ids_zonas=$this->get_id_zonas_existentes();
        // Consulta poblaciones
        return $this->Zona_model->get_zonas_poblacion_in_array($poblacion_id,$ids_zonas);
    }
    
    /**
     * Calcula el número de inmuebles agrupados por estado
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
            $this->db->where('captador_id', $this->data['session_user_id']);
        }
        $this->db->group_by($this->table.'.estado_id');
        return $this->db->get()->result();
    }
    
    /**
     * Calcula el número de inmuebles agrupados por oferta
     *
     * @param [$personal]          Indica si la estadística es personal
     * @param [$historico]         Indica si la estadística pertenece al histórico, está vigente o son todas
     * 
     * @return array
     */
    function get_stats_by_oferta($personal=1,$historico=0)
    {
        $array=array();
        $row1['label']='Sólo venta';
        $row1['data']=$this->get_num_stats_by_oferta_id(1,$personal,$historico);
        array_push($array, $row1);
        $row2['label']='Sólo alquiler';
        $row2['data']=$this->get_num_stats_by_oferta_id(2,$personal,$historico);
        array_push($array, $row2);
        $row3['label']='Venta y alquiler';
        $row3['data']=$this->get_num_stats_by_oferta_id(3,$personal,$historico);
        array_push($array, $row3);
        // Hay que devolver NULL si no hay datos que mostrar
        if($row1['data']==0 && $row2['data']==0 && $row3['data']==0)
        {
            return NULL;
        }
        return $array;
    }
    
    /**
     * Calcula el número de inmuebles agrupados por oferta
     *
     * @param [$oferta_id]         Indica la oferta a consulta. Sólo venta, sólo alquiler o venta y alquiler
     * @param [$personal]          Indica si la estadística es personal
     * @param [$historico]         Indica si la estadística pertenece al histórico, está vigente o son todas
     * 
     * @return array
     */
    function get_num_stats_by_oferta_id($oferta_id,$personal=1,$historico=0)
    {
        $this->db->select($this->table.'.id');
        $this->db->from($this->table);
        $this->db->join('estados', $this->table.'.estado_id=estados.id');    
        if($historico!=2)
        {
            $this->db->where('historico', $historico);
        }
        if($personal)
        {
            $this->db->where('captador_id', $this->data['session_user_id']);
        }
        // Ofertas        
        switch ($oferta_id)
        {
            case 1:
                $this->db->where('(precio_compra > 0 and precio_alquiler=0)');
                break;
            case 2:
                $this->db->where('(precio_alquiler > 0 and precio_compra=0)');
                break;
            case 3:
                $this->db->where('precio_compra > 0');
                $this->db->where('precio_alquiler > 0');
                break;
            default:
                break;
        }
        return $this->db->get()->num_rows();
    }
    
    /**
     * Calcula el número de inmuebles por mes
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
            $this->db->where('captador_id', $this->data['session_user_id']);
        }
        $this->db->where('idioma_id', $this->data['session_id_idioma']);
        $this->db->where('anio_alta', $anio);
        $this->db->group_by($this->view.'.mes_alta');
        return $this->db->get()->result();
    }
    
    /**
     * Calcula el número de inmuebles por mes
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
            $this->db->where('captador_id', $this->data['session_user_id']);
        }
        $this->db->where('idioma_id', $this->data['session_id_idioma']);
        return $this->db->get()->result();
    }
    
    /**
     * Calcula el número de inmuebles por mes
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
     * Devuelve el número de inmuebles por mes con un array en formato plot
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
     * Calcula el número de inmuebles agrupados por tipo
     *
     * @param [$personal]          Indica si la estadística es personal
     * @param [$historico]         Indica si la estadística pertenece al histórico, está vigente o son todas
     * 
     * @return array
     */
    function get_stats_by_tipo($personal=1,$historico=0)
    {
        $this->db->select('nombre_tipo as label,count(*) as data');
        $this->db->from($this->view);   
        if($historico!=2)
        {
            $this->db->where('historico_estado', $historico);
        }
        if($personal)
        {
            $this->db->where('captador_id', $this->data['session_user_id']);
        }
        // Idioma
        $this->db->where('idioma_id', $this->data['session_id_idioma']);
        $this->db->group_by($this->view.'.nombre_tipo');
        return $this->db->get()->result();
    }
    
    /**
     * Calcula el número de inmuebles agrupados por agente
     *
     * @param [$historico]         Indica si la estadística pertenece al histórico, está vigente o son todas
     * 
     * @return array
     */
    function get_stats_by_agente($historico=0)
    {
        $this->db->select('nombre_captador as label,count(*) as data');
        $this->db->from($this->view);   
        if($historico!=2)
        {
            $this->db->where('historico_estado', $historico);
        }
        $this->db->where('captador_id is not null');
        // Idioma
        $this->db->where('idioma_id', $this->data['session_id_idioma']);
        $this->db->group_by($this->view.'.captador_id');
        return $this->db->get()->result();
    }
    
    /**
     * Calcula el número de inmuebles agrupados por publicacion
     *
     * @param [$personal]          Indica si la estadística es personal
     * 
     * @return array
     */
    function get_stats_by_publicacion($personal=1,$historico=0)
    {
        $array=array();
        $row1['label']='Destacados';
        $row1['data']=$this->get_num_stats_by_publicacion(1,$personal,$historico);
        array_push($array, $row1);
        $row2['label']='Oportunidades';
        $row2['data']=$this->get_num_stats_by_publicacion(2,$personal,$historico);
        array_push($array, $row2);
        $row3['label']='Sin categoría';
        $row3['data']=$this->get_num_stats_by_publicacion(3,$personal,$historico);
        array_push($array, $row3);
        $row4['label']='Sin publicar';
        $row4['data']=$this->get_num_stats_by_publicacion(4,$personal,$historico);
        array_push($array, $row4);
        // Hay que devolver NULL si no hay datos que mostrar
        if($row1['data']==0 && $row2['data']==0 && $row3['data']==0 && $row4['data']==0)
        {
            return NULL;
        }
        return $array;
    }
    
    /**
     * Calcula el número de inmuebles agrupados por publicación
     *
     * @param [$publicacion_id]         Indica la publicacion a consulta. Sólo venta, sólo alquiler o venta y alquiler
     * @param [$personal]          Indica si la estadística es personal
     * @param [$historico]         Indica si la estadística pertenece al histórico, está vigente o son todas
     * 
     * @return array
     */
    function get_num_stats_by_publicacion($publicacion_id,$personal=1,$historico=0)
    {
        $this->db->select($this->table.'.id');
        $this->db->from($this->table);
        $this->db->join('estados', $this->table.'.estado_id=estados.id');    
        if($historico!=2)
        {
            $this->db->where('historico', $historico);
        }
        if($personal)
        {
            $this->db->where('captador_id', $this->data['session_user_id']);
        }
        // Ofertas        
        switch ($publicacion_id)
        {
            case 1:
                $this->db->where('publicado',1);
                $this->db->where('destacado',1);
                break;
            case 2:
                $this->db->where('publicado',1);
                $this->db->where('oportunidad',1);
                break;
            case 3:
                $this->db->where('publicado',1);
                $this->db->where('destacado',0);
                $this->db->where('oportunidad',0);
                break;
            case 4:
                $this->db->where('publicado',0);
                break;
            default:
                break;
        }
        return $this->db->get()->num_rows();
    }
    
    /**
     * Calcula el número de inmuebles agrupados por cartel
     *
     * @param [$personal]          Indica si la estadística es personal
     * 
     * @return array
     */
    function get_stats_by_cartel($personal=1,$historico=0)
    {
        $array=array();
        $row1['label']='Impreso';
        $row1['data']=$this->get_num_stats_by_cartel(1,$personal,$historico);
        array_push($array, $row1);
        $row2['label']='Pendiente imprimir';
        $row2['data']=$this->get_num_stats_by_cartel(2,$personal,$historico);
        array_push($array, $row2);
        $row3['label']='Pendiente generar';
        $row3['data']=$this->get_num_stats_by_cartel(3,$personal,$historico);
        array_push($array, $row3);
        // Hay que devolver NULL si no hay datos que mostrar
        if($row1['data']==0 && $row2['data']==0 && $row3['data']==0)
        {
            return NULL;
        }
        return $array;
    }
    
    /**
     * Calcula el número de inmuebles agrupados por publicación
     *
     * @param [$cartel_id]         Indica la cartel a consulta. Sólo venta, sólo alquiler o venta y alquiler
     * @param [$personal]          Indica si la estadística es personal
     * @param [$historico]         Indica si la estadística pertenece al histórico, está vigente o son todas
     * 
     * @return array
     */
    function get_num_stats_by_cartel($cartel_id,$personal=1,$historico=0)
    {
        $this->db->select($this->table.'.id');
        $this->db->from($this->table);
        $this->db->join('estados', $this->table.'.estado_id=estados.id');  
        $this->db->join('inmuebles_carteles', $this->table.'.id=inmuebles_carteles.inmueble_id', 'left');
        if($historico!=2)
        {
            $this->db->where('historico', $historico);
        }
        if($personal)
        {
            $this->db->where('captador_id', $this->data['session_user_id']);
        }
        // Ofertas        
        switch ($cartel_id)
        {
            case 1:
                $this->db->where('inmuebles_carteles.impreso',1);
                break;
            case 2:
                $this->db->where('inmuebles_carteles.impreso',0);
                break;
            case 3:
                $this->db->where('inmuebles_carteles.id is null');
                break;
            default:
                break;
        }
        return $this->db->get()->num_rows();
    }

    /**
     * Marca o desmarca una opción extra para un inmueble en concreto
     *
     * @param [inmueble_id]             Indentificador del inmueble
     * @param [opcion_extra_id]         Indentificador de la opción extra
     * @param [marcar]                  1 si tiene que marcar la opción en el inmueble, 0 en caso contrario
     *
     * @return void
     */
    function marcar_opcion_extra($inmueble_id, $opcion_extra_id, $marcar)
    {
        // Carga del modelo
        $this->load->model('Inmueble_opcion_extra_model');
        // Datos de marcado
        return $this->Inmueble_opcion_extra_model->marcar($inmueble_id, $opcion_extra_id, $marcar);
    }

    /**
     * Marca o desmarca un lugar de interés para un inmueble en concreto
     *
     * @param [inmueble_id]             Indentificador del inmueble
     * @param [lugar_interes_id]         Indentificador de la opción extra
     * @param [marcar]                  1 si tiene que marcar la opción en el inmueble, 0 en caso contrario
     *
     * @return void
     */
    function marcar_lugar_interes($inmueble_id, $lugar_interes_id, $marcar)
    {
        // Carga del modelo
        $this->load->model('Inmueble_lugar_interes_model');
        // Datos de marcado
        return $this->Inmueble_lugar_interes_model->marcar($inmueble_id, $lugar_interes_id, $marcar);
    }

}
