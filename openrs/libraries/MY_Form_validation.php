<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * MY_Form_validation Class
 *
 * Clase donde se ubican todas las funciones de validación necesarias
 * en los distintos casos de uso de la aplicación.
 * 
 * for php5
 *
 * @package Code Igniter
 * @subpackage Libraries
 * @name MY_Form_validation
 * @version MY_Form_validation v1.0
 * @copyright Copyright (c) 2017, Angel Luis Berasuain Ruiz
 */
class MY_Form_validation extends CI_Form_validation
{

    public $error_array;

    /**
     * Constructor - Establece las preferencias de las form_validationes
     *
     * The constructor can be passed an array of config values
     *
     * @access public
     */
    function MY_Form_validation()
    {
        parent::__construct();
        $this->error_array = array();
    }

    function errorArray()
    {
        return $this->error_array;
    }

    function setError($texto_error)
    {
        $this->error_array[] = $texto_error;
    }

    function resetErrorArray()
    {
        $this->error_array = array();
    }

    function hayErrores()
    {
        if (count($this->error_array) > 0)
        {
            return TRUE;
        }
        else
        {
            return FALSE;
        }
    }

    /**     * ************************ VALIDACIONES DOCUMENTOS ************************ */
    function checkResizeFotoFederado($idtipodoc, $path)
    {
        // Resize de la imagen si es federado
        if ($idtipodoc == 14)
        {
            $config_image['image_library'] = 'gd2';
            $config_image['source_image'] = $path;
            $config_image['maintain_ratio'] = FALSE;
            $config_image['width'] = 50;
            $config_image['height'] = 50;
            $config_image['quality'] = 100;

            $this->CI->load->library('image_lib', $config_image);

            if (!$this->CI->image_lib->resize())
            {
                $this->error_array[] = $this->CI->image_lib->display_errors();
                return FALSE;
            }
            else
            {
                return TRUE;
            }
        }
        else
        {
            return TRUE;
        }
    }

    /**     * ************************ VALIDACIONES CAMPOS CONFIGURABLES PLANTILLAS FORMULARIOS ************************ */
    function checkOpcionesDependientesPlantillasFormulariosExisten($opciones_dependiente, $id_campo_dependiente)
    {
        // Convertimos en array las opciones dependientes del padre
        $campo_padre = $this->CI->FormulariosPlantillas_Model->getCampoConfigurable($id_campo_dependiente);
        $array_opciones_padre = explode(";", $campo_padre->opciones);
        // Convertimos en array las opciones dependiente del hijo
        $array_opciones_dependiente_hijo = explode(";", $opciones_dependiente);
        // Si el array de intersección es el mismo que el array del hijo es que todas estaban contenidas
        $array_intersect = array_intersect($array_opciones_padre, $array_opciones_dependiente_hijo);
        // Comparamos
        if (count($array_intersect) == count($array_opciones_dependiente_hijo))
        {
            return TRUE;
        }
        else
        {
            $this->error_array[] = 'Algunas de las opciones dependientes introducidas no pertenecen a su padre';
            return FALSE;
        }
    }

    function validaOpcionesDepedientesPlantillasFormularios($opciones_dependiente, $id_campo_dependiente)
    {
        if (!empty($id_campo_dependiente))
        {
            if (!empty($opciones_dependiente))
            {
                // Buscamos que todas las opciones dependientes introducidas
                return $this->checkOpcionesDependientesPlantillasFormulariosExisten($opciones_dependiente, $id_campo_dependiente);
            }
            else
            {
                $this->error_array[] = 'Debe seleccionar las opciones a las que pertenece el campo dependiente';
                return FALSE;
            }
        }
        else
        {
            if (!empty($opciones_dependiente))
            {
                $this->error_array[] = 'Debe seleccionar el campo dependiente al que pertenecen las opciones introducidas';
                return FALSE;
            }
            else
            {
                return TRUE;
            }
        }
    }

    function validaCampoUnicoPlantillasFormularios($idplantilla, $nombre_campo, $id_campo)
    {
        if ($this->CI->FormulariosPlantillas_Model->getCampoConfigurableByNombre($idplantilla, $nombre_campo, $id_campo))
        {
            $this->error_array[] = 'El nombre del campo ya existe en la plantilla actual';
            return FALSE;
        }
        else
        {
            return TRUE;
        }
    }

    /**     * ************************ VALIDACIONES CAMPOS CONFIGURABLES FORMULARIOS ************************ */
    function checkOpcionesDependientesFormulariosExisten($opciones_dependiente, $id_campo_dependiente)
    {
        // Convertimos en array las opciones dependientes del padre
        $campo_padre = $this->CI->FormulariosInscripcion_Model->getCampoConfigurable($id_campo_dependiente);
        $array_opciones_padre = explode(";", $campo_padre->opciones);
        // Convertimos en array las opciones dependiente del hijo
        $array_opciones_dependiente_hijo = explode(";", $opciones_dependiente);
        // Si el array de intersección es el mismo que el array del hijo es que todas estaban contenidas
        $array_intersect = array_intersect($array_opciones_padre, $array_opciones_dependiente_hijo);
        // Comparamos
        if (count($array_intersect) == count($array_opciones_dependiente_hijo))
        {
            return TRUE;
        }
        else
        {
            $this->error_array[] = 'Algunas de las opciones dependientes introducidas no pertenecen a su padre';
            return FALSE;
        }
    }

    function validaOpcionesDepedientesFormularios($opciones_dependiente, $id_campo_dependiente)
    {
        if (!empty($id_campo_dependiente))
        {
            if (!empty($opciones_dependiente))
            {
                // Buscamos que todas las opciones dependientes introducidas
                return $this->checkOpcionesDependientesFormulariosExisten($opciones_dependiente, $id_campo_dependiente);
            }
            else
            {
                $this->error_array[] = 'Debe seleccionar las opciones a las que pertenece el campo dependiente';
                return FALSE;
            }
        }
        else
        {
            if (!empty($opciones_dependiente))
            {
                $this->error_array[] = 'Debe seleccionar el campo dependiente al que pertenecen las opciones introducidas';
                return FALSE;
            }
            else
            {
                return TRUE;
            }
        }
    }

    // Hay que cambiar la validación, ya que hay campos que tienen diferente nombre pero luego al imprimirse, como el nombre que se le asigna al campo HTML se procesa y se
    // eliminan algunos caracteres, entonces puede llegar a coincidir dando lugar a error a la hora de procesar los datos los formularios
    function validaCampoUnicoFormularios($idprueba, $nombre_campo, $id_campo)
    {
        // Se leen todos los campos excepto el campo actual
        $campos_configurables = $this->CI->Carreras_Model->getCamposConfigurables($idprueba, $id_campo);
        // Se procesan los campos para comparar los nombres reales que van a llevar luego al imprimirse el HTML              
        if ($campos_configurables)
        {
            $nombre_campo_procesado = $this->CI->utilities->procesarNombreCampo($nombre_campo);
            foreach ($campos_configurables as $campo)
            {
                $nombre_campo_existente_procesado = $this->CI->utilities->procesarNombreCampo($campo->nombre);
                if ($nombre_campo_existente_procesado == $nombre_campo_procesado)
                {
                    $this->error_array[] = 'El nombre del campo ya existe en la prueba actual';
                    return FALSE;
                }
            }
        }

        return TRUE;
    }

    /**     * ************************ VALIDACIONES CAMPOS CONFIGURABLES CURSOS ************************ */
    function checkOpcionesDependientesFormulariosCursosExisten($opciones_dependiente, $id_campo_dependiente)
    {
        // Convertimos en array las opciones dependientes del padre
        $campo_padre = $this->CI->FormulariosInscripcionCursos_Model->getCampoConfigurable($id_campo_dependiente);
        $array_opciones_padre = explode(";", $campo_padre->opciones);
        // Convertimos en array las opciones dependiente del hijo
        $array_opciones_dependiente_hijo = explode(";", $opciones_dependiente);
        // Si el array de intersección es el mismo que el array del hijo es que todas estaban contenidas
        $array_intersect = array_intersect($array_opciones_padre, $array_opciones_dependiente_hijo);
        // Comparamos
        if (count($array_intersect) == count($array_opciones_dependiente_hijo))
        {
            return TRUE;
        }
        else
        {
            $this->error_array[] = 'Algunas de las opciones dependientes introducidas no pertenecen a su padre';
            return FALSE;
        }
    }

    function validaOpcionesDepedientesFormulariosCursos($opciones_dependiente, $id_campo_dependiente)
    {
        if (!empty($id_campo_dependiente))
        {
            if (!empty($opciones_dependiente))
            {
                // Buscamos que todas las opciones dependientes introducidas
                return $this->checkOpcionesDependientesFormulariosCursosExisten($opciones_dependiente, $id_campo_dependiente);
            }
            else
            {
                $this->error_array[] = 'Debe seleccionar las opciones a las que pertenece el campo dependiente';
                return FALSE;
            }
        }
        else
        {
            if (!empty($opciones_dependiente))
            {
                $this->error_array[] = 'Debe seleccionar el campo dependiente al que pertenecen las opciones introducidas';
                return FALSE;
            }
            else
            {
                return TRUE;
            }
        }
    }

    /**     * ************************ VALIDACIONES CAMPOS CONFIGURABLES GENERAL ************************ */
    function validaFieldGroupConf($camposConfigurables)
    {
        $return = TRUE;
        foreach ($camposConfigurables as $campo)
        {
            if ($campo->obligatorio)
            {
                $opcionesSeleccionadas = 0;
                $nombreCampo = '';

                if ($campo->componente_html == 'checkbox_group')
                {
                    $nombre_campo = $this->CI->utilities->procesarNombreCampo($campo->nombre);
                    $opcionesCheckboxes = explode(';', $campo->opciones);

                    for ($i = 0; $i < count($opcionesCheckboxes); $i++)
                    {
                        //if($this->CI->input->post($nombre_campo . '_' . $this->CI->utilities->procesarNombreCampo($opcionesCheckboxes[$i])) != '')
                        if ($this->CI->utilities->GetSQLValueString($this->CI->input->post($nombre_campo . '_' . $this->CI->utilities->procesarNombreCampo($opcionesCheckboxes[$i])), 'defined', '1', '0'))
                        {
                            $opcionesSeleccionadas++;
                        }
                        else
                        {
                            $nombreCampo = $campo->nombre;
                        }
                    }
                }

                if ($opcionesSeleccionadas == 0 && $nombreCampo != '')
                {
                    $this->error_array[] = 'El campo <strong>' . $nombreCampo . '</strong> es obligatorio';
                    $return = FALSE;
                }
            }
        }
        return $return;
    }

    function validaFieldGroupConfFormularios($camposConfigurables)
    {
        $return = TRUE;
        foreach ($camposConfigurables as $campo)
        {
            if ($campo->obligatorio)
            {
                $opcionesSeleccionadas = 0;
                $nombreCampo = '';

                if ($campo->componente_html == 'checkbox_group')
                {
                    $nombre_campo = $this->CI->utilities->procesarNombreCampo($campo->nombre);
                    $opcionesCheckboxes = explode(';', $campo->opciones);

                    for ($i = 0; $i < count($opcionesCheckboxes); $i++)
                    {
                        //if($this->CI->input->post($nombre_campo . '_' . $this->CI->utilities->procesarNombreCampo($opcionesCheckboxes[$i])) != '')
                        if ($this->CI->utilities->GetSQLValueString($this->CI->input->post($nombre_campo . '_' . $this->CI->utilities->procesarNombreCampo($opcionesCheckboxes[$i])), 'defined', '1', '0'))
                        {
                            $opcionesSeleccionadas++;
                        }
                        else
                        {
                            $nombreCampo = $campo->nombre;
                        }
                    }
                }

                if ($opcionesSeleccionadas == 0 && $nombreCampo != '')
                {
                    $this->error_array[] = 'El campo <strong>' . $nombreCampo . '</strong> es obligatorio';
                    $return = FALSE;
                }
            }
        }
        return $return;
    }

    function checkOpcionesDependientesInscripcionExisten($opciones_dependiente, $id_campo_dependiente)
    {
        // Convertimos en array las opciones dependientes del padre
        $campo_padre = $this->CI->Carreras_Model->getCampoConfigurableInscripcion($id_campo_dependiente);
        $array_opciones_padre = explode(";", $campo_padre->opciones);
        // Convertimos en array las opciones dependiente del hijo
        $array_opciones_dependiente_hijo = explode(";", $opciones_dependiente);
        // Si el array de intersección es el mismo que el array del hijo es que todas estaban contenidas
        $array_intersect = array_intersect($array_opciones_padre, $array_opciones_dependiente_hijo);
        // Comparamos
        if (count($array_intersect) == count($array_opciones_dependiente_hijo))
        {
            return TRUE;
        }
        else
        {
            $this->error_array[] = 'Algunas de las opciones dependientes introducidas no pertenecen a su padre';
            return FALSE;
        }
    }

    function validaOpcionesDepedientesInscripcion($opciones_dependiente, $id_campo_dependiente)
    {
        if (!empty($id_campo_dependiente))
        {
            if (!empty($opciones_dependiente))
            {
                // Buscamos que todas las opciones dependientes introducidas
                return $this->checkOpcionesDependientesInscripcionExisten($opciones_dependiente, $id_campo_dependiente);
            }
            else
            {
                $this->error_array[] = 'Debe seleccionar las opciones a las que pertenece el campo dependiente';
                return FALSE;
            }
        }
        else
        {
            if (!empty($opciones_dependiente))
            {
                $this->error_array[] = 'Debe seleccionar el campo dependiente al que pertenecen las opciones introducidas';
                return FALSE;
            }
            else
            {
                return TRUE;
            }
        }
    }

    /*     * ************************* VALIDACIONES LICENCIAS ************************ */

    /**
     * validaEmailLicencia
     *
     * Valida que un email de una solicitud de licencia introducido es correcto
     *
     * @access	public
     * @param	string
     * @param	string
     * @return	boolean
     */
    function validaEmailLicencia($cif, $email)
    {
        if ($email != "")
        {
            if ($cif != "")
            {
                // Buscamos si el está en uso para otros NIFs
                if ($this->CI->Datos_Personales_Model->emailDisponibleByCIF($cif, $email))
                {
                    return TRUE;
                }
                else
                {
                    $this->error_array[] = 'El e-mail introducido está en uso';
                    return FALSE;
                }
            }
            else
            {
                return TRUE;
            }
        }
        else
        {
            return TRUE;
        }
    }

    /**
     * validaDocumentoAdjuntoManualmente
     *
     * Valida que un determinado tipo de documento ha sido adjuntado manualmente
     *
     * @access	public
     * @param	int
     * @param	string
     * @return	boolean
     */
    function validaDocumentoAdjuntoManualmente($idtipodoc, $idsesion)
    {
        // Establecemos directorio origen
        $dir_origen = $this->CI->amazon_files->getTmpDir() . $idsesion;
        // Leemos documentos del directorio origen
        $documentos = $this->CI->utilities->getDocsDir($dir_origen);
        // Si existen documentos
        if (count($documentos) > 0)
        {
            // Para cada documento
            foreach ($documentos as $documento)
            {
                // Rutas origen
                $ruta_fichero_origen = $dir_origen . "/" . $documento;
                // Se sube el fichero
                if (file_exists($ruta_fichero_origen))
                {
                    // Obtenemos el identificador del tipo de documento encontrado
                    $documento_divido = explode("_", $documento);
                    $idtipodoc_encontrado = $documento_divido[0];
                    // Comprobamos si casa con el solicitado
                    if ($idtipodoc == $idtipodoc_encontrado)
                    {
                        return TRUE;
                    }
                }
            }
            // Si llega al final es que no lo encontró
            return FALSE;
        }
        // Si no hay en la carpeta
        else
        {
            return FALSE;
        }
    }

    /**
     * validaDocumentacionLicenciaAdjuntos
     *
     * Valida que se han adjuntado todos los documentos necesarios para un determinado tipo de licencia
     *
     * @access	public
     * @param	int
     * @param	int
     * @return	boolean
     */
    function validaDocumentacionLicenciaAdjuntos($idcomunidadtipodoc, $temporada, $idtipolicencia, $idusuario, $cif, $idsesion, $tipovalidacion = "obligatorio")
    {
        // Consulta genérica
        $documentos = $this->CI->Licencias_Model->getDocumentosSolicitar($idcomunidadtipodoc, $idtipolicencia, $idusuario);
        // Leemos documentos
        if ($documentos > 0)
        {
            $doc_validation = TRUE;
            foreach ($documentos as $documento)
            {
                // Los documentos anuales y obligatorios, menores o extranjeros deben adjuntarse siempre por cada tipo de licencia
                // Eliminamos la condición de modificación en los anuales por que puede haber cambios de licencias a diferentes tipos que puedan necesitar documentación adicional
                // Por tanto, si debe volver a introducir los documentos en la modificación aunque ya los hubiera introducido antes (siempre y cuando no estuvieran validados), lo tendrá que hacer
                if (
                    ( $documento->anual /* && $this->CI->session->userdata('solicitar_tipo_solicitud')!='MODIFICACION' */ && ( ($documento->obligatorio && $tipovalidacion == "obligatorio") || ($documento->menores && $tipovalidacion == "menores") || ($documento->extranjeros && $tipovalidacion == "extranjeros")) ) && !$this->validaDocumentoAdjuntoManualmente($documento->idtipodoc, $idsesion)
                )
                {
                    $tipodoc = $this->CI->Documentos_Model->getTipo($documento->idtipodoc);
                    $this->error_array[] = 'El documento ' . $tipodoc->descripcion . ' es de carácter anual y debe adjuntarlo manualmente';
                    $doc_validation = FALSE;
                    $validation_documento_anual = FALSE;
                }
                else
                {
                    $validation_documento_anual = TRUE;
                }

                // Se busca que no esté validado ningún registro en el histórico que coincida con su CIF
                // Se buscan aquellos del tipo de validación indicada
                // Primero consultamos si tiene histórico
                // Luego si ha sido adjuntado manualmente
                // !$this->CI->Usuarios_Model->getEsUsuarioValidadoHistorico($idusuario,$cif)
                // !$this->CI->Usuarios_Model->getEsUsuarioValidadoHistorico(NULL, $cif)
                // Con el carnet ciclista se pide siempre la documentación
                if ($this->CI->data['no_solicitar_docs_federados_renovar'] && $idtipolicencia != 10)
                {
                    if ($this->CI->Licencias_Model->getEsUsuarioFederadoHistorico($idusuario, $cif, $temporada))
                    {
                        $validation_no_solicitar_docs_federados_renovar = FALSE;
                    }
                    else
                    {
                        $validation_no_solicitar_docs_federados_renovar = TRUE;
                    }
                }
                else
                {
                    $validation_no_solicitar_docs_federados_renovar = TRUE;
                }

                if ($validation_documento_anual && $validation_no_solicitar_docs_federados_renovar && $documento->$tipovalidacion && is_null($documento->iddoc) && !$this->validaDocumentoAdjuntoManualmente($documento->idtipodoc, $idsesion))
                {
                    $tipodoc = $this->CI->Documentos_Model->getTipo($documento->idtipodoc);
                    $this->error_array[] = 'El documento ' . $tipodoc->descripcion . ' no ha sido adjuntado';
                    $doc_validation = FALSE;
                }
            }
            return $doc_validation;
        }
        else
        {
            return TRUE;
        }
    }

    /**
     * validaDocumentacionLicenciaExtranjero
     *
     * Valida que se han adjuntado todos los documentos necesarios para un extranjero
     *
     * @access	public
     * @param	int
     * @param	string
     * @param	date
     * @param	int
     * @return	boolean
     */
    function validaDocumentacionLicenciaExtranjero($idcomunidadtipodoc, $temporada, $idtipolicencia, $idusuario, $idsesion, $cif, $fechanac, $idnacionalidad)
    {
        $extranjero = $this->CI->utilities->esExtranjero($cif, $idnacionalidad);
        if ($this->checkDateFormat($fechanac))
        {
            $edad = $this->CI->utilities->obtener_edad_licencia($this->CI->utilities->cambiafecha_form($fechanac));
        }
        else
        {
            return TRUE;
        }
        // Si es menor y no tiene cif no es necesario realizar validación
        if ($edad < 18 && $extranjero)
        {
            return TRUE;
        }
        // Si es mayor de edad y es extranjero
        if ($edad >= 18 && $extranjero)
        {
            return $this->validaDocumentacionLicenciaAdjuntos($idcomunidadtipodoc, $temporada, $idtipolicencia, $idusuario, $cif, $idsesion, "extranjeros");
        }
        return TRUE;
    }

    /**
     * validaDocumentacionLicenciaMenor
     *
     * Valida que se han adjuntado todos los documentos necesarios para un extranjero
     *
     * @access	public
     * @param	int
     * @param	string
     * @param	date
     * @param	int
     * @return	boolean
     */
    function validaDocumentacionLicenciaMenor($idcomunidadtipodoc, $temporada, $idtipolicencia, $idusuario, $cif, $idsesion, $fechanac)
    {
        if ($this->checkDateFormat($fechanac))
        {
            $edad = $this->CI->utilities->obtener_edad_licencia($this->CI->utilities->cambiafecha_form($fechanac));
        }
        else
        {
            return TRUE;
        }
        // Si mayor de edad
        if ($edad >= 18)
        {
            return TRUE;
        }
        else
        {
            return $this->validaDocumentacionLicenciaAdjuntos($idcomunidadtipodoc, $temporada, $idtipolicencia, $idusuario, $cif, $idsesion, "menores");
        }
    }

    /**
     * validaDocumentacionLicencia
     *
     * Valida que se han adjuntado todos los documentos necesarios en una solicitud de licencia
     *
     * @access	public
     * @param	int
     * @param	int
     * @param	string
     * @param	date
     * @return	boolean
     */
    function validaDocumentacionLicencia($idcomunidadtipodoc, $temporada, $idtipolicencia, $idusuario, $cif, $fechanac, $idsesion, $idnacionalidad)
    {
        // Validaciones para personas físicas
        if ($idtipolicencia !== 1 && $idtipolicencia != 8 && $idtipolicencia != 11)
        {
            // Validaciones para menores
            $validation_menores = $this->validaDocumentacionLicenciaMenor($idcomunidadtipodoc, $temporada, $idtipolicencia, $idusuario, $cif, $idsesion, $fechanac);
            // Validaciones para extranjeros
            $validation_extranjeros = $this->validaDocumentacionLicenciaExtranjero($idcomunidadtipodoc, $temporada, $idtipolicencia, $idusuario, $idsesion, $cif, $fechanac, $idnacionalidad);
        }
        else
        {
            $validation_menores = TRUE;
            $validation_extranjeros = TRUE;
        }
        // Validaciones generales (Documentos adjuntos o histórico)
        $validation_adjuntos = $this->validaDocumentacionLicenciaAdjuntos($idcomunidadtipodoc, $temporada, $idtipolicencia, $idusuario, $cif, $idsesion);
        // Si todas las validaciones son correctas
        if ($validation_menores && $validation_extranjeros && $validation_adjuntos)
            return TRUE;
        else
            return FALSE;
    }

    /**
     * validaNuevaLicenciaSolicitada
     *
     * Valida que un se está solicitando una nueva licencia
     *
     * @access	public
     * @param	int
     * @return	boolean
     */
    function validaNuevaLicenciaSolicitada($idlicenciasolicitada)
    {
        if ($idlicenciasolicitada)
        {
            $this->error_array[] = 'Ya ha enviado la solicitud actual. Vuelva a solicitarla desde el principio';
            return FALSE;
        }
        else
        {
            return TRUE;
        }
    }

    /**
     * validaCodPromoLicencia
     *
     * Valida que un código de promoción único está disponible para ser utilizado
     *
     * @access	public
     * @param	string
     * @return	boolean
     */
    function validaCodPromoLicencia($codPromo)
    {
        if ($codPromo != '')
        {
            $fecha_caducidad = $this->CI->Licencias_Model->existeCodPromo($codPromo);
            if ($fecha_caducidad != "")
            {
                $fecha_caducidad_timestamp = human_to_unix($fecha_caducidad, TRUE, 'eu'); // Euro time with seconds
                $diferencia_segundos = $fecha_caducidad_timestamp - now();
                if ($diferencia_segundos > 0)
                {
                    return TRUE;
                }
                else
                {
                    $this->set_message('validaCodPromoLicencia', 'El %s ya ha caducado');
                    return FALSE;
                }
            }
            else
            {
                $this->set_message('validaCodPromoLicencia', 'No hay ningún código activo para %s');
                return FALSE;
            }
        }
        else
            return TRUE;
    }

    /**
     * validaCodPromoCarnetCiclista
     *
     * Valida que un código de promoción único está disponible para ser utilizado
     *
     * @access	public
     * @param	string
     * @return	boolean
     */
    function validaCodPromoCarnetCiclista($codPromo)
    {
        if ($codPromo != '')
        {
            $fecha_caducidad = $this->CI->Licencias_Model->existeCodPromoCarnetCiclista($codPromo);
            if ($fecha_caducidad != "")
            {
                $fecha_caducidad_timestamp = human_to_unix($fecha_caducidad, TRUE, 'eu'); // Euro time with seconds
                $diferencia_segundos = $fecha_caducidad_timestamp - now();
                if ($diferencia_segundos > 0)
                {
                    return TRUE;
                }
                else
                {
                    $this->set_message('validaCodPromoCarnetCiclista', 'El %s ya ha caducado');
                    return FALSE;
                }
            }
            else
            {
                $this->set_message('validaCodPromoCarnetCiclista', 'No hay ningún código activo para %s');
                return FALSE;
            }
        }
        else
            return TRUE;
    }

    /**
     * validaCodPromoUnicosLicencia
     *
     * Valida que ninguno de los códigos introducidos está repetido
     *
     * @access	public
     * @param	string
     * @param	string
     * @param	string
     * @return	boolean
     */
    function validaCodPromoUnicosLicencia($codPromo1, $codPromo2, $codPromo3)
    {
        if (($codPromo1 == $codPromo2 && $codPromo1 != "" && $codPromo2 != "") ||
            ($codPromo1 == $codPromo3 && $codPromo1 != "" && $codPromo3 != "") ||
            ($codPromo2 == $codPromo3 && $codPromo2 != "" && $codPromo3 != ""))
        {
            $this->error_array[] = 'Alguno de los códigos promocionales introducidos no es único';
            return FALSE;
        }
        else
            return TRUE;
    }

    /**
     * validaEdadCarnetCiclista
     *
     * Valida que se el solicitante esté dentro del rango de carnet ciclista
     *
     * @access	public
     * @param	int
     * @return	boolean
     */
    function validaEdadCarnetCiclista($fechanac_form)
    {
        $idcategoriacarnetciclista = $this->CI->Licencias_Model->getCategoriaCarnetCiclista($fechanac_form);
        if ($idcategoriacarnetciclista)
        {
            return $idcategoriacarnetciclista;
        }
        else
        {
            $this->error_array[] = 'Lo sentimos, no se encuentra en el rango de edad para poder solicitar un carnet ciclista';
            return FALSE;
        }
    }

    /**
     * validaCategoriaArbitro
     *
     * Valida que un árbitro puede realizar licencia con la categoría solicitada
     *
     * @access	public
     * @param	string
     * @param	int
     * @return	boolean
     */
    function validaCategoriaArbitro($cif, $idcategoria)
    {
        if (empty($idcategoria) || empty($cif))
        {
            return TRUE;
        }
        else
        {
            // Leemos la categoría solicitada
            $categoria_solicitada = $this->CI->Categorias_Model->getCategoria($idcategoria);
            // No hacemos las comprobaciones en el caso de que sea 48,49 o 50 porque esas categorias no están metidas en la bd de arbitros
            if (in_array($categoria_solicitada->codigo, array(48, 49, 50)))
            {
                return TRUE;
            }
            else
            {
                $cif_formateado = $this->CI->Licencias_Model->formatearCIF($cif);
                $arbitro = $this->CI->Arbitros_Model->getByLicenciaCat($cif_formateado, $categoria_solicitada->codigo);
                if ($arbitro > 0)
                {
                    return TRUE;
                }
                else if ($arbitro == -1)
                {
                    $this->error_array[] = 'Su curso de árbitro aún no ha sido validado';
                    return FALSE;
                }
                else if ($arbitro == -2)
                {
                    $this->error_array[] = 'El nivel de la categoría de árbitro seleccionada es superior al nivel del curso de árbitro que posee';
                    return FALSE;
                }
                else
                {
                    $this->error_array[] = 'No posee curso de árbitro';
                    return FALSE;
                }
            }
        }
    }

    function validaTecnico($cif, $idcategoria, $fecha_comprobacion, $temporada, $id_padre_modificacion = NULL, $idlicencia = NULL)
    {
        $validaCategoriaTecnico = $this->validaCategoriaTecnico($cif, $idcategoria, $fecha_comprobacion, $idlicencia);
        if ($validaCategoriaTecnico == 1)
        {
            return $this->validaTecnicoIncompatible($cif, $idcategoria, $temporada, $idlicencia, $id_padre_modificacion);
        }
        else
        {
            return $validaCategoriaTecnico;
        }
    }

    function validaTecnicoIncompatible($cif, $idcategoria, $temporada, $idlicencia = NULL, $id_padre_modificacion = NULL)
    {
        if (empty($idcategoria) || empty($cif))
        {
            return 1;
        }
        else
        {
            // Leemos la categoría solicitada
            $categoria_solicitada = $this->CI->Categorias_Model->getCategoria($idcategoria);

            // Añadimos una comprobación previa para categorías de directores deportivos y varios que no pueden estar repetida
            if (in_array($categoria_solicitada->codigo, array(24, 25, 26, 27, 55, 56, 200, 211, 212, 213, 214, 219, 222, 223, 224, 225, 233, 234, 235, 236, 244, 245, 246, 247, 259, 306)))
            {
                $cif_formateado = $this->CI->Licencias_Model->formatearCIF($cif);
                if ($this->CI->Licencias_Model->checkLicenciaTecnicoDeportivoNoRepetida($cif_formateado, $temporada, $idlicencia, $id_padre_modificacion))
                {
                    $this->error_array[] = 'Existe otra licencia de director deportivo o equivalente ya solicitada';
                    return -5;
                }
            }

            return 1;
        }
    }

    /**
     * validaCategoriaTecnico
     *
     * Valida que un técnico puede realizar licencia con la categoría solicitada
     *
     * @access	public
     * @param	string
     * @param	int
     * @return	boolean
     */
    function validaCategoriaTecnico($cif, $idcategoria, $fecha_comprobacion, $idlicencia = NULL)
    {
        if (empty($idcategoria) || empty($cif))
        {
            return 1;
        }
        else
        {
            // Leemos la categoría solicitada
            $categoria_solicitada = $this->CI->Categorias_Model->getCategoria($idcategoria);
            // No hacemos las comprobaciones en el caso de que no sea 24,25 o 26 porque esas categorias no están metidas en la bd de tecnicos
            if (!in_array($categoria_solicitada->codigo, array(24, 25, 26, 27, 55, 56, 233, 234, 235, 236, 244, 245, 246, 247, 259, 306)))
            {
                return 1;
            }
            else
            {
                $cif_formateado = $this->CI->Licencias_Model->formatearCIF($cif);
                $entrenador = $this->CI->Entrenadores_Model->getByLicencia($cif_formateado, $categoria_solicitada->codigo);

                if ($entrenador)
                {
                    // Si son categorías en prácticas
                    if (in_array($categoria_solicitada->codigo, array(27, 55, 56)))
                    {
                        $fecha_celebracion_aumentada = strtotime('+2 year', strtotime($entrenador->fecha_celebracion));
                        $date1 = date('d/m/Y', $fecha_celebracion_aumentada);
                        $date2 = $this->CI->utilities->cambiafecha_bd($fecha_comprobacion);
                        // La fecha de celebración no puede ser superior a dos años
                        if ($this->CI->utilities->compararFechas($date2, $date1) > 0)
                        {
                            $this->error_array[] = 'La fecha de celebración del curso de la categoría en prácticas seleccionada es superior a dos años';
                            return -3;
                        }
                        // Si el cif introducido no puede tener otra licencia en prácticas solicitada con el mismo código en cualquier temporada
                        if ($this->CI->Licencias_Model->tieneLicenciasCategoriasEnPracticas($cif_formateado, $categoria_solicitada->codigo, $idlicencia))
                        {
                            $this->error_array[] = 'Ya tiene otra licencia solicitada para la categoría en prácticas seleccionada';
                            return -2;
                        }
                    }

                    // Si no está validado
                    if (!$entrenador->validado)
                    {
                        $this->error_array[] = 'Su curso de técnico no está validado';
                        return -4;
                    }

                    // Si todo fue bien
                    return 1;
                }
                else
                {
                    $this->error_array[] = 'No posee curso de técnico para la categoría seleccionada';
                    return -1;
                }
            }
        }
    }

    /**
     * validaLicenciaRepetidaSolicitar
     *
     * Valida que la licencia no esté repetida dentro de una solicitud de un usuario
     *
     * @access	public
     * @return	boolean
     */
    function validaLicenciaRepetidaSolicitar($temporada, $idusuario, $idsolicitante, $idtipogeneral, $idcomunidad)
    {
        if (empty($idtipogeneral) || empty($idsolicitante) || empty($idusuario) || empty($temporada) || empty($idcomunidad))
        {
            return FALSE;
        }
        else
        {
            // Las licencias de técnicas pueden repetirse, deberá de validarse posteriormente a nivel de categoría
            if ($idtipogeneral == 3)
                return TRUE;

            $comunidad = $this->CI->Comunidades_Model->getTieneSmartweb($idcomunidad);
            // Leemos la categoría solicitada
            $check = $this->CI->Licencias_Model->getLicenciaRepetidaSolicitar($temporada, $idusuario, $idsolicitante, $idtipogeneral, $idcomunidad);
            if (!empty($check))
            {
                if ($idtipogeneral == 8)
                {
                    if (!$comunidad->tiene_smartweb || $this->CI->data['esadmin'])
                        $this->error_array[] = 'Ya ha solicitado usted un carnet ciclista. Si desea realizar algún cambio en su solicitud, borre la anterior de su listado y vuelva a solicitar uno nuevo. <br><br><p align="center"> - <a href="' . site_url('usuarios/index') . '">Volver</a> - </p>';
                    else
                        $this->error_array[] = 'Ya ha solicitado usted un carnet ciclista. Si desea realizar algún cambio en su solicitud, borre la anterior de su listado y vuelva a solicitar uno nuevo. <br><br><p align="center"> - <a href="' . site_url('smartweb/licencias/listalicencias') . '">Volver</a> - </p>';
                }
                else
                {
                    if (!$comunidad->tiene_smartweb || $this->CI->data['esadmin'])
                        $this->error_array[] = 'Ya ha solicitado usted una licencia con la misma categoría. Si desea realizar algún cambio en la licencia, borre la anterior en su listado de licencias y vuelva a solicitar una nueva. <br><br><p align="center"> - <a href="' . site_url('usuarios/index') . '">Volver</a> - </p>';
                    else
                        $this->error_array[] = 'Ya ha solicitado usted una licencia con la misma categoría. Si desea realizar algún cambio en la licencia, borre la anterior en su listado de licencias y vuelva a solicitar una nueva. <br><br><p align="center"> - <a href="' . site_url('smartweb/licencias/listalicencias') . '">Volver</a> - </p>';
                }
                return FALSE;
            }
            else
            {
                return TRUE;
            }
        }
    }

    /**
     * validaLicenciaIncompatibleSolicitar
     *
     * Valida que la licencia no es incompatible dentro de una solicitud de un usuario
     *
     * @access	public
     * @return	boolean
     */
    function validaLicenciaIncompatibleSolicitar($temporada, $idusuario, $idsolicitante, $idtipogeneral, $idcomunidad)
    {
        if (empty($idtipogeneral) || empty($idsolicitante) || empty($idusuario) || empty($temporada) || empty($idcomunidad))
        {
            return FALSE;
        }
        else
        {
            $comunidad = $this->CI->Comunidades_Model->getTieneSmartweb($idcomunidad);
            // Leemos la categoría solicitada
            $check = $this->CI->Licencias_Model->checkIncompatibilidadSolicitanteSolicitar($temporada, $idusuario, $idsolicitante, $idtipogeneral, $idcomunidad);
            if (!$check)
            {
                if (!$comunidad->tiene_smartweb || $this->CI->data['esadmin'])
                    $this->error_array[] = 'Ya existe una solicitud incompatible con la petición actual, tramitada por el club o el usuario desde su zona privada. Si lo que desea es hacer un cambio elimine primero la solicitud realizada anteriormente (Si ya estuviera pagada, no podrá borrarla. En ese caso, póngase en contacto con su federación). <br><br><p align="center"> - <a href="' . site_url('usuarios/index') . '">Volver</a> - </p>';
                else
                    $this->error_array[] = 'Ya existe una solicitud incompatible con la petición actual, tramitada por el club o el usuario desde su zona privada. Si lo que desea es hacer un cambio elimine primero la solicitud realizada anteriormente (Si ya estuviera pagada, no podrá borrarla. En ese caso, póngase en contacto con su federación). <br><br><p align="center"> - <a href="' . site_url($comunidad->url_seo) . '">Volver</a> - </p>';
                return FALSE;
            }
            else
            {
                return TRUE;
            }
        }
    }

    /**
     * validaNIFLicencia
     *
     * Valida que un NIF de licencia introducido es correcto
     *
     * @access	public
     * @param	integer
     * @param	string
     * @param	integer
     * @param	date
     * @return	boolean
     */
    function validaNIFLicencia($idusuario, $cif, $idtipolicenciageneral, $fechanac, $modoIDmenor, $modoIDextranjero, $idpais)
    {
        $fechanac_bd = $this->CI->utilities->cambiafecha_form($fechanac);
        $edad = $this->CI->utilities->obtener_edad_licencia($fechanac_bd);
        // Si el solicitante es mayor de edad o es un club o un organizador
        if ($idtipolicenciageneral == 1 || $idtipolicenciageneral == 6)
        {
            if ($cif != "")
            {
                if ($this->CI->utilities->valida_nif($cif) == 2)
                {
                    // Buscamos si el usuario especificado tiene ese NIF y está en uso
                    if ($this->CI->Usuarios_Model->nifUsuarioDisponible($cif, $idusuario))
                    {
                        return TRUE;
                    }
                    else
                    {
                        $this->error_array[] = 'El campo CIF lo tiene asignado otro usuario';
                        return FALSE;
                    }
                }
                else
                {
                    $this->error_array[] = 'Debe introducir un CIF correcto';
                    return FALSE;
                }
            }
            else
            {
                $this->error_array[] = 'El campo CIF es obligatorio';
                return FALSE;
            }
        }
        else if ($edad >= 18)
        {
            if ($modoIDextranjero == "generar")
            {
                if ($cif == "")
                    return TRUE;
                else
                {
                    $this->error_array[] = 'Para generar un nuevo identificador de extranjeros, debe dejar el campo NIF/CIF vacío';
                    return FALSE;
                }
            }
            else if ($cif != "")
            {
                // Hay que comprobar que si es un NIF, el pais no va a ser extranjero
                if ($this->CI->utilities->valida_nif($cif) == 1)
                {
                    if ($this->CI->utilities->esPaisExtranjero($idpais))
                    {
                        $this->error_array[] = 'No puede seleccionar un pais extranjero si ha introducido un NIF válido';
                        return FALSE;
                    }
                    else
                    {
                        // Buscamos si el usuario especificado tiene ese NIF y está en uso
                        if ($this->CI->Usuarios_Model->nifUsuarioDisponible($cif, $idusuario))
                        {
                            return TRUE;
                        }
                        else
                        {
                            $this->error_array[] = 'El campo NIF/NIE lo tiene asignado otro usuario';
                            return FALSE;
                        }
                    }
                }
                else if ($this->CI->utilities->valida_nif($cif) == 3)
                {
                    // Buscamos si el usuario especificado tiene ese NIF y está en uso
                    if ($this->CI->Usuarios_Model->nifUsuarioDisponible($cif, $idusuario))
                    {
                        return TRUE;
                    }
                    else
                    {
                        $this->error_array[] = 'El campo NIF/NIE lo tiene asignado otro usuario';
                        return FALSE;
                    }
                }
                else
                {
                    $this->error_array[] = 'El campo NIF/NIE es incorrecto';
                    return FALSE;
                }
            }
            else
            {
                $this->error_array[] = 'El campo NIF/NIE es obligatorio';
                return FALSE;
            }
        }
        else
        {
            // Si se marca que se genere el identificador explícitamente de menores
            if ($modoIDmenor == "generar")
            {
                if ($cif == "")
                    return TRUE;
                else
                {
                    $this->error_array[] = 'Para generar un nuevo identificador de menores, debe dejar el campo NIF/CIF vacío';
                    return FALSE;
                }
            }
            else // Si se marca que se genere el identificador explícitamente de extranjeros
            if ($modoIDextranjero == "generar")
            {
                if ($cif == "")
                    return TRUE;
                else
                {
                    $this->error_array[] = 'Para generar un nuevo identificador de extranjeros, debe dejar el campo NIF/CIF vacío';
                    return FALSE;
                }
            }
            // Si se usa un identificador de menores existente
            /* else if($modoIDmenor=="usar")
              {
              // Debe coincidir con el que tenga asignado el usuario en el sistema
              if($cif!="")
              {
              $usuario=$this->CI->Datos_Personales_Model->getDatosPersonales($idusuario);
              if($cif!=$usuario->cif)
              {
              $this->error_array[]='El identificador de menores utilizado no coincide con el asignado en la base de datos para el usuario en curso';
              return FALSE;
              }
              else
              return TRUE;
              }
              else
              {
              $this->error_array[]='El campo para identificador de menores es obligatorio';
              return FALSE;
              }
              } */
            else
            {
                if ($cif != "")
                {
                    // Hay que comprobar que si es un NIF, el pais no va a ser extranjero
                    if ($this->CI->utilities->valida_nif($cif) == 1)
                    {
                        if ($this->CI->utilities->esPaisExtranjero($idpais))
                        {
                            $this->error_array[] = 'No puede seleccionar un pais extranjero si ha introducido un NIF válido';
                            return FALSE;
                        }
                        else
                        {
                            // Buscamos si el usuario especificado tiene ese NIF y está en uso
                            if ($this->CI->Usuarios_Model->nifUsuarioDisponible($cif, $idusuario))
                            {
                                return TRUE;
                            }
                            else
                            {
                                $this->error_array[] = 'El campo NIF/NIE lo tiene asignado otro usuario';
                                return FALSE;
                            }
                        }
                    }
                    else if ($this->CI->utilities->valida_nif($cif) == 3 || $this->CI->utilities->num_ident_menores_valido($cif))
                    {
                        // Buscamos si el usuario especificado tiene ese NIF y está en uso
                        if ($this->CI->Usuarios_Model->nifUsuarioDisponible($cif, $idusuario))
                        {
                            return TRUE;
                        }
                        else
                        {
                            $this->error_array[] = 'El campo NIF/NIE lo tiene asignado otro usuario';
                            return FALSE;
                        }
                    }
                    else
                    {
                        $this->error_array[] = 'El campo NIF/NIE es incorrecto';
                        return FALSE;
                    }
                }
                else
                {
                    $this->error_array[] = 'El campo NIF/NIE es obligatorio';
                    return FALSE;
                }
            }
        }
    }

    /**
     *  Comprueba un NIF segun la edad y el tipo de licencia general.
     *
     * @param [cif]			NIF/NIE/CIF
     * @param [idtipolicenciageneral]			ID del tipo de licencia general
     * @param [edad]			edad
     *
     * @return 1 = NIF, 2 = CIF, 3 = NIE, 4 = Numero identificacion menores, FALSE = error
     */
    function validaNIFlicenciaedad($cif, $idtipolicenciageneral, $edad, $idpais)
    {
        $validanif = $this->CI->utilities->valida_nif($cif);

        //echo $cif."--".$idpais."--$edad--$validanif<br>";

        if ($idtipolicenciageneral == 1 || $idtipolicenciageneral == 6)
        {
            if ($validanif == 2)
                return TRUE;
            else
                return FALSE;
        } else if ($edad >= 18)
        {
            // Aquellos que empiecen por 99
            if (substr($cif, 0, 2) == '99')
                return 5;

            // Los extranjeros mayores de edad deben tener NIE válido
            if ($this->CI->utilities->esPaisExtranjero($idpais) && $validanif != 3)
                return 5;

            // Los nacionales mayores de edad deben tener NIF válido
            // Al poner esta condición estamos haciendo que los extranjeros que residen en España no se puedan introducir
            //if(!$this->CI->utilities->esPaisExtranjero($idpais) && $validanif == 3) return 5;
            // NIE o NIF Válido
            if ($validanif == 0 || $validanif == 3)
                return $validanif;
            else
                return FALSE;
        } else if ($edad < 18)
        {
            // Los menores pueden llevar NIF/NIE también
            if ($validanif == 0 || $validanif == 3)
            {
                return $validanif;
            }
            else
            {
                if ($this->CI->utilities->num_ident_menores_valido($cif))
                    return 4;
                else
                    return FALSE;
            }
        } else
        {
            return FALSE;
        }
    }

    function validaSexoLicencia($cif, $sexo, $idtipolicenciageneral)
    {
        // Sólo se comprueba el sexo para licencias para personas físicas
        if ($idtipolicenciageneral != 1 && $idtipolicenciageneral != 6)
        {
            return $this->validaSexoUsuario($cif, $sexo);
        }
        else
        {
            return TRUE;
        }
    }

    /**
     * validaCategoriaEquipoLicencia
     *
     * Valida que la categoría seleccionada en la licencia está habilitada para el equipo seleccionado
     *
     * @access	public
     * @param	integer
     * @param	integer
     * @return	boolean
     */
    function validaCategoriaEquipoLicencia($idequipo, $idcategoria)
    {
        if (!empty($idequipo) && !empty($idcategoria))
        {
            $categoria = $this->CI->Categorias_Model->getCategoria($idcategoria);
            $codcategoria = $categoria->codigo;
            // Buscamos si la categoría de licencia es incompatible con el equipo seleccionado
            if (!$this->CI->Clubes_Model->getEquipoCodCategoriaByID($idequipo, $codcategoria))
            {
                $this->error_array[] = 'La categoría de licencia es incompatible con el equipo seleccionado';
                return FALSE;
            }
            else
            {
                return TRUE;
            }
        }
        else
        {
            return TRUE;
        }
    }

    /**
     * validaIncompatibilidadLicencia
     *
     * Valida que la licencia no es incompatible con una existente
     *
     */
    function validaIncompatibilidadLicencia($dni, $idtipogeneral, $temporada)
    {
        if (empty($dni))
        {
            return TRUE;
        }
        else
        {
            $nif_cif = $this->CI->Licencias_Model->formatearCIF($dni);
            if (!$this->CI->Licencias_Model->checkTipoGeneral($nif_cif, $idtipogeneral, $temporada, NULL))
            {
                $this->error_array[] = 'La solicitud introducida es incompatible con otras registradas anteriormente';
                return FALSE;
            }
            else
            {
                return TRUE;
            }
        }
    }

    /**
     * validaExisteLicenciaSolicitar
     *
     * Valida que la licencia no ha sido importada anteriormente
     *
     */
    function validaExisteLicenciaSolicitar($temporada, $dni, $idtipolicenciageneral, $idcategoria)
    {
        if (empty($dni))
        {
            return TRUE;
        }
        else
        {
            $nif_cif = $this->CI->Licencias_Model->formatearCIF($dni);
            if ($this->CI->Licencias_Model->existeLicenciaImportarSolicitar($temporada, $nif_cif, $idtipolicenciageneral, $idcategoria))
            {
                $this->error_array[] = 'Ya existe una solicitud registrada con los datos introducidos. Póngase en contacto con el administrador para más información';
                return FALSE;
            }
            else
            {
                return TRUE;
            }
        }
    }

    /**
     * validaSolicitanteCambiaComunidad
     *
     * Valida que el NIF/CIF introducido no ha sido registrado en el año anterior con otra licencia en otra comunidad diferente a la actual
     *
     */
    function validaSolicitanteCambiaComunidad($temporada, $dni)
    {
        if (empty($dni))
        {
            return TRUE;
        }
        else
        {
            if ($this->CI->Licencias_Model->checkLicenciaOtraComunidad($temporada, $dni))
            {
                return TRUE;
            }
            else
            {
                $this->error_array[] = 'Usted tenía licencia en otra comunidad, consulte con su Federación de origen para tramitar el cambio';
                return FALSE;
            }
        }
    }

    /**
     * validaSolicitanteCarnetCiclistaCambiaComunidad
     *
     * Valida que el NIF/CIF introducido no ha sido registrado en el año anterior con otro carnet ciclista en otra comunidad diferente a la actual
     *
     */
    function validaSolicitanteCarnetCiclistaCambiaComunidad($temporada, $dni)
    {
        if (empty($dni))
        {
            return TRUE;
        }
        else
        {
            if ($this->CI->Licencias_Model->checkLicenciaOtraComunidad($temporada, $dni, TRUE))
            {
                return TRUE;
            }
            else
            {
                $this->error_array[] = 'Usted tenía carnet ciclista en otra comunidad, consulte con su Federación de origen para tramitar el cambio';
                return FALSE;
            }
        }
    }

    /**
     * validaCIFOtraComunidad
     *
     * Valida que un CIF de licencia introducido no está registrado en otra comunidad
     *
     * @access	public
     * @param	string
     * @param	integer
     * @return	boolean
     */
    function validaCIFOtraComunidad($cif, $idcomunidadlic)
    {
        if ($cif != "")
        {
            // Sólo comprobamos los CIFs
            if ($this->CI->utilities->valida_nif($cif) == 2)
            {
                // Buscamos si el usuario especificado tiene ese CIF en otra comunidad
                if ($this->CI->Datos_Personales_Model->CIFRegistradoOtraComunidad($cif, $idcomunidadlic))
                {
                    $this->error_array[] = 'El campo CIF está asignado en otra comunidad para el club/organizador actual';
                    return FALSE;
                }
                else
                {
                    return TRUE;
                }
            }
            else
            {
                return TRUE;
            }
        }
        else
        {
            return TRUE;
        }
    }

    /**
     * validaNIFLicenciaOtraComunidad
     *
     * Valida que un NIF de licencia introducido no está registrado en otra comunidad
     *
     * @access	public
     * @param	string
     * @param	integer
     * @return	boolean
     */
    function validaNIFLicenciaOtraComunidad($cif_user, $temporada, $idcomunidadlic)
    {
        if ($cif_user != "")
        {
            // Sólo comprobamos los personas físicas
            if ($this->CI->utilities->valida_nif($cif_user) != 2)
            {
                // Buscamos si el existen licencias solicitadas en otras comunidades
                if ($this->CI->Licencias_Model->existeLicenciaOtraComunidad($cif_user, $temporada, $idcomunidadlic))
                {
                    $this->error_array[] = 'Ya existe una licencia solicitada en otra comunidad para el NIF/CIF indicado';
                    return FALSE;
                }
                else
                {
                    return TRUE;
                }
            }
            else
            {
                return TRUE;
            }
        }
        else
        {
            return TRUE;
        }
    }

    /**
     * validaNIFLicenciaOtraComunidad
     *
     * Valida que un NIF de carnet ciclista introducido no está registrado en otra comunidad
     *
     * @access	public
     * @param	string
     * @param	integer
     * @return	boolean
     */
    function validaNIFCarnetCiclistaOtraComunidad($cif_user, $temporada, $idcomunidadlic)
    {
        if ($cif_user != "")
        {
            // Sólo comprobamos los personas físicas
            if ($this->CI->utilities->valida_nif($cif_user) != 2)
            {
                // Buscamos si el existen licencias solicitadas en otras comunidades
                if ($this->CI->Licencias_Model->existeLicenciaOtraComunidad($cif_user, $temporada, $idcomunidadlic, TRUE))
                {
                    $this->error_array[] = 'Ya existe un carnet ciclista solicitado en otra comunidad para el NIF/CIF indicado';
                    return FALSE;
                }
                else
                {
                    return TRUE;
                }
            }
            else
            {
                return TRUE;
            }
        }
        else
        {
            return TRUE;
        }
    }

    /**
     * validaCorredorNoSancionado
     *
     * Valida que un NIF/NIE no está sancionado actualmente
     *
     * @access	public
     * @param	string
     * @return	boolean
     */
    function validaCorredorNoSancionado($cif, $fecha_comprobacion = NULL)
    {
        if ($cif != "")
        {
            // Convertimos
            $num_licencia = $this->CI->utilities->convertirNIFNumLicenciaGenerico($cif);
            // Determinamos si tiene una sanción vigente
            if ($this->CI->Sancionados_Model->get_sancionado_activo($num_licencia, $fecha_comprobacion))
            {
                $this->error_array[] = 'El corredor con el NIF/NIE especificado está actualmente sancionado o no puede obtener licencia';
                return FALSE;
            }
            else
            {
                return TRUE;
            }
        }
        else
        {
            return TRUE;
        }
    }

    /**
     * validaRestriccionProvincias
     *
     * Valida que la provincia no está contenida en el array de provincias restringidas
     *
     * @access	public
     * @param	array
     * @param	integer
     * @return	boolean
     */
    function validaRestriccionProvincias($restricciones_provincias, $idprovincia)
    {
        if (count($restricciones_provincias))
        {
            if (!in_array($idprovincia, $restricciones_provincias))
            {
                $this->error_array[] = 'Esta prueba está reservada a participantes pertenecientes a las siguientes provincias: ' . $this->CI->utilities->getNombresProvincias($restricciones_provincias);
                return FALSE;
            }
            else
            {
                return TRUE;
            }
        }
        else
        {
            return TRUE;
        }
    }

    /*     * ************************ VALIDACIONES USUARIO *************************** */

    /**
     * validaLicenciaActivaOtraComunidad
     *
     * Valida que un NIF/CIF/NIE introducido no está registrado en otra comunidad al solicitar verificación
     *
     * @access	public
     * @param	string
     * @param	integer
     * @return	boolean
     */
    function validaLicenciaActivaOtraComunidad($cif, $idcomunidadlic, $temporada)
    {
        if ($cif != "")
        {
            // Buscamos si el usuario especificado tiene ese CIF en otra comunidad
            if ($this->CI->Licencias_Model->getLicenciasActivasOtraComunidad($cif, $idcomunidadlic, $temporada))
            {
                $this->error_array[] = 'El NIF/CIF/NIE introducido tiene licencia activa en otra comunidad';
                return FALSE;
            }
            else
            {
                return TRUE;
            }
        }
        else
        {
            return TRUE;
        }
    }

    /**
     * validaNIFUsuarioLicencia
     *
     * Valida que un NIF de un usuario de una licencia introducido es correcto
     *
     * @access	public
     * @param	integer
     * @param	string
     * @param	date
     * @return	boolean
     */
    function validaNIFUsuarioLicencia($cif)
    {
        if ($cif != "")
        {
            if ($this->CI->utilities->valida_nif($cif) > 0 || $this->CI->utilities->num_ident_menores_valido($cif))
            {
                return TRUE;
            }
            else
            {
                $this->error_array[] = 'El campo NIF/CIF/NIE es incorrecto';
                return FALSE;
            }
        }
        else
        {
            return TRUE;
        }
    }

    function validaNIFAutorizadoClubLicencia($cif, $idpais)
    {
        if ($cif != "")
        {
            // Hay que comprobar que si es un NIF, el pais no va a ser extranjero
            if ($this->CI->utilities->valida_nif($cif) == 1)
            {
                if ($this->CI->utilities->esPaisExtranjero($idpais))
                {
                    $this->error_array[] = 'No puede seleccionar un pais extranjero si ha introducido un NIF válido';
                    return FALSE;
                }
                else
                {
                    return TRUE;
                }
            }
            else if ($this->CI->utilities->valida_nif($cif) == 3 || $this->CI->utilities->num_ident_menores_valido($cif))
            {
                return TRUE;
            }
            else
            {
                $this->error_array[] = 'El campo NIF/NIE es incorrecto';
                return FALSE;
            }
        }
        else
        {
            return TRUE;
        }
    }

    /**
     * validaNIFSolicitarAutorizadoClub
     *
     * Valida que un NIF de un autorizado de un club no está repetido dentro del club
     *
     * @access	public
     * @param	integer
     * @param	string
     * @param	date
     * @return	boolean
     */
    function validaNIFAutorizadoClubNoRepetido($cif, $idasociado, $idclub)
    {
        // Sólo se debe comprobar cuando sea una licencia para un club determinado, en el cual debe estar autorizado el usuario y además sea el admin o el club quien lo solicita
        if (!empty($cif) && !empty($idasociado) && !empty($idclub) && $idclub != $this->CI->data['id_independiente'] && $idclub != $this->CI->data['id_club_arbitros'])
        {
            if ($this->CI->Clubes_Model->checkNIFAutorizadoClubNoRepetido($cif, $idasociado, $idclub))
            {
                return TRUE;
            }
            else
            {
                $this->error_array[] = 'El NIF/CIF/NIE introducido está asignado a otra persona dentro del club seleccionado';
                return FALSE;
            }
        }
        else
        {
            return TRUE;
        }
    }

    /**
     * validaRAEDUsuarioLicencia
     *
     * Valida que un RAED de un usuario introducido de una licencia es correcto
     *
     * @access	public
     * @param	integer
     * @param	string
     * @param	string
     * @return	boolean
     */
    function validaRAEDUsuarioLicencia($cif, $raed)
    {
        // Se comprueba que sólo se puede meter si es un CIF
        if ($cif != "")
        {
            if ($this->CI->utilities->valida_nif($cif) == 2)
            {
                return TRUE;
            }
            else
            {
                if ($raed != "")
                {
                    $this->error_array[] = 'Sólo puede rellenar el campo R.A.E.D si introduce el CIF correspondiente';
                    return FALSE;
                }
                else
                {
                    return TRUE;
                }
            }
        }
        else
        {
            return TRUE;
        }
    }

    /*     * ************************ VALIDACIONES INSCRIPCIONES *************************** */

    /**
     * validaNIFNoUsuario
     *
     * Valida que un NIF de un inscrito introducido es correcto
     *
     * @access	public
     * @return	boolean
     */
    function validaNIFNoUsuario($id, $cif, $idpais)
    {
        // Los paises extranjeros no tienen validación
        if (!empty($cif))
        {
            if ($this->CI->utilities->valida_nif($cif) == 1 || $this->CI->utilities->valida_nif($cif) == 3 || $this->CI->utilities->num_ident_menores_valido($cif) || $this->CI->utilities->esPaisExtranjero($idpais))
            {
                // Buscamos si el usuario no registrado especificado tiene ese NIF y está en uso
                if ($this->CI->Datos_Personales_Model->nifNoUsuarioDisponible($cif, $id))
                {
                    return TRUE;
                }
                else
                {
                    $this->error_array[] = 'El NIF/NIE introducido ya está registrado';
                    return FALSE;
                }
            }
            else
            {
                $this->error_array[] = 'El campo NIF/NIE es incorrecto';
                return TRUE;
            }
        }
    }

    /*     * ************************ VALIDACIONES INSCRIPCIONES *************************** */

    /**
     * validaNIFInscripciones
     *
     * Valida que un NIF de un inscrito introducido es correcto
     *
     * @access	public
     * @param	integer
     * @param	string
     * @return	boolean
     */
    function validaNIFInscripciones($idprueba, $cif, $idpais, $no_inscripcion_sin_pagar, $idinscrito = NULL)
    {
        // Los paises extranjeros no tienen validación
        if ($cif != "")
        {
            if ($this->CI->utilities->valida_nif($cif) == 1 || $this->CI->utilities->valida_nif($cif) == 3 || $this->CI->utilities->num_ident_menores_valido($cif) || $this->CI->utilities->esPaisExtranjero($idpais))
            {
                // Buscamos si el inscrito especificado tiene ese NIF y está en uso
                if ($no_inscripcion_sin_pagar)
                {
                    $pagado = 1;
                }
                else
                {
                    $pagado = NULL;
                }
                if ($this->CI->Carreras_Model->nifInscritoDisponible($cif, $idprueba, $idinscrito, $pagado))
                {
                    return TRUE;
                }
                else
                {
                    $this->error_array[] = 'El NIF/NIE introducido ya está inscrito en la prueba actual';
                    return FALSE;
                }
            }
            else
            {
                $this->error_array[] = 'El campo NIF/NIE es incorrecto';
                return FALSE;
            }
        }
        else
        {
            return TRUE;
        }
    }

    /**
     * validaNIFInscripciones
     *
     * Valida que un NIF de un inscrito introducido es correcto
     *
     * @access	public
     * @param	integer
     * @param	string
     * @return	boolean
     */
    function validaUCIIExtranjerosInscripciones($idprueba, $uciid_extranjeros, $idpais, $no_inscripcion_sin_pagar, $idinscrito = NULL)
    {
        // Los paises extranjeros no tienen validación
        if (!empty($uciid_extranjeros) && $this->CI->utilities->esPaisExtranjero($idpais))
        {
            if ($no_inscripcion_sin_pagar)
            {
                $pagado = 1;
            }
            else
            {
                $pagado = NULL;
            }
            if ($this->CI->Carreras_Model->UCIIDInscritoDisponible($uciid_extranjeros, $idprueba, $idinscrito, $pagado))
            {
                return TRUE;
            }
            else
            {
                $this->error_array[] = 'El UCI ID introducido ya lo tiene asignado otro corredor';
                return FALSE;
            }
        }
        else
        {
            return TRUE;
        }
    }

    /**
     * validaFechaNacMenor
     *
     * Valida que la fecha de nacimiento del menor no ha llegado a 18 años el día de la prueba
     *
     * @access	public
     * @param	date
     * @param	date
     * @return	boolean
     */
    function validaFechaNacMenor($fechanac, $fechaprueba)
    {
        if (!empty($fechanac) && !empty($fechaprueba))
        {
            if ($this->CI->utilities->obtener_edad_hasta($this->CI->utilities->cambiafecha_form($fechanac), $this->CI->utilities->cambiafecha_form($fechaprueba)) < 18)
            {
                return TRUE;
            }
            else
            {
                $this->error_array[] = 'Ya ha alcanzado la mayoría de edad en la fecha de la prueba';
                return FALSE;
            }
        }
        else
        {
            return TRUE;
        }
    }

    /**
     * validaNIFDNIDoble
     *
     * Valida que un NIF de un inscrito y el de su pareja no coinciden y es correcto
     *
     * @access	public
     * @param	integer
     * @param	string
     * @return	boolean
     */
    function validaNIFDNIDoble($idprueba, $cif, $dnidoble)
    {
        if ($cif != $dnidoble)
        {
            if (!empty($dnidoble))
            {
                if ($this->CI->utilities->valida_nif($dnidoble) == 1 || $this->CI->utilities->valida_nif($dnidoble) == 3)
                {
                    // Buscamos si la pareja especificada tiene ese NIF y está en uso
                    if ($this->CI->Carreras_Model->nifDobleInscritoDisponible($dnidoble, $idprueba))
                    {
                        return TRUE;
                    }
                    else
                    {
                        $this->error_array[] = 'El NIF/NIE de su pareja ya está asociado a un inscrito en la prueba actual';
                        return FALSE;
                    }
                }
                else
                {
                    $this->error_array[] = 'El NIF/NIE de su pareja es incorrecto';
                    return FALSE;
                }
            }
            else
            {
                return TRUE;
            }
        }
        else
        {
            $this->error_array[] = 'El NIF/NIE del inscrito no puede coincidir con el NIF/CIF de su pareja';
            return FALSE;
        }
    }

    /**
     * validaNIFInscripcionesDorsales
     *
     * Valida que un NIF de un importación de dorsales de inscrito introducido es correcto
     *
     * @access	public
     * @param	integer
     * @param	string
     * @return	boolean
     */
    function validaNIFInscripcionesDorsales($idprueba, $cif, $idpais)
    {
        // Los paises extranjeros no tienen validación
        if ($cif != "")
        {
            if ($this->CI->utilities->valida_nif($cif) == 1 || $this->CI->utilities->valida_nif($cif) == 3 || $this->CI->utilities->num_ident_menores_inscripciones_valido($cif) || $this->CI->utilities->num_ident_menores_valido($cif) || $this->CI->utilities->esPaisExtranjero($idpais))
            {
                return TRUE;
            }
            else
            {
                $this->error_array[] = 'El campo NIF/NIE es incorrecto';
                return FALSE;
            }
        }
        else
        {
            $this->error_array[] = 'El campo NIF/NIE no ha sido especificado';
            return FALSE;
        }
    }

    /*     * ************************ VALIDACIONES INSCRIPCIONES CURSOS *************************** */

    /**
     * validaNIFInscripcionesCursos
     *
     * Valida que un NIF de un inscrito introducido es correcto
     *
     * @access	public
     * @param	integer
     * @param	string
     * @return	boolean
     */
    function validaNIFInscripcionesCursos($idprueba, $cif, $idpais, $idinscrito = NULL)
    {
        // Los paises extranjeros no tienen validación
        if ($cif != "")
        {
            if ($this->CI->utilities->valida_nif($cif) == 1 || $this->CI->utilities->valida_nif($cif) == 3 || $this->CI->utilities->num_ident_menores_valido($cif) || $this->CI->utilities->esPaisExtranjero($idpais))
            {
                // Buscamos si el inscrito especificado tiene ese NIF y está en uso
                if ($this->CI->Cursos_Model->nifInscritoDisponible($cif, $idprueba, $idinscrito))
                {
                    return TRUE;
                }
                else
                {
                    $this->error_array[] = 'El NIF/NIE introducido ya está inscrito en el evento actual';
                    return FALSE;
                }
            }
            else
            {
                $this->error_array[] = 'El campo NIF/NIE es incorrecto';
                return FALSE;
            }
        }
        else
        {
            return TRUE;
        }
    }

    /*     * ************************ VALIDACIONES CLUBES *************************** */

    /**
     * validaCIFClub
     *
     * Valida que un CIF de un club introducido es correcto
     *
     * @access	public
     * @param	integer
     * @param	string
     * @return	boolean
     */
    function validaCIFClub($idusuario = NULL, $cif)
    {
        if ($cif != "")
        {
            if ($this->CI->utilities->valida_nif($cif) == 2)
            {
                // Buscamos si el club especificado tiene ese NIF y está en uso
                if ($this->CI->Datos_Personales_Model->cifDisponible($cif, $idusuario))
                {
                    return TRUE;
                }
                else
                {
                    $this->error_array[] = 'El campo CIF está en uso';
                    return FALSE;
                }
            }
            else
            {
                $this->error_array[] = 'El campo CIF es incorrecto';
                return FALSE;
            }
        }
        else
        {
            return TRUE;
        }
    }

    /**
     * validaRAEDClub
     *
     * Valida que un RAED de un club introducido es correcto
     *
     * @access	public
     * @param	integer
     * @param	string
     * @param	string
     * @param	integer
     * @return	boolean
     */
    function validaRAEDClub($idusuario = NULL, $cif, $raed, $idcomunidaddp = NULL)
    {
        // Se determina la comunidad sobre la que se debe validar
        if (!is_null($idusuario))
        {
            $datos_personales = $this->CI->Datos_Personales_Model->getDatosPersonales($idusuario);
            $idcomunidaddp = $datos_personales->idcomunidaddp;
        }
        // Se comprueba que sólo se puede meter si es un CIF
        if ($cif != "")
        {
            if ($this->CI->utilities->valida_nif($cif) == 2)
            {
                if ($raed != "")
                {
                    // Buscamos si el club especificado tiene ese raed y está en uso
                    if ($this->CI->Datos_Personales_Model->raedDisponible($raed, $idusuario, $idcomunidaddp))
                    {
                        return TRUE;
                    }
                    else
                    {
                        $this->error_array[] = 'El campo R.A.E.D está en uso';
                        return FALSE;
                    }
                }
                else
                {
                    return TRUE;
                }
            }
            else
            {
                if ($raed != "")
                {
                    $this->error_array[] = 'Sólo puede rellenar el campo R.A.E.D si introduce el CIF correspondiente';
                    return FALSE;
                }
                else
                {
                    return TRUE;
                }
            }
        }
        else
        {
            return TRUE;
        }
    }

    /*     * ************************ VALIDACIONES USUARIO *************************** */

    /**
     * validaNIFUsuario
     *
     * Valida que un NIF de un usuario introducido es correcto
     *
     * @access	public
     * @param	integer
     * @param	string
     * @return	boolean
     */
    function validaNIFUsuario($idusuario = NULL, $cif)
    {
        if ($cif != "")
        {
            if ($this->CI->utilities->valida_nif($cif) > 0 || $this->CI->utilities->num_ident_menores_valido($cif))
            {
                // Buscamos si el usuario especificado tiene ese NIF y está en uso
                if ($this->CI->Usuarios_Model->nifUsuarioDisponible($cif, $idusuario))
                {
                    return TRUE;
                }
                else
                {
                    $this->error_array[] = 'El campo NIF/CIF está en uso';
                    $this->CI->session->set_flashdata('mensaje', 'El campo NIF/CIF está en uso');
                    return FALSE;
                }
            }
            else
            {
                $this->error_array[] = 'El campo NIF/CIF es incorrecto';
                $this->CI->session->set_flashdata('mensaje', 'El campo NIF/CIF es incorrecto');
                return FALSE;
            }
        }
        else
        {
            return TRUE;
        }
    }

    /**
     * validaNIFFusion
     *
     * Valida que un NIF de un usuario introducido existe en el histórico
     *
     * @access	public
     * @param	string
     * @return	boolean
     */
    function validaNIFFusion($cif)
    {
        if ($cif != "")
        {
            // Buscamos si el NIF tiene opciones para fusionar en el histórico
            $datos_personales = $this->CI->Datos_Personales_Model->getDatosPersonalesHistoricoByCIF($cif);
            if (count($datos_personales) > 0)
            {
                return TRUE;
            }
            else
            {
                $this->error_array[] = 'No ha sido posible realizar la fusión ya que el NIF/CIF/NIE introducido no existe en el histórico';
                return FALSE;
            }
        }
        else
        {
            $this->error_array[] = 'No ha sido posible realizar la fusión ya que el NIF/CIF/NIE no ha sido introducido';
            return FALSE;
        }
    }

    /**
     * validaOpcionesFusion
     *
     * Valida que un NIF de un usuario introducido existe en el histórico
     *
     * @access	public
     * @param	string
     * @return	boolean
     */
    function validaOpcionesFusion($opciones_fusion, $cif)
    {
        if ($cif != "" && $opciones_fusion != "")
        {
            // Para clubes debe introducirse un CIF
            if ($this->CI->utilities->valida_nif($cif) == 2)
            {
                if ($opciones_fusion == 2)
                {
                    $this->error_array[] = 'El modo de fusión Corredores, Técnicos o Árbitros sólo admite NIF/NIEs válidos';
                    return FALSE;
                }
                else
                {
                    return TRUE;
                }
            }
            else
            {
                if ($opciones_fusion == 1)
                {
                    $this->error_array[] = 'El modo de fusión Clubes y Organizadores sólo admite CIFs válidos';
                    return FALSE;
                }
                else
                {
                    return TRUE;
                }
            }
        }
        else
        {
            return FALSE;
        }
    }

    /**
     * validaCIFUusarioOtraComunidad
     *
     * Valida que el CIF de un usuario no existe en otra comunidad como club
     *
     * @access	public
     * @param	string
     * @return	boolean
     */
    function validaCIFClubOtraComunidad($cif, $idcomunidaddp, $esclub, $esorganizador)
    {
        if ($esclub == 1 || $esorganizador == 1)
        {
            return $this->validaCIFOtraComunidad($cif, $idcomunidaddp);
        }
        else
        {
            return TRUE;
        }
    }

    /**
     * validaFusionUsuario
     *
     * Valida que la fusión se puede realizar correctamente
     *
     * @access	public
     * @param	string
     * @return	boolean
     */
    function validaFusionUsuario($fusionar, $idusuario, $cif, $idcomunidaddp, $esclub, $esorganizador)
    {
        if ($fusionar == 1)
        {
            // Se calcula la opción de fusión
            $opcion_fusion = $this->CI->utilities->obtenerOpcionFusion($esclub, $esorganizador);
            // Resto de comprobaciones
            $validation_nif = $this->validaNIFFusion($cif);
            $validation_opciones = $this->validaOpcionesFusion($opcion_fusion, $cif);
            // Sólo para clubes
            if ($opcion_fusion == 1 && $validation_nif)
            {
                $validation_autorizados_clubes = $this->validaAutorizadosClubesFusion($idusuario, $cif);
            }
            else
            {
                $validation_autorizados_clubes = TRUE;
            }
            // Check
            if ($validation_nif && $validation_opciones && $validation_autorizados_clubes)
            {
                return TRUE;
            }
            else
            {
                return FALSE;
            }
        }
        else
        {
            return TRUE;
        }
    }

    /**
     * validaAutorizadosClubesFusion
     *
     * Valida que el club sobre el que va a fusionar y él mismo no tenga autorizados
     *
     * @access	public
     * @return	boolean
     */
    function validaAutorizadosClubesFusion($idclub_actual, $cif)
    {
        if ($cif != "")
        {
            // Obtenemos datos clubes
            $club_antiguo = $this->CI->Datos_Personales_Model->getDatosClubHistorico($cif);
            $federados_actual = $this->CI->Federados_Model->getFederadosClub($idclub_actual);
            $federados_antiguo = $this->CI->Federados_Model->getFederadosClub($club_antiguo->id);
            // Comparamos
            if (count($federados_actual) == 0 || count($federados_antiguo) == 0)
            {
                return TRUE;
            }
            else
            {
                $this->error_array[] = 'No ha sido posible realizar la fusión ya que el club actual y el encontrado en el histórico poseen autorizados';
                return FALSE;
            }
        }
        else
        {
            return FALSE;
        }
    }

    function validaAutorizadosClubes($idclub_actual, $cif)
    {
        if ($cif != "")
        {
            // Obtenemos datos clubes
            $club_antiguo = $this->CI->Datos_Personales_Model->getDatosClubHistorico($cif);
            if ($club_antiguo)
            {
                $federados_actual = $this->CI->Federados_Model->getFederadosClub($idclub_actual);
                $federados_antiguo = $this->CI->Federados_Model->getFederadosClub($club_antiguo->id);
                /*
                  echo $idclub_actual."---".$club_antiguo->id;
                  echo "-----<br><br>";
                  echo count($federados_actual);
                  echo "-----<br><br>";
                  echo count($federados_antiguo); die();
                 * 
                 */
                // Comparamos
                if ($federados_actual && $federados_antiguo)
                {
                    return FALSE;
                }
            }
        }

        return TRUE;
    }

    function validaCIF($idusuario = NULL, $cif)
    {
        if ($cif != "")
        {
            if ($this->CI->utilities->valida_nif($cif) == 2)
            {
//                // Buscamos si el usuario especificado tiene ese NIF y está en uso
//                if($this->CI->Usuarios_Model->nifUsuarioDisponible($cif, $idusuario))
//                {
                return TRUE;
//                }
//                else
//                {
//                    $this->error_array[]='El campo CIF está en uso';
//                    return FALSE;
//                }          
            }
            else
            {
                $this->error_array[] = 'El campo CIF es incorrecto';
                return FALSE;
            }
        }
        else
        {
            return TRUE;
        }
    }

    /**
     * validaRAEDUsuario
     *
     * Valida que un RAED de un usuario introducido es correcto
     *
     * @access	public
     * @param	integer
     * @param	string
     * @param	string
     * @param	integer
     * @return	boolean
     */
    function validaRAEDUsuario($idusuario = NULL, $cif, $raed, $idcomunidaddp = NULL)
    {
        // Se determina la comunidad sobre la que se debe validar
        if (!is_null($idusuario))
        {
            $datos_personales = $this->CI->Datos_Personales_Model->getDatosPersonales($idusuario);
            $idcomunidaddp = $datos_personales->idcomunidaddp;
        }
        // Se comprueba que sólo se puede meter si es un CIF
        if ($cif != "")
        {
            if ($this->CI->utilities->valida_nif($cif) == 2)
            {
                if ($raed != "")
                {
                    // Buscamos si el usuario especificado tiene ese raed y está en uso
                    if ($this->CI->Usuarios_Model->raedUsuarioDisponible($raed, $idusuario, $idcomunidaddp))
                    {
                        return TRUE;
                    }
                    else
                    {
                        $this->error_array[] = 'El campo R.A.E.D está en uso';
                        return FALSE;
                    }
                }
                else
                {
                    return TRUE;
                }
            }
            else
            {
                if ($raed != "")
                {
                    $this->error_array[] = 'Sólo puede rellenar el campo R.A.E.D si introduce el CIF correspondiente';
                    return FALSE;
                }
                else
                {
                    return TRUE;
                }
            }
        }
        else
        {
            return TRUE;
        }
    }

    /**
     * validaSexoUsuario
     *
     * Valida que el sexo introducido es correcto
     *
     * @access	public
     * @param	integer
     * @param	string
     * @param	string
     * @return	boolean
     */
    function validaSexoUsuario($cif, $sexo)
    {
        // Se comprueba que sólo se puede meter si no es un CIF
        if ($cif != "")
        {
            if ($this->CI->utilities->valida_nif($cif) == 1 || $this->CI->utilities->valida_nif($cif) == 3)
            {
                if ($sexo != "")
                {
                    return TRUE;
                }
                else
                {
                    $this->error_array[] = 'Debe especificar el sexo del usuario';
                    return FALSE;
                }
            }
            else if ($this->CI->utilities->valida_nif($cif) == 2)
            {
                if ($sexo == "")
                {
                    return TRUE;
                }
                else
                {
                    $this->error_array[] = 'No puede especificar el sexo del usuario cuando es una persona jurídica';
                    return FALSE;
                }
            }
            // Número de identificación de menores
            else
            {
                if ($this->CI->utilities->num_ident_menores_valido($cif))
                {
                    if ($sexo != "")
                    {
                        return TRUE;
                    }
                    else
                    {
                        $this->error_array[] = 'Si está introduciendo un número de identificación de menores debe especificar el sexo';
                        return FALSE;
                    }
                }
                else
                {
                    return TRUE;
                }
            }
        }
        else
        {
            return TRUE;
        }
    }

    /**
     * validaEmailUsuario
     *
     * Valida que un email de un usuario introducido es correcto
     *
     * @access	public
     * @param	integer
     * @param	string
     * @return	boolean
     */
    function validaEmailUsuario($idusuario = NULL, $email)
    {
        if ($email != "")
        {
            // Buscamos si el usuario especificado tiene ese email y está en uso
            if ($this->CI->Usuarios_Model->emailUsuarioDisponible($email, $idusuario))
            {
                return TRUE;
            }
            else
            {
                $this->error_array[] = 'El e-mail está en uso';
                $this->CI->session->set_flashdata('mensaje', 'El e-mail está en uso');
                return FALSE;
            }
        }
    }

    /**
     * validaUsernameUsuario
     *
     * Valida que un username de un usuario introducido es correcto
     *
     * @access	public
     * @param	integer
     * @param	string
     * @return	boolean
     */
    function validaUsernameUsuario($idusuario = NULL, $username)
    {
        if ($username != "")
        {
            // Buscamos si el usuario especificado tiene ese username y está en uso
            if ($this->CI->Usuarios_Model->usernameUsuarioDisponible($username, $idusuario))
            {
                return TRUE;
            }
            else
            {
                $this->error_array[] = 'El nick está en uso';
                $this->CI->session->set_flashdata('mensaje', 'El nick está en uso');
                return FALSE;
            }
        }
        else
        {
            return TRUE;
        }
    }

    /*     * ************************* VALIDACIONES CURSOS ************************ */

    /**
     * validaFechasDistintasCursos
     *
     * Valida que la fecha elegida no sea inferior a todas las anteriores
     *
     * @access	public
     * @param	date
     * @param	date
     * @param	date
     * @return	boolean
     */
    function validaFechasDistintasCursos($fecha1, $fecha2, $fecha3)
    {
        if ($fecha1 != "" && $fecha2 != "" && $fecha3 != "")
        {
            if ($fecha1 == $fecha2 || $fecha1 == $fecha3 || $fecha2 == $fecha3)
            {
                $this->error_array[] = 'Alguna de las fechas introducidas está repetida';
                return FALSE;
            }
            else
            {
                return TRUE;
            }
        }
        else
        {
            return TRUE;
        }
    }

    /**
     * validaFechasSolicitadasCurso
     *
     * Valida que la fecha elegida no sea inferior a todas las anteriores
     *
     * @access	public
     * @param	date
     * @param	date
     * @param	date
     * @return	boolean
     */
    function validaFechasSolicitadasCurso($fecha1, $fecha2, $fecha3, $temporada_prueba)
    {
        $fechas_validas = TRUE;
        $fecha_actual = date("d/m/Y");
        // Detalles fecha 1
        $detailsFieldDate1['description'] = "Fecha posible de celebración [1]";
        // Detalles fecha 2
        $detailsFieldDate2['description'] = "Fecha posible de celebración [2]";
        // Detalles fecha 3
        $detailsFieldDate3['description'] = "Fecha posible de celebración [3]";
        // Comprobación 1
        if ($this->checkDateFormat($fecha_actual) && $this->checkDateFormat($fecha1) && $this->CI->utilities->compararFechas($fecha1, $fecha_actual) < 0)
        {
            $this->error_array[] = 'El campo ' . $detailsFieldDate1['description'] . ' tiene una fecha inferior a la fecha actual';
            $fechas_validas = FALSE;
        }
        // Comprobación temporada 1
        $anio_fecha1 = substr($fecha1, 6, 4);
        if ($anio_fecha1 != $temporada_prueba)
        {
            $this->error_array[] = 'El campo ' . $detailsFieldDate1['description'] . ' tiene una fecha que no corresponde con la temporada del evento';
            $fechas_validas = FALSE;
        }
        // Comprobación 2
        if ($this->checkDateFormat($fecha_actual) && $this->checkDateFormat($fecha2) && $this->CI->utilities->compararFechas($fecha2, $fecha_actual) < 0)
        {
            $this->error_array[] = 'El campo ' . $detailsFieldDate2['description'] . ' tiene una fecha inferior a la fecha actual';
            $fechas_validas = FALSE;
        }
        // Comprobación temporada 2
        $anio_fecha2 = substr($fecha2, 6, 4);
        if ($anio_fecha2 != $temporada_prueba)
        {
            $this->error_array[] = 'El campo ' . $detailsFieldDate2['description'] . ' tiene una fecha que no corresponde con la temporada del evento';
            $fechas_validas = FALSE;
        }
        // Comprobación 3
        if ($this->checkDateFormat($fecha_actual) && $this->checkDateFormat($fecha3) && $this->CI->utilities->compararFechas($fecha3, $fecha_actual) < 0)
        {
            $this->error_array[] = 'El campo ' . $detailsFieldDate3['description'] . ' tiene una fecha inferior a la fecha actual';
            $fechas_validas = FALSE;
        }
        // Comprobación temporada 3
        $anio_fecha3 = substr($fecha3, 6, 4);
        if ($anio_fecha3 != $temporada_prueba)
        {
            $this->error_array[] = 'El campo ' . $detailsFieldDate3['description'] . ' tiene una fecha que no corresponde con la temporada del evento';
            $fechas_validas = FALSE;
        }
        // Comprobación final
        return $fechas_validas;
    }

    /**
     * validaFechaFinCurso
     *
     * Valida que la fecha de finalización no sea inferior a la fecha elegida
     *
     * @access	public
     * @param	date
     * @param	date
     * @return	boolean
     */
    function validaFechaFinCurso($fecha_elegida, $fecha_fin)
    {
        if ($fecha_elegida != "")
        {
            if ($fecha_fin != "")
            {
                // Datos de validación fechas
                $detailsFechaElegida['name'] = 'fecha_elegida';
                $detailsFechaElegida['description'] = 'Fecha elegida';
                $detailsFechaFin['name'] = 'fecha_fin';
                $detailsFechaFin['description'] = 'Fecha de finalización';
                return $this->dateLessEqualThan($detailsFechaElegida, $detailsFechaFin);
            }
            else
            {
                return TRUE;
            }
        }
        else
        {
            $this->error_array[] = 'No puede introducirse la fecha de finalización hasta que no esté establecida la fecha elegida';
            return FALSE;
        }
    }

    /**
     * validaFechaElegidaClubCurso
     *
     * Valida que la fecha elegida esté en el rango de la temporada de la prueba y además que el club tenga licencia en ese año
     *
     * @access	public
     * @return	boolean
     */
    function validaFechaElegidaClubCurso($fecha_elegida, $idclub, $tempactual)
    {
        if ($fecha_elegida != "")
        {
            // Buscamos licencia para el club
            $temporada_fecha_elegida = substr($fecha_elegida, 6, 4);
            $esclub_fecha_elegida = $this->CI->Usuarios_Model->getEsClub($idclub, $temporada_fecha_elegida);
            $esorganizador_fecha_elegida = $this->CI->Usuarios_Model->getEsOrganizador($idclub, $temporada_fecha_elegida);
            if (!$esclub_fecha_elegida && !$esorganizador_fecha_elegida)
            {
                $this->error_array[] = 'El club/organizador no está federado para el año de la fecha elegida';
                return FALSE;
            }
            else
            {
                return TRUE;
            }
        }
        else
        {
            return TRUE;
        }
    }

    /**
     * validaFechaElegidaTemporadaCurso
     *
     * Valida que la fecha elegida esté dentro de la temporada del evento
     *
     */
    function validaFechaElegidaTemporadaCurso($fecha_elegida, $tempactual)
    {
        if ($fecha_elegida != "")
        {
            // Buscamos licencia para el club
            $temporada_fecha_elegida = substr($fecha_elegida, 6, 4);
            if ($temporada_fecha_elegida != $tempactual)
            {
                $this->error_array[] = 'La fecha elegida no pertenece a la temporada del evento';
                return FALSE;
            }
            else
            {
                return TRUE;
            }
        }
        else
        {
            return TRUE;
        }
    }

    /*     * ************************* VALIDACIONES CARRERAS ************************ */

    /**
     * validaFechasDistintasCarreras
     *
     * Valida que la fecha elegida no sea inferior a todas las anteriores
     *
     * @access	public
     * @param	date
     * @param	date
     * @param	date
     * @return	boolean
     */
    function validaFechasDistintasCarreras($fecha1, $fecha2, $fecha3)
    {
        if ($fecha1 != "" && $fecha2 != "" && $fecha3 != "")
        {
            if ($fecha1 == $fecha2 || $fecha1 == $fecha3 || $fecha2 == $fecha3)
            {
                $this->error_array[] = 'Alguna de las fechas introducidas está repetida';
                return FALSE;
            }
            else
            {
                return TRUE;
            }
        }
        else
        {
            return TRUE;
        }
    }

    /**
     * validaFechasSolicitadasPrueba
     *
     * Valida que la fecha elegida no sea inferior a todas las anteriores
     *
     * @access	public
     * @param	date
     * @param	date
     * @param	date
     * @return	boolean
     */
    function validaFechasSolicitadasPrueba($fecha1, $fecha2, $fecha3, $temporada_prueba)
    {
        $fechas_validas = TRUE;
        $fecha_actual = date("d/m/Y");
        // Detalles fecha 1
        $detailsFieldDate1['description'] = "Fecha posible de celebración [1]";
        // Detalles fecha 2
        $detailsFieldDate2['description'] = "Fecha posible de celebración [2]";
        // Detalles fecha 3
        $detailsFieldDate3['description'] = "Fecha posible de celebración [3]";
        // Comprobación 1
        if ($this->checkDateFormat($fecha_actual) && $this->checkDateFormat($fecha1) && $this->CI->utilities->compararFechas($fecha1, $fecha_actual) < 0)
        {
            $this->error_array[] = 'El campo ' . $detailsFieldDate1['description'] . ' tiene una fecha inferior a la fecha actual';
            $fechas_validas = FALSE;
        }
        // Comprobación temporada 1
        $anio_fecha1 = substr($fecha1, 6, 4);
        if ($anio_fecha1 != $temporada_prueba)
        {
            $this->error_array[] = 'El campo ' . $detailsFieldDate1['description'] . ' tiene una fecha que no corresponde con la temporada de la prueba';
            $fechas_validas = FALSE;
        }
        // Comprobación 2
        if ($this->checkDateFormat($fecha_actual) && $this->checkDateFormat($fecha2) && $this->CI->utilities->compararFechas($fecha2, $fecha_actual) < 0)
        {
            $this->error_array[] = 'El campo ' . $detailsFieldDate2['description'] . ' tiene una fecha inferior a la fecha actual';
            $fechas_validas = FALSE;
        }
        // Comprobación temporada 2
        $anio_fecha2 = substr($fecha2, 6, 4);
        if ($anio_fecha2 != $temporada_prueba)
        {
            $this->error_array[] = 'El campo ' . $detailsFieldDate2['description'] . ' tiene una fecha que no corresponde con la temporada de la prueba';
            $fechas_validas = FALSE;
        }
        // Comprobación 3
        if ($this->checkDateFormat($fecha_actual) && $this->checkDateFormat($fecha3) && $this->CI->utilities->compararFechas($fecha3, $fecha_actual) < 0)
        {
            $this->error_array[] = 'El campo ' . $detailsFieldDate3['description'] . ' tiene una fecha inferior a la fecha actual';
            $fechas_validas = FALSE;
        }
        // Comprobación temporada 3
        $anio_fecha3 = substr($fecha3, 6, 4);
        if ($anio_fecha3 != $temporada_prueba)
        {
            $this->error_array[] = 'El campo ' . $detailsFieldDate3['description'] . ' tiene una fecha que no corresponde con la temporada de la prueba';
            $fechas_validas = FALSE;
        }
        // Comprobación final
        return $fechas_validas;
    }

    /**
     * validaFechaFinCarrera
     *
     * Valida que la fecha de finalización no sea inferior a la fecha elegida
     *
     * @access	public
     * @param	date
     * @param	date
     * @return	boolean
     */
    function validaFechaFinCarrera($fecha_elegida, $fecha_fin)
    {
        if ($fecha_elegida != "")
        {
            if ($fecha_fin != "")
            {
                // Datos de validación fechas
                $detailsFechaElegida['name'] = 'fecha_elegida';
                $detailsFechaElegida['description'] = 'Fecha elegida';
                $detailsFechaFin['name'] = 'fecha_fin';
                $detailsFechaFin['description'] = 'Fecha de finalización';
                return $this->dateLessEqualThan($detailsFechaElegida, $detailsFechaFin);
            }
            else
            {
                return TRUE;
            }
        }
        else
        {
            $this->error_array[] = 'No puede introducirse la fecha de finalización hasta que no esté establecida la fecha elegida';
            return FALSE;
        }
    }

    /**
     * validaFechaElegidaCompletaPrueba
     *
     * Valida que la fecha elegida esté en el rango de la temporada de la prueba y además que el club tenga licencia en ese año
     *
     * @access	public
     * @return	boolean
     */
    function validaFechaElegidaClubPrueba($fecha_elegida, $idclub, $tempactual)
    {
        if ($fecha_elegida != "")
        {
            // Buscamos licencia para el club
            $temporada_fecha_elegida = substr($fecha_elegida, 6, 4);
            $esclub_fecha_elegida = $this->CI->Usuarios_Model->getEsClub($idclub, $temporada_fecha_elegida);
            $esorganizador_fecha_elegida = $this->CI->Usuarios_Model->getEsOrganizador($idclub, $temporada_fecha_elegida);
            if (!$esclub_fecha_elegida && !$esorganizador_fecha_elegida)
            {
                $this->error_array[] = 'El club/organizador no está federado para el año de la fecha elegida';
                return FALSE;
            }
            else
            {
                return TRUE;
            }
        }
        else
        {
            return TRUE;
        }
    }

    /**
     * validaFechaElegidaTemporadaPrueba
     *
     * Valida que la fecha elegida esté dentro de la temporada de la prueba
     *
     */
    function validaFechaElegidaTemporadaPrueba($fecha_elegida, $tempactual)
    {
        if ($fecha_elegida != "")
        {
            // Buscamos licencia para el club
            $temporada_fecha_elegida = substr($fecha_elegida, 6, 4);
            if ($temporada_fecha_elegida != $tempactual)
            {
                $this->error_array[] = 'La fecha elegida no pertenece a la temporada de la prueba';
                return FALSE;
            }
            else
            {
                return TRUE;
            }
        }
        else
        {
            return TRUE;
        }
    }

    /**     * ************************ VALIDACIONES REGLAMENTO ************************ */

    /**
     * validaCategoriaSeleccionadaReglamentoObligatoria
     *
     * Valida que se ha seleccionado alguna categoría para el reglamento
     *
     * @access	public
     * @param	integer
     * @return	boolean
     */
    function validaCategoriaSeleccionadaReglamentoObligatoria($num_categorias)
    {
        for ($cont = 1; $cont <= $num_categorias; $cont++)
        {
            $nombre_check = "categoria" . $cont;
            if ($this->CI->input->post($nombre_check) == 1)
            {
                return TRUE;
            }
        }
        // Si no hay ningúna seleccionada
        $this->error_array[] = 'Debes seleccionar al menos una categoría del reglamento';
        return FALSE;
    }

    /*     * ************************* FORMULARIOS ********************************* */

    /**
     * validaAsignarPlantillasFormulariosMultiple
     *
     * Valida que se pueden asignar una plantilla de formularios a diferentes pruebas
     *
     * @access	public
     * @param	array
     * @return	boolean
     */
    function validaAsignarPlantillasFormulariosMultiple($pruebas)
    {
        $comprobacion = TRUE;
        foreach ($pruebas as $idprueba)
        {
            if (!$this->CI->Carreras_Model->getEsFormularioEditable($idprueba))
            {
                $carrera = $this->CI->Carreras_Model->getCarrera($idprueba);
                $comprobacion = FALSE;
                $this->error_array[] = 'La plantilla del formulario de la prueba ' . $carrera->nombreprueba . ' no puede ser cambiada al haber datos introducidos';
            }
        }
        return $comprobacion;
    }

    /**
     * validaAsignarPlantillasFormularios
     *
     * Valida que se pueden asignar una plantilla al formulario personalizable
     *
     * @access	public
     * @param	integer
     * @return	boolean
     */
    function validaAsignarPlantillasFormularios($idprueba)
    {
        if (!$this->CI->Carreras_Model->getEsFormularioEditable($idprueba))
        {
            $this->error_array[] = 'La plantilla del formulario no puede ser cambiada al haber datos introducidos';
            return FALSE;
        }
        else
        {
            return TRUE;
        }
    }

    /*     * ************************* ENCUESTAS *********************************** */

    /**
     * validaAsignarPlantillasEncuestasMultiple
     *
     * Valida que se pueden asignar una plantilla de encuestas a diferentes pruebas
     *
     * @access	public
     * @param	array
     * @return	boolean
     */
    function validaAsignarPlantillasEncuestasMultiple($pruebas)
    {
        $comprobacion = TRUE;
        foreach ($pruebas as $idprueba)
        {
            if (!$this->CI->Carreras_Model->getEsEncuestaEditable($idprueba))
            {
                $carrera = $this->CI->Carreras_Model->getCarrera($idprueba);
                $comprobacion = FALSE;
                $this->error_array[] = 'Las plantillas de encuestas de la prueba ' . $carrera->nombreprueba . ' no pueden ser cambiadas';
            }
        }
        return $comprobacion;
    }

    /**
     * validaAsignarPlantillasEncuestas
     *
     * Valida que se pueden asignar plantillas a las encuestas
     *
     * @access	public
     * @param	integer
     * @return	boolean
     */
    function validaAsignarPlantillasEncuestas($idprueba)
    {
        if (!$this->CI->Carreras_Model->getEsEncuestaEditable($idprueba))
        {
            $this->error_array[] = 'La encuesta no es editable en estos momentos';
            return FALSE;
        }
        else
        {
            return TRUE;
        }
    }

    /**
     * validaEnlacePublicadoEncuestas
     *
     * Valida que está publicado el enlace público de la prueba
     *
     * @access	public
     * @param	integer
     * @return	boolean
     */
    function validaEnlacePublicadoEncuestas($idprueba)
    {
        $inscripcion = $this->CI->Carreras_Model->getInscripcion($idprueba);
        if ($inscripcion && $inscripcion->publicado)
        {
            return TRUE;
        }
        else
        {
            $this->error_array[] = 'Aún no ha sido publicado el enlace de inscripción de la prueba';
            return FALSE;
        }
    }

    /**
     * validaPlantillasAsignadasEncuestas
     *
     * Valida que las plantillas están asignadas antes de abrir la encuesta
     *
     * @access	public
     * @param	integer
     * @return	boolean
     */
    function validaPlantillasAsignadasEncuestas($idprueba)
    {
        if ($this->CI->Carreras_Model->getEncuestasEstadoProceso($idprueba, 0) == 2)
        {
            return TRUE;
        }
        else
        {
            $this->error_array[] = 'Las plantillas aún no han sido asignadas a la encuesta';
            return FALSE;
        }
    }

    /**     * ************************ VALIDACIONES ASOCIADOS ************************ */

    /**
     * validaNIFAsociado
     *
     * Valida que un NIF de un asociado introducido es correcto
     *
     * @access	public
     * @param	integer
     * @param	string
     * @param	date
     * @return	boolean
     */
    function validaNIFAsociado($idclub, $cif, $modoIDmenor, $modoIDextranjero, $idasociado = NULL)
    {
        if ($cif != "")
        {
            if ($modoIDmenor == "generar")
            {
                $this->error_array[] = 'El menor de edad no puede tener DNI';
                return FALSE;
            } if ($modoIDextranjero == "generar")
            {
                $this->error_array[] = 'El extranjero no puede tener DNI';
                return FALSE;
            }
            else
            {
                if ($this->CI->utilities->valida_nif($cif) == 1 || $this->CI->utilities->valida_nif($cif) == 3 || $this->CI->utilities->num_ident_menores_valido($cif))
                {
                    // Buscamos si el usuario especificado tiene ese NIF y está en uso
                    if ($this->CI->Clubes_Model->nifDisponible($idclub, $cif, $idasociado))
                    {
                        return TRUE;
                    }
                    else
                    {
                        $this->error_array[] = 'El campo DNI lo tiene asignado otro asociado';
                        return FALSE;
                    }
                }
                else
                {
                    $this->error_array[] = 'El campo DNI es incorrecto';
                    return FALSE;
                }
            }
        }
        else
        {
            if ($modoIDmenor == "generar" || $modoIDextranjero == "generar")
            {
                return TRUE;
            }
            else
            {
                $this->error_array[] = 'El campo <strong>DNI</strong> es obligatorio';
                return FALSE;
            }
        }
    }

    /**
     * validaNIFAsociado
     *
     * Valida que un NIF de un asociado introducido es correcto
     *
     * @access	public
     * @param	string
     * @param	string
     * @return	boolean
     */
    function validaModosIdentificacionAsociado($modoIDmenor, $modoIDextranjero)
    {
        if ($modoIDmenor == "generar" && $modoIDextranjero == "generar")
        {
            $this->error_array[] = 'Sólo puede seleccionar un modo de identificación del autorizado';
            return FALSE;
        }
        else
        {
            return TRUE;
        }
    }

    /**     * ************************ VENTAS DELEGACIONES ************************ */
    function validaNumLicenciasCreditoClub($cif, $temporada)
    {
        if ($cif != "")
        {
            if ($this->CI->utilities->valida_nif($cif) == 2)
            {
                if ($this->CI->Credito_Model->getNumLicenciasCreditoClub($cif, $temporada) >= 30)
                {
                    return TRUE;
                }
                else
                {
                    $this->error_array[] = 'El club/organizador posee menos de 30 licencias';
                    return FALSE;
                }
            }
            else
            {
                $this->error_array[] = 'El campo CIF es incorrecto';
                return FALSE;
            }
        }
        else
        {
            $this->error_array[] = 'El campo CIF es obligatorio';
            return FALSE;
        }
    }

    /**     * ************************ VALIDACIONES EQUIPOS ************************ */
    function validaCodigoEquipo($codigo, $temporada, $idequipo = NULL)
    {
        if (!empty($codigo) && !empty($temporada) && strlen($codigo) == 4)
        {
            $existe = $this->CI->Clubes_Model->getEquipoByCodigoTemporada($codigo, $temporada);
            if ($existe && $existe !== $idequipo)
            {
                $this->error_array[] = 'El código introducido ya existe';
                return false;
            }
            else
            {
                return true;
            }
        }
        else
        {
            $this->error_array[] = 'El código introducido es incorrecto';
            return false;
        }
    }

    function validaAgrupamientoEquipo($idagrupamiento, $temporada, $idclub, $idequipo = NULL)
    {
        if (!empty($idclub) && !empty($temporada))
        {
            $existe = $this->CI->Clubes_Model->getEquipoComprobacionAgrupamiento($idagrupamiento, $temporada, $idclub, $idequipo);
            if ($existe)
            {
                $this->error_array[] = 'El agrupamiento ya está asociado a otro equipo del mismo club';
                return false;
            }
            else
            {
                return true;
            }
        }
        else
        {
            $this->error_array[] = 'El equipo debe estar vinculado a un club';
            return false;
        }
    }

    /**     * ************************ VALIDACIONES GENERALES ************************ */

    /**
     * validaNumLicencia
     *
     * Valida que un número de licencia (ya sea para árbitros, entrenadores o licencias) es correcto
     *
     * @access	public
     * @param	string
     * @return	boolean
     */
    function validaNumLicencia($cif)
    {
        if ($cif != "")
        {
            if ($this->CI->utilities->num_ident_menores_valido($cif) || $this->CI->utilities->valida_nif($cif) == 2 || $this->CI->utilities->valida_nif($cif) == 3)
            {
                return TRUE;
            }
            else if (!is_numeric($cif) || $cif > 99999999)
            {
                $this->error_array[] = 'El formato del número de licencia es incorrecto';
                return FALSE;
            }
            else
            {
                return TRUE;
            }
        }
        else
        {
            return TRUE;
        }
    }

    /**
     * checkDateActual
     *
     * Valida que la fecha no sea inferior a la actual
     *
     * @access	public
     * @param	date
     * @return	boolean
     */
    function checkDateActual($fecha)
    {
        // Fecha actual
        $fecha_actual = date("d/m/Y");
        // Comprobación
        if ($fecha != "" && $this->checkDateFormat($fecha) && $this->CI->utilities->compararFechas($fecha_actual, $fecha) > 0)
        {
            $this->set_message('checkDateActual', 'El campo %s es inferior a la fecha actual');
            return FALSE;
        }
        else
        {
            return TRUE;
        }
    }

    /**
     * checkDatePosterior
     *
     * Valida que la fecha no sea superior a la actual
     *
     * @access	public
     * @param	date
     * @return	boolean
     */
    function checkDatePosterior($fecha)
    {
        // Fecha actual
        $fecha_actual = date("d/m/Y");
        // Comprobación
        if ($fecha != "" && $this->checkDateFormat($fecha) && $this->CI->utilities->compararFechas($fecha, $fecha_actual) > 0)
        {
            $this->set_message('checkDatePosterior', 'El campo %s es posterior a la fecha actual');
            return FALSE;
        }
        else
        {
            return TRUE;
        }
    }

    /**
     * checkAnioActual
     *
     * Valida que la fecha debe ser inferior al año actual
     *
     * @access	public
     * @param	date
     * @return	boolean
     */
    function checkAnioActual($fecha)
    {
        // Fecha actual
        $fecha_anio_actual = "01/01/" . date("Y");
        // Comprobación
        if ($fecha != "" && $this->checkDateFormat($fecha) && $this->CI->utilities->compararFechas($fecha, $fecha_anio_actual) > 0)
        {
            $this->set_message('checkAnioActual', 'El campo %s no puede pertenecer al año actual');
            return FALSE;
        }
        else
        {
            return TRUE;
        }
    }

    /**
     * Determina si es único un valor en una determinada tabla
     *
     * @access	public
     * @param	string
     * @param	field
     * @return	bool
     */
    public function is_unique_global($str, $string)
    {
        $explode=explode(',', $string);
        list($table, $field) = explode('.', $explode[0]);
        $id = $explode[1];
        
        $this->CI->db->select();
        $this->CI->db->from($table);  
        $this->CI->db->where($field,$str);
        if($id!=0)
        {
            $this->CI->db->where($field." <> ".$id);
        }
        $query = $this->CI->db->get();
        
        // Comprobación
        if ($query->num_rows() === 0)
        {
            return TRUE;
        }
        else
        {
            $this->set_message('is_unique_global', 'Ya existe otro registro con el mismo valor para el campo %s');
            return FALSE;
        }
        return;
    }
    
    /**
     * Determina si es único un valor en una determinada tabla
     *
     * @access	public
     * @param	string
     * @param	field
     * @return	bool
     */
    public function is_unique_global_foreign_key($str, $string)
    {
        $explode=explode(';', $string);
        $table = $explode[0];
        $id = $explode[1];
        $field = $explode[2];
        $primary_key = $explode[3];
        $foreign_key_field = $explode[4];
        $foreign_key_value = $explode[5];
        
        $this->CI->db->select();
        $this->CI->db->from($table);  
        $this->CI->db->where($field,$str);
        $this->CI->db->where($foreign_key_field,$foreign_key_value);
        if($id!=0)
        {
            $this->CI->db->where($primary_key." <> ".$id);
        }
        $query = $this->CI->db->get();
        
        // Comprobación
        if ($query->num_rows() === 0)
        {
            return TRUE;
        }
        else
        {
            $this->set_message('is_unique_global_foreign_key', 'Ya existe otro registro con el mismo valor para el campo %s');
            return FALSE;
        }
        return;
    }

    /**
     * checkInputKey
     *
     * Valida que la cadena indicada tenga un formato válido para ser clave en POST, GET, etc.
     *
     * @access	public
     * @param	string
     * @return	boolean
     */
    function checkInputKey($str)
    {
        // Fecha actual
        $nombreCampo = $this->CI->utilities->procesarNombreCampo($str);
        // Comprobación
        if (!preg_match("/^[a-z0-9:_\/\.\[\]-]+$/i", $nombreCampo))
        {
            $this->set_message('checkInputKey', 'El campo %s tiene caracteres no permitidos');
            return FALSE;
        }
        else
        {
            return TRUE;
        }
    }

    /**
     * checkDateFormat
     *
     * Valida que se el texto introducido es una fecha en formato dd/mm/aaaa
     *
     * @access	public
     * @param	string
     * @return	boolean
     */
    function checkDateFormat($date)
    {
        if (preg_match('/^\d{2}\/\d{2}\/\d{4}$/', $date))
        {
            if (checkdate(substr($date, 3, 2), substr($date, 0, 2), substr($date, 6, 4)))
                return TRUE;
            else
            {
                $this->set_message('checkDateFormat', 'El campo %s tiene un formato de fecha incorrecto');
                return FALSE;
            }
        }
        else
        {
            $this->set_message('checkDateFormat', 'El campo %s tiene un formato de fecha incorrecto');
            return FALSE;
        }
    }

    /**
     * checkHourFormat
     *
     * Valida que se el texto introducido es una hora en formato hh:mm
     *
     * @access	public
     * @param	string
     * @return	boolean
     */
    function checkHourFormat($hour, $patternType = "minutes")
    {
        if ($patternType == "minutes")
            $pattern = "/^([0-1][0-9]|[2][0-3])[\:]([0-5][0-9])$/";
        if ($patternType == "seconds")
            $pattern = "/^([0-1][0-9]|[2][0-3])[\:]([0-5][0-9])[\:]([0-5][0-9])$/";

        if (preg_match($pattern, $hour))
        {
            return TRUE;
        }
        else
        {
            $this->set_message('checkHourFormat', 'El campo %s tiene un formato de hora incorrecto');
            return FALSE;
        }
    }

    /**
     * Porcentaje
     *
     * Valida que se el texto introducido es un número en formato eee.eee,dd y entre valores [0,100]
     *
     * @access	public
     * @param	string
     * @return	boolean
     */
    function Porcentaje($number)
    {
        $numero_formateado = $this->CI->utilities->formatear_numero($number);
        if ($this->numericLatin($number) && $numero_formateado >= 0 && $numero_formateado <= 100)
        {
            return TRUE;
        }
        else
        {
            $this->set_message('Porcentaje', 'El campo %s no está entre los valores [0,100]');
            return FALSE;
        }
    }

    /**
     * numericLatin
     *
     * Valida que se el texto introducido es un número en formato eeeee,dd
     *
     * @access	public
     * @param	string
     * @return	boolean
     */
    function numericLatin($number)
    {
        if (!preg_match('/^[0-9]+(,[0-9]{2})?$/', $number))
        {
            $this->set_message('numericLatin', 'El campo %s no es un número en formato eeeee,dd');
            return FALSE;
        }
        else
            return TRUE;
    }

    /**
     * Valida si un numero de cuenta bancaria es correcto
     *
     * @access	public
     * @param	string
     * @return	boolean
     */
    function validaCCC($ccc)
    {
        // Separamos los componentes
        $ccc_separado = explode(" ", $ccc);

        if (count($ccc_separado) == 5)
        {
            //echo count($ccc_separado);die();
            $iban = $ccc_separado[0];
            $banco = $ccc_separado[1];
            $sucursal = $ccc_separado[2];
            $dc = $ccc_separado[3];
            $cuenta = $ccc_separado[4];
            // Se valida con los elementos divididos
            if ($this->CI->utilities->valida_ccc($banco, $sucursal, $dc, $cuenta) == (int) -1)
            {
                $this->set_message('validaCCC', 'El campo %s posee un formato incorrecto');
                return FALSE;
            }
            else
                return TRUE;
        }
        else
        {
            $this->set_message('validaCCC', 'El campo %s posee un formato incorrecto');
            return FALSE;
        }
    }

    /**
     *  Determina si un NIF/NIE/CIF es válido
     *
     * @access	public
     * @param	string
     * @return	boolean
     */
    function validaNIF($cif)
    {
        if ($this->CI->utilities->valida_nif($cif) <= 0)
        {
            $this->set_message('validaNIF', 'El campo %s es un NIF/CIF/NIE incorrecto');
            return FALSE;
        }
        else
            return TRUE;
    }

    /**
     * validaTelefonosObligatorios
     *
     * Valida que uno de los dos telefonos introducidos no sea nulo
     *
     * @access	public
     * @param	integer
     * @param	integer
     * @return	boolean
     */
    function validaTelefonosObligatorios($telefono_f, $telefono_m)
    {
        if ($telefono_f == '' && $telefono_m == '')
        {
            $this->error_array[] = 'Debes introducir al menos un número de teléfono (móvil o fijo)';
            return FALSE;
        }
        else
            return TRUE;
    }

    /**
     * validaTelefonosFaxObligatorios
     *
     * Valida que uno de los dos telefonos o el fax introducidos no sean nulos
     *
     * @access	public
     * @param	integer
     * @param	integer
     * @param	integer
     * @return	boolean
     */
    function validaTelefonosFaxObligatorios($telefono_f, $telefono_m, $fax)
    {
        if ($telefono_f == '' && $telefono_m == '' && $fax == '')
        {
            $this->error_array[] = 'Debes introducir al menos un número de teléfono (móvil o fijo) o el fax';
            return FALSE;
        }
        else
            return TRUE;
    }

    /**
     * hourLessEqualThan
     *
     * Valida que se la primera hora es menor que la segunda (formato hh:mm)
     *
     * @access	public
     * @param	array
     * @param	array
     * @return	boolean
     */
    function hourLessEqualThan($detailsFieldHour1, $detailsFieldHour2)
    {
        // Obtenemos los valores de los details
        $nameFieldHour1 = $detailsFieldHour1['name'];
        $descriptionFieldHour1 = $detailsFieldHour1['description'];
        // Obtenemos el valor del campo input de $nameFieldHour1
        $hour1 = $_POST[$nameFieldHour1];
        $nameFieldHour2 = $detailsFieldHour2['name'];
        $descriptionFieldHour2 = $detailsFieldHour2['description'];
        // Obtenemos el valor del campo input de $nameFieldHour2
        $hour2 = $_POST[$nameFieldHour2];
        // Si la primera hora es válida
        if ($this->checkHourFormat($hour1) && $this->checkHourFormat($hour2))
        {
            // Transformamos a numeric $hour1
            $hour1_separada = explode(":", $hour1);
            $hour1_numeric = (int) $hour1_separada[0] . $hour1_separada[1];

            // Transformamos a numeric el campo input de $nameFieldHour2
            $hour2_separada = explode(":", $hour2);
            $hour2_numeric = (int) $hour2_separada[0] . $hour2_separada[1];

            if ($hour1_numeric > $hour2_numeric)
            {
                $this->error_array[] = 'El campo ' . $descriptionFieldHour1 . ' tiene una hora superior al campo ' . $descriptionFieldHour2;
                return FALSE;
            }
            else
                return TRUE;
        }
        else
            return TRUE;
    }

    /**
     * dateLessEqualThan
     *
     * Valida que se la primera fecha es menor que la segunda (formato dd/mm/aaaa)
     *
     * @access	public
     * @param	array
     * @param	array
     * @return	boolean
     */
    function dateLessEqualThan($detailsFieldDate1, $detailsFieldDate2)
    {
        // Obtenemos los valores de los details
        $nameFieldDate1 = $detailsFieldDate1['name'];
        $descriptionFieldDate1 = $detailsFieldDate1['description'];
        // Obtenemos el valor del campo input de $nameFieldDate1
        $date1 = $_POST[$nameFieldDate1];
        $nameFieldDate2 = $detailsFieldDate2['name'];
        $descriptionFieldDate2 = $detailsFieldDate2['description'];
        // Obtenemos el valor del campo input de $nameFieldDate2
        $date2 = $_POST[$nameFieldDate2];
        // Si la primera hora es válida
        if ($this->checkDateFormat($date1) && $this->checkDateFormat($date2))
        {
            if ($this->CI->utilities->compararFechas($date1, $date2) > 0)
            {
                $this->error_array[] = 'El campo ' . $descriptionFieldDate1 . ' tiene una fecha superior al campo ' . $descriptionFieldDate2;
                return FALSE;
            }
            else
                return TRUE;
        }
        else
            return TRUE;
    }

    /**
     * validaFechaHora
     *
     * Valida que una fecha y hora conjunta están en formato correcto
     *
     * @access	public
     * @param	string
     * @return	boolean
     */
    function validaFechaHora($fecha)
    {
        if ($fecha != "")
        {
            // Dividimos la fecha y hora            
            $fecha_hora = explode(" ", $fecha);
            $date = $fecha_hora[0];
            $hour = $fecha_hora[1];
            // Comprobamos formatos
            if ($this->checkDateFormat($date))
            {
                if ($this->checkHourFormat($hour, "seconds"))
                {
                    return TRUE;
                }
                else
                {
                    $this->set_message('validaFechaHora', 'El campo %s tiene un formato de hora incorrecto');
                    return FALSE;
                }
            }
            else
            {
                $this->set_message('validaFechaHora', 'El campo %s tiene un formato de fecha incorrecto');
                return FALSE;
            }
        }
        else
        {
            return TRUE;
        }
    }

    function validaPassAdmin($pass, $tipoacceso)
    {
        $validation_PASS = TRUE;
        if ($tipoacceso != 'admin')
        {
            return $validation_PASS;
        }
        if (!preg_match("#[0-9]+#", $pass))
        {
            $this->error_array[] = "La contraseña debe incluir al menos un número";
            $validation_PASS = FALSE;
        }
        if (!preg_match("#[a-z]+#", $pass))
        {
            $this->error_array[] = "La contraseña debe incluir al menos una letra minúscula";
            $validation_PASS = FALSE;
        }
        if (!preg_match("#[A-Z]+#", $pass))
        {
            $this->error_array[] = "La contraseña debe incluir al menos una letra mayúscula";
            $validation_PASS = FALSE;
        }
        return $validation_PASS;
    }

    /**     * ************************ VALIDACIONES INSCRIPCIONES ************************ */
    function checkResizeLogoPatrocinador($path)
    {
        $config_image['image_library'] = 'gd2';
        $config_image['source_image'] = $path;
        $config_image['maintain_ratio'] = FALSE;
        $config_image['width'] = 350;
        $config_image['height'] = 175;
        $config_image['quality'] = 100;

        $this->CI->load->library('image_lib', $config_image);

        if (!$this->CI->image_lib->resize())
        {
            $this->error_array[] = $this->CI->image_lib->display_errors();
            return FALSE;
        }
        else
        {
            return TRUE;
        }
    }

    /**     * ************************ VALIDACIONES TAREAS DIARIAS ************************ */
    function validaCategoriasSeleccionadas($categorias)
    {
        $categorias_selecc = $this->CI->TareasDiarias_Model->getCategoriasSeleccionadas($categorias);
        $categorias_otros_selecc = $this->CI->TareasDiarias_Model->getCategoriasOtrosSeleccionadas();

        if (count($categorias_selecc) == 0 && count($categorias_otros_selecc) == 0)
        {
            $this->error_array[] = "Debe rellenar los datos de un concepto al menos";
            return FALSE;
        }
        else
        {
            return TRUE;
        }
    }

    private function _getNumHorasCategoriasSelecc($array_categorias)
    {
        $num_horas = 0;
        if (count($array_categorias))
        {
            foreach ($array_categorias as $categoria)
            {
                $num_horas+=$categoria['horas'];
            }
        }
        return $num_horas;
    }

    function validaLimiteHoras($categorias, $idtarea = 0)
    {
        // Categorías del formulario seleccionadas
        $categorias_selecc = $this->CI->TareasDiarias_Model->getCategoriasSeleccionadas($categorias);
        $categorias_otros_selecc = $this->CI->TareasDiarias_Model->getCategoriasOtrosSeleccionadas();
        // Si hay que tener en cuenta las horas de la tarea
        $num_horas_tarea = 0;
        if (!empty($idtarea))
        {
            $categorias_tarea_selecc = $this->CI->TareasDiarias_Model->getCategoriasAsignadas($idtarea, "result_array");
            $num_horas_tarea = $this->_getNumHorasCategoriasSelecc($categorias_tarea_selecc);
        }
        // Total horas
        $num_horas = $this->_getNumHorasCategoriasSelecc($categorias_selecc) + $this->_getNumHorasCategoriasSelecc($categorias_otros_selecc) + $num_horas_tarea;
        // Restricción
        if ($num_horas > 8)
        {
            $this->error_array[] = "El número de horas totales no puede ser superior a 8";
            return FALSE;
        }
        else
        {
            return TRUE;
        }
    }

    function validaTareaUnica($idusuario, $fecha)
    {
        $tarea = $this->CI->TareasDiarias_Model->getDiariasByFecha($idusuario, $this->CI->utilities->cambiafecha_form($fecha));

        if (count($tarea) == 0)
        {
            return TRUE;
        }
        else
        {
            $this->error_array[] = "Ya existe otra tarea diaria para la fecha actual";
            return FALSE;
        }
    }

    /*     * *********************** VALIDACIONES IRPF ************************************** */

    /**
     * validaNIFConyuge
     *
     * Valida que un NIF árbitro y el de su cónyuge no coinciden y es correcto
     *
     * @access	public
     * @return	boolean
     */
    function validaNIFConyuge($cif, $dniconyuge, $id_irpf)
    {
        if ($cif != $dniconyuge)
        {
            if (!empty($dniconyuge))
            {
                if ($this->CI->utilities->valida_nif($dniconyuge) == 1 || $this->CI->utilities->valida_nif($dniconyuge) == 3)
                {
                    // Modelo
                    $this->CI->load->model('Arbitros_Irpf_Model');
                    // Buscamos si la pareja especificada tiene ese NIF y está en uso
                    if ($this->CI->Arbitros_Irpf_Model->nifConyugeDisponible($dniconyuge, $id_irpf))
                    {
                        return TRUE;
                    }
                    else
                    {
                        $this->error_array[] = 'El NIF/NIE de su cónyuge ya está asociado a un árbitro';
                        return FALSE;
                    }
                }
                else
                {
                    $this->error_array[] = 'El NIF/NIE de su cónyuge es incorrecto';
                    return FALSE;
                }
            }
            else
            {
                return TRUE;
            }
        }
        else
        {
            $this->error_array[] = 'El NIF/NIE del árbitro no puede coincidir con el NIF/CIF de su cónyuge';
            return FALSE;
        }
    }

    /*     * ************************ VALIDACIONES PARTICIPANTES *************************** */

    /**
     * validaNumLicenciaParticipante
     *
     * Valida que un número de licencia de un participante introducido es correcto
     *
     * @access	public
     * @param	string
     * @return	boolean
     */
    function validaNumLicenciaParticipante($cif, $idpais)
    {
        // Nif Obligatorio
        if ($cif != "")
        {
            // Extranjeros
            if ($idpais != 724)
            {
                return TRUE;
                // Españoles Residentes o Menores
            }
            else if ($this->CI->utilities->num_ident_menores_valido($cif) || $this->CI->utilities->valida_nif($cif) == 3)
            {
                return TRUE;
                // Españoles con DNI normal (no admitidos)
            }
            else if ($this->CI->utilities->valida_nif($cif) == 1)
            {
                return FALSE;
                // Españoles con Número de licencia mal especificado
            }
            else if (!is_numeric($cif) || $cif > 99999999)
            {
                return FALSE;
            }
            else
            {
                return TRUE;
            }
        }
        else
        {
            return FALSE;
        }
    }

    function validarDatosParticipantes($idprueba, $linedata, $carrera, $dorsales_importados = NULL, $dnis_importados = NULL)
    {
        // Procesar datos
        $error = FALSE;
        $texto_errores = "";

        // Cambiados los strlower de texto de federado y añadidos etiquetas de errores
        $etiqueta_error_apertura = "<p>";
        $etiqueta_error_cierre = "</p>";

        // Se rescatan los datos de su licencia
        $licencia = $this->CI->Importar_Model->getFederadoParticipante($linedata['dni'], $carrera->fecha_elegida, $carrera->temporada);
        if ($licencia)
        {
            // Conversión de datos de licencia
            $linedata['federado'] = 1;
            $linedata['texto_federado'] = "Sí";
            $linedata['categoria_licencia'] = $licencia->idcategoria;
            $categoria_licencia = $this->CI->Categorias_Model->getCategoria($licencia->idcategoria);
            if ($categoria_licencia)
            {
                $linedata['nombre_categoria_licencia'] = $categoria_licencia->categoria;
            }
            else
            {
                $linedata['nombre_categoria_licencia'] = NULL;
            }
            // Rescatamos datos del equipo
            // Debemos añadir el idagrupamiento para saber si hay que mirar en los certificados de ciclocross
            $clubequipo = $this->CI->Importar_Model->getClubEquipoParticipanteLicencia($licencia, $carrera->idagrupamiento);
            $linedata['idclub'] = $clubequipo['idclub'];
            $linedata['idequipo'] = $clubequipo['idequipo'];
            $linedata['clubequipo'] = $clubequipo['clubequipo'];
            $linedata['nombre_clubequipo'] = $linedata['clubequipo'];
            // Conversión de datos
            $linedata['first_name'] = $licencia->first_name;
            $linedata['last_name'] = $licencia->last_name;
            $linedata['fechanac'] = $this->CI->utilities->cambiafecha_bd($licencia->fechanac);
            $linedata['nombre_pais'] = $licencia->pais;
            $linedata['sexo'] = $licencia->sexo;
            $linedata['nombre_poblacion'] = $licencia->localidad;
            $linedata['poblacion'] = $licencia->localidad;
            $linedata['idpoblacion'] = $this->CI->Poblaciones_Model->getIdPoblacionByName($linedata['nombre_poblacion']);
            //$linedata['idpoblacion'] = $licencia->idpoblacion;
            $linedata['nombre_provincia'] = $licencia->provincia;
            $linedata['provincia'] = $licencia->provincia;
            $linedata['idprovincia'] = $licencia->idprovincia;

            // categoría de licencia
            if (empty($linedata['nombre_categoria_licencia']))
            {
                $linedata['nombre_categoria_licencia'].=' <span class="label label-warning">No existe</span>';
                $error = TRUE;
                $texto_errores .= $etiqueta_error_apertura . " Categoria de licencia no existe " . $etiqueta_error_cierre;
            }
        }

        // País
        $linedata['idpais'] = $this->CI->Paises_Model->getIDPaisByName($linedata['nombre_pais']);
        if (empty($linedata['idpais']))
        {
            $linedata['nombre_pais'].=' <span class="label label-warning">No existe</span>';
            $error = TRUE;
            $texto_errores .= $etiqueta_error_apertura . " Pais no existe " . $etiqueta_error_cierre;
        }

        // Nif en formato licencia
        $validation_nif = $this->CI->form_validation->validaNumLicenciaParticipante($linedata['dni'], $linedata['idpais']);
        if (!$validation_nif)
        {
            $linedata['dni'].=' <span class="label label-warning">Erróneo</span>';
            $error = TRUE;
            $texto_errores .= $etiqueta_error_apertura . " Licencia incorrecta " . $etiqueta_error_cierre;
        }

        // Es un nuevo inscrito
        $nif = $this->CI->utilities->convertirNumLicenciaNIF($linedata['dni'], $linedata['idpais']);
        $existe = $this->CI->Carreras_Model->existeInscrito($nif, $idprueba);
        if ($existe)
        {
            $linedata['nuevo'] = 0;
            $linedata['existe'] = ' <span class="label label-success">Existente</span>';
        }
        else
        {
            $linedata['nuevo'] = 1;
            $linedata['existe'] = ' <span class="label label-success">Nuevo</span>';
        }

        // obtenemos el dorsal de prueba
        if (empty($linedata['dorsal_prueba']) || $linedata['dorsal_prueba'] <= 0)
        {
            $linedata['dorsal_prueba'].=' <span class="label label-warning">Incorrecto</span>';
            $error = TRUE;
            $texto_errores .= $etiqueta_error_apertura . " Dorsal de prueba incorrecto " . $etiqueta_error_cierre;
        }
        else
        {
            // Comprueba que no está repetido
            if (!is_null($dorsales_importados))
            {
                if (in_array($linedata['dorsal_prueba'], $dorsales_importados))
                {
                    $linedata['dorsal_prueba'].=' <span class="label label-warning">Repetido</span>';
                    $error = TRUE;
                    $texto_errores .= $etiqueta_error_apertura . " Dorsal de prueba repetido " . $etiqueta_error_cierre;
                }
            }
        }

        // Se comprueban datos personales si no tiene licencia
        if (empty($licencia))
        {
            // obtenemos el dni
            if (empty($linedata['dni']))
            {
                $linedata['dni'].=' <span class="label label-warning">No especificado</span>';
                $error = TRUE;
                $texto_errores .= $etiqueta_error_apertura . " Licencia no especificada " . $etiqueta_error_cierre;
            }

            // obtenemos el nombre
            if (empty($linedata['first_name']))
            {
                $linedata['first_name'].=' <span class="label label-warning">No especificado</span>';
                $error = TRUE;
                $texto_errores .= $etiqueta_error_apertura . " Nombre no especificado " . $etiqueta_error_cierre;
            }

            // obtenemos los apellidos
            if (empty($linedata['last_name']))
            {
                $linedata['last_name'].=' <span class="label label-warning">No especificado</span>';
                $error = TRUE;
                $texto_errores .= $etiqueta_error_apertura . " Apellidos no especificados " . $etiqueta_error_cierre;
            }

            // Corregimos el formato de fecha de nacimiento
            if (!empty($linedata['fechanac']))
            {
                if (preg_match('/^(\d{1,2})\/(\d{1,2})\/(\d{4})$/', $linedata['fechanac'], $fechanac))
                {
                    $linedata['fechanac'] = str_pad($fechanac[1], 2, "0", STR_PAD_LEFT) . '/' . str_pad($fechanac[2], 2, "0", STR_PAD_LEFT) . '/' . str_pad($fechanac[3], 4, "0", STR_PAD_LEFT);
                    if (!$this->CI->form_validation->checkDateFormat($linedata['fechanac']))
                    {
                        $linedata['fechanac'].=' <span class="label label-warning">Incorrecto</span>';
                        $error = TRUE;
                        $texto_errores .= $etiqueta_error_apertura . " Fecha nacimiento incorrecta " . $etiqueta_error_cierre;
                    }
                }
                else
                {
                    $linedata['fechanac'].=' <span class="label label-warning">Incorrecto</span>';
                    $error = TRUE;
                    $texto_errores .= $etiqueta_error_apertura . " Fecha nacimiento incorrecta " . $etiqueta_error_cierre;
                }
            }
            else
            {
                $linedata['fechanac'].=' <span class="label label-warning">No especificada</span>';
                $error = TRUE;
                $texto_errores .= $etiqueta_error_apertura . " Fecha nacimiento no especificada " . $etiqueta_error_cierre;
            }

            // Provincia
            $linedata['idprovincia'] = $this->CI->Provincias_Model->getIdProvinciaByName($linedata['nombre_provincia']);
            if (!$linedata['idprovincia'])
            {
                $linedata['nombre_provincia'].=' <span class="label label-success">No existe</span>';
            }

            // Población
            $linedata['idpoblacion'] = $this->CI->Poblaciones_Model->getIdPoblacionByName($linedata['nombre_poblacion']);
            if (!$linedata['idpoblacion'])
            {
                $linedata['nombre_poblacion'].=' <span class="label label-success">No existe</span>';
            }

            // categoría de licencia
            $linedata['categoria_licencia'] = $this->CI->Importar_Model->getCategoriaLicenciaParticipante($linedata['nombre_categoria_licencia'], $carrera->idcomunidadprueba, $carrera->temporada, $linedata['idprovincia']);
            if (empty($linedata['categoria_licencia']))
            {
                $linedata['nombre_categoria_licencia'].=' <span class="label label-warning">No existe</span>';
                $error = TRUE;
                $texto_errores .= $etiqueta_error_apertura . " Categoria de licencia no existe " . $etiqueta_error_cierre;
            }

            // Sexo
            if (empty($linedata['sexo']) || ($linedata['sexo'] != "H" && $linedata['sexo'] != "M"))
            {
                $linedata['sexo'].=' <span class="label label-warning">Incorrecto</span>';
                $error = TRUE;
                $texto_errores .= $etiqueta_error_apertura . " Sexo incorrecto " . $etiqueta_error_cierre;
            }

            // Federado
            if (empty($linedata['texto_federado']) || ($linedata['texto_federado'] != "Sí" && $linedata['texto_federado'] != "sí" && $linedata['texto_federado'] != "Si" && $linedata['texto_federado'] != "si" && $linedata['texto_federado'] != "s" && $linedata['texto_federado'] != "S" && $linedata['texto_federado'] != "No" && $linedata['texto_federado'] != "no" && $linedata['texto_federado'] != "N" && $linedata['texto_federado'] != "n"))
            {
                $linedata['texto_federado'].=' <span class="label label-warning">Incorrecto</span>';
                $linedata['federado'] = 0;
                $error = TRUE;
                $texto_errores .= $etiqueta_error_apertura . " Federado formato incorrecto " . $etiqueta_error_cierre;
            }
            else
            {
                // Formateo de federado
                if ($linedata['texto_federado'] == "Sí" || $linedata['texto_federado'] == "sí" || $linedata['texto_federado'] == "Si" || $linedata['texto_federado'] == "si" || $linedata['texto_federado'] == "s" || $linedata['texto_federado'] == "S")
                {
                    $linedata['federado'] = 1;
                }
                else
                {
                    $linedata['federado'] = 0;
                }
                // Según el valor
                if (!$this->CI->Importar_Model->comprobarFederadoParticipante($linedata['idpais'], $linedata['federado'], $linedata['dni'], $carrera->fecha_elegida, $carrera->temporada))
                {
                    $linedata['texto_federado'].=' <span class="label label-warning">Incorrecto</span>';
                    $error = TRUE;
                    $texto_errores .= $etiqueta_error_apertura . " Federado incorrecto " . $etiqueta_error_cierre;
                }
            }

            // obtenemos el clubequipo
            $clubequipo = $this->CI->Importar_Model->getClubEquipoParticipante($linedata['nombre_clubequipo'], $linedata['federado'], $linedata['dni'], $carrera->temporada);
            if (empty($linedata['nombre_clubequipo']))
            {
                $linedata['clubequipo'] = NULL;
                $linedata['nombre_clubequipo'].=' <span class="label label-success">No especificado</span>';
            }
            else
            {
                $linedata['idclub'] = $clubequipo['idclub'];
                $linedata['idequipo'] = $clubequipo['idequipo'];
                $linedata['clubequipo'] = $clubequipo['clubequipo'];
            }
        }

        // Comprueba que no está repetido
        if (!is_null($dnis_importados))
        {
            if (in_array($linedata['dni'], $dnis_importados))
            {
                $linedata['dni'].=' <span class="label label-warning">Repetido</span>';
                $error = TRUE;
                $texto_errores .= " Licencia repetida " . $etiqueta_error_cierre;
            }
        }

        // Si NO se ignora el equipo cambiado se machaca todo lo anterior
        if (isset($linedata['ignorar_clubequipocambiado']) && !$linedata['ignorar_clubequipocambiado'] && !empty($linedata['nombre_clubequipocambiado']))
        {
            $linedata['idclub'] = NULL;
            $linedata['idequipo'] = NULL;
            $linedata['clubequipo'] = $linedata['nombre_clubequipocambiado'];
        }

        // Si está habilitado el equipo cambiado se muestran sus opciones
        if (!empty($linedata['nombre_clubequipocambiado']))
        {
            $linedata['nombre_clubequipocambiado'] = ' <span class="label label-important">' . $linedata['nombre_clubequipocambiado'] . '</span>';
        }


        $linedata['error'] = $error;

        $datos_validados['linedata'] = $linedata;
        $datos_validados['texto_errores'] = $texto_errores;
        $datos_validados['error'] = $error;

        return $datos_validados;
    }

    /*     * ******************** CIRCUITOS ************************** */

    /**
     * checkCircuitoExiste
     *
     * Valida que el código del circuito existe
     *
     * @access	public
     * @param	string
     * @return	boolean
     */
    function checkCircuitoExiste($codigo_circuito_ptos)
    {
        // Comprobación
        if ($this->CI->ClasificacionesCircuitos_Model->getCircuitoByCodigo($codigo_circuito_ptos))
        {
            return TRUE;
        }
        else
        {
            $this->set_message('checkCircuitoExiste', 'El circuito introducido no está registrado en el sistema de clasificaciones');
            return FALSE;
        }
    }

    /**
     * checkCircuitoExiste
     *
     * Valida que el código del circuito existe
     *
     * @access	public
     * @param	string
     * @return	boolean
     */
    function checkLimiteAsignarPruebasCircuito($idcircuito, $pruebas)
    {
        // Comprobación
        $num_pruebas_asignar = count($pruebas);
        $num_pruebas_circuito = $this->CI->ClasificacionesCircuitos_Model->getNumPruebasCircuito($idcircuito);
        if ($num_pruebas_asignar + $num_pruebas_circuito <= $this->CI->config->item('max_pruebas_circuitos'))
        {
            return TRUE;
        }
        else
        {
            $this->error_array[] = 'El límite máximo de pruebas a asignar en el circuito es de ' . $this->CI->config->item('max_pruebas_circuitos');
            return FALSE;
        }
    }

    /*     * ********************* PARA SMARTWEB ******************** */

    /**
     * validaLicenciaIncompatibleSolicitar
     *
     * Valida que la licencia no es incompatible dentro de una solicitud de un usuario
     *
     * @access	public
     * @return	boolean
     */
    function validaLicenciaIncompatibleSolicitarSW($temporada, $idusuario, $idsolicitante, $idtipogeneral, $idcomunidad)
    {
        if (empty($idtipogeneral) || empty($idsolicitante) || empty($idusuario) || empty($temporada) || empty($idcomunidad))
        {
            return FALSE;
        }
        else
        {
            // Leemos la categoría solicitada
            $check = $this->CI->Licencias_Model->checkIncompatibilidadSolicitanteSolicitar($temporada, $idusuario, $idsolicitante, $idtipogeneral, $idcomunidad);
            if (!$check)
            {
                $this->error_array[] = 'Ya existe una solicitud incompatible con la petición actual, tramitada por el club o el usuario desde su zona privada. Si lo que desea es hacer un cambio elimine primero la solicitud realizada anteriormente (Si ya estuviera pagada, no podrá borrarla. En ese caso, póngase en contacto con su federación). <br><br><p align="center"> - <a href="' . site_url('smartweb/licencias/listalicencias') . '">Volver</a> - </p>';
                return FALSE;
            }
            else
            {
                return TRUE;
            }
        }
    }

}
