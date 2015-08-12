<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class BaseModel extends MY_Model
{
	protected $primary_column = 'id';

	public $fields = array();
    public $fields_meta = array();

	public function __construct()
    {
        parent::__construct();
        self::add_field('id', 'int');
        //self::add_field('status', 'boolean', array('label' => 'Activo', 'default' => 1));
        self::add_field('sort', 'int');
        //self::add_field($this->s_main_field, 'string', array_merge(array('label' => $this->s_main_field_label), $this->v_main_field_attributes));
    }
	
	function get_list($order_by = '')
	{
		$r = array();
		$this->db->select();
		$this->db->from($this->_table);
		$order_by = $order_by!='' ? $order_by : $this->primary_column;
		$this->db->order_by($order_by);
		$query = $this->db->get();
        foreach ($query->result() as $d)
            $r[$d->id] = $d->{$this->primary_column};
        return $r;		
	}
	
	function get_value($id)
	{
		$this->db->select($this->primary_column.' AS title');
		$this->db->from($this->_table);
		$this->db->where('id', $id);
		$query = $this->db->get();
        return $query->row($this->primary_column);
	}

	function get_data()
	{
		$this->db->select();
		$this->db->from($this->_table.' p');
		$query = $this->db->get();
		return $query->result();
	}
	
	protected function add_field($field_name, $field_type, $field_meta = array())
    {
        if (empty($field_meta))
            $field_meta['label'] = $field_name;
		if (!array_key_exists('required', $field_meta))
            $field_meta['required'] = TRUE;
        if (!array_key_exists('default', $field_meta))
            $field_meta['default'] = '';
		$this->fields[$field_name]		= $field_type;
        $this->fields_meta[$field_name]	= $field_meta;
    }
	
	function get_all_fields($filter_type = '', $classify = TRUE)
	{
		$field_container = array();
		foreach ($this->fields as $field_name => $field_type)
		{
			// Campos ocultos
			if ($field_name == "id" || $field_name == "sort" || array_key_exists("internal", $this->fields_meta[$field_name]))
				continue;

            if ($filter_type != '' && $filter_type != $field_type)
                continue;

            $current_field = array();
            $current_field['name'] = $field_name;
            $current_field['type'] = $field_type;
            $current_field = array_merge($current_field, $this->fields_meta[$field_name]);
			if ($classify)
                $field_container[$field_type][$field_name] = $current_field;
            else
                $field_container[$field_name] = $current_field;
        }
        return $field_container;
    }
	
	function get_required_fields()
    {
		$fields = array_filter($this->get_all_fields('', FALSE), function($v) { return $v['required']; });
        return $fields;
    }
	
	function get_by_id($id)
	{
		$this->db->where('id', $id);
		$query = $this->db->get($this->_table);
		if ($query->num_rows == 0)
			return FALSE;
		return $query->first_row();
	}
	
	public function reorder($d_id, $d_from, $d_to, $d_dir)
	{
		$table = $this->_table;
		if ($d_dir == "forward")
			for ($i = $d_from + 1; $i <= $d_to ; $i++)
				$this->db->query('UPDATE '.$this->_table.' as t SET t.sort = t.sort - 1 WHERE t.sort = '.$i);
        else
            for ($i = $d_from - 1 ; $i >= $d_to ; $i--)
				$this->db->query('UPDATE '.$this->_table.' as t SET t.sort = t.sort + 1 WHERE t.sort = '.$i);
        $this->db->query('UPDATE '.$this->_table.' SET sort = '.$d_to.' WHERE id = '.$d_id);
    }
    
    function getFieldsTable($table,$db='db')
    {
        $fields = $this->$db->list_fields($table);
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
}