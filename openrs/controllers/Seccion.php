<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

require_once APPPATH . 'core/MY_Controller_Front.php';

class Seccion extends MY_Controller_Front
{

    function __construct()
    {
        parent::__construct();
        $this->load->helper('cookie');
        $this->load->library('ion_auth');
        $this->load->library('form_validation');
        $this->load->model('Seccion_model');
        $this->load->model('Bloque_model');
        $this->load->model('Usuario_model');
        $this->load->model('General_model');
        $this->load->model('Idioma_model');
        $this->load->model('Carrusel_model');
        $this->load->model('Provincia_model');
        $this->load->model('Poblacion_model');
        $this->load->model('Tipo_inmueble_model');
        $this->load->model('Zona_model');
        $this->load->model('Inmueble_model');
        $this->load->model('Buscador_model');
        $this->load->model('Articulo_model');
        $this->load->model('Etiqueta_model');
        $this->load->model('Inmueble_model');
        $this->load->model('Comentario_model');
        $this->load->model('Voto_model');
        // Carga de key de google analytic para seguimiento público
        $this->load->model('Config_model');
        $config = $this->Config_model->get_config();
        $this->session->set_userdata('google_analytics_ID', $config->google_analytics_ID);
        // Cargas de key para recaptcha para protección de formularios externos
        $this->session->set_userdata('recaptcha_secret_key', $config->recaptcha_secret_key);
        $this->session->set_userdata('recaptcha_site_key', $config->recaptcha_site_key); 
        // Datos de idiomas
        if($this->session->userdata('idioma'))
            $this->lang->load(array('admin', 'auth', 'blog', 'cms', 'common', 'inmuebles', 'ion_auth', 'tienda'),$this->session->userdata('idioma'));
    }

    //Método para la portada: diferente en cada tienda, para que la portada sea original
    function index()
    {
        $data = $this->inicializar(1);
        $data['bloques'] = $this->Bloque_model->get_bloques(1, $data['idioma_actual']->id_idioma, 1);
        foreach ($data['bloques'] as $k => $v)
        {
            if ($v->id_tipo_bloque == 1 || $v->id_tipo_bloque == 4)
            { //bloque de texto
                $data['bloques'][$k]->texto = $this->Bloque_model->get_contenido($v->id_bloque, "texto", $data['idioma_actual']->id_idioma);
            }
            elseif ($v->id_tipo_bloque == 2)
            { //bloque carrusel
                $carrusel = $this->Bloque_model->get_contenido($v->id_bloque, "carrusel", $data['idioma_actual']->id_idioma);
                $data['bloques'][$k]->carrusel_general = $carrusel;
                $data['bloques'][$k]->carrusel = $this->Bloque_model->get_carrusel($carrusel->id, $data['idioma_actual']->id_idioma);
                $data['bloques'][$k]->categorias = $this->Carrusel_model->get_categorias_carrusel($data['idioma_actual']->id_idioma, $carrusel->id);
                switch ($data['bloques'][$k]->carrusel_general->columnas)
                {
                    case 2:
                        $data['col_md'] = 'col-sm-6';
                        break;
                    case 3:
                        $data['col_md'] = 'col-sm-4';
                        break;
                    case 4:
                        $data['col_md'] = 'col-sm-3';
                        break;
                    case 6:
                        $data['col_md'] = 'col-sm-2';
                        break;
                    default:
                        $data['col_md'] = 'col-sm-2';
                        break;
                }
            }
            elseif ($v->id_tipo_bloque == 5)
            { //bloque productos
                $caracteristicas = $this->Bloque_model->getBloqueFrontend($v->id_bloque);
                $data['bloques'][$k]->num_inmuebles = $caracteristicas->num_inmuebles;
                $data['bloques'][$k]->tipo = $caracteristicas->tipo;
                $data['bloques'][$k]->inmuebles = $this->Bloque_model->getInmueblesBloque($caracteristicas->tipo, $caracteristicas->num_inmuebles, $data['idioma_actual']->id_idioma);
            }
        }

        $this->template->write_view('header', 'public/template/header', $data);
        $this->template->write_view('content_center', 'public/seccion', $data);
        $this->template->write_view('footer', 'public/template/footer', $data);
        $this->template->render();
    }

    function inicializar($seccion, $titulo = NULL)
    {
        $data['cargar_idiomas'] = $this->Idioma_model->get_idiomas_subidos_activos();
        $data['idioma_actual'] = $this->Idioma_model->get_id_idioma_by_nombre($this->uri->segment('1'));
        $data['config'] = $this->General_model->get_config();
        //$data['categorias_principales']=$this->producto_model->get_categorias_principales($data['idioma_actual']->id_idioma);
        $data['secciones_header'] = $this->Seccion_model->get_secciones_header($data['idioma_actual']->id_idioma);
        $data['subsecciones_header'] = $this->Seccion_model->get_subsecciones_header($data['idioma_actual']->id_idioma);
        //Para buscador inmuebles
        $data['provincias'] = $this->Provincia_model->get_provincias_dropdown();
        $data['tipos_inmuebles'] = $this->Tipo_inmueble_model->get_tipos_inmuebles_dropdown(-1, 1);
        $data['ofertas'] = $this->Inmueble_model->get_ofertas_dropdown(-1);

        $data['cols_pie'] = $this->Usuario_model->get_columnas_pie();
        if (count($data['cols_pie']))
        {
            $data['span'] = 12 / count($data['cols_pie']);
        }
        else
        {
            $data['span'] = 2;
        }
        $cont = 0;
        foreach ($data['cols_pie'] as $col)
        {
            $cont++;
            if ($col->id_opc == 1)
                $data['menu_footer'] = $this->Seccion_model->get_secciones_footer($data['idioma_actual']->id_idioma);
            elseif ($col->id_opc == 3)
                $data['codigo' . $cont] = $this->Usuario_model->get_codigo_pie($col->id, $data['idioma_actual']->id_idioma);
        }
        $data['seccion'] = $this->Seccion_model->get_seccion($data['idioma_actual']->id_idioma, $seccion);
        /* if (count($data['seccion'])==0){
          redirect('errors/error_404');
          } */
        if ($titulo != NULL)
        {
            $data['title'] = $titulo;
        }
        else
        {
            $data['title'] = $data['seccion']->titulo_seo;
        }
        $data['meta_description'] = $data['seccion']->descripcion_seo;
        $data['meta_keywords'] = $data['seccion']->keyword_seo;

        return $data;
    }

    function seccion($seccion)
    {
        $idseccion = $this->Seccion_model->get_seccion_nombre($this->Idioma_model->get_id_idioma_by_nombre($this->uri->segment('1'))->id_idioma, $seccion)->id;
        $data = $this->inicializar($idseccion);
        $data['bloques'] = $this->Bloque_model->get_bloques(1, $data['idioma_actual']->id_idioma, $idseccion);
        foreach ($data['bloques'] as $k => $v)
        {
            if ($v->id_tipo_bloque == 1 || $v->id_tipo_bloque == 4)
            { //bloque de texto
                $data['bloques'][$k]->texto = $this->Bloque_model->get_contenido($v->id_bloque, "texto", $data['idioma_actual']->id_idioma);
            }
            elseif ($v->id_tipo_bloque == 2)
            { //bloque carrusel
                $carrusel = $this->Bloque_model->get_contenido($v->id_bloque, "carrusel", $data['idioma_actual']->id_idioma);
                $data['bloques'][$k]->carrusel_general = $carrusel;
                $data['bloques'][$k]->carrusel = $this->Bloque_model->get_carrusel($carrusel->id, $data['idioma_actual']->id_idioma);
                $data['bloques'][$k]->categorias = $this->Carrusel_model->get_categorias_carrusel($data['idioma_actual']->id_idioma, $carrusel->id);
                switch ($data['bloques'][$k]->carrusel_general->columnas)
                {
                    case 2:
                        $data['col_md'] = 'col-sm-6';
                        break;
                    case 3:
                        $data['col_md'] = 'col-sm-4';
                        break;
                    case 4:
                        $data['col_md'] = 'col-sm-3';
                        break;
                    case 6:
                        $data['col_md'] = 'col-sm-2';
                        break;
                    default:
                        $data['col_md'] = 'col-sm-2';
                        break;
                }
            }
            elseif ($v->id_tipo_bloque == 5)
            { //bloque productos
                $caracteristicas = $this->Bloque_model->getBloqueFrontend($v->id_bloque);
                $data['bloques'][$k]->num_inmuebles = $caracteristicas->num_inmuebles;
                $data['bloques'][$k]->tipo = $caracteristicas->tipo;
                $data['bloques'][$k]->inmuebles = $this->Bloque_model->getInmueblesBloque($caracteristicas->tipo, $caracteristicas->num_inmuebles, $data['idioma_actual']->id_idioma);
            }
        }
        if ($this->input->post())
        {

            $this->form_validation->set_rules('nombre', 'Nombre', 'trim|required');
            $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
            $this->form_validation->set_rules('telefono', 'Teléfono', 'trim|required|is_natural');
			$this->form_validation->set_rules('mensaje', 'Mensaje', 'trim|required');

            $data = array(
                'secret' => $this->session->userdata('recaptcha_secret_key'),
                'response' => $this->input->post('g-recaptcha-response')
            );

            $verify = curl_init();
            curl_setopt($verify, CURLOPT_URL, "https://www.google.com/recaptcha/api/siteverify");
            curl_setopt($verify, CURLOPT_POST, true);
            curl_setopt($verify, CURLOPT_POSTFIELDS, http_build_query($data));
            curl_setopt($verify, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($verify, CURLOPT_RETURNTRANSFER, true);
            $response = curl_exec($verify);

            $respuesta = json_decode($response);
            if ($this->form_validation->run() && $respuesta->success)
            {

                $this->load->library('email');

                $config['protocol'] = 'mail';
                //$config['mailpath'] = '/usr/sbin/sendmail';
                //$config['charset'] = 'iso-8859-1';
                $config['wordwrap'] = TRUE;

                $this->email->initialize($config);
                $this->load->model('Config_model');

                $dataconfig = $this->Config_model->get_config();
                $this->email->from('noreply@openrs.es', 'OPENRS');
                $this->email->to($dataconfig->email_contacto);

                $this->email->subject('Correo entrante de la WEB');
                $this->email->message('
						<html>
						<head>
						<title>Contacto OPENRS</title>
						</head>
						<body>
						<p>Detalles del formulario de contacto:</p>
						<p><b>Nombre</b>: ' . $this->input->post('nombre') . '</p>' . '
						<p><b>Empresa</b>: ' . $this->input->post('empresa') . '</p>' . '
						<p><b>Email</b>: ' . $this->input->post('email') . '</p>' . '
						<p><b>Teléfono</b>: ' . $this->input->post('telefono') . '</p>' . '
						<p><b>Mensaje</b>: ' . $this->input->post('mensaje') . '</p>' . '
						</body>
						</html>'
                );
                $this->email->send();
				$this->session->set_flashdata('mensaje','El mensaje ha sido enviado correctamente');
				redirect($this->uri->segment(1).'/'.$this->uri->segment(2));
            }else{
				$this->session->set_flashdata('error',validation_errors());
				redirect($this->uri->segment(1).'/'.$this->uri->segment(2));
			}
        }

        $this->template->write_view('header', 'public/template/header', $data);
        $this->template->write_view('content_center', 'public/seccion', $data);
        $this->template->write_view('footer', 'public/template/footer', $data);
        $this->template->render();
    }

    function cargar_localidades($idprovincia)
    {
        $this->data['poblaciones'] = $this->Poblacion_model->get_poblaciones_dropdown($idprovincia);
        $this->load->view('public/poblaciones', $this->data);
    }

    function cargar_zonas($idpoblacion)
    {
        $this->data['zonas'] = $this->Zona_model->get_zonas_dropdown($idpoblacion);
        $this->load->view('public/zonas', $this->data);
    }

    public function ver_inmuebles()
    {
        $data = $this->inicializar(1, 'Inmuebles');
        // Valores filtros de sesión
        $this->_load_filtros_session();
        // Valores de los filtros de búsqueda
        $filtros = $this->_generar_filtros_busqueda();
        if ($this->input->get('start') && $this->input->get('start') > 0)
        {
            $filtros['start'] = $this->input->get('start');
        }
        else
        {
            $filtros['start'] = 0;
        }
        if ($this->input->get('referencia'))
        {
            $referencia = $this->security->xss_clean($this->input->get('referencia'));
            $inmueble = $this->Buscador_model->getInmuebleByReferencia($data['idioma_actual']->id_idioma, $referencia);
            if ($inmueble)
            {
                redirect($this->uri->segment('1').'/inmueble/' . $inmueble->id . '-' . $inmueble->url_seo);
            }
        }
        else
        {
            $filtros = $this->security->xss_clean($filtros);
            $data['filtros'] = $filtros;
			if(isset($filtros['provincia_id']) && $filtros['provincia_id'] >= 0){
				$data['poblaciones'] = $this->Poblacion_model->get_poblaciones_dropdown($filtros['provincia_id']);
				if(isset($filtros['poblacion_id']) && !empty($filtros['poblacion_id'])){
					$data['zonas'] = $this->Zona_model->get_zonas_dropdown($filtros['poblacion_id']);
				}
			}
            // Búsqueda
            $data['total'] = $this->Buscador_model->getInmuebleBuscador($data['idioma_actual']->id_idioma, $filtros, 1);
            $data['inmuebles'] = $this->Buscador_model->getInmuebleBuscador($data['idioma_actual']->id_idioma, $filtros);
        }
        $data['title'] = "Inmuebles";
        $data['meta_description'] = "Todos los inmuebles que busques";
        $data['meta_keywords'] = "Pisos, chalets, adosados";
        $this->template->write_view('header', 'public/template/header', $data);
        $this->template->write_view('content_center', 'public/ver_inmuebles', $data);
        $this->template->write_view('footer', 'public/template/footer', $data);
        $this->template->render();
    }

    private function _load_filtros_session()
    {
        // Filtro provincia_id
        $this->session->set_userdata('inmuebles_buscador_front_provincia_id', $this->input->get('provincia_id'));

        // Filtro poblacion_id
        $this->session->set_userdata('inmuebles_buscador_front_poblacion_id', $this->input->get('poblacion_id'));

        // Filtro zona_id
        $this->session->set_userdata('inmuebles_buscador_front_zona_id', $this->input->get('zona_id'));

        // Filtro tipo_id
        $this->session->set_userdata('inmuebles_buscador_front_tipo_id', $this->input->get('tipo_id'));

        // Filtro oferta_id
        $this->session->set_userdata('inmuebles_buscador_front_oferta_id', $this->input->get('oferta_id'));

        // Filtro destacado_id
        $this->session->set_userdata('inmuebles_buscador_front_destacado_id', $this->input->get('destacado_id'));

        // Filtro oportunidad_id
        $this->session->set_userdata('inmuebles_buscador_front_oportunidad_id', $this->input->get('oportunidad_id'));

        // Filtro banios_desde
        $this->session->set_userdata('inmuebles_buscador_front_banios_desde', $this->input->get('banios_desde'));

        // Filtro habitaciones_desde
        $this->session->set_userdata('inmuebles_buscador_front_habitaciones_desde', $this->input->get('habitaciones_desde'));

        // Filtro metros_desde
        $this->session->set_userdata('inmuebles_buscador_front_metros_desde', $this->input->get('metros_desde'));

        // Filtro precios_desde
        $this->session->set_userdata('inmuebles_buscador_front_precios_desde', $this->input->get('precios_desde'));

        // Filtro precios_hasta
        $this->session->set_userdata('inmuebles_buscador_front_precios_hasta', $this->input->get('precios_hasta'));
    }

    private function _generar_filtros_busqueda()
    {
        $filtros = array();

        $filtros['tipo_id'] = $this->session->userdata('inmuebles_buscador_front_tipo_id');
        $filtros['provincia_id'] = $this->session->userdata('inmuebles_buscador_front_provincia_id');
        $filtros['poblacion_id'] = $this->session->userdata('inmuebles_buscador_front_poblacion_id');
        $filtros['zona_id'] = $this->session->userdata('inmuebles_buscador_front_zona_id');
        $filtros['oferta_id'] = $this->session->userdata('inmuebles_buscador_front_oferta_id');
        $filtros['destacado_id'] = $this->session->userdata('inmuebles_buscador_front_destacado_id');
        $filtros['oportunidad_id'] = $this->session->userdata('inmuebles_buscador_front_oportunidad_id');

        // Búsqueda por rangos de búsqueda
        $filtros['banios_desde'] = $this->session->userdata('inmuebles_buscador_front_banios_desde');
        $filtros['habitaciones_desde'] = $this->session->userdata('inmuebles_buscador_front_habitaciones_desde');
        $filtros['metros_desde'] = $this->session->userdata('inmuebles_buscador_front_metros_desde');
        // Precios es especial por el tipo de consulta que se hace   
        $filtros['precios_desde'] = $this->utilities->get_sql_value_string($this->utilities->formatear_numero($this->session->userdata('inmuebles_buscador_front_precios_desde')), "int");
        $filtros['precios_hasta'] = $this->utilities->get_sql_value_string($this->utilities->formatear_numero($this->session->userdata('inmuebles_buscador_front_precios_hasta')), "int");

        // Sólo publicados
        $filtros['publicado_id'] = 1;

        return $filtros;
    }

    // Ajax method
    function multiple_google_map($infowindow_type = 'private')
    {
        // Deshabilitar profiler
        $this->output->enable_profiler(FALSE);
        // Comprobación de petición por AJAX
        if (!$this->input->is_ajax_request())
        {
            echo 'Petición no realizada a través de AJAX';
            return;
        }
        // Valores de los filtros de búsqueda
        $filtros = $this->_generar_filtros_busqueda();
        // Si está logueado
        $filtros['idioma_id'] = $this->Idioma_model->get_id_idioma_by_nombre($this->uri->segment('1'))->id_idioma;
        // Búsqueda                
        $inmuebles = $this->Inmueble_model->get_by_filtros($filtros);
        // Check
        if ($inmuebles)
        {
            // Idioma a mostrar
            $idioma_actual = $this->Idioma_model->get_id_idioma_by_nombre($this->uri->segment('1'));
            // Create the map.
            $this->data['map'] = $this->Inmueble_model->create_google_map($inmuebles, $filtros, $infowindow_type, $idioma_actual->id_idioma, $idioma_actual->nombre_seo);
            // Load our view, passing the map data that has just been created
            $this->load->view('common/google_maps', $this->data);
        }
        else
        {
            echo "No hay inmuebles para mostrar en el mapa de Google";
        }
    }

    function ver_inmueble($url_seo)
    {
        $url = explode('-', $url_seo);
        $data = $this->inicializar(1, $url[1]);
        if (isset($this->ion_auth->user()->row()->id))
        {
            $session_es_agente = $this->Usuario_model->is_agente($this->ion_auth->user()->row()->id);
            if ($session_es_agente)
            {
                $data['inmueble'] = $this->Buscador_model->getInmuebleById($data['idioma_actual']->id_idioma, $url[0]);
            }
            else
            {
                $data['inmueble'] = $this->Buscador_model->getInmuebleById($data['idioma_actual']->id_idioma, $url[0], 1);
            }
        }
        else
        {
            $data['inmueble'] = $this->Buscador_model->getInmuebleById($data['idioma_actual']->id_idioma, $url[0], 1);
        }

        $data['imagenes'] = $this->Buscador_model->getImagenesInmueble($url[0]);
        $data['extras'] = $this->Buscador_model->getExtrasInmueble($data['idioma_actual']->id_idioma, $url[0]);
        $data['lugares'] = $this->Buscador_model->getLugaresInmueble($data['idioma_actual']->id_idioma, $url[0]);
        $data['video'] = $this->Buscador_model->getVideoInmueble($url[0]);
        $data['enlaces'] = $this->Buscador_model->getEnlacesInmueble($url[0]);
        $data['ce'] = $this->Buscador_model->getCEInmueble($url[0]);
        //correo
        if ($this->input->post())
        {
            $cadena = str_replace("\r\n", "<br />", $this->input->post('mensaje'));
            $this->form_validation->set_rules('nombre', 'Nombre', 'trim|required');
            $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
            $this->form_validation->set_rules('telefono', 'Teléfono', 'trim|required|is_natural');
			$this->form_validation->set_rules('mensaje', 'Mensaje', 'trim|required');

            $data = array(
                'secret' => $this->session->userdata('recaptcha_secret_key'),
                'response' => $this->input->post('g-recaptcha-response')
            );

            $verify = curl_init();
            curl_setopt($verify, CURLOPT_URL, "https://www.google.com/recaptcha/api/siteverify");
            curl_setopt($verify, CURLOPT_POST, true);
            curl_setopt($verify, CURLOPT_POSTFIELDS, http_build_query($data));
            curl_setopt($verify, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($verify, CURLOPT_RETURNTRANSFER, true);
            $response = curl_exec($verify);

            $respuesta = json_decode($response);
            if ($this->form_validation->run() && $respuesta->success)
            {

                $this->load->library('email');

                $config['protocol'] = 'mail';
                //$config['mailpath'] = '/usr/sbin/sendmail';
                //$config['charset'] = 'iso-8859-1';
                $config['wordwrap'] = TRUE;

                $this->email->initialize($config);

                $this->load->model('Config_model');
                $dataconfig = $this->Config_model->get_config();
                $this->email->from('noreply@openrs.es', 'OPENRS');
                $this->email->to($dataconfig->email_contacto);

                $this->email->subject('Correo entrante de la WEB');
                $this->email->message('
                                                    <html>
                                                    <head>
                                                    <title>Contacto Inmueble OPENRS</title>
                                                    </head>
                                                    <body>
                                                    <p>Detalles del formulario de contacto:</p>
                                                    <p><b>Inmueble</b>: ' . $this->input->post('referencia') . ': ' . $this->input->post('inmueble') . '</p>' . '
                                                    <p><b>Nombre</b>: ' . $this->input->post('nombre') . '</p>' . '
                                                    <p><b>Empresa</b>: ' . $this->input->post('empresa') . '</p>' . '
                                                    <p><b>Email</b>: ' . $this->input->post('email') . '</p>' . '
                                                    <p><b>Teléfono</b>: ' . $this->input->post('telefono') . '</p>' . '
                                                    <p><b>Mensaje</b>: ' . $this->input->post('mensaje') . '</p>' . '
                                                    </body>
                                                    </html>'
                );
                $this->email->send();
				$this->session->set_flashdata('mensaje','El mensaje ha sido enviado correctamente');
				redirect($this->uri->segment(1).'/'.$this->uri->segment(2).'/'.$this->uri->segment(3));
            }else{
				$this->session->set_flashdata('error',validation_errors());
				redirect($this->uri->segment(1).'/'.$this->uri->segment(2).'/'.$this->uri->segment(3));
			}
        }
		if($data['inmueble']){
			$data['title'] = $data['inmueble']->titulo;
			$data['meta_description'] = $data['inmueble']->descripcion_seo;
			$data['meta_keywords'] = $data['inmueble']->keywords_seo;
		}
        $this->template->write_view('header', 'public/template/header', $data);
        $this->template->write_view('content_center', 'public/ver_inmueble', $data);
        $this->template->write_view('footer', 'public/template/footer', $data);
        $this->template->render();
    }

    function devolver_idioma()
    {
        return $this->Idioma_model->get_id_idioma_by_nombre($this->uri->segment('1'));
    }

    function ver_articulo($id_articulo = NULL)
    {
        $idioma = $this->devolver_idioma();

        if ($id_articulo == NULL)
        {
            redirect('errors/error_404');
        }
        else
        {
            $articulo = $this->Articulo_model->getById($id_articulo, $idioma->id_idioma);
            if (count($articulo) == 0)
            {
                redirect('errors/error_404');
            }
        }
        $data = $this->inicializar(7, $articulo->titulo);
        $data['articulo'] = $articulo;
        $data['autor'] = $data['config']->nombre;
        $data['meta_description'] = $data['articulo']->titulo . ' | ' . $this->config->item('site_name');
        //$data['meta_keywords']= $meta_etiquetas.',Annais Events, eventos, caza, bodas, comuniones';
        $data['slide'] = TRUE;
        $data['noticias'] = TRUE;

        //Aumenta en 1 el número de visitas a la publicación
        $this->Articulo_model->updateById($id_articulo, array('visitas' => ($data['articulo']->visitas + 1)));
        $data['comentarios'] = $this->Comentario_model->get_comentarios($id_articulo);
        $data['categorias'] = $this->Articulo_model->get_categorias(1, $idioma->id_idioma);
        $data['etiquetas'] = $this->Etiqueta_model->get_etiquetas_articulo($id_articulo, $idioma->id_idioma);

        //Obtenemos los artículos anterior y siguiente para navegar a través de ellos.
        $data['articulo_prev'] = $this->Articulo_model->articulo_anterior($data['articulo']->id, $idioma->id_idioma);
        $data['articulo_next'] = $this->Articulo_model->articulo_siguiente($data['articulo']->id, $idioma->id_idioma);
        $meta_etiquetas = '';
        $data['articulos_recientes'] = $this->Articulo_model->get_articulos_relacionados($id_articulo, $idioma->id_idioma, $data['etiquetas']);
        $data['articulos_populares'] = $this->Articulo_model->articulos_populares($idioma->id_idioma);
        $data['articulos_votados'] = $this->Articulo_model->articulos_votados($idioma->id_idioma);
        $data['etiquetas_favoritas'] = $this->Etiqueta_model->etiquetas_favoritas($idioma->id_idioma);
        if ($this->input->post())
        {
            $this->form_validation->set_rules('contenido2', $this->lang->line('blog_comentario'), 'trim|required');
            $this->form_validation->set_rules('email', $this->lang->line('blog_email'), 'trim|required|valid_email');
            $this->form_validation->set_rules('nick', $this->lang->line('blog_nick'), 'trim');

            $this->form_validation->set_message('required', $this->lang->line('login_c_required'));
            $this->form_validation->set_message('valid_email', $this->lang->line('login_c_valid_email'));

            $data2 = array(
                'secret' => $this->session->userdata('recaptcha_secret_key'),
                'response' => $this->input->post('g-recaptcha-response')
            );

            $verify = curl_init();
            curl_setopt($verify, CURLOPT_URL, "https://www.google.com/recaptcha/api/siteverify");
            curl_setopt($verify, CURLOPT_POST, true);
            curl_setopt($verify, CURLOPT_POSTFIELDS, http_build_query($data2));
            curl_setopt($verify, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($verify, CURLOPT_RETURNTRANSFER, true);
            $response = curl_exec($verify);

            $respuesta = json_decode($response);
            if ($this->form_validation->run() && $respuesta->success)
            {
                $data_comentario = array(
                    'contenido' => $this->input->post('contenido2'),
                    'visible' => TRUE,
                    'id_articulo' => $id_articulo,
                    'num_mensaje_articulo' => ($this->Comentario_model->max_num_mensaje_articulo($id_articulo) + 1),
                );
                if ($this->input->post('nick') != '')
                    $data_comentario['nick'] = $this->input->post('nick');
                else
                    $data_comentario['nick'] = $this->lang->line('blog_anonimo');
                $this->Comentario_model->insertar_comentario($data_comentario);
                //Activar alerta de nuevo comentario
                $this->Articulo_model->updateById($id_articulo, array('comentario' => 1));
                redirect($this->uri->segment('1') . '/blog/' . $articulo->url_seo_articulo);
            }
        }

        $data['bloques'] = $this->Bloque_model->get_bloques(1, $data['idioma_actual']->id_idioma, 2);
        foreach ($data['bloques'] as $k => $v)
        {
            if ($v->id_tipo_bloque == 2)
            { //bloque carrusel
                $carrusel = $this->Bloque_model->get_contenido($v->id_bloque, "carrusel", $data['idioma_actual']->id_idioma);
                $data['bloques'][$k]->carrusel_general = $carrusel;
                $data['bloques'][$k]->carrusel = $this->Bloque_model->get_carrusel($carrusel->id, $data['idioma_actual']->id_idioma);
                $data['bloques'][$k]->categorias = $this->carrusel_model->get_categorias_carrusel($data['idioma_actual']->id_idioma, $carrusel->id);
                switch ($data['bloques'][$k]->carrusel_general->columnas)
                {
                    case 2:
                        $data['col_md'] = 'col-md-6';
                        break;
                    case 3:
                        $data['col_md'] = 'col-md-4';
                        break;
                    case 4:
                        $data['col_md'] = 'col-md-3';
                        break;
                    case 6:
                        $data['col_md'] = 'col-md-2';
                        break;
                    default:
                        $data['col_md'] = 'col-md-2';
                        break;
                }
            }
        }

        $this->template->write_view('header', 'public/template/header', $data);
        $this->template->write_view('content_center', 'blog/ver_articulo', $data);
        $this->template->write_view('footer', 'public/template/footer', $data);
        $this->template->render();
    }

    function votar($id_articulo)
    {
        $idioma = $this->devolver_idioma();
        if ($id_articulo == NULL)
        {
            redirect('errors/error_404');
        }
        else
        {
            $data['articulo'] = $this->Articulo_model->getById($id_articulo, $idioma->id_idioma);
            if (count($data['articulo']) == 0)
            {
                redirect('errors/error_404');
            }
            if ($data['articulo']->id_estado != 1)
            {
                redirect('errors/error_404');
            }
        }
        //Si no hay repetición de la ip en la tabla se produce el voto
        if ($this->Voto_model->comprobar_voto($id_articulo, $this->input->ip_address()))
        {
            $data_voto = array(
                'ip' => $this->input->ip_address(),
                'id_articulo' => $id_articulo
            );
            $this->Voto_model->insert($data_voto);
        }
        redirect($this->uri->segment('1') . '/blog/' . $data['articulo']->url_seo_articulo);
    }

    function articulos($busqueda = NULL, $url = NULL)
    {
        $idioma = $this->devolver_idioma();
        $data = $this->inicializar(7, $this->lang->line('blog_c_listado_articulos_categoria'));
        $data['bloques'] = $this->Bloque_model->get_bloques(1, $data['idioma_actual']->id_idioma, $data['seccion']->id);
        foreach ($data['bloques'] as $k => $v)
        {
            if ($v->id_tipo_bloque == 1)
            { //bloque de texto
                $data['bloques'][$k]->texto = $this->Bloque_model->get_contenido($v->id_bloque, "texto", $data['idioma_actual']->id_idioma);
            }
            elseif ($v->id_tipo_bloque == 2)
            { //bloque carrusel
                $carrusel = $this->Bloque_model->get_contenido($v->id_bloque, "carrusel", $data['idioma_actual']->id_idioma);
                $data['bloques'][$k]->carrusel_general = $carrusel;
                $data['bloques'][$k]->carrusel = $this->Bloque_model->get_carrusel($carrusel->id, $data['idioma_actual']->id_idioma);
            }
        }
        /* Necesario para la paginación */
        $this->load->library('pagination');
        $opciones = array();
        $desde = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

        $opciones['per_page'] = 5;
        $opciones['base_url'] = site_url() . '/seccion/articulos/';
        $opciones['total_rows'] = count($this->Articulo_model->articulos_publicados_etiqueta($busqueda));
        $opciones['uri_segment'] = 4;

        $this->pagination->initialize($opciones);
        //Si se busca por una etiqueta
        if ($busqueda != NULL)
        {
            $data['articulos'] = $this->Articulo_model->articulos_publicados($idioma->id_idioma, $opciones['per_page'], 0, $busqueda);
        }
        else
        {  //Si no hay criterios
            $data['articulos'] = $this->Articulo_model->articulos_publicados($idioma->id_idioma, $opciones['per_page'], $desde);
        }
        foreach ($data['articulos'] as $art)
        {
            $data['etiquetas'][$art->id_articulo] = $this->Etiqueta_model->get_etiquetas_articulo($art->id_articulo, $idioma->id_idioma);
        }
        if (count($data['articulos']) == 0)
            $data['vacio'] = TRUE;
        $data['paginacion'] = $this->pagination->create_links();
        $data['articulos_populares'] = $this->Articulo_model->articulos_populares($idioma->id_idioma);
        $data['articulos_votados'] = $this->Articulo_model->articulos_votados($idioma->id_idioma);
        $data['etiquetas_favoritas'] = $this->Etiqueta_model->etiquetas_favoritas($idioma->id_idioma);
        $data['categorias'] = $this->Articulo_model->get_categorias(1, $idioma->id_idioma);
        $data['busqueda'] = $busqueda;

        $this->template->write_view('header', 'public/template/header', $data);
        $this->template->write_view('content_center', 'public/seccion', $data);
        $this->template->write_view('footer', 'public/template/footer', $data);
        $this->template->render();
    }

    function articulos_categoria($busqueda = NULL)
    {
        $idioma = $this->devolver_idioma();
        $data = $this->inicializar(2, $this->lang->line('blog_c_listado_articulos_categoria'));

        $data['bloques'] = $this->Bloque_model->get_bloques(1, $data['idioma_actual']->id_idioma, $data['seccion']->id);
        foreach ($data['bloques'] as $k => $v)
        {
            if ($v->id_tipo_bloque == 1)
            { //bloque de texto
                $data['bloques'][$k]->texto = $this->Bloque_model->get_contenido($v->id_bloque, "texto", $data['idioma_actual']->id_idioma);
            }
            elseif ($v->id_tipo_bloque == 2)
            { //bloque carrusel
                $carrusel = $this->Bloque_model->get_contenido($v->id_bloque, "carrusel", $data['idioma_actual']->id_idioma);
                $data['bloques'][$k]->carrusel_general = $carrusel;
                $data['bloques'][$k]->carrusel = $this->Bloque_model->get_carrusel($carrusel->id, $data['idioma_actual']->id_idioma);
            }
        }
        /* Necesario para la paginación */
        $this->load->library('pagination');
        $opciones = array();
        $desde = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

        $opciones['per_page'] = 10;
        $opciones['base_url'] = site_url() . '/seccion/articulos/';
        $opciones['total_rows'] = count($this->Articulo_model->articulos_publicados_categoria($busqueda));
        $opciones['uri_segment'] = 4;

        $this->pagination->initialize($opciones);
        //Si se busca por una etiqueta
        if ($busqueda != NULL)
        {
            $data['articulos'] = $this->Articulo_model->articulos_publicados_x_categoria($idioma->id_idioma, $opciones['per_page'], 0, $busqueda);
        }
        else
        {  //Si no hay criterios
            $data['articulos'] = $this->Articulo_model->articulos_publicados_x_categoria($idioma->id_idioma, $opciones['per_page'], $desde);
        }
        foreach ($data['articulos'] as $art)
        {
            $data['etiquetas'][$art->id_articulo] = $this->Etiqueta_model->get_etiquetas_articulo($art->id_articulo, $idioma->id_idioma);
        }
        if (count($data['articulos']) == 0)
            $data['vacio'] = TRUE;
        $data['paginacion'] = $this->pagination->create_links();
        $data['articulos_populares'] = $this->Articulo_model->articulos_populares($idioma->id_idioma);
        $data['articulos_votados'] = $this->Articulo_model->articulos_votados($idioma->id_idioma);
        $data['etiquetas_favoritas'] = $this->Etiqueta_model->etiquetas_favoritas($idioma->id_idioma);
        $data['categorias'] = $this->Articulo_model->get_categorias(1, $idioma->id_idioma);

        $this->template->write_view('header', 'public/template/header', $data);
        $this->template->write_view('content_center', 'public/seccion', $data);
        $this->template->write_view('footer', 'public/template/footer', $data);
        $this->template->render();
    }

}
