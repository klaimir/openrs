<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require_once APPPATH . 'core/MY_Model.php';

class Documento_generado_model extends MY_Model
{

    // Identificadores aplicados
    public $inmueble_id = NULL;
    public $cliente_id = NULL;
    
    public $idioma_id = NULL;    
    public $agente_id = NULL;
    public $plantilla_id = NULL;
    // Datos recabados de la bd
    public $inmueble = NULL;
    public $cliente = NULL;
    public $agente = NULL;
    public $plantilla = NULL;
    public $categorias = NULL;
    // Datos de la plantilla
    public $html = NULL;

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Establece la plantilla, las diferentes categorías con sus marcas a aplicar y el HTML con las marcas por reemplazar
     *
     * @return void
     */
    function aplicar_plantilla()
    {
        // Establecer datos de plantilla
        $this->establecer_datos_plantilla();
        // Sustituir marcas
        $this->sustituir_marcas();
    }

    /**
     * Establece la plantilla, las diferentes categorías con sus marcas a aplicar y el HTML con las marcas por reemplazar
     *
     * @return void
     */
    function establecer_datos_plantilla()
    {
        // Modelos axiliares
        $this->load->model('Plantilla_documentacion_model');
        // Asignamos la plantilla
        $this->plantilla = $this->Plantilla_documentacion_model->get_by_id($this->plantilla_id);
        $this->html = $this->plantilla->html;
        // Y sus categorías que a la vez contienen sus marcas
        $this->categorias = $this->Tipo_plantilla_documentacion_model->get_categorias_with_marcas($this->plantilla->tipo_plantilla_id);
    }

    /**
     * Reemplaza las marcas asignadas a las diferentes categorías del tipo de documento seleccionado
     *
     * @return void
     */
    function sustituir_marcas()
    {
        // Leemos las categorias asignadas y sustituimos las marcas según cada categoría con un método parametrizado
        foreach ($this->categorias as $categoria)
        {
            $method = "sustituir_marcas_" . $categoria->referencia;
            $this->$method();
        }
    }

    /**
     * Reemplaza las marcas de los datos de los clientes
     *
     * @return void
     */
    function sustituir_marcas_clientes()
    {
        // Marcas
        $categoria = $this->categorias[1];
        // Datos
        $this->cliente = $this->Cliente_model->get_by_view_id($this->cliente_id);
        // Por cada marca se determina un valor
        foreach ($categoria->marcas as $marca)
        {
            // Calculamos el replace
            $replace = "%" . $categoria->referencia . "." . $marca->referencia . "%";
            // Si la marca es especial hay que aplicar algún tipo de función para resolver su valor
            if ($marca->especial)
            {
                switch ($marca->referencia)
                {
                    case "fecha_nac":
                        $this->html = str_replace($replace, $this->utilities->cambiafecha_bd($this->inmueble->fecha_nac), $this->html);
                        break;
                    case "fecha_alta":
                        $this->html = str_replace($replace, $this->utilities->cambiafecha_bd($this->inmueble->fecha_alta), $this->html);
                        break;
                    default:
                        break;
                }
            }
            else
            {
                $referencia = $marca->referencia;
                $this->html = str_replace($replace, $this->cliente->$referencia, $this->html);
            }
        }
    }
    
    /**
     * Genera la imagen QR
     *
     * @return string html con el código qr generado
     */
    function generate_qr_image($inmueble_id,$idioma_id,$url_seo)
    {
         // Calculamos el texto qr
        $idioma=$this->Idioma_model->get_idioma($idioma_id);
        $qr_text=site_url($idioma->nombre_seo.'/'.$url_seo);
        // Imprimimos el qr
        $this->load->helper('qr');
        create_qr($qr_text, FCPATH . 'uploads/inmuebles/' . $inmueble_id . '/codigo_qr.png');
        return '<img width="80" height="80" src="' . base_url('uploads/inmuebles/' . $inmueble_id . '/codigo_qr.png') . '" />';
    }

    /**
     * Reemplaza las marcas de los datos de los inmuebles
     *
     * @return void
     */
    function sustituir_marcas_inmuebles()
    {
        // Modelos axiliares
        $this->load->model('Inmueble_model');
        // Marcas
        $categoria = $this->categorias[3];
        // Datos
        $this->inmueble = $this->Inmueble_model->get_info_documento($this->inmueble_id, $this->idioma_id);
        // Por cada marca se determina un valor
        foreach ($categoria->marcas as $marca)
        {
            // Calculamos el replace
            $replace = "%" . $categoria->referencia . "." . $marca->referencia . "%";
            // Si la marca es especial hay que aplicar algún tipo de función para resolver su valor
            if ($marca->especial)
            {
                switch ($marca->referencia)
                {
                    case "imagen_portada":
                        $this->load->model('Inmueble_imagen_model');
                        $imagen=$this->Inmueble_imagen_model->get_portada($this->inmueble_id);                        
                        if($imagen->portada)
                        {
                            // Calculamos dimensiones para mantenter ratio
                            $dimensiones_imagen=$this->utilities->redimensionar_fotografia(FCPATH.$imagen->imagen,600,600);
                            $html_imagen = '<img width="'.$dimensiones_imagen['anchura'].'" height="'.$dimensiones_imagen['altura'].'" src="' . base_url($imagen->imagen) . '" />';
                        }
                        else
                        {
                            $html_imagen = NULL;
                        }
                        $this->html = str_replace($replace, $html_imagen, $this->html);
                        break;
                    case "fecha_alta":
                        $this->html = str_replace($replace, $this->utilities->cambiafecha_bd($this->inmueble->fecha_alta), $this->html);
                        break;
                    case "precio_compra":
                        $this->html = str_replace($replace, number_format($this->inmueble->precio_compra, 0, ",", "."), $this->html);
                        break;
                    case "precio_alquiler":
                        $this->html = str_replace($replace, number_format($this->inmueble->precio_alquiler, 0, ",", "."), $this->html);
                        break;
                    case "precio_compra_anterior":
                        $this->html = str_replace($replace, number_format($this->inmueble->precio_compra_anterior, 0, ",", "."), $this->html);
                        break;
                    case "precio_alquiler_anterior":
                        $this->html = str_replace($replace, number_format($this->inmueble->precio_alquiler_anterior, 0, ",", "."), $this->html);
                        break;
                    case "titulo_publico":
                        if ($this->inmueble->info_idioma)
                        {
                            $titulo_publico = $this->inmueble->info_idioma->titulo;
                        }
                        else
                        {
                            $titulo_publico = "";
                        }
                        $this->html = str_replace($replace, $titulo_publico, $this->html);
                        break;
                    case "descripcion_publica":
                        if ($this->inmueble->info_idioma)
                        {
                            $descripcion_publica = $this->inmueble->info_idioma->descripcion;
                        }
                        else
                        {
                            $descripcion_publica = "";
                        }
                        $this->html = str_replace($replace, $descripcion_publica, $this->html);
                        break;
                    case "url_seo":
                        if ($this->inmueble->info_idioma)
                        {
                            $url_seo = $this->inmueble->info_idioma->url_seo;
                        }
                        else
                        {
                            $url_seo = "";
                        }
                        $this->html = str_replace($replace, $url_seo, $this->html);
                        break;
                    case "descripcion_seo":
                        if ($this->inmueble->info_idioma)
                        {
                            $descripcion_seo = $this->inmueble->info_idioma->descripcion_seo;
                        }
                        else
                        {
                            $descripcion_seo = "";
                        }
                        $this->html = str_replace($replace, $descripcion_seo, $this->html);
                        break;
                    case "keywords_seo":
                        if ($this->inmueble->info_idioma)
                        {
                            $keywords_seo = $this->inmueble->info_idioma->keywords_seo;
                        }
                        else
                        {
                            $keywords_seo = "";
                        }
                        $this->html = str_replace($replace, $keywords_seo, $this->html);
                        break;
                    default:
                        break;
                }
            }
            else
            {
                $referencia = $marca->referencia;
                $this->html = str_replace($replace, $this->inmueble->$referencia, $this->html);
            }
        }
    }
    
    /**
     * Reemplaza las marcas de los datos de los carteles
     *
     * @return void
     */
    function sustituir_marcas_carteles()
    {
        // Modelos axiliares
        $this->load->model('Inmueble_model');
        // Marcas
        $categoria = $this->categorias[6];
        // Datos
        $this->inmueble = $this->Inmueble_model->get_info_documento($this->inmueble_id, $this->idioma_id);
        // Por cada marca se determina un valor
        foreach ($categoria->marcas as $marca)
        {
            // Calculamos el replace
            $replace = "%" . $categoria->referencia . "." . $marca->referencia . "%";
            // Si la marca es especial hay que aplicar algún tipo de función para resolver su valor
            if ($marca->especial)
            {
                switch ($marca->referencia)
                {
                    case "codigo_qr":
                        // Hay  que comprobar el idioma primero
                        if ($this->inmueble->info_idioma)
                        {                           
                            $codigo_qr = $this->generate_qr_image($this->inmueble_id,$this->idioma_id,$this->inmueble->info_idioma->url_seo);
                        }
                        else
                        {
                            $codigo_qr = "";
                        }
                        $this->html = str_replace($replace, $codigo_qr, $this->html);
                        break;
                    default:
                        break;
                }
            }
            else
            {
                $referencia = $marca->referencia;
                $this->html = str_replace($replace, $this->inmueble->$referencia, $this->html);
            }
        }
    }

    /**
     * Reemplaza las marcas de los datos de los agentes
     *
     * @return void
     */
    function sustituir_marcas_agentes()
    {
        // Marcas
        $categoria = $this->categorias[4];
        // Datos
        $this->agente = $this->Usuario_model->get_by_id($this->agente_id);
        // Por cada marca se determina un valor
        foreach ($categoria->marcas as $marca)
        {
            // Calculamos el replace
            $replace = "%" . $categoria->referencia . "." . $marca->referencia . "%";
            // Si la marca es especial hay que aplicar algún tipo de función para resolver su valor
            if ($marca->especial)
            {
                switch ($marca->referencia)
                {
                    case "nombre":
                        $this->html = str_replace($replace, $this->agente->first_name, $this->html);
                        break;
                    case "apellidos":
                        $this->html = str_replace($replace, $this->agente->last_name, $this->html);
                        break;
                    default:
                        break;
                }
            }
            else
            {
                $referencia = $marca->referencia;
                $this->html = str_replace($replace, $this->agente->$referencia, $this->html);
            }
        }
    }

    /**
     * Reemplaza las marcas de los datos generales
     *
     * @return void
     */
    function sustituir_marcas_general()
    {
        // Hay que especificar esto para que no afecte al servidor
        setlocale(LC_TIME, 'spanish');
        // Marcas
        $categoria = $this->categorias[1];
        // Por cada marca se determina un valor
        foreach ($categoria->marcas as $marca)
        {
            // Calculamos el replace
            $replace = "%" . $categoria->referencia . "." . $marca->referencia . "%";
            // Marcas
            switch ($marca->referencia)
            {
                case 'saltopagina':
                    $this->html = str_replace($replace, '<H1 style="PAGE-BREAK-AFTER: always"> </H1>', $this->html);
                    break;
                case 'f_actual_numero':
                    $this->html = str_replace($replace, date("d/m/Y"), $this->html);
                    break;
                case 'f_actual_texto':
                    $texto_fecha = strftime("%#d de %B del %Y");
                    $this->html = str_replace($replace, $texto_fecha, $this->html);
                    break;
                default:
                    break;
            }
        }
        // Marca general no incluida en configuración (Rutas internas)
        //$html = str_replace('../../../', base_url(), $html);
    }

}
