<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class General_model extends CI_Model {
	
	public function get_config(){
		return $this->db->get('config')->row();
	}
	
	public function update($tabla,$data,$where){
		foreach($where as $k=>$v){
			$this->db->where($k,$v);
		}

		$this->db->update($tabla,$data);
		return $where['id'];
	}
	
	public function dropdown($tabla,$key,$value,$where=null){
		$this->db->select($key.','.$value);
		if($where!=null){
			foreach($where as $k=>$v){
				$this->db->where($k,$v);
			}
		}
		$query=$this->db->get($tabla);
		return $query->result();
	}
	
	public function dropdown_idioma($tabla,$key,$value,$idioma,$where=null){
		$this->db->select($key.','.$value);
		$this->db->join($tabla.'_idiomas', $tabla.'.id = '.$tabla.'_idiomas.id_'.$tabla);
		$this->db->where('id_idioma', $idioma);
		if($where!=null){
			foreach($where as $k=>$v){
				$this->db->where($k,$v);
			}
		}
		$query=$this->db->get($tabla);
		return $query->result();
	}
	
	public function maximo($tabla,$key,$where=null){
		$this->db->select_max($key);
		if($where!=null){
			foreach($where as $k=>$v){
				$this->db->where($k,$v);
			}
		}
		$query = $this->db->get($tabla);
		return $query->row();
	}
	
	public function insert($tabla,$data){
		$this->db->insert($tabla,$data);
		return $this->db->insert_id();
	}
	
	public function existe($tabla,$where){
		foreach($where as $k=>$v){
			$this->db->where($k,$v);
		}
		
		$query=$this->db->get($tabla);
		return count($query->result());
	}

	public function delete($tabla,$where){
		foreach($where as $k=>$v){
			$this->db->where($k,$v);
		}
		$this->db->delete($tabla);
	}
	public function listar($select=null,$tabla,$where=null){
		if($select!=null){
			$this->db->select($select);
		}
		if($where != null){
			foreach($where as $k=>$v){
				$this->db->where($k,$v);
			}
		}
		$query = $this->db->get($tabla);
		return $query->result();
	}
	public function get_fila($tabla,$where=null,$select=null){
		if($select!=null){
			$this->db->select($select);
		}
		if($where != null){
			foreach($where as $k=>$v){
				$this->db->where($k,$v);
			}
		}
		$query = $this->db->get($tabla);
		return $query->row();
	}
	/*
	public function listar($select=null,$tabla,$where=null){
		if($select!=null){
			$this->db->select($select);
		}
		if($where != null){
			foreach($where as $k=>$v){
				$this->db->where($k,$v);
			}
		}
		$query = $this->db->get($tabla);
		return $query->result();
	}*/
}

?>