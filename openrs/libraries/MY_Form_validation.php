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
        $explode = explode(';', $string);
        $table = $explode[0];
        $id = $explode[1];
        $field = $explode[2];
        $primary_key = $explode[3];

        $this->CI->db->select();
        $this->CI->db->from($table);
        $this->CI->db->where($field, $str);
        if ($id != 0)
        {
            $this->CI->db->where($primary_key . " <> " . $id);
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
        $explode = explode(';', $string);
        $table = $explode[0];
        $id = $explode[1];
        $field = $explode[2];
        $primary_key = $explode[3];
        $foreign_key_field = $explode[4];
        $foreign_key_value = $explode[5];

        $this->CI->db->select();
        $this->CI->db->from($table);
        $this->CI->db->where($field, $str);
        $this->CI->db->where($foreign_key_field, $foreign_key_value);
        if ($id != 0)
        {
            $this->CI->db->where($primary_key . " <> " . $id);
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
    function is_nif_valido($cif, $idpais = 64)
    {
        if (!$this->CI->utilities->es_pais_extranjero($idpais) && $this->CI->utilities->valida_nif($cif) <= 0)
        {
            $this->set_message('is_nif_valido', 'El campo %s es un NIF/NIE/CIF incorrecto');
            return FALSE;
        }
        else
        {
            return TRUE;
        }
    }

}
