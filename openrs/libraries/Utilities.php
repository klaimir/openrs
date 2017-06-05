<?php

if (!defined('APPPATH'))
    exit('No direct script access allowed');

/**
 * Utilities Class
 *
 * Clase donde se ubican todas las funciones de de utilidades varias.
 * 
 * for php5
 *
 * @package Code Igniter
 * @subpackage Libraries
 * @name Utilities
 * @version Utilities v1.0
 * @copyright Copyright (c) 2013, Angel Luis Berasuain Ruiz
 */
class Utilities {

    protected $CI;
    
    /**
     * Constructor - Establece las preferencias de las validaciones
     *
     * The constructor can be passed an array of config values
     *
     * @access public
     */
    function __construct() {
        $this->CI = & get_instance();
    }
    
    /**
     * Establece el valor de sesión en un filtro de búsqueda para un parámetro dado
     *
     * @param [error_array]			Array de errores
     *
     * @return Devuelve un texto de errores formateado
     */
    function set_value_session_filter($prefix, $field, $default_value=NULL, $button='submit') {
        // Si hay submit se coge el get
        $get_submit = $this->CI->input->get($button);
        if(!empty($get_submit))
        {
            $this->CI->session->set_userdata($prefix.'_'.$field, $this->CI->input->get($field));
        }
        // En caso contrario, si la sesión no tiene valores se aplica uno por defecto
        else
        {
            $clientes_buscador_fecha_hasta = $this->CI->session->userdata($prefix.'_'.$field);
            if(empty($clientes_buscador_fecha_hasta))
            {
                $this->CI->session->set_userdata($prefix.'_'.$field, $default_value);
            }
        }
    }
    
    /**
     * Encoding un determinado array
     *
     * @param [array]			Array de datos a codificar
     * @param [encoding_in]		Encoding de origen
     * @param [encoding_out]		Encoding de destino
     *
     * @return Devuelve el array codificado en el encoding indicado
     */
    function encoding_array($array,$encoding_in='UTF-8', $encoding_out='windows-1252') {
        foreach ($array as $key => $value)
        {
            // Con este se puede detectar, pero realmente son caracteres raros que no afectan a la importación
            /*
              if(iconv('windows-1252','UTF-8//IGNORE',$value)!=@iconv('windows-1252','UTF-8//TRANSLIT',$value))
              {
              echo $value;
              }
             * 
             */
            $array[$key] = @iconv($encoding_in, $encoding_out, $value);
        }
        return $array;
    }

    /**
     * Formatea un array de errores en un string
     *
     * @param [error_array]			Array de errores
     *
     * @return Devuelve un texto de errores formateado
     */
    function validation_errors($error_array, $etiqueta = "div", $class = "alert alert-error") {
        $string = "";
        // Crea una cadena en función de los parámetros
        if (count($error_array) > 0) {
            foreach ($error_array as $error) {
                $string.='
                <' . $etiqueta . ' class="' . $class . '">
                    ' . $error . '
                </' . $etiqueta . '>';
            }
        } else {
            return $string;
        }
    }

    /**
     * Obtiene un dígito de una cuenta
     *
     * @param [valor]			Número interno de cuenta
     *
     * @return Devuelve el dígito buscado
     */
    function obtener_digito($valor) {
        $valores = array(1, 2, 4, 8, 5, 10, 9, 7, 3, 6);
        $control = 0;
        for ($i = 0; $i <= 9; $i++) {
            $control += $valor[$i] * $valores[$i];
        }
        $control = 11 - ($control % 11);
        if ($control == 11)
            $control = 0;
        else if ($control == 10)
            $control = 1;
        return $control;
    }

    /**
     * Valida si un numero de cuenta bancaria es correcto
     *
     * @param [banco]			Número de banco
     * @param [sucursal]		Número de sucursal
     * @param [dc]				Número de dc
     * @param [cuenta]			Número de cuenta interna
     *
     * @return Devuelve un entero con los valores válido (1) o no (-1)
     */
    function valida_ccc($banco, $sucursal, $dc, $cuenta) {
        if (is_null($banco) || is_null($sucursal) || is_null($dc) || is_null($cuenta)) {
            return -1;
        } else {
            if (strlen($banco) != 4 || strlen($sucursal) != 4 || strlen($dc) != 2 || strlen($cuenta) != 10) {
                return -1;
            } else {
                if (!is_numeric($banco) || !is_numeric($sucursal) || !is_numeric($dc) || !is_numeric($cuenta)) {
                    return -1;
                } else {
                    if (!($this->obtener_digito("00" . $banco . $sucursal) == $dc[0]) ||
                            !($this->obtener_digito($cuenta) == $dc[1])) {
                        return -1;
                    } else {
                        return 1;
                    }
                }
            }
        }
    }
    
    /**
     *  Determina si es un pais extranjero
     *
     * @param [idpais]			Identificador del pais
     *
     * @return TRUE or FALSE
     */
    function es_pais_extranjero($idpais)
    {
        if($idpais!=64)
        {
            return TRUE;
        }
        else
        {
            return FALSE;
        }
    }
    
    /**
     *  Determina si una persona física es un extranjero
     *
     * @param [cif]			NIF
     * @param [idpais]      Identificador del pais
     *
     * @return TRUE or FALSE
     */
    function esExtranjero($cif,$idpais)
    {
        if($cif!="")
        {
            // NIE válido
            if($this->valida_nif($cif)==3)
            {
                return TRUE;
            }
            else
            {
                // NIF o CIF válido
                if($this->valida_nif($cif)==1 || $this->valida_nif($cif)==2)
                {
                    return FALSE;
                }
                // Formato desconocido o número de identificación de menores
                else
                {
                    return $this->es_pais_extranjero($idpais);
                }
            }
        }
        // Si no hay NIF, se determina por el pais
        else
        {
            return $this->es_pais_extranjero($idpais);
        }
    }
    
    /**
     *  Determina si un NIF/NIE/CIF es válido. Copyright ©2005-2011 David Vidal Serra. Bajo licencia GNU GPL.
     *  Modificada para aceptar número XENNNNNN como NIEs válidos
     *
     * @param [cif]			NIF/NIE/CIF
     *
     * @return 1 = NIF ok, 2 = CIF ok, 3 = NIE ok, -1 = NIF bad, -2 = CIF bad, -3 = NIE bad, 0 = ??? bad
     */
    function valida_nif($cif) {
        $cif = strtoupper($cif);
        for ($i = 0; $i < 9; $i ++) {
            $num[$i] = substr($cif, $i, 1);
        }
        
        //si no tiene un formato valido devuelve error
        if (!preg_match('/((^[A-Z]{1}[0-9]{7}[A-Z0-9]{1}$|^[T]{1}[A-Z0-9]{8}$)|^[0-9]{8}[A-Z]{1}$)/', $cif)) {
            return 0;
        }
        //comprobacion de NIFs estandar
        if (preg_match('/(^[0-9]{8}[A-Z]{1}$)/', $cif)) {
            if ($num[8] == substr('TRWAGMYFPDXBNJZSQVHLCKE', substr($cif, 0, 8) % 23, 1)) {
                return 1;
            } else {
                return -1;
            }
        }
        //algoritmo para comprobacion de codigos tipo CIF
        $suma = $num[2] + $num[4] + $num[6];
        for ($i = 1; $i < 8; $i += 2) {
            $suma += substr((2 * $num[$i]), 0, 1) + substr((2 * $num[$i]), 1, 1);
        }
        $n = 10 - substr($suma, strlen($suma) - 1, 1);
        //comprobacion de NIFs especiales (se calculan como CIFs o como NIFs)
        if (preg_match('/^[KLM]{1}/', $cif)) {
            if ($num[8] == chr(64 + $n) || $num[8] == substr('TRWAGMYFPDXBNJZSQVHLCKE', substr($cif, 1, 8) % 23, 1)) {
                return 1;
            } else {
                return -1;
            }
        }
        //comprobacion de CIFs
        if (preg_match('/^[ABCDEFGHJNPQRSUVW]{1}/', $cif)) {
            if ($num[8] == chr(64 + $n) || $num[8] == substr($n, strlen($n) - 1, 1)) {
                return 2;
            } else {
                return -2;
            }
        }
        //comprobacion de NIEs
        if (preg_match('/^[XYZ]{1}/', $cif)) {
            if ($num[8] == substr('TRWAGMYFPDXBNJZSQVHLCKE', substr(str_replace(array('X', 'Y', 'Z'), array('0', '1', '2'), $cif), 0, 8) % 23, 1)) {
                return 3;
            } else {
                return -3;
            }
        }
        //si todavia no se ha verificado devuelve error
        return 0;
    }

    /**
     * Devuelve el n�mero de segundo de diferencia entre ambas fechas
     *
     * @param [fecha1]			Primera fecha a comparar en formato dd/mm/YYYY
     * @param [fecha2]			Segunda fecha a comparar en formato dd/mm/YYYY
     *
     * @return n�mero de segundo de diferencia entre ambas fechas
     */
    function compararFechas($primera, $segunda) {
        $valoresPrimera = explode("/", $primera);
        $valoresSegunda = explode("/", $segunda);

        $diaPrimera = $valoresPrimera[0];
        $mesPrimera = $valoresPrimera[1];
        $anyoPrimera = $valoresPrimera[2];

        $diaSegunda = $valoresSegunda[0];
        $mesSegunda = $valoresSegunda[1];
        $anyoSegunda = $valoresSegunda[2];

        $diasPrimeraJuliano = gregoriantojd($mesPrimera, $diaPrimera, $anyoPrimera);
        $diasSegundaJuliano = gregoriantojd($mesSegunda, $diaSegunda, $anyoSegunda);

        if (!checkdate($mesPrimera, $diaPrimera, $anyoPrimera)) {
            return 0;
        } elseif (!checkdate($mesSegunda, $diaSegunda, $anyoSegunda)) {
            return 0;
        } else {
            return $diasPrimeraJuliano - $diasSegundaJuliano;
        }
    }
    
    /**
     * Devuelve una fecha y hora simple en formato AAAA-MM-DD HH:mm:ss
     *
     * @param [fecha]			Fecha en formato DD/MM/AAAA HH:mm:ss
     *
     * @return fecha simple en formato AAAA-MM-DD HH:mm:ss
     */
    function cambiafechahora_form($fecha)
    {
        if(trim($fecha)!="")
        {
            $fecha_explode=explode(" ",$fecha);
            $date=$fecha_explode[0];
            $date_formateada=$this->cambiafecha_form($date);
            $hour=$fecha_explode[1];
            $fecha_final=$date_formateada." ".$hour;
            return $fecha_final;
        }
        else
        {
            return NULL;
        }
    }

    /**
     * Devuelve una fecha simple en formato AAAA-MM-DD
     *
     * @param [fecha]			Fecha en formato DD/MM/AAAA
     *
     * @return fecha simple en formato AAAA-MM-DD
     */
    function cambiafecha_form($fecha) {
        if (!$this->esfecha($fecha)) {
            $fecha_final = NULL;
        } else {
            $fecha_temp = explode("/", $fecha);
            if (strlen($fecha_temp[2])==2) {
                $fecha_temp[2]='20'.$fecha_temp[2];
                if($fecha_temp[2] > date('Y')) {
                    $fecha_temp[2] = $fecha_temp[2] - 100;
                }
            }
            $fecha_final = $fecha_temp[2] . "-" . $fecha_temp[1] . "-" . $fecha_temp[0];
        }
        return $fecha_final;
    }

    /**
     * Devuelve una fecha simple en formato DD/MM/AAAA
     *
     * @param [fecha]			Fecha en formato AAAA-MM-DD
     *
     * @return fecha simple en formato DD/MM/AAAA
     */
    function cambiafecha_bd($fecha) {

        // Si la fecha viene en formato AAAA-MM-DD HH:MM:SS cogemos solo la parte de la fecha
        $fecha_temp = explode(' ',$fecha);
        if (count($fecha_temp)>0)
            $fecha=$fecha_temp[0];

        if (is_null($fecha) || $fecha == '') {
            $fecha_final = NULL;
        } else {
            $fecha_temp = explode("-", $fecha);
            $fecha_final = $fecha_temp[2] . "/" . $fecha_temp[1] . "/" . $fecha_temp[0];
        }
        return $fecha_final;
    }
    
     /**
     * Devuelve una fecha simple en formato AAAAMMDD
     *
     * @param [fecha]			Fecha en formato DD/MM/AAAA
     *
     * @return fecha simple en formato AAAAMMDD
     */
    function cambiafecha_conta($fecha) {
        $fecha_temp = explode(' ',$fecha);
        $fecha_final=str_replace('-','',$fecha_temp[0]);
        return $fecha_final;
    }

    /**
     * Comprueba si un string es una fecha en formato dd/mm/yyyy
     *
     * @param $fecha fecha en formato dd/mm/yyyy
     * @return true o false
     */
    function esfecha($fecha) {
        return preg_match('/\d{2}\/\d{2}\/\d{2,4}/',$fecha);
    }
    
    /**
    * Determina la url al cual debe de volver el navegador
    *
    *
    * @return string con la url
    */

    function enlace_volver_general()
    {	
        if($_POST) return "javascript:history.go(-2);"; else return "javascript:history.go(-1);";
    }
    
    function enlace_anterior()
    {	
        return "javascript:history.go(-1);";
    }

    /**
     * Devuelve todos los datos de un fichero almacenado en el sistema
     *
     * @param [path]			ruta absoluta del fichero
     *
     * @return un array con todos las caracter�sticas del fichero
     */
    function filedata($path) {
        // Vaciamos la cach� de lectura de disco
        clearstatcache();
        // Comprobamos si el fichero existe
        $data["exists"] = is_file($path);
        // Comprobamos si el fichero es escribible
        $data["writable"] = is_writable($path);
        // Leemos los permisos del fichero
        $data["chmod"] = ($data["exists"] ? substr(sprintf("%o", fileperms($path)), -4) : FALSE);
        // Extraemos la extensi�n, un s�lo paso
        $data["ext"] = substr(strrchr($path, "."), 1);
        // Primer paso de lectura de ruta
        $data["path"] = array_shift(explode("." . $data["ext"], $path));
        // Primer paso de lectura de nombre
        $data["name"] = array_pop(explode("/", $data["path"]));
        // Ajustamos nombre a FALSE si est� vacio
        $data["name"] = ($data["name"] ? $data["name"] : FALSE);
        // Ajustamos la ruta a FALSE si est� vacia
        $data["path"] = ($data["exists"] ? ($data["name"] ? realpath(array_shift(explode($data["name"], $data["path"]))) : realpath(array_shift(explode($data["ext"], $data["path"])))) : ($data["name"] ? array_shift(explode($data["name"], $data["path"])) : ($data["ext"] ? array_shift(explode($data["ext"], $data["path"])) : rtrim($data["path"], "/"))));
        // Ajustamos el nombre a FALSE si est� vacio o a su valor en caso contrario
        $data["filename"] = (($data["name"] OR $data["ext"]) ? $data["name"] . ($data["ext"] ? "." : "") . $data["ext"] : FALSE);
        // Devolvemos los resultados
        return $data;
    }

    /**
     * Devuelve una subcadena de un string
     *
     * @param [texto]			Cadena a recortar
     * @param [texto]			Longitud m�xima de la cadena recortada
     *
     * @return subcadena de un string
     */
    function cortarTexto($texto, $marcador) {
        if (strlen($texto) < $marcador - 1) {
            return $texto;
        }
        return substr($texto, 0, $marcador + 1);
    }
    
    /**
     * Calcula la edad a partir del año de solicitud de una licencia
     *
     * @param [fecha]			fecha de nacimiento
     *
     * @return Entero con la edad
     */
    function obtener_edad_licencia($fecha, $temporada=NULL) {
        if ($fecha != "") {
            $ano=substr($fecha,0,4);
            if(is_null($temporada))
            {
                $temporada_licencia=$this->CI->session->userdata('solicitar_temporada');
            }
            else
            {
                $temporada_licencia=$temporada;
            }
            return intval($temporada_licencia)-intval($ano);
        } else
            return 0;
    }

    /**
     * Calcula la edad a partir de una fecha de nacimiento en formato dd/mm/YYYY
     *
     * @param [fecha]			fecha de nacimiento
     *
     * @return Entero con la edad
     */
    function obtener_edad($fecha) {
        if ($fecha != "") {
            list($Y, $m, $d) = explode("-", $fecha);
            return( date("md") < $m . $d ? date("Y") - $Y - 1 : date("Y") - $Y );
        } else
            return 0;
    }

    /**
     * Calcula la edad a una fecha data a partir de una fecha de nacimiento en formato YYYY-mm-dd
     *
     * @param [fecha]			fecha de nacimiento
     * @param [fechahasta]		fecha en la que se calculara la edad
     *
     * @return Entero con la edad
     */
    function obtener_edad_hasta($fecha,$fechahasta) {
        $timestamp=strtotime($fechahasta);
        if ($fecha != "") {
            list($Y, $m, $d) = explode("-", $fecha);
            return( date("md",$timestamp) < $m . $d ? date("Y",$timestamp) - $Y - 1 : date("Y",$timestamp) - $Y );
        } else
            return 0;
    }

    // Convertir array en cadena con separador
    function convertirArrayString($array, $separador, $default_return=NULL) {
        $count_array=count($array);
        if (is_array($array) &&  $count_array> 0) {
            $string = "";
            $cont=1;
            foreach ($array as $value) {
                if($count_array==$cont)
                {
                    $string.=$value;
                }
                else
                {
                    $string.=$value . $separador;
                    $cont++;
                }
            }
            return $string;
        } else {
            return $default_return;
        }
    }

    /**
     * Obtiene un valor debidamente formateado según el tipo de dato deseado
     *
     * @param [theValue]			Valor a procesar
     * @param [theType]				Tipo de dato
     * @param [theDefinedValue]		Valor cuando no se define un campo
     * @param [theNotDefinedValue]	Valor cuando se define un campo
     *
     * @return valor formateado
     */
    function get_sql_value_string($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") {
        if ($theType != "array")
            $theValue = (!get_magic_quotes_gpc()) ? addslashes($theValue) : $theValue;

        switch ($theType) {
            case "text":
                $theValue = ($theValue != "") ? strval($theValue) : NULL;
                break;
            case "long":
            case "int":
                $theValue = ($theValue != "") ? intval($theValue) : NULL;
                break;
            case "int_cero":
                $theValue = ($theValue != 0 && $theValue != "") ? intval($theValue) : NULL;
                break;
            case "double":
                $theValue = ($theValue != "") ? doubleval($theValue) : NULL;
                break;
            case "float":
                $theValue = ($theValue != "") ? floatval($theValue) : NULL;
                break;
            case "defined":
                $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
                break;
            case "array":
                if (isset($theValue) && $theValue != "" && is_array($theValue)) {
                    $string = "";
                    foreach ($theValue as $value) {
                        $string.=$value;
                    }
                    return $string;
                } else {
                    return NULL;
                }
                break;
        }
        return $theValue;
    }

    /**
     * Devuelve el navegador sobre el que se ejecuta la aplicaci�n (http://php.net/manual/es/function.get-browser.php)
     *
     *
     * @return String con el tipo de navegador detectado
     */
    function ObtenerNavegador() {
        $browsers = array("firefox", "msie", "opera", "chrome", "safari",
            "mozilla", "seamonkey", "konqueror", "netscape",
            "gecko", "navigator", "mosaic", "lynx", "amaya",
            "omniweb", "avant", "camino", "flock", "aol");

        $agent = strtolower($_SERVER['HTTP_USER_AGENT']);
        foreach ($browsers as $browser) {
            if (preg_match("#($browser)[/ ]?([0-9.]*)#", $agent, $match)) {
                $resultado['name'] = $match[1];
                $resultado['version'] = $match[2];
                break;
            }
        }
        return $resultado;
    }

    /**
     * Formatea un Número entero añadiéndole n ceros delante
     *
     * @param [num_secuencial]		Número secuencial en formato int
     * @param [digitos]             Número máximos de dígitos que tendrá el número
     *
     * @return Número secuencial formateado
     */
    function ObtenerNumSecuencialFormateado($num_secuencial, $digitos) {
        for ($cont = 1; $cont < $digitos; $cont++) {
            if ($num_secuencial < (pow(10, $cont))) {
                $num_secuencial = $this->generarNumerosRepetidos($digitos - 1, "0") . $num_secuencial;
            }
        }
        // Devolución
        return $num_secuencial;
    }

    // Genera tanto números de cantidad $num como $digitos indicados y lo devuelve en un string
    function generarNumerosRepetidos($digitos, $num) {
        $cadena = "";
        for ($cont = 1; $cont <= $digitos; $cont++) {
            $cadena.=$num;
        }
        return $cadena;
    }

    /**
     * Obtiene el valor alfabético del mes
     *
     * @param [num]			Número del mes
     *
     * @return string con el valor alfabético del mes
     */
    function obtener_mes($num) {
        $valor = $num - 1;
        $mes = array('Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre');
        return $mes[$valor];
    }

    /**
     * Borra recursivamente el contenido de un directorio
     *
     * @param [dirname]			ruta absoluta del directorio
     *
     * @return true or false
     */
    function full_rmdir($dirname) {
        if ($dirHandle = opendir($dirname)) {
            $old_cwd = getcwd();
            chdir($dirname);

            while ($file = readdir($dirHandle)) {
                if ($file == '.' || $file == '..')
                    continue;

                if (is_dir($file)) {
                    if (!full_rmdir($file))
                        return false;
                }
                else {
                    if (!unlink($file))
                        return false;
                }
            }

            closedir($dirHandle);
            chdir($old_cwd);
            if (!rmdir($dirname))
                return false;

            return true;
        }
        else {
            return false;
        }
    }

    /**
     * Obtiene recursivamente los ficheros de un directorio
     *
     * @param [dirname]			ruta absoluta del directorio
     *
     * @return true or false
     */
    function getDocsDir($dirname) {
        $docs = array();
        // Se recorre el directorio almacenando los ficheros
        if ($dirHandle = opendir($dirname)) {
            $old_cwd = getcwd();
            chdir($dirname);

            while ($file = readdir($dirHandle)) {
                if ($file == '.' || $file == '..')
                    continue;

                if (!is_dir($file)) {
                    $docs[] = $file;
                }
            }

            closedir($dirHandle);
            chdir($old_cwd);
        }
        // Devuelve array de documentos encontrados
        return $docs;
    }

    /**
     * Redimensiona una fotograf�a para mostrarla en un formato legible
     *
     * @param [ruta_foto]			Ruta absoluta donde est� ubicada la fotograf�a
     * @param [max_pixels_altura]	N�mero m�ximo de pixeles de altura que puede ocupar la fotograf�a
     * @param [max_pixels_anchura]	N�mero m�ximo de pixeles de anchura que puede ocupar la fotograf�a
     *
     * @return array con los resultados del ancho y el alto de la fotograf�a redimensionada
     */
    function redimensionar_fotografia($ruta_foto, $max_pixels_altura = 300, $max_pixels_anchura = 300) {
        $resultados = array();
        // Se obtiene la dimensi�n de la fotograf�a
        $size = GetImageSize($ruta_foto);
        // Se redimensiona porcentualmente
        $anchura = $size[0];
        $altura = $size[1];
        $proporcion_anchura_altura = $anchura / $altura;
        $proporcion_altura_anchura = $altura / $anchura;
        // Se calcula el m�ximo n�mero de pixeles a la mayor dimensi�n
        if ($anchura > $altura) {
            $resultados['anchura'] = $max_pixels_anchura;
            $resultados['altura'] = $max_pixels_anchura * $proporcion_altura_anchura;
        } else {
            $resultados['altura'] = $max_pixels_altura;
            $resultados['anchura'] = $max_pixels_altura * $proporcion_anchura_altura;
        }
        return $resultados;
    }

    /**
     * Cambia un n�mero en formato eee.eee.eee,dd a formato anglosaj�n para almecenarse en la BD
     *
     * @param [num]			n�mero en formato eee.eee.eee,dd
     *
     * @return N�mero formateado
     */
    function formatear_numero($num) {
        $num_original = (string) $num;
        $num_formateado = "";

        for ($cont = 0; $cont < strlen($num_original); $cont++) {
            
            if ($num_original[$cont] == ".")
            {
                $num_original[$cont] = ",";
            }  
           else
           {
               if ($num_original[$cont] == ",") {
                    $num_original[$cont] = ".";
                }
           }
                
           $num_formateado.=$num_original[$cont];
            
        }

        return $num_formateado;
    }

    /**
     *  Genera una cadena aleatoria de caracteres
     *
     * @param [DesdeLetra]			Letra de inicio del conjunto de b�squeda
     * @param [HastaLetra]			Letra de inicio del conjunto de b�squeda
     * @param [tam]					Tama�o de la cadena de caracteres generada
     *
     * @return cadena de caracteres aleatoria
     */
    function generar_cadena_aleatoria($DesdeLetra, $HastaLetra, $tam) {
        $cadenaAleatoria = "";
        if ($tam > 0) {
            $cont = 0;
            do {
                $letraAleatoria = chr(rand(ord($DesdeLetra), ord($HastaLetra)));
                $cadenaAleatoria.=$letraAleatoria;
                $cont++;
            } while ($cont != $tam);
        }
        return $cadenaAleatoria;
    }

    /**
     *  Obtiene letra del NIF a partir del DNI
     *
     * @param [dni]			Letra de inicio del conjunto de búsqueda
     *
     * @return Letra del DNI
     */
    function LetraNIF($dni) {
        $valor = (int) ($dni / 23);
        $valor *= 23;
        $valor = $dni - $valor;
        $letras = "TRWAGMYFPDXBNJZSQVHLCKEO";
        $letraNif = substr($letras, $valor, 1);
        return $letraNif;
    }

    /**
     *  Genera un identificador de transacción para operaciones bancarias
     *
     *
     * @return Cadena de caracteres con el identificador
     */
    function generarIDTrans() {
        /*
         * ALGORITMO EN ASP
         *
          Dim y As String, ddd As String, hh As String, mm As String, ss As String, an As String, id As String

          'y = Now.Year.ToString.Substring(Len(Now.Year.ToString) - 1, Len(Now.Year.ToString)) 'Año (Último Número)
          y = Now.Year.ToString.Substring(Len(Now.Year.ToString) - 1, 1) 'Año (Último Número)


          ddd = Now.DayOfYear.ToString.PadLeft(3, "0")
          'If ddd < 10 Then
          '    ddd = y & "00" 'Añadimos 2 ceros en el caso de ser menos de 10
          'Else
          '    If (ddd > 9 And ddd < 100) Then
          '        ddd = "0" & ddd 'Añadimos un 0 en el caso de ser mayor de 9 y menor de 100
          '    End If
          'End If
          hh = Now.TimeOfDay.Hours.ToString.PadLeft(2, "0") 'Hora Actual
          mm = Now.TimeOfDay.Minutes.ToString.PadLeft(2, "0") 'Minutos Acutales
          ss = Now.TimeOfDay.Seconds.ToString.PadLeft(2, "0") 'Segundos Actuales
          Randomize()
          an = Int((99 - 10 + 1) * Rnd() + 10) 'Aleatro entre 10 y 99

          Return y & ddd & hh & mm & ss & an
          'Return ddd & hh & mm & ss & an
         * 
         */
        // Strings
        $y = '';
        $ddd = '';
        $hh = '';
        $mm = '';
        $ss = '';
        $an = '';
        $id = '';
        // Año (Último Número)
        $current_year = date("Y");
        $y = substr($current_year, 3, 1);
        // Día del año absoluto
        $absolut_current_day = date("z");
        $ddd = str_pad($absolut_current_day, 3, "0", STR_PAD_LEFT);
        // Hora Actual
        $absolut_current_hour = date("H");
        $hh = str_pad($absolut_current_hour, 2, "0", STR_PAD_LEFT);
        // Minutos Acutales
        $absolut_current_minutes = date("i");
        $mm = str_pad($absolut_current_minutes, 2, "0", STR_PAD_LEFT);
        // Segundos Actuales
        $absolut_current_seconds = date("s");
        $ss = str_pad($absolut_current_seconds, 2, "0", STR_PAD_LEFT);
        // Aleatro entre 10 y 99
        $an = rand(10, 99);
        // Id. Transacción
        $id = $y . $ddd . $hh . $mm . $ss . $an;
        return $id;
    }

    function desofuscarPalabraSecreta($pal_sec_ofuscada, $clave_xor) {
        $cad1_0 = "0";
        $cad2_0 = "00";
        $cad3_0 = "000";
        $cad4_0 = "0000";
        $cad5_0 = "00000";
        $cad6_0 = "000000";
        $cad7_0 = "0000000";
        $cad8_0 = "00000000";
        $pal_sec = "";
        $trozos = explode(";", $pal_sec_ofuscada);
        $tope = count($trozos);

        for ($i = 0; $i < $tope; $i++) {
            $res = "";
            $pal_sec_ofus_bytes[$i] = decbin(hexdec($trozos[$i]));
            if (strlen($pal_sec_ofus_bytes[$i]) == 7) {
                $pal_sec_ofus_bytes[$i] = $cad1_0 . $pal_sec_ofus_bytes[$i];
            }
            if (strlen($pal_sec_ofus_bytes[$i]) == 6) {
                $pal_sec_ofus_bytes[$i] = $cad2_0 . $pal_sec_ofus_bytes[$i];
            }
            if (strlen($pal_sec_ofus_bytes[$i]) == 5) {
                $pal_sec_ofus_bytes[$i] = $cad3_0 . $pal_sec_ofus_bytes[$i];
            }
            if (strlen($pal_sec_ofus_bytes[$i]) == 4) {
                $pal_sec_ofus_bytes[$i] = $cad4_0 . $pal_sec_ofus_bytes[$i];
            }
            if (strlen($pal_sec_ofus_bytes[$i]) == 3) {
                $pal_sec_ofus_bytes[$i] = $cad5_0 . $pal_sec_ofus_bytes[$i];
            }
            if (strlen($pal_sec_ofus_bytes[$i]) == 2) {
                $pal_sec_ofus_bytes[$i] = $cad6_0 . $pal_sec_ofus_bytes[$i];
            }
            if (strlen($pal_sec_ofus_bytes[$i]) == 1) {
                $pal_sec_ofus_bytes[$i] = $cad7_0 . $pal_sec_ofus_bytes[$i];
            }
            $pal_sec_xor_bytes[$i] = decbin(ord($clave_xor[$i]));
            if (strlen($pal_sec_xor_bytes[$i]) == 7) {
                $pal_sec_xor_bytes[$i] = $cad1_0 . $pal_sec_xor_bytes[$i];
            }
            if (strlen($pal_sec_xor_bytes[$i]) == 6) {
                $pal_sec_xor_bytes[$i] = $cad2_0 . $pal_sec_xor_bytes[$i];
            }
            if (strlen($pal_sec_xor_bytes[$i]) == 5) {
                $pal_sec_xor_bytes[$i] = $cad3_0 . $pal_sec_xor_bytes[$i];
            }
            if (strlen($pal_sec_xor_bytes[$i]) == 4) {
                $pal_sec_xor_bytes[$i] = $cad4_0 . $pal_sec_xor_bytes[$i];
            }
            if (strlen($pal_sec_xor_bytes[$i]) == 3) {
                $pal_sec_xor_bytes[$i] = $cad5_0 . $pal_sec_xor_bytes[$i];
            }
            if (strlen($pal_sec_xor_bytes[$i]) == 2) {
                $pal_sec_xor_bytes[$i] = $cad6_0 . $pal_sec_xor_bytes[$i];
            }
            if (strlen($pal_sec_xor_bytes[$i]) == 1) {
                $pal_sec_xor_bytes[$i] = $cad7_0 . $pal_sec_xor_bytes[$i];
            }
            for ($j = 0; $j < 8; $j++) {
                (string) $res .= (int) $pal_sec_ofus_bytes[$i][$j] ^ (int) $pal_sec_xor_bytes[$i][$j];
            }
            $xor[$i] = $res;

            $pal_sec .= chr(bindec($xor[$i]));
        }
        return $pal_sec;
    }

    function getCorreos($users) {
        // Se devuelven los correos en un array
        $emails = array();
        foreach ($users as $user) {
            $emails[] = $user->email;
        }
        return $emails;
    }

    function create_zip($files = array(),$destination = '',$overwrite = false,$dir='./') {
        chdir($dir);

        //if the zip file already exists and overwrite is false, return false
        if(file_exists($destination) && !$overwrite) { return false; }
        //vars
        $valid_files = array();
        //if files were passed in...
        if(is_array($files)) {
            //cycle through each file
            foreach($files as $file) {
                //make sure the file exists
                if(file_exists($file)) {
                    $valid_files[] = $file;
                }
            }
        }
        //if we have good files...
        if(count($valid_files)) {
            //create the archive
            $zip = new ZipArchive();
            if($zip->open($destination,$overwrite ? ZIPARCHIVE::OVERWRITE : ZIPARCHIVE::CREATE) !== true) {
                return false;
            }
            //add the files
            foreach($valid_files as $file) {
                $zip->addFile($file,$file);
            }
            //debug
            //echo 'The zip archive contains ',$zip->numFiles,' files with a status of ',$zip->status;

            //close the zip -- done!
            $zip->close();

            //check to make sure the file exists
            return file_exists($destination);
        }
        else
        {
            return false;
        }
    }
    
    function csv_encode_conv($var, $enc='Windows-1252') {
        $var = htmlentities($var, ENT_QUOTES, 'utf-8');
        $var = html_entity_decode($var, ENT_QUOTES , $enc);
        return $var;
    }
    
    function str_pad_iconv($text,$pad,$charset="UTF-8") {
		$tam=iconv_strlen($text, $charset);
		if($tam>=$pad)
		{
			return $text;
		}
		else
		{
			for($cont=0;$cont<$pad-$tam;$cont++)
			{
				$text.=" ";
			}
			return $text;
		}
    }

    function cleantext($string) {

        $table = array(
            'Š'=>'S', 'š'=>'s', 'Đ'=>'Dj', 'đ'=>'dj', 'Ž'=>'Z', 'ž'=>'z', 'Č'=>'C', 'č'=>'c', 'Ć'=>'C', 'ć'=>'c',
            'À'=>'A', 'Á'=>'A', 'Â'=>'A', 'Ã'=>'A', 'Ä'=>'A', 'Å'=>'A', 'Æ'=>'A', 'Ç'=>'C', 'È'=>'E', 'É'=>'E',
            'Ê'=>'E', 'Ë'=>'E', 'Ì'=>'I', 'Í'=>'I', 'Î'=>'I', 'Ï'=>'I', 'Ò'=>'O', 'Ó'=>'O', 'Ô'=>'O',
            'Õ'=>'O', 'Ö'=>'O', 'Ø'=>'O', 'Ù'=>'U', 'Ú'=>'U', 'Û'=>'U', 'Ü'=>'U', 'Ý'=>'Y', 'Þ'=>'B', 'ß'=>'Ss',
            'à'=>'a', 'á'=>'a', 'â'=>'a', 'ã'=>'a', 'ä'=>'a', 'å'=>'a', 'æ'=>'a', 'ç'=>'c', 'è'=>'e', 'é'=>'e',
            'ê'=>'e', 'ë'=>'e', 'ì'=>'i', 'í'=>'i', 'î'=>'i', 'ï'=>'i', 'ð'=>'o', 'ò'=>'o', 'ó'=>'o',
            'ô'=>'o', 'õ'=>'o', 'ö'=>'o', 'ø'=>'o', 'ù'=>'u', 'ú'=>'u', 'û'=>'u', 'ý'=>'y', 'ý'=>'y', 'þ'=>'b',
            'ÿ'=>'y', 'Ŕ'=>'R', 'ŕ'=>'r', 'ñ'=>'Ñ'
        );

        $stripped = preg_replace(array('/\s{2,}/', '/[\t\n]/'), ' ', $string);

        return strtoupper(strtr($string, $table));
    }

    function cleantextimport($string) {
        return $this->cleantext(trim(utf8_encode($string)));
    }

    function slugify($string,$separador='-') {

        $table = array(
            'Š'=>'S', 'š'=>'s', 'Đ'=>'Dj', 'đ'=>'dj', 'Ž'=>'Z', 'ž'=>'z', 'Č'=>'C', 'č'=>'c', 'Ć'=>'C', 'ć'=>'c',
            'À'=>'A', 'Á'=>'A', 'Â'=>'A', 'Ã'=>'A', 'Ä'=>'A', 'Å'=>'A', 'Æ'=>'A', 'Ç'=>'C', 'È'=>'E', 'É'=>'E',
            'Ê'=>'E', 'Ë'=>'E', 'Ì'=>'I', 'Í'=>'I', 'Î'=>'I', 'Ï'=>'I', 'Ñ'=>'N', 'Ò'=>'O', 'Ó'=>'O', 'Ô'=>'O',
            'Õ'=>'O', 'Ö'=>'O', 'Ø'=>'O', 'Ù'=>'U', 'Ú'=>'U', 'Û'=>'U', 'Ü'=>'U', 'Ý'=>'Y', 'Þ'=>'B', 'ß'=>'Ss',
            'à'=>'a', 'á'=>'a', 'â'=>'a', 'ã'=>'a', 'ä'=>'a', 'å'=>'a', 'æ'=>'a', 'ç'=>'c', 'è'=>'e', 'é'=>'e',
            'ê'=>'e', 'ë'=>'e', 'ì'=>'i', 'í'=>'i', 'î'=>'i', 'ï'=>'i', 'ð'=>'o', 'ñ'=>'n', 'ò'=>'o', 'ó'=>'o',
            'ô'=>'o', 'õ'=>'o', 'ö'=>'o', 'ø'=>'o', 'ù'=>'u', 'ú'=>'u', 'û'=>'u', 'ý'=>'y', 'ý'=>'y', 'þ'=>'b',
            'ÿ'=>'y', 'Ŕ'=>'R', 'ŕ'=>'r', '/' => '-', ' ' => $separador
        );

        $stripped = preg_replace(array('/\s{2,}/', '/[\t\n]/'), ' ', $string);

        return strtolower(strtr($string, $table));
    }

    function navegadorIncompatible() {
        if(preg_match('/(?i)msie [2-8]/',$_SERVER['HTTP_USER_AGENT']))
            return TRUE;
        else
            return FALSE;
    }
        
    function strip_html_tags($string) { 
        $convert_text=strip_tags($string, '<p><li>');        
        $convert_text = str_replace('<p align="justify">', "", $convert_text);
        $convert_text = str_replace('<p align="center">', "", $convert_text);
        $convert_text = str_replace('<p align="right">', "", $convert_text);
        $convert_text = str_replace('<p align="left">', "", $convert_text);
        $convert_text = str_replace('</p>', "\n", $convert_text);
        $convert_text = str_replace('<li>', "- ", $convert_text);
        $convert_text = str_replace('</li>', "\n", $convert_text);
        return $convert_text; 
    }
    
    function generarFicheroTemp($prefijo="fichero",$limpiar=TRUE)
    {
        // Limpiar ficheros anteriores
        if($limpiar)
            $this->CleanFiles(FCPATH."documentos/temp");
        // Establecemos el output
        $uniqid = uniqid($prefijo.'_', true);
        $filename_parcial = "documentos/temp/".$uniqid.".pdf";        
        return $filename_parcial;
    }
    
    function CleanFiles($dir)
    {
        //Borrar los ficheros temporales
        $t = time();
        $h = opendir($dir);
        while($file=readdir($h))
        {
            if(substr($file,-4)=='.pdf')
            {
                $path = $dir.'/'.$file;
                if($t-filemtime($path)>3600)
                    @unlink($path);
            }
        }
        closedir($h);
    }

    function trim_words($str, $limit = 100, $end_char = '...')
    {
        if (trim($str) == '')
        {
            return $str;
        }

        if (strlen($str)>$limit)
        {
            $new_str=substr($str, 0, $limit).$end_char;
        }
        else
        {
            $new_str=$str;
        }

        return rtrim($new_str);
    }
    
    function operarFecha($fecha,$cantidad,$tipo="day",$format='Y-m-d')
    {
        $nuevafecha = strtotime ( $cantidad." ".$tipo , strtotime ( $fecha ) );
        $nuevafechaformateada = date ( $format , $nuevafecha );
        return $nuevafechaformateada;
    }
    
    function getFieldsTable($table,$db='db')
    {
        $fields = $this->CI->$db->list_fields($table);
        $separador=",";
        $cont=1;
        $tamfields=count($fields);
        $fieldslist="";
        foreach ($fields as $field)
        {
           if($tamfields==$cont)
                $fieldslist.=$table.'.'.$field;
           else
                $fieldslist.=$table.'.'.$field.$separador;
           $cont++;
        }
        return $fieldslist;
    }
    
    function crearLOG($datos, $filename, $separator=":", $end_string="\n") {
        if (count($datos) > 0) {
            $fp = fopen($filename, "w+");
            // Recorremos el array
            foreach ($datos as $dato) {
                $line_implode=implode($separator,$dato).$end_string;
                fwrite($fp, $line_implode);
            }
            fclose($fp);
        }
    }
    
    function array_to_txt_binary($array, $download = "", $separator="") {
        if ($download != "")
        {	
            header('Content-Type: application/csv');
            header('Content-Disposition: attachement; filename="' . $download . '"');
            // Para evitar que salgan con caracteres extraños
            header('Content-Transfer-Encoding: binary');
            header('Content-Description: File Transfer');
            header('Content-Transfer-Encoding: binary');
            header('Cache-Control: must-revalidate');
            ob_clean();
            flush();
        }		

        ob_start();
        $f = fopen('php://output', 'w') or show_error("Can't open php://output");
        $n = 0;		
        foreach ($array as $line)
        {
            $n++;
            
            // Se le añade retorno de carro
            $line_implode=implode($separator,$line)."\r\n";
            
            if ( ! fwrite($f, $line_implode))
            {
                show_error("Can't write line $n: $line");
            }
        }
        fclose($f) or show_error("Can't close php://output");
        $str = ob_get_contents();
        ob_end_clean();

        if ($download == "")
        {
            return $str;	
        }
        else
        {	
            echo $str;
        }
    }
    
    function procesarNombreCampo($nombreCampo)
    {
        $nombreCampo = strtolower($nombreCampo);
        
        $nombreCampo = str_replace('ñ', 'n', $nombreCampo);
        $nombreCampo = str_replace(array('á', 'à', 'â', 'ä'), 'a', $nombreCampo);
        $nombreCampo = str_replace(array('Á', 'À', 'Â', 'Ä'), 'a', $nombreCampo);
        $nombreCampo = str_replace(array('é', 'è', 'ê', 'ë'), 'e', $nombreCampo);
        $nombreCampo = str_replace(array('É', 'È', 'Ê', 'Ë'), 'e', $nombreCampo);
        $nombreCampo = str_replace(array('í', 'ì', 'î', 'ï'), 'i', $nombreCampo);
        $nombreCampo = str_replace(array('Í', 'Ì', 'Î', 'Ï'), 'i', $nombreCampo);
        $nombreCampo = str_replace(array('ó', 'ò', 'ô', 'ö'), 'o', $nombreCampo);
        $nombreCampo = str_replace(array('Ó', 'Ò', 'Ô', 'Ö'), 'o', $nombreCampo);
        $nombreCampo = str_replace(array('ú', 'ù', 'û', 'ü'), 'u', $nombreCampo);
        $nombreCampo = str_replace(array('Ú', 'Ù', 'Û', 'Ü'), 'u', $nombreCampo);
        $nombreCampo = str_replace(array('(', ')', '[', ']', '{', '}', '¡', '!', 
            '¿', '?', '@', '#', '$', '%', '&', '+', '-', '*', '/', '<', '>', '.', 
            ':', ',', ';', '\\', '|', '·', '"', "'", 'º', 'ª', '€'), '', $nombreCampo);
        $nombreCampo = str_replace(' ', '_', $nombreCampo);
        
        return $nombreCampo;
    }
    
    function obtenerOpcionFusion($esclub,$esorganizador)
    {
        // Se calcula la opción de fusión
        if($esclub==1 || $esorganizador==1)
        {
            return 1;
        }
        else
        {
            return 2;
        }
    }
    
    function obtenerClasePruebaNavision($clase)
    {
        $prefijo=substr($clase, 0, 2);
        // Si el prefijo contiene las cadenas "1." o "2." se elimina
        if($prefijo=="1." || $prefijo=="2.")
        {
            $clase_navision=substr($clase, 2);
        }
        else
        {
            $clase_navision=$clase;
        }
        return $clase_navision;
    }
    
    function obtenerTipoPruebaNavision($numetapas)
    {
        if($numetapas==1)
        {
            return 1;
        }
        else
        {
            return 2;
        }
    }
    
    function getRutaWebFicheroEquipo($ruta_fichero,$guid)
    {
        $fich = substr(strrchr($ruta_fichero, "/"), 1);
        if ($fich<>"")
        {
            $explode_ruta_fichero=explode('/',$ruta_fichero);
            $posicion_idclub=count($explode_ruta_fichero)-2;
            $idclub=$explode_ruta_fichero[$posicion_idclub];
            $fich=str_replace($guid . '_','',$fich);
            $enlace = base_url(). 'documentos/club/'.$idclub . '/' . $guid .'_'. $fich;
            // Establecimiento de datos
            $array_datos['fich']=$fich;
            $array_datos['enlace']=$enlace;
            return $array_datos;
        }
        else
        {
            return NULL;
        }        
    }
    
    function getPrimeraPalabra($palabra,$separador)
    {
        $explode=explode($separador, $palabra);        
        return $explode[0];
    }
    
    function getTime_bd($date)
    {
        if(empty($date))
        {
            return NULL;
        }
        else
        {
            $explode=explode(" ", $date);        
            return $explode[1];
        }
    }
    
    function getDate_bd($date)
    {
        if(empty($date))
        {
            return NULL;
        }
        else
        {
            $explode=explode(" ", $date);        
            return $this->cambiafecha_bd($explode[0]);
        }
    }
    
    function combinateDateTime($date,$hour)
    {
        if(empty($date)) {
            return NULL;
        } else {
            $date_formateado=$this->cambiafecha_form($date);
            return $date_formateado." ".$hour;
        }        
    }
    
    function compararFechasHoras($fecha_hora1,$fecha_hora2)
    {
        $fecha_hora1_timestamp=strtotime($this->cambiafechahora_form($fecha_hora1));
        $fecha_hora2_timestamp=strtotime($this->cambiafechahora_form($fecha_hora2));
        return $fecha_hora1_timestamp-$fecha_hora2_timestamp;
    }
    
    /**
     * Devuelve una fecha y hora simple en formato AAAA-MM-DD HH:mm:ss
     *
     * @param [fecha]			Fecha en formato DD/MM/AAAA HH:mm:ss
     *
     * @return fecha simple en formato AAAA-MM-DD HH:mm:ss
     */
    function cambiafechahora_bd($fecha)
    {
        if(trim($fecha)!="")
        {
            $fecha_explode=explode(" ",$fecha);
            $date=$fecha_explode[0];
            $date_formateada=$this->cambiafecha_bd($date);
            $hour=$fecha_explode[1];
            $fecha_final=$date_formateada." ".$hour;
            return $fecha_final;
        }
        else
        {
            return NULL;
        }
    }
    
    function merge_csv($nombre, $num_csv, $prefijo){
        header('Content-Type: application/csv');
        header('Content-Disposition: attachement; filename='.$nombre.".csv");
        // Para evitar que salgan con caracteres extraños
        header('Content-Transfer-Encoding: binary');
        header('Content-Description: File Transfer');
        header('Cache-Control: must-revalidate');
        ob_clean();
        flush();      
        $result = fopen('php://output', 'w');
        for($cont=0;$cont<=$num_csv;$cont++){
            $csvcontent = file_get_contents('./documentos/temp/'.$prefijo.'_'.$nombre.$cont.'.csv');
            fwrite($result, $csvcontent);
            unlink('./documentos/temp/'.$prefijo.'_'.$nombre.$cont.'.csv');
        }
        fclose($result);
    }
    
    function slugify2($string) {

        $table = array(
            'Š'=>'S', 'š'=>'s', 'Đ'=>'Dj', 'đ'=>'dj', 'Ž'=>'Z', 'ž'=>'z', 'Č'=>'C', 'č'=>'c', 'Ć'=>'C', 'ć'=>'c',
            'À'=>'A', 'Á'=>'A', 'Â'=>'A', 'Ã'=>'A', 'Ä'=>'A', 'Å'=>'A', 'Æ'=>'A', 'Ç'=>'C', 'È'=>'E', 'É'=>'E',
            'Ê'=>'E', 'Ë'=>'E', 'Ì'=>'I', 'Í'=>'I', 'Î'=>'I', 'Ï'=>'I', 'Ñ'=>'N', 'Ò'=>'O', 'Ó'=>'O', 'Ô'=>'O',
            'Õ'=>'O', 'Ö'=>'O', 'Ø'=>'O', 'Ù'=>'U', 'Ú'=>'U', 'Û'=>'U', 'Ü'=>'U', 'Ý'=>'Y', 'Þ'=>'B', 'ß'=>'Ss',
            'à'=>'a', 'á'=>'a', 'â'=>'a', 'ã'=>'a', 'ä'=>'a', 'å'=>'a', 'æ'=>'a', 'ç'=>'c', 'è'=>'e', 'é'=>'e',
            'ê'=>'e', 'ë'=>'e', 'ì'=>'i', 'í'=>'i', 'î'=>'i', 'ï'=>'i', 'ð'=>'o', 'ñ'=>'n', 'ò'=>'o', 'ó'=>'o',
            'ô'=>'o', 'õ'=>'o', 'ö'=>'o', 'ø'=>'o', 'ù'=>'u', 'ú'=>'u', 'û'=>'u', 'ý'=>'y', 'ý'=>'y', 'þ'=>'b',
            'ÿ'=>'y', 'Ŕ'=>'R', 'ŕ'=>'r', '/' => '-'
        );

        $stripped = preg_replace(array('/\s{2,}/', '/[\t\n]/'), ' ', $string);

        return strtr($string, $table);
    }
    
    function checkResizecartel($path, $width, $height) {
        $config_image['image_library'] = 'gd2';
        $config_image['source_image'] = $path;
        $config_image['maintain_ratio'] = FALSE;
        $config_image['width'] = $width;
        $config_image['height'] = $height;
        if($height == '200')
            $config_image['quality'] = 100;
        else
            $config_image['quality'] = 80;
 
        $this->CI->image_lib->initialize($config_image);

        if ( ! $this->CI->image_lib->resize())
        {
            $this->error_array[] = $this->CI->image_lib->display_errors();
            return FALSE;
        }
        else
        {
            return TRUE;
        }
    }
    
    function array_msort($array, $cols)
    {
        $colarr = array();
        foreach ($cols as $col => $order) {
            $colarr[$col] = array();
            foreach ($array as $k => $row) { $colarr[$col]['_'.$k] = strtolower($row[$col]); }
        }
        $eval = 'array_multisort(';
        foreach ($cols as $col => $order) {
            $eval .= '$colarr[\''.$col.'\'],'.$order.',';
        }
        $eval = substr($eval,0,-1).');';
        eval($eval);
        $ret = array();
        foreach ($colarr as $col => $arr) {
            foreach ($arr as $k => $v) {
                $k = substr($k,1);
                if (!isset($ret[$k])) $ret[$k] = $array[$k];
                $ret[$k][$col] = $array[$k][$col];
            }
        }
        return $ret;
    }
    
    // http://stackoverflow.com/questions/2762061/how-to-add-http-if-its-not-exists-in-the-url
    // La función prep_url del helper URL ya lo hace
    function addhttp($url) {
        if (!preg_match("~^(?:f|ht)tps?://~i", $url)) {
            $url = "http://" . $url;
        }
        return $url;
    }
    
    // Las imágenes almacenadas en el propio servidor se almacenan con esta ruta
    function filterPathImage($html) {
         return str_replace('../../../', base_url(), $html);
    }
    
    function get_keys_objects_array($object_array,$key) {
        // Datos necesarios
        $array_valores=array();        
        // Eliminamos repetidos de objetos
        if($object_array)
        {
            foreach($object_array as $object) {
                    $array_valores[]=$object->$key;
            }
        }
        return $array_valores;
    }
    
    function in_array_object($searched_value,$object_array,$key) {
        // Obtenemos valores de búsqueda de un listado de objetos
        $array_valores=$this->get_keys_objects_array($object_array,$key); 
        // Si el valor buscado es un array, debe buscarse en el conjunto de valores
        if(is_array($searched_value))
        {
            foreach($searched_value as $valor) {
                if(in_array($valor,$array_valores))
                {
                    return TRUE;
                }
            }
            return FALSE;
        }
        // Si no sólo tiene que buscar en el valor
        else
        {
            return in_array($searched_value,$array_valores);
        }
    }
    
    function dropdown($object_array,$key,$field) {
        // Datos necesarios
        $array_valores=array();        
        // Eliminamos repetidos de objetos
        if($object_array)
        {
            foreach($object_array as $object) {
                    $array_valores[$object->$key]=$object->$field;
            }
        }
        return $array_valores;
    }
    
    function eliminarResultadosRepetidos($resultados,$key) {
        // Datos necesarios
        $array_string=array();
        $array_valores=array();        
        // Eliminamos repetidos de objetos
        if($resultados)
        {
            foreach($resultados as $resultado) {
                if(!in_array($resultados->$key,$array_string))
                {
                    $array_string[]=$resultado->$key;
                    $array_valores[]=$resultado;
                }
            }            
            return $array_valores;
        }
        else
        {
            return $resultados;
        }        
    }
    
    function show_access_error($mensaje) 
    {
        $this->CI->session->set_flashdata('mensaje', $mensaje);
        $this->CI->session->set_flashdata('color', 'error');
        redirect(site_url('usuarios/show_error'), 'refresh');
    }
    
    public function check_security_access_perfiles_or($perfiles) {
        // Comprobación OR
        $error=TRUE;
        $mensaje = "Usted no tiene acceso a esta sección";
        foreach($perfiles as $perfil)
        {
            if($this->CI->data[$perfil])
            {                
                $error=FALSE;
            }
        }
        // Check del error
        if($error)
        {
            show_error($mensaje);
        }
    }
    
    public function check_security_access_perfiles_and($perfiles) {
        // Comprobación OR
        $error=FALSE;
        $mensaje = "Usted no tiene acceso a esta sección";
        foreach($perfiles as $perfil)
        {
            if(!$this->CI->data[$perfil])
            {                
                $error=TRUE;
            }
        }
        // Check del error
        if($error)
        {
            show_error($mensaje);
        }
    }
}