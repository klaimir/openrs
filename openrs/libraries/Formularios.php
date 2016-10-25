<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Formularios {
	
	public function __construct()
	{
		$this->CI =& get_instance();
		$this->CI->load->model('general_model');
	}
	
	function dropdown($tabla,$key,$value,$where=null)
	{
		$dropdown[0] = $this->CI->lang->line('drop_seleccione');
		$datos=$this->CI->general_model->dropdown($tabla,$key,$value,$where);
		$dropdown = array();
		foreach($datos as $drop){
			$dropdown[$drop->$key] = $drop->$value;
		}
		
		return $dropdown;
	}
	
	function dropdown_idioma($tabla,$key,$value,$idioma,$where=null)
	{
		$dropdown[0] = $this->CI->lang->line('drop_seleccione');
		$datos=$this->CI->general_model->dropdown_idioma($tabla,$key,$value,$idioma, $where);
		foreach($datos as $drop){
			$dropdown[$drop->$key] = $drop->$value;
		}
		return $dropdown;
	}

}
?>